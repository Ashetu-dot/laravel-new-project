<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Vendor - Vendora Admin | Jimma, Ethiopia</title>
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
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
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

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--accent-yellow);
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--accent-blue);
        }

        /* Form Card */
        .form-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 32px;
            max-width: 900px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
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

        .form-label i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-gold);
        }

        .form-check-label {
            font-size: 14px;
            color: var(--text-primary);
            cursor: pointer;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            padding: 12px 16px;
            background-color: #f3f4f6;
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .input-group .form-input {
            border-radius: 0 8px 8px 0;
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-text {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
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

        .btn-primary:hover:not(:disabled) {
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

        .btn-danger {
            background-color: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid var(--border-color);
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

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.9);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(184, 142, 63, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        .loading-text {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 16px;
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
                <a href="{{ route('admin.vendors') }}" class="nav-item active">
                    <i class="ri-store-line"></i> Vendors
                </a>
                <a href="{{ route('admin.catalog.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i> Inventory
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
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
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-store-line" style="color: var(--primary-gold);"></i> Edit Vendor
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
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-store-line"></i>
                        Edit Vendor: {{ $vendor->business_name ?? $vendor->name }}
                    </h1>
                    <p>Update vendor information and account settings</p>
                </div>
                <div>
                    <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-secondary btn-sm">
                        <i class="ri-eye-line"></i> View Details
                    </a>
                    <a href="{{ route('admin.vendors') }}" class="btn btn-secondary btn-sm">
                        <i class="ri-arrow-left-line"></i> Back to Vendors
                    </a>
                </div>
            </div>

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

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    <ul style="margin-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST" id="vendorForm">
                    @csrf
                    @method('PUT')

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- Business Name -->
                        <div class="form-group">
                            <label for="business_name" class="form-label">
                                <i class="ri-store-line"></i> Business Name
                            </label>
                            <input type="text"
                                   id="business_name"
                                   name="business_name"
                                   class="form-input @error('business_name') error @enderror"
                                   value="{{ old('business_name', $vendor->business_name ?? $vendor->name) }}"
                                   required>
                            @error('business_name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Owner Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-user-line"></i> Owner Name
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-input @error('name') error @enderror"
                                   value="{{ old('name', $vendor->name) }}"
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="ri-mail-line"></i> Email Address
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-input @error('email') error @enderror"
                                   value="{{ old('email', $vendor->email) }}"
                                   required>
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <i class="ri-phone-line"></i> Phone Number
                            </label>
                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   class="form-input @error('phone') error @enderror"
                                   value="{{ old('phone', $vendor->phone ?? '') }}"
                                   placeholder="+251 XXX XXX XXX">
                            @error('phone')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Category
                            </label>
                            <select name="category" id="category" class="form-select @error('category') error @enderror">
                                <option value="">Select Category</option>
                                <option value="coffee" {{ old('category', $vendor->category) == 'coffee' ? 'selected' : '' }}>Coffee & Tea</option>
                                <option value="handicrafts" {{ old('category', $vendor->category) == 'handicrafts' ? 'selected' : '' }}>Traditional Handicrafts</option>
                                <option value="textiles" {{ old('category', $vendor->category) == 'textiles' ? 'selected' : '' }}>Textiles & Habesha Kemis</option>
                                <option value="food" {{ old('category', $vendor->category) == 'food' ? 'selected' : '' }}>Ethiopian Food & Spices</option>
                                <option value="jewelry" {{ old('category', $vendor->category) == 'jewelry' ? 'selected' : '' }}>Traditional Jewelry</option>
                                <option value="art" {{ old('category', $vendor->category) == 'art' ? 'selected' : '' }}>Art & Paintings</option>
                                <option value="electronics" {{ old('category', $vendor->category) == 'electronics' ? 'selected' : '' }}>Electronics & Repair</option>
                                <option value="services" {{ old('category', $vendor->category) == 'services' ? 'selected' : '' }}>Local Services</option>
                            </select>
                            @error('category')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div class="form-group">
                            <label for="website" class="form-label">
                                <i class="ri-global-line"></i> Website
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">https://</span>
                                <input type="text"
                                       id="website"
                                       name="website"
                                       class="form-input @error('website') error @enderror"
                                       value="{{ old('website', str_replace(['https://', 'http://'], '', $vendor->website ?? '')) }}"
                                       placeholder="example.com">
                            </div>
                            @error('website')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="ri-file-text-line"></i> Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-textarea @error('description') error @enderror"
                                  placeholder="Vendor description...">{{ old('description', $vendor->description ?? '') }}</textarea>
                        @error('description')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- City -->
                        <div class="form-group">
                            <label for="city" class="form-label">
                                <i class="ri-map-pin-line"></i> City
                            </label>
                            <select name="city" id="city" class="form-select @error('city') error @enderror">
                                <option value="">Select City</option>
                                <option value="Jimma" {{ old('city', $vendor->city) == 'Jimma' ? 'selected' : '' }}>Jimma</option>
                                <option value="Addis Ababa" {{ old('city', $vendor->city) == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                <option value="Bahir Dar" {{ old('city', $vendor->city) == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                                <option value="Hawassa" {{ old('city', $vendor->city) == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                                <option value="Dire Dawa" {{ old('city', $vendor->city) == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                                <option value="Gondar" {{ old('city', $vendor->city) == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                                <option value="Mekelle" {{ old('city', $vendor->city) == 'Mekelle' ? 'selected' : '' }}>Mekelle</option>
                                <option value="Adama" {{ old('city', $vendor->city) == 'Adama' ? 'selected' : '' }}>Adama</option>
                            </select>
                            @error('city')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Region/State -->
                        <div class="form-group">
                            <label for="state" class="form-label">
                                <i class="ri-map-pin-line"></i> Region/State
                            </label>
                            <select name="state" id="state" class="form-select @error('state') error @enderror">
                                <option value="">Select Region</option>
                                <option value="Oromia" {{ old('state', $vendor->state) == 'Oromia' ? 'selected' : '' }}>Oromia</option>
                                <option value="Addis Ababa" {{ old('state', $vendor->state) == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                <option value="Amhara" {{ old('state', $vendor->state) == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                <option value="Sidama" {{ old('state', $vendor->state) == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                                <option value="SNNPR" {{ old('state', $vendor->state) == 'SNNPR' ? 'selected' : '' }}>SNNPR</option>
                                <option value="Tigray" {{ old('state', $vendor->state) == 'Tigray' ? 'selected' : '' }}>Tigray</option>
                                <option value="Somali" {{ old('state', $vendor->state) == 'Somali' ? 'selected' : '' }}>Somali</option>
                                <option value="Afar" {{ old('state', $vendor->state) == 'Afar' ? 'selected' : '' }}>Afar</option>
                                <option value="Benishangul-Gumuz" {{ old('state', $vendor->state) == 'Benishangul-Gumuz' ? 'selected' : '' }}>Benishangul-Gumuz</option>
                                <option value="Gambela" {{ old('state', $vendor->state) == 'Gambela' ? 'selected' : '' }}>Gambela</option>
                                <option value="Harari" {{ old('state', $vendor->state) == 'Harari' ? 'selected' : '' }}>Harari</option>
                            </select>
                            @error('state')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="form-group">
                            <label for="country" class="form-label">
                                <i class="ri-earth-line"></i> Country
                            </label>
                            <input type="text"
                                   id="country"
                                   name="country"
                                   class="form-input @error('country') error @enderror"
                                   value="{{ old('country', $vendor->country ?? 'Ethiopia') }}">
                            @error('country')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- Tax ID -->
                        <div class="form-group">
                            <label for="tax_id" class="form-label">
                                <i class="ri-file-list-line"></i> Tax ID / Business License
                            </label>
                            <input type="text"
                                   id="tax_id"
                                   name="tax_id"
                                   class="form-input @error('tax_id') error @enderror"
                                   value="{{ old('tax_id', $vendor->tax_id ?? '') }}">
                            <small class="form-text">Optional: Tax registration number or business license ID</small>
                            @error('tax_id')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Founded Year -->
                        <div class="form-group">
                            <label for="founded_year" class="form-label">
                                <i class="ri-calendar-line"></i> Founded Year
                            </label>
                            <input type="number"
                                   id="founded_year"
                                   name="founded_year"
                                   class="form-input @error('founded_year') error @enderror"
                                   value="{{ old('founded_year', $vendor->founded_year ?? '') }}"
                                   min="1900"
                                   max="{{ date('Y') }}"
                                   placeholder="e.g., 2020">
                            @error('founded_year')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;">
                        <!-- Account Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-toggle-line"></i> Account Status
                            </label>
                            <div style="display: flex; gap: 24px;">
                                <label class="form-check">
                                    <input type="radio" name="is_active" class="form-check-input" value="1" {{ old('is_active', $vendor->is_active) ? 'checked' : '' }}>
                                    <span class="form-check-label">Active</span>
                                </label>
                                <label class="form-check">
                                    <input type="radio" name="is_active" class="form-check-input" value="0" {{ old('is_active', $vendor->is_active) ? '' : 'checked' }}>
                                    <span class="form-check-label">Inactive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Email Verification -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-mail-check-line"></i> Email Verification
                            </label>
                            <div style="display: flex; gap: 24px;">
                                <label class="form-check">
                                    <input type="radio" name="email_verified" class="form-check-input" value="1" {{ old('email_verified', $vendor->email_verified_at) ? 'checked' : '' }}>
                                    <span class="form-check-label">Verified</span>
                                </label>
                                <label class="form-check">
                                    <input type="radio" name="email_verified" class="form-check-input" value="0" {{ old('email_verified', $vendor->email_verified_at) ? '' : 'checked' }}>
                                    <span class="form-check-label">Unverified</span>
                                </label>
                            </div>
                            @if($vendor->email_verified_at)
                                <small class="form-text">Verified on {{ $vendor->email_verified_at->format('M d, Y') }}</small>
                            @endif
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-save-line"></i> Update Vendor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Updating vendor...</div>
    </div>

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

            // Website URL formatting
            const websiteInput = document.getElementById('website');
            if (websiteInput) {
                websiteInput.addEventListener('blur', function() {
                    let value = this.value.trim();
                    if (value && !value.startsWith('http')) {
                        // Just keep the clean value, the controller will handle the protocol
                    }
                });
            }
        });

        // Form validation
        function validateForm() {
            const businessName = document.getElementById('business_name').value.trim();
            if (!businessName) {
                alert('Please enter business name');
                return false;
            }

            const ownerName = document.getElementById('name').value.trim();
            if (!ownerName) {
                alert('Please enter owner name');
                return false;
            }

            const email = document.getElementById('email').value.trim();
            if (!email) {
                alert('Please enter email address');
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            const phone = document.getElementById('phone').value.trim();
            if (phone) {
                const phoneRegex = /^\+?[0-9\s\-\(\)]+$/;
                if (!phoneRegex.test(phone)) {
                    alert('Please enter a valid phone number');
                    return false;
                }
            }

            const foundedYear = document.getElementById('founded_year').value;
            if (foundedYear) {
                const year = parseInt(foundedYear);
                const currentYear = new Date().getFullYear();
                if (year < 1900 || year > currentYear) {
                    alert(`Founded year must be between 1900 and ${currentYear}`);
                    return false;
                }
            }

            return true;
        }

        // Form submission with loading state
        document.getElementById('vendorForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            if (!validateForm()) {
                e.preventDefault();
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Updating...';
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

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
