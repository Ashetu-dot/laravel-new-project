<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Coupons - Vendora | Jimma, Ethiopia</title>
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

        /* Coupons Header */
        .coupons-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .coupons-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .coupons-header h1 i {
            color: var(--primary-gold);
        }

        .coupons-header p {
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

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }

        /* Coupons Grid */
        .coupons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .coupon-card {
            background: linear-gradient(135deg, #fff, #f9fafb);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
        }

        .coupon-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .coupon-header {
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            padding: 20px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .coupon-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(45deg);
            pointer-events: none;
        }

        .coupon-type {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .coupon-value {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .coupon-code {
            font-size: 18px;
            font-family: monospace;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            letter-spacing: 2px;
        }

        .coupon-body {
            padding: 20px;
        }

        .coupon-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .coupon-description {
            color: var(--text-secondary);
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .coupon-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
            padding: 12px 0;
            border-top: 1px dashed var(--border-color);
            border-bottom: 1px dashed var(--border-color);
        }

        .meta-item {
            flex: 1;
            min-width: 100px;
        }

        .meta-label {
            font-size: 11px;
            color: var(--text-secondary);
            margin-bottom: 2px;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .coupon-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .coupon-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-expired {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-used {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .btn-redeem {
            background-color: var(--primary-gold);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-redeem:hover:not(:disabled) {
            background-color: #9c7832;
            transform: translateY(-2px);
        }

        .btn-redeem:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
        }

        .tab {
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            background: transparent;
            border: 1px solid transparent;
        }

        .tab:hover {
            color: var(--primary-gold);
        }

        .tab.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
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
            font-size: 64px;
            color: var(--border-color);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 24px;
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
            transform: translateY(-2px);
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 16px;
            max-width: 400px;
            width: 90%;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .modal-close {
            cursor: pointer;
            font-size: 20px;
            color: var(--text-secondary);
        }

        .modal-body {
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-icon {
            font-size: 48px;
            color: var(--success-color);
            margin-bottom: 16px;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: center;
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

        /* Toast */
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
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                    <i class="ri-heart-3-line"></i> Wishlist
                </a>
                <a href="{{ route('customer.following') }}" class="nav-item">
                    <i class="ri-store-2-line"></i> Following
                </a>
                <a href="{{ route('customer.coupons') }}" class="nav-item active">
                    <i class="ri-coupon-3-line"></i> My Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('profile.edit', Auth::id()) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Account Settings
                </a>
                <a href="{{ route('customer.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i> Notifications
                </a>
                <a href="{{ route('customer.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i> Messages
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
                    <i class="ri-coupon-3-line" style="color: var(--primary-gold);"></i> My Coupons
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
                    <i class="ri-shopping-cart-line"></i>
                </a>
            </div>
        </header>

        <!-- Coupons Content -->
        <div class="dashboard-container">
            <!-- Header -->
            <div class="coupons-header">
                <div>
                    <h1>
                        <i class="ri-coupon-3-line"></i>
                        My Coupons
                    </h1>
                    <p>Save money with exclusive discounts and offers</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-coupon-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Active Coupons</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">ETB 1,250</div>
                        <div class="stat-label">Total Savings</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-history-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Used Coupons</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-gold-light">
                        <i class="ri-timer-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Expiring Soon</div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" onclick="filterCoupons('all')">All Coupons</button>
                <button class="tab" onclick="filterCoupons('active')">Active</button>
                <button class="tab" onclick="filterCoupons('used')">Used</button>
                <button class="tab" onclick="filterCoupons('expired')">Expired</button>
            </div>

            <!-- Coupons Grid -->
            <div class="coupons-grid" id="couponsGrid">
                <!-- Active Coupon -->
                <div class="coupon-card" data-status="active">
                    <div class="coupon-header">
                        <div class="coupon-type">WELCOME BONUS</div>
                        <div class="coupon-value">20% OFF</div>
                        <div class="coupon-code">WELCOME20</div>
                    </div>
                    <div class="coupon-body">
                        <h3 class="coupon-title">Welcome Discount</h3>
                        <p class="coupon-description">Get 20% off on your first purchase from any vendor. Minimum purchase ETB 500.</p>
                        
                        <div class="coupon-meta">
                            <div class="meta-item">
                                <div class="meta-label">Valid From</div>
                                <div class="meta-value">Jan 1, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Valid Until</div>
                                <div class="meta-value">Mar 31, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Min. Purchase</div>
                                <div class="meta-value">ETB 500</div>
                            </div>
                        </div>

                        <div class="coupon-footer">
                            <span class="coupon-status status-active">Active</span>
                            <button class="btn-redeem" onclick="redeemCoupon(1)">Redeem Now</button>
                        </div>
                    </div>
                </div>

                <!-- Percentage Discount -->
                <div class="coupon-card" data-status="active">
                    <div class="coupon-header">
                        <div class="coupon-type">FLASH SALE</div>
                        <div class="coupon-value">15% OFF</div>
                        <div class="coupon-code">FLASH15</div>
                    </div>
                    <div class="coupon-body">
                        <h3 class="coupon-title">Flash Sale Discount</h3>
                        <p class="coupon-description">Limited time offer! 15% off on all electronics and gadgets.</p>
                        
                        <div class="coupon-meta">
                            <div class="meta-item">
                                <div class="meta-label">Valid From</div>
                                <div class="meta-value">Feb 15, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Valid Until</div>
                                <div class="meta-value">Feb 28, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Max Discount</div>
                                <div class="meta-value">ETB 1,000</div>
                            </div>
                        </div>

                        <div class="coupon-footer">
                            <span class="coupon-status status-active">Active</span>
                            <button class="btn-redeem" onclick="redeemCoupon(2)">Redeem Now</button>
                        </div>
                    </div>
                </div>

                <!-- Fixed Amount Discount -->
                <div class="coupon-card" data-status="active">
                    <div class="coupon-header">
                        <div class="coupon-type">SPECIAL OFFER</div>
                        <div class="coupon-value">ETB 200 OFF</div>
                        <div class="coupon-code">SAVE200</div>
                    </div>
                    <div class="coupon-body">
                        <h3 class="coupon-title">Special Discount</h3>
                        <p class="coupon-description">Get ETB 200 off on orders above ETB 1,000. Valid on all categories.</p>
                        
                        <div class="coupon-meta">
                            <div class="meta-item">
                                <div class="meta-label">Valid From</div>
                                <div class="meta-value">Mar 1, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Valid Until</div>
                                <div class="meta-value">Apr 15, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Min. Purchase</div>
                                <div class="meta-value">ETB 1,000</div>
                            </div>
                        </div>

                        <div class="coupon-footer">
                            <span class="coupon-status status-active">Active</span>
                            <button class="btn-redeem" onclick="redeemCoupon(3)">Redeem Now</button>
                        </div>
                    </div>
                </div>

                <!-- Used Coupon -->
                <div class="coupon-card" data-status="used">
                    <div class="coupon-header" style="background: linear-gradient(135deg, #9ca3af, #6b7280);">
                        <div class="coupon-type">LOYALTY REWARD</div>
                        <div class="coupon-value">10% OFF</div>
                        <div class="coupon-code">LOYAL10</div>
                    </div>
                    <div class="coupon-body">
                        <h3 class="coupon-title">Loyalty Reward</h3>
                        <p class="coupon-description">Thank you for being a loyal customer! Get 10% off on your next purchase.</p>
                        
                        <div class="coupon-meta">
                            <div class="meta-item">
                                <div class="meta-label">Valid From</div>
                                <div class="meta-value">Jan 15, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Valid Until</div>
                                <div class="meta-value">Feb 15, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Used On</div>
                                <div class="meta-value">Feb 10, 2026</div>
                            </div>
                        </div>

                        <div class="coupon-footer">
                            <span class="coupon-status status-used">Used</span>
                            <button class="btn-redeem" disabled>Already Used</button>
                        </div>
                    </div>
                </div>

                <!-- Expired Coupon -->
                <div class="coupon-card" data-status="expired">
                    <div class="coupon-header" style="background: linear-gradient(135deg, #ef4444, #b91c1c);">
                        <div class="coupon-type">NEW YEAR SALE</div>
                        <div class="coupon-value">25% OFF</div>
                        <div class="coupon-code">NEWYEAR25</div>
                    </div>
                    <div class="coupon-body">
                        <h3 class="coupon-title">New Year Special</h3>
                        <p class="coupon-description">Celebrate the new year with 25% off on all products.</p>
                        
                        <div class="coupon-meta">
                            <div class="meta-item">
                                <div class="meta-label">Valid From</div>
                                <div class="meta-value">Dec 25, 2025</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Valid Until</div>
                                <div class="meta-value">Jan 15, 2026</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Status</div>
                                <div class="meta-value">Expired</div>
                            </div>
                        </div>

                        <div class="coupon-footer">
                            <span class="coupon-status status-expired">Expired</span>
                            <button class="btn-redeem" disabled>Expired</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State (hidden by default) -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="ri-coupon-3-line empty-icon"></i>
                <h3>No coupons available</h3>
                <p>You don't have any coupons at the moment. Check back later for new offers!</p>
                <a href="{{ route('search.results') }}" class="btn btn-primary">
                    <i class="ri-shopping-bag-line"></i> Start Shopping
                </a>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="pagination-item"><i class="ri-arrow-left-s-line"></i></a>
                <a href="#" class="pagination-item active">1</a>
                <a href="#" class="pagination-item">2</a>
                <a href="#" class="pagination-item">3</a>
                <a href="#" class="pagination-item"><i class="ri-arrow-right-s-line"></i></a>
            </div>
        </div>
    </main>

    <!-- Redemption Modal -->
    <div class="modal" id="redeemModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Redeem Coupon</h3>
                <div class="modal-close" onclick="closeModal()">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-icon">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <h4 style="margin-bottom: 8px;">Coupon Applied!</h4>
                <p style="color: var(--text-secondary);">Your discount has been applied to the cart.</p>
                <p style="font-size: 14px; margin-top: 8px;">Code: <strong id="redeemedCode"></strong></p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('customer.cart.index') }}" class="btn btn-primary">View Cart</a>
                <button class="btn btn-secondary" onclick="closeModal()">Continue Shopping</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-icon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Coupon redeemed successfully</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
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

        // Filter coupons
        function filterCoupons(status) {
            // Update tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter cards
            const cards = document.querySelectorAll('.coupon-card');
            let visibleCount = 0;

            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            const emptyState = document.getElementById('emptyState');
            if (visibleCount === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }

        // Redeem coupon
        function redeemCoupon(couponId) {
            // Show loading state
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="loading-spinner"></span> Redeeming...';

            // Simulate API call
            setTimeout(() => {
                // Get coupon code
                const couponCode = btn.closest('.coupon-card').querySelector('.coupon-code').textContent;
                document.getElementById('redeemedCode').textContent = couponCode;
                
                // Show modal
                document.getElementById('redeemModal').classList.add('active');
                
                // Reset button
                btn.disabled = false;
                btn.innerHTML = originalText;
            }, 1000);
        }

        // Close modal
        function closeModal() {
            document.getElementById('redeemModal').classList.remove('active');
            showToast('Success', 'Coupon applied to your cart!', 'success');
        }

        // Show toast
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