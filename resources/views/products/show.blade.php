<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - {{ $product->vendor->business_name ?? $product->vendor->name ?? 'Vendor' }} | Vendora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #E5E7EB;
            --white: #FFFFFF;
            --light-gray: #F9FAFB;
            --shadow: 0 4px 20px rgba(0,0,0,0.05);
            --shadow-hover: 0 8px 30px rgba(184,142,63,0.15);
            --radius: 8px;
            --transition: all 0.3s ease;
        }

        /* Dark Mode */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #E5E7EB;
            --text-light: #9CA3AF;
            --border-color: #374151;
            --white: #1F2937;
            --light-gray: #111827;
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo i {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .theme-toggle {
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            border-radius: 30px;
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-dark);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px 0;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary-gold);
        }

        /* Product Container */
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            background: var(--white);
            border-radius: 16px;
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 30px;
            }
        }

        /* Product Images */
        .product-images {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .main-image {
            width: 100%;
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--light-gray);
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 48px;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .thumbnail {
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .thumbnail:hover {
            border-color: var(--primary-gold);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Info */
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-category {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-title {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stars {
            display: flex;
            gap: 2px;
            color: var(--primary-gold);
            font-size: 18px;
        }

        .rating-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .review-count {
            color: var(--text-light);
            font-size: 14px;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .current-price {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .original-price {
            font-size: 20px;
            color: var(--text-light);
            text-decoration: line-through;
        }

        .discount-badge {
            background: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .product-description {
            color: var(--text-light);
            line-height: 1.8;
        }

        .vendor-info {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .vendor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .vendor-details h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .vendor-details a {
            color: var(--primary-gold);
            text-decoration: none;
        }

        .vendor-details a:hover {
            text-decoration: underline;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .in-stock {
            background: #ecfdf5;
            color: #10b981;
        }

        .low-stock {
            background: #fffbeb;
            color: #f59e0b;
        }

        .out-of-stock {
            background: #fef2f2;
            color: #ef4444;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-primary {
            background: var(--primary-gold);
            color: white;
            flex: 2;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            flex: 1;
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* Reviews Section */
        .reviews-section {
            background: var(--white);
            border-radius: 16px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .reviews-header h2 {
            font-size: 24px;
            font-weight: 700;
        }

        .review-card {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .review-card:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .review-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .review-author-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .review-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .review-rating {
            display: flex;
            gap: 2px;
            color: var(--primary-gold);
        }

        .review-content {
            color: var(--text-light);
            line-height: 1.6;
        }

        .no-reviews {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
        }

        .no-reviews i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Footer */
        footer {
            background: var(--white);
            padding: 40px 0;
            margin-top: 60px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-light);
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1000;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left-color: #10b981;
        }

        .toast.error {
            border-left-color: #ef4444;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="logo">
                <i class="ri-store-3-fill"></i>
                Vendora
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @else
                    <a href="{{ route('profile.show', Auth::id()) }}" class="nav-link">Profile</a>
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                    @endif
                @endguest
                <button class="theme-toggle" id="themeToggle">
                    <i class="ri-moon-line"></i>
                    <span>Theme</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Back Link -->
            <a href="javascript:history.back()" class="back-link">
                <i class="ri-arrow-left-line"></i> Back
            </a>

            <!-- Product Container -->
            <div class="product-container">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        @if(isset($product->image) && $product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                        @elseif(isset($product->images) && is_array($product->images) && count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}">
                        @else
                            <div class="image-placeholder">
                                <i class="ri-image-line"></i>
                            </div>
                        @endif
                    </div>

                    @if(isset($product->images) && is_array($product->images) && count($product->images) > 1)
                    <div class="thumbnail-grid">
                        @foreach(array_slice($product->images, 0, 4) as $index => $image)
                        <div class="thumbnail">
                            <img src="{{ Storage::url($image) }}" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    @if(isset($product->category) && $product->category)
                    <div class="product-category">{{ $product->category }}</div>
                    @endif

                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="product-rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($averageRating ?? 0))
                                    <i class="ri-star-fill"></i>
                                @elseif($i - 0.5 <= ($averageRating ?? 0))
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="rating-value">{{ number_format($averageRating ?? 0, 1) }}</span>
                        <span class="review-count">({{ $reviewCount ?? 0 }} reviews)</span>
                    </div>

                    <div class="product-price">
                        <span class="current-price">{{ number_format($product->price) }} ETB</span>
                        @if(isset($product->original_price) && $product->original_price > $product->price)
                            <span class="original-price">{{ number_format($product->original_price) }} ETB</span>
                            @php
                                $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                            @endphp
                            <span class="discount-badge">-{{ $discount }}%</span>
                        @endif
                    </div>

                    <div class="product-description">
                        {{ $product->description }}
                    </div>

                    <!-- Vendor Info -->
                    @if(isset($product->vendor))
                    <div class="vendor-info">
                        <div class="vendor-avatar">
                            {{ substr($product->vendor->business_name ?? $product->vendor->name ?? 'V', 0, 1) }}
                        </div>
                        <div class="vendor-details">
                            <h4>Sold by</h4>
                            <a href="{{ route('vendor.show', $product->vendor_id) }}">
                                {{ $product->vendor->business_name ?? $product->vendor->name ?? 'Vendor' }}
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Stock Status -->
                    @php
                        $stock = $product->stock ?? 0;
                        $stockClass = 'out-of-stock';
                        $stockText = 'Out of Stock';

                        if ($stock > 10) {
                            $stockClass = 'in-stock';
                            $stockText = 'In Stock';
                        } elseif ($stock > 0) {
                            $stockClass = 'low-stock';
                            $stockText = 'Low Stock (' . $stock . ' left)';
                        }
                    @endphp
                    <div class="stock-status {{ $stockClass }}">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>{{ $stockText }}</span>
                    </div>

                    <!-- Product Actions -->
                    <div class="product-actions">
                        <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                            <i class="ri-shopping-cart-line"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline" onclick="addToWishlist({{ $product->id }})">
                            <i class="ri-heart-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <div class="reviews-header">
                    <h2>Customer Reviews</h2>
                    <div class="review-rating">
                        <span class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($averageRating ?? 0))
                                    <i class="ri-star-fill"></i>
                                @elseif($i - 0.5 <= ($averageRating ?? 0))
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </span>
                        <span>{{ number_format($averageRating ?? 0, 1) }} out of 5</span>
                    </div>
                </div>

                @if(isset($reviews) && count($reviews) > 0)
                    <div class="reviews-list">
                        @foreach($reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="review-author">
                                    <div class="review-avatar">
                                        {{ substr($review->user_name ?? 'Anonymous', 0, 1) }}
                                    </div>
                                    <div class="review-author-info">
                                        <h4>{{ $review->user_name ?? 'Anonymous' }}</h4>
                                        <div class="review-date">{{ $review->date ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= ($review->rating ?? 0))
                                            <i class="ri-star-fill"></i>
                                        @else
                                            <i class="ri-star-line"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div class="review-content">
                                {{ $review->comment ?? 'No comment provided.' }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-reviews">
                        <i class="ri-chat-3-line"></i>
                        <h3>No Reviews Yet</h3>
                        <p>Be the first to review this product!</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon" id="toastIcon">✓</div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Operation completed</div>
        </div>
    </div>

    <script>
        // Theme Toggle
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'ri-sun-line';
            document.querySelector('#themeToggle span').textContent = 'Light';
        }

        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            const text = this.querySelector('span');

            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'ri-sun-line';
                text.textContent = 'Light';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'ri-moon-line';
                text.textContent = 'Theme';
                localStorage.setItem('theme', 'light');
            }
        });

        // Toast notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');

            toast.className = 'toast ' + type;
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Add to cart
        function addToCart(productId) {
            @auth
                showToast('Success', 'Product added to cart!');
            @else
                window.location.href = '{{ route("login") }}';
            @endauth
        }

        // Add to wishlist
        function addToWishlist(productId) {
            @auth
                showToast('Success', 'Product added to wishlist!');
            @else
                window.location.href = '{{ route("login") }}';
            @endauth
        }
    </script>
</body>
</html>
