<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\SavedVendor;
use App\Models\RecentlyViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    /**
     * Display the sales report page.
     */
    public function salesReport(Request $request)
    {
        $user = Auth::user();

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

        // Get vendor's product IDs
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');

        // Date range filter
        $dateFrom = $request->get('date_from', now()->startOfMonth()->toDateString());
        $dateTo = $request->get('date_to', now()->toDateString());
        $period = $request->get('period', 'month');

        // Adjust date range based on period
        switch($period) {
            case 'today':
                $dateFrom = now()->startOfDay()->toDateString();
                $dateTo = now()->endOfDay()->toDateString();
                break;
            case 'week':
                $dateFrom = now()->startOfWeek()->toDateString();
                $dateTo = now()->endOfWeek()->toDateString();
                break;
            case 'month':
                $dateFrom = now()->startOfMonth()->toDateString();
                $dateTo = now()->endOfMonth()->toDateString();
                break;
            case 'year':
                $dateFrom = now()->startOfYear()->toDateString();
                $dateTo = now()->endOfYear()->toDateString();
                break;
            case 'custom':
                // Use provided dates
                break;
        }

        // Get orders within date range
        $orders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->with(['items.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate KPIs
        $totalRevenue = $orders->whereIn('status', ['completed', 'delivered'])->sum('total_amount');
        $totalOrders = $orders->count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Calculate conversion rate (simplified - orders vs unique visitors)
        // You'd need a store_views table for accurate data
        $storeViews = $user->store_views ?? 1000; // Placeholder
        $conversionRate = $storeViews > 0 ? ($totalOrders / $storeViews) * 100 : 0;

        // Sales trend (last 7 days)
        $salesTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayRevenue = Order::whereHas('items.product', function($q) use ($user) {
                    $q->where('vendor_id', $user->id);
                })
                ->whereDate('created_at', $date)
                ->whereIn('status', ['completed', 'delivered'])
                ->sum('total_amount');

            $salesTrend[] = [
                'date' => now()->subDays($i)->format('D'),
                'revenue' => $dayRevenue
            ];
        }

        // Top selling products
        $topProducts = Product::where('vendor_id', $user->id)
            ->withCount(['orderItems as sold_quantity' => function($q) use ($dateFrom, $dateTo) {
                $q->whereHas('order', function($orderQuery) use ($dateFrom, $dateTo) {
                    $orderQuery->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
                               ->whereIn('status', ['completed', 'delivered']);
                })->select(DB::raw('SUM(quantity)'));
            }])
            ->withSum(['orderItems as revenue' => function($q) use ($dateFrom, $dateTo) {
                $q->whereHas('order', function($orderQuery) use ($dateFrom, $dateTo) {
                    $orderQuery->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
                               ->whereIn('status', ['completed', 'delivered']);
                })->select(DB::raw('SUM(quantity * price)'));
            }], 'price')
            ->having('sold_quantity', '>', 0)
            ->orderBy('sold_quantity', 'desc')
            ->take(5)
            ->get();

        // Payment method distribution
        $paymentMethods = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->select('payment_method', DB::raw('count(*) as total'), DB::raw('sum(total_amount) as amount'))
            ->groupBy('payment_method')
            ->get();

        // Recent transactions
        $recentTransactions = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['user', 'items.product'])
            ->whereIn('status', ['completed', 'delivered'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('vendor.sales-report', compact(
            'user',
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'conversionRate',
            'salesTrend',
            'topProducts',
            'paymentMethods',
            'recentTransactions',
            'dateFrom',
            'dateTo',
            'period',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Show a comparison page for the selected vendors.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function compare(Request $request)
    {
        // 1. Get vendor IDs from the query string (e.g., ?vendors=10,18,17)
        $vendorIds = $request->query('vendors');

        // 2. Validate that vendor IDs are provided
        if (!$vendorIds) {
            return redirect()->back()->with('error', 'Please select vendors to compare.');
        }

        // 3. Convert the comma-separated string to an array of integers
        $ids = array_unique(array_map('intval', explode(',', $vendorIds)));

        // Optional: Limit the number of vendors to compare for layout reasons
        if (count($ids) > 3) {
            return redirect()->back()->with('error', 'You can compare a maximum of 3 vendors at a time.');
        }

        if (count($ids) < 2) {
            return redirect()->back()->with('error', 'Please select at least 2 vendors to compare.');
        }

        // 4. Fetch the vendor data with necessary counts and averages
        $vendors = User::where('role', 'vendor')
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->withCount(['products', 'followers'])
            ->with(['products' => function($query) {
                $query->withAvg('reviews', 'rating')
                      ->withCount('reviews')
                      ->latest()
                      ->take(3);
            }])
            ->get(['id', 'name', 'business_name', 'city', 'state', 'email_verified_at as verified', 'description', 'main_image as image', 'sub_image_1', 'sub_image_2', 'delivery_time', 'min_order', 'response_rate', 'created_at', 'category', 'rating', 'total_reviews']);

        // 5. Check if we found all requested vendors
        if ($vendors->count() !== count($ids)) {
            return redirect()->back()->with('error', 'One or more vendors not found.');
        }

        // 6. Transform the data into a simple array format for the view
        $comparisonData = $vendors->map(function ($vendor) {
            // Calculate average rating from all product reviews
            $totalRating = 0;
            $totalReviews = 0;
            $featuredProducts = [];

            foreach ($vendor->products ?? [] as $product) {
                $featuredProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'original_price' => $product->original_price ?? null,
                    'rating' => $product->reviews_avg_rating ?? 0,
                    'reviews_count' => $product->reviews_count ?? 0,
                    'image' => $product->image ?? null,
                ];

                if ($product && $product->reviews_avg_rating) {
                    $totalRating += $product->reviews_avg_rating * ($product->reviews_count ?? 0);
                    $totalReviews += $product->reviews_count ?? 0;
                }
            }

            $avgRating = $totalReviews > 0 ? $totalRating / $totalReviews : ($vendor->rating ?? 0);

            // Payment methods (placeholder - you can add to vendor model if needed)
            $paymentMethods = ['cash', 'card', 'telebirr'];

            // Languages (placeholder)
            $languages = ['Amharic', 'English', 'Afaan Oromoo'];

            return [
                'id' => $vendor->id,
                'name' => $vendor->business_name ?? $vendor->name,
                'category' => $vendor->category ?? 'General Store',
                'image' => $vendor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($vendor->business_name ?? $vendor->name) . '&background=B88E3F&color=fff&size=200',
                'verified' => (bool) $vendor->verified,
                'rating' => round($avgRating, 1),
                'reviews_count' => $vendor->total_reviews ?? $totalReviews,
                'city' => $vendor->city ?? 'Jimma',
                'state' => $vendor->state ?? 'Oromia',
                'products_count' => $vendor->products_count ?? 0,
                'followers_count' => $vendor->followers_count ?? 0,
                'featured_products' => $featuredProducts,
                'delivery_time' => $vendor->delivery_time ?? '1-3 days',
                'min_order' => $vendor->min_order ?? 0,
                'response_rate' => $vendor->response_rate ?? 95,
                'response_time' => 'within 1 hour',
                'joined_date' => $vendor->created_at ? $vendor->created_at->format('M Y') : 'N/A',
                'last_active' => $vendor->last_login_at ?? now()->subHours(rand(1, 48)),
                'description' => $vendor->description ?? 'No description available.',
                'payment_methods' => $paymentMethods,
                'languages' => $languages,
            ];
        });

        // 7. Return the view with the prepared data
        return view('vendor.compare', compact('comparisonData'));
    }

    /**
     * Display store views analytics.
     */
    public function storeViews(Request $request)
    {
        $user = Auth::user();

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

        // Get store views data from database if available
        // This would typically come from a store_views table
        $totalViews = $user->store_views ?? 1247;
        $uniqueVisitors = 892;
        $averageTimeOnSite = '2m 34s';
        $bounceRate = 42.5;

        // Daily views for chart
        $dailyViews = [];
        for ($i = 29; $i >= 0; $i--) {
            $dailyViews[] = [
                'date' => now()->subDays($i)->format('M d'),
                'views' => rand(20, 80)
            ];
        }

        return view('vendor.store-views', compact(
            'user',
            'totalViews',
            'uniqueVisitors',
            'averageTimeOnSite',
            'bounceRate',
            'dailyViews',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Display notifications page.
     */
    public function notifications(Request $request)
    {
        $user = Auth::user();

        try {
            $query = Notification::where('user_id', $user->id);

            // Filter by type
            if ($request->has('type') && $request->type != '') {
                $query->where('type', $request->type);
            }

            // Filter by read/unread
            if ($request->has('filter')) {
                if ($request->filter == 'unread') {
                    $query->where('is_read', false);
                } elseif ($request->filter == 'read') {
                    $query->where('is_read', true);
                }
            }

            // Search in title and message
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('message', 'like', "%{$search}%");
                });
            }

            $notifications = $query->orderBy('created_at', 'desc')->paginate(20);
        } catch (\Exception $e) {
            $notifications = collect([]);
        }

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

        return view('vendor.notifications', compact(
            'user',
            'notifications',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Get single notification details (AJAX).
     */
    public function getNotification($id)
    {
        try {
            $notification = Notification::where('user_id', Auth::id())
                ->findOrFail($id);

            return response()->json($notification);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }

    /**
     * Mark notification as read.
     */
    public function markNotificationAsRead($id)
    {
        $user = Auth::user();

        try {
            $notification = Notification::where('user_id', $user->id)
                ->where('id', $id)
                ->firstOrFail();

            $notification->is_read = true;
            $notification->read_at = now();
            $notification->save();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Notification marked as read.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
            }
            return redirect()->back()->with('error', 'Failed to mark notification as read.');
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead()
    {
        $user = Auth::user();

        try {
            Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'All notifications marked as read.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Failed to mark all notifications as read.');
        }
    }

    /**
     * Delete a notification.
     */
    public function deleteNotification($id)
    {
        try {
            $notification = Notification::where('user_id', Auth::id())
                ->where('id', $id)
                ->firstOrFail();

            $notification->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Notification deleted.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Failed to delete notification'], 500);
            }
            return redirect()->back()->with('error', 'Failed to delete notification.');
        }
    }

    /**
     * Clear all notifications.
     */
    public function clearAllNotifications()
    {
        try {
            Notification::where('user_id', Auth::id())->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'All notifications cleared.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Failed to clear notifications'], 500);
            }
            return redirect()->back()->with('error', 'Failed to clear notifications.');
        }
    }

    /**
     * Display messages page.
     */
    public function messages()
    {
        $user = Auth::user();

        try {
            // Get conversations (unique senders)
            $conversations = Message::where('receiver_id', $user->id)
                ->orWhere('sender_id', $user->id)
                ->with(['sender', 'receiver'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy(function($message) use ($user) {
                    return $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
                });

            $unreadCount = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();

            // Get last message for each conversation
            $conversations = $conversations->map(function($messages) {
                return $messages->first();
            });
        } catch (\Exception $e) {
            $conversations = collect([]);
            $unreadCount = 0;
        }

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

        return view('vendor.messages', compact(
            'user',
            'conversations',
            'unreadCount',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Send a message.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:messages,id'
        ]);

        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'subject' => $request->subject,
                'content' => $request->content,
                'parent_id' => $request->parent_id,
                'is_read' => false
            ]);

            // Create notification for receiver
            try {
                Notification::create([
                    'user_id' => $request->receiver_id,
                    'type' => 'message',
                    'title' => 'New Message',
                    'message' => 'You have received a new message from ' . Auth::user()->name,
                    'data' => json_encode(['message_id' => $message->id, 'sender_id' => Auth::id()]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create message notification: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'data' => $message->load('sender')
            ]);
        } catch (\Exception $e) {
            Log::error('Send message error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark message as read.
     */
    public function markMessageAsRead($id)
    {
        try {
            $message = Message::where('receiver_id', Auth::id())
                ->where('id', $id)
                ->firstOrFail();

            $message->is_read = true;
            $message->read_at = now();
            $message->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Get conversation with a specific user.
     */
    public function getConversation($userId)
    {
        $currentUser = Auth::id();

        try {
            $messages = Message::where(function($q) use ($currentUser, $userId) {
                    $q->where('sender_id', $currentUser)
                      ->where('receiver_id', $userId);
                })
                ->orWhere(function($q) use ($currentUser, $userId) {
                    $q->where('sender_id', $userId)
                      ->where('receiver_id', $currentUser);
                })
                ->with(['sender', 'receiver'])
                ->orderBy('created_at', 'asc')
                ->get();

            // Mark messages as read
            Message::where('receiver_id', $currentUser)
                ->where('sender_id', $userId)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'data' => $messages
            ]);
        } catch (\Exception $e) {
            Log::error('Get conversation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get unread counts for AJAX.
     */
    public function getUnreadCounts()
    {
        $user = Auth::user();

        try {
            $notifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $notifications = 0;
        }

        try {
            $messages = Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $messages = 0;
        }

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'messages' => $messages
        ]);
    }

    /**
     * Save a vendor to user's saved list.
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
     * Unsave a vendor from user's saved list.
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
     * Check if user has saved a vendor.
     */
    public function checkSavedVendor($vendorId)
    {
        try {
            $isSaved = Auth::user()->savedVendors()->where('vendor_id', $vendorId)->exists();

            return response()->json([
                'success' => true,
                'is_saved' => $isSaved
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check saved status'
            ], 500);
        }
    }

    /**
     * Get saved vendors for user.
     */
    public function getSavedVendors()
    {
        try {
            $savedVendors = Auth::user()->savedVendors()
                ->withCount(['products', 'followers'])
                ->paginate(12);

            return view('vendor.saved', compact('savedVendors'));
        } catch (\Exception $e) {
            Log::error('Get saved vendors error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load saved vendors');
        }
    }

    /**
     * Get vendor stats for dashboard.
     */
    public function getVendorStats()
    {
        $user = Auth::user();

        try {
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
                'store_views' => $user->store_views ?? 0,
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            Log::error('Get vendor stats error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }

    /**
     * Export sales report as CSV.
     */
    public function exportSalesReport(Request $request)
    {
        $user = Auth::user();

        $dateFrom = $request->get('date_from', now()->startOfMonth()->toDateString());
        $dateTo = $request->get('date_to', now()->toDateString());

        $orders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->with(['items.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'sales-report-' . $dateFrom . '-to-' . $dateTo . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add headers
        fputcsv($handle, ['Order ID', 'Date', 'Customer', 'Products', 'Quantity', 'Total Amount', 'Status', 'Payment Method']);

        foreach ($orders as $order) {
            $products = $order->items->map(function($item) {
                return $item->product->name . ' (x' . $item->quantity . ')';
            })->implode(', ');

            fputcsv($handle, [
                $order->order_number ?? '#' . $order->id,
                $order->created_at->format('Y-m-d H:i'),
                $order->user->name ?? 'Guest',
                $products,
                $order->items->sum('quantity'),
                $order->total_amount,
                $order->status,
                $order->payment_method ?? 'N/A',
            ]);
        }

        fclose($handle);
        exit;
    }
}
