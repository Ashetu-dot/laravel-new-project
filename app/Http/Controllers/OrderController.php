<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
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
     * Display the specified order for vendor.
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
                'user'
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

        return view('vendor.orders.show', compact(
            'order',
            'vendorSubtotal',
            'vendorItems',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'user',
        ));
    }

    /**
     * Update order status (vendor).
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,refunded',
            'notes' => 'nullable|string|max:500',
            'tracking_number' => 'nullable|string|max:100'
        ]);

        $order = Order::where('id', $id)
            ->whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['items.product', 'user'])
            ->firstOrFail();

        $oldStatus = $order->status;
        $order->status = $request->status;

        // Set timestamps based on status
        if ($request->status == 'processing' && !$order->processing_at) {
            $order->processing_at = now();
        } elseif ($request->status == 'shipped' && !$order->shipped_at) {
            $order->shipped_at = now();
        } elseif ($request->status == 'delivered' && !$order->delivered_at) {
            $order->delivered_at = now();
        } elseif ($request->status == 'cancelled' && !$order->cancelled_at) {
            $order->cancelled_at = now();
            $order->cancellation_reason = $request->notes;
        } elseif ($request->status == 'refunded' && !$order->refunded_at) {
            $order->refunded_at = now();
        }

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
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'order_status_updated',
                'title' => 'Order Status Updated',
                'message' => 'Your order #' . $order->order_number . ' is now ' . $request->status,
                'data' => json_encode([
                    'order_id' => $order->id,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                    'notes' => $request->notes
                ]),
                'is_read' => false,
            ]);
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
     * Get orders for AJAX requests (vendor).
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
     * Export orders to CSV (vendor).
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
     * Get order statistics for vendor dashboard.
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
     * Get recent order activities.
     */
    private function getRecentActivities($vendorId)
    {
        // This would typically fetch recent order status changes
        // For now, return empty array
        return [];
    }

    /**
     * Bulk update order status (vendor).
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,refunded'
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
     * Print order invoice (vendor).
     */
    public function printInvoice(string $id)
    {
        $user = Auth::user();

        $order = Order::where('id', $id)
            ->whereHas('items.product', function($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->with(['items.product', 'user'])
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

    // ========== CUSTOMER ORDER METHODS ==========

    /**
     * Display customer orders.
     */
    public function customerOrders(Request $request)
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

        // Build query
        $query = Order::where('user_id', $user->id)
            ->with(['items.product', 'vendor']);

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('vendor', function($vendorQuery) use ($search) {
                      $vendorQuery->where('business_name', 'like', "%{$search}%")
                                 ->orWhere('name', 'like', "%{$search}%");
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

        // Apply sorting
        $sort = $request->get('sort', 'latest');
        if ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'highest') {
            $query->orderBy('total_amount', 'desc');
        } elseif ($sort === 'lowest') {
            $query->orderBy('total_amount', 'asc');
        }

        $orders = $query->paginate(10)->withQueryString();

        // Get order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $processingOrders = Order::where('user_id', $user->id)->where('status', 'processing')->count();
        $completedOrders = Order::where('user_id', $user->id)->whereIn('status', ['completed', 'delivered'])->count();
        $cancelledOrders = Order::where('user_id', $user->id)->where('status', 'cancelled')->count();
        $totalSpent = Order::where('user_id', $user->id)->whereIn('status', ['completed', 'delivered'])->sum('total_amount');

        // Get cart count
        try {
            $cartCount = \App\Models\Cart::where('user_id', $user->id)->sum('quantity');
        } catch (\Exception $e) {
            $cartCount = 0;
        }

        return view('customer.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalSpent',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'cartCount',
            'user'
        ));
    }

    /**
     * Display single customer order.
     */
    public function customerOrderShow($id)
    {
        $user = Auth::user();

        $order = Order::where('user_id', $user->id)
            ->with(['items.product', 'vendor'])
            ->findOrFail($id);

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

        return view('customer.orders.show', compact(
            'order',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'user'
        ));
    }

    /**
     * Cancel customer order.
     */
    public function customerOrderCancel(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

        try {
            $order = Order::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'processing'])
                ->with(['items.product', 'vendor'])
                ->findOrFail($id);

            $order->status = 'cancelled';
            $order->cancelled_at = now();
            $order->cancellation_reason = $request->reason;
            $order->save();

            // Restore product stock
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stock += $item->quantity;
                    $product->save();
                }
            }

            // Notify vendor
            try {
                Notification::create([
                    'user_id' => $order->vendor_id,
                    'type' => 'order_cancelled',
                    'title' => 'Order Cancelled',
                    'message' => 'Order #' . $order->order_number . ' has been cancelled by the customer.',
                    'data' => json_encode([
                        'order_id' => $order->id,
                        'customer_id' => $user->id,
                        'reason' => $request->reason
                    ]),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to create cancellation notification: ' . $e->getMessage());
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order cancelled successfully'
                ]);
            }

            return redirect()->route('customer.orders.show', $order->id)
                ->with('success', 'Order cancelled successfully');

        } catch (\Exception $e) {
            Log::error('Order cancellation error: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to cancel order'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to cancel order');
        }
    }

    /**
     * Track customer order.
     */
    public function customerOrderTrack($id)
    {
        $user = Auth::user();

        $order = Order::where('user_id', $user->id)
            ->with(['items.product', 'vendor'])
            ->findOrFail($id);

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

        // Define tracking steps
        $trackingSteps = [
            'pending' => [
                'label' => 'Order Placed',
                'description' => 'Your order has been placed successfully',
                'icon' => 'ri-shopping-bag-line',
                'completed' => true,
                'date' => $order->created_at
            ],
            'processing' => [
                'label' => 'Processing',
                'description' => 'Vendor is preparing your order',
                'icon' => 'ri-time-line',
                'completed' => in_array($order->status, ['processing', 'shipped', 'delivered', 'completed']),
                'date' => $order->processing_at ?? null
            ],
            'shipped' => [
                'label' => 'Shipped',
                'description' => $order->tracking_number ? 'Tracking: ' . $order->tracking_number : 'Your order has been shipped',
                'icon' => 'ri-truck-line',
                'completed' => in_array($order->status, ['shipped', 'delivered', 'completed']),
                'date' => $order->shipped_at ?? null
            ],
            'delivered' => [
                'label' => 'Delivered',
                'description' => 'Your order has been delivered',
                'icon' => 'ri-checkbox-circle-line',
                'completed' => in_array($order->status, ['delivered', 'completed']),
                'date' => $order->delivered_at ?? null
            ]
        ];

        return view('customer.orders.track', compact('order', 'trackingSteps', 'unreadNotificationsCount', 'unreadMessagesCount', 'user'));
    }

    /**
     * Reorder from previous order.
     */
    public function customerReorder($id)
    {
        $user = Auth::user();

        try {
            $oldOrder = Order::where('user_id', $user->id)
                ->with('items')
                ->findOrFail($id);

            // Check if products are still available
            $unavailableProducts = [];
            foreach ($oldOrder->items as $item) {
                $product = Product::find($item->product_id);
                if (!$product || !$product->is_active || $product->stock < $item->quantity) {
                    $unavailableProducts[] = $item->product->name ?? 'Product #' . $item->product_id;
                }
            }

            if (!empty($unavailableProducts)) {
                $message = 'Some products are no longer available: ' . implode(', ', $unavailableProducts);
                return redirect()->back()->with('error', $message);
            }

            // Create new order
            $order = Order::create([
                'user_id' => $user->id,
                'vendor_id' => $oldOrder->vendor_id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $oldOrder->total_amount,
                'status' => 'pending',
                'payment_method' => $oldOrder->payment_method,
                'shipping_address_id' => $oldOrder->shipping_address_id,
                'billing_address_id' => $oldOrder->billing_address_id,
                'notes' => 'Reorder from order #' . $oldOrder->order_number
            ]);

            // Copy order items and update stock
            foreach ($oldOrder->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'vendor_id' => $item->vendor_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total
                ]);

                // Decrease stock
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stock -= $item->quantity;
                    $product->save();
                }
            }

            return redirect()->route('customer.orders.show', $order->id)
                ->with('success', 'Reorder placed successfully');

        } catch (\Exception $e) {
            Log::error('Reorder error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reorder. Please try again.');
        }
    }

    /**
     * Get customer order statistics for AJAX.
     */
    public function getCustomerOrderStats()
    {
        $user = Auth::user();

        try {
            $stats = [
                'total' => Order::where('user_id', $user->id)->count(),
                'pending' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
                'processing' => Order::where('user_id', $user->id)->where('status', 'processing')->count(),
                'completed' => Order::where('user_id', $user->id)->whereIn('status', ['completed', 'delivered'])->count(),
                'cancelled' => Order::where('user_id', $user->id)->where('status', 'cancelled')->count(),
                'total_spent' => Order::where('user_id', $user->id)->whereIn('status', ['completed', 'delivered'])->sum('total_amount')
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            Log::error('Error fetching order stats: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }
}
