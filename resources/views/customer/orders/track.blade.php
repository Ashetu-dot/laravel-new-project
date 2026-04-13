<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order #{{ $order->order_number }} - Vendora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: #f3f4f6;
            transform: translateX(-4px);
        }

        .order-number {
            font-size: 28px;
            font-weight: 800;
            color: #1f2937;
        }

        .order-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-shipped { background: #e0e7ff; color: #4338ca; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 600;
        }

        .tracking-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .tracking-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 40px;
            text-align: center;
        }

        .tracking-steps {
            position: relative;
        }

        .tracking-step {
            display: flex;
            gap: 24px;
            position: relative;
            padding-bottom: 48px;
        }

        .tracking-step:last-child {
            padding-bottom: 0;
        }

        .tracking-step::before {
            content: '';
            position: absolute;
            left: 23px;
            top: 48px;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }

        .tracking-step:last-child::before {
            display: none;
        }

        .tracking-step.completed::before {
            background: linear-gradient(180deg, #10b981 0%, #e5e7eb 100%);
        }

        .step-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            transition: all 0.3s;
        }

        .tracking-step.completed .step-icon {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .tracking-step.active .step-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            animation: pulse 2s infinite;
        }

        .tracking-step.pending .step-icon {
            background: #f3f4f6;
            color: #9ca3af;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            }
            50% {
                box-shadow: 0 4px 20px rgba(102, 126, 234, 0.6);
            }
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .step-date {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .step-description {
            font-size: 14px;
            color: #9ca3af;
            line-height: 1.6;
        }

        .tracking-step.pending .step-title,
        .tracking-step.pending .step-date {
            color: #9ca3af;
        }

        .order-items {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .items-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s;
        }

        .item:hover {
            background: #f9fafb;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .item-meta {
            font-size: 14px;
            color: #6b7280;
        }

        .item-price {
            text-align: right;
        }

        .item-quantity {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .item-total {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            .header {
                padding: 20px;
            }

            .order-number {
                font-size: 22px;
            }

            .tracking-card {
                padding: 24px;
            }

            .tracking-title {
                font-size: 20px;
                margin-bottom: 32px;
            }

            .tracking-step {
                gap: 16px;
                padding-bottom: 40px;
            }

            .step-icon {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .tracking-step::before {
                left: 19px;
            }

            .step-title {
                font-size: 16px;
            }

            .order-items {
                padding: 20px;
            }

            .item {
                flex-direction: column;
            }

            .item-price {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <a href="{{ route('customer.orders') }}" class="back-btn">
                    <i class="ri-arrow-left-line"></i> Back to Orders
                </a>
                <span class="order-status status-{{ strtolower($order->status) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            
            <h1 class="order-number">Order #{{ $order->order_number }}</h1>
            
            <div class="order-info">
                <div class="info-item">
                    <span class="info-label">Order Date</span>
                    <span class="info-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total Amount</span>
                    <span class="info-value">{{ number_format($order->total_amount, 2) }} ETB</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">{{ ucfirst($order->payment_method) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Vendor</span>
                    <span class="info-value">{{ $order->vendor->business_name ?? $order->vendor->name ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Tracking Steps -->
        <div class="tracking-card">
            <h2 class="tracking-title">Order Tracking</h2>
            
            <div class="tracking-steps">
                @foreach($trackingSteps as $key => $step)
                <div class="tracking-step {{ $step['completed'] ? 'completed' : ($order->status === $key ? 'active' : 'pending') }}">
                    <div class="step-icon">
                        @if($step['completed'])
                            <i class="ri-check-line"></i>
                        @else
                            <i class="{{ $step['icon'] }}"></i>
                        @endif
                    </div>
                    <div class="step-content">
                        <div class="step-title">{{ $step['label'] }}</div>
                        @if($step['date'])
                            <div class="step-date">{{ \Carbon\Carbon::parse($step['date'])->format('M d, Y - h:i A') }}</div>
                        @endif
                        <div class="step-description">{{ $step['description'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <h3 class="items-title">Order Items ({{ $order->items->count() }})</h3>
            
            @foreach($order->items as $item)
            <div class="item">
                <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : asset('images/placeholder.png') }}" 
                     alt="{{ $item->product_name }}" 
                     class="item-image">
                <div class="item-details">
                    <div class="item-name">{{ $item->product_name }}</div>
                    <div class="item-meta">{{ number_format($item->price, 2) }} ETB each</div>
                </div>
                <div class="item-price">
                    <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                    <div class="item-total">{{ number_format($item->price * $item->quantity, 2) }} ETB</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
