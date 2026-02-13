<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Vendor Registration</title>
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
        }

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 20px;
            background: linear-gradient(180deg, var(--bg-body) 0%, #EFEFEF 100%);
        }

        .registration-card {
            background: var(--bg-card);
            width: 100%;
            max-width: 800px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 48px;
            display: flex;
            flex-direction: column;
            gap: 40px;
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

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 20px;
        }

        .progress-line {
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--border-color);
            z-index: 1;
        }

        .progress-line-fill {
            position: absolute;
            top: 15px;
            left: 0;
            height: 2px;
            background-color: var(--primary-color);
            z-index: 1;
            transition: width 0.3s ease;
        }

        .step-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-light);
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background-color: #FFF8E1;
        }

        .step-item.completed .step-circle {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }

        .step-label {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
            white-space: nowrap;
        }

        .step-item.active .step-label {
            color: var(--text-dark);
            font-weight: 600;
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

        .form-input, .form-select, .form-textarea {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.15);
        }

        .form-input.error, .form-select.error, .form-textarea.error {
            border-color: var(--error-color);
        }

        .error-message {
            font-size: 12px;
            color: var(--error-color);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #FAFAFA;
            position: relative;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: #FFFDF5;
        }

        .file-upload-area.has-file {
            border-color: var(--success-color);
            background-color: #E8F5E9;
        }

        .upload-icon {
            font-size: 32px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .upload-text {
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .upload-hint {
            color: var(--text-light);
            font-size: 12px;
        }

        .file-preview {
            display: none;
            margin-top: 16px;
            padding: 12px;
            background-color: #f5f5f5;
            border-radius: var(--radius-sm);
            font-size: 14px;
        }

        .file-preview.active {
            display: block;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 24px;
            border-top: 1px solid #f0f0f0;
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
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Visual Decor */
        .decorative-shape {
            position: fixed;
            z-index: -1;
            opacity: 0.4;
        }

        .shape-1 {
            top: 100px;
            right: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.2) 0%, rgba(255,255,255,0) 70%);
        }

        .shape-2 {
            bottom: 50px;
            left: -50px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.15) 0%, rgba(255,255,255,0) 70%);
        }

        /* Accessibility Focus */
        *:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* ========== RESPONSIVE ENHANCEMENTS ========== */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 24px 60px; }
            .registration-card { max-width: 750px; padding: 40px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 20px 40px; }
            .logo { font-size: 26px; }
            .logo i { font-size: 30px; }
            .registration-card { max-width: 700px; padding: 40px; }
            .card-header h1 { font-size: 30px; }
        }

        @media screen and (max-width: 900px) {
            .registration-card { max-width: 100%; padding: 36px; }
            .form-row { gap: 16px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .nav-actions { gap: 16px; }
            .login-link { font-size: 15px; }
            .hamburger { display: block; }

            .main-container { padding: 40px 16px; }
            .registration-card { padding: 32px 24px; gap: 32px; }

            .card-header h1 { font-size: 28px; }
            .card-header p { font-size: 15px; }

            .step-label { font-size: 12px; white-space: nowrap; }
            .step-circle { width: 28px; height: 28px; font-size: 12px; }

            .form-row { flex-direction: column; gap: 16px; }
            .form-actions .btn { padding: 12px 24px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 22px; }
            .logo i { font-size: 26px; }
            .nav-actions { gap: 12px; }
            .login-link { font-size: 14px; }
            .hamburger { font-size: 22px; }

            .main-container { padding: 32px 12px; }
            .registration-card { padding: 28px 20px; gap: 28px; }

            .card-header h1 { font-size: 26px; }
            .card-header p { font-size: 14px; }

            .progress-steps { margin-bottom: 16px; }
            .step-label { font-size: 11px; }
            .step-circle { width: 26px; height: 26px; }

            .form-input, .form-select { padding: 10px 14px; font-size: 15px; }
            .form-textarea { min-height: 100px; }

            .file-upload-area { padding: 24px; }
            .upload-icon { font-size: 28px; }

            .form-actions { flex-direction: column; gap: 16px; }
            .form-actions .btn {
                width: 100%;
                justify-content: center;
                padding: 14px 20px;
            }
            .btn-secondary { order: 2; }
            .btn-primary { order: 1; }

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
            .registration-card { padding: 24px 16px; border-radius: 12px; gap: 24px; }

            .card-header h1 { font-size: 24px; margin-bottom: 8px; }
            .card-header p { font-size: 13px; }

            .progress-steps { overflow-x: auto; padding-bottom: 8px; }
            .step-item { min-width: 70px; }
            .step-label { font-size: 10px; white-space: normal; text-align: center; }
            .step-circle { width: 24px; height: 24px; font-size: 11px; }
            .progress-line, .progress-line-fill { top: 12px; }

            .form-label { font-size: 13px; }
            .form-input, .form-select { padding: 10px 12px; font-size: 14px; }

            .file-upload-area { padding: 20px; }
            .upload-text { font-size: 14px; }
            .upload-hint { font-size: 11px; }

            .btn { font-size: 15px; padding: 12px 20px; }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 18px; }
            .logo i { font-size: 22px; }
            .login-link { font-size: 12px; }

            .registration-card { padding: 20px 12px; }
            .card-header h1 { font-size: 22px; }

            .step-item { min-width: 60px; }
            .step-circle { width: 22px; height: 22px; font-size: 10px; }

            .form-input, .form-select { padding: 8px 10px; font-size: 13px; }
            .btn { font-size: 14px; padding: 10px 16px; }
        }
    </style>
