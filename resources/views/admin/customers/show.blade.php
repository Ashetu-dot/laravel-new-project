<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Customer Details - Vendora Admin | Jimma, Ethiopia</title>
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
            --accent-orange: #f97316;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
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

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--accent-blue);
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

        .btn-primary:hover {
            background-color: var(--primary-gold-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
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

        .btn-success {
            background-color: var(--accent-green);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Detail Cards */
        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary-gold);
        }

        .info-row {
            display: flex;
            margin-bottom: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 140px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            font-weight: 500;
            word-break: break-word;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-verified {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-unverified {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .badge-vip {
            background: linear-gradient(135deg, #B88E3F, #9c7832);
            color: white;
        }

        .badge-premium {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            background-color: #f3f4f6;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* Customer Segments */
        .segment-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .segment-vip {
            background: linear-gradient(135deg, #B88E3F, #9c7832);
            color: white;
        }

        .segment-regular {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .segment-new {
            background-color: #d1fae5;
            color: #065f46;
        }

        .segment-at-risk {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Orders Table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .orders-table th {
            text-align: left;
            padding: 12px;
            font-size: 12px;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        .orders-table td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }

        .orders-table tr:hover td {
            background-color: #f9fafb;
        }

        .order-status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-refunded { background-color: #f3f4f6; color: #6b7280; }
        .status-shipped { background-color: #e0f2fe; color: #0369a1; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }

        /* Timeline */
        .timeline {
            margin-top: 20px;
        }

        .timeline-item {
            display: flex;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .timeline-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .timeline-time {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .text-gold {
            color: var(--primary-gold);
            font-weight: 600;
        }

        .text-gold:hover {
            text-decoration: underline;
        }

        .font-mono {
            font-family: monospace;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .empty-state h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .empty-state p {
            font-size: 14px;
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

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .tooltip-text {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--sidebar-bg);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            transition: opacity 0.2s;
            z-index: 10;
        }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
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
                    <i class="ri-user-line" style="color: var(--primary-gold);"></i> Customer Details
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
                    <i class="ri-arrow-left-line"></i> Back to Customers
                </a>
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="dashboard-container">

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

            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="ri-alert-line"></i>
                    {{ session('warning') }}
                </div>
            @endif




            <!-- Page Header -->
<div class="page-header">
    <div>
        <h1>
            <i class="ri-user-line"></i>
            {{ $customer->name }}
        </h1>
        <p>Customer profile and order history</p>
    </div>
    <div style="display: flex; gap: 12px;">
        @php
            // Calculate customer segment
            $totalOrders = $customer->orders_count ?? $customer->orders->count() ?? 0;
            $totalSpent = $totalSpent ?? 0;
            $accountAge = $customer->created_at->diffInDays(now());

            $segment = 'regular';
            $segmentLabel = 'Regular Customer';
            $segmentClass = 'segment-regular';

            if ($totalSpent > 10000) {
                $segment = 'vip';
                $segmentLabel = 'VIP Customer';
                $segmentClass = 'segment-vip';
            } elseif ($totalSpent > 5000) {
                $segment = 'premium';
                $segmentLabel = 'Premium Customer';
                $segmentClass = 'badge-premium';
            } elseif ($accountAge < 30) {
                $segment = 'new';
                $segmentLabel = 'New Customer';
                $segmentClass = 'segment-new';
            }

            $lastOrderDate = $customer->orders && $customer->orders->isNotEmpty()
                ? $customer->orders->first()->created_at
                : null;

            $daysSinceLastOrder = $lastOrderDate ? $lastOrderDate->diffInDays(now()) : null;

            if ($daysSinceLastOrder && $daysSinceLastOrder > 90) {
                $segment = 'at-risk';
                $segmentLabel = 'At Risk';
                $segmentClass = 'segment-at-risk';
            }
        @endphp

        <span class="badge {{ $segmentClass }}">
            <i class="ri-{{ $segment == 'vip' ? 'crown-line' : ($segment == 'premium' ? 'star-line' : 'user-line') }}"></i>
            {{ $segmentLabel }}
        </span>

        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary">
            <i class="ri-edit-line"></i> Edit Customer
        </a>

        <form action="{{ route('admin.customers.toggle-status', $customer->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-{{ $customer->is_active ? 'danger' : 'success' }}">
                <i class="ri-{{ $customer->is_active ? 'close' : 'check' }}-line"></i>
                {{ $customer->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
    </div>
</div>

            <!-- Customer Quick Stats -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
                <div style="background: var(--card-bg); padding: 16px; border-radius: 12px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-blue);">
                            <i class="ri-shopping-bag-3-line" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-secondary);">Total Orders</div>
                            <div style="font-size: 20px; font-weight: 700;">{{ number_format($totalOrders) }}</div>
                        </div>
                    </div>
                </div>

                <div style="background: var(--card-bg); padding: 16px; border-radius: 12px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #fef3e7; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--primary-gold);">
                            <i class="ri-money-dollar-circle-line" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-secondary);">Total Spent</div>
                            <div style="font-size: 20px; font-weight: 700;">ETB {{ number_format($totalSpent, 2) }}</div>
                        </div>
                    </div>
                </div>

                <div style="background: var(--card-bg); padding: 16px; border-radius: 12px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #f3e8ff; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-purple);">
                            <i class="ri-star-line" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-secondary);">Avg. Order</div>
                            <div style="font-size: 20px; font-weight: 700;">ETB {{ number_format($totalOrders > 0 ? $totalSpent / $totalOrders : 0, 2) }}</div>
                        </div>
                    </div>
                </div>

                <div style="background: var(--card-bg); padding: 16px; border-radius: 12px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #fee2e2; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-red);">
                            <i class="ri-calendar-line" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-secondary);">Customer Since</div>
                            <div style="font-size: 16px; font-weight: 600;">{{ $customer->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="detail-grid">
                <!-- Customer Info Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-information-line"></i>
                            Customer Information
                        </h3>
                        <span class="badge {{ $customer->is_active ? 'badge-active' : 'badge-inactive' }}">
                            <i class="ri-{{ $customer->is_active ? 'check-line' : 'close-line' }}"></i>
                            {{ $customer->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $customer->name }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">
                            <a href="mailto:{{ $customer->email }}" class="text-gold">
                                {{ $customer->email }}
                                <i class="ri-external-link-line" style="font-size: 12px; margin-left: 4px;"></i>
                            </a>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">
                            @if($customer->phone)
                                <a href="tel:{{ $customer->phone }}" class="text-gold">{{ $customer->phone }}</a>
                            @else
                                <span style="color: var(--text-secondary);">Not provided</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Location</div>
                        <div class="info-value">
                            @if($customer->city || $customer->state || $customer->country)
                                <div>{{ $customer->city ?? '' }}</div>
                                <div>{{ $customer->state ?? '' }} {{ $customer->country ?? '' }}</div>
                            @else
                                <span style="color: var(--text-secondary);">Not provided</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Account Status</div>
                        <div class="info-value">
                            <span class="badge {{ $customer->is_active ? 'badge-active' : 'badge-inactive' }}">
                                <i class="ri-{{ $customer->is_active ? 'check-line' : 'close-line' }}"></i>
                                {{ $customer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email Verification</div>
                        <div class="info-value">
                            @if($customer->email_verified_at)
                                <span class="badge badge-verified">
                                    <i class="ri-check-line"></i> Verified
                                </span>
                                <span style="font-size: 12px; color: var(--text-secondary); margin-left: 8px;">
                                    {{ $customer->email_verified_at->format('M d, Y') }}
                                </span>
                            @else
                                <span class="badge badge-unverified">
                                    <i class="ri-close-line"></i> Unverified
                                </span>
                                <button class="btn btn-sm btn-secondary" style="margin-left: 8px;" onclick="verifyEmail({{ $customer->id }})">
                                    Verify Now
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">
                            <strong>{{ $customer->created_at->format('F j, Y') }}</strong>
                            <span style="font-size: 12px; color: var(--text-secondary); margin-left: 8px;">
                                ({{ $customer->created_at->diffForHumans() }})
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $customer->updated_at->format('F j, Y g:i A') }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Customer Segments</div>
                        <div class="info-value">
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                <span class="segment-badge {{ $segmentClass }}">
                                    <i class="ri-{{ $segment == 'vip' ? 'crown-line' : ($segment == 'premium' ? 'star-line' : 'user-line') }}"></i>
                                    {{ $segmentLabel }}
                                </span>
                                @if($customer->email_verified_at)
                                    <span class="segment-badge" style="background-color: #dbeafe; color: #1e40af;">
                                        <i class="ri-mail-check-line"></i> Email Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ri-bar-chart-2-line"></i>
                            Customer Statistics
                        </h3>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($totalOrders) }}</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">ETB {{ number_format($totalSpent, 0) }}</div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $customer->reviews_count ?? 0 }}</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>

                    <div style="margin-top: 24px;">
                        <div class="info-row">
                            <div class="info-label">Average Order</div>
                            <div class="info-value">
                                <span class="text-gold">ETB {{ number_format($totalOrders > 0 ? $totalSpent / $totalOrders : 0, 2) }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Last Order</div>
                            <div class="info-value">
                                @if($lastOrderDate)
                                    <span class="tooltip">
                                        {{ $lastOrderDate->format('M d, Y') }}
                                        <span class="tooltip-text">{{ $lastOrderDate->diffForHumans() }}</span>
                                    </span>
                                @else
                                    <span style="color: var(--text-secondary);">No orders yet</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Account Age</div>
                            <div class="info-value">
                                <span class="tooltip">
                                    {{ $accountAge }} days
                                    <span class="tooltip-text">{{ $customer->created_at->diffForHumans() }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Lifetime Value</div>
                            <div class="info-value">
                                <span class="text-gold">ETB {{ number_format($totalSpent, 2) }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Orders/Year</div>
                            <div class="info-value">
                                {{ number_format($accountAge > 0 ? ($totalOrders / $accountAge) * 365 : 0, 1) }}
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Timeline -->
                    <div style="margin-top: 24px;">
                        <h4 style="font-size: 14px; margin-bottom: 12px; color: var(--text-secondary);">Recent Activity</h4>
                        <div class="timeline">
                            @if($customer->orders && $customer->orders->isNotEmpty())
                                @foreach($customer->orders->take(3) as $order)
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="ri-shopping-bag-line"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-title">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gold">
                                                    Order #{{ $order->order_number ?? $order->id }}
                                                </a>
                                                <span class="order-status status-{{ $order->status }}" style="margin-left: 8px;">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                            <div class="timeline-time">
                                                {{ $order->created_at->format('M d, Y g:i A') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div style="color: var(--text-secondary); font-size: 13px; text-align: center; padding: 20px;">
                                    No recent activity
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ri-shopping-bag-3-line"></i>
                        Recent Orders
                    </h3>
                    <div>
                        <span style="color: var(--text-secondary); font-size: 14px; margin-right: 16px;">
                            Total: <strong>{{ $totalOrders }}</strong> orders
                        </span>
                        <a href="{{ route('admin.orders') }}?customer={{ $customer->id }}" class="btn btn-secondary btn-sm">
                            View All Orders
                        </a>
                    </div>
                </div>

                @if(isset($customer->orders) && $customer->orders->count() > 0)
                    <div style="overflow-x: auto;">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gold">
                                                #{{ $order->order_number ?? $order->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="tooltip">
                                                {{ $order->created_at->format('M d, Y') }}
                                                <span class="tooltip-text">{{ $order->created_at->format('g:i A') }}</span>
                                            </span>
                                        </td>
                                        <td>{{ $order->items_count ?? $order->items->count() ?? 0 }}</td>
                                        <td class="font-mono">ETB {{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="order-status status-{{ $order->status }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span style="color: var(--text-secondary);">{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 4px;">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm" style="padding: 4px 8px;">
                                                    View
                                                </a>
                                                @if($order->status == 'pending')
                                                    <button class="btn btn-primary btn-sm" style="padding: 4px 8px;" onclick="updateOrderStatus({{ $order->id }}, 'processing')">
                                                        Process
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ri-shopping-bag-3-line"></i>
                        <h3>No Orders Yet</h3>
                        <p>This customer hasn't placed any orders.</p>
                        <a href="{{ route('admin.products') }}" class="btn btn-primary" style="margin-top: 16px;">
                            <i class="ri-shopping-cart-line"></i> Browse Products
                        </a>
                    </div>
                @endif
            </div>

            <!-- Customer Reviews -->
            @if(isset($customer->reviews) && $customer->reviews->count() > 0)
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ri-star-line"></i>
                        Recent Reviews
                    </h3>
                    <a href="{{ route('admin.reviews') }}?customer={{ $customer->id }}" class="btn btn-secondary btn-sm">
                        View All
                    </a>
                </div>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                    @foreach($customer->reviews->take(4) as $review)
                        <div style="padding: 16px; background-color: #f9fafb; border-radius: 8px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <div>
                                    <a href="{{ route('admin.catalog.products.show', $review->product_id) }}" class="text-gold" style="font-weight: 600;">
                                        {{ $review->product->name ?? 'Product' }}
                                    </a>
                                </div>
                                <div style="color: var(--primary-gold);">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="ri-star-fill"></i>
                                        @else
                                            <i class="ri-star-line"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 8px;">
                                "{{ Str::limit($review->comment, 100) }}"
                            </p>
                            <div style="font-size: 11px; color: var(--text-secondary);">
                                {{ $review->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Loading...</div>
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
        });

        // Verify email function
        function verifyEmail(customerId) {
            if (!confirm('Mark this customer\'s email as verified?')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/admin/customers/${customerId}/verify-email`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    alert('Email verified successfully!');
                    location.reload();
                } else {
                    alert('Failed to verify email: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                document.getElementById('loadingOverlay').style.display = 'none';
                console.error('Error:', error);
                alert('An error occurred: ' + error.message);
            });
        }

        // Update order status
        function updateOrderStatus(orderId, status) {
            if (!confirm(`Change order status to ${status}?`)) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/admin/orders/${orderId}/status`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update order status: ' + data.message);
                }
            })
            .catch(error => {
                document.getElementById('loadingOverlay').style.display = 'none';
                alert('An error occurred');
            });
        }

     

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
