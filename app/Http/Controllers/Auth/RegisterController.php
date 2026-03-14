<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Show the registration form (main registration page for both customer and vendor)
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Show customer registration form (using the same view)
     */
    public function showCustomerRegister()
    {
        // Use the same view file
        return view('auth.register');
    }

    /**
     * Handle registration (both customer and vendor)
     */
    public function register(Request $request)
    {
        // Log incoming request data for debugging
        Log::info('Registration attempt', ['email' => $request->email, 'role' => $request->role]);

        // Validate based on role
        if ($request->role === 'vendor') {
            $validator = $this->validateVendor($request);
        } else {
            $validator = $this->validateCustomer($request);
        }

        if ($validator->fails()) {
            Log::warning('Registration validation failed', [
                'errors' => $validator->errors()->toArray(),
                'email' => $request->email
            ]);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Check if email already exists
            if (User::where('email', $request->email)->exists()) {
                DB::rollBack();
                Log::warning('Email already exists during registration', ['email' => $request->email]);

                return redirect()->back()
                    ->with('error', 'This email is already registered.')
                    ->withInput();
            }

            // Prepare user data - WITHOUT username field
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password, ['rounds' => 10]),
                'role' => $request->role ?? 'customer',
                'phone' => $request->phone,
                'is_active' => ($request->role === 'vendor') ? false : true,
                'email_verified_at' => null,
            ];

            // Add vendor-specific fields
            if ($request->role === 'vendor') {
                $userData = array_merge($userData, [
                    'business_name' => $request->business_name,
                    'category' => $request->category,
                    'description' => $request->description,
                    'city' => $request->city,
                    'state' => $request->state,
                    'website' => $request->website,
                    'location' => ($request->city && $request->state) ? $request->city . ', ' . $request->state : null,
                ]);
            }

            Log::info('Attempting to create user', [
                'email' => $userData['email'],
                'role' => $userData['role']
            ]);

            // Create user
            $user = User::create($userData);

            if (!$user) {
                throw new \Exception('User creation failed - no user returned');
            }

            Log::info('User created successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // Fire registered event (sends verification email)
            try {
                event(new Registered($user));
                Log::info('Registered event fired', ['user_id' => $user->id]);
            } catch (\Exception $e) {
                Log::error('Failed to fire Registered event', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id
                ]);
                // Don't rollback - user is already created
            }

            // Notify admins about new user registration
            try {
                $this->notificationService->notifyAdminsNewUser($user);
                Log::info('Admin notification sent for new user', ['user_id' => $user->id]);
            } catch (\Exception $e) {
                Log::error('Failed to notify admins about new user', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id
                ]);
                // Don't rollback - user is already created
            }

            DB::commit();

            Log::info('Transaction committed', ['user_id' => $user->id]);

            // Redirect with appropriate message
            if ($user->role === 'vendor') {
                return redirect()->route('login')
                    ->with('success', 'Registration successful! Please check your email to verify your account. Your vendor account will be active after verification and admin approval.');
            }

            return redirect()->route('login')
                ->with('success', 'Registration successful! Please check your email to verify your account before logging in.');

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            $errorCode = $e->errorInfo[1] ?? null;
            $errorMessage = $e->getMessage();

            Log::error('Database error during registration', [
                'error_code' => $errorCode,
                'error_message' => $errorMessage,
                'email' => $request->email
            ]);

            if ($errorCode == 1062) { // Duplicate entry
                return redirect()->back()
                    ->with('error', 'This email is already registered.')
                    ->withInput();
            }

            return redirect()->back()
                ->with('error', 'Database error occurred. Please try again.')
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Registration failed with exception', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'email' => $request->email
            ]);

            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Handle customer-only registration (from customer register link)
     */
    public function registerCustomer(Request $request)
    {
        // Set role to customer
        $request->merge(['role' => 'customer']);

        // Reuse the main register method
        return $this->register($request);
    }

    /**
     * Validate vendor registration data
     */
    private function validateVendor(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => [
                'required',
                'string',
                'max:25',
                function ($attribute, $value, $fail) {
                    // Normalize to digits only and validate Ethiopian mobile format
                    $digits = preg_replace('/\D+/', '', $value ?? '');

                    // Expect 12 digits starting with country code 251 and leading 9 (e.g. 2519XXXXXXXX)
                    if (!preg_match('/^2519\d{8}$/', $digits)) {
                        $fail('Please enter a valid Ethiopian mobile number (e.g. +251 9XX XXX XXX).');
                    }
                },
            ],
            'business_name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'city' => [
                'nullable',
                'string',
                'max:100',
                // Common Ethiopian cities – keep in sync with the view
                'in:Addis Ababa,Jimma,Dire Dawa,Bahir Dar,Mekelle,Adama,Hawassa,Gondar,Dessie,Jijiga,Shashamane,Harar',
            ],
            'state' => [
                'nullable',
                'string',
                'max:100',
                // Ethiopian regions – keep in sync with the view
                'in:Oromia,Amhara,Tigray,Addis Ababa,Dire Dawa,Somali,Afar,Benishangul-Gumuz,SNNPR,Gambela,Harari,Sidama,South West Ethiopia Peoples',
            ],
            'website' => ['nullable', 'url', 'max:255'],
            'terms' => ['required', 'accepted'],
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'phone.required' => 'Please enter your phone number.',
            'business_name.required' => 'Please enter your business name.',
            'category.required' => 'Please select a business category.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);
    }

    /**
     * Validate customer registration data
     */
    private function validateCustomer(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => [
                'nullable',
                'string',
                'max:25',
                function ($attribute, $value, $fail) {
                    if ($value === null || $value === '') {
                        return;
                    }

                    $digits = preg_replace('/\D+/', '', $value ?? '');

                    // Allow empty or valid Ethiopian mobile number
                    if (!preg_match('/^2519\d{8}$/', $digits)) {
                        $fail('Please enter a valid Ethiopian mobile number (e.g. +251 9XX XXX XXX).');
                    }
                },
            ],
            'terms' => ['required', 'accepted'],
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);
    }

    /**
     * Check if email already exists (AJAX)
     */
    public function checkEmailExists(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'This email is already registered.' : 'Email is available.'
        ]);
    }

    /**
     * Send verification email manually
     */
    public function sendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email already verified.'
                ]);
            }

            $user->sendEmailVerificationNotification();

            return response()->json([
                'success' => true,
                'message' => 'Verification email sent successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Send verification email failed', [
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send verification email.'
            ], 500);
        }
    }
}
