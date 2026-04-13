<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ __('Shopping Cart') }} — Vendora</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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

        /* Header */
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

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #ecfdf5;
            color: var(--success);
            border: 1px solid var(--success);
        }

        .alert-error {
            background: #fee2e2;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        /* Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 30px;
        }

        @media (max-width: 968px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Cart Items */
        .cart-items {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid var(--border);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--bg-light);
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .item-vendor {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .item-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .qty-input {
            width: 60px;
            height: 32px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .item-subtotal {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .remove-btn {
            padding: 8px 16px;
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .remove-btn:hover {
            background: var(--danger);
            color: var(--white);
        }

        /* Cart Summary */
        .cart-summary {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            font-size: 15px;
        }

        .summary-row.total {
            border-top: 2px solid var(--border);
            margin-top: 12px;
            padding-top: 16px;
            font-size: 18px;
            font-weight: 700;
        }

        .summary-row .label {
            color: var(--text-gray);
        }

        .summary-row .value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-row.total .value {
            color: var(--primary-gold);
        }

        .checkout-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary-gold);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .checkout-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .continue-shopping {
            width: 100%;
            padding: 12px;
            background: transparent;
            color: var(--text-dark);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 12px;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .continue-shopping:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 12px;
        }

        .empty-cart i {
            font-size: 80px;
            color: var(--text-gray);
            margin-bottom: 20px;
        }

        .empty-cart h2 {
            font-size: 24px;
            margin-bottom: 12px;
        }

        .empty-cart p {
            color: var(--text-gray);
            margin-bottom: 24px;
        }

        .shop-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: var(--primary-gold);
            color: var(--white);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .shop-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Loading Overlay */
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

        /* Responsive */
        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 12px;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }

            .item-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .page-title {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="ri-shopping-cart-line"></i>
                {{ __('Shopping Cart') }}
            </h1>
            <a href="{{ route('search.results') }}" class="back-btn">
                <i class="ri-arrow-left-line"></i>
                {{ __('Continue Shopping') }}
            </a>
        </div>
    </div>

    <div class="container">
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

        @if($cartItems->count() > 0)
            <div class="cart-layout">
                <!-- Cart Items -->
                <div class="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item" id="cart-item-{{ $item->id }}">
                            <img src="{{ $item->product->first_image ? asset('storage/' . $item->product->first_image) : $item->product->placeholder_image }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="item-image">
                            
                            <div class="item-details">
                                <div class="item-name">{{ $item->product->name }}</div>
                                <div class="item-vendor">
                                    <i class="ri-store-line"></i>
                                    {{ $item->product->vendor->business_name ?? $item->product->vendor->name }}
                                </div>
                                <div class="item-price">{{ number_format($item->product->price) }} ETB</div>
                                
                                <div class="quantity-controls">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input type="number" 
                                           class="qty-input" 
                                           value="{{ $item->quantity }}" 
                                           min="1" 
                                           max="{{ $item->product->stock ?? 100 }}"
                                           onchange="updateQuantity({{ $item->id }}, this.value)">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="item-actions">
                                <div class="item-subtotal" id="subtotal-{{ $item->id }}">
                                    {{ number_format($item->product->price * $item->quantity) }} ETB
                                </div>
                                <button class="remove-btn" onclick="removeItem({{ $item->id }})">
                                    <i class="ri-delete-bin-line"></i>
                                    {{ __('Remove') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2 class="summary-title">{{ __('Order Summary') }}</h2>
                    
                    <div class="summary-row">
                        <span class="label">{{ __('Subtotal') }}</span>
                        <span class="value" id="summary-subtotal">{{ number_format($subtotal) }} ETB</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="label">{{ __('Tax (15% VAT)') }}</span>
                        <span class="value" id="summary-tax">{{ number_format($tax) }} ETB</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="label">{{ __('Shipping') }}</span>
                        <span class="value">{{ __('Calculated at checkout') }}</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span class="label">{{ __('Total') }}</span>
                        <span class="value" id="summary-total">{{ number_format($total) }} ETB</span>
                    </div>

                    <button class="checkout-btn" onclick="proceedToCheckout()">
                        <i class="ri-secure-payment-line"></i>
                        {{ __('Proceed to Checkout') }}
                    </button>

                    <a href="{{ route('search.results') }}" class="continue-shopping">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="ri-shopping-cart-line"></i>
                <h2>{{ __('Your cart is empty') }}</h2>
                <p>{{ __('Add some products to your cart and they will appear here.') }}</p>
                <a href="{{ route('search.results') }}" class="shop-btn">
                    <i class="ri-shopping-bag-line"></i>
                    {{ __('Start Shopping') }}
                </a>
            </div>
        @endif
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Update quantity
        function updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/customer/cart/${cartId}/update`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to update quantity');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the cart');
            })
            .finally(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        }

        // Remove item
        function removeItem(cartId) {
            if (!confirm('{{ __("Are you sure you want to remove this item?") }}')) return;

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch(`/customer/cart/${cartId}/remove`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to remove item');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while removing the item');
            })
            .finally(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        }

        // Proceed to checkout
        function proceedToCheckout() {
            window.location.href = '{{ route("customer.checkout.index") }}';
        }
    </script>
</body>
</html>
