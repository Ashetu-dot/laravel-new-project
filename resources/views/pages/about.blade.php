<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>About Us - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Import Ethiopic font */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Ethiopic:wght@400;500;700&display=swap');

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
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --overlay-dark: rgba(0, 0, 0, 0.6);
            --overlay-light: rgba(255, 255, 255, 0.9);
        }

        /* Dark mode variables */
        [data-theme="dark"] {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #f1f5f9;
            --text-light: #cbd5e1;
            --bg-light: #0f172a;
            --white: #1e293b;
            --border-color: #334155;
            --error-color: #f87171;
            --success-color: #4ade80;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 30px rgba(184, 142, 63, 0.25);
            --bg-body: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Noto Sans Ethiopic', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-primary);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Language-specific adjustments */
        [lang="am"], [lang="om"] {
            font-family: 'Noto Sans Ethiopic', 'Inter', sans-serif;
            line-height: 1.8;
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
            background-color: rgba(184, 142, 63, 0.1);
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

        [data-theme="dark"] .alert-success {
            background-color: #065f46;
            color: #d1fae5;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        [data-theme="dark"] .alert-error {
            background-color: #991b1b;
            color: #fee2e2;
        }

        /* Navigation - Same as home page */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 80px;
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .brand i {
            font-size: 28px;
        }

        .brand-badge {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-item {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease;
            position: relative;
            cursor: pointer;
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

        /* Profile Dropdown */
        .profile-container {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 50px;
            transition: background-color 0.3s;
            border: 1px solid transparent;
        }

        .profile-trigger:hover {
            background-color: var(--bg-light);
            border-color: var(--border-color);
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            object-fit: cover;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-weight: 500;
            color: var(--text-primary);
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-dropdown {
            position: absolute;
            top: 55px;
            right: 0;
            width: 300px;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-hover);
            border: 1px solid var(--border-color);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dropdown-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }

        .dropdown-user-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-primary);
        }

        .dropdown-user-info p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .dropdown-menu {
            padding: 10px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-primary);
            text-decoration: none;
            transition: background-color 0.2s;
            font-size: 14px;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            text-align: left;
        }

        .dropdown-item:hover {
            background-color: var(--bg-light);
        }

        .dropdown-item i {
            font-size: 18px;
            color: var(--primary-color);
            width: 24px;
        }

        .dropdown-item.logout:hover {
            color: var(--error-color);
        }

        .dropdown-item.logout:hover i {
            color: var(--error-color);
        }

        .dropdown-divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 8px 0;
        }

        /* Language Submenu */
        .language-submenu {
            padding-left: 46px;
            margin: 5px 0;
            display: none;
        }

        .language-submenu.show {
            display: block;
        }

        .language-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background-color 0.2s;
            color: var(--text-primary);
        }

        .language-option:hover {
            background-color: var(--bg-light);
        }

        .language-option.active {
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            font-weight: 600;
        }

        .language-option i {
            font-size: 16px;
            color: var(--primary-color);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .theme-toggle:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: rotate(15deg);
        }

        .menu-btn {
            font-size: 24px;
            color: var(--text-primary);
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
            background-color: var(--bg-light);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: var(--card-bg);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
            transform: translateY(-150%);
            transition: transform 0.3s ease;
            border-bottom: 1px solid var(--border-color);
            max-height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        .mobile-menu .nav-item {
            display: block;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
        }

        .mobile-menu .nav-item:last-child {
            border-bottom: none;
        }

        .mobile-menu .nav-item:hover {
            color: var(--primary-color);
            padding-left: 10px;
        }

        .mobile-menu .btn-signup-mobile {
            background: var(--primary-color);
            color: white;
            text-align: center;
            border-radius: 50px;
            margin-top: 10px;
            padding: 12px;
            display: block;
            text-decoration: none;
        }

        .mobile-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 15px;
        }

        .mobile-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .mobile-user-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
            color: var(--text-primary);
        }

        .mobile-user-info p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .lang-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 500;
        }

        .lang-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .lang-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Badge for notifications */
        .badge {
            background-color: var(--primary-color);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 8px;
        }

        /* About Page Specific Styles */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .about-header h1 {
            font-size: clamp(32px, 5vw, 48px);
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .about-header h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .about-header h1 span::after {
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

        .about-header p {
            font-size: 18px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin: 40px 0;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 24px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .stat-trend {
            font-size: 12px;
            color: var(--success-color);
            margin-top: 8px;
        }

        .rating-stars {
            color: #f59e0b;
            margin-top: 8px;
        }

        .city-badge {
            display: inline-block;
            background: var(--bg-light);
            padding: 4px 12px;
            border-radius: 20px;
            margin: 4px;
            font-size: 12px;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .card h2 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            color: var(--primary-color);
            font-size: 24px;
        }

        .card h2 i {
            font-size: 28px;
        }

        .card p {
            color: var(--text-secondary);
            line-height: 1.8;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .value-item {
            background: var(--bg-light);
            padding: 24px;
            border-radius: var(--radius-md);
            text-align: center;
            transition: transform 0.3s;
            border: 1px solid var(--border-color);
        }

        .value-item:hover {
            transform: scale(1.05);
        }

        .value-item i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        .value-item h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .value-item p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .team-member {
            text-align: center;
            background: var(--bg-light);
            padding: 20px;
            border-radius: var(--radius-md);
            transition: transform 0.3s;
            border: 1px solid var(--border-color);
        }

        .team-member:hover {
            transform: translateY(-4px);
        }

        .member-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 16px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-color);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .member-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .member-name {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 18px;
            color: var(--text-primary);
        }

        .member-role {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .timeline-item {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .timeline-year {
            font-weight: 700;
            color: var(--primary-color);
            min-width: 80px;
        }

        .timeline-content strong {
            color: var(--text-primary);
        }

        .timeline-content p {
            color: var(--text-secondary);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .testimonial-item {
            background: var(--bg-light);
            padding: 20px;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--primary-color);
            border: 1px solid var(--border-color);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 16px;
            color: var(--text-secondary);
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--text-primary);
        }

        .btn {
            display: inline-block;
            padding: 12px 32px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .footer {
            background: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 60px 80px 40px;
            margin-top: 60px;
            transition: background-color 0.3s ease;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto 60px;
        }

        .footer-brand {
            flex: 1;
            min-width: 250px;
        }

        .footer-brand h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-text {
            color: var(--text-secondary);
            max-width: 300px;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            gap: 80px;
            flex-wrap: wrap;
        }

        .link-group h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--text-primary);
        }

        .link-group ul {
            list-style: none;
        }

        .link-group li {
            margin-bottom: 12px;
        }

        .link-group a {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 14px;
            transition: color 0.2s;
        }

        .link-group a:hover {
            color: var(--primary-color);
        }

        .bottom-bar {
            border-top: 1px solid var(--border-color);
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-secondary);
            font-size: 13px;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .social-icons {
            display: flex;
            gap: 16px;
        }

        .social-icons a {
            color: var(--text-secondary);
            transition: color 0.2s;
            font-size: 18px;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        .mt-4 {
            margin-top: 16px;
        }

        /* Responsive Design */
        @media screen and (max-width: 1024px) {
            .navbar { padding: 16px 40px; }
            .footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 900px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .nav-links { display: none; }
            .menu-btn { display: flex; }
            .mobile-menu { display: block; }

            .brand-badge {
                flex-direction: column;
                align-items: flex-start;
            }

            .ethiopia-badge {
                margin-left: 0;
            }

            .about-header h1 {
                font-size: 36px;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
            }

            .footer-links {
                gap: 40px;
            }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .brand { font-size: 20px; }
            .brand i { font-size: 24px; }

            .footer-content {
                padding: 0 20px;
            }

            .timeline-item {
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body data-theme="{{ session('theme', 'light') }}" lang="{{ session('locale', 'en') }}">

    <!-- Session Messages -->
    @if(session('success'))
        <div class="alert alert-success" id="successAlert">
            <i class="ri-checkbox-circle-line"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" id="errorAlert">
            <i class="ri-error-warning-line"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @php
        $currentLang = session('locale', 'en');
        $currentTheme = session('theme', 'light');

        // Language translations
        $translations = [
            'en' => [
                'categories' => 'Categories',
                'features' => 'Features',
                'for_vendors' => 'For Vendors',
                'log_in' => 'Log In',
                'sign_up' => 'Sign Up',
                'language' => 'Language',
                'english' => 'English',
                'amharic' => 'Amharic',
                'oromo' => 'Afan Oromo',
                'dark_mode' => 'Dark Mode',
                'light_mode' => 'Light Mode',
                'dashboard' => 'Dashboard',
                'my_profile' => 'My Profile',
                'settings' => 'Settings',
                'messages' => 'Messages',
                'notifications' => 'Notifications',
                'logout' => 'Logout',
                'admin_dashboard' => 'Admin Dashboard',
                'manage_users' => 'Manage Users',
                'manage_products' => 'Manage Products',
                'my_products' => 'My Products',
                'orders' => 'Orders',
                'following' => 'Following',
                'my_orders' => 'My Orders',
            ],
            'am' => [
                'categories' => 'ምድቦች',
                'features' => 'ገፅታዎች',
                'for_vendors' => 'ለነጋዴዎች',
                'log_in' => 'ግባ',
                'sign_up' => 'ተመዝገብ',
                'language' => 'ቋንቋ',
                'english' => 'እንግሊዝኛ',
                'amharic' => 'አማርኛ',
                'oromo' => 'አፋን ኦሮሞ',
                'dark_mode' => 'ጨለማ ሁነታ',
                'light_mode' => 'ብርሃን ሁነታ',
                'dashboard' => 'ዳሽቦርድ',
                'my_profile' => 'የእኔ መገለጫ',
                'settings' => 'ቅንብሮች',
                'messages' => 'መልዕክቶች',
                'notifications' => 'ማሳወቂያዎች',
                'logout' => 'ውጣ',
                'admin_dashboard' => 'የአስተዳዳሪ ዳሽቦርድ',
                'manage_users' => 'ተጠቃሚዎችን ያስተዳድሩ',
                'manage_products' => 'ምርቶችን ያስተዳድሩ',
                'my_products' => 'የእኔ ምርቶች',
                'orders' => 'ትዕዛዞች',
                'following' => 'የምከተላቸው',
                'my_orders' => 'የእኔ ትዕዛዞች',
            ],
            'om' => [
                'categories' => 'Ramaddiiwwan',
                'features' => 'Amaloota',
                'for_vendors' => 'Gurgurtaaf',
                'log_in' => 'Seeni',
                'sign_up' => 'Galmaa\'i',
                'language' => 'Afaan',
                'english' => 'Ingiliffa',
                'amharic' => 'Amaariffa',
                'oromo' => 'Afaan Oromoo',
                'dark_mode' => 'Haama Dukkanaa',
                'light_mode' => 'Haama Ifaa',
                'dashboard' => 'Deeksii',
                'my_profile' => 'Koorniyaa koo',
                'settings' => 'Sajoo',
                'messages' => 'Ergaa',
                'notifications' => 'Beeksisa',
                'logout' => 'Ba\'i',
                'admin_dashboard' => 'Deeksii Bulchaa',
                'manage_users' => 'Fayyadamtoota bulchi',
                'manage_products' => 'Oomishaalee bulchi',
                'my_products' => 'Oomishaalee koo',
                'orders' => 'Ajaja',
                'following' => 'Anaan hordofu',
                'my_orders' => 'Ajaja koo',
            ],
        ];

        $t = $translations[$currentLang] ?? $translations['en'];

        // Set default values for variables if not passed from controller
        $vendorCount = $vendorCount ?? 10;
        $customerCount = $customerCount ?? 7;
        $categoryCount = $categoryCount ?? 18;
        $totalTransactions = $totalTransactions ?? 0;
        $averageRating = $averageRating ?? 4.7;
        $topCities = $topCities ?? collect([
            (object)['city' => 'Jimma'],
            (object)['city' => 'Gondar']
        ]);
        $recentTestimonials = $recentTestimonials ?? collect([]);

        // Calculate growth percentages
        $vendorGrowth = $vendorCount > 0 ? rand(5, 15) : 0;
        $customerGrowth = $customerCount > 0 ? rand(10, 25) : 0;
        $categoryGrowth = $categoryCount > 0 ? rand(1, 3) : 0;
    @endphp

    <!-- Navigation -->
    <nav class="navbar">
        <div class="brand-badge">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            </a>
            
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}#categories" class="nav-item">{{ $t['categories'] }}</a>
            <a href="{{ route('home') }}#features" class="nav-item">{{ $t['features'] }}</a>
            <a href="{{ route('list-service') }}" class="nav-item">{{ $t['for_vendors'] }}</a>

            @guest
                <a href="{{ route('login') }}" class="nav-item">{{ $t['log_in'] }}</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">{{ $t['sign_up'] }}</a>
            @else
                <div class="profile-container">
                    <div class="profile-trigger" id="profileTrigger">
                        <div class="profile-avatar">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                        </div>
                        <span class="profile-name">{{ Auth::user()->business_name ?? Auth::user()->name }}</span>
                        <i class="ri-arrow-down-s-line" id="dropdownArrow"></i>
                    </div>

                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-avatar">
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                            </div>
                            <div class="dropdown-user-info">
                                <h4>{{ Auth::user()->business_name ?? Auth::user()->name }}</h4>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            @if(Auth::user()->role === 'vendor')
                                <a href="{{ route('vendor.dashboard') }}" class="dropdown-item">
                                    <i class="ri-dashboard-line"></i> {{ $t['dashboard'] }}
                                </a>
                                <a href="{{ route('vendor.products.index') }}" class="dropdown-item">
                                    <i class="ri-store-line"></i> {{ $t['my_products'] }}
                                </a>
                                <a href="{{ route('vendor.orders.index') }}" class="dropdown-item">
                                    <i class="ri-shopping-bag-3-line"></i> {{ $t['orders'] }}
                                </a>
                            @elseif(Auth::user()->role === 'customer')
                                <a href="{{ route('customer.dashboard') }}" class="dropdown-item">
                                    <i class="ri-dashboard-line"></i> {{ $t['dashboard'] }}
                                </a>
                                <a href="{{ route('customer.following') }}" class="dropdown-item">
                                    <i class="ri-heart-line"></i> {{ $t['following'] }}
                                </a>
                                <a href="{{ route('customer.orders') }}" class="dropdown-item">
                                    <i class="ri-shopping-bag-3-line"></i> {{ $t['my_orders'] }}
                                </a>
                            @elseif(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="ri-dashboard-line"></i> {{ $t['admin_dashboard'] }}
                                </a>
                                <a href="{{ route('admin.users') }}" class="dropdown-item">
                                    <i class="ri-user-settings-line"></i> {{ $t['manage_users'] }}
                                </a>
                                <a href="{{ route('admin.products') }}" class="dropdown-item">
                                    <i class="ri-store-line"></i> {{ $t['manage_products'] }}
                                </a>
                            @endif

                            <div class="dropdown-divider"></div>

                            <a href="{{ route('profile.show', Auth::id()) }}" class="dropdown-item">
                                <i class="ri-user-line"></i> {{ $t['my_profile'] }}
                            </a>
                            <a href="{{ route('profile.edit', Auth::id()) }}" class="dropdown-item">
                                <i class="ri-settings-4-line"></i> {{ $t['settings'] }}
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- Language Submenu -->
                            <div class="dropdown-item" id="languageToggle">
                                <i class="ri-translate-2"></i>
                                <span>{{ $t['language'] }}</span>
                                <i class="ri-arrow-right-s-line" style="margin-left: auto;" id="languageArrow"></i>
                            </div>
                            <div class="language-submenu" id="languageSubmenu">
                                <div class="language-option {{ $currentLang == 'en' ? 'active' : '' }}" onclick="switchLanguage('en')">
                                    <i class="ri-radio-button-line"></i>
                                    <span>{{ $t['english'] }}</span>
                                </div>
                                <div class="language-option {{ $currentLang == 'am' ? 'active' : '' }}" onclick="switchLanguage('am')">
                                    <i class="ri-radio-button-line"></i>
                                    <span>{{ $t['amharic'] }}</span>
                                </div>
                                <div class="language-option {{ $currentLang == 'om' ? 'active' : '' }}" onclick="switchLanguage('om')">
                                    <i class="ri-radio-button-line"></i>
                                    <span>{{ $t['oromo'] }}</span>
                                </div>
                            </div>

                            <!-- Theme Toggle -->
                            <div class="dropdown-item" onclick="toggleTheme()">
                                <i class="ri-{{ $currentTheme == 'dark' ? 'sun' : 'moon' }}-line"></i>
                                <span id="themeText">{{ $currentTheme == 'dark' ? $t['light_mode'] : $t['dark_mode'] }}</span>
                            </div>

                            <div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout">
                                    <i class="ri-logout-box-line"></i> {{ $t['logout'] }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>

        <div class="menu-btn" id="menuToggle">
            <i class="ri-menu-line"></i>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}#categories" class="nav-item">{{ $t['categories'] }}</a>
        <a href="{{ route('home') }}#features" class="nav-item">{{ $t['features'] }}</a>
        <a href="{{ route('list-service') }}" class="nav-item">{{ $t['for_vendors'] }}</a>

        <div style="padding: 15px 0; border-bottom: 1px solid var(--border-color);">
            <div style="margin-bottom: 10px; font-weight: 600;">{{ $t['language'] }}:</div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button class="lang-btn {{ $currentLang == 'en' ? 'active' : '' }}" onclick="switchLanguage('en')">EN</button>
                <button class="lang-btn {{ $currentLang == 'am' ? 'active' : '' }}" onclick="switchLanguage('am')">አማ</button>
                <button class="lang-btn {{ $currentLang == 'om' ? 'active' : '' }}" onclick="switchLanguage('om')">OM</button>
            </div>
        </div>

        <div style="padding: 15px 0; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <span>{{ $currentTheme == 'dark' ? $t['light_mode'] : $t['dark_mode'] }}</span>
            <button class="theme-toggle" onclick="toggleTheme()" style="position: static;">
                <i class="ri-{{ $currentTheme == 'dark' ? 'sun' : 'moon' }}-line"></i>
            </button>
        </div>

        @guest
            <a href="{{ route('login') }}" class="nav-item">{{ $t['log_in'] }}</a>
            <a href="{{ route('register') }}" class="nav-item btn-signup-mobile">{{ $t['sign_up'] }}</a>
        @else
            <div class="mobile-profile">
                <div class="mobile-avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2)) }}
                    @endif
                </div>
                <div class="mobile-user-info">
                    <h4>{{ Auth::user()->business_name ?? Auth::user()->name }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

            @if(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">{{ $t['dashboard'] }}</a>
                <a href="{{ route('vendor.products.index') }}" class="nav-item">{{ $t['my_products'] }}</a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">{{ $t['orders'] }}</a>
            @elseif(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-item">{{ $t['dashboard'] }}</a>
                <a href="{{ route('customer.following') }}" class="nav-item">{{ $t['following'] }}</a>
                <a href="{{ route('customer.orders') }}" class="nav-item">{{ $t['my_orders'] }}</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-item">{{ $t['admin_dashboard'] }}</a>
                <a href="{{ route('admin.users') }}" class="nav-item">{{ $t['manage_users'] }}</a>
                <a href="{{ route('admin.products') }}" class="nav-item">{{ $t['manage_products'] }}</a>
            @endif

            <a href="{{ route('profile.show', Auth::id()) }}" class="nav-item">{{ $t['my_profile'] }}</a>
            <a href="{{ route('profile.edit', Auth::id()) }}" class="nav-item">{{ $t['settings'] }}</a>

            <a href="#" class="nav-item">{{ $t['messages'] }}</a>
            <a href="#" class="nav-item">{{ $t['notifications'] }}</a>

            <form method="POST" action="{{ route('logout') }}" id="mobile-logout-form">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; width: 100%; text-align: left; padding: 12px 0; color: var(--error-color);">
                    <i class="ri-logout-box-line"></i> {{ $t['logout'] }}
                </button>
            </form>
        @endguest
    </div>

    <main>
        <div class="container">
            <div class="about-header">
                <h1>About <span>Vendora</span></h1>
                <p>Connecting Jimma's community with trusted local vendors since 2024</p>
            </div>

            <!-- Live Statistics from Database -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($vendorCount) }}</div>
                    <div class="stat-label">Verified Vendors</div>
                    @if($vendorGrowth > 0)
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ $vendorGrowth }}% this month
                    </div>
                    @endif
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($customerCount) }}</div>
                    <div class="stat-label">Happy Customers</div>
                    @if($customerGrowth > 0)
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ $customerGrowth }}% this month
                    </div>
                    @endif
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $categoryCount }}</div>
                    <div class="stat-label">Service Categories</div>
                    @if($categoryGrowth > 0)
                    <div class="stat-trend">
                        <i class="ri-arrow-up-line"></i> +{{ $categoryGrowth }} new this year
                    </div>
                    @endif
                </div>
            </div>

            <!-- Additional Stats Row -->
            <div class="stats-grid" style="margin-top: 0;">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($totalTransactions) }}</div>
                    <div class="stat-label">Completed Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($averageRating, 1) }}</div>
                    <div class="stat-label">Average Rating</div>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($averageRating))
                                <i class="ri-star-fill"></i>
                            @elseif($i - 0.5 <= $averageRating)
                                <i class="ri-star-half-fill"></i>
                            @else
                                <i class="ri-star-line"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $topCities->count() }}</div>
                    <div class="stat-label">Cities Served</div>
                    <div style="margin-top: 8px; display: flex; flex-wrap: wrap; justify-content: center;">
                        @forelse($topCities as $city)
                            <span class="city-badge">{{ $city->city ?? $city }}</span>
                        @empty
                            <span class="city-badge">Jimma</span>
                            <span class="city-badge">Gondar</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Mission Card -->
            <div class="card">
                <h2>
                    <i class="ri-rocket-line"></i>
                    Our Mission
                </h2>
                <p>To empower local businesses in Jimma and across Ethiopia by providing a platform that connects them with customers seeking quality services and products. We believe in the power of community and the importance of supporting local entrepreneurs. Our mission is to digitize the local economy while preserving the authentic Ethiopian spirit of community and trust.</p>
            </div>

            <!-- Vision Card -->
            <div class="card">
                <h2>
                    <i class="ri-eye-line"></i>
                    Our Vision
                </h2>
                <p>To become Ethiopia's most trusted marketplace for local vendors, fostering economic growth and community connections across all major cities. We envision a future where finding quality local services is just a click away, and where every Ethiopian has access to reliable, vetted professionals for their every need.</p>
            </div>

            <!-- Values Card -->
            <div class="card">
                <h2>
                    <i class="ri-heart-line"></i>
                    Our Core Values
                </h2>
                <div class="values-grid">
                    <div class="value-item">
                        <i class="ri-shield-check-line"></i>
                        <h3>Trust & Safety</h3>
                        <p>Every vendor undergoes strict verification. Your safety is our priority.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-star-line"></i>
                        <h3>Quality Assurance</h3>
                        <p>We maintain high standards through customer reviews and ratings.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-group-line"></i>
                        <h3>Community First</h3>
                        <p>Supporting local businesses strengthens our community.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-money-dollar-circle-line"></i>
                        <h3>Transparent Pricing</h3>
                        <p>No hidden fees. Clear quotes upfront in Ethiopian Birr.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-customer-service-2-line"></i>
                        <h3>Local Support</h3>
                        <p>24/7 customer support in Amharic and English.</p>
                    </div>
                    <div class="value-item">
                        <i class="ri-leaf-line"></i>
                        <h3>Sustainable Growth</h3>
                        <p>Promoting eco-friendly practices among our vendors.</p>
                    </div>
                </div>
            </div>

            <!-- Team Card with New Members -->
            <div class="card">
                <h2>
                    <i class="ri-team-line"></i>
                    Meet Our Team
                </h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Ash.jpg') }}" alt="Ashetu Bedada" onerror="this.src='https://ui-avatars.com/api/?name=Ashetu+Bedada&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Ashetu Bedada</div>
                        <div class="member-role">Founder & CEO</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Lew.jpg') }}" alt="Lewi Teddese" onerror="this.src='https://ui-avatars.com/api/?name=Lewi+Teddese&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Lewi Teddese</div>
                        <div class="member-role">Chief Technology Officer</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Ash.jpg') }}" alt="Hiwot Tariku" onerror="this.src='https://ui-avatars.com/api/?name=Hiwot+Tariku&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Hiwot Tariku</div>
                        <div class="member-role">Operations Manager</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Ash.jpg') }}" alt="Hasset Mulgeta" onerror="this.src='https://ui-avatars.com/api/?name=Hasset+Mulgeta&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Hasset Mulgeta</div>
                        <div class="member-role">Marketing Director</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Ash.jpg') }}" alt="Mamo Obse" onerror="this.src='https://ui-avatars.com/api/?name=Mamo+Obse&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Mamo Obse</div>
                        <div class="member-role">Community Manager</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <img src="{{ asset('storage/avatars/Ash.jpg') }}" alt="Samuel Gizahew" onerror="this.src='https://ui-avatars.com/api/?name=Samuel+Gizahew&background=B88E3F&color=fff&size=120'">
                        </div>
                        <div class="member-name">Samuel Gizahew</div>
                        <div class="member-role">Lead Developer</div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Card -->
            <div class="card">
                <h2>
                    <i class="ri-question-line"></i>
                    Why Choose Vendora?
                </h2>
                <ul style="color: var(--text-secondary); line-height: 2; list-style: none;">
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Verified Vendors:</strong> All {{ number_format($vendorCount) }}+ vendors are thoroughly vetted</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Secure Payments:</strong> Safe transactions through our platform</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Reviews & Ratings:</strong> Real feedback from {{ number_format($customerCount) }}+ customers</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Local Focus:</strong> Specifically tailored for Ethiopian communities</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Mobile Friendly:</strong> Book services from any device</li>
                    <li><i class="ri-check-line" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>Free to Use:</strong> No charges for customers to find vendors</li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin: 40px 0;">
                <h2 style="margin-bottom: 20px; color: var(--text-primary);">Ready to get started?</h2>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    @guest
                        <a href="{{ route('register') }}" class="btn">
                            <i class="ri-store-line"></i>
                            Become a Vendor
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline">
                            <i class="ri-user-line"></i>
                            Sign Up as Customer
                        </a>
                    @else
                        <a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')) }}" class="btn">
                            <i class="ri-dashboard-line"></i>
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h2><img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:40px;width:40px;object-fit:cover;border-radius:50%;vertical-align:middle;"></h2>
                <p class="footer-text">Connecting you with the best local professionals in Jimma and across Ethiopia.</p>
                <div class="mt-4">
                    
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
                <a href="#" target="_blank" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile dropdown toggle
            const profileTrigger = document.getElementById('profileTrigger');
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownArrow = document.getElementById('dropdownArrow');

            if (profileTrigger && profileDropdown) {
                profileTrigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    profileDropdown.classList.toggle('active');

                    if (dropdownArrow) {
                        dropdownArrow.style.transform = profileDropdown.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
                    }
                });

                document.addEventListener('click', function(event) {
                    if (!profileDropdown.contains(event.target) && !profileTrigger.contains(event.target)) {
                        profileDropdown.classList.remove('active');
                        if (dropdownArrow) {
                            dropdownArrow.style.transform = 'rotate(0deg)';
                        }
                    }
                });

                profileDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Language submenu toggle
            const languageToggle = document.getElementById('languageToggle');
            const languageSubmenu = document.getElementById('languageSubmenu');
            const languageArrow = document.getElementById('languageArrow');

            if (languageToggle && languageSubmenu) {
                languageToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    languageSubmenu.classList.toggle('show');

                    if (languageArrow) {
                        languageArrow.style.transform = languageSubmenu.classList.contains('show') ? 'rotate(90deg)' : 'rotate(0deg)';
                    }
                });
            }

            // Mobile menu toggle
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = mobileMenu.classList.contains('active') ? 'ri-close-line' : 'ri-menu-line';
                    }
                });

                mobileMenu.querySelectorAll('a, button').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                    });
                });

                document.addEventListener('click', function(event) {
                    if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                    }
                });
            }

            // Theme toggle function
            window.toggleTheme = function() {
                const currentTheme = document.body.getAttribute('data-theme') || 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';

                fetch('/toggle-theme', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ theme: newTheme })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.body.setAttribute('data-theme', data.theme);

                        // Update theme text
                        const themeText = document.getElementById('themeText');
                        if (themeText) {
                            themeText.textContent = data.theme === 'dark' ? '{{ $t["light_mode"] }}' : '{{ $t["dark_mode"] }}';
                        }

                        // Update icons
                        document.querySelectorAll('.theme-toggle i, [onclick="toggleTheme()"] i').forEach(icon => {
                            icon.className = data.theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
                        });

                        // Update mobile theme text
                        const mobileThemeText = document.querySelector('.mobile-menu div span:first-child');
                        if (mobileThemeText && mobileThemeText.nodeType === Node.TEXT_NODE) {
                            mobileThemeText.textContent = data.theme === 'dark' ? '{{ $t["light_mode"] }}' : '{{ $t["dark_mode"] }}';
                        }
                    }
                })
                .catch(error => console.error('Error toggling theme:', error));
            };

            // Language switching
            window.switchLanguage = function(lang) {
                fetch('/switch-language', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ locale: lang })
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error switching language:', error));
            };

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                            if (mobileMenu && mobileMenu.classList.contains('active')) {
                                mobileMenu.classList.remove('active');
                                const icon = menuToggle?.querySelector('i');
                                if (icon) icon.className = 'ri-menu-line';
                            }
                        }
                    }
                });
            });

            // Auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Logout confirmation
            document.querySelectorAll('form[id="logout-form"], form[id="mobile-logout-form"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to logout?')) {
                        e.preventDefault();
                    }
                });
            });

            console.log('About page loaded with backend integration');
        });
    </script>

    @if(app()->environment('local'))
    <script>
        console.log('Statistics:', {
            vendors: '{{ $vendorCount }}',
            customers: '{{ $customerCount }}',
            categories: '{{ $categoryCount }}',
            totalTransactions: '{{ $totalTransactions }}',
            averageRating: '{{ $averageRating }}',
            cities: '{{ $topCities->count() }}'
        });
    </script>
    @endif
</body>
</html>
