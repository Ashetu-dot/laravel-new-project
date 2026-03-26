<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Vendora Marketplace</title>
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

        /* Reset Password Card */
        .reset-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-hover);
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            transition: background-color 0.3s;
            border: 1px solid var(--border-color);
        }

        .reset-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .reset-header .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .reset-header .icon-wrapper i {
            font-size: 40px;
            color: var(--primary-gold);
        }

        .reset-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .reset-header p {
            color: var(--text-gray);
            font-size: 15px;
            line-height: 1.6;
        }

        /* Form */
        .reset-form {
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

        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-gray);
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--primary-gold);
        }

        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            display: flex;
            gap: 4px;
            margin-bottom: 4px;
        }

        .strength-segment {
            height: 4px;
            flex: 1;
            background: var(--border-color);
            border-radius: 2px;
            transition: all 0.3s;
        }

        .strength-segment.weak {
            background: var(--error);
        }

        .strength-segment.medium {
            background: var(--warning);
        }

        .strength-segment.strong {
            background: var(--success);
        }

        .strength-text {
            font-size: 12px;
            color: var(--text-gray);
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

        /* Password Requirements */
        .password-requirements {
            background: var(--light-gray);
            border-radius: var(--radius-sm);
            padding: 12px;
            margin-top: 12px;
            font-size: 12px;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-gray);
            margin-bottom: 6px;
        }

        .requirement i {
            font-size: 14px;
        }

        .requirement.valid {
            color: var(--success);
        }

        .requirement.invalid {
            color: var(--error);
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

            .reset-card {
                padding: 32px 24px;
            }

            .reset-header h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .reset-card {
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
            <i class="ri-store-2-fill"></i>
            Vendora
        </a>
        <div class="nav-controls">
            
            <button class="theme-toggle" id="themeToggle" title="Toggle theme">
                <i class="ri-moon-line"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="reset-card">
            <div class="reset-header">
                <div class="icon-wrapper">
                    <i class="ri-lock-password-line"></i>
                </div>
                <h1>{{ __('Reset Password') }}</h1>
                <p>{{ __('Please enter your new password below.') }}</p>
            </div>

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

            <!-- Success Message -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form class="reset-form" method="POST" action="{{ route('password.update') }}" id="resetForm">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input @error('email') error @enderror" 
                           value="{{ $email ?? old('email') }}"
                           placeholder="Enter your email address"
                           readonly>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-information-line"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                    <div class="password-input-wrapper">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input @error('password') error @enderror" 
                               placeholder="Enter new password"
                               required>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="ri-eye-line" id="password-icon"></i>
                        </span>
                    </div>
                    
                    <!-- Password Strength -->
                    <div class="password-strength" id="passwordStrength" style="display: none;">
                        <div class="strength-bar">
                            <div class="strength-segment" id="strength-1"></div>
                            <div class="strength-segment" id="strength-2"></div>
                            <div class="strength-segment" id="strength-3"></div>
                        </div>
                        <span class="strength-text" id="strengthText"></span>
                    </div>

                    <!-- Password Requirements -->
                    <div class="password-requirements">
                        <div class="requirement" id="req-length">
                            <i class="ri-close-circle-line invalid"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement" id="req-uppercase">
                            <i class="ri-close-circle-line invalid"></i>
                            <span>At least one uppercase letter</span>
                        </div>
                        <div class="requirement" id="req-lowercase">
                            <i class="ri-close-circle-line invalid"></i>
                            <span>At least one lowercase letter</span>
                        </div>
                        <div class="requirement" id="req-number">
                            <i class="ri-close-circle-line invalid"></i>
                            <span>At least one number</span>
                        </div>
                        <div class="requirement" id="req-special">
                            <i class="ri-close-circle-line invalid"></i>
                            <span>At least one special character</span>
                        </div>
                    </div>

                    @error('password')
                        <div class="error-message">
                            <i class="ri-information-line"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="password-input-wrapper">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               placeholder="Confirm new password"
                               required>
                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="ri-eye-line" id="password-confirm-icon"></i>
                        </span>
                    </div>
                    <div id="passwordMatch" style="font-size: 12px; margin-top: 6px;"></div>
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="btn-text">{{ __('Reset Password') }}</span>
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

        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = fieldId === 'password' ? 
                document.getElementById('password-icon') : 
                document.getElementById('password-confirm-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'ri-eye-off-line';
            } else {
                field.type = 'password';
                icon.className = 'ri-eye-line';
            }
        }

        // Password Strength Checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('strengthText');
            const segments = {
                1: document.getElementById('strength-1'),
                2: document.getElementById('strength-2'),
                3: document.getElementById('strength-3')
            };

            // Requirements
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            // Update requirement icons
            document.getElementById('req-length').className = hasLength ? 'requirement valid' : 'requirement invalid';
            document.getElementById('req-uppercase').className = hasUpper ? 'requirement valid' : 'requirement invalid';
            document.getElementById('req-lowercase').className = hasLower ? 'requirement valid' : 'requirement invalid';
            document.getElementById('req-number').className = hasNumber ? 'requirement valid' : 'requirement invalid';
            document.getElementById('req-special').className = hasSpecial ? 'requirement valid' : 'requirement invalid';

            document.getElementById('req-length').querySelector('i').className = hasLength ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';
            document.getElementById('req-uppercase').querySelector('i').className = hasUpper ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';
            document.getElementById('req-lowercase').querySelector('i').className = hasLower ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';
            document.getElementById('req-number').querySelector('i').className = hasNumber ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';
            document.getElementById('req-special').querySelector('i').className = hasSpecial ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';

            // Calculate strength
            let strength = 0;
            if (hasLength) strength++;
            if (hasUpper) strength++;
            if (hasLower) strength++;
            if (hasNumber) strength++;
            if (hasSpecial) strength++;

            if (password.length === 0) {
                strengthDiv.style.display = 'none';
                return;
            }

            strengthDiv.style.display = 'block';

            // Reset segments
            for (let i = 1; i <= 3; i++) {
                segments[i].className = 'strength-segment';
            }

            // Set strength
            if (strength <= 2) {
                segments[1].classList.add('weak');
                strengthText.textContent = 'Weak password';
            } else if (strength <= 4) {
                segments[1].classList.add('medium');
                segments[2].classList.add('medium');
                strengthText.textContent = 'Medium password';
            } else {
                segments[1].classList.add('strong');
                segments[2].classList.add('strong');
                segments[3].classList.add('strong');
                strengthText.textContent = 'Strong password';
            }
        });

        // Password Match Checker
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;
            const matchDiv = document.getElementById('passwordMatch');

            if (confirm.length === 0) {
                matchDiv.innerHTML = '';
                return;
            }

            if (password === confirm) {
                matchDiv.innerHTML = '<span style="color: var(--success);"><i class="ri-checkbox-circle-line"></i> Passwords match</span>';
            } else {
                matchDiv.innerHTML = '<span style="color: var(--error);"><i class="ri-close-circle-line"></i> Passwords do not match</span>';
            }
        });

        // Form submission with loading state
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            
            if (password !== confirm) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

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
    </script>
</body>
</html>