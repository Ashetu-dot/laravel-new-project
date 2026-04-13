<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>{{ $product->name }} - Vendora Admin | Jimma, Ethiopia</title>
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
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
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
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            flex-shrink: 0;
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

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary-gold);
        }

        .breadcrumb i {
            font-size: 12px;
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

        /* Product Content */
        .product-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .product-container {
                padding: 24px 16px;
            }
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
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

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-image {
            width: 100%;
            max-width: 400px;
            height: 300px;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .product-image-placeholder {
            width: 100%;
            max-width: 400px;
            height: 300px;
            background-color: #f3f4f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .product-image-placeholder i {
            font-size: 48px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: var(--text-secondary);
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .vendor-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .vendor-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .vendor-details h4 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .vendor-details p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
        }

        .btn-secondary {
            background-color: var(--card-bg);
            color: var(--text-primary);
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

        .btn-success {
            background-color: var(--accent-green);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .description-text {
            line-height: 1.6;
            color: var(--text-secondary);
        }

        .stock-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stock-low {
            color: var(--accent-red);
        }

        .stock-medium {
            color: var(--accent-yellow);
        }

        .stock-high {
            color: var(--accent-green);
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    @include('partials.admin-sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <i class="ri-menu-line menu-toggle" onclick="toggleSidebar()"></i>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <a href="{{ route('admin.catalog.products') }}">Products</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>{{ $product->name }}</span>
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
                    <i class="ri-message-3-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Product Content -->
        <div class="product-container">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="ri-shopping-cart-line"></i>
                    {{ $product->name }}
                    <span class="status-badge status-{{ $product->is_active ? 'active' : 'inactive' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </h1>
            </div>

            <div class="product-grid">
                <!-- Product Details -->
                <div class="product-main">
                    <!-- Product Image and Description -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-image-line"></i>
                                Product Details
                            </h3>
                        </div>

                        @php $firstImage = $product->first_image; @endphp
                        @if($firstImage)
                            <img src="{{ filter_var($firstImage, FILTER_VALIDATE_URL) ? $firstImage : asset('storage/' . ltrim($firstImage, '/')) }}"
                                 alt="{{ $product->name }}"
                                 class="product-image"
                                 onerror="this.onerror=null;this.src='{{ $product->placeholder_image }}'">
                        @else
                            <div class="product-image-placeholder">
                                <i class="ri-image-line"></i>
                            </div>
                        @endif

                        <div class="description-text">
                            <h4 style="margin-bottom: 12px;">Description</h4>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <!-- Vendor Information -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-store-2-line"></i>
                                Vendor Information
                            </h3>
                        </div>
                        <div class="vendor-info">
                            <div class="vendor-avatar">
                                <img src="{{ $product->vendor->avatar_url }}"
                                     alt="{{ $product->vendor->name }}"
                                     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(substr($product->vendor->business_name ?? $product->vendor->name, 0, 2)) }}&background=B88E3F&color=fff&size=80';">
                            </div>
                            <div class="vendor-details">
                                <h4>{{ $product->vendor->business_name ?? $product->vendor->name }}</h4>
                                <p>{{ $product->vendor->email }}</p>
                                @if($product->vendor->phone)
                                    <p>{{ $product->vendor->phone }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Summary Sidebar -->
                <div class="product-sidebar">
                    <!-- Product Information -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-information-line"></i>
                                Product Information
                            </h3>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Product ID:</span>
                            <span class="info-value">#{{ $product->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Price:</span>
                            <span class="info-value">{{ number_format($product->price, 2) }} ETB</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Stock:</span>
                            <span class="info-value">
                                <span class="stock-indicator">
                                    @if($product->stock <= 5)
                                        <span class="stock-low">{{ $product->stock }} units</span>
                                        <i class="ri-error-warning-line stock-low"></i>
                                    @elseif($product->stock <= 20)
                                        <span class="stock-medium">{{ $product->stock }} units</span>
                                        <i class="ri-alert-line stock-medium"></i>
                                    @else
                                        <span class="stock-high">{{ $product->stock }} units</span>
                                        <i class="ri-checkbox-circle-line stock-high"></i>
                                    @endif
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Category:</span>
                            <span class="info-value">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge status-{{ $product->is_active ? 'active' : 'inactive' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Created:</span>
                            <span class="info-value">{{ $product->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($product->updated_at != $product->created_at)
                            <div class="info-row">
                                <span class="info-label">Last Updated:</span>
                                <span class="info-value">{{ $product->updated_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-settings-4-line"></i>
                                Actions
                            </h3>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('admin.catalog.products.edit', $product->id) }}" class="btn btn-primary">
                                <i class="ri-edit-line"></i>
                                Edit Product
                            </a>

                            <button class="btn {{ $product->is_active ? 'btn-secondary' : 'btn-success' }}"
                                    onclick="toggleProductStatus({{ $product->id }})">
                                <i class="ri-{{ $product->is_active ? 'pause' : 'play' }}-circle-line"></i>
                                {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                            </button>

                            <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">
                                <i class="ri-delete-bin-line"></i>
                                Delete Product
                            </button>

                            <a href="{{ route('admin.catalog.products') }}" class="btn btn-secondary">
                                <i class="ri-arrow-left-line"></i>
                                Back to Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        function toggleProductStatus(productId) {
            if (!confirm('Are you sure you want to change the product status?')) {
                return;
            }

            fetch(`/admin/catalog/products/${productId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update product status: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update product status. Please try again.');
            });
        }

        function deleteProduct(productId) {
            if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                return;
            }

            fetch(`/admin/catalog/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/admin/catalog/products';
                } else {
                    alert('Failed to delete product: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete product. Please try again.');
            });
        }

        // Mobile sidebar toggle
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const menuToggle = document.querySelector('.menu-toggle');

                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
