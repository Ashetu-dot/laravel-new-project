<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
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
     * Display the sales report page with enhanced analytics.
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

        // Get current period orders
        $currentOrders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->with(['items.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get previous period for comparison (same length, previous timeframe)
        $dateRangeLength = now()->parse($dateFrom)->diffInDays(now()->parse($dateTo)) + 1;
        $previousDateFrom = now()->parse($dateFrom)->subDays($dateRangeLength)->toDateString();
        $previousDateTo = now()->parse($dateTo)->subDays($dateRangeLength)->toDateString();

        $previousOrders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$previousDateFrom . ' 00:00:00', $previousDateTo . ' 23:59:59'])
            ->get();

        // Calculate current KPIs
        $totalRevenue = $currentOrders->whereIn('status', ['completed', 'delivered'])->sum('total_amount');
        $totalOrders = $currentOrders->count();
        $completedOrders = $currentOrders->whereIn('status', ['completed', 'delivered'])->count();
        $pendingOrders = $currentOrders->where('status', 'pending')->count();
        $processingOrders = $currentOrders->where('status', 'processing')->count();
        $cancelledOrders = $currentOrders->where('status', 'cancelled')->count();
        
        $averageOrderValue = $completedOrders > 0 ? $totalRevenue / $completedOrders : 0;

        // Calculate previous period KPIs for trends
        $previousRevenue = $previousOrders->whereIn('status', ['completed', 'delivered'])->sum('total_amount');
        $previousOrdersCount = $previousOrders->count();
        
        // Calculate trends
        $revenueTrend = $this->calculateTrend($totalRevenue, $previousRevenue);
        $ordersTrend = $this->calculateTrend($totalOrders, $previousOrdersCount);
        $aovTrend = $this->calculateTrend($averageOrderValue, $previousOrdersCount > 0 ? $previousRevenue / $previousOrdersCount : 0);

        // Calculate conversion rate (simplified - orders vs unique visitors)
        $storeViews = $user->store_views ?? max(1000, $totalOrders * 10); // Estimate if not available
        $conversionRate = $storeViews > 0 ? ($completedOrders / $storeViews) * 100 : 0;
        
        $previousConversionRate = $storeViews > 0 ? ($previousOrdersCount / $storeViews) * 100 : 0;
        $conversionTrend = $this->calculateTrend($conversionRate, $previousConversionRate);

        // Sales trend (last 7 days or based on period)
        $salesTrend = $this->getSalesTrendData($user->id, $period);

        // Top selling products
        $topProducts = $this->getTopProducts($user->id, $dateFrom, $dateTo);

        // Payment method distribution
        $paymentMethods = $this->getPaymentMethodDistribution($user->id, $dateFrom, $dateTo);

        // Recent transactions
        $recentTransactions = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Daily/Monthly sales for chart
        $chartData = $this->getChartData($user->id, $period, $dateFrom, $dateTo);

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'totalRevenue' => $totalRevenue,
                'totalOrders' => $totalOrders,
                'completedOrders' => $completedOrders,
                'pendingOrders' => $pendingOrders,
                'processingOrders' => $processingOrders,
                'cancelledOrders' => $cancelledOrders,
                'averageOrderValue' => $averageOrderValue,
                'conversionRate' => round($conversionRate, 1),
                'revenueTrend' => round($revenueTrend, 1),
                'ordersTrend' => round($ordersTrend, 1),
                'aovTrend' => round($aovTrend, 1),
                'conversionTrend' => round($conversionTrend, 1),
                'chartData' => $chartData,
                'topProducts' => $topProducts,
                'paymentMethods' => $paymentMethods,
                'recentTransactions' => $recentTransactions->items(),
                'pagination' => $recentTransactions->links()->toHtml()
            ]);
        }

        return view('vendor.sales-report', compact(
            'user',
            'totalRevenue',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'processingOrders',
            'cancelledOrders',
            'averageOrderValue',
            'conversionRate',
            'revenueTrend',
            'ordersTrend',
            'aovTrend',
            'conversionTrend',
            'salesTrend',
            'topProducts',
            'paymentMethods',
            'recentTransactions',
            'chartData',
            'dateFrom',
            'dateTo',
            'period',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    // /**
    //  * Calculate trend percentage between current and previous values.
    //  */
    // private function calculateTrend($current, $previous)
    // {
    //     if ($previous == 0) {
    //         return $current > 0 ? 100 : 0;
    //     }
    //     return (($current - $previous) / $previous) * 100;
    // }

    /**
     * Get sales trend data for chart.
     */
    private function getSalesTrendData($vendorId, $period)
    {
        $data = [];
        $days = $period == 'year' ? 12 : ($period == 'month' ? 30 : 7);
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayRevenue = Order::whereHas('items.product', function($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId);
                })
                ->whereDate('created_at', $date)
                ->whereIn('status', ['completed', 'delivered'])
                ->sum('total_amount');

            $data[] = [
                'date' => $period == 'year' ? $date->format('M') : $date->format('D'),
                'revenue' => $dayRevenue
            ];
        }
        
        return $data;
    }

    /**
     * Get chart data with heights for visualization.
     */
    private function getChartData($vendorId, $period, $dateFrom, $dateTo)
    {
        $data = [];
        $currentDate = now()->parse($dateFrom);
        $endDate = now()->parse($dateTo);
        $maxValue = 0;

        while ($currentDate <= $endDate) {
            $revenue = Order::whereHas('items.product', function($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId);
                })
                ->whereDate('created_at', $currentDate)
                ->whereIn('status', ['completed', 'delivered'])
                ->sum('total_amount');

            $data[] = [
                'label' => $currentDate->format($period == 'today' ? 'H:i' : 'D'),
                'value' => $revenue,
                'full_date' => $currentDate->format('Y-m-d')
            ];

            $maxValue = max($maxValue, $revenue);
            $currentDate->addDay();
        }

        // Calculate heights for chart (max 280px)
        $chartData = [];
        foreach ($data as $item) {
            $height = $maxValue > 0 ? ($item['value'] / $maxValue) * 280 : 0;
            $chartData[] = [
                'label' => $item['label'],
                'height' => max(4, $height),
                'value' => $item['value'],
                'formatted_value' => 'ETB ' . number_format($item['value'], 2)
            ];
        }

        return $chartData;
    }

    /**
     * Get top selling products.
     */
    private function getTopProducts($vendorId, $dateFrom, $dateTo)
    {
        return Product::where('vendor_id', $vendorId)
            ->withCount(['orderItems as sold_quantity' => function($q) use ($dateFrom, $dateTo) {
                $q->whereHas('order', function($orderQuery) use ($dateFrom, $dateTo) {
                    $orderQuery->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
                               ->whereIn('status', ['completed', 'delivered']);
                })->select(DB::raw('COALESCE(SUM(quantity), 0)'));
            }])
            ->withSum(['orderItems as revenue' => function($q) use ($dateFrom, $dateTo) {
                $q->whereHas('order', function($orderQuery) use ($dateFrom, $dateTo) {
                    $orderQuery->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
                               ->whereIn('status', ['completed', 'delivered']);
                })->select(DB::raw('COALESCE(SUM(quantity * price), 0)'));
            }], 'price')
            ->having('sold_quantity', '>', 0)
            ->orderBy('sold_quantity', 'desc')
            ->take(5)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image ? Storage::url($product->image) : null,
                    'quantity' => (int) $product->sold_quantity,
                    'revenue' => (float) $product->revenue,
                    'price' => $product->price,
                    'stock' => $product->stock
                ];
            });
    }

    /**
     * Get payment method distribution.
     */
    private function getPaymentMethodDistribution($vendorId, $dateFrom, $dateTo)
    {
        $paymentMethods = Order::whereHas('items.product', function($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->select('payment_method', DB::raw('COUNT(*) as total'), DB::raw('SUM(total_amount) as amount'))
            ->groupBy('payment_method')
            ->get();

        $total = $paymentMethods->sum('total');
        
        return $paymentMethods->map(function($method) use ($total) {
            $name = $method->payment_method ?? 'Cash on Delivery';
            $icons = [
                'cash' => 'ri-bank-card-line',
                'telebirr' => 'ri-phone-line',
                'bank' => 'ri-bank-line',
                'chapa' => 'ri-secure-payment-line'
            ];
            
            return [
                'name' => $name,
                'count' => $method->total,
                'amount' => $method->amount,
                'percentage' => $total > 0 ? round(($method->total / $total) * 100) : 0,
                'icon' => $icons[strtolower($name)] ?? 'ri-bank-card-line'
            ];
        });
    }

    /**
     * Export sales report as CSV.
     */
    public function exportSalesReport(Request $request)
    {
        $user = Auth::user();

        $dateFrom = $request->get('date_from', now()->startOfMonth()->toDateString());
        $dateTo = $request->get('date_to', now()->toDateString());
        $period = $request->get('period', 'month');

        // Adjust date range based on period if no custom dates
        if ($period != 'custom') {
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
            }
        }

        $orders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->with(['items.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate summary
        $totalRevenue = $orders->whereIn('status', ['completed', 'delivered'])->sum('total_amount');
        $totalOrders = $orders->count();
        $completedOrders = $orders->whereIn('status', ['completed', 'delivered'])->count();
        $averageOrderValue = $completedOrders > 0 ? $totalRevenue / $completedOrders : 0;

        $filename = 'sales-report-' . $dateFrom . '-to-' . $dateTo . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($orders, $dateFrom, $dateTo, $totalRevenue, $totalOrders, $completedOrders, $averageOrderValue) {
            $handle = fopen('php://output', 'w');
            
            // Add report header
            fputcsv($handle, ['SALES REPORT']);
            fputcsv($handle, ['Period', $dateFrom . ' to ' . $dateTo]);
            fputcsv($handle, ['Generated', now()->format('Y-m-d H:i:s')]);
            fputcsv($handle, []);
            
            // Add summary
            fputcsv($handle, ['SUMMARY']);
            fputcsv($handle, ['Total Revenue', 'ETB ' . number_format($totalRevenue, 2)]);
            fputcsv($handle, ['Total Orders', $totalOrders]);
            fputcsv($handle, ['Completed Orders', $completedOrders]);
            fputcsv($handle, ['Average Order Value', 'ETB ' . number_format($averageOrderValue, 2)]);
            fputcsv($handle, []);
            
            // Add headers for detailed report
            fputcsv($handle, ['DETAILED REPORT']);
            fputcsv($handle, [
                'Order ID', 
                'Date', 
                'Customer', 
                'Products', 
                'Quantity', 
                'Total Amount', 
                'Status', 
                'Payment Method',
                'Order Date'
            ]);

            foreach ($orders as $order) {
                $products = $order->items->map(function($item) {
                    return $item->product->name . ' (x' . $item->quantity . ' @ ETB ' . number_format($item->price, 2) . ')';
                })->implode('; ');

                fputcsv($handle, [
                    $order->order_number ?? '#' . $order->id,
                    $order->created_at->format('Y-m-d H:i'),
                    $order->user->name ?? 'Guest Customer',
                    $products,
                    $order->items->sum('quantity'),
                    'ETB ' . number_format($order->total_amount, 2),
                    ucfirst($order->status),
                    $order->payment_method ?? 'N/A',
                    $order->created_at->format('Y-m-d')
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show a comparison page for the selected vendors.
     */
    public function compare(Request $request)
    {
        // Get vendor IDs from the query string (e.g., ?vendors=10,18,17)
        $vendorIds = $request->query('vendors');

        // Validate that vendor IDs are provided
        if (!$vendorIds) {
            return redirect()->back()->with('error', 'Please select vendors to compare.');
        }

        // Convert the comma-separated string to an array of integers
        $ids = array_unique(array_map('intval', explode(',', $vendorIds)));

        // Limit the number of vendors to compare for layout reasons
        if (count($ids) > 3) {
            return redirect()->back()->with('error', 'You can compare a maximum of 3 vendors at a time.');
        }

        if (count($ids) < 2) {
            return redirect()->back()->with('error', 'Please select at least 2 vendors to compare.');
        }

        // Fetch the vendor data with necessary counts and averages
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
            ->get();

        // Check if we found all requested vendors
        if ($vendors->count() !== count($ids)) {
            return redirect()->back()->with('error', 'One or more vendors not found.');
        }

        // Transform the data into a simple array format for the view
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
                    'rating' => round($product->reviews_avg_rating ?? 0, 1),
                    'reviews_count' => $product->reviews_count ?? 0,
                    'image' => $product->image ? Storage::url($product->image) : null,
                ];

                if ($product && $product->reviews_avg_rating) {
                    $totalRating += $product->reviews_avg_rating * ($product->reviews_count ?? 0);
                    $totalReviews += $product->reviews_count ?? 0;
                }
            }

            $avgRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 1) : (round($vendor->rating ?? 0, 1));

            // Get recent reviews
            $recentReviews = Review::whereHas('product', function($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->id);
                })
                ->with('user')
                ->latest()
                ->take(3)
                ->get()
                ->map(function($review) {
                    return [
                        'rating' => $review->rating,
                        'comment' => Str::limit($review->comment, 50),
                        'user' => $review->user->name,
                        'date' => $review->created_at->diffForHumans()
                    ];
                });

            return [
                'id' => $vendor->id,
                'name' => $vendor->business_name ?? $vendor->name,
                'category' => $vendor->category ?? 'General Store',
                'image' => $vendor->main_image ? Storage::url($vendor->main_image) : 
                          ($vendor->avatar ? Storage::url($vendor->avatar) : 
                          'https://ui-avatars.com/api/?name=' . urlencode($vendor->business_name ?? $vendor->name) . '&background=B88E3F&color=fff&size=200'),
                'verified' => !is_null($vendor->email_verified_at),
                'rating' => $avgRating,
                'reviews_count' => $vendor->total_reviews ?? $totalReviews,
                'city' => $vendor->city ?? 'Jimma',
                'state' => $vendor->state ?? 'Oromia',
                'products_count' => $vendor->products_count ?? 0,
                'followers_count' => $vendor->followers_count ?? 0,
                'featured_products' => $featuredProducts,
                'delivery_time' => $vendor->delivery_time ?? '1-3 days',
                'min_order' => $vendor->min_order ?? 0,
                'response_rate' => $vendor->response_rate ?? rand(90, 99),
                'response_time' => 'within 1 hour',
                'joined_date' => $vendor->created_at ? $vendor->created_at->format('M Y') : 'N/A',
                'last_active' => $vendor->last_login_at ?? now()->subHours(rand(1, 48)),
                'description' => $vendor->description ?? 'No description available.',
                'payment_methods' => ['Cash', 'Telebirr', 'Bank Transfer'],
                'languages' => ['Amharic', 'English', 'Afaan Oromoo'],
                'recent_reviews' => $recentReviews,
                'phone' => $vendor->phone ?? 'Not provided',
                'website' => $vendor->website ?? null,
                'social_media' => [
                    'facebook' => $vendor->facebook_url,
                    'instagram' => $vendor->instagram_url,
                    'telegram' => $vendor->telegram_url,
                    'twitter' => $vendor->twitter_url
                ]
            ];
        });

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

    // Get period from request
    $period = $request->get('period', 'month');
    
    // Set date range based on period
    switch($period) {
        case 'today':
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
            $days = 1;
            $previousStartDate = now()->subDay()->startOfDay();
            $previousEndDate = now()->subDay()->endOfDay();
            break;
        case 'week':
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
            $days = 7;
            $previousStartDate = now()->subWeek()->startOfWeek();
            $previousEndDate = now()->subWeek()->endOfWeek();
            break;
        case 'month':
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            $days = now()->daysInMonth;
            $previousStartDate = now()->subMonth()->startOfMonth();
            $previousEndDate = now()->subMonth()->endOfMonth();
            break;
        case 'year':
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
            $days = 12; // For monthly data
            $previousStartDate = now()->subYear()->startOfYear();
            $previousEndDate = now()->subYear()->endOfYear();
            break;
        default:
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            $days = now()->daysInMonth;
            $previousStartDate = now()->subMonth()->startOfMonth();
            $previousEndDate = now()->subMonth()->endOfMonth();
    }

    // Get current period data
    // In a real app, you would query your store_views table
    // For now, we'll use the user's store_views count and simulate data
    $totalViews = $user->store_views ?? rand(1000, 5000);
    $uniqueVisitors = round($totalViews * 0.7); // Estimate unique visitors
    $averageTimeOnSite = rand(120, 300) . 's'; // 2-5 minutes
    $bounceRate = round(rand(30, 60) / 10, 1); // 30-60%

    // Get previous period data for trends
    $previousViews = rand(800, 4000);
    $previousVisitors = round($previousViews * 0.7);
    $previousAvgTime = rand(100, 250) . 's';
    $previousBounceRate = round(rand(30, 60) / 10, 1);

    // Calculate trends
    $viewsTrend = $this->calculateTrend($totalViews, $previousViews);
    $visitorsTrend = $this->calculateTrend($uniqueVisitors, $previousVisitors);
    
    // Parse time strings to seconds for comparison
    $currentTimeSeconds = (int) filter_var($averageTimeOnSite, FILTER_SANITIZE_NUMBER_INT);
    $previousTimeSeconds = (int) filter_var($previousAvgTime, FILTER_SANITIZE_NUMBER_INT);
    $timeTrend = $this->calculateTrend($currentTimeSeconds, $previousTimeSeconds);
    
    $bounceTrend = $this->calculateTrend($bounceRate, $previousBounceRate);

    // Generate daily views for chart
    $dailyViews = [];

  
    $maxViews = 0;
    
    for ($i = $days - 1; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $views = rand(20, 100);
        $maxViews = max($maxViews, $views);
        
        $dailyViews[] = [
            'date' => $period == 'year' ? $date->format('M') : $date->format('M d'),
            'views' => $views,
            'unique' => rand(10, 70),
            'avg_time' => rand(1, 3) . 'm ' . rand(0, 59) . 's'
        ];
    }

    // Top referring sources
    $referrers = [
        ['source' => 'Direct', 'percentage' => 35],
        ['source' => 'Google', 'percentage' => 28],
        ['source' => 'Facebook', 'percentage' => 15],
        ['source' => 'Telegram', 'percentage' => 12],
        ['source' => 'Instagram', 'percentage' => 10],
    ];

    // Popular pages
    $popularPages = [
        ['page' => 'Homepage', 'views' => rand(500, 1000)],
        ['page' => 'Products Page', 'views' => rand(400, 800)],
        ['page' => 'Coffee Collection', 'views' => rand(300, 600)],
        ['page' => 'About Us', 'views' => rand(100, 300)],
        ['page' => 'Contact Page', 'views' => rand(50, 200)],
    ];

    // For AJAX requests, return JSON
    if ($request->ajax()) {
        return response()->json([
            'totalViews' => $totalViews,
            'uniqueVisitors' => $uniqueVisitors,
            'averageTimeOnSite' => $averageTimeOnSite,
            'bounceRate' => $bounceRate,
            'viewsTrend' => round($viewsTrend, 1),
            'visitorsTrend' => round($visitorsTrend, 1),
            'timeTrend' => round($timeTrend, 1),
            'bounceTrend' => round($bounceTrend, 1),
            'dailyViews' => $dailyViews,
            'maxViews' => $maxViews,
            'referrers' => $referrers,
            'popularPages' => $popularPages,
            'period' => $period
        ]);
    }

    return view('vendor.store-views', compact(
        'user',
        'totalViews',
        'uniqueVisitors',
        'averageTimeOnSite',
        'bounceRate',
        'viewsTrend',
        'visitorsTrend',
        'timeTrend',
        'bounceTrend',
        'dailyViews',
        'maxViews',
        'referrers',
        'popularPages',
        'period',
        'unreadNotificationsCount',
        'unreadMessagesCount'
    ));
}

/**
 * Calculate trend percentage between current and previous values.
 */
private function calculateTrend($current, $previous)
{
    if ($previous == 0) {
        return $current > 0 ? 100 : 0;
    }
    return (($current - $previous) / $previous) * 100;
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
            
            // Get notification stats
            $totalCount = Notification::where('user_id', $user->id)->count();
            $unreadCount = Notification::where('user_id', $user->id)->where('is_read', false)->count();
            $readCount = $totalCount - $unreadCount;
            
        } catch (\Exception $e) {
            $notifications = collect([]);
            $totalCount = 0;
            $unreadCount = 0;
            $readCount = 0;
            Log::error('Failed to load notifications: ' . $e->getMessage());
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
            'totalCount',
            'unreadCount',
            'readCount',
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

            return response()->json([
                'success' => true,
                'data' => $notification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Notification not found'
            ], 404);
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
                return response()->json([
                    'success' => true,
                    'message' => 'Notification marked as read'
                ]);
            }

            return redirect()->back()->with('success', 'Notification marked as read.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to mark notification as read'
                ], 404);
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
                return response()->json([
                    'success' => true,
                    'message' => 'All notifications marked as read'
                ]);
            }

            return redirect()->back()->with('success', 'All notifications marked as read.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to mark all notifications as read'
                ], 500);
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
                return response()->json([
                    'success' => true,
                    'message' => 'Notification deleted'
                ]);
            }

            return redirect()->back()->with('success', 'Notification deleted.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to delete notification'
                ], 500);
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
                return response()->json([
                    'success' => true,
                    'message' => 'All notifications cleared'
                ]);
            }

            return redirect()->back()->with('success', 'All notifications cleared.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to clear notifications'
                ], 500);
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
        // Get all messages for the user
        $messages = Message::where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Group messages by conversation partner
        $conversations = [];
        foreach ($messages as $message) {
            $otherUserId = $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
            
            if (!isset($conversations[$otherUserId])) {
                $conversations[$otherUserId] = [
                    'messages' => collect([]),
                    'last_message' => $message,
                    'unread_count' => 0
                ];
            }
            
            $conversations[$otherUserId]['messages']->push($message);
            
            // Count unread messages
            if ($message->receiver_id == $user->id && !$message->is_read) {
                $conversations[$otherUserId]['unread_count']++;
            }
            
            // Update last message if this one is newer
            if ($message->created_at > $conversations[$otherUserId]['last_message']->created_at) {
                $conversations[$otherUserId]['last_message'] = $message;
            }
        }

        // Sort conversations by last message date
        $conversations = collect($conversations)->sortByDesc(function($conv) {
            return $conv['last_message']->created_at;
        });

        // Build conversation list with user details
        $conversationList = [];
        foreach ($conversations as $userId => $conv) {
            $otherUser = $conv['messages']->first()->sender_id == $user->id ? 
                $conv['messages']->first()->receiver : 
                $conv['messages']->first()->sender;
            
            $conversationList[] = [
                'user' => $otherUser,
                'messages' => $conv['messages']->sortBy('created_at'),
                'last_message' => $conv['last_message'],
                'unread_count' => $conv['unread_count']
            ];
        }

    } catch (\Exception $e) {
        $conversationList = [];
        Log::error('Failed to load conversations: ' . $e->getMessage());
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
        'conversationList',
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
                    'data' => json_encode([
                        'message_id' => $message->id, 
                        'sender_id' => Auth::id(),
                        'sender_name' => Auth::user()->name,
                        'preview' => Str::limit($request->content, 50)
                    ]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create message notification: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'data' => [
                    'id' => $message->id,
                    'content' => $message->content,
                    'created_at' => $message->created_at->diffForHumans(),
                    'sender' => [
                        'id' => Auth::id(),
                        'name' => Auth::user()->name,
                        'avatar' => Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : null
                    ]
                ]
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

            return response()->json([
                'success' => true,
                'message' => 'Message marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark message as read'
            ], 404);
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
                ->get()
                ->map(function($message) use ($currentUser) {
                    return [
                        'id' => $message->id,
                        'content' => $message->content,
                        'created_at' => $message->created_at->diffForHumans(),
                        'is_mine' => $message->sender_id == $currentUser,
                        'sender' => [
                            'id' => $message->sender->id,
                            'name' => $message->sender->name,
                            'avatar' => $message->sender->avatar ? Storage::url($message->sender->avatar) : null
                        ],
                        'is_read' => $message->is_read,
                        'read_at' => $message->read_at ? $message->read_at->diffForHumans() : null
                    ];
                });

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
                'message' => 'Failed to load conversation'
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
                Auth::user()->savedVendors()->attach($vendorId, [
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Update vendor's saved count if you have such field
                // $vendor->increment('saved_count');

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

                // Update vendor's saved count if you have such field
                // $vendor->decrement('saved_count');

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
 * Export store views data as CSV.
 */
public function exportStoreViews(Request $request)
{
    $user = Auth::user();
    $period = $request->get('period', 'month');
    
    // Get date range
    switch($period) {
        case 'today':
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
            break;
        case 'week':
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
            break;
        case 'month':
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            break;
        case 'year':
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
            break;
        default:
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
    }
    
    // Generate daily data
    $data = [];
    $currentDate = $startDate->copy();
    
    while ($currentDate <= $endDate) {
        $data[] = [
            'date' => $currentDate->format('Y-m-d'),
            'views' => rand(20, 100), // Replace with actual data
            'unique' => rand(10, 60)
        ];
        $currentDate->addDay();
    }
    
    // Generate CSV
    $filename = "store-views-{$period}-" . now()->format('Y-m-d') . ".csv";
    
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ];
    
    $callback = function() use ($data) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Date', 'Page Views', 'Unique Visitors']);
        
        foreach ($data as $row) {
            fputcsv($file, [$row['date'], $row['views'], $row['unique']]);
        }
        
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}


    /**
     * Get vendor stats for dashboard.
     */
    public function getVendorStats()
    {
        $user = Auth::user();

        try {
            $productsCount = Product::where('vendor_id', $user->id)->count();
            $activeProducts = Product::where('vendor_id', $user->id)->where('is_active', true)->count();
            
            $ordersQuery = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            });
            
            $totalOrders = $ordersQuery->count();
            $pendingOrders = $ordersQuery->where('status', 'pending')->count();
            $completedOrders = $ordersQuery->whereIn('status', ['completed', 'delivered'])->count();
            
            $totalRevenue = Order::whereHas('items.product', function($q) use ($user) {
                    $q->where('vendor_id', $user->id);
                })
                ->whereIn('status', ['completed', 'delivered'])
                ->sum('total_amount');

            $followersCount = $user->followers()->count();
            
            // Calculate average rating from product reviews
            $avgRating = Product::where('vendor_id', $user->id)
                ->withAvg('reviews', 'rating')
                ->get()
                ->avg('reviews_avg_rating') ?? 0;

            $stats = [
                'followers' => $followersCount,
                'products' => $productsCount,
                'active_products' => $activeProducts,
                'rating' => round($avgRating, 1),
                'total_reviews' => $user->total_reviews ?? 0,
                'total_orders' => $totalOrders,
                'pending_orders' => $pendingOrders,
                'completed_orders' => $completedOrders,
                'total_revenue' => $totalRevenue,
                'store_views' => $user->store_views ?? 0,
                'products_count' => $productsCount,
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            Log::error('Get vendor stats error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }

}