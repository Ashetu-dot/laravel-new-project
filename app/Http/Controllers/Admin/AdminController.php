<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Message;
use App\Models\Notification;
use App\Models\VideoTutorial;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Services\Admin\AdminService;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\AdminPasswordUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PromotionUsage;

class AdminController extends Controller
{
    protected $adminService;


/**
     * Dashboard overview
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_vendors' => User::where('role', 'vendor')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'pending_vendors' => User::where('role', 'vendor')->where('is_active', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display users list
     */
    public function users(Request $request)
    {
        // Get filter parameters
        $role = $request->get('role', 'all');
        $status = $request->get('status', 'all');
        $search = $request->get('search');

        // Build query
        $query = User::query();

        // Apply role filter
        if ($role !== 'all') {
            $query->where('role', $role);
        }

        // Apply status filter
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        // Apply search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Get users with pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics for the view
        $stats = [
            'total' => User::count(),
            'vendors' => User::where('role', 'vendor')->count(),
            'customers' => User::where('role', 'customer')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'pending' => User::where('role', 'vendor')->where('is_active', false)->count(),
        ];

        return view('admin.users.index', compact('users', 'stats', 'role', 'status', 'search'));
    }

    /**
     * Show single user details
     */
    public function showUser($id)
    {
        $user = User::with(['products', 'reviews'])->findOrFail($id);

        $stats = [
            'products_count' => $user->products()->count(),
            'reviews_count' => $user->reviews()->count(),
            'average_rating' => $user->reviews()->avg('rating') ?? 0,
            'orders_count' => DB::table('orders')->where('vendor_id', $id)->count(),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    /**
     * Show edit user form
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'business_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'sometimes|in:admin,vendor,customer',
            'is_active' => 'sometimes|boolean',
            'is_verified' => 'sometimes|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'User updated successfully.');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activated' : 'deactivated';

        return redirect()->back()->with('success', "User {$status} successfully.");
    }

    /**
     * Toggle generic user status via users routes.
     *
     * This is a small wrapper so routes that expect
     * toggleUserStatus() continue to work.
     */
    public function toggleUserStatus($id)
    {
        return $this->toggleStatus($id);
    }



    /**
     * Toggle vendor verification
     */
    public function toggleVerification($id)
    {
        $user = User::where('role', 'vendor')->findOrFail($id);

        // Using email_verified_at instead of is_verified
        $user->email_verified_at = $user->email_verified_at ? null : now();
        $user->save();

        $status = $user->email_verified_at ? 'verified' : 'unverified';

        return redirect()->back()->with('success', "Vendor {$status} successfully.");
    }



    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Don't allow deleting own account
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Export users list
     */
    public function exportUsers(Request $request)
    {
        $role = $request->get('role', 'all');

        $query = User::query();

        if ($role !== 'all') {
            $query->where('role', $role);
        }

        $users = $query->get();

        // Generate CSV
        $filename = 'users_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add headers
        fputcsv($handle, ['ID', 'Name', 'Email', 'Role', 'Business Name', 'Phone', 'Active', 'Verified', 'Joined']);

        // Add data
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->business_name,
                $user->phone,
                $user->is_active ? 'Yes' : 'No',
                $user->is_verified ? 'Yes' : 'No',
                $user->created_at->format('Y-m-d')
            ]);
        }

        fclose($handle);
        exit;
    }

    /**
     * Pending vendors list
     */
    public function pendingVendors()
    {
        $vendors = User::where('role', 'vendor')
            ->where('is_active', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users.pending', compact('vendors'));
    }

    /**
     * Approve vendor
     */
    public function approveVendor($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);
        $vendor->is_active = true;
        $vendor->save();

        // Send notification email to vendor
        // Mail::to($vendor->email)->send(new VendorApproved($vendor));

        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

    /**
     * Reject vendor with reason
     */
    public function rejectVendor(Request $request, $id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        $validated = $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        // Send rejection email with reason
        // Mail::to($vendor->email)->send(new VendorRejected($vendor, $validated['reason']));

        $vendor->delete(); // Or you can keep but mark as rejected

        return redirect()->route('admin.users')->with('success', 'Vendor rejected.');
    }

    /**
     * Bulk actions on users
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $users = User::whereIn('id', $validated['user_ids']);

        switch ($validated['action']) {
            case 'activate':
                $users->update(['is_active' => true]);
                $message = 'Users activated successfully.';
                break;
            case 'deactivate':
                $users->update(['is_active' => false]);
                $message = 'Users deactivated successfully.';
                break;
            case 'delete':
                // Don't allow deleting own account
                if (in_array(auth()->id(), $validated['user_ids'])) {
                    return redirect()->back()->with('error', 'You cannot delete your own account.');
                }
                $users->delete();
                $message = 'Users deleted successfully.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Constructor with dependency injection
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            // Apply auth:admin middleware to all methods except create and store
            'auth:admin' => ['except' => ['create', 'store']],

            // Custom role check using closure - now using admin guard
            function ($request, $next) {
                if (!in_array($request->route()->getName(), ['admin.login', 'admin.login.submit'])) {
                    if (!Auth::guard('admin')->check()) {
                        abort(403, 'Unauthorized access. Admin only.');
                    }
                }
                return $next($request);
            },
        ];
    }

    /**
     * ========================================================================
     * DASHBOARD & STATISTICS
     * ========================================================================
     */

    /**
     * Display admin dashboard.
     */
    public function index(Request $request)
    {
        $period = $request->get('period', 7);

        $stats = $this->adminService->getDashboardStats();
        $recentActivities = $this->adminService->getRecentActivities();
        $chartData = $this->getChartData($period);

        // Additional dashboard data
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $pendingVendorsCount = User::where('role', 'vendor')->whereNull('email_verified_at')->count();

        // Notifications count
        try {
            $unreadNotificationsCount = \App\Models\Notification::where('user_id', Auth::id())
                ->where('is_read', false)->count();
            $recentNotifications = \App\Models\Notification::where('user_id', Auth::id())
                ->latest()->limit(5)->get();
        } catch (\Exception $e) {
            $unreadNotificationsCount = 0;
            $recentNotifications = collect([]);
        }

        // Messages count
        try {
            $unreadMessagesCount = \App\Models\Message::where('receiver_id', Auth::id())
                ->where('is_read', false)->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }

        $recentOrders = Order::with('user')->latest()->paginate(10);

        // KPI cards — real data
        $totalRevenue        = Order::where('status', 'completed')->sum('total_amount') ?? 0;
        $activeVendorsCount  = User::where('role', 'vendor')->where('is_active', true)->count();
        $totalCustomersCount = User::where('role', 'customer')->count();
        $totalOrdersCount    = Order::count();

        // Growth: compare last 30 days vs previous 30 days
        $now   = now();
        $rev30 = Order::where('status', 'completed')->where('created_at', '>=', $now->copy()->subDays(30))->sum('total_amount');
        $rev60 = Order::where('status', 'completed')->whereBetween('created_at', [$now->copy()->subDays(60), $now->copy()->subDays(30)])->sum('total_amount');
        $revenueGrowth  = $rev60 > 0 ? round((($rev30 - $rev60) / $rev60) * 100, 1) : 0;

        $ord30 = Order::where('created_at', '>=', $now->copy()->subDays(30))->count();
        $ord60 = Order::whereBetween('created_at', [$now->copy()->subDays(60), $now->copy()->subDays(30)])->count();
        $orderChange = $ord60 > 0 ? round((($ord30 - $ord60) / $ord60) * 100, 1) : 0;

        $cust30 = User::where('role', 'customer')->where('created_at', '>=', $now->copy()->subDays(30))->count();
        $cust60 = User::where('role', 'customer')->whereBetween('created_at', [$now->copy()->subDays(60), $now->copy()->subDays(30)])->count();
        $customerGrowth = $cust60 > 0 ? round((($cust30 - $cust60) / $cust60) * 100, 1) : 0;

        $vend30 = User::where('role', 'vendor')->where('created_at', '>=', $now->copy()->subDays(30))->count();
        $vend60 = User::where('role', 'vendor')->whereBetween('created_at', [$now->copy()->subDays(60), $now->copy()->subDays(30)])->count();
        $vendorGrowth = $vend60 > 0 ? round((($vend30 - $vend60) / $vend60) * 100, 1) : 0;

        // Today's stats — real data
        $completedOrdersToday = Order::where('status', 'completed')->whereDate('created_at', today())->count();
        $newReviewsToday      = \App\Models\Review::whereDate('created_at', today())->count();
        $refundRequests       = Order::where('status', 'refund_requested')->count();
        $productViewsToday    = \App\Models\Product::whereDate('updated_at', today())->sum('views_count') ?? 0;

        // Greeting based on time
        $greeting = $this->getGreeting();

        return view('admin.dashboard', compact(
            'stats',
            'recentActivities',
            'chartData',
            'period',
            'pendingOrdersCount',
            'pendingVendorsCount',
            'unreadNotificationsCount',
            'unreadMessagesCount',
            'recentOrders',
            'recentNotifications',
            'totalRevenue',
            'activeVendorsCount',
            'totalCustomersCount',
            'totalOrdersCount',
            'revenueGrowth',
            'vendorGrowth',
            'orderChange',
            'customerGrowth',
            'productViewsToday',
            'completedOrdersToday',
            'newReviewsToday',
            'refundRequests',
            'greeting'
        ));
    }

    /**
     * Get greeting based on time of day.
     */
    private function getGreeting()
    {
        $hour = now()->hour;
        if ($hour < 12) return 'Good morning';
        if ($hour < 17) return 'Good afternoon';
        return 'Good evening';
    }

    /**
     * Get chart data for dashboard (PRIVATE - used internally)
     */
    private function getChartData($days = 7)
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayOrders = Order::whereDate('created_at', $date)->count();
            $dayRevenue = Order::whereDate('created_at', $date)->where('status', 'completed')->sum('total_amount');

            // Calculate percentages for chart display (relative to max)
            $maxOrders = Order::whereDate('created_at', '>=', now()->subDays($days))->count() ?: 100;
            $maxRevenue = Order::whereDate('created_at', '>=', now()->subDays($days))->where('status', 'completed')->sum('total_amount') ?: 1000;

            $data[] = [
                'label' => $date->format('D'),
                'orders_percent' => $maxOrders > 0 ? ($dayOrders / $maxOrders) * 100 : 30,
                'revenue_percent' => $maxRevenue > 0 ? ($dayRevenue / $maxRevenue) * 100 : 50,
                'orders_count' => $dayOrders,
                'revenue_amount' => $dayRevenue,
            ];
        }
        return $data;
    }

    /**
     * ========================================================================
     * AUTHENTICATION
     * ========================================================================
     */

    /**
     * Show admin login form.
     */
    public function create()
    {
        // If already logged in, redirect to dashboard
        if ($this->adminService->isAuthenticated()) {
            return redirect()->route('admin.dashboard');
        }

        // Check for remember me auto-login
        if ($this->adminService->hasValidRememberMe()) {
            $result = $this->adminService->loginWithRememberMe();
            if ($result === 1) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back! Auto-login successful.');
            }
        }

        // Get remembered credentials for pre-filling
        $rememberedCredentials = $this->adminService->getRememberMeCredentials();

        return view('auth.login', [
            'remembered_email' => $rememberedCredentials['email'] ?? '',
            'remember_checked' => !empty($rememberedCredentials)
        ]);
    }




