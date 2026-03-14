<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ __('Checkout') }} — Vendora</title>
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--primary-gold);
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

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        @media (max-width: 968px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }
        }

        .checkout-form {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-gold);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-label .required {
            color: var(--danger);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .payment-methods {
            display: grid;
            gap: 12px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-option:hover {
            border-color: var(--primary-gold);
            background: rgba(184, 142, 63, 0.05);
        }

        .payment-option input[type="radio"] {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .payment-option.selected {
            border-color: var(--primary-gold);
            background: rgba(184, 142, 63, 0.1);
        }

        .payment-icon {
            font-size: 24px;
            margin-right: 12px;
            color: var(--primary-gold);
        }

        .payment-details {
            flex: 1;
        }

        .payment-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .payment-desc {
            font-size: 13px;
            color: var(--text-gray);
        }

        .order-summary {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item.total {
            font-size: 18px;
            font-weight: 700;
            padding-top: 16px;
            margin-top: 12px;
            border-top: 2px solid var(--border);
        }

        .summary-item.total .value {
            color: var(--primary-gold);
        }

        .cart-items-preview {
            margin-bottom: 20px;
        }

        .cart-item-mini {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .cart-item-mini:last-child {
            border-bottom: none;
        }

        .item-mini-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
        }

        .item-mini-details {
            flex: 1;
        }

        .item-mini-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .item-mini-meta {
            font-size: 13px;
            color: var(--text-gray);
        }

        .item-mini-price {
            font-weight: 600;
            color: var(--primary-gold);
        }

        .place-order-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary-gold);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .place-order-btn:hover:not(:disabled) {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .place-order-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top-color: var(--white);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-error {
            background: #fee2e2;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 8px;
            margin-top: 16px;
            font-size: 14px;
            color: var(--success);
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="ri-secure-payment-line"></i>
                {{ __('Checkout') }}
            </h1>
            <a href="{{ route('customer.cart.index') }}" class="back-btn">
                <i class="ri-arrow-left-line"></i>
                {{ __('Back to Cart') }}
            </a>
        </div>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i>
                {{ session('error') }}
            </div>
        @endif

        <form id="checkoutForm" class="checkout-layout">
            <div class="checkout-form">
                <!-- Shipping Information -->
                <div class="section-title">
                    <i class="ri-map-pin-line"></i>
                    {{ __('Shipping Information') }}
                </div>

                <div class="form-group">
                    <label class="form-label">
                        {{ __('Full Address') }} <span class="required">*</span>
                    </label>
                    <input type="text" name="shipping_address" class="form-input" 
                           value="{{ $savedAddresses['shipping'] }}" 
                           placeholder="Street address, building, apartment" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            {{ __('City') }} <span class="required">*</span>
                        </label>
                        <input type="text" name="shipping_city" class="form-input" 
                               value="{{ $savedAddresses['city'] }}" 
                               placeholder="Jimma" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            {{ __('State/Region') }} <span class="required">*</span>
                        </label>
                        <input type="text" name="shipping_state" class="form-input" 
                               value="{{ $savedAddresses['state'] }}" 
                               placeholder="Oromia" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        {{ __('Phone Number') }} <span class="required">*</span>
                    </label>
                    <input type="tel" name="phone" class="form-input" 
                           value="{{ $savedAddresses['phone'] }}" 
                           placeholder="+251 912 345 678" required>
                </div>

                <!-- Payment Method -->
                <div class="section-title" style="margin-top: 32px;">
                    <i class="ri-bank-card-line"></i>
                    {{ __('Payment Method') }}
                </div>

                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cash_on_delivery" checked>
                        <i class="ri-hand-coin-line payment-icon"></i>
                        <div class="payment-details">
                            <div class="payment-name">{{ __('Cash on Delivery') }}</div>
                            <div class="payment-desc">{{ __('Pay when you receive your order') }}</div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="chapa">
                        <i class="ri-bank-card-line payment-icon"></i>
                        <div class="payment-details">
                            <div class="payment-name">{{ __('Chapa Payment') }}</div>
                            <div class="payment-desc">{{ __('Pay securely online with Chapa (Cards, Mobile Money, Bank Transfer)') }}</div>
                        </div>
                    </label>
                </div>

                <!-- Order Notes -->
                <div class="section-title" style="margin-top: 32px;">
                    <i class="ri-file-text-line"></i>
                    {{ __('Order Notes') }} <span style="font-weight: 400; font-size: 14px; color: var(--text-gray);">({{ __('Optional') }})</span>
                </div>

                <div class="form-group">
                    <textarea name="notes" class="form-textarea" 
                              placeholder="Any special instructions for your order..."></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2 class="section-title">
                    <i class="ri-shopping-bag-line"></i>
                    {{ __('Order Summary') }}
                </h2>

                <div class="cart-items-preview">
                    @foreach($cartItems as $item)
                    <div class="cart-item-mini">
                        <img src="{{ $item->product->first_image ? asset('storage/' . $item->product->first_image) : $item->product->placeholder_image }}" 
                             alt="{{ $item->product->name }}" 
                             class="item-mini-image">
                        <div class="item-mini-details">
                            <div class="item-mini-name">{{ $item->product->name }}</div>
                            <div class="item-mini-meta">Qty: {{ $item->quantity }} × {{ number_format($item->product->price) }} ETB</div>
                        </div>
                        <div class="item-mini-price">{{ number_format($item->product->price * $item->quantity) }} ETB</div>
                    </div>
                    @endforeach
                </div>

                <div class="summary-item">
                    <span>{{ __('Subtotal') }}</span>
                    <span class="value">{{ number_format($subtotal) }} ETB</span>
                </div>

                <div class="summary-item">
                    <span>{{ __('Tax (15% VAT)') }}</span>
                    <span class="value">{{ number_format($tax) }} ETB</span>
                </div>

                <div class="summary-item">
                    <span>{{ __('Shipping') }}</span>
                    <span class="value">{{ number_format($shippingFee) }} ETB</span>
                </div>

                <div class="summary-item total">
                    <span>{{ __('Total') }}</span>
                    <span class="value">{{ number_format($total) }} ETB</span>
                </div>

                <button type="submit" class="place-order-btn" id="placeOrderBtn">
                    <i class="ri-check-line"></i>
                    {{ __('Place Order') }}
                </button>

                <div class="secure-badge">
                    <i class="ri-shield-check-line"></i>
                    {{ __('Secure checkout - Your information is protected') }}
                </div>
            </div>
        </form>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Form submission
        document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const btn = document.getElementById('placeOrderBtn');
            const originalText = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i> Processing...';
            document.getElementById('loadingOverlay').style.display = 'flex';

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/customer/checkout/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    // Redirect to success page
                    window.location.href = result.redirect;
                } else {
                    alert(result.message || 'Failed to place order. Please try again.');
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    document.getElementById('loadingOverlay').style.display = 'none';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                btn.disabled = false;
                btn.innerHTML = originalText;
                document.getElementById('loadingOverlay').style.display = 'none';
            }
        });
    </script>
</body>
</html>
