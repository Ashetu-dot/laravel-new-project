<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendors I Follow - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
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

        /* Following Header */
        .following-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .following-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .following-header h1 i {
            color: var(--primary-gold);
        }

        .following-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-details {
            flex: 1;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .stat-change {
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        .trend-up { color: var(--success-color); }
        .trend-down { color: var(--accent-red); }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 24px;
            background-color: var(--card-bg);
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 18px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary-gold);
        }

        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 32px 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-primary);
            background-color: var(--card-bg);
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
        }

        .filter-select:focus {
            border-color: var(--primary-gold);
        }

        /* Following Grid */
        .following-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .vendor-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-primary);
            border: 1px solid transparent;
            position: relative;
        }

        .vendor-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .vendor-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: var(--primary-gold);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            z-index: 1;
        }

        .vendor-image {
            height: 140px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            position: relative;
            overflow: hidden;
        }

        .vendor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vendor-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: white;
            position: absolute;
            bottom: -35px;
            left: 20px;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary-gold);
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .vendor-logo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .vendor-info {
            padding: 50px 20px 20px;
        }

        .vendor-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .verified-badge {
            color: var(--success-color);
            font-size: 16px;
        }

        .vendor-category {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .vendor-location {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .vendor-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--primary-gold);
            font-weight: 600;
        }

        .vendor-products {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .vendor-actions {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
        }

        .unfollow-btn {
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0;
            transform: scale(0.8);
        }

        .vendor-card:hover .unfollow-btn {
            opacity: 1;
            transform: scale(1);
        }

        .unfollow-btn:hover {
            background-color: var(--danger-color);
            transform: scale(1.1);
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .empty-icon {
            font-size: 80px;
            color: var(--border-color);
            margin-bottom: 24px;
        }

        .empty-state h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 24px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
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

        /* Loading Spinner */
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

        /* Toast Notifications */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            border-left: 4px solid var(--success-color);
        }

        .toast-error {
            border-left: 4px solid var(--danger-color);
        }

        .toast-icon {
            font-size: 20px;
        }

        .toast-success .toast-icon {
            color: var(--success-color);
        }

        .toast-error .toast-icon {
            color: var(--danger-color);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma
            </span>
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN</div>
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('search.results') }}" class="nav-item">
                    <i class="ri-search-line"></i>
                    Discover
                </a>
                <a href="{{ route('customer.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    My Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SHOPPING</div>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                    <i class="ri-heart-3-line"></i>
                    Wishlist
                    @if(isset($wishlistCount) && $wishlistCount > 0)
                        <span class="badge-count">{{ $wishlistCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.following') }}" class="nav-item active">
                    <i class="ri-store-2-line"></i>
                    Following
                </a>
                <a href="{{ route('customer.coupons') }}" class="nav-item">
                    <i class="ri-coupon-3-line"></i>
                    My Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">
                    <i class="ri-user-line"></i>
                    My Profile
                </a>
                <a href="{{ route('profile.edit', Auth::id()) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Account Settings
                </a>
                <a href="{{ route('customer.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i>
                    Notifications
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i>
                    Messages
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="ri-logout-box-line"></i>
                        Logout
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
                <p>Member since {{ Auth::user()->created_at->format('M Y') }}</p>
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
                    <i class="ri-store-2-line" style="color: var(--primary-gold);"></i> Vendors I Follow
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
                <a href="{{ route('customer.cart.index') }}" class="icon-btn">
                    <i class="ri-shopping-cart-2-line"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="badge-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Following Content -->
        <div class="dashboard-container">
            <!-- Header -->
            <div class="following-header">
                <div>
                    <h1>
                        <i class="ri-store-2-line"></i>
                        Vendors I Follow
                    </h1>
                    <p>Stay updated with your favorite vendors and their latest products</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-store-2-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $following->total() }}</div>
                        <div class="stat-label">Total Following</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $totalProducts ?? 0 }}</div>
                        <div class="stat-label">Products Available</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-star-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $avgRating ?? 0 }}</div>
                        <div class="stat-label">Avg. Vendor Rating</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-gold-light">
                        <i class="ri-time-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $newThisWeek ?? 0 }}</div>
                        <div class="stat-label">New This Week</div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Search followed vendors..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="sortFilter">
                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Recently Followed</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                    </select>
                </div>
            </div>

            <!-- Following Grid -->
            @if($following->count() > 0)
                <div class="following-grid">
                    @foreach($following as $vendor)
                        <div class="vendor-card" id="vendor-{{ $vendor->id }}">
                            <div class="vendor-actions">
                                <button class="unfollow-btn" onclick="unfollowVendor({{ $vendor->id }})" title="Unfollow">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            @if($vendor->is_verified)
                                <div class="vendor-badge">
                                    <i class="ri-verified-badge-fill"></i> Verified
                                </div>
                            @endif
                            <a href="{{ route('vendor.show', $vendor->id) }}" style="text-decoration: none; color: inherit;">
                                <div class="vendor-image">
                                    @if($vendor->main_image)
                                        <img src="{{ Storage::url($vendor->main_image) }}" alt="{{ $vendor->business_name ?? $vendor->name }}">
                                    @endif
                                    <div class="vendor-logo">
                                        @if($vendor->avatar)
                                            <img src="{{ Storage::url($vendor->avatar) }}" alt="{{ $vendor->business_name ?? $vendor->name }}">
                                        @else
                                            {{ strtoupper(substr($vendor->business_name ?? $vendor->name, 0, 2)) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="vendor-info">
                                    <div class="vendor-name">
                                        {{ $vendor->business_name ?? $vendor->name }}
                                        @if($vendor->email_verified_at)
                                            <i class="ri-verified-badge-fill verified-badge" title="Verified Vendor"></i>
                                        @endif
                                    </div>
                                    <div class="vendor-category">
                                        <i class="ri-price-tag-3-line"></i> {{ $vendor->category ?? 'General Store' }}
                                    </div>
                                    <div class="vendor-location">
                                        <i class="ri-map-pin-line"></i> {{ $vendor->city ?? 'Jimma' }}, {{ $vendor->state ?? 'Oromia' }}
                                    </div>
                                    <div class="vendor-meta">
                                        <div class="vendor-rating">
                                            <i class="ri-star-fill"></i> {{ number_format($vendor->rating ?? 4.5, 1) }}
                                            <span style="color: var(--text-secondary); font-weight: normal;">({{ $vendor->total_reviews ?? 0 }})</span>
                                        </div>
                                        <div class="vendor-products">
                                            <i class="ri-store-2-line"></i> {{ $vendor->products_count ?? 0 }} products
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($following->hasPages())
                    <div class="pagination">
                        {{ $following->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="ri-store-2-line empty-icon"></i>
                    <h3>No vendors followed yet</h3>
                    <p>Start following vendors to see their products and updates here. When you follow vendors, they'll appear in this list.</p>
                    <div style="display: flex; gap: 12px; justify-content: center;">
                        <a href="{{ route('search.results') }}" class="btn btn-primary">
                            <i class="ri-search-line"></i> Discover Vendors
                        </a>
                        <a href="{{ route('vendors.search') }}" class="btn btn-secondary">
                            <i class="ri-store-line"></i> Browse All
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-icon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Vendor unfollowed successfully</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </div>
    </div>

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

            // Search and filter functionality
            let searchTimeout;
            document.getElementById('searchInput')?.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => applyFilters(), 500);
            });

            document.getElementById('sortFilter')?.addEventListener('change', applyFilters);
        });

        // Apply filters
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const sort = document.getElementById('sortFilter').value;

            const params = new URLSearchParams(window.location.search);
            if (search) params.set('search', search);
            else params.delete('search');
            if (sort) params.set('sort', sort);
            else params.delete('sort');
            params.set('page', '1');

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        // Unfollow vendor
        function unfollowVendor(vendorId) {
            if (!confirm('Are you sure you want to unfollow this vendor?')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/vendor/${vendorId}/unfollow`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const element = document.getElementById(`vendor-${vendorId}`);
                    if (element) {
                        element.style.transition = 'opacity 0.3s';
                        element.style.opacity = '0';
                        setTimeout(() => {
                            element.remove();
                            showToast('Success', 'Vendor unfollowed successfully', 'success');
                            
                            // Reload if no items left
                            if (document.querySelectorAll('.vendor-card').length === 0) {
                                setTimeout(() => location.reload(), 500);
                            }
                        }, 300);
                    }
                } else {
                    showToast('Error', data.message || 'Failed to unfollow vendor', 'error');
                }
                document.getElementById('loadingOverlay').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to unfollow vendor', 'error');
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        }

        // Toast notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = toast.querySelector('.toast-icon i');

            toast.className = 'toast';
            if (type === 'success') {
                toast.classList.add('toast-success');
                toastIcon.className = 'ri-checkbox-circle-line';
            } else {
                toast.classList.add('toast-error');
                toastIcon.className = 'ri-error-warning-line';
            }

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                hideToast();
            }, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>