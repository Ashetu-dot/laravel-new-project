<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ $vendor->business_name ?? $vendor->name }} — Vendora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-authenticated" content="{{ Auth::check() ? 'true' : 'false' }}">
    <meta name="description" content="{{ Str::limit($vendor->description ?? 'Local vendor', 160) }}">
    <meta property="og:title" content="{{ $vendor->business_name ?? $vendor->name }}">
    <meta property="og:description" content="{{ Str::limit($vendor->description ?? '', 200) }}">
    <meta property="og:image" content="{{ $vendor->avatar_url }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="{{ asset('js/cart.js') }}" defer></script>
    <style>
        /* ===== RESET & VARIABLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        :root {
            --primary: #4F46E5;
            --primary-hover: #4338ca;
            --primary-soft: #EEF2FF;
            --text-dark: #111827;
            --text-gray: #6B7280;
            --bg-light: #F9FAFB;
            --white: #FFFFFF;
            --border: #E5E7EB;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 12px;
            --radius-sm: 8px;
            --header-height: 80px;
            --container-padding: 1.5rem;
            --font-regular: 'MiSans-Regular', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-medium: 'MiSans-Medium', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-bold: 'MiSans-Bold', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        @font-face {
            font-family: 'MiSans-Regular';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Regular.ttf') format('truetype');
            font-display: swap;
        }
        @font-face {
            font-family: 'MiSans-Medium';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Medium.ttf') format('truetype');
            font-display: swap;
        }
        @font-face {
            font-family: 'MiSans-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/MiSans-Bold.ttf') format('truetype');
            font-display: swap;
        }

        body {
            font-family: var(--font-regular);
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
            width: 100%;
            overflow-x: hidden;
        }

        /* ===== UTILITIES ===== */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--container-padding);
        }

        /* ===== HEADER (fully responsive) ===== */
        header {
            background-color: var(--white);
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 max(1rem, calc((100% - 1280px)/2));
            padding-left: clamp(1rem, 5vw, 2.5rem);
            padding-right: clamp(1rem, 5vw, 2.5rem);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
        }

        /* existing header nav styles (kept for backwards compatibility) */
        .logo {
            font-family: var(--font-bold);
            font-size: clamp(1.2rem, 4vw, 1.8rem);
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        /* new navbar styles adopted from search view */
        .navbar {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .navbar .logo i {
            color: var(--primary);
            font-size: 2rem;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: var(--text-gray);
            text-decoration: none;
            font-family: var(--font-medium);
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .btn-login {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
        }

        /* legacy styles for compatibility */
        nav {
            flex: 1 1 auto;
            display: flex;
            justify-content: center;
        }

        nav ul {
            display: flex;
            gap: clamp(0.8rem, 3vw, 2.5rem);
            list-style: none;
            padding: 0 0.5rem;
        }

        nav a {
            text-decoration: none;
            color: var(--text-gray);
            font-size: clamp(0.85rem, 2vw, 1rem);
            font-family: var(--font-medium);
            transition: color 0.2s;
            white-space: nowrap;
        }

        nav a:hover, nav a.active {
            color: var(--primary);
        }

        .auth-buttons {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-family: var(--font-medium);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .btn-outline {
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-dark);
        }
        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-soft);
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        /* ===== HERO SECTION (responsive) ===== */
        .hero {
            background-color: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .banner-container {
            width: 100%;
            height: clamp(180px, 30vw, 360px);
            overflow: hidden;
            position: relative;
        }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.4));
        }

        .vendor-profile-header {
            max-width: 1280px;
            margin: -3rem auto 0;
            padding: 0 var(--container-padding);
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 1.5rem;
            z-index: 10;
        }

        .profile-pic-container {
            width: clamp(100px, 20vw, 160px);
            height: clamp(100px, 20vw, 160px);
            border-radius: 50%;
            border: 4px solid var(--white);
            background: var(--white);
            overflow: hidden;
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vendor-info-header {
            flex: 1;
            padding-bottom: 1rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1rem;
        }

        .vendor-main-details h1 {
            font-family: var(--font-bold);
            font-size: clamp(1.6rem, 4vw, 2.5rem);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem 1rem;
            margin-bottom: 0.25rem;
        }

        .verified-badge {
            background: #DEF7EC;
            color: #03543F;
            font-size: 0.8rem;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-family: var(--font-medium);
            white-space: nowrap;
        }

        .vendor-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem 1.5rem;
            color: var(--text-gray);
            font-size: 0.9rem;
            align-items: center;
        }
        .vendor-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .rating-stars {
            color: #FBBF24;
            display: flex;
            align-items: center;
            gap: 2px;
            flex-wrap: wrap;
        }

        .action-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text-gray);
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.2s;
        }
        .btn-icon:hover {
            color: var(--primary);
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        /* ===== MAIN GRID (responsive) ===== */
        .main-grid {
            max-width: 1280px;
            margin: 2rem auto;
            padding: 0 var(--container-padding);
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* cards */
        .section-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: clamp(1.2rem, 4vw, 2rem);
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
        }

        .section-title {
            font-family: var(--font-bold);
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.8rem;
        }
        .section-title-link {
            font-size: 0.9rem;
            color: var(--primary);
            text-decoration: none;
            font-family: var(--font-medium);
            white-space: nowrap;
        }

        .about-text {
            color: var(--text-gray);
            line-height: 1.7;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .tag {
            background: #F3F4F6;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            color: var(--text-gray);
            font-size: 0.85rem;
            font-family: var(--font-medium);
        }

        /* product grid (responsive) */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
            gap: 1.5rem;
        }

        .product-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background: var(--white);
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
            border-color: #C7D2FE;
        }
        .product-img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }
        .product-info {
            padding: 1.2rem;
        }
        .product-price {
            color: var(--primary);
            font-family: var(--font-bold);
            font-size: 1.2rem;
        }
        .product-name {
            font-family: var(--font-medium);
            font-size: 1rem;
            margin: 0.25rem 0 0.5rem;
        }
        .product-meta {
            font-size: 0.8rem;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* reviews */
        .review-summary {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }
        .rating-big {
            font-size: 3rem;
            font-family: var(--font-bold);
            line-height: 1;
        }
        .rating-bars {
            flex: 1 1 250px;
        }
        .rating-bar-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .star-label {
            font-size: 0.85rem;
            color: var(--text-gray);
            min-width: 35px;
        }
        .bar-bg {
            flex: 1;
            height: 8px;
            background: #F3F4F6;
            border-radius: 4px;
            overflow: hidden;
        }
        .bar-fill {
            height: 100%;
            background: #FBBF24;
        }

        .review-item {
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #F3F4F6;
        }
        .review-item:last-child {
            border: none;
            margin: 0;
            padding: 0;
        }
        .reviewer-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 0.8rem;
        }
        .reviewer-details {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .reviewer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #E0E7FF;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-bold);
            object-fit: cover;
        }

        /* sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .contact-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1px solid var(--border);
        }
        .contact-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.2rem;
            align-items: flex-start;
        }
        .contact-icon {
            width: 40px;
            height: 40px;
            background: #EEF2FF;
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .contact-details h4 {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 400;
        }
        .contact-details p {
            font-size: 1rem;
            font-family: var(--font-medium);
            word-break: break-word;
        }
        .map-card {
            width: 100%;
            height: 200px;
            background: #E5E7EB;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            margin: 1rem 0;
        }
        .map-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hours-list {
            list-style: none;
            margin-top: 1rem;
            border-top: 1px solid #F3F4F6;
            padding-top: 1rem;
        }
        .hours-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-bottom: 0.6rem;
            color: var(--text-gray);
        }
        .hours-item.today {
            color: var(--primary);
            font-family: var(--font-medium);
        }

        /* form inside sidebar */
        .contact-card form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .contact-card input,
        .contact-card textarea {
            padding: 0.8rem;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.95rem;
            width: 100%;
        }

        /* footer (responsive) */
        footer {
            background-color: var(--white);
            border-top: 1px solid var(--border);
            padding: 3rem max(1rem, calc((100% - 1280px)/2));
            margin-top: 3rem;
        }
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }
        .footer-brand {
            max-width: 300px;
        }
        .footer-brand h2 {
            font-family: var(--font-bold);
            font-size: 1.8rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem 4rem;
        }
        .link-column h3 {
            font-size: 1rem;
            font-family: var(--font-bold);
            margin-bottom: 1rem;
        }
        .link-column ul {
            list-style: none;
        }
        .link-column li {
            margin-bottom: 0.6rem;
        }
        .link-column a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.9rem;
        }
        .link-column a:hover {
            color: var(--primary);
        }
        .footer-bottom {
            border-top: 1px solid #F3F4F6;
            padding-top: 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }
        .social-links {
            display: flex;
            gap: 1rem;
        }
        .social-icon {
            color: var(--text-gray);
            font-size: 1.2rem;
            transition: color 0.2s;
        }
        .social-icon:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero">
        <div class="banner-container">
            <div class="hero-overlay"></div>
            @php
                // Banner: use main_image (store banner), fallback to sub_image_1
                $bannerImage = $vendor->main_image ?? $vendor->sub_image_1 ?? null;
                if ($bannerImage) {
                    $bannerUrl = str_starts_with($bannerImage, 'http')
                        ? $bannerImage
                        : Storage::url($bannerImage);
                } else {
                    $bannerUrl = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1280&q=80';
                }
            @endphp
            <img src="{{ $bannerUrl }}" alt="Vendor Banner" class="banner-img" loading="lazy">
        </div>

        <div class="vendor-profile-header">
            <div class="profile-pic-container">
                {{-- Use the model's avatar_url accessor which handles storage path + fallback to initials avatar --}}
                <img src="{{ $vendor->avatar_url }}" 
                     alt="{{ $vendor->business_name ?? $vendor->name }}" 
                     class="profile-pic"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(substr($vendor->business_name ?? $vendor->name, 0, 2)) }}&background=B88E3F&color=fff&size=200'">
            </div>

            <div class="vendor-info-header">
                <div class="vendor-main-details">
                    <h1>
                        {{ $vendor->business_name ?? $vendor->name }}
                        @if($vendor->is_verified)
                            <span class="verified-badge"><i class="ri-checkbox-circle-fill"></i> Verified</span>
                        @endif
                    </h1>
                    <div class="vendor-meta">
                        <span><i class="ri-map-pin-line"></i> {{ $vendor->city ?? $vendor->address_line1 ?? 'N/A' }}</span>
                        <span><i class="ri-time-line"></i> Open • Closes {{ $vendor->closing_time ?? '—' }}</span>
                        <div class="rating-stars">
                            @php $rating = $vendor->rating ?? 0; @endphp
                            @for($i=1;$i<=5;$i++)
                                @if($rating >= $i)
                                    <i class="ri-star-fill"></i>
                                @elseif($rating > $i-1)
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                            <span style="color: var(--text-dark); margin-left: 4px;">{{ number_format($rating, 1) }}</span>
                            <span style="color: var(--text-gray);">({{ $vendor->total_reviews ?? 0 }})</span>
                        </div>
                    </div>
                </div>
                <div class="action-group">
                    <button class="btn-icon" title="Share" onclick="shareVendor()"><i class="ri-share-forward-line"></i></button>
                    <button class="btn-icon" title="Save" onclick="saveVendor({{ $vendor->id }})"><i class="ri-heart-line"></i></button>
                    <a href="#contact" class="btn btn-primary">Contact</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Grid -->
    <div class="main-grid">
        <!-- Left Column -->
        <main>
            <!-- About -->
            <div class="section-card">
                <div class="section-title">About Us</div>
                <div class="about-text">
                    {!! nl2br(e($vendor->description ?? 'No description available.')) !!}
                </div>
                @if(!empty($vendor->tags))
                <div class="tags-container">
                    @foreach($vendor->tags as $tag)
                        <span class="tag">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Featured Products -->
            <div class="section-card" id="products">
                <div class="section-title">
                    Featured Products
                    <a href="{{ route('vendor.products', $vendor->id) }}" class="section-title-link">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                @if($vendor->products && $vendor->products->count() > 0)
                <div class="product-grid">
                    @foreach($vendor->products->take(4) as $product)
                        @if($product && $product->id)
                        <div class="product-card">
                            <a href="{{ route('product.show', $product->slug ?? $product->id) }}" style="text-decoration: none; color: inherit;">
                                @php
                                    // Handle product images
                                    $productImage = null;
                                    
                                    // Check different possible image fields
                                    if (!empty($product->images)) {
                                        if (is_array($product->images)) {
                                            $productImage = $product->images[0] ?? null;
                                        } elseif (is_string($product->images)) {
                                            $imagesArray = json_decode($product->images, true);
                                            if (is_array($imagesArray) && count($imagesArray) > 0) {
                                                $productImage = $imagesArray[0];
                                            } elseif (!empty($product->images)) {
                                                $productImage = $product->images;
                                            }
                                        }
                                    } elseif (!empty($product->image)) {
                                        $productImage = $product->image;
                                    }
                                    
                                    // Build correct URL
                                    if ($productImage) {
                                        if (str_starts_with($productImage, 'http')) {
                                            $imageUrl = $productImage;
                                        } elseif (str_starts_with($productImage, 'storage/')) {
                                            $imageUrl = asset($productImage);
                                        } else {
                                            $imageUrl = asset('storage/' . $productImage);
                                        }
                                    } else {
                                        $imageUrl = asset('images/default-product.jpg');
                                    }
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="product-img" loading="lazy">
                                <div class="product-info">
                                    <div class="product-price">
                                        {{ number_format($product->price) }} ETB
                                    </div>
                                    <h3 class="product-name">{{ Str::limit($product->name, 40) }}</h3>
                                    <div class="product-meta">
                                        <i class="ri-cube-line"></i> {{ $product->category->name ?? 'Product' }}
                                    </div>
                                </div>
                            </a>
                            @if($product->stock > 0)
                            <button onclick="quickAddToCart({{ $product->id }}, event)" class="btn btn-primary" style="width: calc(100% - 24px); margin: 0 12px 12px 12px; padding: 10px; font-size: 14px;">
                                <i class="ri-shopping-cart-line"></i> Add to Cart
                            </button>
                            @else
                            <button disabled class="btn btn-primary" style="width: calc(100% - 24px); margin: 0 12px 12px 12px; padding: 10px; font-size: 14px; opacity: 0.5; cursor: not-allowed;">
                                <i class="ri-close-circle-line"></i> Out of Stock
                            </button>
                            @endif
                        </div>
                        @endif
                    @endforeach
                </div>
                @else
                <div style="text-align: center; padding: 40px; color: var(--text-gray);">
                    <i class="ri-shopping-bag-line" style="font-size: 48px; opacity: 0.5;"></i>
                    <p style="margin-top: 12px;">No products available yet</p>
                </div>
                @endif
            </div>

            <!-- Reviews -->
            <div class="section-card">
                <div class="section-title">
                    Reviews & Ratings
                    @if(Auth::check())
                    <a href="{{ route('vendor.products', $vendor->id) }}" class="btn btn-outline" style="font-size: 0.85rem; text-decoration: none;">Write a Review</a>
                    @endif
                </div>
                <div class="review-summary">
                    <div>
                        <div class="rating-big">{{ number_format($vendor->rating ?? 0, 1) }}</div>
                        <div class="rating-stars" style="font-size:0.9rem;">
                            @php $rating = $vendor->rating ?? 0; @endphp
                            @for($i=1;$i<=5;$i++)
                                @if($rating >= $i)
                                    <i class="ri-star-fill"></i>
                                @elseif($rating > $i-1)
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line"></i>
                                @endif
                            @endfor
                        </div>
                        <div style="font-size:0.8rem; color:var(--text-gray);">{{ $vendor->total_reviews ?? 0 }} reviews</div>
                    </div>
                    @if($vendor->reviews && $vendor->reviews->count() > 0)
                    <div class="rating-bars">
                        @php
                            $counts = $vendor->reviews->groupBy(function($r){ return (int)$r->rating; });
                            $totalReviews = $vendor->reviews->count();
                        @endphp
                        @for($star=5;$star>=1;$star--)
                            @php 
                                $count = isset($counts[$star]) ? $counts[$star]->count() : 0; 
                                $pct = $totalReviews ? round(($count * 100) / $totalReviews) : 0;
                            @endphp
                            <div class="rating-bar-row">
                                <span class="star-label">{{ $star }}★</span>
                                <div class="bar-bg"><div class="bar-fill" style="width:{{ $pct }}%"></div></div>
                                <span>{{ $pct }}%</span>
                            </div>
                        @endfor
                    </div>
                    @endif
                </div>
                @if($vendor->reviews && $vendor->reviews->count() > 0)
                <div class="reviews-list">
                    @foreach($vendor->reviews->take(3) as $review)
                        <div class="review-item">
                            <div class="reviewer-info">
                                <div class="reviewer-details">
                                    @if($review->user)
                                        <img src="{{ $review->user->avatar_url }}" 
                                             alt="{{ $review->user->name }}" 
                                             class="reviewer-avatar"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="reviewer-avatar">U</div>
                                    @endif
                                    <div>
                                        <h4 style="font-size:1rem;">{{ $review->user->name ?? 'Anonymous' }}</h4>
                                        <div style="font-size:0.75rem; color:var(--text-gray);">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="rating-stars">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="{{ $review->rating >= $i ? 'ri-star-fill' : 'ri-star-line' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p>{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
                @if($vendor->reviews->count() > 3)
                <div style="text-align: center; margin-top: 1rem;">
                    <a href="{{ route('vendor.reviews', $vendor->id) }}" class="btn btn-outline">View All Reviews</a>
                </div>
                @endif
                @else
                <div style="text-align: center; padding: 20px; color: var(--text-gray);">
                    <p>No reviews yet. Be the first to review!</p>
                </div>
                @endif
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="contact-card" id="contact">
                <h3 style="font-family:var(--font-bold); margin-bottom:1.2rem;">Contact & Location</h3>
                @if($vendor->phone)
                <div class="contact-item">
                    <div class="contact-icon"><i class="ri-phone-line"></i></div>
                    <div class="contact-details">
                        <h4>Phone</h4>
                        <p><a href="tel:{{ $vendor->phone }}" style="color: inherit; text-decoration: none;">{{ $vendor->phone }}</a></p>
                    </div>
                </div>
                @endif
                @if($vendor->email)
                <div class="contact-item">
                    <div class="contact-icon"><i class="ri-mail-line"></i></div>
                    <div class="contact-details">
                        <h4>Email</h4>
                        <p><a href="mailto:{{ $vendor->email }}" style="color: inherit; text-decoration: none;">{{ $vendor->email }}</a></p>
                    </div>
                </div>
                @endif
                @if($vendor->address_line1 || $vendor->city)
                <div class="contact-item">
                    <div class="contact-icon"><i class="ri-map-pin-2-line"></i></div>
                    <div class="contact-details">
                        <h4>Address</h4>
                        <p>{{ $vendor->address_line1 }} {{ $vendor->city }}</p>
                    </div>
                </div>
                @endif
                <div class="map-card">
                    <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Map" class="map-placeholder" loading="lazy">
                    <div style="position: absolute; bottom: 10px; left: 10px;">
                        <button class="btn btn-primary" style="padding:6px 12px; font-size:0.8rem;" onclick="getDirections()">Directions</button>
                    </div>
                </div>
                <ul class="hours-list">
                    <li class="hours-item"><span>Mon-Fri</span><span>{{ $vendor->weekday_hours ?? '7:00–20:00' }}</span></li>
                    <li class="hours-item today"><span>Saturday</span><span>{{ $vendor->saturday_hours ?? '8:00–21:00' }}</span></li>
                    <li class="hours-item"><span>Sunday</span><span>{{ $vendor->sunday_hours ?? '8:00–18:00' }}</span></li>
                </ul>
            </div>
            
            <div class="contact-card">
                <h3 style="font-family:var(--font-bold); margin-bottom:1rem;">Send Message</h3>
                @if(Auth::check())
                <form method="post" id="contactForm">
                    @csrf
                    <input type="text" name="name" placeholder="Your name" value="{{ Auth::user()->name }}" required>
                    <input type="email" name="email" placeholder="Your email" value="{{ Auth::user()->email }}" required>
                    <textarea name="message" rows="4" placeholder="I'm interested in..." required></textarea>
                    <button type="submit" class="btn btn-primary" style="width:100%;">Send Inquiry</button>
                </form>
                @else
                <p style="text-align: center; color: var(--text-gray);">
                    Please <a href="{{ route('login') }}" style="color: var(--primary);">login</a> to send a message to this vendor.
                </p>
                @endif
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-line"></i> Vendora</h2>
                <p style="color: var(--text-gray); margin-top: 1rem;">Ethiopia's premier marketplace connecting local vendors with customers.</p>
            </div>
            <div class="footer-links">
                <div class="link-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('vendors.search') }}">Vendors</a></li>
                        <li><a href="{{ route('products.public') }}">Products</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="{{ route('help-center') }}">Help Center</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('help-center') }}">FAQ</a></li>
                        <li><a href="{{ route('contact') }}">Shipping Info</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">
                &copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia
            </div>
            <div class="footer-links" style="gap: 1.5rem;">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
            </div>
            <div class="social-links">
                <a href="#" class="social-icon"><i class="ri-facebook-fill"></i></a>
                <a href="#" class="social-icon"><i class="ri-twitter-fill"></i></a>
                <a href="#" class="social-icon"><i class="ri-instagram-fill"></i></a>
                <a href="#" class="social-icon"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Smooth scroll to products section if URL has #products
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#products') {
                const productsSection = document.getElementById('products');
                if (productsSection) {
                    setTimeout(() => {
                        productsSection.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 100);
                }
            }
        });

        // Save Vendor Function
        function saveVendor(vendorId) {
            if (!confirm('Are you sure you want to save this vendor?')) return;
            
            fetch(`/vendors/${vendorId}/save`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Vendor saved successfully!');
                    // Update button state
                    const btn = document.querySelector(`button[onclick="saveVendor(${vendorId})"]`);
                    if (btn) {
                        btn.innerHTML = '<i class="ri-heart-fill"></i>';
                        btn.setAttribute('onclick', `unsaveVendor(${vendorId})`);
                        btn.setAttribute('title', 'Unsave');
                    }
                } else {
                    alert(data.message || 'Failed to save vendor');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        // Unsave Vendor Function
        function unsaveVendor(vendorId) {
            if (!confirm('Remove this vendor from your saved list?')) return;
            
            fetch(`/vendors/${vendorId}/unsave`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Vendor removed from saved list!');
                    // Update button state
                    const btn = document.querySelector(`button[onclick="unsaveVendor(${vendorId})"]`);
                    if (btn) {
                        btn.innerHTML = '<i class="ri-heart-line"></i>';
                        btn.setAttribute('onclick', `saveVendor(${vendorId})`);
                        btn.setAttribute('title', 'Save');
                    }
                } else {
                    alert(data.message || 'Failed to unsave vendor');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        // Share Vendor Function
        function shareVendor() {
            const url = window.location.href;
            const title = document.title;

            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(() => {
                    // User cancelled share
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(() => {
                    // Fallback for older browsers
                    const textArea = document.createElement('textarea');
                    textArea.value = url;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    alert('Link copied to clipboard!');
                });
            }
        }

        // Directions Function
        function getDirections() {
            const address = "{{ $vendor->address_line1 ?? '' }} {{ $vendor->city ?? '' }}".trim();
            if (address) {
                const url = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(address)}`;
                window.open(url, '_blank');
            } else {
                alert('Address not available for directions.');
            }
        }

        // Quick Add to Cart Function
        function quickAddToCart(productId, event) {
            event.preventDefault();
            event.stopPropagation();
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to cart!');
                    // Update cart count if you have a cart counter
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount && data.cartCount) {
                        cartCount.textContent = data.cartCount;
                    }
                } else {
                    alert(data.message || 'Failed to add to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        // Contact Form Handler
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    formData.append('vendor_id', {{ $vendor->id }});

                    fetch('{{ route("contact.vendor") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message || 'Message sent successfully!');
                            this.reset();
                        } else {
                            alert(data.message || 'Failed to send message');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
                });
            }
        });

        // Debug function to check image URLs (remove in production)
        function debugImages() {
            console.log('Checking images...');
            document.querySelectorAll('img').forEach((img, index) => {
                console.log(`Image ${index + 1}:`, {
                    src: img.src,
                    alt: img.alt,
                    complete: img.complete,
                    naturalWidth: img.naturalWidth,
                    naturalHeight: img.naturalHeight
                });
            });
        }
        
        // Uncomment to debug images
        // window.addEventListener('load', debugImages);
    </script>
</body>
</html>