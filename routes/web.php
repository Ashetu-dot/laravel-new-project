<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\VendorCustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// =========================================================================
// PUBLIC ROUTES
// =========================================================================

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// =========================================================================
// STATIC PAGES
// =========================================================================
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy.policy');
Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms.service');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// =========================================================================
// PUBLIC VENDOR SEARCH & PROFILES
// =========================================================================

// Vendor search and listing
Route::get('/search', [VendorCustomerController::class, 'search'])->name('search.results');
Route::get('/vendors/search', [VendorCustomerController::class, 'searchVendors'])->name('vendors.search');
Route::get('/vendors/{id}', [VendorCustomerController::class, 'showVendor'])->name('vendor.show');

// AJAX endpoint for getting vendor details
Route::get('/vendors/{id}/details', [VendorCustomerController::class, 'getVendor'])->name('vendors.get');

// =========================================================================
// AUTHENTICATION ROUTES (Guest only)
// =========================================================================

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [VendorCustomerController::class, 'index'])->name('login');
    Route::post('/login', [VendorCustomerController::class, 'store'])->name('login.authenticate');

    // Vendor Registration (Multi-step)
    Route::get('/register', [VendorCustomerController::class, 'create'])->name('register');
    Route::post('/register', [VendorCustomerController::class, 'register'])->name('vendor.register');

    // Customer Registration
    Route::get('/register/customer', [VendorCustomerController::class, 'showCustomerRegister'])->name('register.customer');
    Route::post('/register/customer', [VendorCustomerController::class, 'registerCustomer'])->name('customer.register');

    // Password Reset
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [VendorCustomerController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [VendorCustomerController::class, 'resetPassword'])
        ->name('password.update');
});

// =========================================================================
// AUTHENTICATED ROUTES (Common for all users)
// =========================================================================

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [VendorCustomerController::class, 'logout'])->name('logout');

    // Multi-step form persistence (for vendors)
    Route::post('/vendor/registration/step', [VendorCustomerController::class, 'saveStep'])->name('vendor.registration.step');

    // Profile routes (users can only access their own profile)
    Route::get('/profile/{id}', [VendorCustomerController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [VendorCustomerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [VendorCustomerController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [VendorCustomerController::class, 'destroy'])->name('profile.destroy');

    // Follow/Unfollow vendors
    Route::post('/vendor/{id}/follow', [VendorCustomerController::class, 'follow'])->name('vendor.follow');
    Route::post('/vendor/{id}/unfollow', [VendorCustomerController::class, 'unfollow'])->name('vendor.unfollow');
});

// =========================================================================
// EMAIL VERIFICATION ROUTES (MustVerifyEmail)
// =========================================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VendorCustomerController::class, 'verificationNotice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        // Redirect based on user role after verification
        $user = Auth::user();
        if ($user->role === 'vendor') {
            return redirect()->route('vendor.dashboard')->with('success', 'Email verified successfully!');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Email verified successfully!');
        }
        return redirect()->route('customer.dashboard')->with('success', 'Email verified successfully!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [VendorCustomerController::class, 'resendVerification'])
        ->middleware(['throttle:6,1'])->name('verification.send');
});

// =========================================================================
// DASHBOARD ROUTES (Verified only, role-specific)
// =========================================================================

Route::middleware(['auth', 'verified'])->group(function () {
    // Vendor dashboard
    Route::get('/vendor/dashboard', [VendorCustomerController::class, 'vendorDashboard'])
        ->name('vendor.dashboard')
        ->middleware('role:vendor');

    // Customer dashboard
    Route::get('/customer/dashboard', [VendorCustomerController::class, 'customerDashboard'])
        ->name('customer.dashboard')
        ->middleware('role:customer');
});

