<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Category;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Message;
use App\Models\User;
use App\Models\Testimonial;

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
     * Show the vendor registration form.
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
     * Show the customer registration form.
     */
    public function showCustomerRegister()
    {
        return view('auth.customer-register');
    }

    /**
     * Save current step for multi-step vendor form.
     */
    public function saveStep(Request $request)
    {
        $request->validate(['step' => 'required|integer|between:1,3']);
        Session::put('registration_step', $request->step);
        return response()->json(['success' => true]);
    }

    /**
     * Handle customer registration.
     */
    public function registerCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            // Create the user account with customer role
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'city' => $validated['city'],
                'password' => Hash::make($validated['password']),
                'role' => 'customer',
                'is_active' => true,
                'country' => 'Ethiopia',
                'products_count' => 0,
                'rating' => 0,
                'total_reviews' => 0,
            ]);

            // Send email verification notification
            $user->sendEmailVerificationNotification();

            // Log the user in
            Auth::login($user);

            return redirect()->route('customer.dashboard')
                ->with('success', 'Account created successfully! Please verify your email.');

        } catch (\Exception $e) {
            Log::error('Customer registration failed: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
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
                'phone' => ['nullable', 'string', 'max:20'],
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
                try {
                    $logoPath = $request->file('logo')->store('vendor-logos', 'public');
                } catch (\Exception $e) {
                    Log::error('Logo upload failed: ' . $e->getMessage());
                }
            }

            try {
                DB::beginTransaction();

                // Create the user account with vendor role
                $user = User::create([
                    'name' => $validated['fullname'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
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
                    'country' => 'Ethiopia',
                ]);

                // Log the user in
                Auth::login($user);

                // Send email verification notification
                $user->sendEmailVerificationNotification();

                DB::commit();

                // Clear registration step
                Session::forget('registration_step');

                // Set step to 3 for verification page
                Session::put('registration_step', 3);

                return redirect()->route('register')
                    ->with('success', 'Vendor account created successfully! Please verify your email.')
                    ->with('step', 3);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Vendor registration failed: ' . $e->getMessage());
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
     * Send password reset link.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We could not find a user with that email address.'
        ]);

        try {
            // Send password reset link
            $status = PasswordBroker::sendResetLink(
                $request->only('email')
            );

            if ($status === PasswordBroker::RESET_LINK_SENT) {
                return back()->with('status', __($status));
            }

            return back()->withErrors(['email' => __($status)]);
            
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            
            return back()->withErrors([
                'email' => 'An error occurred while sending the reset link. Please try again later.'
            ]);
        }
    }

    /**
     * Reset password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $status = PasswordBroker::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === PasswordBroker::PASSWORD_RESET) {
                return redirect()->route('login')->with('status', __($status));
            }

            return back()->withErrors(['email' => [__($status)]]);
            
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            
            return back()->withErrors([
                'email' => 'An error occurred while resetting your password. Please try again later.'
            ]);
        }
    }

    /**
     * Check if email exists in the system (AJAX endpoint for real-time validation).
     */
    public function checkEmailExists(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            $email = $request->email;
            $exists = User::where('email', $email)->exists();
            
            return response()->json([
                'exists' => $exists,
                'message' => $exists ? 'Email registered' : 'Email not registered'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Email check error: ' . $e->getMessage());
            
            return response()->json([
                'exists' => false,
                'message' => 'Error checking email'
            ], 500);
        }
    }

    /**
     * Handle login request (for customers and vendors from main login page).
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');
        $selectedRole = $request->input('role', 'customer');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact support.',
                ])->onlyInput('email');
            }

            // Check if email is verified
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return redirect()->route('verification.notice')
                    ->with('error', 'Please verify your email before logging in.');
            }

            // Verify role matches selected role
            if ($selectedRole === 'customer' && $user->role !== 'customer') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account is not registered as a customer.',
                ])->onlyInput('email');
            }

            if ($selectedRole === 'vendor' && $user->role !== 'vendor') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account is not registered as a vendor.',
                ])->onlyInput('email');
            }

            // Update last login
            $user->last_login_at = now();
            $user->save();

            // Redirect based on user role
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
     * Handle admin login request (from admin login page).
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact support.',
                ])->onlyInput('email');
            }

            // Check if email is verified
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return redirect()->route('verification.notice')
                    ->with('error', 'Please verify your email before logging in.');
            }

            // Check if user is admin
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account does not have admin privileges.',
                ])->onlyInput('email');
            }

            // Update last login
            $user->last_login_at = now();
            $user->save();

            return redirect()->intended(route('admin.dashboard'));
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
     * Display homepage with stats from database.
     */
    public function home()
    {
        try {
            // Get counts for hero stats
            $vendorCount = User::where('role', 'vendor')
                              ->where('is_active', true)
                              ->count();
            
            $customerCount = User::where('role', 'customer')
                                ->where('is_active', true)
                                ->count();
            
            $categoryCount = Category::count();
            
            // If no data yet, use defaults for display
            $vendorCount = $vendorCount ?: 500;
            $customerCount = $customerCount ?: 10000;
            $categoryCount = $categoryCount ?: 15;
            
            // Get popular categories (categories with most vendors/products)
            $popularCategories = Category::withCount('products')
                                         ->orderBy('products_count', 'desc')
                                         ->limit(6)
                                         ->get();
            
            // Get categories popular in Jimma
            $jimmaCategories = Category::withCount(['products' => function($query) {
                $query->whereHas('vendor', function($q) {
                    $q->where('city', 'LIKE', '%Jimma%')
                      ->orWhere('location', 'LIKE', '%Jimma%');
                });
            }])
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->limit(3)
            ->get();
            
            // Get testimonials
            try {
                $testimonials = Testimonial::where('is_active', true)
                                           ->orderBy('sort_order')
                                           ->orderBy('created_at', 'desc')
                                           ->limit(4)
                                           ->get();
            } catch (\Exception $e) {
                // If testimonials table doesn't exist, create empty collection
                $testimonials = collect([]);
            }
            
            return view('home', compact(
                'vendorCount',
                'customerCount', 
                'categoryCount',
                'popularCategories',
                'jimmaCategories',
                'testimonials'
            ));
            
        } catch (\Exception $e) {
            Log::error('Home page error: ' . $e->getMessage());
            
            // Return with empty collections if there's an error
            $vendorCount = 500;
            $customerCount = 10000;
            $categoryCount = 15;
            $popularCategories = collect([]);
            $jimmaCategories = collect([]);
            $testimonials = collect([]);
            
            return view('home', compact(
                'vendorCount',
                'customerCount', 
                'categoryCount',
                'popularCategories',
                'jimmaCategories',
                'testimonials'
            ));
        }
    }


    /**
 * Display about page with statistics.
 */
public function about()
{
    try {
        // Get counts for statistics
        $vendorCount = User::where('role', 'vendor')
                          ->where('is_active', true)
                          ->count();
        
        $customerCount = User::where('role', 'customer')
                            ->where('is_active', true)
                            ->count();
        
        $categoryCount = Category::count();
        
        // Get total number of successful orders/completed transactions
        $totalTransactions = Order::whereIn('status', ['completed', 'delivered'])
                                  ->count();
        
        // Get average rating across all vendors
        $averageRating = User::where('role', 'vendor')
                             ->where('rating', '>', 0)
                             ->avg('rating');
        
        // Get cities with most vendors
        $topCities = User::where('role', 'vendor')
                        ->where('is_active', true)
                        ->whereNotNull('city')
                        ->select('city', DB::raw('count(*) as total'))
                        ->groupBy('city')
                        ->orderBy('total', 'desc')
                        ->limit(5)
                        ->get();
        
        // Get recent testimonials
        $recentTestimonials = Testimonial::where('is_active', true)
                                         ->orderBy('created_at', 'desc')
                                         ->limit(3)
                                         ->get();
        
        return view('pages.about', compact(
            'vendorCount',
            'customerCount', 
            'categoryCount',
            'totalTransactions',
            'averageRating',
            'topCities',
            'recentTestimonials'
        ));
        
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('About page error: ' . $e->getMessage());
        
        // Return with default values if there's an error
        $vendorCount = 500;
        $customerCount = 10000;
        $categoryCount = 15;
        $totalTransactions = 5000;
        $averageRating = 4.8;
        $topCities = collect([]);
        $recentTestimonials = collect([]);
        
        return view('pages.about', compact(
            'vendorCount',
            'customerCount', 
            'categoryCount',
            'totalTransactions',
            'averageRating',
            'topCities',
            'recentTestimonials'
        ));
    }
}

/**
 * Display careers page.
 */
public function careers()
{
    // You can fetch open positions from database if you have a jobs table
    // For now, we'll use static data
    return view('pages.careers');
}

/**
 * Handle job application submission.
 */
public function apply(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'position' => 'required|string',
        'cover_letter' => 'nullable|string',
        'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
    ]);

    try {
        // Store resume file
        $resumePath = $request->file('resume')->store('applications', 'public');
        
        // Here you would save to database or send email
        // For now, just redirect with success message
        
        return redirect()->route('careers')->with('success', 'Application submitted successfully! We will review your application and contact you soon.');
        
    } catch (\Exception $e) {
        Log::error('Application submission failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to submit application. Please try again.');
    }
}

