<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Privacy Policy - Vendora | Jimma, Ethiopia</title>
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

        .page-section ul {
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
                <h1>Privacy Policy</h1>
                <p class="last-updated">Last Updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="page-section">
                <h2>Our Commitment to Your Privacy</h2>
                <p>At Vendora, we take your privacy seriously. This policy describes how we collect, use, and protect your personal information when you use our marketplace platform in Jimma, Ethiopia.</p>

                <div class="highlight-box">
                    <p style="margin-bottom: 0; font-weight: 600;">📍 Jimma, Ethiopia – Your local data is protected under Ethiopian law and international standards.</p>
                </div>
            </div>

            <div class="page-section">
                <h2>Information We Collect</h2>

                <h3>1. Account Information</h3>
                <ul>
                    <li>Full name and contact details</li>
                    <li>Email address and phone number</li>
                    <li>Business information for vendors</li>
                    <li>Payment information (processed securely)</li>
                </ul>

                <h3>2. Usage Information</h3>
                <ul>
                    <li>Products you view and purchase</li>
                    <li>Vendors you follow</li>
                    <li>Search history and preferences</li>
                    <li>Location data (city/region)</li>
                </ul>

                <h3>3. Technical Information</h3>
                <ul>
                    <li>IP address and browser type</li>
                    <li>Device information</li>
                    <li>Cookies and similar technologies</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>How We Use Your Information</h2>
                <ul>
                    <li>To provide and improve our marketplace services</li>
                    <li>To connect you with local vendors in Jimma</li>
                    <li>To process your orders and payments</li>
                    <li>To send you important updates and notifications</li>
                    <li>To personalize your experience</li>
                    <li>To prevent fraud and ensure security</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>Information Sharing</h2>
                <p>We do not sell your personal information. We may share your information with:</p>
                <ul>
                    <li><strong>Vendors:</strong> When you place an order, relevant information is shared with the vendor</li>
                    <li><strong>Service Providers:</strong> Payment processors, delivery services, and technical support</li>
                    <li><strong>Legal Requirements:</strong> When required by Ethiopian law</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>Your Rights</h2>
                <p>Under Ethiopian data protection law, you have the right to:</p>
                <ul>
                    <li>Access your personal information</li>
                    <li>Correct inaccurate data</li>
                    <li>Request deletion of your data</li>
                    <li>Object to data processing</li>
                    <li>Data portability</li>
                </ul>
                <p>To exercise these rights, contact us at <a href="mailto:privacy@vendora.com" style="color: var(--primary-gold);">privacy@vendora.com</a></p>
            </div>

            <div class="page-section">
                <h2>Data Security</h2>
                <p>We implement appropriate technical and organizational measures to protect your data, including:</p>
                <ul>
                    <li>Encryption of sensitive information</li>
                    <li>Regular security assessments</li>
                    <li>Access controls and authentication</li>
                    <li>Secure data storage</li>
                </ul>
            </div>

            <div class="page-section">
                <h2>Cookies</h2>
                <p>We use cookies to improve your experience, including:</p>
                <ul>
                    <li>Essential cookies for site functionality</li>
                    <li>Preference cookies to remember your settings</li>
                    <li>Analytics cookies to understand usage</li>
                </ul>
                <p>You can control cookies through your browser settings.</p>
            </div>

            <div class="page-section">
                <h2>Children's Privacy</h2>
                <p>Our services are not directed to individuals under 18. We do not knowingly collect information from children.</p>
            </div>

            <div class="page-section">
                <h2>Changes to This Policy</h2>
                <p>We may update this privacy policy periodically. We will notify you of significant changes through our website or email.</p>
            </div>

            <div class="page-section">
                <h2>Contact Us</h2>
                <p>If you have questions about this privacy policy, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> privacy@vendora.com</li>
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
