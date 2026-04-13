<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Product Details - Vendora Admin | Jimma, Ethiopia</title>
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

        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary-gold);
        }

        /* Product Gallery */
        .product-gallery {
            display: grid;
            grid-template-columns: 100px 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 640px) {
            .product-gallery {
                grid-template-columns: 1fr;
            }
        }

        .thumbnail-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        @media (max-width: 640px) {
            .thumbnail-list {
                flex-direction: row;
                order: 2;
            }
        }

        .thumbnail {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.2s;
        }

        .thumbnail:hover {
            border-color: var(--primary-gold);
        }

        .thumbnail.active {
            border-color: var(--primary-gold);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .main-image {
            width: 100%;
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            background-color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .main-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }

        .main-image-placeholder i {
            font-size: 64px;
            margin-bottom: 16px;
        }

        /* Info Rows */
        .info-row {
            display: flex;
            margin-bottom: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 140px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            font-weight: 500;
            word-break: break-word;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-sale {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-stock-high {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-stock-medium {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-stock-low {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .price-current {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .price-original {
            font-size: 16px;
            color: var(--text-secondary);
            text-decoration: line-through;
            margin-left: 8px;
        }

        .discount-badge {
            background-color: var(--accent-red);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Tags */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .tag {
            background-color: #f3f4f6;
            color: var(--text-secondary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* Reviews Section */
        .reviews-list {
            margin-top: 20px;
        }

        .review-item {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .reviewer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        .reviewer-name {
            font-weight: 600;
        }

        .review-rating {
            color: var(--primary-gold);
        }

        .review-date {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .review-comment {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .empty-state h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .empty-state p {
            font-size: 14px;
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
                    <i class="ri-shopping-cart-line" style="color: var(--primary-gold);"></i> Product Details
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
                <a href="{{ route('admin.products') }}" class="btn btn-secondary btn-sm">
                    <i class="ri-arrow-left-line"></i> Back to Products
                </a>
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="dashboard-container">

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

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-shopping-cart-line"></i>
                        {{ $product->name }}
                    </h1>
                    <p>Product details and information</p>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                        <i class="ri-edit-line"></i> Edit Product
                    </a>
                    <form action="{{ route('admin.products.toggle-status', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-{{ $product->is_active ? 'danger' : 'success' }}" onclick="return confirm('Are you sure you want to {{ $product->is_active ? 'deactivate' : 'activate' }} this product?')">
                            <i class="ri-{{ $product->is_active ? 'close' : 'check' }}-line"></i>
                            {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="ri-delete-bin-line"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Gallery and Info Grid -->
            <div class="detail-grid">
                <!-- Product Gallery Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-image-line"></i>
                            Product Images
                        </h3>
                    </div>

                    @php
                        $images = [];
                        if (isset($product->images) && is_array($product->images)) {
                            $images = $product->images;
                        } elseif (isset($product->image)) {
                            $images = [$product->image];
                        }
                    @endphp

                    @if(count($images) > 0)
                        <div class="product-gallery">
                            <div class="thumbnail-list">
                                @foreach($images as $index => $image)
                                    <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage(this, '{{ Storage::url($image) }}')">
                                        <img src="{{ Storage::url($image) }}" alt="Product thumbnail {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="main-image" id="mainImage">
                                <img src="{{ Storage::url($images[0]) }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                    @else
                        <div class="main-image-placeholder">
                            <i class="ri-image-line"></i>
                            <p>No images available</p>
                        </div>
                    @endif
                </div>

                <!-- Product Info Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-information-line"></i>
                            Product Information
                        </h3>
                        <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <div class="info-label">SKU</div>
                        <div class="info-value"><code>{{ $product->sku ?? 'N/A' }}</code></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Slug</div>
                        <div class="info-value"><code>{{ $product->slug }}</code></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Category</div>
                        <div class="info-value">
                            @if($product->category)
                                <a href="{{ route('admin.categories.show', $product->category_id) }}" class="text-gold">
                                    {{ $product->category->name ?? $product->category }}
                                </a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Vendor</div>
                        <div class="info-value">
                            @if($product->vendor)
                                <a href="{{ route('admin.vendors.show', $product->vendor_id) }}" class="text-gold">
                                    {{ $product->vendor->business_name ?? $product->vendor->name }}
                                </a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Price</div>
                        <div class="info-value">
                            @if(isset($product->sale_price) && $product->sale_price < $product->price)
                                <span class="price-current">ETB {{ number_format($product->sale_price, 2) }}</span>
                                <span class="price-original">ETB {{ number_format($product->price, 2) }}</span>
                                <span class="discount-badge">{{ $product->discount_percentage }}% OFF</span>
                            @else
                                <span class="price-current">ETB {{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Stock</div>
                        <div class="info-value">
                            @php
                                $stockClass = 'badge-stock-high';
                                $stockText = 'In Stock';
                                if ($product->stock <= 0) {
                                    $stockClass = 'badge-stock-low';
                                    $stockText = 'Out of Stock';
                                } elseif ($product->stock < 10) {
                                    $stockClass = 'badge-stock-medium';
                                    $stockText = 'Low Stock';
                                }
                            @endphp
                            <span class="badge {{ $stockClass }}">
                                {{ $stockText }} ({{ $product->stock }} units)
                            </span>
                        </div>
                    </div>

                    @if($product->tags && count($product->tags) > 0)
                        <div class="info-row">
                            <div class="info-label">Tags</div>
                            <div class="info-value">
                                <div class="tags-container">
                                    @foreach($product->tags as $tag)
                                        <span class="tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="info-row">
                        <div class="info-label">Description</div>
                        <div class="info-value">
                            <div style="line-height: 1.6; color: var(--text-secondary);">
                                {{ $product->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Stats Grid -->
            <div class="detail-grid" style="margin-top: 0;">
                <!-- Sales Statistics Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-bar-chart-2-line"></i>
                            Sales Statistics
                        </h3>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($product->sold_count ?? 0) }}</div>
                            <div class="stat-label">Units Sold</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">ETB {{ number_format(($product->sold_count ?? 0) * ($product->sale_price ?? $product->price), 2) }}</div>
                            <div class="stat-label">Revenue</div>
                        </div>
                    </div>

                    <div style="margin-top: 16px;">
                        <div class="info-row">
                            <div class="info-label">Views</div>
                            <div class="info-value">{{ number_format($product->views_count ?? 0) }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Conversion Rate</div>
                            <div class="info-value">
                                @php
                                    $views = $product->views_count ?? 1;
                                    $sold = $product->sold_count ?? 0;
                                    $conversion = ($sold / $views) * 100;
                                @endphp
                                {{ number_format($conversion, 2) }}%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-star-line"></i>
                            Customer Reviews
                        </h3>
                        <a href="{{ route('admin.reviews') }}?product={{ $product->id }}" class="btn btn-secondary btn-sm">
                            View All
                        </a>
                    </div>

                    @if(isset($product->reviews) && $product->reviews->count() > 0)
                        <div class="stats-grid" style="margin-bottom: 16px;">
                            <div class="stat-item">
                                <div class="stat-value">{{ number_format($product->rating, 1) }}</div>
                                <div class="stat-label">Average Rating</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $product->reviews->count() }}</div>
                                <div class="stat-label">Total Reviews</div>
                            </div>
                        </div>

                        <div class="reviews-list">
                            @foreach($product->reviews->take(3) as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">
                                                {{ $review->user ? strtoupper(substr($review->user->name, 0, 2)) : 'AN' }}
                                            </div>
                                            <span class="reviewer-name">{{ $review->user->name ?? 'Anonymous' }}</span>
                                        </div>
                                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="ri-star-fill"></i>
                                            @else
                                                <i class="ri-star-line"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="review-comment">
                                        "{{ $review->comment }}"
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="ri-star-line"></i>
                            <h3>No Reviews Yet</h3>
                            <p>This product hasn't received any reviews.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Metadata Card -->
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ri-file-copy-line"></i>
                        Additional Information
                    </h3>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                    <div>
                        <h4 style="margin-bottom: 12px; color: var(--text-secondary); font-size: 14px;">SEO Metadata</h4>
                        <div class="info-row">
                            <div class="info-label">Meta Title</div>
                            <div class="info-value">{{ $product->meta_title ?? 'Not set' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Meta Description</div>
                            <div class="info-value">{{ $product->meta_description ?? 'Not set' }}</div>
                        </div>
                    </div>

                    <div>
                        <h4 style="margin-bottom: 12px; color: var(--text-secondary); font-size: 14px;">Timestamps</h4>
                        <div class="info-row">
                            <div class="info-label">Created</div>
                            <div class="info-value">{{ $product->created_at->format('M d, Y H:i') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ $product->updated_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>

                    <div>
                        <h4 style="margin-bottom: 12px; color: var(--text-secondary); font-size: 14px;">Quick Actions</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('admin.inventory.restock', $product->id) }}" class="btn btn-secondary btn-sm" style="justify-content: center;">
                                <i class="ri-add-line"></i> Restock
                            </a>
                            <a href="{{ route('admin.products.duplicate', $product->id) }}" class="btn btn-secondary btn-sm" style="justify-content: center;">
                                <i class="ri-file-copy-line"></i> Duplicate
                            </a>
                            <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="btn btn-secondary btn-sm" style="justify-content: center;">
                                <i class="ri-external-link-line"></i> View on Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

        // Change main image when thumbnail is clicked
        function changeMainImage(thumbnail, imageUrl) {
            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            thumbnail.classList.add('active');

            // Update main image
            const mainImage = document.getElementById('mainImage');
            mainImage.innerHTML = `<img src="${imageUrl}" alt="Product image">`;
        }

       

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
