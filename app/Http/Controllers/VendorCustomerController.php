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
use App\Models\Review;
use App\Models\SearchHistory;
use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Models\SavedVendor;
use App\Models\RecentlyViewed;
use App\Models\Cart;

class VendorCustomerController extends Controller
{
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
                                         ->limit(16)
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
            ->limit(4)
            ->get();

            // Get testimonials
            try {
                $testimonials = Testimonial::where('is_active', true)
                                           ->orderBy('sort_order')
                                           ->orderBy('created_at', 'desc')
                                           ->limit(6)
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

            // Format average rating to 1 decimal place
            $averageRating = $averageRating ? number_format($averageRating, 1) : 4.8;

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
            try {
                $recentTestimonials = Testimonial::where('is_active', true)
                                                 ->orderBy('created_at', 'desc')
                                                 ->limit(3)
                                                 ->get();
            } catch (\Exception $e) {
                $recentTestimonials = collect([]);
            }

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
        try {
            // Fetch active positions from database
            $positions = JobPosting::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('pages.careers', compact('positions'));

        } catch (\Exception $e) {
            Log::error('Careers page error: ' . $e->getMessage());

            // Return with empty collection - blade will show fallback content
            $positions = collect([]);
            return view('pages.careers', compact('positions'));
        }
    }

    /**
     * Handle job application submission.
     */
    public function apply(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string',
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        try {
            // Store the resume file
            $resumePath = null;
            if ($request->hasFile('resume')) {
                $fileName = time() . '_' . $request->file('resume')->getClientOriginalName();
                $resumePath = $request->file('resume')->storeAs('applications', $fileName, 'public');
            }

            // Get position title based on ID
            $positionTitles = [
                '1' => 'Senior Full Stack Developer',
                '2' => 'Community Manager',
                '3' => 'UI/UX Designer',
                '4' => 'Sales & Partnerships Lead',
                '5' => 'Open Application',
            ];

            $positionTitle = $positionTitles[$validated['position']] ?? 'Unknown Position';

            // Save to database
            JobApplication::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'position_id' => $validated['position'],
                'position_title' => $positionTitle,
                'cover_letter' => $validated['cover_letter'],
                'resume_path' => $resumePath,
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);

            Log::info('Job application saved to database', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'position' => $positionTitle,
            ]);