// =========================================================================
// COMPLETE VENDOR ROUTES
// =========================================================================
Route::middleware(['auth', 'verified', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    
    // ======== VENDOR DASHBOARD & STORE ========
    Route::get('/dashboard', [VendorCustomerController::class, 'vendorDashboard'])->name('dashboard');
    Route::get('/store/{id}', [VendorCustomerController::class, 'showVendor'])->name('store'); // FIXES YOUR ERROR
    
    // ======== ORDERS MANAGEMENT ========
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::get('/orders-list', [OrderController::class, 'getOrders'])->name('orders.list');
    
    // ======== PRODUCTS MANAGEMENT ========
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Product status updates
    Route::patch('/products/{id}/activate', [ProductController::class, 'activate'])->name('products.activate');
    Route::patch('/products/{id}/deactivate', [ProductController::class, 'deactivate'])->name('products.deactivate');
    Route::post('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    
    // Bulk product actions
    Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
    Route::patch('/products/bulk-activate', [ProductController::class, 'bulkActivate'])->name('products.bulk-activate');
    Route::patch('/products/bulk-deactivate', [ProductController::class, 'bulkDeactivate'])->name('products.bulk-deactivate');
    
    // AJAX endpoints for products
    Route::get('/products-list', [ProductController::class, 'getVendorProducts'])->name('products.list');
    
    // ======== CATEGORIES MANAGEMENT ========
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories-list', [CategoryController::class, 'getCategories'])->name('categories.list');
    
    // ======== ANALYTICS ========
    Route::get('/sales-report', [VendorController::class, 'salesReport'])->name('sales-report');
    Route::get('/store-views', [VendorController::class, 'storeViews'])->name('store-views');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews-stats', [ReviewController::class, 'getStats'])->name('reviews.stats');
    
    // ======== SETTINGS ========
    Route::get('/profile', [VendorCustomerController::class, 'show'])->name('profile');
    Route::get('/settings', [VendorCustomerController::class, 'edit'])->name('settings');
    Route::post('/settings', [VendorCustomerController::class, 'updateSettings'])->name('settings.update');
    Route::post('/password', [VendorCustomerController::class, 'updatePassword'])->name('password.update');
    
    // ======== NOTIFICATIONS & MESSAGES ========
    Route::get('/notifications', [VendorController::class, 'notifications'])->name('notifications');
    Route::get('/messages', [VendorController::class, 'messages'])->name('messages');
});

// =========================================================================
// ADMIN ROUTES
// =========================================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest admin routes (login only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'create'])->name('login');
        Route::post('/login', [AdminController::class, 'store'])->name('login.submit');
    });

    // Protected admin routes
    Route::middleware(['auth'])->group(function () {

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/search', [AdminController::class, 'search'])->name('search');

        // ======== ORDERS MANAGEMENT ========
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
        Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

        // ======== CUSTOMERS MANAGEMENT ========
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('customers.delete');

        // ======== VENDORS MANAGEMENT ========
        Route::get('/vendors', [AdminController::class, 'vendors'])->name('vendors');
        Route::get('/vendors/{id}', [AdminController::class, 'showVendor'])->name('vendors.show');
        Route::get('/vendors/{id}/edit', [AdminController::class, 'editVendor'])->name('vendors.edit');
        Route::put('/vendors/{id}', [AdminController::class, 'updateVendor'])->name('vendors.update');
        Route::delete('/vendors/{id}', [AdminController::class, 'deleteVendor'])->name('vendors.delete');
        Route::post('/vendors/{id}/verify', [AdminController::class, 'verifyVendor'])->name('vendors.verify');
        Route::post('/vendors/{id}/status', [AdminController::class, 'changeVendorStatus'])->name('vendors.status');

        // ======== CATALOG MANAGEMENT ========
        Route::get('/catalog', [AdminController::class, 'catalog'])->name('catalog');
        Route::get('/catalog/products', [AdminController::class, 'products'])->name('catalog.products');
        Route::get('/catalog/categories', [AdminController::class, 'categories'])->name('catalog.categories');

        // ======== INVENTORY MANAGEMENT ========
        Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
        Route::get('/inventory/low-stock', [AdminController::class, 'lowStock'])->name('inventory.low-stock');
        Route::post('/inventory/{product}/restock', [AdminController::class, 'restock'])->name('inventory.restock');

        // ======== PROMOTIONS MANAGEMENT ========
        Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
        Route::get('/promotions/create', [AdminController::class, 'createPromotion'])->name('promotions.create');
        Route::post('/promotions', [AdminController::class, 'storePromotion'])->name('promotions.store');
        Route::get('/promotions/{id}/edit', [AdminController::class, 'editPromotion'])->name('promotions.edit');
        Route::put('/promotions/{id}', [AdminController::class, 'updatePromotion'])->name('promotions.update');
        Route::delete('/promotions/{id}', [AdminController::class, 'deletePromotion'])->name('promotions.delete');

        // ======== ADMIN PROFILE & SETTINGS ========
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password', [AdminController::class, 'editPassword'])->name('password.edit');
        Route::post('/password', [AdminController::class, 'updatePassword'])->name('password.update');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        // ======== ADMIN MANAGEMENT (Super Admin only) ========
        Route::middleware('permission:manage-admins')->group(function () {
            Route::get('/admins', [AdminController::class, 'list'])->name('admins.list');
            Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
            Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
            Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admins.show');
            Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
            Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
            Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
            Route::post('/admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.status');
        });

        // ======== ROLES & PERMISSIONS ========
        Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
        Route::get('/roles/create', [AdminController::class, 'createRole'])->name('roles.create');
        Route::post('/roles', [AdminController::class, 'storeRole'])->name('roles.store');
        Route::get('/roles/{id}/edit', [AdminController::class, 'editRole'])->name('roles.edit');
        Route::put('/roles/{id}', [AdminController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{id}', [AdminController::class, 'deleteRole'])->name('roles.delete');

        // ======== NOTIFICATIONS ========
        Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
        Route::post('/notifications/{id}/read', [AdminController::class, 'markNotificationAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [AdminController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');

        // ======== MESSAGES ========
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
        Route::get('/messages/{id}', [AdminController::class, 'showMessage'])->name('messages.show');
        Route::post('/messages/{id}/reply', [AdminController::class, 'replyMessage'])->name('messages.reply');

        // ======== HELP & SUPPORT ========
        Route::get('/help', [AdminController::class, 'help'])->name('help');
        Route::get('/documentation', [AdminController::class, 'documentation'])->name('documentation');

        // ======== ANALYTICS & STATISTICS ========
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/reports/export', [AdminController::class, 'exportReport'])->name('reports.export');

        // ======== SYSTEM VERIFICATION ========
        Route::get('/verify', [AdminController::class, 'verify'])->name('verify');

        // ======== AJAX ENDPOINTS ========
        Route::prefix('ajax')->name('ajax.')->group(function () {
            Route::get('/admins-search', [AdminController::class, 'searchAdmins'])->name('admins.search');
            Route::get('/vendors-search', [AdminController::class, 'searchVendors'])->name('vendors.search');
            Route::get('/customers-search', [AdminController::class, 'searchCustomers'])->name('customers.search');
            Route::get('/orders-search', [AdminController::class, 'searchOrders'])->name('orders.search');
            Route::get('/stats', [AdminController::class, 'getStats'])->name('stats');
            Route::get('/dashboard-stats', [AdminController::class, 'getDashboardStats'])->name('dashboard.stats');
            Route::get('/chart-data', [AdminController::class, 'getChartDataAjax'])->name('chart.data');
        });
    });
});

// =========================================================================
// FALLBACK ROUTE (404 handling)
// =========================================================================

Route::fallback(function () {
    return view('errors.404');
});