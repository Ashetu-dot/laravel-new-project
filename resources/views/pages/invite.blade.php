<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Invite Friends - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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
            --gradient-gold: linear-gradient(135deg, #B88E3F, #9c7832);
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #E5E7EB;
            --text-gray: #9CA3AF;
            --border-color: #374151;
            --white: #1F2937;
            --light-gray: #111827;
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --text-primary: #f3f4f6;
            --accent: #D4A55A;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
            --shadow-hover: 0 8px 24px rgba(0,0,0,0.4);
            --error: #F87171;
            --success: #34D399;
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

        /* theme / language toggles */
        .theme-lang-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toggle-btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--light-gray);
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
            background-color: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        body.dark-mode .toggle-btn-icon {
            background-color: #0b1220;
            border-color: #1f2937;
            color: #cbd5e1;
        }
        body.dark-mode .theme-lang-toggle { color: #cbd5e1; }

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

        .language-option {
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .language-option:hover {
            background-color: var(--light-gray);
            color: var(--primary-gold);
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
            padding: 80px 20px 100px;
            text-align: center;
            color: white;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1600&q=80');
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
            isolation: isolate;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.4), rgba(0, 0, 0, 0.7));
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
            margin: 0 auto;
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

        .container {
            max-width: 1200px;
            margin: -30px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
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
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
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
            transition: all 0.3s;
        }

        .stat-card:hover .stat-icon {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
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
            box-shadow: var(--shadow-hover);
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
            animation: pulse 4s infinite;
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
            animation: pulse 4s infinite 2s;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        .referral-hero-content {
            position: relative;
            z-index: 2;
        }

        .referral-hero h2 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .referral-hero p {
            font-size: 20px;
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .referral-code {
            flex: 1;
            padding: 15px 25px;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 3px;
            color: white;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
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
            font-size: 16px;
        }

        .copy-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        .copy-btn i {
            font-size: 18px;
        }

        /* How It Works */
        .how-it-works {
            margin-bottom: 60px;
        }

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
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
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
            transition: transform 0.3s;
        }

        .step-card:hover .step-icon {
            transform: scale(1.1);
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
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .reward-card:hover {
            transform: translateX(10px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .reward-icon {
            width: 80px;
            height: 80px;
            background: rgba(184, 142, 63, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 36px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .reward-card:hover .reward-icon {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
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
            font-size: 28px;
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
            border: 1px solid var(--border-color);
        }

        .invite-form {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: var(--text-dark);
        }

        .form-title span {
            color: var(--primary-color);
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

        .form-input[readonly] {
            background-color: var(--bg-light);
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .invite-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            padding: 18px;
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
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.4);
        }

        .invite-btn i {
            font-size: 20px;
        }

        /* Share Section */
        .share-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .share-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text-dark);
        }

        .share-title span {
            color: var(--primary-color);
        }

        .share-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .share-btn {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            transition: all 0.3s;
            text-decoration: none;
            box-shadow: var(--shadow);
        }

        .share-btn:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
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

        .share-btn.copy:hover {
            background: var(--primary-color);
        }

        .referral-link-box {
            background: var(--bg-light);
            padding: 20px;
            border-radius: var(--radius-md);
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid var(--border-color);
        }

        .referral-link-box p {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .referral-link-code {
            background: var(--white);
            padding: 12px 20px;
            border-radius: 50px;
            display: inline-block;
            font-family: monospace;
            font-size: 16px;
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            word-break: break-all;
        }

        /* Referral History */
        .history-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 60px;
            border: 1px solid var(--border-color);
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
            color: var(--text-dark);
        }

        .history-title i {
            color: var(--primary-color);
            margin-right: 8px;
        }

        .view-all-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .view-all-link:hover {
            gap: 8px;
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
            padding: 6px 15px;
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
            padding: 60px 20px;
            color: var(--text-light);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-light);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .empty-state p {
            font-size: 14px;
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
            color: var(--text-dark);
        }

        .terms-title i {
            color: var(--primary-color);
            font-size: 22px;
        }

        .terms-list {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.8;
            padding-left: 20px;
        }

        .terms-list li {
            margin-bottom: 8px;
        }

        .terms-list li::marker {
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
            font-size: 18px;
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
            .page-header h1 { font-size: 48px; }

            .referral-hero {
                padding: 40px 20px;
            }

            .referral-hero h2 {
                font-size: 36px;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 60px 20px 80px; }
            .page-header h1 { font-size: 40px; }

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
                font-size: 24px;
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
                gap: 12px;
            }

            .share-btn {
                width: 55px;
                height: 55px;
                font-size: 26px;
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
                <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            </a>
            
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-item">Features</a>
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
            @guest
                <a href="{{ route('login') }}" class="nav-item">Log In</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
            @endguest
        </div>
        <div class="menu-btn" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
        <div class="nav-actions">
            <div class="theme-lang-toggle">
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
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
        <a href="{{ route('home') }}#features" class="nav-item">Features</a>
        <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @endguest
        <div class="mobile-nav-actions" style="margin-top:16px; display:flex; gap:16px; align-items:center;">
            <button class="toggle-btn-icon" id="themeToggleMobile" title="Toggle Theme">
                <i class="ri-moon-line"></i>
            </button>
            <div class="language-selector" id="languageSelectorMobile" style="position:relative;">
                <button class="toggle-btn-icon" id="languageToggleMobile" onclick="toggleLanguageDropdown(event, true)" aria-haspopup="true" aria-expanded="false" title="Language">
                    <i class="ri-translate-2"></i>
                </button>
                <div class="language-dropdown" style="display:none; position:absolute; right:0; background:white; box-shadow:var(--shadow); border-radius:8px; overflow:hidden;">
                    <div class="language-option" data-locale="en" onclick="changeLanguage('en', true)">
                        English @if(session('locale','en') === 'en') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                    <div class="language-option" data-locale="am" onclick="changeLanguage('am', true)">
                        አማርኛ @if(session('locale','en') === 'am') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                    <div class="language-option" data-locale="om" onclick="changeLanguage('om', true)">
                        Oromiffa @if(session('locale','en') === 'om') <i class="ri-check-line" style="float:right"></i> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header with Dynamic Background -->
    <section class="page-header" id="inviteHeroBg">
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
                <h2 class="section-title">How It <span>Works</span></h2>
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
                <h2 class="section-title">Rewards & <span>Bonuses</span></h2>
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
                <h2 class="form-title">Invite via <span>Email</span></h2>
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
                <h3 class="share-title">Share Your <span>Referral Link</span></h3>
                <div class="share-buttons">
                    <a href="#" class="share-btn telegram" onclick="shareOnTelegram()" title="Share on Telegram">
                        <i class="ri-telegram-line"></i>
                    </a>
                    <a href="#" class="share-btn facebook" onclick="shareOnFacebook()" title="Share on Facebook">
                        <i class="ri-facebook-line"></i>
                    </a>
                    <a href="#" class="share-btn twitter" onclick="shareOnTwitter()" title="Share on Twitter">
                        <i class="ri-twitter-line"></i>
                    </a>
                    <a href="#" class="share-btn whatsapp" onclick="shareOnWhatsApp()" title="Share on WhatsApp">
                        <i class="ri-whatsapp-line"></i>
                    </a>
                    <a href="#" class="share-btn email" onclick="shareOnEmail()" title="Share via Email">
                        <i class="ri-mail-line"></i>
                    </a>
                    <button class="share-btn copy" onclick="copyReferralLink()" title="Copy Link">
                        <i class="ri-link"></i>
                    </button>
                </div>
                @auth
                <div class="referral-link-box">
                    <p>Your unique referral link:</p>
                    <code class="referral-link-code">{{ url('/register?ref=' . (Auth::user()->referral_code ?? 'VENDORA' . rand(1000, 9999))) }}</code>
                </div>
                @endauth
            </section>

            <!-- Referral History (visible when logged in) -->
            @auth
            <section class="history-section">
                <div class="history-header">
                    <h3 class="history-title">
                        <i class="ri-history-line"></i>
                        Your Referrals
                    </h3>
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
                            <td>{{ $referral->created_at ? $referral->created_at->format('M d, Y') : 'Feb 15, 2025' }}</td>
                            <td>
                                <span class="status-badge status-{{ $referral->status ?? 'success' }}">
                                    {{ ucfirst($referral->status ?? 'Success') }}
                                </span>
                            </td>
                            <td><strong>ETB {{ $referral->reward ?? '150' }}</strong></td>
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
                    <i class="ri-file-text-line"></i>
                    Terms & Conditions
                </h4>
                <ul class="terms-list">
                    <li>Both referrer and friend must have valid accounts on Vendora</li>
                    <li>Friend must sign up using the unique referral code or link</li>
                    <li>Rewards are credited within 24 hours after friend's first booking is completed</li>
                    <li>Maximum referral bonus per month: ETB 2,000</li>
                    <li>Referral program is valid for customers only (vendors can participate in vendor referral program)</li>
                    <li>Vendora reserves the right to void referrals found to be fraudulent or in violation of terms</li>
                    <li>Rewards can be used for future bookings or withdrawn to mobile money</li>
                </ul>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:40px;width:40px;object-fit:cover;border-radius:50%;vertical-align:middle;"></h2>
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
                        <li><a href="{{ route('list-service') }}">List your service</a></li>
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
        // ── Rotating hero background ──────────────────────────────────
        (function() {
            const header = document.getElementById('inviteHeroBg');
            if (!header) return;
            const images = [
                'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1600&q=80',
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1600&q=80',
                'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=1600&q=80',
                'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1600&q=80',
                'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1600&q=80',
                'https://images.unsplash.com/photo-1534452203293-494d7ddbf7e0?w=1600&q=80',
            ];
            const overlay = 'linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6))';
            let i = 0;
            setInterval(() => {
                i = (i + 1) % images.length;
                header.style.backgroundImage = `${overlay}, url('${images[i]}')`;
            }, 8000);
        })();

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

        // Referral link — set once from PHP
        @auth
        const REFERRAL_URL = '{{ url("/register?ref=" . (Auth::user()->referral_code ?? "")) }}';
        const REFERRAL_CODE = '{{ Auth::user()->referral_code ?? "" }}';
        @else
        const REFERRAL_URL = '{{ url("/register") }}';
        const REFERRAL_CODE = '';
        @endauth

        // Copy referral code function
        function copyReferralCode() {
            navigator.clipboard.writeText(REFERRAL_CODE).then(() => {
                showNotification('Referral code copied: ' + REFERRAL_CODE, 'success');
            }).catch(() => showNotification('Failed to copy. Please copy manually.', 'error'));
        }

        // Copy referral link function
        function copyReferralLink() {
            navigator.clipboard.writeText(REFERRAL_URL).then(() => {
                showNotification('Referral link copied to clipboard!', 'success');
            }).catch(() => showNotification('Failed to copy. Please copy manually.', 'error'));
        }

        // Share functions
        function shareOnTelegram() {
            const msg = encodeURIComponent('Join me on Vendora — find amazing local services in Jimma! Use my referral link to get a bonus on signup: ' + REFERRAL_URL);
            window.open(`https://t.me/share/url?url=${encodeURIComponent(REFERRAL_URL)}&text=${msg}`, '_blank');
        }

        function shareOnFacebook() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(REFERRAL_URL)}`, '_blank');
        }

        function shareOnTwitter() {
            const text = encodeURIComponent('Join me on Vendora to find amazing local services in Jimma! Use my referral link for a bonus: ' + REFERRAL_URL);
            window.open(`https://twitter.com/intent/tweet?text=${text}`, '_blank');
        }

        function shareOnWhatsApp() {
            const text = encodeURIComponent('Join me on Vendora — find amazing local services in Jimma! Sign up with my referral link to get a bonus: ' + REFERRAL_URL);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function shareOnEmail() {
            const subject = encodeURIComponent('Join me on Vendora!');
            const body = encodeURIComponent('Hey!\n\nI\'ve been using Vendora to find amazing local services in Jimma. Join me and get a bonus on signup!\n\nSign up here: ' + REFERRAL_URL);
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
            `;

            const icon = type === 'success' ? 'ri-checkbox-circle-line' :
                        type === 'error' ? 'ri-error-warning-line' :
                        'ri-information-line';

            notification.innerHTML = `<i class="${icon}"></i> ${message}`;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (!alert.style.position) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
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

        // theme toggling helpers
        function applyTheme(theme) {
            if (theme === 'dark') {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        }
        function updateTheme(theme) {
            fetch('/toggle-theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: theme })
            }).catch(()=>{});
        }

        document.getElementById('themeToggle')?.addEventListener('click', function() {
            const isDark = document.body.classList.toggle('dark-mode');
            const theme = isDark ? 'dark' : 'light';
            const icon = this.querySelector('i');
            if (icon) icon.className = isDark ? 'ri-sun-line' : 'ri-moon-line';
            updateTheme(theme);
        });
        document.getElementById('themeToggleMobile')?.addEventListener('click', function() {
            const isDark = document.body.classList.toggle('dark-mode');
            const theme = isDark ? 'dark' : 'light';
            const icon = this.querySelector('i');
            if (icon) icon.className = isDark ? 'ri-sun-line' : 'ri-moon-line';
            updateTheme(theme);
        });

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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ locale: locale })
            }).then(() => {
                window.location.reload();
            }).catch(err => console.error('Failed to change language', err));
        }

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

        (function() {
            try {
                const storedLocale = localStorage.getItem('locale');
                if (storedLocale && document.documentElement.lang !== storedLocale) {
                    document.documentElement.lang = storedLocale;
                }
            } catch(e) { }
        })();
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Invite Friends page loaded - Local environment');
    </script>
    @endif
</body>
</html>
