<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Documentation - Vendora Admin | Jimma, Ethiopia</title>
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

        /* Documentation Header */
        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .doc-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .doc-header h1 i {
            color: var(--primary-gold);
        }

        .doc-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        .search-box {
            min-width: 300px;
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
            padding: 12px 12px 12px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary-gold);
        }

        /* Alert Banner */
        .alert-banner {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-left: 4px solid var(--primary-gold);
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .alert-banner i {
            font-size: 28px;
            color: var(--primary-gold);
        }

        .alert-content {
            flex: 1;
        }

        .alert-content h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #92400e;
        }

        .alert-content p {
            color: #92400e;
            opacity: 0.9;
            font-size: 14px;
        }

        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 40px;
        }

        .quick-link {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .quick-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            border-color: var(--primary-gold);
        }

        .quick-link i {
            font-size: 32px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .quick-link span {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .quick-link small {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Documentation Grid */
        .doc-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 768px) {
            .doc-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar Navigation */
        .doc-sidebar {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            height: fit-content;
            position: sticky;
            top: 90px;
        }

        .doc-sidebar h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .doc-nav {
            list-style: none;
        }

        .doc-nav-item {
            margin-bottom: 8px;
        }

        .doc-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
        }

        .doc-nav-link:hover {
            background-color: #f9fafb;
            color: var(--primary-gold);
        }

        .doc-nav-link.active {
            background-color: #fef3e7;
            color: var(--primary-gold);
            font-weight: 500;
        }

        .doc-nav-link i {
            font-size: 18px;
        }

        .doc-nav-section {
            margin-left: 34px;
            margin-top: 8px;
            margin-bottom: 8px;
            list-style: none;
            border-left: 1px dashed var(--border-color);
            padding-left: 16px;
        }

        .doc-nav-section li {
            margin-bottom: 6px;
        }

        .doc-nav-section a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
            display: block;
            padding: 4px 0;
        }

        .doc-nav-section a:hover {
            color: var(--primary-gold);
        }

        /* Main Content Area */
        .doc-content {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .doc-section {
            margin-bottom: 40px;
        }

        .doc-section:last-child {
            margin-bottom: 0;
        }

        .doc-section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .doc-section h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 24px 0 16px;
        }

        .doc-section p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 16px;
            font-size: 15px;
        }

        .doc-section ul, .doc-section ol {
            margin-left: 24px;
            margin-bottom: 16px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .doc-section li {
            margin-bottom: 8px;
        }

        .doc-section code {
            background-color: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 13px;
            color: var(--accent-red);
        }

        .doc-section pre {
            background-color: #1e293b;
            color: #e2e8f0;
            padding: 16px;
            border-radius: 8px;
            overflow-x: auto;
            margin-bottom: 16px;
        }

        .doc-section pre code {
            background-color: transparent;
            color: inherit;
            padding: 0;
        }

        .doc-card {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
        }

        .doc-card h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .doc-card h4 i {
            color: var(--primary-gold);
        }

        .doc-tip {
            background-color: #ecfdf5;
            border-left: 4px solid var(--success-color);
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
        }

        .doc-tip i {
            color: var(--success-color);
            font-size: 20px;
        }

        .doc-tip-content {
            flex: 1;
        }

        .doc-tip-content strong {
            color: #065f46;
            display: block;
            margin-bottom: 4px;
        }

        .doc-tip-content p {
            color: #065f46;
            margin-bottom: 0;
        }

        .doc-warning {
            background-color: #fff7ed;
            border-left: 4px solid var(--warning-color);
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
        }

        .doc-warning i {
            color: var(--warning-color);
            font-size: 20px;
        }

        .doc-warning-content {
            flex: 1;
        }

        .doc-warning-content strong {
            color: #92400e;
            display: block;
            margin-bottom: 4px;
        }

        .doc-warning-content p {
            color: #92400e;
            margin-bottom: 0;
        }

        .version-badge {
            display: inline-block;
            padding: 2px 8px;
            background-color: #e2e8f0;
            color: #475569;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            margin-left: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
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
            background-color: white;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .action-bar {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
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
                <a href="#" class="nav-item">
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
                <a href="{{ route('admin.analytics') }}" class="nav-item">
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
                <a href="{{ route('admin.documentation') }}" class="nav-item active">
                    <i class="ri-book-open-line"></i> Documentation
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help Center
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
                    <i class="ri-book-open-line" style="color: var(--primary-gold);"></i> Documentation
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

        <!-- Documentation Content -->
        <div class="dashboard-container">
            <!-- Header with Search -->
            <div class="doc-header">
                <div>
                    <h1>
                        <i class="ri-book-open-line"></i>
                        Admin Documentation
                    </h1>
                    <p>Learn how to manage your marketplace effectively</p>
                </div>
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Search documentation..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Alert Banner -->
            <div class="alert-banner">
                <i class="ri-information-line"></i>
                <div class="alert-content">
                    <h3>Documentation v{{ $version ?? '2.0' }}</h3>
                    <p>This documentation is regularly updated. Last updated: {{ $lastUpdated ?? now()->format('F j, Y') }}</p>
                </div>
                <button class="btn btn-secondary btn-sm" onclick="window.print()">
                    <i class="ri-printer-line"></i> Print
                </button>
                <button class="btn btn-primary btn-sm" onclick="downloadPDF()">
                    <i class="ri-file-pdf-line"></i> Download PDF
                </button>
            </div>

            <!-- Quick Links -->
            <div class="quick-links">
                <a href="#getting-started" class="quick-link">
                    <i class="ri-rocket-line"></i>
                    <span>Getting Started</span>
                    <small>Beginner's guide</small>
                </a>
                <a href="#orders" class="quick-link">
                    <i class="ri-shopping-bag-3-line"></i>
                    <span>Orders</span>
                    <small>Manage orders</small>
                </a>
                <a href="#users" class="quick-link">
                    <i class="ri-user-settings-line"></i>
                    <span>Users</span>
                    <small>Customers & vendors</small>
                </a>
                <a href="#products" class="quick-link">
                    <i class="ri-shopping-cart-line"></i>
                    <span>Products</span>
                    <small>Catalog management</small>
                </a>
                <a href="#marketing" class="quick-link">
                    <i class="ri-megaphone-line"></i>
                    <span>Marketing</span>
                    <small>Promotions & coupons</small>
                </a>
                <a href="#settings" class="quick-link">
                    <i class="ri-settings-4-line"></i>
                    <span>Settings</span>
                    <small>System configuration</small>
                </a>
            </div>

            <!-- Documentation Grid -->
            <div class="doc-grid">
                <!-- Sidebar Navigation -->
                <div class="doc-sidebar">
                    <h3>Contents</h3>
                    <ul class="doc-nav">
                        <li class="doc-nav-item">
                            <a href="#getting-started" class="doc-nav-link active">
                                <i class="ri-rocket-line"></i>
                                Getting Started
                            </a>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#dashboard" class="doc-nav-link">
                                <i class="ri-dashboard-line"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#orders" class="doc-nav-link">
                                <i class="ri-shopping-bag-3-line"></i>
                                Orders Management
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#viewing-orders">Viewing Orders</a></li>
                                <li><a href="#updating-order-status">Updating Order Status</a></li>
                                <li><a href="#processing-refunds">Processing Refunds</a></li>
                                <li><a href="#exporting-orders">Exporting Orders</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#customers" class="doc-nav-link">
                                <i class="ri-user-line"></i>
                                Customer Management
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#viewing-customers">Viewing Customers</a></li>
                                <li><a href="#editing-customers">Editing Customers</a></li>
                                <li><a href="#customer-communication">Communication</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#vendors" class="doc-nav-link">
                                <i class="ri-store-line"></i>
                                Vendor Management
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#vendor-approval">Vendor Approval</a></li>
                                <li><a href="#vendor-verification">Verification Process</a></li>
                                <li><a href="#vendor-suspension">Suspension</a></li>
                                <li><a href="#vendor-payouts">Payouts</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#products" class="doc-nav-link">
                                <i class="ri-shopping-cart-line"></i>
                                Product Management
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#product-approval">Product Approval</a></li>
                                <li><a href="#categories">Categories</a></li>
                                <li><a href="#inventory">Inventory Management</a></li>
                                <li><a href="#reviews">Reviews</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#marketing" class="doc-nav-link">
                                <i class="ri-megaphone-line"></i>
                                Marketing Tools
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#promotions">Promotions</a></li>
                                <li><a href="#coupons">Coupons</a></li>
                                <li><a href="#email-campaigns">Email Campaigns</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#analytics" class="doc-nav-link">
                                <i class="ri-bar-chart-2-line"></i>
                                Analytics & Reports
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#sales-reports">Sales Reports</a></li>
                                <li><a href="#user-analytics">User Analytics</a></li>
                                <li><a href="#exporting-reports">Exporting Reports</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#settings" class="doc-nav-link">
                                <i class="ri-settings-4-line"></i>
                                System Settings
                            </a>
                            <ul class="doc-nav-section">
                                <li><a href="#general-settings">General Settings</a></li>
                                <li><a href="#payment-settings">Payment Settings</a></li>
                                <li><a href="#email-settings">Email Settings</a></li>
                                <li><a href="#maintenance">Maintenance Mode</a></li>
                            </ul>
                        </li>
                        <li class="doc-nav-item">
                            <a href="#faq" class="doc-nav-link">
                                <i class="ri-question-line"></i>
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Main Documentation Content -->
                <div class="doc-content">
                    <!-- Getting Started Section -->
                    <section id="getting-started" class="doc-section">
                        <h2>Getting Started</h2>

                        <div class="doc-tip">
                            <i class="ri-lightbulb-line"></i>
                            <div class="doc-tip-content">
                                <strong>Welcome to Vendora Admin!</strong>
                                <p>This guide will help you understand the basics of managing your marketplace.</p>
                            </div>
                        </div>

                        <h3>Overview</h3>
                        <p>The Vendora admin dashboard gives you complete control over your marketplace. You can manage users, orders, products, and configure system settings all from one place.</p>

                        <h3>Quick Start</h3>
                        <ol>
                            <li><strong>Check your dashboard</strong> - The dashboard shows key metrics like total orders, revenue, and user statistics.</li>
                            <li><strong>Review pending vendors</strong> - Go to Vendors section to approve new vendor applications.</li>
                            <li><strong>Monitor orders</strong> - Check the Orders section for new orders and update their status.</li>
                            <li><strong>Configure settings</strong> - Visit Settings to customize your marketplace.</li>
                        </ol>

                        <div class="doc-card">
                            <h4><i class="ri-shield-check-line"></i> Admin Roles</h4>
                            <p>Different admin users can have different permissions. Super admins have full access, while other admins can have limited permissions based on their role.</p>
                        </div>
                    </section>

                    <!-- Dashboard Section -->
                    <section id="dashboard" class="doc-section">
                        <h2>Dashboard</h2>

                        <p>The dashboard provides a real-time overview of your marketplace performance.</p>

                        <h3>Key Metrics</h3>
                        <ul>
                            <li><strong>Total Revenue</strong> - Sum of all completed orders</li>
                            <li><strong>Orders</strong> - Total number of orders (with pending count)</li>
                            <li><strong>Users</strong> - Total customers and vendors registered</li>
                            <li><strong>Products</strong> - Total products in the marketplace</li>
                        </ul>

                        <h3>Charts and Graphs</h3>
                        <p>The dashboard includes visual representations of:</p>
                        <ul>
                            <li>Daily sales trends</li>
                            <li>Order status distribution</li>
                            <li>User registration over time</li>
                            <li>Top selling products</li>
                        </ul>
                    </section>

                    <!-- Orders Section -->
                    <section id="orders" class="doc-section">
                        <h2>Orders Management</h2>

                        <div class="doc-warning">
                            <i class="ri-alert-line"></i>
                            <div class="doc-warning-content">
                                <strong>Important</strong>
                                <p>Always verify payment status before updating order status to "completed".</p>
                            </div>
                        </div>

                        <h3 id="viewing-orders">Viewing Orders</h3>
                        <p>The Orders page displays all orders in the system. You can filter orders by status, date range, or customer. Each order shows:</p>
                        <ul>
                            <li>Order number and date</li>
                            <li>Customer information</li>
                            <li>Products purchased</li>
                            <li>Total amount</li>
                            <li>Payment method</li>
                            <li>Current status</li>
                        </ul>

                        <h3 id="updating-order-status">Updating Order Status</h3>
                        <p>To update an order status:</p>
                        <ol>
                            <li>Navigate to the order details page</li>
                            <li>Click the "Update Status" button</li>
                            <li>Select the new status from the dropdown</li>
                            <li>Add a note if necessary</li>
                            <li>Click "Save Changes"</li>
                        </ol>

                        <p>Available order statuses:</p>
                        <ul>
                            <li><code>pending</code> - Order received, waiting for payment</li>
                            <li><code>processing</code> - Payment confirmed, order being prepared</li>
                            <li><code>shipped</code> - Order has been shipped</li>
                            <li><code>delivered</code> - Order delivered to customer</li>
                            <li><code>cancelled</code> - Order cancelled</li>
                            <li><code>refunded</code> - Order refunded</li>
                        </ul>

                        <h3 id="processing-refunds">Processing Refunds</h3>
                        <p>To process a refund:</p>
                        <ol>
                            <li>Open the order details</li>
                            <li>Click "Process Refund"</li>
                            <li>Select the items to refund</li>
                            <li>Enter refund amount</li>
                            <li>Add reason for refund</li>
                            <li>Confirm refund</li>
                        </ol>

                        <h3 id="exporting-orders">Exporting Orders</h3>
                        <p>You can export orders to CSV format for further analysis:</p>
                        <ol>
                            <li>Go to Orders page</li>
                            <li>Apply any filters you want</li>
                            <li>Click the "Export" button</li>
                            <li>Select date range if prompted</li>
                            <li>The CSV file will download automatically</li>
                        </ol>
                    </section>

                    <!-- Customer Management Section -->
                    <section id="customers" class="doc-section">
                        <h2>Customer Management</h2>

                        <h3 id="viewing-customers">Viewing Customers</h3>
                        <p>The Customers page shows all registered customers. You can see:</p>
                        <ul>
                            <li>Customer name and email</li>
                            <li>Registration date</li>
                            <li>Total orders placed</li>
                            <li>Total spent</li>
                            <li>Account status</li>
                        </ul>

                        <h3 id="editing-customers">Editing Customers</h3>
                        <p>Admin can edit customer information if needed:</p>
                        <ol>
                            <li>Click on a customer to view details</li>
                            <li>Click "Edit Customer"</li>
                            <li>Update information as needed</li>
                            <li>Click "Save Changes"</li>
                        </ol>

                        <h3 id="customer-communication">Customer Communication</h3>
                        <p>You can communicate with customers through:</p>
                        <ul>
                            <li>Internal messaging system</li>
                            <li>Email notifications</li>
                            <li>Bulk email campaigns</li>
                        </ul>
                    </section>

                    <!-- Vendor Management Section -->
                    <section id="vendors" class="doc-section">
                        <h2>Vendor Management</h2>

                        <div class="doc-tip">
                            <i class="ri-checkbox-circle-line"></i>
                            <div class="doc-tip-content">
                                <strong>Pro Tip</strong>
                                <p>Regularly check the pending vendors list to ensure quick approval for new sellers.</p>
                            </div>
                        </div>

                        <h3 id="vendor-approval">Vendor Approval Process</h3>
                        <p>New vendors require admin approval before they can start selling:</p>
                        <ol>
                            <li>Go to Vendors page</li>
                            <li>Filter by "Pending" status</li>
                            <li>Review vendor information</li>
                            <li>Click "Verify" to approve or "Reject" if needed</li>
                            <li>Optionally add notes about the decision</li>
                        </ol>

                        <h3 id="vendor-verification">Verification Process</h3>
                        <p>Vendors should be verified before approval. Check for:</p>
                        <ul>
                            <li>Valid business license</li>
                            <li>Tax ID verification</li>
                            <li>Phone number verification</li>
                            <li>Business address validation</li>
                        </ul>

                        <h3 id="vendor-suspension">Vendor Suspension</h3>
                        <p>If a vendor violates terms, you can suspend them:</p>
                        <ol>
                            <li>Go to vendor details</li>
                            <li>Click "Suspend Vendor"</li>
                            <li>Select reason for suspension</li>
                            <li>Set duration if temporary</li>
                            <li>Confirm suspension</li>
                        </ol>

                        <h3 id="vendor-payouts">Vendor Payouts</h3>
                        <p>Manage vendor payouts:</p>
                        <ul>
                            <li>View pending payouts</li>
                            <li>Process bulk payouts</li>
                            <li>View payout history</li>
                            <li>Export payout reports</li>
                        </ul>
                    </section>

                    <!-- Product Management Section -->
                    <section id="products" class="doc-section">
                        <h2>Product Management</h2>

                        <h3 id="product-approval">Product Approval</h3>
                        <p>Vendor-created products may require admin approval:</p>
                        <ol>
                            <li>Go to Products page</li>
                            <li>Filter by "Pending" status</li>
                            <li>Review product details</li>
                            <li>Check images and descriptions</li>
                            <li>Approve or reject the product</li>
                        </ol>

                        <h3 id="categories">Category Management</h3>
                        <p>Organize products with categories:</p>
                        <ul>
                            <li>Create new categories</li>
                            <li>Edit existing categories</li>
                            <li>Assign products to categories</li>
                            <li>Manage category hierarchy</li>
                        </ul>

                        <h3 id="inventory">Inventory Management</h3>
                        <p>Monitor and manage stock levels:</p>
                        <ul>
                            <li>View low stock alerts</li>
                            <li>Update stock quantities</li>
                            <li>Export inventory report</li>
                            <li>Set reorder points</li>
                        </ul>

                        <h3 id="reviews">Review Management</h3>
                        <p>Monitor and moderate product reviews:</p>
                        <ul>
                            <li>Approve/reject reviews</li>
                            <li>Respond to reviews</li>
                            <li>Report inappropriate reviews</li>
                            <li>View rating analytics</li>
                        </ul>
                    </section>

                    <!-- Marketing Section -->
                    <section id="marketing" class="doc-section">
                        <h2>Marketing Tools</h2>

                        <h3 id="promotions">Creating Promotions</h3>
                        <p>Set up promotions to boost sales:</p>
                        <ol>
                            <li>Go to Promotions page</li>
                            <li>Click "Create Promotion"</li>
                            <li>Set promotion type (percentage, fixed amount)</li>
                            <li>Select products or categories</li>
                            <li>Set start and end dates</li>
                            <li>Publish promotion</li>
                        </ol>

                        <h3 id="coupons">Coupon Management</h3>
                        <p>Create and manage discount coupons:</p>
                        <ul>
                            <li>Generate unique coupon codes</li>
                            <li>Set discount amounts</li>
                            <li>Limit usage per customer</li>
                            <li>Set expiration dates</li>
                            <li>Track coupon usage</li>
                        </ul>

                        <h3 id="email-campaigns">Email Campaigns</h3>
                        <p>Send marketing emails to customers:</p>
                        <ul>
                            <li>Create email templates</li>
                            <li>Segment customer lists</li>
                            <li>Schedule campaigns</li>
                            <li>Track open rates</li>
                            <li>Analyze campaign performance</li>
                        </ul>
                    </section>

                    <!-- Analytics Section -->
                    <section id="analytics" class="doc-section">
                        <h2>Analytics & Reports</h2>

                        <h3 id="sales-reports">Sales Reports</h3>
                        <p>View detailed sales analytics:</p>
                        <ul>
                            <li>Daily, weekly, monthly sales</li>
                            <li>Revenue by product</li>
                            <li>Revenue by vendor</li>
                            <li>Sales trends</li>
                            <li>Comparison with previous periods</li>
                        </ul>

                        <h3 id="user-analytics">User Analytics</h3>
                        <p>Track user behavior and growth:</p>
                        <ul>
                            <li>New registrations over time</li>
                            <li>User retention rates</li>
                            <li>Vendor vs customer ratio</li>
                            <li>Geographic distribution</li>
                        </ul>

                        <h3 id="exporting-reports">Exporting Reports</h3>
                        <p>Export reports for external analysis:</p>
                        <ol>
                            <li>Go to Reports page</li>
                            <li>Select report type</li>
                            <li>Set date range</li>
                            <li>Choose export format (CSV, PDF)</li>
                            <li>Click "Export"</li>
                        </ol>
                    </section>

                    <!-- Settings Section -->
                    <section id="settings" class="doc-section">
                        <h2>System Settings</h2>

                        <h3 id="general-settings">General Settings</h3>
                        <p>Configure basic marketplace settings:</p>
                        <ul>
                            <li>Site name and logo</li>
                            <li>Contact information</li>
                            <li>Currency and tax settings</li>
                            <li>Language and region</li>
                        </ul>

                        <h3 id="payment-settings">Payment Settings</h3>
                        <p>Configure payment gateways:</p>
                        <ul>
                            <li>Enable/disable payment methods</li>
                            <li>Set payment gateway credentials</li>
                            <li>Configure Chapa integration</li>
                            <li>Set payment fees</li>
                        </ul>

                        <h3 id="email-settings">Email Settings</h3>
                        <p>Configure email notifications:</p>
                        <ul>
                            <li>SMTP settings</li>
                            <li>Email templates</li>
                            <li>Notification preferences</li>
                            <li>Test email sending</li>
                        </ul>

                        <h3 id="maintenance">Maintenance Mode</h3>
                        <p>Temporarily disable the site for maintenance:</p>
                        <ol>
                            <li>Go to Settings</li>
                            <li>Toggle "Maintenance Mode"</li>
                            <li>Add custom message if desired</li>
                            <li>Set allowed IPs if needed</li>
                            <li>Save settings</li>
                        </ol>
                    </section>

                    <!-- FAQ Section -->
                    <section id="faq" class="doc-section">
                        <h2>Frequently Asked Questions</h2>

                        <div class="doc-card">
                            <h4><i class="ri-question-line"></i> How do I add a new admin user?</h4>
                            <p>Go to Settings → Admin Management and click "Add New Admin". Fill in their details and assign appropriate permissions.</p>
                        </div>

                        <div class="doc-card">
                            <h4><i class="ri-question-line"></i> How do I process vendor payouts?</h4>
                            <p>Navigate to Vendors → Payouts. You can process individual or bulk payouts from there.</p>
                        </div>

                        <div class="doc-card">
                            <h4><i class="ri-question-line"></i> What should I do if a vendor complains about a dispute?</h4>
                            <p>Review the order details in the Orders section. You can mediate between customer and vendor, and issue refunds if necessary.</p>
                        </div>

                        <div class="doc-card">
                            <h4><i class="ri-question-line"></i> How do I customize email templates?</h4>
                            <p>Go to Settings → Email Settings → Email Templates. You can edit the HTML content of all system emails.</p>
                        </div>

                        <div class="doc-card">
                            <h4><i class="ri-question-line"></i> How do I backup the system?</h4>
                            <p>The system automatically backs up daily. You can also manually trigger backups from Settings → System → Backup.</p>
                        </div>
                    </section>

                    <!-- Action Bar -->
                    <div class="action-bar">
                        <button class="btn btn-secondary" onclick="window.location.href='{{ route('admin.help') }}'">
                            <i class="ri-question-line"></i> Need Help?
                        </button>
                        <button class="btn btn-primary" onclick="scrollToTop()">
                            <i class="ri-arrow-up-line"></i> Back to Top
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

            // Highlight active section on scroll
            const sections = document.querySelectorAll('.doc-section');
            const navLinks = document.querySelectorAll('.doc-nav-link, .doc-nav-section a');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Search functionality
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => performSearch(this.value), 500);
            });
        });

        // Perform search
        function performSearch(query) {
            if (!query.trim()) {
                // Reset all highlights
                document.querySelectorAll('.doc-section').forEach(section => {
                    section.style.display = 'block';
                });
                return;
            }

            // Show loading
            document.getElementById('loadingOverlay').style.display = 'flex';

            // Simulate search (in real app, this would be an AJAX call)
            setTimeout(() => {
                const sections = document.querySelectorAll('.doc-section');
                let found = false;

                sections.forEach(section => {
                    const text = section.textContent.toLowerCase();
                    if (text.includes(query.toLowerCase())) {
                        section.style.display = 'block';
                        found = true;

                        // Highlight matching text
                        const elements = section.querySelectorAll('p, li, h2, h3');
                        elements.forEach(el => {
                            const html = el.innerHTML;
                            const regex = new RegExp(`(${query})`, 'gi');
                            el.innerHTML = html.replace(regex, '<mark style="background-color: #fef3c7; color: #92400e; padding: 0 2px;">$1</mark>');
                        });
                    } else {
                        section.style.display = 'none';
                    }
                });

                if (!found) {
                    alert('No results found for "' + query + '"');
                }

                document.getElementById('loadingOverlay').style.display = 'none';
            }, 500);
        }

        // Scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

                // Download PDF
        function downloadPDF() {
            document.getElementById('loadingOverlay').style.display = 'flex';
            window.location.href = '{{ route("admin.help.documentation.pdf") }}';
        }
        // Print
        window.onafterprint = function() {
            // Restore original content after printing
            location.reload();
        };

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + F for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                document.getElementById('searchInput').focus();
            }

            // Esc to clear search
            if (e.key === 'Escape') {
                document.getElementById('searchInput').value = '';
                performSearch('');
            }
        });

    </script>

</body>
</html>