<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Customer & Vendor Login | Jimma, Ethiopia</title>
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

        .login-card {
            background: var(--white);
            width: 100%;
            max-width: 480px;
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
        .login-card::before {
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

        /* Role Switch Tabs */
        .role-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            padding: 4px;
            background: #f5f5f5;
            border-radius: 50px;
        }

        .role-tab {
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

        .role-tab i {
            font-size: 18px;
        }

        .role-tab.active {
            background: var(--white);
            color: var(--primary-gold);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .role-tab:hover:not(.active) {
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
        .form-group {
            margin-bottom: 24px;
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

        .forgot-link {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--primary-gold);
            text-decoration: underline;
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

        .signup-prompt {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-gray);
            font-size: 15px;
        }

        .signup-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 12px;
        }

        .signup-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 30px;
            transition: all 0.2s;
        }

        .signup-link:hover {
            background: #fef3e7;
            transform: translateY(-1px);
        }

        .signup-link i {
            font-size: 16px;
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
            .login-card { padding: 40px; }
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

            .login-card {
                padding: 32px 24px;
                max-width: 100%;
            }

            .card-header h1 {
                font-size: 24px;
            }

            .role-tab {
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

            .signup-links {
                flex-direction: column;
                gap: 8px;
                align-items: center;
            }

            .signup-link {
                width: 100%;
                justify-content: center;
            }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 22px; }
            .logo-icon { font-size: 26px; }

            .login-card {
                padding: 28px 20px;
            }

            .card-header h1 {
                font-size: 22px;
            }

            .card-header p {
                font-size: 14px;
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

            .form-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 24px;
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

            .login-card {
                padding: 24px 16px;
                border-radius: 16px;
            }

            .login-card::before {
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

            .role-tabs {
                gap: 8px;
                margin-bottom: 24px;
            }

            .role-tab {
                padding: 10px 12px;
                font-size: 13px;
            }

            .role-tab i {
                font-size: 16px;
            }

            .form-group {
                margin-bottom: 20px;
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

            .signup-prompt {
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

            .login-card {
                padding: 20px 14px;
            }

            .card-header h1 {
                font-size: 18px;
            }

            .card-header p {
                font-size: 12px;
            }

            .role-tab {
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
        <div class="login-card">
            <div class="card-header">
                <h1 id="welcomeTitle">Welcome Back</h1>
                <p id="welcomeSubtitle">Sign in to continue to your account</p>
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

            <!-- Role Selection Tabs -->
            <div class="role-tabs" id="roleTabs">
                <button type="button" class="role-tab active" data-role="customer" onclick="setRole('customer')">
                    <i class="ri-user-line"></i> Customer
                </button>
                <button type="button" class="role-tab" data-role="vendor" onclick="setRole('vendor')">
                    <i class="ri-store-line"></i> Vendor
                </button>
                <button type="button" class="role-tab" data-role="admin" onclick="setRole('admin')">
                    <i class="ri-shield-user-line"></i> Admin
                </button>
            </div>

            <!-- Vendor Info Message (Hidden by default) -->
            <div id="vendorInfoMessage" class="vendor-info-message" style="display: none;">
                <i class="ri-information-line"></i>
                <span>Vendor accounts require admin approval. If your account is not approved yet, you won't be able to login.</span>
            </div>

            <!-- Admin Info Message (Hidden by default) -->
            <div id="adminInfoMessage" class="vendor-info-message" style="display: none; background-color: #ffebee; border-left-color: var(--error-color);">
                <i class="ri-shield-keyhole-line"></i>
                <span>Admin access is restricted to authorized personnel only.</span>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.authenticate') }}" id="loginForm">
                @csrf
                <input type="hidden" name="role" id="selectedRole" value="customer">

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label" id="emailLabel">Email Address</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line input-icon" id="emailIcon"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') error @enderror"
                               placeholder="Enter your email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="email">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-2-line input-icon"></i>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') error @enderror"
                               placeholder="Enter your password"
                               required
                               autocomplete="current-password">
                        <i class="ri-eye-off-line toggle-password" onclick="togglePassword(this)"></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-actions">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-checkbox"></span>
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Sign In</span>
                </button>

                <!-- Sign Up Links -->
                <div class="signup-prompt">
                    <span>Don't have an account?</span>
                    <div class="signup-links">
                        <a href="{{ route('register.customer') }}" class="signup-link">
                            <i class="ri-user-line"></i> Join as Customer
                        </a>
                        <a href="{{ route('register') }}" class="signup-link">
                            <i class="ri-store-line"></i> Join as Vendor
                        </a>
                    </div>
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

        // Role selection function
        function setRole(role) {
            // Update hidden input
            document.getElementById('selectedRole').value = role;

            // Update active tab
            document.querySelectorAll('.role-tab').forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.role === role) {
                    tab.classList.add('active');
                }
            });

            // Update welcome text based on role
            const title = document.getElementById('welcomeTitle');
            const subtitle = document.getElementById('welcomeSubtitle');
            const emailField = document.getElementById('email');
            const vendorMessage = document.getElementById('vendorInfoMessage');
            const adminMessage = document.getElementById('adminInfoMessage');

            // Hide all messages first
            vendorMessage.style.display = 'none';
            adminMessage.style.display = 'none';

            if (role === 'vendor') {
                title.textContent = 'Welcome Vendor!';
                subtitle.textContent = 'Sign in to manage your store';
                emailField.placeholder = 'Enter your business email';
                vendorMessage.style.display = 'flex';
            } else if (role === 'admin') {
                title.textContent = 'Admin Login';
                subtitle.textContent = 'Sign in to access admin dashboard';
                emailField.placeholder = 'Enter your admin email';
                adminMessage.style.display = 'flex';
            } else {
                title.textContent = 'Welcome Back!';
                subtitle.textContent = 'Sign in to continue to your account';
                emailField.placeholder = 'Enter your email';
            }

            // Save to localStorage
            localStorage.setItem('lastLoginRole', role);
        }

        // Password visibility toggle
        function togglePassword(element) {
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
                element.classList.remove('ri-eye-off-line');
                element.classList.add('ri-eye-line');
            } else {
                input.type = 'password';
                element.classList.remove('ri-eye-line');
                element.classList.add('ri-eye-off-line');
            }
        }

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            // Don't disable if already disabled (prevents double submission)
            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }

            // Disable button and show spinner
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Signing in...';
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

        // Prevent double submission with a flag
        let submitted = false;
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;

            // Reset the flag after 5 seconds (in case of network issues)
            setTimeout(() => {
                submitted = false;
            }, 5000);
        });

        // Load last selected role from localStorage
        const lastRole = localStorage.getItem('lastLoginRole');
        if (lastRole && ['customer', 'vendor', 'admin'].includes(lastRole)) {
            setRole(lastRole);
        } else {
            setRole('customer');
        }

        // Reset button state when page loads (in case of back navigation)
        window.addEventListener('pageshow', function(event) {
            // If the page is loaded from cache (like back button)
            if (event.persisted) {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Sign In</span>';
                submitted = false;
            }
        });

        // Mobile menu toggle (if needed)
        document.getElementById('menuBtn')?.addEventListener('click', function() {
            // Add your mobile menu logic here if needed
            console.log('Menu clicked');
        });

        // Add email validation on blur
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                // Show invalid email message without blocking
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = '<i class="ri-error-warning-fill"></i> Please enter a valid email address';
                
                // Remove any existing error message
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
    </script>
</body>
</html>