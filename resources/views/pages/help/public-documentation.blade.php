<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Documentation - Vendora | Local Vendor Finder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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
            <i class="ri-store-2-fill"></i>
            Vendora
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
                <h2 class="section-title">
                    <i class="ri-home-line"></i>
                    Overview
                </h2>
                <div class="section-content">
                    <p>
                        Vendora is a comprehensive local vendor finder platform designed to connect customers with local businesses in Jimma, Ethiopia. Our platform makes it easy to discover, review, and engage with local vendors across various categories.
                    </p>
                    <p>
                        Whether you're looking for restaurants, shops, services, or entertainment, Vendora helps you find the best local businesses with detailed information, customer reviews, and direct communication channels.
                    </p>
                    
                    <div class="alert alert-info">
                        <i class="ri-information-line"></i>
                        <span>Vendora supports multiple languages including English, Amharic (አማርኛ), and Oromo (Afaan Oromoo) to serve our diverse community.</span>
                    </div>
                </div>
            </section>

            <!-- Getting Started Section -->
            <section id="getting-started" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-rocket-line"></i>
                    Getting Started
                </h2>
                <div class="section-content">
                    <p>Getting started with Vendora is simple and takes just a few minutes:</p>
                    <ul>
                        <li><strong>Browse as Guest:</strong> Explore vendors and services without creating an account</li>
                        <li><strong>Create Account:</strong> Sign up as a customer or vendor for full features</li>
                        <li><strong>Verify Email:</strong> Complete email verification for security</li>
                        <li><strong>Complete Profile:</strong> Add your information for better recommendations</li>
                        <li><strong>Start Exploring:</strong> Search, review, and connect with local vendors</li>
                    </ul>

                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-search-line"></i>
                            </div>
                            <h3 class="feature-title">Search & Discover</h3>
                            <p class="feature-desc">Find local vendors by category, location, or keywords with our powerful search engine.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-star-line"></i>
                            </div>
                            <h3 class="feature-title">Read Reviews</h3>
                            <p class="feature-desc">Make informed decisions with authentic customer reviews and ratings.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-message-line"></i>
                            </div>
                            <h3 class="feature-title">Direct Contact</h3>
                            <p class="feature-desc">Connect directly with vendors through our messaging system.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- For Customers Section -->
            <section id="for-customers" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-user-line"></i>
                    For Customers
                </h2>
                <div class="section-content">
                    <p>As a customer on Vendora, you have access to powerful tools to discover and engage with local businesses:</p>
                    
                    <h4>Key Features:</h4>
                    <ul>
                        <li><strong>Advanced Search:</strong> Filter vendors by category, location, ratings, and more</li>
                        <li><strong>Wishlist:</strong> Save your favorite vendors for quick access</li>
                        <li><strong>Reviews & Ratings:</strong> Share your experiences and help others</li>
                        <li><strong>Direct Messaging:</strong> Contact vendors directly through the platform</li>
                        <li><strong>Order Tracking:</strong> Track your orders and purchases</li>
                        <li><strong>Personalized Recommendations:</strong> Get suggestions based on your preferences</li>
                    </ul>

                    <div class="alert alert-success">
                        <i class="ri-lightbulb-line"></i>
                        <span>Pro tip: Use the wishlist feature to save vendors you're interested in and receive updates about their latest offerings!</span>
                    </div>
                </div>
            </section>

            <!-- For Vendors Section -->
            <section id="for-vendors" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-store-line"></i>
                    For Vendors
                </h2>
                <div class="section-content">
                    <p>Grow your business with Vendora's comprehensive vendor platform:</p>
                    
                    <h4>Vendor Dashboard Features:</h4>
                    <ul>
                        <li><strong>Business Profile:</strong> Showcase your products, services, and business information</li>
                        <li><strong>Product Management:</strong> Add, edit, and manage your product catalog</li>
                        <li><strong>Order Management:</strong> Process and track customer orders efficiently</li>
                        <li><strong>Customer Analytics:</strong> View insights about your customers and sales</li>
                        <li><strong>Review Management:</strong> Respond to customer reviews and build your reputation</li>
                        <li><strong>Promotion Tools:</strong> Create special offers and promotions</li>
                    </ul>

                    <div class="alert alert-warning">
                        <i class="ri-alert-line"></i>
                        <span>Vendor accounts require verification to ensure trust and authenticity for all customers.</span>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-star-line"></i>
                    Platform Features
                </h2>
                <div class="section-content">
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-global-line"></i>
                            </div>
                            <h3 class="feature-title">Multi-language Support</h3>
                            <p class="feature-desc">Available in English, Amharic, and Oromo to serve our diverse community.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-smartphone-line"></i>
                            </div>
                            <h3 class="feature-title">Mobile Responsive</h3>
                            <p class="feature-desc">Access Vendora on any device with our fully responsive design.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-shield-check-line"></i>
                            </div>
                            <h3 class="feature-title">Secure Platform</h3>
                            <p class="feature-desc">Your data is protected with industry-standard security measures.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-map-pin-2-line"></i>
                            </div>
                            <h3 class="feature-title">Location-Based</h3>
                            <p class="feature-desc">Find vendors near you with our location-based search system.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-notification-line"></i>
                            </div>
                            <h3 class="feature-title">Real-time Updates</h3>
                            <p class="feature-desc">Get instant notifications about orders, messages, and updates.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="ri-customer-service-line"></i>
                            </div>
                            <h3 class="feature-title">24/7 Support</h3>
                            <p class="feature-desc">Our support team is always here to help you succeed.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Guidelines Section -->
            <section id="guidelines" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-shield-check-line"></i>
                    Community Guidelines
                </h2>
                <div class="section-content">
                    <p>To maintain a safe and trustworthy platform, please follow these guidelines:</p>
                    
                    <h4>For All Users:</h4>
                    <ul>
                        <li>Be respectful and professional in all interactions</li>
                        <li>Provide honest and accurate reviews</li>
                        <li>Respect privacy and personal information</li>
                        <li>Report suspicious activity to our support team</li>
                    </ul>

                    <h4>For Vendors:</h4>
                    <ul>
                        <li>Maintain accurate business information</li>
                        <li>Respond promptly to customer inquiries</li>
                        <li>Deliver products and services as described</li>
                        <li>Honor all promotions and commitments</li>
                    </ul>

                    <h4>For Customers:</h4>
                    <ul>
                        <li>Provide constructive and fair feedback</li>
                        <li>Honor your commitments and orders</li>
                        <li>Communicate clearly with vendors</li>
                        <li>Report any issues promptly</li>
                    </ul>
                </div>
            </section>

            <!-- Support Section -->
            <section id="support" class="doc-section">
                <h2 class="section-title">
                    <i class="ri-customer-service-line"></i>
                    Support & Help
                </h2>
                <div class="section-content">
                    <p>We're here to help you make the most of Vendora:</p>
                    
                    <h4>Get Help:</h4>
                    <ul>
                        <li><strong>Help Center:</strong> Browse our comprehensive FAQ and guides</li>
                        <li><strong>Contact Support:</strong> Reach out to our support team directly</li>
                        <li><strong>Community Forum:</strong> Connect with other users and vendors</li>
                        <li><strong>Video Tutorials:</strong> Watch step-by-step guides for common tasks</li>
                    </ul>

                    <div class="alert alert-info">
                        <i class="ri-mail-line"></i>
                        <span>For urgent support, email us at support@vendora.com or call +251-XXX-XXXX</span>
                    </div>

                    <h4>Contact Information:</h4>
                    <ul>
                        <li><strong>Email:</strong> support@vendora.com</li>
                        <li><strong>Phone:</strong> +251-XXX-XXXX</li>
                        <li><strong>Office:</strong> Jimma, Ethiopia</li>
                        <li><strong>Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM</li>
                    </ul>
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