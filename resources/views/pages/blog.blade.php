<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Blog - Vendora | Jimma, Ethiopia</title>
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

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            padding: 60px 20px;
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

        /* Blog Layout */
        .blog-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
        }

        /* Featured Post */
        .featured-post {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-column: 1 / -1;
        }

        .featured-post:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .featured-image {
            height: 100%;
            min-height: 350px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 64px;
        }

        .featured-content {
            padding: 40px;
        }

        .featured-category {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .featured-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-dark);
            line-height: 1.3;
        }

        .featured-excerpt {
            color: var(--text-light);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .featured-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .featured-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .author-info {
            font-size: 14px;
        }

        .author-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .author-title {
            color: var(--text-light);
            font-size: 12px;
        }

        .featured-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-light);
            font-size: 14px;
        }

        .read-more-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .read-more-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Blog Grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .blog-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .blog-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .blog-content {
            padding: 24px;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .blog-category {
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }

        .blog-date {
            color: var(--text-light);
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .blog-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.4;
            color: var(--text-dark);
        }

        .blog-excerpt {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .blog-author-avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .blog-author-name {
            font-size: 12px;
            font-weight: 500;
        }

        .blog-read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .blog-read-more:hover {
            gap: 8px;
        }

        /* Sidebar */
        .blog-sidebar {
            position: sticky;
            top: 100px;
            align-self: start;
        }

        .sidebar-widget {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }

        .widget-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .widget-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-color);
        }

        /* Search Widget */
        .search-form {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            overflow: hidden;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        .search-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: var(--primary-hover);
        }

        /* Categories Widget */
        .categories-list {
            list-style: none;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-link {
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .category-link i {
            color: var(--primary-color);
            font-size: 14px;
        }

        .category-link:hover {
            color: var(--primary-color);
        }

        .category-count {
            background: var(--bg-light);
            color: var(--text-light);
            padding: 2px 8px;
            border-radius: 50px;
            font-size: 12px;
        }

        /* Popular Posts Widget */
        .popular-post {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .popular-post:last-child {
            margin-bottom: 0;
        }

        .popular-image {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .popular-content {
            flex: 1;
        }

        .popular-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .popular-title a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .popular-title a:hover {
            color: var(--primary-color);
        }

        .popular-date {
            font-size: 11px;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Tags Widget */
        .tags-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: var(--bg-light);
            color: var(--text-light);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .tag:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Newsletter Widget */
        .newsletter-widget p {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 16px;
        }

        .newsletter-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            margin-bottom: 10px;
            font-size: 14px;
        }

        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .subscribe-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .subscribe-btn:hover {
            background: var(--primary-hover);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 50px;
            grid-column: 1 / -1;
        }

        .page-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-link.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-dots {
            color: var(--text-light);
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
            
            .blog-layout {
                grid-template-columns: 1fr;
            }
            
            .blog-sidebar {
                position: static;
                margin-top: 40px;
            }
            
            .featured-post {
                grid-template-columns: 1fr;
            }
            
            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }
            
            .blog-grid {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 40px 20px; }
            .page-header h1 { font-size: 36px; }

            .featured-content {
                padding: 30px;
            }
            
            .featured-title {
                font-size: 24px;
            }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }

            .page-header h1 { font-size: 32px; }
            
            .featured-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
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
        <a href="{{ route('press') }}" class="nav-item">Press</a>
        <a href="{{ route('blog') }}" class="nav-item active">Blog</a>
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
        <h1>Vendora <span>Blog</span></h1>
        <p>Insights, stories, and updates from the Vendora community</p>
    </section>

    <main>
        <div class="container">
            <div class="blog-layout">
                <!-- Main Content -->
                <div class="blog-main">
                    <!-- Featured Post -->
                    <article class="featured-post">
                        <div class="featured-image">
                            <i class="ri-store-3-line"></i>
                        </div>
                        <div class="featured-content">
                            <span class="featured-category">Community Spotlight</span>
                            <h2 class="featured-title">How Jimma's Coffee Vendors Are Going Digital</h2>
                            <p class="featured-excerpt">Discover how local coffee roasters in Jimma are using Vendora to reach new customers and preserve traditional Ethiopian coffee culture in the digital age.</p>
                            <div class="featured-meta">
                                <div class="featured-author">
                                    <div class="author-avatar">AT</div>
                                    <div class="author-info">
                                        <div class="author-name">Abebe Tadesse</div>
                                        <div class="author-title">Community Manager</div>
                                    </div>
                                </div>
                                <div class="featured-date">
                                    <i class="ri-calendar-line"></i>
                                    <span>February 17, 2025</span>
                                </div>
                                <div class="featured-date">
                                    <i class="ri-time-line"></i>
                                    <span>5 min read</span>
                                </div>
                            </div>
                            <a href="#" class="read-more-btn">
                                Read Full Story <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </article>

                    <!-- Blog Grid -->
                    <div class="blog-grid">
                        <!-- Blog Post 1 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-handbag-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Vendor Success</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 15, 2025</span>
                                </div>
                                <h3 class="blog-title">From Local Shop to Online Success: A Vendora Story</h3>
                                <p class="blog-excerpt">How a traditional handicraft shop in Jimma grew their business 300% in just 6 months using Vendora's platform.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">MK</div>
                                        <span class="blog-author-name">Mekdes Kebede</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Blog Post 2 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-customer-service-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Tips & Tricks</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 12, 2025</span>
                                </div>
                                <h3 class="blog-title">10 Tips for Choosing the Right Local Vendor</h3>
                                <p class="blog-excerpt">From checking reviews to comparing quotes, learn how to find the perfect vendor for your needs on Vendora.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">TB</div>
                                        <span class="blog-author-name">Tekle Berhan</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Blog Post 3 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-camera-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Photography</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 10, 2025</span>
                                </div>
                                <h3 class="blog-title">Best Wedding Photographers in Jimma for 2025</h3>
                                <p class="blog-excerpt">We've rounded up the top-rated wedding photographers on Vendora to help you capture your special day.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">AG</div>
                                        <span class="blog-author-name">Azeb G/Hiwot</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Blog Post 4 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-restaurant-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Food & Drink</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 8, 2025</span>
                                </div>
                                <h3 class="blog-title">Traditional Ethiopian Dishes You Can Order Online</h3>
                                <p class="blog-excerpt">From Doro Wat to Kitfo, discover local caterers and restaurants delivering authentic Ethiopian cuisine.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">AT</div>
                                        <span class="blog-author-name">Abebe Tadesse</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Blog Post 5 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-home-gear-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Home Services</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 5, 2025</span>
                                </div>
                                <h3 class="blog-title">Home Maintenance Checklist for Jimma Residents</h3>
                                <p class="blog-excerpt">Keep your home in top shape with this seasonal maintenance guide and find trusted local professionals.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">MK</div>
                                        <span class="blog-author-name">Mekdes Kebede</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Blog Post 6 -->
                        <article class="blog-card">
                            <div class="blog-image">
                                <i class="ri-heart-pulse-line"></i>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-category">Health & Beauty</span>
                                    <span class="blog-date"><i class="ri-calendar-line"></i> Feb 3, 2025</span>
                                </div>
                                <h3 class="blog-title">Top 5 Salons and Spas in Jimma</h3>
                                <p class="blog-excerpt">Treat yourself to some self-care at these highly-rated beauty spots recommended by Vendora customers.</p>
                                <div class="blog-footer">
                                    <div class="blog-author">
                                        <div class="blog-author-avatar">AG</div>
                                        <span class="blog-author-name">Azeb G/Hiwot</span>
                                    </div>
                                    <a href="#" class="blog-read-more">
                                        Read More <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <a href="#" class="page-link active">1</a>
                        <a href="#" class="page-link">2</a>
                        <a href="#" class="page-link">3</a>
                        <span class="page-dots">...</span>
                        <a href="#" class="page-link">8</a>
                        <a href="#" class="page-link">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="blog-sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Search</h3>
                        <form class="search-form" action="#" method="GET">
                            <input type="text" class="search-input" placeholder="Search articles...">
                            <button type="submit" class="search-btn">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="categories-list">
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Community Spotlight
                                </a>
                                <span class="category-count">12</span>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Vendor Success
                                </a>
                                <span class="category-count">8</span>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Tips & Tricks
                                </a>
                                <span class="category-count">15</span>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Food & Drink
                                </a>
                                <span class="category-count">10</span>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Home Services
                                </a>
                                <span class="category-count">7</span>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-link">
                                    <i class="ri-price-tag-3-line"></i>
                                    Health & Beauty
                                </a>
                                <span class="category-count">9</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Popular Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Popular Posts</h3>
                        
                        <div class="popular-post">
                            <div class="popular-image">
                                <i class="ri-cup-line"></i>
                            </div>
                            <div class="popular-content">
                                <h4 class="popular-title">
                                    <a href="#">The Best Coffee Shops in Jimma</a>
                                </h4>
                                <div class="popular-date">
                                    <i class="ri-calendar-line"></i> Feb 14, 2025
                                </div>
                            </div>
                        </div>

                        <div class="popular-post">
                            <div class="popular-image">
                                <i class="ri-handbag-line"></i>
                            </div>
                            <div class="popular-content">
                                <h4 class="popular-title">
                                    <a href="#">How to Start Your Online Vendor Journey</a>
                                </h4>
                                <div class="popular-date">
                                    <i class="ri-calendar-line"></i> Feb 10, 2025
                                </div>
                            </div>
                        </div>

                        <div class="popular-post">
                            <div class="popular-image">
                                <i class="ri-cake-line"></i>
                            </div>
                            <div class="popular-content">
                                <h4 class="popular-title">
                                    <a href="#">Top Caterers for Your Next Event</a>
                                </h4>
                                <div class="popular-date">
                                    <i class="ri-calendar-line"></i> Feb 5, 2025
                                </div>
                            </div>
                        </div>

                        <div class="popular-post">
                            <div class="popular-image">
                                <i class="ri-camera-line"></i>
                            </div>
                            <div class="popular-content">
                                <h4 class="popular-title">
                                    <a href="#">Wedding Photography Guide 2025</a>
                                </h4>
                                <div class="popular-date">
                                    <i class="ri-calendar-line"></i> Feb 1, 2025
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Popular Tags</h3>
                        <div class="tags-cloud">
                            <a href="#" class="tag">#Jimma</a>
                            <a href="#" class="tag">#Ethiopia</a>
                            <a href="#" class="tag">#Coffee</a>
                            <a href="#" class="tag">#Handicrafts</a>
                            <a href="#" class="tag">#Wedding</a>
                            <a href="#" class="tag">#Photography</a>
                            <a href="#" class="tag">#Food</a>
                            <a href="#" class="tag">#Beauty</a>
                            <a href="#" class="tag">#HomeServices</a>
                            <a href="#" class="tag">#Vendors</a>
                            <a href="#" class="tag">#SuccessStory</a>
                            <a href="#" class="tag">#Tips</a>
                        </div>
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Newsletter</h3>
                        <p>Subscribe to get the latest posts and updates from Vendora.</p>
                        <form action="#" method="POST">
                            @csrf
                            <input type="email" class="newsletter-input" placeholder="Your email address" required>
                            <button type="submit" class="subscribe-btn">
                                <i class="ri-send-plane-line"></i>
                                Subscribe
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
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
                        <li><a href="{{ route('blog') }}">Blog</a></li>
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
        document.querySelector('.subscribe-btn')?.addEventListener('click', function(e) {
            const input = this.previousElementSibling;
            if (input && input.value) {
                e.preventDefault();
                alert('Thank you for subscribing to our blog newsletter!');
                input.value = '';
            }
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Blog page loaded - Local environment');
    </script>
    @endif
</body>
</html>