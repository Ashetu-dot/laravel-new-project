<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Admin Settings</title>
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

        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                <a href="{{ route('admin.support-tickets') }}" class="nav-item">
                    <i class="ri-question-line"></i>
                    Support
                </a>
                <a href="{{ route('admin.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i>
                    Notifications
                </a>
                <a href="{{ route('admin.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i>
                    Messages
                </a>
                <a href="{{ route('admin.video-tutorials') }}" class="nav-item">
                    <i class="ri-video-line"></i>
                    Tutorials
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
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>Administrator</p>
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
                    <input type="text" placeholder="Search settings..." id="settingsSearch">
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
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
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

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Settings Container -->
            <div class="settings-container">
                <!-- Settings Sidebar -->
                <div class="settings-sidebar">
                    <div class="settings-nav">
                        <button class="settings-nav-item {{ $activeSection == 'general' ? 'active' : '' }}" onclick="showSection('general')">
                            <i class="ri-settings-4-line"></i>
                            General Settings
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'profile' ? 'active' : '' }}" onclick="showSection('profile')">
                            <i class="ri-user-settings-line"></i>
                            Profile Settings
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'security' ? 'active' : '' }}" onclick="showSection('security')">
                            <i class="ri-shield-keyhole-line"></i>
                            Security
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'marketplace' ? 'active' : '' }}" onclick="showSection('marketplace')">
                            <i class="ri-store-3-line"></i>
                            Marketplace
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'payment' ? 'active' : '' }}" onclick="showSection('payment')">
                            <i class="ri-bank-card-line"></i>
                            Payment Gateways
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'email' ? 'active' : '' }}" onclick="showSection('email')">
                            <i class="ri-mail-settings-line"></i>
                            Email Settings
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'notifications' ? 'active' : '' }}" onclick="showSection('notifications')">
                            <i class="ri-notification-4-line"></i>
                            Notification Preferences
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'backup' ? 'active' : '' }}" onclick="showSection('backup')">
                            <i class="ri-database-2-line"></i>
                            Backup & Restore
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'api' ? 'active' : '' }}" onclick="showSection('api')">
                            <i class="ri-code-box-line"></i>
                            API Settings
                        </button>
                        <button class="settings-nav-item {{ $activeSection == 'legal' ? 'active' : '' }}" onclick="showSection('legal')">
                            <i class="ri-file-text-line"></i>
                            Legal & Policies
                        </button>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="settings-content">
                    <!-- General Settings Section -->
                    <div id="section-general" class="settings-section {{ $activeSection == 'general' ? 'active' : '' }}">
                        <h2 class="section-title">General Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="general">

                            <div class="form-group">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-input" value="{{ config('app.name', 'Vendora Marketplace') }}" placeholder="Enter site name">
                                <div class="form-hint">This will appear in page titles and emails</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Site Description</label>
                                <textarea name="site_description" class="form-textarea" placeholder="Enter site description">{{ config('app.description', 'The best local vendor marketplace') }}</textarea>
                                <div class="form-hint">Brief description for SEO and sharing</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Site URL</label>
                                    <input type="url" name="site_url" class="form-input" value="{{ config('app.url') }}" placeholder="https://example.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Site Email</label>
                                    <input type="email" name="site_email" class="form-input" value="{{ config('mail.from.address', 'info@vendora.com') }}" placeholder="info@example.com">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Timezone</label>
                                    <select name="timezone" class="form-select">
                                        @php
                                            $timezones = [
                                                'UTC' => 'UTC',
                                                'America/New_York' => 'Eastern Time',
                                                'America/Chicago' => 'Central Time',
                                                'America/Denver' => 'Mountain Time',
                                                'America/Los_Angeles' => 'Pacific Time',
                                                'Europe/London' => 'London',
                                                'Europe/Paris' => 'Paris',
                                                'Asia/Tokyo' => 'Tokyo',
                                                'Asia/Shanghai' => 'Shanghai',
                                                'Australia/Sydney' => 'Sydney',
                                                'Africa/Addis_Ababa' => 'Addis Ababa (Ethiopia)',
                                            ];
                                        @endphp
                                        @foreach($timezones as $value => $label)
                                            <option value="{{ $value }}" {{ config('app.timezone', 'UTC') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Format</label>
                                    <select name="date_format" class="form-select">
                                        <option value="Y-m-d" {{ config('app.date_format', 'Y-m-d') == 'Y-m-d' ? 'selected' : '' }}>2024-01-01</option>
                                        <option value="m/d/Y" {{ config('app.date_format') == 'm/d/Y' ? 'selected' : '' }}>01/01/2024</option>
                                        <option value="d/m/Y" {{ config('app.date_format') == 'd/m/Y' ? 'selected' : '' }}>01/01/2024</option>
                                        <option value="F j, Y" {{ config('app.date_format') == 'F j, Y' ? 'selected' : '' }}>January 1, 2024</option>
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
                                        <input type="checkbox" name="maintenance_mode" {{ app()->isDownForMaintenance() ? 'checked' : '' }}>
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
                    <div id="section-profile" class="settings-section {{ $activeSection == 'profile' ? 'active' : '' }}">
                        <h2 class="section-title">Profile Settings</h2>

                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div style="display: flex; align-items: center; gap: 24px; margin-bottom: 24px; flex-wrap: wrap;">
                                <div style="position: relative;">
                                    <div class="avatar" style="width: 80px; height: 80px; font-size: 32px;">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" id="avatarPreview">
                                        @else
                                            <span id="avatarInitials">{{ substr(Auth::user()->name ?? 'AD', 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-secondary" style="position: absolute; bottom: -10px; right: -10px; width: 32px; height: 32px; padding: 0; border-radius: 50%;" onclick="document.getElementById('avatarInput').click();">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <input type="file" id="avatarInput" name="avatar" style="display: none;" accept="image/*" onchange="previewAvatar(this)">
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
                                    <input type="tel" name="phone" class="form-input" value="{{ Auth::user()->phone ?? '' }}" placeholder="+251 91 234 5678">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Department</label>
                                    <input type="text" name="department" class="form-input" value="{{ Auth::user()->department ?? 'Administration' }}" placeholder="Department">
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
                    <div id="section-security" class="settings-section {{ $activeSection == 'security' ? 'active' : '' }}">
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
                                        <input type="checkbox" name="two_factor" {{ Auth::user()->two_factor_enabled ?? false ? 'checked' : '' }}>
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

                            <div class="info-card" id="sessions-list">
                                <div style="text-align: center; padding: 20px;">
                                    <div class="spinner"></div>
                                    <p>Loading sessions...</p>
                                </div>
                            </div>

                            <button class="btn btn-secondary" onclick="logoutAllDevices()" style="margin-top: 8px;">
                                <i class="ri-logout-box-line"></i> Logout All Devices
                            </button>
                        </div>
                    </div>

                    <!-- Marketplace Settings -->
                    <div id="section-marketplace" class="settings-section {{ $activeSection == 'marketplace' ? 'active' : '' }}">
                        <h2 class="section-title">Marketplace Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="marketplace">

                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD" {{ config('marketplace.currency', 'USD') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                    <option value="EUR" {{ config('marketplace.currency') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                    <option value="GBP" {{ config('marketplace.currency') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                    <option value="ETB" {{ config('marketplace.currency') == 'ETB' ? 'selected' : '' }}>ETB - Ethiopian Birr</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Commission Rate (%)</label>
                                    <input type="number" name="commission_rate" class="form-input" value="{{ config('marketplace.commission_rate', 10) }}" min="0" max="100" step="0.1">
                                    <div class="form-hint">Percentage taken from each sale</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Minimum Payout ($)</label>
                                    <input type="number" name="minimum_payout" class="form-input" value="{{ config('marketplace.minimum_payout', 50) }}" min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Allow Guest Checkout</strong>
                                        <div class="form-hint">Customers can checkout without creating an account</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="guest_checkout" {{ config('marketplace.guest_checkout', true) ? 'checked' : '' }}>
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
                                        <input type="checkbox" name="vendor_verification" {{ config('marketplace.vendor_verification', true) ? 'checked' : '' }}>
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
                                        <input type="checkbox" name="enable_reviews" {{ config('marketplace.enable_reviews', true) ? 'checked' : '' }}>
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
                    <div id="section-payment" class="settings-section {{ $activeSection == 'payment' ? 'active' : '' }}">
                        <h2 class="section-title">Payment Gateways</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="payment">

                            <div style="display: grid; gap: 16px; margin-bottom: 24px;">
                                @php
                                    $gateways = [
                                        'chapa' => ['name' => 'Chapa', 'icon' => 'ri-bank-line', 'description' => 'Ethiopian online payment gateway'],
                                        'cash_on_delivery' => ['name' => 'Cash on Delivery', 'icon' => 'ri-money-dollar-circle-line', 'description' => 'Customers pay in cash when orders are delivered'],
                                    ];
                                @endphp

                                @foreach($gateways as $key => $gateway)
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid var(--border-color); border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 16px;">
                                        <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="{{ $gateway['icon'] }}" style="font-size: 24px; color: var(--primary-gold);"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-weight: 600;">{{ $gateway['name'] }}</h4>
                                            <p style="font-size: 13px; color: var(--text-secondary);">{{ $gateway['description'] }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="gateways[{{ $key }}]" {{ config("payment.gateways.{$key}.enabled", in_array($key, ['chapa', 'cash_on_delivery'])) ? 'checked' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Payment Settings</button>
                            </div>
                        </form>
                    </div>

                    <!-- Email Settings -->
                    <div id="section-email" class="settings-section {{ $activeSection == 'email' ? 'active' : '' }}">
                        <h2 class="section-title">Email Settings</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="email">

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Driver</label>
                                    <select name="mail_driver" class="form-select">
                                        <option value="smtp" {{ config('mail.default', 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                        <option value="sendmail" {{ config('mail.default') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                        <option value="mailgun" {{ config('mail.default') == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                        <option value="ses" {{ config('mail.default') == 'ses' ? 'selected' : '' }}>Amazon SES</option>
                                        <option value="postmark" {{ config('mail.default') == 'postmark' ? 'selected' : '' }}>Postmark</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Host</label>
                                    <input type="text" name="mail_host" class="form-input" value="{{ config('mail.mailers.smtp.host', 'smtp.mailtrap.io') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Port</label>
                                    <input type="text" name="mail_port" class="form-input" value="{{ config('mail.mailers.smtp.port', 2525) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Username</label>
                                    <input type="text" name="mail_username" class="form-input" value="{{ config('mail.mailers.smtp.username', '') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mail Password</label>
                                    <input type="password" name="mail_password" class="form-input" placeholder="••••••••" value="{{ config('mail.mailers.smtp.password', '') }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mail Encryption</label>
                                    <select name="mail_encryption" class="form-select">
                                        <option value="tls" {{ config('mail.mailers.smtp.encryption', 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ config('mail.mailers.smtp.encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                        <option value="" {{ config('mail.mailers.smtp.encryption') == '' ? 'selected' : '' }}>None</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">From Address</label>
                                <input type="email" name="mail_from_address" class="form-input" value="{{ config('mail.from.address', 'noreply@vendora.com') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">From Name</label>
                                <input type="text" name="mail_from_name" class="form-input" value="{{ config('mail.from.name', 'Vendora Marketplace') }}">
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Email Settings</button>
                                <button type="button" class="btn btn-secondary" onclick="sendTestEmail()">Send Test Email</button>
                            </div>
                        </form>
                    </div>

                    <!-- Notification Preferences -->
                    <div id="section-notifications" class="settings-section {{ $activeSection == 'notifications' ? 'active' : '' }}">
                        <h2 class="section-title">Notification Preferences</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="notifications">

                            @php
                                $notificationTypes = [
                                    'new_order' => ['label' => 'New Order Notifications', 'desc' => 'Get notified when a new order is placed'],
                                    'new_vendor' => ['label' => 'New Vendor Registration', 'desc' => 'Get notified when a vendor registers'],
                                    'new_customer' => ['label' => 'New Customer Registration', 'desc' => 'Get notified when a new customer signs up'],
                                    'low_stock' => ['label' => 'Low Stock Alerts', 'desc' => 'Get notified when products are running low'],
                                    'system' => ['label' => 'System Updates', 'desc' => 'Get notified about system maintenance and updates'],
                                    'vendor_verification' => ['label' => 'Vendor Verification Requests', 'desc' => 'Get notified when a vendor requests verification'],
                                    'refund_request' => ['label' => 'Refund Requests', 'desc' => 'Get notified when a customer requests a refund'],
                                ];
                            @endphp

                            @foreach($notificationTypes as $key => $type)
                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>{{ $type['label'] }}</strong>
                                        <div class="form-hint">{{ $type['desc'] }}</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="notifications[{{ $key }}]" {{ config("notifications.{$key}", true) ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>
                            @endforeach

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Preferences</button>
                            </div>
                        </form>
                    </div>

                    <!-- Backup & Restore -->
                    <div id="section-backup" class="settings-section {{ $activeSection == 'backup' ? 'active' : '' }}">
                        <h2 class="section-title">Backup & Restore</h2>

                        <div class="info-card" id="backup-info">
                            <div class="info-title">
                                <i class="ri-information-line"></i>
                                Backup Information
                            </div>
                            <ul class="info-list" id="backup-details">
                                <li>
                                    <span class="info-label">Last Backup</span>
                                    <span class="info-value" id="last-backup">Loading...</span>
                                </li>
                                <li>
                                    <span class="info-label">Backup Size</span>
                                    <span class="info-value" id="backup-size">Loading...</span>
                                </li>
                                <li>
                                    <span class="info-label">Next Scheduled</span>
                                    <span class="info-value" id="next-backup">Loading...</span>
                                </li>
                                <li>
                                    <span class="info-label">Backup Location</span>
                                    <span class="info-value" id="backup-location">Loading...</span>
                                </li>
                            </ul>
                        </div>

                        <div style="display: flex; gap: 16px; margin-bottom: 32px; flex-wrap: wrap;">
                            <button class="btn btn-primary" onclick="downloadBackup()">
                                <i class="ri-download-line"></i> Download Backup
                            </button>
                            <button class="btn btn-success" onclick="createBackup()">
                                <i class="ri-refresh-line"></i> Create Backup Now
                            </button>
                            <button class="btn btn-secondary" onclick="document.getElementById('restoreBackup').click()">
                                <i class="ri-upload-line"></i> Restore Backup
                            </button>
                            <input type="file" id="restoreBackup" style="display: none;" accept=".sql,.zip" onchange="restoreBackup(this)">
                        </div>

                        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Available Backups</h3>

                        <div class="table-responsive" style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--border-color);">
                                        <th style="text-align: left; padding: 12px;">Backup File</th>
                                        <th style="text-align: left; padding: 12px;">Date</th>
                                        <th style="text-align: left; padding: 12px;">Size</th>
                                        <th style="text-align: left; padding: 12px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="backups-list">
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 40px;">
                                            <div class="spinner"></div>
                                            <p style="margin-top: 16px;">Loading backups...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- API Settings -->
                    <div id="section-api" class="settings-section {{ $activeSection == 'api' ? 'active' : '' }}">
                        <h2 class="section-title">API Settings</h2>

                        <div class="info-card">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 16px;">
                                <div>
                                    <h4 style="font-weight: 600;">API Keys</h4>
                                    <p style="font-size: 13px; color: var(--text-secondary);">Manage your API access keys</p>
                                </div>
                                <button class="btn btn-primary" onclick="generateApiKey()">Generate New Key</button>
                            </div>

                            <div class="table-responsive" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid var(--border-color);">
                                            <th style="text-align: left; padding: 12px;">Name</th>
                                            <th style="text-align: left; padding: 12px;">API Key</th>
                                            <th style="text-align: left; padding: 12px;">Created</th>
                                            <th style="text-align: left; padding: 12px;">Last Used</th>
                                            <th style="text-align: left; padding: 12px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="api-keys-list">
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 40px;">
                                                <div class="spinner"></div>
                                                <p style="margin-top: 16px;">Loading API keys...</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="api">

                            <div class="form-group">
                                <label class="toggle-label">
                                    <span style="flex: 1;">
                                        <strong>Enable API Access</strong>
                                        <div class="form-hint">Allow third-party applications to access the API</div>
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="api_enabled" {{ config('api.enabled', true) ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Rate Limit (requests per minute)</label>
                                <input type="number" name="api_rate_limit" class="form-input" value="{{ config('api.rate_limit', 60) }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Allowed IPs</label>
                                <textarea name="api_allowed_ips" class="form-textarea" placeholder="192.168.1.1&#10;10.0.0.0/24">{{ implode("\n", config('api.allowed_ips', [])) }}</textarea>
                                <div class="form-hint">One IP or CIDR per line. Leave empty to allow all.</div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save API Settings</button>
                            </div>
                        </form>
                    </div>

                    <!-- Legal & Policies -->
                    <div id="section-legal" class="settings-section {{ $activeSection == 'legal' ? 'active' : '' }}">
                        <h2 class="section-title">Legal & Policies</h2>

                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="legal">

                            <div class="form-group">
                                <label class="form-label">Terms of Service</label>
                                <textarea name="terms_of_service" class="form-textarea" rows="8" placeholder="Enter your terms of service...">{{ config('legal.terms_of_service', 'By using Vendora Marketplace, you agree to these terms...') }}</textarea>
                                <div class="form-actions" style="justify-content: flex-start; padding-top: 8px;">
                                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('terms_pdf').click()">Upload PDF</button>
                                    <input type="file" id="terms_pdf" name="terms_pdf" style="display: none;" accept=".pdf">
                                    <span class="form-hint">or paste content above</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Privacy Policy</label>
                                <textarea name="privacy_policy" class="form-textarea" rows="8" placeholder="Enter your privacy policy...">{{ config('legal.privacy_policy', 'We value your privacy and are committed to protecting your personal data...') }}</textarea>
                                <div class="form-actions" style="justify-content: flex-start; padding-top: 8px;">
                                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('privacy_pdf').click()">Upload PDF</button>
                                    <input type="file" id="privacy_pdf" name="privacy_pdf" style="display: none;" accept=".pdf">
                                    <span class="form-hint">or paste content above</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Cookie Policy</label>
                                <textarea name="cookie_policy" class="form-textarea" rows="5" placeholder="Enter your cookie policy...">{{ config('legal.cookie_policy', 'This website uses cookies to improve your experience...') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">GDPR Compliance</label>
                                <select name="gdpr_enabled" class="form-select">
                                    <option value="1" {{ config('legal.gdpr_enabled', true) ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ !config('legal.gdpr_enabled', true) ? 'selected' : '' }}>Disabled</option>
                                </select>
                                <div class="form-hint">Enable GDPR compliance features for EU customers</div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Policies</button>
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
                    <button class="btn btn-danger" onclick="clearCache()">
                        <i class="ri-delete-bin-line"></i> Clear Cache
                    </button>
                    <button class="btn btn-danger" onclick="resetSettings()">
                        <i class="ri-reset-left-line"></i> Reset All Settings
                    </button>
                    <button class="btn btn-danger" onclick="deleteAccount()">
                        <i class="ri-user-unfollow-line"></i> Delete Account
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" style="position: fixed; top: 20px; right: 20px; background: white; border-radius: 8px; padding: 16px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); display: none; align-items: center; gap: 12px; z-index: 2000; border-left: 4px solid var(--success-color); min-width: 300px;">
        <div id="toastIcon" style="font-size: 24px;">
            <i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>
        </div>
        <div style="flex: 1;">
            <div id="toastTitle" style="font-weight: 600; margin-bottom: 4px;">Success</div>
            <div id="toastMessage" style="font-size: 13px; color: var(--text-secondary);">Action completed successfully!</div>
        </div>
        <button onclick="hideToast()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text-secondary);">
            <i class="ri-close-line"></i>
        </button>
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
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Load dynamic data
            loadBackupInfo();
            loadBackups();
            loadApiKeys();
            loadSessions();

            // Check URL hash for section
            const hash = window.location.hash.substring(1);
            if (hash) {
                showSection(hash);
            }
        });

        // Toast functions
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (type === 'success') {
                toastIcon.innerHTML = '<i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>';
                toast.style.borderLeftColor = 'var(--success-color)';
            } else if (type === 'error') {
                toastIcon.innerHTML = '<i class="ri-error-warning-line" style="color: var(--accent-red);"></i>';
                toast.style.borderLeftColor = 'var(--accent-red)';
            } else if (type === 'warning') {
                toastIcon.innerHTML = '<i class="ri-alert-line" style="color: var(--warning-color);"></i>';
                toast.style.borderLeftColor = 'var(--warning-color)';
            }

            toast.style.display = 'flex';
            setTimeout(hideToast, 3000);
        }

        function hideToast() {
            document.getElementById('toast').style.display = 'none';
        }

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

            // Update URL hash
            window.location.hash = sectionId;
        }

        // Avatar upload preview
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatar = document.querySelector('.avatar');
                    const initials = document.getElementById('avatarInitials');
                    const preview = document.getElementById('avatarPreview');
                    
                    if (!preview) {
                        // Create img element if it doesn't exist
                        const img = document.createElement('img');
                        img.id = 'avatarPreview';
                        img.src = e.target.result;
                        img.alt = 'Avatar';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        
                        // Clear avatar and append img
                        avatar.innerHTML = '';
                        avatar.appendChild(img);
                    } else {
                        preview.src = e.target.result;
                    }
                    
                    if (initials) {
                        initials.style.display = 'none';
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Load backup info
        function loadBackupInfo() {
            fetch('/admin/backup/info', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('last-backup').textContent = data.last_backup || 'Never';
                    document.getElementById('backup-size').textContent = data.size || '0 MB';
                    document.getElementById('next-backup').textContent = data.next_backup || 'Not scheduled';
                    document.getElementById('backup-location').textContent = data.location || 'Local';
                }
            })
            .catch(error => console.error('Error loading backup info:', error));
        }

        // Load backups list
        function loadBackups() {
            fetch('/admin/backups', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('backups-list');
                if (data.success && data.backups.length > 0) {
                    let html = '';
                    data.backups.forEach(backup => {
                        html += `
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 12px;">${backup.filename}</td>
                                <td style="padding: 12px;">${backup.date}</td>
                                <td style="padding: 12px;">${backup.size}</td>
                                <td style="padding: 12px;">
                                    <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;" onclick="downloadBackupFile('${backup.filename}')">Download</button>
                                    <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;" onclick="restoreBackupFile('${backup.filename}')">Restore</button>
                                </td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = html;
                } else {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                                <i class="ri-database-2-line" style="font-size: 48px; opacity: 0.5;"></i>
                                <p style="margin-top: 16px;">No backups found</p>
                            </td>
                        </tr>
                    `;
                }
            })
            .catch(error => console.error('Error loading backups:', error));
        }

        // Load API keys
        function loadApiKeys() {
            fetch('/admin/api/keys', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('api-keys-list');
                if (data.success && data.keys.length > 0) {
                    let html = '';
                    data.keys.forEach(key => {
                        html += `
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 12px;">${key.name}</td>
                                <td style="padding: 12px;">
                                    <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">${key.preview}</code>
                                </td>
                                <td style="padding: 12px;">${key.created_at}</td>
                                <td style="padding: 12px;">${key.last_used || 'Never'}</td>
                                <td style="padding: 12px;">
                                    <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;" onclick="revokeApiKey('${key.id}')">Revoke</button>
                                </td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = html;
                } else {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                                <i class="ri-key-line" style="font-size: 48px; opacity: 0.5;"></i>
                                <p style="margin-top: 16px;">No API keys found</p>
                            </td>
                        </tr>
                    `;
                }
            })
            .catch(error => console.error('Error loading API keys:', error));
        }

        // Load active sessions
        function loadSessions() {
            fetch('/admin/sessions', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                const sessionsList = document.getElementById('sessions-list');
                if (data.success && data.sessions.length > 0) {
                    let html = '';
                    data.sessions.forEach(session => {
                        const isCurrent = session.is_current ? '<span class="badge" style="background-color: var(--accent-green); color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px;">Current</span>' : '';
                        html += `
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; padding: 8px; border-radius: 8px; background: white;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 32px; height: 32px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="${session.icon}"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">${session.device}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">Last active: ${session.last_active}</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    ${isCurrent}
                                    ${!session.is_current ? `<button class="btn btn-secondary" style="padding: 4px 12px; font-size: 12px;" onclick="terminateSession('${session.id}')">Terminate</button>` : ''}
                                </div>
                            </div>
                        `;
                    });
                    sessionsList.innerHTML = html;
                } else {
                    sessionsList.innerHTML = '<p style="text-align: center; padding: 20px;">No active sessions found</p>';
                }
            })
            .catch(error => console.error('Error loading sessions:', error));
        }

        // Generate API key
        function generateApiKey() {
            if (!confirm('Generate a new API key? This will create a new key that can be used for API access.')) return;

            fetch('/admin/api/keys/generate', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'API key generated successfully');
                    loadApiKeys();
                } else {
                    showToast('Error', data.message || 'Failed to generate API key', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to generate API key', 'error');
            });
        }

        // Revoke API key
        function revokeApiKey(id) {
            if (!confirm('Revoke this API key? This will immediately disable access for any applications using this key.')) return;

            fetch(`/admin/api/keys/${id}/revoke`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'API key revoked successfully');
                    loadApiKeys();
                } else {
                    showToast('Error', data.message || 'Failed to revoke API key', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to revoke API key', 'error');
            });
        }

        // Terminate session
        function terminateSession(id) {
            if (!confirm('Terminate this session? The user will be logged out from this device.')) return;

            fetch(`/admin/sessions/${id}/terminate`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Session terminated successfully');
                    loadSessions();
                } else {
                    showToast('Error', data.message || 'Failed to terminate session', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to terminate session', 'error');
            });
        }

        // Logout all devices
        function logoutAllDevices() {
            if (!confirm('Logout from all devices? This will log you out everywhere except this current session.')) return;

            fetch('/admin/sessions/logout-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Logged out from all other devices');
                    loadSessions();
                } else {
                    showToast('Error', data.message || 'Failed to logout all devices', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to logout all devices', 'error');
            });
        }

        // Send test email
        function sendTestEmail() {
            fetch('/admin/settings/test-email', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Test email sent successfully');
                } else {
                    showToast('Error', data.message || 'Failed to send test email', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to send test email', 'error');
            });
        }

        // Create backup
        function createBackup() {
            if (!confirm('Create a new backup? This may take a few moments.')) return;

            fetch('/admin/backup/create', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Backup created successfully');
                    loadBackupInfo();
                    loadBackups();
                } else {
                    showToast('Error', data.message || 'Failed to create backup', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to create backup', 'error');
            });
        }

        // Download backup
        function downloadBackup() {
            window.location.href = '/admin/backup/download';
        }

        // Download specific backup file
        function downloadBackupFile(filename) {
            window.location.href = `/admin/backup/download/${filename}`;
        }

        // Restore backup
        function restoreBackup(input) {
            if (!input.files || !input.files[0]) return;

            const formData = new FormData();
            formData.append('backup', input.files[0]);

            if (!confirm('Restore from this backup? This will replace your current data and cannot be undone.')) return;

            fetch('/admin/backup/restore', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Backup restored successfully');
                    input.value = '';
                } else {
                    showToast('Error', data.message || 'Failed to restore backup', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to restore backup', 'error');
            });
        }

        // Restore backup file
        function restoreBackupFile(filename) {
            if (!confirm(`Restore from ${filename}? This will replace your current data and cannot be undone.`)) return;

            fetch(`/admin/backup/restore/${filename}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Backup restored successfully');
                } else {
                    showToast('Error', data.message || 'Failed to restore backup', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to restore backup', 'error');
            });
        }

        // Clear cache
        function clearCache() {
            if (!confirm('Clear all cache? This may temporarily slow down the site while caches rebuild.')) return;

            fetch('/admin/cache/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Cache cleared successfully');
                } else {
                    showToast('Error', data.message || 'Failed to clear cache', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to clear cache', 'error');
            });
        }

        // Reset settings
        function resetSettings() {
            if (!confirm('Reset all settings to default? This cannot be undone.')) return;

            fetch('/admin/settings/reset', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Settings reset successfully');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('Error', data.message || 'Failed to reset settings', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to reset settings', 'error');
            });
        }

        // Delete account
        function deleteAccount() {
            if (!confirm('Are you absolutely sure you want to delete your account? This cannot be undone.')) return;

            const password = prompt('Please enter your password to confirm:');
            if (!password) return;

            fetch('/admin/account/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ password: password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Account deleted successfully');
                    setTimeout(() => window.location.href = '/admin/login', 2000);
                } else {
                    showToast('Error', data.message || 'Failed to delete account', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to delete account', 'error');
            });
        }

        // Settings search
        document.getElementById('settingsSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            document.querySelectorAll('.settings-nav-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Confirm before leaving unsaved changes
        let formChanged = false;
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('change', () => {
                formChanged = true;
            });
            
            form.addEventListener('submit', () => {
                formChanged = false;
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
            }
        });
    </script>
</body>
</html>