/**
 * Display press page.
 */
public function press()
{
    // You can fetch press releases from database if you have a press_releases table
    // For now, we'll use static data from the view
    
    return view('pages.press');
}

/**
 * Handle press newsletter subscription.
 */
public function pressSubscribe(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|max:255',
    ]);

    try {
        // Here you would save to database or add to mailing list
        // For now, just redirect with success message
        
        return redirect()->route('press')->with('success', 'Thank you for subscribing to our press newsletter!');
        
    } catch (\Exception $e) {
        Log::error('Press subscription failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to subscribe. Please try again.');
    }
}

/**
 * Display blog listing page.
 */
public function blog()
{
    // You can fetch blog posts from database if you have a posts table
    // For now, we'll use static data from the view
    
    return view('pages.blog');
}

/**
 * Display single blog post.
 */
public function blogPost($slug)
{
    // Here you would fetch the specific blog post from database
    // For now, redirect to blog listing
    
    return view('pages.blog-post', compact('slug'));
}

/**
 * Handle blog newsletter subscription.
 */
public function blogSubscribe(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|max:255',
    ]);

    try {
        // Here you would save to database or add to mailing list
        // For now, just redirect with success message
        
        return redirect()->route('blog')->with('success', 'Thank you for subscribing to our blog newsletter!');
        
    } catch (\Exception $e) {
        Log::error('Blog subscription failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to subscribe. Please try again.');
    }
}


