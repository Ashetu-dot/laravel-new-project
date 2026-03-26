<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Analytics - Vendora Admin | Jimma, Ethiopia</title>
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

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header h1 i {
            color: var(--primary-gold);
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

        /* KPI Cards */
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
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
        }

        .kpi-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .kpi-details {
            flex: 1;
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .kpi-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .kpi-change {
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

        /* Chart Cards */
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-header h3 i {
            color: var(--primary-gold);
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

        /* Bar Chart */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 240px;
            gap: 16px;
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

        /* Pie Chart Placeholder */
        .pie-chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 240px;
        }

        .pie-chart {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: conic-gradient(
                var(--accent-blue) 0deg 144deg,
                var(--accent-green) 144deg 252deg,
                var(--accent-yellow) 252deg 324deg,
                var(--accent-red) 324deg 360deg
            );
            margin-bottom: 24px;
        }

        .pie-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        /* Tables Grid */
        .tables-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .tables-grid {
                grid-template-columns: 1fr;
            }
        }

        .table-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .table-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-card h3 i {
            color: var(--primary-gold);
        }

        .vendor-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .vendor-item:last-child {
            border-bottom: none;
        }

        .vendor-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .vendor-rank {
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

        .vendor-name {
            font-weight: 600;
        }

        .vendor-meta {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .vendor-stats {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        .product-name {
            font-weight: 600;
        }

        .product-category {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .product-sales {
            font-weight: 600;
            color: var(--accent-blue);
        }

        /* Insights Section */
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

        .insight-card h3 i {
            color: var(--primary-gold);
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .metric-row:last-child {
            border-bottom: none;
        }

        .metric-label {
            color: var(--text-secondary);
        }

        .metric-value {
            font-weight: 600;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #f3f4f6;
            border-radius: 20px;
            overflow: hidden;
            margin: 12px 0;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--primary-gold);
            border-radius: 20px;
        }

        /* Export Button */
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
            font-size: 14px;
        }

        .export-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
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
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 12px;
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
            padding: 60px 20px;
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
                <div class="nav-label">DASHBOARD</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-line"></i> Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-line"></i> Vendors
                </a>
                <a href="{{ route('admin.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i> Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item active">
                    <i class="ri-bar-chart-2-line"></i> Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i> Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SYSTEM</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i> Administrators
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
                </a>
                <a href="{{ route('admin.documentation') }}" class="nav-item">
                    <i class="ri-book-open-line"></i> Documentation
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
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
                <p>Administrator</p>
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
                    <i class="ri-bar-chart-2-line" style="color: var(--primary-gold);"></i> Analytics
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Analytics Content -->
        <div class="dashboard-container">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-bar-chart-2-line"></i>
                        Analytics Dashboard
                    </h1>
                    <p>Track your marketplace performance and key metrics</p>
                </div>
                <div class="date-range" id="dateRangeFilter">
                    <button class="date-range-btn {{ $period == 7 ? 'active' : '' }}" data-period="7" onclick="setPeriod(7)">7 Days</button>
                    <button class="date-range-btn {{ $period == 30 ? 'active' : '' }}" data-period="30" onclick="setPeriod(30)">30 Days</button>
                    <button class="date-range-btn {{ $period == 90 ? 'active' : '' }}" data-period="90" onclick="setPeriod(90)">90 Days</button>
                    <button class="date-range-btn {{ $period == 365 ? 'active' : '' }}" data-period="365" onclick="setPeriod(365)">Year</button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-icon bg-green-light">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="kpi-details">
                        <div class="kpi-value">ETB {{ number_format($salesData->sum('total') ?? 0, 2) }}</div>
                        <div class="kpi-label">Total Revenue</div>
                        <div class="kpi-change trend-up">
                            <i class="ri-arrow-up-line"></i> +12.5%
                        </div>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon bg-blue-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="kpi-details">
                        <div class="kpi-value">{{ $salesData->sum('count') ?? 0 }}</div>
                        <div class="kpi-label">Total Orders</div>
                        <div class="kpi-change trend-up">
                            <i class="ri-arrow-up-line"></i> +8.2%
                        </div>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon bg-purple-light">
                        <i class="ri-store-line"></i>
                    </div>
                    <div class="kpi-details">
                        <div class="kpi-value">{{ $topVendors->count() }}</div>
                        <div class="kpi-label">Active Vendors</div>
                        <div class="kpi-change trend-up">
                            <i class="ri-arrow-up-line"></i> +5.3%
                        </div>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon bg-gold-light">
                        <i class="ri-user-line"></i>
                    </div>
                    <div class="kpi-details">
                        <div class="kpi-value">{{ $topProducts->sum('orders_count') ?? 0 }}</div>
                        <div class="kpi-label">Products Sold</div>
                        <div class="kpi-change trend-up">
                            <i class="ri-arrow-up-line"></i> +15.7%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="chart-grid">
                <!-- Sales Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>
                            <i class="ri-bar-chart-grouped-line"></i>
                            Sales Overview
                        </h3>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--primary-gold);"></span>
                                Revenue
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--accent-blue);"></span>
                                Orders
                            </div>
                        </div>
                    </div>
                    <div class="bar-chart" id="salesChart">
                        @forelse($salesData as $data)
                            @php
                                $maxRevenue = $salesData->max('total') ?: 1;
                                $maxOrders = $salesData->max('count') ?: 1;
                                $revenueHeight = ($data->total / $maxRevenue) * 200;
                                $ordersHeight = ($data->count / $maxOrders) * 200;
                            @endphp
                            <div class="bar-wrapper">
                                <div class="bar" style="height: {{ $ordersHeight }}px; background: var(--accent-blue);"
                                     onmouseover="showTooltip(this, '{{ $data->count }} orders')"
                                     onmouseout="hideTooltip(this)">
                                    <div class="bar-tooltip">{{ $data->count }} orders</div>
                                </div>
                                <div class="bar" style="height: {{ $revenueHeight }}px; background: var(--primary-gold); margin-top: 4px;"
                                     onmouseover="showTooltip(this, 'ETB {{ number_format($data->total, 2) }}')"
                                     onmouseout="hideTooltip(this)">
                                    <div class="bar-tooltip">ETB {{ number_format($data->total, 2) }}</div>
                                </div>
                                <div class="bar-label">{{ \Carbon\Carbon::parse($data->date)->format('M d') }}</div>
                            </div>
                        @empty
                            <div class="empty-state" style="width: 100%;">
                                <i class="ri-bar-chart-2-line"></i>
                                <p>No sales data available</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Category Distribution -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>
                            <i class="ri-pie-chart-line"></i>
                            Category Distribution
                        </h3>
                    </div>
                    <div class="pie-chart-container">
                        <div class="pie-chart"></div>
                        <div class="pie-legend">
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--accent-blue);"></span>
                                Electronics (40%)
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--accent-green);"></span>
                                Fashion (30%)
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--accent-yellow);"></span>
                                Home (20%)
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: var(--accent-red);"></span>
                                Other (10%)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Vendors & Products -->
            <div class="tables-grid">
                <!-- Top Vendors -->
                <div class="table-card">
                    <h3>
                        <i class="ri-store-3-line"></i>
                        Top Performing Vendors
                    </h3>
                    @forelse($topVendors as $index => $vendor)
                        <div class="vendor-item">
                            <div class="vendor-info">
                                <span class="vendor-rank">{{ $index + 1 }}</span>
                                <div>
                                    <div class="vendor-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                                    <div class="vendor-meta">{{ $vendor->category ?? 'General Store' }}</div>
                                </div>
                            </div>
                            <div class="vendor-stats">{{ $vendor->followers_count }} followers</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="ri-store-line"></i>
                            <p>No vendor data available</p>
                        </div>
                    @endforelse
                </div>

                <!-- Top Products -->
                <div class="table-card">
                    <h3>
                        <i class="ri-shopping-cart-line"></i>
                        Best Selling Products
                    </h3>
                    @forelse($topProducts as $index => $product)
                        <div class="product-item">
                            <div class="product-info">
                                <span class="product-rank">{{ $index + 1 }}</span>
                                <div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                </div>
                            </div>
                            <div class="product-sales">{{ $product->orders_count }} sold</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="ri-shopping-cart-line"></i>
                            <p>No product data available</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Insights -->
            <div class="insights-grid">
                <div class="insight-card">
                    <h3>
                        <i class="ri-lightbulb-line"></i>
                        Key Insights
                    </h3>

                    <div class="metric-row">
                        <span class="metric-label">Average Order Value</span>
                        <span class="metric-value">ETB {{ number_format($salesData->avg('total') ?? 0, 2) }}</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">Conversion Rate</span>
                        <span class="metric-value">3.8%</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">Customer Retention</span>
                        <span class="metric-value">67%</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">Avg. Daily Orders</span>
                        <span class="metric-value">{{ round($salesData->avg('count') ?? 0) }}</span>
                    </div>

                    <div class="progress-bar" style="margin-top: 16px;">
                        <div class="progress-fill" style="width: 75%;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; color: var(--text-secondary);">
                        <span>Goal: ETB 50,000</span>
                        <span>75% achieved</span>
                    </div>
                </div>

                <div class="insight-card">
                    <h3>
                        <i class="ri-calendar-check-line"></i>
                        Recent Activity
                    </h3>

                    <div class="metric-row">
                        <span class="metric-label">New Vendors (Today)</span>
                        <span class="metric-value">3</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">New Customers (Today)</span>
                        <span class="metric-value">24</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">New Products (Today)</span>
                        <span class="metric-value">12</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">Pending Reviews</span>
                        <span class="metric-value">8</span>
                    </div>

                    <div class="metric-row">
                        <span class="metric-label">Support Tickets</span>
                        <span class="metric-value">5</span>
                    </div>

                    <div style="margin-top: 16px;">
                        <button class="btn btn-primary btn-sm" style="width: 100%;" onclick="exportAnalytics()">
                            <i class="ri-download-2-line"></i> Export Report
                        </button>
                    </div>
                </div>
            </div>
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

        // Set period
        function setPeriod(days) {
            document.getElementById('loadingOverlay').style.display = 'flex';
            window.location.href = `{{ route('admin.analytics') }}?period=${days}`;
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

        // Export analytics
        function exportAnalytics() {
            document.getElementById('loadingOverlay').style.display = 'flex';

            setTimeout(() => {
                alert('Export started. Your report will be downloaded shortly.');
                document.getElementById('loadingOverlay').style.display = 'none';

                // Simulate download
                // window.location.href = '{{ route("admin.reports.export") }}?type=analytics&period={{ $period }}';
            }, 1000);
        }

       
    </script>

</body>
</html>
