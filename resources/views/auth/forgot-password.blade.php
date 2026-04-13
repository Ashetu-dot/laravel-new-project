<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Vendora Marketplace</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --white: #ffffff;
            --light-gray: #f8fafc;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-lg: 16px;
            --transition: all 0.3s ease;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #f1f5f9;
            --text-gray: #cbd5e1;
            --border-color: #334155;
            --white: #1f2937;
            --light-gray: #111827;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 30px rgba(212, 165, 90, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
            transition: background-color 0.3s, color 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: var(--white);
            padding: 16px 80px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .brand {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .brand:hover {
            transform: scale(1.05);
        }

        .brand i {
            font-size: 32px;
        }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 20px;
        }

        .theme-toggle:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* Main Container */
        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* Forgot Password Card */
        .forgot-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-hover);
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            transition: background-color 0.3s;
            border: 1px solid var(--border-color);
        }

        .forgot-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .forgot-header .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .forgot-header .icon-wrapper i {
            font-size: 40px;
            color: var(--primary-gold);
        }

        .forgot-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .forgot-header p {
            color: var(--text-gray);
            font-size: 15px;
            line-height: 1.6;
        }

        /* Form */
        .forgot-form {
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: var(--white);
            color: var(--text-dark);
            font-size: 15px;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-input.error {
            border-color: var(--error);
        }

        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success-message i {
            font-size: 18px;
        }

        .btn-primary {
            width: 100%;
            padding: 14px 24px;
            background: var(--primary-gold);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            text-align: center;
            margin-top: 24px;
        }

        .back-link a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }

        .back-link a:hover {
            color: var(--primary-gold);
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error);
            color: var(--error);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid var(--warning);
            color: var(--warning);
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 24px;
            color: var(--text-gray);
            font-size: 13px;
            border-top: 1px solid var(--border-color);
            background: var(--white);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
            }

            .forgot-card {
                padding: 32px 24px;
            }

            .forgot-header h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .forgot-card {
                padding: 24px 16px;
            }

            .ethiopia-badge {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
        </a>
        <div class="nav-controls">
            
            <button class="theme-toggle" id="themeToggle" title="Toggle theme">
                <i class="ri-moon-line"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="icon-wrapper">
                    <i class="ri-lock-password-line"></i>
                </div>
                <h1>{{ __('Forgot Password?') }}</h1>
                <p>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="ri-error-warning-line"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form class="forgot-form" method="POST" action="{{ route('password.email') }}" id="forgotForm">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input @error('email') error @enderror"
                           value="{{ old('email') }}"
                           placeholder="Enter your email address"
                           required
                           autofocus>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-information-line"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="btn-text">{{ __('Email Password Reset Link') }}</span>
                    <span class="btn-spinner" style="display: none;">
                        <span class="spinner"></span>
                    </span>
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">
                    <i class="ri-arrow-left-line"></i>
                    {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Vendora Marketplace. {{ __('All rights reserved.') }}</p>
    </footer>

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

        // Form submission with loading state
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnSpinner = submitBtn.querySelector('.btn-spinner');

            submitBtn.disabled = true;
            btnText.style.opacity = '0.7';
            btnSpinner.style.display = 'inline';
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Email validation on blur
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const errorElement = document.querySelector('.error-message');

            if (email && !isValidEmail(email)) {
                if (!errorElement) {
                    const div = document.createElement('div');
                    div.className = 'error-message';
                    div.innerHTML = '<i class="ri-information-line"></i> Please enter a valid email address';
                    this.parentNode.appendChild(div);
                    this.classList.add('error');
                }
            } else {
                if (errorElement) {
                    errorElement.remove();
                    this.classList.remove('error');
                }
            }
        });

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Smooth scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    </script>
</body>
</html>
