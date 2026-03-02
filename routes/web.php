<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\VendorCustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ConfirmationController;
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

// Homepage with dynamic stats
Route::get('/', [VendorCustomerController::class, 'home'])->name('home');

// =========================================================================
// STATIC PAGES
// =========================================================================
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');
Route::get('/about', [VendorCustomerController::class, 'about'])->name('about');
Route::get('/cookie-policy', [VendorCustomerController::class, 'cookiePolicy'])->name('cookie-policy');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/contact', [VendorCustomerController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [VendorCustomerController::class, 'contactSubmit'])->name('contact.submit');


// Theme routes
Route::post('/toggle-theme', [ThemeController::class, 'toggle'])->name('theme.toggle');
Route::get('/get-theme', [ThemeController::class, 'getTheme'])->name('theme.get');

// Language switcher
Route::post('/switch-language', [LanguageController::class, 'switch'])->name('language.switch');

// Careers
Route::get('/careers', [VendorCustomerController::class, 'careers'])->name('careers');
Route::post('/careers/apply', [VendorCustomerController::class, 'apply'])->name('careers.apply');

// Blog
Route::get('/blog', [VendorCustomerController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [VendorCustomerController::class, 'blogPost'])->name('blog.post');
Route::post('/blog/subscribe', [VendorCustomerController::class, 'blogSubscribe'])->name('blog.subscribe');

// Press
Route::get('/press', [VendorCustomerController::class, 'press'])->name('press');
Route::post('/press/subscribe', [VendorCustomerController::class, 'pressSubscribe'])->name('press.subscribe');

// Trust & Safety
Route::get('/trust-safety', [VendorCustomerController::class, 'trustSafety'])->name('trust-safety');
Route::post('/safety/report', [VendorCustomerController::class, 'safetyReport'])->name('safety.report');

// Help Center
Route::get('/help-center', [VendorCustomerController::class, 'helpCenter'])->name('help-center');
Route::get('/help-center/search', [VendorCustomerController::class, 'helpSearch'])->name('help.search');
Route::get('/help-center/article/{slug}', [VendorCustomerController::class, 'helpArticle'])->name('help.article');

// Invite Friends
Route::get('/invite', [VendorCustomerController::class, 'invite'])->name('invite');
Route::post('/invite/send', [VendorCustomerController::class, 'sendInvite'])->name('invite.send');

// How it works
Route::get('/how-it-works', [VendorCustomerController::class, 'howItWorks'])->name('how-it-works');

// Features
Route::get('/features', [VendorCustomerController::class, 'features'])->name('features');

// List Service
Route::get('/list-service', [VendorCustomerController::class, 'listService'])->name('list-service');

// Vendor Resources
Route::get('/vendor-resources', [VendorCustomerController::class, 'vendorResources'])->name('vendor-resources');

// Success Stories
Route::get('/success-stories', [VendorCustomerController::class, 'successStories'])->name('success-stories');

// Community
Route::get('/community', [VendorCustomerController::class, 'community'])->name('community');

// =========================================================================
// PUBLIC VENDOR SEARCH & PROFILES
// =========================================================================

// Vendor search and listing
Route::get('/compare', [VendorController::class, 'compare'])->name('vendors.compare');
Route::get('/vendors/{vendor}/quick-view', [VendorCustomerController::class, 'quickView'])->name('vendor.quick-view');
Route::get('/search', [VendorCustomerController::class, 'search'])->name('search.results');
Route::get('/vendors/search', [VendorCustomerController::class, 'searchVendors'])->name('vendors.search');
Route::get('/vendors/{id}', [VendorCustomerController::class, 'showVendor'])->name('vendor.show');
Route::get('/vendors/{id}/details', [VendorCustomerController::class, 'getVendor'])->name('vendors.get');

// =========================================================================
// AUTHENTICATION ROUTES (Guest only)
// =========================================================================

Route::middleware('guest')->group(function () {
    // Main Login (Customer/Vendor)
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.authenticate');

    // Admin Login
    Route::get('/admin/login', [AdminController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login.submit');

    // Registration
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('vendor.register');

    // Customer Registration
    Route::get('/register/customer', [RegisterController::class, 'showCustomerRegister'])->name('register.customer');
    Route::post('/register/customer', [RegisterController::class, 'registerCustomer'])->name('customer.register');

    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// =========================================================================
// AJAX ROUTES (For real-time validation)
// =========================================================================
Route::post('/check-email-exists', [RegisterController::class, 'checkEmailExists'])->name('check.email');

// Test route - REMOVE IN PRODUCTION
Route::get('/verify-email/{email}', [RegisterController::class, 'manuallyVerifyEmail']);
// =========================================================================
// AUTHENTICATED ROUTES (Common for all users)
// =========================================================================

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Multi-step form persistence (for vendors)
    Route::post('/vendor/registration/step', [RegisterController::class, 'saveStep'])->name('vendor.registration.step');

    // Profile routes (users can only access their own profile)
    Route::get('/profile/{id}', [VendorCustomerController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [VendorCustomerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [VendorCustomerController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [VendorCustomerController::class, 'destroy'])->name('profile.destroy');

    // Follow/Unfollow vendors
    Route::post('/vendor/{id}/follow', [VendorCustomerController::class, 'follow'])->name('vendor.follow');
    Route::delete('/vendor/{id}/unfollow', [VendorCustomerController::class, 'unfollow'])->name('vendor.unfollow');

    // AJAX endpoints for follow/unfollow
    Route::post('/vendors/{vendor}/follow', [VendorCustomerController::class, 'followVendor'])->name('vendor.follow.ajax');
    Route::delete('/vendors/{vendor}/unfollow', [VendorCustomerController::class, 'unfollowVendor'])->name('vendor.unfollow.ajax');

    // Save/Unsave vendors
    Route::post('/vendors/{vendor}/save', [VendorCustomerController::class, 'saveVendor'])->name('vendor.save');
    Route::post('/vendors/{vendor}/unsave', [VendorCustomerController::class, 'unsaveVendor'])->name('vendor.unsave');

    // Contact Vendor
    Route::post('/contact/vendor', [VendorCustomerController::class, 'sendContactMessage'])->name('contact.vendor');
});

// =========================================================================
// NOTIFICATION ROUTES (Accessible by all authenticated users)
// =========================================================================

Route::middleware(['auth'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('unread-count');
    Route::get('/recent', [NotificationController::class, 'getRecent'])->name('recent');
});

// =========================================================================
// SEARCH HISTORY ROUTES
// =========================================================================

Route::middleware(['auth'])->group(function () {
    Route::delete('/search/history/{id}', [VendorCustomerController::class, 'removeSearchHistory'])->name('search.history.remove');
    Route::delete('/search/history/clear/all', [VendorCustomerController::class, 'clearSearchHistory'])->name('search.history.clear');
    Route::post('/search/save', [VendorCustomerController::class, 'saveSearch'])->name('search.save');
});

// =========================================================================
// EMAIL VERIFICATION ROUTES (MustVerifyEmail)
// =========================================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'send'])->middleware(['throttle:6,1'])->name('verification.send');
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

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware('role:admin');
});

// =========================================================================
// PUBLIC PRODUCT ROUTES
// =========================================================================
Route::get('/product/{id}', [ProductController::class, 'publicShow'])->name('product.show');
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.public');
Route::get('/products/category/{category}', [ProductController::class, 'byCategory'])->name('products.category');

// =========================================================================
// COMPLETE VENDOR ROUTES
// =========================================================================
Route::middleware(['auth', 'verified', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {

    // ======== VENDOR DASHBOARD & STORE ========
    Route::get('/dashboard', [VendorCustomerController::class, 'vendorDashboard'])->name('dashboard');
    Route::get('/store/{id}', [VendorCustomerController::class, 'showVendor'])->name('store');
    Route::get('/store', [VendorCustomerController::class, 'showVendor'])->name('store.index');

    // ======== VENDOR PROFILE ========
    Route::get('/profile', [VendorCustomerController::class, 'vendorProfile'])->name('profile');



    // ======== ORDERS MANAGEMENT ========
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/bulk-update-status', [OrderController::class, 'bulkUpdateStatus'])->name('orders.bulk-update-status');
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::get('/orders-list', [OrderController::class, 'getOrders'])->name('orders.list');
    Route::get('/orders-stats', [OrderController::class, 'getStats'])->name('orders.stats');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'printInvoice'])->name('orders.invoice');


    // ======== PRODUCTS MANAGEMENT ========
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Vendor products listing for public
    Route::get('/{vendor}/products', [ProductController::class, 'vendorProducts'])->name('products');

    // Product status updates
    Route::patch('/products/{id}/activate', [ProductController::class, 'activate'])->name('products.activate');
    Route::patch('/products/{id}/deactivate', [ProductController::class, 'deactivate'])->name('products.deactivate');
    Route::post('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');

    // Bulk product actions
    Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
    Route::patch('/products/bulk-activate', [ProductController::class, 'bulkActivate'])->name('products.bulk-activate');
    Route::patch('/products/bulk-deactivate', [ProductController::class, 'bulkDeactivate'])->name('products.bulk-deactivate');

    // Notification AJAX endpoints
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');

    // AJAX endpoints for products
    Route::get('/products-list', [ProductController::class, 'getVendorProducts'])->name('products.list');
    Route::get('/products-stats', [ProductController::class, 'getStats'])->name('products.stats');

    // ======== CATEGORIES MANAGEMENT ========
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories-list', [CategoryController::class, 'getCategories'])->name('categories.list');

    // ======== ANALYTICS ========
    Route::get('/sales-report', [VendorController::class, 'salesReport'])->name('sales-report');
    Route::get('/export-sales', [VendorController::class, 'exportSalesReport'])->name('export-sales');

    // Store views
    Route::get('/store-views', [VendorController::class, 'storeViews'])->name('store-views');
    Route::get('/export-store-views', [VendorController::class, 'exportStoreViews'])->name('export-store-views');


    // ======== REVIEWS MANAGEMENT ========
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::post('/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{id}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews-stats', [ReviewController::class, 'getStats'])->name('reviews.stats');

    // Bulk operations
    Route::post('/reviews/bulk-approve', [ReviewController::class, 'bulkApprove'])->name('reviews.bulk-approve');
    Route::post('/reviews/bulk-delete', [ReviewController::class, 'bulkDelete'])->name('reviews.bulk-delete');

    // Export
    Route::get('/reviews/export', [ReviewController::class, 'export'])->name('reviews.export');

    // ======== SETTINGS ========
    Route::get('/settings', [VendorCustomerController::class, 'vendorSettings'])->name('settings');
    Route::post('/settings', [VendorCustomerController::class, 'updateSettings'])->name('settings.update');
    Route::post('/password', [VendorCustomerController::class, 'updatePassword'])->name('password.update');

    // ======== NOTIFICATIONS ========
    Route::get('/notifications', [VendorController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/{id}', [VendorController::class, 'getNotification'])->name('notifications.get');
    Route::post('/notifications/{id}/read', [VendorController::class, 'markNotificationAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [VendorController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [VendorController::class, 'deleteNotification'])->name('notifications.delete');
    Route::delete('/notifications/clear-all', [VendorController::class, 'clearAllNotifications'])->name('notifications.clear-all');
    Route::get('/unread-counts', [VendorController::class, 'getUnreadCounts'])->name('unread-counts');

    // ======== MESSAGES ========
    Route::get('/messages', [VendorController::class, 'messages'])->name('messages');
    Route::get('/messages/conversation/{userId}', [VendorController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages/send', [VendorController::class, 'sendMessage'])->name('messages.send');
    Route::post('/messages/{id}/read', [VendorController::class, 'markMessageAsRead'])->name('messages.read');

    // Saved vendors
    Route::get('/saved', [VendorController::class, 'getSavedVendors'])->name('saved');
    Route::post('/save/{vendor}', [VendorController::class, 'saveVendor'])->name('save');
    Route::delete('/unsave/{vendor}', [VendorController::class, 'unsaveVendor'])->name('unsave');
    Route::get('/check-saved/{vendor}', [VendorController::class, 'checkSavedVendor'])->name('check-saved');

    // Stats
    Route::get('/stats', [VendorController::class, 'getVendorStats'])->name('stats');
});

// =========================================================================
// COMPLETE CUSTOMER ROUTES
// =========================================================================
Route::middleware(['auth', 'verified', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    // ======== CUSTOMER DASHBOARD ========
    Route::get('/dashboard', [VendorCustomerController::class, 'customerDashboard'])->name('dashboard');

    // ======== NOTIFICATIONS ========
    Route::get('/notifications', [NotificationController::class, 'customerNotifications'])->name('notifications');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');

    // ======== WISHLIST MANAGEMENT ========
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/item/{id}', [WishlistController::class, 'removeById'])->name('wishlist.remove-by-id');
    Route::get('/wishlist/check/{product}', [WishlistController::class, 'check'])->name('wishlist.check');
    Route::get('/wishlist/count', [WishlistController::class, 'getCount'])->name('wishlist.count');
    Route::delete('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
    Route::post('/wishlist/move-to-cart/{product}', [WishlistController::class, 'moveToCart'])->name('wishlist.move-to-cart');
    Route::post('/wishlist/bulk-remove', [WishlistController::class, 'bulkRemove'])->name('wishlist.bulk-remove');



    // ======== FOLLOWING MANAGEMENT ========
    Route::get('/following', [VendorCustomerController::class, 'following'])->name('following');

    // ======== COUPONS MANAGEMENT ========
    Route::get('/coupons', [CouponController::class, 'customerCoupons'])->name('coupons');
    Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');
    Route::post('/coupons/{id}/redeem', [CouponController::class, 'redeem'])->name('coupons.redeem');
    Route::get('/coupons/available/{vendorId}', [CouponController::class, 'vendorCoupons'])->name('coupons.vendor');
    Route::post('/coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');

    // ======== CART MANAGEMENT ========
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/preview', [CartController::class, 'preview'])->name('cart.preview');
    Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // ======== CUSTOMER ORDERS ========
    Route::get('/orders', [OrderController::class, 'customerOrders'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'customerOrderShow'])->name('orders.show');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'customerOrderCancel'])->name('orders.cancel');
    Route::get('/orders/{id}/track', [OrderController::class, 'customerOrderTrack'])->name('orders.track');
    Route::post('/orders/{id}/reorder', [OrderController::class, 'customerReorder'])->name('orders.reorder');
    Route::get('/orders-stats', [OrderController::class, 'getCustomerOrderStats'])->name('orders.stats');

    // ======== CUSTOMER PROFILE ========
    Route::get('/profile', [VendorCustomerController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [VendorCustomerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [VendorCustomerController::class, 'update'])->name('profile.update');

    // ======== CUSTOMER SETTINGS ========
    Route::get('/settings', [VendorCustomerController::class, 'edit'])->name('settings');
    Route::post('/settings', [VendorCustomerController::class, 'updateSettings'])->name('settings.update');
    Route::post('/password', [VendorCustomerController::class, 'updatePassword'])->name('password.update');

    // ======== CUSTOMER MESSAGES ========
    Route::get('/messages', [MessageController::class, 'customerMessages'])->name('messages');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::get('/messages/conversation/{userId}', [MessageController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
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
    Route::middleware(['auth', 'role:admin'])->group(function () {

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/search', [AdminController::class, 'search'])->name('search');


//Route::get('/admin/test-admins', [App\Http\Controllers\Admin\AdminController::class, 'testAdmins']);



        // ======== ADMIN MANAGEMENT (ADD THIS SECTION) ========
           // Route::get('/admins', [App\Http\Controllers\Admin\AdminController::class, 'admins'])->name('admins.list');
        Route::get('/admins', [AdminController::class, 'admins'])->name('admins.list');
        Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
        Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
        Route::get('/admins/{id}', [AdminController::class, 'showAdmin'])->name('admins.show');
        Route::get('/admins/{id}/edit', [AdminController::class, 'editAdmin'])->name('admins.edit');
        Route::put('/admins/{id}', [AdminController::class, 'updateAdmin'])->name('admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'deleteAdmin'])->name('admins.delete');
        Route::post('/admins/{id}/toggle-status', [AdminController::class, 'toggleAdminStatus'])->name('admins.toggle-status');








           // ======== ROLES & PERMISSIONS  ========
        Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
        Route::get('/roles/create', [AdminController::class, 'createRole'])->name('roles.create');
        Route::post('/roles', [AdminController::class, 'storeRole'])->name('roles.store');
        Route::get('/roles/{id}', [AdminController::class, 'showRole'])->name('roles.show');
        Route::get('/roles/{id}/edit', [AdminController::class, 'editRole'])->name('roles.edit');
        Route::put('/roles/{id}', [AdminController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{id}', [AdminController::class, 'deleteRole'])->name('roles.delete');

         // ======== USERS MANAGEMENT (ADD THIS SECTION) ========
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/pending', [AdminController::class, 'pendingVendors'])->name('users.pending');

        Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('users.show');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::post('/users/{id}/toggle-verification', [AdminController::class, 'toggleVerification'])->name('users.toggle-verification');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::post('/vendors/{id}/approve', [AdminController::class, 'approveVendor'])->name('vendors.approve');
        Route::post('/vendors/{id}/reject', [AdminController::class, 'rejectVendor'])->name('vendors.reject');
        Route::get('/users/export', [AdminController::class, 'exportUsers'])->name('users.export');
        Route::post('/users/bulk-action', [AdminController::class, 'bulkAction'])->name('users.bulk-action');
        Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
        Route::get('/users-stats', [AdminController::class, 'getUserStats'])->name('users.stats');

        // ======== ORDERS MANAGEMENT ========
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
        Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
        Route::get('/orders/export', [AdminController::class, 'exportOrders'])->name('orders.export');
        Route::get('/orders-stats', [AdminController::class, 'getOrderStats'])->name('orders.stats');

        // ======== CUSTOMERS MANAGEMENT ========
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('customers.delete');
        Route::get('/customers-stats', [AdminController::class, 'getCustomerStats'])->name('customers.stats');

        // ======== VENDORS MANAGEMENT ========
        Route::get('/vendors', [AdminController::class, 'vendors'])->name('vendors');
        Route::get('/vendors/{id}', [AdminController::class, 'showVendor'])->name('vendors.show');
        Route::get('/vendors/{id}/edit', [AdminController::class, 'editVendor'])->name('vendors.edit');
        Route::put('/vendors/{id}', [AdminController::class, 'updateVendor'])->name('vendors.update');
        Route::delete('/vendors/{id}', [AdminController::class, 'deleteVendor'])->name('vendors.delete');
        Route::post('/vendors/{id}/verify', [AdminController::class, 'verifyVendor'])->name('vendors.verify');
        Route::post('/vendors/{id}/status', [AdminController::class, 'changeVendorStatus'])->name('vendors.status');
        Route::get('/vendors-stats', [AdminController::class, 'getVendorStats'])->name('vendors.stats');

         // ======== PRODUCTS MANAGEMENT (ADD THIS IF MISSING) ========
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create'); // ADD THIS LINE
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store'); // ADD THIS LINE
        Route::get('/products/{id}', [AdminController::class, 'showProduct'])->name('products.show');
        Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');
        Route::post('/products/{id}/toggle-status', [AdminController::class, 'toggleProductStatus'])->name('products.toggle-status');
        Route::get('/products-stats', [AdminController::class, 'getProductStats'])->name('products.stats');

        // ======== CATALOG MANAGEMENT ========
        Route::get('/catalog', [AdminController::class, 'catalog'])->name('catalog');
        Route::get('/catalog/products', [AdminController::class, 'products'])->name('catalog.products');

        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');

        Route::get('/catalog/categories', [AdminController::class, 'categories'])->name('catalog.categories');
        Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');

        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');

        Route::get('/categories/{id}', [AdminController::class, 'showCategory'])->name('categories.show');

        Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');

        Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');

        Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.destroy');

        Route::get('/catalog/products/export', [AdminController::class, 'exportProducts'])->name('catalog.products.export');

       


        // ======== PROMOTIONS MANAGEMENT ========
        Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
        Route::get('/promotions/create', [AdminController::class, 'createPromotion'])->name('promotions.create');
        Route::post('/promotions', [AdminController::class, 'storePromotion'])->name('promotions.store');
        Route::get('/promotions/{id}/edit', [AdminController::class, 'editPromotion'])->name('promotions.edit');
        Route::put('/promotions/{id}', [AdminController::class, 'updatePromotion'])->name('promotions.update');
        //Route::delete('/promotions/{id}', [AdminController::class, 'deletePromotion'])->name('promotions.delete');
        Route::delete('/promotions/{id}', [AdminController::class, 'deletePromotion'])->name('promotions.destroy'); // This is the missing route



        Route::get('/products/list', [ProductController::class, 'getProductsList'])->name('products.list');

        // ======== COUPONS MANAGEMENT ========
        Route::get('/coupons', [CouponController::class, 'adminIndex'])->name('coupons');
        Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');

        Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('coupons.update');

        Route::post('/coupons/generate', [CouponController::class, 'generate'])->name('coupons.generate');
        Route::delete('/coupons/{id}', [CouponController::class, 'adminDelete'])->name('coupons.delete');
        Route::post('/coupons/{id}/toggle', [CouponController::class, 'toggleStatus'])->name('coupons.toggle');
        Route::post('/coupons/bulk-delete', [CouponController::class, 'bulkDelete'])->name('coupons.bulk-delete');
        Route::get('/coupons/export', [CouponController::class, 'export'])->name('coupons.export');




        // ======== ADMIN PROFILE & SETTINGS ========
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password', [AdminController::class, 'editPassword'])->name('password.edit');
        Route::post('/password', [AdminController::class, 'updatePassword'])->name('password.update');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        // ======== ADMIN NOTIFICATIONS ========
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
        Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');

        // ======== ADMIN MESSAGES ========
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');
        Route::get('/messages/conversation/{userId}', [MessageController::class, 'getConversation'])->name('messages.conversation');

        // ======== HELP & SUPPORT ========
        Route::get('/help', [AdminController::class, 'help'])->name('help');
        Route::get('/documentation', [AdminController::class, 'documentation'])->name('documentation');
        Route::get('/documentation/pdf', [AdminController::class, 'downloadDocumentationPDF'])->name('help.documentation.pdf');

        // ======== ANALYTICS & STATISTICS ========
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/reports/export', [AdminController::class, 'exportReport'])->name('reports.export');
        Route::get('/dashboard-stats', [AdminController::class, 'getDashboardStats'])->name('dashboard.stats');
        Route::get('/revenue-stats', [AdminController::class, 'getRevenueStats'])->name('revenue.stats');

        // ======== AJAX ENDPOINTS ========
        Route::prefix('ajax')->name('ajax.')->group(function () {
            Route::get('/admins-search', [AdminController::class, 'searchAdmins'])->name('admins.search');
            Route::get('/vendors-search', [AdminController::class, 'searchVendors'])->name('vendors.search');
            Route::get('/customers-search', [AdminController::class, 'searchCustomers'])->name('customers.search');
            Route::get('/orders-search', [AdminController::class, 'searchOrders'])->name('orders.search');
            Route::get('/products-search', [AdminController::class, 'searchProducts'])->name('products.search');
            Route::get('/stats', [AdminController::class, 'getStats'])->name('stats');
            Route::get('/chart-data', [AdminController::class, 'getChartDataAjax'])->name('chart.data');
        });

        // Blog routes
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/search', [BlogController::class, 'search'])->name('search');
            Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
            Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
            Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
            Route::post('/newsletter', [BlogController::class, 'newsletter'])->name('newsletter');
        });
    });
});

// =========================================================================
// API ROUTES
// =========================================================================

Route::prefix('api')->name('api.')->group(function () {
    // Public API endpoints
    Route::get('/vendors', [VendorCustomerController::class, 'apiVendors'])->name('vendors');
    Route::get('/vendors/{id}', [VendorCustomerController::class, 'apiVendor'])->name('vendor');
    Route::get('/products', [ProductController::class, 'apiProducts'])->name('products');
    Route::get('/products/{id}', [ProductController::class, 'apiProduct'])->name('product');
    Route::get('/categories', [CategoryController::class, 'apiCategories'])->name('categories');
    Route::get('/search', [VendorCustomerController::class, 'apiSearch'])->name('search');

    // Protected API endpoints
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');

        // Customer API endpoints
        Route::get('/customer/wishlist', [WishlistController::class, 'apiIndex'])->name('customer.wishlist');
        Route::post('/customer/wishlist/add/{product}', [WishlistController::class, 'apiAdd'])->name('customer.wishlist.add');
        Route::delete('/customer/wishlist/remove/{product}', [WishlistController::class, 'apiRemove'])->name('customer.wishlist.remove');

        // ADD THIS NEW ROUTE FOR BATCH CHECK
        Route::post('/customer/wishlist/check-batch', [WishlistController::class, 'apiCheckBatch'])->name('customer.wishlist.check-batch');

        // Cart API endpoints
        Route::get('/cart', [CartController::class, 'apiIndex'])->name('cart');
        Route::post('/cart/add/{product}', [CartController::class, 'apiAdd'])->name('cart.add');
        Route::put('/cart/update/{cart}', [CartController::class, 'apiUpdate'])->name('cart.update');
        Route::delete('/cart/remove/{cart}', [CartController::class, 'apiRemove'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class, 'apiClear'])->name('cart.clear');

        // Orders API endpoints
        Route::get('/orders', [OrderController::class, 'apiOrders'])->name('orders');
        Route::get('/orders/{id}', [OrderController::class, 'apiOrder'])->name('order');
    });
});

// =========================================================================
// CONTACT FORM SUBMISSION
// =========================================================================
Route::post('/contact/submit', [VendorCustomerController::class, 'contactSubmit'])->name('contact.submit');

// =========================================================================
// REVIEW ROUTES
// =========================================================================
Route::get('/vendors/{id}/reviews', [VendorCustomerController::class, 'loadMoreReviews'])->name('vendor.reviews');

// =========================================================================
// FALLBACK ROUTE (404 handling)
// =========================================================================

Route::fallback(function () {
    return view('errors.404');
});