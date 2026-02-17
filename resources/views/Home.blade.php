<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Local Vendor Finder | Jimma, Ethiopia</title>
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

        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
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

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 80px;
            text-align: center;
            background: linear-gradient(180deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            position: relative;
        }

        .hero-headline {
            font-size: 64px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 24px;
            color: var(--text-dark);
            max-width: 900px;
            letter-spacing: -1.5px;
        }

        .hero-headline span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .hero-headline span::after {
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

        .hero-subtext {
            font-size: 20px;
            color: var(--text-light);
            margin-bottom: 40px;
            max-width: 600px;
            line-height: 1.6;
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary-color);
        }

        .hero-stat-label {
            font-size: 14px;
            color: var(--text-light);
        }

        /* Search Container */
        .search-container {
            background: var(--white);
            padding: 16px;
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 960px;
            border: 1px solid rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(184, 142, 63, 0.15);
        }

        .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-right: 1px solid #E5E5E5;
            position: relative;
        }

        .input-group:last-of-type {
            border-right: none;
        }

        .input-group i {
            font-size: 22px;
            color: var(--primary-color);
            margin-right: 16px;
        }

        .input-content {
            display: flex;
            flex-direction: column;
            width: 100%;
            text-align: left;
        }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .input-field {
            border: none;
            outline: none;
            font-size: 16px;
            color: var(--text-light);
            background: transparent;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .input-field::placeholder {
            color: #AAAAAA;
        }

        .search-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 16px;
            flex-shrink: 0;
        }

        .search-btn:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05);
        }

        .search-btn i {
            font-size: 24px;
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .feature-card {
            background: var(--white);
            padding: 40px 32px;
            border-radius: 24px;
            text-align: left;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background-color: rgba(184, 142, 63, 0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-size: 24px;
            transition: transform 0.3s;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }

        .feature-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .feature-desc {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Background Circles */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }

        .circle-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(184,142,63,0.08) 0%, rgba(255,255,255,0) 70%);
            top: -200px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(184,142,63,0.06) 0%, rgba(255,255,255,0) 70%);
            bottom: 0;
            left: -100px;
            animation: float 12s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Categories Section */
        .categories-wrapper {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .view-all:hover {
            gap: 8px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: var(--white);
            padding: 30px 10px;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            text-decoration: none;
            color: var(--text-dark);
        }

        .category-item:hover {
            border-color: var(--primary-color);
            background: #FFFDF8;
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(184, 142, 63, 0.1);
        }

        .cat-icon {
            font-size: 32px;
            color: var(--text-dark);
            margin-bottom: 12px;
            transition: color 0.3s, transform 0.3s;
        }

        .category-item:hover .cat-icon {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .cat-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
        }

        /* Local Categories */
        .local-section {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }

        .local-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 40px;
        }

        .local-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--text-dark);
        }

        .local-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .local-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }

        .local-content {
            padding: 24px;
        }

        .local-content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .local-content p {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .local-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .local-vendors {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Testimonials */
        .testimonials {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 80px 20px;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            margin-top: 48px;
        }

        .testimonial-card {
            background: var(--white);
            padding: 32px;
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .testimonial-text {
            color: var(--text-light);
            font-style: italic;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .testimonial-info h4 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .testimonial-info p {
            color: var(--text-light);
            font-size: 12px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            text-align: center;
            padding: 80px 20px;
        }

        .cta-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .cta-text {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: white;
            color: var(--primary-color);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            border-top: 1px solid #EEEEEE;
            padding: 60px 80px 40px;
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
            .hero-headline { font-size: 56px; }
            .categories-wrapper, .local-section { padding: 0 30px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 18px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }
            .hero-headline { font-size: 48px; max-width: 700px; }
            .hero-subtext { font-size: 18px; }
            .search-container { max-width: 800px; }
            .features { gap: 24px; padding: 0 30px; }
            .categories-grid { grid-template-columns: repeat(3, 1fr); gap: 18px; }
            .footer-links { gap: 50px; }
            .local-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media screen and (max-width: 900px) {
            .search-container {
                flex-direction: column;
                border-radius: 40px;
                padding: 24px;
                max-width: 550px;
            }
            .input-group {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #E5E5E5;
                padding: 12px 16px;
            }
            .input-group:last-of-type { border-bottom: none; }
            .search-btn {
                margin-left: 0;
                margin-top: 16px;
                width: 60px;
                height: 60px;
            }
            .hero-stats { gap: 24px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .hero { padding: 80px 20px 60px; }
            .hero-headline { font-size: 40px; }
            .hero-headline span::after { height: 10px; bottom: 4px; }
            .hero-subtext { font-size: 16px; max-width: 480px; }
            .hero-stats { justify-content: center; gap: 20px; }

            .features { grid-template-columns: 1fr; gap: 20px; margin: 50px auto; max-width: 550px; }

            .categories-wrapper { padding: 0 24px; margin-bottom: 60px; }
            .section-title { font-size: 28px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }

            .local-grid { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .cta-title { font-size: 36px; }
            .cta-buttons { flex-direction: column; align-items: center; }

            .footer-content { flex-direction: column; gap: 40px; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            .footer-brand .footer-text { max-width: 100%; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; gap: 8px; }
            .brand i { font-size: 24px; }

            .hero-headline { font-size: 34px; }
            .hero-subtext { font-size: 15px; }

            .search-container { border-radius: 32px; padding: 20px; }
            .input-group i { font-size: 20px; margin-right: 12px; }
            .input-field { font-size: 15px; }

            .categories-wrapper { padding: 0 20px; }
            .section-header { flex-wrap: wrap; gap: 10px; }
            .section-title { font-size: 26px; }

            .feature-card { padding: 30px 24px; }

            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }

        @media screen and (max-width: 480px) {
            .hero-headline { font-size: 28px; }
            .hero { padding: 60px 16px 40px; }

            .search-container { padding: 18px; }
            .input-group { padding: 8px 0px; }
            .input-label { font-size: 11px; }

            .section-title { font-size: 24px; }
            .categories-grid { gap: 12px; }
            .category-item { padding: 20px 8px; }
            .cat-icon { font-size: 28px; }

            .feature-icon { width: 48px; height: 48px; font-size: 22px; }
            .feature-title { font-size: 18px; }

            .cta-title { font-size: 28px; }
            .btn { padding: 14px 30px; font-size: 16px; }

            footer { padding: 40px 20px 20px; }
        }

        @media screen and (max-width: 360px) {
            .hero-headline { font-size: 26px; }
            .brand { font-size: 18px; }
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
            <a href="#categories" class="nav-item">Categories</a>
            <a href="#features" class="nav-item">Features</a>
            <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
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
        <a href="#categories" class="nav-item">Categories</a>
        <a href="#features" class="nav-item">Features</a>
        <a href="{{ route('register') }}" class="nav-item">For Vendors</a>
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

    <!-- Hero Section -->
    <section class="hero">
        <h1 class="hero-headline">Find the Best <br><span>Local Vendors</span> in Jimma</h1>
        <p class="hero-subtext">Connect with top-rated local professionals for your events, home needs, and daily services. Trusted by thousands in your community.</p>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($vendorCount) }}</div>
                <div class="hero-stat-label">Local Vendors</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($customerCount) }}</div>
                <div class="hero-stat-label">Happy Customers</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ $categoryCount }}</div>
                <div class="hero-stat-label">Categories</div>
            </div>
        </div>

        <!-- Search Box -->
        <form action="{{ route('search.results') }}" method="GET" style="width: 100%; display: flex; justify-content: center;">
            <div class="search-container">
                <div class="input-group">
                    <i class="ri-search-line"></i>
                    <div class="input-content">
                        <label class="input-label">What</label>
                        <input type="text" name="query" class="input-field" placeholder="Plumbers, Bakers, Photographers..." value="{{ request('query') }}">
                    </div>
                </div>
                <div class="input-group">
                    <i class="ri-map-pin-line"></i>
                    <div class="input-content">
                        <label class="input-label">Where</label>
                        <input type="text" name="location" class="input-field" placeholder="Jimma, Ethiopia" value="{{ request('location', 'Jimma') }}">
                    </div>
                </div>
                <button type="submit" class="search-btn" aria-label="Search">
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>
        </form>
    </section>

    <!-- Categories Section (Dynamic from DB) -->
    <section id="categories" class="categories-wrapper">
        <div class="section-header">
            <h2 class="section-title">Popular Categories</h2>
            <a href="{{ route('search.results') }}" class="view-all">View All <i class="ri-arrow-right-s-line"></i></a>
        </div>
        <div class="categories-grid">
            @forelse($popularCategories as $category)
            <a href="{{ route('search.results', ['category' => $category->slug]) }}" class="category-item">
                <i class="{{ $category->icon ?? 'ri-price-tag-3-line' }} cat-icon"></i>
                <span class="cat-name">{{ $category->name }}</span>
            </a>
            @empty
                <a href="{{ route('search.results', ['category' => 'coffee-tea']) }}" class="category-item"><i class="ri-cup-line cat-icon"></i><span class="cat-name">Coffee & Tea</span></a>
                <a href="{{ route('search.results', ['category' => 'handicrafts']) }}" class="category-item"><i class="ri-palette-line cat-icon"></i><span class="cat-name">Handicrafts</span></a>
                <a href="{{ route('search.results', ['category' => 'food']) }}" class="category-item"><i class="ri-restaurant-line cat-icon"></i><span class="cat-name">Ethiopian Food</span></a>
                <a href="{{ route('search.results', ['category' => 'photography']) }}" class="category-item"><i class="ri-camera-lens-line cat-icon"></i><span class="cat-name">Photography</span></a>
                <a href="{{ route('search.results', ['category' => 'events']) }}" class="category-item"><i class="ri-cake-3-line cat-icon"></i><span class="cat-name">Events</span></a>
                <a href="{{ route('search.results', ['category' => 'home-services']) }}" class="category-item"><i class="ri-home-gear-line cat-icon"></i><span class="cat-name">Home Services</span></a>
            @endforelse
        </div>
    </section>

    <!-- Local Jimma Categories (Dynamic from DB) -->
    <section class="local-section">
        <div class="section-header">
            <h2 class="section-title">Popular in Jimma</h2>
            <a href="{{ route('search.results', ['location' => 'Jimma']) }}" class="view-all">Explore Local <i class="ri-arrow-right-s-line"></i></a>
        </div>
        <div class="local-grid">
            @forelse($jimmaCategories as $localCat)
            <a href="{{ route('search.results', ['category' => $localCat->slug, 'location' => 'Jimma']) }}" class="local-card">
                <div class="local-image">
                    <i class="{{ $localCat->icon ?? 'ri-store-line' }}"></i>
                </div>
                <div class="local-content">
                    <h3>{{ $localCat->name }}</h3>
                    <p>{{ $localCat->short_description ?? 'Find the best local vendors in Jimma.' }}</p>
                    <div class="local-meta">
                        <span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span>
                        <span class="local-vendors">{{ $localCat->vendors_count ?? rand(5, 30) }} vendors</span>
                    </div>
                </div>
            </a>
            @empty
                <a href="{{ route('search.results', ['category' => 'coffee-tea', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-cup-line"></i></div>
                    <div class="local-content">
                        <h3>Coffee & Tea</h3>
                        <p>Fresh Ethiopian coffee from local roasters</p>
                        <div class="local-meta"><span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span><span class="local-vendors">12 vendors</span></div>
                    </div>
                </a>
                <a href="{{ route('search.results', ['category' => 'handicrafts', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-palette-line"></i></div>
                    <div class="local-content">
                        <h3>Traditional Handicrafts</h3>
                        <p>Authentic Ethiopian crafts and artworks</p>
                        <div class="local-meta"><span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span><span class="local-vendors">24 vendors</span></div>
                    </div>
                </a>
                <a href="{{ route('search.results', ['category' => 'food', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-restaurant-line"></i></div>
                    <div class="local-content">
                        <h3>Ethiopian Food</h3>
                        <p>Local restaurants and food vendors</p>
                        <div class="local-meta"><span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span><span class="local-vendors">18 vendors</span></div>
                    </div>
                </a>
            @endforelse
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-shield-check-line"></i>
            </div>
            <h3 class="feature-title">Verified Vendors</h3>
            <p class="feature-desc">Every vendor on our platform undergoes a strict verification process to ensure safety and quality for the Jimma community.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-money-dollar-circle-line"></i>
            </div>
            <h3 class="feature-title">Transparent Pricing</h3>
            <p class="feature-desc">Get clear quotes upfront in Ethiopian Birr. No hidden fees or last-minute surprises when you book services.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-customer-service-2-line"></i>
            </div>
            <h3 class="feature-title">24/7 Local Support</h3>
            <p class="feature-desc">Our dedicated support team in Jimma is always available to help you with bookings and inquiries in Amharic and English.</p>
        </div>
    </section>

    <!-- Testimonials (Dynamic from DB) -->
    <section class="testimonials">
        <div class="testimonials-container">
            <h2 class="section-title" style="text-align: center;">What Jimma Residents Say</h2>
            <div class="testimonials-grid">
                @forelse($testimonials as $testimonial)
                <div class="testimonial-card">
                    <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">{{ substr($testimonial->author_name, 0, 2) }}</div>
                        <div class="testimonial-info">
                            <h4>{{ $testimonial->author_name }}</h4>
                            <p>{{ $testimonial->author_role }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="testimonial-card">
                    <p class="testimonial-text">"Vendora helped me find the best coffee supplier in Jimma. The quality is amazing and delivery is always on time!"</p>
                    <div class="testimonial-author"><div class="testimonial-avatar">AB</div><div class="testimonial-info"><h4>Abebe Kebede</h4><p>Local Business Owner</p></div></div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"As a vendor, Vendora has connected me with so many customers in Jimma. My handicraft business has grown tremendously!"</p>
                    <div class="testimonial-author"><div class="testimonial-avatar">AT</div><div class="testimonial-info"><h4>Azeb Tadesse</h4><p>Handicraft Artisan</p></div></div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container">
            <h2 class="cta-title">Ready to Start?</h2>
            <p class="cta-text">Join thousands of vendors and customers in Jimma and across Ethiopia.</p>
            <div class="cta-buttons">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="ri-store-line"></i> Become a Vendor
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        <i class="ri-user-line"></i> Sign Up as Customer
                    </a>
                @else
                    <a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')) }}" class="btn btn-primary">
                        <i class="ri-dashboard-line"></i> Go to Dashboard
                    </a>
                    <a href="{{ route('search.results') }}" class="btn btn-outline">
                        <i class="ri-search-line"></i> Explore Vendors
                    </a>
                @endguest
            </div>
        </div>
    </section>

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
                        <li><a href="{{ route('success-stories') }}">Success Stories</a></li>
                        <li><a href="{{ route('community') }}">Community</a></li>
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
            });

            // Close mobile menu when clicking on a link
            mobileMenu.querySelectorAll('a, button').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                });
            });

            // Close when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                    mobileMenu.classList.remove('active');
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
                    if (mobileMenu) {
                        mobileMenu.classList.remove('active');
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

        // Add animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.feature-card, .category-item, .local-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Confirm logout
        document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Update active navigation based on scroll
        const sections = document.querySelectorAll('section[id]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.nav-links .nav-item, .mobile-menu .nav-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });

        // Search form validation
        document.querySelector('.search-btn').addEventListener('click', function(e) {
            const query = document.querySelector('input[name="query"]').value.trim();
            if (query === '') {
                e.preventDefault();
                alert('Please enter what you are looking for');
            }
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Vendora Homepage loaded - Local environment');
        console.log('Stats:', {
            vendors: '{{ $vendorCount }}',
            customers: '{{ $customerCount }}',
            categories: '{{ $categoryCount }}'
        });
    </script>
    @endif
</body>
</html>