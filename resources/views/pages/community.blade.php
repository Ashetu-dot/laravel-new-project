<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Community - Vendora | Jimma, Ethiopia</title>
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

        .community-badge {
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

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 60px;
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

        /* Community Groups */
        .groups-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .group-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .group-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .group-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            padding: 30px;
            color: white;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .group-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
        }

        .group-info h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .group-meta {
            display: flex;
            gap: 15px;
            font-size: 14px;
            opacity: 0.9;
        }

        .group-content {
            padding: 30px;
            flex: 1;
        }

        .group-description {
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .group-features {
            list-style: none;
            margin-bottom: 25px;
        }

        .group-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            color: var(--text-dark);
            font-size: 14px;
            border-bottom: 1px dashed var(--border-color);
        }

        .group-features li i {
            color: var(--success-color);
            font-size: 16px;
        }

        .group-footer {
            display: flex;
            gap: 15px;
            margin-top: auto;
        }

        .group-btn {
            flex: 1;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
        }

        .group-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .group-btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .group-btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Events Section */
        .events-section {
            margin-bottom: 60px;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .event-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .event-date {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 20px;
            text-align: center;
        }

        .event-day {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .event-month {
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .event-content {
            padding: 20px;
            flex: 1;
        }

        .event-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
            color: var(--text-light);
            font-size: 13px;
        }

        .event-meta i {
            color: var(--primary-color);
            width: 18px;
        }

        .event-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .event-attendees {
            font-size: 13px;
            color: var(--text-light);
        }

        .event-attendees i {
            color: var(--primary-color);
        }

        .event-rsvp {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .event-rsvp:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Forum Section */
        .forum-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.03) 0%, rgba(248, 250, 252, 0) 100%);
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 60px;
        }

        .forum-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .forum-topics {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .forum-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .forum-header h3 {
            font-size: 20px;
            font-weight: 700;
        }

        .view-all-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .topic-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .topic-item:last-child {
            border-bottom: none;
        }

        .topic-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .topic-content {
            flex: 1;
        }

        .topic-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .topic-title a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .topic-title a:hover {
            color: var(--primary-color);
        }

        .topic-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: var(--text-light);
        }

        .topic-meta i {
            color: var(--primary-color);
        }

        .topic-stats {
            text-align: right;
            font-size: 13px;
            color: var(--text-light);
        }

        .topic-replies {
            font-weight: 600;
            color: var(--primary-color);
        }

        .forum-sidebar {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .sidebar-widget {
            margin-bottom: 30px;
        }

        .sidebar-widget:last-child {
            margin-bottom: 0;
        }

        .widget-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .category-list {
            list-style: none;
        }

        .category-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed var(--border-color);
        }

        .category-list a {
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-list a:hover {
            color: var(--primary-color);
        }

        .category-list i {
            color: var(--primary-color);
            font-size: 14px;
        }

        .category-count {
            background: var(--bg-light);
            padding: 2px 8px;
            border-radius: 50px;
            font-size: 11px;
            color: var(--text-light);
        }

        .active-users {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .active-user {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            position: relative;
        }

        .active-user.online::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            background: var(--success-color);
            border-radius: 50%;
            border: 2px solid var(--white);
        }

        .new-topic-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-align: center;
            display: inline-block;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .new-topic-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Mentorship */
        .mentorship-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            padding: 50px;
            margin-bottom: 60px;
            color: white;
        }

        .mentorship-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .mentorship-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .mentorship-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .mentorship-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .mentorship-title {
            font-size: 20px;
            font-weight: 700;
        }

        .mentorship-description {
            opacity: 0.9;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .mentorship-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .mentorship-stat {
            text-align: center;
        }

        .mentorship-stat-value {
            font-size: 24px;
            font-weight: 700;
        }

        .mentorship-stat-label {
            font-size: 12px;
            opacity: 0.8;
        }

        .mentorship-btn {
            display: inline-block;
            background: white;
            color: var(--primary-color);
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .mentorship-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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

        /* View All Link */
        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap 0.3s;
        }

        .view-all:hover {
            gap: 10px;
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

            .groups-grid {
                grid-template-columns: 1fr;
            }

            .events-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .forum-grid {
                grid-template-columns: 1fr;
            }

            .mentorship-grid {
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .forum-section {
                padding: 30px 20px;
            }

            .topic-item {
                flex-wrap: wrap;
            }

            .topic-stats {
                width: 100%;
                text-align: left;
            }

            .mentorship-section {
                padding: 40px 20px;
            }

            .group-header {
                flex-direction: column;
                text-align: center;
            }

            .group-footer {
                flex-direction: column;
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
            <a href="{{ route('community') }}" class="nav-item active">Community</a>
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
        <a href="{{ route('community') }}" class="nav-item active">Community</a>
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

    <!-- Page Header -->
    <section class="page-header">
        <h1>Vendora <span>Community</span></h1>
        <p>Connect, learn, and grow with thousands of vendors and customers across Ethiopia</p>
    </section>

    <main>
        <div class="container">
            <!-- Stats Section -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-group-line"></i>
                    </div>
                    <div class="stat-value">{{ $totalMembers ?? '15k+' }}</div>
                    <div class="stat-label">Community Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-message-line"></i>
                    </div>
                    <div class="stat-value">{{ $dailyPosts ?? '500+' }}</div>
                    <div class="stat-label">Daily Discussions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <div class="stat-value">{{ $monthlyEvents ?? '25+' }}</div>
                    <div class="stat-label">Monthly Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ri-user-star-line"></i>
                    </div>
                    <div class="stat-value">{{ $mentors ?? '50+' }}</div>
                    <div class="stat-label">Active Mentors</div>
                </div>
            </div>

            <!-- Community Groups -->
            <section>
                <h2 class="section-title">Join Our <span>Community</span> Groups</h2>
                <div class="groups-grid">
                    <!-- Telegram Group -->
                    <div class="group-card">
                        <div class="group-header">
                            <div class="group-icon">
                                <i class="ri-telegram-line"></i>
                            </div>
                            <div class="group-info">
                                <h3>Telegram Community</h3>
                                <div class="group-meta">
                                    <span><i class="ri-user-line"></i> 5,200+ members</span>
                                    <span><i class="ri-message-line"></i> Active daily</span>
                                </div>
                            </div>
                        </div>
                        <div class="group-content">
                            <p class="group-description">Our largest community on Telegram. Get real-time updates, ask questions, and connect with vendors and customers from across Ethiopia.</p>
                            <ul class="group-features">
                                <li><i class="ri-check-line"></i> Daily tips and insights</li>
                                <li><i class="ri-check-line"></i> Vendor spotlights</li>
                                <li><i class="ri-check-line"></i> Customer inquiries</li>
                                <li><i class="ri-check-line"></i> Live Q&A sessions</li>
                            </ul>
                            <div class="group-footer">
                                <a href="#" class="group-btn">
                                    <i class="ri-telegram-line"></i>
                                    Join Telegram
                                </a>
                                <a href="#" class="group-btn group-btn-outline">
                                    Preview Group
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Group -->
                    <div class="group-card">
                        <div class="group-header">
                            <div class="group-icon">
                                <i class="ri-whatsapp-line"></i>
                            </div>
                            <div class="group-info">
                                <h3>WhatsApp Community</h3>
                                <div class="group-meta">
                                    <span><i class="ri-user-line"></i> 3,800+ members</span>
                                    <span><i class="ri-message-line"></i> Regional groups</span>
                                </div>
                            </div>
                        </div>
                        <div class="group-content">
                            <p class="group-description">Connect with local vendors in your area through our WhatsApp groups. Perfect for networking and local collaborations.</p>
                            <ul class="group-features">
                                <li><i class="ri-check-line"></i> City-specific groups</li>
                                <li><i class="ri-check-line"></i> Category-based chats</li>
                                <li><i class="ri-check-line"></i> Local opportunities</li>
                                <li><i class="ri-check-line"></i> Event coordination</li>
                            </ul>
                            <div class="group-footer">
                                <a href="#" class="group-btn">
                                    <i class="ri-whatsapp-line"></i>
                                    Join WhatsApp
                                </a>
                                <a href="#" class="group-btn group-btn-outline">
                                    Find Your City
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Upcoming Events -->
            <section class="events-section">
                <h2 class="section-title">Upcoming <span>Events</span></h2>
                <div class="events-grid">
                    <div class="event-card">
                        <div class="event-date">
                            <div class="event-day">25</div>
                            <div class="event-month">FEB</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Vendor Meetup - Jimma</h3>
                            <div class="event-meta">
                                <span><i class="ri-time-line"></i> 3:00 PM - 6:00 PM</span>
                                <span><i class="ri-map-pin-line"></i> Jimma Cultural Center</span>
                            </div>
                            <p class="event-description">Network with local vendors, share experiences, and learn from successful entrepreneurs in Jimma.</p>
                            <div class="event-footer">
                                <span class="event-attendees"><i class="ri-user-line"></i> 45 attending</span>
                                <a href="#" class="event-rsvp">RSVP</a>
                            </div>
                        </div>
                    </div>
                    <div class="event-card">
                        <div class="event-date">
                            <div class="event-day">28</div>
                            <div class="event-month">FEB</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Virtual Workshop: Marketing Tips</h3>
                            <div class="event-meta">
                                <span><i class="ri-time-line"></i> 10:00 AM - 12:00 PM</span>
                                <span><i class="ri-video-line"></i> Online (Zoom)</span>
                            </div>
                            <p class="event-description">Learn effective marketing strategies to grow your business on Vendora from our expert panel.</p>
                            <div class="event-footer">
                                <span class="event-attendees"><i class="ri-user-line"></i> 120 registered</span>
                                <a href="#" class="event-rsvp">Register</a>
                            </div>
                        </div>
                    </div>
                    <div class="event-card">
                        <div class="event-date">
                            <div class="event-day">05</div>
                            <div class="event-month">MAR</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Addis Ababa Vendor Expo</h3>
                            <div class="event-meta">
                                <span><i class="ri-time-line"></i> 9:00 AM - 5:00 PM</span>
                                <span><i class="ri-map-pin-line"></i> Addis Ababa Exhibition Center</span>
                            </div>
                            <p class="event-description">Showcase your products, meet customers face-to-face, and connect with other vendors.</p>
                            <div class="event-footer">
                                <span class="event-attendees"><i class="ri-user-line"></i> 200+ attending</span>
                                <a href="#" class="event-rsvp">Book Booth</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 30px;">
                    <a href="#" class="view-all">View All Events <i class="ri-arrow-right-line"></i></a>
                </div>
            </section>

            <!-- Forum Section -->
            <section class="forum-section">
                <h2 class="section-title">Community <span>Forum</span></h2>
                <div class="forum-grid">
                    <div class="forum-topics">
                        <div class="forum-header">
                            <h3>Recent Discussions</h3>
                            <a href="#" class="view-all-link">View All <i class="ri-arrow-right-line"></i></a>
                        </div>

                        <div class="topic-item">
                            <div class="topic-avatar">AT</div>
                            <div class="topic-content">
                                <div class="topic-title">
                                    <a href="#">How to price photography services in Jimma?</a>
                                </div>
                                <div class="topic-meta">
                                    <span><i class="ri-user-line"></i> Azeb Tadesse</span>
                                    <span><i class="ri-time-line"></i> 2 hours ago</span>
                                </div>
                            </div>
                            <div class="topic-stats">
                                <span class="topic-replies">12 replies</span>
                            </div>
                        </div>

                        <div class="topic-item">
                            <div class="topic-avatar">TB</div>
                            <div class="topic-content">
                                <div class="topic-title">
                                    <a href="#">Best marketing strategies for new vendors</a>
                                </div>
                                <div class="topic-meta">
                                    <span><i class="ri-user-line"></i> Tekle Berhan</span>
                                    <span><i class="ri-time-line"></i> 5 hours ago</span>
                                </div>
                            </div>
                            <div class="topic-stats">
                                <span class="topic-replies">24 replies</span>
                            </div>
                        </div>

                        <div class="topic-item">
                            <div class="topic-avatar">SM</div>
                            <div class="topic-content">
                                <div class="topic-title">
                                    <a href="#">Dealing with difficult customers - advice needed</a>
                                </div>
                                <div class="topic-meta">
                                    <span><i class="ri-user-line"></i> Sara Mohammed</span>
                                    <span><i class="ri-time-line"></i> 1 day ago</span>
                                </div>
                            </div>
                            <div class="topic-stats">
                                <span class="topic-replies">18 replies</span>
                            </div>
                        </div>

                        <div class="topic-item">
                            <div class="topic-avatar">DH</div>
                            <div class="topic-content">
                                <div class="topic-title">
                                    <a href="#">Equipment recommendations for starting photographers</a>
                                </div>
                                <div class="topic-meta">
                                    <span><i class="ri-user-line"></i> Dawit Haile</span>
                                    <span><i class="ri-time-line"></i> 2 days ago</span>
                                </div>
                            </div>
                            <div class="topic-stats">
                                <span class="topic-replies">31 replies</span>
                            </div>
                        </div>

                        <a href="#" class="new-topic-btn">
                            <i class="ri-add-line"></i>
                            Start New Discussion
                        </a>
                    </div>

                    <div class="forum-sidebar">
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Categories</h4>
                            <ul class="category-list">
                                <li>
                                    <a href="#"><i class="ri-price-tag-line"></i> General Discussion</a>
                                    <span class="category-count">245</span>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-store-line"></i> Business Tips</a>
                                    <span class="category-count">189</span>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-question-line"></i> Q&A</a>
                                    <span class="category-count">312</span>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-megaphone-line"></i> Announcements</a>
                                    <span class="category-count">56</span>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-handbag-line"></i> Job Opportunities</a>
                                    <span class="category-count">98</span>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar-widget">
                            <h4 class="widget-title">Active Now</h4>
                            <div class="active-users">
                                <div class="active-user online">AT</div>
                                <div class="active-user online">TB</div>
                                <div class="active-user">SM</div>
                                <div class="active-user online">DH</div>
                                <div class="active-user">BT</div>
                                <div class="active-user">MA</div>
                                <div class="active-user online">GB</div>
                                <div class="active-user">HA</div>
                            </div>
                            <p style="font-size: 13px; color: var(--text-light); margin-top: 10px;">24 members online</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mentorship Program -->
            <section class="mentorship-section">
                <h2 class="section-title" style="color: white;">Mentorship <span style="color: white;">Program</span></h2>
                <div class="mentorship-grid">
                    <div class="mentorship-card">
                        <div class="mentorship-header">
                            <div class="mentorship-icon">
                                <i class="ri-user-star-line"></i>
                            </div>
                            <h3 class="mentorship-title">Become a Mentor</h3>
                        </div>
                        <p class="mentorship-description">Share your expertise and help fellow vendors grow. Experienced vendors can apply to become mentors and guide newcomers.</p>
                        <div class="mentorship-stats">
                            <div class="mentorship-stat">
                                <div class="mentorship-stat-value">35</div>
                                <div class="mentorship-stat-label">Active Mentors</div>
                            </div>
                            <div class="mentorship-stat">
                                <div class="mentorship-stat-value">120+</div>
                                <div class="mentorship-stat-label">Mentees</div>
                            </div>
                        </div>
                        <a href="#" class="mentorship-btn">Apply as Mentor</a>
                    </div>
                    <div class="mentorship-card">
                        <div class="mentorship-header">
                            <div class="mentorship-icon">
                                <i class="ri-graduation-cap-line"></i>
                            </div>
                            <h3 class="mentorship-title">Find a Mentor</h3>
                        </div>
                        <p class="mentorship-description">Get personalized guidance from experienced vendors who have been where you are and can help you succeed.</p>
                        <div class="mentorship-stats">
                            <div class="mentorship-stat">
                                <div class="mentorship-stat-value">8</div>
                                <div class="mentorship-stat-label">Categories</div>
                            </div>
                            <div class="mentorship-stat">
                                <div class="mentorship-stat-value">Free</div>
                                <div class="mentorship-stat-label">For Members</div>
                            </div>
                        </div>
                        <a href="#" class="mentorship-btn">Find a Mentor</a>
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
        console.log('Community page loaded - Local environment');
    </script>
    @endif
</body>
</html>
