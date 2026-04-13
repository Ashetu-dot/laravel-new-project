{{-- resources/views/customer/notifications.blade.php --}}
<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notifications - Customer Dashboard | Vendora</title>
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
            --text-gray: #666666;
            --border-color: #E5E7EB;
            --white: #FFFFFF;
            --light-gray: #F9FAFB;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 24px rgba(0,0,0,0.12);
            --radius-sm: 8px;
            --radius-lg: 12px;
            --transition: all 0.3s ease;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #E5E7EB;
            --text-gray: #9CA3AF;
            --border-color: #374151;
            --white: #1F2937;
            --light-gray: #111827;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
            --shadow-hover: 0 8px 24px rgba(0,0,0,0.4);
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
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo i {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
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

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-dark);
            padding: 5px 10px;
            border-radius: 30px;
            transition: background 0.2s;
        }

        .user-menu:hover {
            background: var(--light-gray);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-gold);
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--error);
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
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
            color: var(--text-dark);
        }

        .theme-toggle:hover {
            border-color: var(--primary-gold);
        }

        /* Page Header */
        .page-header {
            margin: 40px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
        }

        .page-header h1 span {
            color: var(--primary-gold);
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
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
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Filters */
        .filters {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
            box-shadow: var(--shadow-sm);
        }

        .filter-select {
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            min-width: 150px;
            font-size: 14px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        .search-box {
            flex: 1;
            position: relative;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(184, 142, 63, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 24px;
        }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .stat-info p {
            font-size: 14px;
            color: var(--text-gray);
        }

        /* Notifications Container */
        .notifications-container {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            margin-bottom: 40px;
        }

        .notifications-header {
            display: grid;
            grid-template-columns: 1fr 150px 100px;
            padding: 15px 20px;
            background: var(--light-gray);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            color: var(--text-dark);
        }

        .notifications-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .notification-item {
            display: grid;
            grid-template-columns: 1fr 150px 100px;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            transition: background 0.2s;
            cursor: pointer;
            position: relative;
        }

        .notification-item:hover {
            background: var(--light-gray);
        }

        .notification-item.unread {
            background: rgba(184, 142, 63, 0.05);
            border-left: 3px solid var(--primary-gold);
        }

        .notification-content {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(184, 142, 63, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 24px;
            flex-shrink: 0;
        }

        .notification-details {
            flex: 1;
        }

        .notification-details h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .notification-details p {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .notification-meta {
            display: flex;
            gap: 20px;
            font-size: 12px;
            color: var(--text-gray);
            flex-wrap: wrap;
        }

        .notification-meta i {
            margin-right: 3px;
            color: var(--primary-gold);
        }

        .notification-type {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 20px;
            background: var(--light-gray);
            font-size: 11px;
            font-weight: 600;
        }

        .notification-time {
            font-size: 13px;
            color: var(--text-gray);
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .action-btn:hover {
            background: var(--light-gray);
            color: var(--primary-gold);
        }

        .action-btn.delete:hover {
            color: var(--error);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state i {
            font-size: 80px;
            color: var(--primary-gold);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .empty-state p {
            color: var(--text-gray);
            margin-bottom: 30px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0 40px;
        }

        .page-link {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }

        .page-link:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .page-link.active {
            background: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
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
            border-radius: 16px;
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
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-header h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--text-gray);
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--error);
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .notification-detail {
            padding: 12px 0;
            border-bottom: 1px dashed var(--border-color);
        }

        .notification-detail:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .detail-data {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 14px;
            max-height: 200px;
            overflow-y: auto;
            font-family: monospace;
        }

        .modal-footer {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: 8px;
            box-shadow: var(--shadow-hover);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 3000;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
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
            font-size: 13px;
            color: var(--text-gray);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-gray);
            font-size: 18px;
        }

        /* Footer */
        footer {
            background: var(--white);
            padding: 40px 0;
            margin-top: auto;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-gray);
            font-size: 14px;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-color);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                height: auto;
                padding: 20px 0;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-select {
                width: 100%;
            }

            .notifications-header {
                display: none;
            }

            .notification-item {
                grid-template-columns: 1fr;
                gap: 15px;
                position: relative;
            }

            .notification-actions {
                position: absolute;
                top: 15px;
                right: 15px;
            }

            .notification-time {
                position: absolute;
                top: 15px;
                left: 80px;
            }

            .notification-content {
                margin-top: 30px;
            }
        }

        @media (max-width: 480px) {
            .header-actions {
                flex-direction: column;
                width: 100%;
            }

            .header-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
                <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('customer.orders') }}" class="nav-link">My Orders</a>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-link">Wishlist</a>

                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle">
                    <i class="ri-moon-line"></i>
                    <span>Theme</span>
                </button>

                <!-- User Menu -->
                <a href="{{ route('profile.show', Auth::id()) }}" class="user-menu">
                    @php
                        $avatarUrl = Auth::user()->avatar
                            ? Storage::url(Auth::user()->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=B88E3F&color=fff&size=200';
                    @endphp
                    <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1><span>My</span> Notifications</h1>
                <p>Stay updated with your activity on Vendora</p>
            </div>
            <div class="header-actions">
                @if($unreadCount > 0)
                <button class="btn btn-primary" onclick="markAllAsRead()">
                    <i class="ri-check-double-line"></i> Mark All Read
                </button>
                @endif
                <button class="btn btn-danger" onclick="clearAllNotifications()">
                    <i class="ri-delete-bin-line"></i> Clear All
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="ri-notification-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalCount }}</h3>
                    <p>Total Notifications</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="ri-mail-unread-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $unreadCount }}</h3>
                    <p>Unread</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="ri-mail-open-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $readCount }}</h3>
                    <p>Read</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="ri-price-tag-3-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ count($typeCounts) }}</h3>
                    <p>Categories</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <select class="filter-select" id="typeFilter" onchange="applyFilters()">
                <option value="">All Types</option>
                <option value="order" {{ request('type') == 'order' ? 'selected' : '' }}>Orders</option>
                <option value="message" {{ request('type') == 'message' ? 'selected' : '' }}>Messages</option>
                <option value="follow" {{ request('type') == 'follow' ? 'selected' : '' }}>Follows</option>
                <option value="review" {{ request('type') == 'review' ? 'selected' : '' }}>Reviews</option>
                <option value="system" {{ request('type') == 'system' ? 'selected' : '' }}>System</option>
                <option value="promotion" {{ request('type') == 'promotion' ? 'selected' : '' }}>Promotions</option>
                <option value="success" {{ request('type') == 'success' ? 'selected' : '' }}>Success</option>
                <option value="warning" {{ request('type') == 'warning' ? 'selected' : '' }}>Warnings</option>
            </select>

            <select class="filter-select" id="statusFilter" onchange="applyFilters()">
                <option value="">All Status</option>
                <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Read</option>
            </select>

            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search notifications..." value="{{ request('search') }}">
                <i class="ri-search-line"></i>
            </div>
        </div>

        <!-- Notifications Container -->
        <div class="notifications-container">
            <div class="notifications-header">
                <div>Notification</div>
                <div>Time</div>
                <div>Actions</div>
            </div>

            <div class="notifications-list" id="notificationsList">
                @forelse($notifications as $notification)
                <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}" data-id="{{ $notification->id }}" onclick="viewNotification({{ $notification->id }})">
                    <div class="notification-content">
                        <div class="notification-icon">
                            @php
                                $icon = 'ri-notification-line';
                                $color = 'var(--primary-gold)';

                                switch($notification->type) {
                                    case 'order':
                                        $icon = 'ri-shopping-bag-line';
                                        break;
                                    case 'message':
                                        $icon = 'ri-message-3-line';
                                        break;
                                    case 'follow':
                                        $icon = 'ri-user-follow-line';
                                        break;
                                    case 'review':
                                        $icon = 'ri-star-line';
                                        break;
                                    case 'success':
                                        $icon = 'ri-checkbox-circle-line';
                                        $color = 'var(--success)';
                                        break;
                                    case 'warning':
                                        $icon = 'ri-alert-line';
                                        $color = 'var(--warning)';
                                        break;
                                    case 'error':
                                        $icon = 'ri-error-warning-line';
                                        $color = 'var(--error)';
                                        break;
                                    case 'promotion':
                                        $icon = 'ri-discount-percent-line';
                                        break;
                                    case 'system':
                                        $icon = 'ri-information-line';
                                        $color = 'var(--info)';
                                        break;
                                }
                            @endphp
                            <i class="{{ $icon }}" style="color: {{ $color }}"></i>
                        </div>
                        <div class="notification-details">
                            <h4>{{ $notification->title }}</h4>
                            <p>{{ Str::limit($notification->message, 100) }}</p>
                            <div class="notification-meta">
                                <span class="notification-type">
                                    <i class="{{ $icon }}"></i>
                                    {{ ucfirst($notification->type) }}
                                </span>
                                @if($notification->data && is_array($notification->data))
                                    @foreach($notification->data as $key => $value)
                                        @if(in_array($key, ['order_id', 'vendor_id', 'product_id']))
                                        <span>
                                            <i class="ri-price-tag-3-line"></i>
                                            {{ ucfirst(str_replace('_', ' ', $key)) }}: #{{ $value }}
                                        </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="notification-time" title="{{ $notification->created_at->format('F j, Y g:i A') }}">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                    <div class="notification-actions" onclick="event.stopPropagation()">
                        @if(!$notification->is_read)
                        <button class="action-btn" onclick="markAsRead({{ $notification->id }})" title="Mark as read">
                            <i class="ri-check-line"></i>
                        </button>
                        @endif
                        <button class="action-btn delete" onclick="deleteNotification({{ $notification->id }})" title="Delete">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="ri-notification-line"></i>
                    <h3>No notifications yet</h3>
                    <p>When you receive notifications about orders, messages, and updates, they'll appear here.</p>
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-primary">
                        <i class="ri-dashboard-line"></i> Go to Dashboard
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
            <div class="pagination">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Notification Detail Modal -->
    <div class="modal" id="notificationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Notification Details</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="notificationDetail">
                <div class="loading-spinner" style="margin: 20px auto;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal()">Close</button>
                <button class="btn btn-primary" id="modalMarkRead" onclick="markCurrentAsRead()">Mark as Read</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Operation completed successfully</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize theme
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'ri-sun-line';
            document.querySelector('#themeToggle span').textContent = 'Light';
        }

        // Theme Toggle
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

        // Toast notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');

            toast.className = 'toast ' + type;

            let iconHtml = '<i class="ri-checkbox-circle-line"></i>';
            if (type === 'error') iconHtml = '<i class="ri-error-warning-line"></i>';
            else if (type === 'warning') iconHtml = '<i class="ri-alert-line"></i>';
            else if (type === 'info') iconHtml = '<i class="ri-information-line"></i>';

            toastIcon.innerHTML = iconHtml;
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Apply filters
        function applyFilters() {
            const type = document.getElementById('typeFilter').value;
            const status = document.getElementById('statusFilter').value;
            const search = document.getElementById('searchInput').value;

            let url = new URL(window.location.href);

            if (type) url.searchParams.set('type', type);
            else url.searchParams.delete('type');

            if (status) url.searchParams.set('filter', status);
            else url.searchParams.delete('filter');

            if (search) url.searchParams.set('search', search);
            else url.searchParams.delete('search');

            window.location.href = url.toString();
        }

        // Debounced search
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 500);
        });

        // Mark as read
        function markAsRead(id) {
            fetch(`/customer/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.querySelector(`.notification-item[data-id="${id}"]`);
                    if (item) {
                        item.classList.remove('unread');
                        showToast('Success', 'Notification marked as read');

                        // Update unread count in UI
                        updateUnreadCount();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to mark as read', 'error');
            });
        }

        // Mark all as read
        function markAllAsRead() {
            fetch('/customer/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.classList.remove('unread');
                    });
                    showToast('Success', 'All notifications marked as read');

                    // Update unread count in UI
                    updateUnreadCount();

                    // Reload after short delay to update counts
                    setTimeout(() => location.reload(), 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to mark all as read', 'error');
            });
        }

        // Delete notification
        function deleteNotification(id) {
            if (!confirm('Are you sure you want to delete this notification?')) {
                return;
            }

            fetch(`/customer/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.querySelector(`.notification-item[data-id="${id}"]`);
                    if (item) {
                        item.remove();
                        showToast('Success', 'Notification deleted');

                        // Check if no notifications left
                        if (document.querySelectorAll('.notification-item').length === 0) {
                            location.reload();
                        } else {
                            updateUnreadCount();
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to delete notification', 'error');
            });
        }

        // Clear all notifications
        function clearAllNotifications() {
            if (!confirm('Are you sure you want to clear all notifications? This action cannot be undone.')) {
                return;
            }

            fetch('/customer/notifications/clear-all', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to clear notifications', 'error');
            });
        }

        // View notification details
        function viewNotification(id) {
            const modal = document.getElementById('notificationModal');
            const detailDiv = document.getElementById('notificationDetail');

            detailDiv.innerHTML = '<div style="text-align: center; padding: 40px;"><div class="loading-spinner" style="margin: 0 auto 20px;"></div><p>Loading...</p></div>';
            modal.classList.add('active');

            fetch(`/customer/notifications/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notification = data.data;
                        let dataHtml = '';

                        if (notification.data) {
                            const jsonData = typeof notification.data === 'string'
                                ? JSON.parse(notification.data)
                                : notification.data;
                            dataHtml = '<pre>' + JSON.stringify(jsonData, null, 2) + '</pre>';
                        }

                        detailDiv.innerHTML = `
                            <div class="notification-detail">
                                <div class="detail-label">Title</div>
                                <div class="detail-value">${notification.title}</div>
                            </div>
                            <div class="notification-detail">
                                <div class="detail-label">Message</div>
                                <div class="detail-value">${notification.message}</div>
                            </div>
                            <div class="notification-detail">
                                <div class="detail-label">Type</div>
                                <div class="detail-value">
                                    <span class="notification-type">
                                        <i class="ri-notification-line"></i>
                                        ${notification.type}
                                    </span>
                                </div>
                            </div>
                            <div class="notification-detail">
                                <div class="detail-label">Received</div>
                                <div class="detail-value">${new Date(notification.created_at).toLocaleString()}</div>
                            </div>
                            <div class="notification-detail">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span style="color: ${notification.is_read ? 'var(--success)' : 'var(--warning)'}">
                                        <i class="ri-${notification.is_read ? 'checkbox-circle' : 'time'}-line"></i>
                                        ${notification.is_read ? 'Read' : 'Unread'}
                                    </span>
                                </div>
                            </div>
                            ${notification.data ? `
                            <div class="notification-detail">
                                <div class="detail-label">Additional Data</div>
                                <div class="detail-data">${dataHtml}</div>
                            </div>
                            ` : ''}
                        `;

                        document.getElementById('modalMarkRead').onclick = () => markCurrentAsRead(notification.id);

                        // Hide mark as read button if already read
                        if (notification.is_read) {
                            document.getElementById('modalMarkRead').style.display = 'none';
                        } else {
                            document.getElementById('modalMarkRead').style.display = 'block';
                        }
                    } else {
                        throw new Error('Failed to load notification');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    detailDiv.innerHTML = `
                        <div style="text-align: center; padding: 40px;">
                            <i class="ri-error-warning-line" style="font-size: 48px; color: var(--error);"></i>
                            <p style="margin-top: 20px; color: var(--error);">Failed to load notification details</p>
                        </div>
                    `;
                });
        }

        function markCurrentAsRead(id) {
            if (id) {
                markAsRead(id);
            }
            closeModal();
        }

        function closeModal() {
            document.getElementById('notificationModal').classList.remove('active');
        }

        // Update unread count in header
        function updateUnreadCount() {
            fetch('/customer/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.querySelector('.nav-btn .badge-count');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.style.display = 'block';
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error updating unread count:', error));
        }

        // Update unread count every 30 seconds
        setInterval(updateUnreadCount, 30000);

        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on background click
        document.getElementById('notificationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);
    </script>
</body>
</html>
