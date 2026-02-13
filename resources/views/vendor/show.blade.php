<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>{{ $vendor->business_name ?? $vendor->name }} - Vendor Profile | Vendora Jimma</title>
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
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #333333;
            --text-light: #777777;
            --white: #ffffff;
            --border-color: #e5e7eb;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --accent-green: #10b981;
            --accent-red: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-dark);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 28px;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }

        .logo i {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .btn-signup {
            background: var(--primary-gold);
            color: white !important;
            padding: 10px 24px;
            border-radius: 50px;
        }

        .btn-signup:hover {
            background: var(--primary-hover);
        }

        /* Ethiopian Badge */
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

        /* Main Container */
        .main-container {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary-gold);
        }

        /* Vendor Profile */
        .profile-header {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 32px;
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
            padding: 80px 40px 40px;
        }

        .profile-name-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .profile-name-section h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .profile-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-verified {
            background-color: #ecfdf5;
            color: var(--accent-green);
        }

        .badge-location {
            background-color: #fef3e7;
            color: var(--primary-gold);
        }

        .profile-stats {
            display: flex;
            gap: 32px;
            margin-bottom: 24px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-light);
        }

        .profile-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            padding: 24px;
            background-color: #f9fafb;
            border-radius: 12px;
            margin-bottom: 24px;
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
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .meta-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .profile-description {
            margin-bottom: 32px;
        }

        .profile-description h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .profile-description p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .profile-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
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

        .btn-outline {
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-color);
        }

        .btn-outline:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .btn-following {
            background-color: #fef3e7;
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
        }

        .btn-following:hover {
            background-color: #fee7d6;
        }

        /* Products Section */
        .products-section {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-header h2 {
            font-size: 24px;
            font-weight: 700;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-card {
            background: #f9fafb;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .product-image {
            height: 160px;
            background: linear-gradient(135deg, #e5e7eb, #d1d5db);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        .product-info {
            padding: 16px;
        }

        .product-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-price {
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-light);
        }

        /* Reviews Section */
        .reviews-section {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
        }

        .review-card {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .review-card:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .review-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .review-author h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .review-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .review-rating {
            display: flex;
            gap: 2px;
            color: var(--primary-gold);
        }

        .review-content {
            color: var(--text-light);
            line-height: 1.6;
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

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 16px 24px;
            }
            .nav-links {
                display: none;
            }
            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 32px;
                left: 20px;
            }
            .profile-info {
                padding: 60px 20px 20px;
            }
            .profile-name-section h1 {
                font-size: 28px;
            }
            .profile-stats {
                gap: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
            @guest
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link btn-signup">Sign Up</a>
            @else
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-link">Profile</a>
                @if(Auth::user()->role === 'vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
                @elseif(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">

        <!-- Back Link -->
        <a href="javascript:history.back()" class="back-link">
            <i class="ri-arrow-left-line"></i> Back to search results
        </a>

        <!-- Vendor Profile Header -->
        <div class="profile-header">
            <div class="profile-cover"></div>
            <div class="profile-avatar">
                {{ substr($vendor->business_name ?? $vendor->name, 0, 2) }}
            </div>

            <div class="profile-info">
                <div class="profile-name-section">
                    <div>
                        <h1>{{ $vendor->business_name ?? $vendor->name }}</h1>
                        <div class="profile-badges">
                            @if($vendor->email_verified_at)
                                <span class="badge badge-verified">
                                    <i class="ri-verified-badge-fill"></i> Verified Vendor
                                </span>
                            @endif
                            <span class="badge badge-location">
                                <i class="ri-map-pin-line"></i> {{ $vendor->city ?? 'Jimma' }}, {{ $vendor->state ?? 'Oromia' }}
                            </span>
                        </div>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $followersCount }}</div>
                            <div class="stat-label">Followers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $vendor->products_count ?? 0 }}</div>
                            <div class="stat-label">Products</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($vendor->rating ?? 4.5, 1) }}</div>
                            <div class="stat-label">Rating</div>
                        </div>
                    </div>
                </div>

                <div class="profile-meta">
                    @if($vendor->email)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Email</div>
                            <div class="meta-value">{{ $vendor->email }}</div>
                        </div>
                    </div>
                    @endif

                    @if($vendor->phone)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Phone</div>
                            <div class="meta-value">{{ $vendor->phone }}</div>
                        </div>
                    </div>
                    @endif

                    @if($vendor->website)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-global-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Website</div>
                            <div class="meta-value">
                                <a href="{{ $vendor->website }}" target="_blank" style="color: var(--primary-gold); text-decoration: none;">
                                    {{ str_replace(['https://', 'http://'], '', $vendor->website) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($vendor->category)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-price-tag-3-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Category</div>
                            <div class="meta-value">{{ ucfirst($vendor->category) }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($vendor->description)
                <div class="profile-description">
                    <h3>About {{ $vendor->business_name ?? 'the shop' }}</h3>
                    <p>{{ $vendor->description }}</p>
                </div>
                @endif

                <div class="profile-actions">
                    @auth
                        @if(Auth::id() !== $vendor->id)
                            @if($isFollowing)
                                <form action="{{ route('vendor.unfollow', $vendor->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-following">
                                        <i class="ri-user-unfollow-line"></i> Following
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('vendor.follow', $vendor->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-user-follow-line"></i> Follow Vendor
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="ri-user-follow-line"></i> Follow to get updates
                        </a>
                    @endauth

                    <button class="btn btn-outline" onclick="alert('Contact feature coming soon!')">
                        <i class="ri-message-3-line"></i> Contact Vendor
                    </button>
                </div>
            </div>
        </div>

       <!-- Products Section -->
<div class="products-section">
    <div class="section-header">
        <h2>Products by {{ $vendor->business_name ?? 'this vendor' }}</h2>
        <a href="#" class="btn btn-outline" style="padding: 8px 20px;">View All</a>
    </div>

    <div class="products-grid">
        @for($i = 1; $i <= min(4, $vendor->products_count ?? 4); $i++)
        <div class="product-card">
            <div class="product-image">
                <i class="ri-image-line" style="font-size: 32px;"></i>
            </div>
            <div class="product-info">
                <h4>Product {{ $i }}</h4>
                <div class="product-price">ETB {{ rand(100, 1000) }}</div>
                <div class="product-meta">
                    <span><i class="ri-star-fill" style="color: var(--primary-gold);"></i> 4.8</span>
                    <span>12 sold</span>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>  

        <!-- Reviews Section -->
        <div class="reviews-section">
            <div class="section-header">
                <h2>Customer Reviews</h2>
                <div class="profile-stats" style="gap: 8px;">
                    <span class="badge badge-verified"><i class="ri-star-fill"></i> {{ number_format($vendor->rating ?? 4.5, 1) }} average</span>
                    <span class="badge badge-location">12 reviews</span>
                </div>
            </div>

            <div class="reviews-list">
                @for($i = 1; $i <= 3; $i++)
                <div class="review-card">
                    <div class="review-header">
                        <div class="review-author">
                            <div class="review-avatar">JD</div>
                            <div>
                                <h4>John Doe</h4>
                                <div class="review-date">{{ now()->subDays($i * 5)->format('F j, Y') }}</div>
                            </div>
                        </div>
                        <div class="review-rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                    </div>
                    <div class="review-content">
                        <p>Great vendor! The products are high quality and delivery was fast. Would definitely recommend to others in Jimma.</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Confirm unfollow
        document.querySelectorAll('form[action*="unfollow"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to unfollow this vendor?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
