<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Settings - {{ $user->business_name ?? $user->name }} | Vendora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #E5E7EB;
            --white: #FFFFFF;
            --light-gray: #F9FAFB;
            --shadow: 0 4px 20px rgba(0,0,0,0.05);
            --shadow-hover: 0 8px 30px rgba(184,142,63,0.15);
            --radius: 8px;
            --transition: all 0.3s ease;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
        }

        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #E5E7EB;
            --text-light: #9CA3AF;
            --border-color: #374151;
            --white: #1F2937;
            --light-gray: #111827;
            --success: #34D399;
            --error: #F87171;
            --warning: #FBBF24;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
            transition: background-color 0.3s, color 0.3s;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .theme-toggle {
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            border-radius: 30px;
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Settings Card */
        .settings-card {
            background: var(--white);
            border-radius: 16px;
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .settings-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .settings-header h1 {
            font-size: 32px;
            margin-bottom: 8px;
            color: var(--primary-gold);
        }

        .settings-header p {
            color: var(--text-light);
        }

        /* Progress Bar */
        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--border-color);
            z-index: 1;
        }

        .progress-step {
            position: relative;
            z-index: 2;
            background: var(--white);
            padding: 0 10px;
            text-align: center;
        }

        .step-number {
            width: 32px;
            height: 32px;
            background: var(--light-gray);
            border: 2px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-weight: 600;
            color: var(--text-light);
        }

        .step-number.active {
            background: var(--primary-gold);
            border-color: var(--primary-gold);
            color: white;
        }

        .step-number.completed {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step-label {
            font-size: 12px;
            color: var(--text-light);
        }

        .step-label.active {
            color: var(--primary-gold);
            font-weight: 600;
        }

        /* Form Sections */
        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            color: var(--primary-gold);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .required-star {
            color: var(--error);
            margin-left: 2px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            font-size: 15px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184,142,63,0.1);
        }

        .form-control.is-invalid {
            border-color: var(--error);
            background-color: rgba(239, 68, 68, 0.05);
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            color: var(--error);
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* Image Preview */
        .image-preview {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .current-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid var(--border-color);
        }

        .current-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-actions {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        /* Social Links */
        .social-links {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .social-input {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 20px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-primary {
            background: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #0f9e6a;
            transform: translateY(-2px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: flex-end;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
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
            background: #ecfdf5;
            color: var(--success);
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fef2f2;
            color: var(--error);
            border: 1px solid #fecaca;
        }

        .alert-warning {
            background: #fffbeb;
            color: var(--warning);
            border: 1px solid #fde68a;
        }

        .alert i {
            font-size: 20px;
        }

        .alert ul {
            margin-left: 20px;
        }

        /* Toast Notification */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: 8px;
            box-shadow: var(--shadow-hover);
            padding: 16px 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 400px;
            animation: slideInRight 0.3s ease;
        }

        .toast.success {
            border-left-color: var(--success);
        }

        .toast.error {
            border-left-color: var(--error);
        }

        .toast.warning {
            border-left-color: var(--warning);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast.success .toast-icon {
            color: var(--success);
        }

        .toast.error .toast-icon {
            color: var(--error);
        }

        .toast.warning .toast-icon {
            color: var(--warning);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-dark);
        }

        .toast-message {
            font-size: 14px;
            color: var(--text-light);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-light);
            font-size: 18px;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: var(--error);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-row-3 {
                grid-template-columns: 1fr;
            }

            .social-links {
                grid-template-columns: 1fr;
            }

            .settings-card {
                padding: 30px 20px;
            }

            .navigation-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .navigation-buttons .btn {
                width: 100%;
            }

            .actions {
                flex-direction: column;
            }

            .actions .btn {
                width: 100%;
            }

            .toast {
                min-width: 250px;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
            <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('vendor.products.index') }}" class="nav-link">Products</a>
            <a href="{{ route('vendor.profile') }}" class="nav-link">Profile</a>
            <button class="theme-toggle" id="themeToggle">
                <i class="ri-moon-line"></i>
                <span>Theme</span>
            </button>
        </div>
    </nav>

    <div class="container">
        <!-- Settings Card -->
        <div class="settings-card">
            <div class="settings-header">
                <h1>Vendor Settings</h1>
                <p>Update your business information and preferences</p>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-step">
                    <div class="step-number active" id="step1Indicator">1</div>
                    <div class="step-label active" id="step1Label">Basic Info</div>
                </div>
                <div class="progress-step">
                    <div class="step-number" id="step2Indicator">2</div>
                    <div class="step-label" id="step2Label">Address</div>
                </div>
                <div class="progress-step">
                    <div class="step-number" id="step3Indicator">3</div>
                    <div class="step-label" id="step3Label">Additional</div>
                </div>
                <div class="progress-step">
                    <div class="step-number" id="step4Indicator">4</div>
                    <div class="step-label" id="step4Label">Media</div>
                </div>
            </div>

            <!-- Alert Messages -->
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
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.settings.update') }}" enctype="multipart/form-data" id="settingsForm">
                @csrf
                
                <!-- Section 1: Basic Information -->
                <div class="form-section active" id="section1">
                    <h3 class="section-title">Basic Information</h3>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Business Name <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="business_name" 
                               class="form-control @error('business_name') is-invalid @enderror" 
                               value="{{ old('business_name', $user->business_name) }}" 
                               required
                               maxlength="255">
                        @error('business_name')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Email <span class="required-star">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="tel" 
                                   name="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+251 XXX XXX XXX"
                                   pattern="^\+?[0-9\s\-\(\)]{10,20}$"
                                   title="Please enter a valid phone number (10-20 digits, can include +, spaces, -, parentheses)">
                            @error('phone')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small style="color: var(--text-light);">Format: +251 912 345 678 or 0912345678</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Category <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="category" 
                               class="form-control @error('category') is-invalid @enderror" 
                               value="{{ old('category', $user->category) }}" 
                               required
                               placeholder="e.g., Coffee, Handicrafts, Textiles">
                        @error('category')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Website</label>
                        <input type="url" 
                               name="website" 
                               class="form-control @error('website') is-invalid @enderror" 
                               value="{{ old('website', $user->website) }}" 
                               placeholder="https://example.com">
                        @error('website')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Section 2: Address Information -->
                <div class="form-section" id="section2">
                    <h3 class="section-title">Address Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                City <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   name="city" 
                                   class="form-control @error('city') is-invalid @enderror" 
                                   value="{{ old('city', $user->city) }}" 
                                   required>
                            @error('city')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                State <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   name="state" 
                                   class="form-control @error('state') is-invalid @enderror" 
                                   value="{{ old('state', $user->state) }}" 
                                   required>
                            @error('state')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Address Line 1 <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="address_line1" 
                               class="form-control @error('address_line1') is-invalid @enderror" 
                               value="{{ old('address_line1', $user->address_line1) }}" 
                               required>
                        @error('address_line1')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address Line 2</label>
                        <input type="text" 
                               name="address_line2" 
                               class="form-control @error('address_line2') is-invalid @enderror" 
                               value="{{ old('address_line2', $user->address_line2) }}">
                        @error('address_line2')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Zip Code <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="zip_code" 
                               class="form-control @error('zip_code') is-invalid @enderror" 
                               value="{{ old('zip_code', $user->zip_code) }}" 
                               required
                               pattern="[0-9]{4,10}"
                               title="Please enter a valid zip code (4-10 digits)"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        @error('zip_code')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <small style="color: var(--text-light);">Numbers only, 4-10 digits</small>
                    </div>
                </div>

                <!-- Section 3: Additional Information -->
                <div class="form-section" id="section3">
                    <h3 class="section-title">Additional Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Delivery Time</label>
                            <input type="text" 
                                   name="delivery_time" 
                                   class="form-control @error('delivery_time') is-invalid @enderror" 
                                   value="{{ old('delivery_time', $user->delivery_time) }}" 
                                   placeholder="e.g., 1-3 days">
                            @error('delivery_time')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Minimum Order (ETB)</label>
                            <input type="number" 
                                   name="min_order" 
                                   class="form-control @error('min_order') is-invalid @enderror" 
                                   value="{{ old('min_order', $user->min_order) }}" 
                                   min="0"
                                   step="10">
                            @error('min_order')
                                <div class="invalid-feedback">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small style="color: var(--text-light);">Numbers only, minimum 0</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Description <span class="required-star">*</span>
                        </label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="5" 
                                  required
                                  minlength="20"
                                  maxlength="500">{{ old('description', $user->description) }}</textarea>
                        <small style="color: var(--text-light);">Min 20 characters, Max 500 characters</small>
                        @error('description')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <h4 style="margin: 20px 0 10px;">Social Media Links</h4>
                    
                    <div class="social-links">
                        <div class="form-group">
                            <div class="social-input">
                                <div class="social-icon"><i class="ri-facebook-fill"></i></div>
                                <input type="url" 
                                       name="facebook_url" 
                                       class="form-control @error('facebook_url') is-invalid @enderror" 
                                       value="{{ old('facebook_url', $user->facebook_url) }}" 
                                       placeholder="https://facebook.com/yourpage">
                            </div>
                            @error('facebook_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="social-input">
                                <div class="social-icon"><i class="ri-instagram-fill"></i></div>
                                <input type="url" 
                                       name="instagram_url" 
                                       class="form-control @error('instagram_url') is-invalid @enderror" 
                                       value="{{ old('instagram_url', $user->instagram_url) }}" 
                                       placeholder="https://instagram.com/yourpage">
                            </div>
                            @error('instagram_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="social-input">
                                <div class="social-icon"><i class="ri-telegram-fill"></i></div>
                                <input type="url" 
                                       name="telegram_url" 
                                       class="form-control @error('telegram_url') is-invalid @enderror" 
                                       value="{{ old('telegram_url', $user->telegram_url) }}" 
                                       placeholder="https://t.me/yourusername">
                            </div>
                            @error('telegram_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="social-input">
                                <div class="social-icon"><i class="ri-twitter-fill"></i></div>
                                <input type="url" 
                                       name="twitter_url" 
                                       class="form-control @error('twitter_url') is-invalid @enderror" 
                                       value="{{ old('twitter_url', $user->twitter_url) }}" 
                                       placeholder="https://twitter.com/yourpage">
                            </div>
                            @error('twitter_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 4: Media -->
                <div class="form-section" id="section4">
                    <h3 class="section-title">Business Logo & Images</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Business Logo/Avatar</label>
                        <input type="file" 
                               name="avatar" 
                               class="form-control @error('avatar') is-invalid @enderror" 
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               id="avatarInput">
                        <small style="color: var(--text-light);">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        @error('avatar')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        @if($user->avatar)
                            <div class="image-preview" id="currentAvatar">
                                <div class="current-image">
                                    <img src="{{ $user->avatar_url }}" alt="Current avatar">
                                </div>
                                <div class="image-actions">
                                    <button type="button" class="btn btn-sm btn-outline" onclick="document.getElementById('remove_avatar').checked = true; document.getElementById('currentAvatar').style.display = 'none';">
                                        <i class="ri-delete-bin-line"></i> Remove
                                    </button>
                                    <input type="checkbox" name="remove_avatar" id="remove_avatar" value="1" style="display: none;">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Main Banner Image</label>
                        <input type="file" 
                               name="main_image" 
                               class="form-control @error('main_image') is-invalid @enderror" 
                               accept="image/jpeg,image/png,image/jpg"
                               id="mainImageInput">
                        <small style="color: var(--text-light);">Recommended size: 1200x400px (Max: 5MB)</small>
                        @error('main_image')
                            <div class="invalid-feedback">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        @if($user->main_image)
                            <div class="image-preview" id="currentMainImage">
                                <div class="current-image" style="width: 200px;">
                                    @php
                                        $bannerPreview = filter_var($user->main_image, FILTER_VALIDATE_URL)
                                            ? $user->main_image
                                            : (Storage::disk('public')->exists(ltrim($user->main_image, '/'))
                                                ? Storage::url(ltrim($user->main_image, '/'))
                                                : null);
                                    @endphp
                                    @if($bannerPreview)
                                        <img src="{{ $bannerPreview }}" alt="Main banner">
                                    @endif
                                </div>
                                </div>
                                <div class="image-actions">
                                    <button type="button" class="btn btn-sm btn-outline" onclick="document.getElementById('remove_main_image').checked = true; document.getElementById('currentMainImage').style.display = 'none';">
                                        <i class="ri-delete-bin-line"></i> Remove
                                    </button>
                                    <input type="checkbox" name="remove_main_image" id="remove_main_image" value="1" style="display: none;">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-outline" id="prevBtn" onclick="changeSection(-1)" disabled>
                        <i class="ri-arrow-left-line"></i> Previous
                    </button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeSection(1)">
                        Next <i class="ri-arrow-right-line"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                        <i class="ri-save-line"></i> Save All Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Theme Toggle
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'ri-sun-line';
            document.querySelector('#themeToggle span').textContent = 'Light';
        }

        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            const text = this.querySelector('span');
            
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'ri-sun-line';
                text.textContent = 'Light';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'ri-moon-line';
                text.textContent = 'Theme';
                localStorage.setItem('theme', 'light');
            }
        });

        // Toast notification system
        function showToast(title, message, type = 'success', duration = 5000) {
            const toastContainer = document.getElementById('toastContainer');
            
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            let iconHtml = '<i class="ri-checkbox-circle-line"></i>';
            if (type === 'error') iconHtml = '<i class="ri-error-warning-line"></i>';
            else if (type === 'warning') iconHtml = '<i class="ri-alert-line"></i>';
            
            toast.innerHTML = `
                <div class="toast-icon">${iconHtml}</div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <div class="toast-close" onclick="this.parentElement.remove()">
                    <i class="ri-close-line"></i>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            
            // Auto remove after duration
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'slideInRight 0.3s reverse';
                    setTimeout(() => toast.remove(), 300);
                }
            }, duration);
        }

        // Multi-step form
        let currentSection = 1;
        const totalSections = 4;

        function changeSection(direction) {
            // Validate current section before moving forward
            if (direction > 0 && !validateSection(currentSection)) {
                showToast('Validation Error', 'Please fill in all required fields correctly', 'error');
                return;
            }

            const newSection = currentSection + direction;
            
            if (newSection >= 1 && newSection <= totalSections) {
                // Hide current section
                document.getElementById(`section${currentSection}`).classList.remove('active');
                
                // Show new section
                document.getElementById(`section${newSection}`).classList.add('active');
                
                // Update progress indicators
                updateProgress(newSection);
                
                // Update buttons
                updateButtons(newSection);
                
                currentSection = newSection;
            }
        }

        function validateSection(section) {
            const sectionElement = document.getElementById(`section${section}`);
            const requiredFields = sectionElement.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Additional validation for specific fields
            if (section === 1) {
                const email = document.querySelector('input[name="email"]');
                const phone = document.querySelector('input[name="phone"]');
                
                // Email validation
                if (email && email.value && !email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                    email.classList.add('is-invalid');
                    isValid = false;
                }
                
                // Phone validation (if provided)
                if (phone && phone.value && !phone.value.match(/^\+?[0-9\s\-\(\)]{10,20}$/)) {
                    phone.classList.add('is-invalid');
                    isValid = false;
                }
            }

            if (section === 2) {
                const zipCode = document.querySelector('input[name="zip_code"]');
                if (zipCode && zipCode.value && !zipCode.value.match(/^[0-9]{4,10}$/)) {
                    zipCode.classList.add('is-invalid');
                    isValid = false;
                }
            }

            return isValid;
        }

        function updateProgress(newSection) {
            // Update step numbers
            for (let i = 1; i <= totalSections; i++) {
                const indicator = document.getElementById(`step${i}Indicator`);
                const label = document.getElementById(`step${i}Label`);
                
                if (i < newSection) {
                    indicator.className = 'step-number completed';
                    label.className = 'step-label completed';
                } else if (i === newSection) {
                    indicator.className = 'step-number active';
                    label.className = 'step-label active';
                } else {
                    indicator.className = 'step-number';
                    label.className = 'step-label';
                }
            }
        }

        function updateButtons(section) {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            
            // Update previous button
            prevBtn.disabled = section === 1;
            
            // Update next/submit buttons
            if (section === totalSections) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }
        }

        // Form submission with loading state
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            // Validate all sections before final submit
            let isValid = true;
            let firstInvalidSection = null;
            
            for (let i = 1; i <= totalSections; i++) {
                if (!validateSection(i)) {
                    isValid = false;
                    if (firstInvalidSection === null) {
                        firstInvalidSection = i;
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();
                
                // Switch to the first invalid section
                if (firstInvalidSection !== null && firstInvalidSection !== currentSection) {
                    // Hide current section
                    document.getElementById(`section${currentSection}`).classList.remove('active');
                    
                    // Show invalid section
                    document.getElementById(`section${firstInvalidSection}`).classList.add('active');
                    
                    // Update progress
                    updateProgress(firstInvalidSection);
                    
                    // Update buttons
                    updateButtons(firstInvalidSection);
                    
                    currentSection = firstInvalidSection;
                }
                
                showToast('Validation Error', 'Please fix all errors before submitting', 'error');
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="loading-spinner"></span> Saving...';
            submitBtn.disabled = true;

            // Show saving toast
            showToast('Saving', 'Your changes are being saved...', 'info');

            // Allow form to submit normally
            // The page will reload after submission
        });

        // Real-time validation with debounce
        let validationTimeout;
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(validationTimeout);
                validationTimeout = setTimeout(() => {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else if (this.name === 'email' && this.value && !this.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                        this.classList.add('is-invalid');
                    } else if (this.name === 'phone' && this.value && !this.value.match(/^\+?[0-9\s\-\(\)]{10,20}$/)) {
                        this.classList.add('is-invalid');
                    } else if (this.name === 'zip_code' && this.value && !this.value.match(/^[0-9]{4,10}$/)) {
                        this.classList.add('is-invalid');
                    } else if (this.name === 'min_order' && this.value && isNaN(this.value)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                }, 300);
            });
        });

        // File input validation
        document.getElementById('avatarInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                
                if (!allowedTypes.includes(file.type)) {
                    showToast('Error', 'Please select a valid image file (JPEG, PNG, JPG, GIF)', 'error');
                    this.value = '';
                } else if (file.size > maxSize) {
                    showToast('Error', 'File size must be less than 2MB', 'error');
                    this.value = '';
                } else {
                    showToast('Success', 'File uploaded successfully', 'success');
                }
            }
        });

        document.getElementById('mainImageInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                
                if (!allowedTypes.includes(file.type)) {
                    showToast('Error', 'Please select a valid image file (JPEG, PNG, JPG)', 'error');
                    this.value = '';
                } else if (file.size > maxSize) {
                    showToast('Error', 'File size must be less than 5MB', 'error');
                    this.value = '';
                } else {
                    showToast('Success', 'File uploaded successfully', 'success');
                }
            }
        });

        // Auto-dismiss alerts
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