<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Wishlist - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-bg: #f3f4f6;
            --sidebar-bg: #1f2937;
            --sidebar-text: #9ca3af;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #374151;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            max-width: 1920px;
            margin: 0 auto;
            width: 100%;
        }

        /* Sidebar styles */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        .brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 24px;
            font-weight: 700;
            border-bottom: 1px solid #374151;
            letter-spacing: -0.5px;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 28px;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .nav-label {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            font-size: 15px;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-active);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid #374151;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        .logout-form {
            margin-top: 8px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        .top-header {
            height: 70px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .top-header {
                padding: 0 20px;
            }
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: background 0.2s;
            position: relative;
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 16px;
            }
        }

        /* Wishlist Header */
        .wishlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .wishlist-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .wishlist-header h1 i {
            color: var(--primary-gold);
        }

        .wishlist-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        .wishlist-actions {
            display: flex;
            gap: 12px;
        }

        /* Wishlist Grid */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .wishlist-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid transparent;
        }

        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .wishlist-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--primary-gold);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            z-index: 1;
        }

        .wishlist-remove {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--danger-color);
            transition: all 0.2s;
            z-index: 1;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .wishlist-remove:hover {
            background-color: var(--danger-color);
            color: white;
            transform: scale(1.1);
        }

        .wishlist-image {
            width: 100%;
            height: 200px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 48px;
            position: relative;
        }

        .wishlist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wishlist-content {
            padding: 20px;
        }

        .wishlist-vendor {
            font-size: 12px;
            color: var(--primary-gold);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .wishlist-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .wishlist-title a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .wishlist-title a:hover {
            color: var(--primary-gold);
        }

        .wishlist-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .wishlist-stock {
            font-size: 12px;
            margin-bottom: 16px;
        }

        .in-stock {
            color: var(--success-color);
        }

        .out-of-stock {
            color: var(--danger-color);
        }

        .wishlist-footer {
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .empty-state p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination-item {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-item:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
            
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN MENU</div>
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('search.results') }}" class="nav-item">
                    <i class="ri-search-line"></i> Discover
                </a>
                <a href="{{ route('customer.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> My Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SHOPPING</div>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item active">
                    <i class="ri-heart-3-line"></i> Wishlist
                    @if(isset($wishlistItems) && $wishlistItems->total() > 0)
                        <span class="badge-count">{{ $wishlistItems->total() }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.following') }}" class="nav-item">
                    <i class="ri-store-line"></i> Following
                </a>
                <a href="{{ route('customer.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> My Coupons
                </a>
                <a href="{{ route('customer.cart.index') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Cart
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('customer.profile') }}" class="nav-item">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('customer.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Customer since {{ Auth::user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-heart-3-line" style="color: var(--primary-gold);"></i> My Wishlist
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('customer.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Wishlist Content -->
        <div class="dashboard-container">
            <!-- Header -->
            <div class="wishlist-header">
                <div>
                    <h1>
                        <i class="ri-heart-3-line"></i>
                        My Wishlist
                    </h1>
                    <p>Products you've saved for later</p>
                </div>
                @if($wishlistItems->total() > 0)
                    <div class="wishlist-actions">
                        <button class="btn btn-secondary" onclick="clearWishlist()">
                            <i class="ri-delete-bin-line"></i> Clear All
                        </button>
                    </div>
                @endif
            </div>

            <!-- Wishlist Grid -->
            @if($wishlistItems->count() > 0)
                <div class="wishlist-grid">
                    @foreach($wishlistItems as $item)
                        <div class="wishlist-card" id="wishlist-item-{{ $item->id }}">
                            @if($item->product && $item->product->vendor)
                                <div class="wishlist-badge">{{ $item->product->vendor->business_name ?? $item->product->vendor->name }}</div>
                            @endif
                            <button class="wishlist-remove" onclick="removeFromWishlist({{ $item->id }}, {{ $item->product_id }})" title="Remove from wishlist">
                                <i class="ri-close-line"></i>
                            </button>
                            <div class="wishlist-image">
                                @if($item->product && $item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}">
                                @else
                                    <i class="ri-shopping-bag-line"></i>
                                @endif
                            </div>
                            <div class="wishlist-content">
                                <div class="wishlist-vendor">
                                    <i class="ri-store-line"></i>
                                    {{ $item->product->vendor->business_name ?? $item->product->vendor->name }}
                                </div>
                                <h3 class="wishlist-title">
                                    <a href="{{ route('product.show', $item->product_id) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                <div class="wishlist-price">
                                    ETB {{ number_format($item->product->price, 2) }}
                                </div>
                                <div class="wishlist-stock">
                                    @if($item->product->stock > 0)
                                        <span class="in-stock"><i class="ri-checkbox-circle-line"></i> In Stock ({{ $item->product->stock }})</span>
                                    @else
                                        <span class="out-of-stock"><i class="ri-error-warning-line"></i> Out of Stock</span>
                                    @endif
                                </div>
                                <div class="wishlist-footer">
                                    @if($item->product->stock > 0)
                                        <button class="btn btn-primary" onclick="addToCart({{ $item->product_id }})">
                                            <i class="ri-shopping-cart-line"></i> Add to Cart
                                        </button>
                                    @else
                                        <button class="btn btn-primary" disabled>
                                            <i class="ri-shopping-cart-line"></i> Out of Stock
                                        </button>
                                    @endif
                                    <a href="{{ route('product.show', $item->product_id) }}" class="btn btn-secondary">
                                        <i class="ri-eye-line"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($wishlistItems->hasPages())
                    <div class="pagination">
                        {{ $wishlistItems->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="ri-heart-3-line"></i>
                    <h3>Your Wishlist is Empty</h3>
                    <p>Save items you like by clicking the heart icon on any product.</p>
                    <a href="{{ route('search.results') }}" class="btn btn-primary">
                        <i class="ri-search-line"></i> Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </main>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div style="text-align: center;">
            <div class="loading-spinner" style="width: 40px; height: 40px;"></div>
            <p style="margin-top: 16px; color: var(--primary-gold);">Loading...</p>
        </div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });

                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('active');
                        }
                    }
                });
            }
        });

        // Remove from wishlist
        function removeFromWishlist(wishlistId, productId) {
            if (!confirm('Remove this item from your wishlist?')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/customer/wishlist/remove/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    showToast('Success', 'Item removed from wishlist', 'success');
                    const element = document.getElementById(`wishlist-item-${wishlistId}`);
                    if (element) {
                        element.style.transition = 'opacity 0.3s';
                        element.style.opacity = '0';
                        setTimeout(() => {
                            element.remove();
                            // Reload if no items left
                            if (document.querySelectorAll('.wishlist-card').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                } else {
                    showToast('Error', data.message || 'Failed to remove item', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                showToast('Error', 'Failed to remove item', 'error');
            });
        }

        // Add to cart
        function addToCart(productId) {
            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/customer/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: 1,
                    options: {}
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    showToast('Success', 'Product added to cart successfully!', 'success');
                } else {
                    showToast('Error', data.message || 'Failed to add to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                showToast('Error', 'Failed to add to cart', 'error');
            });
        }

        // Show toast notification
        function showToast(title, message, type = 'info') {
            // Remove existing toasts
            const existing = document.querySelectorAll('.toast-notification');
            existing.forEach(n => n.remove());
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'info' ? '#3b82f6' : '#f59e0b'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 10001;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
                animation: slideInRight 0.3s ease;
            `;
            
            const iconMap = {
                success: 'check-line',
                error: 'error-warning-line',
                info: 'information-line',
                warning: 'alert-line'
            };
            
            toast.innerHTML = `
                <i class="ri-${iconMap[type] || 'information-line'}" style="font-size: 24px;"></i>
                <div>
                    <div style="font-weight: 600; margin-bottom: 4px;">${title}</div>
                    <div style="font-size: 14px; opacity: 0.9;">${message}</div>
                </div>
                <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; padding: 4px; margin-left: 8px;">
                    <i class="ri-close-line" style="font-size: 20px;"></i>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 4 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Clear wishlist
        function clearWishlist() {
            if (!confirm('Are you sure you want to clear your entire wishlist? This action cannot be undone.')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch('/customer/wishlist/clear', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    showToast('Success', 'Wishlist cleared successfully', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast('Error', data.message || 'Failed to clear wishlist', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                showToast('Error', 'Failed to clear wishlist', 'error');
            });
        }
    </script>

</body>
</html>