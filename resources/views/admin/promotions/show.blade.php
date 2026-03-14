<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>View Promotion - Vendora Admin | Jimma, Ethiopia</title>
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

        .btn-primary:hover {
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

        /* Detail Cards */
        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
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

        .info-row {
            display: flex;
            margin-bottom: 16px;
        }

        .info-label {
            width: 140px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            font-weight: 500;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .badge-active { background-color: #d1fae5; color: #065f46; }
        .badge-inactive { background-color: #fee2e2; color: #991b1b; }
        .badge-upcoming { background-color: #e0f2fe; color: #0369a1; }
        .badge-expired { background-color: #f3f4f6; color: #6b7280; }

        .type-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .type-fixed { background-color: #dbeafe; color: #1e40af; }
        .type-percentage { background-color: #fef3c7; color: #92400e; }
        .type-bogo { background-color: #f3e8ff; color: #6b21a8; }
        .type-free_shipping { background-color: #d1fae5; color: #065f46; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .products-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-weight: 500;
            font-size: 14px;
        }

        .product-meta {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .usages-table {
            width: 100%;
            border-collapse: collapse;
        }

        .usages-table th {
            text-align: left;
            padding: 12px;
            font-size: 12px;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
        }

        .usages-table td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
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
            background-color: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }

        .text-gold {
            color: var(--primary-gold);
        }

        .font-mono {
            font-family: monospace;
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
                <a href="{{ route('admin.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i> Inventory
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item active">
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
                <p>{{ ucfirst(Auth::user()->role ?? 'administrator') }}</p>
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
                    <i class="ri-megaphone-line" style="color: var(--primary-gold);"></i> Promotion Details
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
                <a href="{{ route('admin.promotions.promotions') }}" class="btn btn-secondary" style="margin-left: 8px;">
                    <i class="ri-arrow-left-line"></i> Back
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
                <h1>
                    <i class="ri-megaphone-line"></i>
                    {{ $promotion->name }}
                </h1>
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="btn btn-primary">
                        <i class="ri-edit-line"></i> Edit Promotion
                    </a>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="detail-grid">
                <!-- Main Info Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-information-line"></i>
                            Promotion Information
                        </h3>
                        @php
                            $now = now();
                            $isActive = $promotion->is_active && $promotion->start_date <= $now && $promotion->end_date >= $now;
                            $isUpcoming = $promotion->is_active && $promotion->start_date > $now;
                            $isExpired = $promotion->end_date < $now;

                            $statusClass = $isActive ? 'active' : ($isUpcoming ? 'upcoming' : ($isExpired ? 'expired' : 'inactive'));
                            $statusText = $isActive ? 'Active' : ($isUpcoming ? 'Upcoming' : ($isExpired ? 'Expired' : 'Inactive'));
                        @endphp
                        <span class="badge badge-{{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Code</div>
                        <div class="info-value">
                            <strong class="text-gold font-mono">{{ $promotion->code }}</strong>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Type</div>
                        <div class="info-value">
                            <span class="type-badge type-{{ $promotion->type }}">
                                @if($promotion->type == 'fixed')
                                    Fixed Amount
                                @elseif($promotion->type == 'percentage')
                                    Percentage
                                @elseif($promotion->type == 'bogo')
                                    Buy One Get One
                                @elseif($promotion->type == 'free_shipping')
                                    Free Shipping
                                @else
                                    {{ ucfirst($promotion->type) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Value</div>
                        <div class="info-value">
                            @if($promotion->type == 'fixed')
                                <strong>ETB {{ number_format($promotion->value, 2) }}</strong>
                            @elseif($promotion->type == 'percentage')
                                <strong>{{ $promotion->value }}%</strong>
                                @if($promotion->max_discount)
                                    <span style="font-size: 12px; color: var(--text-secondary);"> (Max ETB {{ number_format($promotion->max_discount, 2) }})</span>
                                @endif
                            @elseif($promotion->type == 'free_shipping')
                                <strong>Free Shipping</strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Duration</div>
                        <div class="info-value">
                            <strong>{{ $promotion->start_date->format('M d, Y H:i') }}</strong>
                            →
                            <strong>{{ $promotion->end_date ? $promotion->end_date->format('M d, Y H:i') : 'No end date' }}</strong>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Min Purchase</div>
                        <div class="info-value">
                            @if($promotion->min_purchase > 0)
                                ETB {{ number_format($promotion->min_purchase, 2) }}
                            @else
                                No minimum
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Product Scope</div>
                        <div class="info-value">
                            @if($promotion->product_scope == 'all')
                                All Products
                            @elseif($promotion->product_scope == 'selected')
                                Selected Products ({{ $promotion->products->count() }})
                            @elseif($promotion->product_scope == 'categories')
                                Selected Categories ({{ $promotion->categories->count() }})
                            @endif
                        </div>
                    </div>

                    @if($promotion->description)
                    <div class="info-row">
                        <div class="info-label">Description</div>
                        <div class="info-value">{{ $promotion->description }}</div>
                    </div>
                    @endif

                    @if($promotion->terms_conditions)
                    <div class="info-row">
                        <div class="info-label">Terms & Conditions</div>
                        <div class="info-value">{{ $promotion->terms_conditions }}</div>
                    </div>
                    @endif

                    <div class="info-row">
                        <div class="info-label">Created By</div>
                        <div class="info-value">{{ $promotion->creator->name ?? 'System' }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Created At</div>
                        <div class="info-value">{{ $promotion->created_at->format('M d, Y H:i') }}</div>
                    </div>

                    @if($promotion->updated_at != $promotion->created_at)
                    <div class="info-row">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $promotion->updated_at->format('M d, Y H:i') }}</div>
                    </div>
                    @endif
                </div>

                <!-- Stats Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-bar-chart-2-line"></i>
                            Usage Statistics
                        </h3>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">{{ $promotion->usages_count ?? 0 }}</div>
                            <div class="stat-label">Total Uses</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $promotion->usage_limit_per_user ?? '∞' }}</div>
                            <div class="stat-label">Per User</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $promotion->total_usage_limit ?? '∞' }}</div>
                            <div class="stat-label">Total Limit</div>
                        </div>
                    </div>

                    @if($promotion->banner)
                    <div style="margin-top: 24px;">
                        <h4 style="margin-bottom: 12px; font-size: 14px; color: var(--text-secondary);">Banner Image</h4>
                        <img src="{{ Storage::url($promotion->banner) }}" alt="Promotion Banner" style="max-width: 100%; border-radius: 8px; box-shadow: var(--shadow-sm);">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Products/Categories Section -->
            @if($promotion->product_scope != 'all' && ($promotion->products->count() > 0 || $promotion->categories->count() > 0))
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ri-shopping-bag-line"></i>
                        @if($promotion->product_scope == 'selected')
                            Applicable Products ({{ $promotion->products->count() }})
                        @elseif($promotion->product_scope == 'categories')
                            Applicable Categories ({{ $promotion->categories->count() }})
                        @endif
                    </h3>
                </div>

                <div class="products-list">
                    @if($promotion->product_scope == 'selected')
                        @forelse($promotion->products as $product)
                            <div class="product-item">
                                <div class="product-image">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <i class="ri-shopping-bag-line"></i>
                                    @endif
                                </div>
                                <div class="product-details">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-meta">
                                        SKU: {{ $product->sku ?? 'N/A' }} • Price: ETB {{ number_format($product->price, 2) }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px; color: var(--text-secondary);">
                                <i class="ri-shopping-bag-line" style="font-size: 32px; margin-bottom: 12px;"></i>
                                <p>No products selected for this promotion</p>
                            </div>
                        @endforelse
                    @elseif($promotion->product_scope == 'categories')
                        @forelse($promotion->categories as $category)
                            <div class="product-item">
                                <div class="product-image">
                                    <i class="ri-price-tag-3-line"></i>
                                </div>
                                <div class="product-details">
                                    <div class="product-name">{{ $category->name }}</div>
                                    <div class="product-meta">
                                        {{ $category->products_count ?? $category->products()->count() }} products in this category
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px; color: var(--text-secondary);">
                                <i class="ri-price-tag-3-line" style="font-size: 32px; margin-bottom: 12px;"></i>
                                <p>No categories selected for this promotion</p>
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
            @endif

            <!-- Recent Usages -->
            @if(isset($recentUsages) && $recentUsages->count() > 0)
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ri-history-line"></i>
                        Recent Usage History
                    </h3>
                    <span class="badge badge-info">{{ $recentUsages->count() }} recent uses</span>
                </div>

                <div style="overflow-x: auto;">
                    <table class="usages-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Order</th>
                                <th>Discount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsages as $usage)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div class="avatar" style="width: 24px; height: 24px; font-size: 10px;">
                                            {{ $usage->user ? strtoupper(substr($usage->user->name, 0, 2)) : 'GU' }}
                                        </div>
                                        <span>{{ $usage->user->name ?? 'Guest User' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($usage->order)
                                        <a href="{{ route('admin.orders.show', $usage->order_id) }}" class="text-gold">
                                            #{{ $usage->order->order_number ?? $usage->order_id }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="font-mono">ETB {{ number_format($usage->discount_amount, 2) }}</td>
                                <td>{{ $usage->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </main>

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
