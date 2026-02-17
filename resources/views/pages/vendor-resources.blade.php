<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendor Resources - Vendora | Jimma, Ethiopia</title>
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

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
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

        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }

        .quick-link-card {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--text-dark);
        }

        .quick-link-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .quick-link-icon {
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

        .quick-link-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .quick-link-desc {
            color: var(--text-light);
            font-size: 12px;
        }

        /* Section Title */
        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
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
            height: 8px;
            background-color: rgba(184, 142, 63, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .view-all:hover {
            gap: 8px;
        }

        /* Guide Categories */
        .guide-categories {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .guide-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
        }

        .guide-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .guide-image {
            height: 160px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .guide-content {
            padding: 25px;
        }

        .guide-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .guide-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .guide-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: 13px;
        }

        .guide-meta i {
            color: var(--primary-color);
        }

        .guide-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Templates & Tools */
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .template-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            border: 1px solid transparent;
        }

        .template-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .template-icon {
            width: 60px;
            height: 60px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 28px;
        }

        .template-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .template-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .template-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .template-format {
            font-size: 12px;
            color: var(--text-light);
            background: var(--bg-light);
            padding: 4px 10px;
            border-radius: 50px;
        }

        .template-download {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Webinars & Training */
        .webinars-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .webinar-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            display: flex;
        }

        .webinar-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .webinar-date {
            width: 100px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .webinar-day {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .webinar-month {
            font-size: 14px;
            text-transform: uppercase;
        }

        .webinar-content {
            flex: 1;
            padding: 20px;
        }

        .webinar-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .webinar-meta {
            display: flex;
            gap: 15px;
            color: var(--text-light);
            font-size: 13px;
            margin-bottom: 10px;
        }

        .webinar-meta i {
            color: var(--primary-color);
        }

        .webinar-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .webinar-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .webinar-speaker {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .webinar-speaker i {
            color: var(--primary-color);
        }

        .webinar-register {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .webinar-register:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Article Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .article-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .article-image {
            height: 150px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
        }

        .article-content {
            padding: 20px;
        }

        .article-category {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .article-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .article-excerpt {
            color: var(--text-light);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .article-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: 12px;
        }

        .article-meta i {
            color: var(--primary-color);
        }

        /* Community Section */
        .community-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 60px;
        }

        .community-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .community-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .community-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .community-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .community-icon {
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

        .community-name {
            font-size: 18px;
            font-weight: 700;
        }

        .community-members {
            color: var(--text-light);
            font-size: 13px;
        }

        .community-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .community-btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .community-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Support Section */
        .support-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 50px;
            text-align: center;
            color: white;
        }

        .support-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .support-text {
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .support-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .support-btn {
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

        .support-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .support-btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .support-btn-outline:hover {
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

            .quick-links {
                grid-template-columns: repeat(2, 1fr);
            }

            .guide-categories,
            .templates-grid,
            .articles-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .webinars-grid {
                grid-template-columns: 1fr;
            }

            .community-grid {
                grid-template-columns: 1fr;
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 60px 20px; }
            .page-header h1 { font-size: 36px; }

            .quick-links {
                grid-template-columns: 1fr;
            }

            .guide-categories,
            .templates-grid,
            .articles-grid {
                grid-template-columns: 1fr;
            }

            .webinar-card {
                flex-direction: column;
            }

            .webinar-date {
                width: 100%;
                flex-direction: row;
                gap: 10px;
                padding: 15px;
            }

            .community-section {
                padding: 30px 20px;
            }

            .support-section {
                padding: 40px 20px;
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

            .support-buttons {
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

    @if(session('info'))
        <div class="alert alert-info">
            <i class="ri-information-line"></i>
            {{ session('info') }}
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
            <a href="{{ route('list-service') }}" class="nav-item">List Your Service</a>
            <a href="{{ route('vendor-resources') }}" class="nav-item active">Resources</a>
            <a href="{{ route('about') }}" class="nav-item">About Us</a>
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
        <a href="{{ route('list-service') }}" class="nav-item">List Your Service</a>
        <a href="{{ route('vendor-resources') }}" class="nav-item active">Resources</a>
        <a href="{{ route('about') }}" class="nav-item">About Us</a>
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
        <h1>Vendor <span>Resources</span></h1>
        <p>Everything you need to succeed on Vendora - guides, templates, training, and support</p>
    </section>

    <main>
        <div class="container">
            <!-- Quick Links -->
            <div class="quick-links">
                <a href="#getting-started" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="ri-rocket-line"></i>
                    </div>
                    <h3 class="quick-link-title">Getting Started</h3>
                    <p class="quick-link-desc">Begin your journey</p>
                </a>
                <a href="#guides" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="ri-book-open-line"></i>
                    </div>
                    <h3 class="quick-link-title">Guides</h3>
                    <p class="quick-link-desc">Learn best practices</p>
                </a>
                <a href="#templates" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="ri-file-copy-line"></i>
                    </div>
                    <h3 class="quick-link-title">Templates</h3>
                    <p class="quick-link-desc">Ready-to-use resources</p>
                </a>
                <a href="#webinars" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="ri-video-line"></i>
                    </div>
                    <h3 class="quick-link-title">Webinars</h3>
                    <p class="quick-link-desc">Live training sessions</p>
                </a>
            </div>

            <!-- Getting Started Section -->
            <section id="getting-started">
                <div class="section-header">
                    <h2 class="section-title"><span>Getting</span> Started</h2>
                    <a href="#" class="view-all">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="guide-categories">
                    <div class="guide-card">
                        <div class="guide-image">
                            <i class="ri-user-add-line"></i>
                        </div>
                        <div class="guide-content">
                            <h3 class="guide-title">Account Setup Guide</h3>
                            <p class="guide-description">Step-by-step instructions to create and optimize your vendor account.</p>
                            <div class="guide-meta">
                                <span><i class="ri-time-line"></i> 5 min read</span>
                                <a href="#" class="guide-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="guide-card">
                        <div class="guide-image">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <div class="guide-content">
                            <h3 class="guide-title">Verification Process</h3>
                            <p class="guide-description">Everything you need to know about getting verified on Vendora.</p>
                            <div class="guide-meta">
                                <span><i class="ri-time-line"></i> 4 min read</span>
                                <a href="#" class="guide-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="guide-card">
                        <div class="guide-image">
                            <i class="ri-store-line"></i>
                        </div>
                        <div class="guide-content">
                            <h3 class="guide-title">Profile Optimization</h3>
                            <p class="guide-description">Tips to make your profile stand out and attract more customers.</p>
                            <div class="guide-meta">
                                <span><i class="ri-time-line"></i> 6 min read</span>
                                <a href="#" class="guide-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Guides Section -->
            <section id="guides">
                <div class="section-header">
                    <h2 class="section-title">Essential <span>Guides</span></h2>
                    <a href="#" class="view-all">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="articles-grid">
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-price-tag-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Pricing</span>
                            <h3 class="article-title">How to Price Your Services</h3>
                            <p class="article-excerpt">Learn effective pricing strategies to maximize your earnings while staying competitive.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 8 min read</span>
                                <span><i class="ri-eye-line"></i> 2.5k views</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-camera-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Marketing</span>
                            <h3 class="article-title">Photography Tips for Listings</h3>
                            <p class="article-excerpt">Take professional-looking photos of your work to attract more customers.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 6 min read</span>
                                <span><i class="ri-eye-line"></i> 3.2k views</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-star-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Reviews</span>
                            <h3 class="article-title">Getting Great Reviews</h3>
                            <p class="article-excerpt">Strategies to deliver exceptional service and earn 5-star ratings.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 5 min read</span>
                                <span><i class="ri-eye-line"></i> 1.8k views</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-message-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Communication</span>
                            <h3 class="article-title">Customer Communication Guide</h3>
                            <p class="article-excerpt">Best practices for messaging customers and handling inquiries.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 4 min read</span>
                                <span><i class="ri-eye-line"></i> 1.5k views</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-calendar-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Scheduling</span>
                            <h3 class="article-title">Managing Your Calendar</h3>
                            <p class="article-excerpt">Tips to optimize your availability and avoid scheduling conflicts.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 3 min read</span>
                                <span><i class="ri-eye-line"></i> 1.2k views</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-card">
                        <div class="article-image">
                            <i class="ri-bank-card-line"></i>
                        </div>
                        <div class="article-content">
                            <span class="article-category">Payments</span>
                            <h3 class="article-title">Understanding Payouts</h3>
                            <p class="article-excerpt">How payments work, processing times, and withdrawal options.</p>
                            <div class="article-meta">
                                <span><i class="ri-time-line"></i> 5 min read</span>
                                <span><i class="ri-eye-line"></i> 2.1k views</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Templates & Tools -->
            <section id="templates">
                <div class="section-header">
                    <h2 class="section-title">Templates & <span>Tools</span></h2>
                    <a href="#" class="view-all">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="templates-grid">
                    <div class="template-card">
                        <div class="template-icon">
                            <i class="ri-file-word-line"></i>
                        </div>
                        <h3 class="template-title">Service Agreement Template</h3>
                        <p class="template-description">Professional contract template customized for Ethiopian vendors.</p>
                        <div class="template-footer">
                            <span class="template-format">DOCX</span>
                            <a href="#" class="template-download">Download <i class="ri-download-line"></i></a>
                        </div>
                    </div>
                    <div class="template-card">
                        <div class="template-icon">
                            <i class="ri-file-excel-line"></i>
                        </div>
                        <h3 class="template-title">Invoice Template</h3>
                        <p class="template-description">Professional invoice template with Ethiopian tax calculations.</p>
                        <div class="template-footer">
                            <span class="template-format">XLSX</span>
                            <a href="#" class="template-download">Download <i class="ri-download-line"></i></a>
                        </div>
                    </div>
                    <div class="template-card">
                        <div class="template-icon">
                            <i class="ri-file-pdf-line"></i>
                        </div>
                        <h3 class="template-title">Price List Template</h3>
                        <p class="template-description">Beautiful price list template to showcase your services.</p>
                        <div class="template-footer">
                            <span class="template-format">PDF</span>
                            <a href="#" class="template-download">Download <i class="ri-download-line"></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Webinars & Training -->
            <section id="webinars">
                <div class="section-header">
                    <h2 class="section-title">Webinars & <span>Training</span></h2>
                    <a href="#" class="view-all">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="webinars-grid">
                    <div class="webinar-card">
                        <div class="webinar-date">
                            <span class="webinar-day">25</span>
                            <span class="webinar-month">FEB</span>
                        </div>
                        <div class="webinar-content">
                            <h3 class="webinar-title">Mastering Your Vendor Dashboard</h3>
                            <div class="webinar-meta">
                                <span><i class="ri-time-line"></i> 10:00 AM</span>
                                <span><i class="ri-video-line"></i> Online</span>
                            </div>
                            <p class="webinar-description">Learn to navigate your dashboard, track earnings, and manage bookings efficiently.</p>
                            <div class="webinar-footer">
                                <div class="webinar-speaker">
                                    <i class="ri-user-star-line"></i>
                                    <span>Abebe Tadesse</span>
                                </div>
                                <a href="#" class="webinar-register">Register</a>
                            </div>
                        </div>
                    </div>
                    <div class="webinar-card">
                        <div class="webinar-date">
                            <span class="webinar-day">28</span>
                            <span class="webinar-month">FEB</span>
                        </div>
                        <div class="webinar-content">
                            <h3 class="webinar-title">Marketing Your Services</h3>
                            <div class="webinar-meta">
                                <span><i class="ri-time-line"></i> 2:00 PM</span>
                                <span><i class="ri-video-line"></i> Online</span>
                            </div>
                            <p class="webinar-description">Strategies to promote your services and attract more customers on Vendora.</p>
                            <div class="webinar-footer">
                                <div class="webinar-speaker">
                                    <i class="ri-user-star-line"></i>
                                    <span>Mekdes Kebede</span>
                                </div>
                                <a href="#" class="webinar-register">Register</a>
                            </div>
                        </div>
                    </div>
                    <div class="webinar-card">
                        <div class="webinar-date">
                            <span class="webinar-day">03</span>
                            <span class="webinar-month">MAR</span>
                        </div>
                        <div class="webinar-content">
                            <h3 class="webinar-title">Customer Service Excellence</h3>
                            <div class="webinar-meta">
                                <span><i class="ri-time-line"></i> 11:00 AM</span>
                                <span><i class="ri-video-line"></i> Online</span>
                            </div>
                            <p class="webinar-description">Best practices for delivering exceptional service and building customer loyalty.</p>
                            <div class="webinar-footer">
                                <div class="webinar-speaker">
                                    <i class="ri-user-star-line"></i>
                                    <span>Tekle Berhan</span>
                                </div>
                                <a href="#" class="webinar-register">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Community Section -->
            <section class="community-section">
                <h2 class="section-title" style="text-align: center;">Join the <span>Community</span></h2>
                <div class="community-grid">
                    <div class="community-card">
                        <div class="community-header">
                            <div class="community-icon">
                                <i class="ri-telegram-line"></i>
                            </div>
                            <div>
                                <h3 class="community-name">Telegram Group</h3>
                                <p class="community-members">2,500+ members</p>
                            </div>
                        </div>
                        <p class="community-description">Connect with other vendors, share tips, ask questions, and grow together in our active Telegram community.</p>
                        <a href="#" class="community-btn">Join Group</a>
                    </div>
                    <div class="community-card">
                        <div class="community-header">
                            <div class="community-icon">
                                <i class="ri-whatsapp-line"></i>
                            </div>
                            <div>
                                <h3 class="community-name">WhatsApp Group</h3>
                                <p class="community-members">1,800+ members</p>
                            </div>
                        </div>
                        <p class="community-description">Get real-time support and network with fellow vendors in our WhatsApp community.</p>
                        <a href="#" class="community-btn">Join Group</a>
                    </div>
                </div>
            </section>

            <!-- Support Section -->
            <section class="support-section">
                <h2 class="support-title">Need Help?</h2>
                <p class="support-text">Our vendor support team is here to help you succeed. Get answers to your questions and personalized assistance.</p>
                <div class="support-buttons">
                    <a href="{{ route('help-center') }}" class="support-btn">
                        <i class="ri-customer-service-line"></i>
                        Visit Help Center
                    </a>
                    <a href="#" class="support-btn support-btn-outline">
                        <i class="ri-mail-send-line"></i>
                        Contact Support
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
                        <li><a href="{{ route('how-it-works') }}">How it works</a></li>
                        <li><a href="{{ route('trust-safety') }}">Trust & Safety</a></li>
                        <li><a href="{{ route('help-center') }}">Help Center</a></li>
                        <li><a href="{{ route('invite') }}">Invite Friends</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>For Vendors</h4>
                    <ul>
                        <li><a href="{{ route('list-service') }}">List your service</a></li>
                        <li><a href="{{ route('vendor-resources') }}">Vendor Resources</a></li>
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
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Vendor Resources page loaded - Local environment');
    </script>
    @endif
</body>
</html>