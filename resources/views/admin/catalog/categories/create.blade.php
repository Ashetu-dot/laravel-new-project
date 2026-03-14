<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Create Category - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
            font-display: swap;
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
            --text-soft: #9ca3af;
            --border-color: #e5e7eb;
            --border-soft: #f3f4f6;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --primary-soft: rgba(184, 142, 63, 0.1);
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-blue: #3b82f6;
            --accent-yellow: #f59e0b;
            --accent-purple: #8b5cf6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-gold: 0 4px 12px rgba(184, 142, 63, 0.2);
            --gradient-gold: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-hover));
            --gradient-ethiopia: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--border-soft);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gold-hover);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #111827 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
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
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 26px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            letter-spacing: -0.5px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 32px;
            filter: drop-shadow(0 2px 4px rgba(184, 142, 63, 0.3));
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: var(--gradient-ethiopia);
            color: white;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
            box-shadow: var(--shadow-sm);
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 28px;
        }

        .nav-label {
            color: #6b7280;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 12px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--gradient-gold);
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover, .nav-item.active {
            background: linear-gradient(135deg, var(--sidebar-active-bg), rgba(184, 142, 63, 0.1));
            color: var(--sidebar-text-active);
            transform: translateX(4px);
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .nav-item:hover i {
            transform: scale(1.1);
            color: var(--primary-gold);
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .avatar {
            width: 44px;
            height: 44px;
            background: var(--gradient-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
            font-size: 18px;
            box-shadow: var(--shadow-md);
            border: 2px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: 600;
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
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            width: calc(100% - 32px);
            margin: 8px 16px 16px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            transform: translateX(4px);
        }

        .logout-btn i {
            font-size: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Top Header */
        .top-header {
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            background: var(--primary-bg);
            border: 1px solid var(--border-color);
        }

        .menu-toggle:hover {
            background: var(--primary-gold);
            color: white;
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: flex;
            }
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .breadcrumb a:hover {
            color: var(--primary-gold);
            background: var(--primary-soft);
        }

        .breadcrumb i {
            font-size: 12px;
            color: var(--text-soft);
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
        }

        .page-title i {
            color: var(--primary-gold);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.3s;
            position: relative;
            text-decoration: none;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .icon-btn:hover {
            background: var(--gradient-gold);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
            border-color: transparent;
        }

        .badge-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, var(--accent-red), #dc2626);
            color: white;
            font-size: 10px;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
            flex: 1;
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
            gap: 12px;
            color: var(--text-primary);
        }

        .page-header h1 i {
            color: var(--primary-gold);
            background: var(--primary-soft);
            padding: 10px;
            border-radius: 14px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Form Container */
        .form-container {
            background-color: var(--card-bg);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 24px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 24px;
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
            margin-right: 6px;
        }

        .required {
            color: var(--accent-red);
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--accent-red);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-text {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 6px;
            display: block;
            line-height: 1.5;
        }

        .form-text i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        /* Checkbox Styling */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--primary-soft);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary-gold);
        }

        .checkbox-wrapper label {
            font-weight: 500;
            cursor: pointer;
            flex: 1;
            margin-bottom: 0;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 24px;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            border-left: 4px solid;
            box-shadow: var(--shadow-md);
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
            background: linear-gradient(135deg, #d1fae5, #ecfdf5);
            color: #065f46;
            border-left-color: var(--accent-green);
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2, #fef2f2);
            color: #991b1b;
            border-left-color: var(--accent-red);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7, #fffbeb);
            color: #92400e;
            border-left-color: var(--accent-yellow);
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #1e40af;
            border-left-color: var(--accent-blue);
        }

        .alert i {
            font-size: 24px;
        }

        .alert ul {
            margin: 8px 0 0 20px;
        }

        .alert li {
            margin-bottom: 4px;
        }

        /* Buttons */
        .btn {
            padding: 14px 28px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--gradient-gold);
            color: white;
            box-shadow: var(--shadow-gold);
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: var(--primary-bg);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-1px);
            background: white;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 28px;
            border-top: 2px solid var(--border-color);
        }

        @media (max-width: 480px) {
            .form-actions {
                flex-direction: column-reverse;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
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
            background: rgba(255, 255, 255, 0.95);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            backdrop-filter: blur(4px);
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--primary-soft);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 1s linear infinite;
        }

        .loading-text {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 18px;
        }

        /* Icon Preview */
        .icon-preview {
            margin-top: 12px;
            padding: 12px 16px;
            background: var(--primary-soft);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: var(--text-secondary);
            border: 1px solid rgba(184, 142, 63, 0.2);
        }

        .icon-preview i {
            font-size: 24px;
            color: var(--primary-gold);
            background: white;
            padding: 8px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .icon-preview span {
            font-family: monospace;
            color: var(--primary-gold);
            font-weight: 500;
        }

        /* Character Counter */
        .char-counter {
            text-align: right;
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .char-counter i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .page-header h1 {
                font-size: 24px;
            }
            .form-container {
                padding: 20px;
            }
            .breadcrumb {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .top-header {
                padding: 0 16px;
            }
            .dashboard-container {
                padding: 20px 12px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            .form-control {
                padding: 12px 14px;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .top-header, .form-actions, .btn {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .form-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            :root {
                --primary-gold: #b88e3f;
                --text-primary: #000000;
                --text-secondary: #333333;
                --border-color: #000000;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

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
            <div class="nav-group">
                <div class="nav-label">DASHBOARD</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-line"></i> Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-line"></i> Vendors
                </a>
                <a href="{{ route('admin.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item active">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i> Inventory
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i> Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i> Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SYSTEM</div>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i> Administrators
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
                </a>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if(Auth::user() && Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                <p>{{ ucfirst(Auth::user()->role ?? 'administrator') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                <i class="ri-logout-box-line"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <a href="{{ route('admin.catalog.categories') }}">Categories</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>Create Category</span>
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
                    <i class="ri-message-3-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="btn btn-secondary" style="margin-left: 8px;">
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
                        <i class="ri-price-tag-3-line"></i>
                        Create New Category
                    </h1>
                    <p>Add a new category to organize your products</p>
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
                        <ul style="margin-top: 8px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Create Category Form -->
            <div class="form-container">
                <form action="{{ route('admin.catalog.categories.store') }}" method="POST" id="categoryForm">
                    @csrf

                    <div class="form-grid">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-price-tag-3-line"></i> Category Name
                                <span class="required">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') error @enderror"
                                   placeholder="e.g., Electronics, Fashion, Food"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="form-group">
                            <label for="slug" class="form-label">
                                <i class="ri-link"></i> Slug
                            </label>
                            <input type="text"
                                   id="slug"
                                   name="slug"
                                   class="form-control @error('slug') error @enderror"
                                   placeholder="e.g., electronics"
                                   value="{{ old('slug') }}">
                            <small class="form-text">
                                <i class="ri-information-line"></i> Leave empty for auto-generation from name
                            </small>
                            @error('slug')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Icon Class -->
                        <div class="form-group">
                            <label for="icon" class="form-label">
                                <i class="ri-paint-brush-line"></i> Icon Class
                            </label>
                            <input type="text"
                                   id="icon"
                                   name="icon"
                                   class="form-control @error('icon') error @enderror"
                                   placeholder="e.g., ri-shopping-bag-line"
                                   value="{{ old('icon') }}"
                                   oninput="updateIconPreview(this.value)">
                            <small class="form-text">
                                <i class="ri-information-line"></i> RemixIcon class name (optional)
                            </small>
                            @error('icon')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror

                            <!-- Icon Preview -->
                            <div class="icon-preview" id="iconPreview" style="{{ old('icon') ? 'display: flex;' : 'display: none;' }}">
                                <i class="{{ old('icon') ?? 'ri-price-tag-line' }}" id="previewIcon"></i>
                                <div>
                                    <div>Icon Preview</div>
                                    <span id="iconClass">{{ old('icon') ?? 'ri-price-tag-line' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="ri-toggle-line"></i> Status
                            </label>
                            <div class="checkbox-wrapper">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active">Active Category</label>
                            </div>
                            <small class="form-text">
                                <i class="ri-information-line"></i> Inactive categories won't be visible to users
                            </small>
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label for="description" class="form-label">
                                <i class="ri-file-text-line"></i> Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      class="form-control @error('description') error @enderror"
                                      placeholder="Detailed category description..."
                                      oninput="updateCharCounter(this)">{{ old('description') }}</textarea>
                            <div class="char-counter">
                                <i class="ri-text"></i> <span id="charCount">0</span> characters
                            </div>
                            @error('description')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('admin.catalog.categories') }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="ri-add-line"></i> Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Creating category...</div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const body = document.body;

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('active');
                    
                    // Change icon based on state
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = sidebar.classList.contains('active') ? 'ri-close-line' : 'ri-menu-line';
                    }

                    // Prevent body scroll when sidebar is open on mobile
                    if (window.innerWidth <= 1024) {
                        body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
                    }
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 1024) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && sidebar.classList.contains('active')) {
                            sidebar.classList.remove('active');
                            const icon = menuToggle.querySelector('i');
                            if (icon) icon.className = 'ri-menu-line';
                            body.style.overflow = '';
                        }
                    }
                });

                // Handle escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });

                // Close sidebar on window resize if open
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 1024 && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });
            }

            // Auto-generate slug from name
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', function() {
                    if (!slugInput.value || slugInput.value === '') {
                        slugInput.value = generateSlug(this.value);
                    }
                });
            }

            // Form validation
            document.getElementById('categoryForm').addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                
                if (!name) {
                    e.preventDefault();
                    alert('Please enter a category name');
                    return;
                }

                // Show loading state
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner"></span> Creating...';
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

            // Initialize character counter
            const description = document.getElementById('description');
            if (description) {
                updateCharCounter(description);
            }

            // Initialize icon preview if there's a value
            const iconInput = document.getElementById('icon');
            if (iconInput && iconInput.value) {
                updateIconPreview(iconInput.value);
            }
        });

        // Generate slug from text
        function generateSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')              // Trim - from start of text
                .replace(/-+$/, '');             // Trim - from end of text
        }

        // Update icon preview
        function updateIconPreview(iconClass) {
            const preview = document.getElementById('iconPreview');
            const previewIcon = document.getElementById('previewIcon');
            const iconClassSpan = document.getElementById('iconClass');

            if (iconClass && iconClass.trim() !== '') {
                previewIcon.className = iconClass;
                iconClassSpan.textContent = iconClass;
                preview.style.display = 'flex';
            } else {
                preview.style.display = 'none';
            }
        }

        // Update character counter
        function updateCharCounter(textarea) {
            const counter = document.getElementById('charCount');
            if (counter) {
                counter.textContent = textarea.value.length;
            }
        }

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('categoryForm').submit();
            }
            
            // Escape to cancel
            if (e.key === 'Escape') {
                if (!document.getElementById('loadingOverlay').style.display === 'flex') {
                    window.location.href = '{{ route('admin.catalog.categories') }}';
                }
            }
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    @if(app()->environment('local'))
        <!-- Development environment indicator -->
        <div style="position: fixed; bottom: 10px; right: 10px; background: #FFD700; color: #000; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; opacity: 0.5; z-index: 9999;">
            DEV MODE
        </div>
    @endif
</body>
</html>