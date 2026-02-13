<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\VendorCustomerController;

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
// VENDOR & CUSTOMER AUTHENTICATION
// =========================================================================

// Guest only routes (redirect if authenticated)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [VendorCustomerController::class, 'index'])->name('login');
    Route::post('/login', [VendorCustomerController::class, 'store'])->name('login.authenticate');

    // Registration
    Route::get('/register', [VendorCustomerController::class, 'create'])->name('register');
    Route::post('/register', [VendorCustomerController::class, 'register'])->name('vendor.register');
});

// Authenticated routes (both vendors and customers)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [VendorCustomerController::class, 'logout'])->name('logout');

    // Multi-step form persistence
    Route::post('/vendor/registration/step', [VendorCustomerController::class, 'saveStep'])->name('vendor.registration.step');

    // Profile routes (users can only access their own profile)
    Route::get('/profile/{id}', [VendorCustomerController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [VendorCustomerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [VendorCustomerController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [VendorCustomerController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// EMAIL VERIFICATION ROUTES (MustVerifyEmail)
// =========================================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home')->with('success', 'Email verified successfully!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// =========================================================================
// VENDOR & CUSTOMER DASHBOARDS (Verified only)
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

    // Vendor specific routes
    Route::prefix('vendor')->name('vendor.')->middleware('role:vendor')->group(function () {
        Route::post('/settings', [VendorCustomerController::class, 'updateSettings'])->name('settings.update');
        Route::post('/password', [VendorCustomerController::class, 'updatePassword'])->name('password.update');
    });
});

// =========================================================================
// PUBLIC VENDOR SEARCH & PROFILES
// =========================================================================

// Vendor search and listing
Route::get('/search', [VendorCustomerController::class, 'search'])->name('search.results');
Route::get('/vendors/search', [VendorCustomerController::class, 'searchVendors'])->name('vendors.search');
Route::get('/vendors/{id}', [VendorCustomerController::class, 'showVendor'])->name('vendor.show');

// Follow/Unfollow (requires authentication)
Route::middleware('auth')->group(function () {
    Route::post('/vendor/{id}/follow', [VendorCustomerController::class, 'follow'])->name('vendor.follow');
    Route::post('/vendor/{id}/unfollow', [VendorCustomerController::class, 'unfollow'])->name('vendor.unfollow');
});

// AJAX endpoint for getting vendor details
Route::get('/vendors/{id}/details', [VendorCustomerController::class, 'getVendor'])->name('vendors.get');

// =========================================================================
// ADMIN ROUTES
// =========================================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest admin routes
    Route::middleware('guest')->group(function () {
    
    
    // Guest admin routes (no middleware needed here - controller handles it)
    Route::get('/login', [AdminController::class, 'create'])->name('login');
    Route::post('/login', [AdminController::class, 'store'])->name('login.submit');
    
    });

    // Protected admin routes - WITHOUT middleware first
    Route::middleware(['auth'])->group(function () {

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/search', [AdminController::class, 'search'])->name('search');
        
        // ======== MANAGEMENT ROUTES ========

        // Orders Management
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
        Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

        // Customers Management
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('customers.edit'); 
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('customers.delete');

        // Vendors Management
        Route::get('/vendors', [AdminController::class, 'vendors'])->name('vendors');
        Route::get('/vendors/{id}', [AdminController::class, 'showVendor'])->name('vendors.show');
        Route::put('/vendors/{id}', [AdminController::class, 'updateVendor'])->name('vendors.update');
        Route::delete('/vendors/{id}', [AdminController::class, 'deleteVendor'])->name('vendors.delete');
        Route::post('/vendors/{id}/verify', [AdminController::class, 'verifyVendor'])->name('vendors.verify');
        Route::post('/vendors/{id}/status', [AdminController::class, 'changeVendorStatus'])->name('vendors.status');

        // Catalog Management
        Route::get('/catalog', [AdminController::class, 'catalog'])->name('catalog');
        Route::get('/catalog/products', [AdminController::class, 'products'])->name('catalog.products');
        Route::get('/catalog/categories', [AdminController::class, 'categories'])->name('catalog.categories');
        
         // ======== INVENTORY MANAGEMENT ========
        Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
        Route::get('/inventory/low-stock', [AdminController::class, 'lowStock'])->name('inventory.low-stock');
        Route::post('/inventory/{product}/restock', [AdminController::class, 'restock'])->name('inventory.restock');

        // Promotions Management
        Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
        Route::get('/promotions/create', [AdminController::class, 'createPromotion'])->name('promotions.create');
        Route::post('/promotions', [AdminController::class, 'storePromotion'])->name('promotions.store');
        Route::get('/promotions/{id}/edit', [AdminController::class, 'editPromotion'])->name('promotions.edit');
        Route::put('/promotions/{id}', [AdminController::class, 'updatePromotion'])->name('promotions.update');
        Route::delete('/promotions/{id}', [AdminController::class, 'deletePromotion'])->name('promotions.delete');

        // ======== ADMIN PROFILE & SETTINGS ========

        // Admin Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

        // Password Management
        Route::get('/password', [AdminController::class, 'editPassword'])->name('password.edit');
        Route::post('/password', [AdminController::class, 'updatePassword'])->name('password.update');

        // Settings
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
       // ======== AJAX ENDPOINTS ========
        Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('/admins-search', [AdminController::class, 'searchAdmins'])->name('admins.search');
        Route::get('/vendors-search', [AdminController::class, 'searchVendors'])->name('vendors.search');
        Route::get('/customers-search', [AdminController::class, 'searchCustomers'])->name('customers.search');
        Route::get('/orders-search', [AdminController::class, 'searchOrders'])->name('orders.search');
        Route::get('/stats', [AdminController::class, 'getStats'])->name('stats');
        Route::get('/dashboard-stats', [AdminController::class, 'getDashboardStats'])->name('dashboard.stats');
        Route::get('/chart-data', [AdminController::class, 'getChartDataAjax'])->name('chart.data'); // ← FIXED
        });
        });
    });

// =========================================================================
// FALLBACK ROUTE (404 handling)
// =========================================================================

Route::fallback(function () {
    return view('errors.404');
});