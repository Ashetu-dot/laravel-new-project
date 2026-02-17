<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - {{ $user->name }}'s Profile | Jimma, Ethiopia</title>
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

        :root {
            --primary-bg: #f8fafc;
            --sidebar-bg: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #334155;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e2e8f0;
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
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
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* Ethiopian Flag Colors Accent */
        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 400px;
            width: 100%;
            pointer-events: none;
        }

        .toast {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            animation: slideInRight 0.3s ease forwards;
            position: relative;
            overflow: hidden;
            pointer-events: auto;
            border-left: 4px solid transparent;
        }

        .toast.success {
            border-left-color: var(--success-color);
        }

        .toast.error {
            border-left-color: var(--accent-red);
        }

        .toast.warning {
            border-left-color: var(--accent-yellow);
        }

        .toast.info {
            border-left-color: var(--accent-blue);
        }

        .toast::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: rgba(0,0,0,0.05);
            animation: progress 5s linear forwards;
        }

        .toast.success::after {
            background: linear-gradient(90deg, var(--success-color), rgba(16, 185, 129, 0.3));
        }

        .toast.error::after {
            background: linear-gradient(90deg, var(--accent-red), rgba(239, 68, 68, 0.3));
        }

        .toast.warning::after {
            background: linear-gradient(90deg, var(--accent-yellow), rgba(245, 158, 11, 0.3));
        }

        .toast.info::after {
            background: linear-gradient(90deg, var(--accent-blue), rgba(59, 130, 246, 0.3));
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes progress {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }

        .toast-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .toast.success .toast-icon {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .toast.error .toast-icon {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--accent-red);
        }

        .toast.warning .toast-icon {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--accent-yellow);
        }

        .toast.info .toast-icon {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .toast.success .toast-title {
            color: var(--success-color);
        }

        .toast.error .toast-title {
            color: var(--accent-red);
        }

        .toast.warning .toast-title {
            color: var(--accent-yellow);
        }

        .toast.info .toast-title {
            color: var(--accent-blue);
        }

        .toast-message {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .toast-close:hover {
            color: var(--text-primary);
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
            border-bottom: 1px solid #334155;
            letter-spacing: -0.5px;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 28px;
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .nav-label {
            color: #64748b;
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
            border-top: 1px solid #334155;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        /* Top Header */
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
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 600;
        }

        .page-title i {
            color: var(--primary-gold);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
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
            transition: all 0.2s;
            position: relative;
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--primary-gold);
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
            gap: 16px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Profile Card */
        .profile-card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .profile-cover {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            position: relative;
        }

        .profile-avatar {
            position: absolute;
            bottom: -60px;
            left: 40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            color: var(--primary-gold);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            padding: 80px 40px 40px 40px;
        }

        @media (max-width: 640px) {
            .profile-avatar {
                left: 50%;
                transform: translateX(-50%);
            }
            .profile-info {
                padding: 80px 20px 30px;
            }
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .profile-name-section {
            flex: 1;
        }

        .profile-name-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .profile-role {
            display: inline-block;
            padding: 4px 12px;
            background-color: #fef3e7;
            color: var(--primary-gold);
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--accent-green);
            font-size: 14px;
        }

        .profile-stats {
            display: flex;
            gap: 32px;
            background: #f8fafc;
            padding: 16px 24px;
            border-radius: var(--radius-md);
        }

        @media (max-width: 640px) {
            .profile-stats {
                width: 100%;
                justify-content: space-around;
            }
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .profile-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 24px;
            background-color: #f8fafc;
            border-radius: var(--radius-md);
            margin-bottom: 32px;
        }

        @media (max-width: 768px) {
            .profile-meta {
                grid-template-columns: 1fr;
            }
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .meta-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            background-color: #fef3e7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 24px;
        }

        .meta-content {
            flex: 1;
        }

        .meta-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .meta-value {
            font-weight: 600;
            color: var(--text-primary);
            word-break: break-word;
        }

        .profile-bio {
            margin-bottom: 32px;
            padding: 24px;
            background-color: #f8fafc;
            border-radius: var(--radius-md);
        }

        .profile-bio h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-bio h3 i {
            color: var(--primary-gold);
        }

        .profile-bio p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .profile-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: var(--radius-sm);
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

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
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
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
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
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
        }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-stats {
                gap: 24px;
            }
        }

        @media (max-width: 768px) {
            .toast-container {
                max-width: 350px;
                right: 16px;
                left: 16px;
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .profile-header {
                flex-direction: column;
            }
            .profile-stats {
                width: 100%;
                justify-content: space-between;
            }
            .profile-actions {
                flex-direction: column;
            }
            .profile-actions .btn {
                width: 100%;
                justify-content: center;
            }
            
            .toast {
                padding: 14px 16px;
            }
            
            .toast-icon {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }
            
            .toast-title {
                font-size: 15px;
            }
            
            .toast-message {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer">
        @if(session('success'))
        <div class="toast success" id="toastSuccess">
            <div class="toast-icon">
                <i class="ri-checkbox-circle-line"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Success!</div>
                <div class="toast-message">{{ session('success') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="toast error" id="toastError">
            <div class="toast-icon">
                <i class="ri-error-warning-line"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Error!</div>
                <div class="toast-message">{{ session('error') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif

        @if(session('warning'))
        <div class="toast warning" id="toastWarning">
            <div class="toast-icon">
                <i class="ri-error-warning-line"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Warning!</div>
                <div class="toast-message">{{ session('warning') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif

        @if(session('info'))
        <div class="toast info" id="toastInfo">
            <div class="toast-icon">
                <i class="ri-information-line"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Information</div>
                <div class="toast-message">{{ session('info') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif

        @if($errors->any())
        <div class="toast error" id="toastErrors">
            <div class="toast-icon">
                <i class="ri-error-warning-line"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Validation Error</div>
                <div class="toast-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma
            </span>
        </div>

        <div class="nav-menu">
            @if($user->role === 'admin')
                <!-- Admin Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">MAIN</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.orders') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> Orders
                    </a>
                    <a href="{{ route('admin.customers') }}" class="nav-item">
                        <i class="ri-user-3-line"></i> Customers
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">MANAGEMENT</div>
                    <a href="{{ route('admin.vendors') }}" class="nav-item">
                        <i class="ri-store-2-line"></i> Vendors
                    </a>
                    <a href="{{ route('admin.catalog') }}" class="nav-item">
                        <i class="ri-archive-line"></i> Catalog
                    </a>
                    <a href="{{ route('admin.promotions') }}" class="nav-item">
                        <i class="ri-price-tag-3-line"></i> Promotions
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">ADMIN</div>
                    <a href="{{ route('admin.settings') }}" class="nav-item">
                        <i class="ri-settings-4-line"></i> Settings
                    </a>
                    <a href="{{ route('admin.admins.list') }}" class="nav-item">
                        <i class="ri-shield-user-line"></i> Admins
                    </a>
                    <a href="{{ route('admin.roles') }}" class="nav-item">
                        <i class="ri-shield-keyhole-line"></i> Roles
                    </a>
                </div>
            @elseif($user->role === 'vendor')
                <!-- Vendor Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">VENDOR</div>
                    <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('vendor.store', $user->id) }}" class="nav-item">
                        <i class="ri-store-line"></i> My Store
                    </a>
                    <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> Orders
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">PRODUCTS</div>
                    <a href="{{ route('vendor.products.create') }}" class="nav-item">
                        <i class="ri-add-circle-line"></i> Add Product
                    </a>
                    <a href="{{ route('vendor.products.index') }}" class="nav-item">
                        <i class="ri-list-check"></i> Manage Products
                    </a>
                    <a href="{{ route('vendor.categories.index') }}" class="nav-item">
                        <i class="ri-price-tag-3-line"></i> Categories
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">ANALYTICS</div>
                    <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                        <i class="ri-bar-chart-2-line"></i> Sales Report
                    </a>
                    <a href="{{ route('vendor.store-views') }}" class="nav-item">
                        <i class="ri-eye-line"></i> Store Views
                    </a>
                </div>
            @else
                <!-- Customer Sidebar -->
                <div class="nav-group">
                    <div class="nav-label">MAIN</div>
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">
                        <i class="ri-dashboard-line"></i> Dashboard
                    </a>
                    <a href="{{ route('search.results') }}" class="nav-item">
                        <i class="ri-search-line"></i> Discover
                    </a>
                    <a href="{{ route('customer.orders') }}" class="nav-item">
                        <i class="ri-shopping-bag-3-line"></i> My Orders
                    </a>
                </div>
                <div class="nav-group">
                    <div class="nav-label">SHOPPING</div>
                    <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                        <i class="ri-heart-3-line"></i> Wishlist
                    </a>
                    <a href="{{ route('customer.following') }}" class="nav-item">
                        <i class="ri-store-2-line"></i> Following
                    </a>
                    <a href="{{ route('customer.coupons') }}" class="nav-item">
                        <i class="ri-coupon-3-line"></i> My Coupons
                    </a>
                </div>
            @endif

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('profile.show', $user->id) }}" class="nav-item active">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('profile.edit', $user->id) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                @else
                    {{ substr($user->name ?? 'U', 0, 2) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ $user->name ?? 'User' }}</h4>
                <p>{{ ucfirst($user->role ?? 'customer') }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-user-line"></i> Profile
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('customer.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                @if($user->role === 'customer')
                    <a href="{{ route('customer.cart.index') }}" class="icon-btn">
                        <i class="ri-shopping-cart-2-line"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="badge-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                @endif
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-user-line" style="color: var(--primary-gold);"></i> 
                        My Profile
                    </h1>
                    <p>View and manage your personal information</p>
                </div>
                @if(Auth::id() == $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">
                        <i class="ri-edit-line"></i> Edit Profile
                    </a>
                @endif
            </div>

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-cover"></div>
                <div class="profile-avatar">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                    @else
                        {{ substr($user->name ?? 'U', 0, 2) }}
                    @endif
                </div>

                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-name-section">
                            <h2>
                                {{ $user->name }}
                                @if($user->role === 'vendor')
                                    <span class="profile-role">Vendor</span>
                                @elseif($user->role === 'admin')
                                    <span class="profile-role">Administrator</span>
                                @else
                                    <span class="profile-role">Customer</span>
                                @endif
                                @if($user->email_verified_at)
                                    <span class="verified-badge">
                                        <i class="ri-verified-badge-fill"></i> Verified
                                    </span>
                                @endif
                            </h2>
                            @if($user->business_name)
                                <p style="color: var(--text-secondary); margin-bottom: 8px;">
                                    <i class="ri-store-line"></i> {{ $user->business_name }}
                                </p>
                            @endif
                        </div>

                        <div class="profile-stats">
                            @if($user->role === 'vendor')
                                <div class="stat-item">
                                    <div class="stat-value">{{ $followersCount ?? 0 }}</div>
                                    <div class="stat-label">Followers</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $productsCount ?? 0 }}</div>
                                    <div class="stat-label">Products</div>
                                </div>
                            @endif
                            <div class="stat-item">
                                <div class="stat-value">{{ $followingCount ?? 0 }}</div>
                                <div class="stat-label">Following</div>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Information Grid -->
                    <div class="profile-meta">
                        <!-- Email -->
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Email Address</div>
                                <div class="meta-value">{{ $user->email }}</div>
                            </div>
                        </div>

                        <!-- Phone -->
                        @if($user->phone)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-phone-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Phone Number</div>
                                <div class="meta-value">{{ $user->phone }}</div>
                            </div>
                        </div>
                        @endif

                        <!-- Member Since -->
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Member Since</div>
                                <div class="meta-value">
                                    @if($user->created_at)
                                        {{ $user->created_at->format('F j, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Last Login -->
                        @if($user->last_login_at)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-history-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Last Login</div>
                                <div class="meta-value">
                                    {{ $user->last_login_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Address (if vendor) -->
                        @if($user->role === 'vendor' && ($user->address_line1 || $user->city || $user->state))
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Address</div>
                                <div class="meta-value">
                                    @if($user->address_line1){{ $user->address_line1 }}@endif
                                    @if($user->address_line2), {{ $user->address_line2 }}@endif
                                    @if($user->city || $user->state)
                                        <br>
                                        @if($user->city){{ $user->city }}@endif
                                        @if($user->state){{ $user->state }}@endif
                                        @if($user->zip_code) - {{ $user->zip_code }}@endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Website (if vendor) -->
                        @if($user->role === 'vendor' && $user->website)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-global-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Website</div>
                                <div class="meta-value">
                                    <a href="{{ $user->website }}" target="_blank" style="color: var(--primary-gold); text-decoration: none;">
                                        {{ $user->website }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Category (if vendor) -->
                        @if($user->role === 'vendor' && $user->category)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-price-tag-3-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Category</div>
                                <div class="meta-value">{{ $user->category }}</div>
                            </div>
                        </div>
                        @endif

                        <!-- Tax ID (if vendor) -->
                        @if($user->role === 'vendor' && $user->tax_id)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="ri-file-list-line"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Tax ID / License</div>
                                <div class="meta-value">{{ $user->tax_id }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Bio/Description -->
                    @if($user->description || $user->bio)
                    <div class="profile-bio">
                        <h3>
                            <i class="ri-information-line"></i>
                            About
                        </h3>
                        <p>{{ $user->description ?? $user->bio }}</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    @if(Auth::id() == $user->id)
                    <div class="profile-actions">
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">
                            <i class="ri-edit-line"></i> Edit Profile
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="ri-home-line"></i> Home
                        </a>
                        @if($user->role === 'vendor')
                            <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @elseif($user->role === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @elseif($user->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="ri-dashboard-line"></i> Dashboard
                            </a>
                        @endif
                        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ri-delete-bin-line"></i> Delete Account
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Auto-remove toasts after animation
            setTimeout(() => {
                document.querySelectorAll('.toast').forEach(toast => {
                    toast.style.animation = 'slideOutRight 0.3s ease forwards';
                    setTimeout(() => toast.remove(), 300);
                });
            }, 5000);

            // Add click handlers for toast close buttons
            document.querySelectorAll('.toast-close').forEach(btn => {
                btn.addEventListener('click', function() {
                    const toast = this.closest('.toast');
                    toast.style.animation = 'slideOutRight 0.3s ease forwards';
                    setTimeout(() => toast.remove(), 300);
                });
            });
        });

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>