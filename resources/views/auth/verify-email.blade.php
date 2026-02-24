<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Verify Email | Jimma, Ethiopia</title>
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
            --warning-color: #F57C00;
            --info-color: #1976D2;
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

        .verify-card {
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
        .verify-card::before {
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

        /* Icon */
        .verify-icon {
            text-align: center;
            margin-bottom: 24px;
        }

        .verify-icon i {
            font-size: 80px;
            color: var(--primary-gold);
            background: rgba(184, 142, 63, 0.1);
            padding: 20px;
            border-radius: 50%;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
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

        .alert-warning {
            background-color: #FFF3E0;
            color: var(--warning-color);
            border: 1px solid #FFE0B2;
        }

        .alert-info {
            background-color: #E3F2FD;
            color: var(--info-color);
            border: 1px solid #BBDEFB;
        }

        /* Info Box */
        .info-box {
            background-color: #F5F5F5;
            border-radius: var(--radius-md);
            padding: 24px;
            margin-bottom: 24px;
        }

        .info-box h3 {
            font-size: 16px;
            margin-bottom: 16px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box h3 i {
            color: var(--primary-gold);
        }

        .info-box ul {
            list-style: none;
        }

        .info-box li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: var(--text-gray);
            font-size: 14px;
        }

        .info-box li i {
            color: var(--success-color);
            font-size: 16px;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .btn-group {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, #ca9e4b 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 142, 63, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            flex: 1;
            padding: 16px;
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #F5F5F5;
            border-color: var(--primary-gold);
            color: var(--primary-gold);
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
            font-size: 14px;
        }

        .login-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
        }

        .login-link:hover {
            text-decoration: underline;
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
            .verify-card { padding: 40px; }
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

            .verify-card {
                padding: 32px 24px;
                max-width: 100%;
            }

            .card-header h1 {
                font-size: 24px;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
            }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 22px; }
            .logo-icon { font-size: 26px; }

            .verify-card {
                padding: 28px 20px;
            }

            .card-header h1 {
                font-size: 22px;
            }

            .card-header p {
                font-size: 14px;
            }

            .verify-icon i {
                font-size: 60px;
            }

            .btn-primary, .btn-secondary {
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

            .verify-card {
                padding: 24px 16px;
                border-radius: 16px;
            }

            .verify-card::before {
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

            .verify-icon i {
                font-size: 50px;
                padding: 15px;
            }

            .btn-primary, .btn-secondary {
                padding: 13px;
                font-size: 14px;
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

            .verify-card {
                padding: 20px 14px;
            }

            .card-header h1 {
                font-size: 18px;
            }

            .card-header p {
                font-size: 12px;
            }

            .verify-icon i {
                font-size: 40px;
                padding: 12px;
            }

            .btn-primary, .btn-secondary {
                padding: 12px;
                font-size: 13px;
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
        <div class="verify-card">
            <div class="verify-icon">
                <i class="ri-mail-check-line"></i>
            </div>

            <div class="card-header">
                <h1>Verify Your Email Address</h1>
                <p>Please verify your email to access all features</p>
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

            @if(session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    <i class="ri-mail-send-line"></i>
                    A new verification link has been sent to your email address.
                </div>
            @endif

            @if(!Auth::user()->hasVerifiedEmail())
                <div class="alert alert-warning">
                    <i class="ri-mail-unread-line"></i>
                    Your email address ({{ Auth::user()->email }}) is not verified.
                </div>
            @endif

            <!-- Info Box -->
            <div class="info-box">
                <h3>
                    <i class="ri-information-line"></i>
                    Why verify your email?
                </h3>
                <ul>
                    <li>
                        <i class="ri-check-line"></i>
                        Access your dashboard and all features
                    </li>
                    <li>
                        <i class="ri-check-line"></i>
                        Receive order confirmations and updates
                    </li>
                    <li>
                        <i class="ri-check-line"></i>
                        Communicate with vendors securely
                    </li>
                    <li>
                        <i class="ri-check-line"></i>
                        Reset your password if forgotten
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <!-- Resend Verification Email Form -->
                <form method="POST" action="{{ route('verification.send') }}" style="flex: 1;" id="resendForm">
                    @csrf
                    <button type="submit" class="btn-primary" id="resendBtn">
                        <i class="ri-mail-send-line"></i>
                        <span>Resend Verification</span>
                    </button>
                </form>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        <i class="ri-logout-box-line"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

            <!-- Help Links -->
            <div class="login-prompt">
                <span>Didn't receive the email?</span>
                <a href="#" class="login-link" onclick="showHelp()">Get help</a>
            </div>

            <!-- Help Section (Hidden by default) -->
            <div id="helpSection" style="display: none; margin-top: 16px; padding: 16px; background: #F5F5F5; border-radius: var(--radius-sm);">
                <p style="color: var(--text-gray); font-size: 13px; margin-bottom: 8px;">
                    <i class="ri-mail-settings-line" style="margin-right: 4px;"></i>
                    Try these steps:
                </p>
                <ul style="list-style: none; font-size: 12px; color: var(--text-gray);">
                    <li style="margin-bottom: 8px;">✓ Check your spam/junk folder</li>
                    <li style="margin-bottom: 8px;">✓ Add noreply@vendora.com to your contacts</li>
                    <li style="margin-bottom: 8px;">✓ Wait a few minutes and try again</li>
                    <li>✓ Contact support if the problem persists</li>
                </ul>
            </div>
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
        // Resend button with loading state
        document.getElementById('resendForm')?.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('resendBtn');
            
            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Sending...';
        });

        // Show help section
        function showHelp() {
            const helpSection = document.getElementById('helpSection');
            if (helpSection.style.display === 'none') {
                helpSection.style.display = 'block';
            } else {
                helpSection.style.display = 'none';
            }
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Mobile menu toggle
        document.getElementById('menuBtn')?.addEventListener('click', function() {
            console.log('Menu clicked');
        });

        // Reset button state when page loads (in case of back navigation)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                const resendBtn = document.getElementById('resendBtn');
                if (resendBtn) {
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = '<i class="ri-mail-send-line"></i><span>Resend Verification</span>';
                }
            }
        });

        // Check if email is already verified every 5 seconds
        setInterval(function() {
            fetch('{{ route("verification.notice") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // If redirected to dashboard, reload page
                if (html.includes('dashboard')) {
                    window.location.reload();
                }
            })
            .catch(() => {});
        }, 5000);
    </script>
</body>
</html>