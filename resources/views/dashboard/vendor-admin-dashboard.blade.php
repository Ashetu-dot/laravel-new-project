<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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

        @media (max-width: 1024px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                width: 200px;
            }
        }

        @media (max-width: 640px) {
            .search-bar {
                width: 160px;
            }
            .search-bar input {
                font-size: 13px;
            }
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

        .badge-dot {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 8px;
            height: 8px;
            background-color: var(--accent-red);
            border-radius: 50%;
            border: 2px solid var(--card-bg);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 11px;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dashboard Content */
        .dashboard-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 16px;
            }
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .breadcrumb {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* KPI Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1280px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }
        }

        .kpi-card {
            background-color: var(--card-bg);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .kpi-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: baseline;
        }

        .kpi-trend {
            font-size: 13px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .trend-up { color: var(--accent-green); }
        .trend-down { color: var(--accent-red); }

        .kpi-trend i { margin-right: 4px; }

        /* Chart Section */
        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .charts-row {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .card-actions select {
            padding: 6px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-secondary);
            outline: none;
            background-color: var(--card-bg);
        }

        .chart-placeholder {
            height: 300px;
            background-color: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 14px;
            position: relative;
        }

        /* Simulated Chart Bars */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 100%;
            width: 100%;
            padding: 20px 10px 40px;
        }

        .bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            height: 100%;
            justify-content: flex-end;
            width: 40px;
        }

        .bar {
            width: 100%;
            border-radius: 4px;
            transition: height 0.3s;
            position: relative;
        }

        .bar.revenue { background-color: var(--primary-gold); opacity: 0.8; }
        .bar.orders { background-color: var(--accent-blue); opacity: 0.6; }

        .bar-label {
            font-size: 12px;
            color: var(--text-secondary);
            position: absolute;
            bottom: -25px;
        }

        /* Quick Stats List */
        .quick-stats-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            font-size: 18px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-info h5 {
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-info span {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .stat-value {
            font-weight: 600;
            font-size: 14px;
        }

        /* Recent Activity Section */
        .recent-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .recent-section {
                grid-template-columns: 1fr;
            }
        }

        .table-container {
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
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-success { background-color: #d1fae5; color: #065f46; }
        .status-warning { background-color: #fef3c7; color: #92400e; }
        .status-danger { background-color: #fee2e2; color: #991b1b; }

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e5e7eb;
            object-fit: cover;
        }

        /* Notifications */
        .notification-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notif-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .notif-content {
            flex: 1;
        }

        .notif-content h6 {
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .notif-content p {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.4;
        }

        .notif-time {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
            display: block;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pagination-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-btn.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Color Utility Classes */
        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }

        .text-blue { color: var(--accent-blue); }
        .text-green { color: var(--accent-green); }
        .text-yellow { color: var(--accent-yellow); }
        .text-red { color: var(--accent-red); }
        .text-gold { color: var(--primary-gold); }

        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            height: 30px;
            border: 3px solid #f3f4f6;
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
    </style>
</head>
<body>

    <!-- Left Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                    @if($pendingOrdersCount ?? 0 > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Management</div>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                    @if($pendingVendorsCount ?? 0 > 0)
                        <span style="margin-left: auto; background-color: var(--accent-yellow); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingVendorsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Admin</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.roles') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Roles & Permissions
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>{{ Auth::user()->role ?? 'Super Admin' }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <form action="{{ route('admin.search') }}" method="GET" style="width: 100%; display: flex;">
                        <input type="text" name="query" placeholder="Search orders, customers, or vendors..." value="{{ request('query') }}">
                    </form>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if($unreadNotificationsCount ?? 0 > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <h1 class="page-title">Dashboard Overview</h1>
                <div class="breadcrumb">{{ $greeting ?? 'Welcome back' }}, {{ Auth::user()->name ?? 'Admin' }}. Here's what's happening with your marketplace today.</div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <!-- Total Revenue -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-green-light">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="kpi-label">Total Revenue</div>
                    <div class="kpi-value">${{ number_format($totalRevenue ?? 124592.00, 2) }}</div>
                    <div class="kpi-trend {{ ($revenueGrowth ?? 12.5) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($revenueGrowth ?? 12.5) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ abs($revenueGrowth ?? 12.5) }}% from last month</span>
                    </div>
                </div>

                <!-- Total Vendors -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-blue-light">
                        <i class="ri-store-line"></i>
                    </div>
                    <div class="kpi-label">Active Vendors</div>
                    <div class="kpi-value">{{ number_format($activeVendorsCount ?? 842) }}</div>
                    <div class="kpi-trend {{ ($vendorGrowth ?? 5.2) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($vendorGrowth ?? 5.2) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ abs($vendorGrowth ?? 5.2) }}% from last month</span>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-yellow-light">
                        <i class="ri-shopping-cart-2-line"></i>
                    </div>
                    <div class="kpi-label">Pending Orders</div>
                    <div class="kpi-value">{{ number_format($pendingOrdersCount ?? 156) }}</div>
                    <div class="kpi-trend {{ ($orderChange ?? -2.1) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($orderChange ?? -2.1) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ abs($orderChange ?? 2.1) }}% from yesterday</span>
                    </div>
                </div>

                <!-- Registered Customers -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-gold-light">
                        <i class="ri-group-line"></i>
                    </div>
                    <div class="kpi-label">Total Customers</div>
                    <div class="kpi-value">{{ number_format($totalCustomersCount ?? 12002) }}</div>
                    <div class="kpi-trend {{ ($customerGrowth ?? 8.4) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($customerGrowth ?? 8.4) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ abs($customerGrowth ?? 8.4) }}% from last month</span>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-row">
                <!-- Main Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Revenue & Orders</h3>
                        <div class="card-actions">
                            <form method="GET" action="{{ route('admin.dashboard') }}">
                                <select name="period" onchange="this.form.submit()">
                                    <option value="7" {{ ($period ?? 7) == 7 ? 'selected' : '' }}>Last 7 Days</option>
                                    <option value="30" {{ ($period ?? 7) == 30 ? 'selected' : '' }}>Last 30 Days</option>
                                    <option value="90" {{ ($period ?? 7) == 90 ? 'selected' : '' }}>Last 90 Days</option>
                                    <option value="365" {{ ($period ?? 7) == 365 ? 'selected' : '' }}>This Year</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <div class="bar-chart">
                            @foreach($chartData ?? [] as $day)
                            <div class="bar-group">
                                <div class="bar orders" style="height: {{ $day['orders_percent'] ?? 40 }}%;"></div>
                                <div class="bar revenue" style="height: {{ $day['revenue_percent'] ?? 60 }}%;"></div>
                                <span class="bar-label">{{ $day['label'] ?? 'Mon' }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Store Statistics</h3>
                    </div>
                    <div class="quick-stats-list">
                        <div class="stat-item">
                            <div class="stat-icon bg-blue-light text-blue">
                                <i class="ri-eye-line"></i>
                            </div>
                            <div class="stat-info">
                                <h5>Product Views</h5>
                                <span>Total page views today</span>
                            </div>
                            <div class="stat-value">{{ number_format($productViewsToday ?? 45200) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon bg-green-light text-green">
                                <i class="ri-check-double-line"></i>
                            </div>
                            <div class="stat-info">
                                <h5>Completed Orders</h5>
                                <span>Successfully delivered</span>
                            </div>
                            <div class="stat-value">{{ number_format($completedOrdersToday ?? 892) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon bg-yellow-light text-yellow">
                                <i class="ri-star-smile-line"></i>
                            </div>
                            <div class="stat-info">
                                <h5>New Reviews</h5>
                                <span>5-star ratings received</span>
                            </div>
                            <div class="stat-value">{{ number_format($newReviewsToday ?? 128) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon bg-purple-light" style="color: var(--accent-purple)">
                                <i class="ri-refund-2-line"></i>
                            </div>
                            <div class="stat-info">
                                <h5>Refund Requests</h5>
                                <span>Processing needed</span>
                            </div>
                            <div class="stat-value">{{ number_format($refundRequests ?? 12) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="recent-section">
                <!-- Recent Orders Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Orders</h3>
                        <a href="{{ route('admin.orders') }}" style="color: var(--primary-gold); font-size: 14px; text-decoration: none; font-weight: 500;">View All</a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td>#{{ $order->order_number ?? 'ORD-7782' }}</td>
                                    <td>
                                        <div class="customer-cell">
                                            <img src="{{ $order->customer->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&auto=format&fit=crop&w=64&q=80' }}" alt="Avatar" class="customer-avatar">
                                            <span>{{ $order->customer->name ?? 'Sarah Connor' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $order->product_name ?? 'Wireless Headphones' }}</td>
                                    <td>${{ number_format($order->amount ?? 129.00, 2) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $order->status_color ?? 'success' }}">
                                            {{ $order->status ?? 'Completed' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-secondary); padding: 40px;">
                                        No recent orders found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        {{ $recentOrders->links() ?? '' }}
                    </div>
                </div>

                <!-- Notifications Panel -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Notifications</h3>
                        <a href="{{ route('admin.notifications') }}" style="color: var(--primary-gold); font-size: 14px; text-decoration: none; font-weight: 500;">View All</a>
                    </div>
                    <div class="notifications-list">
                        @forelse($recentNotifications ?? [] as $notification)
                        <div class="notification-item">
                            <div class="notif-dot" style="background-color: {{ $notification->color ?? 'var(--accent-blue)' }};"></div>
                            <div class="notif-content">
                                <h6>{{ $notification->title ?? 'New Vendor Registration' }}</h6>
                                <p>{{ $notification->message ?? 'TechWorld Inc. has requested to join the platform.' }}</p>
                                <span class="notif-time">{{ $notification->created_at->diffForHumans() ?? '2 mins ago' }}</span>
                            </div>
                        </div>
                        @empty
                        <div style="text-align: center; color: var(--text-secondary); padding: 40px;">
                            <i class="ri-notification-off-line" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                            <p>No new notifications</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Mark notifications as read when clicked
            const notificationItems = document.querySelectorAll('.notification-item');
            notificationItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Add your notification read logic here
                    this.style.opacity = '0.7';
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
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
