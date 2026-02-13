<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Catalog Management</title>
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

        @media (max-width: 1024px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                width: 200px;
            }
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
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
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

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1280px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Quick Action Cards */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .action-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .action-grid {
                grid-template-columns: 1fr;
            }
        }

        .action-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
            display: block;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .action-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .action-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .action-desc {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Recent Products Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: #f3f4f6;
            object-fit: cover;
        }

        .stock-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .stock-high { background-color: #d1fae5; color: #065f46; }
        .stock-medium { background-color: #fef3c7; color: #92400e; }
        .stock-low { background-color: #fee2e2; color: #991b1b; }

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
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Management</div>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item active">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">Admin</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Admins
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>{{ Auth::user()->role ?? 'Super Admin' }}</p>
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
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search products...">
                </div>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            
            <div class="page-header">
                <div>
                    <h1 class="page-title">Catalog Management</h1>
                    <p class="page-subtitle">Manage products, categories, and inventory</p>
                </div>
                <div>
                    <span class="stock-badge stock-high">Last updated: {{ now()->format('M d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-product-hunt-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Products</div>
                        <div class="stat-number">{{ number_format($totalProducts ?? 0) }}</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Categories</div>
                        <div class="stat-number">{{ number_format($totalCategories ?? 0) }}</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-store-2-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Active Vendors</div>
                        <div class="stat-number">{{ number_format($activeVendorsCount ?? 0) }}</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon bg-red-light">
                        <i class="ri-alert-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Out of Stock</div>
                        <div class="stat-number">{{ number_format($outOfStock ?? 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Cards -->
            <div class="action-grid">
                <a href="{{ route('admin.catalog.products') }}" class="action-card">
                    <div class="action-icon bg-blue-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <h3 class="action-title">Manage Products</h3>
                    <p class="action-desc">Add, edit, or remove products from the marketplace</p>
                </a>
                
                <a href="{{ route('admin.catalog.categories') }}" class="action-card">
                    <div class="action-icon bg-green-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <h3 class="action-title">Categories</h3>
                    <p class="action-desc">Organize products with categories and subcategories</p>
                </a>
                
                <a href="{{ route('admin.inventory') }}" class="action-card">
                    <div class="action-icon bg-yellow-light">
                        <i class="ri-stack-line"></i>
                    </div>
                    <h3 class="action-title">Inventory</h3>
                    <p class="action-desc">Monitor stock levels and manage inventory</p>
                </a>
            </div>

            <!-- Recent Products Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Recently Added Products</h3>
                    <a href="{{ route('admin.catalog.products') }}" style="color: var(--primary-gold); font-size: 14px; text-decoration: none; font-weight: 500;">View All Products</a>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Vendor</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts ?? [] as $product)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    @php
                                        $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                                        $image = $images[0] ?? 'https://via.placeholder.com/48';
                                    @endphp
                                    <img src="{{ $image }}" alt="{{ $product->name }}" class="product-image">
                                    <div>
                                        <div style="font-weight: 600;">{{ $product->name }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">SKU: {{ $product->sku ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->vendor->business_name ?? $product->vendor->name ?? 'N/A' }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                @if($product->sale_price)
                                    <span style="color: var(--accent-red); font-weight: 600;">${{ number_format($product->sale_price, 2) }}</span>
                                    <span style="text-decoration: line-through; color: var(--text-secondary); font-size: 12px; margin-left: 4px;">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span style="font-weight: 600;">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $stockClass = 'stock-high';
                                    $stockText = 'In Stock';
                                    if ($product->stock <= 0) {
                                        $stockClass = 'stock-low';
                                        $stockText = 'Out of Stock';
                                    } elseif ($product->stock < 10) {
                                        $stockClass = 'stock-medium';
                                        $stockText = 'Low Stock';
                                    }
                                @endphp
                                <span class="stock-badge {{ $stockClass }}">
                                    {{ $stockText }} ({{ $product->stock }})
                                </span>
                            </td>
                            <td>
                                <span class="stock-badge {{ $product->is_active ? 'stock-high' : 'stock-low' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 60px;">
                                <i class="ri-shopping-bag-3-line" style="font-size: 48px; color: var(--text-secondary); margin-bottom: 16px; display: block;"></i>
                                <h3 style="margin-bottom: 8px;">No products found</h3>
                                <p style="color: var(--text-secondary);">Products will appear here once vendors start listing them</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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