<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - {{ $user->name }}'s Profile</title>
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

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Profile Card */
        .profile-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .profile-cover {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            position: relative;
        }

        .profile-avatar {
            position: absolute;
            bottom: -60px;
            left: 40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .profile-info {
            padding: 80px 40px 40px 40px;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .profile-name-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .profile-role {
            display: inline-block;
            padding: 4px 12px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .profile-stats {
            display: flex;
            gap: 32px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .profile-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            padding: 24px;
            background-color: #f9fafb;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        @media (max-width: 640px) {
            .profile-meta {
                grid-template-columns: 1fr;
            }
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: #fef3e7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 20px;
        }

        .meta-content {
            flex: 1;
        }

        .meta-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 2px;
        }

        .meta-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .profile-bio {
            margin-bottom: 32px;
        }

        .profile-bio h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .profile-bio p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .profile-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

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
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
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

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Sidebar (Conditional based on user role) -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
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
                    <a href="{{ route('vendor.show', $user->id) }}" class="nav-item">
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
                </div>
            @else
                <!-- Customer Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">CUSTOMER</div>
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('search.results') }}" class="nav-item">
                        <i class="ri-search-line"></i> Discover
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">SHOPPING</div>
                    <a href="#" class="nav-item">
                        <i class="ri-heart-3-line"></i> Wishlist
                    </a>
                    <a href="#" class="nav-item">
                        <i class="ri-store-2-line"></i> Following
                    </a>
                </div>
            @endif

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('profile.show', $user->id) }}" class="nav-item active">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('profile.edit', $user->id) }}" class="nav-item">
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
                {{ substr($user->name ?? 'U', 0, 2) }}
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
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search...">
                </div>
            </div>

            <div class="header-actions">
                <a href="#" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
                @if($user->role === 'customer')
                    <a href="#" class="icon-btn">
                        <i class="ri-shopping-cart-2-line"></i>
                    </a>
                @endif
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">My Profile</h1>
                    <p class="page-subtitle">View and manage your personal information</p>
                </div>
                @if(Auth::id() == $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">
                        <i class="ri-edit-line"></i> Edit Profile
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                    <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-cover"></div>
                <div class="profile-avatar">
                    {{ substr($user->name ?? 'U', 0, 2) }}
                </div>

                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-name-section">
                            <h2>{{ $user->name }}</h2>
                            <span class="profile-role">{{ ucfirst($user->role) }}</span>
                            @if($user->email_verified_at)
                                <span style="margin-left: 8px; color: var(--accent-green);">
                                    <i class="ri-verified-badge-fill"></i> Verified
                                </span>
                            @endif
                        </div>

                        <div class="profile-stats">
                            @if($user->role === 'vendor')
                                <div class="stat-item">
                                    <div class="stat-value">{{ $followersCount ?? 0 }}</div>
                                    <div class="stat-label">Followers</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $user->products_count ?? 0 }}</div>
                                    <div class="stat-label">Products</div>
                                </div>
                            @endif
                            <div class="stat-item">
                                <div class="stat-value">{{ $followingCount ?? 0 }}</div>
                                <div class="stat-label">Following</div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-meta">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Email Address</div>
                                <div class="meta-value">{{ $user->email }}</div>
                            </div>
                        </div>

                        @if($user->phone)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-phone-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Phone Number</div>
                                <div class="meta-value">{{ $user->phone }}</div>
                            </div>
                        </div>
                        @endif

                        @if($user->business_name)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-store-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Business Name</div>
                                <div class="meta-value">{{ $user->business_name }}</div>
                            </div>
                        </div>
                        @endif

                        @if($user->category)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-price-tag-3-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Category</div>
                                <div class="meta-value">{{ $user->category }}</div>
                            </div>
                        </div>
                        @endif

                        @if($user->city || $user->state)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Location</div>
                                <div class="meta-value">
                                    @if($user->city && $user->state)
                                        {{ $user->city }}, {{ $user->state }}
                                    @elseif($user->city)
                                        {{ $user->city }}
                                    @elseif($user->state)
                                        {{ $user->state }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Member Since</div>
                                <div class="meta-value">
                                    @if($user->created_at)
                                        {{ $user->created_at->format('F j, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user->description || $user->bio)
                    <div class="profile-bio">
                        <h3>About</h3>
                        <p>{{ $user->description ?? $user->bio }}</p>
                    </div>
                    @endif

                    @if(Auth::id() == $user->id)
                    <div class="profile-actions">
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">
                            <i class="ri-edit-line"></i> Edit Profile
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="ri-home-line"></i> Home
                        </a>
                        @if($user->role === 'vendor')
                            <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @elseif($user->role === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @elseif($user->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @endif
                    </div>
                    @endif
                </div>
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