/**
 * Display trust and safety page.
 */
public function trustSafety()
{
    return view('pages.trust-safety');
}

/**
 * Handle safety report submission.
 */
public function safetyReport(Request $request)
{
    $validated = $request->validate([
        'report_type' => 'required|string',
        'vendor_id' => 'nullable|exists:users,id',
        'description' => 'required|string|max:1000',
        'contact_email' => 'required|email',
    ]);

    try {
        // Here you would save the report to database and notify safety team
        // For now, just redirect with success message
        
        return redirect()->route('trust-safety')->with('success', 'Thank you for your report. Our safety team will review it within 24 hours.');
        
    } catch (\Exception $e) {
        Log::error('Safety report failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to submit report. Please try again or contact us directly.');
    }
}







/**
 * Display help center page.
 */
public function helpCenter()
{
    // You can fetch help articles from database if you have a help_articles table
    // For now, we'll use static data from the view
    
    return view('pages.help-center');
}

/**
 * Search help articles.
 */
public function helpSearch(Request $request)
{
    $query = $request->get('q');
    
    // Here you would search your help articles database
    // For now, redirect back with message
    
    return redirect()->route('help-center')->with('info', 'Search results for: "' . $query . '" (Search functionality coming soon)');
}

/**
 * Display single help article.
 */
