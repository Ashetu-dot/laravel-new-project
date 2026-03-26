<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>List Your Service - Vendora | Jimma, Ethiopia</title>
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
            --gradient-gold: linear-gradient(135deg, #B88E3F, #9c7832);
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
            padding: 100px 20px;
            text-align: center;
            color: white;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('{{ $heroImage ?? asset('images/vendor-bg.jpg') }}');
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
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.3), rgba(0, 0, 0, 0.8));
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
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Section Title */
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

        /* Pricing Plans */
        .pricing-section {
            margin-bottom: 60px;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .pricing-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            position: relative;
            border: 2px solid transparent;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .pricing-card.popular {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .popular-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-color);
            color: white;
            padding: 5px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .pricing-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .pricing-price {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .pricing-period {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .pricing-features {
            list-style: none;
            margin-bottom: 30px;
        }

        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            color: var(--text-light);
            font-size: 14px;
            border-bottom: 1px dashed var(--border-color);
        }

        .pricing-features li i {
            color: var(--success-color);
            font-size: 16px;
        }

        .pricing-features li.disabled {
            opacity: 0.5;
        }

        .pricing-features li.disabled i {
            color: var(--error-color);
        }

        .select-plan-btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .select-plan-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Popular Categories */
        .categories-section {
            margin-bottom: 60px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category-card {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px 15px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .category-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .category-card.selected {
            border-color: var(--primary-color);
            background: rgba(184, 142, 63, 0.05);
        }

        .category-icon {
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
            transition: all 0.3s;
        }

        .category-card:hover .category-icon {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .category-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .category-count {
            font-size: 12px;
            color: var(--text-light);
        }

        /* Success Stories Section - Enhanced */
        .stories-section {
            margin-bottom: 60px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .stat-icon {
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
            transition: all 0.3s;
        }

        .stat-card:hover .stat-icon {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 30px;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            background: var(--white);
            color: var(--text-dark);
        }

        .filter-tab:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .filter-tab.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        /* Stories Grid */
        .stories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }

        .story-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .story-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .story-image {
            height: 180px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            position: relative;
        }

        .story-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
            color: white;
        }

        .story-content {
            padding: 25px;
        }

        .story-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .story-name {
            font-size: 18px;
            font-weight: 700;
        }

        .story-rating {
            color: #f59e0b;
            display: flex;
            gap: 2px;
        }

        .story-business {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .story-quote {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 15px;
            font-style: italic;
        }

        .story-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
            color: var(--text-light);
            font-size: 13px;
        }

        .story-meta i {
            color: var(--primary-color);
        }

        .story-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .story-link:hover {
            gap: 8px;
        }

        /* Impact Numbers */
        .impact-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 50px;
            color: white;
        }

        .impact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            text-align: center;
        }

        .impact-item {
            padding: 20px;
        }

        .impact-number {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .impact-label {
            font-size: 16px;
            opacity: 0.95;
        }

        /* Testimonials Slider */
        .testimonials-slider {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 50px;
            box-shadow: var(--shadow);
            margin-bottom: 50px;
            position: relative;
        }

        .slider-container {
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .testimonial-slide {
            flex: 0 0 100%;
            padding: 20px;
        }

        .slide-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .slide-quote {
            font-size: 18px;
            font-style: italic;
            color: var(--text-dark);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .slide-author {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .slide-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .slide-info h4 {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .slide-info p {
            color: var(--text-light);
            font-size: 14px;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--border-color);
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: var(--primary-color);
            transform: scale(1.3);
        }

        .slider-prev,
        .slider-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: all 0.3s;
        }

        .slider-prev {
            left: 20px;
        }

        .slider-next {
            right: 20px;
        }

        .slider-prev:hover,
        .slider-next:hover {
            background: var(--primary-color);
            color: white;
        }

        /* FAQ Section */
        .faq-section {
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

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 60px;
            text-align: center;
            color: white;
        }

        .cta-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-text {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            background: white;
            color: var(--primary-color);
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .cta-btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .cta-btn-outline:hover {
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

            .pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .impact-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .page-header h1 { font-size: 48px; }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .page-header { padding: 80px 20px; }
            .page-header h1 { font-size: 40px; }

            .pricing-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .pricing-card.popular {
                transform: scale(1);
            }

            .pricing-card.popular:hover {
                transform: scale(1) translateY(-10px);
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stories-grid {
                grid-template-columns: 1fr;
            }

            .impact-grid {
                grid-template-columns: 1fr;
            }

            .filter-tabs {
                flex-direction: column;
                align-items: center;
            }

            .filter-tab {
                width: 200px;
                text-align: center;
            }

            .testimonials-slider {
                padding: 30px 20px;
            }

            .slider-prev,
            .slider-next {
                display: none;
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

            .cta-buttons {
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
            
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">Categories</a>
            <a href="{{ route('home') }}#features" class="nav-item">Features</a>
            <a href="{{ route('list-service') }}" class="nav-item active">List Your Service</a>

            @guest
                <a href="{{ route('login') }}" class="nav-item">Log In</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
            @else
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
        <a href="{{ route('list-service') }}" class="nav-item active">List Your Service</a>

        @guest
            <a href="{{ route('login') }}" class="nav-item">Log In</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup">Sign Up</a>
        @else
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer; font-size: 16px; font-weight: 500; color: var(--text-dark);">Logout</button>
            </form>
        @endguest
    </div>

    <!-- Page Header with Dynamic Background -->
    <section class="page-header" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ $heroImage ?? asset('images/vendor-bg.jpg') }}');">
        <h1>List Your <span>Service</span></h1>
        <p>Join thousands of successful vendors in Jimma and across Ethiopia. Start growing your business today.</p>
    </section>

    <main>
        <div class="container">
            <!-- Pricing Plans -->
            <section class="pricing-section">
                <h2 class="section-title">Choose Your <span>Plan</span></h2>
                <div class="pricing-grid">
                    <!-- Basic Plan -->
                    <div class="pricing-card">
                        <h3 class="pricing-name">Basic</h3>
                        <div class="pricing-price">Free</div>
                        <div class="pricing-period">Forever</div>
                        <ul class="pricing-features">
                            <li><i class="ri-check-line"></i> List up to 5 services</li>
                            <li><i class="ri-check-line"></i> Basic profile</li>
                            <li><i class="ri-check-line"></i> 10% commission per booking</li>
                            <li><i class="ri-check-line"></i> Email support</li>
                            <li class="disabled"><i class="ri-close-line"></i> Verified badge</li>
                            <li class="disabled"><i class="ri-close-line"></i> Analytics dashboard</li>
                            <li class="disabled"><i class="ri-close-line"></i> Priority support</li>
                        </ul>
                        <a href="{{ route('register') }}" class="select-plan-btn">Get Started</a>
                    </div>

                    <!-- Professional Plan (Popular) -->
                    <div class="pricing-card popular">
                        <div class="popular-badge">Most Popular</div>
                        <h3 class="pricing-name">Professional</h3>
                        <div class="pricing-price">ETB 299</div>
                        <div class="pricing-period">per month</div>
                        <ul class="pricing-features">
                            <li><i class="ri-check-line"></i> List up to 20 services</li>
                            <li><i class="ri-check-line"></i> Enhanced profile with gallery</li>
                            <li><i class="ri-check-line"></i> 5% commission per booking</li>
                            <li><i class="ri-check-line"></i> Verified badge</li>
                            <li><i class="ri-check-line"></i> Basic analytics</li>
                            <li><i class="ri-check-line"></i> Priority email support</li>
                            <li class="disabled"><i class="ri-close-line"></i> Featured listings</li>
                        </ul>
                        <a href="{{ route('register') }}?plan=professional" class="select-plan-btn">Choose Plan</a>
                    </div>

                    <!-- Business Plan -->
                    <div class="pricing-card">
                        <h3 class="pricing-name">Business</h3>
                        <div class="pricing-price">ETB 599</div>
                        <div class="pricing-period">per month</div>
                        <ul class="pricing-features">
                            <li><i class="ri-check-line"></i> Unlimited services</li>
                            <li><i class="ri-check-line"></i> Premium profile with video</li>
                            <li><i class="ri-check-line"></i> 2% commission per booking</li>
                            <li><i class="ri-check-line"></i> Verified badge</li>
                            <li><i class="ri-check-line"></i> Advanced analytics</li>
                            <li><i class="ri-check-line"></i> 24/7 phone support</li>
                            <li><i class="ri-check-line"></i> Featured listings</li>
                        </ul>
                        <a href="{{ route('register') }}?plan=business" class="select-plan-btn">Choose Plan</a>
                    </div>
                </div>
            </section>

            <!-- Popular Categories -->
            <section class="categories-section">
                <h2 class="section-title">Popular Service <span>Categories</span></h2>
                <div class="categories-grid">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-restaurant-line"></i>
                        </div>
                        <h3 class="category-name">Food & Catering</h3>
                        <div class="category-count">245+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-camera-line"></i>
                        </div>
                        <h3 class="category-name">Photography</h3>
                        <div class="category-count">189+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-home-gear-line"></i>
                        </div>
                        <h3 class="category-name">Home Services</h3>
                        <div class="category-count">312+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-heart-pulse-line"></i>
                        </div>
                        <h3 class="category-name">Health & Beauty</h3>
                        <div class="category-count">178+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-car-washing-line"></i>
                        </div>
                        <h3 class="category-name">Automotive</h3>
                        <div class="category-count">95+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-cake-line"></i>
                        </div>
                        <h3 class="category-name">Events & Party</h3>
                        <div class="category-count">156+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-computer-line"></i>
                        </div>
                        <h3 class="category-name">Tech Support</h3>
                        <div class="category-count">67+ vendors</div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="ri-palette-line"></i>
                        </div>
                        <h3 class="category-name">Handicrafts</h3>
                        <div class="category-count">134+ vendors</div>
                    </div>
                </div>
            </section>

            <!-- Success Stories Section (Enhanced) -->
            <section class="stories-section">
                <h2 class="section-title">Success <span>Stories</span></h2>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-store-line"></i>
                        </div>
                        <div class="stat-value">500+</div>
                        <div class="stat-label">Active Vendors</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-bar-chart-line"></i>
                        </div>
                        <div class="stat-value">150%</div>
                        <div class="stat-label">Average Growth</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                        <div class="stat-value">5M+</div>
                        <div class="stat-label">Total ETB Earned</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-customer-service-line"></i>
                        </div>
                        <div class="stat-value">50k+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <div class="filter-tab active" onclick="filterStories('all')" id="allTab">All Stories</div>
                    <div class="filter-tab" onclick="filterStories('food')" id="foodTab">Food & Catering</div>
                    <div class="filter-tab" onclick="filterStories('photography')" id="photoTab">Photography</div>
                    <div class="filter-tab" onclick="filterStories('services')" id="servicesTab">Home Services</div>
                    <div class="filter-tab" onclick="filterStories('beauty')" id="beautyTab">Health & Beauty</div>
                </div>

                <!-- Stories Grid -->
                <div class="stories-grid" id="storiesGrid">
                    <!-- Story 1 -->
                    <div class="story-card" data-category="food">
                        <div class="story-image">
                            <i class="ri-restaurant-line"></i>
                            <span class="story-category">Catering</span>
                        </div>
                        <div class="story-content">
                            <div class="story-header">
                                <h3 class="story-name">Tsegaye Mulugeta</h3>
                                <div class="story-rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                </div>
                            </div>
                            <p class="story-business">Jimma Coffee House</p>
                            <p class="story-quote">"My coffee business was struggling to reach customers. Within 3 months on Vendora, I'm now supplying to 20+ local cafes."</p>
                            <div class="story-meta">
                                <span><i class="ri-bar-chart-line"></i> +300% growth</span>
                                <a href="#" class="story-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Story 2 -->
                    <div class="story-card" data-category="photography">
                        <div class="story-image">
                            <i class="ri-camera-line"></i>
                            <span class="story-category">Photography</span>
                        </div>
                        <div class="story-content">
                            <div class="story-header">
                                <h3 class="story-name">Dawit Haile</h3>
                                <div class="story-rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                </div>
                            </div>
                            <p class="story-business">Dawit Photography</p>
                            <p class="story-quote">"I used to rely on word of mouth. Now 80% of my bookings come through Vendora. I've even hired two assistants to keep up!"</p>
                            <div class="story-meta">
                                <span><i class="ri-camera-line"></i> 200+ shoots</span>
                                <a href="#" class="story-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Story 3 -->
                    <div class="story-card" data-category="services">
                        <div class="story-image">
                            <i class="ri-home-gear-line"></i>
                            <span class="story-category">Home Services</span>
                        </div>
                        <div class="story-content">
                            <div class="story-header">
                                <h3 class="story-name">Berhanu Tesfaye</h3>
                                <div class="story-rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-fill"></i>
                                </div>
                            </div>
                            <p class="story-business">Berhanu Plumbing</p>
                            <p class="story-quote">"The verified badge made all the difference. Customers trust me more and I'm getting calls from all over Jimma now."</p>
                            <div class="story-meta">
                                <span><i class="ri-tools-line"></i> 500+ jobs</span>
                                <a href="#" class="story-link">Read <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Impact Numbers -->
                <div class="impact-section">
                    <div class="impact-grid">
                        <div class="impact-item">
                            <div class="impact-number">500+</div>
                            <div class="impact-label">Vendors Succeeded</div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-number">50k+</div>
                            <div class="impact-label">Happy Customers</div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-number">5M+ ETB</div>
                            <div class="impact-label">Vendor Earnings</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Slider -->
                <div class="testimonials-slider" id="testimonialSlider">
                    <div class="slider-container">
                        <div class="slider-track" id="sliderTrack">
                            <div class="testimonial-slide">
                                <div class="slide-content">
                                    <p class="slide-quote">"Vendora completely changed my business. I never imagined I could reach so many customers. The platform is easy to use and the support team is always helpful."</p>
                                    <div class="slide-author">
                                        <div class="slide-avatar">AT</div>
                                        <div class="slide-info">
                                            <h4>Azeb Tadesse</h4>
                                            <p>Caterer • Jimma</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-slide">
                                <div class="slide-content">
                                    <p class="slide-quote">"The verified badge helped build trust with customers immediately. My bookings increased by 200% in the first two months. Highly recommended!"</p>
                                    <div class="slide-author">
                                        <div class="slide-avatar">DH</div>
                                        <div class="slide-info">
                                            <h4>Dawit Haile</h4>
                                            <p>Photographer • Jimma</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-slide">
                                <div class="slide-content">
                                    <p class="slide-quote">"I was hesitant to join at first, but now I can't imagine running my business without Vendora. It's been a game-changer for my plumbing service."</p>
                                    <div class="slide-author">
                                        <div class="slide-avatar">BT</div>
                                        <div class="slide-info">
                                            <h4>Berhanu Tesfaye</h4>
                                            <p>Plumber • Jimma</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-prev" onclick="prevSlide()">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="slider-next" onclick="nextSlide()">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                    <div class="slider-nav" id="sliderNav">
                        <div class="slider-dot active" onclick="goToSlide(0)"></div>
                        <div class="slider-dot" onclick="goToSlide(1)"></div>
                        <div class="slider-dot" onclick="goToSlide(2)"></div>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="faq-section">
                <h2 class="section-title">Frequently Asked <span>Questions</span></h2>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I get verified as a vendor?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        After signing up, you'll need to submit your business license, tax ID, and a valid ID. Our team reviews your documents within 24-48 hours. Once approved, you'll receive a verified badge on your profile.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>What are the fees and commissions?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Basic plan is free with 10% commission per booking. Professional plan is ETB 299/month with 5% commission. Business plan is ETB 599/month with 2% commission. No hidden fees.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I get paid?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        You can receive payments through Chapa (direct to your bank account or mobile money) or cash on delivery. Payments are processed within 24-48 hours after service completion.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Can I list multiple services?</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="faq-answer">
                        Yes! Basic plan allows up to 5 services, Professional plan up to 20 services, and Business plan offers unlimited services. You can also create packages and special offers.
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <h2 class="cta-title">Ready to Grow Your Business?</h2>
                <p class="cta-text">Join hundreds of successful vendors in Jimma and across Ethiopia. Start listing your services today.</p>
                <div class="cta-buttons">
                    @guest
                        <a href="{{ route('register') }}" class="cta-btn">
                            <i class="ri-store-line"></i>
                            List Your Service Now
                        </a>
                        <a href="{{ route('login') }}" class="cta-btn cta-btn-outline">
                            <i class="ri-login-circle-line"></i>
                            Sign In
                        </a>
                    @else
                        @if(Auth::user()->role === 'vendor')
                            <a href="{{ route('vendor.dashboard') }}" class="cta-btn">
                                <i class="ri-dashboard-line"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}?type=vendor" class="cta-btn">
                                <i class="ri-store-line"></i>
                                Become a Vendor
                            </a>
                        @endif
                    @endguest
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

        // Category selection
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });

        // Filter stories by category
        function filterStories(category) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            const activeTab = document.getElementById(category + 'Tab');
            if (activeTab) activeTab.classList.add('active');

            // Filter stories
            const stories = document.querySelectorAll('.story-card');
            stories.forEach(story => {
                if (category === 'all' || story.dataset.category === category) {
                    story.style.display = 'block';
                } else {
                    story.style.display = 'none';
                }
            });
        }

        // Testimonial slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const track = document.getElementById('sliderTrack');
        const dots = document.querySelectorAll('.slider-dot');

        function updateSlider() {
            if (track) {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            if (currentSlide < slides.length - 1) {
                currentSlide++;
                updateSlider();
            } else {
                currentSlide = 0;
                updateSlider();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            } else {
                currentSlide = slides.length - 1;
                updateSlider();
            }
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Auto-advance slider
        setInterval(() => {
            nextSlide();
        }, 5000);

        // FAQ toggle function
        function toggleFAQ(element) {
            element.classList.toggle('active');
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
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
        console.log('List Service page loaded - Local environment');
    </script>
    @endif
</body>
</html>
