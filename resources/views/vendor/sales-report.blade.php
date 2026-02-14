<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Sales Report - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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

        /* Sidebar styles (identical to dashboard for consistency) */
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
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .bg-soft-gold { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Sidebar (same as dashboard) -->
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
                <a href="#" class="nav-item active">
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
                <a href="#" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="#" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
                </a>
                <button class="logout-btn" onclick="if(confirm('Logout?')){}">
                    <i class="ri-logout-box-line"></i> Logout
                </button>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">TT</div>
            <div class="user-info">
                <h4>Tadu Store</h4>
                <p>Vendor since Mar 2024</p>
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
                <a href="#" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    <span class="badge-count">3</span>
                </a>
                <a href="#" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    <span class="badge-count">5</span>
                </a>
            </div>
        </header>

        <!-- Sales Report Content -->
        <div class="dashboard-container">
            <!-- Header with date range -->
            <div class="report-header">
                <h1>📊 Sales Performance</h1>
                <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                    <div class="date-range">
                        <button class="date-range-btn active">Today</button>
                        <button class="date-range-btn">Week</button>
                        <button class="date-range-btn">Month</button>
                        <button class="date-range-btn">Year</button>
                    </div>
                    <button class="export-btn"><i class="ri-download-2-line"></i> Export</button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-title">Total Revenue</div>
                    <div class="kpi-value">ETB 245,800</div>
                    <div class="kpi-trend trend-up"><i class="ri-arrow-up-line"></i> +12.5% vs last period</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Orders</div>
                    <div class="kpi-value">324</div>
                    <div class="kpi-trend trend-up"><i class="ri-arrow-up-line"></i> +8.2%</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Average Order Value</div>
                    <div class="kpi-value">ETB 758</div>
                    <div class="kpi-trend trend-up"><i class="ri-arrow-up-line"></i> +3.1%</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Conversion Rate</div>
                    <div class="kpi-value">4.8%</div>
                    <div class="kpi-trend trend-down"><i class="ri-arrow-down-line"></i> -0.4%</div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Sales Trend (Last 7 days)</h3>
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-color" style="background: var(--primary-gold);"></span> This period</div>
                        <div class="legend-item"><span class="legend-color" style="background: #e5e7eb;"></span> Previous period</div>
                    </div>
                </div>
                <div class="bar-chart">
                    <div class="bar-wrapper"><div class="bar" style="height: 140px;"></div><div class="bar-label">Mon</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 190px;"></div><div class="bar-label">Tue</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 110px;"></div><div class="bar-label">Wed</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 210px;"></div><div class="bar-label">Thu</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 280px;"></div><div class="bar-label">Fri</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 320px;"></div><div class="bar-label">Sat</div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 260px;"></div><div class="bar-label">Sun</div></div>
                </div>
            </div>

            <!-- Top Products & Payment Methods -->
            <div class="top-products-grid">
                <div class="insight-card">
                    <h3>🏆 Top Selling Products</h3>
                    <div class="product-rank-item">
                        <div class="product-rank-info"><span class="rank-number">1</span><div><h4>Ethiopian Coffee (1kg)</h4><p>45 units sold</p></div></div>
                        <div class="product-rank-value">ETB 22,500</div>
                    </div>
                    <div class="product-rank-item">
                        <div class="product-rank-info"><span class="rank-number">2</span><div><h4>Habesha Kemis</h4><p>23 units sold</p></div></div>
                        <div class="product-rank-value">ETB 34,500</div>
                    </div>
                    <div class="product-rank-item">
                        <div class="product-rank-info"><span class="rank-number">3</span><div><h4>Traditional Jewelry Set</h4><p>18 units sold</p></div></div>
                        <div class="product-rank-value">ETB 27,000</div>
                    </div>
                    <div class="product-rank-item">
                        <div class="product-rank-info"><span class="rank-number">4</span><div><h4>Spice Mix (Berbere)</h4><p>32 units sold</p></div></div>
                        <div class="product-rank-value">ETB 9,600</div>
                    </div>
                </div>

                <div class="insight-card">
                    <h3>💳 Payment Methods</h3>
                    <div class="payment-method-list">
                        <div><div class="payment-method-item"><span class="payment-method-name"><i class="ri-bank-card-line"></i> Cash on Delivery</span><span>68%</span></div><div class="payment-bar"><div class="payment-bar-fill" style="width:68%"></div></div></div>
                        <div><div class="payment-method-item"><span class="payment-method-name"><i class="ri-phone-line"></i> Mobile Money</span><span>22%</span></div><div class="payment-bar"><div class="payment-bar-fill" style="width:22%"></div></div></div>
                        <div><div class="payment-method-item"><span class="payment-method-name"><i class="ri-bank-line"></i> Bank Transfer</span><span>10%</span></div><div class="payment-bar"><div class="payment-bar-fill" style="width:10%"></div></div></div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="recent-transactions">
                <h3>📋 Recent Transactions</h3>
                <div class="transaction-row">
                    <div class="transaction-info">
                        <div class="transaction-icon"><i class="ri-shopping-bag-line"></i></div>
                        <div class="transaction-detail"><h4>#ORD-3421</h4><p>Abebe K. • 2 items</p></div>
                    </div>
                    <div class="transaction-amount positive">+ ETB 2,450</div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-info">
                        <div class="transaction-icon"><i class="ri-shopping-bag-line"></i></div>
                        <div class="transaction-detail"><h4>#ORD-3420</h4><p>Meron T. • 1 item</p></div>
                    </div>
                    <div class="transaction-amount positive">+ ETB 1,550</div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-info">
                        <div class="transaction-icon"><i class="ri-shopping-bag-line"></i></div>
                        <div class="transaction-detail"><h4>#ORD-3419</h4><p>Biruk D. • 3 items</p></div>
                    </div>
                    <div class="transaction-amount positive">+ ETB 3,780</div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-info">
                        <div class="transaction-icon"><i class="ri-shopping-bag-line"></i></div>
                        <div class="transaction-detail"><h4>#ORD-3418</h4><p>Azeb T. • 5 items</p></div>
                    </div>
                    <div class="transaction-amount positive">+ ETB 5,200</div>
                </div>

                <!-- Pagination (simple) -->
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

    <!-- Mobile menu toggle script -->
    <script>
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
        });

        // dummy filter and export (no backend)
        document.querySelectorAll('.date-range-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.date-range-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // In a real app, you'd fetch new data here
            });
        });

        document.querySelector('.export-btn')?.addEventListener('click', () => alert('Export started (demo)'));
    </script>

</body>
</html>