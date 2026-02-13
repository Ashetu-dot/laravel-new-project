<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Terms of Service - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #333333;
            --text-light: #777777;
            --bg-body: #F7F7F7;
            --white: #ffffff;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 28px;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }

        .logo i {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
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

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
            width: 100%;
        }

        .page-card {
            background: var(--white);
            border-radius: 16px;
            padding: 48px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .page-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .page-header .last-updated {
            color: var(--text-light);
            font-size: 14px;
        }

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

        .page-section {
            margin-bottom: 40px;
        }

        .page-section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .page-section h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 24px 0 12px;
            color: var(--text-dark);
        }

        .page-section p {
            color: var(--text-light);
            margin-bottom: 16px;
        }

        .page-section ul, .page-section ol {
            margin-bottom: 16px;
            padding-left: 24px;
            color: var(--text-light);
        }

        .page-section li {
            margin-bottom: 8px;
        }

        .highlight-box {
            background-color: #f9fafb;
            border-left: 4px solid var(--primary-gold);
            padding: 20px;
            border-radius: 8px;
            margin: 24px 0;
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-light);
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 13px;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive */
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
                font-size: 28px;
            }
            .page-section h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .page-card {
                padding: 24px 16px;
            }
            .page-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('search.results') }}" class="nav-link">Browse</a>
            @guest
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            @else
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-link">Profile</a>
                @if(Auth::user()->role === 'vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
                @elseif(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                @endif
            @endguest
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
                    <p style="margin-bottom: 0; font-weight: 600;">📍 Jimma, Ethiopia – These terms govern your use of our local marketplace platform.</p>
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
                <ul>
                    <li>Commission rates: 10% on each sale</li>
                    <li>Payouts are processed weekly</li>
                    <li>Minimum payout: 500 ETB</li>
                </ul>
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
                <ul>
                    <li><strong>Email:</strong> legal@vendora.com</li>
                    <li><strong>Phone:</strong> +251 47 111 2233</li>
                    <li><strong>Address:</strong> Jimma University Technology Park, Jimma, Ethiopia</li>
                </ul>
            </div>
        </div>

    </main>

    <footer>
        <div class="footer-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('search.results') }}">Browse</a>
            <a href="{{ route('register') }}">Become a Vendor</a>
            <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
            <a href="{{ route('terms.service') }}">Terms of Service</a>
        </div>
        <p>&copy; {{ date('Y') }} Vendora Marketplace. Connecting Jimma with local vendors. All rights reserved.</p>
    </footer>

</body>
</html>
