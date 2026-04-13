<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Create Product - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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
            border-color: var(--accent-red);
        }

        textarea.form-control {
            min-height: 120px;
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

        /* Image Upload */
        .image-upload-container {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .image-upload-container:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
        }

        .image-upload-container i {
            font-size: 48px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .image-upload-container p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .image-preview {
            display: none;
            margin-top: 16px;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .image-preview img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        .image-preview .remove-image {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(0,0,0,0.5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .image-preview .remove-image:hover {
            background-color: var(--accent-red);
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
            background-color: var(--accent-red);
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
    @include('partials.admin-sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-shopping-cart-line" style="color: var(--primary-gold);"></i> Create Product
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
                <a href="{{ route('admin.products') }}" class="btn btn-secondary" style="margin-left: 8px;">
                    <i class="ri-arrow-left-line"></i> Back
                </a>
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-shopping-cart-line"></i>
                        Create New Product
                    </h1>
                    <p>Add a new product to your marketplace</p>
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

            <!-- Create Product Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.products.store') }}" id="productForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-grid">
                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-shopping-cart-line"></i> Product Name
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') error @enderror"
                                   placeholder="e.g., Premium Coffee Beans"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div class="form-group">
                            <label for="sku" class="form-label">
                                <i class="ri-barcode-line"></i> SKU (Stock Keeping Unit)
                            </label>
                            <input type="text"
                                   id="sku"
                                   name="sku"
                                   class="form-control @error('sku') error @enderror"
                                   placeholder="e.g., PRD-001"
                                   value="{{ old('sku') }}">
                            <small class="form-text">Leave empty for auto-generation</small>
                            @error('sku')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Category
                            </label>
                            <select id="category_id" name="category_id" class="form-control @error('category_id') error @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Vendor -->
                        <div class="form-group">
                            <label for="vendor_id" class="form-label">
                                <i class="ri-store-line"></i> Vendor
                            </label>
                            <select id="vendor_id" name="vendor_id" class="form-control @error('vendor_id') error @enderror" required>
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->business_name ?? $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price" class="form-label">
                                <i class="ri-money-dollar-circle-line"></i> Regular Price (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number"
                                       id="price"
                                       name="price"
                                       class="form-control @error('price') error @enderror"
                                       placeholder="1000"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('price') }}"
                                       required>
                            </div>
                            @error('price')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Sale Price -->
                        <div class="form-group">
                            <label for="sale_price" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Sale Price (ETB)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">ETB</span>
                                <input type="number"
                                       id="sale_price"
                                       name="sale_price"
                                       class="form-control @error('sale_price') error @enderror"
                                       placeholder="800"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('sale_price') }}">
                            </div>
                            <small class="form-text">Leave empty if not on sale</small>
                            @error('sale_price')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div class="form-group">
                            <label for="stock" class="form-label">
                                <i class="ri-stack-line"></i> Stock Quantity
                            </label>
                            <input type="number"
                                   id="stock"
                                   name="stock"
                                   class="form-control @error('stock') error @enderror"
                                   placeholder="100"
                                   min="0"
                                   value="{{ old('stock', 0) }}"
                                   required>
                            @error('stock')
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

                        <!-- Tags -->
                        <div class="form-group full-width">
                            <label for="tags" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Tags
                            </label>
                            <input type="text"
                                   id="tags"
                                   name="tags"
                                   class="form-control @error('tags') error @enderror"
                                   placeholder="e.g., coffee, premium, organic (comma separated)"
                                   value="{{ old('tags') }}">
                            <small class="form-text">Separate tags with commas</small>
                            @error('tags')
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
                                      placeholder="Detailed product description..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Meta Title (SEO) -->
                        <div class="form-group">
                            <label for="meta_title" class="form-label">
                                <i class="ri-file-search-line"></i> Meta Title (SEO)
                            </label>
                            <input type="text"
                                   id="meta_title"
                                   name="meta_title"
                                   class="form-control"
                                   placeholder="SEO title (optional)"
                                   value="{{ old('meta_title') }}">
                            <small class="form-text">Leave empty to use product name</small>
                        </div>

                        <!-- Meta Description (SEO) -->
                        <div class="form-group">
                            <label for="meta_description" class="form-label">
                                <i class="ri-file-search-line"></i> Meta Description (SEO)
                            </label>
                            <input type="text"
                                   id="meta_description"
                                   name="meta_description"
                                   class="form-control"
                                   placeholder="SEO description (optional)"
                                   value="{{ old('meta_description') }}">
                        </div>

                        <!-- Product Image -->
                        <div class="form-group full-width">
                            <label for="image" class="form-label">
                                <i class="ri-image-line"></i> Product Image
                            </label>
                            <div class="image-upload-container" onclick="document.getElementById('image').click()">
                                <i class="ri-upload-cloud-line"></i>
                                <p>Click to upload product image</p>
                                <p style="font-size: 12px; margin-top: 8px;">JPG, PNG, GIF up to 2MB</p>
                            </div>
                            <input type="file"
                                   id="image"
                                   name="image"
                                   class="form-control"
                                   accept="image/jpeg,image/png,image/gif,image/webp"
                                   style="display: none;"
                                   onchange="previewImage(this)">

                            <div class="image-preview" id="imagePreview">
                                <img src="#" alt="Preview">
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            @error('image')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.products') }}'">
                            <i class="ri-close-line"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-shopping-cart-line"></i> Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Creating product...</div>
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
        });

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
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a valid image file (JPEG, PNG, GIF, WebP)');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            }
        }

        // Remove image preview
        function removeImage() {
            const input = document.getElementById('image');
            const preview = document.getElementById('imagePreview');

            input.value = '';
            preview.style.display = 'none';
        }

        // Form validation
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            if (!name) {
                alert('Please enter a product name');
                return false;
            }

            const price = document.getElementById('price').value;
            if (!price || price <= 0) {
                alert('Please enter a valid price');
                return false;
            }

            const category = document.getElementById('category_id').value;
            if (!category) {
                alert('Please select a category');
                return false;
            }

            const vendor = document.getElementById('vendor_id').value;
            if (!vendor) {
                alert('Please select a vendor');
                return false;
            }

            const stock = document.getElementById('stock').value;
            if (stock < 0) {
                alert('Stock cannot be negative');
                return false;
            }

            const salePrice = document.getElementById('sale_price').value;
            if (salePrice && parseFloat(salePrice) >= parseFloat(price)) {
                alert('Sale price must be less than regular price');
                return false;
            }

            return true;
        }

        // Form submission with loading state
        document.getElementById('productForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

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
    </script>

</body>
</html>
