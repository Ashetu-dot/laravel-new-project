<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Customer - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        :root {
            --primary-bg: #f3f4f6;
            --sidebar-bg: #1f2937;
            --sidebar-text: #9ca3af;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #374151;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-blue: #3b82f6;
            --accent-yellow: #f59e0b;
            --accent-purple: #8b5cf6;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        .brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 24px;
            font-weight: 700;
            border-bottom: 1px solid #374151;
            letter-spacing: -0.5px;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 28px;
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

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .nav-label {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            font-size: 15px;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-active);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid #374151;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        /* Logout Button */
        .logout-btn {
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
            margin-top: 8px;
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        .top-header {
            height: 70px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .top-header {
                padding: 0 20px;
            }
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: background 0.2s;
            position: relative;
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 16px;
            }
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header h1 i {
            color: var(--primary-gold);
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
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
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--accent-green);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--accent-red);
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--accent-yellow);
        }

        /* Form Container */
        .form-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow-sm);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-label i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: inherit;
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--accent-red);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            padding: 12px 16px;
            background-color: #f3f4f6;
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-text {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
        }

        /* Radio & Checkbox */
        .radio-group {
            display: flex;
            gap: 24px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            margin-bottom: 12px;
        }

        .checkbox-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: var(--primary-gold-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .btn-danger {
            background-color: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
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

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.9);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(184, 142, 63, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        .loading-text {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    @include('partials.admin-sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-user-line" style="color: var(--primary-gold);"></i> Edit Customer
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.customers') }}" class="btn btn-secondary btn-sm">
                    <i class="ri-arrow-left-line"></i> Back
                </a>
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-user-line"></i>
                        Edit Customer: {{ $customer->name }}
                    </h1>
                    <p>Update customer information and account settings</p>
                </div>
                <div>
                    <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-secondary">
                        <i class="ri-eye-line"></i> View Details
                    </a>
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
                    <ul style="margin-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Customer Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}" id="customerForm">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-user-line"></i> Full Name
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') error @enderror"
                                   value="{{ old('name', $customer->name) }}"
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="ri-mail-line"></i> Email Address
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') error @enderror"
                                   value="{{ old('email', $customer->email) }}"
                                   required>
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <i class="ri-phone-line"></i> Phone Number
                            </label>
                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   class="form-control @error('phone') error @enderror"
                                   value="{{ old('phone', $customer->phone) }}"
                                   placeholder="+251 XXX XXX XXX">
                            @error('phone')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="form-group">
                            <label for="city" class="form-label">
                                <i class="ri-map-pin-line"></i> City
                            </label>
                            <input type="text"
                                   id="city"
                                   name="city"
                                   class="form-control @error('city') error @enderror"
                                   value="{{ old('city', $customer->city ?? '') }}"
                                   placeholder="e.g., Addis Ababa">
                            @error('city')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- State/Region -->
                        <div class="form-group">
                            <label for="state" class="form-label">
                                <i class="ri-map-pin-line"></i> State/Region
                            </label>
                            <input type="text"
                                   id="state"
                                   name="state"
                                   class="form-control @error('state') error @enderror"
                                   value="{{ old('state', $customer->state ?? '') }}"
                                   placeholder="e.g., Oromia">
                            @error('state')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="form-group">
                            <label for="country" class="form-label">
                                <i class="ri-earth-line"></i> Country
                            </label>
                            <input type="text"
                                   id="country"
                                   name="country"
                                   class="form-control @error('country') error @enderror"
                                   value="{{ old('country', $customer->country ?? 'Ethiopia') }}">
                            @error('country')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Account Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-toggle-line"></i> Account Status
                            </label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', $customer->is_active) ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active', $customer->is_active) ? '' : 'checked' }}>
                                    <span>Inactive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Email Verification -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-mail-check-line"></i> Email Verification
                            </label>
                            <div class="checkbox-option">
                                <input type="checkbox"
                                       name="mark_email_verified"
                                       id="mark_email_verified"
                                       value="1"
                                       {{ $customer->email_verified_at ? 'checked disabled' : '' }}>
                                <label for="mark_email_verified">
                                    @if($customer->email_verified_at)
                                        Verified on {{ $customer->email_verified_at->format('M d, Y') }}
                                    @else
                                        Mark as verified
                                    @endif
                                </label>
                            </div>
                        </div>

                        <!-- Password Reset (Optional) -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="ri-lock-line"></i> Password Reset (Optional)
                            </label>
                            <div class="checkbox-option">
                                <input type="checkbox"
                                       name="send_password_reset"
                                       id="send_password_reset"
                                       value="1">
                                <label for="send_password_reset">Send password reset email to customer</label>
                            </div>
                            <small class="form-text">Check this to send a password reset link to the customer's email</small>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-save-line"></i> Update Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Updating customer...</div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('active');
                        }
                    }
                });
            }

            // Email verification checkbox handling
            const emailVerifiedCheckbox = document.getElementById('mark_email_verified');
            if (emailVerifiedCheckbox && emailVerifiedCheckbox.disabled) {
                // Already verified, keep disabled
            }
        });

        // Form validation
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            if (!name) {
                alert('Please enter customer name');
                return false;
            }

            const email = document.getElementById('email').value.trim();
            if (!email) {
                alert('Please enter email address');
                return false;
            }

            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            return true;
        }

        // Form submission with loading state
        document.getElementById('customerForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            if (!validateForm()) {
                e.preventDefault();
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span> Updating...';
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

      

        // Auto-hide alerts after 5 seconds
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