/**
 * Handle admin login request.
 */
public function store(AdminLoginRequest $request)
{
    $validated = $request->validated();

    $result = $this->adminService->login(
        $validated['email'],
        $validated['password'],
        $request->boolean('remember')
    );

    if ($result === 1) {
        // Use intended() instead of route() to respect the intended URL
        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Welcome back! Successfully logged in.');
    }

    return back()
        ->withErrors(['email' => 'The provided credentials are incorrect.'])
        ->withInput($request->only('email', 'remember'));
}


    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        $result = $this->adminService->logout();

        if ($result === 1) {
            return redirect()->route('admin.login')
                ->with('success', 'You have been successfully logged out.');
        }

        return redirect()->route('admin.login')
            ->with('error', 'Logout failed. Please try again.');
    }

    /**
     * ========================================================================
     * ORDERS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display a listing of orders.
     */
    public function orders(Request $request)
    {
        $status = $request->get('status');
        $search = $request->get('search');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $query = Order::with('user');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        $orderStats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $pendingOrdersCount  = $orderStats['pending'];
        $pendingVendorsCount = User::where('role', 'vendor')->whereNull('email_verified_at')->count();

        try {
            $unreadNotificationsCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
        } catch (\Exception $e) { $unreadNotificationsCount = 0; }

        try {
            $unreadMessagesCount = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', false)->count();
        } catch (\Exception $e) { $unreadMessagesCount = 0; }

        return view('admin.orders.index', compact(
            'orders', 'orderStats', 'status', 'search', 'dateFrom', 'dateTo',
            'pendingOrdersCount', 'pendingVendorsCount',
            'unreadNotificationsCount', 'unreadMessagesCount'
        ));
    }

    /**
     * Display the specified order.
     */
    public function showOrder($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,refunded,refund_requested'
            ]);

            $order = Order::findOrFail($id);
            $oldStatus = $order->status;
            $order->status = $request->status;
            $order->save();

            // Log activity
            if (class_exists('Activity')) {
                activity()
                    ->performedOn($order)
                    ->causedBy(Auth::user())
                    ->log("Order status changed from {$oldStatus} to {$request->status}");
            }

            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order status updated successfully.',
                    'status' => $order->status
                ]);
            }

            return redirect()->route('admin.orders.show', $id)
                ->with('success', 'Order status updated successfully.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status value.',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->with('error', 'Invalid status value.');
            
        } catch (\Exception $e) {
            Log::error('Failed to update order status: ' . $e->getMessage(), [
                'order_id' => $id,
                'status' => $request->status ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update order status: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Failed to update order status.');
        }
    }

    /**
     * ========================================================================
     * CUSTOMERS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display a listing of customers.
     */
    public function customers(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $query = User::where('role', 'customer')->withCount('orders');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status !== null) {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(15);

        $customerStats = [
            'total' => User::where('role', 'customer')->count(),
            'active' => User::where('role', 'customer')->where('is_active', true)->count(),
            'inactive' => User::where('role', 'customer')->where('is_active', false)->count(),
            'new_this_month' => User::where('role', 'customer')
                ->whereMonth('created_at', now()->month)
                ->count(),
        ];

        return view('admin.customers.index', compact('customers', 'customerStats', 'search', 'status'));
    }

    /**
     * Display the specified customer.
     */
    public function showCustomer($id)
    {
        $customer = User::where('role', 'customer')
            ->withCount('orders')
            ->with(['orders' => function ($q) {
                $q->latest()->limit(10);
            }])
            ->findOrFail($id);

        $totalSpent = Order::where('user_id', $customer->id)
            ->where('status', 'completed')
            ->sum('total_amount');

        $totalOrders = $customer->orders_count ?? 0;
        
        $unreadNotificationsCount = 0;
        $unreadMessagesCount = 0;

        return view('admin.customers.show', compact('customer', 'totalSpent', 'totalOrders', 'unreadNotificationsCount', 'unreadMessagesCount'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function editCustomer($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $unreadNotificationsCount = 0;
        $unreadMessagesCount = 0;

        return view('admin.customers.edit', compact('customer', 'unreadNotificationsCount', 'unreadMessagesCount'));
    }

    /**
     * Update customer information.
     */
    public function updateCustomer(Request $request, $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'is_active' => $request->boolean('is_active', $customer->is_active),
        ];

        // Update location string if city and state are provided
        if ($request->city && $request->state) {
            $updateData['location'] = $request->city . ', ' . $request->state;
        }

        $customer->update($updateData);

        return redirect()->route('admin.customers.show', $id)
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Delete customer account.
     */
    public function deleteCustomer($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        // Check if customer has orders
        $ordersCount = Order::where('user_id', $customer->id)->count();

        if ($ordersCount > 0) {
            // Soft delete or just deactivate
            $customer->is_active = false;
            $customer->save();

            return redirect()->route('admin.customers')
                ->with('warning', 'Customer has orders. Account has been deactivated instead of deleted.');
        }

        $customer->delete();

        return redirect()->route('admin.customers')
            ->with('success', 'Customer deleted successfully.');
    }

    /**
     * Toggle customer status (active/inactive).
     */
    public function toggleCustomerStatus($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $customer->is_active = !$customer->is_active;
        $customer->save();

        $status = $customer->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Customer {$status} successfully.");
    }

    /**
     * Get customer statistics (AJAX).
     */
    public function getCustomerStats()
    {
        try {
            $stats = [
                'total' => User::where('role', 'customer')->count(),
                'active' => User::where('role', 'customer')->where('is_active', true)->count(),
                'inactive' => User::where('role', 'customer')->where('is_active', false)->count(),
                'new_today' => User::where('role', 'customer')
                    ->whereDate('created_at', today())
                    ->count(),
                'new_this_week' => User::where('role', 'customer')
                    ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->count(),
                'new_this_month' => User::where('role', 'customer')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'verified' => User::where('role', 'customer')
                    ->whereNotNull('email_verified_at')
                    ->count(),
                'unverified' => User::where('role', 'customer')
                    ->whereNull('email_verified_at')
                    ->count(),
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Get customer stats error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load customer statistics'
            ], 500);
        }
    }

    /**
     * Verify customer email (admin action).
     */
    public function verifyCustomerEmail($id)
    {
        try {
            $customer = User::where('role', 'customer')->findOrFail($id);

            if ($customer->email_verified_at) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email is already verified'
                ]);
            }

            $customer->email_verified_at = now();
            $customer->save();

            Log::info('Admin verified customer email', [
                'admin_id' => Auth::id(),
                'customer_id' => $customer->id,
                'customer_email' => $customer->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Verify customer email error: ' . $e->getMessage(), [
                'customer_id' => $id,
                'admin_id' => Auth::id()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify email'
            ], 500);
        }
    }

    /**
     * ========================================================================
     * VENDORS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display a listing of vendors.
     */
    public function vendors(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $verification = $request->get('verification');

        $query = User::where('role', 'vendor');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status !== null) {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        if ($verification === 'pending') {
            $query->whereNull('email_verified_at');
        } elseif ($verification === 'verified') {
            $query->whereNotNull('email_verified_at');
        }

        $vendors = $query->orderBy('created_at', 'desc')->paginate(15);

        $vendorStats = [
            'total' => User::where('role', 'vendor')->count(),
            'active' => User::where('role', 'vendor')->where('is_active', true)->count(),
            'pending' => User::where('role', 'vendor')->whereNull('email_verified_at')->count(),
            'verified' => User::where('role', 'vendor')->whereNotNull('email_verified_at')->count(),
        ];

        return view('admin.vendors.index', compact('vendors', 'vendorStats', 'search', 'status', 'verification'));
    }

    /**
     * Display the specified vendor.
     */
    public function showVendor($id)
    {
        $vendor = User::where('role', 'vendor')
            ->with(['followers'])
            ->findOrFail($id);

        $followersCount = $vendor->followers()->count();
        $productsCount = $vendor->products_count ?? 0;
        $totalSales = 0; // Implement when orders table has vendor_id

        return view('admin.vendors.show', compact('vendor', 'followersCount', 'productsCount', 'totalSales'));
    }

    /**
     * Update vendor information.
     */
    public function updateVendor(Request $request, $id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $vendor->id,
            'category' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $vendor->update($request->all());

        return redirect()->route('admin.vendors.show', $id)
            ->with('success', 'Vendor updated successfully.');
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function editVendor($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        return view('admin.vendors.edit', compact('vendor'));
    }

    /**
     * Delete vendor account.
     */
    public function deleteVendor($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        // Check if vendor has products
        $productsCount = $vendor->products_count ?? 0;

        if ($productsCount > 0) {
            // Soft delete or just deactivate
            $vendor->is_active = false;
            $vendor->save();

            return redirect()->route('admin.vendors')
                ->with('warning', 'Vendor has products. Account has been deactivated instead of deleted.');
        }

        $vendor->delete();

        return redirect()->route('admin.vendors')
            ->with('success', 'Vendor deleted successfully.');
    }

    /**
     * Verify vendor email.
     */
    public function verifyVendor($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        $vendor->email_verified_at = now();
        $vendor->is_active = true;
        $vendor->save();

        return redirect()->route('admin.vendors.show', $id)
            ->with('success', 'Vendor verified successfully.');
    }

    /**
     * Change vendor status (active/inactive).
     */
    public function changeVendorStatus(Request $request, $id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);

        $vendor->is_active = $request->boolean('status', !$vendor->is_active);
        $vendor->save();

        // If the request expects JSON (AJAX), return JSON.
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Vendor status updated successfully.',
                'new_status' => $vendor->is_active,
            ]);
        }

        // Otherwise, redirect back in the admin panel with a flash message.
        $status = $vendor->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Vendor {$status} successfully.");
    }

    /**
     * ========================================================================
     * CATALOG MANAGEMENT
     * ========================================================================
     */

    /**
     * Display catalog overview.
     */
    public function catalog()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $outOfStock = Product::where('stock', '<=', 0)->count();
        $recentProducts = Product::with(['vendor', 'category'])->latest()->limit(10)->get();
        $activeVendorsCount = User::where('role', 'vendor')->where('is_active', true)->count();

        return view('admin.catalog.index', compact(
            'totalProducts',
            'totalCategories',
            'outOfStock',
            'recentProducts',
            'activeVendorsCount'
        ));
    }

    /**
     * Display inventory management page.
     */
    public function inventory(Request $request)
    {
        $search = $request->get('search');
        $stockStatus = $request->get('stock_status');

        $query = Product::with(['vendor', 'category']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }

        if ($stockStatus === 'low') {
            $query->where('stock', '>', 0)
                  ->where('stock', '<', 10);
        } elseif ($stockStatus === 'out') {
            $query->where('stock', '<=', 0);
        } elseif ($stockStatus === 'in') {
            $query->where('stock', '>', 10);
        }

        $products = $query->orderBy('stock', 'asc')->paginate(15);

        $stats = [
            'total_products' => Product::count(),
            'in_stock' => Product::where('stock', '>', 10)->count(),
            'low_stock' => Product::where('stock', '>', 0)->where('stock', '<', 10)->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            'total_value' => Product::sum(DB::raw('price * stock')),
        ];

        return view('admin.inventory.index', compact('products', 'stats', 'search', 'stockStatus'));
    }

    /**
     * Display low stock products.
     */
    public function lowStock()
    {
        $products = Product::with(['vendor', 'category'])
            ->where('stock', '>', 0)
            ->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->paginate(15);

        return view('admin.inventory.low-stock', compact('products'));
    }

    /**
     * Restock a product.
     */
    public function restock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $product->stock += $request->quantity;
        $product->save();

        return redirect()->back()->with('success', "Product restocked with {$request->quantity} units.");
    }

    /**
     * Display products listing.
     */
    public function products(Request $request)
    {
        $tab = $request->get('tab', 'products');

        // Products data
        $search = $request->get('search');
        $category = $request->get('category');
        $vendor = $request->get('vendor');
        $status = $request->get('status');

        $query = Product::with(['vendor', 'category']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($vendor) {
            $query->where('vendor_id', $vendor);
        }

        if ($status === 'active')   $query->where('is_active', true);
        if ($status === 'inactive') $query->where('is_active', false);

        $products = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $categories = Category::all();
        $allCategories = $categories;
        $vendors = User::where('role', 'vendor')->select('id', 'business_name', 'name')->get();

        // Categories tab data
        $catSearch = $request->get('cat_search');
        $catFilter = $request->get('cat_filter');
        $catQuery  = Category::withCount('products');
        if ($catSearch) $catQuery->where('name', 'like', "%{$catSearch}%");
        if ($catFilter === 'active')   $catQuery->where('is_active', true);
        if ($catFilter === 'inactive') $catQuery->where('is_active', false);
        if ($catFilter === 'parent')   $catQuery->whereNull('parent_id');
        if ($catFilter === 'child')    $catQuery->whereNotNull('parent_id');
        $categoriesPaginated = $catQuery->with('children')->paginate(15, ['*'], 'cat_page')->withQueryString();

        $totalCategories           = Category::count();
        $activeCategories          = Category::where('is_active', true)->count();
        $totalProductsInCategories = Product::count();

        // Header counts
        try { $unreadNotificationsCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count(); } catch (\Exception $e) { $unreadNotificationsCount = 0; }
        try { $unreadMessagesCount = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', false)->count(); } catch (\Exception $e) { $unreadMessagesCount = 0; }

        $pendingOrdersCount  = Order::where('status', 'pending')->count();
        $pendingVendorsCount = User::where('role', 'vendor')->whereNull('email_verified_at')->count();

        return view('admin.catalog.products', compact(
            'products', 'categories', 'allCategories', 'vendors',
            'search', 'category', 'vendor', 'status', 'tab',
            'categoriesPaginated', 'totalCategories', 'activeCategories', 'totalProductsInCategories',
            'catSearch', 'catFilter',
            'unreadNotificationsCount', 'unreadMessagesCount',
            'pendingOrdersCount', 'pendingVendorsCount'
        ));
    }

    /**
     * Show a specific product
     */
    public function showProduct($id)
    {
        $product = Product::with(['vendor', 'category', 'reviews.user'])->findOrFail($id);
        
        // Get unread counts for header
        $user = Auth::user();
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

        return view('admin.catalog.products.show', compact(
            'product',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Show form to create a new product
     */
    public function createProduct()
    {
        $categories = Category::where('is_active', true)->get();
        $vendors = User::where('role', 'vendor')->where('is_active', true)->get();
        
        return view('admin.catalog.products.create', compact('categories', 'vendors'));
    }

    /**
     * Store a new product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'vendor_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        return redirect()->route('admin.catalog.products')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show form to edit a product
     */
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $vendors = User::where('role', 'vendor')->where('is_active', true)->get();
        
        return view('admin.catalog.products.edit', compact('product', 'categories', 'vendors'));
    }

    /**
     * Update a product
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'vendor_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.catalog.products')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product
     */
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        // Return JSON response for AJAX requests
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ]);
        }

        return redirect()->route('admin.catalog.products')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Toggle product status
     */
    public function toggleProductStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        $status = $product->is_active ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "Product {$status} successfully.",
            'status' => $product->is_active
        ]);
    }

    /**
     * Get product statistics
     */
    public function getProductStats()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $lowStockProducts = Product::where('stock', '<=', 10)->count();
        $outOfStockProducts = Product::where('stock', 0)->count();

        return response()->json([
            'total' => $totalProducts,
            'active' => $activeProducts,
            'low_stock' => $lowStockProducts,
            'out_of_stock' => $outOfStockProducts
        ]);
    }

    /**
     * Export products
     */
    public function exportProducts(Request $request)
    {
        $products = Product::with(['vendor', 'category'])->get();
        
        $filename = 'products_' . now()->format('Y_m_d_H_i_s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Description', 'Price', 'Stock', 'Category', 
                'Vendor', 'Status', 'Created At'
            ]);

            // Add data rows
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->description,
                    $product->price,
                    $product->stock,
                    $product->category->name ?? 'N/A',
                    $product->vendor->business_name ?? $product->vendor->name ?? 'N/A',
                    $product->is_active ? 'Active' : 'Inactive',
                    $product->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display categories listing.
     */
    public function categories(Request $request)
    {
        $tab = $request->get('tab', 'categories');

        // Categories data
        $catSearch = $request->get('search');
        $catFilter = $request->get('filter');
        $catQuery  = Category::withCount('products');
        if ($catSearch) $catQuery->where('name', 'like', "%{$catSearch}%");
        if ($catFilter === 'active')   $catQuery->where('is_active', true);
        if ($catFilter === 'inactive') $catQuery->where('is_active', false);
        if ($catFilter === 'parent')   $catQuery->whereNull('parent_id');
        if ($catFilter === 'child')    $catQuery->whereNotNull('parent_id');
        $categories = $catQuery->with('children')->paginate(15)->withQueryString();

        $totalCategories          = Category::count();
        $activeCategories         = Category::where('is_active', true)->count();
        $totalProductsInCategories = \App\Models\Product::count();

        // Products data
        $search   = $request->get('prod_search');
        $category = $request->get('category');
        $vendor   = $request->get('vendor');
        $status   = $request->get('status');

        $prodQuery = \App\Models\Product::with(['vendor', 'category']);
        if ($search)   $prodQuery->where(fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%"));
        if ($category) $prodQuery->where('category_id', $category);
        if ($vendor)   $prodQuery->where('vendor_id', $vendor);
        if ($status === 'active')   $prodQuery->where('is_active', true);
        if ($status === 'inactive') $prodQuery->where('is_active', false);
        $products = $prodQuery->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $allCategories = Category::all();
        $vendors       = \App\Models\User::where('role', 'vendor')->select('id', 'business_name', 'name')->get();

        // Header counts
        try { $unreadNotificationsCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count(); } catch (\Exception $e) { $unreadNotificationsCount = 0; }
        try { $unreadMessagesCount = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', false)->count(); } catch (\Exception $e) { $unreadMessagesCount = 0; }

        return view('admin.catalog.categories', compact(
            'categories', 'totalCategories', 'activeCategories', 'totalProductsInCategories',
            'products', 'allCategories', 'vendors',
            'search', 'category', 'vendor', 'status', 'tab',
            'unreadNotificationsCount', 'unreadMessagesCount'
        ));
    }

    /**
     * Show form to create a new category
     */
    public function createCategory()
    {
        return view('admin.catalog.categories.create');
    }

    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        }

        Category::create($data);

        return redirect()->route('admin.catalog.categories')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show a specific category
     */
    public function showCategory($id)
    {
        $category = Category::withCount('products')->findOrFail($id);
        $products = $category->products()->paginate(20);
        
        return view('admin.catalog.categories.show', compact('category', 'products'));
    }

    /**
     * Show form to edit a category
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.catalog.categories.edit', compact('category'));
    }

    /**
     * Update a category
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        }

        $category->update($data);

        return redirect()->route('admin.catalog.categories')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Delete a category
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete category with existing products.');
        }

        $category->delete();

        return redirect()->route('admin.catalog.categories')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Toggle category status
     */
    public function toggleCategoryStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        return redirect()->back()
            ->with('success', 'Category status updated successfully.');
    }

    /**
     * Export categories
     */
    public function exportCategories()
    {
        $categories = Category::withCount('products')->get();
        
        // Simple CSV export
        $filename = 'categories_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($categories) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Slug', 'Products Count', 'Status', 'Created At']);

            foreach ($categories as $category) {
                fputcsv($file, [
                    $category->id,
                    $category->name,
                    $category->slug,
                    $category->products_count,
                    $category->is_active ? 'Active' : 'Inactive',
                    $category->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * ========================================================================
     * PROMOTIONS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display promotions listing.
     */
    public function promotions(Request $request)
    {
        $status = $request->get('status');

        $query = Promotion::query();

        if ($status === 'active') {
            $query->where('is_active', true)
                  ->where('start_date', '<=', now())
                  ->where('end_date', '>=', now());
        } elseif ($status === 'upcoming') {
            $query->where('start_date', '>', now());
        } elseif ($status === 'expired') {
            $query->where('end_date', '<', now());
        }

        $promotions = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.promotions.index', compact('promotions', 'status'));
    }

    // /**
    //  * Show form to create promotion.
    //  */
    // public function createPromotion()
    // {
    //     return view('admin.promotions.create');
    // }



/**
 * Show create promotion form.
 */
public function createPromotion()
{
    $user = Auth::user();
    
    // Get categories for filter
    $categories = Category::all();
    
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
    
    return view('admin.promotions.create', compact(
        'user',
        'categories',
        'unreadNotificationsCount',
        'unreadMessagesCount'
    ));
}








    
    // /**
    //  * Store a new promotion.
    //  */
    // public function storePromotion(Request $request)
    // {
    //     $request->validate([
    //         'code' => 'required|string|unique:promotions',
    //         'type' => 'required|in:fixed,percentage',
    //         'value' => 'required|numeric|min:0',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //         'usage_limit' => 'nullable|integer|min:1',
    //         'is_active' => 'boolean',
    //     ]);

    //     $promotion = Promotion::create($request->all());

    //     return redirect()->route('admin.promotions')
    //         ->with('success', 'Promotion created successfully.');
    // }











 /**
 * Store a new promotion.
 */
public function storePromotion(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:percentage,fixed,bogo,free_shipping',
        'discount_percentage' => 'required_if:type,percentage|nullable|numeric|min:1|max:100',
        'discount_amount' => 'required_if:type,fixed|nullable|numeric|min:1',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'min_purchase' => 'nullable|numeric|min:0',
        'max_discount' => 'nullable|numeric|min:0',
        'usage_limit' => 'nullable|integer|min:0',
        'total_usage_limit' => 'nullable|integer|min:0',
        'is_active' => 'required|in:0,1',
        'description' => 'nullable|string',
        'terms' => 'nullable|string',
        'banner' => 'nullable|image|max:2048',
        'product_scope' => 'required|in:all,selected,categories',
        'products' => 'required_if:product_scope,selected|array',
        'products.*' => 'exists:products,id',
        'categories' => 'required_if:product_scope,categories|array',
        'categories.*' => 'exists:categories,id',
    ]);

    try {
        DB::beginTransaction();

        // Create promotion
        $promotion = new \App\Models\Promotion();
        $promotion->name = $request->name;
        $promotion->type = $request->type;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->min_purchase = $request->min_purchase ?? 0;
        $promotion->usage_limit = $request->usage_limit ?? 0;
        $promotion->total_usage_limit = $request->total_usage_limit ?? 0;
        $promotion->is_active = $request->is_active;
        $promotion->description = $request->description;
        $promotion->terms = $request->terms;
        $promotion->product_scope = $request->product_scope;
        $promotion->created_by = Auth::id();

        // Set discount value based on type
        if ($request->type === 'percentage') {
            $promotion->discount_value = $request->discount_percentage;
            $promotion->max_discount = $request->max_discount;
        } elseif ($request->type === 'fixed') {
            $promotion->discount_value = $request->discount_amount;
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('promotions', 'public');
            $promotion->banner = $path;
        }

        $promotion->save();

        // Save applicable products
        if ($request->product_scope === 'selected' && $request->has('products')) {
            $promotion->products()->attach($request->products);
        }

        // Save applicable categories
        if ($request->product_scope === 'categories' && $request->has('categories')) {
            $promotion->categories()->attach($request->categories);
        }

        DB::commit();

        Log::info('Promotion created', [
            'promotion_id' => $promotion->id,
            'name' => $promotion->name,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion created successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Promotion creation error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->back()
            ->with('error', 'Failed to create promotion. Please try again.')
            ->withInput();
    }
}




/**
 * Get products list for AJAX.
 */
public function getProductsList()
{
    try {
        $products = Product::with('category')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => number_format($product->price, 2),
                    'category' => $product->category->name ?? 'Uncategorized',
                    'stock' => $product->stock,
                    'image' => $product->image ? Storage::url($product->image) : null
                ];
            });

        return response()->json([
            'success' => true,
            'products' => $products
        ]);

    } catch (\Exception $e) {
        Log::error('Error fetching products list: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch products'
        ], 500);
    }
}


    // /**
    //  * Show form to edit promotion.
    //  */
    // public function editPromotion($id)
    // {
    //     $promotion = Promotion::findOrFail($id);
    //     return view('admin.promotions.edit', compact('promotion'));
    // }




