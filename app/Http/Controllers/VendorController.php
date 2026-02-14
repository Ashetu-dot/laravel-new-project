<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
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
        
        // This would typically come from a store_views table
        // For now, we'll use placeholder data
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
    public function notifications()
    {
        $user = Auth::user();
        
        try {
            $notifications = Notification::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
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
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
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
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
            
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'data' => $message->load('sender')
            ]);
        } catch (\Exception $e) {
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
}