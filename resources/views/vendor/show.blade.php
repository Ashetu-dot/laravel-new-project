<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>{{ $vendor->business_name ?? $vendor->name }} - Vendor Profile | Vendora Jimma</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ Str::limit($vendor->description ?? 'Local vendor in Jimma, Ethiopia offering quality products and services.', 160) }}">
    <meta property="og:title" content="{{ $vendor->business_name ?? $vendor->name }} - Vendora Jimma">
    <meta property="og:description" content="{{ Str::limit($vendor->description ?? 'Local vendor in Jimma, Ethiopia', 200) }}">
    <meta property="og:image" content="{{ $vendor->main_image ?? asset('images/default-vendor.jpg') }}">
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
            --accent-blue: #3b82f6;
            --accent-yellow: #f59e0b;
        }

        /* Dark Mode */
        body.dark-mode {
            --primary-bg: #1a1a1a;
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #f3f4f6;
            --text-light: #9ca3af;
            --white: #2d2d2d;
            --border-color: #404040;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 30px rgba(212, 165, 90, 0.2);
            --accent-green: #34D399;
            --accent-red: #F87171;
            --accent-blue: #60A5FA;
            --accent-yellow: #FBBF24;
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
            transition: background-color 0.3s, color 0.3s;
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
            transition: background-color 0.3s;
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
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
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

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary-bg);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 20px;
        }

        .theme-toggle:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
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

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: 8px;
            box-shadow: var(--shadow-hover);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left-color: var(--accent-green);
        }

        .toast.error {
            border-left-color: var(--accent-red);
        }

        .toast.warning {
            border-left-color: var(--accent-yellow);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast.success .toast-icon {
            color: var(--accent-green);
        }

        .toast.error .toast-icon {
            color: var(--accent-red);
        }

        .toast.warning .toast-icon {
            color: var(--accent-yellow);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-light);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-light);
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
            padding: 8px 0;
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
            transition: background-color 0.3s;
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
            border: 4px solid var(--white);
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-transform: uppercase;
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

        .badge-joined {
            background-color: #e0f2fe;
            color: var(--accent-blue);
        }

        .profile-stats {
            display: flex;
            gap: 32px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            min-width: 80px;
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
            background-color: var(--primary-bg);
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
            flex-shrink: 0;
        }

        .meta-content {
            flex: 1;
            min-width: 0;
        }

        .meta-label {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .meta-value {
            font-weight: 600;
            color: var(--text-dark);
            word-break: break-word;
        }

        .meta-value a {
            color: var(--primary-gold);
            text-decoration: none;
        }

        .meta-value a:hover {
            text-decoration: underline;
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
            white-space: pre-line;
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

        .btn-share {
            background-color: var(--accent-blue);
            color: white;
        }

        .btn-share:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        /* Products Section */
        .products-section {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
            margin-bottom: 32px;
            transition: background-color 0.3s;
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

        .view-all-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: all 0.3s;
        }

        .view-all-link:hover {
            background: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
            transform: translateY(-2px);
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
            background: var(--primary-bg);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
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
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-discount {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--accent-red);
            color: white;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            z-index: 2;
        }

        .product-info {
            padding: 16px;
        }

        .product-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .product-price-wrapper {
            margin-bottom: 8px;
        }

        .product-price {
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 18px;
        }

        .product-original-price {
            font-size: 14px;
            color: var(--text-light);
            text-decoration: line-through;
            margin-left: 8px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-light);
        }

        .product-rating {
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .product-rating i {
            font-size: 14px;
        }

        /* Reviews Section */
        .reviews-section {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
            transition: background-color 0.3s;
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .reviews-summary {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .average-rating {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-gold);
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
            flex-wrap: wrap;
            gap: 10px;
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
            text-transform: uppercase;
            font-size: 16px;
        }

        .review-author-info h4 {
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

        .load-more-btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }

        .load-more-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background: rgba(184, 142, 63, 0.05);
        }

        .load-more-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 20px;
        }

        .social-link:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: 16px;
            max-width: 500px;
            width: 100%;
            padding: 30px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 24px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--accent-red);
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-light);
            font-size: 14px;
            transition: background-color 0.3s;
            margin-top: 40px;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar {
                padding: 20px 40px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 16px 24px;
                flex-wrap: wrap;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                gap: 16px;
                z-index: 99;
            }

            .nav-links.active {
                display: flex;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 32px;
                left: 20px;
                bottom: -40px;
            }

            .profile-info {
                padding: 60px 20px 20px;
            }

            .profile-name-section h1 {
                font-size: 28px;
            }

            .profile-stats {
                gap: 16px;
            }

            .stat-item {
                min-width: 60px;
            }

            .stat-value {
                font-size: 20px;
            }

            .profile-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .view-all-link {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .profile-stats {
                gap: 12px;
            }

            .stat-item {
                min-width: 50px;
            }

            .stat-value {
                font-size: 18px;
            }

            .stat-label {
                font-size: 12px;
            }

            .profile-meta {
                padding: 16px;
            }

            .meta-icon {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .modal-content {
                padding: 20px;
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

        <div class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="ri-menu-line"></i>
        </div>

        <div class="nav-links" id="navLinks">
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
            <button class="theme-toggle" id="themeToggle" title="Toggle theme">
                <i class="ri-moon-line"></i>
            </button>
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
                {{ Str::upper(substr($vendor->business_name ?? $vendor->name, 0, 2)) }}
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
                            @if($vendor->created_at)
                                <span class="badge badge-joined">
                                    <i class="ri-calendar-line"></i> Joined {{ $vendor->created_at->format('M Y') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($followersCount) }}</div>
                            <div class="stat-label">Followers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($vendor->products_count ?? 0) }}</div>
                            <div class="stat-label">Products</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($vendor->rating ?? 4.5, 1) }}</div>
                            <div class="stat-label">Rating</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($vendor->total_reviews ?? 0) }}</div>
                            <div class="stat-label">Reviews</div>
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
                                <a href="{{ $vendor->website }}" target="_blank" rel="noopener noreferrer">
                                    {{ preg_replace('#^https?://#', '', $vendor->website) }}
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

                    @if($vendor->address_line1)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-map-pin-2-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Address</div>
                            <div class="meta-value">{{ $vendor->address_line1 }}{{ $vendor->address_line2 ? ', ' . $vendor->address_line2 : '' }}</div>
                        </div>
                    </div>
                    @endif

                    @if($vendor->delivery_time)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-truck-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Delivery Time</div>
                            <div class="meta-value">{{ $vendor->delivery_time }}</div>
                        </div>
                    </div>
                    @endif

                    @if($vendor->min_order)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="ri-shopping-bag-line"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Min. Order</div>
                            <div class="meta-value">{{ number_format($vendor->min_order) }} ETB</div>
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

                <!-- Social Links -->
                @if($vendor->facebook_url || $vendor->instagram_url || $vendor->telegram_url || $vendor->twitter_url)
                <div class="social-links">
                    @if($vendor->facebook_url)
                    <a href="{{ $vendor->facebook_url }}" class="social-link" target="_blank" rel="noopener noreferrer" title="Facebook">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    @endif
                    @if($vendor->instagram_url)
                    <a href="{{ $vendor->instagram_url }}" class="social-link" target="_blank" rel="noopener noreferrer" title="Instagram">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    @endif
                    @if($vendor->telegram_url)
                    <a href="{{ $vendor->telegram_url }}" class="social-link" target="_blank" rel="noopener noreferrer" title="Telegram">
                        <i class="ri-telegram-fill"></i>
                    </a>
                    @endif
                    @if($vendor->twitter_url)
                    <a href="{{ $vendor->twitter_url }}" class="social-link" target="_blank" rel="noopener noreferrer" title="Twitter">
                        <i class="ri-twitter-fill"></i>
                    </a>
                    @endif
                </div>
                @endif

                <div class="profile-actions">
                    @auth
                        @if(Auth::id() !== $vendor->id)
                            @if($isFollowing)
                                <form action="{{ route('vendor.unfollow', $vendor->id) }}" method="POST" style="display: inline;" id="unfollowForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-following" onclick="return confirm('Are you sure you want to unfollow this vendor?')">
                                        <i class="ri-user-unfollow-line"></i> Following
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('vendor.follow', $vendor->id) }}" method="POST" style="display: inline;" id="followForm">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-user-follow-line"></i> Follow Vendor
                                    </button>
                                </form>
                            @endif
                            <button class="btn btn-outline" onclick="openContactModal({{ $vendor->id }})">
                                <i class="ri-message-3-line"></i> Contact Vendor
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="ri-user-follow-line"></i> Follow to get updates
                        </a>
                    @endauth

                    <button class="btn btn-share" onclick="shareVendor({{ $vendor->id }})">
                        <i class="ri-share-line"></i> Share
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        @if(isset($vendor->products) && $vendor->products->count() > 0)
        <div class="products-section">
            <div class="section-header">
                <h2>Products by {{ $vendor->business_name ?? 'this vendor' }}</h2>
                <a href="{{ route('vendor.products', $vendor->id) }}" class="view-all-link">
                    View All <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="products-grid">
                @foreach($vendor->products->take(8) as $product)
                <a href="{{ route('product.show', $product->id) }}" class="product-card">
                    <div class="product-image">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <i class="ri-image-line" style="font-size: 32px;"></i>
                        @endif
                        @if(isset($product->original_price) && $product->original_price > $product->price)
                            @php
                                $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                            @endphp
                            <span class="product-discount">-{{ $discount }}%</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <h4>{{ Str::limit($product->name, 30) }}</h4>
                        <div class="product-price-wrapper">
                            <span class="product-price">{{ number_format($product->price) }} ETB</span>
                            @if(isset($product->original_price) && $product->original_price > $product->price)
                                <span class="product-original-price">{{ number_format($product->original_price) }} ETB</span>
                            @endif
                        </div>
                        <div class="product-meta">
                            <span class="product-rating">
                                <i class="ri-star-fill"></i> {{ number_format($product->rating ?? 4.5, 1) }}
                            </span>
                            <span>{{ $product->sold_count ?? 0 }} sold</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Reviews Section -->
        @if(isset($vendor->reviews) && $vendor->reviews->count() > 0)
        <div class="reviews-section">
            <div class="reviews-header">
                <h2>Customer Reviews</h2>
                <div class="reviews-summary">
                    <span class="average-rating">{{ number_format($vendor->rating ?? 4.5, 1) }}</span>
                    <div>
                        <div class="review-rating" style="font-size: 20px;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($vendor->rating ?? 4.5))
                                    <i class="ri-star-fill"></i>
                                @elseif($i - 0.5 <= ($vendor->rating ?? 4.5))
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="badge badge-location">{{ $vendor->total_reviews ?? 0 }} reviews</span>
                    </div>
                </div>
            </div>

            <div class="reviews-list" id="reviewsList">
                @foreach($vendor->reviews->take(3) as $review)
                <div class="review-card">
                    <div class="review-header">
                        <div class="review-author">
                            <div class="review-avatar">
                                {{ Str::upper(substr($review->user->name ?? 'Anonymous', 0, 2)) }}
                            </div>
                            <div class="review-author-info">
                                <h4>{{ $review->user->name ?? 'Anonymous' }}</h4>
                                <div class="review-date">{{ $review->created_at->format('F j, Y') }}</div>
                            </div>
                        </div>
                        <div class="review-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="ri-star-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="review-content">
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @if($vendor->reviews->count() > 3)
            <button class="load-more-btn" onclick="loadMoreReviews({{ $vendor->id }})">
                Load More Reviews
            </button>
            @endif
        </div>
        @endif

    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Operation completed successfully</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal" id="contactModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Contact Vendor</h3>
                <button class="modal-close" onclick="closeContactModal()">&times;</button>
            </div>
            <form id="contactForm">
                @csrf
                <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                <div class="modal-body">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Your Message</label>
                        <textarea name="message" rows="5" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-family: inherit; background: var(--primary-bg); color: var(--text-dark);" placeholder="Write your message here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeContactModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize theme
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'ri-sun-line';
        }

        // Theme Toggle
        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'ri-sun-line';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'ri-moon-line';
                localStorage.setItem('theme', 'light');
            }
        });

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Toast Notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');

            toast.className = 'toast ' + type;

            let iconHtml = '<i class="ri-checkbox-circle-line"></i>';
            if (type === 'error') iconHtml = '<i class="ri-error-warning-line"></i>';
            else if (type === 'warning') iconHtml = '<i class="ri-alert-line"></i>';

            toastIcon.innerHTML = iconHtml;
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Contact Modal
        function openContactModal(vendorId) {
            document.getElementById('contactModal').classList.add('active');
        }

        function closeContactModal() {
            document.getElementById('contactModal').classList.remove('active');
        }

        // Contact Form Submission
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="loading-spinner"></span> Sending...';
            submitBtn.disabled = true;

            fetch('/contact/vendor', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', 'Message sent successfully!');
                    closeContactModal();
                    this.reset();
                } else {
                    showToast('Error', data.message || 'Failed to send message', 'error');
                }
            })
            .catch(error => {
                showToast('Error', 'Failed to send message', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // Share Vendor
        function shareVendor(vendorId) {
            const url = window.location.href;

            if (navigator.share) {
                navigator.share({
                    title: '{{ $vendor->business_name ?? $vendor->name }}',
                    text: 'Check out this vendor on Vendora!',
                    url: url
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    showToast('Success', 'Link copied to clipboard!');
                }).catch(() => {
                    prompt('Copy this link:', url);
                });
            }
        }

        // Load More Reviews (AJAX)
        function loadMoreReviews(vendorId) {
            const button = event.target;
            const originalText = button.innerHTML;

            button.innerHTML = '<span class="loading-spinner"></span> Loading...';
            button.disabled = true;

            const offset = document.querySelectorAll('.review-card').length;

            fetch(`/vendors/${vendorId}/reviews?offset=${offset}`)
                .then(response => response.json())
                .then(data => {
                    const reviewsList = document.getElementById('reviewsList');

                    data.reviews.forEach(review => {
                        let ratingHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            if (i <= review.rating) {
                                ratingHtml += '<i class="ri-star-fill"></i>';
                            } else if (i - 0.5 <= review.rating) {
                                ratingHtml += '<i class="ri-star-half-fill"></i>';
                            } else {
                                ratingHtml += '<i class="ri-star-line"></i>';
                            }
                        }

                        const reviewHtml = `
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="review-author">
                                        <div class="review-avatar">${review.avatar}</div>
                                        <div class="review-author-info">
                                            <h4>${review.author}</h4>
                                            <div class="review-date">${review.date}</div>
                                        </div>
                                    </div>
                                    <div class="review-rating">${ratingHtml}</div>
                                </div>
                                <div class="review-content">
                                    <p>${review.comment}</p>
                                </div>
                            </div>
                        `;
                        reviewsList.insertAdjacentHTML('beforeend', reviewHtml);
                    });

                    if (!data.hasMore) {
                        button.style.display = 'none';
                    } else {
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error loading reviews:', error);
                    button.innerHTML = originalText;
                    button.disabled = false;
                    showToast('Error', 'Failed to load more reviews', 'error');
                });
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

        // Confirm unfollow
        document.getElementById('unfollowForm')?.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to unfollow this vendor?')) {
                e.preventDefault();
            }
        });

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);

        // Escape key closes modals
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeContactModal();
                hideToast();
            }
        });

        // Click outside modal closes it
        document.getElementById('contactModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeContactModal();
            }
        });
    </script>

</body>
</html>
