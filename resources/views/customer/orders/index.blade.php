<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Orders - Vendora | Jimma, Ethiopia</title>
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

        /* Orders Header */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .orders-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .orders-header h1 i {
            color: var(--primary-gold);
        }

        .orders-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 4px;
        }

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

        /* Orders List */
        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .order-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            border-color: var(--primary-gold);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .order-info h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .order-info p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .order-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff7ed;
            color: #9a3412;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-shipped {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .status-delivered {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-refunded {
            background-color: #f1f5f9;
            color: #475569;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 24px;
        }

        .item-image img {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .item-meta {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .item-price {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .order-total {
            font-size: 16px;
            font-weight: 600;
        }

        .order-total span {
            color: var(--text-secondary);
            font-weight: normal;
            margin-right: 8px;
        }

        .order-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
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

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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
        }

        .modal-body textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
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
                <a href="{{ route('customer.orders') }}" class="nav-item active">
                    <i class="ri-shopping-bag-3-line"></i> My Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SHOPPING</div>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                    <i class="ri-heart-3-line"></i> Wishlist
                </a>
                <a href="{{ route('customer.following') }}" class="nav-item">
                    <i class="ri-store-line"></i> Following
                </a>
                <a href="{{ route('customer.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> My Coupons
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
                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
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
                    <i class="ri-shopping-bag-3-line" style="color: var(--primary-gold);"></i> My Orders
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('customer.cart.index') }}" class="icon-btn">
                    <i class="ri-shopping-cart-line"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="badge-count">{{ $cartCount }}</span>
                    @endif
                </a>
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

        <!-- Orders Content -->
        <div class="dashboard-container">
            <!-- Header -->
            <div class="orders-header">
                <div>
                    <h1>
                        <i class="ri-shopping-bag-3-line"></i>
                        My Orders
                    </h1>
                    <p>Track and manage your orders</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $totalOrders }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $pendingOrders }}</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $processingOrders }}</div>
                    <div class="stat-label">Processing</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $completedOrders }}</div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">ETB {{ number_format($totalSpent, 2) }}</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Search by order number or vendor..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="statusFilter">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <select class="filter-select" id="sortFilter">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Amount</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Amount</option>
                    </select>
                </div>
            </div>

            <!-- Orders List -->
            <div class="orders-list">
                @forelse($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-info">
                                <h3>Order #{{ $order->order_number }}</h3>
                                <p>
                                    <i class="ri-store-line"></i> {{ $order->vendor->business_name ?? $order->vendor->name }}
                                    <span style="margin-left: 12px;"><i class="ri-calendar-line"></i> {{ $order->created_at->format('M d, Y') }}</span>
                                </p>
                            </div>
                            @php
                                $statusClass = 'status-' . $order->status;
                            @endphp
                            <span class="order-status {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                        </div>

                        <div class="order-items">
                            @foreach($order->items->take(2) as $item)
                                <div class="order-item">
                                    <div class="item-image">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}">
                                        @else
                                            <i class="ri-shopping-bag-line"></i>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">{{ $item->product->name ?? 'Product' }}</div>
                                        <div class="item-meta">Qty: {{ $item->quantity }}</div>
                                    </div>
                                    <div class="item-price">ETB {{ number_format($item->price, 2) }}</div>
                                </div>
                            @endforeach
                            @if($order->items->count() > 2)
                                <div style="text-align: center; color: var(--text-secondary); font-size: 12px;">
                                    +{{ $order->items->count() - 2 }} more items
                                </div>
                            @endif
                        </div>

                        <div class="order-footer">
                            <div class="order-total">
                                <span>Total:</span> ETB {{ number_format($order->total_amount, 2) }}
                            </div>
                            <div class="order-actions">
                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="ri-eye-line"></i> View Details
                                </a>
                                @if(in_array($order->status, ['shipped', 'delivered', 'completed']))
                                    <a href="{{ route('customer.orders.track', $order->id) }}" class="btn btn-primary btn-sm">
                                        <i class="ri-truck-line"></i> Track
                                    </a>
                                @endif
                                @if(in_array($order->status, ['pending', 'processing']))
                                    <button class="btn btn-danger btn-sm" onclick="showCancelModal({{ $order->id }}, '{{ $order->order_number }}')">
                                        <i class="ri-close-line"></i> Cancel
                                    </button>
                                @endif
                                @if(in_array($order->status, ['delivered', 'completed']))
                                    <button class="btn btn-secondary btn-sm" onclick="reorder({{ $order->id }})">
                                        <i class="ri-refresh-line"></i> Reorder
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="ri-shopping-bag-3-line"></i>
                        <h3>No Orders Yet</h3>
                        <p>You haven't placed any orders yet. Start shopping to see your orders here.</p>
                        <a href="{{ route('search.results') }}" class="btn btn-primary">
                            <i class="ri-search-line"></i> Start Shopping
                        </a>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="pagination">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Cancel Order Modal -->
    <div class="modal" id="cancelModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cancel Order</h3>
                <div class="modal-close" onclick="closeCancelModal()">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel order <strong id="cancelOrderNumber"></strong>?</p>
                <textarea id="cancelReason" placeholder="Reason for cancellation (optional)" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeCancelModal()">No, Keep It</button>
                <button class="btn btn-danger" onclick="confirmCancel()" id="cancelConfirmBtn">Yes, Cancel Order</button>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div style="text-align: center;">
            <div class="loading-spinner" style="width: 40px; height: 40px;"></div>
            <p style="margin-top: 16px; color: var(--primary-gold);">Processing...</p>
        </div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentOrderId = null;

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
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => applyFilters(), 500);
            });

            document.getElementById('statusFilter').addEventListener('change', applyFilters);
            document.getElementById('sortFilter').addEventListener('change', applyFilters);
        });

        // Apply filters
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const sort = document.getElementById('sortFilter').value;

            const params = new URLSearchParams(window.location.search);
            if (search) params.set('search', search);
            else params.delete('search');
            if (status && status !== 'all') params.set('status', status);
            else params.delete('status');
            if (sort) params.set('sort', sort);
            else params.delete('sort');
            params.set('page', '1');

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        // Show cancel modal
        function showCancelModal(orderId, orderNumber) {
            currentOrderId = orderId;
            document.getElementById('cancelOrderNumber').textContent = orderNumber;
            document.getElementById('cancelModal').classList.add('active');
        }

        // Close cancel modal
        function closeCancelModal() {
            document.getElementById('cancelModal').classList.remove('active');
            document.getElementById('cancelReason').value = '';
            currentOrderId = null;
        }

        // Confirm cancel
        function confirmCancel() {
            if (!currentOrderId) return;

            const reason = document.getElementById('cancelReason').value;
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('cancelConfirmBtn').disabled = true;

            fetch(`/customer/orders/${currentOrderId}/cancel`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ reason: reason })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to cancel order: ' + (data.message || 'Unknown error'));
                }
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('cancelConfirmBtn').disabled = false;
                closeCancelModal();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to cancel order');
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('cancelConfirmBtn').disabled = false;
                closeCancelModal();
            });
        }

        // Reorder
        function reorder(orderId) {
            if (!confirm('Are you sure you want to reorder these items?')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/customer/orders/${orderId}/reorder`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/customer/cart';
                } else {
                    alert(data.message || 'Failed to reorder');
                }
                document.getElementById('loadingOverlay').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to reorder');
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        }
    </script>

</body>
</html>
