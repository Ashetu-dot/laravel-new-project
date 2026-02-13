<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Customer & Vendor Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf');
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf');
            font-weight: 700;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --bg-color: #F7F7F7;
            --text-dark: #333333;
            --text-gray: #777777;
            --white: #ffffff;
            --error-color: #D32F2F;
            --success-color: #388E3C;
            --border-color: #E0E0E0;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.05);
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

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .login-card {
            background: var(--white);
            width: 100%;
            max-width: 520px;
            padding: 60px;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
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
            margin-bottom: 40px;
        }

        .card-header h1 {
            font-family: 'Inter-Bold', sans-serif;
            font-size: 32px;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .card-header p {
            color: var(--text-gray);
            font-size: 16px;
            line-height: 1.5;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
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

        /* Form */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-family: 'Inter-Bold', sans-serif;
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
            z-index: 10;
        }

        .toggle-password:hover {
            color: var(--primary-gold);
        }

        .form-control {
            width: 100%;
            padding: 16px 48px 16px 50px;
            font-size: 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
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
            margin-bottom: 32px;
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
            border-radius: 4px;
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
            border-radius: var(--radius-sm);
            font-size: 18px;
            font-family: 'Inter-Bold', sans-serif;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 142, 63, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .signup-prompt {
            text-align: center;
            margin-top: 24px;
            color: var(--text-gray);
            font-size: 15px;
        }

        .signup-link {
            color: var(--primary-gold);
            font-family: 'Inter-Bold', sans-serif;
            text-decoration: none;
            margin-left: 4px;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        .role-switch {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            padding: 4px;
            background-color: #f5f5f5;
            border-radius: 40px;
        }

        .role-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: none;
            border-radius: 40px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.2s;
        }

        .role-btn.active {
            background-color: var(--white);
            color: var(--primary-gold);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .role-btn:hover {
            color: var(--primary-gold);
        }

        /* Footer */
        .footer-minimal {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 12px;
        }

        .footer-minimal a {
            color: #999;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-minimal a:hover {
            color: var(--primary-gold);
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 24px 40px; }
            .login-card { max-width: 500px; padding: 50px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 20px 32px; }
            .logo { font-size: 26px; }
            .logo-icon { font-size: 30px; }
            .login-card { max-width: 480px; padding: 48px; }
            .card-header h1 { font-size: 30px; }
        }

        @media screen and (max-width: 900px) {
            .navbar { padding: 18px 28px; }
            .login-card { padding: 40px; }
            .form-control { padding: 14px 44px 14px 46px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .logo { font-size: 24px; gap: 6px; }
            .logo-icon { font-size: 28px; }
            .menu-btn { display: block; }

            .main-container { padding: 40px 20px; }
            .login-card { padding: 40px 32px; border-radius: 20px; max-width: 460px; }
            .card-header h1 { font-size: 28px; }
            .card-header p { font-size: 15px; }
            .form-control { font-size: 15px; }
            .btn-submit { font-size: 17px; padding: 15px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 22px; }
            .logo-icon { font-size: 26px; }
            .menu-btn { font-size: 22px; padding: 6px; }

            .main-container { padding: 30px 16px; }
            .login-card { padding: 32px 24px; border-radius: 20px; }
            .card-header h1 { font-size: 26px; }
            .card-header p { font-size: 14px; }
            .form-label { font-size: 13px; }
            .form-control { padding: 14px 40px 14px 44px; font-size: 14px; }
            .input-icon { font-size: 18px; left: 14px; }
            .toggle-password { font-size: 18px; right: 14px; }
            .form-actions { flex-direction: column; align-items: flex-start; gap: 12px; margin-bottom: 28px; }
            .checkbox-wrapper { font-size: 14px; }
            .forgot-link { font-size: 14px; }
            .btn-submit { padding: 14px; font-size: 16px; border-radius: 10px; }
            .signup-prompt { font-size: 14px; margin-top: 20px; }
            .footer-minimal { padding: 24px 20px; font-size: 11px; }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 20px; gap: 4px; }
            .logo-icon { font-size: 24px; }
            .menu-btn { font-size: 20px; padding: 4px; }

            .main-container { padding: 24px 12px; }
            .login-card { padding: 28px 20px; border-radius: 18px; box-shadow: 0 8px 30px rgba(0,0,0,0.05); }
            .login-card::before { height: 5px; }
            .card-header { margin-bottom: 30px; }
            .card-header h1 { font-size: 24px; }
            .card-header p { font-size: 13px; }
            .form-group { margin-bottom: 20px; }
            .form-label { font-size: 12px; margin-bottom: 6px; }
            .form-control { padding: 12px 36px 12px 42px; font-size: 14px; border-radius: 10px; }
            .input-icon { font-size: 16px; left: 12px; }
            .toggle-password { font-size: 16px; right: 12px; }
            .custom-checkbox { width: 18px; height: 18px; }
            input[type="checkbox"]:checked + .custom-checkbox::after { font-size: 12px; }
            .btn-submit { padding: 13px; font-size: 15px; border-radius: 10px; box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3); }
            .signup-prompt { font-size: 13px; margin-top: 18px; display: flex; flex-wrap: wrap; justify-content: center; gap: 4px; }
            .footer-minimal { padding: 20px 16px; font-size: 10px; }
        }

        @media screen and (max-width: 360px) {
            .navbar { padding: 10px 12px; }
            .logo { font-size: 18px; }
            .logo-icon { font-size: 22px; }

            .login-card { padding: 24px 16px; }
            .card-header h1 { font-size: 22px; }
            .card-header p { font-size: 12px; }
            .form-control { padding: 10px 32px 10px 38px; font-size: 13px; }
            .btn-submit { padding: 12px; font-size: 14px; }
            .footer-minimal { padding: 16px 12px; font-size: 9px; }
        }

        /* Accessibility */
        .menu-btn:focus-visible, .btn-submit:focus-visible, .form-control:focus-visible {
            outline: 2px solid var(--primary-gold);
            outline-offset: 2px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill logo-icon"></i>
            Vendora
        </a>
        <button class="menu-btn" aria-label="Menu" id="menuBtn">
            <i class="ri-menu-line"></i>
        </button>
    </nav>

    <div class="main-container">
        <div class="login-card">
            <div class="card-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your Vendora account</p>
            </div>

            <!-- Session Status Messages -->
            @if(session('success'))
                <div class="alert alert-success" id="successAlert">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" id="errorAlert">
                    <i class="ri-error-warning-line"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Role Selection -->
            <div class="role-switch" id="roleSwitch">
                <button type="button" class="role-btn active" data-role="customer" onclick="setRole('customer')">
                    <i class="ri-user-line"></i> Customer
                </button>
                <button type="button" class="role-btn" data-role="vendor" onclick="setRole('vendor')">
                    <i class="ri-store-line"></i> Vendor
                </button>
            </div>

            <form action="{{ route('login.authenticate') }}" method="POST" id="loginForm">
                @csrf
                <input type="hidden" name="role" id="selectedRole" value="customer">

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line input-icon"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') error @enderror"
                               placeholder="name@example.com"
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

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-2-line input-icon"></i>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') error @enderror"
                               placeholder="••••••••"
                               required
                               autocomplete="current-password">
                        <i class="ri-eye-off-line toggle-password" onclick="togglePasswordVisibility(this)" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-checkbox"></span>
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Sign In</span>
                </button>

                <div class="signup-prompt">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="signup-link">Create account</a>
                </div>
            </form>
        </div>
    </div>

    <div class="footer-minimal">
        &copy; {{ date('Y') }} Vendora Inc. All rights reserved. •
        <a href="{{ route('privacy.policy') }}">Privacy Policy</a> •
        <a href="{{ route('terms.service') }}">Terms of Service</a>
    </div>

    <script>
        // Password visibility toggle
        function togglePasswordVisibility(element) {
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

        // Role selection
        function setRole(role) {
            document.getElementById('selectedRole').value = role;

            // Update active state
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.role === role) {
                    btn.classList.add('active');
                }
            });

            // Update form placeholder text based on role
            const emailInput = document.getElementById('email');
            if (role === 'vendor') {
                emailInput.placeholder = 'vendor@example.com';
            } else {
                emailInput.placeholder = 'name@example.com';
            }
        }

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Signing in...';

            // Form will submit normally, but button shows loading state
            // Remove disabled after 5 seconds in case of error
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 5000);
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });

        // Mobile menu (you can expand this later)
        document.getElementById('menuBtn')?.addEventListener('click', function() {
            alert('Mobile menu would open here. In a real app, this would show navigation links.');
        });

        // Input focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--primary-gold)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#999';
            });
        });

        // Prevent form double-submission
        let submitted = false;
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;
        });

        // Add demo credentials for testing (remove in production)
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            console.log('Demo credentials:');
            console.log('Customer: customer@example.com / password');
            console.log('Vendor: vendor@example.com / password');
            console.log('Admin: admin@vendora.com / password');
        }
    </script>

</body>
</html>
