<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora Admin Dashboard | Jimma, Ethiopia</title>
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
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary-gold);
        }

        .card-actions select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-secondary);
            outline: none;
            background-color: var(--card-bg);
            cursor: pointer;
        }

        .card-actions select:hover {
            border-color: var(--primary-gold);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .chart-placeholder {
            height: 100%;
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
            position: relative;
        }

        .bar {
            width: 100%;
            border-radius: 4px 4px 0 0;
            transition: height 0.3s;
            position: relative;
        }

        .bar.revenue { background-color: var(--primary-gold); opacity: 0.8; }
        .bar.orders { background-color: var(--accent-blue); opacity: 0.6; }

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
            z-index: 10;
        }

        .bar-group:hover .bar-tooltip {
            opacity: 1;
        }

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
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-info h5 {
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .stat-info span {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .stat-value {
            font-weight: 700;
            font-size: 16px;
            color: var(--primary-gold);
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
            background-color: #f9fafb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-completed, .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-delivered {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled, .status-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-refunded {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
        }

        .customer-avatar img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Notifications */
        .notifications-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background-color 0.2s;
            border-radius: 8px;
        }

        .notification-item:hover {
            background-color: #f9fafb;
        }

        .notification-item.unread {
            background-color: #fef3e7;
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
            display: flex;
            justify-content: space-between;
        }

        .notif-content p {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.4;
        }

        .notif-time {
            font-size: 11px;
            color: #9ca3af;
            font-weight: normal;
        }

        .notif-badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 12px;
            background-color: var(--primary-gold);
            color: white;
            margin-left: 8px;
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
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

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Color Utility Classes */
        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }

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
            margin-top: 8px;
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
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

        /* Empty State */
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

        .empty-state h4 {
            font-size: 16px;
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

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .action-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }
    </style>
