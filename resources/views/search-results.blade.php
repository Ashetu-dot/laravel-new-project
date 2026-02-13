<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora Marketplace - Search Results | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        /* Font Definitions */
        @font-face {
            font-family: 'MiSans-Regular';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Regular.ttf') format('truetype');
        }
        @font-face {
            font-family: 'MiSans-Medium';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Medium.ttf') format('truetype');
        }
        @font-face {
            font-family: 'MiSans-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Bold.ttf') format('truetype');
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7835;
            --bg-color: #F7F7F7;
            --white: #FFFFFF;
            --text-dark: #333333;
            --text-gray: #777777;
            --text-light: #999999;
            --border-color: #E5E5E5;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 20px rgba(184, 142, 63, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'MiSans-Regular', sans-serif;
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
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Helper Classes */
        .container {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            min-height: 80px;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow-sm);
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
            font-family: 'MiSans-Bold';
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
            border-radius: 24px;
            padding: 0 20px 0 50px;
            font-family: 'MiSans-Regular';
            font-size: 16px;
            color: var(--text-dark);
            background-color: #F9F9F9;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            font-size: 20px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .nav-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-btn:hover {
            background-color: #f0f0f0;
            color: var(--primary-gold);
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
        }

        .user-menu:hover {
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
            border-radius: 8px;
            background-color: var(--white);
            color: var(--text-dark);
            font-family: 'MiSans-Medium';
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
            color: var(--text-gray);
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
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-gold);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'MiSans-Medium';
            white-space: nowrap;
        }

        .filter-tag i {
            cursor: pointer;
        }

        .filter-tag i:hover {
            color: var(--primary-gold-hover);
        }

        .results-count {
            font-family: 'MiSans-Medium';
            color: var(--text-gray);
            font-size: 14px;
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
            gap: 32px;
            margin-bottom: 60px;
        }

        /* Vendor Card */
        .vendor-card {
            background-color: var(--white);
            border-radius: 12px;
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
            height: 220px;
            background-color: #f0f0f0;
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
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            z-index: 2;
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
            font-family: 'MiSans-Bold';
            font-size: 18px;
            color: var(--text-dark);
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            background-color: #FFF8E7;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-family: 'MiSans-Bold';
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
            border-top: 1px solid #f0f0f0;
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
        }

        .action-area {
            margin-top: 16px;
            display: flex;
            gap: 10px;
        }

        .btn-outline {
            flex: 1;
            height: 36px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: transparent;
            font-family: 'MiSans-Medium';
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-primary {
            flex: 1;
            height: 36px;
            border: none;
            border-radius: 6px;
            background: var(--primary-gold);
            font-family: 'MiSans-Medium';
            font-size: 13px;
            color: var(--white);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: var(--primary-gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(184, 142, 63, 0.3);
        }

        .btn-following {
            flex: 1;
            height: 36px;
            border: 1px solid var(--primary-gold);
            border-radius: 6px;
            background: #fef3e7;
            font-family: 'MiSans-Medium';
            font-size: 13px;
            color: var(--primary-gold);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
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
            border-radius: 16px;
            color: var(--text-gray);
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
        }

        .no-results p {
            font-size: 16px;
            margin-bottom: 24px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 60px 0 80px;
            flex-wrap: wrap;
        }

        .page-link {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: var(--white);
            color: var(--text-dark);
            font-family: 'MiSans-Medium';
            font-size: 16px;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid var(--border-color);
        }

        .page-link:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .page-link.active {
            background-color: var(--primary-gold);
            color: var(--white);
            border-color: var(--primary-gold);
        }

        .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .page-link.next-prev {
            width: auto;
            padding: 0 16px;
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 60px;
            color: var(--text-gray);
        }

        .loading .spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid #f3f4f6;
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 16px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
            gap: 24px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 13px;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive Design */
        @media screen and (max-width: 1400px) {
            .container { padding: 0 32px; }
            .grid-container { grid-template-columns: repeat(3, 1fr); gap: 28px; }
        }

        @media screen and (max-width: 1024px) {
            .container { padding: 0 24px; }
            .grid-container { grid-template-columns: repeat(3, 1fr); gap: 24px; }
            .search-container { max-width: 400px; }
        }

        @media screen and (max-width: 900px) {
            .grid-container { grid-template-columns: repeat(2, 1fr); }
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
                gap: 12px;
            }
            .filter-group {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 8px;
                -webkit-overflow-scrolling: touch;
            }
            .filter-btn { flex-shrink: 0; }
            .results-count { align-self: flex-end; }
        }

        @media screen and (max-width: 768px) {
            .container { padding: 0 20px; }
            .grid-container { gap: 20px; }
            .card-image-grid { height: 200px; }
            .card-content { padding: 16px; }
            .filters-section { margin-bottom: 30px; }
        }

        @media screen and (max-width: 640px) {
            .grid-container {
                grid-template-columns: repeat(1, 1fr);
                max-width: 450px;
                margin-left: auto;
                margin-right: auto;
            }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .search-input { height: 44px; font-size: 15px; }
            .ethiopia-badge { font-size: 10px; padding: 2px 8px; }
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
                gap: 12px;
            }
            .nav-btn { width: 36px; height: 36px; font-size: 22px; }
            .user-avatar { width: 36px; height: 36px; }
            .search-container { margin-top: 4px; }
            .filter-group { gap: 8px; }
            .filter-btn { padding: 0 16px; font-size: 13px; height: 40px; }
            .filter-tag { font-size: 12px; padding: 4px 10px; }
            .results-count { font-size: 13px; }
            .page-link { width: 38px; height: 38px; font-size: 14px; }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 20px; }
            .logo i { font-size: 24px; }
            .nav-btn { width: 32px; height: 32px; font-size: 20px; }
            .user-avatar { width: 32px; height: 32px; }
            .search-input { height: 40px; font-size: 14px; padding-left: 44px; }
            .search-icon { left: 14px; font-size: 18px; }
            .card-image-grid { height: 180px; }
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
                    <input type="text" name="query" class="search-input" placeholder="Search for vendors, products, or categories in Jimma..." value="{{ request('query', $query ?? '') }}">
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
                    <a href="#" class="nav-btn" aria-label="Notifications">
                        <i class="ri-notification-3-line"></i>
                    </a>
                    <a href="#" class="nav-btn" aria-label="Cart">
                        <i class="ri-shopping-bag-3-line"></i>
                    </a>
                    <a href="{{ route('profile.show', Auth::id()) }}" class="user-menu">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=B88E3F&color=fff' }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                        <span class="nav-item" style="display: none;">{{ Auth::user()->name }}</span>
                    </a>
                @endguest
                <button class="nav-btn" aria-label="Menu" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Filters -->
    <section class="filters-section">
        <div class="container filters-wrapper">
            <div class="filter-group">
                <form action="{{ route('search.results') }}" method="GET" id="filterForm" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    @if(request('query'))
                        <input type="hidden" name="query" value="{{ request('query') }}">
                    @endif

                    <select name="location" class="filter-btn" onchange="this.form.submit()" style="appearance: none; padding-right: 36px;">
                        <option value="">📍 Location: All</option>
                        <option value="Jimma" {{ request('location') == 'Jimma' ? 'selected' : '' }}>📍 Jimma</option>
                        <option value="Addis Ababa" {{ request('location') == 'Addis Ababa' ? 'selected' : '' }}>📍 Addis Ababa</option>
                        <option value="Bahir Dar" {{ request('location') == 'Bahir Dar' ? 'selected' : '' }}>📍 Bahir Dar</option>
                        <option value="Hawassa" {{ request('location') == 'Hawassa' ? 'selected' : '' }}>📍 Hawassa</option>
                    </select>

                    <select name="category" class="filter-btn" onchange="this.form.submit()" style="appearance: none; padding-right: 36px;">
                        <option value="">🏷️ Category: All</option>
                        <option value="coffee" {{ request('category') == 'coffee' ? 'selected' : '' }}>☕ Coffee & Tea</option>
                        <option value="handicrafts" {{ request('category') == 'handicrafts' ? 'selected' : '' }}>🎨 Handicrafts</option>
                        <option value="textiles" {{ request('category') == 'textiles' ? 'selected' : '' }}>🧵 Textiles</option>
                        <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>🍲 Food & Spices</option>
                        <option value="jewelry" {{ request('category') == 'jewelry' ? 'selected' : '' }}>💍 Jewelry</option>
                        <option value="services" {{ request('category') == 'services' ? 'selected' : '' }}>🛠️ Services</option>
                    </select>

                    <select name="rating" class="filter-btn" onchange="this.form.submit()" style="appearance: none; padding-right: 36px;">
                        <option value="">⭐ Rating: Any</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ 4+ Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ 3+ Stars</option>
                    </select>

                    <button type="button" class="filter-btn" onclick="document.getElementById('filterForm').reset(); window.location='{{ route('search.results') }}'">
                        <i class="ri-filter-off-line"></i> Clear
                    </button>
                </form>

                @if(request('category'))
                    <div class="filter-tag">
                        {{ ucfirst(request('category')) }}
                        <i class="ri-close-line" onclick="window.location='{{ route('search.results', array_merge(request()->except('category'), ['query' => request('query')])) }}'"></i>
                    </div>
                @endif
                @if(request('location'))
                    <div class="filter-tag">
                        {{ request('location') }}
                        <i class="ri-close-line" onclick="window.location='{{ route('search.results', array_merge(request()->except('location'), ['query' => request('query')])) }}'"></i>
                    </div>
                @endif
                @if(request('rating'))
                    <div class="filter-tag">
                        {{ request('rating') }}+ Stars
                        <i class="ri-close-line" onclick="window.location='{{ route('search.results', array_merge(request()->except('rating'), ['query' => request('query')])) }}'"></i>
                    </div>
                @endif
            </div>

            <span class="results-count">Showing {{ $vendors->firstItem() ?? 0 }} - {{ $vendors->lastItem() ?? 0 }} of {{ $vendors->total() }} results</span>
        </div>
    </section>

    <!-- Active Filters Bar (if any filters applied) -->
    @if(request('query') || request('category') || request('location') || request('rating'))
    <div class="active-filters">
        <div class="container">
            <span style="font-size: 14px; color: var(--text-gray);">Active filters:</span>
            @if(request('query'))
                <span class="filter-tag">Search: "{{ request('query') }}"</span>
            @endif
            @if(request('category'))
                <span class="filter-tag">Category: {{ ucfirst(request('category')) }}</span>
            @endif
            @if(request('location'))
                <span class="filter-tag">Location: {{ request('location') }}</span>
            @endif
            @if(request('rating'))
                <span class="filter-tag">{{ request('rating') }}+ Stars</span>
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
                    <img src="{{ $vendor->main_image ?? 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" alt="{{ $vendor->business_name }}" class="card-img-main">
                    <img src="{{ $vendor->sub_image_1 ?? 'https://images.unsplash.com/photo-1565193566173-7a646c770962?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" alt="{{ $vendor->business_name }} detail 1" class="card-img-sub">
                    <img src="{{ $vendor->sub_image_2 ?? 'https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" alt="{{ $vendor->business_name }} detail 2" class="card-img-sub">
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
                            <span>{{ $vendor->products_count ?? rand(5, 50) }} Products</span>
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
        <div class="pagination">
            @if($vendors->onFirstPage())
                <span class="page-link disabled"><i class="ri-arrow-left-s-line"></i></span>
            @else
                <a href="{{ $vendors->previousPageUrl() }}" class="page-link next-prev"><i class="ri-arrow-left-s-line"></i> Prev</a>
            @endif

            @foreach(range(1, $vendors->lastPage()) as $i)
                @if($i >= $vendors->currentPage() - 2 && $i <= $vendors->currentPage() + 2)
                    <a href="{{ $vendors->url($i) }}" class="page-link {{ $i == $vendors->currentPage() ? 'active' : '' }}">{{ $i }}</a>
                @endif
            @endforeach

            @if($vendors->hasMorePages())
                <a href="{{ $vendors->nextPageUrl() }}" class="page-link next-prev">Next <i class="ri-arrow-right-s-line"></i></a>
            @else
                <span class="page-link disabled">Next <i class="ri-arrow-right-s-line"></i></span>
            @endif
        </div>

        @else
        <div class="no-results">
            <i class="ri-store-3-line"></i>
            <h3>No vendors found in Jimma</h3>
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
            </div>
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            alert('Mobile menu would open here. In production, this would show navigation links.');
        });

        // Auto-dismiss alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Preserve query params when changing filters
        function updateFilters(param, value) {
            const url = new URL(window.location.href);
            if (value) {
                url.searchParams.set(param, value);
            } else {
                url.searchParams.delete(param);
            }
            window.location.href = url.toString();
        }
    </script>

</body>
</html>