public function helpArticle($slug)
{
    // Here you would fetch the specific help article from database
    // For now, redirect to help center
    
    return view('pages.help-article', compact('slug'));
}







/**
 * Display invite friends page.
 */
public function invite()
{
    $user = Auth::user();
    
    if ($user) {
        // Generate referral code if user doesn't have one
        if (!$user->referral_code) {
            $user->referral_code = 'VENDORA' . strtoupper(substr(md5($user->id . time()), 0, 6));
            $user->save();
        }
        
        // Get user's referrals (you would need a referrals table)
        // $referrals = Referral::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        $totalInvites = 12; // Example data
        $successfulInvites = 8; // Example data
        $totalEarned = 450; // Example data
        
        return view('pages.invite', compact('user', 'totalInvites', 'successfulInvites', 'totalEarned'));
    }
    
    return view('pages.invite');
}

/**
 * Send email invitation.
 */
public function sendInvite(Request $request)
{
    $validated = $request->validate([
        'friend_name' => 'required|string|max:255',
        'friend_email' => 'required|email|max:255',
        'message' => 'nullable|string',
    ]);

    try {
        $user = Auth::user();
        
        // Here you would send the email
        // Mail::to($validated['friend_email'])->send(new InviteFriendMail($validated, $user));
        
        // Save to database (if you have a referrals table)
        // Referral::create([
        //     'user_id' => $user->id,
        //     'friend_email' => $validated['friend_email'],
        //     'friend_name' => $validated['friend_name'],
        //     'status' => 'pending',
        // ]);
        
        return redirect()->route('invite')->with('success', 'Invitation sent successfully to ' . $validated['friend_name'] . '!');
        
    } catch (\Exception $e) {
        Log::error('Invite send failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to send invitation. Please try again.');
    }
}



/**
 * Display features page.
 */
public function features()
{
    return view('pages.features');
}


/**
 * Display how it works page.
 */
public function howItWorks()
{
    // Get counts for statistics
    $vendorCount = User::where('role', 'vendor')->where('is_active', true)->count();
    $customerCount = User::where('role', 'customer')->where('is_active', true)->count();
    
    // Get booking count (you would need a bookings table)
    // $bookingCount = Booking::count();
    $bookingCount = 5000; // Example data
    
    // Get cities count
    $cityCount = User::where('role', 'vendor')
                    ->whereNotNull('city')
                    ->distinct('city')
                    ->count('city');
    
    return view('pages.how-it-works', compact(
        'vendorCount',
        'customerCount',
        'bookingCount',
        'cityCount'
    ));
}




/**
 * Display list service page.
 */
public function listService()
{
    // Get vendor counts by category
    $categoryVendors = [
        'food' => User::where('role', 'vendor')->where('category', 'like', '%food%')->count(),
        'photography' => User::where('role', 'vendor')->where('category', 'like', '%photo%')->count(),
        'home' => User::where('role', 'vendor')->where('category', 'like', '%home%')->count(),
        'beauty' => User::where('role', 'vendor')->where('category', 'like', '%beauty%')->count(),
        'automotive' => User::where('role', 'vendor')->where('category', 'like', '%auto%')->count(),
        'events' => User::where('role', 'vendor')->where('category', 'like', '%event%')->count(),
        'tech' => User::where('role', 'vendor')->where('category', 'like', '%tech%')->count(),
        'handicrafts' => User::where('role', 'vendor')->where('category', 'like', '%handicraft%')->count(),
    ];
    
    return view('pages.list-service', compact('categoryVendors'));
}



