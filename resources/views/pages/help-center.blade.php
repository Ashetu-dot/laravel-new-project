<!DOCTYPE html>
<html lang="en">
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
            padding: 60px 20px 80px;
            text-align: center;
            position: relative;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
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
            max-width: 600px;
            margin: 0 auto 30px;
        }

        /* Search Container */
        .search-container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 60px;
            box-shadow: var(--shadow-hover);
            display: flex;
            align-items: center;
            padding: 5px;
            border: 1px solid var(--border-color);
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
            color: #aaa;
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
        }

        .container {
            max-width: 1200px;
            margin: -30px auto 60px;
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
        }

        .quick-help-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
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
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
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
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .help-footer p {
            opacity: 0.9;
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
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .help-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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

            .page-header { padding: 50px 20px 70px; }
            .page-header h1 { font-size: 36px; }
            
            .quick-help-grid {
                grid-template-columns: 1fr;
            }
            
            .categories-grid {
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
            <a href="{{ route('about') }}" class="nav-item">About Us</a>
            <a href="{{ route('help-center') }}" class="nav-item active">Help Center</a>
            @guest
                <a href="{{ route('login') }}" class="nav-item">Log In</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
            @else
                <span class="nav-item" style="color: var(--primary-color); font-weight: 600;">
                    <i class="ri-user-line"></i> {{ Auth::user()->name }}
                </span>
                <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">Profile</a>
                @if(Auth::user()->role === 'vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="nav-item">Dashboard</a>
                @elseif(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">Dashboard</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-item">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
                </form>
            @endguest
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
        <a href="{{ route('about') }}" class="nav-item">About Us</a>
        <a href="{{ route('help-center') }}" class="nav-item active">Help Center</a>
        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @else
            <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">Profile</a>
            @if(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">Dashboard</a>
            @elseif(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-item">Dashboard</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-item">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
            </form>
        @endguest
    </div>

    <!-- Page Header -->
    <section class="page-header">
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
                                    <span>Payment methods</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cancellation policy</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Leaving a review</span>
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
                                    <span>Getting paid</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Responding to reviews</span>
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
                                    <span>Accepted payment methods</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Telebirr payments</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Bank transfers</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cash on delivery</span>
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
                                    <span>Invoices and receipts</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <!-- Account & Security -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-shield-user-line"></i>
                            </div>
                            <h3 class="category-title">Account & Security</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Login issues</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Changing password</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Two-factor authentication</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Privacy settings</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Deleting account</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Reporting suspicious activity</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <!-- Technical Support -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-customer-service-line"></i>
                            </div>
                            <h3 class="category-title">Technical Support</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>App not working</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Browser compatibility</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Mobile app help</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Notification issues</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Loading errors</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Report a bug</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="view-all-link">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <!-- Policies -->
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="ri-file-text-line"></i>
                            </div>
                            <h3 class="category-title">Policies</h3>
                        </div>
                        <ul class="topic-list">
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Terms of service</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Privacy policy</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cancellation policy</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Refund policy</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Community guidelines</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </li>
                            <li class="topic-item">
                                <a href="#" class="topic-link">
                                    <span>Cookie policy</span>
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
                            <p>Learn about payment methods, processing times, and security.</p>
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
                            We accept Telebirr, bank transfers, cash on delivery (for eligible services), and major credit/debit cards. All payments are secure and encrypted.
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
                            <span>How do I leave a review?</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            After a completed booking, you'll receive an email with a link to leave a review. You can also go to "My Bookings" in your dashboard and leave a review there.
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
                        <li><a href="#">Invite Friends</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>For Vendors</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">List your service</a></li>
                        <li><a href="#">Vendor Resources</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora Inc. All rights reserved. Made with ❤️ in Jimma, Ethiopia</span>
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