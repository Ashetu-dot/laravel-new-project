<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Press - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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

        /* Navigation */
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

        .dropdown-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
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

        .mobile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
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

        /* Hero Section with Dynamic Background */
        .hero {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 80px;
            text-align: center;
            min-height: 500px;
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
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
            z-index: -1;
        }

        .hero h1 {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            margin-bottom: 16px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: white;
        }

        .hero h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .hero h1 span::after {
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

        .hero p {
            font-size: 18px;
            color: rgba(255,255,255,0.9);
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        /* Page Header (replacing with hero) */
        .page-header {
            display: none;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Overview Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 60px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-number {
            font-size: 40px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Section Title */
        .section-title {
            font-size: clamp(28px, 4vw, 32px);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 40px;
            text-align: center;
        }

        .section-title span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
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

        /* Press Releases */
        .press-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .press-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
        }

        .press-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .press-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .press-content {
            padding: 24px;
        }

        .press-date {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .press-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .press-excerpt {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .press-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .press-source {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .press-source i {
            color: var(--primary-color);
        }

        .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .read-more:hover {
            gap: 8px;
        }

        /* Media Coverage */
        .coverage-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .coverage-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .coverage-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .coverage-logo {
            width: 80px;
            height: 80px;
            background: var(--bg-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--primary-color);
            font-size: 32px;
            border: 1px solid var(--border-color);
        }

        .coverage-name {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .coverage-date {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        .coverage-title {
            font-size: 14px;
            color: var(--text-primary);
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .coverage-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Press Kit */
        .press-kit {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 60px;
            border-radius: var(--radius-lg);
            margin-bottom: 60px;
        }

        .press-kit-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .kit-item {
            background: var(--card-bg);
            padding: 30px;
            border-radius: var(--radius-lg);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            border: 1px solid var(--border-color);
        }

        .kit-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .kit-icon {
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

        .kit-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .kit-description {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .kit-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.3s;
        }

        .kit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Media Inquiries */
        .inquiries-section {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 50px;
            box-shadow: var(--shadow);
            margin-bottom: 60px;
            border: 1px solid var(--border-color);
        }

        .inquiries-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .inquiries-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-primary);
        }

        .inquiries-text {
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .contact-card {
            background: var(--bg-light);
            border-radius: var(--radius-md);
            padding: 30px;
            margin-top: 30px;
            border: 1px solid var(--border-color);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 10px;
            background: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .contact-icon {
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

        .contact-info {
            flex: 1;
            text-align: left;
        }

        .contact-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .contact-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .contact-value a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .contact-value a:hover {
            text-decoration: underline;
        }

        /* Newsletter */
        .newsletter-section {
            background: var(--primary-color);
            border-radius: var(--radius-lg);
            padding: 60px;
            color: white;
            text-align: center;
        }

        .newsletter-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .newsletter-text {
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
        }

        .newsletter-btn {
            background: var(--text-dark);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .newsletter-btn:hover {
            background: black;
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 60px 80px 40px;
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

        /* Background Circles */
        .bg-circle {
            position: fixed;
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
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

        /* Responsive Design */
        @media screen and (max-width: 1280px) {
            .navbar { padding: 16px 40px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 16px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .press-grid,
            .coverage-grid,
            .press-kit-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .hero h1 { font-size: 40px; }
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

            .hero { padding: 100px 20px 60px; min-height: 400px; }
            .hero h1 { font-size: 36px; }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .press-grid,
            .coverage-grid,
            .press-kit-grid {
                grid-template-columns: 1fr;
            }

            .press-kit {
                padding: 40px 20px;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-btn {
                width: 100%;
                justify-content: center;
            }

            .inquiries-section {
                padding: 30px 20px;
            }

            .footer-content { flex-direction: column; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }
            .brand i { font-size: 24px; }

            .hero h1 { font-size: 32px; }
            .section-title { font-size: 28px; }

            .press-kit {
                padding: 30px 15px;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
            }

            .contact-info {
                text-align: center;
            }

            .footer-links { flex-direction: column; gap: 30px; }
            .bottom-bar { flex-direction: column; align-items: center; text-align: center; }
        }
    </style>
</head>
<body data-theme="{{ session('theme', 'light') }}" lang="{{ session('locale', 'en') }}">

    <!-- Background Circles -->
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>

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

        // Background images array - matching home page
        $backgroundImages = [
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?q=80&w=2071&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=2068&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=2083&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1974&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop',
        ];
        $randomImage = $backgroundImages[array_rand($backgroundImages)];

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
                'careers' => 'Careers',
                'about_us' => 'About Us',
                'press' => 'Press & Media',
                'press_title' => 'Press & Media',
                'press_subtitle' => 'Latest news, announcements, and media coverage about Vendora',
                'media_mentions' => 'Media Mentions',
                'press_releases' => 'Press Releases',
                'awards' => 'Awards',
                'partner_pubs' => 'Partner Publications',
                'latest_press' => 'Latest Press Releases',
                'media_coverage' => 'Media Coverage',
                'press_kit' => 'Press Kit',
                'brand_assets' => 'Brand Assets',
                'brand_desc' => 'Download our logo, brand guidelines, and official images in high resolution.',
                'media_kit' => 'Media Kit',
                'media_kit_desc' => 'Company fact sheet, executive bios, and background information.',
                'photos_videos' => 'Photos & Videos',
                'photos_desc' => 'High-resolution photos of our team, office, and events for media use.',
                'download' => 'Download',
                'media_inquiries' => 'Media Inquiries',
                'inquiries_text' => 'For press and media inquiries, please contact our communications team. We\'re happy to provide interviews, quotes, and additional information.',
                'email' => 'Email',
                'phone' => 'Phone',
                'press_contact' => 'Press Contact',
                'stay_updated' => 'Stay Updated',
                'newsletter_text' => 'Subscribe to our press newsletter to receive the latest news and announcements.',
                'subscribe' => 'Subscribe',
                'company' => 'Company',
                'discover' => 'Discover',
                'for_vendors_title' => 'For Vendors',
                'how_it_works' => 'How it works',
                'trust_safety' => 'Trust & Safety',
                'help_center' => 'Help Center',
                'invite_friends' => 'Invite Friends',
                'list_service' => 'List your service',
                'vendor_resources' => 'Vendor Resources',
                'success_stories' => 'Success Stories',
                'community' => 'Community',
                'rights_reserved' => 'All rights reserved',
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
                'careers' => 'ስራዎች',
                'about_us' => 'ስለ እኛ',
                'press' => 'ፕሬስ እና ሚዲያ',
                'press_title' => 'ፕሬስ እና ሚዲያ',
                'press_subtitle' => 'ስለ ቬንዶራ የቅርብ ጊዜ ዜናዎች፣ ማስታወቂያዎች እና የሚዲያ ሽፋን',
                'media_mentions' => 'የሚዲያ ማጣቀሻዎች',
                'press_releases' => 'ፕሬስ ማስታወቂያዎች',
                'awards' => 'ሽልማቶች',
                'partner_pubs' => 'አጋር ህትመቶች',
                'latest_press' => 'የቅርብ ጊዜ ፕሬስ ማስታወቂያዎች',
                'media_coverage' => 'የሚዲያ ሽፋን',
                'press_kit' => 'ፕሬስ ኪት',
                'brand_assets' => 'የምርት ስም ንብረቶች',
                'brand_desc' => 'ሎጎችን፣ የምርት ስም መመሪያዎችን እና ኦፊሴላዊ ምስሎችን በከፍተኛ ጥራት ያውርዱ።',
                'media_kit' => 'ሚዲያ ኪት',
                'media_kit_desc' => 'የኩባንያ መረጃ ሉህ፣ የአስፈጻሚ ባዮዎች እና ዳራ መረጃ።',
                'photos_videos' => 'ፎቶዎች እና ቪዲዮዎች',
                'photos_desc' => 'ለሚዲያ አገልግሎት የቡድናችን፣ የቢሮ እና የዝግጅቶች ከፍተኛ ጥራት ያላቸው ፎቶዎች።',
                'download' => 'አውርድ',
                'media_inquiries' => 'የሚዲያ ጥያቄዎች',
                'inquiries_text' => 'ለፕሬስ እና ሚዲያ ጥያቄዎች፣ እባክዎ የኮሙዩኒኬሽን ቡድናችንን ያግኙ። ቃለመጠይቆችን፣ ጥቅሶችን እና ተጨማሪ መረጃዎችን ለመስጠት ደስተኞች ነን።',
                'email' => 'ኢሜይል',
                'phone' => 'ስልክ',
                'press_contact' => 'የፕሬስ እውቂያ',
                'stay_updated' => 'ይዘምኑ',
                'newsletter_text' => 'የቅርብ ጊዜ ዜናዎችን እና ማስታወቂያዎችን ለመቀበል ለፕሬስ ጋዜጣችን ይመዝገቡ።',
                'subscribe' => 'ይመዝገቡ',
                'company' => 'ኩባንያ',
                'discover' => 'ያግኙ',
                'for_vendors_title' => 'ለነጋዴዎች',
                'how_it_works' => 'እንዴት እንደሚሰራ',
                'trust_safety' => 'እምነት እና ደህንነት',
                'help_center' => 'የእርዳታ ማዕከል',
                'invite_friends' => 'ጓደኞችን ይጋብዙ',
                'list_service' => 'አገልግሎትዎን ይዘርዝሩ',
                'vendor_resources' => 'የነጋዴ መርጃዎች',
                'success_stories' => 'የስኬት ታሪኮች',
                'community' => 'ማህበረሰብ',
                'rights_reserved' => 'መብቱ በህግ የተጠበቀ ነው',
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
                'careers' => 'Hojiwwan',
                'about_us' => 'Waa\'ee keenya',
                'press' => 'Gaalee fi Miidiyaa',
                'press_title' => 'Gaalee fi Miidiyaa',
                'press_subtitle' => 'Oduu, labsiiwwan, fi haguuggii miidiyaa waa\'ee Vendoraa',
                'media_mentions' => 'Faaruuwwan Miidiyaa',
                'press_releases' => 'Labsiiwwan Gaalee',
                'awards' => 'Badhaaswwan',
                'partner_pubs' => 'Maxxansa Hirmachaa',
                'latest_press' => 'Labsiiwwan Gaalee Haaraa',
                'media_coverage' => 'Haguuggii Miidiyaa',
                'press_kit' => 'Meeshaa Gaalee',
                'brand_assets' => 'Qabeenya Mallattoo',
                'brand_desc' => 'Logoo keenya, qajeelfama mallattoo fi suuraalee idilee kan resolution olaanaa qaban buusi.',
                'media_kit' => 'Meeshaa Miidiyaa',
                'media_kit_desc' => 'Baafata dhugaa kompanii, odeeffannoo abbootii fi odeeffannoo dugdaa.',
                'photos_videos' => 'Suuraalee fi Viidiyoo',
                'photos_desc' => 'Suuraalee garee keenyaa, waajjira keenyaa fi sagantaa kennaa resolution olaanaa qaban kan fayyadama miidiyaa.',
                'download' => 'Buusi',
                'media_inquiries' => 'Gaaffii Miidiyaa',
                'inquiries_text' => 'Gaaffiiwwan gaalee fi miidiyaa, garee quunnamtii keenya quunnami. Gaaffiiwwan, ibsa fi odeeffannoo dabalataa kennuuf gammanna.',
                'email' => 'Imeelii',
                'phone' => 'Bilbila',
                'press_contact' => 'Quunnamtii Gaalee',
                'stay_updated' => 'Haaraa argadhu',
                'newsletter_text' => 'Oduu dhiyoo fi labsiiwwan argachuuf gaazexaa gaalee keenya hordofadhu.',
                'subscribe' => 'Hordofadhu',
                'company' => 'Kompanii',
                'discover' => 'Barbaadi',
                'for_vendors_title' => 'Gurgurtootaaf',
                'how_it_works' => 'Akkamitti hojjeta',
                'trust_safety' => 'Amanaa fi Nageenya',
                'help_center' => 'Gargaarsa Giddugala',
                'invite_friends' => 'Hiriyoota waami',
                'list_service' => 'Tajaajila kee galmeessi',
                'vendor_resources' => 'Qabeenya Gurgurtaa',
                'success_stories' => 'Seenaa Milkaa\'inaa',
                'community' => 'Hawaasa',
                'rights_reserved' => 'Mirgiwwan hundi eegaman',
            ],
        ];

        $t = $translations[$currentLang] ?? $translations['en'];

        // Check if press data exists
        $hasPressReleases = isset($pressReleases) && $pressReleases instanceof \Illuminate\Support\Collection && $pressReleases->count() > 0;
        $hasMediaCoverage = isset($mediaCoverage) && $mediaCoverage instanceof \Illuminate\Support\Collection && $mediaCoverage->count() > 0;
    @endphp

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
            <a href="{{ route('home') }}#categories" class="nav-item">{{ $t['categories'] }}</a>
            <a href="{{ route('home') }}#features" class="nav-item">{{ $t['features'] }}</a>
            <a href="{{ route('list-service') }}" class="nav-item">{{ $t['for_vendors'] }}</a>
            <a href="{{ route('about') }}" class="nav-item">{{ $t['about_us'] }}</a>

            @guest
                <a href="{{ route('login') }}" class="nav-item">{{ $t['log_in'] }}</a>
                <a href="{{ route('register') }}" class="nav-item btn-signup">{{ $t['sign_up'] }}</a>
            @else
                <div class="profile-container">
                    <div class="profile-trigger" id="profileTrigger">
                        <div class="profile-avatar">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{ strtoupper(substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2)) }}
                            @endif
                        </div>
                        <span class="profile-name">{{ Auth::user()->business_name ?? Auth::user()->name }}</span>
                        <i class="ri-arrow-down-s-line" id="dropdownArrow"></i>
                    </div>

                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-avatar">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    {{ strtoupper(substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2)) }}
                                @endif
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
        <a href="{{ route('about') }}" class="nav-item">{{ $t['about_us'] }}</a>

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
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
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

    <!-- Hero Section with Dynamic Background -->
    <section class="hero">
        <div class="hero-background" style="background-image: url('{{ $randomImage }}');"></div>
        <div class="hero-overlay"></div>
        <h1><span>{{ $t['press'] }}</span></h1>
        <p>{{ $t['press_subtitle'] }}</p>
    </section>

    <main>
        <div class="container">
            <!-- Overview Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">{{ $t['media_mentions'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">{{ $t['press_releases'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">{{ $t['awards'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">{{ $t['partner_pubs'] }}</div>
                </div>
            </div>

            <!-- Latest Press Releases -->
            <section>
                <h2 class="section-title">{{ $t['latest_press'] }}</h2>
                <div class="press-grid">
                    @if($hasPressReleases)
                        @foreach($pressReleases as $release)
                        <div class="press-card">
                            <div class="press-image">
                                <i class="ri-{{ $release->icon ?? 'newspaper-line' }}"></i>
                            </div>
                            <div class="press-content">
                                <span class="press-date">{{ \Carbon\Carbon::parse($release->date)->format('F j, Y') }}</span>
                                <h3 class="press-title">{{ $release->title }}</h3>
                                <p class="press-excerpt">{{ $release->excerpt }}</p>
                                <div class="press-meta">
                                    <div class="press-source">
                                        <i class="ri-building-line"></i>
                                        <span>{{ $release->source }}</span>
                                    </div>
                                    <a href="{{ $release->url }}" class="read-more" target="_blank">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Press Release 1 -->
                        <div class="press-card">
                            <div class="press-image">
                                <i class="ri-newspaper-line"></i>
                            </div>
                            <div class="press-content">
                                <span class="press-date">February 15, 2025</span>
                                <h3 class="press-title">Vendora Expands to Addis Ababa</h3>
                                <p class="press-excerpt">Leading local vendor marketplace launches in Ethiopia's capital, connecting thousands of new vendors with customers.</p>
                                <div class="press-meta">
                                    <div class="press-source">
                                        <i class="ri-building-line"></i>
                                        <span>Vendora Press Room</span>
                                    </div>
                                    <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Press Release 2 -->
                        <div class="press-card">
                            <div class="press-image">
                                <i class="ri-award-line"></i>
                            </div>
                            <div class="press-content">
                                <span class="press-date">January 20, 2025</span>
                                <h3 class="press-title">Vendora Wins Innovation Award</h3>
                                <p class="press-excerpt">Recognized as Ethiopia's Most Innovative Tech Startup at the 2025 Ethiopian Business Awards.</p>
                                <div class="press-meta">
                                    <div class="press-source">
                                        <i class="ri-trophy-line"></i>
                                        <span>Ethiopian Business Awards</span>
                                    </div>
                                    <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Press Release 3 -->
                        <div class="press-card">
                            <div class="press-image">
                                <i class="ri-hand-coin-line"></i>
                            </div>
                            <div class="press-content">
                                <span class="press-date">December 5, 2024</span>
                                <h3 class="press-title">$2M Funding Round Announced</h3>
                                <p class="press-excerpt">Vendora secures $2 million in seed funding to accelerate growth and expand across East Africa.</p>
                                <div class="press-meta">
                                    <div class="press-source">
                                        <i class="ri-bank-line"></i>
                                        <span>TechCrunch</span>
                                    </div>
                                    <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Press Release 4 -->
                        <div class="press-card">
                            <div class="press-image">
                                <i class="ri-group-line"></i>
                            </div>
                            <div class="press-content">
                                <span class="press-date">November 12, 2024</span>
                                <h3 class="press-title">10,000 Vendors Milestone</h3>
                                <p class="press-excerpt">Vendora celebrates reaching 10,000 registered vendors across Ethiopia, with 50,000+ successful transactions.</p>
                                <div class="press-meta">
                                    <div class="press-source">
                                        <i class="ri-building-line"></i>
                                        <span>Vendora Press Room</span>
                                    </div>
                                    <a href="#" class="read-more">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Media Coverage -->
            <section>
                <h2 class="section-title">{{ $t['media_coverage'] }}</h2>
                <div class="coverage-grid">
                    @if($hasMediaCoverage)
                        @foreach($mediaCoverage as $coverage)
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-{{ $coverage->icon ?? 'global-line' }}"></i>
                            </div>
                            <div class="coverage-name">{{ $coverage->publication }}</div>
                            <div class="coverage-date">{{ \Carbon\Carbon::parse($coverage->date)->format('F Y') }}</div>
                            <p class="coverage-title">{{ $coverage->title }}</p>
                            <a href="{{ $coverage->url }}" class="coverage-link" target="_blank">Read Article <i class="ri-external-link-line"></i></a>
                        </div>
                        @endforeach
                    @else
                        <!-- Coverage 1 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-global-line"></i>
                            </div>
                            <div class="coverage-name">Forbes Africa</div>
                            <div class="coverage-date">January 2025</div>
                            <p class="coverage-title">"How Vendora is Revolutionizing Local Commerce in Ethiopia"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>

                        <!-- Coverage 2 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-computer-line"></i>
                            </div>
                            <div class="coverage-name">TechCrunch</div>
                            <div class="coverage-date">December 2024</div>
                            <p class="coverage-title">"Ethiopian Startup Vendora Raises $2M to Digitize Local Markets"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>

                        <!-- Coverage 3 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-newspaper-line"></i>
                            </div>
                            <div class="coverage-name">The Reporter</div>
                            <div class="coverage-date">November 2024</div>
                            <p class="coverage-title">"Jimma-Based Startup Connects Local Vendors with Customers"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>

                        <!-- Coverage 4 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-flask-line"></i>
                            </div>
                            <div class="coverage-name">African Business Review</div>
                            <div class="coverage-date">October 2024</div>
                            <p class="coverage-title">"Top 10 Ethiopian Startups to Watch in 2025"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>

                        <!-- Coverage 5 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-mic-line"></i>
                            </div>
                            <div class="coverage-name">BBC News Amharic</div>
                            <div class="coverage-date">September 2024</div>
                            <p class="coverage-title">"የዲጂታል ቴክኖሎጂ የአገር ውስጥ ንግድን እንዴት እየቀየረ ነው?"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>

                        <!-- Coverage 6 -->
                        <div class="coverage-card">
                            <div class="coverage-logo">
                                <i class="ri-pie-chart-line"></i>
                            </div>
                            <div class="coverage-name">Ethiopian Business Review</div>
                            <div class="coverage-date">August 2024</div>
                            <p class="coverage-title">"The Rise of E-Commerce in Ethiopia's Regional Cities"</p>
                            <a href="#" class="coverage-link">Read Article <i class="ri-external-link-line"></i></a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Press Kit -->
            <section class="press-kit">
                <h2 class="section-title">{{ $t['press_kit'] }}</h2>
                <div class="press-kit-grid">
                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-image-line"></i>
                        </div>
                        <h3 class="kit-title">{{ $t['brand_assets'] }}</h3>
                        <p class="kit-description">{{ $t['brand_desc'] }}</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            {{ $t['download'] }} (ZIP)
                        </a>
                    </div>

                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-file-text-line"></i>
                        </div>
                        <h3 class="kit-title">{{ $t['media_kit'] }}</h3>
                        <p class="kit-description">{{ $t['media_kit_desc'] }}</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            {{ $t['download'] }} (PDF)
                        </a>
                    </div>

                    <div class="kit-item">
                        <div class="kit-icon">
                            <i class="ri-gallery-line"></i>
                        </div>
                        <h3 class="kit-title">{{ $t['photos_videos'] }}</h3>
                        <p class="kit-description">{{ $t['photos_desc'] }}</p>
                        <a href="#" class="kit-btn">
                            <i class="ri-download-line"></i>
                            {{ $t['download'] }} (ZIP)
                        </a>
                    </div>
                </div>
            </section>

            <!-- Media Inquiries -->
            <section class="inquiries-section">
                <div class="inquiries-content">
                    <h2 class="inquiries-title">{{ $t['media_inquiries'] }}</h2>
                    <p class="inquiries-text">{{ $t['inquiries_text'] }}</p>

                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">{{ $t['email'] }}</div>
                                <div class="contact-value">
                                    <a href="mailto:press@vendora.com">press@vendora.com</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-phone-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">{{ $t['phone'] }}</div>
                                <div class="contact-value">
                                    <a href="tel:+251911234567">+251 91 123 4567</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ri-user-line"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-label">{{ $t['press_contact'] }}</div>
                                <div class="contact-value">Azeb G/Hiwot</div>
                                <div style="font-size: 12px; color: var(--text-secondary);">Communications Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter -->
            <section class="newsletter-section">
                <h2 class="newsletter-title">{{ $t['stay_updated'] }}</h2>
                <p class="newsletter-text">{{ $t['newsletter_text'] }}</p>

                <form class="newsletter-form" action="#" method="POST">
                    @csrf
                    <input type="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-btn">
                        {{ $t['subscribe'] }} <i class="ri-send-plane-line"></i>
                    </button>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-fill"></i> Vendora</h2>
                <p class="footer-text">{{ $t['press_subtitle'] }}</p>
                <div class="mt-4">
                    <span class="ethiopia-badge">
                        <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                    </span>
                </div>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>{{ $t['company'] }}</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">{{ $t['about_us'] }}</a></li>
                        <li><a href="{{ route('careers') }}">{{ $t['careers'] }}</a></li>
                        <li><a href="{{ route('press') }}">{{ $t['press'] }}</a></li>
                        <li><a href="#">{{ $t['blog'] ?? 'Blog' }}</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>{{ $t['discover'] }}</h4>
                    <ul>
                        <li><a href="{{ route('how-it-works') }}">{{ $t['how_it_works'] }}</a></li>
                        <li><a href="#">{{ $t['trust_safety'] }}</a></li>
                        <li><a href="#">{{ $t['help_center'] }}</a></li>
                        <li><a href="#">{{ $t['invite_friends'] }}</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>{{ $t['for_vendors_title'] }}</h4>
                    <ul>
                        <li><a href="{{ route('list-service') }}">{{ $t['list_service'] }}</a></li>
                        <li><a href="#">{{ $t['vendor_resources'] }}</a></li>
                        <li><a href="#">{{ $t['success_stories'] }}</a></li>
                        <li><a href="#">{{ $t['community'] }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora. {{ $t['rights_reserved'] }}. Jimma, Ethiopia</span>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-telegram-fill"></i></a>
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

                document.addEventListener('click', function(event) {
                    if (!languageSubmenu.contains(event.target) && !languageToggle.contains(event.target)) {
                        languageSubmenu.classList.remove('show');
                        if (languageArrow) {
                            languageArrow.style.transform = 'rotate(0deg)';
                        }
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
                        
                        const themeText = document.getElementById('themeText');
                        if (themeText) {
                            themeText.textContent = data.theme === 'dark' ? '{{ $t["light_mode"] }}' : '{{ $t["dark_mode"] }}';
                        }
                        
                        document.querySelectorAll('.theme-toggle i, [onclick="toggleTheme()"] i').forEach(icon => {
                            icon.className = data.theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
                        });

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

                        if (mobileMenu && mobileMenu.classList.contains('active')) {
                            mobileMenu.classList.remove('active');
                            const icon = menuToggle.querySelector('i');
                            if (icon) icon.className = 'ri-menu-line';
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
                    if (!confirm('{{ $currentLang == 'am' ? 'መውጣት መፈለግዎን እርግጠኛ ነዎት?' : ($currentLang == 'om' ? 'Mirkaneeffachuu barbaaddaa?' : 'Are you sure you want to logout?') }}')) {
                        e.preventDefault();
                    }
                });
            });

            // Newsletter form validation
            document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[type="email"]').value;
                if (email) {
                    alert('{{ $currentLang == 'am' ? 'ለፕሬስ ጋዜጣችን ስለተመዘገቡ እናመሰግናለን!' : ($currentLang == 'om' ? 'Gaazexaa gaalee keenyaaf galmeessaniif galatoomi!' : 'Thank you for subscribing to our press newsletter!') }}');
                    this.reset();
                }
            });

            // Rotating background images
            const heroBackground = document.querySelector('.hero-background');
            if (heroBackground) {
                const backgrounds = [
                    'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?q=80&w=2071&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=2068&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=2083&auto=format&fit=crop',
                ];

                setInterval(() => {
                    const randomIndex = Math.floor(Math.random() * backgrounds.length);
                    heroBackground.style.backgroundImage = `url('${backgrounds[randomIndex]}')`;
                }, 10000);
            }
        });
    </script>
</body>
</html>