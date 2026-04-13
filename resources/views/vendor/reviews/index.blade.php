<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Product Reviews - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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
            --star-color: #FFB800;
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

        /* Reviews Header */
        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .reviews-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reviews-header h1 i {
            color: var(--primary-gold);
        }

        .reviews-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 24px;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
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

        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 32px 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-primary);
            background-color: var(--card-bg);
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
        }

        .filter-select:focus {
            border-color: var(--primary-gold);
        }

        /* Stats Cards */
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

        .stat-sub {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }

        /* Reviews Table */
        .reviews-container {
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
            padding: 16px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        td {
            padding: 20px 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 24px;
        }

        .product-image img {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
        }

        .product-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .product-category {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .customer-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .review-date {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .star-filled {
            color: var(--star-color);
        }

        .star-empty {
            color: #e0e0e0;
        }

        .rating-value {
            margin-left: 4px;
            font-weight: 600;
        }

        .review-content {
            max-width: 300px;
        }

        .review-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .review-text {
            color: var(--text-secondary);
            font-size: 13px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .review-images {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .review-image {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            background-color: #f3f4f6;
            cursor: pointer;
            object-fit: cover;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fed7aa;
            color: #92400e;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            background: transparent;
            color: var(--text-secondary);
        }

        .action-btn:hover {
            background-color: #f3f4f6;
        }

        .action-btn.approve:hover {
            color: var(--success-color);
            background-color: #d1fae5;
        }

        .action-btn.reject:hover {
            color: var(--danger-color);
            background-color: #fee2e2;
        }

        .action-btn.delete:hover {
            color: var(--danger-color);
            background-color: #fee2e2;
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 16px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .modal-close:hover {
            background-color: #f3f4f6;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
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

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* Loading Spinner */
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

        /* Empty State */
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
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            
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
                <a href="{{ route('vendor.store-views') }}" class="nav-item">
                    <i class="ri-eye-line"></i> Store Views
                </a>
                <a href="{{ route('vendor.reviews.index') }}" class="nav-item active">
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
                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->business_name ?? Auth::user()->name }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
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
                    <i class="ri-star-line" style="color: var(--primary-gold);"></i> Product Reviews
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

        <!-- Reviews Content -->
        <div class="dashboard-container">
            <!-- Header -->
            <div class="reviews-header">
                <div>
                    <h1>
                        <i class="ri-star-line"></i>
                        Product Reviews
                    </h1>
                    <p>Manage and respond to customer reviews for your products</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-star-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $totalReviews }}</div>
                        <div class="stat-label">Total Reviews</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-star-fill"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $averageRating }}</div>
                        <div class="stat-label">Average Rating</div>
                        <div class="stat-sub">out of 5</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-gold-light">
                        <i class="ri-star-half-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $pendingReviews }}</div>
                        <div class="stat-label">Pending Approval</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-star-smile-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $productsWithReviews }}</div>
                        <div class="stat-label">Products with Reviews</div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Search reviews by product or customer..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="ratingFilter">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                    </select>
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <select class="filter-select" id="sortFilter">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rating</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
                    </select>
                </div>
            </div>

            <!-- Reviews Table -->
            <div class="reviews-container">
                @if($reviews->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <div class="product-image">
                                        @php
                                            $pImg = null;
                                            if ($review->product) {
                                                $imgs = $review->product->images;
                                                if (is_string($imgs)) $imgs = json_decode($imgs, true);
                                                $raw = is_array($imgs) ? ($imgs[0] ?? null) : null;
                                                if ($raw) {
                                                    $pImg = filter_var($raw, FILTER_VALIDATE_URL)
                                                        ? $raw
                                                        : (Storage::disk('public')->exists(ltrim($raw, '/'))
                                                            ? Storage::url(ltrim($raw, '/'))
                                                            : null);
                                                }
                                            }
                                        @endphp
                                        @if($pImg)
                                            <img src="{{ $pImg }}" alt="{{ $review->product->name }}">
                                        @else
                                            <i class="ri-shopping-bag-line"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="product-name">{{ $review->product->name ?? 'Vendor Review' }}</div>
                                        <div class="product-category">{{ $review->product->category ?? ($review->vendor_id ? 'Store Review' : 'N/A') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        <img src="{{ $review->user?->avatar_url ?? 'https://ui-avatars.com/api/?name=GU&background=B88E3F&color=fff&size=80' }}"
                                             alt="{{ $review->user->name ?? 'Guest' }}"
                                             style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                    </div>
                                    <div>
                                        <div class="customer-name">{{ $review->user->name ?? 'Guest User' }}</div>
                                        <div class="review-date">{{ $review->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="ri-star-fill star-filled"></i>
                                        @else
                                            <i class="ri-star-line star-empty"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-value">{{ $review->rating }}.0</span>
                                </div>
                            </td>
                            <td>
                                <div class="review-content">
                                    @if($review->title)
                                        <div class="review-title">{{ $review->title }}</div>
                                    @endif
                                    <div class="review-text">{{ $review->comment }}</div>
                                    @if($review->images && count($review->images) > 0)
                                    <div class="review-images">
                                        @foreach(array_slice($review->images, 0, 3) as $image)
                                            <img src="{{ Storage::url($image) }}" class="review-image" onclick="viewImage('{{ Storage::url($image) }}')">
                                        @endforeach
                                        @if(count($review->images) > 3)
                                            <span class="review-image" style="display: flex; align-items: center; justify-content: center; background: #f3f4f6;">+{{ count($review->images) - 3 }}</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($review->is_approved === null)
                                    <span class="status-badge status-pending">Pending</span>
                                @elseif($review->is_approved)
                                    <span class="status-badge status-approved">Approved</span>
                                @else
                                    <span class="status-badge status-rejected">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if($review->is_approved === null || !$review->is_approved)
                                        <button class="action-btn approve" onclick="approveReview({{ $review->id }})" title="Approve">
                                            <i class="ri-check-line"></i>
                                        </button>
                                    @endif
                                    @if($review->is_approved === null || $review->is_approved)
                                        <button class="action-btn reject" onclick="rejectReview({{ $review->id }})" title="Reject">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    @endif
                                    <button class="action-btn" onclick="viewReview({{ $review->id }})" title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <button class="action-btn delete" onclick="deleteReview({{ $review->id }})" title="Delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($reviews->hasPages())
                <div class="pagination">
                    {{ $reviews->appends(request()->query())->links() }}
                </div>
                @endif
                @else
                <div class="empty-state">
                    <i class="ri-star-line"></i>
                    <h3>No Reviews Yet</h3>
                    <p>When customers review your products, they will appear here.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Review Detail Modal -->
    <div class="modal" id="reviewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Review Details</h3>
                <div class="modal-close" onclick="closeModal()">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button class="btn btn-primary" id="modalApproveBtn" onclick="approveFromModal()">Approve</button>
                <button class="btn btn-danger" id="modalRejectBtn" onclick="rejectFromModal()">Reject</button>
            </div>
        </div>
    </div>

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

            // Search and filter functionality
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => applyFilters(), 500);
            });

            document.getElementById('ratingFilter').addEventListener('change', applyFilters);
            document.getElementById('statusFilter').addEventListener('change', applyFilters);
            document.getElementById('sortFilter').addEventListener('change', applyFilters);
        });

        // Apply filters
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const rating = document.getElementById('ratingFilter').value;
            const status = document.getElementById('statusFilter').value;
            const sort = document.getElementById('sortFilter').value;

            const params = new URLSearchParams(window.location.search);
            if (search) params.set('search', search);
            else params.delete('search');
            if (rating) params.set('rating', rating);
            else params.delete('rating');
            if (status) params.set('status', status);
            else params.delete('status');
            if (sort) params.set('sort', sort);
            else params.delete('sort');

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        // View review details
        function viewReview(reviewId) {
            document.getElementById('loadingOverlay').style.display = 'flex';
            
            fetch(`/vendor/reviews/${reviewId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayReviewModal(data.data);
                } else {
                    showToast('Failed to load review details', 'error');
                }
                document.getElementById('loadingOverlay').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                showToast('Failed to load review details', 'error');
            });
        }

        // Display review modal
        function displayReviewModal(review) {
            const modalBody = document.getElementById('reviewModalBody');
            const approveBtn = document.getElementById('modalApproveBtn');
            const rejectBtn = document.getElementById('modalRejectBtn');
            
            let ratingStars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= review.rating) {
                    ratingStars += '<i class="ri-star-fill star-filled"></i>';
                } else {
                    ratingStars += '<i class="ri-star-line star-empty"></i>';
                }
            }

            let imagesHtml = '';
            if (review.images && review.images.length > 0) {
                imagesHtml = '<div style="margin-top: 16px;"><h4 style="margin-bottom: 8px;">Images:</h4><div style="display: flex; gap: 8px; flex-wrap: wrap;">';
                review.images.forEach(image => {
                    imagesHtml += `<img src="${image}" style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover; cursor: pointer;" onclick="window.open('${image}')">`;
                });
                imagesHtml += '</div></div>';
            }

            modalBody.innerHTML = `
                <div style="display: flex; gap: 16px; margin-bottom: 20px;">
                    <div style="width: 60px; height: 60px; border-radius: 8px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                        ${review.product_image ? 
                            `<img src="${review.product_image}" style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover;">` : 
                            '<i class="ri-shopping-bag-line" style="font-size: 24px; color: var(--text-secondary);"></i>'}
                    </div>
                    <div>
                        <h4 style="margin-bottom: 4px;">${review.product_name}</h4>
                        <p style="color: var(--text-secondary); font-size: 13px;">${review.product_category || 'N/A'}</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 16px; margin-bottom: 20px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-gold), #9c7832); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                        ${review.customer_avatar ? 
                            `<img src="${review.customer_avatar}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">` : 
                            review.customer_initials}
                    </div>
                    <div>
                        <h4 style="margin-bottom: 4px;">${review.customer_name}</h4>
                        <p style="color: var(--text-secondary); font-size: 13px;">${review.customer_email}</p>
                        <p style="color: var(--text-secondary); font-size: 12px; margin-top: 4px;">Reviewed on ${review.created_at}</p>
                    </div>
                </div>
                
                <div style="margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                        <div class="rating" style="font-size: 18px;">${ratingStars}</div>
                        <span style="font-weight: 600;">${review.rating}.0 out of 5</span>
                    </div>
                    ${review.title ? `<h4 style="margin-bottom: 8px;">${review.title}</h4>` : ''}
                    <p style="line-height: 1.6; color: var(--text-primary);">${review.comment}</p>
                </div>
                
                ${imagesHtml}
            `;

            approveBtn.setAttribute('onclick', `approveReview(${review.id})`);
            rejectBtn.setAttribute('onclick', `rejectReview(${review.id})`);
            
            if (review.is_approved === true) {
                approveBtn.style.display = 'none';
                rejectBtn.style.display = 'inline-block';
            } else if (review.is_approved === false) {
                approveBtn.style.display = 'inline-block';
                rejectBtn.style.display = 'none';
            } else {
                approveBtn.style.display = 'inline-block';
                rejectBtn.style.display = 'inline-block';
            }

            document.getElementById('reviewModal').classList.add('active');
        }

        // Close modal
        function closeModal() {
            document.getElementById('reviewModal').classList.remove('active');
        }

        // ── Toast ──────────────────────────────────────────────────────
        function showToast(msg, type = 'info') {
            let c = document.getElementById('toastContainer');
            if (!c) {
                c = document.createElement('div');
                c.id = 'toastContainer';
                c.style.cssText = 'position:fixed;top:1.2rem;right:1.2rem;z-index:99999;display:flex;flex-direction:column;gap:8px;pointer-events:none;';
                document.body.appendChild(c);
            }
            const bg = {success:'#059669',error:'#DC2626',info:'#3b82f6',warning:'#D97706'}[type]||'#3b82f6';
            const ic = {success:'ri-checkbox-circle-line',error:'ri-error-warning-line',info:'ri-information-line',warning:'ri-alert-line'}[type]||'ri-information-line';
            const t = document.createElement('div');
            t.style.cssText = `pointer-events:auto;min-width:260px;max-width:380px;padding:12px 16px;border-radius:8px;color:#fff;font-size:14px;display:flex;align-items:center;gap:10px;box-shadow:0 4px 12px rgba(0,0,0,0.2);background:${bg};`;
            t.innerHTML = `<i class="${ic}" style="font-size:18px;flex-shrink:0;"></i><span>${msg}</span>`;
            c.appendChild(t);
            setTimeout(() => t.remove(), 4000);
        }

        function reviewAction(url, method, successMsg, confirmMsg) {
            if (!confirm(confirmMsg)) return;
            document.getElementById('loadingOverlay').style.display = 'flex';
            fetch(url, {
                method,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    showToast(data.message || successMsg, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast(data.message || 'Something went wrong.', 'error');
                }
            })
            .catch(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
                showToast('Network error. Please try again.', 'error');
            });
        }

        // Approve review
        function approveReview(reviewId) {
            reviewAction(`/vendor/reviews/${reviewId}/approve`, 'POST', 'Review approved successfully', 'Approve this review?');
        }

        // Reject review
        function rejectReview(reviewId) {
            reviewAction(`/vendor/reviews/${reviewId}/reject`, 'POST', 'Review rejected successfully', 'Reject this review?');
        }

        // Delete review
        function deleteReview(reviewId) {
            reviewAction(`/vendor/reviews/${reviewId}`, 'DELETE', 'Review deleted successfully', 'Delete this review? This cannot be undone.');
        }

        // View image
        function viewImage(imageUrl) {
            window.open(imageUrl, '_blank');
        }

        // Modal approve/reject helpers
        function approveFromModal() {
            const reviewId = document.getElementById('modalApproveBtn').getAttribute('onclick').match(/\d+/)[0];
            approveReview(reviewId);
        }

        function rejectFromModal() {
            const reviewId = document.getElementById('modalRejectBtn').getAttribute('onclick').match(/\d+/)[0];
            rejectReview(reviewId);
        }
    </script>

</body>
</html>