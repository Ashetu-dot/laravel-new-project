{{-- resources/views/vendor/notifications.blade.php --}}
<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Vendor Dashboard | Vendora</title>
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
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-gold);
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
            padding: 10px 20px;
            border-radius: 8px;
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

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
            transform: translateY(-2px);
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
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            min-width: 150px;
        }

        .search-box {
            flex: 1;
            position: relative;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
        }

        /* Notifications Container */
        .notifications-container {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(184, 142, 63, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 20px;
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
        }

        .notification-meta {
            display: flex;
            gap: 20px;
            font-size: 12px;
            color: var(--text-gray);
        }

        .notification-meta i {
            margin-right: 3px;
        }

        .notification-time {
            font-size: 14px;
            color: var(--text-gray);
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
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
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 60px;
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
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
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
            z-index: 1000;
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

        .toast-icon {
            font-size: 24px;
        }

        .toast.success .toast-icon {
            color: var(--success);
        }

        .toast.error .toast-icon {
            color: var(--error);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-gray);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-gray);
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
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            padding: 30px;
            max-height: 90vh;
            overflow-y: auto;
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
            font-size: 24px;
            cursor: pointer;
            color: var(--text-gray);
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .notification-detail {
            padding: 10px 0;
        }

        .detail-label {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
        }

        .detail-data {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 14px;
            max-height: 200px;
            overflow-y: auto;
        }

        .modal-footer {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        /* Footer */
        footer {
            background: var(--white);
            padding: 40px 0;
            margin-top: 60px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-gray);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                height: auto;
                padding: 20px 0;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .notifications-header {
                grid-template-columns: 1fr 100px 80px;
                font-size: 14px;
            }

            .notification-item {
                grid-template-columns: 1fr 100px 80px;
                padding: 15px;
            }

            .notification-icon {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }

            .notification-details h4 {
                font-size: 14px;
            }

            .notification-details p {
                font-size: 12px;
            }

            .notification-meta {
                flex-direction: column;
                gap: 5px;
            }

            .notification-time {
                font-size: 12px;
            }

            .notification-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .notifications-header {
                display: none;
            }

            .notification-item {
                grid-template-columns: 1fr;
                gap: 10px;
                position: relative;
            }

            .notification-actions {
                flex-direction: row;
                justify-content: flex-end;
                position: absolute;
                top: 10px;
                right: 10px;
            }

            .notification-time {
                position: absolute;
                top: 10px;
                left: 10px;
            }

            .notification-content {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="logo">
                <i class="ri-store-3-fill"></i>
                Vendora
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
                <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('vendor.products.index') }}" class="nav-link">Products</a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-link">Orders</a>

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
                <h1><span>Notifications</span> Center</h1>
                <p>Stay updated with your vendor activity</p>
            </div>
            <div class="header-actions">
                @if($unreadNotificationsCount > 0)
                <button class="btn btn-primary" onclick="markAllAsRead()">
                    <i class="ri-check-double-line"></i> Mark All Read
                </button>
                @endif
                <button class="btn btn-danger" onclick="clearAllNotifications()">
                    <i class="ri-delete-bin-line"></i> Clear All
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <select class="filter-select" id="typeFilter" onchange="applyFilters()">
                <option value="">All Types</option>
                <option value="order" {{ request('type') == 'order' ? 'selected' : '' }}>Orders</option>
                <option value="message" {{ request('type') == 'message' ? 'selected' : '' }}>Messages</option>
                <option value="follow" {{ request('type') == 'follow' ? 'selected' : '' }}>Followers</option>
                <option value="review" {{ request('type') == 'review' ? 'selected' : '' }}>Reviews</option>
                <option value="system" {{ request('type') == 'system' ? 'selected' : '' }}>System</option>
                <option value="promotion" {{ request('type') == 'promotion' ? 'selected' : '' }}>Promotions</option>
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
                                }
                            @endphp
                            <i class="{{ $icon }}" style="color: {{ $color }}"></i>
                        </div>
                        <div class="notification-details">
                            <h4>{{ $notification->title }}</h4>
                            <p>{{ $notification->message }}</p>
                            <div class="notification-meta">
                                <span><i class="ri-price-tag-3-line"></i> {{ ucfirst($notification->type) }}</span>
                                @if($notification->data && isset(json_decode($notification->data, true)['order_id']))
                                <span><i class="ri-shopping-bag-line"></i> Order #{{ json_decode($notification->data, true)['order_id'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="notification-time">
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
                    <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary">
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
                <!-- Content will be loaded dynamically -->
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
            toastIcon.innerHTML = type === 'success' ? '<i class="ri-checkbox-circle-line"></i>' :
                                 type === 'error' ? '<i class="ri-error-warning-line"></i>' :
                                 '<i class="ri-information-line"></i>';
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
            fetch(`/vendor/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.querySelector(`.notification-item[data-id="${id}"]`);
                    if (item) {
                        item.classList.remove('unread');
                        showToast('Success', 'Notification marked as read');
                    }
                }
            })
            .catch(error => {
                showToast('Error', 'Failed to mark as read', 'error');
            });
        }

        // Mark all as read
        function markAllAsRead() {
            fetch('/vendor/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.classList.remove('unread');
                    });
                    showToast('Success', 'All notifications marked as read');
                }
            })
            .catch(error => {
                showToast('Error', 'Failed to mark all as read', 'error');
            });
        }

        // Delete notification
        function deleteNotification(id) {
            if (!confirm('Are you sure you want to delete this notification?')) {
                return;
            }

            fetch(`/vendor/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                        }
                    }
                }
            })
            .catch(error => {
                showToast('Error', 'Failed to delete notification', 'error');
            });
        }

        // Clear all notifications
        function clearAllNotifications() {
            if (!confirm('Are you sure you want to clear all notifications? This action cannot be undone.')) {
                return;
            }

            fetch('/vendor/notifications/clear-all', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                showToast('Error', 'Failed to clear notifications', 'error');
            });
        }

        // View notification details
        function viewNotification(id) {
            const modal = document.getElementById('notificationModal');
            const detailDiv = document.getElementById('notificationDetail');

            fetch(`/vendor/notifications/${id}`)
                .then(response => response.json())
                .then(data => {
                    let dataHtml = '';
                    if (data.data) {
                        const jsonData = typeof data.data === 'string' ? JSON.parse(data.data) : data.data;
                        dataHtml = '<pre>' + JSON.stringify(jsonData, null, 2) + '</pre>';
                    }

                    detailDiv.innerHTML = `
                        <div class="notification-detail">
                            <div class="detail-label">Title</div>
                            <div class="detail-value">${data.title}</div>
                        </div>
                        <div class="notification-detail">
                            <div class="detail-label">Message</div>
                            <div class="detail-value">${data.message}</div>
                        </div>
                        <div class="notification-detail">
                            <div class="detail-label">Type</div>
                            <div class="detail-value">${data.type}</div>
                        </div>
                        <div class="notification-detail">
                            <div class="detail-label">Received</div>
                            <div class="detail-value">${new Date(data.created_at).toLocaleString()}</div>
                        </div>
                        <div class="notification-detail">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">${data.is_read ? 'Read' : 'Unread'}</div>
                        </div>
                        ${data.data ? `
                        <div class="notification-detail">
                            <div class="detail-label">Additional Data</div>
                            <div class="detail-data">${dataHtml}</div>
                        </div>
                        ` : ''}
                    `;

                    document.getElementById('modalMarkRead').onclick = () => markCurrentAsRead(id);
                    modal.classList.add('active');
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
    </script>
</body>
</html>
