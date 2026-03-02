<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Coupon - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
        }

        .avatar img {
            width: 40px;
            height: 40px;
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

        .logout-form {
            margin-top: 8px;
        }

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
            color: var(--danger-color);
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
            background-color: var(--danger-color);
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

        /* Page Header */
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

        /* Form Container */
        .form-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow-sm);
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

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-label i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--danger-color);
        }

        .form-control[type="date"], 
        .form-control[type="datetime-local"] {
            color-scheme: light;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .input-group .form-control {
            flex: 1;
        }

        .input-group-text {
            padding: 12px 16px;
            background-color: #f3f4f6;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            white-space: nowrap;
        }

        .input-group-append {
            display: flex;
        }

        .btn-outline-secondary {
            padding: 12px 16px;
            background-color: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-outline-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .error-message {
            color: var(--danger-color);
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Radio & Checkbox */
        .radio-group {
            display: flex;
            gap: 24px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .checkbox-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Alert Messages */
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
            border-left: 4px solid var(--success-color);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--warning-color);
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
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

        .btn-danger {
            background-color: var(--danger-color);
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
            border-top: 1px solid var(--border-color);
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
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        /* Help Text */
        .help-text {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
        }

        /* Vendor Select */
        .vendor-select {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px;
        }

        .vendor-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            border-bottom: 1px solid #f3f4f6;
        }

        .vendor-option:last-child {
            border-bottom: none;
        }

        .vendor-option input[type="radio"] {
            width: 16px;
            height: 16px;
        }

        /* Usage Stats */
        .usage-stats {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 8px;
            border: 1px solid var(--border-color);
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px dashed var(--border-color);
        }

        .stat-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .stat-value {
            font-weight: 600;
            color: var(--primary-gold);
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
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i> Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item active">
                    <i class="ri-coupon-line"></i> Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SYSTEM</div>
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
                <p>Administrator</p>
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
                    <i class="ri-coupon-line" style="color: var(--primary-gold);"></i> Edit Coupon
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
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-coupon-line"></i>
                        Edit Coupon: {{ $coupon->code }}
                    </h1>
                    <p>Update coupon details and settings</p>
                </div>
                <a href="{{ route('admin.coupons') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Coupons
                </a>
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

            <!-- Edit Coupon Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}" id="couponForm">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <!-- Coupon Code -->
                        <div class="form-group">
                            <label for="code" class="form-label">
                                <i class="ri-coupon-line"></i> Coupon Code
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       id="code" 
                                       name="code" 
                                       class="form-control @error('code') error @enderror" 
                                       placeholder="e.g., SUMMER2024"
                                       value="{{ old('code', $coupon->code) }}"
                                       required>
                                <button type="button" class="btn-outline-secondary" onclick="generateCode()">
                                    <i class="ri-refresh-line"></i> Generate
                                </button>
                            </div>
                            <small class="help-text">Unique code customers will enter at checkout</small>
                            @error('code')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Type -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Discount Type
                            </label>
                            <select id="type" name="type" class="form-control @error('type') error @enderror" required onchange="toggleType()">
                                <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                                <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount Discount</option>
                            </select>
                            @error('type')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Value -->
                        <div class="form-group">
                            <label for="value" class="form-label" id="valueLabel">
                                <i class="ri-percent-line"></i> Discount Value (%)
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       id="value" 
                                       name="value" 
                                       class="form-control @error('value') error @enderror" 
                                       placeholder="20"
                                       min="0.01"
                                       step="0.01"
                                       value="{{ old('value', $coupon->value) }}"
                                       required>
                                <span class="input-group-text" id="valueSuffix">{{ $coupon->type == 'percentage' ? '%' : 'ETB' }}</span>
                            </div>
                            @error('value')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Maximum Discount (for percentage) -->
                        <div class="form-group" id="maxDiscountField" style="{{ old('type', $coupon->type) == 'percentage' ? 'display: block;' : 'display: none;' }}">
                            <label for="max_discount_amount" class="form-label">
                                <i class="ri-coupon-line"></i> Maximum Discount (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number" 
                                       id="max_discount_amount" 
                                       name="max_discount_amount" 
                                       class="form-control" 
                                       placeholder="1000"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}">
                            </div>
                            <small class="help-text">Maximum discount amount (leave empty for no limit)</small>
                            @error('max_discount_amount')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Minimum Purchase -->
                        <div class="form-group">
                            <label for="min_order_amount" class="form-label">
                                <i class="ri-shopping-cart-line"></i> Minimum Purchase (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number" 
                                       id="min_order_amount" 
                                       name="min_order_amount" 
                                       class="form-control" 
                                       placeholder="0 for no minimum"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('min_order_amount', $coupon->min_order_amount ?? 0) }}">
                            </div>
                            <small class="help-text">Minimum order amount required to use this coupon</small>
                            @error('min_order_amount')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Expiry Date -->
                        <div class="form-group">
                            <label for="expires_at" class="form-label">
                                <i class="ri-calendar-line"></i> Expiry Date
                            </label>
                            <input type="datetime-local" 
                                   id="expires_at" 
                                   name="expires_at" 
                                   class="form-control @error('expires_at') error @enderror" 
                                   value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : now()->addDays(30)->format('Y-m-d\TH:i')) }}"
                                   required>
                            <small class="help-text">When this coupon expires</small>
                            @error('expires_at')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Usage Stats (Read Only) -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-bar-chart-line"></i> Usage Statistics
                            </label>
                            <div class="usage-stats">
                                <div class="stat-row">
                                    <span class="stat-label">Times Used</span>
                                    <span class="stat-value">{{ $coupon->used_count ?? 0 }}</span>
                                </div>
                                <div class="stat-row">
                                    <span class="stat-label">Maximum Total Uses</span>
                                    <span class="stat-value">{{ $coupon->max_uses ?? 'Unlimited' }}</span>
                                </div>
                                <div class="stat-row">
                                    <span class="stat-label">Uses Per Customer</span>
                                    <span class="stat-value">{{ $coupon->per_user_limit ?? 1 }}</span>
                                </div>
                                <div class="stat-row">
                                    <span class="stat-label">Created</span>
                                    <span class="stat-value">{{ $coupon->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Max Uses -->
                        <div class="form-group">
                            <label for="max_uses" class="form-label">
                                <i class="ri-group-line"></i> Maximum Total Uses
                            </label>
                            <input type="number" 
                                   id="max_uses" 
                                   name="max_uses" 
                                   class="form-control" 
                                   placeholder="0 for unlimited"
                                   min="0"
                                   value="{{ old('max_uses', $coupon->max_uses) }}">
                            <small class="help-text">Total number of times this coupon can be used</small>
                            @error('max_uses')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Per User Limit -->
                        <div class="form-group">
                            <label for="per_user_limit" class="form-label">
                                <i class="ri-user-line"></i> Uses Per Customer
                            </label>
                            <input type="number" 
                                   id="per_user_limit" 
                                   name="per_user_limit" 
                                   class="form-control" 
                                   placeholder="1"
                                   min="0"
                                   value="{{ old('per_user_limit', $coupon->per_user_limit ?? 1) }}">
                            <small class="help-text">How many times each customer can use this coupon</small>
                            @error('per_user_limit')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-toggle-line"></i> Status
                            </label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', $coupon->is_active) == '1' ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active', $coupon->is_active) == '0' ? 'checked' : '' }}>
                                    <span>Inactive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Vendor Assignment -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-store-line"></i> Assign to Vendor (Optional)
                            </label>
                            <div class="radio-group" style="margin-bottom: 16px;">
                                <label class="radio-option">
                                    <input type="radio" name="vendor_scope" value="all" {{ !$coupon->vendor_id ? 'checked' : '' }} onchange="toggleVendorSelection()">
                                    <span>All Vendors</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="vendor_scope" value="specific" {{ $coupon->vendor_id ? 'checked' : '' }} onchange="toggleVendorSelection()">
                                    <span>Specific Vendor</span>
                                </label>
                            </div>

                            <div id="vendorSelection" style="display: {{ $coupon->vendor_id ? 'block' : 'none' }};">
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                    <option value="">Select a vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ old('vendor_id', $coupon->vendor_id) == $vendor->id ? 'selected' : '' }}>
                                            {{ $vendor->business_name ?? $vendor->name }} ({{ $vendor->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="help-text">If specific vendor is selected, coupon will only work for that vendor's products</small>
                            </div>
                        </div>

                        <!-- User Assignment -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-user-line"></i> Assign to Specific User (Optional)
                            </label>
                            <input type="text" 
                                   id="user_search" 
                                   class="form-control" 
                                   placeholder="Search for a user by email or name..."
                                   autocomplete="off"
                                   value="{{ $coupon->user ? $coupon->user->name . ' (' . $coupon->user->email . ')' : '' }}">
                            <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id', $coupon->user_id) }}">
                            <div id="user_search_results" style="display: none; margin-top: 8px; border: 1px solid var(--border-color); border-radius: 8px; max-height: 200px; overflow-y: auto;"></div>
                            <div id="selected_user" style="margin-top: 8px; {{ $coupon->user_id ? 'display: block;' : 'display: none;' }}">
                                <div style="display: flex; align-items: center; gap: 8px; padding: 8px; background-color: #f9fafb; border-radius: 8px;">
                                    <span id="selected_user_name">{{ $coupon->user ? $coupon->user->name . ' (' . $coupon->user->email . ')' : '' }}</span>
                                    <button type="button" class="btn-outline-secondary btn-sm" onclick="clearUser()">Remove</button>
                                </div>
                            </div>
                            <small class="help-text">If a specific user is selected, only that user can use this coupon</small>
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label for="description" class="form-label">
                                <i class="ri-file-text-line"></i> Description
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      class="form-control @error('description') error @enderror" 
                                      placeholder="Describe what this coupon is for...">{{ old('description', $coupon->description) }}</textarea>
                            <small class="help-text">Internal description (not visible to customers)</small>
                            @error('description')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('admin.coupons') }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-save-line"></i> Update Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
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

                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('active');
                        }
                    }
                });
            }

            // Initialize type toggle
            toggleType();
        });

        // Toggle type fields
        function toggleType() {
            const type = document.getElementById('type').value;
            const valueLabel = document.getElementById('valueLabel');
            const valueSuffix = document.getElementById('valueSuffix');
            const maxDiscountField = document.getElementById('maxDiscountField');
            
            if (type === 'percentage') {
                valueLabel.innerHTML = '<i class="ri-percent-line"></i> Discount Value (%)';
                valueSuffix.textContent = '%';
                maxDiscountField.style.display = 'block';
            } else {
                valueLabel.innerHTML = '<i class="ri-money-cny-circle-line"></i> Discount Amount (ETB)';
                valueSuffix.textContent = 'ETB';
                maxDiscountField.style.display = 'none';
            }
        }

        // Toggle vendor selection
        function toggleVendorSelection() {
            const scope = document.querySelector('input[name="vendor_scope"]:checked').value;
            const vendorSelection = document.getElementById('vendorSelection');
            
            vendorSelection.style.display = scope === 'specific' ? 'block' : 'none';
        }

        // Generate random coupon code
        function generateCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < 8; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            
            // Add prefix based on type
            const type = document.getElementById('type').value;
            if (type === 'percentage') {
                code = 'PCT' + code;
            } else {
                code = 'FIX' + code;
            }
            
            document.getElementById('code').value = code;
        }

        // User search functionality
        let searchTimeout;
        document.getElementById('user_search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value;
            
            if (query.length < 2) {
                document.getElementById('user_search_results').style.display = 'none';
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetch(`/admin/users/search?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(users => {
                    const resultsDiv = document.getElementById('user_search_results');
                    if (users.length > 0) {
                        let html = '';
                        users.forEach(user => {
                            html += `
                                <div class="user-result" style="padding: 10px; cursor: pointer; border-bottom: 1px solid var(--border-color);" onclick="selectUser(${user.id}, '${user.name} (${user.email})')">
                                    <strong>${user.name}</strong><br>
                                    <small>${user.email}</small>
                                </div>
                            `;
                        });
                        resultsDiv.innerHTML = html;
                        resultsDiv.style.display = 'block';
                    } else {
                        resultsDiv.innerHTML = '<div style="padding: 10px; color: var(--text-secondary);">No users found</div>';
                        resultsDiv.style.display = 'block';
                    }
                });
            }, 300);
        });

        // Select user from search
        function selectUser(userId, userName) {
            document.getElementById('user_id').value = userId;
            document.getElementById('selected_user_name').textContent = userName;
            document.getElementById('selected_user').style.display = 'block';
            document.getElementById('user_search').value = userName;
            document.getElementById('user_search_results').style.display = 'none';
        }

        // Clear selected user
        function clearUser() {
            document.getElementById('user_id').value = '';
            document.getElementById('selected_user').style.display = 'none';
            document.getElementById('user_search').value = '';
        }

        // Form submission
        document.getElementById('couponForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            
            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }
            
            // Validate value
            const value = document.getElementById('value').value;
            if (!value || value <= 0) {
                e.preventDefault();
                alert('Please enter a valid discount value');
                return;
            }
            
            // Validate expiry
            const expiresAt = new Date(document.getElementById('expires_at').value);
            if (expiresAt <= new Date()) {
                e.preventDefault();
                alert('Expiry date must be in the future');
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Updating...';
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

    <style>
        .user-result:hover {
            background-color: #f9fafb;
        }
        .btn-outline-secondary.btn-sm {
            padding: 4px 8px;
            font-size: 12px;
        }
    </style>

</body>
</html>