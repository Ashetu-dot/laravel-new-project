<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Order Successful') }} — Vendora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #B88E3F;
            --success: #10b981;
            --text-dark: #111827;
            --text-gray: #6B7280;
            --bg-light: #F9FAFB;
            --white: #FFFFFF;
            --border: #E5E7EB;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            max-width: 800px;
            width: 100%;
            background: var(--white);
            border-radius: 16px;
            padding: 48px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: scaleIn 0.5s ease;
        }

        .success-icon i {
            font-size: 48px;
            color: var(--white);
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        h1 {
            font-size: 32px;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .success-message {
            font-size: 16px;
            color: var(--text-gray);
            margin-bottom: 32px;
        }

        .order-cards {
            display: grid;
            gap: 16px;
            margin-bottom: 32px;
            text-align: left;
        }

        .order-card {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .order-number {
            font-weight: 700;
            font-size: 18px;
            color: var(--text-dark);
        }

        .order-total {
            font-weight: 700;
            font-size: 20px;
            color: var(--primary-gold);
        }

        .order-items {
            display: grid;
            gap: 12px;
        }

        .order-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: var(--white);
            border-radius: 8px;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
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
        }

        .item-price {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: var(--primary-gold);
            color: var(--white);
        }

        .btn-primary:hover {
            background: #9c7832;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
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

        .info-box {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
        }

        .info-box i {
            font-size: 24px;
            color: var(--success);
        }

        .info-box-text {
            flex: 1;
        }

        .info-box-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .info-box-desc {
            font-size: 14px;
            color: var(--text-gray);
        }

        @media (max-width: 768px) {
            .success-container {
                padding: 32px 24px;
            }

            h1 {
                font-size: 24px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="ri-check-line"></i>
        </div>

        <h1>{{ __('Order Placed Successfully!') }}</h1>
        <p class="success-message">
            {{ __('Thank you for your order. We\'ve received your order and will process it shortly.') }}
        </p>

        <div class="info-box">
            <i class="ri-information-line"></i>
            <div class="info-box-text">
                <div class="info-box-title">{{ __('What happens next?') }}</div>
                <div class="info-box-desc">
                    @if($orders->first()->payment_method === 'chapa')
                        {{ __('Your order is confirmed. For Chapa payment, you will receive payment instructions via email or SMS. The vendor will prepare your order once payment is confirmed.') }}
                    @else
                        {{ __('You will receive an email confirmation shortly. The vendor will prepare your order and contact you for delivery. Payment will be collected upon delivery.') }}
                    @endif
                </div>
            </div>
        </div>

        <div class="order-cards">
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">{{ $order->order_number }}</div>
                        <div style="font-size: 14px; color: var(--text-gray); margin-top: 4px;">
                            <i class="ri-store-line"></i> {{ $order->vendor->business_name ?? $order->vendor->name }}
                        </div>
                        <div style="font-size: 13px; margin-top: 4px;">
                            @if($order->payment_method === 'chapa')
                                <span style="background: #4F46E5; color: white; padding: 4px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="ri-bank-card-line"></i> Chapa Payment
                                </span>
                            @else
                                <span style="background: var(--success); color: white; padding: 4px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="ri-hand-coin-line"></i> Cash on Delivery
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="order-total">{{ number_format($order->total_amount) }} ETB</div>
                </div>

                <div class="order-items">
                    @foreach($order->items as $item)
                    <div class="order-item">
                        <img src="{{ $item->product->first_image ? asset('storage/' . $item->product->first_image) : $item->product->placeholder_image }}" 
                             alt="{{ $item->product->name }}" 
                             class="item-image">
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <div class="item-meta">{{ __('Quantity') }}: {{ $item->quantity }} × {{ number_format($item->price) }} ETB</div>
                        </div>
                        <div class="item-price">{{ number_format($item->total) }} ETB</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="action-buttons">
            <a href="{{ route('customer.orders') }}" class="btn btn-primary">
                <i class="ri-file-list-line"></i>
                {{ __('View My Orders') }}
            </a>
            <a href="{{ route('search.results') }}" class="btn btn-secondary">
                <i class="ri-shopping-bag-line"></i>
                {{ __('Continue Shopping') }}
            </a>
        </div>
    </div>
</body>
</html>
