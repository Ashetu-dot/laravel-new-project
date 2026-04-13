<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>My Profile - {{ $user->business_name ?? $user->name }} | Vendora</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --radius-lg: 16px;
            --transition: all 0.3s ease;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
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
            --info: #60A5FA;
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
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
            transition: background-color 0.3s;
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

        .logo i {
            font-size: 28px;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            font-size: 15px;
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
            transition: var(--transition);
        }

        .theme-toggle:hover {
            border-color: var(--primary-gold);
            background: var(--white);
        }

        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Ethiopian Badge */
        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Main Content */
        .main-content {
            padding: 40px 0;
        }

        /* Toast Container */
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

        .toast.info {
            border-left-color: var(--info);
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

        .toast.info .toast-icon {
            color: var(--info);
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

        /* Profile Card */
        .profile-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            transition: background-color 0.3s;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .profile-avatar-wrapper {
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 700;
            text-transform: uppercase;
            border: 4px solid var(--white);
            box-shadow: var(--shadow);
        }

        .profile-avatar-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--white);
            box-shadow: var(--shadow);
        }

        .profile-title {
            flex: 1;
        }

        .profile-title h1 {
            font-size: 32px;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .profile-title p {
            color: var(--text-light);
            font-size: 16px;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: #ecfdf5;
            color: var(--success);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: #fef3e7;
            color: var(--primary-gold);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .stat-card {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .info-item {
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: var(--transition);
        }

        .info-item:hover {
            border-color: var(--primary-gold);
            box-shadow: var(--shadow);
        }

        .info-label {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-weight: 600;
            word-break: break-word;
        }

        .info-value a {
            color: var(--primary-gold);
            text-decoration: none;
        }

        .info-value a:hover {
            text-decoration: underline;
        }

        /* Description */
        .description-box {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .description-box h3 {
            margin-bottom: 10px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-gold);
        }

        .description-box p {
            color: var(--text-light);
            line-height: 1.6;
            white-space: pre-line;
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
            font-size: 20px;
        }

        .social-link:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: var(--radius-lg);
            max-width: 500px;
            width: 100%;
            padding: 30px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 24px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--error);
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar {
                padding: 16px 30px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
                flex-wrap: wrap;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                gap: 16px;
                z-index: 99;
                border-top: 1px solid var(--border-color);
            }

            .nav-links.active {
                display: flex;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: 40px;
            }

            .profile-title h1 {
                font-size: 28px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .profile-card {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 12px 16px;
            }

            .logo {
                font-size: 20px;
            }

            .logo i {
                font-size: 24px;
            }

            .profile-title h1 {
                font-size: 24px;
            }

            .stat-value {
                font-size: 24px;
            }

            .info-item {
                padding: 12px;
            }

            .modal-content {
                padding: 20px;
            }
        }

        /* Print Styles */
        @media print {
            .navbar, .actions, .social-links, .theme-toggle {
                display: none !important;
            }

            .profile-card {
                box-shadow: none;
                border: 1px solid #000;
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
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            
        </a>

        <div class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="ri-menu-line"></i>
        </div>

        <div class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
            <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('vendor.products.index') }}" class="nav-link">Products</a>
            <a href="{{ route('vendor.settings') }}" class="nav-link">Settings</a>
            <button class="theme-toggle" id="themeToggle">
                <i class="ri-moon-line"></i>
                <span>Theme</span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar-wrapper">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->business_name ?? $user->name }}" class="profile-avatar-img">
                        @else
                            <div class="profile-avatar">
                                {{ strtoupper(substr($user->business_name ?? $user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <div class="profile-title">
                        <h1>{{ $user->business_name ?? $user->name }}</h1>
                        <p>{{ $user->email }}</p>
                        <div style="margin-top: 8px;">
                            @if($user->email_verified_at)
                                <span class="verified-badge">
                                    <i class="ri-verified-badge-fill"></i> Verified Vendor
                                </span>
                            @endif
                            @if($user->city)
                                <span class="location-badge">
                                    <i class="ri-map-pin-line"></i> {{ $user->city }}, {{ $user->state ?? 'Ethiopia' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($followersCount) }}</div>
                        <div class="stat-label">Followers</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($followingCount) }}</div>
                        <div class="stat-label">Following</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($productsCount) }}</div>
                        <div class="stat-label">Products</div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    @if($user->phone)
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $user->phone }}</div>
                    </div>
                    @endif

                    @if($user->category)
                    <div class="info-item">
                        <div class="info-label">Category</div>
                        <div class="info-value">{{ ucfirst($user->category) }}</div>
                    </div>
                    @endif

                    @if($user->website)
                    <div class="info-item">
                        <div class="info-label">Website</div>
                        <div class="info-value">
                            <a href="{{ $user->website }}" target="_blank" rel="noopener">
                                {{ preg_replace('#^https?://#', '', $user->website) }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($user->address_line1)
                    <div class="info-item">
                        <div class="info-label">Address</div>
                        <div class="info-value">
                            {{ $user->address_line1 }}
                            @if($user->address_line2)
                                <br>{{ $user->address_line2 }}
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="info-item">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">{{ $user->created_at->format('F Y') }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $user->updated_at->format('M d, Y') }}</div>
                    </div>

                    @if($user->delivery_time)
                    <div class="info-item">
                        <div class="info-label">Delivery Time</div>
                        <div class="info-value">{{ $user->delivery_time }}</div>
                    </div>
                    @endif

                    @if($user->min_order)
                    <div class="info-item">
                        <div class="info-label">Minimum Order</div>
                        <div class="info-value">{{ number_format($user->min_order) }} ETB</div>
                    </div>
                    @endif

                    @if($user->rating)
                    <div class="info-item">
                        <div class="info-label">Rating</div>
                        <div class="info-value">
                            <span style="color: var(--primary-gold);">
                                {{ number_format($user->rating, 1) }}
                                <i class="ri-star-fill" style="font-size: 14px;"></i>
                            </span>
                            ({{ $user->total_reviews ?? 0 }} reviews)
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description -->
                @if($user->description)
                <div class="description-box">
                    <h3><i class="ri-information-line"></i> About</h3>
                    <p>{{ $user->description }}</p>
                </div>
                @endif

                <!-- Social Links -->
                @if($user->facebook_url || $user->instagram_url || $user->telegram_url || $user->twitter_url)
                <div class="social-links">
                    @if($user->facebook_url)
                    <a href="{{ $user->facebook_url }}" class="social-link" target="_blank" title="Facebook">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    @endif
                    @if($user->instagram_url)
                    <a href="{{ $user->instagram_url }}" class="social-link" target="_blank" title="Instagram">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    @endif
                    @if($user->telegram_url)
                    <a href="{{ $user->telegram_url }}" class="social-link" target="_blank" title="Telegram">
                        <i class="ri-telegram-fill"></i>
                    </a>
                    @endif
                    @if($user->twitter_url)
                    <a href="{{ $user->twitter_url }}" class="social-link" target="_blank" title="Twitter">
                        <i class="ri-twitter-fill"></i>
                    </a>
                    @endif
                </div>
                @endif

                <!-- Actions -->
                <div class="actions">
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline">
                        <i class="ri-edit-line"></i> Edit Profile
                    </a>
                    <a href="{{ route('vendor.settings') }}" class="btn btn-outline">
                        <i class="ri-settings-line"></i> Settings
                    </a>
                    <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    @if(Auth::id() === $user->id)
                    <button class="btn btn-outline" onclick="showShareModal()">
                        <i class="ri-share-line"></i> Share
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Share Modal -->
    <div class="modal" id="shareModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Share Profile</h3>
                <button class="modal-close" onclick="closeShareModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 15px;">Share your vendor profile with others:</p>
                <div style="display: flex; gap: 15px; justify-content: center; margin-bottom: 20px;">
                    <button class="social-link" onclick="shareOn('facebook')" style="width: 50px; height: 50px; font-size: 24px;">
                        <i class="ri-facebook-fill"></i>
                    </button>
                    <button class="social-link" onclick="shareOn('twitter')" style="width: 50px; height: 50px; font-size: 24px;">
                        <i class="ri-twitter-fill"></i>
                    </button>
                    <button class="social-link" onclick="shareOn('whatsapp')" style="width: 50px; height: 50px; font-size: 24px;">
                        <i class="ri-whatsapp-fill"></i>
                    </button>
                    <button class="social-link" onclick="shareOn('telegram')" style="width: 50px; height: 50px; font-size: 24px;">
                        <i class="ri-telegram-fill"></i>
                    </button>
                </div>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="profileShareLink" class="form-control" value="{{ route('vendor.show', $user->id) }}" readonly style="flex: 1; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--light-gray);">
                    <button class="btn btn-primary" onclick="copyProfileLink()">Copy</button>
                </div>
            </div>
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

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Toast notification system
        function showToast(title, message, type = 'success', duration = 5000) {
            const toastContainer = document.getElementById('toastContainer');

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            let iconHtml = '<i class="ri-checkbox-circle-line"></i>';
            if (type === 'error') iconHtml = '<i class="ri-error-warning-line"></i>';
            else if (type === 'warning') iconHtml = '<i class="ri-alert-line"></i>';
            else if (type === 'info') iconHtml = '<i class="ri-information-line"></i>';

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

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'slideInRight 0.3s reverse';
                    setTimeout(() => toast.remove(), 300);
                }
            }, duration);
        }

        // Share Modal
        function showShareModal() {
            document.getElementById('shareModal').classList.add('active');
        }

        function closeShareModal() {
            document.getElementById('shareModal').classList.remove('active');
        }

        // Share on Social Media
        function shareOn(platform) {
            const url = '{{ route('vendor.show', $user->id) }}';
            const text = 'Check out {{ $user->business_name ?? $user->name }} on Vendora!';

            let shareUrl = '';
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank');
            }
        }

        // Copy Profile Link
        function copyProfileLink() {
            const input = document.getElementById('profileShareLink');
            input.select();
            document.execCommand('copy');

            showToast('Success', 'Link copied to clipboard!', 'success');

            setTimeout(() => {
                closeShareModal();
            }, 1500);
        }

        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeShareModal();
            }
        });

        // Close modal on background click
        document.getElementById('shareModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeShareModal();
            }
        });

        // Auto-refresh stats (optional)
        setInterval(() => {
            // You can implement AJAX to refresh stats here
        }, 30000);
    </script>
</body>
</html>
