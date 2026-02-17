<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora Marketplace - Search Results | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Font Definitions */
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
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --bg-color: #f8fafc;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --text-light: #94a3b8;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --error: #ef4444;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            padding: 4px 10px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin: 20px auto;
            max-width: 1200px;
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

        /* Helper Classes */
        .container {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 40px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            min-height: 80px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 20px;
        }

        .logo {
            font-family: 'Inter-Bold', sans-serif;
            font-size: 28px;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .logo i {
            font-size: 32px;
        }

        .logo-badge {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-container {
            flex: 1;
            max-width: 600px;
            position: relative;
        }

        .search-input {
            width: 100%;
            height: 48px;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 0 20px 0 50px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: var(--text-dark);
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 20px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .nav-btn {
            background: none;
            border: none;
            font-size: 22px;
            color: var(--text-gray);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            text-decoration: none;
            position: relative;
        }

        .nav-btn:hover {
            background-color: #f1f5f9;
            color: var(--primary-gold);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--error);
            color: white;
            font-size: 10px;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-gold);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 30px;
            transition: all 0.2s;
        }

        .user-menu:hover {
            background-color: #f1f5f9;
            color: var(--primary-gold);
        }

        /* Filter Section */
        .filters-section {
            background-color: var(--white);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 40px;
        }

        .filters-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .filter-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-btn {
            height: 44px;
            padding: 0 20px;
            border: 1px solid var(--border-color);
            border-radius: 40px;
            background-color: var(--white);
            color: var(--text-gray);
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .filter-btn i {
            color: var(--text-light);
        }

        .filter-btn:hover i {
            color: var(--primary-gold);
        }

        .filter-btn.active {
            background-color: #fef3e7;
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .filter-tag {
            background-color: #fef3e7;
            color: var(--primary-gold);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-tag i {
            cursor: pointer;
            font-size: 16px;
        }

        .filter-tag i:hover {
            color: var(--primary-hover);
        }

        .results-count {
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Active Filters Bar */
        .active-filters {
            background-color: var(--white);
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .active-filters .container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .clear-filters {
            color: var(--primary-gold);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-left: 8px;
        }

        .clear-filters:hover {
            text-decoration: underline;
        }

        /* Main Content */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin: 40px 0 60px;
        }

        /* Vendor Card */
        .vendor-card {
            background-color: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid transparent;
        }

        .vendor-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(184, 142, 63, 0.2);
        }

        .card-image-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 2px;
            height: 200px;
            background-color: #f1f5f9;
            position: relative;
        }

        .card-img-main {
            grid-row: 1 / span 2;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-img-sub {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verified-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--primary-gold);
            color: white;
            padding: 4px 10px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            z-index: 2;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .vendor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
            gap: 10px;
        }

        .vendor-name {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary-gold);
            flex-shrink: 0;
        }

        .vendor-category {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 12px;
            display: block;
        }

        .vendor-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            color: var(--text-gray);
            font-size: 13px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item i {
            color: var(--primary-gold);
            font-size: 14px;
        }

        .action-area {
            margin-top: 16px;
            display: flex;
            gap: 10px;
        }

        .btn-outline {
            flex: 1;
            height: 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: transparent;
            font-weight: 500;
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-primary {
            flex: 1;
            height: 40px;
            border: none;
            border-radius: var(--radius-sm);
            background: var(--primary-gold);
            font-weight: 500;
            font-size: 13px;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(184, 142, 63, 0.3);
        }

        .btn-following {
            flex: 1;
            height: 40px;
            border: 1px solid var(--primary-gold);
            border-radius: var(--radius-sm);
            background: #fef3e7;
            font-weight: 500;
            font-size: 13px;
            color: var(--primary-gold);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-following:hover {
            background: #fee7d6;
        }

        /* Empty State */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .no-results i {
            font-size: 64px;
            color: var(--primary-gold);
            margin-bottom: 20px;
        }

        .no-results h3 {
            font-size: 28px;
            margin-bottom: 12px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .no-results p {
            font-size: 16px;
            color: var(--text-gray);
            margin-bottom: 24px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 60px 0 80px;
            flex-wrap: wrap;
        }

        .pagination .page-link {
            min-width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            background-color: var(--white);
            color: var(--text-dark);
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid var(--border-color);
        }

        .pagination .page-link:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination .page-link.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination .page-link.next-prev {
            padding: 0 16px;
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-gray);
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid #f1f5f9;
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media screen and (max-width: 1400px) {
            .grid-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }
        }

        @media screen and (max-width: 1200px) {
            .container { padding: 0 30px; }
        }

        @media screen and (max-width: 1024px) {
            .search-container { max-width: 400px; }
            .search-input { font-size: 15px; }
        }

        @media screen and (max-width: 900px) {
            .nav-content {
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 16px;
            }
            .logo { grid-column: 1; }
            .nav-actions { grid-column: 2; justify-self: end; }
            .search-container {
                grid-column: 1 / -1;
                max-width: 100%;
                order: 3;
                margin-top: 8px;
            }
            .filters-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .filter-group {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 12px;
                -webkit-overflow-scrolling: touch;
            }
            .filter-btn { flex-shrink: 0; }
            .results-count { align-self: flex-end; }
        }

        @media screen and (max-width: 768px) {
            .navbar { min-height: 70px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .ethiopia-badge { font-size: 10px; padding: 2px 8px; }
            
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .card-image-grid { height: 180px; }
            .vendor-name { font-size: 16px; }
            
            .pagination .page-link {
                min-width: 38px;
                height: 38px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 640px) {
            .container { padding: 0 20px; }
            
            .grid-container {
                grid-template-columns: 1fr;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .search-input { height: 44px; font-size: 15px; }
            .search-icon { font-size: 18px; left: 16px; }
            
            .filter-btn { 
                height: 40px; 
                padding: 0 16px; 
                font-size: 13px; 
            }
            
            .filter-tag { font-size: 12px; padding: 4px 12px; }
            .results-count { font-size: 13px; }
            
            .vendor-name { font-size: 17px; }
        }

        @media screen and (max-width: 480px) {
            .nav-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .logo {
                grid-column: 1;
                justify-self: center;
                font-size: 22px;
            }
            .nav-actions {
                grid-column: 1;
                justify-self: center;
                gap: 8px;
            }
            .nav-btn { width: 36px; height: 36px; font-size: 20px; }
            .user-avatar { width: 36px; height: 36px; }
            
            .card-image-grid { height: 170px; }
            
            .footer-links { gap: 20px; }
            .footer-links a { font-size: 13px; }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 20px; }
            .logo i { font-size: 24px; }
            .nav-btn { width: 32px; height: 32px; font-size: 18px; }
            .user-avatar { width: 32px; height: 32px; }
            .search-input { height: 40px; font-size: 14px; padding-left: 42px; }
            .search-icon { left: 14px; font-size: 16px; }
            .card-image-grid { height: 160px; }
            .vendor-name { font-size: 16px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <div class="logo-badge">
                <a href="{{ route('home') }}" class="logo">
                    <i class="ri-store-3-fill"></i>
                    Vendora
                </a>
                <span class="ethiopia-badge">
                    <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                </span>
            </div>

            <div class="search-container">
                <i class="ri-search-line search-icon"></i>
                <form action="{{ route('search.results') }}" method="GET" style="width: 100%;">
                    <input type="text" name="query" class="search-input" placeholder="Search for vendors, products, or categories in Jimma..." value="{{ request('query') }}">
                </form>
            </div>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="nav-btn" aria-label="Login" title="Login">
                        <i class="ri-user-line"></i>
                    </a>
                    <a href="{{ route('register') }}" class="nav-btn" aria-label="Sign Up" title="Sign Up" style="background: var(--primary-gold); color: white;">
                        <i class="ri-user-add-line"></i>
                    </a>
                @else
                    <a href="{{ route('customer.notifications') }}" class="nav-btn" aria-label="Notifications">
                        <i class="ri-notification-3-line"></i>
                        @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                            <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('customer.cart.index') }}" class="nav-btn" aria-label="Cart">
                        <i class="ri-shopping-bag-3-line"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="badge-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('profile.show', Auth::id()) }}" class="user-menu">
                        @php
                            $avatarUrl = Auth::user()->avatar 
                                ? Storage::url(Auth::user()->avatar) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=B88E3F&color=fff&size=200';
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="user-avatar" loading="lazy">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Filters -->
    <section class="filters-section">
        <div class="container filters-wrapper">
            <div class="filter-group">
                <form action="{{ route('search.results') }}" method="GET" id="filterForm" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    @if(request('query'))
                        <input type="hidden" name="query" value="{{ request('query') }}">
                    @endif

                    <select name="location" class="filter-btn" onchange="this.form.submit()">
                        <option value="">📍 All Ethiopia</option>
                        <option value="Jimma" {{ request('location') == 'Jimma' ? 'selected' : '' }}>📍 Jimma</option>
                        <option value="Addis Ababa" {{ request('location') == 'Addis Ababa' ? 'selected' : '' }}>📍 Addis Ababa</option>
                        <option value="Bahir Dar" {{ request('location') == 'Bahir Dar' ? 'selected' : '' }}>📍 Bahir Dar</option>
                        <option value="Hawassa" {{ request('location') == 'Hawassa' ? 'selected' : '' }}>📍 Hawassa</option>
                        <option value="Dire Dawa" {{ request('location') == 'Dire Dawa' ? 'selected' : '' }}>📍 Dire Dawa</option>
                        <option value="Mekelle" {{ request('location') == 'Mekelle' ? 'selected' : '' }}>📍 Mekelle</option>
                        <option value="Gondar" {{ request('location') == 'Gondar' ? 'selected' : '' }}>📍 Gondar</option>
                    </select>

                    <select name="category" class="filter-btn" onchange="this.form.submit()">
                        <option value="">🏷️ All Categories</option>
                        <option value="coffee" {{ request('category') == 'coffee' ? 'selected' : '' }}>☕ Coffee & Tea</option>
                        <option value="handicrafts" {{ request('category') == 'handicrafts' ? 'selected' : '' }}>🎨 Handicrafts</option>
                        <option value="textiles" {{ request('category') == 'textiles' ? 'selected' : '' }}>🧵 Textiles</option>
                        <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>🍲 Food & Spices</option>
                        <option value="jewelry" {{ request('category') == 'jewelry' ? 'selected' : '' }}>💍 Jewelry</option>
                        <option value="electronics" {{ request('category') == 'electronics' ? 'selected' : '' }}>📱 Electronics</option>
                        <option value="services" {{ request('category') == 'services' ? 'selected' : '' }}>🛠️ Services</option>
                    </select>

                    <select name="rating" class="filter-btn" onchange="this.form.submit()">
                        <option value="">⭐ Any Rating</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ 4+ Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ 3+ Stars</option>
                    </select>

                    <select name="sort" class="filter-btn" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>🔄 Newest First</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>⭐ Top Rated</option>
                        <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>📦 Most Products</option>
                    </select>

                    <button type="button" class="filter-btn" onclick="clearAllFilters()">
                        <i class="ri-filter-off-line"></i> Clear
                    </button>
                </form>

                @if(request('category'))
                    <div class="filter-tag">
                        {{ ucfirst(request('category')) }}
                        <i class="ri-close-line" onclick="removeFilter('category')"></i>
                    </div>
                @endif
                @if(request('location'))
                    <div class="filter-tag">
                        {{ request('location') }}
                        <i class="ri-close-line" onclick="removeFilter('location')"></i>
                    </div>
                @endif
                @if(request('rating'))
                    <div class="filter-tag">
                        {{ request('rating') }}+ Stars
                        <i class="ri-close-line" onclick="removeFilter('rating')"></i>
                    </div>
                @endif
                @if(request('sort') && request('sort') != 'newest')
                    <div class="filter-tag">
                        Sort: {{ ucfirst(request('sort')) }}
                        <i class="ri-close-line" onclick="removeFilter('sort')"></i>
                    </div>
                @endif
            </div>

            <span class="results-count">
                @if($vendors->total() > 0)
                    Showing {{ $vendors->firstItem() }} - {{ $vendors->lastItem() }} of {{ $vendors->total() }} vendors
                @else
                    No vendors found
                @endif
            </span>
        </div>
    </section>

    <!-- Active Filters Bar -->
    @if(request()->anyFilled(['query', 'category', 'location', 'rating', 'sort']))
    <div class="active-filters">
        <div class="container">
            <span style="font-size: 14px; color: var(--text-gray);">Active filters:</span>
            @if(request('query'))
                <span class="filter-tag">"{{ request('query') }}"</span>
            @endif
            @if(request('category'))
                <span class="filter-tag">{{ ucfirst(request('category')) }}</span>
            @endif
            @if(request('location'))
                <span class="filter-tag">{{ request('location') }}</span>
            @endif
            @if(request('rating'))
                <span class="filter-tag">{{ request('rating') }}+ Stars</span>
            @endif
            @if(request('sort') && request('sort') != 'newest')
                <span class="filter-tag">Sort: {{ ucfirst(request('sort')) }}</span>
            @endif
            <a href="{{ route('search.results') }}" class="clear-filters">Clear all</a>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="container">

        @if($vendors->count() > 0)
        <div class="grid-container">
            @foreach($vendors as $vendor)
            <div class="vendor-card">
                <div class="card-image-grid">
                    @if($vendor->email_verified_at)
                        <span class="verified-badge"><i class="ri-verified-badge-fill"></i> Verified</span>
                    @endif
                    @php
                        $mainImage = $vendor->main_image 
                            ? (filter_var($vendor->main_image, FILTER_VALIDATE_URL) 
                                ? $vendor->main_image 
                                : Storage::url($vendor->main_image))
                            : 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80';
                        
                        $subImage1 = $vendor->sub_image_1 
                            ? (filter_var($vendor->sub_image_1, FILTER_VALIDATE_URL) 
                                ? $vendor->sub_image_1 
                                : Storage::url($vendor->sub_image_1))
                            : 'https://images.unsplash.com/photo-1565193566173-7a646c770962?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80';
                            
                        $subImage2 = $vendor->sub_image_2 
                            ? (filter_var($vendor->sub_image_2, FILTER_VALIDATE_URL) 
                                ? $vendor->sub_image_2 
                                : Storage::url($vendor->sub_image_2))
                            : 'https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80';
                    @endphp
                    <img src="{{ $mainImage }}" 
                         alt="{{ $vendor->business_name }}" 
                         class="card-img-main"
                         loading="lazy"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=No+Image';">
                    <img src="{{ $subImage1 }}" 
                         alt="{{ $vendor->business_name }}" 
                         class="card-img-sub"
                         loading="lazy"
                         onerror="this.style.display='none'">
                    <img src="{{ $subImage2 }}" 
                         alt="{{ $vendor->business_name }}" 
                         class="card-img-sub"
                         loading="lazy"
                         onerror="this.style.display='none'">
                </div>
                <div class="card-content">
                    <div class="vendor-header">
                        <h3 class="vendor-name">{{ $vendor->business_name ?? $vendor->name }}</h3>
                        <div class="vendor-rating">
                            <i class="ri-star-fill"></i> {{ number_format($vendor->rating ?? 4.5, 1) }}
                        </div>
                    </div>
                    <span class="vendor-category">{{ $vendor->category ?? 'General Store' }}</span>
                    <div class="vendor-meta">
                        <div class="meta-item">
                            <i class="ri-map-pin-2-line"></i>
                            <span>{{ $vendor->city ?? 'Jimma' }}, {{ $vendor->state ?? 'Oromia' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-box-3-line"></i>
                            <span>{{ $vendor->products_count ?? 0 }} Products</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-user-follow-line"></i>
                            <span>{{ $vendor->followers_count ?? 0 }} Followers</span>
                        </div>
                    </div>
                     <div class="action-area">
                        <a href="{{ route('vendor.show', $vendor->id) }}" class="btn-outline">
                            <i class="ri-store-line"></i> View Shop
                        </a>
                        @auth
                            @if(Auth::id() !== $vendor->id)
                                @php
                                    $isFollowing = Auth::user()->following()->where('vendor_id', $vendor->id)->exists();
                                @endphp
                                @if($isFollowing)
                                    <form action="{{ route('vendor.unfollow', $vendor->id) }}" method="POST" style="flex:1;">
                                        @csrf
                                        <button type="submit" class="btn-following">
                                            <i class="ri-user-unfollow-line"></i> Following
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('vendor.follow', $vendor->id) }}" method="POST" style="flex:1;">
                                        @csrf
                                        <button type="submit" class="btn-primary">
                                            <i class="ri-user-follow-line"></i> Follow
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary">
                                <i class="ri-user-follow-line"></i> Follow
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($vendors->hasPages())
        <div class="pagination">
            @if($vendors->onFirstPage())
                <span class="page-link disabled"><i class="ri-arrow-left-s-line"></i></span>
            @else
                <a href="{{ $vendors->previousPageUrl() }}" class="page-link next-prev"><i class="ri-arrow-left-s-line"></i> Prev</a>
            @endif

            @php
                $start = max(1, $vendors->currentPage() - 2);
                $end = min($vendors->lastPage(), $vendors->currentPage() + 2);
            @endphp

            @if($start > 1)
                <a href="{{ $vendors->url(1) }}" class="page-link">1</a>
                @if($start > 2)
                    <span class="page-link disabled">...</span>
                @endif
            @endif

            @for($i = $start; $i <= $end; $i++)
                <a href="{{ $vendors->url($i) }}" class="page-link {{ $i == $vendors->currentPage() ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            @if($end < $vendors->lastPage())
                @if($end < $vendors->lastPage() - 1)
                    <span class="page-link disabled">...</span>
                @endif
                <a href="{{ $vendors->url($vendors->lastPage()) }}" class="page-link">{{ $vendors->lastPage() }}</a>
            @endif

            @if($vendors->hasMorePages())
                <a href="{{ $vendors->nextPageUrl() }}" class="page-link next-prev">Next <i class="ri-arrow-right-s-line"></i></a>
            @else
                <span class="page-link disabled">Next <i class="ri-arrow-right-s-line"></i></span>
            @endif
        </div>
        @endif

        @else
        <div class="no-results">
            <i class="ri-store-3-line"></i>
            <h3>No vendors found</h3>
            <p>We couldn't find any vendors matching your search criteria. Try adjusting your filters or explore other categories.</p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('search.results') }}" class="btn-primary" style="padding: 12px 24px; font-size: 14px; width: auto;">
                    <i class="ri-filter-off-line"></i> Clear all filters
                </a>
                <a href="{{ route('register') }}" class="btn-outline" style="padding: 12px 24px; font-size: 14px; width: auto;">
                    <i class="ri-store-line"></i> Become a Vendor
                </a>
            </div>
        </div>
        @endif

    </main>

    <footer>
        <div class="container">
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('search.results') }}">Browse Vendors</a>
                <a href="{{ route('register') }}">Become a Vendor</a>
                <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                <a href="{{ route('terms.service') }}">Terms of Service</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Remove single filter
        function removeFilter(filterName) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        }

        // Clear all filters
        function clearAllFilters() {
            window.location.href = '{{ route("search.results") }}';
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Confirm logout (if logout button exists)
        document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Add to console for debugging
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            console.log('Search Results Page Loaded');
            console.log('Total Results:', {{ $vendors->total() }});
        }
    </script>

</body>
</html>