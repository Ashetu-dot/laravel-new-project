<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Local Vendor Finder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        /* ----- FONTS (unchanged) ----- */
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
        @font-face {
            font-family: 'AlibabaSans';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/AlibabaSans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        /* ----- ROOT VARIABLES (unchanged) ----- */
        :root {
            --primary-color: #B88E3F;
            --text-dark: #333333;
            --text-light: #777777;
            --bg-light: #F7F7F7;
            --white: #FFFFFF;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'NotoSansHans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            width: 100%;                /* responsive full width */
            max-width: 1920px;         /* keeps original max size */
            margin: 0 auto;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ---- ORIGINAL STYLES (kept exactly) ---- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 80px;
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
            letter-spacing: -0.5px;
            font-family: 'AlibabaSans', sans-serif;
        }

        .brand i {
            font-size: 28px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-item {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .nav-item:hover {
            color: var(--primary-color);
        }

        .menu-btn {
            display: none; 
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 80px;
            text-align: center;
            background: linear-gradient(180deg, rgba(184, 142, 63, 0.05) 0%, rgba(247, 247, 247, 0) 100%);
        }

        .hero-headline {
            font-size: 64px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 24px;
            color: var(--text-dark);
            max-width: 900px;
            letter-spacing: -1.5px;
        }

        .hero-headline span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }
        
        .hero-headline span::after {
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

        .hero-subtext {
            font-size: 20px;
            color: var(--text-light);
            margin-bottom: 60px;
            max-width: 600px;
            line-height: 1.6;
        }

        .search-container {
            background: var(--white);
            padding: 16px;
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 960px;
            border: 1px solid rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(184, 142, 63, 0.15);
        }

        .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-right: 1px solid #E5E5E5;
            position: relative;
        }

        .input-group:last-of-type {
            border-right: none;
        }

        .input-group i {
            font-size: 22px;
            color: var(--primary-color);
            margin-right: 16px;
        }

        .input-content {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .input-field {
            border: none;
            outline: none;
            font-size: 16px;
            color: var(--text-light);
            background: transparent;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .input-field::placeholder {
            color: #AAAAAA;
        }

        .search-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 16px;
            flex-shrink: 0;
        }

        .search-btn:hover {
            background-color: #9A7633;
        }

        .search-btn i {
            font-size: 24px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .feature-card {
            background: var(--white);
            padding: 40px 32px;
            border-radius: 24px;
            text-align: left;
            transition: transform 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background-color: rgba(184, 142, 63, 0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-size: 24px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .feature-desc {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.6;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }

        .circle-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(184,142,63,0.08) 0%, rgba(255,255,255,0) 70%);
            top: -200px;
            right: -100px;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(184,142,63,0.06) 0%, rgba(255,255,255,0) 70%);
            bottom: 0;
            left: -100px;
        }

        .categories-wrapper {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: var(--white);
            padding: 30px 10px;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .category-item:hover {
            border-color: var(--primary-color);
            background: #FFFDF8;
        }

        .cat-icon {
            font-size: 32px;
            color: var(--text-dark);
            margin-bottom: 12px;
            transition: color 0.3s;
        }

        .category-item:hover .cat-icon {
            color: var(--primary-color);
        }

        .cat-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        footer {
            background-color: var(--white);
            border-top: 1px solid #EEEEEE;
            padding: 60px 80px 40px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
        }

        .footer-brand h2 {
            font-family: 'AlibabaSans', sans-serif;
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-text {
            color: var(--text-light);
            max-width: 300px;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            gap: 80px;
        }

        .link-group h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--text-dark);
        }

        .link-group ul {
            list-style: none;
        }

        .link-group li {
            margin-bottom: 12px;
        }

        .link-group a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 14px;
            transition: color 0.2s;
        }

        .link-group a:hover {
            color: var(--primary-color);
        }

        .bottom-bar {
            border-top: 1px solid #EEEEEE;
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #999;
            font-size: 13px;
        }

        .social-icons {
            display: flex;
            gap: 16px;
        }
        .social-icons i {
            font-size: 18px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .social-icons i:hover {
            color: var(--primary-color);
        }

        /* ========== RESPONSIVE FIXES (your full original media queries) ========== */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 20px 40px; }
            .hero-headline { font-size: 56px; }
            .categories-wrapper { padding: 0 30px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 18px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }
            .hero-headline { font-size: 48px; max-width: 700px; }
            .hero-subtext { font-size: 18px; }
            .search-container { max-width: 800px; }
            .features { gap: 24px; padding: 0 30px; }
            .categories-grid { grid-template-columns: repeat(3, 1fr); gap: 18px; }
            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .search-container { 
                flex-direction: column; 
                border-radius: 40px; 
                padding: 24px; 
                max-width: 550px; 
            }
            .input-group {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #E5E5E5;
                padding: 12px 16px;
            }
            .input-group:last-of-type { border-bottom: none; }
            .search-btn {
                margin-left: 0;
                margin-top: 16px;
                width: 60px;
                height: 60px;
            }
            .search-btn i { font-size: 22px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: block; }
            .hero { padding: 80px 20px 60px; }
            .hero-headline { font-size: 40px; letter-spacing: -1px; }
            .hero-headline span::after { height: 10px; bottom: 4px; }
            .hero-subtext { font-size: 16px; max-width: 480px; margin-bottom: 40px; }
            .features { grid-template-columns: 1fr; gap: 20px; margin: 50px auto; max-width: 550px; }
            .categories-wrapper { padding: 0 24px; margin-bottom: 60px; }
            .section-title { font-size: 28px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            .footer-brand .footer-text { max-width: 100%; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; gap: 8px; }
            .brand i { font-size: 24px; }
            .hero-headline { font-size: 34px; }
            .hero-subtext { font-size: 15px; }
            .search-container { border-radius: 32px; padding: 20px; }
            .input-group i { font-size: 20px; margin-right: 12px; }
            .input-field { font-size: 15px; }
            .categories-wrapper { padding: 0 20px; }
            .section-header { flex-wrap: wrap; gap: 10px; }
            .section-title { font-size: 26px; }
            .feature-card { padding: 30px 24px; }
            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }

        @media screen and (max-width: 480px) {
            .hero-headline { font-size: 28px; }
            .hero-headline span::after { height: 8px; bottom: 2px; }
            .hero { padding: 60px 16px 40px; }
            .search-container { padding: 18px; }
            .input-group { padding: 8px 0px; }
            .input-label { font-size: 11px; }
            .section-title { font-size: 24px; }
            .categories-grid { gap: 12px; }
            .category-item { padding: 20px 8px; }
            .cat-icon { font-size: 28px; }
            .feature-icon { width: 48px; height: 48px; font-size: 22px; }
            .feature-title { font-size: 18px; }
            footer { padding: 40px 20px 20px; }
            .link-group h4 { margin-bottom: 16px; }
        }

        @media screen and (max-width: 360px) {
            .hero-headline { font-size: 26px; }
            .brand { font-size: 18px; }
        }

        @media screen and (max-width: 768px) {
            .circle-1 { width: 400px; height: 400px; top: -100px; right: -150px; }
            .circle-2 { width: 300px; height: 300px; left: -120px; }
        }
        @media screen and (max-width: 480px) {
            .circle-1 { width: 250px; height: 250px; top: -50px; right: -80px; }
            .circle-2 { width: 200px; height: 200px; bottom: 50px; left: -80px; }
        }

        .nav-item[style*="background"] {
            padding: 10px 24px !important;
            border-radius: 50px !important;
        }
        @media screen and (max-width: 768px) {
            .nav-item[style*="background"] {
                display: inline-block;
            }
        }
    </style>
</head>
<body>

    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>

    <!-- Navigation with Laravel route bindings -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand" style="text-decoration: none;">
            <i class="ri-store-2-fill"></i>
            Vendora
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}#explore" class="nav-item">Explore</a>
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="#" class="nav-item">For Vendors</a>
            {{-- Check if user is authenticated --}}
            @guest
                <a href="{{ route('login') }}" class="nav-item">Log In</a>
                <a href="{{ route('register') }}" class="nav-item" style="background: var(--primary-color); color: white; padding: 10px 24px; border-radius: 50px;">Sign Up</a>
            @else
                <span class="nav-item" style="color: var(--primary-color);">Hi, {{ Auth::user()->name ?? 'User' }}</span>
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
                </form>
            @endguest
        </div>
        <div class="menu-btn">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1 class="hero-headline">Find the Best <br><span>Local Vendors</span> With Ease</h1>
        <p class="hero-subtext">Connect with top-rated professionals for your events, home needs, and daily services. Trusted by thousands in your community.</p>

        <!-- Search Box (non-functional for now, but can be wired to search route) -->
        <div class="search-container">
            <div class="input-group">
                <i class="ri-search-line"></i>
                <div class="input-content">
                    <label class="input-label">What</label>
                    <input type="text" class="input-field" placeholder="Plumbers, Bakers, Photographers...">
                </div>
            </div>
            <div class="input-group">
                <i class="ri-map-pin-line"></i>
                <div class="input-content">
                    <label class="input-label">Where</label>
                    <input type="text" class="input-field" placeholder="Jimma, Ethiopia or Zip Code">
                </div>
            </div>
            <button class="search-btn" aria-label="Search">
                <i class="ri-arrow-right-line"></i>
            </button>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories-wrapper">
        <div class="section-header">
            <h2 class="section-title">Popular Categories</h2>
            <a href="#" class="view-all">View All <i class="ri-arrow-right-s-line"></i></a>
        </div>
        <div class="categories-grid">
            <div class="category-item">
                <i class="ri-home-gear-line cat-icon"></i>
                <span class="cat-name">Home Services</span>
            </div>
            <div class="category-item">
                <i class="ri-camera-lens-line cat-icon"></i>
                <span class="cat-name">Photography</span>
            </div>
            <div class="category-item">
                <i class="ri-cake-3-line cat-icon"></i>
                <span class="cat-name">Events & Party</span>
            </div>
            <div class="category-item">
                <i class="ri-heart-pulse-line cat-icon"></i>
                <span class="cat-name">Health & Beauty</span>
            </div>
            <div class="category-item">
                <i class="ri-car-washing-line cat-icon"></i>
                <span class="cat-name">Automotive</span>
            </div>
            <div class="category-item">
                <i class="ri-computer-line cat-icon"></i>
                <span class="cat-name">Tech Support</span>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-shield-check-line"></i>
            </div>
            <h3 class="feature-title">Verified Vendors</h3>
            <p class="feature-desc">Every vendor on our platform undergoes a strict verification process to ensure safety and quality.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-money-dollar-circle-line"></i>
            </div>
            <h3 class="feature-title">Transparent Pricing</h3>
            <p class="feature-desc">Get clear quotes upfront. No hidden fees or last-minute surprises when you book services.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-customer-service-2-line"></i>
            </div>
            <h3 class="feature-title">24/7 Support</h3>
            <p class="feature-desc">Our dedicated support team is always available to help you with bookings and inquiries.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-fill"></i> Vendora</h2>
                <p class="footer-text">Connecting you with the best local professionals for all your needs. Simple, fast, and reliable.</p>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Trust & Safety</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Invite Friends</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>For Vendors</h4>
                    <ul>
                        <li><a href="#">List your service</a></li>
                        <li><a href="#">Vendor Resources</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora Inc. All rights reserved.</span>
            <div class="social-icons">
                <i class="ri-twitter-fill"></i>
                <i class="ri-instagram-fill"></i>
                <i class="ri-facebook-fill"></i>
                <i class="ri-linkedin-fill"></i>
            </div>
        </div>
    </footer>

</body>
</html>