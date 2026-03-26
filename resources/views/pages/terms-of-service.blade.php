<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="Terms of Service for Vendora - Jimma's premier local marketplace platform">
    <meta name="theme-color" content="#B88E3F">
    <title>Terms of Service - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
            font-display: swap;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-dark: #8B6B2F;
            --primary-light: #E5D4B3;
            --secondary-green: #078930;
            --secondary-yellow: #FCDD09;
            --secondary-red: #DA121A;
            --text-dark: #1E1E1E;
            --text-medium: #4A4A4A;
            --text-light: #6B7280;
            --bg-body: #F9FAFB;
            --white: #FFFFFF;
            --border-color: #E5E7EB;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --gradient-ethiopia: linear-gradient(135deg, var(--secondary-green) 0%, var(--secondary-yellow) 50%, var(--secondary-red) 100%);
            --gradient-gold: linear-gradient(135deg, var(--primary-gold), var(--primary-dark));
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Modern Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 16px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(184, 142, 63, 0.1);
        }

        .logo {
            font-size: 28px;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo i {
            font-size: 32px;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: var(--gradient-ethiopia);
            color: white;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
            box-shadow: var(--shadow-md);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }

        .nav-links {
            display: flex;
            gap: 32px;
        }

        .nav-link {
            color: var(--text-medium);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 8px 0;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 24px;
            width: 100%;
        }

        .page-card {
            background: var(--white);
            border-radius: 24px;
            padding: 48px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(184, 142, 63, 0.1);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header {
            margin-bottom: 48px;
            text-align: center;
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--gradient-gold);
            border-radius: 2px;
        }

        .page-header h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 16px;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header .last-updated {
            color: var(--text-light);
            font-size: 14px;
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            border-radius: 30px;
            font-weight: 500;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-medium);
            text-decoration: none;
            margin-bottom: 24px;
            padding: 10px 20px;
            background: var(--white);
            border-radius: 30px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-gold);
            box-shadow: var(--shadow-md);
            transform: translateX(-5px);
        }

        .page-section {
            margin-bottom: 48px;
            padding-bottom: 24px;
            border-bottom: 1px dashed var(--border-color);
        }

        .page-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .page-section h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-section h2::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 30px;
            background: var(--gradient-gold);
            border-radius: 4px;
        }

        .page-section h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 28px 0 16px;
            color: var(--primary-dark);
        }

        .page-section p {
            color: var(--text-medium);
            margin-bottom: 16px;
            font-size: 16px;
        }

        .page-section ul, .page-section ol {
            margin-bottom: 20px;
            padding-left: 30px;
            color: var(--text-medium);
        }

        .page-section li {
            margin-bottom: 12px;
            position: relative;
        }

        .page-section li::marker {
            color: var(--primary-gold);
        }

        .highlight-box {
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
            border-left: 4px solid var(--primary-gold);
            padding: 24px;
            border-radius: 12px;
            margin: 28px 0;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .highlight-box::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: var(--primary-gold);
            opacity: 0.05;
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .highlight-box p {
            margin-bottom: 0;
            font-weight: 600;
            color: var(--text-dark);
            position: relative;
            z-index: 1;
        }

        /* Fee Cards */
        .fee-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .fee-card {
            background: linear-gradient(135deg, #f9fafb, #ffffff);
            padding: 20px;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            text-align: center;
            border: 1px solid rgba(184, 142, 63, 0.1);
            transition: transform 0.3s ease;
        }

        .fee-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .fee-card i {
            font-size: 32px;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .fee-card .fee-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-gold);
            margin: 8px 0;
        }

        .fee-card .fee-label {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Contact Info */
        .contact-info {
            background: linear-gradient(135deg, #1E1E1E, #2D2D2D);
            color: white;
            padding: 32px;
            border-radius: 16px;
            margin-top: 20px;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
        }

        .contact-info li {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-info li:last-child {
            border-bottom: none;
        }

        .contact-info i {
            font-size: 24px;
            color: var(--primary-gold);
            width: 30px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1E1E1E, #2D2D2D);
            padding: 60px 0 40px;
            color: white;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-section h4 {
            color: var(--primary-gold);
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer-section p {
            color: #9CA3AF;
            line-height: 1.8;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: #9CA3AF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary-gold);
        }

        .social-links {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-gold);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #9CA3AF;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar {
                padding: 16px 32px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 16px 24px;
            }
            .nav-links {
                display: none;
            }
            .page-card {
                padding: 32px 24px;
            }
            .page-header h1 {
                font-size: 32px;
            }
            .page-section h2 {
                font-size: 24px;
            }
            .fee-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 12px 16px;
            }
            .logo {
                font-size: 24px;
            }
            .logo i {
                font-size: 28px;
            }
            .ethiopia-badge {
                padding: 4px 10px;
                font-size: 10px;
            }
            .page-card {
                padding: 24px 16px;
            }
            .page-header h1 {
                font-size: 28px;
            }
            .page-section h2 {
                font-size: 20px;
            }
            .contact-info {
                padding: 20px;
            }
        }

        /* Print Styles */
        @media print {
            .navbar, .back-link, footer {
                display: none;
            }
            .page-card {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Modern Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">{{ __('nav.home') }}</a>
            <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
            <a href="{{ route('about') }}" class="nav-link">{{ __('nav.about') }}</a>
            <a href="{{ route('contact') }}" class="nav-link">{{ __('nav.contact') }}</a>
            <a href="{{ route('login') }}" class="nav-link btn-signup">{{ __('nav.sign_in') }}</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">

        <a href="javascript:history.back()" class="back-link">
            <i class="ri-arrow-left-line"></i> Back
        </a>

        <div class="page-card">
            <div class="page-header">
                <h1>Terms of Service</h1>
                <p class="last-updated">Last Updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="page-section">
                <h2>Welcome to Vendora</h2>
                <p>By accessing or using Vendora's marketplace platform in Jimma, Ethiopia, you agree to be bound by these Terms of Service. Please read them carefully.</p>

                <div class="highlight-box">
                    <p style="margin-bottom: 0;">📍 Jimma, Ethiopia – These terms govern your use of our local marketplace platform.</p>
                </div>
            </div>

            <div class="page-section">
                <h2>1. Account Registration</h2>
                <p>To use our services, you must register for an account. You agree to:</p>
                <ul>
                    <li>Provide accurate and complete information</li>
                    <li>Maintain the security of your account credentials</li>
                    <li>Promptly update any changes to your information</li>
                    <li>Notify us immediately of unauthorized access</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>2. Vendor Terms</h2>
                <p>If you register as a vendor on Vendora, you agree to:</p>
                <ul>
                    <li>Provide accurate information about your business</li>
                    <li>List products that comply with Ethiopian laws</li>
                    <li>Fulfill orders in a timely manner</li>
                    <li>Pay applicable fees and commissions</li>
                    <li>Maintain high-quality customer service</li>
                    <li>Respond to customer inquiries promptly</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>3. Customer Terms</h2>
                <p>If you use our platform as a customer, you agree to:</p>
                <ul>
                    <li>Provide accurate payment information</li>
                    <li>Not engage in fraudulent activities</li>
                    <li>Respect vendor intellectual property</li>
                    <li>Provide honest reviews and feedback</li>
                    <li>Communicate respectfully with vendors</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>4. Prohibited Activities</h2>
                <p>You may not use the platform for any unlawful purpose or to:</p>
                <ul>
                    <li>Violate any Ethiopian laws or regulations</li>
                    <li>Infringe upon intellectual property rights</li>
                    <li>Transmit harmful code or malware</li>
                    <li>Harass, abuse, or harm others</li>
                    <li>Impersonate any person or entity</li>
                    <li>List prohibited or illegal items</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>5. Fees and Payments</h2>
                <p>Vendors agree to pay all applicable fees as described on our platform. All payments are processed securely in Ethiopian Birr (ETB). Fees are non-refundable except as required by law.</p>
                
                <div class="fee-grid">
                    <div class="fee-card">
                        <i class="ri-percent-line"></i>
                        <div class="fee-value">10%</div>
                        <div class="fee-label">Commission per sale</div>
                    </div>
                    <div class="fee-card">
                        <i class="ri-calendar-line"></i>
                        <div class="fee-value">Weekly</div>
                        <div class="fee-label">Payout schedule</div>
                    </div>
                    <div class="fee-card">
                        <i class="ri-money-dollar-circle-line"></i>
                        <div class="fee-value">500 ETB</div>
                        <div class="fee-label">Minimum payout</div>
                    </div>
                </div>
            </div>

            <div class="page-section">
                <h2>6. Intellectual Property</h2>
                <p>The platform and its original content, features, and functionality are owned by Vendora and are protected by Ethiopian and international copyright, trademark, and intellectual property laws.</p>
            </div>

            <div class="page-section">
                <h2>7. Termination</h2>
                <p>We may terminate or suspend your account immediately, without prior notice, for any reason, including breach of these Terms. You may terminate your account at any time through your profile settings.</p>
            </div>

            <div class="page-section">
                <h2>8. Limitation of Liability</h2>
                <p>Vendora shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the platform. Our total liability shall not exceed the amount you paid us in the past 12 months.</p>
            </div>

            <div class="page-section">
                <h2>9. Dispute Resolution</h2>
                <p>Any disputes arising under these Terms shall be resolved through:</p>
                <ol>
                    <li>Informal negotiation</li>
                    <li>Mediation in Jimma, Ethiopia</li>
                    <li>Binding arbitration in accordance with Ethiopian law</li>
                </ol>
            </div>

            <div class="page-section">
                <h2>10. Governing Law</h2>
                <p>These Terms shall be governed by and construed in accordance with the laws of the Federal Democratic Republic of Ethiopia, without regard to its conflict of law provisions.</p>
            </div>

            <div class="page-section">
                <h2>11. Changes to Terms</h2>
                <p>We reserve the right to modify these Terms at any time. We will notify users of material changes via email or platform notification. Continued use constitutes acceptance of modified Terms.</p>
            </div>

            <div class="page-section">
                <h2>12. Contact Information</h2>
                <p>For questions about these Terms, please contact us:</p>
                <div class="contact-info">
                    <ul>
                        <li>
                            <i class="ri-mail-line"></i>
                            <strong>Email:</strong> legal@vendora.com
                        </li>
                        <li>
                            <i class="ri-phone-line"></i>
                            <strong>Phone:</strong> +251 47 111 2233
                        </li>
                        <li>
                            <i class="ri-map-pin-line"></i>
                            <strong>Address:</strong> Jimma University Technology Park, Jimma, Ethiopia
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </main>

    <!-- Enhanced Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>About Vendora</h4>
                <p>Jimma's premier local marketplace connecting buyers with trusted vendors. Experience the best of Ethiopian commerce.</p>
                <div class="social-links">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                    <a href="#"><i class="ri-instagram-fill"></i></a>
                    <a href="#"><i class="ri-telegram-fill"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('search.results') }}">Browse Products</a></li>
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Info</h4>
                <ul>
                    <li><i class="ri-map-pin-line"></i> Jimma, Ethiopia</li>
                    <li><i class="ri-phone-line"></i> +251 47 111 2233</li>
                    <li><i class="ri-mail-line"></i> info@vendora.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>