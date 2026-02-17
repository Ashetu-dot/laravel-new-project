<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Press - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ----- FONTS ----- */
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

        /* ----- ROOT VARIABLES ----- */
        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --success-color: #10b981;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
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
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
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

        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
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

        /* Navigation */
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
            text-decoration: none;
        }

        .brand i {
            font-size: 28px;
        }

        .brand-badge {
            display: flex;
            align-items: center;
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
            position: relative;
        }

        .nav-item:hover {
            color: var(--primary-color);
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .btn-signup {
            background: var(--primary-color);
            color: white !important;
            padding: 10px 24px !important;
            border-radius: 50px !important;
            transition: all 0.3s ease !important;
        }

        .btn-signup:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-signup::after {
            display: none;
        }

        .menu-btn {
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .menu-btn:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        .mobile-menu .nav-item {
            display: block;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu .nav-item:last-child {
            border-bottom: none;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 80px 20px;
            text-align: center;
            position: relative;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .page-header h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .page-header h1 span::after {
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

        .page-header p {
            font-size: 18px;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Overview Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 60px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-number {
            font-size: 40px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Press Releases */
        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .press-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .press-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid transparent;
        }

        .press-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .press-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .press-content {
            padding: 24px;
        }

        .press-date {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .press-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .press-excerpt {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .press-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .press-source {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 13px;
        }

        .press-source i {
            color: var(--primary-color);
        }

        .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .read-more:hover {
            gap: 8px;
        }

        /* Media Coverage */
        .coverage-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .coverage-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            text-align: center;
        }

        .coverage-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .coverage-logo {
            width: 80px;
            height: 80px;
            background: var(--bg-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--primary-color);
            font-size: 32px;
        }

        .coverage-name {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .coverage-date {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 12px;
        }

        .coverage-title {
            font-size: 14px;
            color: var(--text-dark);
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .coverage-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Press Kit */
        .press-kit {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 60px;
            border-radius: var(--radius-lg);
            margin-bottom: 60px;
        }

        .press-kit-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .kit-item {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius-lg);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .kit-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .kit-icon {
            width: 70px;
            height: 70px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-color);
            font-size: 32px;
        }

        .kit-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .kit-description {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .kit-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.3s;
        }

        .kit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Media Inquiries */
        .inquiries-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 50px;
            box-shadow: var(--shadow);
            margin-bottom: 60px;
        }

        .inquiries-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .inquiries-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .inquiries-text {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .contact-card {
            background: var(--bg-light);
            border-radius: var(--radius-md);
            padding: 30px;
            margin-top: 30px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 10px;
            background: var(--white);
            border-radius: var(--radius-md);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 24px;
        }

        .contact-info {
            flex: 1;
            text-align: left;
        }

        .contact-label {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .contact-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .contact-value a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .contact-value a:hover {
            text-decoration: underline;
        }

        /* Newsletter */
        .newsletter-section {
            background: var(--primary-color);
            border-radius: var(--radius-lg);
            padding: 60px;
            color: white;
            text-align: center;
        }

        .newsletter-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .newsletter-text {
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
        }

        .newsletter-btn {
            background: var(--text-dark);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .newsletter-btn:hover {
            background: black;
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            border-top: 1px solid #EEEEEE;
            padding: 60px 80px 40px;
            margin-top: auto;
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

        .social-icons a {
            color: #999;
            transition: color 0.2s;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        /* Responsive */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 20px 40px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 18px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .press-grid,
            .coverage-grid,
            .press-kit-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 60px 20px; }
            .page-header h1 { font-size: 36px; }

            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .press-grid,
            .coverage-grid,
            .press-kit-grid {
                grid-template-columns: 1fr;
            }
            
            .press-kit {
                padding: 40px 20px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-btn {
                width: 100%;
                justify-content: center;
            }
            
            .inquiries-section {
                padding: 30px 20px;
            }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }

            .page-header h1 { font-size: 32px; }
            .section-title { font-size: 28px; }
            
            .press-kit {
                padding: 30px 15px;
            }
            
            .contact-item {
                flex-direction: column;
                text-align: center;
            }
            
            .contact-info {
                text-align: center;
            }

            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }
    </style>
</head>
<body>

    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>

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

    <!-- Navigation -->
    <nav class="navbar">
        <div class="brand-badge">
            <a href="{{ route('home') }}" class="brand">
                <i class="ri-store-2-fill"></i>
                Vendora
            </a>
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-item">Features</a>
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
            <a href="{{ route('about') }}" class="nav-item">About Us</a>
            
            @guest
                <a href="{{ route('login') }}" class="nav-item">Log In</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
            @else
                <span class="nav-item" style="color: var(--primary-color); font-weight: 600;">
                    <i class="ri-user-line"></i> {{ Auth::user()->name }}
                </span>
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">Profile</a>
                @if(Auth::user()->role === 'vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="nav-item">Dashboard</a>
                @elseif(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">Dashboard</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-item">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
                </form>
            @endguest
        </div>
        <div class="menu-btn" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
        <a href="{{ route('home') }}#features" class="nav-item">Features</a>
        <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
        <a href="{{ route('about') }}" class="nav-item">About Us</a>
        <a href="{{ route('careers') }}" class="nav-item">Careers</a>
        <a href="{{ route('press') }}" class="nav-item active">Press</a>
        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @else
            <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">Profile</a>
            @if(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">Dashboard</a>
            @elseif(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-item">Dashboard</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-item">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
            </form>
        @endguest
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <h1><span>Press</span> & Media</h1>
        <p>Latest news, announcements, and media coverage about Vendora</p>
    </section>

    <main>
        <div class="container">
            <!-- Overview Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Media Mentions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Press Releases</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Awards</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">Partner Publications</div>
                </div>
            </div>

            <!-- Latest Press Releases -->
            <section>
                <h2 class="section-title">Latest Press Releases</h2>
                <div class="press-grid">
                    <!-- Press Release 1 -->
                    <div class="press-card">
                        <div class="press-image">
                            <i class="ri-newspaper-line"></i>
                        </div>
                        <div class="press-content">
                            <span class="press-date">February 15, 2025</span>
                            <h3 class="press-title">Vendora Expands to Addis Ababa</h3>
                            <p class="press-excerpt">Leading local vendor marketplace launches in Ethiopia's capital, connecting thousands of new vendors with customers.</p>
                            <div class="press-meta">
                                <div class="press-source">
                                    <i class="ri-building-line"></i>
                                    <span>Vendora Press Room</span>
                                </div>
                                <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Press Release 2 -->
                    <div class="press-card">
                        <div class="press-image">
                            <i class="ri-award-line"></i>
                        </div>
                        <div class="press-content">
                            <span class="press-date">January 20, 2025</span>
                            <h3 class="press-title">Vendora Wins Innovation Award</h3>
                            <p class="press-excerpt">Recognized as Ethiopia's Most Innovative Tech Startup at the 2025 Ethiopian Business Awards.</p>
                            <div class="press-meta">
                                <div class="press-source">
                                    <i class="ri-trophy-line"></i>
                                    <span>Ethiopian Business Awards</span>
                                </div>
                                <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Press Release 3 -->
                    <div class="press-card">
                        <div class="press-image">
                            <i class="ri-hand-coin-line"></i>
                        </div>
                        <div class="press-content">
                            <span class="press-date">December 5, 2024</span>
                            <h3 class="press-title">$2M Funding Round Announced</h3>
                            <p class="press-excerpt">Vendora secures $2 million in seed funding to accelerate growth and expand across East Africa.</p>
                            <div class="press-meta">
                                <div class="press-source">
                                    <i class="ri-bank-line"></i>
                                    <span>TechCrunch</span>
                                </div>
                                <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Press Release 4 -->
                    <div class="press-card">
                        <div class="press-image">
                            <i class="ri-group-line"></i>
                        </div>
                        <div class="press-content">
                            <span class="press-date">November 12, 2024</span>
                            <h3 class="press-title">10,000 Vendors Milestone</h3>
                            <p class="press-excerpt">Vendora celebrates reaching 10,000 registered vendors across Ethiopia, with 50,000+ successful transactions.</p>
                            <div class="press-meta">
                                <div class="press-source">
                                    <i class="ri-building-line"></i>
                                    <span>Vendora Press Room</span>
                                </div>
                                <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Media Coverage -->
            <section>
                <h2 class="section-title">Media Coverage</h2>
                <div class="coverage-grid">
                    <!-- Coverage 1 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-global-line"></i>
                        </div>
                        <div class="coverage-name">Forbes Africa</div>
                        <div class="coverage-date">January 2025</div>
                        <p class="coverage-title">"How Vendora is Revolutionizing Local Commerce in Ethiopia"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>

                    <!-- Coverage 2 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-computer-line"></i>
                        </div>
                        <div class="coverage-name">TechCrunch</div>
                        <div class="coverage-date">December 2024</div>
                        <p class="coverage-title">"Ethiopian Startup Vendora Raises $2M to Digitize Local Markets"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>

                    <!-- Coverage 3 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-newspaper-line"></i>
                        </div>
                        <div class="coverage-name">The Reporter</div>
                        <div class="coverage-date">November 2024</div>
                        <p class="coverage-title">"Jimma-Based Startup Connects Local Vendors with Customers"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>

                    <!-- Coverage 4 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-flask-line"></i>
                        </div>
                        <div class="coverage-name">African Business Review</div>
                        <div class="coverage-date">October 2024</div>
                        <p class="coverage-title">"Top 10 Ethiopian Startups to Watch in 2025"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>

                    <!-- Coverage 5 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-mic-line"></i>
                        </div>
                        <div class="coverage-name">BBC News Amharic</div>
                        <div class="coverage-date">September 2024</div>
                        <p class="coverage-title">"የዲጂታል ቴክኖሎጂ የአገር ውስጥ ንግድን እንዴት እየቀየረ ነው?"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>

                    <!-- Coverage 6 -->
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ri-pie-chart-line"></i>
                        </div>
                        <div class="coverage-name">Ethiopian Business Review</div>
                        <div class="coverage-date">August 2024</div>
                        <p class="coverage-title">"The Rise of E-Commerce in Ethiopia's Regional Cities"</p>
                        <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                    </div>
                </div>
            </section>

            <!-- Press Kit -->
            <section class="press-kit">
                <h2 class="section-title" style="color: var(--text-dark);">Press Kit</h2>
                <div class="press-kit-grid">
                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-image-line"></i>
                        </div>
                        <h3 class="kit-title">Brand Assets</h3>
                        <p class="kit-description">Download our logo, brand guidelines, and official images in high resolution.</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            Download (ZIP)
                        </a>
                    </div>

                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-file-text-line"></i>
                        </div>
                        <h3 class="kit-title">Media Kit</h3>
                        <p class="kit-description">Company fact sheet, executive bios, and background information.</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            Download (PDF)
                        </a>
                    </div>

                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-gallery-line"></i>
                        </div>
                        <h3 class="kit-title">Photos & Videos</h3>
                        <p class="kit-description">High-resolution photos of our team, office, and events for media use.</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            Download (ZIP)
                        </a>
                    </div>
                </div>
            </section>

            <!-- Media Inquiries -->
            <section class="inquiries-section">
                <div class="inquiries-content">
                    <h2 class="inquiries-title">Media Inquiries</h2>
                    <p class="inquiries-text">For press and media inquiries, please contact our communications team. We're happy to provide interviews, quotes, and additional information.</p>
                    
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">Email</div>
                                <div class="contact-value">
                                    <a href="mailto:press@vendora.com">press@vendora.com</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-phone-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value">
                                    <a href="tel:+251911234567">+251 91 123 4567</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-user-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">Press Contact</div>
                                <div class="contact-value">Azeb G/Hiwot</div>
                                <div style="font-size: 12px; color: var(--text-light);">Communications Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter -->
            <section class="newsletter-section">
                <h2 class="newsletter-title">Stay Updated</h2>
                <p class="newsletter-text">Subscribe to our press newsletter to receive the latest news and announcements.</p>
                
                <form class="newsletter-form" action="#" method="POST">
                    @csrf
                    <input type="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-btn">
                        Subscribe <i class="ri-send-plane-line"></i>
                    </button>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-fill"></i> Vendora</h2>
                <p class="footer-text">Connecting you with the best local professionals in Jimma and across Ethiopia. Simple, fast, and reliable.</p>
                <div style="margin-top: 16px;">
                    <span class="ethiopia-badge">
                        <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                    </span>
                </div>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('press') }}">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="{{ route('search.results') }}">How it works</a></li>
                        <li><a href="#">Trust & Safety</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Invite Friends</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>For Vendors</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">List your service</a></li>
                        <li><a href="#">Vendor Resources</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora Inc. All rights reserved. Made with ❤️ in Jimma, Ethiopia</span>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('active');
                
                // Change icon
                const icon = this.querySelector('i');
                if (mobileMenu.classList.contains('active')) {
                    icon.className = 'ri-close-line';
                } else {
                    icon.className = 'ri-menu-line';
                }
            });

            // Close mobile menu when clicking on a link
            mobileMenu.querySelectorAll('a, button').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    if (icon) icon.className = 'ri-menu-line';
                });
            });

            // Close when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    if (icon) icon.className = 'ri-menu-line';
                }
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Close mobile menu if open
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
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

        // Newsletter form validation
        document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                alert('Thank you for subscribing to our press newsletter!');
                this.reset();
            }
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Press page loaded - Local environment');
    </script>
    @endif
</body>
</html>