</head>
<body>

    <!-- Left Sidebar -->
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
                <div class="nav-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                    @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                    @if(isset($pendingVendorsCount) && $pendingVendorsCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-yellow); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingVendorsCount }}</span>
                    @endif
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Management</div>
                <a href="{{ route('admin.catalog.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i>
                    Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Inventory
                </a>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i>
                    Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i>
                    Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Analytics</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i>
                    Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i>
                    Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Admin</div>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Administrators
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i>
                    Help & Support
                </a>
                <a href="{{ route('admin.documentation') }}" class="nav-item">
                    <i class="ri-book-open-line"></i>
                    Documentation
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>{{ ucfirst(Auth::user()->role ?? 'administrator') }}</p>
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
                        <input type="text" name="q" placeholder="Search orders, customers, or vendors..." value="{{ request('q') }}">
                    </form>
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

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success" style="margin: 16px 32px 0;">
                <i class="ri-checkbox-circle-line"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" style="margin: 16px 32px 0;">
                <i class="ri-error-warning-line"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" style="margin: 16px 32px 0;">
                <i class="ri-alert-line"></i>
                {{ session('warning') }}
            </div>
        @endif

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <h1 class="page-title">Dashboard Overview</h1>
                <div class="breadcrumb">{{ $greeting ?? 'Welcome back' }}, {{ Auth::user()->name ?? 'Admin' }}! Here's what's happening with your marketplace today.</div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="{{ route('admin.orders') }}" class="action-btn">
                        <i class="ri-shopping-bag-3-line"></i> View Orders
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="action-btn">
                        <i class="ri-add-line"></i> Add Product
                    </a>
                    <a href="{{ route('admin.promotions.create') }}" class="action-btn">
                        <i class="ri-megaphone-line"></i> New Promotion
                    </a>
                    <a href="{{ route('admin.coupons.create') }}" class="action-btn">
                        <i class="ri-coupon-line"></i> New Coupon
                    </a>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <!-- Total Revenue -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-green-light">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="kpi-label">Total Revenue</div>
                    <div class="kpi-value">ETB {{ number_format($totalRevenue ?? 124592, 2) }}</div>
                    <div class="kpi-trend {{ ($revenueGrowth ?? 12.5) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($revenueGrowth ?? 12.5) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ number_format(abs($revenueGrowth ?? 12.5), 1) }}% from last month</span>
                    </div>
                </div>

                <!-- Active Vendors -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-blue-light">
                        <i class="ri-store-line"></i>
                    </div>
                    <div class="kpi-label">Active Vendors</div>
                    <div class="kpi-value">{{ number_format($activeVendorsCount ?? 842) }}</div>
                    <div class="kpi-trend {{ ($vendorGrowth ?? 5.2) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($vendorGrowth ?? 5.2) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ number_format(abs($vendorGrowth ?? 5.2), 1) }}% from last month</span>
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
                        <span>{{ number_format(abs($orderChange ?? 2.1), 1) }}% from yesterday</span>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="kpi-card">
                    <div class="kpi-icon bg-gold-light">
                        <i class="ri-group-line"></i>
                    </div>
                    <div class="kpi-label">Total Customers</div>
                    <div class="kpi-value">{{ number_format($totalCustomersCount ?? 12002) }}</div>
                    <div class="kpi-trend {{ ($customerGrowth ?? 8.4) >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="ri-arrow-{{ ($customerGrowth ?? 8.4) >= 0 ? 'up' : 'down' }}-line"></i>
                        <span>{{ number_format(abs($customerGrowth ?? 8.4), 1) }}% from last month</span>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-row">
                <!-- Main Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-bar-chart-2-line"></i>
                            Revenue & Orders
                        </h3>
                        <div class="card-actions">
                            <form method="GET" action="{{ route('admin.dashboard') }}" id="periodForm">
                                <select name="period" onchange="this.form.submit()">
                                    <option value="7" {{ ($period ?? 7) == 7 ? 'selected' : '' }}>Last 7 Days</option>
                                    <option value="30" {{ ($period ?? 7) == 30 ? 'selected' : '' }}>Last 30 Days</option>
                                    <option value="90" {{ ($period ?? 7) == 90 ? 'selected' : '' }}>Last 90 Days</option>
                                    <option value="365" {{ ($period ?? 7) == 365 ? 'selected' : '' }}>This Year</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="chart-container">
                        @if(isset($chartData) && count($chartData) > 0)
                            <div class="bar-chart">
                                @foreach($chartData as $day)
                                    <div class="bar-group">
                                        <div class="bar orders" style="height: {{ $day['orders_percent'] ?? 40 }}%;" title="{{ $day['orders_count'] ?? 0 }} orders"></div>
                                        <div class="bar revenue" style="height: {{ $day['revenue_percent'] ?? 60 }}%;" title="ETB {{ number_format($day['revenue_amount'] ?? 0, 2) }}"></div>
                                        <div class="bar-tooltip">
                                            Orders: {{ $day['orders_count'] ?? 0 }}<br>
                                            Revenue: ETB {{ number_format($day['revenue_amount'] ?? 0, 2) }}
                                        </div>
                                        <span class="bar-label">{{ $day['label'] ?? 'Mon' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="chart-placeholder">
                                <i class="ri-bar-chart-2-line" style="font-size: 32px; margin-bottom: 12px;"></i>
                                <p>No data available for this period</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-flashlight-line"></i>
                            Today's Stats
                        </h3>
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
                                <span>Reviews received today</span>
                            </div>
                            <div class="stat-value">{{ number_format($newReviewsToday ?? 128) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon bg-red-light text-red">
                                <i class="ri-refund-2-line"></i>
                            </div>
                            <div class="stat-info">
                                <h5>Refund Requests</h5>
                                <span>Awaiting processing</span>
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
                        <h3 class="card-title">
                            <i class="ri-shopping-bag-3-line"></i>
                            Recent Orders
                        </h3>
                        <a href="{{ route('admin.orders') }}" class="action-btn" style="padding: 6px 12px;">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    <div class="table-container">
                        @if(isset($recentOrders) && $recentOrders->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        @php
                                            $statusColor = 'pending';
                                            if(in_array($order->status, ['completed', 'delivered'])) $statusColor = 'completed';
                                            elseif($order->status == 'processing') $statusColor = 'processing';
                                            elseif($order->status == 'cancelled') $statusColor = 'cancelled';
                                            elseif($order->status == 'refunded') $statusColor = 'refunded';
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}" style="color: var(--primary-gold); text-decoration: none; font-weight: 600;">
                                                    #{{ $order->order_number ?? 'ORD-' . $order->id }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="customer-cell">
                                                    @if($order->user && $order->user->avatar)
                                                        <img src="{{ Storage::url($order->user->avatar) }}" class="customer-avatar">
                                                    @else
                                                        <div class="customer-avatar">
                                                            {{ $order->user ? strtoupper(substr($order->user->name, 0, 2)) : 'GU' }}
                                                        </div>
                                                    @endif
                                                    <span>{{ $order->user->name ?? 'Guest User' }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $order->items->count() }} items</td>
                                            <td>ETB {{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $statusColor }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if(method_exists($recentOrders, 'links') && $recentOrders->hasPages())
                                <div class="pagination">
                                    {{ $recentOrders->links() }}
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <i class="ri-shopping-bag-3-line"></i>
                                <h4>No Recent Orders</h4>
                                <p>When customers place orders, they will appear here.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Notifications Panel -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-notification-3-line"></i>
                            Recent Notifications
                        </h3>
                        @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                            <span class="notif-badge">{{ $unreadNotificationsCount }} new</span>
                        @endif
                        <a href="{{ route('admin.notifications') }}" class="action-btn" style="padding: 6px 12px; margin-left: auto;">
                            View All
                        </a>
                    </div>
                    <div class="notifications-list">
                        @if(isset($recentNotifications) && $recentNotifications->count() > 0)
                            @foreach($recentNotifications as $notification)
                                @php
                                    $notificationData = is_array($notification->data) ? $notification->data : json_decode($notification->data, true) ?? [];
                                    $color = $notificationData['color'] ?? '#3b82f6';
                                    $title = $notificationData['title'] ?? 'Notification';
                                    $message = $notificationData['message'] ?? 'You have a new notification.';
                                @endphp
                                <div class="notification-item {{ $notification->read_at ? '' : 'unread' }}" onclick="window.location.href='{{ route('admin.notifications.show', $notification->id) }}'">
                                    <div class="notif-dot" style="background-color: {{ $color }};"></div>
                                    <div class="notif-content">
                                        <h6>
                                            {{ $title }}
                                            <span class="notif-time">{{ $notification->created_at->diffForHumans() }}</span>
                                        </h6>
                                        <p>{{ $message }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="ri-notification-off-line"></i>
                                <h4>No Notifications</h4>
                                <p>You're all caught up!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats Row -->
            <div style="margin-top: 24px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
                <div class="card" style="padding: 16px; text-align: center;">
                    <div style="font-size: 32px; font-weight: 700; color: var(--primary-gold);">{{ $stats['total_users'] ?? 0 }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Total Users</div>
                </div>
                <div class="card" style="padding: 16px; text-align: center;">
                    <div style="font-size: 32px; font-weight: 700; color: var(--accent-blue);">{{ $stats['total_vendors'] ?? 0 }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Total Vendors</div>
                </div>
                <div class="card" style="padding: 16px; text-align: center;">
                    <div style="font-size: 32px; font-weight: 700; color: var(--accent-green);">{{ $stats['total_customers'] ?? 0 }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Total Customers</div>
                </div>
                <div class="card" style="padding: 16px; text-align: center;">
                    <div style="font-size: 32px; font-weight: 700; color: var(--accent-purple);">{{ $stats['total_admins'] ?? 0 }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Administrators</div>
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
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Auto-refresh dashboard data every 5 minutes
            setInterval(() => {
                fetch('{{ route("admin.dashboard") }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update KPI values
                    updateKPIs(data);
                })
                .catch(error => console.error('Auto-refresh error:', error));
            }, 300000); // 5 minutes
        });

        // Update KPI values
        function updateKPIs(data) {
            // Update KPI cards with new data
            document.querySelectorAll('.kpi-card').forEach((card, index) => {
                // Add animation
                card.style.transition = 'background-color 0.3s';
                card.style.backgroundColor = '#fef3e7';
                setTimeout(() => {
                    card.style.backgroundColor = '';
                }, 300);
            });
        }

        // Mark notifications as read when clicked
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                // You can add AJAX call to mark as read here
                this.classList.remove('unread');
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Tooltip for chart bars
        document.querySelectorAll('.bar-group').forEach(group => {
            group.addEventListener('mouseenter', function() {
                const tooltip = this.querySelector('.bar-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '1';
                }
            });

            group.addEventListener('mouseleave', function() {
                const tooltip = this.querySelector('.bar-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                }
            });
        });
    </script>

</body>
</html>