            return redirect()->route('careers')
                ->with('success', 'Application submitted successfully! We will review your application and contact you soon.');

        } catch (\Exception $e) {
            Log::error('Application submission failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to submit application. Please try again.');
        }
    }

    /**
     * Display press page.
     */
    public function press()
    {
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
        return view('pages.blog');
    }

    /**
     * Display single blog post.
     */
    public function blogPost($slug)
    {
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
        return view('pages.help-center');
    }

    /**
     * Search help articles.
     */
    public function helpSearch(Request $request)
    {
        $query = $request->get('q');
        return redirect()->route('help-center')->with('info', 'Search results for: "' . $query . '" (Search functionality coming soon)');
    }

    /**
     * Display single help article.
     */
    public function helpArticle($slug)
    {
        return redirect()->route('help-center')->with('info', 'Article requested: ' . $slug . ' (Coming soon)');
    }

    /**
     * Display invite friends page.
     */
    public function invite()
    {
        $user = Auth::user();
        $totalInvites = 0;
        $successfulInvites = 0;
        $totalEarned = 0;

        if ($user) {
            // Generate referral code if user doesn't have one
            if (!$user->referral_code) {
                $user->generateReferralCode();
            }

            // Example data
            $totalInvites = 12;
            $successfulInvites = 8;
            $totalEarned = 450;
        }

        return view('pages.invite', compact('user', 'totalInvites', 'successfulInvites', 'totalEarned'));
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
        try {
            $vendorCount = User::where('role', 'vendor')->where('is_active', true)->count();
            $customerCount = User::where('role', 'customer')->where('is_active', true)->count();
            // use Order model to calculate real booking count
            $bookingCount = Order::count();
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

        } catch (\Exception $e) {
            Log::error('How it works page error: ' . $e->getMessage());

            $vendorCount = 500;
            $customerCount = 10000;
            $bookingCount = Order::count() ?: 5000;
            $cityCount = 15;

            return view('pages.how-it-works', compact(
                'vendorCount',
                'customerCount',
                'bookingCount',
                'cityCount'
            ));
        }
    }

    /**
     * Display list service page.
     */
    public function listService()
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('List service page error: ' . $e->getMessage());

            $categoryVendors = [
                'food' => 245,
                'photography' => 189,
                'home' => 312,
                'beauty' => 178,
                'automotive' => 95,
                'events' => 156,
                'tech' => 67,
                'handicrafts' => 134,
            ];

            return view('pages.list-service', compact('categoryVendors'));
        }
    }

    // /**
    //  * Display vendor resources page.
    //  */
    // public function vendorResources()
    // {
    //     $telegramMembers = 2500;
    //     $whatsappMembers = 1800;

    //     return view('pages.vendor-resources', compact('telegramMembers', 'whatsappMembers'));
    // }

    // /**
    //  * Display success stories page.
    //  */
    // public function successStories()
    // {
    //     try {
    //         $vendorCount = User::where('role', 'vendor')->where('is_active', true)->count();
    //         $totalEarnings = Order::whereIn('status', ['completed', 'delivered'])->sum('total_amount');
    //         $totalEarningsFormatted = $totalEarnings > 0 ? number_format($totalEarnings) . '+' : '5M+';
    //         $happyCustomers = User::where('role', 'customer')->where('is_active', true)->count();
    //         $avgGrowth = '150%';

    //         return view('pages.success-stories', compact(
    //             'vendorCount',
    //             'avgGrowth',
    //             'totalEarningsFormatted',
    //             'happyCustomers'
    //         ));

    //     } catch (\Exception $e) {
    //         Log::error('Success stories page error: ' . $e->getMessage());

    //         $vendorCount = 500;
    //         $avgGrowth = '150%';
    //         $totalEarningsFormatted = '5M+';
    //         $happyCustomers = 10000;

    //         return view('pages.success-stories', compact(
    //             'vendorCount',
    //             'avgGrowth',
    //             'totalEarningsFormatted',
    //             'happyCustomers'
    //         ));
    //     }
    // }

    /**
     * Display community page.
     */
    public function community()
    {
        try {
            $totalMembers = User::count();
            $dailyPosts = 500;
            $monthlyEvents = 25;
            $mentors = User::where('role', 'vendor')->where('is_active', true)->count() / 10;

            return view('pages.community', compact(
                'totalMembers',
                'dailyPosts',
                'monthlyEvents',
                'mentors'
            ));

        } catch (\Exception $e) {
            Log::error('Community page error: ' . $e->getMessage());

            $totalMembers = 15000;
            $dailyPosts = 500;
            $monthlyEvents = 25;
            $mentors = 50;

            return view('pages.community', compact(
                'totalMembers',
                'dailyPosts',
                'monthlyEvents',
                'mentors'
            ));
        }
    }

    /**
     * Display search results for vendors.
     */
    public function search(Request $request)
    {
        try {
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
                ->with(['products' => function($q) {
                    $q->where('is_active', true)->latest()->take(2);
                }])
                ->withCount('followers')
                ->orderBy('rating', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ->withQueryString();

            // Save search history for authenticated users
            if (Auth::check() && $query) {
                $this->saveSearchHistory($request);
            }

            // Get trending vendors for sidebar
            $trendingVendors = User::where('role', 'vendor')
                ->where('is_active', true)
                ->orderBy('rating', 'desc')
                ->orderBy('products_count', 'desc')
                ->limit(5)
                ->get(['id', 'business_name', 'rating', 'products_count', 'city']);

            return view('search-results', compact('vendors', 'trendingVendors'));

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Search failed. Please try again.');
        }
    }

    /**
     * Save search history.
     */
    private function saveSearchHistory(Request $request)
    {
        try {
            $query = $request->get('query');

            if (empty($query)) {
                return;
            }

            $resultsCount = User::where('role', 'vendor')
                ->where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('business_name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('category', 'like', "%{$query}%");
                })
                ->count();

            SearchHistory::create([
                'user_id' => Auth::id(),
                'query' => $query,
                'filters' => $request->except(['query', '_token']),
                'results_count' => $resultsCount,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to save search history: ' . $e->getMessage());
        }
    }

    /**
     * Remove search history item.
     */
    public function removeSearchHistory($id)
    {
        try {
            $history = SearchHistory::where('user_id', Auth::id())->findOrFail($id);
            $history->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'Search history removed.');

        } catch (\Exception $e) {
            Log::error('Remove search history error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to remove search history.');
        }
    }

    /**
     * Clear all search history for user.
     */
    public function clearSearchHistory()
    {
        try {
            SearchHistory::where('user_id', Auth::id())->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'All search history cleared.');

        } catch (\Exception $e) {
            Log::error('Clear search history error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to clear search history.');
        }
    }

    /**
     * Get quick view data for a vendor
     */
    public function quickView($vendorId)
    {
        try {
            $vendor = User::with(['products' => function($query) {
                $query->where('is_active', true)->latest()->limit(5);
            }])->where('role', 'vendor')
              ->where('is_active', true)
              ->findOrFail($vendorId);

            // Prepare images
            $mainImage = $this->getVendorImage($vendor->main_image, 'main');
            $subImage1 = $this->getVendorImage($vendor->sub_image_1, 'sub1');
            $subImage2 = $this->getVendorImage($vendor->sub_image_2, 'sub2');

            // Get product data with pricing
            $products = $vendor->products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'original_price' => $product->original_price,
                    'discount' => $this->calculateDiscount($product),
                    'image' => $this->getProductImage($product->image),
                ];
            });

            // Get followers count
            $followersCount = $vendor->followers()->count();

            return response()->json([
                'success' => true,
                'id' => $vendor->id,
                'name' => $vendor->business_name ?? $vendor->name,
                'description' => $vendor->description ?? 'No description available',
                'rating' => number_format($vendor->rating ?? 4.5, 1),
                'reviews_count' => $vendor->total_reviews ?? 0,
                'products_count' => $vendor->products_count ?? $vendor->products->count(),
                'followers_count' => $followersCount,
                'location' => $vendor->city ?? 'Jimma',
                'main_image' => $mainImage,
                'sub_image1' => $subImage1,
                'sub_image2' => $subImage2,
                'products' => $products,
                'is_following' => Auth::check() ? Auth::user()->following()->where('vendor_id', $vendor->id)->exists() : false,
                'is_saved' => Auth::check() ? $this->isSavedVendor($vendor->id) : false,
            ]);

        } catch (\Exception $e) {
            Log::error('Quick view error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to load vendor details'
            ], 500);
        }
    }

    /**
     * Check if vendor is saved by user.
     */
    private function isSavedVendor($vendorId)
    {
        try {
            return Auth::user()->savedVendors()->where('vendor_id', $vendorId)->exists();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get vendor image URL
     */
    private function getVendorImage($image, $type)
    {
        if ($image && Storage::disk('public')->exists($image)) {
            return Storage::url($image);
        }

        $defaults = [
            'main' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
            'sub1' => 'https://images.unsplash.com/photo-1565193566173-7a646c770962?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
            'sub2' => 'https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
        ];

        return $defaults[$type] ?? $defaults['main'];
    }

    /**
     * Get product image URL
     */
    private function getProductImage($image)
    {
        if ($image && Storage::disk('public')->exists($image)) {
            return Storage::url($image);
        }

        return 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80';
    }

    /**
     * Calculate discount percentage
     */
    private function calculateDiscount($product)
    {
        if (isset($product->original_price) && $product->original_price > $product->price) {
            return round((($product->original_price - $product->price) / $product->original_price) * 100);
        }
        return 0;
    }

    /**
     * Follow a vendor
     */
    public function followVendor(Request $request, $vendorId)
    {
        try {
            $vendor = User::where('role', 'vendor')->findOrFail($vendorId);

            if (Auth::id() === $vendor->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot follow yourself'
                ], 400);
            }

            if (!Auth::user()->following()->where('vendor_id', $vendorId)->exists()) {
                Auth::user()->following()->attach($vendorId);

                // Update followers count
                $vendor->increment('followers_count');

                // Send notification to vendor
                $this->sendFollowNotification($vendorId, Auth::user()->name);

                return response()->json([
                    'success' => true,
                    'message' => 'Vendor followed successfully',
                    'followers_count' => $vendor->followers_count + 1
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Already following this vendor'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Follow vendor error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to follow vendor'
            ], 500);
        }
    }

    /**
     * Send follow notification to vendor.
     */
    private function sendFollowNotification($vendorId, $followerName)
    {
        try {
            Notification::create([
                'user_id' => $vendorId,
                'type' => 'follow',
                'title' => 'New Follower',
                'message' => $followerName . ' started following your shop.',
                'data' => json_encode(['follower_name' => $followerName]),
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send follow notification: ' . $e->getMessage());
        }
    }

    /**
     * Unfollow a vendor
     */
    public function unfollowVendor(Request $request, $vendorId)
    {
        try {
            $vendor = User::where('role', 'vendor')->findOrFail($vendorId);

            if (Auth::user()->following()->where('vendor_id', $vendorId)->exists()) {
                Auth::user()->following()->detach($vendorId);

                // Update followers count
                $vendor->decrement('followers_count');

                return response()->json([
                    'success' => true,
                    'message' => 'Vendor unfollowed successfully',
                    'followers_count' => max(0, $vendor->followers_count - 1)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Not following this vendor'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Unfollow vendor error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to unfollow vendor'
            ], 500);
        }
    }

    /**
     * Save a vendor
     */
    public function saveVendor(Request $request, $vendorId)
    {
        try {
            $vendor = User::where('role', 'vendor')->findOrFail($vendorId);

            if (!Auth::user()->savedVendors()->where('vendor_id', $vendorId)->exists()) {
                Auth::user()->savedVendors()->attach($vendorId);

                return response()->json([
                    'success' => true,
                    'message' => 'Vendor saved successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Vendor already saved'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Save vendor error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save vendor'
            ], 500);
        }
    }

    /**
     * Unsave a vendor
     */
    public function unsaveVendor(Request $request, $vendorId)
    {
        try {
            if (Auth::user()->savedVendors()->where('vendor_id', $vendorId)->exists()) {
                Auth::user()->savedVendors()->detach($vendorId);

                return response()->json([
                    'success' => true,
                    'message' => 'Vendor removed from saved'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Vendor not in saved list'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Unsave vendor error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to unsave vendor'
            ], 500);
        }
    }

    /**
     * Display a single vendor profile.
     */
    public function showVendor(string $id)
    {
        try {
            // Find the vendor
            $vendor = User::where('role', 'vendor')
                ->where('is_active', true)
                ->find($id);

            if (!$vendor) {
                return redirect()->route('search.results')->with('error', 'Vendor not found or inactive.');
            }

            // Get followers count using relationship
            $followersCount = $vendor->followers()->count();

            // Get products
            $products = Product::where('vendor_id', $vendor->id)
                ->where('is_active', true)
                ->whereNotNull('id')
                ->latest()
                ->take(6)
                ->get()
                ->filter(function($product) {
                    // Additional validation to ensure product is valid
                    return $product && $product->id && $product->name;
                });

            // Get reviews for vendor's products
            $reviews = collect([]);
            $totalRating = 0;
            $reviewCount = 0;

            if ($products->isNotEmpty()) {
                $productIds = $products->pluck('id')->toArray();
                
                $reviews = Review::whereIn('product_id', $productIds)
                    ->with('user')
                    ->where('is_approved', true)
                    ->latest()
                    ->take(5)
                    ->get();

                // Calculate average rating
                $allReviews = Review::whereIn('product_id', $productIds)
                    ->where('is_approved', true)
                    ->get();

                if ($allReviews->isNotEmpty()) {
                    $totalRating = $allReviews->sum('rating');
                    $reviewCount = $allReviews->count();
                }
            }

            $averageRating = $reviewCount > 0 ? round($totalRating / $reviewCount, 1) : 4.5;

            // Attach data to vendor object
            $vendor->products = $products;
            $vendor->reviews = $reviews;
            $vendor->rating = $averageRating;
            $vendor->total_reviews = $reviewCount;

            // Increment store views safely
            try {
                $vendor->increment('store_views');
            } catch (\Exception $e) {
                Log::error('Failed to increment store views: ' . $e->getMessage());
            }

            // Check if current user is following this vendor
            $isFollowing = Auth::check() ? Auth::user()->isFollowing($vendor) : false;

            // Record in recently viewed if user is logged in
            if (Auth::check()) {
                try {
                    $this->recordVendorView(Auth::user(), $vendor);
                } catch (\Exception $e) {
                    Log::error('Failed to record vendor view: ' . $e->getMessage());
                }
            }

            return view('vendor.show', compact('vendor', 'isFollowing', 'followersCount'));

        } catch (\Exception $e) {
            Log::error('Show vendor error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->route('search.results')
                ->with('error', 'An error occurred while loading the vendor profile. Please try again.');
        }
    }

    /**
     * Send contact message to vendor
     */
    public function sendContactMessage(Request $request)
    {
        try {
            $request->validate([
                'vendor_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000',
            ]);

            $user = Auth::user();
            $vendor = User::findOrFail($request->vendor_id);

            // Create a message in the messages table
            try {
                $message = Message::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $vendor->id,
                    'subject' => 'Contact from ' . $user->name,
                    'content' => $request->message,
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                // If Message model doesn't exist, log the message
                Log::info('Contact message from ' . $user->email . ' to vendor ' . $vendor->email . ': ' . $request->message);
            }

            // Create a notification for the vendor
            try {
                Notification::create([
                    'user_id' => $vendor->id,
                    'type' => 'message',
                    'title' => 'New Message from ' . $user->name,
                    'message' => 'You have received a new message from a customer.',
                    'data' => json_encode([
                        'sender_id' => $user->id,
                        'sender_name' => $user->name,
                        'message_preview' => Str::limit($request->message, 50)
                    ]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Could not create notification: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Contact vendor error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again.'
            ], 500);
        }
    }

    /**
     * Show vendor profile (authenticated vendor viewing their own profile)
     */
    public function vendorProfile()
    {
        try {
            $user = Auth::user();

            if (!$user || $user->role !== 'vendor') {
                abort(403, 'Unauthorized access.');
            }

            // Get followers count
            $followersCount = DB::table('followers')
                ->where('vendor_id', $user->id)
                ->count();

            // Get following count
            $followingCount = DB::table('followers')
                ->where('user_id', $user->id)
                ->count();

            // Get products count
            $productsCount = DB::table('products')
                ->where('vendor_id', $user->id)
                ->count();

            // Get unread notifications count
            try {
                $unreadNotificationsCount = Notification::where('user_id', $user->id)
                    ->where('is_read', false)
                    ->count();
            } catch (\Exception $e) {
                $unreadNotificationsCount = 0;
                Log::warning('Could not get notification count: ' . $e->getMessage());
            }

            // Get unread messages count
            try {
                $unreadMessagesCount = Message::where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->count();
            } catch (\Exception $e) {
                $unreadMessagesCount = 0;
                Log::warning('Could not get message count: ' . $e->getMessage());
            }

            return view('vendor.profile', compact(
                'user',
                'followersCount',
                'followingCount',
                'productsCount',
                'unreadNotificationsCount',
                'unreadMessagesCount'
            ));

        } catch (\Exception $e) {
            Log::error('Vendor profile error: ' . $e->getMessage());
            return redirect()->route('vendor.dashboard')
                ->with('error', 'Failed to load profile. Please try again.');
        }
    }

    /**
     * Record vendor view for user.
     */
    private function recordVendorView($user, $vendor)
    {
        try {
            // Check if the recently_viewed table exists
            $exists = DB::table('recently_viewed')
                ->where('user_id', $user->id)
                ->where('vendor_id', $vendor->id)
                ->first();

            if ($exists) {
                DB::table('recently_viewed')
                    ->where('user_id', $user->id)
                    ->where('vendor_id', $vendor->id)
                    ->update([
                        'view_count' => $exists->view_count + 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('recently_viewed')->insert([
                    'user_id' => $user->id,
                    'vendor_id' => $vendor->id,
                    'view_count' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Keep only last 10 viewed vendors
            $count = DB::table('recently_viewed')
                ->where('user_id', $user->id)
                ->count();

            if ($count > 10) {
                $oldest = DB::table('recently_viewed')
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->limit($count - 10)
                    ->get();

                foreach ($oldest as $old) {
                    DB::table('recently_viewed')
                        ->where('user_id', $user->id)
                        ->where('vendor_id', $old->vendor_id)
                        ->delete();
                }
            }
        } catch (\Exception $e) {
            Log::warning('Could not record vendor view: ' . $e->getMessage());
        }
    }

    /**
     * Follow a vendor (non-AJAX).
     */
    public function follow(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to follow vendors.');
        }

        try {
            $vendor = User::where('role', 'vendor')->findOrFail($id);
            $user = Auth::user();

            if ($user->id === $vendor->id) {
                return back()->with('error', 'You cannot follow your own shop.');
            }

            // Check if already following
            $alreadyFollowing = DB::table('followers')
                ->where('user_id', $user->id)
                ->where('vendor_id', $vendor->id)
                ->exists();

            if ($alreadyFollowing) {
                return back()->with('info', 'You are already following ' . ($vendor->business_name ?? $vendor->name));
            }

            // Insert follow record with error handling for duplicates
            try {
                DB::table('followers')->insert([
                    'user_id' => $user->id,
                    'vendor_id' => $vendor->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } catch (\Illuminate\Database\QueryException $insertError) {
                // If duplicate, just return success (they're already following)
                if (str_contains($insertError->getMessage(), 'Duplicate entry')) {
                    return back()->with('info', 'You are already following ' . ($vendor->business_name ?? $vendor->name));
                }
                throw $insertError; // Re-throw if it's a different error
            }

            // Update followers count
            $vendor->increment('followers_count');

            // Send notification
            try {
                $this->sendFollowNotification($vendor->id, $user->name);
            } catch (\Exception $e) {
                Log::warning('Failed to send follow notification: ' . $e->getMessage());
            }

            return back()->with('success', 'Now following ' . ($vendor->business_name ?? $vendor->name));

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Follow database error: ' . $e->getMessage());
            
            // Check if it's a table not found error
            if (str_contains($e->getMessage(), "doesn't exist")) {
                return back()->with('error', 'Follow feature is not properly configured. Please contact support.');
            }
            
            // Check if it's a duplicate entry error
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('info', 'You are already following this vendor.');
            }
            
            return back()->with('error', 'Failed to follow vendor. Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Follow error: ' . $e->getMessage());
            Log::error('Follow error trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Failed to follow vendor. Error: ' . $e->getMessage());
        }
    }

    /**
     * Unfollow a vendor (non-AJAX).
     */
    public function unfollow(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            $vendor = User::where('role', 'vendor')->findOrFail($id);
            $user = Auth::user();

            // Check if following
            $isFollowing = DB::table('followers')
                ->where('user_id', $user->id)
                ->where('vendor_id', $vendor->id)
                ->exists();

            if ($isFollowing) {
                // Delete follow record
                DB::table('followers')
                    ->where('user_id', $user->id)
                    ->where('vendor_id', $vendor->id)
                    ->delete();

                // Update followers count
                if ($vendor->followers_count > 0) {
                    $vendor->decrement('followers_count');
                }
            }

            return back()->with('success', 'Unfollowed ' . ($vendor->business_name ?? $vendor->name));

        } catch (\Exception $e) {
            Log::error('Unfollow error: ' . $e->getMessage());
            return back()->with('error', 'Failed to unfollow vendor. Please try again.');
        }
    }

    /**
     * Display user profile.
     */
    public function show(string $id = null)
    {
        try {
            // If no ID provided, use authenticated user
            if ($id === null) {
                $user = Auth::user();
            } else {
                $user = User::findOrFail($id);
                
                // Check authorization
                if (Auth::id() != $id && Auth::user()->role !== 'admin') {
                    abort(403);
                }
            }

            $followersCount = $user->role === 'vendor' ? $user->followers()->count() : 0;
            $followingCount = $user->following()->count();

            $productsCount = $user->role === 'vendor' ? Product::where('vendor_id', $user->id)->count() : 0;

            return view('profile.show', compact('user', 'followersCount', 'followingCount', 'productsCount'));

        } catch (\Exception $e) {
            Log::error('Profile show error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'User not found.');
        }
    }

    /**
     * Show vendor settings (authenticated vendor viewing their own settings)
     */
    public function vendorSettings()
    {
        try {
            $user = Auth::user();

            if (!$user || $user->role !== 'vendor') {
                abort(403, 'Unauthorized access.');
            }

            return view('vendor.settings', compact('user'));

        } catch (\Exception $e) {
            Log::error('Vendor settings error: ' . $e->getMessage());
            return redirect()->route('vendor.dashboard')
                ->with('error', 'Failed to load settings. Please try again.');
        }
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit(string $id = null)
    {
        try {
            // If no ID provided, use authenticated user
            if ($id === null) {
                $user = Auth::user();
            } else {
                $user = User::findOrFail($id);
                
                // Check authorization
                if (Auth::id() != $id) {
                    abort(403);
                }
            }

            return view('profile.edit', compact('user'));

        } catch (\Exception $e) {
            Log::error('Profile edit error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'User not found.');
        }
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request, string $id)
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update profile. Please try again.');
        }
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

            // Clear search history
            SearchHistory::where('user_id', $user->id)->delete();

            // Clear notifications
            Notification::where('user_id', $user->id)->delete();

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
        try {
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

        } catch (\Exception $e) {
            Log::error('Vendor dashboard error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load dashboard. Please try again.');
        }
    }

    /**
     * Customer dashboard.
     */
    public function customerDashboard()
    {
        try {
            $user = Auth::user();

            if (!$user || $user->role !== 'customer') {
                abort(403);
            }

            // Get following vendors with pagination and additional data
            $following = $user->following()
                ->withCount(['products' => function($query) {
                    $query->where('is_active', true);
                }])
                ->where('is_active', true)
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

            // Get recent orders with vendor information
            $recentOrders = Order::where('user_id', $user->id)
                ->with(['items.product', 'vendor'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Get cart count from database if using Cart model, otherwise session
            try {
                $cartCount = Cart::where('user_id', $user->id)->sum('quantity');
            } catch (\Exception $e) {
                // Fallback to session-based cart
                $cart = session()->get('cart', []);
                $cartCount = array_sum(array_column($cart, 'quantity'));
            }

            // Get wishlist count
            $wishlistCount = 0;
            try {
                $wishlistCount = $user->wishlists()->count();
            } catch (\Exception $e) {
                // Wishlist relationship might not exist
            }

            // Get reviews count
            $reviewsCount = 0;
            try {
                $reviewsCount = $user->reviews()->count();
            } catch (\Exception $e) {
                // Reviews relationship might not exist
            }

            // Get total spent amount
            $totalSpent = Order::where('user_id', $user->id)
                ->where('status', 'completed')
                ->sum('total_amount');

            // Get favorite categories based on order history
            $favoriteCategories = collect([]);
            try {
                $favoriteCategories = DB::table('orders')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('orders.user_id', $user->id)
                    ->select('categories.name', DB::raw('COUNT(*) as count'))
                    ->groupBy('categories.id', 'categories.name')
                    ->orderBy('count', 'desc')
                    ->limit(3)
                    ->get();
            } catch (\Exception $e) {
                // Handle if tables don't exist
            }

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
                'cartTotal',
                'wishlistCount',
                'reviewsCount',
                'totalSpent',
                'favoriteCategories'
            ));

        } catch (\Exception $e) {
            Log::error('Customer dashboard error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load dashboard. Please try again.');
        }
    }

    // /**
    //  * Display the vendors that the customer follows.
    //  */
    // public function following()
    // {
    //     try {
    //         $user = Auth::user();

    //         if (!$user || $user->role !== 'customer') {
    //             abort(403);
    //         }

    //         // Get vendors that the customer follows with pagination
    //         $following = $user->following()
    //             ->with(['products' => function($q) {
    //                 $q->where('is_active', true)->take(3);
    //             }])
    //             ->orderBy('followers.created_at', 'desc')
    //             ->paginate(12);

    //         // Get unread counts for header
    //         try {
    //             $unreadNotificationsCount = Notification::where('user_id', $user->id)
    //                 ->where('is_read', false)
    //                 ->count();
    //         } catch (\Exception $e) {
    //             $unreadNotificationsCount = 0;
    //         }

    //         try {
    //             $unreadMessagesCount = Message::where('receiver_id', $user->id)
    //                 ->where('is_read', false)
    //                 ->count();
    //         } catch (\Exception $e) {
    //             $unreadMessagesCount = 0;
    //         }

    //         return view('customer.following', compact(
    //             'user',
    //             'following',
    //             'unreadNotificationsCount',
    //             'unreadMessagesCount'
    //         ));

    //     } catch (\Exception $e) {
    //         Log::error('Following page error: ' . $e->getMessage());
    //         return redirect()->route('home')->with('error', 'Unable to load following list.');
    //     }
    // }


/**
 * Display the vendors that the customer follows.
 */
public function following()
{
    try {
        $user = Auth::user();

        if (!$user || $user->role !== 'customer') {
            abort(403);
        }

        // Get vendors that the customer follows with pagination
        $following = $user->following()
            ->with(['products' => function($q) {
                $q->where('is_active', true)->take(3);
            }])
            ->withCount('products')
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

    } catch (\Exception $e) {
        Log::error('Following page error: ' . $e->getMessage());
        return redirect()->route('customer.dashboard')
            ->with('error', 'Unable to load following list.');
    }
}




    /**
     * Update vendor settings.
     */
    public function updateSettings(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('Update settings error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update settings. Please try again.');
        }
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('Update password error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update password. Please try again.');
        }
    }

    /**
     * Get vendor stats for AJAX requests.
     */
    public function getVendorStats()
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('Get vendor stats error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }

    // /**
    //  * Search vendors for AJAX endpoints.
    //  */
    // public function searchVendors(Request $request)
    // {
    //     try {
    //         $query = $request->get('q');

    //         $vendors = User::where('role', 'vendor')
    //             ->where('is_active', true)
    //             ->when($query, function ($q, $query) {
    //                 return $q->where(function ($subQ) use ($query) {
    //                     $subQ->where('business_name', 'like', "%{$query}%")
    //                          ->orWhere('description', 'like', "%{$query}%");
    //                 });
    //             })
    //             ->limit(10)
    //             ->get(['id', 'business_name', 'city', 'state', 'avatar', 'rating', 'category']);

    //         return response()->json($vendors);

    //     } catch (\Exception $e) {
    //         Log::error('Search vendors error: ' . $e->getMessage());
    //         return response()->json(['error' => 'Search failed'], 500);
    //     }
    // }






/**
 * Search vendors for display.
 */
public function searchVendors(Request $request)
{
    $query = $request->get('q');
    $category = $request->get('category');
    $location = $request->get('location');
    $rating = $request->get('rating');
    $sort = $request->get('sort', 'name');

    $vendors = User::where('role', 'vendor')
        ->where('is_active', true)
        ->when($query, function ($q, $query) {
            return $q->where(function ($subQ) use ($query) {
                $subQ->where('business_name', 'like', "%{$query}%")
                     ->orWhere('description', 'like', "%{$query}%");
            });
        })
        ->when($category, function ($q, $category) {
            return $q->where('category', $category);
        })
        ->when($location, function ($q, $location) {
            return $q->where(function ($subQ) use ($location) {
                $subQ->where('city', 'LIKE', "%{$location}%")
                     ->orWhere('state', 'LIKE', "%{$location}%");
            });
        })
        ->when($rating, function ($q, $rating) {
            return $q->where('rating', '>=', $rating);
        })
        ->withCount('products')
        ->withCount('followers');

    // Apply sorting
    switch($sort) {
        case 'rating':
            $vendors->orderBy('rating', 'desc');
            break;
        case 'newest':
            $vendors->orderBy('created_at', 'desc');
            break;
        default:
            $vendors->orderBy('business_name', 'asc');
    }

    $vendors = $vendors->paginate(12);

    // Transform vendors for display
    $transformedVendors = $vendors->map(function($vendor) {
        $rating = $vendor->rating ?? 0;
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;

        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                $stars .= '<i class="ri-star-fill" style="color: #f59e0b;"></i>';
            } elseif ($halfStar && $i == $fullStars + 1) {
                $stars .= '<i class="ri-star-half-fill" style="color: #f59e0b;"></i>';
                $halfStar = false;
            } else {
                $stars .= '<i class="ri-star-line" style="color: #e5e7eb;"></i>';
            }
        }

        return [
            'id' => $vendor->id,
            'business_name' => $vendor->business_name ?? $vendor->name,
            'city' => $vendor->city ?? 'Jimma',
            'state' => $vendor->state ?? 'Oromia',
            'avatar' => $vendor->avatar ? Storage::url($vendor->avatar) : null,
            'rating' => number_format($rating, 1),
            'category' => $vendor->category ?? 'General Store',
            'avatar_url' => $vendor->avatar ? Storage::url($vendor->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($vendor->business_name ?? $vendor->name) . '&background=B88E3F&color=fff&size=200',
            'full_address' => ($vendor->city ?? 'Jimma') . ', ' . ($vendor->state ?? 'Oromia'),
            'location_string' => ($vendor->city ?? 'Jimma') . ', ' . ($vendor->state ?? 'Oromia'),
            'rating_stars' => $stars,
            'rating_display' => number_format($rating, 1) . ' (' . ($vendor->total_reviews ?? 0) . ' reviews)',
            'dashboard_link' => route('vendor.show', $vendor->id),
            'following_count' => 0,
            'followers_count' => $vendor->followers_count ?? 0,
            'products_count' => $vendor->products_count ?? 0,
            'total_reviews' => $vendor->total_reviews ?? 0,
            'verified' => !is_null($vendor->email_verified_at),
            'avatar_text' => strtoupper(substr($vendor->business_name ?? $vendor->name, 0, 2))
        ];
    });

    // For AJAX requests
    if ($request->ajax()) {
        return response()->json([
            'vendors' => $transformedVendors,
            'pagination' => [
                'current_page' => $vendors->currentPage(),
                'last_page' => $vendors->lastPage(),
                'per_page' => $vendors->perPage(),
                'total' => $vendors->total()
            ]
        ]);
    }

    return view('vendors.search', [
        'vendors' => $transformedVendors,
        'pagination' => [
            'current_page' => $vendors->currentPage(),
            'last_page' => $vendors->lastPage(),
            'per_page' => $vendors->perPage(),
            'total' => $vendors->total()
        ]
    ]);
}









    /**
     * Get vendor by ID for AJAX.
     */
    public function getVendor(string $id)
    {
        try {
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

        } catch (\Exception $e) {
            Log::error('Get vendor error: ' . $e->getMessage());
            return response()->json(['error' => 'Vendor not found'], 404);
        }
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
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->route('home')->with('success', 'Email already verified.');
            }

            $request->user()->sendEmailVerificationNotification();

            return back()->with('success', 'Verification link sent!');

        } catch (\Exception $e) {
            Log::error('Resend verification error: ' . $e->getMessage());
            return back()->with('error', 'Failed to send verification email. Please try again.');
        }
    }

    /**
     * Display cookie policy page.
     */
    public function cookiePolicy()
    {
        return view('pages.cookie-policy');
    }

    // /**
    //  * Handle contact form submission.
    //  */
    // public function contactSubmit(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'subject' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     try {
    //         // Here you would send email or save to database
    //         // Mail::to('support@vendora.com')->send(new ContactFormMail($validated));

    //         return redirect()->route('contact')->with('success', 'Thank you for contacting us. We will get back to you soon!');

    //     } catch (\Exception $e) {
    //         Log::error('Contact form submission error: ' . $e->getMessage());
    //         return back()->with('error', 'Failed to send message. Please try again.');
    //     }
    // }




/**
 * Display contact page.
 */
public function contact()
{
    return view('pages.contact');
}

/**
 * Handle contact form submission.
 */
public function contactSubmit(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|min:10',
    ]);

    try {
        // Here you would send email or save to database
        // Mail::to('support@vendora.com')->send(new ContactFormMail($request->all()));

        // Log the contact submission
        Log::info('Contact form submission', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject
        ]);

        return redirect()->route('contact')->with('success', 'Thank you for contacting us! We will get back to you within 24 hours.');

    } catch (\Exception $e) {
        Log::error('Contact form submission error: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Failed to send message. Please try again.')
            ->withInput();
    }
}








    // API Methods
    public function apiVendors(Request $request)
    {
        try {
            $vendors = User::where('role', 'vendor')
                ->where('is_active', true)
                ->paginate(20);

            return response()->json($vendors);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch vendors'], 500);
        }
    }

    public function apiVendor($id)
    {
        try {
            $vendor = User::where('role', 'vendor')
                ->where('is_active', true)
                ->findOrFail($id);

            return response()->json($vendor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }
    }

    public function apiSearch(Request $request)
    {
        try {
            $query = $request->get('q');

            $vendors = User::where('role', 'vendor')
                ->where('is_active', true)
                ->when($query, function ($q, $query) {
                    return $q->where('business_name', 'like', "%{$query}%");
                })
                ->paginate(20);

            return response()->json($vendors);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Search failed'], 500);
        }
    }
}
