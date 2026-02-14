<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the vendor's orders.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
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
        
        // Build query for orders that contain vendor's products
        $query = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->with(['items.product', 'user', 'items.product.vendor']);
        
        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Status filter
        if ($request->has('status') && !empty($request->status) && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Date range filter
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Sorting
        switch($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'total-high':
                $query->orderBy('total_amount', 'desc');
                break;
            case 'total-low':
                $query->orderBy('total_amount', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // Get order statistics with better performance using subqueries
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
        
        // Paginate results
        $orders = $query->paginate(15)->withQueryString();
        
        // Get recent order status changes for activity feed
        $recentActivities = $this->getRecentActivities($user->id);
        
        return view('vendor.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'totalRevenue',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'recentActivities',
            'user' // Pass user for the sidebar
        ));
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        
        $order = Order::where('id', $id)
            ->whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with([
                'items.product' => function($q) use ($user) {
                    $q->where('vendor_id', $user->id);
                },
                'user', 
                'shippingAddress',
                'billingAddress'
            ])
            ->firstOrFail();
        
        // Calculate vendor-specific totals for this order
        $vendorSubtotal = 0;
        $vendorItems = [];
        
        foreach ($order->items as $item) {
            if ($item->product && $item->product->vendor_id == $user->id) {
                $vendorSubtotal += $item->total;
                $vendorItems[] = $item;
            }
        }
        
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
        
        return view('vendor.order.show', compact(
            'order',
            'vendorSubtotal',
            'vendorItems',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'user',
            
        ));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = Auth::user();
        
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled',
            'notes' => 'nullable|string|max:500'
        ]);
        
        $order = Order::where('id', $id)
            ->whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['items.product'])
            ->firstOrFail();
        
        $oldStatus = $order->status;
        $order->status = $request->status;
        
        // Add tracking number if provided
        if ($request->has('tracking_number') && !empty($request->tracking_number)) {
            $order->tracking_number = $request->tracking_number;
        }
        
        $order->save();
        
        // If status is completed or delivered, update stock if needed
        if (in_array($request->status, ['completed', 'delivered'])) {
            $this->updateStockForCompletedOrder($order);
        }
        
        // Create a notification for the customer
        try {
            $this->createOrderStatusNotification($order, $oldStatus, $request->status, $request->notes);
        } catch (\Exception $e) {
            Log::error('Failed to create order status notification: ' . $e->getMessage());
        }
        
        // Log the status change
        Log::info("Order #{$order->order_number} status changed from {$oldStatus} to {$request->status} by vendor #{$user->id}");
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!',
                'status' => $order->status,
                'tracking_number' => $order->tracking_number
            ]);
        }
        
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Get orders for AJAX requests.
     */
    public function getOrders(Request $request)
    {
        $user = Auth::user();
        
        $query = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->with(['items.product', 'user']);
        
        // Apply filters
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $perPage = $request->get('per_page', 15);
        $orders = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    /**
     * Export orders to CSV.
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        
        $query = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->with(['items.product', 'user']);
        
        // Apply filters if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        $filename = "orders-export-" . date('Y-m-d-His') . ".csv";
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        
        $columns = ['Order #', 'Customer', 'Email', 'Phone', 'Date', 'Items', 'Total', 'Status', 'Payment Method', 'Tracking Number'];
        
        $callback = function() use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper Excel encoding
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);
            
            foreach ($orders as $order) {
                $items = [];
                foreach ($order->items as $item) {
                    $items[] = $item->product->name . ' (x' . $item->quantity . ')';
                }
                
                fputcsv($file, [
                    $order->order_number,
                    $order->user->name,
                    $order->user->email,
                    $order->user->phone ?? 'N/A',
                    $order->created_at->format('Y-m-d H:i'),
                    implode(' | ', $items),
                    number_format($order->total_amount, 2),
                    ucfirst($order->status),
                    $order->payment_method ?? 'N/A',
                    $order->tracking_number ?? 'N/A'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get order statistics for dashboard.
     */
    public function getStats()
    {
        $user = Auth::user();
        
        $vendorProductIds = Product::where('vendor_id', $user->id)->pluck('id');
        
        $today = now()->startOfDay();
        $weekStart = now()->startOfWeek();
        $monthStart = now()->startOfMonth();
        
        $stats = [
            'today' => [
                'orders' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', $today)->count(),
                'revenue' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', $today)->whereIn('status', ['completed', 'delivered'])->sum('total_amount')
            ],
            'week' => [
                'orders' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', '>=', $weekStart)->count(),
                'revenue' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', '>=', $weekStart)->whereIn('status', ['completed', 'delivered'])->sum('total_amount')
            ],
            'month' => [
                'orders' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', '>=', $monthStart)->count(),
                'revenue' => Order::whereHas('items', function($q) use ($vendorProductIds) {
                    $q->whereIn('product_id', $vendorProductIds);
                })->whereDate('created_at', '>=', $monthStart)->whereIn('status', ['completed', 'delivered'])->sum('total_amount')
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Update stock for completed orders.
     */
    private function updateStockForCompletedOrder($order)
    {
        foreach ($order->items as $item) {
            if ($item->product && $item->product->vendor_id == Auth::id()) {
                // Decrease stock
                $item->product->stock = max(0, $item->product->stock - $item->quantity);
                $item->product->save();
                
                // Update sold count
                $item->product->increment('sold_count', $item->quantity);
            }
        }
    }

    /**
     * Create notification for customer about order status change.
     */
    private function createOrderStatusNotification($order, $oldStatus, $newStatus, $notes = null)
    {
        // This would typically create a notification for the customer
        // You can implement this based on your notification system
        Log::info("Order #{$order->order_number} status changed: {$oldStatus} -> {$newStatus}" . ($notes ? " Notes: {$notes}" : ""));
    }

    /**
     * Get recent order activities.
     */
    private function getRecentActivities($vendorId)
    {
        // This would typically fetch recent order status changes
        // For now, return empty array
        return [];
    }

    /**
     * Bulk update order status.
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled'
        ]);
        
        $user = Auth::user();
        $updatedCount = 0;
        
        foreach ($request->order_ids as $orderId) {
            $order = Order::where('id', $orderId)
                ->whereHas('items.product', function($q) use ($user) {
                    $q->where('vendor_id', $user->id);
                })
                ->first();
                
            if ($order) {
                $order->status = $request->status;
                $order->save();
                $updatedCount++;
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => "{$updatedCount} orders updated successfully!",
            'count' => $updatedCount
        ]);
    }

    /**
     * Print order invoice.
     */
    public function printInvoice(string $id)
    {
        $user = Auth::user();
        
        $order = Order::where('id', $id)
            ->whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['items.product', 'user', 'shippingAddress'])
            ->firstOrFail();
        
        // Calculate vendor totals
        $vendorTotal = 0;
        foreach ($order->items as $item) {
            if ($item->product && $item->product->vendor_id == $user->id) {
                $vendorTotal += $item->total;
            }
        }
        
        return view('vendor.orders.invoice', compact('order', 'vendorTotal'));
    }
}