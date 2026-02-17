<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>How It Works - Vendora | Jimma, Ethiopia</title>
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
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
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

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
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
            max-width: 700px;
            margin: 0 auto;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Overview Section */
        .overview-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            margin-bottom: 80px;
        }

        .overview-content h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .overview-content h2 span {
            color: var(--primary-color);
        }

        .overview-content p {
            color: var(--text-light);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .overview-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .overview-stat {
            background: var(--white);
            padding: 20px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow);
            text-align: center;
        }

        .overview-stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .overview-stat-label {
            color: var(--text-light);
            font-size: 13px;
        }

        .overview-image {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overview-image i {
            font-size: 120px;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            bottom: 20px;
        }

        .overview-image-content {
            position: relative;
            z-index: 2;
        }

        .overview-image h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .overview-image p {
            opacity: 0.9;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Section Title */
        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 50px;
            text-align: center;
        }

        .section-title span {
            color: var(--primary-color);
            position: relative;
        }

        .section-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 10px;
            background-color: rgba(184, 142, 63, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        /* Role Tabs */
        .role-tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .role-tab {
            padding: 12px 40px;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            background: var(--white);
        }

        .role-tab.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .role-tab:hover {
            border-color: var(--primary-color);
        }

        /* For Customers Section */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .step-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 35px 25px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            position: relative;
        }

        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto 25px;
            position: relative;
            z-index: 2;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 40px;
            right: -15px;
            width: 30px;
            height: 2px;
            background: var(--border-color);
            display: none;
        }

        .step-card:last-child::before {
            display: none;
        }

        .step-icon {
            font-size: 48px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .step-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .step-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
        }

        /* For Vendors Section */
        .vendor-process {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.03) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 60px;
            margin-bottom: 60px;
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .process-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 35px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .process-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .process-icon {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--primary-color);
            font-size: 36px;
        }

        .process-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .process-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
        }

        .verification-badge {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 20px;
        }

        /* Payment Section */
        .payment-section {
            margin-bottom: 60px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            max-width: 800px;
            margin: 0 auto;
        }

        .payment-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .payment-icon {
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

        .payment-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .payment-description {
            color: var(--text-light);
            font-size: 13px;
            line-height: 1.6;
        }

        /* Trust Section */
        .trust-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 60px;
            margin-bottom: 60px;
            color: white;
        }

        .trust-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            text-align: center;
        }

        .trust-item {
            padding: 20px;
        }

        .trust-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }

        .trust-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .trust-text {
            opacity: 0.9;
            font-size: 14px;
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius-md);
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .faq-question:hover {
            background: rgba(184, 142, 63, 0.02);
        }

        .faq-question i {
            color: var(--primary-color);
            transition: transform 0.3s;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 25px 20px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            display: none;
        }

        .faq-answer.active {
            display: block;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 60px;
            text-align: center;
            color: white;
        }

        .cta-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-text {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            background: white;
            color: var(--primary-color);
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .cta-btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .cta-btn-outline:hover {
            background: white;
            color: var(--primary-color);
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

            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .process-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .payment-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .trust-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }

            .overview-section {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 32px;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 60px 20px; }
            .page-header h1 { font-size: 36px; }

            .role-tabs {
                flex-direction: column;
                align-items: center;
            }

            .role-tab {
                width: 200px;
                text-align: center;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .process-grid {
                grid-template-columns: 1fr;
            }

            .payment-grid {
                grid-template-columns: 1fr;
            }

            .trust-grid {
                grid-template-columns: 1fr;
            }

            .vendor-process {
                padding: 30px 20px;
            }

            .trust-section {
                padding: 40px 20px;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .cta-title {
                font-size: 28px;
            }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }

            .page-header h1 { font-size: 32px; }

            .overview-content h2 {
                font-size: 28px;
            }

            .overview-stats {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
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

    @if(session('info'))
        <div class="alert alert-info">
            <i class="ri-information-line"></i>
            {{ session('info') }}
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
            <a href="{{ route('how-it-works') }}" class="nav-item active">How It Works</a>
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
        <a href="{{ route('how-it-works') }}" class="nav-item active">How It Works</a>
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
        <h1>How <span>Vendora</span> Works</h1>
        <p>A simple, secure platform connecting you with trusted local vendors in Jimma and across Ethiopia</p>
    </section>

    <main>
        <div class="container">
            <!-- Overview Section -->
            <section class="overview-section">
                <div class="overview-content">
                    <h2>Your Gateway to <span>Local Services</span></h2>
                    <p>Vendora is Ethiopia's premier marketplace for finding trusted local professionals. Whether you need a plumber, photographer, caterer, or any other service, we make it easy to find, book, and pay verified vendors in your area.</p>

                    <div class="overview-stats">
                        <div class="overview-stat">
                            <div class="overview-stat-value">{{ $vendorCount ?? '500+' }}</div>
                            <div class="overview-stat-label">Verified Vendors</div>
                        </div>
                        <div class="overview-stat">
                            <div class="overview-stat-value">{{ $customerCount ?? '10k+' }}</div>
                            <div class="overview-stat-label">Happy Customers</div>
                        </div>
                        <div class="overview-stat">
                            <div class="overview-stat-value">{{ $bookingCount ?? '5k+' }}</div>
                            <div class="overview-stat-label">Successful Bookings</div>
                        </div>
                        <div class="overview-stat">
                            <div class="overview-stat-value">{{ $cityCount ?? '15+' }}</div>
                            <div class="overview-stat-label">Cities Served</div>
                        </div>
                    </div>
                </div>
                <div class="overview-image">
                    <div class="overview-image-content">
                        <h3>Simple. Fast. Trusted.</h3>
                        <p>Find the right professional for any job in just a few clicks</p>
                    </div>
                    <i class="ri-store-3-line"></i>
                </div>
            </section>

            <!-- Role Tabs -->
            <div class="role-tabs">
                <div class="role-tab active" onclick="showCustomerSteps()" id="customerTab">For Customers</div>
                <div class="role-tab" onclick="showVendorSteps()" id="vendorTab">For Vendors</div>
            </div>

            <!-- For Customers Section -->
            <section id="customerSteps" class="customer-section">
                <h2 class="section-title">How to <span>Find & Book</span> Services</h2>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="ri-search-line"></i>
                        </div>
                        <h3 class="step-title">Search</h3>
                        <p class="step-description">Browse categories or search for specific services. Filter by location, rating, price, and availability.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="ri-file-copy-line"></i>
                        </div>
                        <h3 class="step-title">Compare</h3>
                        <p class="step-description">View vendor profiles, read reviews, check ratings, and compare prices to find the perfect match.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                        <h3 class="step-title">Book</h3>
                        <p class="step-description">Select your preferred date and time, confirm details, and book securely through our platform.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="ri-star-line"></i>
                        </div>
                        <h3 class="step-title">Review</h3>
                        <p class="step-description">After service completion, leave a review to help others and earn rewards for your feedback.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('search.results') }}" class="cta-btn" style="background: var(--primary-color); color: white; display: inline-flex;">
                        <i class="ri-search-line"></i>
                        Find Services Now
                    </a>
                </div>
            </section>

            <!-- For Vendors Section -->
            <section id="vendorSteps" class="vendor-section" style="display: none;">
                <h2 class="section-title">How to <span>Start & Grow</span> Your Business</h2>

                <div class="vendor-process">
                    <div class="process-grid">
                        <div class="process-card">
                            <div class="process-icon">
                                <i class="ri-user-add-line"></i>
                            </div>
                            <h3 class="process-title">1. Create Account</h3>
                            <p class="process-description">Sign up as a vendor and provide your basic business information. It's free and takes just 5 minutes.</p>
                        </div>
                        <div class="process-card">
                            <div class="process-icon">
                                <i class="ri-shield-check-line"></i>
                            </div>
                            <h3 class="process-title">2. Get Verified</h3>
                            <p class="process-description">Submit your business license, ID, and other documents. Our team verifies within 24-48 hours.</p>
                            <span class="verification-badge">Verified Badge</span>
                        </div>
                        <div class="process-card">
                            <div class="process-icon">
                                <i class="ri-store-line"></i>
                            </div>
                            <h3 class="process-title">3. Set Up Profile</h3>
                            <p class="process-description">Create your profile, add photos, list your services, set prices, and define your availability.</p>
                        </div>
                    </div>
                </div>

                <div class="steps-grid" style="margin-top: 30px;">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="ri-message-line"></i>
                        </div>
                        <h3 class="step-title">Receive Bookings</h3>
                        <p class="step-description">Get notified when customers book your services. Communicate through our secure messaging system.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">5</div>
                        <div class="step-icon">
                            <i class="ri-customer-service-line"></i>
                        </div>
                        <h3 class="step-title">Deliver Service</h3>
                        <p class="step-description">Provide excellent service to your customers. Build your reputation with every job.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">6</div>
                        <div class="step-icon">
                            <i class="ri-bank-card-line"></i>
                        </div>
                        <h3 class="step-title">Get Paid</h3>
                        <p class="step-description">Receive payments securely through Chapa or cash on delivery. Withdraw anytime.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">7</div>
                        <div class="step-icon">
                            <i class="ri-bar-chart-line"></i>
                        </div>
                        <h3 class="step-title">Grow</h3>
                        <p class="step-description">Get more visibility with good ratings, access analytics, and grow your customer base.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('register') }}" class="cta-btn" style="background: var(--primary-color); color: white; display: inline-flex;">
                        <i class="ri-store-line"></i>
                        Become a Vendor
                    </a>
                </div>
            </section>

            <!-- Payment Methods -->
            <section class="payment-section">
                <h2 class="section-title">Secure <span>Payment</span> Options</h2>
                <div class="payment-grid">
                    <div class="payment-card">
                        <div class="payment-icon">
                            <i class="ri-bank-card-line"></i>
                        </div>
                        <h3 class="payment-title">Chapa</h3>
                        <p class="payment-description">Secure online payments with Ethiopia's trusted payment gateway. Pay with cards or mobile money.</p>
                    </div>
                    <div class="payment-card">
                        <div class="payment-icon">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                        <h3 class="payment-title">Cash on Delivery</h3>
                        <p class="payment-description">Pay in cash when the service is delivered. Available for eligible services.</p>
                    </div>
                </div>
            </section>

            <!-- Trust & Safety -->
            <section class="trust-section">
                <h2 class="section-title" style="color: white;">Trust & <span style="color: white;">Safety</span></h2>
                <div class="trust-grid">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <h3 class="trust-title">Verified Vendors</h3>
                        <p class="trust-text">All vendors undergo strict identity and business verification before joining</p>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="ri-lock-line"></i>
                        </div>
                        <h3 class="trust-title">Secure Payments</h3>
                        <p class="trust-text">Your payment information is encrypted and never shared with third parties</p>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="ri-customer-service-line"></i>
                        </div>
                        <h3 class="trust-title">24/7 Support</h3>
                        <p class="trust-text">Our support team is always available to help with any issues or questions</p>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="faq-section">
                <h2 class="section-title">Frequently Asked <span>Questions</span></h2>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Is Vendora free to use?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Yes! Creating an account and browsing vendors is completely free for customers. Vendors pay a small commission only when they successfully complete a booking through our platform.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I know a vendor is reliable?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        All vendors are verified through our multi-step verification process. You can also check their ratings, read reviews from real customers, and see their completed bookings count on their profile.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>What if I need to cancel a booking?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        You can cancel through your dashboard. Cancellation policies vary by vendor and are clearly stated on their profile. Free cancellations are available within the specified time frame.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I get paid as a vendor?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Vendors receive payments through their preferred method: Chapa or cash on delivery. Payments are processed within 24-48 hours after service completion. You can track all transactions in your dashboard.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Is my personal information safe?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Absolutely. We use industry-standard encryption to protect your data. We never share your personal information with third parties without your explicit consent. Read our privacy policy for more details.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How long does vendor verification take?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Vendor verification typically takes 24-48 hours after all required documents are submitted. You'll receive email updates throughout the process and can check your status in your dashboard.
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-text">Join thousands of customers and vendors already using Vendora to connect and grow.</p>
                <div class="cta-buttons">
                    @guest
                        <a href="{{ route('register') }}" class="cta-btn">
                            <i class="ri-user-line"></i>
                            Sign Up as Customer
                        </a>
                        <a href="{{ route('register') }}?type=vendor" class="cta-btn cta-btn-outline">
                            <i class="ri-store-line"></i>
                            Become a Vendor
                        </a>
                    @else
                        @if(Auth::user()->role === 'vendor')
                            <a href="{{ route('vendor.dashboard') }}" class="cta-btn">
                                <i class="ri-dashboard-line"></i>
                                Go to Dashboard
                            </a>
                        @elseif(Auth::user()->role === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="cta-btn">
                                <i class="ri-dashboard-line"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="cta-btn">
                                <i class="ri-dashboard-line"></i>
                                Go to Dashboard
                            </a>
                        @endif
                        <a href="{{ route('search.results') }}" class="cta-btn cta-btn-outline">
                            <i class="ri-search-line"></i>
                            Explore Vendors
                        </a>
                    @endguest
                </div>
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
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="{{ route('how-it-works') }}">How it works</a></li>
                        <li><a href="{{ route('trust-safety') }}">Trust & Safety</a></li>
                        <li><a href="{{ route('help-center') }}">Help Center</a></li>
                        <li><a href="{{ route('invite') }}">Invite Friends</a></li>
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

        // Role tabs functionality
        function showCustomerSteps() {
            document.getElementById('customerSteps').style.display = 'block';
            document.getElementById('vendorSteps').style.display = 'none';
            document.getElementById('customerTab').classList.add('active');
            document.getElementById('vendorTab').classList.remove('active');
        }

        function showVendorSteps() {
            document.getElementById('customerSteps').style.display = 'none';
            document.getElementById('vendorSteps').style.display = 'block';
            document.getElementById('vendorTab').classList.add('active');
            document.getElementById('customerTab').classList.remove('active');
        }

        // FAQ toggle function
        function toggleFAQ(element) {
            element.classList.toggle('active');
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
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
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('How It Works page loaded - Local environment');
    </script>
    @endif
</body>
</html>