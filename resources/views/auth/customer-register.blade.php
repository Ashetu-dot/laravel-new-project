<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Join as Customer | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        @font-face {
            font-family: 'MiSans-Regular';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Regular.ttf');
        }
        @font-face {
            font-family: 'MiSans-Medium';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Medium.ttf');
        }
        @font-face {
            font-family: 'MiSans-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Bold.ttf');
        }

        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #333333;
            --text-light: #777777;
            --bg-body: #F7F7F7;
            --bg-card: #FFFFFF;
            --border-color: #E0E0E0;
            --error-color: #D32F2F;
            --success-color: #388E3C;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'MiSans-Regular', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.5;
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navigation */
        .navbar {
            background-color: var(--bg-card);
            padding: 24px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'MiSans-Bold', sans-serif;
            font-size: 28px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .logo:hover {
            opacity: 0.9;
        }

        .logo i {
            font-size: 32px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .login-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: var(--primary-color);
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .hamburger:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* Role Switch */
        .role-switch {
            display: flex;
            gap: 8px;
            margin-bottom: 32px;
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
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .role-btn.active {
            background-color: var(--white);
            color: var(--primary-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .role-btn:hover {
            color: var(--primary-color);
        }

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 20px;
            background: linear-gradient(180deg, var(--bg-body) 0%, #EFEFEF 100%);
            position: relative;
        }

        .registration-card {
            background: var(--bg-card);
            width: 100%;
            max-width: 600px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 48px;
            display: flex;
            flex-direction: column;
            gap: 32px;
            transition: box-shadow 0.3s;
            animation: fadeIn 0.5s ease;
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

        .registration-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .card-header {
            text-align: center;
        }

        .card-header h1 {
            font-family: 'MiSans-Bold', sans-serif;
            font-size: 32px;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .card-header p {
            color: var(--text-light);
            font-size: 16px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-row {
            display: flex;
            gap: 24px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .required {
            color: var(--error-color);
            margin-left: 4px;
        }

        .form-input, .form-select {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s ease;
            width: 100%;
            background-color: var(--bg-card);
        }

        .form-input:hover, .form-select:hover {
            border-color: var(--primary-color);
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.15);
        }

        .form-input.error, .form-select.error {
            border-color: var(--error-color);
            background-color: #FFF5F5;
        }

        .error-message {
            font-size: 12px;
            color: var(--error-color);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
            animation: shake 0.3s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Buttons */
        .form-actions {
            margin-top: 16px;
        }

        .btn {
            padding: 12px 32px;
            border-radius: var(--radius-sm);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-family: 'MiSans-Medium', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .btn:active::after {
            width: 200px;
            height: 200px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
            width: 100%;
            justify-content: center;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            pointer-events: none;
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

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bars {
            display: flex;
            gap: 4px;
        }

        .strength-bar {
            height: 4px;
            flex: 1;
            background-color: #e0e0e0;
            border-radius: 2px;
            transition: background-color 0.3s;
        }

        .strength-text {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 4px;
            display: block;
        }

        /* Visual Decor */
        .decorative-shape {
            position: fixed;
            z-index: -1;
            opacity: 0.4;
            pointer-events: none;
        }

        .shape-1 {
            top: 100px;
            right: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.2) 0%, rgba(255,255,255,0) 70%);
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            bottom: 50px;
            left: -50px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.15) 0%, rgba(255,255,255,0) 70%);
            animation: float 12s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
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

        /* Location Badge */
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

        /* Login Prompt */
        .login-prompt {
            text-align: center;
            margin-top: 24px;
            color: var(--text-light);
            font-size: 14px;
        }

        .login-prompt a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-prompt a:hover {
            text-decoration: underline;
        }

        /* Accessibility Focus */
        *:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--text-dark);
            color: #fff;
            text-align: center;
            padding: 8px;
            border-radius: var(--radius-sm);
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Responsive */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 24px 60px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 20px 40px; }
            .logo { font-size: 26px; }
            .logo i { font-size: 30px; }
            .card-header h1 { font-size: 30px; }
        }

        @media screen and (max-width: 900px) {
            .registration-card { max-width: 100%; padding: 40px; }
            .form-row { gap: 16px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .nav-actions { gap: 16px; }
            .login-link { font-size: 15px; }
            .hamburger { display: flex; }

            .main-container { padding: 40px 16px; }
            .registration-card { padding: 32px 24px; gap: 28px; }

            .card-header h1 { font-size: 28px; }
            .card-header p { font-size: 15px; }

            .form-row { flex-direction: column; gap: 16px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 22px; }
            .logo i { font-size: 26px; }
            .nav-actions { gap: 12px; }
            .login-link { font-size: 14px; }
            .hamburger { font-size: 22px; }

            .main-container { padding: 32px 12px; }
            .registration-card { padding: 28px 20px; }

            .card-header h1 { font-size: 26px; }
            .card-header p { font-size: 14px; }

            .form-input, .form-select { padding: 10px 14px; font-size: 15px; }

            .decorative-shape { opacity: 0.2; }
            .shape-1 { width: 200px; height: 200px; right: -80px; }
            .shape-2 { width: 250px; height: 250px; left: -80px; }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 20px; gap: 4px; }
            .logo i { font-size: 24px; }
            .nav-actions { gap: 8px; }
            .login-link { font-size: 13px; }
            .hamburger { font-size: 20px; }

            .main-container { padding: 24px 8px; }
            .registration-card { padding: 24px 16px; border-radius: 12px; }

            .card-header h1 { font-size: 24px; margin-bottom: 8px; }
            .card-header p { font-size: 13px; }

            .form-label { font-size: 13px; }
            .form-input, .form-select { padding: 10px 12px; font-size: 14px; }

            .btn { font-size: 15px; padding: 12px 20px; }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 18px; }
            .logo i { font-size: 22px; }
            .login-link { font-size: 12px; }

            .registration-card { padding: 20px 12px; }
            .card-header h1 { font-size: 22px; }

            .form-input, .form-select { padding: 8px 10px; font-size: 13px; }
            .btn { font-size: 14px; padding: 10px 16px; }
        }
    </style>
</head>
<body>

    <!-- Background Decoration -->
    <div class="decorative-shape shape-1"></div>
    <div class="decorative-shape shape-2"></div>

    <!-- Navigation -->
    <nav class="navbar" role="navigation" aria-label="Main Navigation">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </a>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="login-link">Already have an account?</a>
            <div class="hamburger" aria-label="Menu" role="button" tabindex="0" id="menuToggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">
        <div class="registration-card">
            <!-- Role Switch -->
            <div class="role-switch">
                <a href="{{ route('register') }}" class="role-btn active">
                    <i class="ri-user-line"></i> Customer
                </a>
                <a href="{{ route('vendor.register') }}" class="role-btn">
                    <i class="ri-store-line"></i> Vendor
                </a>
            </div>

            <div class="card-header">
                <h1>Create Customer Account</h1>
                <p>Join thousands of shoppers in Jimma discovering unique local products</p>
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

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    Please fix the errors below and try again.
                </div>
            @endif

            <!-- Registration Form -->
            <form class="form-section" action="{{ route('customer.register') }}" method="POST" id="registrationForm">
                @csrf
                <input type="hidden" name="role" value="customer">

                <div class="form-row">
                    <div class="form-group">
                        <label for="fullname" class="form-label">Full Name <span class="required">*</span></label>
                        <div class="input-wrapper tooltip">
                            <span class="tooltip-text">Enter your full name as it appears on ID</span>
                            <input type="text" id="fullname" name="name" class="form-input @error('name') error @enderror" placeholder="e.g. Abebe Kebede" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper tooltip">
                            <span class="tooltip-text">We'll send verification to this email</span>
                            <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" placeholder="name@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-input @error('phone') error @enderror" placeholder="e.g. 0911 123 456" value="{{ old('phone') }}">
                        <small style="font-size: 11px; color: var(--text-light);">Optional, for order updates</small>
                        @error('phone')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city" class="form-label">City <span class="required">*</span></label>
                        <select name="city" id="city" class="form-select @error('city') error @enderror" required>
                            <option value="">Select your city</option>
                            <option value="Jimma" {{ old('city') == 'Jimma' ? 'selected' : '' }} selected>🏙️ Jimma</option>
                            <option value="Addis Ababa" {{ old('city') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                            <option value="Bahir Dar" {{ old('city') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                            <option value="Gondar" {{ old('city') == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                            <option value="Hawassa" {{ old('city') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                            <option value="Dire Dawa" {{ old('city') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                            <option value="Mekelle" {{ old('city') == 'Mekelle' ? 'selected' : '' }}>Mekelle</option>
                            <option value="Adama" {{ old('city') == 'Adama' ? 'selected' : '' }}>Adama</option>
                            <option value="Harar" {{ old('city') == 'Harar' ? 'selected' : '' }}>Harar</option>
                            <option value="Other" {{ old('city') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('city')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" placeholder="••••••••" required minlength="8">
                            <i class="ri-eye-off-line toggle-password" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #999;" onclick="togglePassword(this)"></i>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="password-strength">
                            <div class="strength-bars">
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                            </div>
                            <span class="strength-text">Enter a strong password</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        Create Account <i class="ri-user-add-line"></i>
                    </button>
                </div>

                <div class="login-prompt">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Password visibility toggle
        function togglePassword(element) {
            const input = element.previousElementSibling;
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

        // Password strength checker
        document.getElementById('password')?.addEventListener('input', function() {
            const password = this.value;
            const strengthBars = document.querySelectorAll('.strength-bar');
            const strengthText = document.querySelector('.strength-text');

            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            const colors = ['#e0e0e0', '#ff4444', '#ffaa00', '#00cc66', '#00aa44'];
            const texts = ['Enter a password', 'Weak', 'Fair', 'Good', 'Strong'];

            strengthBars.forEach((bar, index) => {
                bar.style.backgroundColor = index < strength ? colors[strength] : '#e0e0e0';
            });

            strengthText.textContent = texts[strength];
            strengthText.style.color = colors[strength] || 'var(--text-light)';
        });

        // Form submission with loading state
        document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Creating Account...';

            // Form will submit normally
        });

        // Auto-dismiss alerts after 5 seconds
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

        // Hamburger menu (mobile)
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            alert('Mobile menu would open here. In production, this would show navigation links.');
        });
    </script>

</body>
</html>
