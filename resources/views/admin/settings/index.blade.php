<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Admin Settings</title>
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

        /* Settings Layout */
        .settings-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .settings-container {
                grid-template-columns: 1fr;
            }
        }

        /* Settings Sidebar */
        .settings-sidebar {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .settings-nav {
            padding: 16px;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 4px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 14px;
        }

        .settings-nav-item:hover {
            background-color: #f3f4f6;
        }

        .settings-nav-item.active {
            background-color: #fef3e7;
            color: var(--primary-gold);
            font-weight: 500;
        }

        .settings-nav-item i {
            font-size: 20px;
        }

        /* Settings Content */
        .settings-content {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 32px;
        }

        .settings-section {
            display: none;
        }

        .settings-section.active {
            display: block;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        /* Alert Messages */
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
            border: 1px solid #a7f3d0;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 6px;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary-gold);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        .toggle-label {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Button */
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
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        /* Info Cards */
        .info-card {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .info-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-list {
            list-style: none;
        }

        .info-list li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
        }

        /* Danger Zone */
        .danger-zone {
            border: 1px solid #fee2e2;
            border-radius: 8px;
            padding: 24px;
            background-color: #fff5f5;
            margin-top: 32px;
        }

        .danger-title {
            color: var(--danger-color);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
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
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ADMIN</div>
                <a href="{{ route('admin.settings') }}" class="nav-item active">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Admins
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i>
                    Help
                </a>
                <a href="{{ route('admin.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i>
                    Notifications
                </a>
                <a href="{{ route('admin.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i>
                    Messages
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>{{ Auth::user()->role ?? 'Super Admin' }}</p>
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
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search settings...">
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
                    <h1 class="page-title">Settings</h1>
                    <p class="page-subtitle">Manage your marketplace configuration and preferences</p>
                </div>
                <div>
                    <span class="badge" style="background-color: var(--primary-gold); color: white; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                        <i class="ri-save-line"></i> Auto-save enabled
                    </span>
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

            <!-- Settings Container -->
            <div class="settings-container">
                <!-- Settings Sidebar -->
                <div class="settings-sidebar">
                    <div class="settings-nav">
                        <button class="settings-nav-item active" onclick="showSection('general')">
                            <i class="ri-settings-4-line"></i>
                            General Settings
                        </button>
                        <button class="settings-nav-item" onclick="showSection('profile')">
                            <i class="ri-user-settings-line"></i>
                            Profile Settings
                        </button>
                        <button class="settings-nav-item" onclick="showSection('security')">
                            <i class="ri-shield-keyhole-line"></i>
                            Security
                        </button>
                        <button class="settings-nav-item" onclick="showSection('marketplace')">
                            <i class="ri-store-3-line"></i>
                            Marketplace
                        </button>
                        <button class="settings-nav-item" onclick="showSection('payment')">
                            <i class="ri-bank-card-line"></i>
                            Payment Gateways
                        </button>
                        <button class="settings-nav-item" onclick="showSection('email')">
                            <i class="ri-mail-settings-line"></i>
                            Email Settings
                        </button>
                        <button class="settings-nav-item" onclick="showSection('notifications')">
                            <i class="ri-notification-4-line"></i>
                            Notification Preferences
                        </button>
                        <button class="settings-nav-item" onclick="showSection('backup')">
                            <i class="ri-database-2-line"></i>
                            Backup & Restore
                        </button>
                        <button class="settings-nav-item" onclick="showSection('api')">
                            <i class="ri-code-box-line"></i>
                            API Settings
                        </button>
                        <button class="settings-nav-item" onclick="showSection('legal')">
                            <i class="ri-file-text-line"></i>
                            Legal & Policies
                        </button>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="settings-content">
                    <!-- General Settings Section -->
                    <div id="section-general" class="settings-section active">
                        <h2 class="section-title">General Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-input" value="Vendora Marketplace" placeholder="Enter site name">
                                <div class="form-hint">This will appear in page titles and emails</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Site Description</label>
                                <textarea name="site_description" class="form-textarea" placeholder="Enter site description">The best local vendor marketplace</textarea>
                                <div class="form-hint">Brief description for SEO and sharing</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Site URL</label>
                                    <input type="url" name="site_url" class="form-input" value="{{ config('app.url') }}" placeholder="https://example.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Site Email</label>
                                    <input type="email" name="site_email" class="form-input" value="info@vendora.com" placeholder="info@example.com">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Timezone</label>
                                    <select name="timezone" class="form-select">
                                        <option value="UTC" selected>UTC</option>
                                        <option value="America/New_York">Eastern Time</option>
                                        <option value="America/Chicago">Central Time</option>
                                        <option value="America/Denver">Mountain Time</option>
                                        <option value="America/Los_Angeles">Pacific Time</option>
                                        <option value="Europe/London">London</option>
                                        <option value="Europe/Paris">Paris</option>
                                        <option value="Asia/Tokyo">Tokyo</option>
                                        <option value="Asia/Shanghai">Shanghai</option>
                                        <option value="Australia/Sydney">Sydney</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Format</label>
                                    <select name="date_format" class="form-select">
                                        <option value="Y-m-d">2024-01-01</option>
                                        <option value="m/d/Y">01/01/2024</option>
                                        <option value="d/m/Y">01/01/2024</option>
                                        <option value="F j, Y">January 1, 2024</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Maintenance Mode</strong>
                                        <div class="form-hint">Temporarily disable the site for maintenance</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="maintenance_mode">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Profile Settings Section -->
                    <div id="section-profile" class="settings-section">
                        <h2 class="section-title">Profile Settings</h2>

                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div style="display: flex; align-items: center; gap: 24px; margin-bottom: 24px;">
                                <div style="position: relative;">
                                    <div class="avatar" style="width: 80px; height: 80px; font-size: 32px;">
                                        {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                                    </div>
                                    <button type="button" class="btn btn-secondary" style="position: absolute; bottom: -10px; right: -10px; width: 32px; height: 32px; padding: 0; border-radius: 50%;" onclick="document.getElementById('avatarInput').click();">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <input type="file" id="avatarInput" name="avatar" style="display: none;" accept="image/*">
                                </div>
                                <div>
                                    <h3 style="font-size: 18px; margin-bottom: 4px;">{{ Auth::user()->name }}</h3>
                                    <p style="color: var(--text-secondary);">{{ Auth::user()->email }}</p>
                                    <p style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-input" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-input" value="{{ Auth::user()->email }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" class="form-input" value="{{ Auth::user()->phone ?? '' }}" placeholder="+1 (555) 123-4567">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Department</label>
                                    <input type="text" name="department" class="form-input" value="Administration" placeholder="Department">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Bio / About</label>
                                <textarea name="bio" class="form-textarea" placeholder="Tell us a little about yourself">{{ Auth::user()->description ?? '' }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Section -->
                    <div id="section-security" class="settings-section">
                        <h2 class="section-title">Security Settings</h2>

                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf

                            <div class="info-card">
                                <div class="info-title">
                                    <i class="ri-shield-check-line" style="color: var(--accent-green);"></i>
                                    Password Requirements
                                </div>
                                <ul style="margin-left: 20px; color: var(--text-secondary);">
                                    <li>At least 8 characters long</li>
                                    <li>Include at least one uppercase letter</li>
                                    <li>Include at least one number</li>
                                    <li>Include at least one special character</li>
                                </ul>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-input" placeholder="••••••••" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-input" placeholder="••••••••" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-input" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Two-Factor Authentication</strong>
                                        <div class="form-hint">Add an extra layer of security to your account</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="two_factor">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>

                        <!-- Session Management -->
                        <div style="margin-top: 32px;">
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Active Sessions</h3>

                            <div class="info-card">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 32px; height: 32px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-window-line"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">Chrome on Windows</div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">Last active: Just now</div>
                                        </div>
                                    </div>
                                    <span class="badge" style="background-color: var(--accent-green); color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px;">Current</span>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 32px; height: 32px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-smartphone-line"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">Safari on iPhone</div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">Last active: 2 hours ago</div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary" style="padding: 4px 12px; font-size: 12px;">Terminate</button>
                                </div>
                            </div>

                            <button class="btn btn-secondary" style="margin-top: 8px;">
                                <i class="ri-logout-box-line"></i> Logout All Devices
                            </button>
                        </div>
                    </div>

                    <!-- Marketplace Settings -->
                    <div id="section-marketplace" class="settings-section">
                        <h2 class="section-title">Marketplace Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD" selected>USD - US Dollar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="GBP">GBP - British Pound</option>
                                    <option value="JPY">JPY - Japanese Yen</option>
                                    <option value="CAD">CAD - Canadian Dollar</option>
                                    <option value="AUD">AUD - Australian Dollar</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Commission Rate (%)</label>
                                    <input type="number" name="commission_rate" class="form-input" value="10" min="0" max="100" step="0.1">
                                    <div class="form-hint">Percentage taken from each sale</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Minimum Payout ($)</label>
                                    <input type="number" name="minimum_payout" class="form-input" value="50" min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Allow Guest Checkout</strong>
                                        <div class="form-hint">Customers can checkout without creating an account</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="guest_checkout" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Vendor Verification Required</strong>
                                        <div class="form-hint">Vendors must verify their identity before selling</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="vendor_verification" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Enable Reviews</strong>
                                        <div class="form-hint">Allow customers to review products and vendors</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="enable_reviews" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Marketplace Settings</button>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Gateways -->
                    <div id="section-payment" class="settings-section">
                        <h2 class="section-title">Payment Gateways</h2>

                        <div style="display: grid; gap: 16px; margin-bottom: 24px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid var(--border-color); border-radius: 8px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/stripe.svg" alt="Stripe" style="width: 40px; height: 40px;">
                                    <div>
                                        <h4 style="font-weight: 600;">Stripe</h4>
                                        <p style="font-size: 13px; color: var(--text-secondary);">Credit cards, Apple Pay, Google Pay</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid var(--border-color); border-radius: 8px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/paypal.svg" alt="PayPal" style="width: 40px; height: 40px;">
                                    <div>
                                        <h4 style="font-weight: 600;">PayPal</h4>
                                        <p style="font-size: 13px; color: var(--text-secondary);">PayPal accounts and credit cards</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="toggle-switch">
                                        <input type="checkbox">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid var(--border-color); border-radius: 8px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/square.svg" alt="Square" style="width: 40px; height: 40px;">
                                    <div>
                                        <h4 style="font-weight: 600;">Square</h4>
                                        <p style="font-size: 13px; color: var(--text-secondary);">Credit cards and in-person payments</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="toggle-switch">
                                        <input type="checkbox">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary">Configure Payment Gateways</button>
                    </div>

                    <!-- Email Settings -->
                    <div id="section-email" class="settings-section">
                        <h2 class="section-title">Email Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Driver</label>
                                    <select name="mail_driver" class="form-select">
                                        <option value="smtp" selected>SMTP</option>
                                        <option value="sendmail">Sendmail</option>
                                        <option value="mailgun">Mailgun</option>
                                        <option value="ses">Amazon SES</option>
                                        <option value="postmark">Postmark</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Host</label>
                                    <input type="text" name="mail_host" class="form-input" value="smtp.mailtrap.io">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Port</label>
                                    <input type="text" name="mail_port" class="form-input" value="2525">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Username</label>
                                    <input type="text" name="mail_username" class="form-input" value="">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Password</label>
                                    <input type="password" name="mail_password" class="form-input" placeholder="••••••••">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Encryption</label>
                                    <select name="mail_encryption" class="form-select">
                                        <option value="tls">TLS</option>
                                        <option value="ssl">SSL</option>
                                        <option value="">None</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">From Address</label>
                                <input type="email" name="mail_from_address" class="form-input" value="noreply@vendora.com">
                            </div>

                            <div class="form-group">
                                <label class="form-label">From Name</label>
                                <input type="text" name="mail_from_name" class="form-input" value="Vendora Marketplace">
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Email Settings</button>
                                <button type="button" class="btn btn-secondary">Send Test Email</button>
                            </div>
                        </form>
                    </div>

                    <!-- Notification Preferences -->
                    <div id="section-notifications" class="settings-section">
                        <h2 class="section-title">Notification Preferences</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>New Order Notifications</strong>
                                        <div class="form-hint">Get notified when a new order is placed</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notify_new_order" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>New Vendor Registration</strong>
                                        <div class="form-hint">Get notified when a vendor registers</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notify_new_vendor" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>New Customer Registration</strong>
                                        <div class="form-hint">Get notified when a new customer signs up</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notify_new_customer">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Low Stock Alerts</strong>
                                        <div class="form-hint">Get notified when products are running low</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notify_low_stock" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>System Updates</strong>
                                        <div class="form-hint">Get notified about system maintenance and updates</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notify_system" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Preferences</button>
                            </div>
                        </form>
                    </div>

                    <!-- Backup & Restore -->
                    <div id="section-backup" class="settings-section">
                        <h2 class="section-title">Backup & Restore</h2>

                        <div class="info-card">
                            <div class="info-title">
                                <i class="ri-information-line"></i>
                                Backup Information
                            </div>
                            <ul class="info-list">
                                <li>
                                    <span class="info-label">Last Backup</span>
                                    <span class="info-value">2024-02-13 03:00 AM</span>
                                </li>
                                <li>
                                    <span class="info-label">Backup Size</span>
                                    <span class="info-value">2.4 GB</span>
                                </li>
                                <li>
                                    <span class="info-label">Next Scheduled</span>
                                    <span class="info-value">2024-02-14 03:00 AM</span>
                                </li>
                                <li>
                                    <span class="info-label">Backup Location</span>
                                    <span class="info-value">Amazon S3</span>
                                </li>
                            </ul>
                        </div>

                        <div style="display: flex; gap: 16px; margin-bottom: 32px;">
                            <button class="btn btn-primary">
                                <i class="ri-download-line"></i> Download Backup
                            </button>
                            <button class="btn btn-success">
                                <i class="ri-refresh-line"></i> Create Backup Now
                            </button>
                            <button class="btn btn-secondary">
                                <i class="ri-upload-line"></i> Restore Backup
                            </button>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Available Backups</h3>

                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <th style="text-align: left; padding: 12px;">Backup File</th>
                                    <th style="text-align: left; padding: 12px;">Date</th>
                                    <th style="text-align: left; padding: 12px;">Size</th>
                                    <th style="text-align: left; padding: 12px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 12px;">backup-2024-02-13.sql</td>
                                    <td style="padding: 12px;">2024-02-13 03:00</td>
                                    <td style="padding: 12px;">2.4 GB</td>
                                    <td style="padding: 12px;">
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">Download</button>
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">Restore</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px;">backup-2024-02-12.sql</td>
                                    <td style="padding: 12px;">2024-02-12 03:00</td>
                                    <td style="padding: 12px;">2.3 GB</td>
                                    <td style="padding: 12px;">
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">Download</button>
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">Restore</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- API Settings -->
                    <div id="section-api" class="settings-section">
                        <h2 class="section-title">API Settings</h2>

                        <div class="info-card">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                                <div>
                                    <h4 style="font-weight: 600;">API Keys</h4>
                                    <p style="font-size: 13px; color: var(--text-secondary);">Manage your API access keys</p>
                                </div>
                                <button class="btn btn-primary">Generate New Key</button>
                            </div>

                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--border-color);">
                                        <th style="text-align: left; padding: 12px;">Name</th>
                                        <th style="text-align: left; padding: 12px;">API Key</th>
                                        <th style="text-align: left; padding: 12px;">Created</th>
                                        <th style="text-align: left; padding: 12px;">Last Used</th>
                                        <th style="text-align: left; padding: 12px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 12px;">Production</td>
                                        <td style="padding: 12px;">
                                            <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">sk_live_••••••••••</code>
                                        </td>
                                        <td style="padding: 12px;">2024-01-01</td>
                                        <td style="padding: 12px;">2024-02-13</td>
                                        <td style="padding: 12px;">
                                            <button class="btn btn-secondary" style="padding: 4px 8px;">Revoke</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 12px;">Development</td>
                                        <td style="padding: 12px;">
                                            <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">sk_test_••••••••••</code>
                                        </td>
                                        <td style="padding: 12px;">2024-01-15</td>
                                        <td style="padding: 12px;">2024-02-12</td>
                                        <td style="padding: 12px;">
                                            <button class="btn btn-secondary" style="padding: 4px 8px;">Revoke</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label class="toggle-label">
                                <span style="flex: 1;">
                                    <strong>Enable API Access</strong>
                                    <div class="form-hint">Allow third-party applications to access the API</div>
                                </span>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Rate Limit (requests per minute)</label>
                            <input type="number" class="form-input" value="60">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Allowed IPs</label>
                            <textarea class="form-textarea" placeholder="192.168.1.1&#10;10.0.0.0/24">192.168.1.1
10.0.0.0/24</textarea>
                            <div class="form-hint">One IP or CIDR per line. Leave empty to allow all.</div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary">Save API Settings</button>
                        </div>
                    </div>

                    <!-- Legal & Policies -->
                    <div id="section-legal" class="settings-section">
                        <h2 class="section-title">Legal & Policies</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Terms of Service</label>
                                <textarea class="form-textarea" rows="10" placeholder="Enter your terms of service...">By using Vendora Marketplace, you agree to these terms...</textarea>
                                <div class="form-actions" style="justify-content: flex-start; padding-top: 8px;">
                                    <button class="btn btn-secondary">Upload PDF</button>
                                    <span class="form-hint">or paste content above</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Privacy Policy</label>
                                <textarea class="form-textarea" rows="10" placeholder="Enter your privacy policy...">We value your privacy and are committed to protecting your personal data...</textarea>
                                <div class="form-actions" style="justify-content: flex-start; padding-top: 8px;">
                                    <button class="btn btn-secondary">Upload PDF</button>
                                    <span class="form-hint">or paste content above</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Cookie Policy</label>
                                <textarea class="form-textarea" rows="5" placeholder="Enter your cookie policy...">This website uses cookies to improve your experience...</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">GDPR Compliance</label>
                                <select class="form-select">
                                    <option>Enabled</option>
                                    <option>Disabled</option>
                                </select>
                                <div class="form-hint">Enable GDPR compliance features for EU customers</div>
                            </div>

                            <div class="form-actions">
                                <button class="btn btn-primary">Save Policies</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="danger-zone">
                <h3 class="danger-title">
                    <i class="ri-alert-line"></i>
                    Danger Zone
                </h3>
                <p style="color: var(--text-secondary); margin-bottom: 20px;">Once you delete your account or data, there is no going back. Please be certain.</p>

                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to clear all cache? This cannot be undone.')) alert('Cache cleared!')">
                        <i class="ri-delete-bin-line"></i> Clear Cache
                    </button>
                    <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to reset all settings? This cannot be undone.')) alert('Settings reset!')">
                        <i class="ri-reset-left-line"></i> Reset All Settings
                    </button>
                    <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete your account? This cannot be undone.')) alert('Account deletion request submitted!')">
                        <i class="ri-user-unfollow-line"></i> Delete Account
                    </button>
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

        // Show settings section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.settings-section').forEach(section => {
                section.classList.remove('active');
            });

            // Remove active class from all nav items
            document.querySelectorAll('.settings-nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Show selected section
            document.getElementById('section-' + sectionId).classList.add('active');

            // Add active class to clicked nav item
            event.currentTarget.classList.add('active');
        }

        // Avatar upload preview
        document.getElementById('avatarInput')?.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can update avatar preview here
                    console.log('Avatar selected:', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
