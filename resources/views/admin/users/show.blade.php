<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>User Details - Admin Dashboard | Vendora Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-bg: #111827;
            --sidebar-bg: #1a1e2b;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #2d3348;
            --card-bg: #1f2937;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --primary-gold: #D4A55A;
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
            transition: background-color 0.3s, color 0.3s;
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
            transition: background-color 0.3s;
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
            transition: background-color 0.3s;
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
            font-size: 11px;
            font-weight: 600;
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

        .breadcrumb {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* User Profile Card */
        .profile-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 32px;
            margin-bottom: 32px;
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .profile-info {
            flex: 1;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .profile-name h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .profile-name p {
            color: var(--text-secondary);
            font-size: 16px;
        }

        .profile-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-admin {
            background-color: #fee2e2;
            color: #991b1b;
        }
        body.dark-mode .badge-admin {
            background-color: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .badge-vendor {
            background-color: #fef3c7;
            color: #92400e;
        }
        body.dark-mode .badge-vendor {
            background-color: rgba(245, 158, 11, 0.2);
            color: #fcd34d;
        }

        .badge-customer {
            background-color: #dbeafe;
            color: #1e40af;
        }
        body.dark-mode .badge-customer {
            background-color: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }

        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        body.dark-mode .badge-active {
            background-color: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .badge-inactive {
            background-color: #ffe4e6;
            color: #b91c1c;
        }
        body.dark-mode .badge-inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .badge-verified {
            background-color: #d1fae5;
            color: #065f46;
        }
        body.dark-mode .badge-verified {
            background-color: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .stat-item {
            background: var(--primary-bg);
            padding: 16px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            margin-bottom: 32px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary-gold);
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 140px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 500;
        }

        .info-value a {
            color: var(--primary-gold);
            text-decoration: none;
        }

        .info-value a:hover {
            text-decoration: underline;
        }

        /* Rating Stars */
        .rating {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .rating i {
            color: #f59e0b;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 4px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .tab {
            padding: 12px 24px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s;
            border-bottom: 2px solid transparent;
        }

        .tab:hover {
            color: var(--primary-gold);
        }

        .tab.active {
            color: var(--primary-gold);
            border-bottom-color: var(--primary-gold);
        }

        /* Tables */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: var(--primary-bg);
            padding: 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-color);
        }

        .table td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
            font-size: 14px;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background: #9c762f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background: var(--primary-bg);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--card-bg);
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-danger {
            background: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 48px;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .empty-state p {
            color: var(--text-secondary);
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
        }
        body.dark-mode .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border-color: #10b981;
            color: #6ee7b7;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #ef4444;
            color: #b91c1c;
        }
        body.dark-mode .alert-error {
            background-color: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
            color: #fca5a5;
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Management</div>
                <a href="{{ route('admin.users') }}" class="nav-item active">
                    <i class="ri-user-settings-line"></i>
                    Users
                </a>
                <a href="{{ route('admin.users.pending') }}" class="nav-item">
                    <i class="ri-user-star-line"></i>
                    Pending Vendors
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Admin</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn" style="background: none; border: none; color: var(--sidebar-text); cursor: pointer; font-size: 15px; display: flex; align-items: center; gap: 8px; padding: 12px; width: 100%; border-radius: 8px; transition: all 0.2s;">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
            </div>
            <div class="user-info">
                <h4>{{ auth()->user()->name ?? 'Admin User' }}</h4>
                <p>{{ auth()->user()->role ?? 'Super Admin' }}</p>
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
                    <input type="text" placeholder="Search...">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if($unreadNotificationsCount ?? 0 > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">User Details</h1>
                    <div class="breadcrumb">View and manage user information</div>
                </div>
                <a href="{{ route('admin.users') }}" class="back-btn">
                    <i class="ri-arrow-left-line"></i>
                    Back to Users
                </a>
            </div>

            <!-- Alerts -->
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

            <!-- User Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->business_name ?? $user->name, 0, 2)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-name">
                            <h2>{{ $user->business_name ?? $user->name }}</h2>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="profile-badges">
                            @if($user->role == 'admin')
                                <span class="badge badge-admin">Admin</span>
                            @elseif($user->role == 'vendor')
                                <span class="badge badge-vendor">Vendor</span>
                            @else
                                <span class="badge badge-customer">Customer</span>
                            @endif
                            
                            @if($user->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                            
                            @if($user->email_verified_at)
                                <span class="badge badge-verified">Verified</span>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons" style="margin-bottom: 24px;">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                            <i class="ri-edit-line"></i>
                            Edit User
                        </a>
                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">
                                <i class="ri-{{ $user->is_active ? 'close-line' : 'check-line' }}"></i>
                                {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        @if($user->role == 'vendor')
                        <form action="{{ route('admin.users.toggle-verification', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">
                                <i class="ri-{{ $user->is_verified ? 'shield-user-line' : 'shield-check-line' }}"></i>
                                {{ $user->is_verified ? 'Unverify' : 'Verify' }}
                            </button>
                        </form>
                        @endif
                        @if(auth()->id() != $user->id)
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="ri-delete-bin-line"></i>
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>

                    <!-- User Stats -->
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-label">Products</div>
                            <div class="stat-value">{{ number_format($stats['products_count']) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Reviews</div>
                            <div class="stat-value">{{ number_format($stats['reviews_count']) }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Rating</div>
                            <div class="stat-value">
                                @if($stats['average_rating'] > 0)
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($stats['average_rating']))
                                                <i class="ri-star-fill"></i>
                                            @elseif($i - 0.5 <= $stats['average_rating'])
                                                <i class="ri-star-half-fill"></i>
                                            @else
                                                <i class="ri-star-line"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span style="font-size: 14px; color: var(--text-secondary);">{{ number_format($stats['average_rating'], 1) }}</span>
                                @else
                                    No ratings
                                @endif
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Orders</div>
                            <div class="stat-value">{{ number_format($stats['orders_count']) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information Grid -->
            <div class="info-grid">
                <!-- Personal Information -->
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-user-line"></i>
                        Personal Information
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role</span>
                        <span class="info-value">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Member Since</span>
                        <span class="info-value">{{ $user->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Last Login</span>
                        <span class="info-value">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</span>
                    </div>
                </div>

                <!-- Business Information (if vendor) -->
                @if($user->role == 'vendor')
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-store-line"></i>
                        Business Information
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Business Name</span>
                        <span class="info-value">{{ $user->business_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Category</span>
                        <span class="info-value">{{ $user->category ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tax ID</span>
                        <span class="info-value">{{ $user->tax_id ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Website</span>
                        <span class="info-value">
                            @if($user->website)
                                <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Description</span>
                        <span class="info-value">{{ Str::limit($user->description ?? 'N/A', 100) }}</span>
                    </div>
                </div>
                @endif

                <!-- Address Information -->
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-map-pin-line"></i>
                        Address Information
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Address Line 1</span>
                        <span class="info-value">{{ $user->address_line1 ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Address Line 2</span>
                        <span class="info-value">{{ $user->address_line2 ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">City</span>
                        <span class="info-value">{{ $user->city ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">State</span>
                        <span class="info-value">{{ $user->state ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Zip Code</span>
                        <span class="info-value">{{ $user->zip_code ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Country</span>
                        <span class="info-value">{{ $user->country ?? 'Ethiopia' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Location</span>
                        <span class="info-value">{{ $user->location ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Social Media (if vendor) -->
                @if($user->role == 'vendor')
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-share-line"></i>
                        Social Media
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Facebook</span>
                        <span class="info-value">
                            @if($user->facebook_url)
                                <a href="{{ $user->facebook_url }}" target="_blank">{{ $user->facebook_url }}</a>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Instagram</span>
                        <span class="info-value">
                            @if($user->instagram_url)
                                <a href="{{ $user->instagram_url }}" target="_blank">{{ $user->instagram_url }}</a>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telegram</span>
                        <span class="info-value">
                            @if($user->telegram_url)
                                <a href="{{ $user->telegram_url }}" target="_blank">{{ $user->telegram_url }}</a>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Twitter</span>
                        <span class="info-value">
                            @if($user->twitter_url)
                                <a href="{{ $user->twitter_url }}" target="_blank">{{ $user->twitter_url }}</a>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>
                @endif

                <!-- Additional Information -->
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-information-line"></i>
                        Additional Information
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Referral Code</span>
                        <span class="info-value">{{ $user->referral_code ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Store Views</span>
                        <span class="info-value">{{ number_format($user->store_views ?? 0) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email Verified</span>
                        <span class="info-value">
                            @if($user->email_verified_at)
                                <span style="color: var(--accent-green);">{{ $user->email_verified_at->format('M d, Y') }}</span>
                            @else
                                <span style="color: var(--accent-red);">Not Verified</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Theme Preference</span>
                        <span class="info-value">{{ ucfirst($user->theme_preference ?? 'Light') }}</span>
                    </div>
                </div>

                <!-- Business Hours (if vendor) -->
                @if($user->role == 'vendor' && $user->business_hours)
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="ri-time-line"></i>
                        Business Hours
                    </h3>
                    @foreach(json_decode($user->business_hours, true) ?? [] as $day => $hours)
                        <div class="info-row">
                            <span class="info-label">{{ ucfirst($day) }}</span>
                            <span class="info-value">{{ $hours }}</span>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Tabs for additional data -->
            <div class="tabs">
                <div class="tab active" onclick="showTab('products')">Products ({{ $stats['products_count'] }})</div>
                <div class="tab" onclick="showTab('reviews')">Reviews ({{ $stats['reviews_count'] }})</div>
                <div class="tab" onclick="showTab('orders')">Orders ({{ $stats['orders_count'] }})</div>
            </div>

            <!-- Products Tab -->
            <div id="products-tab" class="tab-content">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->products ?? [] as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="ri-shopping-bag-3-line"></i>
                                    <p>No products found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews-tab" class="tab-content" style="display: none;">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reviewer</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->reviews ?? [] as $review)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar" style="width: 32px; height: 32px;">
                                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 2)) }}
                                        </div>
                                        <span>{{ $review->user->name ?? 'Anonymous' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="ri-star-fill"></i>
                                            @else
                                                <i class="ri-star-line"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ Str::limit($review->comment ?? 'No comment', 50) }}</td>
                                <td>{{ $review->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <i class="ri-star-line"></i>
                                    <p>No reviews found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Orders Tab -->
            <div id="orders-tab" class="tab-content" style="display: none;">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->orders ?? [] as $order)
                            <tr>
                                <td>#{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status_color ?? 'active' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <i class="ri-shopping-cart-line"></i>
                                    <p>No orders found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
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

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });

        // Tab switching
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Theme Toggle (if you want to add it)
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                const icon = this.querySelector('i');
                if (document.body.classList.contains('dark-mode')) {
                    icon.className = 'ri-sun-line';
                    localStorage.setItem('theme', 'dark');
                } else {
                    icon.className = 'ri-moon-line';
                    localStorage.setItem('theme', 'light');
                }
            });
        }

        // Initialize theme
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            const themeToggleIcon = document.querySelector('#themeToggle i');
            if (themeToggleIcon) themeToggleIcon.className = 'ri-sun-line';
        }
    </script>
</body>
</html>