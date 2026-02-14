<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Products - Vendora | Jimma, Ethiopia</title>
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

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Alert Styles */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .alert i {
            font-size: 20px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(135deg, #e5e7eb, #d1d5db);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            z-index: 2;
        }

        .badge-active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-inactive {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-sale {
            background-color: var(--accent-yellow);
            color: white;
            left: 12px;
            right: auto;
        }

        .product-info {
            padding: 16px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-primary);
        }

        .product-category {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .current-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .original-price {
            font-size: 14px;
            color: var(--text-secondary);
            text-decoration: line-through;
        }

        .sale-price {
            font-size: 14px;
            background-color: var(--accent-yellow);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .product-stock {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .stock-low {
            color: var(--accent-red);
            font-weight: 600;
        }

        .stock-out {
            color: var(--accent-red);
            font-weight: 600;
            background-color: #fee2e2;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .action-btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .action-btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .action-btn-primary:hover {
            background-color: #9c7832;
        }

        .action-btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .action-btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
            background-color: #f9fafb;
        }

        .action-btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .action-btn-danger:hover {
            background-color: #dc2626;
        }

        .action-btn-warning {
            background-color: var(--accent-yellow);
            color: white;
        }

        .action-btn-warning:hover {
            background-color: #e07b0c;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 24px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
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
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination-item.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Filter Section */
        .filters-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            color: var(--text-primary);
            background-color: var(--card-bg);
            min-width: 150px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            color: var(--text-primary);
            background-color: var(--card-bg);
            min-width: 200px;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        .filter-btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            background-color: var(--primary-gold);
            color: white;
        }

        .filter-btn:hover {
            background-color: #9c7832;
        }

        .filter-btn-reset {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .filter-btn-reset:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background-color: transparent;
        }

        /* Bulk Actions */
        .bulk-actions {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-left: 4px solid var(--primary-gold);
        }

        .bulk-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .bulk-actions .action-btn {
            flex: 0 1 auto;
            min-width: 120px;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
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
                <a href="{{ route('vendor.products.index') }}" class="nav-item active">
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
            <div style="display: flex; align-items: center; width: 100%;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar" style="width: 400px;">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Search products by name or category..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('vendor.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if($unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('vendor.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if($unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">My Products</h1>
                    <p class="page-subtitle">Manage your product inventory</p>
                </div>
                <div>
                    <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> Add New Product
                    </a>
                </div>
            </div>

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

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filter-group">
                    <span class="filter-label">Filter by:</span>
                    <select id="categoryFilter" class="filter-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select id="statusFilter" class="filter-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="low-stock" {{ request('status') == 'low-stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out-of-stock" {{ request('status') == 'out-of-stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>

                    <select id="sortBy" class="filter-select">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Name: Z to A</option>
                    </select>
                </div>
                
                <div style="display: flex; gap: 8px; margin-left: auto;">
                    <button onclick="applyFilters()" class="filter-btn">
                        <i class="ri-filter-3-line"></i> Apply
                    </button>
                    <a href="{{ route('vendor.products.index') }}" class="filter-btn filter-btn-reset">
                        <i class="ri-refresh-line"></i> Reset
                    </a>
                </div>
            </div>

            <!-- Bulk Actions -->
            @if($products->count() > 0)
            <div class="bulk-actions">
                <input type="checkbox" id="selectAll" class="bulk-checkbox">
                <span style="font-size: 14px; color: var(--text-secondary);" id="selectedCount">0 selected</span>
                <button class="action-btn action-btn-primary" onclick="bulkAction('activate')" id="bulkActivateBtn" disabled>
                    <i class="ri-checkbox-circle-line"></i> Activate
                </button>
                <button class="action-btn action-btn-warning" onclick="bulkAction('deactivate')" id="bulkDeactivateBtn" disabled>
                    <i class="ri-indeterminate-circle-line"></i> Deactivate
                </button>
                <form id="bulkDeleteForm" method="POST" action="{{ route('vendor.products.bulk-delete') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_ids" id="bulkProductIds">
                    <button type="submit" class="action-btn action-btn-danger" onclick="return confirmBulkDelete()" id="bulkDeleteBtn" disabled>
                        <i class="ri-delete-bin-line"></i> Delete Selected
                    </button>
                </form>
            </div>
            @endif

            <!-- Products Grid -->
            <div class="products-grid">
                @forelse($products as $product)
                <div class="product-card" data-product-id="{{ $product->id }}">
                    <div class="product-image">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                        @else
                            <i class="ri-image-line" style="font-size: 48px;"></i>
                        @endif
                        
                        @if($product->sale_price && $product->sale_price < $product->price)
                            <span class="product-badge badge-sale" style="left: 12px; right: auto;">
                                Sale
                            </span>
                        @endif
                        
                        <span class="product-badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="product-info">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <input type="checkbox" class="bulk-checkbox product-checkbox" value="{{ $product->id }}" style="width: 18px; height: 18px;">
                            <h3 class="product-name" style="margin-bottom: 0;">{{ $product->name }}</h3>
                        </div>
                        
                        <p class="product-category">
                            <i class="ri-price-tag-3-line" style="font-size: 12px;"></i> 
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>

                        <div class="product-price">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="current-price">ETB {{ number_format($product->sale_price) }}</span>
                                <span class="original-price">ETB {{ number_format($product->price) }}</span>
                                <span class="sale-price">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </span>
                            @else
                                <span class="current-price">ETB {{ number_format($product->price) }}</span>
                            @endif
                        </div>

                        <div class="product-stock">
                            <i class="ri-stack-line"></i>
                            @if($product->stock <= 0)
                                <span class="stock-out">Out of Stock</span>
                            @elseif($product->stock < 10)
                                <span class="stock-low">
                                    {{ $product->stock }} in stock (Low)
                                </span>
                            @else
                                <span>{{ $product->stock }} in stock</span>
                            @endif
                            
                            @if($product->sku)
                                <span style="margin-left: auto; font-size: 11px;">SKU: {{ $product->sku }}</span>
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('vendor.products.edit', $product->id) }}" class="action-btn action-btn-primary" title="Edit Product">
                                <i class="ri-edit-line"></i> Edit
                            </a>
                            
                            @if($product->is_active)
                                <form action="{{ route('vendor.products.deactivate', $product->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn action-btn-warning" style="width: 100%;" title="Deactivate Product">
                                        <i class="ri-eye-off-line"></i> Deactivate
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('vendor.products.activate', $product->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn action-btn-primary" style="width: 100%; background-color: var(--success-color);" title="Activate Product">
                                        <i class="ri-eye-line"></i> Activate
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-danger" style="width: 100%;" title="Delete Product">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </div>
                        
                        <div style="display: flex; gap: 4px; margin-top: 8px; font-size: 11px; color: var(--text-secondary);">
                            <span>Added: {{ $product->created_at->format('M d, Y') }}</span>
                            @if($product->updated_at != $product->created_at)
                                <span>• Updated: {{ $product->updated_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="ri-store-3-line empty-icon"></i>
                    <h2 class="empty-title">No products found</h2>
                    <p class="empty-text">
                        @if(request()->has('search') || request()->has('category') || request()->has('status'))
                            No products match your filters. Try adjusting your search criteria.
                        @else
                            Start adding products to your store and reach customers in Jimma!
                        @endif
                    </p>
                    @if(request()->has('search') || request()->has('category') || request()->has('status'))
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">
                            <i class="ri-refresh-line"></i> Clear Filters
                        </a>
                    @else
                        <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">
                            <i class="ri-add-line"></i> Add Your First Product
                        </a>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination">
                @if($products->onFirstPage())
                    <span class="pagination-item disabled"><i class="ri-arrow-left-s-line"></i></span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="pagination-item"><i class="ri-arrow-left-s-line"></i></a>
                @endif
                
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="pagination-item active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                    @endif
                @endforeach
                
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="pagination-item"><i class="ri-arrow-right-s-line"></i></a>
                @else
                    <span class="pagination-item disabled"><i class="ri-arrow-right-s-line"></i></span>
                @endif
            </div>
            @endif
        </div>
    </main>

    <script>
        // CSRF Token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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

            // Initialize search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('keyup', function(e) {
                    clearTimeout(searchTimeout);
                    if (e.key === 'Enter') {
                        applyFilters();
                    } else {
                        searchTimeout = setTimeout(applyFilters, 500);
                    }
                });
            }

            // Initialize bulk actions
            initializeBulkActions();
        });

        // Apply filters function
        function applyFilters() {
            const search = document.getElementById('searchInput')?.value || '';
            const category = document.getElementById('categoryFilter')?.value || '';
            const status = document.getElementById('statusFilter')?.value || '';
            const sort = document.getElementById('sortBy')?.value || 'newest';
            
            const params = new URLSearchParams(window.location.search);
            
            if (search) params.set('search', search);
            else params.delete('search');
            
            if (category) params.set('category', category);
            else params.delete('category');
            
            if (status) params.set('status', status);
            else params.delete('status');
            
            if (sort && sort !== 'newest') params.set('sort', sort);
            else params.delete('sort');
            
            params.set('page', '1'); // Reset to first page
            
            window.location.href = window.location.pathname + '?' + params.toString();
        }

        // Bulk actions
        function initializeBulkActions() {
            const selectAll = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const bulkActivateBtn = document.getElementById('bulkActivateBtn');
            const bulkDeactivateBtn = document.getElementById('bulkDeactivateBtn');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const selectedCountSpan = document.getElementById('selectedCount');

            if (!selectAll || !productCheckboxes.length) return;

            function updateSelectedCount() {
                const checked = document.querySelectorAll('.product-checkbox:checked');
                const count = checked.length;
                selectedCountSpan.textContent = count + ' selected';
                
                // Update bulk buttons
                [bulkActivateBtn, bulkDeactivateBtn, bulkDeleteBtn].forEach(btn => {
                    if (btn) btn.disabled = count === 0;
                });
                
                // Update select all checkbox
                if (selectAll) {
                    selectAll.checked = count === productCheckboxes.length;
                    selectAll.indeterminate = count > 0 && count < productCheckboxes.length;
                }
            }

            // Select all functionality
            selectAll.addEventListener('change', function() {
                productCheckboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
                updateSelectedCount();
            });

            // Individual checkboxes
            productCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateSelectedCount);
            });

            // Initial update
            updateSelectedCount();
        }

        function getSelectedProductIds() {
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');
            return Array.from(checkboxes).map(cb => cb.value);
        }

        function bulkAction(action) {
            const productIds = getSelectedProductIds();
            if (productIds.length === 0) {
                alert('Please select at least one product.');
                return;
            }

            let url, method, successMessage;
            
            if (action === 'activate') {
                url = '{{ route("vendor.products.bulk-activate") }}';
                method = 'PATCH';
                successMessage = 'Selected products activated successfully.';
            } else if (action === 'deactivate') {
                url = '{{ route("vendor.products.bulk-deactivate") }}';
                method = 'PATCH';
                successMessage = 'Selected products deactivated successfully.';
            }

            if (!confirm(`Are you sure you want to ${action} ${productIds.length} product(s)?`)) {
                return;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': method
                },
                body: JSON.stringify({ product_ids: productIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(successMessage);
                    window.location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Something went wrong.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        function confirmBulkDelete() {
            const productIds = getSelectedProductIds();
            if (productIds.length === 0) {
                alert('Please select at least one product.');
                return false;
            }
            
            document.getElementById('bulkProductIds').value = JSON.stringify(productIds);
            
            return confirm(`Are you sure you want to delete ${productIds.length} product(s)? This action cannot be undone.`);
        }

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
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
    </script>

</body>
</html>