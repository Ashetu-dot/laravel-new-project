<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Admin Management</title>
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

        .avatar img {
            width: 100%;
            height: 100%;
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
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
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(184, 142, 63, 0.15);
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

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
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
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
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
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
            border: 1px solid var(--border-color);
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
            background-color: var(--primary-bg);
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: rgba(184, 142, 63, 0.02);
        }

        .admin-name {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        body.dark-mode .status-active {
            background-color: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }
        body.dark-mode .status-inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            background-color: transparent;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 16px;
        }

        .action-btn:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .action-btn.view:hover {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        .action-btn.edit:hover {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }

        .action-btn.delete:hover {
            background-color: var(--accent-red);
            border-color: var(--accent-red);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .pagination-links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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
            min-width: 36px;
            text-align: center;
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 24px;
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

        /* Theme Toggle */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .theme-toggle:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
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
    @include('partials.admin-sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <form method="GET" action="{{ route('admin.admins.list') }}" style="width: 100%;">
                        <input type="text" name="search" placeholder="Search admins by name, email or phone..." value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            <div class="header-actions">
                <button class="theme-toggle" id="themeToggle">
                    <i class="ri-moon-line"></i>
                </button>
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @php
                        $unreadCount = $unreadNotificationsCount ?? 0;
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @php
                        $messageCount = $unreadMessagesCount ?? 0;
                    @endphp
                    @if($messageCount > 0)
                        <span class="badge-count">{{ $messageCount > 9 ? '9+' : $messageCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Admin Management</h1>
                    <p class="page-subtitle">Manage system administrators and their permissions</p>
                </div>
                <div>
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> Add New Admin
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

            <!-- Stats Cards - Using $stats from controller -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-shield-user-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Admins</div>
                        <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-user-star-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Active</div>
                        <div class="stat-number">{{ $stats['active'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-red-light">
                        <i class="ri-user-unfollow-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Inactive</div>
                        <div class="stat-number">{{ $stats['inactive'] ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="action-bar">
                <div>
                    <span>Filter by status: </span>
                    <a href="{{ route('admin.admins.list') }}" class="btn btn-secondary btn-sm {{ !request('status') ? 'active' : '' }}">All</a>
                    <a href="{{ route('admin.admins.list', ['status' => 'active']) }}" class="btn btn-secondary btn-sm {{ request('status') == 'active' ? 'active' : '' }}">Active</a>
                    <a href="{{ route('admin.admins.list', ['status' => 'inactive']) }}" class="btn btn-secondary btn-sm {{ request('status') == 'inactive' ? 'active' : '' }}">Inactive</a>
                </div>
                <div>
                    <span class="text-secondary">Total: {{ $admins->total() ?? 0 }} admins</span>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Administrators List</h3>
                    <span>Showing {{ $admins->firstItem() ?? 0 }} - {{ $admins->lastItem() ?? 0 }} of {{ $admins->total() ?? 0 }} admins</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>
                                <div class="admin-name">
                                    <div class="admin-avatar">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">{{ $admin->name }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">ID: #{{ $admin->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span style="font-weight: 500;">{{ ucfirst($admin->role) }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $admin->is_active ? 'active' : 'inactive' }}">
                                    {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                @if($admin->last_login_at)
                                    <div>{{ $admin->last_login_at->format('M d, Y') }}</div>
                                    <div style="font-size: 12px; color: var(--text-secondary);">{{ $admin->last_login_at->diffForHumans() }}</div>
                                @else
                                    <span style="color: var(--text-secondary);">Never</span>
                                @endif
                            </td>
                            <td>{{ $admin->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.admins.show', $admin->id) }}" class="action-btn view" title="View Admin">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    @if(Auth::id() !== $admin->id)
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="action-btn edit" title="Edit Admin">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <form action="{{ route('admin.admins.delete', $admin->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this admin? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete Admin">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                        <button class="action-btn" title="Change Status" onclick="changeStatus({{ $admin->id }}, {{ $admin->is_active ? 'false' : 'true' }})">
                                            <i class="ri-toggle-line"></i>
                                        </button>
                                    @else
                                        <span class="action-btn" style="opacity: 0.5; cursor: not-allowed;" title="Cannot modify your own account">
                                            <i class="ri-lock-line"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 60px;">
                                <i class="ri-shield-user-line" style="font-size: 48px; color: var(--text-secondary); margin-bottom: 16px; display: block;"></i>
                                <h3 style="margin-bottom: 8px;">No admins found</h3>
                                <p style="color: var(--text-secondary);">Get started by creating your first admin user</p>
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary" style="margin-top: 20px; display: inline-flex;">
                                    <i class="ri-add-line"></i> Add New Admin
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        Showing {{ $admins->firstItem() ?? 0 }} to {{ $admins->lastItem() ?? 0 }} of {{ $admins->total() ?? 0 }} results
                    </div>
                    <div class="pagination-links">
                        @if($admins->onFirstPage())
                            <span class="pagination-item disabled">Previous</span>
                        @else
                            <a href="{{ $admins->previousPageUrl() }}" class="pagination-item">Previous</a>
                        @endif

                        @foreach($admins->getUrlRange(1, $admins->lastPage()) as $page => $url)
                            @if($page == $admins->currentPage())
                                <span class="pagination-item active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($admins->hasMorePages())
                            <a href="{{ $admins->nextPageUrl() }}" class="pagination-item">Next</a>
                        @else
                            <span class="pagination-item disabled">Next</span>
                        @endif
                    </div>
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

            // Auto-dismiss alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                themeToggle.querySelector('i').className = 'ri-sun-line';
            }

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

        // Change admin status
        function changeStatus(adminId, newStatus) {
            if (confirm('Are you sure you want to change this admin\'s status?')) {
                fetch(`/admin/admins/${adminId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success';
                        alertDiv.innerHTML = '<i class="ri-checkbox-circle-line"></i> Admin status updated successfully.';
                        document.querySelector('.dashboard-container').insertBefore(alertDiv, document.querySelector('.stats-grid'));

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        alert(data.message || 'Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating status.');
                });
            }
        }

       
    </script>
</body>
</html>