/**
 * Show edit promotion form.
 */
public function editPromotion($id)
{
    $user = Auth::user();
    $promotion = \App\Models\Promotion::with(['products', 'categories'])->findOrFail($id);
    
    // Get categories for filter
    $categories = \App\Models\Category::all();
    
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
    
    return view('admin.promotions.edit', compact(
        'user',
        'promotion',
        'categories',
        'unreadNotificationsCount',
        'unreadMessagesCount'
    ));
}

/**
 * Update a promotion.
 */
public function updatePromotion(Request $request, $id)
{
    $promotion = Promotion::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|unique:promotions,code,' . $id . '|max:50',
        'type' => 'required|in:percentage,fixed,bogo,free_shipping',
        'discount_percentage' => 'required_if:type,percentage|nullable|numeric|min:1|max:100',
        'discount_amount' => 'required_if:type,fixed|nullable|numeric|min:1',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'min_purchase' => 'nullable|numeric|min:0',
        'max_discount' => 'nullable|numeric|min:0',
        'usage_limit' => 'nullable|integer|min:0',
        'total_usage_limit' => 'nullable|integer|min:0',
        'is_active' => 'required|in:0,1',
        'description' => 'nullable|string',
        'terms' => 'nullable|string',
        'banner' => 'nullable|image|max:2048',
        'remove_banner' => 'nullable|in:1',
        'product_scope' => 'required|in:all,selected,categories',
        'products' => 'required_if:product_scope,selected|array',
        'products.*' => 'exists:products,id',
        'categories' => 'required_if:product_scope,categories|array',
        'categories.*' => 'exists:categories,id',
    ]);

    try {
        DB::beginTransaction();

        // Log the update attempt
        Log::info('Updating promotion', [
            'promotion_id' => $id,
            'data' => $request->except(['_token', '_method', 'banner'])
        ]);

        // Update promotion
        $promotion->name = $request->name;
        $promotion->code = strtoupper($request->code);
        $promotion->type = $request->type;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->min_purchase = $request->min_purchase ?? 0;
        $promotion->usage_limit_per_user = $request->usage_limit ?? 0;
        $promotion->total_usage_limit = $request->total_usage_limit ?? 0;
        $promotion->is_active = $request->is_active;
        $promotion->description = $request->description;
        $promotion->terms_conditions = $request->terms;
        $promotion->product_scope = $request->product_scope;

        // Set discount value based on type
        if ($request->type === 'percentage') {
            $promotion->value = $request->discount_percentage;
            $promotion->max_discount = $request->max_discount;
        } elseif ($request->type === 'fixed') {
            $promotion->value = $request->discount_amount;
            $promotion->max_discount = null;
        } else {
            $promotion->value = null;
            $promotion->max_discount = null;
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Log banner upload
            Log::info('Processing banner upload', [
                'original_name' => $request->file('banner')->getClientOriginalName(),
                'size' => $request->file('banner')->getSize()
            ]);

            // Delete old banner if exists
            if ($promotion->banner) {
                Storage::disk('public')->delete($promotion->banner);
                Log::info('Deleted old banner', ['path' => $promotion->banner]);
            }
            
            // Store new banner
            $path = $request->file('banner')->store('promotions', 'public');
            $promotion->banner = $path;
            Log::info('New banner uploaded', ['path' => $path]);

        } elseif ($request->has('remove_banner') && $request->remove_banner == '1' && $promotion->banner) {
            // Remove banner without uploading new one
            Storage::disk('public')->delete($promotion->banner);
            $promotion->banner = null;
            Log::info('Banner removed');
        }

        $promotion->save();
        Log::info('Promotion saved', ['promotion_id' => $promotion->id]);

        // Update applicable products
        $promotion->products()->detach();
        if ($request->product_scope === 'selected' && $request->has('products')) {
            $promotion->products()->attach($request->products);
            Log::info('Products attached', ['product_ids' => $request->products]);
        }

        // Update applicable categories
        $promotion->categories()->detach();
        if ($request->product_scope === 'categories' && $request->has('categories')) {
            $promotion->categories()->attach($request->categories);
            Log::info('Categories attached', ['category_ids' => $request->categories]);
        }

        DB::commit();

        Log::info('Promotion updated successfully', [
            'promotion_id' => $promotion->id,
            'name' => $promotion->name,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion updated successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        Log::error('Validation error in promotion update', [
            'errors' => $e->errors()
        ]);
        throw $e;

    } catch (\Illuminate\Database\QueryException $e) {
        DB::rollBack();
        Log::error('Database error in promotion update', [
            'message' => $e->getMessage(),
            'sql' => $e->getSql() ?? 'N/A',
            'bindings' => $e->getBindings() ?? []
        ]);
        
        return redirect()->back()
            ->with('error', 'Database error: ' . $e->getMessage())
            ->withInput();

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Promotion update error', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->back()
            ->with('error', 'Failed to update promotion: ' . $e->getMessage())
            ->withInput();
    }
}







    

    // /**
    //  * Update promotion.
    //  */
    // public function updatePromotion(Request $request, $id)
    // {
    //     $promotion = Promotion::findOrFail($id);

    //     $request->validate([
    //         'code' => 'required|string|unique:promotions,code,' . $promotion->id,
    //         'type' => 'required|in:fixed,percentage',
    //         'value' => 'required|numeric|min:0',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //         'usage_limit' => 'nullable|integer|min:1',
    //         'is_active' => 'boolean',
    //     ]);

    //     $promotion->update($request->all());

    //     return redirect()->route('admin.promotions')
    //         ->with('success', 'Promotion updated successfully.');
    // }

   /**
 * Delete a promotion.
 */
public function deletePromotion($id)
{
    try {
        $promotion = Promotion::findOrFail($id);
        
        // Log the deletion attempt
        Log::info('Attempting to delete promotion', [
            'promotion_id' => $id,
            'name' => $promotion->name
        ]);

        // Check if promotion has been used
        $usageCount = PromotionUsage::where('promotion_id', $id)->count();
        if ($usageCount > 0) {
            Log::warning('Cannot delete promotion that has been used', [
                'promotion_id' => $id,
                'usage_count' => $usageCount
            ]);
            
            return redirect()->back()
                ->with('error', 'Cannot delete promotion that has been used.');
        }
        
        DB::beginTransaction();
        
        // Delete banner image if exists
        if ($promotion->banner) {
            Storage::disk('public')->delete($promotion->banner);
            Log::info('Deleted promotion banner', ['path' => $promotion->banner]);
        }
        
        // Delete pivot relationships
        $promotion->products()->detach();
        $promotion->categories()->detach();
        
        $promotion->delete();
        
        DB::commit();
        
        Log::info('Promotion deleted successfully', [
            'promotion_id' => $id,
            'deleted_by' => Auth::id()
        ]);
        
        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion deleted successfully.');
            
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error deleting promotion', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'promotion_id' => $id
        ]);
        
        return redirect()->back()
            ->with('error', 'Failed to delete promotion: ' . $e->getMessage());
    }
}
    /**
     * ========================================================================
     * ROLES & PERMISSIONS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display roles listing.
     */
    public function roles()
    {
        // Implement when roles table is created
        return view('admin.roles.index');
    }

    /**
     * Show form to create role.
     */
    public function createRole()
    {
        return view('admin.roles.create');
    }

    /**
     * Store new role.
     */
    public function storeRole(Request $request)
    {
        // Implement when roles table is created
        return redirect()->route('admin.roles')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show form to edit role.
     */
    public function editRole($id)
    {
        // Implement when roles table is created
        return view('admin.roles.edit');
    }

    /**
     * Update role.
     */
    public function updateRole(Request $request, $id)
    {
        // Implement when roles table is created
        return redirect()->route('admin.roles')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Delete role.
     */
    public function deleteRole($id)
    {
        // Implement when roles table is created
        return redirect()->route('admin.roles')
            ->with('success', 'Role deleted successfully.');
    }

    /**
     * ========================================================================
     * NOTIFICATIONS MANAGEMENT
     * ========================================================================
     */

    /**
     * Display notifications.
     */
    public function notifications(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $notifications = $user->notifications()->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Mark notification as read.
     */
    public function markNotificationAsRead($id)
    {
        $user = Auth::guard('admin')->user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead()
    {
        $user = Auth::guard('admin')->user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * ========================================================================
     * MESSAGES MANAGEMENT
     * ========================================================================
     */

    /**
     * Display messages.
     */
    public function messages(Request $request)
    {
        // Implement when messages table is created
        return view('admin.messages.index');
    }

    /**
     * Display single message.
     */
    public function showMessage($id)
    {
        // Implement when messages table is created
        return view('admin.messages.show');
    }

    /**
     * Reply to message.
     */
    public function replyMessage(Request $request, $id)
    {
        // Implement when messages table is created
        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

    /**
     * ========================================================================
     * ANALYTICS & REPORTS
     * ========================================================================
     */

    /**
     * Display analytics.
     */
    public function analytics(Request $request)
    {
        $period = $request->get('period', 30);

        $salesData = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays($period))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $topVendors = User::where('role', 'vendor')
            ->withCount('followers')
            ->orderBy('followers_count', 'desc')
            ->limit(10)
            ->get();

        $topProducts = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(10)
            ->get();

        // Get unread counts for header
        $user = Auth::user();
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

        return view('admin.analytics.index', compact(
            'salesData', 
            'topVendors', 
            'topProducts', 
            'period',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Display reports.
     */
    public function reports(Request $request)
    {
        $type = $request->get('type', 'sales');
        $dateFrom = $request->get('date_from', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        return view('admin.reports.index', compact('type', 'dateFrom', 'dateTo'));
    }

    /**
     * Export report.
     */
    public function exportReport(Request $request)
    {
        $type = $request->get('type', 'sales');
        $format = $request->get('format', 'csv');
        $dateFrom = $request->get('date_from', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        // Implement export logic
        return redirect()->back()->with('success', 'Report exported successfully.');
    }

    /**
     * ========================================================================
     * AJAX ENDPOINTS
     * ========================================================================
     */

    /**
     * Search admins (AJAX endpoint)
     */
    public function searchAdmins(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([]);
        }

        $admins = Admin::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->select('id', 'name', 'email')
            ->limit(10)
            ->get();

        return response()->json($admins);
    }

    /**
     * Search vendors (AJAX endpoint)
     */
    public function searchVendors(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([]);
        }

        $vendors = User::where('role', 'vendor')
            ->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->select('id', 'business_name as name', 'email', 'city', 'state')
            ->limit(10)
            ->get();

        return response()->json($vendors);
    }

    /**
     * Search customers (AJAX endpoint)
     */
    public function searchCustomers(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([]);
        }

        $customers = User::where('role', 'customer')
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->select('id', 'name', 'email')
            ->limit(10)
            ->get();

        return response()->json($customers);
    }

    /**
     * Search orders (AJAX endpoint)
     */
    public function searchOrders(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([]);
        }

        $orders = Order::where('order_number', 'like', "%{$search}%")
            ->with('user')
            ->limit(10)
            ->get(['id', 'order_number', 'user_id', 'total_amount', 'status', 'created_at']);

        return response()->json($orders);
    }

    /**
     * Get admin statistics (AJAX endpoint for dashboard widgets)
     */
    public function getStats()
    {
        $stats = $this->adminService->getDashboardStats();

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get dashboard statistics for AJAX refresh.
     */
    public function getDashboardStats()
    {
        $stats = [
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount') ?? 0,
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_vendors' => User::where('role', 'vendor')->count(),
            'active_vendors' => User::where('role', 'vendor')->where('is_active', true)->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_products' => Product::count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get chart data for AJAX refresh (RENAMED to avoid conflict)
     */
    public function getChartDataAjax(Request $request)
    {
        $period = $request->get('period', 7);
        $chartData = $this->getChartData($period);

        return response()->json($chartData);
    }

    /**
     * ========================================================================
     * HELP & DOCUMENTATION
     * ========================================================================
     */

    /**
     * Display help page.
     */
    public function help()
    {
        return view('admin.help.index');
    }

    // /**
    //  * Display documentation.
    //  */
    // public function documentation()
    // {
    //     return view('admin.help.documentation');
    // }



    /**
 * Display documentation page.
 */
public function documentation()
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

    $version = '2.1.0';
    $lastUpdated = now()->format('F j, Y');

    return view('admin.help.documentation', compact(
        'user',
        'version',
        'lastUpdated',
        'unreadNotificationsCount',
        'unreadMessagesCount'
    ));
}



/**
 * Download documentation as PDF.
 */
public function downloadDocumentationPDF()
{
    $user = Auth::user();
    $version = '2.1.0';
    $lastUpdated = now()->format('F j, Y');

    $data = [
        'version' => $version,
        'lastUpdated' => $lastUpdated,
        'generatedAt' => now()->format('Y-m-d H:i:s')
    ];

    $pdf = Pdf::loadView('admin.documentation-pdf', $data);
    $pdf->setPaper('A4', 'portrait');
    $pdf->setOptions([
        'defaultFont' => 'sans-serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true
    ]);

    return $pdf->download('vendora-documentation-v' . $version . '.pdf');
}





    /**
     * ========================================================================
     * PROFILE & SETTINGS
     * ========================================================================
     */

    /**
     * Show admin profile
     */
    public function profile()
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access your profile.');
        }

        return view('admin.profile', compact('admin'));
    }

    /**
     * Update admin profile
     */
    public function updateProfile(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your profile.');
        }

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $admin->id,
            'phone'  => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $result = $this->adminService->updateAdmin($admin->id, $updateData);

        if ($result === 1) {
            return redirect()->route('admin.settings', ['section' => 'profile'])
                ->with('success', 'Profile updated successfully.');
        }

        return back()
            ->with('error', 'Failed to update profile. Please try again.')
            ->withInput($request->except('avatar'));
    }

    /**
     * Show the form for editing admin password.
     */
    public function editPassword()
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your password.');
        }

        return view('admin.password.update_password', compact('admin'));
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your password.');
        }

        $request->validate([
            'current_password'      => 'required|min:6',
            'new_password'          => 'required|min:8|confirmed|different:current_password',
        ]);

        // Verify current password
        if (!$this->adminService->verifyPassword($admin->id, $request->current_password)) {
            return back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->with('active_section', 'security');
        }

        // Update password
        $result = $this->adminService->updatePassword($admin->id, $request->new_password);

        if ($result === 1) {
            $this->adminService->logout();
            return redirect()->route('admin.login')
                ->with('success', 'Password updated successfully. Please login with your new password.');
        }

        return back()
            ->with('error', 'Failed to update password. Please try again.')
            ->with('active_section', 'security');
    }

    /**
     * Show admin settings page
     */
    public function settings(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access settings.');
        }

        $settings = session('admin_settings', []);
        $activeSection = $request->get('section', 'general');

        return view('admin.settings.index', compact('admin', 'settings', 'activeSection'));
    }

    /**
     * Update admin settings
     */
    public function updateSettings(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update settings.');
        }

        $section = $request->input('section', 'general');

        // Persist all submitted settings into session keyed by section
        $current = session('admin_settings', []);
        $current[$section] = $request->except(['_token', 'section']);
        session(['admin_settings' => $current]);

        return redirect()->route('admin.settings', ['section' => $section])
            ->with('success', 'Settings saved successfully.');
    }

    /**
     * ============================
     * SETTINGS AJAX ENDPOINTS
     * ============================
     */

    /**
     * Simple backup info for the settings page.
     */
    public function backupInfo()
    {
        try {
            $disk = Storage::disk('local');
            $disk->makeDirectory('backups');

            $files = collect($disk->files('backups'))
                ->filter(fn ($file) => Str::endsWith($file, ['.zip', '.sql', '.json', '.txt']))
                ->sortByDesc(fn ($file) => $disk->lastModified($file));

            if ($files->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'last_backup' => null,
                    'size' => '0 MB',
                    'next_backup' => null,
                    'location' => 'Local (storage/app/backups)',
                ]);
            }

            $latest = $files->first();
            $sizeBytes = $disk->size($latest) ?: 0;
            $sizeMb = round($sizeBytes / 1024 / 1024, 2);

            return response()->json([
                'success' => true,
                'last_backup' => Carbon::createFromTimestamp($disk->lastModified($latest))->toDayDateTimeString(),
                'size' => $sizeMb . ' MB',
                'next_backup' => null,
                'location' => 'Local (storage/app/backups)',
            ]);
        } catch (\Exception $e) {
            Log::error('backupInfo error: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * List available backup files.
     */
    public function backups()
    {
        try {
            $disk = Storage::disk('local');
            $disk->makeDirectory('backups');

            $files = collect($disk->files('backups'))
                ->filter(fn ($file) => Str::endsWith($file, ['.zip', '.sql', '.json', '.txt']))
                ->sortByDesc(fn ($file) => $disk->lastModified($file))
                ->map(function ($file) use ($disk) {
                    $name = basename($file);
                    $sizeBytes = $disk->size($file) ?: 0;
                    $sizeMb = round($sizeBytes / 1024 / 1024, 2);

                    return [
                        'filename' => $name,
                        'date' => Carbon::createFromTimestamp($disk->lastModified($file))->toDayDateTimeString(),
                        'size' => $sizeMb . ' MB',
                    ];
                })
                ->values()
                ->all();

            return response()->json([
                'success' => true,
                'backups' => $files,
            ]);
        } catch (\Exception $e) {
            Log::error('backups list error: ' . $e->getMessage());
            return response()->json(['success' => false, 'backups' => []], 500);
        }
    }

    /**
     * Create a very simple backup placeholder file.
     */
    public function createBackup()
    {
        try {
            $disk = Storage::disk('local');
            $disk->makeDirectory('backups');

            $filename = 'backup-' . now()->format('Y-m-d-H-i-s') . '.json';
            $payload = [
                'created_at' => now()->toDateTimeString(),
                'note' => 'Placeholder backup file. Implement full DB/files backup as needed.',
            ];

            $disk->put('backups/' . $filename, json_encode($payload, JSON_PRETTY_PRINT));

            return response()->json([
                'success' => true,
                'message' => 'Backup created successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('createBackup error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create backup.',
            ], 500);
        }
    }

    /**
     * Download latest backup.
     */
    public function downloadLatestBackup()
    {
        $disk = Storage::disk('local');
        $disk->makeDirectory('backups');

        $files = collect($disk->files('backups'))
            ->filter(fn ($file) => Str::endsWith($file, ['.zip', '.sql', '.json', '.txt']))
            ->sortByDesc(fn ($file) => $disk->lastModified($file));

        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No backups found.');
        }

        $latest = $files->first();
        return response()->download(storage_path('app/' . $latest));
    }

    /**
     * Download a specific backup file.
     */
    public function downloadBackupFile($filename)
    {
        $path = 'backups/' . $filename;
        if (!Storage::disk('local')->exists($path)) {
            return redirect()->back()->with('error', 'Backup file not found.');
        }

        return response()->download(storage_path('app/' . $path));
    }

    /**
     * Restore from an uploaded backup file (placeholder).
     */
    public function restoreBackup(Request $request)
    {
        $request->validate([
            'backup' => 'required|file',
        ]);

        try {
            $file = $request->file('backup');
            $stored = $file->storeAs('backups/restored', $file->getClientOriginalName(), 'local');

            Log::info('Backup file uploaded for restore', ['path' => $stored]);

            return response()->json([
                'success' => true,
                'message' => 'Backup uploaded. Implement full restore logic as needed.',
            ]);
        } catch (\Exception $e) {
            Log::error('restoreBackup error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore backup.',
            ], 500);
        }
    }

    /**
     * Restore from an existing backup file (placeholder).
     */
    public function restoreBackupFile($filename)
    {
        $path = 'backups/' . $filename;
        if (!Storage::disk('local')->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Backup file not found.',
            ], 404);
        }

        Log::info('Requested restore from backup file', ['path' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Backup restore request received. Implement full restore as needed.',
        ]);
    }

    /**
     * List API keys (simple in-memory store via cache).
     */
    public function listApiKeys()
    {
        $admin = Auth::user();
        $key = 'admin_api_keys_' . $admin->id;
        $keys = Cache::get($key, []);

        $formatted = collect($keys)->map(function ($item) {
            $preview = $item['key'];
            if (strlen($preview) > 12) {
                $preview = substr($preview, 0, 4) . '••••' . substr($preview, -4);
            }

            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'preview' => $preview,
                'created_at' => $item['created_at'],
                'last_used' => $item['last_used'] ?? null,
            ];
        })->values()->all();

        return response()->json([
            'success' => true,
            'keys' => $formatted,
        ]);
    }

    /**
     * Generate a new API key (stored in cache only).
     */
    public function generateApiKey()
    {
        $admin = Auth::user();
        $cacheKey = 'admin_api_keys_' . $admin->id;
        $keys = Cache::get($cacheKey, []);

        $rawKey = Str::random(40);
        $id = (string) Str::uuid();

        $keys[] = [
            'id' => $id,
            'name' => 'Key ' . (count($keys) + 1),
            'key' => $rawKey,
            'created_at' => now()->toDateTimeString(),
            'last_used' => null,
        ];

        Cache::put($cacheKey, $keys, now()->addDays(7));

        return response()->json([
            'success' => true,
            'message' => 'API key generated.',
        ]);
    }

    /**
     * Revoke an API key.
     */
    public function revokeApiKey($id)
    {
        $admin = Auth::user();
        $cacheKey = 'admin_api_keys_' . $admin->id;
        $keys = Cache::get($cacheKey, []);

        $filtered = collect($keys)
            ->reject(fn ($item) => $item['id'] == $id)
            ->values()
            ->all();

        Cache::put($cacheKey, $filtered, now()->addDays(7));

        return response()->json([
            'success' => true,
            'message' => 'API key revoked.',
        ]);
    }

    /**
     * List active sessions (current device only placeholder).
     */
    public function sessions()
    {
        $user = Auth::user();

        $sessions = [
            [
                'id' => session()->getId(),
                'device' => 'This device',
                'icon' => 'ri-computer-line',
                'last_active' => now()->toDayDateTimeString(),
                'is_current' => true,
            ],
        ];

        return response()->json([
            'success' => true,
            'sessions' => $sessions,
        ]);
    }

    /**
     * Terminate a session (placeholder, no-op for now).
     */
    public function terminateSession($id)
    {
        Log::info('Terminate session requested', [
            'requested_id' => $id,
            'current_session_id' => session()->getId(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Session terminated (placeholder).',
        ]);
    }

    /**
     * Logout from all other devices (placeholder).
     */
    public function logoutAllOtherSessions()
    {
        Log::info('Logout from all other devices requested', [
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logged out from other devices (placeholder).',
        ]);
    }

    /**
     * Send a test email using current mail settings.
     */
    public function sendTestEmail()
    {
        try {
            $user = Auth::user();
            $to = $user->email ?? config('mail.from.address');

            if (!$to) {
                return response()->json([
                    'success' => false,
                    'message' => 'No recipient email available.',
                ], 400);
            }

            Mail::raw('This is a Vendora admin test email.', function ($message) use ($to) {
                $message->to($to)
                    ->subject('Vendora Test Email');
            });

            return response()->json([
                'success' => true,
                'message' => 'Test email sent to ' . $to,
            ]);
        } catch (\Exception $e) {
            Log::error('sendTestEmail error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test email: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear application caches.
     */
    public function clearCache()
    {
        try {
            Artisan::call('optimize:clear');

            return response()->json([
                'success' => true,
                'message' => 'Application cache cleared.',
            ]);
        } catch (\Exception $e) {
            Log::error('clearCache error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cache.',
            ], 500);
        }
    }

    /**
     * Reset stored admin settings (session-based).
     */
    public function resetAllSettings()
    {
        session()->forget('admin_settings');

        return response()->json([
            'success' => true,
            'message' => 'Settings reset to defaults (session cleared).',
        ]);
    }

    /**
     * Delete current admin account after password confirmation.
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password is incorrect.',
            ], 422);
        }

        $userId = $user->id;
        Auth::logout();

        try {
            User::where('id', $userId)->delete();
        } catch (\Exception $e) {
            Log::error('deleteAccount error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete account.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully.',
        ]);
    }

    /**
     * ========================================================================
     * ADMIN MANAGEMENT
     * ========================================================================
     */

    /**
     * Display a listing of admins.
     */
    public function list(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $admins = $this->adminService->searchAdmins($search);
        } else {
            $admins = $this->adminService->getAllAdmins();
        }

        return view('admin.admins.index', compact('admins', 'search'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function createAdmin()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function storeAdmin(AdminCreateRequest $request)
    {
        // Check if email already exists
        if ($this->adminService->emailExists($request->email)) {
            return back()
                ->withErrors(['email' => 'The email address is already registered.'])
                ->withInput($request->except('password'));
        }

        $adminData = $request->validated();
        $admin = $this->adminService->createAdmin($adminData);

        if ($admin) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin created successfully.');
        }

        return back()
            ->with('error', 'Failed to create admin. Please try again.')
            ->withInput($request->except('password'));
    }

    /**
     * Display the specified admin.
     */
    public function show($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Prevent editing yourself if needed
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return redirect()->route('admin.profile')
                ->with('info', 'Please use the profile page to edit your own account.');
        }

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Check if email already exists (excluding current admin)
        if ($this->adminService->emailExists($request->email, $id)) {
            return back()
                ->withErrors(['email' => 'The email address is already registered.'])
                ->withInput($request->except('password'));
        }

        $updateData = $request->validated();

        // If password is empty, remove it from update data
        if (empty($updateData['password'])) {
            unset($updateData['password']);
        }

        $result = $this->adminService->updateAdmin($id, $updateData);

        if ($result === 1) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin updated successfully.');
        }

        return back()
            ->with('error', 'Failed to update admin. Please try again.')
            ->withInput($request->except('password'));
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Prevent deleting yourself
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'You cannot delete your own account.');
        }

        $result = $this->adminService->deleteAdmin($id);

        if ($result === 1) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin deleted successfully.');
        }

        return redirect()->route('admin.admins.list')
            ->with('error', 'Failed to delete admin. Please try again.');
    }

    /**
     * Change admin status (active/inactive)
     */
    public function changeStatus($id, Request $request)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found.'
            ], 404);
        }

        // Prevent changing your own status
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot change your own status.'
            ], 403);
        }

        $status = $request->get('status');
        $result = $this->adminService->changeAdminStatus($id, $status);

        if ($result === 1) {
            return response()->json([
                'success' => true,
                'message' => 'Admin status updated successfully.',
                'new_status' => $status
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update admin status.'
        ], 500);
    }

    /**
     * ========================================================================
     * VERIFICATION
     * ========================================================================
     */

    /**
     * Verify admin (if needed for authentication).
     */
    public function verify(Request $request)
    {
        return view('admin.verify');
    }

    /**
     * ========================================================================
     * SUPPORT TICKETS
     * ========================================================================
     */

    /**
     * List all support tickets with basic filters.
     */
    public function supportTickets(Request $request)
    {
        $status = $request->get('status');
        $priority = $request->get('priority');
        $search = $request->get('search');

        $query = SupportTicket::with(['user', 'assignedTo'])
            ->orderByDesc('created_at');

        if ($status) {
            $query->where('status', $status);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $tickets = $query->paginate(15);

        // Aggregate statistics by status for header cards
        $stats = [
            'open' => SupportTicket::where('status', 'open')->count(),
            'pending' => SupportTicket::where('status', 'pending')->count(),
            'resolved' => SupportTicket::where('status', 'resolved')->count(),
            'closed' => SupportTicket::where('status', 'closed')->count(),
        ];

        // Header context: current admin and unread counters
        $user = Auth::user();

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

        return view('admin.support-tickets.index', compact(
            'tickets',
            'status',
            'priority',
            'search',
            'stats',
            'user',
            'unreadNotificationsCount',
            'unreadMessagesCount'
        ));
    }

    /**
     * Show a single support ticket with replies.
     */
    public function showSupportTicket($id)
    {
        $ticket = SupportTicket::with(['user', 'assignedTo', 'replies.user'])->findOrFail($id);

        if (view()->exists('admin.support-tickets.show')) {
            return view('admin.support-tickets.show', compact('ticket'));
        }

        // Fallback to a very simple view if needed later
        return view('admin.support-tickets.index', [
            'tickets' => collect([$ticket]),
        ]);
    }

    /**
     * Add a reply to a support ticket.
     */
    public function replySupportTicket(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Optionally update ticket status when replying
        if ($ticket->status === 'open') {
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        return redirect()
            ->route('admin.support-tickets.show', $ticket->id)
            ->with('success', 'Reply added successfully.');
    }

    /**
     * Update support ticket status.
     */
    public function updateSupportTicketStatus(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:open,in_progress,resolved,closed',
        ]);

        $ticket->status = $request->status;
        if (in_array($request->status, ['resolved', 'closed'], true)) {
            $ticket->resolved_at = now();
        }
        $ticket->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket status updated successfully.',
                'status' => $ticket->status,
            ]);
        }

        return redirect()
            ->route('admin.support-tickets.show', $ticket->id)
            ->with('success', 'Ticket status updated successfully.');
    }

    

