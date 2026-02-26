<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ForgotPasswordController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }




    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('guest'),
        ];
    }
    /**
     * Show the forgot password request form.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the given email address.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'exists:users,email',
                'max:255'
            ]
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'We could not find a user with that email address.',
            'email.max' => 'Email address must not exceed 255 characters.'
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        try {
            // Attempt to send the password reset link
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // Handle the response based on the status
            switch ($status) {
                case Password::RESET_LINK_SENT:
                    // Success - reset link sent
                    return back()->with('status', trans($status))
                                 ->with('success', 'Password reset link has been sent to your email.')
                                 ->withInput($request->only('email'));

                case Password::INVALID_USER:
                    // User not found
                    return back()->withErrors([
                        'email' => trans($status)
                    ])->withInput($request->only('email'));

                case Password::RESET_THROTTLED:
                    // Too many requests
                    return back()->withErrors([
                        'email' => 'Too many password reset attempts. Please try again in ' . 
                                  config('auth.passwords.users.throttle') . ' seconds.'
                    ])->withInput($request->only('email'));

                default:
                    // Any other error
                    return back()->withErrors([
                        'email' => 'An error occurred while sending the reset link. Please try again.'
                    ])->withInput($request->only('email'));
            }

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Password reset error: ' . $e->getMessage(), [
                'email' => $request->email,
                'trace' => $e->getTraceAsString()
            ]);

            // Return a user-friendly error message
            return back()->withErrors([
                'email' => 'Unable to send password reset link at this time. Please try again later.'
            ])->withInput($request->only('email'));
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Validate the email for the forgot password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email is valid.'
        ]);
    }

    /**
     * Resend password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        $email = Session::get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please request a new password reset link.']);
        }

        $request->merge(['email' => $email]);

        return $this->sendResetLinkEmail($request);
    }

    /**
     * Show the password reset request form with a specific email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $email
     * @return \Illuminate\View\View
     */
    public function showLinkRequestFormWithEmail(Request $request, $email)
    {
        return view('auth.forgot-password', [
            'email' => urldecode($email)
        ]);
    }

    /**
     * Handle the forgot password request from API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset link has been sent to your email.',
                    'data' => [
                        'email' => $request->email,
                        'status' => $status
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => trans($status),
                'data' => [
                    'email' => $request->email,
                    'status' => $status
                ]
            ], 400);

        } catch (\Exception $e) {
            \Log::error('API Password reset error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to send password reset link at this time.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Check if email exists in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'exists' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = \App\Models\User::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Email found.' : 'Email not found.'
        ]);
    }

    /**
     * Get the password reset rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email', 'max:255']
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'We could not find a user with that email address.',
            'email.max' => 'Email address must not exceed 255 characters.'
        ];
    }

    /**
     * Get the maximum number of attempts for password reset.
     *
     * @return int
     */
    protected function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 3;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    protected function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 60;
    }
}