<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Add New Product - Vendora | Jimma, Ethiopia</title>
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
            gap: 16px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Form Styles */
        .form-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 32px;
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
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-label .required {
            color: var(--accent-red);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: var(--accent-red);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .file-upload-area:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
        }

        .file-upload-icon {
            font-size: 40px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .file-upload-text {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .file-upload-hint {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .image-preview-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1;
            border: 1px solid var(--border-color);
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview-remove {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0,0,0,0.5);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .image-preview-remove:hover {
            background-color: var(--accent-red);
        }

        /* Price Input Group */
        .price-input-group {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        .price-currency {
            padding: 12px 16px;
            background-color: #f9fafb;
            border-right: 1px solid var(--border-color);
            font-weight: 600;
            color: var(--text-secondary);
        }

        .price-input-group .form-input {
            border: none;
            border-radius: 0;
        }

        .price-input-group .form-input:focus {
            box-shadow: none;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
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
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--success-color);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        .toggle-label {
            margin-left: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Button Styles */
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
        }

        .btn-primary:disabled {
            opacity: 0.5;
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
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert Styles */
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
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .alert i {
            font-size: 20px;
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
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.store', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-store-line"></i> My Store
                </a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">PRODUCTS</div>
                <a href="{{ route('vendor.products.create') }}" class="nav-item active">
                    <i class="ri-add-circle-line"></i> Add Product
                </a>
                <a href="{{ route('vendor.products.index') }}" class="nav-item">
                    <i class="ri-list-check"></i> Manage Products
                </a>
                <a href="{{ route('vendor.categories.index') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Sales Report
                </a>
                <a href="#" class="nav-item">
                    <i class="ri-eye-line"></i> Store Views
                </a>
                <a href="#" class="nav-item">
                    <i class="ri-star-line"></i> Reviews
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SETTINGS</div>
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('profile.edit', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->business_name ?? Auth::user()->name }}</h4>
                <p>Vendor since {{ Auth::user()->created_at->format('M Y') }}</p>
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
                    <i class="ri-add-circle-line" style="color: var(--primary-gold);"></i> Add New Product
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('vendor.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('vendor.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-add-circle-line" style="color: var(--primary-gold);"></i> 
                        Add New Product
                    </h1>
                    <p>Fill in the details below to add a new product to your store</p>
                </div>
                <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Products
                </a>
            </div>

            <!-- Success/Error Messages -->
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

            <!-- Product Form -->
            <div class="form-container">
                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf

                    <div class="form-grid">
                        <!-- Product Name -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                Product Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   class="form-input @error('name') error @enderror" 
                                   value="{{ old('name') }}"
                                   placeholder="e.g., Ethiopian Coffee, Traditional Dress, Handicraft"
                                   required>
                            @error('name')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category and Price -->
                        <div class="form-group">
                            <label class="form-label">
                                Category <span class="required">*</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') error @enderror" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Price (ETB) <span class="required">*</span>
                            </label>
                            <div class="price-input-group">
                                <span class="price-currency">ETB</span>
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       class="form-input @error('price') error @enderror" 
                                       value="{{ old('price') }}"
                                       placeholder="0.00"
                                       min="0"
                                       step="0.01"
                                       required>
                            </div>
                            @error('price')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sale Price and Stock -->
                        <div class="form-group">
                            <label class="form-label">Sale Price (ETB)</label>
                            <div class="price-input-group">
                                <span class="price-currency">ETB</span>
                                <input type="number" 
                                       name="sale_price" 
                                       id="sale_price" 
                                       class="form-input @error('sale_price') error @enderror" 
                                       value="{{ old('sale_price') }}"
                                       placeholder="0.00"
                                       min="0"
                                       step="0.01">
                            </div>
                            <div class="form-hint">Leave empty if not on sale</div>
                            @error('sale_price')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Stock Quantity <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   class="form-input @error('stock') error @enderror" 
                                   value="{{ old('stock', 1) }}"
                                   placeholder="0"
                                   min="0"
                                   required>
                            <div class="form-hint">Enter 0 for out of stock</div>
                            @error('stock')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SKU and Status -->
                        <div class="form-group">
                            <label class="form-label">SKU (Optional)</label>
                            <input type="text" 
                                   name="sku" 
                                   id="sku" 
                                   class="form-input @error('sku') error @enderror" 
                                   value="{{ old('sku') }}"
                                   placeholder="e.g., COF-001">
                            <div class="form-hint">Stock Keeping Unit - unique identifier</div>
                            @error('sku')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <div style="display: flex; align-items: center;">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label" id="statusLabel">Active</span>
                            </div>
                            <div class="form-hint">Toggle to activate/deactivate product</div>
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                Description <span class="required">*</span>
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-textarea @error('description') error @enderror" 
                                      placeholder="Describe your product in detail. Include materials, dimensions, care instructions, etc."
                                      required>{{ old('description') }}</textarea>
                            <div class="form-hint" id="charCount">0/500 characters</div>
                            @error('description')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="form-group full-width">
                            <label class="form-label">Product Images</label>
                            <div class="file-upload-area" onclick="document.getElementById('images').click()">
                                <i class="ri-upload-cloud-2-line file-upload-icon"></i>
                                <div class="file-upload-text">Click to upload or drag and drop</div>
                                <div class="file-upload-hint">SVG, PNG, JPG or GIF (max. 5MB per image, up to 5 images)</div>
                                <input type="file" 
                                       name="images[]" 
                                       id="images" 
                                       style="display: none;" 
                                       accept="image/*" 
                                       multiple>
                            </div>
                            <div id="imagePreviewContainer" class="image-preview-container"></div>
                            @error('images')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="form-group full-width">
                            <label class="form-label">Tags</label>
                            <input type="text" 
                                   name="tags" 
                                   id="tags" 
                                   class="form-input @error('tags') error @enderror" 
                                   value="{{ old('tags') }}"
                                   placeholder="e.g., coffee, traditional, handmade, gift">
                            <div class="form-hint">Separate tags with commas</div>
                            @error('tags')
                                <div class="error-message active">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="submitText">Add Product</span>
                            <span id="submitSpinner" class="spinner" style="display: none;"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

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

            // Toggle status label
            const statusToggle = document.getElementById('is_active');
            const statusLabel = document.getElementById('statusLabel');
            
            if (statusToggle && statusLabel) {
                statusToggle.addEventListener('change', function() {
                    statusLabel.textContent = this.checked ? 'Active' : 'Inactive';
                });
            }

            // Character counter for description
            const description = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            if (description && charCount) {
                description.addEventListener('input', function() {
                    charCount.textContent = this.value.length + '/500 characters';
                });
            }

            // File upload preview
            const fileInput = document.getElementById('images');
            const previewContainer = document.getElementById('imagePreviewContainer');
            let selectedFiles = [];

            if (fileInput && previewContainer) {
                fileInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    
                    if (files.length > 5) {
                        alert('Maximum 5 images allowed');
                        this.value = '';
                        previewContainer.innerHTML = '';
                        selectedFiles = [];
                        return;
                    }

                    // Check file sizes
                    for (let file of files) {
                        if (file.size > 5 * 1024 * 1024) {
                            alert(`File ${file.name} exceeds 5MB`);
                            this.value = '';
                            previewContainer.innerHTML = '';
                            selectedFiles = [];
                            return;
                        }
                    }

                    selectedFiles = files;
                    previewContainer.innerHTML = '';

                    files.forEach((file, index) => {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'image-preview-item';
                            previewItem.innerHTML = `
                                <img src="${e.target.result}" alt="Preview ${index + 1}">
                                <button type="button" class="image-preview-remove" onclick="removeImage(${index})">
                                    <i class="ri-close-line"></i>
                                </button>
                            `;
                            previewContainer.appendChild(previewItem);
                        };
                        
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Form submission
            const form = document.getElementById('productForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            if (form) {
                form.addEventListener('submit', function(e) {
                    submitBtn.disabled = true;
                    submitText.style.display = 'none';
                    submitSpinner.style.display = 'inline-block';
                });
            }

            // Auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Function to remove image from preview
        function removeImage(index) {
            const dt = new DataTransfer();
            const fileInput = document.getElementById('images');
            const files = Array.from(fileInput.files);
            
            files.splice(index, 1);
            
            files.forEach(file => {
                dt.items.add(file);
            });
            
            fileInput.files = dt.files;
            
            // Refresh preview
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = '';
            
            Array.from(fileInput.files).forEach((file, i) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'image-preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${i + 1}">
                        <button type="button" class="image-preview-remove" onclick="removeImage(${i})">
                            <i class="ri-close-line"></i>
                        </button>
                    `;
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        }

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