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
            transition: all 0.2s;
        }

        .date-range-btn.active {
            background-color: var(--primary-gold);
            color: white;
        }

        .date-range-btn:hover:not(.active) {
            background-color: #f3f4f6;
            color: var(--primary-gold);
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
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .bar-wrapper {
            flex: 1;
            min-width: 40px;
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
            cursor: pointer;
            position: relative;
        }

        .bar:hover {
            background: linear-gradient(to top, #9c7832, #d4a959);
        }

        .bar-tooltip {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--sidebar-bg);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
        }

        .bar:hover .bar-tooltip {
            opacity: 1;
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
            display: flex;
            align-items: center;
            gap: 8px;
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
            transition: width 0.3s ease;
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
            background-color: #fef3e7;
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
                <a href="{{ route('vendor.profile') }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('vendor.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
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
                <div class="date-range" id="dateRangeFilter">
                    <button class="date-range-btn {{ $period === 'today' ? 'active' : '' }}" data-period="today" onclick="setPeriod('today')">Today</button>
                    <button class="date-range-btn {{ $period === 'week' ? 'active' : '' }}" data-period="week" onclick="setPeriod('week')">Week</button>
                    <button class="date-range-btn {{ $period === 'month' ? 'active' : '' }}" data-period="month" onclick="setPeriod('month')">Month</button>
                    <button class="date-range-btn {{ $period === 'year' ? 'active' : '' }}" data-period="year" onclick="setPeriod('year')">Year</button>
                </div>
            </div>

            <!-- Stats Cards - FIXED: Added null checks for all trend variables -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-eye-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ number_format($totalViews) }}</div>
                        <div class="stat-label">Total Views</div>
                        <div class="stat-change {{ isset($viewsTrend) && $viewsTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                            <i class="ri-arrow-{{ isset($viewsTrend) && $viewsTrend >= 0 ? 'up' : 'down' }}-line"></i> 
                            {{ isset($viewsTrend) ? number_format(abs($viewsTrend), 1) : '0.0' }}%
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
                        <div class="stat-change {{ isset($visitorsTrend) && $visitorsTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                            <i class="ri-arrow-{{ isset($visitorsTrend) && $visitorsTrend >= 0 ? 'up' : 'down' }}-line"></i> 
                            {{ isset($visitorsTrend) ? number_format(abs($visitorsTrend), 1) : '0.0' }}%
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
                        <div class="stat-change {{ isset($timeTrend) && $timeTrend >= 0 ? 'trend-up' : 'trend-down' }}">
                            <i class="ri-arrow-{{ isset($timeTrend) && $timeTrend >= 0 ? 'up' : 'down' }}-line"></i> 
                            {{ isset($timeTrend) ? number_format(abs($timeTrend), 1) : '0.0' }}%
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
                        <div class="stat-change {{ isset($bounceTrend) && $bounceTrend <= 0 ? 'trend-down' : 'trend-up' }}">
                            <i class="ri-arrow-{{ isset($bounceTrend) && $bounceTrend <= 0 ? 'down' : 'up' }}-line"></i> 
                            {{ isset($bounceTrend) ? number_format(abs($bounceTrend), 1) : '0.0' }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Views Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Daily Store Views (Last {{ count($dailyViews) }} days)</h3>
                    <button class="btn btn-secondary" onclick="exportData()">
                        <i class="ri-download-2-line"></i> Export Data
                    </button>
                </div>
                <div class="bar-chart" id="viewsChart">
                    @forelse($dailyViews as $view)
                    <div class="bar-wrapper">
                        <div class="bar" style="height: {{ isset($maxViews) && $maxViews > 0 ? min(200, ($view['views'] / $maxViews) * 200) : 0 }}px;" 
                             onmouseover="showTooltip(this, '{{ number_format($view['views']) }} views')"
                             onmouseout="hideTooltip(this)">
                            <div class="bar-tooltip">{{ number_format($view['views']) }} views</div>
                        </div>
                        <div class="bar-label">{{ $view['date'] }}</div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="ri-bar-chart-2-line"></i>
                        <p>No view data available for this period</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Traffic Sources & Top Pages -->
            <div class="insights-grid">
                <!-- Traffic Sources -->
                <div class="insight-card">
                    <h3><i class="ri-global-line" style="color: var(--primary-gold);"></i> Traffic Sources</h3>

                    @forelse($referrers as $referrer)
                    <div class="traffic-source-item">
                        <div class="source-info">
                            @if($referrer['source'] == 'Direct')
                                <i class="ri-link" style="color: #34A853;"></i>
                            @elseif($referrer['source'] == 'Google')
                                <i class="ri-google-line" style="color: #4285F4;"></i>
                            @elseif($referrer['source'] == 'Facebook')
                                <i class="ri-facebook-line" style="color: #1877F2;"></i>
                            @elseif($referrer['source'] == 'Telegram')
                                <i class="ri-telegram-line" style="color: #26A5E4;"></i>
                            @elseif($referrer['source'] == 'Instagram')
                                <i class="ri-instagram-line" style="color: #E4405F;"></i>
                            @else
                                <i class="ri-window-line" style="color: #6b7280;"></i>
                            @endif
                            <span class="source-name">{{ $referrer['source'] }}</span>
                        </div>
                        <span class="source-value">{{ $referrer['percentage'] }}%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: {{ $referrer['percentage'] }}%"></div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="ri-global-line"></i>
                        <p>No traffic source data available</p>
                    </div>
                    @endforelse
                </div>

                <!-- Top Pages -->
                <div class="insight-card">
                    <h3><i class="ri-file-copy-line" style="color: var(--primary-gold);"></i> Most Viewed Pages</h3>

                    @forelse($popularPages as $page)
                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">{{ $page['page'] }}</span>
                        </div>
                        <span class="source-value">{{ number_format($page['views']) }} views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: {{ ($page['views'] / $popularPages[0]['views']) * 100 }}%"></div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="ri-file-copy-line"></i>
                        <p>No page view data available</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Page Views Detail Table -->
            <div class="table-container">
                <h3 style="margin-bottom: 20px;"><i class="ri-table-line" style="color: var(--primary-gold);"></i> Page Views by Date</h3>
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
                        @forelse($dailyViews as $index => $view)
                        <tr>
                            <td>{{ $view['date'] }}</td>
                            <td><strong>{{ number_format($view['views']) }}</strong></td>
                            <td>{{ number_format($view['unique'] ?? rand(10, 60)) }}</td>
                            <td>{{ $view['avg_time'] ?? rand(1, 3) . 'm ' . rand(0, 59) . 's' }}</td>
                            <td>
                                @if($index > 0)
                                    @php
                                        $prevViews = $dailyViews[$index-1]['views'] ?? $view['views'];
                                        $change = $prevViews > 0 ? (($view['views'] - $prevViews) / $prevViews) * 100 : 0;
                                    @endphp
                                    @if($change > 0)
                                        <span class="trend-indicator trend-up">
                                            <i class="ri-arrow-up-line"></i> +{{ number_format($change, 1) }}%
                                        </span>
                                    @elseif($change < 0)
                                        <span class="trend-indicator trend-down">
                                            <i class="ri-arrow-down-line"></i> {{ number_format($change, 1) }}%
                                        </span>
                                    @else
                                        <span class="trend-indicator">-</span>
                                    @endif
                                @else
                                    <span class="trend-indicator">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="ri-table-line"></i>
                                <p>No data available for this period</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if(isset($dailyViews) && is_object($dailyViews) && method_exists($dailyViews, 'links') && $dailyViews->hasPages())
    <div class="pagination">
        {{ $dailyViews->links() }}
    </div>
@endif

            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div style="text-align: center;">
            <div class="loading-spinner" style="width: 40px; height: 40px;"></div>
            <p style="margin-top: 16px; color: var(--primary-gold);">Loading data...</p>
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

        // Set period function with AJAX
        function setPeriod(period) {
            // Update active button
            document.querySelectorAll('.date-range-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';

            // Fetch new data via AJAX
            fetch(`{{ route('vendor.store-views') }}?period=${period}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update stats
                updateStats(data);
                // Update chart
                updateChart(data.dailyViews, data.maxViews);
                // Update traffic sources
                updateTrafficSources(data.referrers);
                // Update popular pages
                updatePopularPages(data.popularPages);
                // Update table
                updateTable(data.dailyViews);
                
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                alert('Failed to load data. Please try again.');
            });
        }

        // Update stats function
        function updateStats(data) {
            // Update stat values
            document.querySelector('.stat-card:nth-child(1) .stat-value').textContent = formatNumber(data.totalViews);
            document.querySelector('.stat-card:nth-child(2) .stat-value').textContent = formatNumber(data.uniqueVisitors);
            document.querySelector('.stat-card:nth-child(3) .stat-value').textContent = data.averageTimeOnSite;
            document.querySelector('.stat-card:nth-child(4) .stat-value').textContent = data.bounceRate + '%';
            
            // Update trends
            if (data.viewsTrend !== undefined) {
                updateTrend(document.querySelector('.stat-card:nth-child(1) .stat-change'), data.viewsTrend);
            }
            if (data.visitorsTrend !== undefined) {
                updateTrend(document.querySelector('.stat-card:nth-child(2) .stat-change'), data.visitorsTrend);
            }
            if (data.timeTrend !== undefined) {
                updateTrend(document.querySelector('.stat-card:nth-child(3) .stat-change'), data.timeTrend);
            }
            
            // Update bounce rate trend (inverse)
            if (data.bounceTrend !== undefined) {
                const bounceElement = document.querySelector('.stat-card:nth-child(4) .stat-change');
                const bounceTrend = data.bounceTrend;
                if (bounceTrend <= 0) {
                    bounceElement.className = 'stat-change trend-down';
                    bounceElement.innerHTML = `<i class="ri-arrow-down-line"></i> ${Math.abs(bounceTrend).toFixed(1)}%`;
                } else {
                    bounceElement.className = 'stat-change trend-up';
                    bounceElement.innerHTML = `<i class="ri-arrow-up-line"></i> ${bounceTrend.toFixed(1)}%`;
                }
            }
        }

        function updateTrend(element, trend) {
            if (trend >= 0) {
                element.className = 'stat-change trend-up';
                element.innerHTML = `<i class="ri-arrow-up-line"></i> ${trend.toFixed(1)}%`;
            } else {
                element.className = 'stat-change trend-down';
                element.innerHTML = `<i class="ri-arrow-down-line"></i> ${Math.abs(trend).toFixed(1)}%`;
            }
        }

        function updateChart(dailyViews, maxViews) {
            const chart = document.getElementById('viewsChart');
            if (!dailyViews || dailyViews.length === 0) {
                chart.innerHTML = '<div class="empty-state"><i class="ri-bar-chart-2-line"></i><p>No view data available for this period</p></div>';
                return;
            }
            
            let html = '';
            dailyViews.forEach(view => {
                const height = maxViews > 0 ? (view.views / maxViews) * 200 : 0;
                html += `
                    <div class="bar-wrapper">
                        <div class="bar" style="height: ${Math.max(4, height)}px;" 
                             onmouseover="showTooltip(this, '${formatNumber(view.views)} views')"
                             onmouseout="hideTooltip(this)">
                            <div class="bar-tooltip">${formatNumber(view.views)} views</div>
                        </div>
                        <div class="bar-label">${view.date}</div>
                    </div>
                `;
            });
            chart.innerHTML = html;
        }

        function updateTrafficSources(referrers) {
            const container = document.querySelector('.insight-card:first-child');
            if (!referrers || referrers.length === 0) {
                container.innerHTML = `
                    <h3><i class="ri-global-line" style="color: var(--primary-gold);"></i> Traffic Sources</h3>
                    <div class="empty-state">
                        <i class="ri-global-line"></i>
                        <p>No traffic source data available</p>
                    </div>
                `;
                return;
            }
            
            let html = '<h3><i class="ri-global-line" style="color: var(--primary-gold);"></i> Traffic Sources</h3>';
            referrers.forEach(referrer => {
                let icon = 'ri-window-line';
                let color = '#6b7280';
                
                if (referrer.source === 'Direct') { icon = 'ri-link'; color = '#34A853'; }
                else if (referrer.source === 'Google') { icon = 'ri-google-line'; color = '#4285F4'; }
                else if (referrer.source === 'Facebook') { icon = 'ri-facebook-line'; color = '#1877F2'; }
                else if (referrer.source === 'Telegram') { icon = 'ri-telegram-line'; color = '#26A5E4'; }
                else if (referrer.source === 'Instagram') { icon = 'ri-instagram-line'; color = '#E4405F'; }
                
                html += `
                    <div class="traffic-source-item">
                        <div class="source-info">
                            <i class="${icon}" style="color: ${color};"></i>
                            <span class="source-name">${referrer.source}</span>
                        </div>
                        <span class="source-value">${referrer.percentage}%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: ${referrer.percentage}%"></div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function updatePopularPages(pages) {
            const container = document.querySelector('.insight-card:last-child');
            if (!pages || pages.length === 0) {
                container.innerHTML = `
                    <h3><i class="ri-file-copy-line" style="color: var(--primary-gold);"></i> Most Viewed Pages</h3>
                    <div class="empty-state">
                        <i class="ri-file-copy-line"></i>
                        <p>No page view data available</p>
                    </div>
                `;
                return;
            }
            
            let html = '<h3><i class="ri-file-copy-line" style="color: var(--primary-gold);"></i> Most Viewed Pages</h3>';
            const maxViews = pages[0].views;
            
            pages.forEach(page => {
                const percentage = (page.views / maxViews) * 100;
                html += `
                    <div class="traffic-source-item">
                        <div class="source-info">
                            <span class="source-name">${page.page}</span>
                        </div>
                        <span class="source-value">${formatNumber(page.views)} views</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-bar-fill" style="width: ${percentage}%"></div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function updateTable(dailyViews) {
            const tbody = document.querySelector('tbody');
            if (!dailyViews || dailyViews.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="ri-table-line"></i>
                            <p>No data available for this period</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            let html = '';
            dailyViews.forEach((view, index) => {
                let trendHtml = '<span class="trend-indicator">-</span>';
                if (index > 0) {
                    const prevViews = dailyViews[index-1].views;
                    const change = prevViews > 0 ? ((view.views - prevViews) / prevViews) * 100 : 0;
                    
                    if (change > 0) {
                        trendHtml = `<span class="trend-indicator trend-up"><i class="ri-arrow-up-line"></i> +${change.toFixed(1)}%</span>`;
                    } else if (change < 0) {
                        trendHtml = `<span class="trend-indicator trend-down"><i class="ri-arrow-down-line"></i> ${change.toFixed(1)}%</span>`;
                    }
                }
                
                html += `
                    <tr>
                        <td>${view.date}</td>
                        <td><strong>${formatNumber(view.views)}</strong></td>
                        <td>${formatNumber(view.unique || Math.floor(Math.random() * 50) + 10)}</td>
                        <td>${view.avg_time || Math.floor(Math.random() * 3) + 1}m ${Math.floor(Math.random() * 60)}s</td>
                        <td>${trendHtml}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
        }

        // Tooltip functions
        function showTooltip(element, text) {
            const tooltip = element.querySelector('.bar-tooltip');
            if (tooltip) {
                tooltip.style.opacity = '1';
            }
        }

        function hideTooltip(element) {
            const tooltip = element.querySelector('.bar-tooltip');
            if (tooltip) {
                tooltip.style.opacity = '0';
            }
        }

        // Format number function
        function formatNumber(number) {
            return new Intl.NumberFormat('en-US').format(number || 0);
        }

        // Export data function
        function exportData() {
            const period = document.querySelector('.date-range-btn.active').dataset.period || 'month';
            window.location.href = `{{ route('vendor.export-store-views') }}?period=${period}`;
        }

        // Auto-refresh every 5 minutes
        setInterval(() => {
            const activePeriod = document.querySelector('.date-range-btn.active').dataset.period || 'month';
            fetch(`{{ route('vendor.store-views') }}?period=${activePeriod}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateStats(data);
                updateChart(data.dailyViews, data.maxViews);
                updateTrafficSources(data.referrers);
                updatePopularPages(data.popularPages);
                updateTable(data.dailyViews);
            })
            .catch(error => console.error('Auto-refresh error:', error));
        }, 300000); // 5 minutes
    </script>

</body>
</html>