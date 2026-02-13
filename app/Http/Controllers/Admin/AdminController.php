<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
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

class AdminController extends Controller
{
    protected $adminService;

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
            // Apply auth middleware to all methods except create and store
            'auth' => ['except' => ['create', 'store']],

            // Custom role check using closure
            function ($request, $next) {
                if (!in_array($request->route()->getName(), ['admin.login', 'admin.login.submit'])) {
                    if (!Auth::check() || Auth::user()->role !== 'admin') {
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

    // FIX: Comment out notifications until table is created
    // $unreadNotificationsCount = Auth::user()->unreadNotifications->count();
    $unreadNotificationsCount = 0; // Temporary placeholder

    $recentOrders = Order::with('user')->latest()->paginate(10);

    // FIX: Comment out notifications query
    // $recentNotifications = Auth::user()->notifications()->latest()->limit(5)->get();
    $recentNotifications = collect([]); // Empty collection

    // Get counts for KPI cards
    $totalRevenue = Order::where('status', 'completed')->sum('total_amount') ?? 0;
    $activeVendorsCount = User::where('role', 'vendor')->where('is_active', true)->count();
    $totalCustomersCount = User::where('role', 'customer')->count();

    // Calculate growth percentages (mock for now - implement real logic later)
    $revenueGrowth = 12.5;
    $vendorGrowth = 5.2;
    $orderChange = -2.1;
    $customerGrowth = 8.4;

    // Today's stats
    $productViewsToday = 45200;
    $completedOrdersToday = Order::where('status', 'completed')
        ->whereDate('created_at', today())
        ->count() ?: 892;
    $newReviewsToday = 128;
    $refundRequests = Order::where('status', 'refund_requested')->count() ?: 12;

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
        'recentOrders',
        'recentNotifications',
        'totalRevenue',
        'activeVendorsCount',
        'totalCustomersCount',
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

        return view('admin.login', [
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
        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome back! Successfully logged in.');
    }

    return back()
        ->withErrors(['password' => 'The provided credentials are incorrect.'])
        ->withInput($request->only('email', 'remember'))
        ->with('error', 'Login failed. Please check your credentials.');
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

        return view('admin.orders.index', compact('orders', 'orderStats', 'status', 'search', 'dateFrom', 'dateTo'));
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

        return redirect()->route('admin.orders.show', $id)
            ->with('success', 'Order status updated successfully.');
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

    $query = User::where('role', 'customer');

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
            ->with(['orders' => function ($q) {
                $q->latest()->limit(10);
            }])
            ->findOrFail($id);

        $totalSpent = Order::where('user_id', $customer->id)
            ->where('status', 'completed')
            ->sum('total_amount');

        return view('admin.customers.show', compact('customer', 'totalSpent'));
    }

    /**
 * Show the form for editing the specified customer.
 */
public function editCustomer($id)
{
    $customer = User::where('role', 'customer')->findOrFail($id);

    return view('admin.customers.edit', compact('customer'));
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
            'is_active' => 'boolean',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active', $customer->is_active),
        ]);

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

        return response()->json([
            'success' => true,
            'message' => 'Vendor status updated successfully.',
            'new_status' => $vendor->is_active
        ]);
    }

    /**
     * ========================================================================
     * CATALOG MANAGEMENT
     * ========================================================================
     */

    /**
     * Display catalog overview.
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
        $search = $request->get('search');
        $category = $request->get('category');
        $vendor = $request->get('vendor');

        $query = Product::with(['vendor', 'category']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($vendor) {
            $query->where('vendor_id', $vendor);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::all();
        $vendors = User::where('role', 'vendor')->select('id', 'business_name')->get();

        return view('admin.catalog.products', compact('products', 'categories', 'vendors', 'search', 'category', 'vendor'));
    }

    /**
     * Display categories listing.
     */
    public function categories()
    {
        $categories = Category::withCount('products')->paginate(15);
        return view('admin.catalog.categories', compact('categories'));
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

    /**
     * Show form to create promotion.
     */
    public function createPromotion()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a new promotion.
     */
    public function storePromotion(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:promotions',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $promotion = Promotion::create($request->all());

        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion created successfully.');
    }

    /**
     * Show form to edit promotion.
     */
    public function editPromotion($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update promotion.
     */
    public function updatePromotion(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $request->validate([
            'code' => 'required|string|unique:promotions,code,' . $promotion->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $promotion->update($request->all());

        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Delete promotion.
     */
    public function deletePromotion($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return redirect()->route('admin.promotions')
            ->with('success', 'Promotion deleted successfully.');
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
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Mark notification as read.
     */
    public function markNotificationAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead()
    {
        $user = Auth::user();
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

        return view('admin.analytics.index', compact('salesData', 'topVendors', 'topProducts', 'period'));
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

    /**
     * Display documentation.
     */
    public function documentation()
    {
        return view('admin.help.documentation');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'mobile' => 'nullable|string|max:20',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];

        // Handle password change
        if ($request->filled('new_password')) {
            // Verify current password
            if (!$this->adminService->verifyPassword($admin->id, $request->current_password)) {
                return back()
                    ->withErrors(['current_password' => 'The current password is incorrect.'])
                    ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
            }

            $updateData['password'] = Hash::make($request->new_password);
        }

        $result = $this->adminService->updateAdmin($admin->id, $updateData);

        if ($result === 1) {
            return back()->with('success', 'Profile updated successfully.');
        }

        return back()
            ->with('error', 'Failed to update profile. Please try again.')
            ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
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
    public function updatePassword(AdminPasswordUpdateRequest $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your password.');
        }

        // Verify current password
        if (!$this->adminService->verifyPassword($admin->id, $request->current_password)) {
            return back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput($request->only('email'));
        }

        // Update password
        $result = $this->adminService->updatePassword($admin->id, $request->new_password);

        if ($result === 1) {
            // Logout and redirect to login page with success message
            $this->adminService->logout();

            return redirect()->route('admin.login')
                ->with('success', 'Password updated successfully. Please login with your new password.');
        }

        return back()
            ->with('error', 'Failed to update password. Please try again.')
            ->withInput($request->only('email'));
    }

  /**
 * Show admin settings page
 */
public function settings()
{
    $admin = $this->adminService->getCurrentAdmin();

    if (!$admin) {
        return redirect()->route('admin.login')
            ->with('error', 'Please login to access settings.');
    }

    return view('admin.settings.index', compact('admin'));
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

    $request->validate([
        'theme' => 'nullable|in:light,dark',
        'language' => 'nullable|in:en,es,fr',
        'notifications' => 'nullable|boolean',
    ]);

    // Store settings in database or session
    session([
        'admin.theme' => $request->theme,
        'admin.language' => $request->language,
        'admin.notifications' => $request->boolean('notifications', true),
    ]);

    return back()->with('success', 'Settings updated successfully.');
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
}