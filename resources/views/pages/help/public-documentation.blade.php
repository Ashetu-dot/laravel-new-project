<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Documentation - Vendora | Local Vendor Finder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Import fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Ethiopic:wght@400;500;700&display=swap');

        /* Root Variables */
        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --primary-soft: rgba(184, 142, 63, 0.1);
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        /* Dark mode variables */
        [data-theme="dark"] {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --border-color: #334155;
            --bg-light: #0f172a;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Noto Sans Ethiopic', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 80px;
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
            text-decoration: none;
        }

        .brand i {
            font-size: 28px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-item {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .nav-item:hover {
            color: var(--primary-color);
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .nav-item.active {
            color: var(--primary-color);
        }

        .nav-item.active::after {
            width: 100%;
        }

        /* Theme Toggle */
        .theme-toggle {
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .theme-toggle:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: rotate(15deg);
        }

        /* Documentation Container */
        .doc-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
        }

        /* Sidebar */
        .doc-sidebar {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 100px;
            border: 1px solid var(--border-color);
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 4px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-nav a:hover {
            background-color: var(--primary-soft);
            color: var(--primary-color);
        }

        .sidebar-nav a.active {
            background-color: var(--primary-soft);
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar-nav i {
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .doc-content {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 40px;
            border: 1px solid var(--border-color);
        }

        .doc-header {
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .doc-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .doc-subtitle {
            font-size: 18px;
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        .doc-meta {
            display: flex;
            gap: 24px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .doc-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Content Sections */
        .doc-section {
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 20px;
        }

        .section-content {
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .section-content p {
            margin-bottom: 16px;
        }

        .section-content ul {
            margin: 16px 0;
            padding-left: 24px;
        }

        .section-content li {
            margin-bottom: 8px;
        }

        /* Feature Cards */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin: 32px 0;
        }

        .feature-card {
            background: var(--bg-light);
            padding: 24px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background-color: var(--primary-soft);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--primary-color);
            font-size: 24px;
        }

        .feature-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .feature-desc {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Code Blocks */
        .code-block {
            background: #1e293b;
            color: #e2e8f0;
            padding: 20px;
            border-radius: var(--radius-sm);
            font-family: 'Fira Code', monospace;
            font-size: 14px;
            overflow-x: auto;
            margin: 20px 0;
            border: 1px solid #334155;
        }

        /* Alert Boxes */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        /* Back to Home Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            margin-bottom: 32px;
        }

        .back-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Responsive Design */
        @media screen and (max-width: 1024px) {
            .navbar { padding: 16px 40px; }
            .doc-container { 
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .doc-sidebar {
                position: static;
                order: 2;
            }
            .doc-content {
                order: 1;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .doc-container { padding: 20px 16px; }
            .doc-content { padding: 24px; }
            .doc-title { font-size: 28px; }
            .feature-grid { grid-template-columns: 1fr; }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .brand { font-size: 20px; }
            .doc-title { font-size: 24px; }
        }
    </style>
</head>
<body data-theme="{{ session('theme', 'light') }}">
    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
        </a>

        <div class="nav-links">
            
            <a href="{{ route('documentation') }}" class="nav-item active">Documentation</a>
            <button class="theme-toggle" onclick="toggleTheme()">
                <i class="ri-{{ session('theme', 'light') == 'dark' ? 'sun' : 'moon' }}-line"></i>
            </button>
        </div>
    </nav>

    <!-- Documentation Container -->
    <div class="doc-container">
        <!-- Sidebar -->
        <aside class="doc-sidebar">
            <h3 class="sidebar-title">
                <i class="ri-book-2-line"></i>
                Table of Contents
            </h3>
            <ul class="sidebar-nav">
                <li><a href="#overview" class="nav-link active"><i class="ri-home-line"></i> Overview</a></li>
                <li><a href="#getting-started" class="nav-link"><i class="ri-rocket-line"></i> Getting Started</a></li>
                <li><a href="#for-customers" class="nav-link"><i class="ri-user-line"></i> For Customers</a></li>
                <li><a href="#for-vendors" class="nav-link"><i class="ri-store-line"></i> For Vendors</a></li>
                <li><a href="#features" class="nav-link"><i class="ri-star-line"></i> Features</a></li>
                <li><a href="#guidelines" class="nav-link"><i class="ri-shield-check-line"></i> Guidelines</a></li>
                <li><a href="#support" class="nav-link"><i class="ri-customer-service-line"></i> Support</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="doc-content">
           

            <!-- Header -->
            <header class="doc-header">
                <h1 class="doc-title">Vendora Documentation</h1>
                <p class="doc-subtitle">Complete guide to using Vendora - Your Local Vendor Finder in Jimma, Ethiopia</p>
                <div class="doc-meta">
                    <span><i class="ri-calendar-line"></i> Updated: {{ date('F j, Y') }}</span>
                    <span><i class="ri-map-pin-line"></i> Location: Jimma, Ethiopia</span>
                    <span><i class="ri-user-line"></i> Version: 1.0</span>
                </div>
            </header>

            <!-- Overview Section -->
            <section id="overview" class="doc-section">
                <h2 class="section-title"><i class="ri-home-line"></i> Overview</h2>
                <div class="section-content">
                    <p>Vendora is Ethiopia's premier local vendor marketplace, connecting customers with trusted local businesses in Jimma and across Ethiopia. Our platform makes it effortless to discover, compare, and engage with vendors across dozens of categories — from coffee roasters and handicraft artisans to home services and event planners.</p>
                    <p>Founded in 2023 and launched in 2024, Vendora has grown to serve thousands of customers and hundreds of verified vendors. Every vendor on our platform undergoes a strict verification process to ensure quality and safety.</p>
                    <div class="alert alert-info">
                        <i class="ri-information-line"></i>
                        <span>Vendora is available in English, Amharic (አማርኛ), and Oromo (Afaan Oromoo). Switch languages using the language selector in the navigation bar.</span>
                    </div>
                    <h4>What You Can Do on Vendora:</h4>
                    <ul>
                        <li>Discover and browse thousands of local vendors by category or location</li>
                        <li>Read verified customer reviews and ratings before making decisions</li>
                        <li>Place orders and track them in real time</li>
                        <li>Message vendors directly through our secure messaging system</li>
                        <li>Save favorite vendors to your wishlist for quick access</li>
                        <li>Apply coupons and promotions for discounts on purchases</li>
                    </ul>
                </div>
            </section>

            <!-- Getting Started Section -->
            <section id="getting-started" class="doc-section">
                <h2 class="section-title"><i class="ri-rocket-line"></i> Getting Started</h2>
                <div class="section-content">
                    <h4>Step 1 — Create Your Account</h4>
                    <ul>
                        <li>Visit <a href="{{ route('register') }}" style="color:var(--primary-color)">Register</a> and choose <strong>Customer</strong> or <strong>Vendor</strong></li>
                        <li>Enter your name, email address, and a secure password</li>
                        <li>Agree to the Terms of Service and click <strong>Create Account</strong></li>
                    </ul>
                    <h4>Step 2 — Verify Your Email</h4>
                    <ul>
                        <li>Check your inbox for a verification email from Vendora</li>
                        <li>Click the verification link — if not received, check spam or request a new one</li>
                    </ul>
                    <h4>Step 3 — Complete Your Profile</h4>
                    <ul>
                        <li>Add your profile photo, phone number, and location</li>
                        <li>Customers: set preferred categories for personalized recommendations</li>
                        <li>Vendors: add your business name, description, and banner image</li>
                    </ul>
                    <h4>Step 4 — Start Exploring</h4>
                    <ul>
                        <li>Use the search bar to find vendors by name, category, or location</li>
                        <li>Browse the homepage for featured vendors and popular categories</li>
                        <li>Follow vendors you like to get updates on their latest products</li>
                    </ul>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-search-line"></i></div>
                            <h3 class="feature-title">Search & Discover</h3>
                            <p class="feature-desc">Find vendors by category, location, or keyword. Filter by rating, price, and more.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-star-line"></i></div>
                            <h3 class="feature-title">Read Reviews</h3>
                            <p class="feature-desc">Every review is from a verified customer. Make informed decisions with real feedback.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-message-line"></i></div>
                            <h3 class="feature-title">Direct Contact</h3>
                            <p class="feature-desc">Message vendors directly. Ask questions and confirm orders securely.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- For Customers Section -->
            <section id="for-customers" class="doc-section">
                <h2 class="section-title"><i class="ri-user-line"></i> For Customers</h2>
                <div class="section-content">
                    <h4>Creating an Account</h4>
                    <ul>
                        <li>Go to <a href="{{ route('register') }}" style="color:var(--primary-color)">Register</a> and select <strong>Customer</strong></li>
                        <li>Fill in your name, email, and password — takes under a minute</li>
                        <li>Verify your email to unlock all features including orders and messaging</li>
                    </ul>
                    <h4>Searching for Vendors</h4>
                    <ul>
                        <li>Use the search bar to search by name, category, or keyword</li>
                        <li>Filter results by location (e.g., "Jimma"), rating (4★+), or category</li>
                        <li>Click any vendor card to view their full profile, products, and reviews</li>
                    </ul>
                    <h4>Placing an Order</h4>
                    <ul>
                        <li>Browse a vendor's products and click <strong>Add to Cart</strong></li>
                        <li>Review your cart, apply any coupon codes, then proceed to checkout</li>
                        <li>Choose your payment method: <strong>Chapa</strong> (online) or <strong>Cash on Delivery</strong></li>
                        <li>Confirm your delivery address and place the order</li>
                        <li>You'll receive an email confirmation with your order number</li>
                    </ul>
                    <h4>Payment with Chapa</h4>
                    <ul>
                        <li>Chapa supports bank transfers, mobile money (Telebirr), and debit/credit cards</li>
                        <li>At checkout, select <strong>Pay with Chapa</strong> and follow the prompts</li>
                        <li>Your payment is secured and encrypted — Vendora never stores your card details</li>
                        <li>You'll receive a payment confirmation SMS and email immediately</li>
                    </ul>
                    <h4>Cash on Delivery</h4>
                    <ul>
                        <li>Select <strong>Cash on Delivery</strong> at checkout</li>
                        <li>Pay the exact amount to the delivery person when your order arrives</li>
                        <li>Available for orders within supported delivery zones in Jimma</li>
                        <li>A delivery fee may apply depending on your location</li>
                    </ul>
                    <h4>Cancellation Policy</h4>
                    <ul>
                        <li>Orders can be cancelled within <strong>1 hour</strong> of placement if not yet processed</li>
                        <li>Go to <strong>My Orders</strong> → select the order → click <strong>Cancel Order</strong></li>
                        <li>Refunds for Chapa payments are processed within 3–5 business days</li>
                        <li>Once an order is marked "Processing" or "Shipped", cancellation is not available</li>
                    </ul>
                    <div class="alert alert-success">
                        <i class="ri-lightbulb-line"></i>
                        <span>Pro tip: Follow vendors you love to get notified when they add new products or run promotions. Use the <strong>Wishlist</strong> to save items for later.</span>
                    </div>
                </div>
            </section>

            <!-- For Vendors Section -->
            <section id="for-vendors" class="doc-section">
                <h2 class="section-title"><i class="ri-store-line"></i> For Vendors</h2>
                <div class="section-content">
                    <h4>Vendor Registration</h4>
                    <ul>
                        <li>Go to <a href="{{ route('register') }}" style="color:var(--primary-color)">Register</a> and select <strong>Vendor</strong></li>
                        <li>Enter your business name, email, phone number, and password</li>
                        <li>Verify your email address to activate your account</li>
                        <li>Complete your business profile: add a description, location, and banner image</li>
                    </ul>
                    <h4>Verification Process</h4>
                    <ul>
                        <li>Submit your business verification documents via <strong>Settings → Store Settings</strong></li>
                        <li>Required: valid government ID, business license (if applicable), and proof of address</li>
                        <li>Our team reviews submissions within <strong>24–48 hours</strong></li>
                        <li>Once verified, your profile displays a <strong>Verified ✓</strong> badge — increasing customer trust</li>
                    </ul>
                    <h4>Managing Your Profile</h4>
                    <ul>
                        <li>Go to <strong>Vendor Dashboard → Settings</strong> to update your business info</li>
                        <li>Upload a high-quality banner image (recommended: 1200×400px) and profile photo</li>
                        <li>Add your business hours, phone number, website, and social media links</li>
                        <li>Set your delivery zones and cash on delivery availability</li>
                    </ul>
                    <h4>Adding Products & Services</h4>
                    <ul>
                        <li>Go to <strong>Dashboard → Products → Add Product</strong></li>
                        <li>Fill in: product name, description, price, stock quantity, and category</li>
                        <li>Upload up to 5 high-quality product images</li>
                        <li>Toggle <strong>Active</strong> to make the product visible to customers immediately</li>
                    </ul>
                    <h4>Getting Paid via Chapa</h4>
                    <ul>
                        <li>Connect your Chapa account in <strong>Settings → Payment Settings</strong></li>
                        <li>Funds are held securely until order delivery is confirmed by the customer</li>
                        <li>Payouts are processed every <strong>7 days</strong> to your registered bank account</li>
                        <li>View earnings and payout history in <strong>Dashboard → Sales Report</strong></li>
                    </ul>
                    <h4>Cash on Delivery Setup</h4>
                    <ul>
                        <li>Enable cash on delivery in <strong>Settings → Delivery Settings</strong></li>
                        <li>Set your supported delivery zones and delivery fee</li>
                        <li>When a COD order is placed, confirm and arrange delivery via <strong>Dashboard → Orders</strong></li>
                        <li>Mark orders as delivered once payment is collected from the customer</li>
                    </ul>
                    <div class="alert alert-warning">
                        <i class="ri-alert-line"></i>
                        <span>Vendor accounts require verification before products are visible to customers. Complete your profile and submit documents to get verified quickly.</span>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="doc-section">
                <h2 class="section-title"><i class="ri-star-line"></i> Payments & Platform Features</h2>
                <div class="section-content">
                    <h4>Chapa Payment Integration</h4>
                    <ul>
                        <li>Supports <strong>bank transfers, Telebirr mobile money, and debit/credit cards</strong></li>
                        <li>All transactions are encrypted with TLS 1.3 and PCI-DSS compliant</li>
                        <li>Customers receive instant payment confirmation via SMS and email</li>
                        <li>Vendors receive weekly payouts with full transaction history</li>
                    </ul>
                    <h4>Cash on Delivery</h4>
                    <ul>
                        <li>Available for orders within Jimma and supported zones</li>
                        <li>No upfront payment required — pay when your order arrives</li>
                        <li>Delivery fee is shown clearly at checkout before you confirm</li>
                    </ul>
                    <h4>Refunds & Disputes</h4>
                    <ul>
                        <li>Open a dispute within <strong>48 hours</strong> of expected delivery if your order has issues</li>
                        <li>Go to <strong>My Orders → View Order → Report Issue</strong></li>
                        <li>Our team resolves disputes within <strong>3–5 business days</strong></li>
                        <li>Approved Chapa refunds are returned to your original payment method within 3–5 business days</li>
                    </ul>
                    <h4>Coupons & Promotions</h4>
                    <ul>
                        <li>Apply coupon codes at checkout in the <strong>Coupon Code</strong> field</li>
                        <li>Find available coupons in <strong>Dashboard → My Coupons</strong></li>
                        <li>Vendors create promotions in <strong>Vendor Dashboard → Promotions</strong></li>
                        <li>Coupons have expiry dates and minimum order requirements — check details before applying</li>
                    </ul>
                    <h4>Invoices & Receipts</h4>
                    <ul>
                        <li>A digital receipt is emailed after every successful order</li>
                        <li>Download invoices from <strong>My Orders → View Order → Download Invoice</strong></li>
                        <li>Vendors download sales reports from <strong>Dashboard → Sales Report</strong></li>
                    </ul>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-global-line"></i></div>
                            <h3 class="feature-title">Multi-language</h3>
                            <p class="feature-desc">English, Amharic, and Oromo — switch anytime from the navbar.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-smartphone-line"></i></div>
                            <h3 class="feature-title">Mobile Friendly</h3>
                            <p class="feature-desc">Fully responsive — works perfectly on phones, tablets, and desktops.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-shield-check-line"></i></div>
                            <h3 class="feature-title">Secure & Verified</h3>
                            <p class="feature-desc">All vendors are verified. Payments are encrypted and PCI-DSS compliant.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-map-pin-2-line"></i></div>
                            <h3 class="feature-title">Location-Based</h3>
                            <p class="feature-desc">Find vendors near you with location-aware search and filtering.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-notification-line"></i></div>
                            <h3 class="feature-title">Real-time Notifications</h3>
                            <p class="feature-desc">Instant alerts for orders, messages, promotions, and status updates.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="ri-coupon-line"></i></div>
                            <h3 class="feature-title">Coupons & Deals</h3>
                            <p class="feature-desc">Save money with vendor coupons and platform-wide promotions.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Guidelines Section -->
            <section id="guidelines" class="doc-section">
                <h2 class="section-title"><i class="ri-shield-check-line"></i> Community Guidelines</h2>
                <div class="section-content">
                    <p>Vendora is built on trust. These guidelines keep our community safe, fair, and welcoming for everyone.</p>
                    <h4>For All Users:</h4>
                    <ul>
                        <li>Be respectful and professional — harassment or abuse results in account suspension</li>
                        <li>Provide honest, accurate reviews based on real experiences only</li>
                        <li>Never share personal information in public reviews or messages</li>
                        <li>Report suspicious activity, fake listings, or policy violations immediately</li>
                        <li>Do not conduct transactions outside the Vendora platform</li>
                    </ul>
                    <h4>For Vendors:</h4>
                    <ul>
                        <li>Keep your business information accurate and up to date at all times</li>
                        <li>Respond to customer messages within <strong>24 hours</strong></li>
                        <li>Deliver products and services exactly as described — no substitutions without customer consent</li>
                        <li>Honor all promotions, coupons, and pricing shown on your profile</li>
                        <li>Do not post fake reviews or incentivize customers to leave biased feedback</li>
                    </ul>
                    <h4>For Customers:</h4>
                    <ul>
                        <li>Leave fair, constructive reviews — personal attacks on vendors are not permitted</li>
                        <li>Honor your orders — repeated cancellations may restrict your account</li>
                        <li>Communicate clearly and respectfully with vendors</li>
                        <li>Report issues through the platform before leaving negative reviews</li>
                    </ul>
                    <div class="alert alert-warning">
                        <i class="ri-alert-line"></i>
                        <span>Violations may result in warnings, temporary suspension, or permanent account removal depending on severity.</span>
                    </div>
                </div>
            </section>

            <!-- Support Section -->
            <section id="support" class="doc-section">
                <h2 class="section-title"><i class="ri-customer-service-line"></i> Support & Help</h2>
                <div class="section-content">
                    <p>Our support team is based in Jimma and available in English, Amharic, and Oromo.</p>
                    <h4>Self-Service Resources:</h4>
                    <ul>
                        <li><strong><a href="{{ route('help-center') }}" style="color:var(--primary-color)">Help Center:</a></strong> Browse FAQs and step-by-step guides organized by topic</li>
                        <li><strong><a href="{{ route('how-it-works') }}" style="color:var(--primary-color)">How It Works:</a></strong> Visual walkthrough of the platform for new users</li>
                        <li><strong><a href="{{ route('trust-safety') }}" style="color:var(--primary-color)">Trust & Safety:</a></strong> Learn about our verification and security practices</li>
                    </ul>
                    <h4>Contact Support:</h4>
                    <ul>
                        <li><strong>Email:</strong> <a href="mailto:support@vendora.com" style="color:var(--primary-color)">support@vendora.com</a> — response within 24 hours</li>
                        <li><strong>Phone:</strong> <a href="tel:+251911234567" style="color:var(--primary-color)">+251 91 123 4567</a> — Mon–Fri, 8:00 AM – 6:00 PM</li>
                        <li><strong>In-App Messaging:</strong> Use the <strong>Contact</strong> button on any vendor profile</li>
                        <li><strong>Office:</strong> Jimma, Oromia, Ethiopia</li>
                    </ul>
                    <h4>Reporting Issues:</h4>
                    <ul>
                        <li><strong>Order problems:</strong> <strong>My Orders → View Order → Report Issue</strong></li>
                        <li><strong>Vendor complaints:</strong> Use the <strong>Report</strong> button on the vendor's profile page</li>
                        <li><strong>Payment disputes:</strong> Email <a href="mailto:payments@vendora.com" style="color:var(--primary-color)">payments@vendora.com</a> with your order number</li>
                        <li><strong>Account issues:</strong> Email <a href="mailto:support@vendora.com" style="color:var(--primary-color)">support@vendora.com</a> with your registered email</li>
                    </ul>
                    <div class="alert alert-info">
                        <i class="ri-mail-line"></i>
                        <span>For the fastest response, include your <strong>order number</strong> or <strong>account email</strong> in all support requests.</span>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-theme', newTheme);
            
            // Save theme preference
            fetch('{{ route("theme.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: newTheme })
            }).then(response => {
                if (response.ok) {
                    // Update icon
                    const icon = document.querySelector('.theme-toggle i');
                    icon.className = `ri-${newTheme === 'dark' ? 'sun' : 'moon'}-line`;
                }
            }).catch(error => {
                console.error('Error toggling theme:', error);
            });
        }

        // Smooth Scrolling for Navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Handle sidebar navigation
            const navLinks = document.querySelectorAll('.sidebar-nav a');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Scroll to section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        const offsetTop = targetSection.offsetTop - 100;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Update active navigation on scroll
            const sections = document.querySelectorAll('.doc-section');
            
            function updateActiveNav() {
                const scrollPos = window.scrollY + 150;
                
                sections.forEach(section => {
                    const top = section.offsetTop;
                    const height = section.offsetHeight;
                    const id = section.getAttribute('id');
                    
                    if (scrollPos >= top && scrollPos < top + height) {
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === '#' + id) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }

            window.addEventListener('scroll', updateActiveNav);
            updateActiveNav(); // Initial call
        });
    </script>
</body>
</html>