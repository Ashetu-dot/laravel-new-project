<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Orders - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
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
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar */
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

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        /* Top Header */
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

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--primary-bg);
            padding: 8px 16px;
            border-radius: 8px;
            width: 400px;
        }

        .search-bar i {
            color: var(--text-secondary);
            margin-right: 8px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .order-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .order-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .order-stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .order-stat-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .order-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .order-stat-info {
            flex: 1;
        }

        .order-stat-label {
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .order-stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Filters */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .orders-header h3 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .order-filter-btn {
            padding: 6px 16px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            background: transparent;
            color: var(--text-secondary);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .order-filter-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .order-filter-btn.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-shipped { background-color: #ede9fe; color: #6d28d9; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }

        .order-actions {
            display: flex;
            gap: 8px;
        }

        .order-action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .order-action-btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .order-action-btn-primary:hover {
            background-color: #9c7832;
        }

        .order-action-btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .order-action-btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
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
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            border-left: 4px solid var(--primary-gold);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            border-left-color: var(--success-color);
        }

        .toast-error {
            border-left-color: var(--accent-red);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-secondary);
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px;
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
        }

        /* Logout Button */
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

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Action completed successfully!</div>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </button>
    </div>

    <!-- Order Details Modal -->
    <div class="modal-overlay" id="orderDetailsModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background-color: white; border-radius: 12px; width: 90%; max-width: 600px; max-height: 80vh; overflow-y: auto; padding: 32px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 20px;">Order Details</h3>
                <button onclick="closeOrderModal()" style="background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
            </div>
            <div id="orderDetailsContent"></div>
        </div>
    </div>

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
            <div class="nav-label">VENDOR</div>
            <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('vendor.show', Auth::user()->id) }}" class="nav-item">
                <i class="ri-store-line"></i> My Store
            </a>
            <a href="{{ route('vendor.orders.index') }}" class="nav-item active">
                <i class="ri-shopping-bag-3-line"></i> Orders
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-label">PRODUCTS</div>
            <a href="{{ route('vendor.products.create') }}" class="nav-item">
                <i class="ri-add-circle-line"></i> Add Product
            </a>
            <a href="{{ route('vendor.products.index') }}" class="nav-item">
                <i class="ri-list-check"></i> Manage Products
            </a>
            <a href="{{ route('vendor.categories.index') }}" class="nav-item">
                <i class="ri-price-tag-3-line"></i> Categories
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-label">ANALYTICS</div>
            <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                <i class="ri-bar-chart-2-line"></i> Sales Report
            </a>
            <a href="{{ route('vendor.store-views') }}" class="nav-item">
                <i class="ri-eye-line"></i> Store Views
            </a>
            <a href="{{ route('vendor.reviews.index') }}" class="nav-item">
                <i class="ri-star-line"></i> Reviews
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-label">SETTINGS</div>
            <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-item">
                <i class="ri-user-line"></i> Profile
            </a>
            <a href="{{ route('profile.edit', Auth::user()->id) }}" class="nav-item">
                <i class="ri-settings-4-line"></i> Store Settings
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="ri-logout-box-line"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="user-profile">
        <div class="avatar">
            {{ substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2) }}
        </div>
        <div class="user-info">
            <h4>{{ Auth::user()->business_name ?? Auth::user()->name }}</h4>
            <p>Vendor since {{ Auth::user()->created_at->format('M Y') }}</p>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search orders by customer name or order ID...">
                </div>
            </div>
            <div class="header-actions">
                <a href="#" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
                <a href="#" class="icon-btn">
                    <i class="ri-mail-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Orders Management</h1>
                    <p class="page-subtitle">Track and manage all customer orders</p>
                </div>
                <div>
                    <span class="order-status status-pending">Last updated: {{ now()->format('M d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Order Stats -->
            <div class="order-stats-grid">
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-blue-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Total Orders</div>
                        <div class="order-stat-value">{{ $totalOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-yellow-light">
                        <i class="ri-time-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Pending</div>
                        <div class="order-stat-value">{{ $pendingOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-purple-light">
                        <i class="ri-refresh-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Processing</div>
                        <div class="order-stat-value">{{ $processingOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-green-light">
                        <i class="ri-check-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Completed</div>
                        <div class="order-stat-value">{{ $completedOrders }}</div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="orders-header">
                <h3>
                    <i class="ri-shopping-bag-3-line" style="color: var(--primary-gold);"></i>
                    All Orders
                </h3>
                <div class="order-filters">
                    <button class="order-filter-btn active" onclick="filterOrders('all')">All</button>
                    <button class="order-filter-btn" onclick="filterOrders('pending')">Pending</button>
                    <button class="order-filter-btn" onclick="filterOrders('processing')">Processing</button>
                    <button class="order-filter-btn" onclick="filterOrders('shipped')">Shipped</button>
                    <button class="order-filter-btn" onclick="filterOrders('delivered')">Delivered</button>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-container">
                <table id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="order-row" data-status="{{ $order->status }}">
                            <td><strong>#{{ $order->order_number }}</strong></td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ substr($order->customer_name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">{{ $order->customer_name }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">{{ $order->customer_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $order->date->format('M d, Y') }}</div>
                                <div style="font-size: 12px; color: var(--text-secondary);">{{ $order->date->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="order-items-preview">
                                    @foreach($order->items as $item)
                                        {{ $item['name'] }} x{{ $item['quantity'] }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td><strong>ETB {{ number_format($order->total) }}</strong></td>
                            <td>
                                <span class="order-status status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn order-action-btn-secondary" onclick="viewOrderDetails('{{ $order->order_number }}')" title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                <i class="ri-shopping-bag-3-line empty-icon"></i>
                                <h3 class="empty-title">No orders yet</h3>
                                <p class="empty-text">When customers place orders, they will appear here.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Back to Dashboard -->
            <div style="margin-top: 24px;">
                <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </main>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (type === 'success') {
                toastIcon.innerHTML = '<i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>';
            } else {
                toastIcon.innerHTML = '<i class="ri-error-warning-line" style="color: var(--accent-red);"></i>';
            }

            toast.classList.add('show');
            setTimeout(hideToast, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        function filterOrders(status) {
            document.querySelectorAll('.order-filter-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            document.querySelectorAll('.order-row').forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function viewOrderDetails(orderId) {
            const orders = @json($orders);
            const order = orders.find(o => o.order_number === orderId);

            if (!order) return;

            let itemsHtml = '';
            order.items.forEach(item => {
                itemsHtml += `<tr>
                    <td>${item.name}</td>
                    <td>ETB ${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>ETB ${item.price * item.quantity}</td>
                </tr>`;
            });

            const content = `
                <div style="margin-bottom: 24px;">
                    <h4 style="margin-bottom: 12px;">Order #${order.order_number}</h4>
                    <div style="background: #f9fafb; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
                        <p><strong>Customer:</strong> ${order.customer_name}</p>
                        <p><strong>Email:</strong> ${order.customer_email}</p>
                        <p><strong>Phone:</strong> ${order.customer_phone}</p>
                        <p><strong>Address:</strong> ${order.shipping_address}</p>
                        <p><strong>Payment Method:</strong> ${order.payment_method}</p>
                    </div>
                    <h4 style="margin-bottom: 12px;">Order Items</h4>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${itemsHtml}
                            <tr style="font-weight: 600;">
                                <td colspan="3" style="text-align: right;">Total:</td>
                                <td>ETB ${order.total}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="margin-top: 16px;">
                        <p><strong>Status:</strong> <span class="order-status status-${order.status}">${order.status}</span></p>
                        <p><strong>Order Date:</strong> ${new Date(order.date).toLocaleDateString()}</p>
                    </div>
                </div>
            `;

            document.getElementById('orderDetailsContent').innerHTML = content;
            document.getElementById('orderDetailsModal').style.display = 'flex';
        }

        function closeOrderModal() {
            document.getElementById('orderDetailsModal').style.display = 'none';
        }

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });

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
