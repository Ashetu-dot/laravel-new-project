<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Inventory Management - Vendora Admin | Jimma, Ethiopia</title>
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
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-blue: #3b82f6;
            --accent-yellow: #f59e0b;
            --accent-purple: #8b5cf6;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
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
            display: flex;
            min-height: 100vh;
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
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
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

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--accent-green);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--accent-red);
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--accent-yellow);
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--accent-blue);
        }

        /* Buttons */
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

        .btn-primary:hover:not(:disabled) {
            background-color: var(--primary-gold-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
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
            background-color: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1280px) {
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
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
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

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-trend {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        .trend-up { color: var(--accent-green); }
        .trend-down { color: var(--accent-red); }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
            background-color: var(--card-bg);
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .filter-tabs {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .filter-tab:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .filter-tab.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: var(--primary-bg);
            padding: 8px 16px;
            border-radius: 8px;
            width: 300px;
        }

        .search-box i {
            color: var(--text-secondary);
            margin-right: 8px;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
        }

        .date-range {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-input {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 13px;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .quick-action-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-title i {
            color: var(--primary-gold);
        }

        .results-info {
            color: var(--text-secondary);
            font-size: 14px;
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

        tr.low-stock {
            background-color: #fff3e0;
        }

        tr.low-stock:hover td {
            background-color: #ffe4bc;
        }

        tr.out-of-stock {
            background-color: #fee2e2;
        }

        tr.out-of-stock:hover td {
            background-color: #fecaca;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: #f3f4f6;
            object-fit: cover;
        }

        .product-image-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }

        .stock-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .stock-high { background-color: #d1fae5; color: #065f46; }
        .stock-medium { background-color: #fef3c7; color: #92400e; }
        .stock-low { background-color: #fee2e2; color: #991b1b; }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            background-color: transparent;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Enhanced Pagination - Matching Screenshot Style */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .pagination-info {
            color: var(--text-secondary);
            font-size: 14px;
            margin-right: 16px;
        }

        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination-btn {
            min-width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            background-color: transparent;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            padding: 0 8px;
        }

        .pagination-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background-color: #fff9f0;
        }

        .pagination-btn.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-dots {
            color: var(--text-secondary);
            padding: 0 4px;
        }

        /* Inventory Chart */
        .chart-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-title i {
            color: var(--primary-gold);
        }

        .inventory-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 200px;
            gap: 16px;
        }

        .chart-bar-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .chart-bar {
            width: 100%;
            background: linear-gradient(to top, var(--primary-gold), #e6b450);
            border-radius: 4px 4px 0 0;
            transition: height 0.3s;
        }

        .chart-label {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px;
            color: var(--text-secondary);
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
        }

        /* Loading Spinner */
        .spinner {
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

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
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
                <a href="{{ route('admin.catalog.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item active">
                    <i class="ri-archive-line"></i> Inventory
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
                <a href="{{ route('admin.analytics') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i> Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SYSTEM</div>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i> Administrators
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
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
                <p>{{ ucfirst(Auth::user()->role ?? 'administrator') }}</p>
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
                <div class="page-title">
                    <i class="ri-archive-line" style="color: var(--primary-gold);"></i> Inventory Management
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

        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="ri-alert-line"></i>
                    {{ session('warning') }}
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-archive-line"></i>
                        Inventory Management
                    </h1>
                    <p>Monitor and manage product stock levels</p>
                </div>
                <div>
                    <span class="stock-badge stock-high">Last updated: {{ now()->format('M d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-stack-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Products</div>
                        <div class="stat-number">{{ number_format($stats['total_products'] ?? 0) }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-checkbox-circle-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">In Stock</div>
                        <div class="stat-number">{{ number_format($stats['in_stock'] ?? 0) }}</div>
                        <div class="stat-trend trend-up">
                            <i class="ri-arrow-up-line"></i> {{ number_format(($stats['in_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100, 1) }}%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-error-warning-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Low Stock</div>
                        <div class="stat-number">{{ number_format($stats['low_stock'] ?? 0) }}</div>
                        <div class="stat-trend {{ ($stats['low_stock'] ?? 0) > 0 ? 'trend-down' : '' }}">
                            <i class="ri-arrow-down-line"></i> {{ number_format(($stats['low_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100, 1) }}%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-red-light">
                        <i class="ri-close-circle-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Out of Stock</div>
                        <div class="stat-number">{{ number_format($stats['out_of_stock'] ?? 0) }}</div>
                        <div class="stat-trend trend-down">
                            <i class="ri-arrow-down-line"></i> {{ number_format(($stats['out_of_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100, 1) }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Value Stats -->
            <div class="stats-grid" style="margin-top: -12px;">
                <div class="stat-card">
                    <div class="stat-icon bg-gold-light">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Stock Value</div>
                        <div class="stat-number">ETB {{ number_format($totalStockValue ?? 0, 2) }}</div>
                        <div class="stat-trend">At cost price</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Retail Value</div>
                        <div class="stat-number">ETB {{ number_format($totalRetailValue ?? 0, 2) }}</div>
                        <div class="stat-trend">At selling price</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-bar-chart-2-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Average Margin</div>
                        <div class="stat-number">{{ number_format($avgMargin ?? 25.5, 1) }}%</div>
                        <div class="stat-trend">Across all products</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-repeat-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Turnover Rate</div>
                        <div class="stat-number">{{ number_format($turnoverRate ?? 2.3, 1) }}x</div>
                        <div class="stat-trend">Last 30 days</div>
                    </div>
                </div>
            </div>

            <!-- Inventory Status Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="ri-pie-chart-2-line"></i>
                        Inventory Status Distribution
                    </h3>
                    <a href="{{ route('admin.inventory.low-stock') }}" class="btn btn-sm btn-secondary">
                        View Low Stock <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                @php
                    $inStockPercentage = $inStockPercentage ?? (($stats['in_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100);
                    $lowStockPercentage = $lowStockPercentage ?? (($stats['low_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100);
                    $outOfStockPercentage = $outOfStockPercentage ?? (($stats['out_of_stock'] ?? 0) / max(($stats['total_products'] ?? 1), 1) * 100);
                @endphp

                <div style="display: flex; align-items: center; justify-content: center; gap: 50px; padding: 20px; flex-wrap: wrap;">
                    <div style="position: relative; width: 200px; height: 200px;">
                        <div style="width: 200px; height: 200px; border-radius: 50%; background: conic-gradient(#10b981 0deg {{ $inStockPercentage * 3.6 }}deg, #f59e0b {{ $inStockPercentage * 3.6 }}deg {{ ($inStockPercentage + $lowStockPercentage) * 3.6 }}deg, #ef4444 {{ ($inStockPercentage + $lowStockPercentage) * 3.6 }}deg 360deg);"></div>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-direction: column; box-shadow: var(--shadow-sm);">
                            <span style="font-size: 24px; font-weight: 700; color: var(--text-primary);">{{ number_format($stats['total_products'] ?? 0) }}</span>
                            <span style="font-size: 12px; color: var(--text-secondary);">Total Products</span>
                        </div>
                    </div>

                    <div>
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            <div style="width: 20px; height: 20px; background: #10b981; border-radius: 4px;"></div>
                            <div>
                                <div style="font-weight: 600;">In Stock</div>
                                <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($inStockPercentage, 1) }}% ({{ number_format($stats['in_stock'] ?? 0) }} products)</div>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            <div style="width: 20px; height: 20px; background: #f59e0b; border-radius: 4px;"></div>
                            <div>
                                <div style="font-weight: 600;">Low Stock</div>
                                <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($lowStockPercentage, 1) }}% ({{ number_format($stats['low_stock'] ?? 0) }} products)</div>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 20px; height: 20px; background: #ef4444; border-radius: 4px;"></div>
                            <div>
                                <div style="font-weight: 600;">Out of Stock</div>
                                <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($outOfStockPercentage, 1) }}% ({{ number_format($stats['out_of_stock'] ?? 0) }} products)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-tabs">
                    <a href="{{ route('admin.inventory') }}" class="filter-tab {{ !request('stock_status') ? 'active' : '' }}">All Products</a>
                    <a href="{{ route('admin.inventory', ['stock_status' => 'in']) }}" class="filter-tab {{ request('stock_status') == 'in' ? 'active' : '' }}">In Stock</a>
                    <a href="{{ route('admin.inventory', ['stock_status' => 'low']) }}" class="filter-tab {{ request('stock_status') == 'low' ? 'active' : '' }}">Low Stock</a>
                    <a href="{{ route('admin.inventory', ['stock_status' => 'out']) }}" class="filter-tab {{ request('stock_status') == 'out' ? 'active' : '' }}">Out of Stock</a>
                </div>

                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <form action="{{ route('admin.inventory') }}" method="GET" style="width: 100%; display: flex;">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                        @if(request('stock_status'))
                            <input type="hidden" name="stock_status" value="{{ request('stock_status') }}">
                        @endif
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('admin.inventory.export') }}" class="quick-action-btn">
                    <i class="ri-download-line"></i> Export Inventory
                </a>
                <a href="{{ route('admin.inventory.reorder.export') }}" class="quick-action-btn">
                    <i class="ri-file-list-3-line"></i> Export Reorder List
                </a>
                <a href="{{ route('admin.catalog.products.create') }}" class="quick-action-btn">
                    <i class="ri-add-line"></i> Add New Product
                </a>
            </div>

            <!-- Inventory Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="ri-archive-line"></i>
                        Inventory List
                    </h3>
                    <span class="results-info">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} results</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Vendor</th>
                            <th class="text-right">Current Stock</th>
                            <th class="text-right">Min Stock</th>
                            <th class="text-right">Max Stock</th>
                            <th class="text-right">Reorder Level</th>
                            <th class="text-right">Stock Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products ?? [] as $product)
                            @php
                                $stock = $product->stock ?? 0;
                                $minStock = $product->min_stock ?? 5;
                                $maxStock = $product->max_stock ?? 100;
                                $reorderLevel = $product->reorder_level ?? 5;
                                $costPrice = $product->cost_price ?? ($product->price * 0.7);
                                $stockValue = $stock * $costPrice;

                                $rowClass = '';
                                $statusClass = 'stock-high';
                                $statusText = 'In Stock';

                                if ($stock <= 0) {
                                    $rowClass = 'out-of-stock';
                                    $statusClass = 'stock-low';
                                    $statusText = 'Out of Stock';
                                } elseif ($stock <= $reorderLevel) {
                                    $rowClass = 'low-stock';
                                    $statusClass = 'stock-medium';
                                    $statusText = 'Low Stock';
                                }
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>
                                    <div class="product-cell">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image">
                                        @else
                                            <div class="product-image-placeholder">
                                                <i class="ri-shopping-bag-line"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div style="font-weight: 600;">{{ $product->name }}</div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">ID: #{{ $product->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><code>{{ $product->sku ?? 'N/A' }}</code></td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.vendors.show', $product->vendor_id) }}" class="text-gold">
                                        {{ $product->vendor->business_name ?? $product->vendor->name ?? 'N/A' }}
                                    </a>
                                </td>
                                <td class="text-right">
                                    <span style="font-weight: 600; {{ $stock <= $reorderLevel ? 'color: var(--accent-red);' : '' }}">
                                        {{ number_format($stock) }}
                                    </span>
                                </td>
                                <td class="text-right">{{ number_format($minStock) }}</td>
                                <td class="text-right">{{ number_format($maxStock) }}</td>
                                <td class="text-right">{{ number_format($reorderLevel) }}</td>
                                <td class="text-right">ETB {{ number_format($stockValue, 2) }}</td>
                                <td>
                                    <span class="stock-badge {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.catalog.products.show', $product->id) }}" class="action-btn" title="View Product">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <button type="button" class="action-btn" title="Restock" onclick="showRestockModal({{ $product->id }}, '{{ $product->name }}')">
                                            <i class="ri-add-line"></i>
                                        </button>
                                        <a href="{{ route('admin.catalog.products.edit', $product->id) }}" class="action-btn" title="Edit Product">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="empty-state">
                                    <i class="ri-archive-line"></i>
                                    <h3>No Products Found</h3>
                                    <p>No products match your current filters.</p>
                                    <a href="{{ route('admin.catalog.products.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                                        <i class="ri-add-line"></i> Add New Product
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Enhanced Pagination - Matching Screenshot Style -->
                @if(method_exists($products, 'links') && $products->hasPages())
                    <div class="pagination">
                        <span class="pagination-info">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                        </span>

                        <div class="pagination-nav">
                            {{-- Previous Page Link --}}
                            @if($products->onFirstPage())
                                <span class="pagination-btn disabled">
                                    <i class="ri-arrow-left-s-line"></i> Previous
                                </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="pagination-btn">
                                    <i class="ri-arrow-left-s-line"></i> Previous
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if($page == $products->currentPage())
                                    <a href="{{ $url }}" class="pagination-btn active">{{ $page }}</a>
                                @elseif($page >= $products->currentPage() - 2 && $page <= $products->currentPage() + 2)
                                    <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                                @elseif($page == 1 || $page == $products->lastPage())
                                    <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                                @elseif($page == $products->currentPage() - 3 || $page == $products->currentPage() + 3)
                                    <span class="pagination-dots">...</span>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="pagination-btn">
                                    Next <i class="ri-arrow-right-s-line"></i>
                                </a>
                            @else
                                <span class="pagination-btn disabled">
                                    Next <i class="ri-arrow-right-s-line"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Reorder Suggestions -->
            @if(isset($reorderSuggestions) && count($reorderSuggestions) > 0)
            <div class="table-container" style="margin-top: 24px;">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="ri-shopping-cart-2-line"></i>
                        Suggested Reorders
                    </h3>
                    <a href="{{ route('admin.inventory.reorder.export') }}" class="btn btn-sm btn-secondary">
                        <i class="ri-download-line"></i> Export List
                    </a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Current Stock</th>
                            <th>Reorder Level</th>
                            <th>Suggested Order</th>
                            <th>Estimated Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reorderSuggestions as $suggestion)
                            @php
                                $suggestedQty = max(($suggestion['max_stock'] ?? 100) - ($suggestion['current_stock'] ?? 0), ($suggestion['reorder_level'] ?? 5) * 2);
                                $estimatedCost = $suggestedQty * ($suggestion['cost_price'] ?? 0);
                            @endphp
                            <tr>
                                <td>
                                    <div class="product-cell">
                                        @if($suggestion['image'])
                                            <img src="{{ Storage::url($suggestion['image']) }}" alt="" class="product-image" style="width: 32px; height: 32px;">
                                        @else
                                            <div class="product-image-placeholder" style="width: 32px; height: 32px;">
                                                <i class="ri-shopping-bag-line"></i>
                                            </div>
                                        @endif
                                        <span>{{ $suggestion['name'] ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="text-right" style="color: var(--accent-red); font-weight: 600;">{{ number_format($suggestion['current_stock'] ?? 0) }}</td>
                                <td class="text-right">{{ number_format($suggestion['reorder_level'] ?? 0) }}</td>
                                <td class="text-right">{{ number_format($suggestedQty) }} units</td>
                                <td class="text-right">ETB {{ number_format($estimatedCost, 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="showRestockModal({{ $suggestion['id'] }}, '{{ $suggestion['name'] }}')">
                                        Reorder Now
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </main>

    <!-- Restock Modal -->
    <div id="restockModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 12px; padding: 24px; width: 400px; max-width: 90%; box-shadow: var(--shadow-lg);">
            <h3 style="margin-bottom: 16px;">Restock Product</h3>
            <p id="restockProductName" style="margin-bottom: 20px; color: var(--text-secondary);"></p>

            <form id="restockForm" method="POST" action="">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label for="quantity" style="display: block; margin-bottom: 8px; font-weight: 600;">Quantity to Add</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="10" class="form-control" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px;" required>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="hideRestockModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Restock</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('active');
                        }
                    }
                });
            }
        });

        // Restock Modal Functions
        function showRestockModal(productId, productName) {
            const modal = document.getElementById('restockModal');
            const productNameEl = document.getElementById('restockProductName');
            const form = document.getElementById('restockForm');

            productNameEl.textContent = `Add stock to: ${productName}`;
            form.action = `{{ url('admin/inventory') }}/${productId}/restock`;

            modal.style.display = 'flex';
        }

        function hideRestockModal() {
            document.getElementById('restockModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('restockModal');
            if (event.target === modal) {
                hideRestockModal();
            }
        });



        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

</body>
</html>
