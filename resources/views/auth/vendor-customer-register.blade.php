<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Become a Vendor | Jimma, Ethiopia</title>
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
            background-color: var(--bg-card);
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
            max-width: 800px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 48px;
            display: flex;
            flex-direction: column;
            gap: 40px;
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
            transform: scale(1.1);
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
            transition: all 0.2s ease;
            width: 100%;
            background-color: var(--bg-card);
        }

        .form-input:hover, .form-select:hover, .form-textarea:hover {
            border-color: var(--primary-color);
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.15);
        }

        .form-input.error, .form-select.error, .form-textarea.error {
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
            transform: translateY(-2px);
        }

        .file-upload-area.has-file {
            border-color: var(--success-color);
            background-color: #E8F5E9;
        }

        .upload-icon {
            font-size: 32px;
            color: var(--primary-color);
            margin-bottom: 8px;
            transition: transform 0.2s;
        }

        .file-upload-area:hover .upload-icon {
            transform: scale(1.1);
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
            animation: fadeIn 0.3s ease;
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

        .btn-secondary {
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
            background-color: #f5f5f5;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
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
            .hamburger { display: flex; }

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
                <a href="{{ route('register.customer') }}" class="role-btn">
                    <i class="ri-user-line"></i> Customer
                </a>
                <a href="{{ route('register') }}" class="role-btn active">
                    <i class="ri-store-line"></i> Vendor
                </a>
            </div>

            <div class="card-header">
                <h1>Become a Vendor in Jimma</h1>
                <p>Start selling your unique products to customers in Jimma and across Ethiopia. Complete the steps below to register your vendor account.</p>
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
                            <div class="input-wrapper tooltip">
                                <span class="tooltip-text">Enter your full name as it appears on ID</span>
                                <input type="text" id="fullname" name="fullname" class="form-input @error('fullname') error @enderror" placeholder="e.g. Abebe Kebede" value="{{ old('fullname') }}" required>
                            </div>
                            @error('fullname')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                            <div class="password-strength" style="margin-top: 8px;">
                                <div style="display: flex; gap: 4px;">
                                    <div class="strength-bar" style="height: 4px; flex: 1; background-color: #e0e0e0; border-radius: 2px;"></div>
                                    <div class="strength-bar" style="height: 4px; flex: 1; background-color: #e0e0e0; border-radius: 2px;"></div>
                                    <div class="strength-bar" style="height: 4px; flex: 1; background-color: #e0e0e0; border-radius: 2px;"></div>
                                    <div class="strength-bar" style="height: 4px; flex: 1; background-color: #e0e0e0; border-radius: 2px;"></div>
                                </div>
                                <span class="strength-text" style="font-size: 12px; color: var(--text-light); margin-top: 4px; display: block;">Enter a strong password</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                            </div>
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
                            <input type="text" id="businessName" name="business_name" class="form-input @error('business_name') error @enderror" placeholder="e.g. Abebe's Handicrafts" value="{{ old('business_name') }}" required>
                            @error('business_name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Primary Category <span class="required">*</span></label>
                            <select id="category" name="category" class="form-select @error('category') error @enderror" required>
                                <option value="">Select a category</option>
                                <option value="coffee" {{ old('category') == 'coffee' ? 'selected' : '' }}>☕ Coffee & Tea</option>
                                <option value="handicrafts" {{ old('category') == 'handicrafts' ? 'selected' : '' }}>🎨 Traditional Handicrafts</option>
                                <option value="textiles" {{ old('category') == 'textiles' ? 'selected' : '' }}>🧵 Textiles & Habesha Kemis</option>
                                <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>🍲 Ethiopian Food & Spices</option>
                                <option value="jewelry" {{ old('category') == 'jewelry' ? 'selected' : '' }}>💍 Traditional Jewelry</option>
                                <option value="art" {{ old('category') == 'art' ? 'selected' : '' }}>🎨 Art & Paintings</option>
                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>📱 Electronics & Repair</option>
                                <option value="services" {{ old('category') == 'services' ? 'selected' : '' }}>🛠️ Local Services</option>
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
                            <label for="taxId" class="form-label">Business License / Tax ID</label>
                            <input type="text" id="taxId" name="tax_id" class="form-input" placeholder="Optional for registration" value="{{ old('tax_id') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-input @error('phone') error @enderror" placeholder="e.g. 0911 123 456" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Business Address - Ethiopian Focus -->
                    <div class="form-group">
                        <label class="form-label">Business Address <span class="required">*</span></label>
                        <div class="form-row" style="margin-bottom: 16px;">
                            <input type="text" name="address_line1" class="form-input @error('address_line1') error @enderror" placeholder="Street / Kebele" style="flex: 2;" value="{{ old('address_line1') }}" required>
                            <input type="text" name="address_line2" class="form-input" placeholder="Landmark (Optional)" style="flex: 1;" value="{{ old('address_line2') }}">
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

                            <div class="form-group">
                                <label for="state" class="form-label">Region / State <span class="required">*</span></label>
                                <select name="state" id="state" class="form-select @error('state') error @enderror" required>
                                    <option value="">Select Region</option>
                                    <option value="Oromia" {{ old('state') == 'Oromia' ? 'selected' : '' }} selected>🌍 Oromia (Jimma)</option>
                                    <option value="Addis Ababa" {{ old('state') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                    <option value="Amhara" {{ old('state') == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                    <option value="Tigray" {{ old('state') == 'Tigray' ? 'selected' : '' }}>Tigray</option>
                                    <option value="Sidama" {{ old('state') == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                                    <option value="SNNPR" {{ old('state') == 'SNNPR' ? 'selected' : '' }}>SNNPR</option>
                                    <option value="Somali" {{ old('state') == 'Somali' ? 'selected' : '' }}>Somali</option>
                                    <option value="Afar" {{ old('state') == 'Afar' ? 'selected' : '' }}>Afar</option>
                                    <option value="Benishangul-Gumuz" {{ old('state') == 'Benishangul-Gumuz' ? 'selected' : '' }}>Benishangul-Gumuz</option>
                                    <option value="Gambela" {{ old('state') == 'Gambela' ? 'selected' : '' }}>Gambela</option>
                                    <option value="Harari" {{ old('state') == 'Harari' ? 'selected' : '' }}>Harari</option>
                                </select>
                                @error('state')
                                    <div class="error-message">
                                        <i class="ri-error-warning-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="zip_code" class="form-label">Postal Code</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-input" placeholder="e.g. 1000" value="{{ old('zip_code') }}">
                                <small style="font-size: 11px; color: var(--text-light);">Optional for Jimma</small>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">Shop Description <span class="required">*</span></label>
                        <textarea id="description" name="description" class="form-textarea @error('description') error @enderror" placeholder="Tell us about your business, what makes your products unique, and your experience serving the Jimma community..." maxlength="500" required>{{ old('description') }}</textarea>
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

                <!-- Step 3: Email Verification -->
                <div id="step3" style="display: {{ session('registration_step', 1) == 3 ? 'block' : 'none' }};">
                    <div style="text-align: center; padding: 20px 20px 40px;">
                        <i class="ri-mail-check-line" style="font-size: 64px; color: var(--primary-color); margin-bottom: 20px; animation: pulse 2s infinite;"></i>
                        <h3 style="margin-bottom: 16px; font-size: 24px;">Verify Your Email</h3>

                        @if(session('success'))
                            <div class="alert alert-success" style="margin-bottom: 24px;">
                                <i class="ri-checkbox-circle-line"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(Auth::check())
                            <p style="color: var(--text-light); margin-bottom: 24px; line-height: 1.6;">
                                እንኳን ደህና መጡ! We've sent a verification link to <strong>{{ Auth::user()->email }}</strong>.<br>
                                Please check your inbox and click the link to verify your account and start selling in Jimma.
                            </p>

                            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                                <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="margin: 0;" id="resendBtn">
                                        <i class="ri-mail-send-line"></i> Resend Verification Email
                                    </button>
                                </form>

                                <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary" style="text-decoration: none;">
                                    <i class="ri-dashboard-line"></i> Go to Dashboard
                                </a>
                            </div>
                        @else
                            <p style="color: var(--text-light); margin-bottom: 24px; line-height: 1.6;">
                                Your account has been created successfully! Please log in to verify your email and start selling in Jimma.
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

            <!-- Login Prompt -->
            <div class="login-prompt">
                Already have a vendor account? <a href="{{ route('login') }}">Sign in</a>
            </div>
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

        // City selection auto-sets region
        document.getElementById('city')?.addEventListener('change', function() {
            const city = this.value;
            const stateSelect = document.getElementById('state');

            // Auto-select region based on city
            if (city === 'Jimma') {
                stateSelect.value = 'Oromia';
            } else if (city === 'Addis Ababa') {
                stateSelect.value = 'Addis Ababa';
            } else if (city === 'Bahir Dar' || city === 'Gondar') {
                stateSelect.value = 'Amhara';
            } else if (city === 'Mekelle') {
                stateSelect.value = 'Tigray';
            } else if (city === 'Hawassa') {
                stateSelect.value = 'Sidama';
            } else if (city === 'Dire Dawa') {
                stateSelect.value = 'Dire Dawa';
            } else if (city === 'Harar') {
                stateSelect.value = 'Harari';
            }
        });

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
                const phone = document.getElementById('phone');
                const address1 = document.querySelector('input[name="address_line1"]');
                const city = document.getElementById('city');
                const state = document.getElementById('state');
                const description = document.getElementById('description');

                let isValid = true;
                let errorMessage = '';

                if (!businessName.value.trim()) {
                    errorMessage = 'Please enter your business name';
                    isValid = false;
                } else if (!category.value) {
                    errorMessage = 'Please select a category';
                    isValid = false;
                } else if (!phone.value.trim()) {
                    errorMessage = 'Please enter your phone number';
                    isValid = false;
                } else if (!address1.value.trim()) {
                    errorMessage = 'Please enter your street address';
                    isValid = false;
                } else if (!city.value) {
                    errorMessage = 'Please select your city';
                    isValid = false;
                } else if (!state.value) {
                    errorMessage = 'Please select your region';
                    isValid = false;
                } else if (!description.value.trim()) {
                    errorMessage = 'Please enter a shop description';
                    isValid = false;
                }

                if (isValid) {
                    // Show loading state
                    const submitBtn = document.querySelector('button[onclick="validateAndNext(2)"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner"></span> Creating Account...';
                    submitBtn.disabled = true;

                    // Submit form
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
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            alert('Mobile menu would open here. In production, this would show navigation links.');
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

        // Prevent double submission
        document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('button[type="button"][onclick="validateAndNext(2)"]');
            if (submitBtn && submitBtn.disabled) {
                e.preventDefault();
            }
        });

        // Resend verification cooldown
        document.getElementById('resendForm')?.addEventListener('submit', function(e) {
            const btn = document.getElementById('resendBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Sending...';

            // Re-enable after 60 seconds
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="ri-mail-send-line"></i> Resend Verification Email';
            }, 60000);
        });

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>
</html>
