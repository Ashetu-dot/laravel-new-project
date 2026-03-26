<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Video Tutorials - Admin Dashboard | Vendora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-bg: #111827;
            --sidebar-bg: #1a1e2b;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #2d3348;
            --card-bg: #1f2937;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --primary-gold: #D4A55A;
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
            transition: background-color 0.3s, color 0.3s;
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
            transition: background-color 0.3s;
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
            transition: background-color 0.3s;
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

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--primary-bg);
            padding: 8px 16px;
            border-radius: 8px;
            width: 400px;
        }

        .search-bar i {
            color: var(--text-secondary);
            margin-right: 8px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
        }

        @media (max-width: 1024px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                width: 200px;
            }
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
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            padding: 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--border-color);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(184, 142, 63, 0.15);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Filters */
        .filters-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            border: 1px solid var(--border-color);
        }

        .filters-form {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-select, .filter-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--card-bg);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s;
        }

        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
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
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Featured Videos */
        .featured-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary-gold);
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Video Cards */
        .video-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
            cursor: pointer;
        }

        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(184, 142, 63, 0.15);
        }

        .video-thumbnail {
            position: relative;
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .video-card:hover .video-thumbnail img {
            transform: scale(1.05);
        }

        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .video-card:hover .play-overlay {
            opacity: 1;
        }

        .play-overlay i {
            font-size: 48px;
            color: white;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        .featured-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--primary-gold);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .video-info {
            padding: 16px;
        }

        .video-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .video-category {
            background: var(--primary-bg);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .video-views {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Video Grid */
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1200px) {
            .videos-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .videos-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .videos-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card-bg);
            border-radius: 16px;
            width: 100%;
            max-width: 1000px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: white;
            font-size: 30px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
            z-index: 1001;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .video-player-container {
            aspect-ratio: 16 / 9;
            background: #000;
        }

        .video-player-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-details {
            padding: 24px;
        }

        .video-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .video-header h2 {
            font-size: 24px;
            color: var(--text-primary);
        }

        .video-stats {
            display: flex;
            gap: 16px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .video-stats i {
            color: var(--primary-gold);
            margin-right: 4px;
        }

        .video-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .related-videos {
            border-top: 1px solid var(--border-color);
            padding-top: 24px;
        }

        .related-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .related-item {
            display: flex;
            gap: 12px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .related-item:hover {
            background: var(--primary-bg);
        }

        .related-thumb {
            width: 120px;
            aspect-ratio: 16 / 9;
            border-radius: 6px;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .related-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-info {
            flex: 1;
            min-width: 0;
        }

        .related-info h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-primary);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-info p {
            font-size: 12px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 32px;
        }

        .pagination-item {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
            min-width: 36px;
            text-align: center;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Notification badges */
        .notification-badge-header {
            display: flex;
            gap: 15px;
        }

        .badge-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--primary-bg);
            border-radius: 50px;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 14px;
        }

        .badge-header i {
            color: var(--primary-gold);
        }

        .badge-header span {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* Theme Toggle */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .theme-toggle:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Color Utilities */
        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Catalog
                </a>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ADMIN</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Admins
                </a>
                <a href="{{ route('admin.support-tickets') }}" class="nav-item">
                    <i class="ri-customer-service-line"></i>
                    Support Tickets
                </a>
                <a href="{{ route('admin.video-tutorials') }}" class="nav-item active">
                    <i class="ri-video-line"></i>
                    Video Tutorials
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i>
                    Help
                </a>
                <a href="{{ route('admin.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i>
                    Notifications
                </a>
                <a href="{{ route('admin.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i>
                    Messages
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr($user->name ?? 'AD', 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ $user->name ?? 'Admin User' }}</h4>
                <p>{{ $user->role ?? 'Super Admin' }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <form method="GET" action="{{ route('admin.video-tutorials') }}" style="width: 100%;">
                        <input type="text" name="search" placeholder="Search tutorials..." value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            <div class="header-actions">
                <button class="theme-toggle" id="themeToggle">
                    <i class="ri-moon-line"></i>
                </button>
                <div class="notification-badge-header">
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                    <div class="badge-header">
                        <i class="ri-notification-3-line"></i>
                        <span>{{ $unreadNotificationsCount }}</span>
                    </div>
                    @endif

                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                    <div class="badge-header">
                        <i class="ri-mail-line"></i>
                        <span>{{ $unreadMessagesCount }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Video Tutorials</h1>
                    <p class="page-subtitle">Learn how to make the most of your Vendora admin dashboard</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-video-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Videos</div>
                        <div class="stat-number">{{ $stats['total'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-star-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Featured</div>
                        <div class="stat-number">{{ $stats['featured'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-folders-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Categories</div>
                        <div class="stat-number">{{ $stats['categories'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <form method="GET" action="{{ route('admin.video-tutorials') }}" class="filters-form">
                    <div class="filter-group">
                        <label class="filter-label">Category</label>
                        <select name="category" class="filter-select">
                            <option value="all" {{ $category == 'all' ? 'selected' : '' }}>All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-filter-3-line"></i>
                            Apply Filters
                        </button>
                        @if(request('category') != 'all' || request('search'))
                        <a href="{{ route('admin.video-tutorials') }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i>
                            Clear Filters
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Featured Videos Section -->
            @if($featuredVideos->count() > 0 && request('category') == 'all' && !request('search'))
            <div class="featured-section">
                <h2 class="section-title">
                    <i class="ri-star-fill"></i>
                    Featured Tutorials
                </h2>

                <div class="featured-grid">
                    @foreach($featuredVideos as $video)
                    <div class="video-card" onclick="openVideo({{ $video->id }})">
                        <div class="video-thumbnail">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}">
                            @else
                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" alt="{{ $video->title }}">
                            @endif
                            <div class="featured-badge">
                                <i class="ri-star-fill"></i>
                                Featured
                            </div>
                            <div class="play-overlay">
                                <i class="ri-play-circle-fill"></i>
                            </div>
                            @if($video->duration)
                            <span class="video-duration">{{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}</span>
                            @endif
                        </div>
                        <div class="video-info">
                            <h3 class="video-title">{{ $video->title }}</h3>
                            <div class="video-meta">
                                <span class="video-category">{{ $video->category }}</span>
                                <span class="video-views">
                                    <i class="ri-eye-line"></i>
                                    {{ number_format($video->views_count) }} views
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- All Videos Section -->
            <div class="all-videos-section">
                <h2 class="section-title">
                    <i class="ri-play-list-line"></i>
                    @if(request('category') != 'all' || request('search'))
                        Search Results
                    @else
                        All Tutorials
                    @endif
                </h2>

                @if($videos->count() > 0)
                <div class="videos-grid">
                    @foreach($videos as $video)
                    <div class="video-card" onclick="openVideo({{ $video->id }})">
                        <div class="video-thumbnail">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}">
                            @else
                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" alt="{{ $video->title }}">
                            @endif
                            <div class="play-overlay">
                                <i class="ri-play-circle-fill"></i>
                            </div>
                            @if($video->duration)
                            <span class="video-duration">{{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}</span>
                            @endif
                        </div>
                        <div class="video-info">
                            <h3 class="video-title">{{ $video->title }}</h3>
                            <div class="video-meta">
                                <span class="video-category">{{ $video->category }}</span>
                                <span class="video-views">
                                    <i class="ri-eye-line"></i>
                                    {{ number_format($video->views_count) }} views
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $videos->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="ri-video-line"></i>
                    </div>
                    <h3 class="empty-title">No Videos Found</h3>
                    <p class="empty-text">No tutorials match your current filters. Try adjusting your search or category.</p>
                    <a href="{{ route('admin.video-tutorials') }}" class="btn btn-primary">
                        <i class="ri-refresh-line"></i>
                        Clear Filters
                    </a>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Video Modal -->
    <div class="modal" id="videoModal">
        <button class="modal-close" onclick="closeModal()">
            <i class="ri-close-line"></i>
        </button>
        <div class="modal-content">
            <div class="video-player-container" id="videoPlayer">
                <!-- Video will be loaded here -->
            </div>
            <div class="video-details" id="videoDetails">
                <!-- Video details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme') || 'light';

        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="ri-sun-line"></i>';
        }

        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');

            if (isDark) {
                localStorage.setItem('theme', 'dark');
                themeToggle.innerHTML = '<i class="ri-sun-line"></i>';
            } else {
                localStorage.setItem('theme', 'light');
                themeToggle.innerHTML = '<i class="ri-moon-line"></i>';
            }
        });

        // Format duration
        function formatDuration(seconds) {
            if (!seconds) return '00:00';
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        // Open video modal
        function openVideo(videoId) {
            const modal = document.getElementById('videoModal');
            const player = document.getElementById('videoPlayer');
            const details = document.getElementById('videoDetails');

            // Show loading state
            player.innerHTML = '<div style="display: flex; justify-content: center; align-items: center; height: 100%;"><div class="loading-spinner"></div></div>';
            details.innerHTML = '';

            modal.classList.add('active');

            // Fetch video details
            fetch(`/admin/video-tutorials/${videoId}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const video = data.video;

                        // Load video player
                        if (video.youtube_id) {
                            player.innerHTML = `<iframe src="https://www.youtube.com/embed/${video.youtube_id}?autoplay=1" allowfullscreen></iframe>`;
                        } else if (video.vimeo_id) {
                            player.innerHTML = `<iframe src="https://player.vimeo.com/video/${video.vimeo_id}?autoplay=1" allowfullscreen></iframe>`;
                        }

                        // Load video details
                        details.innerHTML = `
                            <div class="video-header">
                                <h2>${video.title}</h2>
                                <div class="video-stats">
                                    <span><i class="ri-eye-line"></i> ${video.views_count.toLocaleString()} views</span>
                                    ${video.duration ? `<span><i class="ri-time-line"></i> ${formatDuration(video.duration)}</span>` : ''}
                                    <span><i class="ri-price-tag-3-line"></i> ${video.category}</span>
                                </div>
                            </div>
                            <div class="video-description">
                                ${video.description || 'No description available.'}
                            </div>
                            <div class="related-videos" id="relatedVideos">
                                <h3 class="related-title">Related Videos</h3>
                                <div class="related-grid" id="relatedGrid">
                                    <div style="grid-column: 1/-1; text-align: center; padding: 20px;">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Load related videos
                        loadRelatedVideos(videoId);
                    }
                })
                .catch(error => {
                    console.error('Error loading video:', error);
                    player.innerHTML = '<div style="color: white; text-align: center; padding: 50px;">Error loading video. Please try again.</div>';
                });
        }

        // Load related videos
        function loadRelatedVideos(videoId) {
            fetch(`/admin/video-tutorials/${videoId}/related`)
                .then(response => response.json())
                .then(data => {
                    const relatedGrid = document.getElementById('relatedGrid');

                    if (data.success && data.videos.length > 0) {
                        relatedGrid.innerHTML = data.videos.map(video => `
                            <div class="related-item" onclick="openVideo(${video.id})">
                                <div class="related-thumb">
                                    <img src="${video.thumbnail ? '/storage/' + video.thumbnail : 'https://img.youtube.com/vi/' + video.youtube_id + '/default.jpg'}" alt="${video.title}">
                                </div>
                                <div class="related-info">
                                    <h4>${video.title}</h4>
                                    <p>
                                        <i class="ri-eye-line"></i>
                                        ${video.views_count.toLocaleString()} views
                                    </p>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        relatedGrid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 20px; color: var(--text-secondary);">No related videos found.</div>';
                    }
                })
                .catch(error => {
                    console.error('Error loading related videos:', error);
                });
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('videoModal');
            const player = document.getElementById('videoPlayer');

            modal.classList.remove('active');
            player.innerHTML = ''; // Stop video playback
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('videoModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });

        // Auto-submit search on Enter
        document.querySelector('.search-bar input').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>
