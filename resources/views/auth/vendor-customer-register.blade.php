<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Register | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --success-color: #10b981;
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
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        .navbar {
            background-color: var(--bg-card);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .logo i {
            font-size: 32px;
        }

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

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .login-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: var(--primary-gold);
        }

        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .hamburger:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .registration-card {
            background: var(--bg-card);
            width: 100%;
            max-width: 900px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 40px;
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

        /* Role Switch */
        .role-switch {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            padding: 4px;
            background-color: #f1f5f9;
            border-radius: 50px;
        }

        .role-btn {
            flex: 1;
            padding: 12px 24px;
            border: none;
            background: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .role-btn i {
            font-size: 18px;
        }

        .role-btn.active {
            background-color: var(--bg-card);
            color: var(--primary-gold);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .role-btn:hover:not(.active) {
            color: var(--primary-gold);
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .card-header h1 {
            font-size: 32px;
            font-weight: 700;
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
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
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
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 32px;
        }

        .progress-line {
            position: absolute;
            top: 24px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--border-color);
            z-index: 1;
        }

        .progress-line-fill {
            position: absolute;
            top: 24px;
            left: 0;
            height: 2px;
            background-color: var(--primary-gold);
            z-index: 1;
            transition: width 0.5s ease;
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
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-light);
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background-color: #fef3e7;
            transform: scale(1.1);
        }

        .step-item.completed .step-circle {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
            color: white;
        }

        .step-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
        }

        .step-item.active .step-label {
            color: var(--primary-gold);
            font-weight: 600;
        }

        /* Form */
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .required {
            color: var(--error-color);
        }

        .input-wrapper {
            position: relative;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 15px;
            color: var(--text-dark);
            background-color: var(--bg-card);
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:hover,
        .form-select:hover,
        .form-textarea:hover {
            border-color: var(--primary-gold);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: var(--error-color);
            background-color: #fef2f2;
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

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bars {
            display: flex;
            gap: 4px;
            margin-bottom: 4px;
        }

        .strength-bar {
            height: 4px;
            flex: 1;
            background-color: var(--border-color);
            border-radius: 2px;
            transition: background-color 0.3s;
        }

        .strength-text {
            font-size: 12px;
            color: var(--text-light);
        }

        /* Toggle Password */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            font-size: 20px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--primary-gold);
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: #fafafa;
        }

        .file-upload-area:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
            transform: translateY(-2px);
        }

        .file-upload-area.has-file {
            border-color: var(--success-color);
            background-color: #f0fdf4;
        }

        .upload-icon {
            font-size: 40px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .upload-text {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .upload-hint {
            font-size: 12px;
            color: var(--text-light);
        }

        .file-preview {
            display: none;
            margin-top: 16px;
            padding: 16px;
            background-color: #f8fafc;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
        }

        .file-preview.active {
            display: block;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .preview-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .preview-details {
            flex: 1;
        }

        .preview-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .preview-size {
            font-size: 12px;
            color: var(--text-light);
        }

        .preview-remove {
            background: none;
            border: none;
            color: var(--error-color);
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .preview-remove:hover {
            background-color: #fee2e2;
        }

        /* Character Counter */
        .char-counter {
            display: flex;
            justify-content: flex-end;
            margin-top: 4px;
            font-size: 12px;
            color: var(--text-light);
        }

        .char-counter.warning {
            color: #f59e0b;
        }

        .char-counter.error {
            color: var(--error-color);
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 32px;
            border-radius: var(--radius-sm);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-hover) 100%);
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background-color: #f8fafc;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

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

        /* Login Prompt */
        .login-prompt {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            color: var(--text-light);
            font-size: 14px;
        }

        .login-prompt a {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
        }

        .login-prompt a:hover {
            text-decoration: underline;
        }

        /* Verification Step */
        .verification-content {
            text-align: center;
            padding: 40px 20px;
        }

        .verification-icon {
            font-size: 80px;
            color: var(--primary-gold);
            margin-bottom: 24px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .verification-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .verification-text {
            color: var(--text-light);
            margin-bottom: 32px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .verification-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media screen and (max-width: 1024px) {
            .navbar { padding: 20px 40px; }
            .registration-card { padding: 32px; }
        }

        @media screen and (max-width: 900px) {
            .navbar { padding: 16px 30px; }
            .registration-card { padding: 28px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .nav-actions { gap: 16px; }
            .login-link { font-size: 14px; }
            .hamburger { display: flex; }

            .main-container { padding: 30px 16px; }
            .registration-card { padding: 24px; }

            .card-header h1 { font-size: 28px; }
            .card-header p { font-size: 15px; }

            .form-row { grid-template-columns: 1fr; gap: 16px; }

            .step-circle { width: 40px; height: 40px; font-size: 16px; }
            .step-label { font-size: 12px; }

            .verification-title { font-size: 24px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 22px; }
            .logo i { font-size: 26px; }

            .registration-card { padding: 20px; }

            .card-header h1 { font-size: 26px; }
            .card-header p { font-size: 14px; }

            .role-btn { padding: 10px 16px; font-size: 14px; }

            .progress-steps { margin-bottom: 24px; }
            .progress-line, .progress-line-fill { top: 20px; }

            .form-actions { flex-direction: column; gap: 12px; }
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .verification-actions { flex-direction: column; }
            .verification-actions .btn { width: 100%; }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 10px 12px; }
            .logo { font-size: 20px; gap: 4px; }
            .logo i { font-size: 24px; }
            .ethiopia-badge { font-size: 10px; padding: 2px 8px; }

            .main-container { padding: 20px 12px; }
            .registration-card { padding: 16px; }

            .card-header h1 { font-size: 24px; }
            .card-header p { font-size: 13px; }

            .role-btn { padding: 8px 12px; font-size: 13px; }
            .role-btn i { font-size: 16px; }

            .step-circle { width: 36px; height: 36px; font-size: 14px; }
            .step-label { font-size: 11px; white-space: nowrap; }

            .form-label { font-size: 13px; }
            .form-input, .form-select, .form-textarea { padding: 10px 12px; font-size: 14px; }

            .file-upload-area { padding: 24px; }
            .upload-icon { font-size: 32px; }

            .verification-icon { font-size: 60px; }
            .verification-title { font-size: 22px; }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 18px; }
            .logo i { font-size: 22px; }

            .step-circle { width: 32px; height: 32px; font-size: 13px; }
            .step-label { font-size: 10px; }

            .btn { padding: 10px 20px; font-size: 14px; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </a>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="login-link">Already have an account?</a>
            <div class="hamburger" id="menuToggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">
        <div class="registration-card">
            <!-- Role Switch -->
            <div class="role-switch">
                <a href="{{ route('register.customer') }}" class="role-btn {{ request()->routeIs('register.customer') ? 'active' : '' }}">
                    <i class="ri-user-line"></i> Customer
                </a>
                <a href="{{ route('register') }}" class="role-btn {{ request()->routeIs('register') ? 'active' : '' }}">
                    <i class="ri-store-line"></i> Vendor
                </a>
            </div>

            <div class="card-header">
                @if(request()->routeIs('register.customer'))
                    <h1>Create Customer Account</h1>
                    <p>Join Vendora to discover amazing local vendors in Jimma and across Ethiopia</p>
                @else
                    <h1>Become a Vendor in Jimma</h1>
                    <p>Start selling your unique products to customers in Jimma and across Ethiopia</p>
                @endif
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
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(request()->routeIs('register.customer'))
                <!-- Customer Registration Form -->
                <form class="form-section" action="{{ route('customer.register') }}" method="POST" id="customerForm">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Full Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-input @error('name') error @enderror" 
                                   placeholder="e.g. Abebe Kebede" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Address <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-input @error('email') error @enderror" 
                                   placeholder="name@example.com" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Phone Number <span class="required">*</span>
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form-input @error('phone') error @enderror" 
                                   placeholder="e.g. 0911 123 456" 
                                   value="{{ old('phone') }}" 
                                   required>
                            @error('phone')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="city" class="form-label">
                                City <span class="required">*</span>
                            </label>
                            <select name="city" id="city" class="form-select @error('city') error @enderror" required>
                                <option value="">Select your city</option>
                                <option value="Jimma" {{ old('city') == 'Jimma' ? 'selected' : '' }}>🏙️ Jimma</option>
                                <option value="Addis Ababa" {{ old('city') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                <option value="Bahir Dar" {{ old('city') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                                <option value="Gondar" {{ old('city') == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                                <option value="Hawassa" {{ old('city') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                                <option value="Dire Dawa" {{ old('city') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
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
                            <label for="password" class="form-label">
                                Password <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form-input @error('password') error @enderror" 
                                       placeholder="••••••••" 
                                       required 
                                       minlength="8">
                                <i class="ri-eye-off-line toggle-password" onclick="togglePassword(this)"></i>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bars">
                                    <div class="strength-bar"></div>
                                    <div class="strength-bar"></div>
                                    <div class="strength-bar"></div>
                                    <div class="strength-bar"></div>
                                </div>
                                <span class="strength-text">Enter a strong password</span>
                            </div>
                            @error('password')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                Confirm Password <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="form-input" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            <i class="ri-arrow-left-line"></i> Back to Login
                        </a>
                        <button type="submit" class="btn btn-primary" id="customerSubmitBtn">
                            <span>Create Account</span>
                            <i class="ri-user-line"></i>
                        </button>
                    </div>
                </form>

            @else
                <!-- Vendor Registration Form -->
                <form class="form-section" action="{{ route('vendor.register') }}" method="POST" enctype="multipart/form-data" id="vendorForm">
                    @csrf

                    <!-- Progress Indicator -->
                    <div class="progress-steps">
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
                            <span class="step-label">Account</span>
                        </div>
                        <div class="step-item {{ session('registration_step', 1) >= 2 ? 'completed' : '' }} {{ session('registration_step', 1) == 2 ? 'active' : '' }}">
                            <div class="step-circle">
                                @if(session('registration_step', 1) > 2)
                                    <i class="ri-check-line"></i>
                                @else
                                    2
                                @endif
                            </div>
                            <span class="step-label">Business</span>
                        </div>
                        <div class="step-item {{ session('registration_step', 1) >= 3 ? 'completed' : '' }} {{ session('registration_step', 1) == 3 ? 'active' : '' }}">
                            <div class="step-circle">
                                @if(session('registration_step', 1) > 3)
                                    <i class="ri-check-line"></i>
                                @else
                                    3
                                @endif
                            </div>
                            <span class="step-label">Verify</span>
                        </div>
                    </div>

                    <!-- Step 1: Account Information -->
                    <div id="step1" style="display: {{ session('registration_step', 1) == 1 ? 'block' : 'none' }};">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullname" class="form-label">
                                    Full Name <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="fullname" 
                                       name="fullname" 
                                       class="form-input @error('fullname') error @enderror" 
                                       placeholder="e.g. Abebe Kebede" 
                                       value="{{ old('fullname') }}" 
                                       required>
                                @error('fullname')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Email Address <span class="required">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-input @error('email') error @enderror" 
                                       placeholder="name@example.com" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    Password <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-input @error('password') error @enderror" 
                                           placeholder="••••••••" 
                                           required 
                                           minlength="8">
                                    <i class="ri-eye-off-line toggle-password" onclick="togglePassword(this)"></i>
                                </div>
                                <div class="password-strength">
                                    <div class="strength-bars">
                                        <div class="strength-bar"></div>
                                        <div class="strength-bar"></div>
                                        <div class="strength-bar"></div>
                                        <div class="strength-bar"></div>
                                    </div>
                                    <span class="strength-text">Enter a strong password</span>
                                </div>
                                @error('password')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    Confirm Password <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="form-input" 
                                       placeholder="••••••••" 
                                       required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                <i class="ri-arrow-left-line"></i> Back to Login
                            </a>
                            <button type="button" class="btn btn-primary" onclick="goToStep(2)">
                                Continue <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Business Details -->
                    <div id="step2" style="display: {{ session('registration_step', 1) == 2 ? 'block' : 'none' }};">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="business_name" class="form-label">
                                    Business Name <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="business_name" 
                                       name="business_name" 
                                       class="form-input @error('business_name') error @enderror" 
                                       placeholder="e.g. Abebe's Handicrafts" 
                                       value="{{ old('business_name') }}" 
                                       required>
                                @error('business_name')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category" class="form-label">
                                    Category <span class="required">*</span>
                                </label>
                                <select id="category" name="category" class="form-select @error('category') error @enderror" required>
                                    <option value="">Select a category</option>
                                    <option value="coffee" {{ old('category') == 'coffee' ? 'selected' : '' }}>☕ Coffee & Tea</option>
                                    <option value="handicrafts" {{ old('category') == 'handicrafts' ? 'selected' : '' }}>🎨 Traditional Handicrafts</option>
                                    <option value="textiles" {{ old('category') == 'textiles' ? 'selected' : '' }}>🧵 Textiles & Habesha Kemis</option>
                                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>🍲 Ethiopian Food & Spices</option>
                                    <option value="jewelry" {{ old('category') == 'jewelry' ? 'selected' : '' }}>💍 Traditional Jewelry</option>
                                    <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>📱 Electronics</option>
                                    <option value="services" {{ old('category') == 'services' ? 'selected' : '' }}>🛠️ Services</option>
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
                                <label for="phone" class="form-label">
                                    Phone Number <span class="required">*</span>
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-input @error('phone') error @enderror" 
                                       placeholder="e.g. 0911 123 456" 
                                       value="{{ old('phone') }}" 
                                       required>
                                @error('phone')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tax_id" class="form-label">Business License / Tax ID</label>
                                <input type="text" 
                                       id="tax_id" 
                                       name="tax_id" 
                                       class="form-input" 
                                       placeholder="Optional" 
                                       value="{{ old('tax_id') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Business Address <span class="required">*</span></label>
                            <div class="form-row" style="margin-bottom: 16px;">
                                <input type="text" 
                                       name="address_line1" 
                                       class="form-input @error('address_line1') error @enderror" 
                                       placeholder="Street / Kebele" 
                                       value="{{ old('address_line1') }}" 
                                       required>
                                <input type="text" 
                                       name="address_line2" 
                                       class="form-input" 
                                       placeholder="Landmark (Optional)" 
                                       value="{{ old('address_line2') }}">
                            </div>
                            @error('address_line1')
                                <div class="error-message" style="margin-top: -8px; margin-bottom: 16px;">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city" class="form-label">City <span class="required">*</span></label>
                                    <select name="city" id="city" class="form-select @error('city') error @enderror" required>
                                        <option value="">Select City</option>
                                        <option value="Jimma" {{ old('city') == 'Jimma' ? 'selected' : '' }}>🏙️ Jimma</option>
                                        <option value="Addis Ababa" {{ old('city') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                        <option value="Bahir Dar" {{ old('city') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                                        <option value="Gondar" {{ old('city') == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                                        <option value="Hawassa" {{ old('city') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                                        <option value="Dire Dawa" {{ old('city') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                                        <option value="Other" {{ old('city') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('city')
                                        <div class="error-message">
                                            <i class="ri-error-warning-fill"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="state" class="form-label">Region <span class="required">*</span></label>
                                    <select name="state" id="state" class="form-select @error('state') error @enderror" required>
                                        <option value="">Select Region</option>
                                        <option value="Oromia" {{ old('state') == 'Oromia' ? 'selected' : '' }}>🌍 Oromia</option>
                                        <option value="Addis Ababa" {{ old('state') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                        <option value="Amhara" {{ old('state') == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                        <option value="Tigray" {{ old('state') == 'Tigray' ? 'selected' : '' }}>Tigray</option>
                                        <option value="Sidama" {{ old('state') == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                                        <option value="SNNPR" {{ old('state') == 'SNNPR' ? 'selected' : '' }}>SNNPR</option>
                                        <option value="Somali" {{ old('state') == 'Somali' ? 'selected' : '' }}>Somali</option>
                                    </select>
                                    @error('state')
                                        <div class="error-message">
                                            <i class="ri-error-warning-fill"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="zip_code" class="form-label">Postal Code</label>
                                    <input type="text" 
                                           name="zip_code" 
                                           id="zip_code" 
                                           class="form-input" 
                                           placeholder="Optional" 
                                           value="{{ old('zip_code') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">
                                Shop Description <span class="required">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      class="form-textarea @error('description') error @enderror" 
                                      placeholder="Tell us about your business and what makes it unique..." 
                                      maxlength="500" 
                                      required>{{ old('description') }}</textarea>
                            <div class="char-counter" id="charCount">0/500 characters</div>
                            @error('description')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Business Logo (Optional)</label>
                            <div class="file-upload-area" id="fileUploadArea">
                                <i class="ri-upload-cloud-2-line upload-icon"></i>
                                <div class="upload-text" id="uploadText">Click to upload or drag and drop</div>
                                <div class="upload-hint">SVG, PNG, JPG or GIF (max. 5MB)</div>
                                <input type="file" name="logo" id="fileUpload" accept="image/*" style="display: none;">
                            </div>
                            <div id="filePreview" class="file-preview"></div>
                            @error('logo')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(1)">
                                <i class="ri-arrow-left-line"></i> Back
                            </button>
                            <button type="submit" class="btn btn-primary" id="vendorSubmitBtn">
                                <span>Register Business</span>
                                <i class="ri-check-line"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Verification -->
                    <div id="step3" style="display: {{ session('registration_step', 1) == 3 ? 'block' : 'none' }};">
                        <div class="verification-content">
                            <i class="ri-mail-check-line verification-icon"></i>
                            <h2 class="verification-title">Verify Your Email</h2>
                            
                            @if(Auth::check())
                                <p class="verification-text">
                                    We've sent a verification link to <strong>{{ Auth::user()->email }}</strong>.<br>
                                    Please check your inbox and click the link to verify your account.
                                </p>

                                <div class="verification-actions">
                                    <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="resendBtn">
                                            <i class="ri-mail-send-line"></i> Resend Email
                                        </button>
                                    </form>

                                    <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary">
                                        <i class="ri-dashboard-line"></i> Go to Dashboard
                                    </a>
                                </div>
                            @else
                                <p class="verification-text">
                                    Your account has been created successfully!<br>
                                    Please log in to verify your email and start selling.
                                </p>

                                <div class="verification-actions">
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        <i class="ri-login-box-line"></i> Log In
                                    </a>
                                    <a href="{{ route('home') }}" class="btn btn-secondary">
                                        <i class="ri-home-line"></i> Return Home
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            @endif

            <!-- Login Prompt -->
            <div class="login-prompt">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
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
        document.querySelectorAll('input[type="password"]').forEach(passwordInput => {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const container = this.closest('.form-group');
                if (!container) return;

                const strengthBars = container.querySelectorAll('.strength-bar');
                const strengthText = container.querySelector('.strength-text');

                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;

                const colors = ['#e2e8f0', '#ef4444', '#f59e0b', '#10b981', '#10b981'];
                const texts = ['Enter a strong password', 'Weak', 'Fair', 'Good', 'Strong'];

                strengthBars.forEach((bar, index) => {
                    bar.style.backgroundColor = index < strength ? colors[strength] : '#e2e8f0';
                });

                if (strengthText) {
                    strengthText.textContent = texts[strength];
                    strengthText.style.color = colors[strength] || '#64748b';
                }
            });
        });

        // City and region sync
        const citySelect = document.getElementById('city');
        const stateSelect = document.getElementById('state');

        if (citySelect && stateSelect) {
            const cityRegionMap = {
                'Jimma': 'Oromia',
                'Addis Ababa': 'Addis Ababa',
                'Bahir Dar': 'Amhara',
                'Gondar': 'Amhara',
                'Hawassa': 'Sidama',
                'Dire Dawa': 'Dire Dawa'
            };

            citySelect.addEventListener('change', function() {
                const selectedCity = this.value;
                if (cityRegionMap[selectedCity]) {
                    stateSelect.value = cityRegionMap[selectedCity];
                }
            });
        }

        // Multi-step navigation for vendor
        function goToStep(step) {
            // Hide all steps
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';

            // Show selected step
            document.getElementById('step' + step).style.display = 'block';

            // Update progress
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
            document.querySelectorAll('.step-circle').forEach((circle, index) => {
                if (index + 1 < step) {
                    circle.innerHTML = '<i class="ri-check-line"></i>';
                } else if (index + 1 === step) {
                    circle.innerHTML = (index + 1).toString();
                }
            });

            // Save step via AJAX
            fetch('{{ route("vendor.registration.step") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ step: step })
            }).catch(error => console.log('Step persistence error:', error));
        }

        // File upload handling
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileUpload');
        const uploadText = document.getElementById('uploadText');
        const filePreview = document.getElementById('filePreview');

        if (fileUploadArea && fileInput) {
            fileUploadArea.addEventListener('click', () => fileInput.click());

            fileUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--primary-gold)';
                fileUploadArea.style.backgroundColor = '#fef3e7';
            });

            fileUploadArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-color)';
                fileUploadArea.style.backgroundColor = '#fafafa';
            });

            fileUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-color)';
                fileUploadArea.style.backgroundColor = '#fafafa';

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
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                return;
            }

            uploadText.textContent = `Selected: ${file.name}`;
            fileUploadArea.classList.add('has-file');

            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.innerHTML = `
                    <div class="preview-content">
                        <img src="${e.target.result}" class="preview-image">
                        <div class="preview-details">
                            <div class="preview-name">${file.name}</div>
                            <div class="preview-size">${(file.size / 1024).toFixed(1)} KB</div>
                        </div>
                        <button type="button" class="preview-remove" onclick="removeFile()">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                `;
                filePreview.classList.add('active');
            };
            reader.readAsDataURL(file);
        }

        function removeFile() {
            fileInput.value = '';
            uploadText.textContent = 'Click to upload or drag and drop';
            fileUploadArea.classList.remove('has-file');
            filePreview.innerHTML = '';
            filePreview.classList.remove('active');
        }

        // Character counter for description
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');

        if (description && charCount) {
            const updateCounter = () => {
                const count = description.value.length;
                charCount.textContent = count + '/500 characters';
                
                if (count >= 500) {
                    charCount.classList.add('error');
                    charCount.classList.remove('warning');
                } else if (count >= 400) {
                    charCount.classList.add('warning');
                    charCount.classList.remove('error');
                } else {
                    charCount.classList.remove('warning', 'error');
                }
            };
            
            description.addEventListener('input', updateCounter);
            updateCounter();
        }

        // Form submission loading states
        const customerForm = document.getElementById('customerForm');
        if (customerForm) {
            customerForm.addEventListener('submit', function(e) {
                const btn = document.getElementById('customerSubmitBtn');
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner"></span> Creating Account...';
            });
        }

        const vendorForm = document.getElementById('vendorForm');
        if (vendorForm) {
            vendorForm.addEventListener('submit', function(e) {
                const btn = document.getElementById('vendorSubmitBtn');
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner"></span> Registering Business...';
            });
        }

        // Resend verification cooldown
        const resendForm = document.getElementById('resendForm');
        if (resendForm) {
            resendForm.addEventListener('submit', function(e) {
                const btn = document.getElementById('resendBtn');
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner"></span> Sending...';

                setTimeout(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ri-mail-send-line"></i> Resend Email';
                }, 60000);
            });
        }

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Mobile menu
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            alert('Mobile menu would open here. In production, this would show navigation links.');
        });
    </script>

</body>
</html>