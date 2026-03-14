<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Join as Customer or Vendor | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --bg-color: #F7F7F7;
            --text-dark: #333333;
            --text-gray: #777777;
            --white: #ffffff;
            --error-color: #D32F2F;
            --success-color: #388E3C;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.05);
            --border-color: #E0E0E0;
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
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.05) 0%, rgba(247, 247, 247, 0) 40%);
        }

        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 60px;
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-family: 'Inter-Bold', sans-serif;
            font-size: 28px;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            color: var(--primary-gold);
            font-size: 32px;
        }

        .menu-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--text-dark);
            padding: 8px;
            border-radius: 50%;
            transition: background 0.3s;
            display: none;
        }

        .menu-btn:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* Ethiopia Badge */
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

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .register-card {
            background: var(--white);
            width: 100%;
            max-width: 520px;
            padding: 48px;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Decorative element */
        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-gold), #d4af66);
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .card-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 700;
        }

        .card-header p {
            color: var(--text-gray);
            font-size: 15px;
            line-height: 1.5;
        }

        /* Account Type Switch Tabs */
        .account-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            padding: 4px;
            background: #f5f5f5;
            border-radius: 50px;
        }

        .account-tab {
            flex: 1;
            padding: 14px 20px;
            border: none;
            background: transparent;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .account-tab i {
            font-size: 18px;
        }

        .account-tab.active {
            background: var(--white);
            color: var(--primary-gold);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .account-tab:hover:not(.active) {
            color: var(--primary-gold);
        }

        /* Alert Messages */
        .alert {
            padding: 14px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
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
            background-color: #E8F5E9;
            color: var(--success-color);
            border: 1px solid #A5D6A5;
        }

        .alert-error {
            background-color: #FFEBEE;
            color: var(--error-color);
            border: 1px solid #FFCDD2;
        }

        /* Vendor Info Message */
        .vendor-info-message {
            background-color: #fef3e7;
            border-left: 4px solid var(--primary-gold);
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #7d5d2c;
        }

        .vendor-info-message i {
            color: var(--primary-gold);
            font-size: 20px;
        }

        /* Form */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 20px;
            transition: color 0.2s;
            z-index: 1;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            font-size: 20px;
            transition: color 0.2s;
            z-index: 1;
        }

        .toggle-password:hover {
            color: var(--primary-gold);
        }

        .form-control {
            width: 100%;
            padding: 16px 48px 16px 50px;
            font-size: 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background-color: #FAFAFA;
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23999' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 20px;
            padding-right: 56px;
        }

        textarea.form-control {
            padding: 16px;
            min-height: 100px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--error-color);
        }

        .form-control::placeholder {
            color: #BBBBBB;
        }

        .error-message {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Password Strength Meter */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background-color: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-progress {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-text {
            font-size: 12px;
            color: var(--text-gray);
        }

        .password-requirements {
            background-color: #f8f9fa;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            margin-top: 8px;
            font-size: 12px;
            color: var(--text-gray);
        }

        .password-requirements ul {
            list-style: none;
            margin-top: 6px;
        }

        .password-requirements li {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .password-requirements li.valid {
            color: var(--success-color);
        }

        .password-requirements li i {
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 24px 0 28px;
            font-size: 14px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-gray);
            user-select: none;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #D1D1D1;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            position: relative;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]:checked + .custom-checkbox {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }

        input[type="checkbox"]:checked + .custom-checkbox::after {
            content: "\EB7B";
            font-family: 'remixicon';
            color: white;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, #ca9e4b 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 142, 63, 0.4);
        }

        .btn-submit:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .login-prompt {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-gray);
            font-size: 15px;
        }

        .login-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 30px;
            transition: all 0.2s;
            margin-left: 8px;
        }

        .login-link:hover {
            background: #fef3e7;
            transform: translateY(-1px);
        }

        /* Footer minimal */
        .footer-minimal {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 12px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #999;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive Design */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 20px 40px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 18px 30px; }
            .logo { font-size: 24px; }
            .logo-icon { font-size: 28px; }
        }

        @media screen and (max-width: 900px) {
            .navbar { padding: 16px 28px; }
            .register-card { padding: 40px; }
            .card-header h1 { font-size: 26px; }
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 14px 20px;
            }

            .menu-btn {
                display: block;
            }

            .main-container {
                padding: 30px 16px;
            }

            .register-card {
                padding: 32px 24px;
                max-width: 100%;
            }

            .card-header h1 {
                font-size: 24px;
            }

            .account-tab {
                padding: 12px 16px;
                font-size: 14px;
            }

            .form-control {
                padding: 14px 44px 14px 46px;
                font-size: 15px;
            }

            .btn-submit {
                font-size: 16px;
                padding: 14px;
            }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 22px; }
            .logo-icon { font-size: 26px; }

            .register-card {
                padding: 28px 20px;
            }

            .card-header h1 {
                font-size: 22px;
            }

            .card-header p {
                font-size: 14px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-label {
                font-size: 13px;
            }

            .form-control {
                padding: 14px 40px 14px 44px;
                font-size: 14px;
            }

            .input-icon {
                font-size: 18px;
                left: 14px;
            }

            .toggle-password {
                font-size: 18px;
                right: 14px;
            }

            .btn-submit {
                padding: 14px;
                font-size: 15px;
            }
        }

        @media screen and (max-width: 480px) {
            .navbar {
                padding: 10px 14px;
            }

            .logo {
                font-size: 20px;
                gap: 4px;
            }

            .logo-icon {
                font-size: 24px;
            }

            .menu-btn {
                font-size: 22px;
                padding: 6px;
            }

            .main-container {
                padding: 20px 12px;
            }

            .register-card {
                padding: 24px 16px;
                border-radius: 16px;
            }

            .register-card::before {
                height: 5px;
            }

            .card-header {
                margin-bottom: 24px;
            }

            .card-header h1 {
                font-size: 20px;
            }

            .card-header p {
                font-size: 13px;
            }

            .account-tabs {
                gap: 8px;
                margin-bottom: 24px;
            }

            .account-tab {
                padding: 10px 12px;
                font-size: 13px;
            }

            .account-tab i {
                font-size: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 12px;
                margin-bottom: 6px;
            }

            .form-control {
                padding: 12px 36px 12px 42px;
                font-size: 14px;
                border-radius: 10px;
            }

            .input-icon {
                font-size: 16px;
                left: 12px;
            }

            .toggle-password {
                font-size: 16px;
                right: 12px;
            }

            .custom-checkbox {
                width: 18px;
                height: 18px;
            }

            input[type="checkbox"]:checked + .custom-checkbox::after {
                font-size: 12px;
            }

            .btn-submit {
                padding: 13px;
                font-size: 15px;
                border-radius: 10px;
            }

            .login-prompt {
                font-size: 13px;
                margin-top: 20px;
            }

            .footer-minimal {
                padding: 20px;
                font-size: 11px;
            }

            .footer-links {
                gap: 16px;
            }
        }

        @media screen and (max-width: 360px) {
            .navbar {
                padding: 8px 12px;
            }

            .logo {
                font-size: 18px;
            }

            .logo-icon {
                font-size: 22px;
            }

            .register-card {
                padding: 20px 14px;
            }

            .card-header h1 {
                font-size: 18px;
            }

            .card-header p {
                font-size: 12px;
            }

            .account-tab {
                padding: 8px 10px;
                font-size: 12px;
            }

            .form-control {
                padding: 10px 32px 10px 38px;
                font-size: 13px;
            }

            .btn-submit {
                padding: 12px;
                font-size: 14px;
            }

            .footer-minimal {
                padding: 16px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill logo-icon"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma
            </span>
        </a>
        <button class="menu-btn" aria-label="Menu" id="menuBtn">
            <i class="ri-menu-line"></i>
        </button>
    </nav>

    <div class="main-container">
        <div class="register-card">
            <div class="card-header">
                <h1 id="welcomeTitle">Create Your Account</h1>
                <p id="welcomeSubtitle">Join Vendora and start your journey</p>
            </div>

            <!-- Session Status Messages -->
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

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <!-- Account Type Selection Tabs -->
            <div class="account-tabs" id="accountTabs">
                <button type="button" class="account-tab active" data-role="customer" onclick="setAccountType('customer')">
                    <i class="ri-user-line"></i> Customer
                </button>
                <button type="button" class="account-tab" data-role="vendor" onclick="setAccountType('vendor')">
                    <i class="ri-store-line"></i> Vendor
                </button>
            </div>

            <!-- Vendor Info Message (Hidden by default) -->
            <div id="vendorInfoMessage" class="vendor-info-message" style="display: none;">
                <i class="ri-information-line"></i>
                <div>
                    <strong>Vendor Account Benefits:</strong>
                    <ul style="margin-top: 8px; margin-left: 20px; list-style: disc;">
                        <li>Create and manage your products</li>
                        <li>Track orders and sales</li>
                        <li>Communicate with customers</li>
                        <li>Access vendor dashboard</li>
                    </ul>
                    <p style="margin-top: 8px;"><strong>Note:</strong> Vendor accounts require admin approval before you can start selling.</p>
                </div>
            </div>

            <!-- Registration Form - FIXED: Changed action to route('register') -->
            <form method="POST" action="{{ route('register') }}" id="registerForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" id="selectedRole" value="customer">

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" class="form-label">Full Name *</label>
                    <div class="input-wrapper">
                        <i class="ri-user-line input-icon"></i>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') error @enderror"
                               placeholder="John Doe"
                               value="{{ old('name') }}"
                               required
                               autofocus>
                    </div>
                    @error('name')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address *</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line input-icon"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') error @enderror"
                               placeholder="you@example.com"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Phone Field (Optional for customers, required for vendors) -->
                <div class="form-group" id="phoneGroup">
                    <label for="phone" class="form-label" id="phoneLabel">Phone Number</label>
                    <div class="input-wrapper">
                        <i class="ri-phone-line input-icon"></i>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') error @enderror"
                               placeholder="+251 912 345 678"
                               value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Vendor Fields (Hidden by default) -->
                <div id="vendorFields" style="display: none;">
                    <!-- Business Name -->
                    <div class="form-group">
                        <label for="business_name" class="form-label">Business Name *</label>
                        <div class="input-wrapper">
                            <i class="ri-store-3-line input-icon"></i>
                            <input type="text"
                                   id="business_name"
                                   name="business_name"
                                   class="form-control @error('business_name') error @enderror"
                                   placeholder="Your Business Name"
                                   value="{{ old('business_name') }}">
                        </div>
                        @error('business_name')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Business Category -->
                    <div class="form-group">
                        <label for="category" class="form-label">Business Category *</label>
                        <div class="input-wrapper">
                            <i class="ri-grid-line input-icon"></i>
                            <select id="category" name="category" class="form-control @error('category') error @enderror">
                                <option value="">Select a category</option>
                                <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Restaurant</option>
                                <option value="photography" {{ old('category') == 'photography' ? 'selected' : '' }}>Photography</option>
                                <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home Services</option>
                                <option value="beauty" {{ old('category') == 'beauty' ? 'selected' : '' }}>Beauty & Spa</option>
                                <option value="automotive" {{ old('category') == 'automotive' ? 'selected' : '' }}>Automotive</option>
                                <option value="events" {{ old('category') == 'events' ? 'selected' : '' }}>Event Planning</option>
                                <option value="tech" {{ old('category') == 'tech' ? 'selected' : '' }}>Technology</option>
                                <option value="handicrafts" {{ old('category') == 'handicrafts' ? 'selected' : '' }}>Handicrafts</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        @error('category')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Business Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">Business Description</label>
                        <div class="input-wrapper">
                            <i class="ri-file-text-line input-icon" style="top: 20px; transform: none;"></i>
                            <textarea id="description"
                                      name="description"
                                      class="form-control @error('description') error @enderror"
                                      placeholder="Tell us about your business...">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Business Address -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <div class="input-wrapper">
                                <i class="ri-map-pin-line input-icon"></i>
                                <select
                                    id="city"
                                    name="city"
                                    class="form-control @error('city') error @enderror"
                                >
                                    <option value="">Select city (Ethiopia)</option>
                                    <option value="Addis Ababa" {{ old('city') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                    <option value="Jimma" {{ old('city') == 'Jimma' ? 'selected' : '' }}>Jimma</option>
                                    <option value="Dire Dawa" {{ old('city') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                                    <option value="Bahir Dar" {{ old('city') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                                    <option value="Mekelle" {{ old('city') == 'Mekelle' ? 'selected' : '' }}>Mekelle</option>
                                    <option value="Adama" {{ old('city') == 'Adama' ? 'selected' : '' }}>Adama</option>
                                    <option value="Hawassa" {{ old('city') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                                    <option value="Gondar" {{ old('city') == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                                    <option value="Dessie" {{ old('city') == 'Dessie' ? 'selected' : '' }}>Dessie</option>
                                    <option value="Jijiga" {{ old('city') == 'Jijiga' ? 'selected' : '' }}>Jijiga</option>
                                    <option value="Shashamane" {{ old('city') == 'Shashamane' ? 'selected' : '' }}>Shashamane</option>
                                    <option value="Harar" {{ old('city') == 'Harar' ? 'selected' : '' }}>Harar</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="state" class="form-label">State/Region</label>
                            <div class="input-wrapper">
                                <i class="ri-government-line input-icon"></i>
                                <select
                                    id="state"
                                    name="state"
                                    class="form-control @error('state') error @enderror"
                                >
                                    <option value="">Select region</option>
                                    <option value="Oromia" {{ old('state') == 'Oromia' ? 'selected' : '' }}>Oromia</option>
                                    <option value="Amhara" {{ old('state') == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                    <option value="Tigray" {{ old('state') == 'Tigray' ? 'selected' : '' }}>Tigray</option>
                                    <option value="Addis Ababa" {{ old('state') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                    <option value="Dire Dawa" {{ old('state') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                                    <option value="Somali" {{ old('state') == 'Somali' ? 'selected' : '' }}>Somali</option>
                                    <option value="Afar" {{ old('state') == 'Afar' ? 'selected' : '' }}>Afar</option>
                                    <option value="Benishangul-Gumuz" {{ old('state') == 'Benishangul-Gumuz' ? 'selected' : '' }}>Benishangul-Gumuz</option>
                                    <option value="SNNPR" {{ old('state') == 'SNNPR' ? 'selected' : '' }}>SNNPR</option>
                                    <option value="Gambela" {{ old('state') == 'Gambela' ? 'selected' : '' }}>Gambela</option>
                                    <option value="Harari" {{ old('state') == 'Harari' ? 'selected' : '' }}>Harari</option>
                                    <option value="Sidama" {{ old('state') == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                                    <option value="South West Ethiopia Peoples" {{ old('state') == 'South West Ethiopia Peoples' ? 'selected' : '' }}>South West Ethiopia Peoples</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="form-group">
                        <label for="website" class="form-label">Website (Optional)</label>
                        <div class="input-wrapper">
                            <i class="ri-global-line input-icon"></i>
                            <input type="url"
                                   id="website"
                                   name="website"
                                   class="form-control @error('website') error @enderror"
                                   placeholder="https://example.com"
                                   value="{{ old('website') }}">
                        </div>
                        @error('website')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Password Fields Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Password *</label>
                        <div class="input-wrapper">
                            <i class="ri-lock-2-line input-icon"></i>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') error @enderror"
                                   placeholder="Create a password"
                                   required
                                   onkeyup="checkPasswordStrength(this.value)">
                            <i class="ri-eye-off-line toggle-password" onclick="togglePassword('password')"></i>
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-progress" id="strengthProgress"></div>
                            </div>
                            <span class="strength-text" id="strengthText">Enter a password</span>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <div class="input-wrapper">
                            <i class="ri-lock-2-line input-icon"></i>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm your password"
                                   required
                                   onkeyup="checkPasswordMatch()">
                            <i class="ri-eye-off-line toggle-password" onclick="togglePassword('password_confirmation')"></i>
                        </div>
                        <div id="passwordMatchMessage" class="error-message" style="display: none;"></div>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="password-requirements" id="passwordRequirements">
                    <span>Password must contain:</span>
                    <ul>
                        <li id="req-length"><i class="ri-close-line" style="color: var(--error-color);"></i> At least 8 characters</li>
                        <li id="req-uppercase"><i class="ri-close-line" style="color: var(--error-color);"></i> At least one uppercase letter</li>
                        <li id="req-lowercase"><i class="ri-close-line" style="color: var(--error-color);"></i> At least one lowercase letter</li>
                        <li id="req-number"><i class="ri-close-line" style="color: var(--error-color);"></i> At least one number</li>
                        <li id="req-special"><i class="ri-close-line" style="color: var(--error-color);"></i> At least one special character</li>
                    </ul>
                </div>

                <!-- Terms and Conditions -->
                  <div class="form-group">
                      <label class="checkbox-wrapper">
                          <input type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                          <span class="custom-checkbox"></span>
                          <span>I agree to the <a href="{{ route('terms-of-service') }}" target="_blank" style="color: var(--primary-gold); text-decoration: none;">Terms of Service</a> and <a href="{{ route('privacy-policy') }}" target="_blank" style="color: var(--primary-gold); text-decoration: none;">Privacy Policy</a></span>
                      </label>
                      @error('terms')
                          <div class="error-message">
                              <i class="ri-error-warning-fill"></i> {{ $message }}
                          </div>
                      @enderror
                  </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Create Account</span>
                </button>

                <!-- Login Link -->
                <div class="login-prompt">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="login-link">
                        <i class="ri-login-box-line"></i> Sign In
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="footer-minimal">
        <div>&copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia</div>
        <div class="footer-links">
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
            <a href="{{ route('terms-of-service') }}">Terms of Service</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Account type selection function
        function setAccountType(type) {
            // Update hidden input
            document.getElementById('selectedRole').value = type;

            // Update active tab
            document.querySelectorAll('.account-tab').forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.role === type) {
                    tab.classList.add('active');
                }
            });

            // Update UI based on account type
            const welcomeTitle = document.getElementById('welcomeTitle');
            const welcomeSubtitle = document.getElementById('welcomeSubtitle');
            const vendorFields = document.getElementById('vendorFields');
            const vendorMessage = document.getElementById('vendorInfoMessage');
            const phoneLabel = document.getElementById('phoneLabel');
            const phoneInput = document.getElementById('phone');

            if (type === 'vendor') {
                welcomeTitle.textContent = 'Join as Vendor';
                welcomeSubtitle.textContent = 'Start selling your products and services';
                vendorFields.style.display = 'block';
                vendorMessage.style.display = 'flex';
                phoneLabel.innerHTML = 'Phone Number *';
                phoneInput.required = true;
                
                // Make vendor fields required
                document.getElementById('business_name').required = true;
                document.getElementById('category').required = true;
            } else {
                welcomeTitle.textContent = 'Join as Customer';
                welcomeSubtitle.textContent = 'Discover amazing products and services';
                vendorFields.style.display = 'none';
                vendorMessage.style.display = 'none';
                phoneLabel.innerHTML = 'Phone Number (Optional)';
                phoneInput.required = false;
                
                // Make vendor fields not required
                document.getElementById('business_name').required = false;
                document.getElementById('category').required = false;
            }

            // Save to localStorage
            localStorage.setItem('lastAccountType', type);
        }

        // Password visibility toggle
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = input.nextElementSibling;
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            } else {
                input.type = 'password';
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthProgress = document.getElementById('strengthProgress');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength += 20;
            
            // Check for uppercase
            if (/[A-Z]/.test(password)) strength += 20;
            
            // Check for lowercase
            if (/[a-z]/.test(password)) strength += 20;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 20;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            // Update progress bar
            strengthProgress.style.width = strength + '%';
            
            // Update color based on strength
            if (strength <= 20) {
                strengthProgress.style.backgroundColor = '#D32F2F';
                strengthText.textContent = 'Weak password';
            } else if (strength <= 40) {
                strengthProgress.style.backgroundColor = '#F57C00';
                strengthText.textContent = 'Fair password';
            } else if (strength <= 60) {
                strengthProgress.style.backgroundColor = '#FBC02D';
                strengthText.textContent = 'Good password';
            } else if (strength <= 80) {
                strengthProgress.style.backgroundColor = '#7CB342';
                strengthText.textContent = 'Strong password';
            } else {
                strengthProgress.style.backgroundColor = '#388E3C';
                strengthText.textContent = 'Very strong password';
            }
            
            // Update requirements checklist
            updatePasswordRequirements(password);
        }

        // Update password requirements checklist
        function updatePasswordRequirements(password) {
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };
            
            for (const [key, valid] of Object.entries(requirements)) {
                const element = document.getElementById(`req-${key}`);
                const icon = element.querySelector('i');
                
                if (valid) {
                    icon.className = 'ri-check-line';
                    icon.style.color = 'var(--success-color)';
                    element.classList.add('valid');
                } else {
                    icon.className = 'ri-close-line';
                    icon.style.color = 'var(--error-color)';
                    element.classList.remove('valid');
                }
            }
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchMessage = document.getElementById('passwordMatchMessage');
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchMessage.style.display = 'none';
                    document.getElementById('password_confirmation').classList.remove('error');
                } else {
                    matchMessage.style.display = 'flex';
                    matchMessage.innerHTML = '<i class="ri-error-warning-fill"></i> Passwords do not match';
                    document.getElementById('password_confirmation').classList.add('error');
                }
            } else {
                matchMessage.style.display = 'none';
                document.getElementById('password_confirmation').classList.remove('error');
            }
        }

        // Form submission with loading state
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            // Don't disable if already disabled (prevents double submission)
            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }

            // Check if passwords match
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

            // Disable button and show spinner
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Creating Account...';
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Input focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--primary-gold)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#999';
            });
        });

        // FIXED: Check URL parameters to set initial account type
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            
            if (type === 'vendor') {
                setAccountType('vendor');
            } else if (type === 'customer') {
                setAccountType('customer');
            } else {
                // Load from localStorage or default to customer
                const lastType = localStorage.getItem('lastAccountType');
                if (lastType && ['customer', 'vendor'].includes(lastType)) {
                    setAccountType(lastType);
                } else {
                    setAccountType('customer');
                }
            }
        });

        // Check for old input values to restore vendor fields
        @if(old('role') === 'vendor')
            setAccountType('vendor');
        @endif

        // Reset button state when page loads (in case of back navigation)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Create Account</span>';
            }
        });

        // Mobile menu toggle
        document.getElementById('menuBtn')?.addEventListener('click', function() {
            console.log('Menu clicked');
        });

        // Email validation on blur
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = '<i class="ri-error-warning-fill"></i> Please enter a valid email address';
                
                const existingError = this.parentElement.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }
                
                this.parentElement.parentElement.appendChild(errorDiv);
                this.classList.add('error');
            } else {
                this.classList.remove('error');
                const existingError = this.parentElement.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }
            }
        });

        // Phone number formatting for Ethiopian numbers
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length > 0) {
                if (value.startsWith('251')) {
                    // Already has country code
                    if (value.length > 12) value = value.slice(0, 12);
                } else if (value.startsWith('0')) {
                    // Local format, add country code
                    value = '251' + value.slice(1);
                    if (value.length > 12) value = value.slice(0, 12);
                } else {
                    // Assume local without leading 0
                    value = '251' + value;
                    if (value.length > 12) value = value.slice(0, 12);
                }
                
                // Format for display
                if (value.length >= 5) {
                    value = '+' + value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
                }
                
                e.target.value = value;
            }
        });
    </script>
</body>
</html>