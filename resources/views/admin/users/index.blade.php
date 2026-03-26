<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>User Management - Admin Dashboard | Vendora Marketplace</title>
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(184, 142, 63, 0.15);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-header h3 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-blue-light { background-color: rgba(59, 130, 246, 0.1); color: var(--accent-blue); }
        .bg-green-light { background-color: rgba(16, 185, 129, 0.1); color: var(--accent-green); }
        .bg-purple-light { background-color: rgba(139, 92, 246, 0.1); color: var(--accent-purple); }
        .bg-gold-light { background-color: rgba(184, 142, 63, 0.1); color: var(--primary-gold); }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change i {
            color: var(--accent-green);
        }

        /* Filters Section */
        .filters-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
        }

        .filters-form {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-select, .filter-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--card-bg);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s;
        }

        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 12px;
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Bulk Actions */
        .bulk-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: var(--primary-bg);
            border-radius: 8px;
            margin-bottom: 16px;
            border: 1px solid var(--border-color);
        }

        .select-all {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Table */
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

        .table tr:hover td {
            background: rgba(184, 142, 63, 0.02);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-gold), #9c762f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .user-details p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
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

        .badge-unverified {
            background-color: #f3f4f6;
            color: #6b7280;
        }
        body.dark-mode .badge-unverified {
            background-color: rgba(107, 114, 128, 0.2);
            color: #9ca3af;
        }

        /* Action Buttons */
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
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            background: transparent;
            color: var(--text-secondary);
            text-decoration: none;
        }

        .action-btn:hover {
            background: var(--primary-bg);
            color: var(--primary-gold);
        }

        .action-btn.view:hover { color: var(--accent-blue); }
        .action-btn.edit:hover { color: var(--primary-gold); }
        .action-btn.delete:hover { color: var(--accent-red); }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination-info {
            color: var(--text-secondary);
            font-size: 14px;
            margin-right: auto;
        }

        .page-link {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-primary);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .page-link:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .page-link.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
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

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
                    @if($pendingOrdersCount ?? 0 > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingOrdersCount }}</span>
                    @endif
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
                    @if($pendingVendorsCount ?? 0 > 0)
                        <span style="margin-left: auto; background-color: var(--accent-yellow); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingVendorsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Admin</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.roles') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Roles & Permissions
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
                @if(auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                @else
                    {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                @endif
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
                    <form action="{{ route('admin.users') }}" method="GET" style="width: 100%; display: flex;">
                        <input type="text" name="search" placeholder="Search users by name, email, or business..." value="{{ request('search') }}">
                        @if(request('role'))
                            <input type="hidden" name="role" value="{{ request('role') }}">
                        @endif
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                    </form>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
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
                <h1 class="page-title">User Management</h1>
                <div class="breadcrumb">Manage all users on the platform</div>
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

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Total Users</h3>
                        <div class="stat-icon bg-blue-light">
                            <i class="ri-group-line"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['total']) }}</div>
                    <div class="stat-change">
                        <i class="ri-arrow-up-line"></i> All registered users
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Vendors</h3>
                        <div class="stat-icon bg-gold-light">
                            <i class="ri-store-line"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['vendors']) }}</div>
                    <div class="stat-change">
                        <i class="ri-user-star-line"></i> {{ $stats['pending'] }} pending approval
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Customers</h3>
                        <div class="stat-icon bg-green-light">
                            <i class="ri-user-line"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['customers']) }}</div>
                    <div class="stat-change">
                        <i class="ri-check-line"></i> Active buyers
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Admins</h3>
                        <div class="stat-icon bg-purple-light">
                            <i class="ri-shield-user-line"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['admins']) }}</div>
                    <div class="stat-change">
                        <i class="ri-shield-line"></i> System administrators
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <form method="GET" action="{{ route('admin.users') }}" class="filters-form">
                    <div class="filter-group">
                        <label class="filter-label">Role</label>
                        <select name="role" class="filter-select">
                            <option value="all" {{ $role == 'all' ? 'selected' : '' }}>All Roles</option>
                            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="vendor" {{ $role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="customer" {{ $role == 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select name="status" class="filter-select">
                            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
                            <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" name="search" class="filter-input" placeholder="Name, email, business..." value="{{ $search ?? '' }}">
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-filter-line"></i> Apply Filters
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                            <i class="ri-refresh-line"></i> Clear
                        </a>
                        <a href="{{ route('admin.users.export') }}?{{ http_build_query(request()->except('page')) }}" class="btn btn-secondary">
                            <i class="ri-download-line"></i> Export
                        </a>
                    </div>
                </form>
            </div>

            <!-- Bulk Actions -->
            <form method="POST" action="{{ route('admin.users.bulk-action') }}" id="bulkActionForm">
                @csrf
                <div class="bulk-actions">
                    <div class="select-all">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll">Select All</label>
                    </div>

                    <select name="action" class="filter-select" style="width: 200px;" required>
                        <option value="">Bulk Actions</option>
                        <option value="activate">Activate Selected</option>
                        <option value="deactivate">Deactivate Selected</option>
                        <option value="delete">Delete Selected</option>
                    </select>

                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to perform this action?')">
                        Apply to Selected
                    </button>
                </div>

                <!-- Users Table -->
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" id="selectAllTable">
                                </th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Verified</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox">
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            @if($user->avatar)
                                                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                            @else
                                                {{ strtoupper(substr($user->business_name ?? $user->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div class="user-details">
                                            <h4>{{ $user->business_name ?? $user->name }}</h4>
                                            <p>{{ $user->email }}</p>
                                            @if($user->phone)
                                                <p style="font-size: 11px; color: var(--text-secondary);">{{ $user->phone }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge badge-admin">Admin</span>
                                    @elseif($user->role == 'vendor')
                                        <span class="badge badge-vendor">Vendor</span>
                                    @else
                                        <span class="badge badge-customer">Customer</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_verified ?? false)
                                        <span class="badge badge-verified">Verified</span>
                                    @else
                                        <span class="badge badge-unverified">Not Verified</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="action-btn view" title="View">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn edit" title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" title="{{ $user->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="ri-{{ $user->is_active ? 'close-line' : 'check-line' }}"></i>
                                            </button>
                                        </form>
                                        @if($user->role == 'vendor')
                                        <form action="{{ route('admin.users.toggle-verification', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" title="{{ ($user->is_verified ?? false) ? 'Unverify' : 'Verify' }}">
                                                <i class="ri-{{ ($user->is_verified ?? false) ? 'shield-user-line' : 'shield-check-line' }}"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @if(auth()->id() != $user->id)
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 48px;">
                                    <i class="ri-user-search-line" style="font-size: 48px; color: var(--text-secondary);"></i>
                                    <p style="margin-top: 16px; color: var(--text-secondary);">No users found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
                </div>
                <div class="pagination-links">
                    @if($users->onFirstPage())
                        <span class="page-link disabled">Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-link">Previous</a>
                    @endif

                    @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if($page == $users->currentPage())
                            <span class="page-link active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-link">Next</a>
                    @else
                        <span class="page-link disabled">Next</span>
                    @endif
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

            // Select All functionality
            const selectAll = document.getElementById('selectAll');
            const selectAllTable = document.getElementById('selectAllTable');
            const checkboxes = document.querySelectorAll('.user-checkbox');

            function toggleSelectAll(source) {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = source.checked;
                });
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    toggleSelectAll(this);
                    if (selectAllTable) selectAllTable.checked = this.checked;
                });
            }

            if (selectAllTable) {
                selectAllTable.addEventListener('change', function() {
                    toggleSelectAll(this);
                    if (selectAll) selectAll.checked = this.checked;
                });
            }

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });

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
        });
    </script>
</body>
</html>