</head>
<body>

    <!-- Background Decoration -->
    <div class="decorative-shape shape-1"></div>
    <div class="decorative-shape shape-2"></div>

    <!-- Navigation with Laravel routes -->
    <nav class="navbar" role="navigation" aria-label="Main Navigation">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
        </a>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="login-link">Already a vendor? Log in</a>
            <div class="hamburger" aria-label="Menu" role="button" tabindex="0" id="menuToggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">
        <div class="registration-card">
            <div class="card-header">
                <h1>Join the Marketplace</h1>
                <p>Start selling your unique products to millions of customers. Complete the steps below to register your vendor account.</p>
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
                    Please fix the errors below and try again.
                </div>
            @endif

            <!-- Progress Indicator -->
            <div class="progress-steps" aria-label="Registration Progress">
                <div class="progress-line"></div>
                <div class="progress-line-fill" style="width: {{ session('registration_step', 1) == 1 ? '33%' : (session('registration_step', 1) == 2 ? '66%' : '100%') }};"></div>

                <div class="step-item {{ session('registration_step', 1) >= 1 ? 'completed' : '' }} {{ session('registration_step', 1) == 1 ? 'active' : '' }}">
                    <div class="step-circle">
                        @if(session('registration_step', 1) > 1)
                            <i class="ri-check-line"></i>
                        @else
                            1
                        @endif
                    </div>
                    <div class="step-label">Account</div>
                </div>
                <div class="step-item {{ session('registration_step', 1) >= 2 ? 'completed' : '' }} {{ session('registration_step', 1) == 2 ? 'active' : '' }}">
                    <div class="step-circle">
                        @if(session('registration_step', 1) > 2)
                            <i class="ri-check-line"></i>
                        @else
                            2
                        @endif
                    </div>
                    <div class="step-label">Business Info</div>
                </div>
                <div class="step-item {{ session('registration_step', 1) >= 3 ? 'completed' : '' }} {{ session('registration_step', 1) == 3 ? 'active' : '' }}">
                    <div class="step-circle">
                        @if(session('registration_step', 1) > 3)
                            <i class="ri-check-line"></i>
                        @else
                            3
                        @endif
                    </div>
                    <div class="step-label">Verification</div>
                </div>
            </div>

            <!-- Form with Laravel CSRF and route binding -->
            <form class="form-section" action="{{ route('vendor.register') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <!-- Step 1: Account Information -->
                <div id="step1" style="display: {{ session('registration_step', 1) == 1 ? 'block' : 'none' }};">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullname" class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" id="fullname" name="fullname" class="form-input @error('fullname') error @enderror" placeholder="John Doe" value="{{ old('fullname') }}">
                            @error('fullname')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" placeholder="you@example.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">Password <span class="required">*</span></label>
                            <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" placeholder="••••••••">
                            @error('password')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="required">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="••••••••">
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end; margin-top: 16px;">
                        <button type="button" class="btn btn-primary" onclick="validateAndNext(1)">
                            Continue to Business Info <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Business Details -->
                <div id="step2" style="display: {{ session('registration_step', 1) == 2 ? 'block' : 'none' }};">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="businessName" class="form-label">Business Name <span class="required">*</span></label>
                            <input type="text" id="businessName" name="business_name" class="form-input @error('business_name') error @enderror" placeholder="e.g. Artisan Crafts Co." value="{{ old('business_name') }}">
                            @error('business_name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Primary Category <span class="required">*</span></label>
                            <select id="category" name="category" class="form-select @error('category') error @enderror">
                                <option value="">Select a category</option>
                                <option value="fashion" {{ old('category') == 'fashion' ? 'selected' : '' }}>Fashion & Apparel</option>
                                <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home & Living</option>
                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="art" {{ old('category') == 'art' ? 'selected' : '' }}>Art & Collectibles</option>
                                <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Beverages</option>
                                <option value="beauty" {{ old('category') == 'beauty' ? 'selected' : '' }}>Beauty & Personal Care</option>
                                <option value="photography" {{ old('category') == 'photography' ? 'selected' : '' }}>Photography</option>
                                <option value="handmade" {{ old('category') == 'handmade' ? 'selected' : '' }}>Handmade Crafts</option>
                            </select>
                            @error('category')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="taxId" class="form-label">Tax ID / VAT Number</label>
                            <input type="text" id="taxId" name="tax_id" class="form-input" placeholder="Optional for registration" value="{{ old('tax_id') }}">
                        </div>
                        <div class="form-group">
                            <label for="website" class="form-label">Website URL</label>
                            <input type="url" id="website" name="website" class="form-input @error('website') error @enderror" placeholder="https://example.com" value="{{ old('website') }}">
                            @error('website')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Business Address -->
                    <div class="form-group">
                        <label class="form-label">Business Address <span class="required">*</span></label>
                        <div class="form-row" style="margin-bottom: 16px;">
                            <input type="text" name="address_line1" class="form-input @error('address_line1') error @enderror" placeholder="Street Address" style="flex: 2;" value="{{ old('address_line1') }}">
                            <input type="text" name="address_line2" class="form-input" placeholder="Apt / Suite" style="flex: 1;" value="{{ old('address_line2') }}">
                        </div>
                        @error('address_line1')
                            <div class="error-message" style="margin-top: -8px; margin-bottom: 16px;">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="city" class="form-input @error('city') error @enderror" placeholder="City" value="{{ old('city') }}">
                                @error('city')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="state" class="form-select @error('state') error @enderror">
                                    <option value="">State / Province</option>
                                    <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                                    <option value="AK" {{ old('state') == 'AK' ? 'selected' : '' }}>Alaska</option>
                                    <option value="AZ" {{ old('state') == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                    <option value="AR" {{ old('state') == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                    <option value="CA" {{ old('state') == 'CA' ? 'selected' : '' }}>California</option>
                                    <option value="CO" {{ old('state') == 'CO' ? 'selected' : '' }}>Colorado</option>
                                    <option value="CT" {{ old('state') == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                    <option value="DE" {{ old('state') == 'DE' ? 'selected' : '' }}>Delaware</option>
                                    <option value="FL" {{ old('state') == 'FL' ? 'selected' : '' }}>Florida</option>
                                    <option value="GA" {{ old('state') == 'GA' ? 'selected' : '' }}>Georgia</option>
                                    <option value="HI" {{ old('state') == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                    <option value="ID" {{ old('state') == 'ID' ? 'selected' : '' }}>Idaho</option>
                                    <option value="IL" {{ old('state') == 'IL' ? 'selected' : '' }}>Illinois</option>
                                    <option value="IN" {{ old('state') == 'IN' ? 'selected' : '' }}>Indiana</option>
                                    <option value="IA" {{ old('state') == 'IA' ? 'selected' : '' }}>Iowa</option>
                                    <option value="KS" {{ old('state') == 'KS' ? 'selected' : '' }}>Kansas</option>
                                    <option value="KY" {{ old('state') == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                    <option value="LA" {{ old('state') == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                    <option value="ME" {{ old('state') == 'ME' ? 'selected' : '' }}>Maine</option>
                                    <option value="MD" {{ old('state') == 'MD' ? 'selected' : '' }}>Maryland</option>
                                    <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                    <option value="MI" {{ old('state') == 'MI' ? 'selected' : '' }}>Michigan</option>
                                    <option value="MN" {{ old('state') == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                    <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                    <option value="MO" {{ old('state') == 'MO' ? 'selected' : '' }}>Missouri</option>
                                    <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Montana</option>
                                    <option value="NE" {{ old('state') == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                    <option value="NV" {{ old('state') == 'NV' ? 'selected' : '' }}>Nevada</option>
                                    <option value="NH" {{ old('state') == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                    <option value="NJ" {{ old('state') == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                    <option value="NM" {{ old('state') == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                    <option value="NY" {{ old('state') == 'NY' ? 'selected' : '' }}>New York</option>
                                    <option value="NC" {{ old('state') == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                    <option value="ND" {{ old('state') == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                    <option value="OH" {{ old('state') == 'OH' ? 'selected' : '' }}>Ohio</option>
                                    <option value="OK" {{ old('state') == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                    <option value="OR" {{ old('state') == 'OR' ? 'selected' : '' }}>Oregon</option>
                                    <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                    <option value="RI" {{ old('state') == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                    <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                    <option value="SD" {{ old('state') == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                    <option value="TN" {{ old('state') == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                    <option value="TX" {{ old('state') == 'TX' ? 'selected' : '' }}>Texas</option>
                                    <option value="UT" {{ old('state') == 'UT' ? 'selected' : '' }}>Utah</option>
                                    <option value="VT" {{ old('state') == 'VT' ? 'selected' : '' }}>Vermont</option>
                                    <option value="VA" {{ old('state') == 'VA' ? 'selected' : '' }}>Virginia</option>
                                    <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Washington</option>
                                    <option value="WV" {{ old('state') == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                    <option value="WI" {{ old('state') == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                    <option value="WY" {{ old('state') == 'WY' ? 'selected' : '' }}>Wyoming</option>
                                </select>
                                @error('state')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="zip_code" class="form-input @error('zip_code') error @enderror" placeholder="Zip Code" value="{{ old('zip_code') }}">
                                @error('zip_code')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">Shop Description <span class="required">*</span></label>
                        <textarea id="description" name="description" class="form-textarea @error('description') error @enderror" placeholder="Tell us about your brand and what makes your products unique..." maxlength="500">{{ old('description') }}</textarea>
                        <div class="char-counter" style="display: flex; justify-content: flex-end; margin-top: 4px; font-size: 12px; color: var(--text-light);">
                            <span id="charCount">0</span>/500 characters
                        </div>
                        @error('description')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="form-group">
                        <label class="form-label">Business Logo or Store Banner</label>
                        <div class="file-upload-area" id="fileUploadArea" tabindex="0" role="button" aria-label="Upload file">
                            <i class="ri-upload-cloud-2-line upload-icon"></i>
                            <div class="upload-text" id="uploadText">Click to upload or drag and drop</div>
                            <div class="upload-hint">SVG, PNG, JPG or GIF (max. 5MB)</div>
                            <input type="file" name="logo" style="display: none;" id="fileUpload" accept="image/*">
                        </div>
                        <div id="filePreview" class="file-preview"></div>
                        @error('logo')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-top: 16px;">
                        <button type="button" class="btn btn-secondary" onclick="changeStep(1)">
                            <i class="ri-arrow-left-line"></i> Back to Account
                        </button>
                        <button type="button" class="btn btn-primary" onclick="validateAndNext(2)">
                            Complete Registration <i class="ri-check-line"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Email Verification - FIXED VERSION -->
                <div id="step3" style="display: {{ session('registration_step', 1) == 3 ? 'block' : 'none' }};">
                    <div style="text-align: center; padding: 20px 20px 40px;">
                        <i class="ri-mail-check-line" style="font-size: 64px; color: var(--primary-color); margin-bottom: 20px;"></i>
                        <h3 style="margin-bottom: 16px; font-size: 24px;">Verify Your Email</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success" style="margin-bottom: 24px;">
                                <i class="ri-checkbox-circle-line"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(Auth::check())
                            <p style="color: var(--text-light); margin-bottom: 24px; line-height: 1.6;">
                                We've sent a verification link to <strong>{{ Auth::user()->email }}</strong>.<br>
                                Please check your inbox and click the link to verify your account.
                            </p>
                            
                            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="margin: 0;">
                                        <i class="ri-mail-send-line"></i> Resend Verification Email
                                    </button>
                                </form>
                                
                                <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary" style="text-decoration: none;">
                                    <i class="ri-dashboard-line"></i> Go to Dashboard
                                </a>
                            </div>
                        @else
                            <p style="color: var(--text-light); margin-bottom: 24px; line-height: 1.6;">
                                Your account has been created successfully! Please log in to verify your email.
                            </p>
                            
                            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('login') }}" class="btn btn-primary" style="text-decoration: none;">
                                    <i class="ri-login-box-line"></i> Log In
                                </a>
                                
                                <a href="{{ route('home') }}" class="btn btn-secondary" style="text-decoration: none;">
                                    <i class="ri-home-line"></i> Return Home
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Multi-step form navigation
        function changeStep(step) {
            // Hide all steps
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';

            // Show selected step
            document.getElementById('step' + step).style.display = 'block';

            // Update progress line
            const fillWidth = step === 1 ? '33%' : (step === 2 ? '66%' : '100%');
            document.querySelector('.progress-line-fill').style.width = fillWidth;

            // Update step classes
            document.querySelectorAll('.step-item').forEach((item, index) => {
                item.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    item.classList.add('completed');
                } else if (index + 1 === step) {
                    item.classList.add('active');
                }
            });

            // Update step circles
            const stepCircles = document.querySelectorAll('.step-circle');
            stepCircles.forEach((circle, index) => {
                if (index + 1 < step) {
                    circle.innerHTML = '<i class="ri-check-line"></i>';
                } else if (index + 1 === step) {
                    circle.innerHTML = (index + 1).toString();
                }
            });

            // Update session via AJAX
            fetch('{{ route("vendor.registration.step") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ step: step })
            }).catch(error => console.log('Step persistence error:', error));
        }

        // Validate current step before proceeding
        function validateAndNext(currentStep) {
            if (currentStep === 1) {
                const fullname = document.getElementById('fullname');
                const email = document.getElementById('email');
                const password = document.getElementById('password');
                const passwordConfirm = document.getElementById('password_confirmation');

                let isValid = true;
                let errorMessage = '';

                if (!fullname.value.trim()) {
                    errorMessage = 'Please enter your full name';
                    isValid = false;
                } else if (!email.value.trim() || !email.value.includes('@')) {
                    errorMessage = 'Please enter a valid email address';
                    isValid = false;
                } else if (!password.value || password.value.length < 8) {
                    errorMessage = 'Password must be at least 8 characters';
                    isValid = false;
                } else if (password.value !== passwordConfirm.value) {
                    errorMessage = 'Passwords do not match';
                    isValid = false;
                }

                if (isValid) {
                    changeStep(2);
                } else {
                    alert(errorMessage);
                }
            } else if (currentStep === 2) {
                const businessName = document.getElementById('businessName');
                const category = document.getElementById('category');
                const address1 = document.querySelector('input[name="address_line1"]');
                const city = document.querySelector('input[name="city"]');
                const state = document.querySelector('select[name="state"]');
                const zipCode = document.querySelector('input[name="zip_code"]');
                const description = document.getElementById('description');

                let isValid = true;
                let errorMessage = '';

                if (!businessName.value.trim()) {
                    errorMessage = 'Please enter your business name';
                    isValid = false;
                } else if (!category.value) {
                    errorMessage = 'Please select a category';
                    isValid = false;
                } else if (!address1.value.trim()) {
                    errorMessage = 'Please enter your street address';
                    isValid = false;
                } else if (!city.value.trim()) {
                    errorMessage = 'Please enter your city';
                    isValid = false;
                } else if (!state.value) {
                    errorMessage = 'Please select your state';
                    isValid = false;
                } else if (!zipCode.value.trim()) {
                    errorMessage = 'Please enter your zip code';
                    isValid = false;
                } else if (!description.value.trim()) {
                    errorMessage = 'Please enter a shop description';
                    isValid = false;
                }

                if (isValid) {
                    // Submit form to create vendor account
                    document.getElementById('registrationForm').submit();
                } else {
                    alert(errorMessage);
                }
            }
        }

        // File upload handling
        document.addEventListener('DOMContentLoaded', function() {
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileInput = document.getElementById('fileUpload');
            const uploadText = document.getElementById('uploadText');
            const filePreview = document.getElementById('filePreview');

            if (fileUploadArea && fileInput) {
                fileUploadArea.addEventListener('click', () => fileInput.click());

                fileUploadArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    fileUploadArea.style.borderColor = 'var(--primary-color)';
                    fileUploadArea.style.backgroundColor = '#FFFDF5';
                });

                fileUploadArea.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    fileUploadArea.style.borderColor = 'var(--border-color)';
                    fileUploadArea.style.backgroundColor = '#FAFAFA';
                });

                fileUploadArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    fileUploadArea.style.borderColor = 'var(--border-color)';
                    fileUploadArea.style.backgroundColor = '#FAFAFA';

                    if (e.dataTransfer.files.length) {
                        fileInput.files = e.dataTransfer.files;
                        handleFileSelect(e.dataTransfer.files[0]);
                    }
                });

                fileInput.addEventListener('change', () => {
                    if (fileInput.files.length) {
                        handleFileSelect(fileInput.files[0]);
                    }
                });
            }

            function handleFileSelect(file) {
                uploadText.textContent = `Selected: ${file.name}`;
                fileUploadArea.classList.add('has-file');

                // Show file preview
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        filePreview.innerHTML = `
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="${e.target.result}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                <div>
                                    <div style="font-weight: 600;">${file.name}</div>
                                    <div style="font-size: 12px; color: var(--text-light);">${(file.size / 1024).toFixed(1)} KB</div>
                                </div>
                            </div>
                        `;
                        filePreview.classList.add('active');
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Character counter for description
        const descTextarea = document.getElementById('description');
        if (descTextarea) {
            const charCount = document.getElementById('charCount');
            if (charCount) {
                const updateCounter = () => {
                    const count = descTextarea.value.length;
                    charCount.textContent = count;

                    if (count >= 500) {
                        descTextarea.classList.add('error');
                        charCount.style.color = 'var(--error-color)';
                    } else {
                        descTextarea.classList.remove('error');
                        charCount.style.color = 'var(--text-light)';
                    }
                };
                descTextarea.addEventListener('input', updateCounter);
                updateCounter();
            }
        }

        // Hamburger menu (mobile)
        document.querySelector('.hamburger')?.addEventListener('click', function() {
            // Toggle mobile menu (you can implement this later)
            console.log('Mobile menu clicked');
            alert('Mobile menu would open here. Navigation links are hidden on mobile by CSS.');
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
    </script>

</body>
</html>