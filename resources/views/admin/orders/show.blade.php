<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Order #{{ $order->id }} - Vendora Admin | Jimma, Ethiopia</title>
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
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
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
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary-gold);
        }

        .breadcrumb i {
            font-size: 12px;
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

        /* Order Content */
        .order-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .order-container {
                padding: 24px 16px;
            }
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
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

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-completed, .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-delivered {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled, .status-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-refunded {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .order-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .order-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: var(--text-secondary);
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }

        .customer-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .customer-details h4 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .customer-details p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .order-items {
            margin-top: 16px;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-image i {
            font-size: 24px;
            color: var(--text-secondary);
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .item-meta {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .item-price {
            text-align: right;
        }

        .item-quantity {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .item-total {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .order-summary {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
            font-weight: 600;
            font-size: 16px;
        }

        .payment-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .payment-chapa {
            background-color: #e0f2fe;
            color: #0277bd;
        }

        .payment-cod {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
        }

        .btn-secondary {
            background-color: var(--card-bg);
            color: var(--text-primary);
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

        .address-block {
            background-color: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .address-block h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .address-block p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
            margin: 0;
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

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .toast {
            min-width: 300px;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 4px solid;
        }

        .toast.success {
            border-left-color: #10b981;
        }

        .toast.error {
            border-left-color: #ef4444;
        }

        .toast.warning {
            border-left-color: #f59e0b;
        }

        .toast.info {
            border-left-color: #3b82f6;
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .toast.success .toast-icon {
            background: #d1fae5;
            color: #10b981;
        }

        .toast.error .toast-icon {
            background: #fee2e2;
            color: #ef4444;
        }

        .toast.warning .toast-icon {
            background: #fef3c7;
            color: #f59e0b;
        }

        .toast.info .toast-icon {
            background: #dbeafe;
            color: #3b82f6;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.4;
        }

        .toast-close {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f3f4f6;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 14px;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .toast-close:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast.hiding {
            animation: slideOutRight 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 640px) {
            .toast-container {
                top: 10px;
                right: 10px;
                left: 10px;
            }

            .toast {
                min-width: auto;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Sidebar -->
    @include('partials.admin-sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <i class="ri-menu-line menu-toggle" onclick="toggleSidebar()"></i>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <a href="{{ route('admin.orders') }}">Orders</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>Order #{{ $order->id }}</span>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-message-3-line"></i>
                </a>
            </div>
        </header>

        <!-- Order Content -->
        <div class="order-container">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="ri-shopping-bag-3-line"></i>
                    Order #{{ $order->id }}
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </h1>
            </div>

            <div class="order-grid">
                <!-- Order Details -->
                <div class="order-main">
                    <!-- Customer Information -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-user-3-line"></i>
                                Customer Information
                            </h3>
                        </div>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                @if($order->user->profile_image)
                                    <img src="{{ asset('storage/' . $order->user->profile_image) }}" alt="{{ $order->user->name }}">
                                @else
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                @endif
                            </div>
                            <div class="customer-details">
                                <h4>{{ $order->user->name }}</h4>
                                <p>{{ $order->user->email }}</p>
                                @if($order->user->phone)
                                    <p>{{ $order->user->phone }}</p>
                                @endif
                            </div>
                        </div>

                        @if($order->shipping_address)
                            <div class="address-block">
                                <h5>Shipping Address</h5>
                                <p>{{ $order->shipping_address }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-shopping-cart-line"></i>
                                Order Items ({{ $order->items->count() }})
                            </h3>
                        </div>
                        <div class="order-items">
                            @foreach($order->items as $item)
                                <div class="item-row">
                                    <div class="item-image">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                        @else
                                            <i class="ri-image-line"></i>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">
                                            {{ $item->product ? $item->product->name : 'Product Not Found' }}
                                        </div>
                                        <div class="item-meta">
                                            @if($item->product && $item->product->vendor)
                                                Vendor: {{ $item->product->vendor->business_name ?? $item->product->vendor->name }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item-price">
                                        <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                                        <div class="item-total">{{ number_format($item->total, 2) }} ETB</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="order-summary">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span>{{ number_format($order->subtotal, 2) }} ETB</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (15% VAT):</span>
                                <span>{{ number_format($order->tax, 2) }} ETB</span>
                            </div>
                            @if($order->shipping_cost > 0)
                                <div class="summary-row">
                                    <span>Shipping:</span>
                                    <span>{{ number_format($order->shipping_cost, 2) }} ETB</span>
                                </div>
                            @endif
                            <div class="summary-row">
                                <span>Total:</span>
                                <span>{{ number_format($order->total, 2) }} ETB</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="order-sidebar">
                    <!-- Order Status -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-information-line"></i>
                                Order Details
                            </h3>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Order ID:</span>
                            <span class="info-value">#{{ $order->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Payment Method:</span>
                            <span class="info-value">
                                <span class="payment-badge payment-{{ strtolower(str_replace(' ', '-', $order->payment_method)) }}">
                                    {{ $order->payment_method }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Payment Status:</span>
                            <span class="info-value">
                                <span class="status-badge status-{{ strtolower($order->payment_status) }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Order Date:</span>
                            <span class="info-value">{{ $order->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        @if($order->updated_at != $order->created_at)
                            <div class="info-row">
                                <span class="info-label">Last Updated:</span>
                                <span class="info-value">{{ $order->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Order Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ri-settings-4-line"></i>
                                Actions
                            </h3>
                        </div>
                        <div class="action-buttons">
                            @if($order->status === 'pending')
                                <button class="btn btn-success" onclick="updateOrderStatus('processing')">
                                    <i class="ri-play-circle-line"></i>
                                    Process Order
                                </button>
                                <button class="btn btn-danger" onclick="updateOrderStatus('cancelled')">
                                    <i class="ri-close-circle-line"></i>
                                    Cancel Order
                                </button>
                            @elseif($order->status === 'processing')
                                <button class="btn btn-success" onclick="updateOrderStatus('completed')">
                                    <i class="ri-check-circle-line"></i>
                                    Mark Completed
                                </button>
                                <button class="btn btn-primary" onclick="updateOrderStatus('delivered')">
                                    <i class="ri-truck-line"></i>
                                    Mark Delivered
                                </button>
                            @endif

                            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
                                <i class="ri-arrow-left-line"></i>
                                Back to Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Display session flash messages as toasts
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if(session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif

            @if(session('warning'))
                showToast('{{ session('warning') }}', 'warning');
            @endif

            @if(session('info'))
                showToast('{{ session('info') }}', 'info');
            @endif
        });

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Toast Notification Function
        function showToast(message, type = 'success', title = '') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const icons = {
                success: 'ri-check-line',
                error: 'ri-close-line',
                warning: 'ri-alert-line',
                info: 'ri-information-line'
            };

            const titles = {
                success: title || 'Success',
                error: title || 'Error',
                warning: title || 'Warning',
                info: title || 'Info'
            };

            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="${icons[type]}"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">${titles[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="closeToast(this)">
                    <i class="ri-close-line"></i>
                </button>
            `;

            container.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                closeToast(toast.querySelector('.toast-close'));
            }, 5000);
        }

        function closeToast(button) {
            const toast = button.closest('.toast');
            toast.classList.add('hiding');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        function updateOrderStatus(status) {
            console.log('Updating order status to:', status);
            console.log('Order ID:', '{{ $order->id }}');
            console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
            
            // Show loading toast
            showToast('Updating order status...', 'info', 'Processing');

            const url = `/admin/orders/{{ $order->id }}/status`;
            console.log('Request URL:', url);

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);
                
                // Parse JSON regardless of status code
                return response.json().then(data => {
                    console.log('Response data:', data);
                    
                    if (!response.ok) {
                        throw new Error(data.message || `HTTP error! status: ${response.status}`);
                    }
                    return data;
                });
            })
            .then(data => {
                console.log('Success data:', data);
                
                if (data.success) {
                    showToast(data.message || 'Order status updated successfully!', 'success', 'Success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to update order status', 'error', 'Error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                console.error('Error message:', error.message);
                showToast(error.message || 'Failed to update order status. Please try again.', 'error', 'Error');
            });
        }

        // Mobile sidebar toggle
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const menuToggle = document.querySelector('.menu-toggle');

                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