/**
 * Display vendor resources page.
 */
public function vendorResources()
{
    // Get counts for community stats
    $telegramMembers = 2500; // This could come from a config or database
    $whatsappMembers = 1800;
    
    return view('pages.vendor-resources', compact('telegramMembers', 'whatsappMembers'));
}

/**
 * Display success stories page.
 */
public function successStories()
{
    // Get vendor counts
    $vendorCount = User::where('role', 'vendor')->where('is_active', true)->count();
    
    // Calculate average growth (this would come from actual data in a real app)
    $avgGrowth = '150%';
    
    // Calculate total earnings (this would come from orders table)
    $totalEarnings = '5M+';
    
    // Count happy customers
    $happyCustomers = User::where('role', 'customer')->where('is_active', true)->count();
    
    return view('pages.success-stories', compact(
        'vendorCount',
        'avgGrowth',
        'totalEarnings',
        'happyCustomers'
    ));
}






/**
 * Display community page.
 */
public function community()
{
    // Get community stats
    $totalMembers = User::count(); // Total users
    $dailyPosts = 500; // This would come from a forum posts table
    $monthlyEvents = 25; // This would come from an events table
    $mentors = User::where('role', 'vendor')->where('is_active', true)->count() / 10; // Example calculation
    
    return view('pages.community', compact(
        'totalMembers',
        'dailyPosts',
        'monthlyEvents',
        'mentors'
    ));
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
            ->with(['followers', 'products' => function($q) {
                $q->where('is_active', true)->take(6);
            }])
            ->findOrFail($id);

        $isFollowing = false;
        if (Auth::check()) {
            $isFollowing = Auth::user()->following()
                ->where('vendor_id', $vendor->id)
                ->exists();
        }

        $followersCount = $vendor->followers()->count();
        $productsCount = $vendor->products()->count();

        return view('vendor.show', compact('vendor', 'isFollowing', 'followersCount', 'productsCount'));
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
            return back()->with('info', 'You are already following ' . ($vendor->business_name ?? $vendor->name));
        }

        $user->following()->attach($vendor->id, ['created_at' => now(), 'updated_at' => now()]);

        return back()->with('success', 'Now following ' . ($vendor->business_name ?? $vendor->name));
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

        return back()->with('success', 'Unfollowed ' . ($vendor->business_name ?? $vendor->name));
    }

    /**
     * Display user profile.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $followersCount = $user->role === 'vendor' ? $user->followers()->count() : 0;
        $followingCount = $user->following()->count();
        
        $productsCount = $user->role === 'vendor' ? Product::where('vendor_id', $user->id)->count() : 0;

        return view('profile.show', compact('user', 'followersCount', 'followingCount', 'productsCount'));
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

        $rules = [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Add vendor-specific fields
        if ($user->role === 'vendor') {
            $rules['business_name'] = 'sometimes|string|max:255';
            $rules['category'] = 'sometimes|string|max:100';
            $rules['description'] = 'nullable|string|max:500';
            $rules['website'] = 'nullable|url|max:255';
        }

        $validated = $request->validate($rules);

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

        DB::beginTransaction();

        try {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Remove followers/following relationships
            $user->followers()->detach();
            $user->following()->detach();

            // Delete user's products if vendor
            if ($user->role === 'vendor') {
                Product::where('vendor_id', $user->id)->delete();
            }

            Auth::logout();
            $user->delete();

            DB::commit();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'Your account has been deleted.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Account deletion failed: ' . $e->getMessage());
            
            return back()->with('error', 'Failed to delete account. Please try again.');
        }
    }

    /**
     * Show vendor dashboard with real data.
     */
    public function vendorDashboard()
    {
        $user = Auth::user();

        // Get followers count
        $followersCount = $user->followers()->count();

        // Get products count
        $productsCount = Product::where('vendor_id', $user->id)->count();

        // Get store views
        $storeViews = $user->store_views ?? rand(800, 1500);

        // Get order statistics
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');

        $totalOrders = Order::whereHas('items', function($q) use ($vendorProductIds) {
            $q->whereIn('product_id', $vendorProductIds);
        })->count();

        $pendingOrders = Order::whereHas('items', function($q) use ($vendorProductIds) {
            $q->whereIn('product_id', $vendorProductIds);
        })->where('status', 'pending')->count();

        $processingOrders = Order::whereHas('items', function($q) use ($vendorProductIds) {
            $q->whereIn('product_id', $vendorProductIds);
        })->where('status', 'processing')->count();

        $completedOrders = Order::whereHas('items', function($q) use ($vendorProductIds) {
            $q->whereIn('product_id', $vendorProductIds);
        })->whereIn('status', ['completed', 'delivered'])->count();

        $totalRevenue = Order::whereHas('items', function($q) use ($vendorProductIds) {
            $q->whereIn('product_id', $vendorProductIds);
        })->whereIn('status', ['completed', 'delivered'])->sum('total_amount');

        // Get recent orders
        $recentOrders = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->with(['user', 'items.product'])
          ->orderBy('created_at', 'desc')
          ->paginate(10);

        // Get recent followers
        $recentFollowers = $user->followers()
            ->orderBy('followers.created_at', 'desc')
            ->take(5)
            ->get();

        // Get unread counts
        try {
            $unreadNotificationsCount = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
        }

        try {
            $unreadMessagesCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }

        // Get categories for the add product modal
        try {
            $categories = Category::where('vendor_id', $user->id)
                ->orWhere('is_global', true)
                ->get();
        } catch (\Exception $e) {
            $categories = Category::all();
        }

        // Average rating
        $averageRating = $user->rating ?? 4.8;

        return view('vendor.dashboard', compact(
            'user',
            'followersCount',
            'productsCount',
            'storeViews',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'totalRevenue',
            'recentOrders',
            'recentFollowers',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'categories',
            'averageRating'
        ));
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

        // Get following vendors with pagination
        $following = $user->following()
            ->withCount('products')
            ->orderBy('followers.created_at', 'desc')
            ->paginate(8);

        $followingCount = $user->following()->count();

        // Get unread notifications count
        try {
            $unreadNotificationsCount = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
        }

        // Get unread messages count
        try {
            $unreadMessagesCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }

        // Get recent notifications
        try {
            $recentNotifications = Notification::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            $recentNotifications = collect([]);
        }

        // Get recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Cart count (session-based)
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        
        $cartItems = collect([]);
        $cartTotal = 0;

        return view('customer.dashboard', compact(
            'user',
            'following',
            'followingCount',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'recentNotifications',
            'recentOrders',
            'cartCount',
            'cartItems',
            'cartTotal'
        ));
    }

    /**
     * Display the vendors that the customer follows.
     */
    public function following()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'customer') {
            abort(403);
        }

        // Get vendors that the customer follows with pagination
        $following = $user->following()
            ->with(['products' => function($q) {
                $q->where('is_active', true)->take(3);
            }])
            ->orderBy('followers.created_at', 'desc')
            ->paginate(12);

        // Get unread counts for header
        try {
            $unreadNotificationsCount = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
        }

        try {
            $unreadMessagesCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }

        return view('customer.following', compact(
            'user',
            'following',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
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
            'products' => Product::where('vendor_id', $user->id)->count(),
            'rating' => (float) ($user->rating ?? 0),
            'total_reviews' => $user->total_reviews ?? 0,
            'total_orders' => Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->count(),
            'total_revenue' => Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->whereIn('status', ['completed', 'delivered'])->sum('total_amount'),
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

    /**
     * Show email verification notice.
     */
    public function verificationNotice()
    {
        return view('auth.verify-email');
    }

    /**
     * Resend verification email.
     */
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('success', 'Email already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}