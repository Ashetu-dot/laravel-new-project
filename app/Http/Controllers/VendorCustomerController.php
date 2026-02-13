<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class VendorCustomerController extends Controller
{
    /**
     * Display the login form.
     */
    public function index()
    {
        return view('auth.vendor-customer-login');
    }

    /**
     * Show the registration form.
     */
    public function create()
    {
        // Initialize step if not set
        if (!Session::has('registration_step')) {
            Session::put('registration_step', 1);
        }

        return view('auth.vendor-customer-register');
    }

    /**
     * Save current step for multi-step form.
     */
    public function saveStep(Request $request)
    {
        $request->validate(['step' => 'required|integer|between:1,3']);
        Session::put('registration_step', $request->step);
        return response()->json(['success' => true]);
    }

    /**
     * Handle vendor registration.
     */
    public function register(Request $request)
    {
        // If coming from step 2, validate and create user
        if ($request->has('business_name')) {
            // Validate all fields
            $validated = $request->validate([
                // Account Information
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()],

                // Business Information
                'business_name' => ['required', 'string', 'max:255'],
                'category' => ['required', 'string', 'max:100'],
                'tax_id' => ['nullable', 'string', 'max:100'],
                'website' => ['nullable', 'url', 'max:255'],
                'address_line1' => ['required', 'string', 'max:255'],
                'address_line2' => ['nullable', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:100'],
                'state' => ['required', 'string', 'max:100'],
                'zip_code' => ['required', 'string', 'max:20'],
                'description' => ['required', 'string', 'max:500'],
                'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
            ]);

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('vendor-logos', 'public');
            }

            try {
                // Create the user account with vendor role
                $user = User::create([
                    'name' => $validated['fullname'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'vendor',
                    'business_name' => $validated['business_name'],
                    'category' => $validated['category'],
                    'tax_id' => $validated['tax_id'] ?? null,
                    'website' => $validated['website'] ?? null,
                    'address_line1' => $validated['address_line1'],
                    'address_line2' => $validated['address_line2'] ?? null,
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'zip_code' => $validated['zip_code'],
                    'description' => $validated['description'],
                    'avatar' => $logoPath,
                    'products_count' => 0,
                    'rating' => 0,
                    'total_reviews' => 0,
                    'is_active' => true,
                    'country' => 'USA',
                ]);

                // Log the user in
                Auth::login($user);

                // Send email verification notification
                $user->sendEmailVerificationNotification();

                // Clear registration step
                Session::forget('registration_step');

                // Set step to 3 for verification page
                Session::put('registration_step', 3);

                return redirect()->route('register')
                    ->with('success', 'Vendor account created successfully! Please verify your email.')
                    ->with('step', 3);

            } catch (\Exception $e) {
                return back()->withInput()
                    ->with('error', 'Registration failed. Please try again.')
                    ->with('step', 2);
            }
        }

        // If this is a new registration, just show step 2
        Session::put('registration_step', 2);
        return redirect()->route('register')->with('step', 2);
    }

    /**
     * Display search results for vendors.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $category = $request->get('category');
        $location = $request->get('location');
        $rating = $request->get('rating');

        $vendors = User::where('role', 'vendor')
            ->where('is_active', true)
            ->when($query, function ($q, $query) {
                return $q->where(function ($subQ) use ($query) {
                    $subQ->where('business_name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%")
                         ->orWhere('category', 'like', "%{$query}%");
                });
            })
            ->when($category, function ($q, $category) {
                return $q->where('category', $category);
            })
            ->when($location, function ($q, $location) {
                return $q->where(function ($subQ) use ($location) {
                    $subQ->where('city', 'like', "%{$location}%")
                         ->orWhere('state', 'like', "%{$location}%");
                });
            })
            ->when($rating, function ($q, $rating) {
                return $q->where('rating', '>=', $rating);
            })
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $totalResults = $vendors->total();

        return view('search-results', compact('vendors', 'query', 'category', 'location', 'totalResults'));
    }

    /**
     * Display a single vendor profile.
     */
    public function showVendor(string $id)
    {
        $vendor = User::where('role', 'vendor')
            ->where('is_active', true)
            ->with('followers')
            ->findOrFail($id);

        $isFollowing = false;
        if (Auth::check()) {
            $isFollowing = Auth::user()->following()
                ->where('vendor_id', $vendor->id)
                ->exists();
        }

        $followersCount = $vendor->followers()->count();

        return view('vendor.show', compact('vendor', 'isFollowing', 'followersCount'));
    }

    /**
     * Follow a vendor.
     */
    public function follow(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to follow vendors.');
        }

        $vendor = User::where('role', 'vendor')->findOrFail($id);
        $user = Auth::user();

        if ($user->id === $vendor->id) {
            return back()->with('error', 'You cannot follow your own shop.');
        }

        if ($user->following()->where('vendor_id', $vendor->id)->exists()) {
            return back()->with('info', 'You are already following ' . $vendor->business_name);
        }

        $user->following()->attach($vendor->id);

        return back()->with('success', 'Now following ' . $vendor->business_name);
    }

    /**
     * Unfollow a vendor.
     */
    public function unfollow(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $vendor = User::where('role', 'vendor')->findOrFail($id);
        $user = Auth::user();

        $user->following()->detach($vendor->id);

        return back()->with('success', 'Unfollowed ' . $vendor->business_name);
    }

    /**
     * Handle login request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'vendor') {
                return redirect()->intended(route('vendor.dashboard'));
            } elseif ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Display user profile.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            abort(403);
        }

        $followersCount = $user->role === 'vendor' ? $user->followers()->count() : 0;
        $followingCount = $user->following()->count();

        return view('profile.show', compact('user', 'followersCount', 'followingCount'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            abort(403);
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'business_name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'description' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('profile.show', $user->id)
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete user account.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            abort(403);
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        Auth::logout();
        $user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Your account has been deleted.');
    }

    /**
     * Vendor dashboard.
     */
    public function vendorDashboard()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'vendor') {
            abort(403);
        }

        $vendor = $user;
        $followersCount = $vendor->followers()->count();
        $productsCount = $vendor->products_count ?? 0;
        $recentFollowers = $vendor->followers()
            ->orderBy('followers.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('vendor.dashboard', compact('vendor', 'followersCount', 'productsCount', 'recentFollowers'));
    }

    /**
     * Customer dashboard.
     */
    public function customerDashboard()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'customer') {
            abort(403);
        }

        $following = $user->following()
            ->orderBy('followers.created_at', 'desc')
            ->paginate(10);

        return view('customer.dashboard', compact('user', 'following'));
    }

    /**
     * Update vendor settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'vendor') {
            abort(403);
        }

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Get vendor stats for AJAX requests.
     */
    public function getVendorStats()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $stats = [
            'followers' => $user->followers()->count(),
            'products' => $user->products_count ?? 0,
            'rating' => (float) $user->rating ?? 0,
            'total_reviews' => $user->total_reviews ?? 0,
        ];

        return response()->json($stats);
    }

    /**
     * Search vendors for AJAX endpoints.
     */
    public function searchVendors(Request $request)
    {
        $query = $request->get('q');

        $vendors = User::where('role', 'vendor')
            ->where('is_active', true)
            ->when($query, function ($q, $query) {
                return $q->where('business_name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'business_name', 'city', 'state', 'avatar', 'rating', 'category']);

        return response()->json($vendors);
    }

    /**
     * Get vendor by ID for AJAX.
     */
    public function getVendor(string $id)
    {
        $vendor = User::where('role', 'vendor')
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'id' => $vendor->id,
            'business_name' => $vendor->business_name,
            'category' => $vendor->category,
            'city' => $vendor->city,
            'state' => $vendor->state,
            'avatar' => $vendor->avatar,
            'rating' => $vendor->rating,
            'description' => $vendor->description,
        ]);
    }
}