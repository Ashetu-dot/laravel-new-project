<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Trust & Safety - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ----- FONTS ----- */
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
        @font-face {
            font-family: 'AlibabaSans';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/AlibabaSans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        /* ----- ROOT VARIABLES ----- */
        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'NotoSansHans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Ethiopian Flag Colors Accent */
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

        .safety-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
            margin: 20px auto;
            max-width: 1200px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 80px;
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
            letter-spacing: -0.5px;
            font-family: 'AlibabaSans', sans-serif;
            text-decoration: none;
        }

        .brand i {
            font-size: 28px;
        }

        .brand-badge {
            display: flex;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-item {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease;
            position: relative;
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

        .btn-signup {
            background: var(--primary-color);
            color: white !important;
            padding: 10px 24px !important;
            border-radius: 50px !important;
            transition: all 0.3s ease !important;
        }

        .btn-signup:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-signup::after {
            display: none;
        }

        .menu-btn {
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .menu-btn:hover {
            background-color: rgba(0,0,0,0.05);
        }

        /* toggle icon buttons (theme & language) */
        .toggle-btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--bg-light);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 20px;
        }

        .toggle-btn-icon:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .language-selector {
            position: relative;
        }

        .language-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-hover);
            min-width: 150px;
            display: none;
            z-index: 100;
        }

        .language-selector.open .language-dropdown {
            display: block;
        }

        .language-selector:hover .language-dropdown {
            display: block;
        }

        .language-option {
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
        }
        .language-option:hover {
            background: var(--bg-light);
        }

        /* Hero (matching home page) */
        .hero {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px;
            text-align: center;
            min-height: 480px;
            overflow: hidden;
            color: white;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 1s ease-in-out;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.35) 100%);
            z-index: -1;
        }

        .hero h1 { font-size: clamp(32px, 5vw, 48px); font-weight: 800; margin-bottom: 16px; text-shadow: 2px 2px 6px rgba(0,0,0,0.35); }
        .hero p { font-size: 18px; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto; text-shadow: 1px 1px 2px rgba(0,0,0,0.25); }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        .mobile-menu .nav-item {
            display: block;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu .nav-item:last-child {
            border-bottom: none;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 80px 20px;
            text-align: center;
            position: relative;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .page-header h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .page-header h1 span::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            height: 12px;
            background-color: rgba(184, 142, 63, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        .page-header p {
            font-size: 18px;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Trust Badges */
        .trust-badges {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .badge-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px 20px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .badge-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .badge-icon {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-color);
            font-size: 40px;
        }

        .badge-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .badge-text {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Section Styles */
        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .section-title-left {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title-left::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        /* Verification Process */
        .verification-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .verification-step {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            position: relative;
            transition: transform 0.3s;
        }

        .verification-step:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .step-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .step-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
        }

        /* Safety Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .feature-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            display: flex;
            gap: 20px;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 28px;
            flex-shrink: 0;
        }

        .feature-content {
            flex: 1;
        }

        .feature-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .feature-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Guidelines */
        .guidelines-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .guideline-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary-color);
        }

        .guideline-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .guideline-title i {
            color: var(--primary-color);
            font-size: 22px;
        }

        .guideline-list {
            list-style: none;
        }

        .guideline-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }

        .guideline-list i {
            color: var(--success-color);
            font-size: 16px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Report Section */
        .report-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 60px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .report-content h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .report-content p {
            color: var(--text-light);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .report-methods {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .report-method {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: var(--white);
            border-radius: var(--radius-md);
            transition: transform 0.3s;
        }

        .report-method:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow);
        }

        .method-icon {
            width: 45px;
            height: 45px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 20px;
            flex-shrink: 0;
        }

        .method-info {
            flex: 1;
        }

        .method-title {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .method-desc {
            font-size: 12px;
            color: var(--text-light);
        }

        .report-image {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 40px;
            text-align: center;
            color: white;
        }

        .report-image i {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .report-image h4 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .report-image p {
            opacity: 0.9;
            font-size: 14px;
        }

        /* FAQ Section */
        .faq-grid {
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius-md);
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .faq-question:hover {
            background: rgba(184, 142, 63, 0.02);
        }

        .faq-question i {
            color: var(--primary-color);
            transition: transform 0.3s;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 25px 20px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            display: none;
        }

        .faq-answer.active {
            display: block;
        }

        /* Contact Safety Team */
        .contact-safety {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .contact-safety h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .contact-safety p {
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .safety-contacts {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .safety-contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            background: var(--bg-light);
            border-radius: var(--radius-md);
            transition: transform 0.3s;
        }

        .safety-contact-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .contact-details {
            text-align: left;
        }

        .contact-label {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .contact-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .contact-value a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .contact-value a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background-color: var(--white);
            border-top: 1px solid #EEEEEE;
            padding: 60px 80px 40px;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
        }

        .footer-brand h2 {
            font-family: 'AlibabaSans', sans-serif;
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-text {
            color: var(--text-light);
            max-width: 300px;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            gap: 80px;
        }

        .link-group h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--text-dark);
        }

        .link-group ul {
            list-style: none;
        }

        .link-group li {
            margin-bottom: 12px;
        }

        .link-group a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 14px;
            transition: color 0.2s;
        }

        .link-group a:hover {
            color: var(--primary-color);
        }

        .bottom-bar {
            border-top: 1px solid #EEEEEE;
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #999;
            font-size: 13px;
        }

        .social-icons {
            display: flex;
            gap: 16px;
        }

        .social-icons a {
            color: #999;
            transition: color 0.2s;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        /* Responsive */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 20px 40px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 18px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }

            .trust-badges {
                grid-template-columns: repeat(2, 1fr);
            }

            .verification-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .report-grid {
                grid-template-columns: 1fr;
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .guidelines-grid {
                grid-template-columns: 1fr;
            }

            .safety-contacts {
                flex-direction: column;
                align-items: center;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 60px 20px; }
            .page-header h1 { font-size: 36px; }

            .trust-badges {
                grid-template-columns: 1fr;
            }

            .verification-grid {
                grid-template-columns: 1fr;
            }

            .feature-card {
                flex-direction: column;
                text-align: center;
            }

            .feature-icon {
                margin: 0 auto;
            }

            .report-section {
                padding: 30px 20px;
            }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }

            .page-header h1 { font-size: 32px; }
            .section-title { font-size: 28px; }

            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }

        /* Dark mode overrides */
        body.dark-mode {
            background-color: #0b1220;
            color: #e6eef8;
        }

        body.dark-mode .navbar,
        body.dark-mode footer,
        body.dark-mode .badge-card,
        body.dark-mode .feature-card,
        body.dark-mode .guideline-card,
        body.dark-mode .report-section,
        body.dark-mode .faq-item,
        body.dark-mode .contact-safety,
        body.dark-mode .mobile-menu {
            background-color: #0f1724;
            color: #cbd5e1;
            border-color: #1f2937;
            box-shadow: none;
        }

        body.dark-mode .brand { color: #f8fafc; }
        body.dark-mode .nav-item { color: #cbd5e1; }
        body.dark-mode .nav-item:hover { color: #ffffff; }
        body.dark-mode .btn-signup { background: #2563eb; box-shadow: none; }
        body.dark-mode .hero-overlay { background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.45) 100%); }
        body.dark-mode .footer-text, body.dark-mode .badge-text, body.dark-mode .feature-description, body.dark-mode .method-desc, body.dark-mode .guideline-list li { color: #9ca3af; }
        body.dark-mode a { color: #93c5fd; }
        body.dark-mode .ethiopia-badge { background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%); color: white; }
        body.dark-mode .toggle-btn-icon { background-color: #0b1220; border-color: #1f2937; color: #cbd5e1; }
    </style>
</head>
<body>

    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>

    <!-- Session Messages -->
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

    <!-- Navigation -->
    <nav class="navbar">
        <div class="brand-badge">
            <a href="{{ route('home') }}" class="brand">
                <i class="ri-store-2-fill"></i>
                Vendora
            </a>
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </span>
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-item">Features</a>
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
        </div>

        <div class="nav-actions">
            <div class="theme-lang-toggle" style="display:flex; align-items:center; gap:8px;">
                <button class="toggle-btn-icon" id="themeToggle" title="Toggle Theme">
                    <i class="ri-moon-line"></i>
                </button>
                <div class="language-selector" id="languageSelector">
                    <button class="toggle-btn-icon" id="languageToggle" onclick="toggleLanguageDropdown(event)" aria-haspopup="true" aria-expanded="false" title="Language">
                        <i class="ri-translate-2"></i>
                    </button>
                    <div class="language-dropdown" style="display:none; position:absolute; right:24px; background:white; box-shadow:var(--shadow); border-radius:8px; overflow:hidden;">
                        <div class="language-option" data-locale="en" onclick="changeLanguage('en')">
                            English @if(session('locale','en') === 'en') <i class="ri-check-line" style="float:right"></i> @endif
                        </div>
                        <div class="language-option" data-locale="am" onclick="changeLanguage('am')">
                            አማርኛ @if(session('locale','en') === 'am') <i class="ri-check-line" style="float:right"></i> @endif
                        </div>
                        <div class="language-option" data-locale="om" onclick="changeLanguage('om')">
                            Oromiffa @if(session('locale','en') === 'om') <i class="ri-check-line" style="float:right"></i> @endif
                        </div>
                    </div>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="nav-item">Log In</a>
                    <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
                @endguest
            </div>
        </div>

        <div class="menu-btn" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
        <a href="{{ route('home') }}#features" class="nav-item">Features</a>
        <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
        <!-- theme & language controls mobile -->
        <div style="padding:12px 0; border-top:1px solid var(--border-color); display:flex; gap:8px; align-items:center;">
            <button class="toggle-btn-icon" id="themeToggleMobile" title="Toggle Theme">
                <i class="ri-moon-line"></i>
            </button>
            <div class="language-selector" id="languageSelectorMobile" style="position:relative;">
                <button class="toggle-btn-icon" id="languageToggleMobile" onclick="toggleLanguageDropdown(event, 'mobile')" aria-haspopup="true" aria-expanded="false" title="Language">
                    <i class="ri-translate-2"></i>
                </button>
                <div class="language-dropdown" style="display:none; right:0;">
                    <div class="language-option" data-locale="en" onclick="changeLanguage('en', true)">
                        English @if(session('locale','en')==='en') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                    <div class="language-option" data-locale="am" onclick="changeLanguage('am', true)">
                        አማርኛ @if(session('locale','en')==='am') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                    <div class="language-option" data-locale="om" onclick="changeLanguage('om', true)">
                        Oromiffa @if(session('locale','en')==='om') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                </div>
            </div>
        </div>
        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @else
            <!-- authenticated menu items intentionally removed from navbar per request -->
        @endguest
    </div>

    <!-- Hero (dynamic background, multilingual-ready) -->
    <section class="hero">
        <div class="hero-background" style="background-image: url('{{ isset($heroImage) ? asset($heroImage) : asset('images/hero-home.jpg') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <h1>{{ __('Trust &') }} <span>{{ __('Safety') }}</span></h1>
            <p>{{ __('Your safety is our priority. Learn how we protect our community and ensure secure transactions between vendors and customers.') }}</p>
        </div>
    </section>

    <main>
        <div class="container">
            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <h3 class="badge-title">Verified Vendors</h3>
                    <p class="badge-text">All vendors undergo identity verification and business authentication</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="ri-lock-line"></i>
                    </div>
                    <h3 class="badge-title">Secure Payments</h3>
                    <p class="badge-text">End-to-end encrypted transactions with multiple payment options</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="ri-star-line"></i>
                    </div>
                    <h3 class="badge-title">Real Reviews</h3>
                    <p class="badge-text">Authentic customer feedback from verified purchases</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="ri-customer-service-line"></i>
                    </div>
                    <h3 class="badge-title">24/7 Support</h3>
                    <p class="badge-text">Dedicated safety team available in Amharic and English</p>
                </div>
            </div>

            <!-- Verification Process -->
            <section>
                <h2 class="section-title">Vendor Verification Process</h2>
                <div class="verification-grid">
                    <div class="verification-step">
                        <div class="step-number">1</div>
                        <h3 class="step-title">Identity Verification</h3>
                        <p class="step-description">Vendors must provide valid government ID, business license, or tax identification number. Our team manually reviews each document.</p>
                    </div>
                    <div class="verification-step">
                        <div class="step-number">2</div>
                        <h3 class="step-title">Business Authentication</h3>
                        <p class="step-description">We verify business addresses, phone numbers, and may conduct video calls to confirm legitimacy of the business.</p>
                    </div>
                    <div class="verification-step">
                        <div class="step-number">3</div>
                        <h3 class="step-title">Ongoing Monitoring</h3>
                        <p class="step-description">Regular reviews of vendor performance, customer feedback, and random audits ensure continued compliance.</p>
                    </div>
                </div>
            </section>

            <!-- Safety Features -->
            <section>
                <h2 class="section-title">Safety Features</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-shield-user-line"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-title">Verified Badge</h3>
                            <p class="feature-description">Look for the verified badge on vendor profiles. This indicates they've completed our full verification process.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-chat-check-line"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-title">Review System</h3>
                            <p class="feature-description">Only customers who have booked through Vendora can leave reviews, ensuring authenticity and reliability.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-secure-payment-line"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-title">Secure Messaging</h3>
                            <p class="feature-description">All communications are encrypted. Keep conversations on our platform for your safety and dispute resolution.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-title">Emergency Support</h3>
                            <p class="feature-description">24/7 emergency hotline for urgent safety concerns. Available in Amharic, English, and Oromiffa.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Community Guidelines -->
            <section>
                <h2 class="section-title">Community Guidelines</h2>
                <div class="guidelines-grid">
                    <div class="guideline-card">
                        <h3 class="guideline-title">
                            <i class="ri-user-star-line"></i>
                            For Customers
                        </h3>
                        <ul class="guideline-list">
                            <li><i class="ri-check-line"></i> Communicate only through Vendora's platform</li>
                            <li><i class="ri-check-line"></i> Make payments through approved methods only</li>
                            <li><i class="ri-check-line"></i> Leave honest reviews based on actual experience</li>
                            <li><i class="ri-check-line"></i> Report any suspicious activity immediately</li>
                            <li><i class="ri-check-line"></i> Respect vendor's time and cancellation policies</li>
                            <li><i class="ri-check-line"></i> Verify service details before booking</li>
                        </ul>
                    </div>
                    <div class="guideline-card">
                        <h3 class="guideline-title">
                            <i class="ri-store-3-line"></i>
                            For Vendors
                        </h3>
                        <ul class="guideline-list">
                            <li><i class="ri-check-line"></i> Maintain accurate and up-to-date business information</li>
                            <li><i class="ri-check-line"></i> Respond to customer inquiries promptly</li>
                            <li><i class="ri-check-line"></i> Deliver services as described and on time</li>
                            <li><i class="ri-check-line"></i> Honor agreed pricing and policies</li>
                            <li><i class="ri-check-line"></i> Maintain professional conduct at all times</li>
                            <li><i class="ri-check-line"></i> Keep your calendar and availability updated</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Report Section -->
            <section class="report-section">
                <div class="report-grid">
                    <div class="report-content">
                        <h3>Report a Concern</h3>
                        <p>If you encounter any suspicious activity, harassment, or safety concerns, please report it immediately. Our safety team reviews all reports within 24 hours.</p>

                        <div class="report-methods">
                            <div class="report-method">
                                <div class="method-icon">
                                    <i class="ri-flag-line"></i>
                                </div>
                                <div class="method-info">
                                    <div class="method-title">In-App Reporting</div>
                                    <div class="method-desc">Use the report button on any profile or message</div>
                                </div>
                            </div>
                            <div class="report-method">
                                <div class="method-icon">
                                    <i class="ri-mail-send-line"></i>
                                </div>
                                <div class="method-info">
                                    <div class="method-title">Email</div>
                                    <div class="method-desc">safety@vendora.com</div>
                                </div>
                            </div>
                            <div class="report-method">
                                <div class="method-icon">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div class="method-info">
                                    <div class="method-title">Emergency Hotline</div>
                                    <div class="method-desc">+251 91 234 5678 (24/7)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="report-image">
                        <i class="ri-shield-line"></i>
                        <h4>Your Report is Confidential</h4>
                        <p>All reports are handled with strict confidentiality. We never share reporter information with the reported party.</p>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section>
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How do you verify vendors?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            We verify vendors through a multi-step process including government ID verification, business license validation, and sometimes video calls. Vendors must also provide proof of address and contact information. Once verified, they receive a "Verified" badge on their profile.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>What should I do if I have a dispute with a vendor?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            First, try to resolve directly through our messaging platform. If you can't reach a resolution, contact our support team within 48 hours. We'll investigate and mediate. For payment disputes, we have a buyer protection policy that may apply depending on the situation.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>Are my payments secure?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Yes. All payments are processed through encrypted, secure channels. We use industry-standard SSL encryption and never store your full payment details. We offer multiple payment options including mobile money (Telebirr, M-Pesa), bank transfer, and cash on delivery for eligible services.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How are reviews moderated?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Reviews can only be left by customers who have completed a booking through Vendora. Our system detects and filters suspicious reviews. We manually review flagged reviews and remove any that violate our guidelines (spam, harassment, fake reviews).
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>What happens if a vendor doesn't show up?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            If a vendor fails to show up or cancels last minute, report it immediately. We'll investigate and may remove the vendor from our platform. You'll receive a full refund if you've paid in advance. We also offer assistance finding an alternative vendor.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How do I know a vendor is reliable?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Look for verified badges, check their rating and read recent reviews. Vendors with high ratings and detailed positive feedback are typically reliable. You can also message them through our platform to ask questions before booking.
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Safety Team -->
            <section class="contact-safety">
                <h3>Contact Our Safety Team</h3>
                <p>Our dedicated safety team is available 24/7 to address your concerns and ensure a secure experience for everyone.</p>

                <div class="safety-contacts">
                    <div class="safety-contact-item">
                        <div class="contact-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">Email</div>
                            <div class="contact-value">
                                <a href="mailto:safety@vendora.com">safety@vendora.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="safety-contact-item">
                        <div class="contact-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">Emergency Hotline</div>
                            <div class="contact-value">
                                <a href="tel:+251912345678">+251 91 234 5678</a>
                            </div>
                        </div>
                    </div>

                    <div class="safety-contact-item">
                        <div class="contact-icon">
                            <i class="ri-message-line"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">Live Chat</div>
                            <div class="contact-value">Available 24/7 in app</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-fill"></i> Vendora</h2>
                <p class="footer-text">Connecting you with the best local professionals in Jimma and across Ethiopia. Simple, fast, and reliable.</p>
                <div style="margin-top: 16px;">
                    <span class="ethiopia-badge">
                        <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                    </span>
                </div>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('press') }}">Press</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="{{ route('search.results') }}">How it works</a></li>
                        <li><a href="{{ route('trust-safety') }}">Trust & Safety</a></li>
                        <li><a href="{{ route('help-center') }}">Help Center</a></li>
                        <li><a href="{{ route('invite') }}">Invite Friends</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>For Vendors</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">List your service</a></li>
                        <li><a href="{{ route('community') }}">Community</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia</span>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('active');

                // Change icon
                const icon = this.querySelector('i');
                if (mobileMenu.classList.contains('active')) {
                    icon.className = 'ri-close-line';
                } else {
                    icon.className = 'ri-menu-line';
                }
            });

            // Close mobile menu when clicking on a link
            mobileMenu.querySelectorAll('a, button').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    if (icon) icon.className = 'ri-menu-line';
                });
            });

            // Close when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    if (icon) icon.className = 'ri-menu-line';
                }
            });
        }

        // Smooth scrolling for anchor links
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
                    }
                }
            });
        });

        // FAQ toggle function
        function toggleFAQ(element) {
            element.classList.toggle('active');
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Confirm logout
        document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Theme toggle - sync with backend and localStorage
        function applyTheme(theme) {
            document.body.classList.toggle('dark-mode', theme === 'dark');
            const ico = document.querySelector('#themeToggle i') || document.querySelector('#themeToggleMobile i');
            if (ico) ico.className = theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
        }

        function updateTheme(theme) {
            applyTheme(theme);
            localStorage.setItem('theme', theme);
            // send to server
            fetch('/toggle-theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ theme: theme })
            });
        }

        const themeToggleBtn = document.getElementById('themeToggle');
        const themeToggleBtnMobile = document.getElementById('themeToggleMobile');
        [themeToggleBtn, themeToggleBtnMobile].forEach(btn => {
            if (!btn) return;
            btn.addEventListener('click', function() {
                const isDark = document.body.classList.toggle('dark-mode');
                const theme = isDark ? 'dark' : 'light';
                const icon = this.querySelector('i');
                if (icon) icon.className = isDark ? 'ri-sun-line' : 'ri-moon-line';
                updateTheme(theme);
            });
        });

        // initialize theme on load from server or storage
        (function() {
            let theme = localStorage.getItem('theme');
            if (theme) {
                applyTheme(theme);
            } else {
                // fetch preferred theme from server once and apply (do NOT re-post)
                fetch('/get-theme').then(r=>r.json()).then(data=>{
                    if (data.success && data.theme) {
                        applyTheme(data.theme);
                        try { localStorage.setItem('theme', data.theme); } catch(e) {}
                    }
                }).catch(()=>{});
            }
        })();

        // Language dropdown toggle and switch
        function toggleLanguageDropdown(e) {
            e.stopPropagation();
            const sel = document.getElementById('languageSelector');
            if (!sel) return;
            const dd = sel.querySelector('.language-dropdown');
            const expanded = dd.style.display !== 'block';
            dd.style.display = expanded ? 'block' : 'none';
            const btn = document.getElementById('languageToggle');
            if (btn) btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }

        function changeLanguage(locale, isMobile = false) {
            // optimistically update the UI (check marks) before reload
            document.querySelectorAll('.language-option').forEach(opt => {
                if (opt.dataset.locale === locale) {
                    if (!opt.querySelector('i')) {
                        const icon = document.createElement('i');
                        icon.className = 'ri-check-line';
                        icon.style.float = 'right';
                        opt.appendChild(icon);
                    }
                } else {
                    const icon = opt.querySelector('i');
                    if (icon) icon.remove();
                }
            });

            // close dropdowns
            const desktopSel = document.getElementById('languageSelector');
            if (desktopSel) {
                const dd = desktopSel.querySelector('.language-dropdown');
                if (dd) dd.style.display = 'none';
                const btn = document.getElementById('languageToggle');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
            if (isMobile) {
                const mobileSel = document.getElementById('languageSelectorMobile');
                if (mobileSel) {
                    const dd = mobileSel.querySelector('.language-dropdown');
                    if (dd) dd.style.display = 'none';
                    const btn = document.getElementById('languageToggleMobile');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            }

            // remember choice in localStorage as a quick fallback/UI hint
            try { localStorage.setItem('locale', locale); } catch{};
            fetch('/switch-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ locale: locale })
            }).then(() => {
                // reload after server updates session
                window.location.reload();
            }).catch(err => console.error('Failed to change language', err));
        }

        // Close language dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const sel = document.getElementById('languageSelector');
            if (!sel) return;
            const dd = sel.querySelector('.language-dropdown');
            if (dd && !sel.contains(event.target)) {
                dd.style.display = 'none';
                const btn = document.getElementById('languageToggle'); if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        });

        // set html lang from localStorage as soon as possible
        (function() {
            try {
                const storedLocale = localStorage.getItem('locale');
                if (storedLocale && document.documentElement.lang !== storedLocale) {
                    document.documentElement.lang = storedLocale;
                }
            } catch(e) { /* ignore */ }
        })();
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Trust & Safety page loaded - Local environment');
    </script>
    @endif
</body>
</html>
