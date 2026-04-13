<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Vendors - Vendora Marketplace | Jimma, Ethiopia</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --white: #ffffff;
            --light-gray: #f8fafc;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-lg: 16px;
            --transition: all 0.3s ease;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --chapa: #4F46E5;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #f1f5f9;
            --text-gray: #cbd5e1;
            --border-color: #334155;
            --white: #1f2937;
            --light-gray: #111827;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 30px rgba(212, 165, 90, 0.2);
            --chapa: #6366F1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Navbar */
        .navbar {
            background: var(--white);
            padding: 16px 80px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .brand {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .brand:hover {
            transform: scale(1.05);
        }

        .brand i {
            font-size: 32px;
        }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 20px;
        }

        .theme-toggle:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .page-header h1 {
            font-size: 42px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .page-header h1 span {
            color: var(--primary-gold);
            position: relative;
            display: inline-block;
        }

        .page-header h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
        }

        .page-header p {
            color: var(--text-gray);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        .selected-count {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 20px;
            background: var(--primary-gold);
            color: white;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Table Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .view-options {
            display: flex;
            gap: 10px;
            background: var(--white);
            padding: 5px;
            border-radius: 40px;
            border: 1px solid var(--border-color);
        }

        .view-btn {
            padding: 8px 20px;
            border: none;
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            border-radius: 30px;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .view-btn:hover {
            color: var(--primary-gold);
        }

        .view-btn.active {
            background: var(--primary-gold);
            color: white;
        }

        .export-btn {
            padding: 10px 24px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 40px;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .export-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Compare Table */
        .compare-table {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: background-color 0.3s;
        }

        .compare-row {
            display: grid;
            grid-template-columns: 220px repeat(auto-fit, minmax(180px, 1fr));
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s;
        }

        .compare-row:last-child {
            border-bottom: none;
        }

        .compare-row:hover {
            background-color: rgba(184, 142, 63, 0.02);
        }

        .compare-cell {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            word-break: break-word;
        }

        .compare-cell.label {
            font-weight: 600;
            color: var(--text-dark);
            background: rgba(184, 142, 63, 0.05);
            justify-content: flex-start;
            font-size: 15px;
        }

        /* Vendor Header */
        .vendor-header {
            flex-direction: column;
            gap: 12px;
            padding: 30px 20px;
        }

        .vendor-image-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .vendor-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-gold);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .vendor-image:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-hover);
        }

        .verified-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-gold);
            color: white;
            padding: 6px;
            border-radius: 50%;
            font-size: 14px;
            border: 2px solid var(--white);
        }

        .vendor-name {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.3;
        }

        .vendor-link {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .vendor-link:hover {
            color: var(--primary-gold);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .view-shop-btn {
            background: var(--primary-gold);
            color: white;
            border: none;
        }

        .view-shop-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .remove-btn {
            background: transparent;
            color: var(--error);
            border: 1px solid var(--error);
        }

        .remove-btn:hover {
            background: var(--error);
            color: white;
        }

        /* Rating Stars */
        .rating {
            color: #f59e0b;
            display: inline-flex;
            gap: 2px;
        }

        .rating-value {
            margin-left: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Value Badge */
        .value-badge {
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-gold);
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
        }

        .value-large {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .text-muted {
            color: var(--text-gray);
            font-style: italic;
        }

        /* Products List */
        .products-list {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .product-item {
            padding: 8px 0;
            border-bottom: 1px dashed var(--border-color);
            font-size: 13px;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-name {
            font-weight: 500;
            color: var(--text-dark);
        }

        .product-price {
            color: var(--primary-gold);
            font-weight: 600;
            margin-left: 8px;
        }

        /* Tags */
        .feature-tag {
            display: inline-block;
            padding: 4px 12px;
            background: var(--light-gray);
            border-radius: 30px;
            font-size: 12px;
            color: var(--text-gray);
            margin: 2px;
        }

        .feature-tag.active {
            background: var(--primary-gold);
            color: white;
        }

        /* Payment Method Tags - Specific for Cash and Chapa */
        .payment-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            margin: 2px;
            transition: var(--transition);
        }

        .payment-tag.cash {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
        }

        .payment-tag.cash:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.4);
        }

        .payment-tag.chapa {
            background: linear-gradient(135deg, var(--chapa), #818CF8);
            color: white;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
        }

        .payment-tag.chapa:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        /* Chapa Badge */
        .chapa-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #4F46E5, #818CF8);
            color: white;
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
        }

        /* Back Button */
        .back-section {
            text-align: center;
            margin-top: 40px;
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: var(--primary-gold);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.3);
        }

        .back-btn.outline {
            background: transparent;
            color: var(--primary-gold);
            border: 2px solid var(--primary-gold);
        }

        .back-btn.outline:hover {
            background: var(--primary-gold);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 80px;
            color: var(--primary-gold);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .empty-state p {
            color: var(--text-gray);
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-color);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-hover);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left-color: var(--success);
        }

        .toast.error {
            border-left-color: var(--error);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast.success .toast-icon {
            color: var(--success);
        }

        .toast.error .toast-icon {
            color: var(--error);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-gray);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-gray);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .navbar { padding: 16px 40px; }
            
            .compare-row {
                grid-template-columns: 180px repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .page-header h1 { font-size: 36px; }
            
            .vendor-image-wrapper { width: 100px; height: 100px; }
            .vendor-name { font-size: 18px; }
        }

        @media (max-width: 768px) {
            .navbar { 
                padding: 16px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .page-header h1 { font-size: 32px; }

            .compare-table {
                overflow-x: auto;
            }

            .compare-row {
                min-width: 800px;
            }

            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .view-options {
                justify-content: center;
            }

            .export-btn {
                justify-content: center;
            }

            .back-section {
                flex-direction: column;
                align-items: stretch;
            }

            .back-btn {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .page-header h1 { font-size: 28px; }
            
            .ethiopia-badge { font-size: 11px; padding: 4px 12px; }
            
            .vendor-image-wrapper { width: 80px; height: 80px; }
            
            .vendor-name { font-size: 16px; }
            
            .action-buttons {
                flex-direction: column;
            }
        }

        /* Print Styles */
        @media print {
            .navbar, .table-controls, .back-section, .theme-toggle, .toast {
                display: none !important;
            }

            .compare-table {
                box-shadow: none;
                border: 1px solid #000;
            }

            .vendor-image {
                border: 2px solid #000;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
        </a>
        <div class="nav-controls">
            
            <button class="theme-toggle" id="themeToggle" title="{{ __('Toggle theme') }}">
                <i class="ri-moon-line"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="page-header">
            <h1>{{ __('Compare') }} <span>{{ __('Vendors') }}</span></h1>
            <p>{{ __('Compare features side by side to make the best choice for your needs') }}</p>
            @if(isset($comparisonData) && count($comparisonData) > 0)
            <div class="selected-count">
                <i class="ri-checkbox-circle-line"></i>
                {{ count($comparisonData) }} {{ __('vendors selected') }}
            </div>
            @endif
        </div>

        @if(isset($comparisonData) && count($comparisonData) > 0)
        <!-- Table Controls -->
        <div class="table-controls">
            <div class="view-options">
                <button class="view-btn active" onclick="setView('table')">
                    <i class="ri-table-line"></i> {{ __('Table View') }}
                </button>
                <button class="view-btn" onclick="setView('card')">
                    <i class="ri-layout-grid-line"></i> {{ __('Card View') }}
                </button>
            </div>
            <button class="export-btn" onclick="exportComparison()">
                <i class="ri-download-line"></i> {{ __('Export Comparison') }}
            </button>
        </div>

        <!-- Compare Table -->
        <div class="compare-table" id="compareTable">
            <!-- Vendor Headers Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Vendor') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell vendor-header">
                    <div class="vendor-image-wrapper">
                        <img src="{{ $vendor['image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($vendor['name']) . '&background=B88E3F&color=fff&size=200' }}"
                             alt="{{ $vendor['name'] }}"
                             class="vendor-image"
                             loading="lazy"
                             onerror="this.src='https://via.placeholder.com/200x200?text=' + encodeURIComponent('{{ $vendor['name'] }}');">
                        @if($vendor['verified'] ?? false)
                        <span class="verified-badge" title="{{ __('Verified Vendor') }}">
                            <i class="ri-verified-badge-fill"></i>
                        </span>
                        @endif
                    </div>
                    <div class="vendor-name">
                        <a href="{{ route('vendor.show', $vendor['id']) }}" class="vendor-link">
                            {{ $vendor['name'] }}
                        </a>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('vendor.show', $vendor['id']) }}" class="action-btn view-shop-btn">
                            <i class="ri-store-line"></i> {{ __('View') }}
                        </a>
                        <button class="action-btn remove-btn" onclick="removeFromComparison({{ $vendor['id'] }})">
                            <i class="ri-delete-bin-line"></i> {{ __('Remove') }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Category Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Category') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    <span class="feature-tag">{{ $vendor['category'] ?? __('General Store') }}</span>
                </div>
                @endforeach
            </div>

            <!-- Location Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Location') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    <i class="ri-map-pin-2-line" style="color: var(--primary-gold); margin-right: 5px;"></i>
                    {{ $vendor['city'] ?? '' }}{{ ($vendor['city'] ?? false) && ($vendor['state'] ?? false) ? ', ' : '' }}{{ $vendor['state'] ?? 'Jimma' }}
                </div>
                @endforeach
            </div>

            <!-- Rating Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Rating') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(($vendor['rating'] ?? 0) > 0)
                        <span class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($vendor['rating']))
                                    <i class="ri-star-fill"></i>
                                @elseif($i - 0.5 <= $vendor['rating'])
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="rating-value">{{ number_format($vendor['rating'], 1) }}</span>
                    @else
                        <span class="text-muted">{{ __('No reviews') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Reviews Count Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Reviews') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    <span class="value-badge">
                        <i class="ri-chat-3-line"></i>
                        {{ number_format($vendor['reviews_count'] ?? 0) }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Products Count Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Products') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    <span class="value-badge">
                        <i class="ri-shopping-bag-3-line"></i>
                        {{ number_format($vendor['products_count'] ?? 0) }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Featured Products Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Featured Products') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(isset($vendor['featured_products']) && count($vendor['featured_products']) > 0)
                        <ul class="products-list">
                            @foreach(array_slice($vendor['featured_products'], 0, 3) as $product)
                            <li class="product-item">
                                <span class="product-name">{{ $product['name'] }}</span>
                                <span class="product-price">{{ number_format($product['price']) }} ETB</span>
                            </li>
                            @endforeach
                            @if(count($vendor['featured_products']) > 3)
                            <li class="product-item text-muted">+{{ count($vendor['featured_products']) - 3 }} {{ __('more') }}</li>
                            @endif
                        </ul>
                    @else
                        <span class="text-muted">{{ __('No featured products') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Followers Count Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Followers') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    <span class="value-badge">
                        <i class="ri-user-follow-line"></i>
                        {{ number_format($vendor['followers_count'] ?? 0) }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Delivery Time Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Delivery Time') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(($vendor['delivery_time'] ?? false))
                        <span class="feature-tag active">
                            <i class="ri-truck-line"></i>
                            {{ $vendor['delivery_time'] }}
                        </span>
                    @else
                        <span class="text-muted">{{ __('N/A') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Minimum Order Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Minimum Order') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(($vendor['min_order'] ?? 0) > 0)
                        <span class="value-large">{{ number_format($vendor['min_order']) }} ETB</span>
                    @else
                        <span class="text-muted">{{ __('No minimum') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Response Rate Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Response Rate') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(($vendor['response_rate'] ?? 0) > 0)
                        <div class="value-badge">{{ $vendor['response_rate'] }}%</div>
                        <small class="text-muted" style="margin-left: 5px;">
                            ({{ $vendor['response_time'] ?? __('within 1 hour') }})
                        </small>
                    @else
                        <span class="text-muted">{{ __('N/A') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Payment Methods Row - UPDATED with only Cash and Chapa -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Payment Methods') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(isset($vendor['payment_methods']) && count($vendor['payment_methods']) > 0)
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
                            @foreach($vendor['payment_methods'] as $method)
                                @if(in_array($method, ['cash', 'chapa']))
                                    @if($method === 'cash')
                                    <span class="payment-tag cash" title="{{ __('Cash on Delivery') }}">
                                        <i class="ri-bank-card-line"></i>
                                        {{ __('Cash') }}
                                    </span>
                                    @elseif($method === 'chapa')
                                    <span class="payment-tag chapa" title="{{ __('Pay with Chapa') }}">
                                        <i class="ri-flashlight-line"></i>
                                        Chapa
                                    </span>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
                            <!-- Default to Cash if no payment methods specified -->
                            <span class="payment-tag cash" title="{{ __('Cash on Delivery') }}">
                                <i class="ri-bank-card-line"></i>
                                {{ __('Cash') }}
                            </span>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Chapa Badge Row - Additional row for Chapa information -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Online Payment') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(isset($vendor['payment_methods']) && in_array('chapa', $vendor['payment_methods']))
                        <div class="chapa-badge">
                            <i class="ri-flashlight-fill"></i>
                            {{ __('Chapa Secure Payment') }}
                        </div>
                    @else
                        <span class="text-muted">{{ __('Cash only') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Languages Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Languages') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if(isset($vendor['languages']) && count($vendor['languages']) > 0)
                        <div style="display: flex; gap: 5px; flex-wrap: wrap; justify-content: center;">
                            @foreach($vendor['languages'] as $lang)
                                <span class="feature-tag">{{ $lang }}</span>
                            @endforeach
                        </div>
                    @else
                        <span class="feature-tag">{{ __('Amharic') }}</span>
                        <span class="feature-tag">{{ __('English') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Member Since Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Member Since') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if($vendor['joined_date'] ?? false)
                        <i class="ri-calendar-line" style="color: var(--primary-gold); margin-right: 5px;"></i>
                        {{ \Carbon\Carbon::parse($vendor['joined_date'])->format('M Y') }}
                    @else
                        <span class="text-muted">{{ __('N/A') }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Last Active Row -->
            <div class="compare-row">
                <div class="compare-cell label">{{ __('Last Active') }}</div>
                @foreach($comparisonData as $vendor)
                <div class="compare-cell">
                    @if($vendor['last_active'] ?? false)
                        <span class="{{ \Carbon\Carbon::parse($vendor['last_active'])->diffInHours(now()) < 24 ? 'value-badge' : 'text-muted' }}">
                            {{ \Carbon\Carbon::parse($vendor['last_active'])->diffForHumans() }}
                        </span>
                    @else
                        <span class="text-muted">{{ __('Recently active') }}</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="ri-store-3-line"></i>
            <h3>{{ __('No vendors selected for comparison') }}</h3>
            <p>{{ __('Please select at least 2 vendors from the search results to compare them side by side.') }}</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="{{ route('search.results') }}" class="back-btn">
                    <i class="ri-search-line"></i>
                    {{ __('Browse Vendors') }}
                </a>
                <a href="{{ route('home') }}" class="back-btn outline">
                    <i class="ri-home-line"></i>
                    {{ __('Go Home') }}
                </a>
            </div>
        </div>
        @endif

        <!-- Back Section -->
        <div class="back-section">
            <a href="javascript:history.back()" class="back-btn outline">
                <i class="ri-arrow-left-line"></i>
                {{ __('Back to Previous Page') }}
            </a>
            <a href="{{ route('search.results') }}" class="back-btn outline">
                <i class="ri-search-line"></i>
                {{ __('New Search') }}
            </a>
            @if(isset($comparisonData) && count($comparisonData) > 0)
            <button class="back-btn" onclick="printComparison()">
                <i class="ri-printer-line"></i>
                {{ __('Print Comparison') }}
            </button>
            @endif
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">{{ __('Success') }}</div>
            <div class="toast-message" id="toastMessage">{{ __('Operation completed successfully') }}</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </div>
    </div>

    <script>
        // Initialize theme
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'ri-sun-line';
        }

        // Theme Toggle
        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'ri-sun-line';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'ri-moon-line';
                localStorage.setItem('theme', 'light');
            }
        });

        // View Toggle
        function setView(view) {
            const table = document.getElementById('compareTable');
            const buttons = document.querySelectorAll('.view-btn');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.closest('.view-btn').classList.add('active');
            
            if (view === 'card') {
                // Implement card view if needed
                showToast('Info', 'Card view coming soon', 'info');
            }
        }

        // Remove from comparison
        function removeFromComparison(vendorId) {
            let compareList = JSON.parse(localStorage.getItem('compareList')) || [];
            compareList = compareList.filter(id => id != vendorId);
            localStorage.setItem('compareList', JSON.stringify(compareList));
            
            showToast('Success', '{{ __("Vendor removed from comparison") }}');
            
            // Reload page after short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }

        // Export Comparison
        function exportComparison() {
            const table = document.querySelector('.compare-table');
            const html = table.outerHTML;
            const blob = new Blob([html], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'vendor-comparison.html';
            a.click();
            URL.revokeObjectURL(url);
            
            showToast('Success', '{{ __("Comparison exported successfully") }}');
        }

        // Print Comparison
        function printComparison() {
            window.print();
        }

        // Toast Notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');

            toast.className = 'toast ' + type;
            toastIcon.innerHTML = type === 'success' ? '<i class="ri-checkbox-circle-line"></i>' : 
                                 type === 'error' ? '<i class="ri-error-warning-line"></i>' : 
                                 '<i class="ri-information-line"></i>';
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Escape key closes modals
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideToast();
            }
        });

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);
    </script>
</body>
</html>