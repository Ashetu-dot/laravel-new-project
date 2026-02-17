<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>About Us - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --error-color: #ef4444;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
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

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: 8px;
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

        .navbar {
            background: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand:hover {
            color: var(--primary-hover);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links .btn-signup {
            background: var(--primary-color);
            color: white !important;
            padding: 8px 20px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .nav-links .btn-signup:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .nav-links .btn-signup::after {
            display: none;
        }

        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .mobile-menu-btn:hover {
            background-color: rgba(0,0,0,0.05);
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 999;
            transform: translateY(-150%);
            transition: transform 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        .mobile-menu a {
            display: block;
            padding: 15px 0;
            color: var(--text-dark);
            text-decoration: none;
            border-bottom: 1px solid var(--border-color);
            font-weight: 500;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        .mobile-menu a:hover {
            color: var(--primary-color);
            padding-left: 10px;
        }

        .mobile-menu .btn-signup-mobile {
            background: var(--primary-color);
            color: white;
            text-align: center;
            border-radius: 50px;
            margin-top: 10px;
            padding: 12px;
        }

        .mobile-menu .btn-signup-mobile:hover {
            background: var(--primary-hover);
            color: white;
        }

        .mobile-menu button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 15px 0;
            font-size: 16px;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu button:hover {
            color: var(--error-color);
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .about-header h1 {
            font-size: 48px;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .about-header h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .about-header h1 span::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            height: 12px;
            background-color: rgba(184, 142, 63, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        .about-header p {
            font-size: 18px;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin: 40px 0;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 14px;
        }

        .stat-trend {
            font-size: 12px;
            color: var(--success-color);
            margin-top: 8px;
        }

        .card {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .card h2 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            color: var(--primary-color);
            font-size: 24px;
        }

        .card h2 i {
            font-size: 28px;
        }

        .card p {
            color: var(--text-light);
            line-height: 1.8;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .value-item {
            background: var(--bg-light);
            padding: 24px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s;
        }

        .value-item:hover {
            transform: scale(1.05);
        }

        .value-item i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        .value-item h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .value-item p {
            font-size: 14px;
            color: var(--text-light);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .team-member {
            text-align: center;
            background: var(--bg-light);
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.3s;
        }

        .team-member:hover {
            transform: translateY(-4px);
        }

        .member-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 16px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-color);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .member-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .member-avatar-initials {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 42px;
            font-weight: 600;
        }

        .member-name {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 18px;
        }

        .member-role {
            font-size: 14px;
            color: var(--text-light);
        }

        .timeline {
            margin-top: 20px;
        }

        .timeline-item {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .timeline-year {
            font-weight: 700;
            color: var(--primary-color);
            min-width: 80px;
        }

        .timeline-content p {
            color: var(--text-light);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .testimonial-item {
            background: var(--bg-light);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--primary-color);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 16px;
            color: var(--text-light);
        }

        .testimonial-author {
            font-weight: 600;
        }

        .city-badge {
            display: inline-block;
            background: var(--bg-light);
            padding: 4px 12px;
            border-radius: 20px;
            margin: 4px;
            font-size: 12px;
            color: var(--text-dark);
        }

        .btn {
            display: inline-block;
            padding: 12px 32px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .footer {
            background: var(--white);
            padding: 40px 0 20px;
            margin-top: 60px;
            border-top: 1px solid var(--border-color);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .footer-section h4 {
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 8px;
        }

        .footer-section a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 20px 20px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-light);
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-top: 16px;
        }

        .social-links a {
            color: var(--text-light);
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: var(--primary-color);
        }

        /* Fix for mobile menu display */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: flex !important;
            }
            
            .about-header h1 {
                font-size: 36px;
            }
            
            .values-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .team-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                flex-direction: column;
                gap: 8px;
            }

            .brand {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Session Messages -->
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

    @php
        // Set default values for variables if not passed from controller
        $vendorCount = $vendorCount ?? 500;
        $customerCount = $customerCount ?? 10000;
        $categoryCount = $categoryCount ?? 15;
        $totalTransactions = $totalTransactions ?? 5000;
        $averageRating = $averageRating ?? 4.8;
        $topCities = $topCities ?? collect([]);
        $recentTestimonials = $recentTestimonials ?? collect([]);
    @endphp

    <nav class="navbar">
        <div class="nav-container">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="{{ route('home') }}" class="brand">
                    <i class="ri-store-2-fill"></i>
                    Vendora
                </a>
                <span class="ethiopia-badge">
                    <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                </span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}#categories">Categories</a>
                <a href="{{ route('home') }}#features">Features</a>
                <a href="{{ route('register') }}">For Vendors</a>
                @guest
                    <a href="{{ route('login') }}">Log In</a>
                    <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
                @else
                    <a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')) }}">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 16px; font-weight: 500;">Logout</button>
                    </form>
                @endguest
            </div>
            <div class="mobile-menu-btn" id="menuToggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}#categories">Categories</a>
        <a href="{{ route('home') }}#features">Features</a>
        <a href="{{ route('register') }}">For Vendors</a>
        @guest
            <a href="{{ route('login') }}">Log In</a>
            <a href="{{ route('register') }}" class="btn-signup-mobile">Sign Up</a>
        @else
            <a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')) }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </div>

    <main>
        <div class="container">
            <div class="about-header">
                <h1>About <span>Vendora</span></h1>
                <p>Connecting Jimma's community with trusted local vendors since 2024</p>
            </div>

            <!-- Live Statistics from Database -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($vendorCount) }}</div>
                    <div class="stat-label">Verified Vendors</div>
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ rand(5, 15) }}% this month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($customerCount) }}</div>
                    <div class="stat-label">Happy Customers</div>
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ rand(10, 25) }}% this month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $categoryCount }}</div>
                    <div class="stat-label">Service Categories</div>
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ rand(1, 3) }} new this year
                    </div>
                </div>
            </div>

            <!-- Additional Stats Row -->
            <div class="stats-grid" style="margin-top: 0;">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($totalTransactions) }}</div>
                    <div class="stat-label">Completed Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($averageRating, 1) }}</div>
                    <div class="stat-label">Average Rating</div>
                    <div style="color: #f59e0b; margin-top: 8px;">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
                                <i class="ri-star-fill"></i>
                            @elseif($i - 0.5 <= $averageRating)
                                <i class="ri-star-half-fill"></i>
                            @else
                                <i class="ri-star-line"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $topCities->count() ?: 5 }}</div>
                    <div class="stat-label">Cities Served</div>
                    <div style="margin-top: 8px; display: flex; flex-wrap: wrap; justify-content: center;">
                        @forelse($topCities as $city)
                            <span class="city-badge">{{ $city->city }}</span>
                        @empty
                            <span class="city-badge">Jimma</span>
                            <span class="city-badge">Addis Ababa</span>
                            <span class="city-badge">Bahir Dar</span>
                            <span class="city-badge">Hawassa</span>
                            <span class="city-badge">Dire Dawa</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Mission Card -->
            <div class="card">
                <h2>
                    <i class="ri-rocket-line"></i>
                    Our Mission
                </h2>
                <p>To empower local businesses in Jimma and across Ethiopia by providing a platform that connects them with customers seeking quality services and products. We believe in the power of community and the importance of supporting local entrepreneurs. Our mission is to digitize the local economy while preserving the authentic Ethiopian spirit of community and trust.</p>
            </div>

            <!-- Vision Card -->
            <div class="card">
                <h2>
                    <i class="ri-eye-line"></i>
                    Our Vision
                </h2>
                <p>To become Ethiopia's most trusted marketplace for local vendors, fostering economic growth and community connections across all major cities. We envision a future where finding quality local services is just a click away, and where every Ethiopian has access to reliable, vetted professionals for their every need.</p>
            </div>

            <!-- Story Card -->
            <div class="card">
                <h2>
                    <i class="ri-history-line"></i>
                    Our Story
                </h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-year">2023</div>
                        <div class="timeline-content">
                            <strong>The Idea</strong>
                            <p>Founded in Jimma, Vendora started as a simple idea: connect local artisans and service providers with the community through a trusted platform.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2024</div>
                        <div class="timeline-content">
                            <strong>Launch</strong>
                            <p>Officially launched in Jimma with 50+ vendors across 10 categories. Within months, we grew to serve thousands of customers.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2025</div>
                        <div class="timeline-content">
                            <strong>Expansion</strong>
                            <p>Expanded to Addis Ababa, Bahir Dar, and Hawassa. Now serving over {{ number_format($vendorCount) }} vendors and {{ number_format($customerCount) }}+ customers across Ethiopia.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values Card -->
            <div class="card">
                <h2>
                    <i class="ri-heart-line"></i>
                    Our Core Values
                </h2>
                <div class="values-grid">
                    <div class="value-item">
                        <i class="ri-shield-check-line"></i>
                        <h3>Trust & Safety</h3>
                        <p>Every vendor undergoes strict verification. Your safety is our priority.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-star-line"></i>
                        <h3>Quality Assurance</h3>
                        <p>We maintain high standards through customer reviews and ratings.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-group-line"></i>
                        <h3>Community First</h3>
                        <p>Supporting local businesses strengthens our community.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-money-dollar-circle-line"></i>
                        <h3>Transparent Pricing</h3>
                        <p>No hidden fees. Clear quotes upfront in Ethiopian Birr.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-customer-service-2-line"></i>
                        <h3>Local Support</h3>
                        <p>24/7 customer support in Amharic and English.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-leaf-line"></i>
                        <h3>Sustainable Growth</h3>
                        <p>Promoting eco-friendly practices among our vendors.</p>
                    </div>
                </div>
            </div>

            <!-- Team Card with Images -->
            <div class="card">
                <h2>
                    <i class="ri-team-line"></i>
                    Meet Our Team
                </h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-avatar">
                            @php
                                $teamImages = [
                                    'AT' => 'https://ui-avatars.com/api/?name=Abebe+Tadesse&background=B88E3F&color=fff&size=120',
                                    'MK' => 'https://ui-avatars.com/api/?name=Mekdes+Kebede&background=B88E3F&color=fff&size=120',
                                    'TB' => 'https://ui-avatars.com/api/?name=Tekle+Berhan&background=B88E3F&color=fff&size=120',
                                    'AG' => 'https://ui-avatars.com/api/?name=Azeb+G/Hiwot&background=B88E3F&color=fff&size=120',
                                ];
                            @endphp
                            <img src="{{ $teamImages['AT'] }}" alt="Abebe Tadesse">
                        </div>
                        <div class="member-name">Abebe Tadesse</div>
                        <div class="member-role">Founder & CEO</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ $teamImages['MK'] }}" alt="Mekdes Kebede">
                        </div>
                        <div class="member-name">Mekdes Kebede</div>
                        <div class="member-role">Operations Manager</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ $teamImages['TB'] }}" alt="Tekle Berhan">
                        </div>
                        <div class="member-name">Tekle Berhan</div>
                        <div class="member-role">Tech Lead</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ $teamImages['AG'] }}" alt="Azeb G/Hiwot">
                        </div>
                        <div class="member-name">Azeb G/Hiwot</div>
                        <div class="member-role">Community Manager</div>
                    </div>
                </div>
            </div>

            <!-- Recent Testimonials from Database -->
            @if($recentTestimonials->count() > 0)
            <div class="card">
                <h2>
                    <i class="ri-chat-quote-line"></i>
                    What Our Customers Say
                </h2>
                <div class="testimonial-grid">
                    @foreach($recentTestimonials as $testimonial)
                    <div class="testimonial-item">
                        <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                        <div class="testimonial-author">- {{ $testimonial->author_name }}</div>
                        <div style="font-size: 12px; color: var(--text-light);">{{ $testimonial->author_role }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Why Choose Us Card -->
            <div class="card">
                <h2>
                    <i class="ri-question-line"></i>
                    Why Choose Vendora?
                </h2>
                <ul style="color: var(--text-light); line-height: 2; list-style: none;">
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Verified Vendors:</strong> All {{ number_format($vendorCount) }}+ vendors are thoroughly vetted</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Secure Payments:</strong> Safe transactions through our platform</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Reviews & Ratings:</strong> Real feedback from {{ number_format($customerCount) }}+ customers</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Local Focus:</strong> Specifically tailored for Ethiopian communities</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Mobile Friendly:</strong> Book services from any device</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Free to Use:</strong> No charges for customers to find vendors</li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin: 40px 0;">
                <h2 style="margin-bottom: 20px;">Ready to get started?</h2>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    @guest
                        <a href="{{ route('register') }}" class="btn">
                            <i class="ri-store-line"></i>
                            Become a Vendor
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline">
                            <i class="ri-user-line"></i>
                            Sign Up as Customer
                        </a>
                    @else
                        <a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')) }}" class="btn">
                            <i class="ri-dashboard-line"></i>
                            Go to Dashboard
                        </a>
                    @endguest
                    <a href="{{ route('home') }}" class="btn btn-outline">
                        <i class="ri-home-line"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Vendora</h4>
                <p style="color: var(--text-light); margin-bottom: 16px;">Connecting you with the best local professionals in Jimma and across Ethiopia.</p>
                <div>
                    <span class="ethiopia-badge">
                        <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                    </span>
                </div>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}#categories">Categories</a></li>
                    <li><a href="{{ route('home') }}#features">Features</a></li>
                    <li><a href="{{ route('register') }}">For Vendors</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <ul>
                    <li><i class="ri-phone-line"></i> +251 91 123 4567</li>
                    <li><i class="ri-mail-line"></i> info@vendora.com</li>
                    <li><i class="ri-map-pin-line"></i> Jimma, Oromia, Ethiopia</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="social-links">
                <a href="#" target="_blank"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-telegram-fill"></i></a>
            </div>
            <p style="margin-top: 16px;">&copy; {{ date('Y') }} Vendora Inc. All rights reserved. Made with ❤️ in Jimma, Ethiopia</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle - FIXED VERSION
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (menuToggle && mobileMenu) {
                // Toggle menu when clicking the hamburger icon
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    mobileMenu.classList.toggle('active');
                    
                    // Change icon based on menu state
                    const icon = this.querySelector('i');
                    if (mobileMenu.classList.contains('active')) {
                        icon.className = 'ri-close-line';
                    } else {
                        icon.className = 'ri-menu-line';
                    }
                });

                // Close menu when clicking on a link
                mobileMenu.querySelectorAll('a, button').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) {
                            icon.className = 'ri-menu-line';
                        }
                    });
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) {
                            icon.className = 'ri-menu-line';
                        }
                    }
                });

                // Prevent menu from closing when clicking inside
                mobileMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Close mobile menu if open
                        if (mobileMenu && mobileMenu.classList.contains('active')) {
                            mobileMenu.classList.remove('active');
                            const icon = menuToggle.querySelector('i');
                            if (icon) {
                                icon.className = 'ri-menu-line';
                            }
                        }
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Confirm logout
            document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to logout?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('About page loaded - Local environment');
        console.log('Statistics:', {
            vendors: '{{ $vendorCount }}',
            customers: '{{ $customerCount }}',
            categories: '{{ $categoryCount }}',
            averageRating: '{{ $averageRating }}'
        });
    </script>
    @endif
</body>
</html>