<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Careers - Vendora | Jimma, Ethiopia</title>
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

        /* Why Join Us Section */
        .why-join {
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .benefit-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius-lg);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .benefit-icon {
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

        .benefit-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .benefit-card p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Open Positions */
        .positions-section {
            margin-bottom: 80px;
        }

        .positions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .position-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid transparent;
        }

        .position-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .position-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .position-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .position-type {
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .position-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .position-location i {
            color: var(--primary-color);
        }

        .position-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .position-requirements {
            margin-bottom: 20px;
        }

        .requirements-title {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .requirements-list {
            list-style: none;
        }

        .requirements-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 13px;
            margin-bottom: 8px;
        }

        .requirements-list i {
            color: var(--success-color);
            font-size: 14px;
        }

        .position-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .position-salary {
            font-weight: 600;
            color: var(--primary-color);
        }

        .apply-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .apply-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Life at Vendora */
        .life-section {
            margin-bottom: 80px;
        }

        .life-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .life-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .life-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .life-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .life-content {
            padding: 24px;
        }

        .life-content h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .life-content p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Application Form */
        .application-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 60px 20px;
            border-radius: var(--radius-lg);
            margin-bottom: 60px;
        }

        .application-form {
            max-width: 600px;
            margin: 0 auto;
            background: var(--white);
            padding: 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background: rgba(184, 142, 63, 0.05);
        }

        .file-upload-icon {
            font-size: 32px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .file-upload-text {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .file-upload-hint {
            font-size: 12px;
            color: var(--text-light);
        }

        .file-input {
            display: none;
        }

        .file-preview {
            display: none;
            margin-top: 15px;
            padding: 12px;
            background: var(--bg-light);
            border-radius: var(--radius-md);
            align-items: center;
            gap: 12px;
        }

        .file-preview.active {
            display: flex;
        }

        .file-preview i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .file-preview-info {
            flex: 1;
        }

        .file-preview-name {
            font-weight: 500;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .file-preview-size {
            font-size: 11px;
            color: var(--text-light);
        }

        .file-preview-remove {
            color: var(--error-color);
            cursor: pointer;
            font-size: 18px;
        }

        .submit-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* FAQ Section */
        .faq-section {
            margin-bottom: 80px;
        }

        .faq-grid {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius-md);
            margin-bottom: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }

        .faq-question i {
            color: var(--primary-color);
            transition: transform 0.3s;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 20px 20px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            display: none;
        }

        .faq-answer.active {
            display: block;
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
            .benefits-grid { grid-template-columns: repeat(2, 1fr); }
            .positions-grid { grid-template-columns: 1fr; }
            .life-grid { grid-template-columns: repeat(2, 1fr); }
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

            .benefits-grid { grid-template-columns: 1fr; }
            .life-grid { grid-template-columns: 1fr; }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }

            .page-header h1 { font-size: 32px; }
            .section-title { font-size: 28px; }

            .application-form { padding: 30px 20px; }

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
            <a href="{{ route('careers') }}" class="nav-item active">Careers</a>
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
        <a href="{{ route('careers') }}" class="nav-item active">Careers</a>
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
        <h1>Join the <span>Vendora</span> Team</h1>
        <p>Help us connect communities with trusted local vendors across Ethiopia</p>
    </section>

    <main>
        <div class="container">
            <!-- Why Join Us Section -->
            <section class="why-join">
                <h2 class="section-title">Why Join Vendora?</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-heart-line"></i>
                        </div>
                        <h3>Purpose-Driven Work</h3>
                        <p>Make a real impact by helping local businesses thrive and communities connect.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-team-line"></i>
                        </div>
                        <h3>Great Team Culture</h3>
                        <p>Work with passionate, supportive colleagues who share your values.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                        <h3>Growth Opportunities</h3>
                        <p>Continuous learning and clear career progression paths.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-hand-heart-line"></i>
                        </div>
                        <h3>Competitive Benefits</h3>
                        <p>Health insurance, flexible hours, and competitive compensation.</p>
                    </div>
                </div>
            </section>

            <!-- Open Positions -->
            <section class="positions-section">
                <h2 class="section-title">Open Positions</h2>
                <div class="positions-grid">
                    <!-- Position 1 -->
                    <div class="position-card">
                        <div class="position-header">
                            <h3 class="position-title">Senior Full Stack Developer</h3>
                            <span class="position-type">Full-time</span>
                        </div>
                        <div class="position-location">
                            <i class="ri-map-pin-line"></i>
                            <span>Jimma / Remote</span>
                        </div>
                        <p class="position-description">
                            We're looking for an experienced Full Stack Developer to help build and scale our platform. You'll work on both frontend and backend, creating seamless experiences for vendors and customers.
                        </p>
                        <div class="position-requirements">
                            <div class="requirements-title">Requirements:</div>
                            <ul class="requirements-list">
                                <li><i class="ri-check-line"></i> 4+ years of experience with Laravel/PHP</li>
                                <li><i class="ri-check-line"></i> Strong JavaScript/Vue.js skills</li>
                                <li><i class="ri-check-line"></i> Experience with MySQL and database design</li>
                                <li><i class="ri-check-line"></i> Familiarity with REST APIs and microservices</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <span class="position-salary">Competitive Salary</span>
                            <a href="#application-form" class="apply-btn" onclick="document.getElementById('position_id').value='1'">
                                Apply Now <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Position 2 -->
                    <div class="position-card">
                        <div class="position-header">
                            <h3 class="position-title">Community Manager</h3>
                            <span class="position-type">Full-time</span>
                        </div>
                        <div class="position-location">
                            <i class="ri-map-pin-line"></i>
                            <span>Jimma (On-site)</span>
                        </div>
                        <p class="position-description">
                            Join our team to build and nurture relationships with vendors and customers in Jimma and beyond. You'll be the face of Vendora in the community.
                        </p>
                        <div class="position-requirements">
                            <div class="requirements-title">Requirements:</div>
                            <ul class="requirements-list">
                                <li><i class="ri-check-line"></i> 2+ years in community management or similar</li>
                                <li><i class="ri-check-line"></i> Excellent communication in Amharic and English</li>
                                <li><i class="ri-check-line"></i> Experience with social media management</li>
                                <li><i class="ri-check-line"></i> Passion for local business development</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <span class="position-salary">Competitive Salary</span>
                            <a href="#application-form" class="apply-btn" onclick="document.getElementById('position_id').value='2'">
                                Apply Now <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Position 3 -->
                    <div class="position-card">
                        <div class="position-header">
                            <h3 class="position-title">UI/UX Designer</h3>
                            <span class="position-type">Full-time</span>
                        </div>
                        <div class="position-location">
                            <i class="ri-map-pin-line"></i>
                            <span>Jimma / Remote</span>
                        </div>
                        <p class="position-description">
                            Design beautiful, intuitive experiences for our users. You'll work on both vendor and customer interfaces, making our platform easy and enjoyable to use.
                        </p>
                        <div class="position-requirements">
                            <div class="requirements-title">Requirements:</div>
                            <ul class="requirements-list">
                                <li><i class="ri-check-line"></i> 3+ years of UI/UX design experience</li>
                                <li><i class="ri-check-line"></i> Proficiency in Figma, Adobe XD</li>
                                <li><i class="ri-check-line"></i> Portfolio demonstrating user-centered design</li>
                                <li><i class="ri-check-line"></i> Experience with mobile-first design</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <span class="position-salary">Competitive Salary</span>
                            <a href="#application-form" class="apply-btn" onclick="document.getElementById('position_id').value='3'">
                                Apply Now <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Position 4 -->
                    <div class="position-card">
                        <div class="position-header">
                            <h3 class="position-title">Sales & Partnerships Lead</h3>
                            <span class="position-type">Full-time</span>
                        </div>
                        <div class="position-location">
                            <i class="ri-map-pin-line"></i>
                            <span>Jimma (On-site)</span>
                        </div>
                        <p class="position-description">
                            Drive our growth by building relationships with vendors and strategic partners across Ethiopia. You'll be key to expanding our vendor network.
                        </p>
                        <div class="position-requirements">
                            <div class="requirements-title">Requirements:</div>
                            <ul class="requirements-list">
                                <li><i class="ri-check-line"></i> 3+ years in sales or business development</li>
                                <li><i class="ri-check-line"></i> Strong network in Ethiopian business community</li>
                                <li><i class="ri-check-line"></i> Excellent negotiation and communication skills</li>
                                <li><i class="ri-check-line"></i> Fluent in Amharic and English</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <span class="position-salary">Competitive + Commission</span>
                            <a href="#application-form" class="apply-btn" onclick="document.getElementById('position_id').value='4'">
                                Apply Now <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Life at Vendora -->
            <section class="life-section">
                <h2 class="section-title">Life at Vendora</h2>
                <div class="life-grid">
                    <div class="life-card">
                        <div class="life-image">
                            <i class="ri-group-line"></i>
                        </div>
                        <div class="life-content">
                            <h3>Collaborative Culture</h3>
                            <p>We work together, learn together, and celebrate our wins as a team. Regular team-building events and workshops.</p>
                        </div>
                    </div>
                    <div class="life-card">
                        <div class="life-image">
                            <i class="ri-cake-line"></i>
                        </div>
                        <div class="life-content">
                            <h3>Celebrations & Traditions</h3>
                            <p>We honor Ethiopian traditions and celebrate holidays together, from Timkat to Enkutatash.</p>
                        </div>
                    </div>
                    <div class="life-card">
                        <div class="life-image">
                            <i class="ri-coffee-line"></i>
                        </div>
                        <div class="life-content">
                            <h3>Coffee Ceremonies</h3>
                            <p>Our office features traditional coffee ceremonies, bringing our team together around Ethiopia's favorite beverage.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Application Form -->
            <section id="application-form" class="application-section">
                <div class="application-form">
                    <h2 class="form-title">Apply Now</h2>
                    
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="position_id" id="position_id" value="">

                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-input" placeholder="+251 91 234 5678" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Position Applying For *</label>
                            <select name="position" class="form-select" required>
                                <option value="">Select a position</option>
                                <option value="1">Senior Full Stack Developer</option>
                                <option value="2">Community Manager</option>
                                <option value="3">UI/UX Designer</option>
                                <option value="4">Sales & Partnerships Lead</option>
                                <option value="5">Open Application</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Cover Letter</label>
                            <textarea name="cover_letter" class="form-textarea" placeholder="Tell us why you're interested in joining Vendora..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Resume/CV *</label>
                            <div class="file-upload-area" onclick="document.getElementById('resume').click()">
                                <i class="ri-upload-cloud-2-line file-upload-icon"></i>
                                <div class="file-upload-text">Click to upload or drag and drop</div>
                                <div class="file-upload-hint">PDF, DOC, DOCX (Max 5MB)</div>
                                <input type="file" id="resume" name="resume" class="file-input" accept=".pdf,.doc,.docx" required>
                            </div>
                            <div class="file-preview" id="filePreview">
                                <i class="ri-file-pdf-line"></i>
                                <div class="file-preview-info">
                                    <div class="file-preview-name" id="fileName"></div>
                                    <div class="file-preview-size" id="fileSize"></div>
                                </div>
                                <i class="ri-close-line file-preview-remove" onclick="clearFile()"></i>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="ri-send-plane-line"></i>
                            Submit Application
                        </button>
                    </form>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="faq-section">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>What is the hiring process?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Our typical hiring process includes: 1) Application review, 2) Initial phone screening, 3) Technical/interview, 4) Final interview with leadership, 5) Offer and onboarding.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>Do you offer remote work?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Yes! We offer flexible work arrangements including remote, hybrid, and on-site options depending on the role. We believe in work-life balance and trust our team to deliver results from wherever they work best.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>What benefits do you offer?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            We offer competitive salaries, health insurance, paid time off, professional development opportunities, flexible working hours, and a supportive team environment. We also celebrate Ethiopian holidays and host regular team events.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How can I check my application status?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            After submitting your application, you'll receive a confirmation email. Our team reviews applications within 1-2 weeks. If your qualifications match our needs, we'll contact you to schedule an interview.
                        </div>
                    </div>
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
                        <li><a href="#">Press</a></li>
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

        // File upload preview
        document.getElementById('resume').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = (file.size / 1024).toFixed(2) + ' KB';
                document.getElementById('filePreview').classList.add('active');
            }
        });

        function clearFile() {
            document.getElementById('resume').value = '';
            document.getElementById('filePreview').classList.remove('active');
        }

        // FAQ toggle
        function toggleFAQ(element) {
            element.classList.toggle('active');
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
        }

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

        // Set selected position from URL hash
        if (window.location.hash === '#application-form') {
            const hashParams = new URLSearchParams(window.location.search);
            const position = hashParams.get('position');
            if (position) {
                document.getElementById('position_id').value = position;
            }
        }
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Careers page loaded - Local environment');
    </script>
    @endif
</body>
</html>