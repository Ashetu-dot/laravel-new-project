<!-- resources/views/admin/promotions/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Create Promotion - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Your existing styles remain the same */
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
            --info-color: #3b82f6;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
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
            background-color: white;
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
            font-weight: 500;
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

        .form-text {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
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
            transition: background-color 0.2s;
        }

        .product-item:hover {
            background-color: #f9fafb;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image i {
            font-size: 20px;
            color: var(--text-secondary);
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
            font-size: 14px;
        }

        /* Category Selection */
        select[multiple] {
            padding: 8px;
        }

        select[multiple] option {
            padding: 8px;
            border-radius: 4px;
        }

        select[multiple] option:checked {
            background-color: var(--primary-gold) linear-gradient(0deg, var(--primary-gold) 0%, var(--primary-gold) 100%);
            color: white;
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
            border-left: 4px solid var(--info-color);
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin: 4px 0;
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

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
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

        /* Image Preview */
        .image-preview {
            margin-top: 12px;
            padding: 12px;
            background-color: #f9fafb;
            border-radius: 8px;
            display: none;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        /* Badge for selected count */
        .selected-count {
            display: inline-block;
            padding: 2px 8px;
            background-color: var(--primary-gold);
            color: white;
            border-radius: 12px;
            font-size: 11px;
            margin-left: 8px;
        }

        /* Select All Option */
        .select-all-option {
            padding: 12px;
            background-color: #f9fafb;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .select-all-option:hover {
            background-color: #f3f4f6;
        }

        .select-all-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
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
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
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
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
                </a>
                <a href="{{ route('admin.documentation') }}" class="nav-item">
                    <i class="ri-book-open-line"></i> Documentation
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
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-megaphone-line" style="color: var(--primary-gold);"></i> Create Promotion
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
                        Create New Promotion
                    </h1>
                    <p>Create a new promotion to boost sales and engage customers</p>
                </div>
                <a href="{{ route('admin.promotions.promotions') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Promotions
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
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Create Promotion Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.promotions.store') }}" id="promotionForm" enctype="multipart/form-data">
                    @csrf

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
                                   value="{{ old('name') }}"
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
                            <div style="display: flex; gap: 8px;">
                                <input type="text"
                                       id="code"
                                       name="code"
                                       class="form-control @error('code') error @enderror"
                                       placeholder="SUMMER2024"
                                       value="{{ old('code') }}"
                                       required>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="generateCode()" style="white-space: nowrap;">
                                    <i class="ri-refresh-line"></i> Generate
                                </button>
                            </div>
                            <small class="form-text">Unique code for this promotion. Customers will enter this code at checkout.</small>
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
                                <option value="">Select Type</option>
                                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount Discount</option>
                                <option value="bogo" {{ old('type') == 'bogo' ? 'selected' : '' }}>Buy One Get One (BOGO)</option>
                                <option value="free_shipping" {{ old('type') == 'free_shipping' ? 'selected' : '' }}>Free Shipping</option>
                            </select>
                            @error('type')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Value (Percentage) -->
                        <div class="form-group" id="percentageField" style="{{ old('type') == 'percentage' ? 'display: block;' : 'display: none;' }}">
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
                                       value="{{ old('discount_percentage') }}">
                            </div>
                            <small class="form-text">Enter a value between 1 and 100</small>
                            @error('discount_percentage')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Discount Value (Fixed) -->
                        <div class="form-group" id="fixedField" style="{{ old('type') == 'fixed' ? 'display: block;' : 'display: none;' }}">
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
                                       value="{{ old('discount_amount') }}">
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
                                   value="{{ old('start_date', now()->format('Y-m-d\TH:i')) }}"
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
                                   value="{{ old('end_date', now()->addDays(30)->format('Y-m-d\TH:i')) }}"
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
                                       value="{{ old('min_purchase', 0) }}">
                            </div>
                            <small class="form-text">Minimum cart total required to use this promotion</small>
                            @error('min_purchase')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Max Discount Amount (for percentage) -->
                        <div class="form-group" id="maxDiscountField" style="{{ old('type') == 'percentage' ? 'display: block;' : 'display: none;' }}">
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
                                       value="{{ old('max_discount') }}">
                            </div>
                            <small class="form-text">Maximum discount amount (leave empty for no limit)</small>
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
                                   value="{{ old('usage_limit', 1) }}">
                            <small class="form-text">0 for unlimited usage per customer</small>
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
                                   value="{{ old('total_usage_limit', 0) }}">
                            <small class="form-text">Total number of times this promotion can be used (0 for unlimited)</small>
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
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active') == '0' ? 'checked' : '' }}>
                                    <span>Inactive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Display order -->
                        <div class="form-group">
                            <label for="display_order" class="form-label">
                                <i class="ri-sort-numberic-desc"></i> Display Order
                            </label>
                            <input type="number"
                                   id="display_order"
                                   name="display_order"
                                   class="form-control"
                                   placeholder="0"
                                   min="0"
                                   value="{{ old('display_order', 0) }}">
                            <small class="form-text">Order in which promotion appears (lower numbers first)</small>
                            @error('display_order')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label for="description" class="form-label">
                                <i class="ri-file-text-line"></i> Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      class="form-control @error('description') error @enderror"
                                      placeholder="Describe the promotion details...">{{ old('description') }}</textarea>
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
                                      placeholder="Terms and conditions for this promotion">{{ old('terms') }}</textarea>
                            <small class="form-text">Optional: Add any terms or conditions for this promotion</small>
                        </div>

                        <!-- Banner Image -->
                        <div class="form-group full-width">
                            <label for="banner" class="form-label">
                                <i class="ri-image-line"></i> Banner Image
                            </label>
                            <input type="file"
                                   id="banner"
                                   name="banner"
                                   class="form-control"
                                   accept="image/jpeg,image/png,image/gif,image/webp"
                                   onchange="previewImage(this)">
                            <small class="form-text">Recommended size: 1200x400px (max 2MB). Supported formats: JPG, PNG, GIF, WebP</small>
                            <div class="image-preview" id="imagePreview">
                                <img src="#" alt="Preview">
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
                                    <input type="radio" name="product_scope" value="all" {{ old('product_scope', 'all') == 'all' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>All Products</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="product_scope" value="selected" {{ old('product_scope') == 'selected' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>Selected Products</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="product_scope" value="categories" {{ old('product_scope') == 'categories' ? 'checked' : '' }} onchange="toggleProductSelection()">
                                    <span>By Category</span>
                                </label>
                            </div>

                            <!-- Selected Products -->
                            <div id="selectedProductsSection" style="display: {{ old('product_scope') == 'selected' ? 'block' : 'none' }};">
                                <div class="products-search">
                                    <input type="text" id="productSearch" class="form-control" placeholder="Search products..." onkeyup="filterProducts()">
                                </div>
                                <div class="products-list" id="productsList">
                                    <!-- Products will be loaded here via AJAX -->
                                    <div style="text-align: center; padding: 30px; color: var(--text-secondary);">
                                        <i class="ri-loader-4-line" style="font-size: 24px; animation: spin 1s linear infinite;"></i>
                                        <p style="margin-top: 10px;">Loading products...</p>
                                    </div>
                                </div>
                                <small class="form-text" id="selectedCount">No products selected</small>
                            </div>

                            <!-- Categories Selection -->
                            <div id="categoriesSection" style="display: {{ old('product_scope') == 'categories' ? 'block' : 'none' }};">
                                <select name="categories[]" id="categories" class="form-control" multiple size="6">
                                    @if(isset($categories) && $categories->count() > 0)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, (array)old('categories', [])) ? 'selected' : '' }}>
                                                {{ $category->name }} ({{ $category->products_count ?? 0 }} products)
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No categories found</option>
                                    @endif
                                </select>
                                <small class="form-text">Hold Ctrl/Cmd (Windows/Linux) or Cmd (Mac) to select multiple categories</small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.promotions.promotions') }}'">
                            <i class="ri-close-line"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-megaphone-line"></i> Create Promotion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Creating promotion...</div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Store selected products
        let selectedProducts = {{ json_encode(old('products', [])) }};
        let allProducts = [];

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
            @if(old('product_scope') == 'selected')
                loadProducts();
            @endif

            // Set min date for end date
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            if (startDate && endDate) {
                startDate.addEventListener('change', function() {
                    endDate.min = this.value;
                    if (endDate.value && endDate.value < this.value) {
                        endDate.value = this.value;
                    }
                });
            }

            // Set default end date to 30 days after start
            const startDateValue = startDate?.value;
            if (startDateValue && !endDate?.value) {
                const start = new Date(startDateValue);
                start.setDate(start.getDate() + 30);
                endDate.value = start.toISOString().slice(0, 16);
            }
        });

        // Generate random code
        function generateCode() {
            const name = document.getElementById('name').value;
            let prefix = name ? name.substring(0, 3).toUpperCase() : 'PROMO';
            // Remove any special characters from prefix
            prefix = prefix.replace(/[^A-Z]/g, '');
            if (prefix.length < 2) prefix = 'PROMO';

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
                document.getElementById('discount_percentage').required = true;
                document.getElementById('discount_amount').required = false;
            } else if (type === 'fixed') {
                document.getElementById('fixedField').style.display = 'block';
                document.getElementById('discount_percentage').required = false;
                document.getElementById('discount_amount').required = true;
            } else if (type === 'bogo' || type === 'free_shipping') {
                document.getElementById('discount_percentage').required = false;
                document.getElementById('discount_amount').required = false;
            }
        }

        // Toggle product selection sections
        function toggleProductSelection() {
            const scope = document.querySelector('input[name="product_scope"]:checked')?.value;

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

            fetch('/admin/products/list', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.products) {
                    allProducts = data.products;
                    renderProducts(allProducts);
                } else {
                    productsList.innerHTML = '<div style="text-align: center; padding: 30px; color: var(--text-secondary);">No products found</div>';
                }
            })
            .catch(error => {
                console.error('Error loading products:', error);
                productsList.innerHTML = '<div style="text-align: center; padding: 30px; color: var(--danger-color);">Failed to load products. Please refresh the page.</div>';
            });
        }

        // Render products list
        function renderProducts(products) {
            const productsList = document.getElementById('productsList');

            if (!products || products.length === 0) {
                productsList.innerHTML = '<div style="text-align: center; padding: 30px; color: var(--text-secondary);">No products found</div>';
                return;
            }

            let html = `
                <div class="select-all-option">
                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                    <label for="selectAll">Select All Products</label>
                </div>
            `;

            products.forEach(product => {
                const checked = selectedProducts.includes(product.id) ? 'checked' : '';
                const imageUrl = product.image ? `/storage/${product.image}` : null;

                html += `
                    <div class="product-item" data-product-name="${product.name.toLowerCase()}">
                        <input type="checkbox"
                               name="products[]"
                               value="${product.id}"
                               ${checked}
                               onchange="updateSelectedCount()">
                        <div class="product-image">
                            ${imageUrl ? `<img src="${imageUrl}" alt="${product.name}">` : '<i class="ri-shopping-bag-line"></i>'}
                        </div>
                        <div class="product-details">
                            <div class="product-name">${product.name}</div>
                            <div class="product-meta">
                                ${product.category ? product.category : 'Uncategorized'} •
                                Stock: ${product.stock}
                            </div>
                        </div>
                        <div class="product-price">ETB ${parseFloat(product.price).toFixed(2)}</div>
                    </div>
                `;
            });

            productsList.innerHTML = html;

            // Update select all checkbox state
            updateSelectAllState();
            updateSelectedCount();
        }

        // Filter products based on search
        function filterProducts() {
            const searchTerm = document.getElementById('productSearch').value.toLowerCase();

            if (!searchTerm) {
                renderProducts(allProducts);
                return;
            }

            const filtered = allProducts.filter(product =>
                product.name.toLowerCase().includes(searchTerm) ||
                (product.category && product.category.toLowerCase().includes(searchTerm))
            );

            renderProducts(filtered);
        }

        // Toggle select all products
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name="products[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });

            updateSelectedCount();
        }

        // Update select all checkbox state
        function updateSelectAllState() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name="products[]"]');

            if (selectAll && checkboxes.length > 0) {
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                selectAll.checked = allChecked;
                selectAll.indeterminate = !allChecked && Array.from(checkboxes).some(cb => cb.checked);
            }
        }

        // Update selected products count
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('input[name="products[]"]:checked');
            const count = checkboxes.length;
            const selectedCount = document.getElementById('selectedCount');

            if (selectedCount) {
                selectedCount.innerHTML = count > 0 ?
                    `<span class="selected-count">${count}</span> product(s) selected` :
                    'No products selected';
            }

            // Update selectedProducts array
            selectedProducts = Array.from(checkboxes).map(cb => cb.value);
        }

        // Preview image before upload
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a valid image file (JPEG, PNG, GIF, WebP)');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Form validation
        function validateForm() {
            // Check required fields
            const name = document.getElementById('name').value.trim();
            if (!name) {
                alert('Please enter a promotion name');
                return false;
            }

            const code = document.getElementById('code').value.trim();
            if (!code) {
                alert('Please enter a promotion code');
                return false;
            }

            const type = document.getElementById('type').value;
            if (!type) {
                alert('Please select a promotion type');
                return false;
            }

            // Validate dates
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (endDate <= startDate) {
                alert('End date must be after start date');
                return false;
            }

            // Validate based on type
            if (type === 'percentage') {
                const percentage = document.getElementById('discount_percentage').value;
                if (!percentage || percentage < 1 || percentage > 100) {
                    alert('Please enter a valid discount percentage (1-100)');
                    return false;
                }
            } else if (type === 'fixed') {
                const amount = document.getElementById('discount_amount').value;
                if (!amount || amount < 1) {
                    alert('Please enter a valid discount amount');
                    return false;
                }
            }

            // Validate product scope
            const productScope = document.querySelector('input[name="product_scope"]:checked')?.value;
            if (productScope === 'selected') {
                const selectedCount = document.querySelectorAll('input[name="products[]"]:checked').length;
                if (selectedCount === 0) {
                    alert('Please select at least one product');
                    return false;
                }
            } else if (productScope === 'categories') {
                const selectedCategories = document.getElementById('categories').selectedOptions.length;
                if (selectedCategories === 0) {
                    alert('Please select at least one category');
                    return false;
                }
            }

            return true;
        }

        // Form submission with loading state
        document.getElementById('promotionForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }

            if (!validateForm()) {
                e.preventDefault();
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Creating...';
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

       

        // Add keyboard shortcut for code generation (Ctrl+G)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'g') {
                e.preventDefault();
                generateCode();
            }
        });
    </script>

</body>
</html>
