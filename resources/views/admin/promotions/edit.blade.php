<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Promotion - Vendora Admin | Jimma, Ethiopia</title>
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
        }

        .input-group-text {
            padding: 12px 16px;
            background-color: #f3f4f6;
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
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
            margin-bottom: 12px;
        }

        .checkbox-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Products Selection */
        .products-section {
            margin-top: 24px;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .products-section h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .products-search {
            margin-bottom: 16px;
        }

        .products-list {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: white;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-weight: 600;
            font-size: 14px;
        }

        .product-meta {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .product-price {
            font-weight: 600;
            color: var(--primary-gold);
        }

        /* Current Banner */
        .current-banner {
            margin-top: 12px;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .current-banner h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .banner-preview {
            max-width: 300px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 12px;
        }

        .banner-preview img {
            width: 100%;
            height: auto;
            object-fit: cover;
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
            border-left: 4px solid var(--accent-blue, #3b82f6);
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
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item active">
                    <i class="ri-megaphone-line"></i> Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item">
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
                    <i class="ri-megaphone-line" style="color: var(--primary-gold);"></i> Edit Promotion
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
                        <i class="ri-megaphone-line"></i>
                        Edit Promotion: {{ $promotion->name }}
                    </h1>
                    <p>Update promotion details and settings</p>
                </div>
                {{--  <a href="{{ route('admin.promotions') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Promotions
                </a>  --}}
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

            <!-- Edit Promotion Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.promotions.update', $promotion->id) }}" id="promotionForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <!-- Promotion Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-megaphone-line"></i> Promotion Name
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') error @enderror"
                                   placeholder="e.g., Summer Sale 2024"
                                   value="{{ old('name', $promotion->name) }}"
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Promotion Code -->
                        <div class="form-group">
                            <label for="code" class="form-label">
                                <i class="ri-coupon-line"></i> Promotion Code
                            </label>
                            <div class="input-group">
                                <input type="text"
                                       id="code"
                                       name="code"
                                       class="form-control @error('code') error @enderror"
                                       placeholder="SUMMER2024"
                                       value="{{ old('code', $promotion->code) }}"
                                       required>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="generateCode()" style="margin-left: 8px;">
                                    <i class="ri-refresh-line"></i> Generate
                                </button>
                            </div>
                            @error('code')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Promotion Type -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Promotion Type
                            </label>
                            <select id="type" name="type" class="form-control @error('type') error @enderror" required onchange="togglePromotionType()">
                                <option value="percentage" {{ old('type', $promotion->type) == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                                <option value="fixed" {{ old('type', $promotion->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount Discount</option>
                                <option value="bogo" {{ old('type', $promotion->type) == 'bogo' ? 'selected' : '' }}>Buy One Get One (BOGO)</option>
                                <option value="free_shipping" {{ old('type', $promotion->type) == 'free_shipping' ? 'selected' : '' }}>Free Shipping</option>
                            </select>
                            @error('type')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Value (Percentage) -->
                        <div class="form-group" id="percentageField" style="{{ old('type', $promotion->type) == 'percentage' ? 'display: block;' : 'display: none;' }}">
                            <label for="discount_percentage" class="form-label">
                                <i class="ri-percent-line"></i> Discount Percentage
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input type="number"
                                       id="discount_percentage"
                                       name="discount_percentage"
                                       class="form-control"
                                       placeholder="20"
                                       min="1"
                                       max="100"
                                       step="1"
                                       value="{{ old('discount_percentage', $promotion->type == 'percentage' ? $promotion->value : '') }}">
                            </div>
                            @error('discount_percentage')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Value (Fixed) -->
                        <div class="form-group" id="fixedField" style="{{ old('type', $promotion->type) == 'fixed' ? 'display: block;' : 'display: none;' }}">
                            <label for="discount_amount" class="form-label">
                                <i class="ri-money-cny-circle-line"></i> Discount Amount (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number"
                                       id="discount_amount"
                                       name="discount_amount"
                                       class="form-control"
                                       placeholder="500"
                                       min="1"
                                       step="1"
                                       value="{{ old('discount_amount', $promotion->type == 'fixed' ? $promotion->value : '') }}">
                            </div>
                            @error('discount_amount')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Date Range -->
                        <div class="form-group">
                            <label for="start_date" class="form-label">
                                <i class="ri-calendar-line"></i> Start Date
                            </label>
                            <input type="datetime-local"
                                   id="start_date"
                                   name="start_date"
                                   class="form-control @error('start_date') error @enderror"
                                   value="{{ old('start_date', \Carbon\Carbon::parse($promotion->start_date)->format('Y-m-d\TH:i')) }}"
                                   required>
                            @error('start_date')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-label">
                                <i class="ri-calendar-line"></i> End Date
                            </label>
                            <input type="datetime-local"
                                   id="end_date"
                                   name="end_date"
                                   class="form-control @error('end_date') error @enderror"
                                   value="{{ old('end_date', \Carbon\Carbon::parse($promotion->end_date)->format('Y-m-d\TH:i')) }}"
                                   required>
                            @error('end_date')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Minimum Purchase -->
                        <div class="form-group">
                            <label for="min_purchase" class="form-label">
                                <i class="ri-shopping-cart-line"></i> Minimum Purchase (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number"
                                       id="min_purchase"
                                       name="min_purchase"
                                       class="form-control"
                                       placeholder="0 for no minimum"
                                       min="0"
                                       step="1"
                                       value="{{ old('min_purchase', $promotion->min_purchase) }}">
                            </div>
                            <small class="form-text text-muted">Leave as 0 for no minimum purchase requirement</small>
                            @error('min_purchase')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Max Discount Amount (for percentage) -->
                        <div class="form-group" id="maxDiscountField" style="{{ old('type', $promotion->type) == 'percentage' ? 'display: block;' : 'display: none;' }}">
                            <label for="max_discount" class="form-label">
                                <i class="ri-coupon-line"></i> Maximum Discount (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number"
                                       id="max_discount"
                                       name="max_discount"
                                       class="form-control"
                                       placeholder="1000"
                                       min="0"
                                       step="1"
                                       value="{{ old('max_discount', $promotion->max_discount) }}">
                            </div>
                            <small class="form-text text-muted">Maximum discount amount (leave empty for no limit)</small>
                            @error('max_discount')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Usage Limit Per User -->
                        <div class="form-group">
                            <label for="usage_limit" class="form-label">
                                <i class="ri-user-line"></i> Usage Limit Per Customer
                            </label>
                            <input type="number"
                                   id="usage_limit"
                                   name="usage_limit"
                                   class="form-control"
                                   placeholder="1"
                                   min="0"
                                   value="{{ old('usage_limit', $promotion->usage_limit_per_user) }}">
                            <small class="form-text text-muted">0 for unlimited</small>
                            @error('usage_limit')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Total Usage Limit -->
                        <div class="form-group">
                            <label for="total_usage_limit" class="form-label">
                                <i class="ri-group-line"></i> Total Usage Limit
                            </label>
                            <input type="number"
                                   id="total_usage_limit"
                                   name="total_usage_limit"
                                   class="form-control"
                                   placeholder="1000"
                                   min="0"
                                   value="{{ old('total_usage_limit', $promotion->total_usage_limit) }}">
                            <small class="form-text text-muted">0 for unlimited</small>
                            @error('total_usage_limit')
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
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', $promotion->is_active) == '1' ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active', $promotion->is_active) == '0' ? 'checked' : '' }}>
                                    <span>Inactive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Used Count (Read Only) -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-bar-chart-line"></i> Times Used
                            </label>
                            <input type="text" class="form-control" value="{{ $promotion->used_count }}" readonly disabled>
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label for="description" class="form-label">
                                <i class="ri-file-text-line"></i> Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      class="form-control @error('description') error @enderror"
                                      placeholder="Describe the promotion details...">{{ old('description', $promotion->description) }}</textarea>
                            @error('description')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="form-group full-width">
                            <label for="terms" class="form-label">
                                <i class="ri-file-copy-line"></i> Terms & Conditions
                            </label>
                            <textarea id="terms"
                                      name="terms"
                                      class="form-control"
                                      placeholder="Terms and conditions for this promotion">{{ old('terms', $promotion->terms_conditions) }}</textarea>
                        </div>

                        <!-- Current Banner -->
                        @if($promotion->banner)
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-image-line"></i> Current Banner
                            </label>
                            <div class="current-banner">
                                <div class="banner-preview">
                                    <img src="{{ Storage::url($promotion->banner) }}" alt="Promotion Banner">
                                </div>
                                <label class="checkbox-option">
                                    <input type="checkbox" name="remove_banner" value="1">
                                    <span>Remove current banner</span>
                                </label>
                            </div>
                        </div>
                        @endif

                        <!-- New Banner Image -->
                        <div class="form-group full-width">
                            <label for="banner" class="form-label">
                                <i class="ri-image-line"></i> Update Banner Image
                            </label>
                            <input type="file"
                                   id="banner"
                                   name="banner"
                                   class="form-control"
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            <small class="form-text text-muted">Recommended size: 1200x400px (max 2MB)</small>
                            <div id="imagePreview" style="margin-top: 12px; display: none;">
                                <img src="#" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                            </div>
                            @error('banner')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Applicable Products -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-shopping-bag-line"></i> Applicable Products
                            </label>
                            <div class="radio-group" style="margin-bottom: 16px;">
                                <label class="radio-option">
                                    <input type="radio" name="product_scope" value="all" {{ old('product_scope', $promotion->product_scope) == 'all' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>All Products</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="product_scope" value="selected" {{ old('product_scope', $promotion->product_scope) == 'selected' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>Selected Products</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="product_scope" value="categories" {{ old('product_scope', $promotion->product_scope) == 'categories' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>By Category</span>
                                </label>
                            </div>

                            <!-- Selected Products -->
                            <div id="selectedProductsSection" style="display: {{ old('product_scope', $promotion->product_scope) == 'selected' ? 'block' : 'none' }};">
                                <div class="products-search">
                                    <input type="text" id="productSearch" class="form-control" placeholder="Search products...">
                                </div>
                                <div class="products-list" id="productsList">
                                    <!-- Products will be loaded here via AJAX -->
                                    <div style="text-align: center; padding: 20px; color: var(--text-secondary);">
                                        Loading products...
                                    </div>
                                </div>
                            </div>

                            <!-- Categories Selection -->
                            <div id="categoriesSection" style="display: {{ old('product_scope', $promotion->product_scope) == 'categories' ? 'block' : 'none' }};">
                                <select name="categories[]" id="categories" class="form-control" multiple size="5">
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $promotion->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple categories</small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.promotions.promotions') }}'">
                            <i class="ri-close-line"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-save-line"></i> Update Promotion
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
        let selectedProductIds = {{ json_encode(old('products', $promotion->products->pluck('id')->toArray())) }};

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

            // Load products if needed
            @if(old('product_scope', $promotion->product_scope) == 'selected')
                loadProducts();
            @endif

            // Set min date for end date
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            if (startDate && endDate) {
                startDate.addEventListener('change', function() {
                    endDate.min = this.value;
                });
            }
        });

        // Generate random code
        function generateCode() {
            const prefix = document.getElementById('name').value.substring(0, 3).toUpperCase() || 'PROMO';
            const random = Math.random().toString(36).substring(2, 8).toUpperCase();
            document.getElementById('code').value = prefix + random;
        }

        // Toggle promotion type fields
        function togglePromotionType() {
            const type = document.getElementById('type').value;

            document.getElementById('percentageField').style.display = 'none';
            document.getElementById('fixedField').style.display = 'none';
            document.getElementById('maxDiscountField').style.display = 'none';

            if (type === 'percentage') {
                document.getElementById('percentageField').style.display = 'block';
                document.getElementById('maxDiscountField').style.display = 'block';
            } else if (type === 'fixed') {
                document.getElementById('fixedField').style.display = 'block';
            }
        }

        // Toggle product selection sections
        function toggleProductSelection() {
            const scope = document.querySelector('input[name="product_scope"]:checked').value;

            document.getElementById('selectedProductsSection').style.display = 'none';
            document.getElementById('categoriesSection').style.display = 'none';

            if (scope === 'selected') {
                document.getElementById('selectedProductsSection').style.display = 'block';
                loadProducts();
            } else if (scope === 'categories') {
                document.getElementById('categoriesSection').style.display = 'block';
            }
        }

        // Load products via AJAX
        function loadProducts() {
            const productsList = document.getElementById('productsList');

            fetch('{{ route("admin.promotions.products.list.promotions") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.products) {
                    let html = '';
                    data.products.forEach(product => {
                        const checked = selectedProductIds.includes(product.id) ? 'checked' : '';
                        html += `
                            <div class="product-item">
                                <input type="checkbox" name="products[]" value="${product.id}" ${checked} onchange="updateSelectedProducts(this)">
                                <div class="product-image">
                                    ${product.image ? `<img src="${product.image}" alt="${product.name}">` : '<i class="ri-shopping-bag-line"></i>'}
                                </div>
                                <div class="product-details">
                                    <div class="product-name">${product.name}</div>
                                    <div class="product-meta">${product.category} • Stock: ${product.stock}</div>
                                </div>
                                <div class="product-price">ETB ${product.price}</div>
                            </div>
                        `;
                    });
                    productsList.innerHTML = html;

                    // Add search functionality
                    document.getElementById('productSearch').addEventListener('input', function(e) {
                        const search = e.target.value.toLowerCase();
                        document.querySelectorAll('.product-item').forEach(item => {
                            const name = item.querySelector('.product-name').textContent.toLowerCase();
                            item.style.display = name.includes(search) ? 'flex' : 'none';
                        });
                    });
                }
            })
            .catch(error => {
                console.error('Error loading products:', error);
                productsList.innerHTML = '<div style="text-align: center; padding: 20px; color: var(--text-secondary);">Failed to load products</div>';
            });
        }

        // Update selected products array
        function updateSelectedProducts(checkbox) {
            if (checkbox.checked) {
                selectedProductIds.push(parseInt(checkbox.value));
            } else {
                selectedProductIds = selectedProductIds.filter(id => id !== parseInt(checkbox.value));
            }
        }

        // Preview image before upload
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        // Form submission with loading state
        document.getElementById('promotionForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }

            // Validate dates
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (endDate <= startDate) {
                e.preventDefault();
                alert('End date must be after start date');
                return;
            }

            // Validate based on type
            const type = document.getElementById('type').value;
            if (type === 'percentage') {
                const percentage = document.getElementById('discount_percentage').value;
                if (!percentage || percentage < 1 || percentage > 100) {
                    e.preventDefault();
                    alert('Please enter a valid discount percentage (1-100)');
                    return;
                }
            } else if (type === 'fixed') {
                const amount = document.getElementById('discount_amount').value;
                if (!amount || amount < 1) {
                    e.preventDefault();
                    alert('Please enter a valid discount amount');
                    return;
                }
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Updating...';
            document.getElementById('loadingOverlay').style.display = 'flex';
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
