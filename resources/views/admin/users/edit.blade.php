<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit User - Admin Dashboard | Vendora Marketplace</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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

        /* Form Card */
        .form-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 32px;
        }

        .form-section {
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary-gold);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-label i {
            margin-right: 4px;
            color: var(--primary-gold);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--card-bg);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--accent-red);
        }

        .form-control:disabled {
            background: var(--primary-bg);
            cursor: not-allowed;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            cursor: pointer;
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .help-text {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 6px;
        }

        /* Toggle Switch */
        .toggle-group {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .toggle-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .toggle-switch {
            position: relative;
            width: 48px;
            height: 24px;
            background: var(--border-color);
            border-radius: 12px;
            transition: all 0.3s;
        }

        .toggle-switch:before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: all 0.3s;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]:checked + .toggle-switch {
            background: var(--primary-gold);
        }

        input[type="checkbox"]:checked + .toggle-switch:before {
            left: 26px;
        }

        /* Avatar Upload */
        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .current-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 600;
        }

        .avatar-actions {
            flex: 1;
        }

        .file-input {
            position: relative;
            display: inline-block;
        }

        .file-input input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        /* Business Hours */
        .business-hours {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        @media (max-width: 640px) {
            .business-hours {
                grid-template-columns: 1fr;
            }
        }

        .hour-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hour-item .day {
            width: 100px;
            font-weight: 500;
        }

        .hour-item .time {
            flex: 1;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 24px;
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
            transform: translateY(-2px);
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
    <!-- Sidebar -->
    @include('partials.admin-sidebar')

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
                    <h1 class="page-title">Edit User</h1>
                    <div class="breadcrumb">Update user information</div>
                </div>
                <div>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="back-btn">
                        <i class="ri-arrow-left-line"></i>
                        Back to User
                    </a>
                </div>
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

            <!-- Edit Form -->
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" class="form-card">
                @csrf
                @method('PUT')

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="ri-user-line"></i>
                        Basic Information
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-user-line"></i>
                                Full Name
                            </label>
                            <input type="text" name="name" class="form-control @error('name') error @enderror" 
                                   value="{{ old('name', $user->name) }}" placeholder="Enter full name">
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-mail-line"></i>
                                Email Address
                            </label>
                            <input type="email" name="email" class="form-control @error('email') error @enderror" 
                                   value="{{ old('email', $user->email) }}" placeholder="Enter email address">
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-phone-line"></i>
                                Phone Number
                            </label>
                            <input type="text" name="phone" class="form-control @error('phone') error @enderror" 
                                   value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                            @error('phone')
                                <div class="error-message">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-shield-user-line"></i>
                                Role
                            </label>
                            <select name="role" class="form-control @error('role') error @enderror">
                                <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="vendor" {{ old('role', $user->role) == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="error-message">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Business Information Section (for vendors) -->
                <div class="form-section" id="businessSection" style="{{ $user->role == 'vendor' ? '' : 'display: none;' }}">
                    <h3 class="section-title">
                        <i class="ri-store-line"></i>
                        Business Information
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-store-2-line"></i>
                                Business Name
                            </label>
                            <input type="text" name="business_name" class="form-control" 
                                   value="{{ old('business_name', $user->business_name) }}" placeholder="Enter business name">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-price-tag-3-line"></i>
                                Category
                            </label>
                            <input type="text" name="category" class="form-control" 
                                   value="{{ old('category', $user->category) }}" placeholder="Enter business category">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-file-list-line"></i>
                                Tax ID
                            </label>
                            <input type="text" name="tax_id" class="form-control" 
                                   value="{{ old('tax_id', $user->tax_id) }}" placeholder="Enter tax ID">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-global-line"></i>
                                Website
                            </label>
                            <input type="url" name="website" class="form-control" 
                                   value="{{ old('website', $user->website) }}" placeholder="https://example.com">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">
                                <i class="ri-file-text-line"></i>
                                Description
                            </label>
                            <textarea name="description" class="form-control" placeholder="Enter business description">{{ old('description', $user->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="ri-map-pin-line"></i>
                        Address Information
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">
                                <i class="ri-road-map-line"></i>
                                Address Line 1
                            </label>
                            <input type="text" name="address_line1" class="form-control" 
                                   value="{{ old('address_line1', $user->address_line1) }}" placeholder="Street address, P.O. box">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">
                                <i class="ri-road-map-line"></i>
                                Address Line 2
                            </label>
                            <input type="text" name="address_line2" class="form-control" 
                                   value="{{ old('address_line2', $user->address_line2) }}" placeholder="Apartment, suite, unit, building">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-building-line"></i>
                                City
                            </label>
                            <input type="text" name="city" class="form-control" 
                                   value="{{ old('city', $user->city) }}" placeholder="Enter city">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-government-line"></i>
                                State
                            </label>
                            <input type="text" name="state" class="form-control" 
                                   value="{{ old('state', $user->state) }}" placeholder="Enter state">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-mail-line"></i>
                                Zip Code
                            </label>
                            <input type="text" name="zip_code" class="form-control" 
                                   value="{{ old('zip_code', $user->zip_code) }}" placeholder="Enter zip code">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-flag-line"></i>
                                Country
                            </label>
                            <input type="text" name="country" class="form-control" 
                                   value="{{ old('country', $user->country ?? 'Ethiopia') }}" placeholder="Enter country">
                        </div>
                    </div>
                </div>

                <!-- Social Media Links (for vendors) -->
                <div class="form-section" id="socialSection" style="{{ $user->role == 'vendor' ? '' : 'display: none;' }}">
                    <h3 class="section-title">
                        <i class="ri-share-line"></i>
                        Social Media Links
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-facebook-line"></i>
                                Facebook
                            </label>
                            <input type="url" name="facebook_url" class="form-control" 
                                   value="{{ old('facebook_url', $user->facebook_url) }}" placeholder="https://facebook.com/...">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-instagram-line"></i>
                                Instagram
                            </label>
                            <input type="url" name="instagram_url" class="form-control" 
                                   value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="https://instagram.com/...">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-telegram-line"></i>
                                Telegram
                            </label>
                            <input type="url" name="telegram_url" class="form-control" 
                                   value="{{ old('telegram_url', $user->telegram_url) }}" placeholder="https://t.me/...">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-twitter-line"></i>
                                Twitter
                            </label>
                            <input type="url" name="twitter_url" class="form-control" 
                                   value="{{ old('twitter_url', $user->twitter_url) }}" placeholder="https://twitter.com/...">
                        </div>
                    </div>
                </div>

                <!-- Status & Settings -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="ri-settings-4-line"></i>
                        Status & Settings
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Account Status</label>
                            <div class="toggle-group">
                                <label class="toggle-label">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                    <span class="toggle-switch"></span>
                                    <span>{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                                </label>
                            </div>
                            <div class="help-text">Toggle to activate or deactivate this account</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Theme Preference</label>
                            <select name="theme_preference" class="form-control">
                                <option value="light" {{ old('theme_preference', $user->theme_preference) == 'light' ? 'selected' : '' }}>Light</option>
                                <option value="dark" {{ old('theme_preference', $user->theme_preference) == 'dark' ? 'selected' : '' }}>Dark</option>
                                <option value="system" {{ old('theme_preference', $user->theme_preference) == 'system' ? 'selected' : '' }}>System Default</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">
                        <i class="ri-close-line"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line"></i>
                        Save Changes
                    </button>
                </div>
            </form>
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

            // Role change handler
            const roleSelect = document.querySelector('select[name="role"]');
            const businessSection = document.getElementById('businessSection');
            const socialSection = document.getElementById('socialSection');

            if (roleSelect) {
                roleSelect.addEventListener('change', function() {
                    if (this.value === 'vendor') {
                        businessSection.style.display = 'block';
                        socialSection.style.display = 'block';
                    } else {
                        businessSection.style.display = 'none';
                        socialSection.style.display = 'none';
                    }
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
        });

        // Theme Toggle
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