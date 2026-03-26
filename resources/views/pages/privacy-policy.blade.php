<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="Privacy Policy for Vendora - Your trusted local marketplace in Jimma, Ethiopia. Learn how we protect your data.">
    <meta name="theme-color" content="#B88E3F">
    <title>Privacy Policy - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
            font-display: swap;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-dark: #8B6B2F;
            --primary-light: #E5D4B3;
            --primary-soft: rgba(184, 142, 63, 0.1);
            --secondary-green: #078930;
            --secondary-yellow: #FCDD09;
            --secondary-red: #DA121A;
            --text-dark: #1E293B;
            --text-medium: #334155;
            --text-light: #64748B;
            --text-soft: #94A3B8;
            --bg-body: #F8FAFC;
            --bg-card: #FFFFFF;
            --bg-soft: #F1F5F9;
            --border-color: #E2E8F0;
            --border-soft: #EDF2F7;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            --shadow-gold: 0 10px 25px -5px rgba(184, 142, 63, 0.3);
            --gradient-gold: linear-gradient(135deg, var(--primary-gold), var(--primary-dark));
            --gradient-ethiopia: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            --gradient-soft: linear-gradient(135deg, #F8FAFC, #F1F5F9);
            --gradient-card: linear-gradient(135deg, #FFFFFF, #F8FAFC);
            --success-light: #D1FAE5;
            --success-dark: #065F46;
            --info-light: #DBEAFE;
            --info-dark: #1E40AF;
            --warning-light: #FEF3C7;
            --warning-dark: #92400E;
            --error-light: #FEE2E2;
            --error-dark: #991B1B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.02) 0%, transparent 20%),
                              radial-gradient(circle at 90% 80%, rgba(184, 142, 63, 0.02) 0%, transparent 20%);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Modern Glass Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 16px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(184, 142, 63, 0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
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
            gap: 4px;
            padding: 4px 12px;
            background: var(--gradient-ethiopia);
            color: white;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
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
            align-items: center;
        }

        .nav-link {
            color: var(--text-medium);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s;
            position: relative;
            padding: 8px 0;
        }

        .nav-link:hover {
            color: var(--primary-gold);
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

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-signup {
            background: var(--gradient-gold);
            color: white !important;
            padding: 10px 24px !important;
            border-radius: 50px !important;
            box-shadow: var(--shadow-md);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
        }

        .btn-signup::after {
            display: none;
        }

        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            background: var(--bg-soft);
        }

        .hamburger:hover {
            background: var(--primary-soft);
            color: var(--primary-gold);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 80px;
            left: 20px;
            right: 20px;
            background: var(--bg-card);
            padding: 24px;
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            z-index: 999;
            transform: translateY(-150%);
            transition: transform 0.3s ease;
            border: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        .mobile-menu a, .mobile-menu button {
            display: block;
            padding: 16px 20px;
            color: var(--text-dark);
            text-decoration: none;
            border-bottom: 1px solid var(--border-soft);
            font-weight: 500;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 12px;
        }

        .mobile-menu a:hover, .mobile-menu button:hover {
            background: var(--primary-soft);
            color: var(--primary-gold);
            padding-left: 30px;
        }

        .mobile-menu a:last-child, .mobile-menu button:last-child {
            border-bottom: none;
        }

        .btn-signup-mobile {
            background: var(--gradient-gold);
            color: white !important;
        }

        .btn-signup-mobile:hover {
            background: var(--gradient-gold) !important;
            opacity: 0.9;
        }

        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 24px;
            width: 100%;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 24px;
            padding: 10px 20px;
            border-radius: 50px;
            background: var(--bg-card);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }

        .back-link:hover {
            color: var(--primary-gold);
            transform: translateX(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-gold);
        }

        .page-card {
            background: var(--bg-card);
            border-radius: 32px;
            padding: 60px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(184, 142, 63, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        .page-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-gold);
        }

        .page-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(184, 142, 63, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
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
            z-index: 1;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .page-header h1 span {
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
        }

        .page-header .last-updated {
            color: var(--text-light);
            font-size: 14px;
            background: var(--bg-soft);
            display: inline-block;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }

        .highlight-box {
            background: linear-gradient(135deg, #FEF3E7, #FFF);
            border-left: 4px solid var(--primary-gold);
            padding: 28px;
            border-radius: 20px;
            margin: 40px 0;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(184, 142, 63, 0.2);
        }

        .highlight-box p {
            margin-bottom: 0;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .highlight-box i {
            color: var(--primary-gold);
            font-size: 28px;
        }

        .page-section {
            margin-bottom: 48px;
            position: relative;
            z-index: 1;
        }

        .page-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-section h2 i {
            color: var(--primary-gold);
            font-size: 32px;
            background: var(--primary-soft);
            padding: 10px;
            border-radius: 16px;
        }

        .page-section h3 {
            font-size: 22px;
            font-weight: 600;
            margin: 32px 0 20px;
            color: var(--text-dark);
            padding-left: 12px;
            border-left: 4px solid var(--primary-gold);
        }

        .page-section p {
            color: var(--text-medium);
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.8;
        }

        /* Enhanced List Styling */
        .list-container {
            background: var(--gradient-soft);
            border-radius: 24px;
            padding: 28px;
            margin: 24px 0;
            border: 1px solid var(--border-color);
        }

        .styled-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .styled-list li {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 20px;
            background: var(--bg-card);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .styled-list li:hover {
            transform: translateX(8px) translateY(-2px);
            border-color: var(--primary-gold);
            box-shadow: var(--shadow-lg);
            background: white;
        }

        .list-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-soft);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 18px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .styled-list li:hover .list-icon {
            background: var(--primary-gold);
            color: white;
            transform: scale(1.1);
        }

        .list-content {
            flex: 1;
        }

        .list-content strong {
            color: var(--text-dark);
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .list-content .list-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Checkmark List */
        .check-list {
            list-style: none;
            margin: 20px 0;
        }

        .check-list li {
            position: relative;
            padding-left: 36px;
            margin-bottom: 16px;
            color: var(--text-medium);
            font-size: 15px;
            line-height: 1.6;
        }

        .check-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--success-dark);
            font-weight: bold;
            background: var(--success-light);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: var(--shadow-sm);
        }

        /* Bullet List */
        .bullet-list {
            list-style: none;
            margin: 20px 0;
        }

        .bullet-list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 14px;
            color: var(--text-medium);
            font-size: 15px;
        }

        .bullet-list li::before {
            content: '•';
            position: absolute;
            left: 8px;
            color: var(--primary-gold);
            font-size: 20px;
            font-weight: bold;
        }

        /* Info Cards Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin: 30px 0;
        }

        .info-card {
            background: var(--gradient-card);
            padding: 28px;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-gold);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-gold);
        }

        .info-card:hover::before {
            transform: scaleX(1);
        }

        .info-card h4 {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            color: var(--text-dark);
            font-size: 20px;
        }

        .info-card h4 i {
            color: var(--primary-gold);
            font-size: 24px;
            background: var(--primary-soft);
            padding: 8px;
            border-radius: 12px;
        }

        .info-card p {
            color: var(--text-light);
            margin-bottom: 0;
            font-size: 14px;
            line-height: 1.7;
        }

        /* Feature Grid */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .feature-item {
            background: var(--bg-soft);
            padding: 24px 16px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            background: white;
            border-color: var(--primary-gold);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-soft);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--primary-gold);
            font-size: 28px;
            transition: all 0.3s;
        }

        .feature-item:hover .feature-icon {
            background: var(--primary-gold);
            color: white;
            transform: rotate(360deg);
        }

        .feature-item h5 {
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
        }

        .feature-item p {
            color: var(--text-light);
            font-size: 13px;
            margin-bottom: 0;
            line-height: 1.5;
        }

        /* Contact Section */
        .contact-details {
            background: var(--gradient-soft);
            border-radius: 24px;
            padding: 32px;
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            border: 1px solid var(--border-color);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            background: var(--bg-card);
            border-radius: 18px;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .contact-item:hover {
            transform: translateY(-3px);
            border-color: var(--primary-gold);
            box-shadow: var(--shadow-lg);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-soft);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-gold);
            font-size: 24px;
            transition: all 0.3s;
        }

        .contact-item:hover .contact-icon {
            background: var(--primary-gold);
            color: white;
        }

        .contact-info {
            flex: 1;
        }

        .contact-label {
            font-size: 12px;
            color: var(--text-soft);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 16px;
        }

        .contact-value a {
            color: var(--primary-gold);
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-value a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 48px;
            padding: 28px;
            background: linear-gradient(135deg, var(--primary-soft), transparent);
            border-radius: 20px;
            text-align: center;
            font-size: 15px;
            color: var(--text-medium);
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1;
        }

        .footer-note i {
            color: var(--primary-gold);
            font-size: 24px;
            vertical-align: middle;
            margin-right: 8px;
        }

        /* Footer */
        footer {
            background: var(--bg-card);
            padding: 60px 60px 30px;
            border-top: 1px solid var(--border-color);
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .footer-section h4 {
            margin-bottom: 24px;
            color: var(--text-dark);
            font-size: 18px;
            font-weight: 600;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--gradient-gold);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 14px;
        }

        .footer-section a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-block;
        }

        .footer-section a:hover {
            color: var(--primary-gold);
            transform: translateX(5px);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 40px auto 0;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: 13px;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-links a {
            color: var(--text-light);
            font-size: 22px;
            transition: all 0.3s;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-soft);
        }

        .social-links a:hover {
            color: white;
            background: var(--primary-gold);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar { padding: 16px 40px; }
            .footer-content { grid-template-columns: repeat(2, 1fr); }
            .feature-grid { grid-template-columns: repeat(2, 1fr); }
            .contact-details { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .mobile-menu { display: block; }

            .page-card { padding: 32px 24px; }
            .page-header h1 { font-size: 36px; }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .ethiopia-badge { display: none; }

            .page-card { padding: 24px 20px; }
            .page-header h1 { font-size: 28px; }

            .page-section h2 {
                font-size: 24px;
            }

            .page-section h2 i {
                font-size: 24px;
                padding: 8px;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                padding: 24px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .styled-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .list-icon {
                margin-bottom: 4px;
            }

            .highlight-box p {
                flex-direction: column;
                text-align: center;
                font-size: 16px;
            }
        }

        @media (max-width: 380px) {
            .page-header h1 { font-size: 24px; }
            .page-section h2 { font-size: 22px; }
            .feature-item { padding: 20px 12px; }
        }

        /* Print Styles */
        @media print {
            .navbar, .footer, .back-link, .hamburger, .mobile-menu, .social-links {
                display: none !important;
            }
            .page-card {
                box-shadow: none;
                padding: 20px;
                border: 1px solid #ddd;
            }
            body {
                background: white;
            }
        }

        /* Loading Animation */
        .skeleton {
            animation: skeleton-loading 1s linear infinite alternate;
        }

        @keyframes skeleton-loading {
            0% { background-color: hsl(200, 20%, 90%); }
            100% { background-color: hsl(200, 20%, 95%); }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-soft);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
            
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">{{ __('nav.home') }}</a>
            <a href="{{ route('home') }}#categories" class="nav-link">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-link">Features</a>
            <a href="{{ route('about') }}" class="nav-link">{{ __('nav.about') }}</a>
            <a href="{{ route('contact') }}" class="nav-link">{{ __('nav.contact') }}</a>
            <a href="{{ route('login') }}" class="nav-link btn-signup">{{ __('nav.sign_in') }}</a>
        </div>
        <div class="hamburger" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">{{ __('nav.home') }}</a>
        <a href="{{ route('home') }}#categories">Categories</a>
        <a href="{{ route('home') }}#features">Features</a>
        <a href="{{ route('about') }}">{{ __('nav.about') }}</a>
        <a href="{{ route('contact') }}">{{ __('nav.contact') }}</a>
        <a href="{{ route('login') }}" class="btn-signup-mobile">{{ __('nav.sign_in') }}</a>
    </div>

    <!-- Main Content -->
    <main class="main-container">

        <a href="javascript:history.back()" class="back-link">
            <i class="ri-arrow-left-line"></i> Back
        </a>

        <div class="page-card">
            <div class="page-header">
                <h1><span>Privacy</span> Policy</h1>
                <p class="last-updated">Last Updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="highlight-box">
                <p>
                    <i class="ri-shield-check-line"></i>
                    <strong>Your privacy is our priority.</strong> This policy explains how we collect, use, and protect your personal information when you use Vendora in Jimma, Ethiopia.
                </p>
            </div>

            <div class="page-section">
                <h2><i class="ri-heart-line"></i> Our Commitment</h2>
                <p>Vendora is built on trust. We are committed to protecting your personal information and being transparent about how we use it. This Privacy Policy applies to all users of Vendora, including customers and vendors in Jimma and across Ethiopia.</p>
                <p>By using Vendora, you agree to the collection and use of information in accordance with this policy. We comply with Ethiopian data protection laws and international best practices.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-database-2-line"></i> Information We Collect</h2>

                <h3>1. Information You Provide</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-user-line"></i></span>
                            <div class="list-content">
                                <strong>Account Information</strong>
                                <span class="list-description">Name, email address, phone number, and password when you register</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-id-card-line"></i></span>
                            <div class="list-content">
                                <strong>Profile Information</strong>
                                <span class="list-description">Business name, description, category, address, and profile photo</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-message-line"></i></span>
                            <div class="list-content">
                                <strong>Communications</strong>
                                <span class="list-description">Messages you send through our platform and responses to surveys</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <h3>2. Information Automatically Collected</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-bar-chart-line"></i></span>
                            <div class="list-content">
                                <strong>Usage Data</strong>
                                <span class="list-description">Pages visited, time spent, links clicked, and interactions with vendors</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-map-pin-line"></i></span>
                            <div class="list-content">
                                <strong>Location Data</strong>
                                <span class="list-description">City and region (with your permission)</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-cookie-line"></i></span>
                            <div class="list-content">
                                <strong>Cookies</strong>
                                <span class="list-description">Small files stored on your device to enhance your experience</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <h3>3. Information from Third Parties</h3>
                <div class="list-container">
                    <ul class="styled-list">
                        <li>
                            <span class="list-icon"><i class="ri-bank-card-line"></i></span>
                            <div class="list-content">
                                <strong>Payment Processors</strong>
                                <span class="list-description">Transaction confirmations and payment status via Chapa</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-share-line"></i></span>
                            <div class="list-content">
                                <strong>Social Media</strong>
                                <span class="list-description">If you connect your social media accounts</span>
                            </div>
                        </li>
                        <li>
                            <span class="list-icon"><i class="ri-check-line"></i></span>
                            <div class="list-content">
                                <strong>Verification Services</strong>
                                <span class="list-description">Business verification data</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h4><i class="ri-customer-service-line"></i> For Customers</h4>
                    <p>We collect information to help you find the best local vendors and complete your bookings securely. Your data helps personalize your experience.</p>
                </div>
                <div class="info-card">
                    <h4><i class="ri-store-line"></i> For Vendors</h4>
                    <p>We collect business information to verify your identity and showcase your services to potential customers in Jimma and beyond.</p>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-stack-line"></i> How We Use Your Information</h2>
                
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-service-line"></i>
                        </div>
                        <h5>Provide Services</h5>
                        <p>Operate accounts, process bookings, and facilitate payments</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-bar-chart-2-line"></i>
                        </div>
                        <h5>Improve Platform</h5>
                        <p>Analyze usage patterns to enhance user experience</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-mail-send-line"></i>
                        </div>
                        <h5>Communicate</h5>
                        <p>Send updates, confirmations, and important notifications</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-user-heart-line"></i>
                        </div>
                        <h5>Personalize</h5>
                        <p>Recommend relevant vendors based on preferences</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <h5>Verify</h5>
                        <p>Verify vendor identities and ensure platform safety</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-lock-line"></i>
                        </div>
                        <h5>Security</h5>
                        <p>Detect and prevent fraud and security incidents</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-gavel-line"></i>
                        </div>
                        <h5>Legal Compliance</h5>
                        <p>Comply with Ethiopian laws and regulations</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-megaphone-line"></i>
                        </div>
                        <h5>Marketing</h5>
                        <p>Send promotional communications (with consent)</p>
                    </div>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-share-line"></i> Information Sharing</h2>
                <p>We do not sell your personal information. We may share your information only in these specific circumstances:</p>

                <h3>With Vendors</h3>
                <p>When you book a service, we share necessary information with the vendor to fulfill your booking, including your name, contact details, and booking requirements.</p>

                <h3>With Service Providers</h3>
                <p>We share information with trusted third parties who help us operate our platform:</p>
                <ul class="check-list">
                    <li><strong>Payment Processors:</strong> Chapa (PCI-DSS compliant)</li>
                    <li><strong>Cloud Services:</strong> Secure data hosting and storage</li>
                    <li><strong>Analytics:</strong> Google Analytics and similar tools</li>
                    <li><strong>Customer Support:</strong> Help desk software</li>
                </ul>
            </div>

            <div class="page-section">
                <h2><i class="ri-lock-line"></i> Data Security</h2>
                <div class="list-container">
                    <ul class="check-list">
                        <li><strong>Encryption:</strong> All data transmitted between your device and our servers is encrypted using SSL/TLS</li>
                        <li><strong>Access Controls:</strong> Strict access controls and authentication requirements for our team</li>
                        <li><strong>Regular Audits:</strong> Security assessments and vulnerability testing</li>
                        <li><strong>Secure Storage:</strong> Data stored in secure facilities</li>
                        <li><strong>Payment Security:</strong> Payment information is handled by PCI-DSS compliant partners</li>
                        <li><strong>2FA:</strong> Two-factor authentication available for all accounts</li>
                    </ul>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-user-star-line"></i> Your Rights and Choices</h2>
                <p>Under Ethiopian data protection law, you have the following rights:</p>
                <div class="list-container">
                    <ul class="check-list">
                        <li><strong>Access:</strong> Request a copy of your personal data</li>
                        <li><strong>Correction:</strong> Update inaccurate or incomplete information</li>
                        <li><strong>Deletion:</strong> Request deletion of your data (subject to legal requirements)</li>
                        <li><strong>Restriction:</strong> Limit how we use your information</li>
                        <li><strong>Objection:</strong> Object to certain types of processing</li>
                        <li><strong>Portability:</strong> Receive your data in a structured, commonly used format</li>
                        <li><strong>Withdraw Consent:</strong> Withdraw consent at any time</li>
                    </ul>
                </div>
            </div>

            <div class="page-section">
                <h2><i class="ri-calendar-line"></i> Data Retention</h2>
                <p>We retain your information for as long as necessary to:</p>
                <ul class="bullet-list">
                    <li>Provide you with our services</li>
                    <li>Comply with legal obligations (up to 7 years for financial records)</li>
                    <li>Resolve disputes</li>
                    <li>Enforce our agreements</li>
                </ul>
                <p>When information is no longer needed, we securely delete or anonymize it. Account information is typically retained for the duration of your account plus a reasonable period afterward to comply with legal requirements.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-cookie-line"></i> Cookie Policy</h2>
                <p>We use cookies and similar technologies to enhance your experience. You can control cookies through your browser settings. Types of cookies we use:</p>
                <ul class="bullet-list">
                    <li><strong>Essential Cookies:</strong> Required for platform functionality</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our site</li>
                    <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                    <li><strong>Marketing Cookies:</strong> Used for targeted advertising (with consent)</li>
                </ul>
            </div>

            <div class="page-section">
                <h2><i class="ri-user-line"></i> Children's Privacy</h2>
                <p>Our services are not intended for individuals under 18 years of age. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with information, please contact us immediately.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-earth-line"></i> International Data Transfers</h2>
                <p>Your information may be transferred to and processed in countries other than Ethiopia. We ensure appropriate safeguards are in place to protect your information in accordance with this policy. All data transfers comply with applicable laws.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-file-copy-line"></i> Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of significant changes through:</p>
                <ul class="bullet-list">
                    <li>Email notification (if you have an account)</li>
                    <li>Notice on our website</li>
                    <li>In-app notification</li>
                </ul>
                <p>We encourage you to review this policy periodically. Continued use of Vendora after changes constitutes acceptance of the updated policy.</p>
            </div>

            <div class="page-section">
                <h2><i class="ri-mail-send-line"></i> Contact Us</h2>
                <p>If you have questions, concerns, or requests regarding this Privacy Policy or your personal information, please contact our Data Protection Officer:</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Email</div>
                            <div class="contact-value">
                                <a href="mailto:privacy@vendora.com">privacy@vendora.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Phone</div>
                            <div class="contact-value">
                                <a href="tel:+251471112233">+251 47 111 2233</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Address</div>
                            <div class="contact-value">Jimma University Technology Park<br>Jimma, Ethiopia</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-time-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Response Time</div>
                            <div class="contact-value">Within 24-48 hours</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-whatsapp-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">WhatsApp</div>
                            <div class="contact-value">
                                <a href="https://wa.me/251471112233">+251 47 111 2233</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="ri-telegram-line"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Telegram</div>
                            <div class="contact-value">
                                <a href="https://t.me/vendora">@VendoraSupport</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-note">
                <i class="ri-shield-check-line"></i>
                <strong>Vendora is committed to protecting your privacy</strong> and building a trusted marketplace for the Jimma community. We're here to help with any questions or concerns.
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Vendora</h4>
                <p style="color: var(--text-light); margin-bottom: 20px; font-size: 14px; line-height: 1.7;">
                    Connecting you with trusted local vendors in Jimma and across Ethiopia. Your trusted marketplace since 2024.
                </p>
                <span class="ethiopia-badge" style="display: inline-flex;">
                    <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                </span>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('help-center') }}">Help Center</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>For Vendors</h4>
                <ul>
                    
                    <li><a href="{{ route('community') }}">Community</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('privacy-policy') }}" style="color: var(--primary-gold);">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
                    <li><a href="{{ route('cookie-policy') }}">Cookie Policy</a></li>
                    <li><a href="{{ route('trust-safety') }}">Trust & Safety</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} Vendora Marketplace. All rights reserved. Made with ❤️ in Jimma, Ethiopia</span>
            <div class="social-links">
                <a href="#" target="_blank" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
                <a href="#" target="_blank" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle with improved functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const body = document.body;

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isActive = mobileMenu.classList.toggle('active');
                    
                    // Change icon
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = isActive ? 'ri-close-line' : 'ri-menu-line';
                    }

                    // Prevent body scroll when menu is open
                    body.style.overflow = isActive ? 'hidden' : '';
                });

                // Close mobile menu when clicking on a link
                mobileMenu.querySelectorAll('a, button').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    });
                });

                // Close when clicking outside
                document.addEventListener('click', function(event) {
                    if (mobileMenu.classList.contains('active') && 
                        !mobileMenu.contains(event.target) && 
                        !menuToggle.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });

                // Handle escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });
            }

            // Confirm logout
            document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to logout?')) {
                        e.preventDefault();
                    }
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Close mobile menu if open
                        if (mobileMenu && mobileMenu.classList.contains('active')) {
                            mobileMenu.classList.remove('active');
                            const icon = menuToggle.querySelector('i');
                            if (icon) icon.className = 'ri-menu-line';
                            body.style.overflow = '';
                        }
                    }
                });
            });

            // Add active state to current page in footer
            const currentPath = window.location.pathname;
            document.querySelectorAll('.footer-section a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.style.color = 'var(--primary-gold)';
                    link.style.fontWeight = '600';
                }
            });

            // Lazy load images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));

            // Add copy protection for sensitive content (optional)
            const sensitiveContent = document.querySelector('.contact-details');
            if (sensitiveContent) {
                sensitiveContent.addEventListener('copy', (e) => {
                    e.clipboardData.setData('text/plain', 
                        'Contact information from Vendora. For more info, visit vendora.com');
                    e.preventDefault();
                });
            }

            // Animate elements on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.info-card, .feature-item, .list-container');
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementBottom = element.getBoundingClientRect().bottom;
                    
                    if (elementTop < window.innerHeight && elementBottom > 0) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            // Set initial styles for animation
            document.querySelectorAll('.info-card, .feature-item, .list-container').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });

            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Run once on load
        });

        // Add to homescreen prompt for mobile (optional)
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            // You can show a custom install prompt here
        });

        // Service worker registration (if you have one)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(err => {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }

        // Performance monitoring
        window.addEventListener('load', () => {
            if (window.performance) {
                const perfData = window.performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                console.log(`Page load time: ${pageLoadTime}ms`);
            }
        });
    </script>

    @if(app()->environment('local'))
        <!-- Development environment indicator -->
        <div style="position: fixed; bottom: 10px; right: 10px; background: #FFD700; color: #000; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; opacity: 0.5; z-index: 9999;">
            DEV MODE
        </div>
    @endif
</body>
</html>