<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Contact Us - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    {{--  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-bg: #f3f4f6;
            --navbar-bg: #ffffff;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: var(--shadow-sm);
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

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo i {
            color: var(--primary-gold);
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
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .nav-link.active {
            color: var(--primary-gold);
            font-weight: 600;
        }

        .btn-login {
            background-color: var(--primary-gold);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: var(--primary-gold-hover);
        }

        /* Mobile menu */
        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 0;
            }

            .nav-links.active {
                display: flex;
            }
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            width: 100%;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .page-header h1 i {
            color: var(--primary-gold);
            margin-right: 0.5rem;
        }

        .page-header p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Contact Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Contact Info Cards */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid transparent;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-gold);
        }

        .info-icon {
            width: 48px;
            height: 48px;
            background-color: #fef3e7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .info-icon i {
            font-size: 1.5rem;
            color: var(--primary-gold);
        }

        .info-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 0.25rem;
        }

        .info-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 500;
            margin-top: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: gap 0.2s;
        }

        .info-link:hover {
            gap: 0.5rem;
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background-color: #fef3e7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            text-decoration: none;
            transition: all 0.2s;
        }

        .social-link:hover {
            background-color: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* Contact Form */
        .contact-form-container {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .contact-form-container h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .form-label i {
            color: var(--primary-gold);
            margin-right: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-control.error {
            border-color: var(--danger-color);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .error-message {
            color: var(--danger-color);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-submit {
            background-color: var(--primary-gold);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            justify-content: center;
        }

        .btn-submit:hover:not(:disabled) {
            background-color: var(--primary-gold-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Map Section */
        .map-section {
            margin-top: 3rem;
        }

        .map-container {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .map-placeholder {
            background-color: #1f2937;
            border-radius: 0.5rem;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .map-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .map-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 0.5rem;
        }

        .map-overlay i {
            font-size: 3rem;
            color: var(--primary-gold);
        }

        .map-overlay span {
            font-size: 1.125rem;
            font-weight: 600;
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 3rem;
        }

        .faq-section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .faq-item {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s;
        }

        .faq-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .faq-question {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .faq-question i {
            color: var(--primary-gold);
            font-size: 1.25rem;
        }

        .faq-question h3 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .faq-answer {
            color: var(--text-secondary);
            line-height: 1.6;
            padding-left: 2rem;
        }

        /* Footer */
        .footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 2rem;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        .copyright {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            
        </a>

        <div class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>

        <div class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('vendors.search') }}" class="nav-link">Vendors</a>
            <a href="{{ route('how-it-works') }}" class="nav-link">How It Works</a>
            <a href="{{ route('contact') }}" class="nav-link active">Contact</a>
            @guest
                <a href="{{ route('login') }}" class="btn-login">Sign In</a>
           @else
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn-login">Admin Dashboard</a>
            @elseif(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="btn-login">Vendor Dashboard</a>
            @else
                <a href="{{ route('customer.dashboard') }}" class="btn-login">My Dashboard</a>
            @endif

            @endguest
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1>
                <i class="ri-customer-service-2-line"></i>
                Contact Us
            </h1>
            <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <!-- Contact Grid -->
        <div class="contact-grid">
            <!-- Contact Info Cards -->
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="ri-map-pin-line"></i>
                    </div>
                    <h3>Visit Us</h3>
                    <p>Jimma University Technology Park</p>
                    <p>Jimma, Oromia, Ethiopia</p>
                    <p>P.O. Box 378</p>
                    <a href="https://maps.google.com/?q=Jimma+University+Technology+Park" target="_blank" class="info-link">
                        Get Directions <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="ri-phone-line"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p>Main Office: +251 912 345 678</p>
                    <p>Customer Support: +251 987 654 321</p>
                    <p>Mon-Fri, 9am - 6pm</p>
                    <a href="tel:+251912345678" class="info-link">
                        Call Now <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="ri-mail-line"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p>General: info@vendora.com</p>
                    <p>Support: support@vendora.com</p>
                    <p>Sales: sales@vendora.com</p>
                    <a href="mailto:info@vendora.com" class="info-link">
                        Send Email <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>

                <div class="info-card">
                    <h3>Follow Us</h3>
                    <p>Stay connected on social media</p>
                    <div class="social-links">
                        <a href="#" class="social-link" target="_blank">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank">
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank">
                            <i class="ri-telegram-fill"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-container">
                <h2>Send Us a Message</h2>

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

                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="ri-error-warning-line"></i>
                        <ul style="margin-left: 1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="ri-user-line"></i> Your Name
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control @error('name') error @enderror" 
                                   placeholder="John Doe"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="ri-mail-line"></i> Email Address
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control @error('email') error @enderror" 
                                   placeholder="you@example.com"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <div class="error-message">
                                    <i class="ri-error-warning-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">
                            <i class="ri-question-line"></i> Subject
                        </label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               class="form-control @error('subject') error @enderror" 
                               placeholder="What's this about?"
                               value="{{ old('subject') }}"
                               required>
                        @error('subject')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">
                            <i class="ri-message-3-line"></i> Message
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  class="form-control @error('message') error @enderror" 
                                  placeholder="Tell us how we can help..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-message">
                                <i class="ri-error-warning-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Send Message</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
            <div class="map-container">
                <div class="map-placeholder">
                    <!-- Replace with actual Google Maps embed -->
                    <img src="https://via.placeholder.com/1200x300/1f2937/ffffff?text=Jimma+University+Technology+Park" alt="Map">
                    <div class="map-overlay">
                        <i class="ri-map-pin-2-fill"></i>
                        <span>Jimma University Technology Park</span>
                        <span style="font-size: 0.875rem;">Jimma, Oromia, Ethiopia</span>
                    </div>
                </div>
            </div>
        </div>



        <!-- FAQ Section -->
        <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ri-question-line"></i>
                        <h3>How do I become a vendor?</h3>
                    </div>
                    <div class="faq-answer">
                        Click on "Sign Up" and select "Vendor" account type. Fill in your business details and submit for approval.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ri-question-line"></i>
                        <h3>What payment methods do you accept?</h3>
                    </div>
                    <div class="faq-answer">
                        We accept Cash on Delivery, Telebirr, Bank Transfer, and Chapa payment for online transactions.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ri-question-line"></i>
                        <h3>How long does vendor approval take?</h3>
                    </div>
                    <div class="faq-answer">
                        Vendor approval typically takes 24-48 hours. You'll receive an email notification once approved.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ri-question-line"></i>
                        <h3>Do you offer customer support?</h3>
                    </div>
                    <div class="faq-answer">
                        Yes, our support team is available Monday-Friday, 9am-6pm via phone, email, and live chat.
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="copyright">
                &copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia
            </div>
            <div class="footer-links">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const navLinks = document.getElementById('navLinks');

            if (menuToggle && navLinks) {
                menuToggle.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                });
            }

            // Form submission with loading state
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        return;
                    }

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner"></span> Sending...';
                });
            }

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Email validation
        document.getElementById('email')?.addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = '<i class="ri-error-warning-fill"></i> Please enter a valid email address';
                
                const existingError = this.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }
                
                this.parentElement.appendChild(errorDiv);
                this.classList.add('error');
            } else {
                this.classList.remove('error');
                const existingError = this.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }
            }
        });

        // Phone number formatting (if needed)
        document.getElementById('phone')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length > 0) {
                if (value.startsWith('251')) {
                    if (value.length > 12) value = value.slice(0, 12);
                } else if (value.startsWith('0')) {
                    value = '251' + value.slice(1);
                    if (value.length > 12) value = value.slice(0, 12);
                } else {
                    value = '251' + value;
                    if (value.length > 12) value = value.slice(0, 12);
                }
                
                if (value.length >= 5) {
                    value = '+' + value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
                }
                
                e.target.value = value;
            }
        });
    </script>

</body>
</html>