<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Store Views - Vendora | Jimma, Ethiopia</title>
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
            margin-top: 8px;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Date Range */
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

        /* Stats Grid */
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

        /* Chart Container */
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

        /* Bar Chart */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 240px;
            gap: 8px;
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
            font-size: 11px;
            color: var(--text-secondary);
            transform: rotate(-45deg);
            white-space: nowrap;
        }

        /* Insights Grid */
        .insights-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 768px) {
            .insights-grid {
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

        .traffic-source-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .traffic-source-item:last-child {
            border-bottom: none;
        }

        .source-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .source-name {
            font-weight: 500;
        }

        .source-value {
            font-weight: 600;
        }

        .source-bar {
            width: 100%;
            height: 8px;
            background-color: #f3f4f6;
            border-radius: 20px;
            overflow: hidden;
            margin: 8px 0;
        }

        .source-bar-fill {
            height: 100%;
            background-color: var(--primary-gold);
            border-radius: 20px;
        }

        /* Page Views Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .trend-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
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

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
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
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.show', Auth::user()->id) }}" class="nav-item">
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
                <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Sales Report
                </a>
                <a href="{{ route('vendor.store-views') }}" class="nav-item active">
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
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-eye-line" style="color: var(--primary-gold);"></i> Store Views Analytics
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

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-eye-line" style="color: var(--primary-gold);"></i>
                        Store Views Analytics
                    </h1>
                    <p>Track your store's visibility and customer engagement</p>
                </div>
                <div class="date-range">
                    <button class="date-range-btn active" onclick="setPeriod('today')">Today</button>
                    <button class="date-range-btn" onclick="setPeriod('week')">Week</button>
                    <button class="date-range-btn" onclick="setPeriod('month')">Month</button>
                    <button class="date-range-btn" onclick="setPeriod('year')">Year</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-eye-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ number_format($totalViews) }}</div>
                        <div class="stat-label">Total Views</div>
                        <div class="stat-change trend-up">
                            <i class="ri-arrow-up-line"></i> +12.5%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-user-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ number_format($uniqueVisitors) }}</div>
                        <div class="stat-label">Unique Visitors</div>
                        <div class="stat-change trend-up">
                            <i class="ri-arrow-up-line"></i> +8.3%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-timer-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $averageTimeOnSite }}</div>
                        <div class="stat-label">Avg. Time on Site</div>
                        <div class="stat-change trend-up">
                            <i class="ri-arrow-up-line"></i> +2.1%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-gold-light">
                        <i class="ri-percent-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $bounceRate }}%</div>
                        <div class="stat-label">Bounce Rate</div>
                        <div class="stat-change trend-down">
                            <i class="ri-arrow-down-line"></i> -3.2%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Views Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Daily Store Views (Last 30 Days)</h3>
                    <button class="btn btn-secondary" onclick="exportChart()">
                        <i class="ri-download-2-line"></i> Export
                    </button>
                </div>
                <div class="bar-chart">
                    @foreach($dailyViews as $view)
                    <div class="bar-wrapper">
                        <div class="bar" style="height: {{ min(200, ($view['views'] / 100) * 200) }}px;"></div>
                        <div class="bar-label">{{ $view['date'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Traffic Sources & Top Pages -->
            <div class="insights-grid">
                <!-- Traffic Sources -->
                <div class="insight-card">
                    <h3>🌐 Traffic Sources</h3>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <i class="ri-google-line" style="color: #4285F4;"></i>
                            <span class="source-name">Organic Search</span>
                        </div>
                        <span class="source-value">45%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 45%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <i class="ri-facebook-line" style="color: #1877F2;"></i>
                            <span class="source-name">Social Media</span>
                        </div>
                        <span class="source-value">28%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 28%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <i class="ri-mail-line" style="color: #EA4335;"></i>
                            <span class="source-name">Email Marketing</span>
                        </div>
                        <span class="source-value">15%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 15%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <i class="ri-link" style="color: #34A853;"></i>
                            <span class="source-name">Direct</span>
                        </div>
                        <span class="source-value">12%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 12%"></div>
                    </div>
                </div>

                <!-- Top Pages -->
                <div class="insight-card">
                    <h3>📄 Most Viewed Pages</h3>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">Homepage</span>
                        </div>
                        <span class="source-value">1,245 views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 100%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">Products Page</span>
                        </div>
                        <span class="source-value">892 views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 72%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">Coffee Collection</span>
                        </div>
                        <span class="source-value">567 views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 46%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">About Us</span>
                        </div>
                        <span class="source-value">234 views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 19%"></div>
                    </div>

                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">Contact Page</span>
                        </div>
                        <span class="source-value">156 views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: 13%"></div>
                    </div>
                </div>
            </div>

            <!-- Page Views Detail Table -->
            <div class="table-container">
                <h3 style="margin-bottom: 20px;">📊 Page Views by Date</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Page Views</th>
                            <th>Unique Visitors</th>
                            <th>Avg. Time</th>
                            <th>Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_slice($dailyViews, 0, 10) as $index => $view)
                        <tr>
                            <td>{{ $view['date'] }}</td>
                            <td><strong>{{ number_format($view['views']) }}</strong></td>
                            <td>{{ number_format(rand(10, 60)) }}</td>
                            <td>{{ rand(1, 3) }}m {{ rand(0, 59) }}s</td>
                            <td>
                                @if($index > 0 && $view['views'] > ($dailyViews[$index-1]['views'] ?? 0))
                                    <span class="trend-indicator trend-up">
                                        <i class="ri-arrow-up-line"></i> +{{ round(($view['views'] - ($dailyViews[$index-1]['views'] ?? 0)) / ($dailyViews[$index-1]['views'] ?? 1) * 100) }}%
                                    </span>
                                @elseif($index > 0)
                                    <span class="trend-indicator trend-down">
                                        <i class="ri-arrow-down-line"></i> -{{ round((($dailyViews[$index-1]['views'] ?? 0) - $view['views']) / ($dailyViews[$index-1]['views'] ?? 1) * 100) }}%
                                    </span>
                                @else
                                    <span class="trend-indicator">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <a href="#" class="pagination-item"><i class="ri-arrow-left-s-line"></i></a>
                    <a href="#" class="pagination-item active">1</a>
                    <a href="#" class="pagination-item">2</a>
                    <a href="#" class="pagination-item">3</a>
                    <a href="#" class="pagination-item"><i class="ri-arrow-right-s-line"></i></a>
                </div>
            </div>
        </div>
    </main>

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

        // Set period function
        function setPeriod(period) {
            // Update active button
            document.querySelectorAll('.date-range-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Reload with period parameter
            window.location.href = '{{ route("vendor.store-views") }}?period=' + period;
        }

        // Export chart function
        function exportChart() {
            alert('Export functionality will be available soon!');
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
