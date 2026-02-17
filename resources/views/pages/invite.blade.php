<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Invite Friends - Vendora | Jimma, Ethiopia</title>
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

        .referral-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 16px;
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
            padding: 60px 20px;
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
            max-width: 600px;
            margin: 0 auto;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Referral Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .stat-icon {
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
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Referral Hero */
        .referral-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 60px;
            margin-bottom: 60px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .referral-hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .referral-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .referral-hero-content {
            position: relative;
            z-index: 2;
        }

        .referral-hero h2 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .referral-hero p {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .referral-code-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 60px;
            padding: 5px;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .referral-code {
            flex: 1;
            padding: 15px 25px;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            color: white;
            text-align: center;
        }

        .copy-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-right: 5px;
        }

        .copy-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* How It Works */
        .how-it-works {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .step-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow);
            position: relative;
            transition: transform 0.3s;
        }

        .step-card:hover {
            transform: translateY(-5px);
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
            margin: 0 auto 25px;
        }

        .step-icon {
            font-size: 48px;
            color: var(--primary-color);
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

        /* Rewards Section */
        .rewards-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 60px;
            margin-bottom: 60px;
        }

        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .reward-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            display: flex;
            gap: 20px;
            align-items: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .reward-card:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-hover);
        }

        .reward-icon {
            width: 70px;
            height: 70px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 32px;
            flex-shrink: 0;
        }

        .reward-content {
            flex: 1;
        }

        .reward-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .reward-description {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .reward-value {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-color);
        }

        /* Invite Form */
        .invite-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 50px;
            box-shadow: var(--shadow);
            margin-bottom: 60px;
        }

        .invite-form {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .invite-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .invite-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Share Section */
        .share-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .share-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .share-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .share-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .share-btn:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .share-btn.telegram {
            background: #0088cc;
        }

        .share-btn.facebook {
            background: #1877f2;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.whatsapp {
            background: #25d366;
        }

        .share-btn.email {
            background: #ea4335;
        }

        .share-btn.copy {
            background: var(--text-light);
        }

        /* Referral History */
        .history-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 60px;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .history-title {
            font-size: 24px;
            font-weight: 700;
        }

        .view-all-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            padding: 15px 10px;
            color: var(--text-light);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
        }

        .history-table td {
            padding: 15px 10px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-success {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-expired {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
        }

        .empty-icon {
            font-size: 48px;
            color: var(--text-light);
            margin-bottom: 15px;
        }

        /* Terms */
        .terms-section {
            background: var(--bg-light);
            border-radius: var(--radius-md);
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid var(--border-color);
        }

        .terms-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .terms-list {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            padding-left: 20px;
        }

        .terms-list li {
            margin-bottom: 8px;
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
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .rewards-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 40px; }
            
            .referral-hero {
                padding: 40px 20px;
            }
            
            .referral-hero h2 {
                font-size: 32px;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 40px 20px; }
            .page-header h1 { font-size: 36px; }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .steps-grid {
                grid-template-columns: 1fr;
            }
            
            .rewards-section {
                padding: 30px 20px;
            }
            
            .invite-section {
                padding: 30px 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .history-section {
                padding: 20px;
                overflow-x: auto;
            }
            
            .referral-code-box {
                flex-direction: column;
                background: transparent;
                gap: 15px;
            }
            
            .referral-code {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50px;
                width: 100%;
            }
            
            .copy-btn {
                width: 100%;
                justify-content: center;
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
            
            .referral-hero h2 {
                font-size: 28px;
            }
            
            .share-buttons {
                gap: 10px;
            }
            
            .share-btn {
                width: 50px;
                height: 50px;
                font-size: 24px;
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
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
            <a href="{{ route('about') }}" class="nav-item">About Us</a>
            <a href="{{ route('invite') }}" class="nav-item active">Invite Friends</a>
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
        <a href="{{ route('invite') }}" class="nav-item active">Invite Friends</a>
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
        <h1>Invite <span>Friends</span></h1>
        <p>Share Vendora with your friends and earn rewards together!</p>
    </section>

    <main>
        <div class="container">
            <!-- Stats Section (only visible when logged in) -->
            @auth
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-user-shared-line"></i>
                    </div>
                    <div class="stat-value">{{ $totalInvites ?? '12' }}</div>
                    <div class="stat-label">Total Invites</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-user-follow-line"></i>
                    </div>
                    <div class="stat-value">{{ $successfulInvites ?? '8' }}</div>
                    <div class="stat-label">Successful Signups</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-gift-line"></i>
                    </div>
                    <div class="stat-value">ETB {{ $totalEarned ?? '450' }}</div>
                    <div class="stat-label">Total Earned</div>
                </div>
            </div>
            @endauth

            <!-- Referral Hero -->
            <div class="referral-hero">
                <div class="referral-hero-content">
                    <h2>Share & Earn Together</h2>
                    <p>Get ETB 50 for every friend who signs up and ETB 100 more when they make their first booking!</p>
                    
                    @auth
                    <div class="referral-code-box">
                        <div class="referral-code" id="referralCode">{{ Auth::user()->referral_code ?? 'VENDORA' . rand(1000, 9999) }}</div>
                        <button class="copy-btn" onclick="copyReferralCode()">
                            <i class="ri-file-copy-line"></i>
                            Copy Code
                        </button>
                    </div>
                    @else
                    <div style="margin-top: 30px;">
                        <a href="{{ route('login') }}" class="btn-signup" style="display: inline-block; padding: 15px 40px !important; font-size: 18px;">Login to Get Your Referral Code</a>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- How It Works -->
            <section class="how-it-works">
                <h2 class="section-title">How It Works</h2>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="ri-share-line"></i>
                        </div>
                        <h3 class="step-title">Share Your Code</h3>
                        <p class="step-description">Share your unique referral code with friends via social media, messaging apps, or email.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="ri-user-add-line"></i>
                        </div>
                        <h3 class="step-title">Friend Signs Up</h3>
                        <p class="step-description">Your friend signs up using your referral code and creates their account.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="ri-gift-line"></i>
                        </div>
                        <h3 class="step-title">You Both Earn</h3>
                        <p class="step-description">You get ETB 50 and your friend gets ETB 25 instantly. They earn ETB 100 on first booking!</p>
                    </div>
                </div>
            </section>

            <!-- Rewards Section -->
            <section class="rewards-section">
                <h2 class="section-title">Rewards</h2>
                <div class="rewards-grid">
                    <div class="reward-card">
                        <div class="reward-icon">
                            <i class="ri-user-shared-line"></i>
                        </div>
                        <div class="reward-content">
                            <div class="reward-title">For You</div>
                            <div class="reward-description">When your friend signs up</div>
                            <div class="reward-value">ETB 50</div>
                        </div>
                    </div>
                    <div class="reward-card">
                        <div class="reward-icon">
                            <i class="ri-user-star-line"></i>
                        </div>
                        <div class="reward-content">
                            <div class="reward-title">For Your Friend</div>
                            <div class="reward-description">Welcome bonus on signup</div>
                            <div class="reward-value">ETB 25</div>
                        </div>
                    </div>
                    <div class="reward-card">
                        <div class="reward-icon">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                        <div class="reward-content">
                            <div class="reward-title">First Booking</div>
                            <div class="reward-description">When they make their first booking</div>
                            <div class="reward-value">ETB 100</div>
                        </div>
                    </div>
                    <div class="reward-card">
                        <div class="reward-icon">
                            <i class="ri-award-line"></i>
                        </div>
                        <div class="reward-content">
                            <div class="reward-title">Monthly Top Referrer</div>
                            <div class="reward-description">Additional bonus for top referrers</div>
                            <div class="reward-value">ETB 500</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Invite Form (visible when logged in) -->
            @auth
            <section class="invite-section">
                <h2 class="form-title">Invite Friends via Email</h2>
                <form class="invite-form" action="{{ route('invite.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Friend's Name</label>
                        <input type="text" name="friend_name" class="form-input" placeholder="Enter your friend's name" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Friend's Email</label>
                        <input type="email" name="friend_email" class="form-input" placeholder="Enter your friend's email" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="your_name" class="form-input" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="your_email" class="form-input" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Personal Message (Optional)</label>
                        <textarea name="message" class="form-input" rows="3" placeholder="Add a personal message to your friend...">Hey! I've been using Vendora to find amazing local services in Jimma. You should try it too! Use my referral code {{ Auth::user()->referral_code ?? 'VENDORA' . rand(1000, 9999) }} to get ETB 25 bonus on signup!</textarea>
                    </div>
                    
                    <button type="submit" class="invite-btn">
                        <i class="ri-mail-send-line"></i>
                        Send Invitation
                    </button>
                </form>
            </section>
            @endauth

            <!-- Share Section -->
            <section class="share-section">
                <h3 class="share-title">Share Your Referral Link</h3>
                <div class="share-buttons">
                    <a href="#" class="share-btn telegram" onclick="shareOnTelegram()">
                        <i class="ri-telegram-line"></i>
                    </a>
                    <a href="#" class="share-btn facebook" onclick="shareOnFacebook()">
                        <i class="ri-facebook-line"></i>
                    </a>
                    <a href="#" class="share-btn twitter" onclick="shareOnTwitter()">
                        <i class="ri-twitter-line"></i>
                    </a>
                    <a href="#" class="share-btn whatsapp" onclick="shareOnWhatsApp()">
                        <i class="ri-whatsapp-line"></i>
                    </a>
                    <a href="#" class="share-btn email" onclick="shareOnEmail()">
                        <i class="ri-mail-line"></i>
                    </a>
                    <button class="share-btn copy" onclick="copyReferralLink()">
                        <i class="ri-link"></i>
                    </button>
                </div>
                @auth
                <div style="margin-top: 20px; background: var(--bg-light); padding: 15px; border-radius: var(--radius-md);">
                    <p style="font-size: 14px; color: var(--text-light); margin-bottom: 5px;">Your referral link:</p>
                    <code style="background: var(--white); padding: 8px 15px; border-radius: 50px; display: inline-block;">{{ url('/register?ref=' . (Auth::user()->referral_code ?? 'VENDORA' . rand(1000, 9999))) }}</code>
                </div>
                @endauth
            </section>

            <!-- Referral History (visible when logged in) -->
            @auth
            <section class="history-section">
                <div class="history-header">
                    <h3 class="history-title">Your Referrals</h3>
                    <a href="#" class="view-all-link">View All <i class="ri-arrow-right-line"></i></a>
                </div>
                
                @if(isset($referrals) && count($referrals) > 0)
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Friend</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Reward</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $referral)
                        <tr>
                            <td>{{ $referral->friend_name ?? 'Abebe Kebede' }}</td>
                            <td>{{ $referral->created_at ?? 'Feb 15, 2025' }}</td>
                            <td>
                                <span class="status-badge status-{{ $referral->status ?? 'success' }}">
                                    {{ ucfirst($referral->status ?? 'Success') }}
                                </span>
                            </td>
                            <td>ETB {{ $referral->reward ?? '150' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="ri-user-shared-line"></i>
                    </div>
                    <h4>No referrals yet</h4>
                    <p>Start inviting friends to earn rewards!</p>
                </div>
                @endif
            </section>
            @endauth

            <!-- Terms and Conditions -->
            <section class="terms-section">
                <h4 class="terms-title">
                    <i class="ri-file-text-line" style="color: var(--primary-color);"></i>
                    Terms & Conditions
                </h4>
                <ul class="terms-list">
                    <li>Both referrer and friend must have valid accounts on Vendora</li>
                    <li>Friend must sign up using the unique referral code or link</li>
                    <li>Rewards are credited within 24 hours after friend's first booking is completed</li>
                    <li>Maximum referral bonus per month: ETB 2,000</li>
                    <li>Referral program is valid for customers only (vendors can participate in vendor referral program)</li>
                    <li>Vendora reserves the right to void referrals found to be fraudulent or in violation of terms</li>
                    <li>Rewards can be used for future bookings or withdrawn to mobile money (Telebirr)</li>
                </ul>
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

        // Copy referral code function
        function copyReferralCode() {
            const codeElement = document.getElementById('referralCode');
            const code = codeElement.textContent;
            
            navigator.clipboard.writeText(code).then(function() {
                alert('Referral code copied to clipboard: ' + code);
            }, function() {
                alert('Failed to copy code. Please select and copy manually.');
            });
        }

        // Copy referral link function
        function copyReferralLink() {
            const link = '{{ url("/register?ref=" . (Auth::user()->referral_code ?? "VENDORA" . rand(1000, 9999))) }}';
            
            navigator.clipboard.writeText(link).then(function() {
                alert('Referral link copied to clipboard!');
            }, function() {
                alert('Failed to copy link. Please select and copy manually.');
            });
        }

        // Share functions
        function shareOnTelegram() {
            const message = encodeURIComponent('Join me on Vendora to find amazing local services in Jimma! Use my referral code for a bonus: {{ Auth::user()->referral_code ?? "VENDORA" . rand(1000, 9999) }}');
            const url = `https://t.me/share/url?url={{ urlencode(url('/')) }}&text=${message}`;
            window.open(url, '_blank');
        }

        function shareOnFacebook() {
            const url = `https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/')) }}&quote=${encodeURIComponent('Join me on Vendora! Use my referral code for a bonus.')}`;
            window.open(url, '_blank');
        }

        function shareOnTwitter() {
            const text = encodeURIComponent('Join me on Vendora to find amazing local services in Jimma! Use my referral code {{ Auth::user()->referral_code ?? "VENDORA" . rand(1000, 9999) }} for a bonus!');
            const url = `https://twitter.com/intent/tweet?text=${text}&url={{ urlencode(url('/')) }}`;
            window.open(url, '_blank');
        }

        function shareOnWhatsApp() {
            const text = encodeURIComponent('Join me on Vendora to find amazing local services in Jimma! Use my referral code {{ Auth::user()->referral_code ?? "VENDORA" . rand(1000, 9999) }} for a bonus!');
            const url = `https://wa.me/?text=${text}%20{{ urlencode(url('/')) }}`;
            window.open(url, '_blank');
        }

        function shareOnEmail() {
            const subject = encodeURIComponent('Join me on Vendora!');
            const body = encodeURIComponent('Hey,\n\nI\'ve been using Vendora to find amazing local services in Jimma. You should try it too! Sign up using my referral code {{ Auth::user()->referral_code ?? "VENDORA" . rand(1000, 9999) }} to get a bonus on signup!\n\nCheck it out: ' + '{{ url('/') }}');
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
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
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Invite Friends page loaded - Local environment');
    </script>
    @endif
</body>
</html>