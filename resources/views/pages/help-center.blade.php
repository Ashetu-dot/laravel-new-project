<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Help Center - Vendora | Jimma, Ethiopia</title>
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
            --overlay-dark: rgba(0, 0, 0, 0.6);
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
+
+        /* dark mode preferences persisted */
+        body.dark-mode .toggle-btn-icon { background-color: #0b1220; border-color: #1f2937; color: #cbd5e1; }

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

        .support-badge {
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
            position: relative;
            z-index: 1000;
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

        .nav-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-item.active::after {
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

        /* Page Header with Dynamic Background */
        .page-header {
            position: relative;
            padding: 100px 20px 120px;
            text-align: center;
            color: white;
            background-image: linear-gradient(var(--overlay-dark), var(--overlay-dark)), url('{{ $heroImage ?? asset('images/help-center-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            isolation: isolate;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.3), rgba(0, 0, 0, 0.7));
            z-index: -1;
        }

        .page-header h1 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease;
        }

        .page-header h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .page-header h1 span::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            height: 12px;
            background-color: rgba(184, 142, 63, 0.3);
            z-index: -1;
            border-radius: 4px;
        }

        .page-header p {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.95;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease 0.2s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Search Container */
        .search-container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 60px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            padding: 5px;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            animation: fadeInUp 1s ease 0.4s both;
        }

        .search-icon {
            padding: 0 20px;
            color: var(--text-light);
            font-size: 20px;
        }

        .search-input {
            flex: 1;
            padding: 18px 0;
            border: none;
            outline: none;
            font-size: 16px;
            background: transparent;
        }

        .search-input::placeholder {
            color: #999;
        }

        .search-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-right: 5px;
        }

        .search-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.4);
        }

        .container {
            max-width: 1200px;
            margin: -50px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        /* Quick Help Cards */
        .quick-help-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }

        .quick-help-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px 20px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--text-dark);
            border: 1px solid transparent;
        }

        .quick-help-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .quick-icon {
            width: 70px;
            height: 70px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-color);
            font-size: 32px;
            transition: transform 0.3s;
        }

        .quick-help-card:hover .quick-icon {
            transform: scale(1.1);
            background: var(--primary-color);
            color: white;
        }

        .quick-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .quick-desc {
            color: var(--text-light);
            font-size: 13px;
            line-height: 1.5;
        }

        /* Help Categories */
        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .section-title span {
            color: var(--primary-color);
            position: relative;
        }

        .section-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 10px;
            background-color: rgba(184, 142, 63, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .category-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 24px;
        }

        .category-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .topic-list {
            list-style: none;
            margin-bottom: 20px;
        }

        .topic-item {
            margin-bottom: 12px;
        }

        .topic-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            padding: 8px 0;
            transition: color 0.3s;
            border-bottom: 1px dashed var(--border-color);
        }

        .topic-link:hover {
            color: var(--primary-color);
        }

        .topic-link i {
            font-size: 16px;
            opacity: 0.5;
            transition: opacity 0.3s, transform 0.3s;
        }

        .topic-link:hover i {
            opacity: 1;
            transform: translateX(5px);
        }

        .view-all-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin-top: 10px;
            transition: gap 0.3s;
        }

        .view-all-link:hover {
            gap: 10px;
        }

        /* Payment Methods Section */
        .payment-section {
            margin: 40px 0 60px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
        }

        .payment-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .payment-icon {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--primary-color);
            font-size: 40px;
            transition: all 0.3s;
        }

        .payment-card:hover .payment-icon {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .payment-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .payment-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .payment-badge {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Featured Articles */
        .featured-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.03) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 60px;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .featured-article {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px;
            display: flex;
            gap: 20px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .featured-article:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-hover);
        }

        .featured-icon {
            width: 50px;
            height: 50px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 24px;
            flex-shrink: 0;
        }

        .featured-content {
            flex: 1;
        }

        .featured-content h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .featured-content p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .read-more:hover {
            gap: 8px;
        }

        /* Contact Support */
        .support-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 60px;
        }

        .support-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .support-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .support-icon {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--primary-color);
            font-size: 36px;
        }

        .support-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .support-card p {
            color: var(--text-light);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .support-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .support-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .support-btn i {
            font-size: 18px;
        }

        /* Contact Methods */
        .contact-methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 60px;
        }

        .contact-method {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .contact-method:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .method-icon {
            width: 60px;
            height: 60px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-color);
            font-size: 28px;
        }

        .method-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .method-detail {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 5px;
        }

        .method-info {
            color: var(--text-light);
            font-size: 13px;
        }

        /* FAQ Section */
        .faq-section {
            margin-bottom: 60px;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            cursor: pointer;
        }

        .faq-item:hover {
            box-shadow: var(--shadow-hover);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: var(--text-dark);
        }

        .faq-question i {
            color: var(--primary-color);
            transition: transform 0.3s;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-answer {
            margin-top: 15px;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        /* Still Need Help */
        .help-footer {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 50px;
            text-align: center;
            color: white;
        }

        .help-footer h3 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .help-footer p {
            opacity: 0.95;
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .help-footer-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .help-btn {
            background: white;
            color: var(--primary-color);
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .help-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .help-btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .help-btn-outline:hover {
            background: white;
            color: var(--primary-color);
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

            .quick-help-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .support-section {
                grid-template-columns: 1fr;
            }

            .contact-methods {
                grid-template-columns: repeat(2, 1fr);
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }

            .featured-grid {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header {
                padding: 80px 20px 100px;
            }

            .page-header h1 {
                font-size: 36px;
            }

            .quick-help-grid {
                grid-template-columns: 1fr;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .payment-grid {
                grid-template-columns: 1fr;
            }

            .contact-methods {
                grid-template-columns: 1fr;
            }

            .featured-section {
                padding: 30px 20px;
            }

            .featured-article {
                flex-direction: column;
                text-align: center;
            }

            .featured-icon {
                margin: 0 auto;
            }

            .support-card {
                padding: 30px 20px;
            }

            .help-footer {
                padding: 40px 20px;
            }

            .search-container {
                flex-direction: column;
                border-radius: 30px;
                padding: 20px;
                background: white;
            }

            .search-icon {
                display: none;
            }

            .search-input {
                width: 100%;
                padding: 15px;
                border: 1px solid var(--border-color);
                border-radius: 30px;
                margin-bottom: 15px;
                background: white;
            }

            .search-btn {
                width: 100%;
                margin-right: 0;
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

            .help-footer-buttons {
                flex-direction: column;
            }

            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }
    </style>
</head>
<body>

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
            
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-item">Features</a>
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
            <!-- removed extraneous Help Center and logout links per request -->
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
        <!-- removed help center & logout links -->
        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @endguest
        <!-- mobile toggles -->
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
    </div>

    <!-- Page Header with Dynamic Background -->
    <section class="page-header" style="background-image: linear-gradient(var(--overlay-dark), var(--overlay-dark)), url('{{ $heroImage ?? asset('images/help-center-bg.jpg') }}');">
        <h1>How can we <span>help</span> you?</h1>
        <p>Search our help center or browse topics below to find answers to your questions.</p>

        <!-- Search Bar -->
        <div class="search-container">
            <span class="search-icon"><i class="ri-search-line"></i></span>
            <input type="text" class="search-input" placeholder="Search for answers... e.g., how to book, payment issues, vendor verification">
            <button class="search-btn">Search</button>
        </div>
    </section>

    <main>
        <div class="container">
            <!-- Quick Help Cards -->
            <div class="quick-help-grid">
                <a href="#" class="quick-help-card">
                    <div class="quick-icon">
                        <i class="ri-user-settings-line"></i>
                    </div>
                    <h3 class="quick-title">Account Setup</h3>
                    <p class="quick-desc">Create and manage your account</p>
                </a>
                <a href="#" class="quick-help-card">
                    <div class="quick-icon">
                        <i class="ri-handbag-line"></i>
                    </div>
                    <h3 class="quick-title">Booking Help</h3>
                    <p class="quick-desc">How to book services</p>
                </a>
                <a href="#" class="quick-help-card">
                    <div class="quick-icon">
                        <i class="ri-secure-payment-line"></i>
                    </div>
                    <h3 class="quick-title">Payments</h3>
                    <p class="quick-desc">Payment methods and issues</p>
                </a>
                <a href="#" class="quick-help-card">
                    <div class="quick-icon">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <h3 class="quick-title">Safety</h3>
                    <p class="quick-desc">Trust and safety guidelines</p>
                </a>
            </div>

            <!-- Payment Methods Section -->
            <section class="payment-section">
                <h2 class="section-title">Accepted <span>Payment</span> Methods</h2>
                <div class="payment-grid">
                    <div class="payment-card">
                        <div class="payment-icon">
                            <i class="ri-bank-card-line"></i>
                        </div>
                        <h3 class="payment-title">Chapa</h3>
                        <p class="payment-description">
                            Secure online payments with Ethiopia's trusted payment gateway. Pay instantly with your bank account, card, or mobile money.
                        </p>
                        <span class="payment-badge">Instant & Secure</span>
                    </div>
                    <div class="payment-card">
                        <div class="payment-icon">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                        <h3 class="payment-title">Cash on Delivery</h3>
                        <p class="payment-description">
                            Pay in cash when the service is delivered. Available for eligible local services. Verify with vendor before booking.
                        </p>
                        <span class="payment-badge">Pay at Service</span>
                    </div>
                </div>
            </section>

            <!-- Help Categories -->
            <section>
                <h2 class="section-title">Browse Help Topics</h2>
                <div class="categories-grid">
                    <!-- For Customers -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-user-line"></i>
                            </div>
                            <h3 class="category-title">For Customers</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Creating an account</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>How to search for vendors</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Booking a service</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Payment with Chapa</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cash on delivery process</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cancellation policy</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <!-- For Vendors -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-store-line"></i>
                            </div>
                            <h3 class="category-title">For Vendors</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Vendor registration</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Verification process</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Managing your profile</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Adding products/services</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Getting paid via Chapa</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cash on delivery setup</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <!-- Payments & Billing -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-bank-card-line"></i>
                            </div>
                            <h3 class="category-title">Payments & Billing</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>How to pay with Chapa</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Setting up cash on delivery</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Payment security</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Refunds and disputes</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Payment confirmation</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Invoices and receipts</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Featured Articles -->
            <section class="featured-section">
                <h2 class="section-title" style="margin-bottom: 30px;">Featured Articles</h2>
                <div class="featured-grid">
                    <div class="featured-article">
                        <div class="featured-icon">
                            <i class="ri-user-star-line"></i>
                        </div>
                        <div class="featured-content">
                            <h4>How to get verified as a vendor</h4>
                            <p>Complete guide to the verification process and required documents.</p>
                            <a href="#" class="read-more">Read more <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="featured-article">
                        <div class="featured-icon">
                            <i class="ri-secure-payment-line"></i>
                        </div>
                        <div class="featured-content">
                            <h4>Understanding our payment system</h4>
                            <p>Learn about Chapa payments, cash on delivery, and transaction security.</p>
                            <a href="#" class="read-more">Read more <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="featured-article">
                        <div class="featured-icon">
                            <i class="ri-customer-service-line"></i>
                        </div>
                        <div class="featured-content">
                            <h4>How to file a dispute</h4>
                            <p>Step-by-step guide to resolving issues with vendors or customers.</p>
                            <a href="#" class="read-more">Read more <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="featured-article">
                        <div class="featured-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <div class="featured-content">
                            <h4>Safety tips for users</h4>
                            <p>Best practices to stay safe while using Vendora.</p>
                            <a href="#" class="read-more">Read more <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Support -->
            <section class="support-section">
                <div class="support-card">
                    <div class="support-icon">
                        <i class="ri-message-line"></i>
                    </div>
                    <h3>Live Chat Support</h3>
                    <p>Chat with our support team in real-time. Available 24/7 in Amharic and English.</p>
                    <a href="#" class="support-btn">
                        <i class="ri-chat-1-line"></i>
                        Start Chat
                    </a>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="ri-mail-send-line"></i>
                    </div>
                    <h3>Email Support</h3>
                    <p>Send us an email and we'll get back to you within 24 hours.</p>
                    <a href="mailto:support@vendora.com" class="support-btn">
                        <i class="ri-mail-line"></i>
                        support@vendora.com
                    </a>
                </div>
            </section>

            <!-- Contact Methods -->
            <div class="contact-methods">
                <div class="contact-method">
                    <div class="method-icon">
                        <i class="ri-phone-line"></i>
                    </div>
                    <div class="method-title">Phone Support</div>
                    <div class="method-detail">+251 91 234 5678</div>
                    <div class="method-info">24/7 emergency support</div>
                </div>
                <div class="contact-method">
                    <div class="method-icon">
                        <i class="ri-telegram-line"></i>
                    </div>
                    <div class="method-title">Telegram</div>
                    <div class="method-detail">@VendoraSupport</div>
                    <div class="method-info">Fast response within 1 hour</div>
                </div>
                <div class="contact-method">
                    <div class="method-icon">
                        <i class="ri-whatsapp-line"></i>
                    </div>
                    <div class="method-title">WhatsApp</div>
                    <div class="method-detail">+251 91 234 5678</div>
                    <div class="method-info">Text or voice support</div>
                </div>
            </div>

            <!-- FAQ Section -->
            <section class="faq-section">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>How do I create an account?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Click on "Sign Up" in the top right corner. You can register as a customer or vendor. Fill in your details, verify your email, and you're ready to go!
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>What payment methods are accepted?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            We accept Chapa (secure online payments) and Cash on Delivery for eligible services. All payments are secure and encrypted.
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>How does Chapa payment work?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Chapa is Ethiopia's trusted payment gateway. You can pay using your bank account, card, or mobile money. Payments are processed instantly and securely.
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>How long does vendor verification take?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Vendor verification typically takes 24-48 hours after submitting all required documents. You'll receive an email notification once verified.
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>Can I cancel a booking?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Yes, you can cancel bookings through your dashboard. Cancellation policies vary by vendor. Check the vendor's cancellation policy before booking.
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <span>Is my personal information safe?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            Yes, we use industry-standard encryption and security measures to protect your data. We never share your personal information with third parties without your consent.
                        </div>
                    </div>
                </div>
            </section>

            <!-- Still Need Help -->
            <section class="help-footer">
                <h3>Still Need Help?</h3>
                <p>Can't find what you're looking for? Our support team is here to help you 24/7.</p>
                <div class="help-footer-buttons">
                    <a href="#" class="help-btn">
                        <i class="ri-customer-service-line"></i>
                        Contact Support
                    </a>
                    <a href="#" class="help-btn help-btn-outline">
                        <i class="ri-questionnaire-line"></i>
                        FAQs
                    </a>
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
                fetch('/get-theme').then(r=>r.json()).then(data=>{
                    if (data.success && data.theme) {
                        applyTheme(data.theme);
                        try { localStorage.setItem('theme', data.theme); } catch(e) {}
                    }
                }).catch(()=>{});
            }
        })();

        // Language dropdown toggle and switch
        function toggleLanguageDropdown(e, isMobile = false) {
            e.stopPropagation();
            const selId = isMobile ? 'languageSelectorMobile' : 'languageSelector';
            const sel = document.getElementById(selId);
            if (!sel) return;
            const dd = sel.querySelector('.language-dropdown');
            const expanded = dd.style.display !== 'block';
            dd.style.display = expanded ? 'block' : 'none';
            const btn = document.getElementById(isMobile ? 'languageToggleMobile' : 'languageToggle');
            if (btn) btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }

        function changeLanguage(locale, isMobile = false) {
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
            try { localStorage.setItem('locale', locale); } catch{};
            fetch('/switch-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ locale: locale })
            }).then(() => {
                window.location.reload();
            }).catch(err => console.error('Failed to change language', err));
        }

        // Close language dropdown when clicking outside
        document.addEventListener('click', function(event) {
            ['languageSelector','languageSelectorMobile'].forEach(id => {
                const sel = document.getElementById(id);
                if (!sel) return;
                const dd = sel.querySelector('.language-dropdown');
                if (dd && !sel.contains(event.target)) {
                    dd.style.display = 'none';
                    const btn = sel.querySelector('button');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // set html lang from localStorage as soon as possible
        (function() {
            try {
                const storedLocale = localStorage.getItem('locale');
                if (storedLocale && document.documentElement.lang !== storedLocale) {
                    document.documentElement.lang = storedLocale;
                }
            } catch(e) { }
        })();

        // Search functionality (placeholder)
        document.querySelector('.search-btn').addEventListener('click', function() {
            const query = document.querySelector('.search-input').value;
            if (query.trim() !== '') {
                alert('Searching for: ' + query + '\n(This is a demo - search functionality will be implemented with the backend)');
            } else {
                alert('Please enter a search term');
            }
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Help Center page loaded - Local environment');
    </script>
    @endif
</body>
</html>
