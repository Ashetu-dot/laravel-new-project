<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Admin Profile</title>
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

        /* Profile Card */
        .profile-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .profile-header {
            padding: 32px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 32px;
            flex-wrap: wrap;
        }

        .profile-avatar {
            position: relative;
        }

        .avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            color: white;
            border: 4px solid var(--primary-gold);
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-gold);
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
        }

        .avatar-upload-btn:hover {
            background-color: #9c7832;
            transform: scale(1.05);
        }

        .profile-info h2 {
            font-size: 28px;
            margin-bottom: 4px;
        }

        .profile-info p {
            color: var(--text-secondary);
            font-size: 16px;
        }

        .profile-badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 8px;
        }

        .profile-body {
            padding: 32px;
        }

        .profile-section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-item {
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            margin-top: 24px;
        }

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

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Tabs */
        .profile-tabs {
            display: flex;
            gap: 4px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .tab-btn {
            padding: 12px 24px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            color: var(--text-secondary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn:hover {
            color: var(--primary-gold);
        }

        .tab-btn.active {
            color: var(--primary-gold);
            border-bottom-color: var(--primary-gold);
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
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
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ADMIN</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Admins
                </a>
                <a href="{{ route('admin.roles') }}" class="nav-item">
                    <i class="ri-shield-keyhole-line"></i>
                    Roles
                </a>
                <a href="{{ route('admin.profile') }}" class="nav-item active">
                    <i class="ri-user-settings-line"></i>
                    Profile
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
                    <input type="text" placeholder="Search...">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
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
                    <h1 class="page-title">My Profile</h1>
                    <p class="page-subtitle">Manage your personal information and settings</p>
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

            <!-- Profile Tabs -->
            <div class="profile-tabs">
                <button class="tab-btn active" onclick="showTab('view')">Profile View</button>
                <button class="tab-btn" onclick="showTab('edit')">Edit Profile</button>
                <button class="tab-btn" onclick="showTab('security')">Security</button>
            </div>

            <!-- Profile View Tab -->
            <div id="tab-view" class="tab-pane active">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <div class="avatar-large">
                                {{ substr($admin->name ?? 'AD', 0, 2) }}
                            </div>
                            <div class="avatar-upload-btn" onclick="document.getElementById('file-upload').click();">
                                <i class="ri-camera-line"></i>
                            </div>
                            <input type="file" id="file-upload" style="display: none;" accept="image/*">
                        </div>
                        <div class="profile-info">
                            <h2>{{ $admin->name ?? 'Admin User' }}</h2>
                            <p>{{ $admin->email ?? 'No email' }}</p>
                            <span class="profile-badge">{{ ucfirst($admin->role ?? 'admin') }}</span>
                        </div>
                    </div>

                    <div class="profile-body">
                        <div class="profile-section">
                            <h3 class="section-title">
                                <i class="ri-information-line" style="color: var(--primary-gold);"></i>
                                Personal Information
                            </h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Full Name</div>
                                    <div class="info-value">{{ $admin->name ?? 'Not set' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">{{ $admin->email ?? 'Not set' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Phone Number</div>
                                    <div class="info-value">{{ $admin->phone ?? 'Not provided' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Department</div>
                                    <div class="info-value">{{ $admin->department ?? 'Administration' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-section">
                            <h3 class="section-title">
                                <i class="ri-calendar-line" style="color: var(--primary-gold);"></i>
                                Account Information
                            </h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Member Since</div>
                                    <div class="info-value">
                                        @if($admin->created_at)
                                            {{ $admin->created_at->format('F d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Last Login</div>
                                    <div class="info-value">
                                        @if($admin->last_login_at)
                                            {{ $admin->last_login_at->diffForHumans() }}
                                        @else
                                            First login
                                        @endif
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Account Status</div>
                                    <div class="info-value">
                                        <span style="color: var(--accent-green); font-weight: 600;">Active</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Email Verified</div>
                                    <div class="info-value">
                                        @if($admin->email_verified_at)
                                            <span style="color: var(--accent-green);">Yes</span>
                                        @else
                                            <span style="color: var(--accent-yellow);">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Tab -->
            <div id="tab-edit" class="tab-pane">
                <div class="profile-card">
                    <div class="profile-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="profile-section">
                                <h3 class="section-title">Edit Personal Information</h3>

                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-input" value="{{ $admin->name ?? '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-input" value="{{ $admin->email ?? '' }}" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" name="phone" class="form-input" value="{{ $admin->phone ?? '' }}" placeholder="+1 (555) 123-4567">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Department</label>
                                        <input type="text" name="department" class="form-input" value="Administration" placeholder="Department">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Bio / About</label>
                                    <textarea name="bio" class="form-textarea" placeholder="Tell us a little about yourself">{{ $admin->description ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Security Tab -->
            <div id="tab-security" class="tab-pane">
                <div class="profile-card">
                    <div class="profile-body">
                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf

                            <div class="profile-section">
                                <h3 class="section-title">Change Password</h3>

                                <div class="info-card" style="background-color: #f9fafb; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <i class="ri-shield-check-line" style="color: var(--accent-green); font-size: 24px;"></i>
                                        <div>
                                            <strong>Password Requirements</strong>
                                            <p style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">
                                                At least 8 characters with uppercase, number, and special character
                                            </p>
                                        </div>
                                    </div>
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
                                    <label class="toggle-label" style="display: flex; align-items: center; gap: 12px;">
                                        <input type="checkbox" name="two_factor" style="width: auto;">
                                        <span>
                                            <strong>Enable Two-Factor Authentication</strong>
                                            <span style="display: block; font-size: 12px; color: var(--text-secondary);">Add an extra layer of security to your account</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>

                        <!-- Session Management -->
                        <div style="margin-top: 32px;">
                            <h3 class="section-title">Active Sessions</h3>

                            <div style="background-color: #f9fafb; border-radius: 8px; padding: 20px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-window-line"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">Windows • Chrome</div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">IP: 127.0.0.1</div>
                                        </div>
                                    </div>
                                    <span style="background-color: var(--accent-green); color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px;">Current</span>
                                </div>
                            </div>

                            <button class="btn btn-secondary" style="margin-top: 16px;" onclick="alert('This would log out all other sessions')">
                                <i class="ri-logout-box-line"></i> Logout All Other Devices
                            </button>
                        </div>
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
        });

        // Tab switching
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById('tab-' + tabName).classList.add('active');

            // Add active class to clicked button
            event.currentTarget.classList.add('active');
        }

        // Avatar upload preview
        document.getElementById('file-upload')?.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can update avatar preview here
                    console.log('Avatar selected:', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

       
    </script>

</body>
</html>
