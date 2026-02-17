<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Forgot Password - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            font-family: 'Inter-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }
        @font-face {
            font-family: 'AlibabaSans';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/AlibabaSans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-body: #f8fafc;
            --white: #ffffff;
            --error: #ef4444;
            --success: #10b981;
            --border: #e2e8f0;
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.05);
            --shadow-md: 0 10px 40px rgba(0,0,0,0.08);
            --shadow-lg: 0 20px 60px rgba(184, 142, 63, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-circle {
            position: fixed;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 0;
        }

        .circle-1 {
            width: 600px;
            height: 600px;
            top: -200px;
            right: -200px;
            animation: float 8s ease-in-out infinite;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            bottom: -150px;
            left: -150px;
            animation: float 12s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 300px;
            height: 300px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-20px, -20px); }
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
        }

        .container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 10;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Brand */
        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand h1 {
            font-family: 'AlibabaSans', sans-serif;
            color: white;
            font-size: 36px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 12px;
            text-shadow: 2px 4px 10px rgba(0,0,0,0.2);
            letter-spacing: -0.5px;
        }

        .brand i {
            font-size: 40px;
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.2));
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            backdrop-filter: blur(5px);
        }

        .ethiopia-badge i {
            font-size: 14px;
        }

        /* Card */
        .card {
            background: var(--white);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-gold), #d4af66, var(--primary-gold));
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .card-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
            font-family: 'Inter-Bold', sans-serif;
        }

        .card-header p {
            color: var(--text-light);
            font-size: 15px;
            line-height: 1.6;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
            border-left: 4px solid transparent;
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
            background-color: #ecfdf5;
            color: #065f46;
            border-left-color: var(--success);
        }

        .alert-success i {
            color: var(--success);
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border-left-color: var(--error);
        }

        .alert-error i {
            color: var(--error);
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #fef3e7 0%, #fff8f0 100%);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid rgba(184, 142, 63, 0.2);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.05);
        }

        .info-box i {
            color: var(--primary-gold);
            font-size: 24px;
            background: rgba(184, 142, 63, 0.1);
            padding: 8px;
            border-radius: 12px;
        }

        .info-box p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            flex: 1;
        }

        /* Form */
        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .input-wrapper {
            position: relative;
            transition: all 0.3s;
        }

        .input-wrapper:focus-within {
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 20px;
            transition: color 0.3s;
            z-index: 1;
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary-gold);
        }

        .form-control {
            width: 100%;
            padding: 16px 16px 16px 52px;
            border: 2px solid var(--border);
            border-radius: 16px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: #fafafa;
            font-family: 'Inter', sans-serif;
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--error);
            background-color: #fef2f2;
        }

        .form-control.error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: var(--error);
            font-size: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
            padding-left: 4px;
        }

        .error-message i {
            font-size: 14px;
        }

        /* Loading States */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            z-index: 20;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(184, 142, 63, 0.2);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            font-family: 'Inter-Bold', sans-serif;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover:not(:disabled)::before {
            left: 100%;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(184, 142, 63, 0.4);
        }

        .btn-submit:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-submit.checking {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            cursor: wait;
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

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            padding: 8px 16px;
            border-radius: 30px;
            background: #f8fafc;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .back-link:hover {
            color: var(--primary-gold);
            background: #fef3e7;
            transform: translateX(-5px);
        }

        .back-link i {
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .card {
                padding: 32px 24px;
            }

            .card-header h2 {
                font-size: 28px;
            }

            .brand h1 {
                font-size: 32px;
            }

            .brand i {
                font-size: 36px;
            }

            .form-control {
                padding: 14px 14px 14px 48px;
            }

            .btn-submit {
                padding: 16px;
            }

            .circle-1 {
                width: 400px;
                height: 400px;
            }

            .circle-2 {
                width: 300px;
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .card {
                padding: 28px 20px;
                border-radius: 20px;
            }

            .card-header h2 {
                font-size: 26px;
            }

            .card-header p {
                font-size: 14px;
            }

            .brand h1 {
                font-size: 28px;
            }

            .brand i {
                font-size: 32px;
            }

            .info-box {
                padding: 16px;
            }

            .info-box i {
                font-size: 20px;
                padding: 6px;
            }

            .info-box p {
                font-size: 13px;
            }

            .form-control {
                padding: 14px 14px 14px 46px;
                font-size: 14px;
            }

            .input-icon {
                left: 14px;
                font-size: 18px;
            }

            .btn-submit {
                padding: 15px;
                font-size: 15px;
            }

            .back-link {
                padding: 6px 14px;
                font-size: 13px;
            }
        }

        @media (max-width: 360px) {
            .card {
                padding: 24px 16px;
            }

            .card-header h2 {
                font-size: 24px;
            }

            .brand h1 {
                font-size: 26px;
            }

            .brand i {
                font-size: 28px;
            }
        }

        /* Accessibility */
        .btn-submit:focus-visible,
        .form-control:focus-visible,
        .back-link:focus-visible {
            outline: 2px solid var(--primary-gold);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Animated Background Circles -->
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
    <div class="bg-circle circle-3"></div>

    <div class="container">
        <!-- Brand -->
        <div class="brand">
            <h1>
                <i class="ri-store-3-fill"></i>
                Vendora
            </h1>
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </div>

        <!-- Main Card -->
        <div class="card">
            <!-- Loading Overlay -->
            <div class="loading-overlay" id="loadingOverlay">
                <div class="loading-spinner"></div>
            </div>

            <div class="card-header">
                <h2>Forgot Password? 🔒</h2>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    <span>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </span>
                </div>
            @endif

            <!-- Info Box -->
            <div class="info-box">
                <i class="ri-information-line"></i>
                <p>We'll send a password reset link to your registered email address. The link will expire in <strong>60 minutes</strong>.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                @csrf

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
                               autofocus>
                    </div>
                    <div id="emailStatus" class="error-message" style="display: none;"></div>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Send Reset Link</span>
                    <i class="ri-mail-send-line"></i>
                </button>
            </form>

            <!-- Back Link -->
            <a href="{{ route('login') }}" class="back-link">
                <i class="ri-arrow-left-line"></i>
                Back to Login
            </a>
        </div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Email validation function
        function validateEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        // Check if email exists in database
        async function checkEmailExists(email) {
            try {
                const response = await fetch('/check-email-exists', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();
                return data.exists;
            } catch (error) {
                console.error('Error checking email:', error);
                return false;
            }
        }

        // Debounce function to limit API calls
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Email input with real-time validation
        const emailInput = document.getElementById('email');
        const emailStatus = document.getElementById('emailStatus');
        const submitBtn = document.getElementById('submitBtn');
        const loadingOverlay = document.getElementById('loadingOverlay');
        let isValidEmail = false;
        let isRegisteredEmail = false;

        // Real-time email validation
        const validateEmailField = debounce(async function() {
            const email = emailInput.value.trim();
            
            // Clear previous status
            emailStatus.style.display = 'none';
            emailStatus.innerHTML = '';
            emailInput.classList.remove('error');
            
            if (email.length === 0) {
                isValidEmail = false;
                isRegisteredEmail = false;
                submitBtn.disabled = true;
                return;
            }

            // Check email format
            if (!validateEmail(email)) {
                emailInput.classList.add('error');
                emailStatus.style.display = 'flex';
                emailStatus.innerHTML = '<i class="ri-error-warning-fill"></i> Please enter a valid email address';
                isValidEmail = false;
                isRegisteredEmail = false;
                submitBtn.disabled = true;
                return;
            }

            isValidEmail = true;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('checking');
            submitBtn.innerHTML = '<span class="spinner"></span> Checking email...';

            // Check if email is registered
            const exists = await checkEmailExists(email);
            
            submitBtn.classList.remove('checking');
            
            if (exists) {
                isRegisteredEmail = true;
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Send Reset Link</span> <i class="ri-mail-send-line"></i>';
                emailStatus.style.display = 'none';
            } else {
                isRegisteredEmail = false;
                submitBtn.disabled = true;
                emailInput.classList.add('error');
                emailStatus.style.display = 'flex';
                emailStatus.innerHTML = '<i class="ri-error-warning-fill"></i> This email is not registered in our system';
            }
        }, 500);

        emailInput.addEventListener('input', validateEmailField);

        // Form submission with validation
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = emailInput.value.trim();

            // Final validation before submit
            if (!validateEmail(email)) {
                emailInput.classList.add('error');
                emailStatus.style.display = 'flex';
                emailStatus.innerHTML = '<i class="ri-error-warning-fill"></i> Please enter a valid email address';
                return;
            }

            // Show loading overlay
            loadingOverlay.classList.add('active');
            submitBtn.disabled = true;
            
            // Submit the form
            this.submit();
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
                this.parentElement.querySelector('.input-icon').style.color = '#94a3b8';
            });
        });

        // Prevent double submission
        let submitted = false;
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            if (submitted) {
                e.preventDefault();
                return;
            }
            submitted = true;
        });

        // Console log for debugging (remove in production)
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            console.log('Forgot Password Page Loaded');
            console.log('Form Action:', '{{ route("password.email") }}');
        }
    </script>
</body>
</html>