<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Order Details') }} - {{ $order->order_number }} — Vendora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #111827;
            --text-gray: #6B7280;
            --bg-light: #F9FAFB;
            --white: #FFFFFF;
            --border: #E5E7EB;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            background: var(--white);
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s;
        }

        .back-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .order-header {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .order-header-top {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .order-number {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .order-date {
            color: var(--text-gray);
            font-size: 14px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending {
            background: rgba(251, 191, 36, 0.1);
            color: var(--warning);
        }

        .status-processing {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 13px;
            color: var(--text-gray);
            font-weight: 500;
        }

        .info-value {
            font-size: 15px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .order-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
        }

        @media (max-width: 968px) {
            .order-content {
                grid-template-columns: 1fr;
            }
        }

        .order-items {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
        }

        .order-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
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
            color: var(--text-gray);
            margin-bottom: 8px;
        }

        .item-price {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .order-sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .sidebar-card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            padding-top: 16px;
            margin-top: 12px;
            border-top: 2px solid var(--border);
        }

        .summary-row.total .value {
            color: var(--primary-gold);
        }

        .address-text {
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-dark);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .payment-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .payment-chapa {
            background: rgba(79, 70, 229, 0.1);
            color: #4F46E5;
        }

        .payment-cod {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">{{ __('Order Details') }}</h1>
            <a href="{{ route('customer.orders') }}" class="back-btn">
                <i class="ri-arrow-left-line"></i>
                {{ __('Back to Orders') }}
            </a>
        </div>
    </div>

    <div class="container">
        <!-- Order Header -->
        <div class="order-header">
            <div class="order-header-top">
                <div>
                    <div class="order-number">{{ $order->order_number }}</div>
                    <div class="order-date">
                        <i class="ri-calendar-line"></i>
                        {{ __('Placed on') }} {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </div>
                </div>
                <div>
                    @php
                        $statusClass = 'status-' . $order->status;
                        $statusIcon = match($order->status) {
                            'pending' => 'ri-time-line',
                            'processing' => 'ri-loader-line',
                            'completed' => 'ri-check-line',
                            'cancelled' => 'ri-close-line',
                            default => 'ri-information-line'
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        <i class="{{ $statusIcon }}"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <div class="order-info-grid">
                <div class="info-item">
                    <span class="info-label">{{ __('Vendor') }}</span>
                    <span class="info-value">
                        <i class="ri-store-line"></i>
                        {{ $order->vendor->business_name ?? $order->vendor->name }}
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">{{ __('Payment Method') }}</span>
                    <span class="info-value">
                        @if($order->payment_method === 'chapa')
                            <span class="payment-badge payment-chapa">
                                <i class="ri-bank-card-line"></i> Chapa
                            </span>
                        @else
                            <span class="payment-badge payment-cod">
                                <i class="ri-hand-coin-line"></i> Cash on Delivery
                            </span>
                        @endif
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">{{ __('Payment Status') }}</span>
                    <span class="info-value">{{ ucfirst($order->payment_status) }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">{{ __('Total Amount') }}</span>
                    <span class="info-value" style="color: var(--primary-gold);">
                        {{ number_format($order->total_amount) }} ETB
                    </span>
                </div>
            </div>
        </div>

        <div class="order-content">
            <!-- Order Items -->
            <div class="order-items">
                <h2 class="section-title">{{ __('Order Items') }}</h2>

                @foreach($order->items as $item)
                <div class="order-item">
                    <img src="{{ $item->product->first_image ? asset('storage/' . $item->product->first_image) : $item->product->placeholder_image }}" 
                         alt="{{ $item->product->name }}" 
                         class="item-image">
                    <div class="item-details">
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-meta">
                            {{ __('Quantity') }}: {{ $item->quantity }} × {{ number_format($item->price) }} ETB
                        </div>
                        <div class="item-price">{{ number_format($item->total) }} ETB</div>
                    </div>
                </div>
                @endforeach

                @if($order->notes)
                <div style="margin-top: 20px; padding: 16px; background: var(--bg-light); border-radius: 8px;">
                    <div style="font-weight: 600; margin-bottom: 8px;">
                        <i class="ri-file-text-line"></i> {{ __('Order Notes') }}
                    </div>
                    <div style="color: var(--text-gray); font-size: 14px;">
                        {{ $order->notes }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="order-sidebar">
                <!-- Order Summary -->
                <div class="sidebar-card">
                    <h3 class="section-title">{{ __('Order Summary') }}</h3>

                    @php
                        $subtotal = $order->items->sum('total');
                        $tax = $subtotal * 0.15;
                        $shipping = 50;
                    @endphp

                    <div class="summary-row">
                        <span>{{ __('Subtotal') }}</span>
                        <span class="value">{{ number_format($subtotal) }} ETB</span>
                    </div>

                    <div class="summary-row">
                        <span>{{ __('Tax (15% VAT)') }}</span>
                        <span class="value">{{ number_format($tax) }} ETB</span>
                    </div>

                    <div class="summary-row">
                        <span>{{ __('Shipping') }}</span>
                        <span class="value">{{ number_format($shipping) }} ETB</span>
                    </div>

                    <div class="summary-row total">
                        <span>{{ __('Total') }}</span>
                        <span class="value">{{ number_format($order->total_amount) }} ETB</span>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="sidebar-card">
                    <h3 class="section-title">{{ __('Shipping Address') }}</h3>
                    <div class="address-text">
                        <i class="ri-map-pin-line" style="color: var(--primary-gold);"></i>
                        {{ $order->shipping_address }}
                    </div>
                </div>

                <!-- Actions -->
                @if($order->status === 'pending')
                <div class="sidebar-card">
                    <h3 class="section-title">{{ __('Actions') }}</h3>
                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to cancel this order?') }}')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">
                            <i class="ri-close-circle-line"></i>
                            {{ __('Cancel Order') }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
