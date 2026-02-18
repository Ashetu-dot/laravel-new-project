<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Privacy Policy - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @font-face {
            font-family: 'Inter';

            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter';
            font-weight: 700;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-body: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --success-light: #d1fae5;
            --success-dark: #065f46;
            --info-light: #dbeafe;
            --info-dark: #1e40af;
            --warning-light: #fef3c7;
            --warning-dark: #92400e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
        }

        .logo i {
            font-size: 32px;
        }

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

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-gold);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-signup {
            background: var(--primary-gold);
            color: white !important;
            padding: 8px 20px !important;
            border-radius: 50px !important;
            transition: all 0.3s !important;
        }

        .btn-signup:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-signup::after {
            display: none;
        }

        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .hamburger:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
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
            color: var(--primary-gold);
            padding-left: 10px;
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

        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            width: 100%;
        }

        .page-card {
            background: var(--white);
            border-radius: 24px;
            padding: 50px;
            box-shadow: var(--shadow);
            transition: box-shadow 0.3s;
            animation: fadeIn 0.5s ease;
        }

        .page-card:hover {
            box-shadow: var(--shadow-hover);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 24px;
            padding: 8px 16px;
            border-radius: 50px;
            background: var(--white);
            box-shadow: var(--shadow);
            transition: all 0.3s;
            font-size: 14px;
        }

        .back-link:hover {
            color: var(--primary-gold);
            transform: translateX(-5px);
            box-shadow: var(--shadow-hover);
        }

        .page-header {
            margin-bottom: 40px;
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .page-header h1 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .page-header h1 span {
            color: var(--primary-gold);
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

        .page-header .last-updated {
            color: var(--text-light);
            font-size: 14px;
            background: #f1f5f9;
            display: inline-block;
            padding: 6px 16px;
            border-radius: 50px;
        }

        .page-section {
            margin-bottom: 40px;
        }

        .page-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-section h2 i {
            color: var(--primary-gold);
            font-size: 28px;
        }

        .page-section h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 24px 0 12px;
            color: var(--text-dark);
            padding-left: 8px;
            border-left: 4px solid var(--primary-gold);
        }

        .page-section p {
            color: var(--text-light);
            margin-bottom: 16px;
            font-size: 16px;
        }

        /* Enhanced List Styling */
        .list-container {
            background: #f8fafc;
            border-radius: 16px;
            padding: 24px;
            margin: 20px 0;
        }

        .styled-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .styled-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .styled-list li:hover {
            transform: translateX(5px);
            border-color: var(--primary-gold);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.1);
        }

        .list-icon {
            width: 28px;
            height: 28px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .list-content {
            flex: 1;
        }

        .list-content strong {
            color: var(--primary-gold);
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .list-content .list-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Alternative List Style - Bullet Points */
        .bullet-list {
            list-style: none;
            margin: 16px 0;
        }

        .bullet-list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 12px;
            color: var(--text-light);
            font-size: 15px;
        }

        .bullet-list li::before {
            content: '•';
            position: absolute;
            left: 8px;
            color: var(--primary-gold);
            font-size: 20px;
            font-weight: bold;
        }

        /* Numbered List Style */
        .numbered-list {
            list-style: none;
            counter-reset: item;
            margin: 16px 0;
        }

        .numbered-list li {
            position: relative;
            padding-left: 32px;
            margin-bottom: 12px;
            color: var(--text-light);
            font-size: 15px;
            counter-increment: item;
        }

        .numbered-list li::before {
            content: counter(item) ".";
            position: absolute;
            left: 0;
            color: var(--primary-gold);
            font-weight: 600;
        }

        /* Checkmark List Style */
        .check-list {
            list-style: none;
            margin: 16px 0;
        }

        .check-list li {
            position: relative;
            padding-left: 32px;
            margin-bottom: 12px;
            color: var(--text-light);
            font-size: 15px;
        }

        .check-list li::before {
            content: '✓';
            position: absolute;
            left: 8px;
            color: var(--success-dark);
            font-weight: bold;
            background: var(--success-light);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        /* Two-column List Grid */
        .list-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 20px 0;
        }

        .list-grid-item {
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }

        .list-grid-item:hover {
            border-color: var(--primary-gold);
            transform: translateY(-3px);
        }

        .list-grid-item h5 {
            color: var(--primary-gold);
            margin-bottom: 8px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .list-grid-item p {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 0;
        }

        .highlight-box {
            background: linear-gradient(135deg, #fef3e7 0%, #fff 100%);
            border-left: 4px solid var(--primary-gold);
            padding: 24px;
            border-radius: 16px;
            margin: 30px 0;
            box-shadow: var(--shadow);
        }

        .highlight-box p {
            margin-bottom: 0;
            font-weight: 500;
            color: var(--text-dark);
        }

        .highlight-box i {
            color: var(--primary-gold);
            margin-right: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .info-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            transition: transform 0.3s;
        }

        .info-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary-gold);
        }

        .info-card h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: var(--primary-gold);
        }

        .info-card p {
            margin-bottom: 0;
            font-size: 14px;
        }

        .contact-details {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
            margin-top: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: var(--white);
            border-radius: 12px;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }

        .contact-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow);
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 20px;
        }

        .contact-info {
            flex: 1;
        }

        .contact-label {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .contact-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .contact-value a {
            color: var(--primary-gold);
            text-decoration: none;
        }

        .contact-value a:hover {
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 40px;
            padding: 20px;
            background: #f1f5f9;
            border-radius: 12px;
            text-align: center;
            font-size: 14px;
            color: var(--text-light);
            border: 1px dashed var(--border-color);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 50px 60px 30px;
            border-top: 1px solid var(--border-color);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .footer-section h4 {
            margin-bottom: 20px;
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 600;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 12px;
        }

        .footer-section a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-section a:hover {
            color: var(--primary-gold);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 40px auto 0;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: 13px;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-links a {
            color: var(--text-light);
            font-size: 20px;
            transition: color 0.2s;
        }

        .social-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar { padding: 20px 40px; }
            .footer-content { grid-template-columns: repeat(2, 1fr); }
            .list-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 16px 30px; }
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .mobile-menu { display: block; }

            .page-card { padding: 30px 25px; }
            .page-header h1 { font-size: 32px; }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .list-grid-item {
                padding: 14px;
            }
        }

        @media (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }

            .page-card { padding: 24px 20px; }
            .page-header h1 { font-size: 28px; }

            .page-section h2 {
                font-size: 24px;
            }

            .page-section h2 i {
                font-size: 24px;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 16px;
            }

            .styled-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .list-icon {
                margin-bottom: 4px;
            }
        }

        @media print {
            .navbar, .footer, .back-link, .footer-note, .hamburger, .mobile-menu {
                display: none;
            }
            .page-card {
                box-shadow: none;
                padding: 0;
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
            <a href="{{ route('home') }}#categories" class="nav-link">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-link">Features</a>
            <a href="{{ route('register') }}" class="nav-link">For Vendors</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
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
        <div class="hamburger" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('home') }}#categories">Categories</a>
        <a href="{{ route('home') }}#features">Features</a>
        <a href="{{ route('register') }}">For Vendors</a>
        <a href="{{ route('about') }}">About</a>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="btn-signup-mobile">Sign Up</a>
        @else
            <a href="{{ route('profile.show', Auth::id()) }}">Profile</a>
            @if(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}">Dashboard</a>
            @elseif(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}">Dashboard</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </div>

    <!-- Main Content -->
    <main class="main-container">


        <div class="page-card">
            <div class="page-header">
                <h1><span>Privacy</span> Policy</h1>
                <p class="last-updated">Last Updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="highlight-box">
                <p><i class="ri-shield-check-line"></i> <strong>Your privacy is our priority.</strong> This policy explains how we collect, use, and protect your personal information when you use Vendora in Jimma, Ethiopia.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-heart-line"></i> Our Commitment</h2>
                <p>Vendora is built on trust. We are committed to protecting your personal information and being transparent about how we use it. This Privacy Policy applies to all users of Vendora, including customers and vendors in Jimma and across Ethiopia.</p>
                <p>By using Vendora, you agree to the collection and use of information in accordance with this policy. We comply with Ethiopian data protection laws and international best practices.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-database-2-line"></i> Information We Collect</h2>

                <h3>1. Information You Provide</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-user-line"></i></span>
                            <div class="list-content">
                                <strong>Account Information</strong>
                                <span class="list-description">Name, email address, phone number, and password when you register</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-id-card-line"></i></span>
                            <div class="list-content">
                                <strong>Profile Information</strong>
                                <span class="list-description">Business name, description, category, address, and profile photo</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-message-line"></i></span>
                            <div class="list-content">
                                <strong>Communications</strong>
                                <span class="list-description">Messages you send through our platform and responses to surveys</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <h3>2. Information Automatically Collected</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-bar-chart-line"></i></span>
                            <div class="list-content">
                                <strong>Usage Data</strong>
                                <span class="list-description">Pages visited, time spent, links clicked, and interactions with vendors</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-map-pin-line"></i></span>
                            <div class="list-content">
                                <strong>Location Data</strong>
                                <span class="list-description">City and region (with your permission)</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-cookie-line"></i></span>
                            <div class="list-content">
                                <strong>Cookies</strong>
                                <span class="list-description">Small files stored on your device to enhance your experience</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <h3>3. Information from Third Parties</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-bank-card-line"></i></span>
                            <div class="list-content">
                                <strong>Payment Processors</strong>
                                <span class="list-description">Transaction confirmations and payment status</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-share-line"></i></span>
                            <div class="list-content">
                                <strong>Social Media</strong>
                                <span class="list-description">If you connect your social media accounts</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-check-line"></i></span>
                            <div class="list-content">
                                <strong>Verification Services</strong>
                                <span class="list-description">Business verification data</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h4><i class="ri-customer-service-line"></i> For Customers</h4>
                    <p>We collect information to help you find the best local vendors and complete your bookings securely.</p>
                </div>
                <div class="info-card">
                    <h4><i class="ri-store-line"></i> For Vendors</h4>
                    <p>We collect business information to verify your identity and showcase your services to potential customers.</p>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-stack-line"></i> How We Use Your Information</h2>
                <div class="list-grid">
                    <div class="list-grid-item">
                        <h5><i class="ri-service-line"></i> Provide Services</h5>
                        <p>To operate and maintain your account, process bookings, and facilitate payments</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-bar-chart-2-line"></i> Improve Platform</h5>
                        <p>To analyze usage patterns and enhance user experience</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-mail-send-line"></i> Communicate</h5>
                        <p>To send updates, confirmations, and important notifications</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-user-heart-line"></i> Personalize</h5>
                        <p>To recommend relevant vendors and services based on your preferences</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-shield-check-line"></i> Verify</h5>
                        <p>To verify vendor identities and ensure platform safety</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-lock-line"></i> Security</h5>
                        <p>To detect and prevent fraud, abuse, and security incidents</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-gavel-line"></i> Legal Compliance</h5>
                        <p>To comply with Ethiopian laws and regulations</p>
                    </div>
                    <div class="list-grid-item">
                        <h5><i class="ri-megaphone-line"></i> Marketing</h5>
                        <p>To send promotional communications (with your consent)</p>
                    </div>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-share-line"></i> Information Sharing</h2>
                <p>We do not sell your personal information. We may share your information only in these specific circumstances:</p>

                <h3>With Vendors</h3>
                <p>When you book a service, we share necessary information with the vendor to fulfill your booking, including your name, contact details, and booking requirements.</p>

                <h3>With Service Providers</h3>
                <p>We share information with trusted third parties who help us operate our platform:</p>
                <ul class="check-list">
                    <li><strong>Payment Processors:</strong> Chapa</li>
                    <li><strong>Cloud Services:</strong> Data hosting and storage</li>
                    <li><strong>Analytics:</strong> Google Analytics and similar tools</li>
                    <li><strong>Customer Support:</strong> Help desk software</li>
                </ul>
            </div>

            <div class="page-section">
                <h2><i class="ri-lock-line"></i> Data Security</h2>
                <div class="list-container">
                    <ul class="check-list">
                        <li><strong>Encryption:</strong> All data transmitted between your device and our servers is encrypted using SSL/TLS</li>
                        <li><strong>Access Controls:</strong> Strict access controls and authentication requirements for our team</li>
                        <li><strong>Regular Audits:</strong> Security assessments and vulnerability testing</li>
                        <li><strong>Secure Storage:</strong> Data stored in secure facilities</li>
                        <li><strong>Payment Security:</strong> Payment information is handled by PCI-DSS compliant partners</li>
                    </ul>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-user-star-line"></i> Your Rights and Choices</h2>
                <p>Under Ethiopian data protection law, you have the following rights:</p>
                <div class="list-container">
                    <ul class="check-list">
                        <li><strong>Correction:</strong> Update inaccurate or incomplete information</li>
                        <li><strong>Deletion:</strong> Request deletion of your data (subject to legal requirements)</li>
                        <li><strong>Restriction:</strong> Limit how we use your information</li>
                        <li><strong>Objection:</strong> Object to certain types of processing</li>
                        <li><strong>Portability:</strong> Receive your data in a structured, commonly used format</li>
                    </ul>
                </div>
            </div>



            <div class="page-section">
                <h2><i class="ri-calendar-line"></i> Data Retention</h2>
                <p>We retain your information for as long as necessary to:</p>
                <ul class="bullet-list">
                    <li>Provide you with our services</li>
                    <li>Comply with legal obligations</li>
                    <li>Resolve disputes</li>
                    <li>Enforce our agreements</li>
                </ul>
                <p>When information is no longer needed, we securely delete or anonymize it. Account information is typically retained for the duration of your account plus a reasonable period afterward to comply with legal requirements.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-user-line"></i> Children's Privacy</h2>
                <p>Our services are not intended for individuals under 18 years of age. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with information, please contact us immediately.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-earth-line"></i> International Data Transfers</h2>
                <p>Your information may be transferred to and processed in countries other than Ethiopia. We ensure appropriate safeguards are in place to protect your information in accordance with this policy.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-file-copy-line"></i> Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of significant changes through:</p>
                <ul class="bullet-list">
                    <li>Email notification (if you have an account)</li>
                    <li>Notice on our website</li>
                    <li>In-app notification</li>
                </ul>
                <p>We encourage you to review this policy periodically. Continued use of Vendora after changes constitutes acceptance of the updated policy.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-mail-send-line"></i> Contact Us</h2>
                <p>If you have questions, concerns, or requests regarding this Privacy Policy or your personal information, please contact our Data Protection Officer:</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Email</div>
                            <div class="contact-value">
                                <a href="mailto:privacy@vendora.com">privacy@vendora.com</a>
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
                                <a href="tel:+251471112233">+251 47 111 2233</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Address</div>
                            <div class="contact-value">Jimma, Ethiopia</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-time-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Response Time</div>
                            <div class="contact-value">Within 48 hours</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-note">
                <i class="ri-shield-check-line" style="color: var(--primary-gold); margin-right: 8px;"></i>
                Vendora is committed to protecting your privacy and building a trusted marketplace for the Jimma community.
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Vendora</h4>
                <p style="color: var(--text-light); margin-bottom: 16px; font-size: 14px;">Connecting you with trusted local vendors in Jimma and across Ethiopia.</p>
                <span class="ethiopia-badge">
                    <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                </span>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('help-center') }}">Help Center</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>For Vendors</h4>
                <ul>
                    <li><a href="{{ route('list-service') }}">List Your Service</a></li>
                    <li><a href="{{ route('vendor-resources') }}">Resources</a></li>
                    <li><a href="{{ route('success-stories') }}">Success Stories</a></li>
                    <li><a href="{{ route('community') }}">Community</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms.service') }}">Terms of Service</a></li>

                    <li><a href="{{ route('trust-safety') }}">Trust & Safety</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} Vendora Marketplace. All rights reserved. Jimma, Ethiopia</span>
            <div class="social-links">
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

        // Confirm logout
        document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });

                    // Close mobile menu if open
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                    }
                }
            });
        });
    </script>

    @if(app()->environment('local'))
    {{--  <script>
        console.log('Privacy Policy page loaded - Local environment');
    </script>  --}}
    @endif
</body>
</html>
