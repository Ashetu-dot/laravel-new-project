<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Profile - Vendora | Jimma, Ethiopia</title>
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
            font-family: 'Inter-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        :root {
            --primary-bg: #f8fafc;
            --sidebar-bg: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #334155;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e2e8f0;
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
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

        /* Ethiopian Flag Colors Accent */
        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
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
            border-bottom: 1px solid #334155;
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
            color: #64748b;
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
            border-top: 1px solid #334155;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
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

        .page-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 600;
        }

        .page-title i {
            color: var(--primary-gold);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
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
            transition: all 0.2s;
            position: relative;
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--primary-gold);
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

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
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
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Form Styles */
        .form-container {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow-sm);
        }

        .form-section {
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section h2 i {
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
            border-radius: var(--radius-sm);
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
            min-height: 100px;
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
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .file-upload-area:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
        }

        .file-upload-area.has-file {
            border-color: var(--success-color);
            background-color: #f0fdf4;
        }

        .upload-icon {
            font-size: 40px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .upload-text {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .upload-hint {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .file-preview {
            display: none;
            margin-top: 16px;
            padding: 16px;
            background-color: #f8fafc;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
        }

        .file-preview.active {
            display: block;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .preview-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .preview-details {
            flex: 1;
        }

        .preview-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .preview-size {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .preview-remove {
            background: none;
            border: none;
            color: var(--accent-red);
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .preview-remove:hover {
            background-color: #fee2e2;
        }

        /* Current Avatar */
        .current-avatar {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding: 16px;
            background-color: #f8fafc;
            border-radius: var(--radius-sm);
        }

        .current-avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-gold);
        }

        .current-avatar .avatar-info {
            flex: 1;
        }

        .current-avatar .avatar-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .current-avatar .avatar-info p {
            color: var(--text-secondary);
            font-size: 13px;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: var(--radius-sm);
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
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
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
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        /* Responsive */
        @media (max-width: 640px) {
            .form-container {
                padding: 24px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
            
            .current-avatar {
                flex-direction: column;
                text-align: center;
            }
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
            @if($user->role === 'admin')
                <!-- Admin Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">MAIN</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.orders') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> Orders
                    </a>
                    <a href="{{ route('admin.customers') }}" class="nav-item">
                        <i class="ri-user-3-line"></i> Customers
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">MANAGEMENT</div>
                    <a href="{{ route('admin.vendors') }}" class="nav-item">
                        <i class="ri-store-2-line"></i> Vendors
                    </a>
                    <a href="{{ route('admin.catalog') }}" class="nav-item">
                        <i class="ri-archive-line"></i> Catalog
                    </a>
                    <a href="{{ route('admin.promotions') }}" class="nav-item">
                        <i class="ri-price-tag-3-line"></i> Promotions
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">ADMIN</div>
                    <a href="{{ route('admin.settings') }}" class="nav-item">
                        <i class="ri-settings-4-line"></i> Settings
                    </a>
                    <a href="{{ route('admin.admins.list') }}" class="nav-item">
                        <i class="ri-shield-user-line"></i> Admins
                    </a>
                    <a href="{{ route('admin.roles') }}" class="nav-item">
                        <i class="ri-shield-keyhole-line"></i> Roles
                    </a>
                </div>
            @elseif($user->role === 'vendor')
                <!-- Vendor Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">VENDOR</div>
                    <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('vendor.store', $user->id) }}" class="nav-item">
                        <i class="ri-store-line"></i> My Store
                    </a>
                    <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> Orders
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">PRODUCTS</div>
                    <a href="{{ route('vendor.products.create') }}" class="nav-item">
                        <i class="ri-add-circle-line"></i> Add Product
                    </a>
                    <a href="{{ route('vendor.products.index') }}" class="nav-item">
                        <i class="ri-list-check"></i> Manage Products
                    </a>
                    <a href="{{ route('vendor.categories.index') }}" class="nav-item">
                        <i class="ri-price-tag-3-line"></i> Categories
                    </a>
                </div>
            @else
                <!-- Customer Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">MAIN</div>
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('search.results') }}" class="nav-item">
                        <i class="ri-search-line"></i> Discover
                    </a>
                    <a href="{{ route('customer.orders') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> My Orders
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">SHOPPING</div>
                    <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                        <i class="ri-heart-3-line"></i> Wishlist
                    </a>
                    <a href="{{ route('customer.following') }}" class="nav-item">
                        <i class="ri-store-2-line"></i> Following
                    </a>
                    <a href="{{ route('customer.coupons') }}" class="nav-item">
                        <i class="ri-coupon-3-line"></i> My Coupons
                    </a>
                </div>
            @endif

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('profile.show', $user->id) }}" class="nav-item">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('profile.edit', $user->id) }}" class="nav-item active">
                    <i class="ri-settings-4-line"></i> Edit Profile
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
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                @else
                    {{ substr($user->name ?? 'U', 0, 2) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ $user->name ?? 'User' }}</h4>
                <p>{{ ucfirst($user->role ?? 'customer') }}</p>
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
                    <i class="ri-settings-4-line"></i> Edit Profile
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('customer.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                @if($user->role === 'customer')
                    <a href="{{ route('customer.cart.index') }}" class="icon-btn">
                        <i class="ri-shopping-cart-2-line"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="badge-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                @endif
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-settings-4-line" style="color: var(--primary-gold);"></i> 
                        Edit Profile
                    </h1>
                    <p>Update your personal information and account settings</p>
                </div>
                <a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Profile
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i> {{ session('error') }}
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

            <!-- Edit Profile Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" id="editProfileForm">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h2>
                            <i class="ri-user-line"></i>
                            Basic Information
                        </h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name <span class="required">*</span></label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-input @error('name') error @enderror" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-input @error('email') error @enderror" 
                                       value="{{ old('email', $user->email) }}" 
                                       required>
                                @error('email')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-input @error('phone') error @enderror" 
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="e.g., +251 911 123 456">
                                @error('phone')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Avatar Upload Section -->
                    <div class="form-section">
                        <h2>
                            <i class="ri-image-line"></i>
                            Profile Picture
                        </h2>

                        @if($user->avatar)
                        <div class="current-avatar">
                            <img src="{{ Storage::url($user->avatar) }}" alt="Current Avatar">
                            <div class="avatar-info">
                                <h4>Current Avatar</h4>
                                <p>Upload a new image to change your profile picture. Supported formats: JPG, PNG, GIF (max. 2MB).</p>
                            </div>
                        </div>
                        @endif

                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="ri-upload-cloud-2-line upload-icon"></i>
                            <div class="upload-text" id="uploadText">
                                @if($user->avatar)
                                    Click to change profile picture
                                @else
                                    Click to upload profile picture
                                @endif
                            </div>
                            <div class="upload-hint">SVG, PNG, JPG or GIF (max. 2MB)</div>
                            <input type="file" name="avatar" id="fileUpload" accept="image/*" style="display: none;">
                        </div>
                        <div id="filePreview" class="file-preview"></div>
                        @error('avatar')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Location Information (for all users) -->
                    <div class="form-section">
                        <h2>
                            <i class="ri-map-pin-line"></i>
                            Location
                        </h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" 
                                       id="city" 
                                       name="city" 
                                       class="form-input @error('city') error @enderror" 
                                       value="{{ old('city', $user->city) }}"
                                       placeholder="e.g., Jimma">
                                @error('city')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="state" class="form-label">Region / State</label>
                                <select name="state" id="state" class="form-select @error('state') error @enderror">
                                    <option value="">Select Region</option>
                                    <option value="Oromia" {{ old('state', $user->state) == 'Oromia' ? 'selected' : '' }}>Oromia</option>
                                    <option value="Addis Ababa" {{ old('state', $user->state) == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                    <option value="Amhara" {{ old('state', $user->state) == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                    <option value="Tigray" {{ old('state', $user->state) == 'Tigray' ? 'selected' : '' }}>Tigray</option>
                                    <option value="Sidama" {{ old('state', $user->state) == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                                    <option value="SNNPR" {{ old('state', $user->state) == 'SNNPR' ? 'selected' : '' }}>SNNPR</option>
                                    <option value="Somali" {{ old('state', $user->state) == 'Somali' ? 'selected' : '' }}>Somali</option>
                                </select>
                                @error('state')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Vendor-Specific Information -->
                    @if($user->role === 'vendor')
                    <div class="form-section">
                        <h2>
                            <i class="ri-store-line"></i>
                            Business Information
                        </h2>
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" 
                                       id="business_name" 
                                       name="business_name" 
                                       class="form-input @error('business_name') error @enderror" 
                                       value="{{ old('business_name', $user->business_name) }}"
                                       placeholder="e.g., Abebe's Handicrafts">
                                @error('business_name')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category" class="form-label">Business Category</label>
                                <select name="category" id="category" class="form-select @error('category') error @enderror">
                                    <option value="">Select Category</option>
                                    <option value="coffee" {{ old('category', $user->category) == 'coffee' ? 'selected' : '' }}>Coffee & Tea</option>
                                    <option value="handicrafts" {{ old('category', $user->category) == 'handicrafts' ? 'selected' : '' }}>Handicrafts</option>
                                    <option value="textiles" {{ old('category', $user->category) == 'textiles' ? 'selected' : '' }}>Textiles</option>
                                    <option value="food" {{ old('category', $user->category) == 'food' ? 'selected' : '' }}>Food & Spices</option>
                                    <option value="jewelry" {{ old('category', $user->category) == 'jewelry' ? 'selected' : '' }}>Jewelry</option>
                                    <option value="electronics" {{ old('category', $user->category) == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="services" {{ old('category', $user->category) == 'services' ? 'selected' : '' }}>Services</option>
                                </select>
                                @error('category')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" 
                                       id="website" 
                                       name="website" 
                                       class="form-input @error('website') error @enderror" 
                                       value="{{ old('website', $user->website) }}"
                                       placeholder="https://example.com">
                                @error('website')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label for="address_line1" class="form-label">Street Address</label>
                                <input type="text" 
                                       id="address_line1" 
                                       name="address_line1" 
                                       class="form-input @error('address_line1') error @enderror" 
                                       value="{{ old('address_line1', $user->address_line1) }}"
                                       placeholder="Street / Kebele">
                                @error('address_line1')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address_line2" class="form-label">Address Line 2</label>
                                <input type="text" 
                                       id="address_line2" 
                                       name="address_line2" 
                                       class="form-input" 
                                       value="{{ old('address_line2', $user->address_line2) }}"
                                       placeholder="Landmark (Optional)">
                            </div>

                            <div class="form-group">
                                <label for="tax_id" class="form-label">Tax ID / License</label>
                                <input type="text" 
                                       id="tax_id" 
                                       name="tax_id" 
                                       class="form-input" 
                                       value="{{ old('tax_id', $user->tax_id) }}"
                                       placeholder="Optional">
                                <div class="form-hint">Business license or tax identification number</div>
                            </div>

                            <div class="form-group full-width">
                                <label for="description" class="form-label">Business Description</label>
                                <textarea id="description" 
                                          name="description" 
                                          class="form-textarea @error('description') error @enderror" 
                                          placeholder="Describe your business, products, and what makes you unique..."
                                          maxlength="500">{{ old('description', $user->description) }}</textarea>
                                <div class="form-hint"><span id="charCount">0</span>/500 characters</div>
                                @error('description')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span>Save Changes</span>
                            <i class="ri-check-line"></i>
                        </button>
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @if(Auth::id() == $user->id)
                        <a href="{{ route('password.request') }}" class="btn btn-secondary" style="margin-left: auto;">
                            <i class="ri-lock-line"></i> Change Password
                        </a>
                        @endif
                    </div>
                </form>
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

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Character counter for description
            const description = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            if (description && charCount) {
                const updateCounter = () => {
                    const count = description.value.length;
                    charCount.textContent = count;
                    if (count >= 500) {
                        charCount.style.color = 'var(--accent-red)';
                    } else {
                        charCount.style.color = 'var(--text-secondary)';
                    }
                };
                description.addEventListener('input', updateCounter);
                updateCounter();
            }
        });

        // File upload handling
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileUpload');
        const uploadText = document.getElementById('uploadText');
        const filePreview = document.getElementById('filePreview');

        if (fileUploadArea && fileInput) {
            fileUploadArea.addEventListener('click', () => fileInput.click());

            fileUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--primary-gold)';
                fileUploadArea.style.backgroundColor = '#fef3e7';
            });

            fileUploadArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-color)';
                fileUploadArea.style.backgroundColor = '#f8fafc';
            });

            fileUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-color)';
                fileUploadArea.style.backgroundColor = '#f8fafc';

                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileSelect(e.dataTransfer.files[0]);
                }
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    handleFileSelect(fileInput.files[0]);
                }
            });
        }

        function handleFileSelect(file) {
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                return;
            }

            uploadText.textContent = `Selected: ${file.name}`;
            fileUploadArea.classList.add('has-file');

            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.innerHTML = `
                    <div class="preview-content">
                        <img src="${e.target.result}" class="preview-image">
                        <div class="preview-details">
                            <div class="preview-name">${file.name}</div>
                            <div class="preview-size">${(file.size / 1024).toFixed(1)} KB</div>
                        </div>
                        <button type="button" class="preview-remove" onclick="removeFile()">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                `;
                filePreview.classList.add('active');
            };
            reader.readAsDataURL(file);
        }

        function removeFile() {
            fileInput.value = '';
            uploadText.textContent = 'Click to upload profile picture';
            fileUploadArea.classList.remove('has-file');
            filePreview.innerHTML = '';
            filePreview.classList.remove('active');
        }

        // Form submission loading state
        document.getElementById('editProfileForm')?.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Saving...';
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