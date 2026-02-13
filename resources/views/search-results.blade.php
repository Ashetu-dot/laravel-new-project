<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora Marketplace - Search Results</title>
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
            transition: background-color 0.2s;
        }

        .nav-btn:hover {
            background-color: #f0f0f0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-gold);
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

        .results-count {
            font-family: 'MiSans-Medium';
            color: var(--text-gray);
            font-size: 14px;
            white-space: nowrap;
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid transparent;
        }

        .vendor-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(184, 142, 63, 0.2);
        }

        .card-image-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 2px;
            height: 220px;
            background-color: #f0f0f0;
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
            border-color: var(--text-dark);
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
        }

        .btn-primary:hover {
            background: var(--primary-gold-hover);
        }

        /* Empty State */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 12px;
            color: var(--text-gray);
        }

        .no-results i {
            font-size: 48px;
            color: var(--primary-gold);
            margin-bottom: 16px;
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 8px;
            color: var(--text-dark);
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

        /* Footer Simple */
        footer {
            background-color: var(--white);
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-gray);
            font-size: 14px;
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
            .filters-wrapper { flex-direction: column; align-items: flex-start; }
            .filter-group { width: 100%; overflow-x: auto; padding-bottom: 8px; }
            .filter-btn { flex-shrink: 0; }
        }

        @media screen and (max-width: 768px) {
            .container { padding: 0 20px; }
            .grid-container { gap: 20px; }
            .card-image-grid { height: 200px; }
            .card-content { padding: 16px; }
        }

        @media screen and (max-width: 640px) {
            .grid-container { grid-template-columns: repeat(1, 1fr); max-width: 450px; margin-left: auto; margin-right: auto; }
            .logo { font-size: 24px; }
            .search-input { height: 44px; }
        }

        @media screen and (max-width: 480px) {
            .nav-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .logo { grid-column: 1; justify-self: center; }
            .nav-actions { grid-column: 1; justify-self: center; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="logo">
                <i class="ri-store-3-fill"></i>
                Vendora
            </a>

            <div class="search-container">
                <i class="ri-search-line search-icon"></i>
                <form action="{{ route('search.results') }}" method="GET" style="width: 100%;">
                    <input type="text" name="query" class="search-input" placeholder="Search for vendors, products, or categories..." value="{{ request('query', $query ?? '') }}">
                </form>
            </div>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="nav-btn" aria-label="Login">
                        <i class="ri-user-line"></i>
                    </a>
                    <a href="{{ route('register') }}" class="nav-btn" aria-label="Sign Up" style="background: var(--primary-gold); color: white;">
                        <i class="ri-user-add-line"></i>
                    </a>
                @else
                    <button class="nav-btn" aria-label="Notifications">
                        <i class="ri-notification-3-line"></i>
                    </button>
                    <button class="nav-btn" aria-label="Cart">
                        <i class="ri-shopping-bag-3-line"></i>
                    </button>
                    <a href="{{ route('profile.show', Auth::id()) }}">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80' }}" alt="User" class="user-avatar">
                    </a>
                @endguest
                <button class="nav-btn" aria-label="Menu">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Filters -->
    <section class="filters-section">
        <div class="container filters-wrapper">
            <div class="filter-group">
                <button class="filter-btn">
                    <i class="ri-map-pin-line"></i>
                    Location
                    <i class="ri-arrow-down-s-line"></i>
                </button>
                <button class="filter-btn">
                    <i class="ri-price-tag-3-line"></i>
                    Category
                    <i class="ri-arrow-down-s-line"></i>
                </button>
                <button class="filter-btn">
                    <i class="ri-money-dollar-circle-line"></i>
                    Price Range
                    <i class="ri-arrow-down-s-line"></i>
                </button>
                <button class="filter-btn">
                    <i class="ri-filter-3-line"></i>
                    More Filters
                </button>

                @if(request('category'))
                    <div class="filter-tag">
                        {{ request('category') }} <i class="ri-close-line" onclick="window.location='{{ route('search.results', array_merge(request()->except('category'), ['query' => request('query')])) }}'"></i>
                    </div>
                @endif
                @if(request('location'))
                    <div class="filter-tag">
                        {{ request('location') }} <i class="ri-close-line" onclick="window.location='{{ route('search.results', array_merge(request()->except('location'), ['query' => request('query')])) }}'"></i>
                    </div>
                @endif
            </div>

            <span class="results-count">Showing {{ $totalResults ?? $vendors->total() }} results</span>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container">

        <div class="grid-container">
            @forelse($vendors as $vendor)
            <div class="vendor-card">
                <div class="card-image-grid">
                    <img src="{{ $vendor->main_image ?? 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" alt="{{ $vendor->business_name }}" class="card-img-main">
                    <img src="{{ $vendor->sub_image_1 ?? 'https://images.unsplash.com/photo-1565193566173-7a646c770962?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" alt="{{ $vendor->business_name }} detail 1" class="card-img-sub">
                    <img src="{{ $vendor->sub_image_2 ?? 'https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" alt="{{ $vendor->business_name }} detail 2" class="card-img-sub">
                </div>
                <div class="card-content">
                    <div class="vendor-header">
                        <h3 class="vendor-name">{{ $vendor->business_name ?? $vendor->name }}</h3>
                        <div class="vendor-rating">
                            <i class="ri-star-fill"></i> {{ number_format($vendor->rating, 1) }}
                        </div>
                    </div>
                    <span class="vendor-category">{{ $vendor->category ?? 'General' }}</span>
                    <div class="vendor-meta">
                        <div class="meta-item">
                            <i class="ri-map-pin-2-line"></i>
                            <span>{{ $vendor->city ?? 'City' }}, {{ $vendor->state ?? 'State' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-box-3-line"></i>
                            <span>{{ $vendor->products_count ?? 0 }} Products</span>
                        </div>
                    </div>
                     <div class="action-area">
                        <a href="{{ route('vendor.show', $vendor->id) }}" class="btn-outline">View Shop</a>
                        @auth
                            @if(Auth::id() !== $vendor->id)
                                <form action="{{ route('vendor.follow', $vendor->id) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="btn-primary">Follow</button>
                                </form>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">Follow</a>
                        @endguest
                    </div>
                </div>
            </div>
            @empty
            <div class="no-results">
                <i class="ri-store-3-line"></i>
                <h3>No vendors found</h3>
                <p>Try adjusting your search or filter criteria</p>
                <a href="{{ route('search.results') }}" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: var(--primary-gold); color: white; text-decoration: none; border-radius: 8px;">Clear all filters</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $vendors->links() }}
        </div>

    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
