<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Roles & Permissions</title>
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
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .btn-danger {
            background-color: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        .role-name {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .permission-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 2px;
        }

        .permission-view { background-color: #eff6ff; color: #1e40af; }
        .permission-create { background-color: #ecfdf5; color: #065f46; }
        .permission-edit { background-color: #fef3c7; color: #92400e; }
        .permission-delete { background-color: #fee2e2; color: #991b1b; }
        .permission-default { background-color: #f3f4f6; color: #4b5563; }

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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
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
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Empty State */
        .empty-state {
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
                    <input type="text" placeholder="Search roles...">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
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

            <div class="page-header">
                <div>
                    <h1 class="page-title">Roles & Permissions</h1>
                    <p class="page-subtitle">Manage user roles and access permissions</p>
                </div>
                <div>
                    <span class="badge" style="background-color: var(--primary-gold); color: white; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                        <i class="ri-shield-user-line"></i> Role-based access control
                    </span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" style="background-color: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <i class="ri-error-warning-line"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-shield-user-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Roles</div>
                        <div class="stat-number">5</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-user-settings-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Admin Users</div>
                        <div class="stat-number">3</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-key-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Permissions</div>
                        <div class="stat-number">24</div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <div>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> Create New Role
                    </a>
                </div>

                <div style="display: flex; gap: 12px;">
                    <button class="btn btn-secondary" onclick="alert('Export feature coming soon!')">
                        <i class="ri-download-line"></i> Export
                    </button>
                    <button class="btn btn-secondary" onclick="alert('Import feature coming soon!')">
                        <i class="ri-upload-line"></i> Import
                    </button>
                </div>
            </div>

            <!-- Roles Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Roles List</h3>
                    <span>Showing 1 - 5 of 5 roles</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Description</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="role-name">Super Admin</span>
                            </td>
                            <td>Full system access with all permissions</td>
                            <td>
                                <span style="font-weight: 600;">2</span>
                            </td>
                            <td>
                                <span class="permission-badge permission-view">View</span>
                                <span class="permission-badge permission-create">Create</span>
                                <span class="permission-badge permission-edit">Edit</span>
                                <span class="permission-badge permission-delete">Delete</span>
                                <span class="permission-badge permission-default">Settings</span>
                            </td>
                            <td>2024-01-01</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn" title="View Role">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Edit Role">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Clone Role">
                                        <i class="ri-file-copy-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="role-name">Admin</span>
                            </td>
                            <td>Administrative access to manage marketplace</td>
                            <td>
                                <span style="font-weight: 600;">5</span>
                            </td>
                            <td>
                                <span class="permission-badge permission-view">View</span>
                                <span class="permission-badge permission-create">Create</span>
                                <span class="permission-badge permission-edit">Edit</span>
                                <span class="permission-badge permission-delete">Delete</span>
                            </td>
                            <td>2024-01-01</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn" title="View Role">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Edit Role">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Clone Role">
                                        <i class="ri-file-copy-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="role-name">Manager</span>
                            </td>
                            <td>Manage vendors, products, and orders</td>
                            <td>
                                <span style="font-weight: 600;">8</span>
                            </td>
                            <td>
                                <span class="permission-badge permission-view">View</span>
                                <span class="permission-badge permission-create">Create</span>
                                <span class="permission-badge permission-edit">Edit</span>
                            </td>
                            <td>2024-01-15</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn" title="View Role">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Edit Role">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Clone Role">
                                        <i class="ri-file-copy-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="role-name">Support</span>
                            </td>
                            <td>Customer support and ticket management</td>
                            <td>
                                <span style="font-weight: 600;">12</span>
                            </td>
                            <td>
                                <span class="permission-badge permission-view">View</span>
                                <span class="permission-badge permission-edit">Edit</span>
                            </td>
                            <td>2024-02-01</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn" title="View Role">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Edit Role">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Clone Role">
                                        <i class="ri-file-copy-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="role-name">Viewer</span>
                            </td>
                            <td>Read-only access to marketplace data</td>
                            <td>
                                <span style="font-weight: 600;">20</span>
                            </td>
                            <td>
                                <span class="permission-badge permission-view">View</span>
                            </td>
                            <td>2024-02-10</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn" title="View Role">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Edit Role">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="#" class="action-btn" title="Clone Role">
                                        <i class="ri-file-copy-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <span class="pagination-item disabled">Previous</span>
                    <span class="pagination-item active">1</span>
                    <a href="#" class="pagination-item">2</a>
                    <a href="#" class="pagination-item">3</a>
                    <a href="#" class="pagination-item">Next</a>
                </div>
            </div>

            <!-- Permissions Overview -->
            <div style="margin-top: 32px;">
                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 16px;">Available Permissions</h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px; background-color: var(--card-bg); border-radius: 12px; padding: 24px;">
                    <div><span class="permission-badge permission-view">View Dashboard</span></div>
                    <div><span class="permission-badge permission-view">View Orders</span></div>
                    <div><span class="permission-badge permission-create">Create Orders</span></div>
                    <div><span class="permission-badge permission-edit">Edit Orders</span></div>
                    <div><span class="permission-badge permission-delete">Delete Orders</span></div>
                    <div><span class="permission-badge permission-view">View Customers</span></div>
                    <div><span class="permission-badge permission-create">Create Customers</span></div>
                    <div><span class="permission-badge permission-edit">Edit Customers</span></div>
                    <div><span class="permission-badge permission-view">View Vendors</span></div>
                    <div><span class="permission-badge permission-create">Create Vendors</span></div>
                    <div><span class="permission-badge permission-edit">Edit Vendors</span></div>
                    <div><span class="permission-badge permission-delete">Delete Vendors</span></div>
                    <div><span class="permission-badge permission-view">View Products</span></div>
                    <div><span class="permission-badge permission-create">Create Products</span></div>
                    <div><span class="permission-badge permission-edit">Edit Products</span></div>
                    <div><span class="permission-badge permission-delete">Delete Products</span></div>
                    <div><span class="permission-badge permission-view">View Promotions</span></div>
                    <div><span class="permission-badge permission-create">Create Promotions</span></div>
                    <div><span class="permission-badge permission-edit">Edit Promotions</span></div>
                    <div><span class="permission-badge permission-delete">Delete Promotions</span></div>
                    <div><span class="permission-badge permission-default">Manage Settings</span></div>
                    <div><span class="permission-badge permission-default">Manage Roles</span></div>
                    <div><span class="permission-badge permission-default">Manage Admins</span></div>
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
        });

        
    </script>

</body>
</html>
