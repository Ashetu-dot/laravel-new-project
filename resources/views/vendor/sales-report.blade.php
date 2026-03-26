<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Sales Report - Vendora | Jimma, Ethiopia</title>
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

        /* Sales Report Specific Styles */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 32px;
        }

        .report-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-range {
            display: flex;
            gap: 8px;
            background-color: var(--card-bg);
            padding: 4px;
            border-radius: 40px;
            border: 1px solid var(--border-color);
        }

        .date-range-btn {
            padding: 8px 20px;
            border-radius: 30px;
            border: none;
            background: transparent;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .date-range-btn.active {
            background-color: var(--primary-gold);
            color: white;
        }

        .export-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .export-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
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
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .kpi-title {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .kpi-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
        }

        .trend-up { color: var(--success-color); }
        .trend-down { color: var(--accent-red); }

        .chart-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .chart-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .chart-legend {
            display: flex;
            gap: 24px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 4px;
        }

        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 240px;
            gap: 16px;
            margin-top: 30px;
        }

        .bar-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .bar {
            width: 100%;
            background: linear-gradient(to top, var(--primary-gold), #e6b450);
            border-radius: 8px 8px 0 0;
            transition: height 0.3s ease;
            min-height: 4px;
        }

        .bar-label {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .loading-overlay {
            position: relative;
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .top-products-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 768px) {
            .top-products-grid {
                grid-template-columns: 1fr;
            }
        }

        .insight-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .insight-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .product-rank-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .product-rank-item:last-child {
            border-bottom: none;
        }

        .product-rank-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rank-number {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .product-rank-detail h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .product-rank-detail p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .product-rank-value {
            font-weight: 700;
            color: var(--text-primary);
        }

        .payment-method-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .payment-method-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .payment-method-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-bar {
            width: 200px;
            height: 8px;
            background-color: #f3f4f6;
            border-radius: 20px;
            overflow: hidden;
        }

        .payment-bar-fill {
            height: 100%;
            background-color: var(--primary-gold);
            border-radius: 20px;
        }

        .recent-transactions {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .recent-transactions h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .transaction-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .transaction-row:last-child {
            border-bottom: none;
        }

        .transaction-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .transaction-detail h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .transaction-detail p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .transaction-amount {
            font-weight: 700;
        }

        .positive { color: var(--success-color); }
        .negative { color: var(--accent-red); }

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
            cursor: pointer;
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

        .bg-soft-gold { background-color: #fef3e7; color: var(--primary-gold); }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background-color: #fed7aa;
            color: #92400e;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
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
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.store', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-store-line"></i> My Store
                </a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">
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
                <a href="{{ route('vendor.sales-report') }}" class="nav-item active">
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
                <a href="{{ route('vendor.profile') }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('vendor.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
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
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->business_name ?? Auth::user()->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                @else
                    {{ strtoupper(substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2)) }}
                @endif
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
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-bar-chart-2-line" style="color: var(--primary-gold);"></i> Sales Report
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('vendor.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('vendor.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Sales Report Content -->
        <div class="dashboard-container">
            <!-- Header with date range -->
            <div class="report-header">
                <h1>📊 Sales Performance</h1>
                <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                    <div class="date-range" id="dateRangeFilter">
                        <button class="date-range-btn {{ $period === 'today' ? 'active' : '' }}" data-period="today">Today</button>
                        <button class="date-range-btn {{ $period === 'week' ? 'active' : '' }}" data-period="week">Week</button>
                        <button class="date-range-btn {{ $period === 'month' ? 'active' : '' }}" data-period="month">Month</button>
                        <button class="date-range-btn {{ $period === 'year' ? 'active' : '' }}" data-period="year">Year</button>
                    </div>
                    <button class="export-btn" id="exportBtn"><i class="ri-download-2-line"></i> Export</button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-title">Total Revenue</div>
                    <div class="kpi-value">ETB {{ number_format($totalRevenue, 2) }}</div>
                    <div class="kpi-trend {{ $revenueTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-{{ $revenueTrend >= 0 ? 'arrow-up' : 'arrow-down' }}-line"></i> 
                        {{ number_format(abs($revenueTrend), 1) }}% vs last period
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Orders</div>
                    <div class="kpi-value">{{ $totalOrders }}</div>
                    <div class="kpi-trend {{ $ordersTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-{{ $ordersTrend >= 0 ? 'arrow-up' : 'arrow-down' }}-line"></i> 
                        {{ number_format(abs($ordersTrend), 1) }}%
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Average Order Value</div>
                    <div class="kpi-value">ETB {{ number_format($averageOrderValue, 2) }}</div>
                    <div class="kpi-trend {{ $aovTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-{{ $aovTrend >= 0 ? 'arrow-up' : 'arrow-down' }}-line"></i> 
                        {{ number_format(abs($aovTrend), 1) }}%
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Conversion Rate</div>
                    <div class="kpi-value">{{ number_format($conversionRate, 1) }}%</div>
                    <div class="kpi-trend {{ $conversionTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-{{ $conversionTrend >= 0 ? 'arrow-up' : 'arrow-down' }}-line"></i> 
                        {{ number_format(abs($conversionTrend), 1) }}%
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Sales Trend (Last {{ count($chartData) }} days)</h3>
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-color" style="background: var(--primary-gold);"></span> This period</div>
                        <div class="legend-item"><span class="legend-color" style="background: #e5e7eb;"></span> Previous period</div>
                    </div>
                </div>
                <div class="bar-chart" id="salesChart">
                    @forelse($chartData as $item)
                        <div class="bar-wrapper">
                            <div class="bar" style="height: {{ $item['height'] }}px;"></div>
                            <div class="bar-label">{{ $item['label'] }}</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="ri-bar-chart-2-line"></i>
                            <p>No sales data available for this period</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Top Products & Payment Methods -->
            <div class="top-products-grid">
                <div class="insight-card">
                    <h3>🏆 Top Selling Products</h3>
                    @forelse($topProducts as $index => $product)
                        <div class="product-rank-item">
                            <div class="product-rank-info">
                                <span class="rank-number">{{ $index + 1 }}</span>
                                <div class="product-rank-detail">
                                    <h4>{{ $product['name'] }}</h4>
                                    <p>{{ $product['quantity'] }} units sold</p>
                                </div>
                            </div>
                            <div class="product-rank-value">ETB {{ number_format($product['revenue'], 2) }}</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="ri-shopping-bag-line"></i>
                            <p>No products sold yet</p>
                        </div>
                    @endforelse
                </div>

                <div class="insight-card">
                    <h3>💳 Payment Methods</h3>
                    <div class="payment-method-list">
                        @forelse($paymentMethods as $method)
                            <div>
                                <div class="payment-method-item">
                                    <span class="payment-method-name">
                                        @if($method['name'] == 'Cash on Delivery' || $method['name'] == 'cash')
                                            <i class="ri-bank-card-line"></i>
                                        @elseif($method['name'] == 'Mobile Money' || $method['name'] == 'telebirr')
                                            <i class="ri-phone-line"></i>
                                        @elseif($method['name'] == 'Bank Transfer' || $method['name'] == 'bank')
                                            <i class="ri-bank-line"></i>
                                        @else
                                            <i class="ri-secure-payment-line"></i>
                                        @endif
                                        {{ $method['name'] }}
                                    </span>
                                    <span>{{ $method['percentage'] }}%</span>
                                </div>
                                <div class="payment-bar">
                                    <div class="payment-bar-fill" style="width:{{ $method['percentage'] }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="ri-bank-card-line"></i>
                                <p>No payment data available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Transactions - FIXED: Changed $transactions to $recentTransactions -->
            <div class="recent-transactions">
                <h3>📋 Recent Transactions</h3>
                @forelse($recentTransactions as $transaction)
                    <div class="transaction-row">
                        <div class="transaction-info">
                            <div class="transaction-icon bg-soft-gold">
                                <i class="ri-shopping-bag-line"></i>
                            </div>
                            <div class="transaction-detail">
                                <h4>#{{ $transaction->order_number ?? 'ORD-' . $transaction->id }}</h4>
                                <p>
                                    <i class="ri-user-line" style="font-size: 12px; margin-right: 4px;"></i>
                                    {{ $transaction->user->name ?? 'Guest Customer' }} • 
                                    <i class="ri-shopping-bag-3-line" style="font-size: 12px; margin-right: 4px; margin-left: 4px;"></i>
                                    {{ $transaction->items->count() }} {{ Str::plural('item', $transaction->items->count()) }}
                                </p>
                                <small style="color: var(--text-secondary);">
                                    <i class="ri-time-line" style="font-size: 11px;"></i>
                                    {{ $transaction->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        <div class="transaction-amount positive">
                            <strong>ETB {{ number_format($transaction->total_amount, 2) }}</strong>
                            <div>
                                @php
                                    $statusColor = 'badge-success';
                                    if($transaction->status == 'pending') $statusColor = 'badge-warning';
                                    else if($transaction->status == 'cancelled') $statusColor = 'badge-danger';
                                    else if($transaction->status == 'processing') $statusColor = 'badge-info';
                                @endphp
                                <span class="badge {{ $statusColor }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="ri-history-line" style="font-size: 48px; color: var(--border-color);"></i>
                        <p style="margin-top: 16px; color: var(--text-secondary);">No transactions found for this period</p>
                        <p style="font-size: 13px; color: var(--text-secondary);">When you receive orders, they will appear here</p>
                    </div>
                @endforelse

                <!-- Pagination - FIXED: Changed $transactions to $recentTransactions with method check -->
                @if(method_exists($recentTransactions, 'hasPages') && $recentTransactions->hasPages())
                    <div class="pagination">
                        {{ $recentTransactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Loading Overlay for AJAX requests -->
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div style="text-align: center;">
            <div class="loading-spinner" style="width: 40px; height: 40px; border-width: 3px;"></div>
            <p style="margin-top: 16px; color: var(--primary-gold);">Loading...</p>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
                
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                    }
                });
            }

            // Date range filter with AJAX
            const dateRangeButtons = document.querySelectorAll('.date-range-btn');
            dateRangeButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Update active state
                    dateRangeButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const period = this.dataset.period;
                    
                    // Show loading overlay
                    document.getElementById('loadingOverlay').style.display = 'flex';
                    
                    // Fetch new data
                    fetch(`{{ route('vendor.sales-report') }}?period=${period}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update KPI cards
                        updateKPIs(data);
                        // Update chart
                        updateChart(data.chartData);
                        // Update top products
                        updateTopProducts(data.topProducts);
                        // Update payment methods
                        updatePaymentMethods(data.paymentMethods);
                        // Update transactions
                        updateTransactions(data.recentTransactions);
                        
                        // Store pagination HTML if available
                        if (data.pagination) {
                            window.paginationHtml = data.pagination;
                        }
                        
                        // Hide loading overlay
                        document.getElementById('loadingOverlay').style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('loadingOverlay').style.display = 'none';
                        alert('Failed to load data. Please try again.');
                    });
                });
            });

            // Export button
            document.getElementById('exportBtn')?.addEventListener('click', function() {
                const period = document.querySelector('.date-range-btn.active').dataset.period;
                window.location.href = `{{ route('vendor.export-sales') }}?period=${period}`;
            });

            // Auto-refresh every 5 minutes
            setInterval(() => {
                const activePeriod = document.querySelector('.date-range-btn.active').dataset.period;
                fetch(`{{ route('vendor.sales-report') }}?period=${activePeriod}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateKPIs(data);
                    updateChart(data.chartData);
                    updateTopProducts(data.topProducts);
                    updatePaymentMethods(data.paymentMethods);
                    updateTransactions(data.recentTransactions);
                    if (data.pagination) {
                        window.paginationHtml = data.pagination;
                    }
                })
                .catch(error => console.error('Auto-refresh error:', error));
            }, 300000); // 5 minutes
        });

        // Update functions
        function updateKPIs(data) {
            document.querySelector('.kpi-card:nth-child(1) .kpi-value').textContent = 'ETB ' + formatNumber(data.totalRevenue);
            document.querySelector('.kpi-card:nth-child(2) .kpi-value').textContent = data.totalOrders;
            document.querySelector('.kpi-card:nth-child(3) .kpi-value').textContent = 'ETB ' + formatNumber(data.averageOrderValue);
            document.querySelector('.kpi-card:nth-child(4) .kpi-value').textContent = data.conversionRate + '%';
            
            // Update trends
            updateTrend(document.querySelector('.kpi-card:nth-child(1) .kpi-trend'), data.revenueTrend);
            updateTrend(document.querySelector('.kpi-card:nth-child(2) .kpi-trend'), data.ordersTrend);
            updateTrend(document.querySelector('.kpi-card:nth-child(3) .kpi-trend'), data.aovTrend);
            updateTrend(document.querySelector('.kpi-card:nth-child(4) .kpi-trend'), data.conversionTrend);
        }

        function updateTrend(element, trend) {
            const icon = element.querySelector('i');
            
            if (trend >= 0) {
                element.className = 'kpi-trend trend-up';
                icon.className = 'ri-arrow-up-line';
            } else {
                element.className = 'kpi-trend trend-down';
                icon.className = 'ri-arrow-down-line';
            }
            // Keep the text content but update the number
            const textNode = element.childNodes[2];
            if (textNode) {
                element.innerHTML = icon.outerHTML + ' ' + Math.abs(trend).toFixed(1) + '% vs last period';
            }
        }

        function updateChart(chartData) {
            const chart = document.getElementById('salesChart');
            if (!chartData || chartData.length === 0) {
                chart.innerHTML = '<div class="empty-state"><i class="ri-bar-chart-2-line"></i><p>No sales data available for this period</p></div>';
                return;
            }
            
            let html = '';
            chartData.forEach(item => {
                html += `
                    <div class="bar-wrapper">
                        <div class="bar" style="height: ${item.height}px;" title="ETB ${formatNumber(item.value)}"></div>
                        <div class="bar-label">${item.label}</div>
                    </div>
                `;
            });
            chart.innerHTML = html;
        }

        function updateTopProducts(products) {
            const container = document.querySelector('.insight-card:first-child');
            if (!products || products.length === 0) {
                container.innerHTML = `
                    <h3>🏆 Top Selling Products</h3>
                    <div class="empty-state">
                        <i class="ri-shopping-bag-line"></i>
                        <p>No products sold yet</p>
                    </div>
                `;
                return;
            }
            
            let html = '<h3>🏆 Top Selling Products</h3>';
            products.forEach((product, index) => {
                html += `
                    <div class="product-rank-item">
                        <div class="product-rank-info">
                            <span class="rank-number">${index + 1}</span>
                            <div class="product-rank-detail">
                                <h4>${product.name || 'Product'}</h4>
                                <p>${product.quantity || 0} units sold</p>
                            </div>
                        </div>
                        <div class="product-rank-value">ETB ${formatNumber(product.revenue || 0)}</div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function updatePaymentMethods(methods) {
            const container = document.querySelector('.insight-card:last-child');
            if (!methods || methods.length === 0) {
                container.innerHTML = `
                    <h3>💳 Payment Methods</h3>
                    <div class="empty-state">
                        <i class="ri-bank-card-line"></i>
                        <p>No payment data available</p>
                    </div>
                `;
                return;
            }
            
            let html = '<h3>💳 Payment Methods</h3><div class="payment-method-list">';
            methods.forEach(method => {
                let icon = 'ri-bank-card-line';
                if (method.name === 'Cash on Delivery' || method.name === 'cash') icon = 'ri-bank-card-line';
                else if (method.name === 'Mobile Money' || method.name === 'telebirr') icon = 'ri-phone-line';
                else if (method.name === 'Bank Transfer' || method.name === 'bank') icon = 'ri-bank-line';
                else icon = 'ri-secure-payment-line';
                
                html += `
                    <div>
                        <div class="payment-method-item">
                            <span class="payment-method-name">
                                <i class="${icon}"></i>
                                ${method.name}
                            </span>
                            <span>${method.percentage || 0}%</span>
                        </div>
                        <div class="payment-bar">
                            <div class="payment-bar-fill" style="width:${method.percentage || 0}%"></div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        }

        function updateTransactions(transactions) {
            const container = document.querySelector('.recent-transactions');
            if (!transactions || transactions.length === 0) {
                container.innerHTML = `
                    <h3>📋 Recent Transactions</h3>
                    <div class="empty-state">
                        <i class="ri-history-line" style="font-size: 48px; color: var(--border-color);"></i>
                        <p style="margin-top: 16px; color: var(--text-secondary);">No transactions found for this period</p>
                    </div>
                `;
                return;
            }
            
            let html = '<h3>📋 Recent Transactions</h3>';
            transactions.forEach(transaction => {
                // Determine status color
                let statusClass = 'badge-success';
                let statusText = transaction.status || 'completed';
                if (statusText === 'pending') statusClass = 'badge-warning';
                else if (statusText === 'cancelled') statusClass = 'badge-danger';
                else if (statusText === 'processing') statusClass = 'badge-info';
                
                html += `
                    <div class="transaction-row">
                        <div class="transaction-info">
                            <div class="transaction-icon bg-soft-gold">
                                <i class="ri-shopping-bag-line"></i>
                            </div>
                            <div class="transaction-detail">
                                <h4>#${transaction.order_number || 'ORD-' + (transaction.id || '')}</h4>
                                <p>
                                    <i class="ri-user-line" style="font-size: 12px; margin-right: 4px;"></i>
                                    ${transaction.customer_name || transaction.user?.name || 'Customer'} • 
                                    <i class="ri-shopping-bag-3-line" style="font-size: 12px; margin-right: 4px; margin-left: 4px;"></i>
                                    ${transaction.items_count || transaction.items?.count || 0} items
                                </p>
                                <small style="color: var(--text-secondary);">
                                    <i class="ri-time-line" style="font-size: 11px;"></i>
                                    ${transaction.date || 'Just now'}
                                </small>
                            </div>
                        </div>
                        <div class="transaction-amount positive">
                            <strong>ETB ${formatNumber(transaction.amount || transaction.total_amount || 0)}</strong>
                            <div>
                                <span class="badge ${statusClass}">
                                    ${statusText.charAt(0).toUpperCase() + statusText.slice(1)}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            // Add pagination if exists
            if (window.paginationHtml) {
                html += `<div class="pagination">${window.paginationHtml}</div>`;
            }
            
            container.innerHTML = html;
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(number || 0);
        }
    </script>

</body>
</html>