/**
 * ========================================================================
 * VIDEO TUTORIALS MANAGEMENT
 * ========================================================================
 */

/**
 * Display video tutorials page.
 */
public function videoTutorials(Request $request)
{
    $user = Auth::user();
    $category = $request->get('category', 'all');
    $search = $request->get('search');
    
    $query = VideoTutorial::where('is_published', true);
    
    if ($category !== 'all') {
        $query->where('category', $category);
    }
    
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('tags', 'like', "%{$search}%");
        });
    }
    
    $videos = $query->orderBy('sort_order')
                    ->orderBy('created_at', 'desc')
                    ->paginate(12);
    
    $featuredVideos = VideoTutorial::where('is_featured', true)
                                   ->where('is_published', true)
                                   ->orderBy('sort_order')
                                   ->limit(6)
                                   ->get();
    
    $categories = VideoTutorial::where('is_published', true)
                               ->select('category')
                               ->distinct()
                               ->pluck('category');
    
    $stats = [
        'total' => VideoTutorial::where('is_published', true)->count(),
        'featured' => VideoTutorial::where('is_featured', true)->where('is_published', true)->count(),
        'categories' => $categories->count(),
    ];
    
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
    
    return view('admin.video-tutorials', compact(
        'videos', 
        'featuredVideos', 
        'categories', 
        'stats', 
        'category', 
        'search', 
        'user', 
        'unreadNotificationsCount', 
        'unreadMessagesCount'
    ));
}

/**
 * Get video details for AJAX
 */
public function getVideoDetails($id)
{
    try {
        $video = VideoTutorial::findOrFail($id);
        $video->increment('views_count');
        
        return response()->json([
            'success' => true,
            'video' => $video
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Video not found'
        ], 404);
    }
}

/**
 * Get related videos
 */
public function getRelatedVideos($id)
{
    try {
        $video = VideoTutorial::findOrFail($id);
        
        $related = VideoTutorial::where('is_published', true)
            ->where('id', '!=', $id)
            ->where(function($q) use ($video) {
                $q->where('category', $video->category)
                  ->orWhereJsonContains('tags', $video->tags);
            })
            ->orderBy('views_count', 'desc')
            ->limit(4)
            ->get();
        
        return response()->json([
            'success' => true,
            'videos' => $related
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error loading related videos'
        ], 500);
    }
}
}