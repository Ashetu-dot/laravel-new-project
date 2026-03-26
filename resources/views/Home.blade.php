<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Local Vendor Finder | Jimma, Ethiopia</title>
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

        /* Hero Section with Dynamic Background */
        .hero {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 80px;
            text-align: center;
            min-height: 600px;
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

        .hero-headline {
            font-size: clamp(32px, 8vw, 64px);
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 24px;
            max-width: 900px;
            letter-spacing: -1.5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: white;
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
            background-color: rgba(184, 142, 63, 0.3);
            z-index: -1;
            border-radius: 4px;
        }

        .hero-subtext {
            font-size: clamp(16px, 3vw, 20px);
            color: rgba(255,255,255,0.9);
            margin-bottom: 40px;
            max-width: 600px;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .hero-stats {
            display: flex;
            gap: clamp(20px, 5vw, 48px);
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-stat {
            text-align: center;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255,255,255,0.2);
            min-width: 150px;
        }

        .hero-stat-number {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: 800;
            color: var(--primary-color);
        }

        .hero-stat-label {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
        }

        /* Search Container */
        .search-container {
            background: var(--card-bg);
            padding: 16px;
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 960px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 10;
        }

        .search-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-right: 1px solid var(--border-color);
            position: relative;
        }

        .input-group:last-of-type {
            border-right: none;
        }

        .input-group i {
            font-size: 22px;
            color: var(--primary-color);
            margin-right: 16px;
            flex-shrink: 0;
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
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .input-field {
            border: none;
            outline: none;
            font-size: 16px;
            color: var(--text-primary);
            background: transparent;
            width: 100%;
            font-family: inherit;
        }

        .input-field::placeholder {
            color: #94a3b8;
        }

        .search-btn {
            background-color: var(--primary-color);
            color: white;
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .feature-card {
            background: var(--card-bg);
            padding: 40px 32px;
            border-radius: 24px;
            text-align: left;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
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
            color: var(--text-primary);
        }

        .feature-desc {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.6;
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

        /* Categories Section */
        .categories-wrapper {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-title {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: 700;
            color: var(--text-primary);
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
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: var(--card-bg);
            padding: 30px 10px;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            text-decoration: none;
            color: var(--text-primary);
            text-align: center;
        }

        .category-item:hover {
            border-color: var(--primary-color);
            background: rgba(184, 142, 63, 0.05);
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(184, 142, 63, 0.1);
        }

        .cat-icon {
            font-size: 32px;
            color: var(--text-primary);
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
            color: var(--text-primary);
        }

        /* Local Categories */
        .local-section {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }

        .local-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }

        .local-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--text-primary);
            height: 100%;
            display: flex;
            flex-direction: column;
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
            overflow: hidden;
            position: relative;
        }

        .local-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }

        .local-image .local-icon {
            position: relative;
            z-index: 1;
            color: white;
        }

        .local-content {
            padding: 24px;
            flex: 1;
        }

        .local-content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .local-content p {
            color: var(--text-secondary);
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
            flex-wrap: wrap;
            gap: 10px;
        }

        .local-vendors {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Testimonials */
        .testimonials {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, var(--bg-light) 100%);
            padding: 80px 20px;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            margin-top: 48px;
        }

        .testimonial-card {
            background: var(--card-bg);
            padding: 32px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .testimonial-text {
            color: var(--text-secondary);
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
            flex-shrink: 0;
            object-fit: cover;
            overflow: hidden;
        }

        img.testimonial-avatar {
            display: block;
            background: none;
            object-fit: cover;
            width: 48px;
            height: 48px;
        }

        .testimonial-info h4 {
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-primary);
        }

        .testimonial-info p {
            color: var(--text-secondary);
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
            font-size: clamp(32px, 6vw, 48px);
            font-weight: 800;
            margin-bottom: 24px;
        }

        .cta-text {
            font-size: clamp(16px, 3vw, 18px);
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
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
            border: none;
            cursor: pointer;
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
            background: transparent;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary-color);
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

        /* Loading Spinner */
        .ri-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Notification Animations */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media screen and (max-width: 1024px) {
            .navbar { padding: 16px 40px; }
            .nav-links { gap: 30px; }
            .categories-wrapper, .local-section { padding: 0 30px; }
            footer { padding: 50px 40px 30px; }
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
                border-bottom: 1px solid var(--border-color);
                padding: 12px 16px;
            }
            .input-group:last-of-type { border-bottom: none; }
            .search-btn {
                margin-left: 0;
                margin-top: 16px;
                width: 60px;
                height: 60px;
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

            .hero { padding: 80px 20px 60px; }
            .hero-stat {
                padding: 15px 20px;
                min-width: 120px;
            }

            .features { margin: 50px auto; }

            .categories-wrapper { padding: 0 24px; margin-bottom: 60px; }
            .local-section { padding: 0 24px; }

            .footer-content { flex-direction: column; }
            .footer-links { gap: 40px; }
            .footer-brand .footer-text { max-width: 100%; }
        }

        @media screen and (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .brand { font-size: 20px; }
            .brand i { font-size: 24px; }

            .hero { padding: 60px 16px 40px; }
            .hero-stat {
                width: 100%;
                max-width: 280px;
            }

            .search-container { padding: 16px; }
            .input-group { padding: 8px 12px; }
            .input-group i { font-size: 18px; margin-right: 10px; }

            .categories-wrapper, .local-section { padding: 0 16px; }
            .category-item { padding: 20px 8px; }

            .feature-card { padding: 30px 20px; }

            .cta-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            footer { padding: 40px 20px 20px; }
            .bottom-bar {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .mt-4 { margin-top: 16px; }
        .mb-4 { margin-bottom: 16px; }
        .w-100 { width: 100%; }
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

        // Language translations
        $translations = [
            'en' => [
                'categories' => 'Categories',
                'features' => 'Features',
                'for_vendors' => 'For Vendors',
                'log_in' => 'Log In',
                'sign_up' => 'Sign Up',
                'hero_headline' => 'Find the Best <br><span>Local Vendors</span> in Jimma',
                'hero_subtext' => 'Connect with top-rated local professionals for your events, home needs, and daily services. Trusted by thousands in your community.',
                'local_vendors' => 'Local Vendors',
                'happy_customers' => 'Happy Customers',
                'categories_count' => 'Categories',
                'search_what' => 'What',
                'search_where' => 'Where',
                'search_placeholder' => 'Plumbers, Bakers, Photographers...',
                'location_placeholder' => 'Jimma, Ethiopia',
                'popular_categories' => 'Popular Categories',
                'view_all' => 'View All',
                'popular_in_jimma' => 'Popular in Jimma',
                'explore_local' => 'Explore Local',
                'verified_vendors' => 'Verified Vendors',
                'verified_desc' => 'Every vendor on our platform undergoes a strict verification process to ensure safety and quality for the Jimma community.',
                'transparent_pricing' => 'Transparent Pricing',
                'transparent_desc' => 'Get clear quotes upfront in Ethiopian Birr. No hidden fees or last-minute surprises when you book services.',
                '247_support' => '24/7 Local Support',
                'support_desc' => 'Our dedicated support team in Jimma is always available to help you with bookings and inquiries in Amharic and English.',
                'what_residents_say' => 'What Jimma Residents Say',
                'ready_to_start' => 'Ready to Start?',
                'cta_text' => 'Join thousands of vendors and customers in Jimma and across Ethiopia.',
                'become_vendor' => 'Become a Vendor',
                'sign_up_customer' => 'Sign Up as Customer',
                'go_to_dashboard' => 'Go to Dashboard',
                'explore_vendors' => 'Explore Vendors',
                'company' => 'Company',
                'about_us' => 'About Us',
                'careers' => 'Careers',
                'press' => 'Press',
                'blog' => 'Blog',
                'discover' => 'Discover',
                'how_it_works' => 'How it works',
                'trust_safety' => 'Trust & Safety',
                'help_center' => 'Help Center',
                'invite_friends' => 'Invite Friends',
                'for_vendors_title' => 'For Vendors',
                'list_service' => 'List your service',
                'vendor_resources' => 'Vendor Resources',
                'success_stories' => 'Success Stories',
                'community' => 'Community',
                'rights_reserved' => 'All rights reserved',
                'my_profile' => 'My Profile',
                'settings' => 'Settings',
                'messages' => 'Messages',
                'notifications' => 'Notifications',
                'logout' => 'Logout',
                'dashboard' => 'Dashboard',
                'my_products' => 'My Products',
                'orders' => 'Orders',
                'following' => 'Following',
                'my_orders' => 'My Orders',
                'admin_dashboard' => 'Admin Dashboard',
                'manage_users' => 'Manage Users',
                'manage_products' => 'Manage Products',
                'language' => 'Language',
                'english' => 'English',
                'amharic' => 'Amharic',
                'oromo' => 'Afan Oromo',
                'dark_mode' => 'Dark Mode',
                'light_mode' => 'Light Mode',
                'theme_updated' => 'Theme updated successfully',
                'language_updated' => 'Language updated successfully',
                'search_error' => 'Please enter what you are looking for',

            ],
            'am' => [
                'categories' => 'ምድቦች',
                'features' => 'ገፅታዎች',
                'for_vendors' => 'ለነጋዴዎች',
                'log_in' => 'ግባ',
                'sign_up' => 'ተመዝገብ',
                'hero_headline' => 'በጅማ ውስጥ ምርጥ <br><span>የአካባቢ ነጋዴዎችን</span> ያግኙ',
                'hero_subtext' => 'ለዝግጅቶችዎ፣ ለቤት ፍላጎቶችዎ እና ለዕለታዊ አገልግሎቶችዎ ከከፍተኛ ደረጃ የአካባቢ ባለሙያዎች ጋር ይገናኙ።',
                'local_vendors' => 'የአካባቢ ነጋዴዎች',
                'happy_customers' => 'ደስተኛ ደንበኞች',
                'categories_count' => 'ምድቦች',
                'search_what' => 'ምን',
                'search_where' => 'የት',
                'search_placeholder' => 'የቧንቧ ሰሪዎች፣ ዳቦ ጋጋሪዎች፣ ፎቶግራፍ አንሺዎች...',
                'location_placeholder' => 'ጅማ፣ ኢትዮጵያ',
                'popular_categories' => 'ታዋቂ ምድቦች',
                'view_all' => 'ሁሉንም ይመልከቱ',
                'popular_in_jimma' => 'በጅማ ታዋቂ',
                'explore_local' => 'የአካባቢውን ይወቁ',
                'verified_vendors' => 'የተረጋገጡ ነጋዴዎች',
                'verified_desc' => 'በመድረካችን ላይ ያለ እያንዳንዱ ነጋዴ ለጅማ ማህበረሰብ ደህንነት እና ጥራት ለማረጋገጥ ጥብቅ የማረጋገጫ ሂደት ያካሂዳል።',
                'transparent_pricing' => 'ግልጽ ዋጋ',
                'transparent_desc' => 'በኢትዮጵያ ብር ግልጽ ዋጋዎችን አስቀድመው ያግኙ።',
                '247_support' => '24/7 የአካባቢ ድጋፍ',
                'support_desc' => 'በጅማ ያለው የእኛ የድጋፍ ቡድን በአማርኛ እና በእንግሊዝኛ ለመርዳት ሁልጊዜ ዝግጁ ነው።',
                'what_residents_say' => 'የጅማ ነዋሪዎች ምን ይላሉ',
                'ready_to_start' => 'ለመጀመር ዝግጁ ነዎት?',
                'cta_text' => 'በጅማ እና በመላው ኢትዮጵያ ከሚገኙ በሺዎች ከሚቆጠሩ ነጋዴዎች እና ደንበኞች ጋር ይቀላቀሉ።',
                'become_vendor' => 'ነጋዴ ይሁኑ',
                'sign_up_customer' => 'እንደ ደንበኛ ይመዝገቡ',
                'go_to_dashboard' => 'ወደ ዳሽቦርድ ይሂዱ',
                'explore_vendors' => 'ነጋዴዎችን ይወቁ',
                'company' => 'ኩባንያ',
                'about_us' => 'ስለ እኛ',
                'careers' => 'ስራዎች',
                'press' => 'ፕሬስ',
                'blog' => 'ብሎግ',
                'discover' => 'ያግኙ',
                'how_it_works' => 'እንዴት እንደሚሰራ',
                'trust_safety' => 'እምነት እና ደህንነት',
                'help_center' => 'የእርዳታ ማዕከል',
                'invite_friends' => 'ጓደኞችን ይጋብዙ',
                'for_vendors_title' => 'ለነጋዴዎች',
                'list_service' => 'አገልግሎትዎን ይዘርዝሩ',
                'vendor_resources' => 'የነጋዴ መርጃዎች',
                'success_stories' => 'የስኬት ታሪኮች',
                'community' => 'ማህበረሰብ',
                'rights_reserved' => 'መብቱ በህግ የተጠበቀ ነው',
                'my_profile' => 'የእኔ መገለጫ',
                'settings' => 'ቅንብሮች',
                'messages' => 'መልዕክቶች',
                'notifications' => 'ማሳወቂያዎች',
                'logout' => 'ውጣ',
                'dashboard' => 'ዳሽቦርድ',
                'my_products' => 'የእኔ ምርቶች',
                'orders' => 'ትዕዛዞች',
                'following' => 'የምከተላቸው',
                'my_orders' => 'የእኔ ትዕዛዞች',
                'admin_dashboard' => 'የአስተዳዳሪ ዳሽቦርድ',
                'manage_users' => 'ተጠቃሚዎችን ያስተዳድሩ',
                'manage_products' => 'ምርቶችን ያስተዳድሩ',
                'language' => 'ቋንቋ',
                'english' => 'እንግሊዝኛ',
                'amharic' => 'አማርኛ',
                'oromo' => 'አፋን ኦሮሞ',
                'dark_mode' => 'ጨለማ ሁነታ',
                'light_mode' => 'ብርሃን ሁነታ',
                'theme_updated' => 'ገጽታ በተሳካ ሁኔታ ተዘምኗል',
                'language_updated' => 'ቋንቋ በተሳካ ሁኔታ ተዘምኗል',
                'search_error' => 'እባክዎ የሚፈልጉትን ያስገቡ',

            ],
            'om' => [
                'categories' => 'Ramaddiiwwan',
                'features' => 'Amaloota',
                'for_vendors' => 'Gurgurtaaf',
                'log_in' => 'Seeni',
                'sign_up' => 'Galmaa\'i',
                'hero_headline' => 'Jimmaa keessatti <br><span>Gurgurtota Naannoo</span> filatamaa barbaadi',
                'hero_subtext' => 'Sababa keessaniif, fedhii mana keessaniif, tajaajila guyyaa guyyaa keessaniif ogeeyyii naannoo sadarkaa olaanaa qaban waliin hidhadhaa.',
                'local_vendors' => 'Gurgurtota Naannoo',
                'happy_customers' => 'Maamila Gammadoo',
                'categories_count' => 'Ramaddiiwwan',
                'search_what' => 'Maal',
                'search_where' => 'Eessa',
                'search_placeholder' => 'Ogeeyyii ujummoo, daabbooftota, warra suuraa kaasani...',
                'location_placeholder' => 'Jimmaa, Itoophiyaa',
                'popular_categories' => 'Ramaddiiwwan Beekamoo',
                'view_all' => 'Hunda ilaali',
                'popular_in_jimma' => 'Jimmaa keessatti beekamoo',
                'explore_local' => 'Naannoo sakatta\'i',
                'verified_vendors' => 'Gurgurtota Mirkanaa\'an',
                'verified_desc' => 'Gurgurtoonni hundi tajaajila fi tajaajilaaf akkaataa mirkaneessaa cimaa keessa darbu.',
                'transparent_pricing' => 'Gatii Ifa Ta\'e',
                'transparent_desc' => 'Gatiin kee ifa ta\'e argadhu. Kaffaltiin dhokataa hin jiru.',
                '247_support' => 'Deeggarsa Naannoo 24/7',
                'support_desc' => 'Gareen deeggarsa keenya yeroo hundumaa dhiyeenya.',
                'what_residents_say' => 'Jiraattonni Jimmaa maal jedhu',
                'ready_to_start' => 'Jalqabuuf qophii dhaa?',
                'cta_text' => 'Kumaamaan gurgurtoota fi maamila wajjin tajaajila.',
                'become_vendor' => 'Gurgurtaa ta\'i',
                'sign_up_customer' => 'Maamila ta\'i',
                'go_to_dashboard' => 'Deeksii dhaqi',
                'explore_vendors' => 'Gurgurtota barbaadi',
                'company' => 'Kompanii',
                'about_us' => 'Waa\'ee keenya',
                'careers' => 'Hojiwwan',
                'press' => 'Gaalee',
                'blog' => 'Bilogii',
                'discover' => 'Barbaadi',
                'how_it_works' => 'Akkamitti hojjeta',
                'trust_safety' => 'Amanaa fi Nageenya',
                'help_center' => 'Gargaarsa Giddugala',
                'invite_friends' => 'Hiriyoota waami',
                'for_vendors_title' => 'Gurgurtootaaf',
                'list_service' => 'Tajaajila kee galmeessi',
                'vendor_resources' => 'Qabeenya Gurgurtaa',
                'success_stories' => 'Seenaa Milkaa\'inaa',
                'community' => 'Hawaasa',
                'rights_reserved' => 'Mirgiwwan hundi eegaman',
                'my_profile' => 'Koorniyaa koo',
                'settings' => 'Sajoo',
                'messages' => 'Ergaa',
                'notifications' => 'Beeksisa',
                'logout' => 'Ba\'i',
                'dashboard' => 'Deeksii',
                'my_products' => 'Oomishaalee koo',
                'orders' => 'Ajaja',
                'following' => 'Anaan hordofu',
                'my_orders' => 'Ajaja koo',
                'admin_dashboard' => 'Deeksii Bulchaa',
                'manage_users' => 'Fayyadamtoota bulchi',
                'manage_products' => 'Oomishaalee bulchi',
                'language' => 'Afaan',
                'english' => 'Ingiliffa',
                'amharic' => 'Amaariffa',
                'oromo' => 'Afaan Oromoo',
                'dark_mode' => 'Haama Dukkanaa',
                'light_mode' => 'Haama Ifaa',
                'theme_updated' => 'Haalli milkaa\'inaan haaromfame',
                'language_updated' => 'Afaan milkaa\'inaan haaromfame',
                'search_error' => 'Maaloo waan barbaaddaa galchi',

            ],
        ];

        $t = $translations[$currentLang] ?? $translations['en'];

        // Background images array
        $backgroundImages = [
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?q=80&w=2071&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=2068&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=2083&auto=format&fit=crop',
        ];
        $randomImage = $backgroundImages[array_rand($backgroundImages)];
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
            <a href="#categories" class="nav-item">{{ $t['categories'] }}</a>
            <a href="#features" class="nav-item">{{ $t['features'] }}</a>
            <a href="{{ route('list-service') }}" class="nav-item">{{ $t['for_vendors'] }}</a>
            <a href="{{ route('documentation') }}" class="nav-item">Documentation</a>

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
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
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

                            @if(method_exists(Auth::user(), 'unreadMessages') && Auth::user()->unreadMessages()->count() > 0)
                            <a href="#" class="dropdown-item">
                                <i class="ri-message-line"></i> {{ $t['messages'] }}
                                <span class="badge">{{ Auth::user()->unreadMessages()->count() }}</span>
                            </a>
                            @endif

                            {{--  @if(method_exists(Auth::user(), 'unreadNotifications') && Auth::user()->unreadNotifications()->count() > 0)
                            <a href="{{ route('notifications') }}" class="dropdown-item">
                                <i class="ri-notification-3-line"></i> {{ $t['notifications'] }}
                                <span class="badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
                            </a>
                            @endif  --}}




                            @if(method_exists(Auth::user(), 'unreadNotifications') && Auth::user()->unreadNotifications()->count() > 0)
    @if(Auth::user()->role === 'customer')
        <a href="{{ route('customer.notifications') }}" class="dropdown-item">
            <i class="ri-notification-3-line"></i> {{ $t['notifications'] }}
            <span class="badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
        </a>
    @elseif(Auth::user()->role === 'vendor')
        <a href="{{ route('vendor.notifications') }}" class="dropdown-item">
            <i class="ri-notification-3-line"></i> {{ $t['notifications'] }}
            <span class="badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
        </a>
    @elseif(Auth::user()->role === 'admin')
        <a href="{{ route('admin.notifications') }}" class="dropdown-item">
            <i class="ri-notification-3-line"></i> {{ $t['notifications'] }}
            <span class="badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
        </a>
    @else
        <a href="{{ route('customer.notifications') }}" class="dropdown-item">
            <i class="ri-notification-3-line"></i> {{ $t['notifications'] }}
            <span class="badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
        </a>
    @endif
@endif








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
        <a href="#categories" class="nav-item">{{ $t['categories'] }}</a>
        <a href="#features" class="nav-item">{{ $t['features'] }}</a>
        <a href="{{ route('list-service') }}" class="nav-item">{{ $t['for_vendors'] }}</a>
        <a href="{{ route('documentation') }}" class="nav-item">Documentation</a>

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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background" style="background-image: url('{{ $randomImage }}');"></div>
        <div class="hero-overlay"></div>
        <h1 class="hero-headline">{!! $t['hero_headline'] !!}</h1>
        <p class="hero-subtext">{{ $t['hero_subtext'] }}</p>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($vendorCount ?? 0) }}</div>
                <div class="hero-stat-label">{{ $t['local_vendors'] }}</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($customerCount ?? 0) }}</div>
                <div class="hero-stat-label">{{ $t['happy_customers'] }}</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ $categoryCount ?? 0 }}</div>
                <div class="hero-stat-label">{{ $t['categories_count'] }}</div>
            </div>
        </div>

        <form action="{{ route('search.results') }}" method="GET" class="w-100" style="display: flex; justify-content: center;" id="searchForm">
            <div class="search-container">
                <div class="input-group">
                    <i class="ri-search-line"></i>
                    <div class="input-content">
                        <label class="input-label">{{ $t['search_what'] }}</label>
                        <input type="text" name="query" class="input-field" placeholder="{{ $t['search_placeholder'] }}" value="{{ request('query') }}" id="searchQuery">
                    </div>
                </div>
                <div class="input-group">
                    <i class="ri-map-pin-line"></i>
                    <div class="input-content">
                        <label class="input-label">{{ $t['search_where'] }}</label>
                        <input type="text" name="location" class="input-field" placeholder="{{ $t['location_placeholder'] }}" value="{{ request('location', 'Jimma') }}" id="searchLocation">
                    </div>
                </div>
                <button type="submit" class="search-btn" aria-label="Search" id="searchBtn">
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>
        </form>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories-wrapper">
        <div class="section-header">
            <h2 class="section-title">{{ $t['popular_categories'] }}</h2>
            <a href="{{ route('search.results') }}" class="view-all">{{ $t['view_all'] }} <i class="ri-arrow-right-s-line"></i></a>
        </div>
        <div class="categories-grid">
            @forelse($popularCategories ?? [] as $category)
            <a href="{{ route('search.results', ['category' => $category->slug ?? '']) }}" class="category-item">
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="cat-icon" style="width:48px;height:48px;object-fit:cover;border-radius:10px;">
                @else
                    <i class="{{ $category->icon ?? 'ri-price-tag-3-line' }} cat-icon"></i>
                @endif
                <span class="cat-name">{{ $category->name ?? '' }}</span>
            </a>
            @empty
                <a href="{{ route('search.results', ['category' => 'coffee-tea']) }}" class="category-item">
                    <i class="ri-cup-line cat-icon"></i>
                    <span class="cat-name">Coffee & Tea</span>
                </a>
                <a href="{{ route('search.results', ['category' => 'handicrafts']) }}" class="category-item">
                    <i class="ri-palette-line cat-icon"></i>
                    <span class="cat-name">Handicrafts</span>
                </a>
                <a href="{{ route('search.results', ['category' => 'food']) }}" class="category-item">
                    <i class="ri-restaurant-line cat-icon"></i>
                    <span class="cat-name">Ethiopian Food</span>
                </a>
                <a href="{{ route('search.results', ['category' => 'photography']) }}" class="category-item">
                    <i class="ri-camera-lens-line cat-icon"></i>
                    <span class="cat-name">Photography</span>
                </a>
                <a href="{{ route('search.results', ['category' => 'events']) }}" class="category-item">
                    <i class="ri-cake-3-line cat-icon"></i>
                    <span class="cat-name">Events</span>
                </a>
                <a href="{{ route('search.results', ['category' => 'home-services']) }}" class="category-item">
                    <i class="ri-home-gear-line cat-icon"></i>
                    <span class="cat-name">Home Services</span>
                </a>
            @endforelse
        </div>
    </section>

    <!-- Local Jimma Categories -->
    <section class="local-section">
        <div class="section-header">
            <h2 class="section-title">{{ $t['popular_in_jimma'] }}</h2>
            <a href="{{ route('search.results', ['location' => 'Jimma']) }}" class="view-all">{{ $t['explore_local'] }} <i class="ri-arrow-right-s-line"></i></a>
        </div>
        <div class="local-grid">
            @forelse($jimmaCategories ?? [] as $localCat)
            <a href="{{ route('search.results', ['category' => $localCat->slug ?? '', 'location' => 'Jimma']) }}" class="local-card">
                <div class="local-image">
                    @if($localCat->image_url)
                        <img src="{{ $localCat->image_url }}" alt="{{ $localCat->name }}" loading="lazy">
                    @else
                        <span class="local-icon"><i class="{{ $localCat->icon ?? 'ri-store-line' }}"></i></span>
                    @endif
                </div>
                <div class="local-content">
                    <h3>{{ $localCat->name ?? '' }}</h3>
                    <p>{{ $localCat->short_description ?? 'Find the best local vendors in Jimma.' }}</p>
                    <div class="local-meta">
                        <span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span>
                        <span class="local-vendors">{{ $localCat->vendors_count ?? rand(5, 30) }} {{ $t['local_vendors'] }}</span>
                    </div>
                </div>
            </a>
            @empty
                <a href="{{ route('search.results', ['category' => 'coffee-tea', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-cup-line"></i></div>
                    <div class="local-content">
                        <h3>Coffee & Tea</h3>
                        <p>Fresh Ethiopian coffee from local roasters</p>
                        <div class="local-meta">
                            <span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span>
                            <span class="local-vendors">12 {{ $t['local_vendors'] }}</span>
                        </div>
                    </div>
                </a>
                <a href="{{ route('search.results', ['category' => 'handicrafts', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-palette-line"></i></div>
                    <div class="local-content">
                        <h3>Traditional Handicrafts</h3>
                        <p>Authentic Ethiopian crafts and artworks</p>
                        <div class="local-meta">
                            <span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span>
                            <span class="local-vendors">24 {{ $t['local_vendors'] }}</span>
                        </div>
                    </div>
                </a>
                <a href="{{ route('search.results', ['category' => 'food', 'location' => 'Jimma']) }}" class="local-card">
                    <div class="local-image"><i class="ri-restaurant-line"></i></div>
                    <div class="local-content">
                        <h3>Ethiopian Food</h3>
                        <p>Local restaurants and food vendors</p>
                        <div class="local-meta">
                            <span class="location-badge"><i class="ri-map-pin-line"></i> Jimma</span>
                            <span class="local-vendors">18 {{ $t['local_vendors'] }}</span>
                        </div>
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
            <h3 class="feature-title">{{ $t['verified_vendors'] }}</h3>
            <p class="feature-desc">{{ $t['verified_desc'] }}</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-money-dollar-circle-line"></i>
            </div>
            <h3 class="feature-title">{{ $t['transparent_pricing'] }}</h3>
            <p class="feature-desc">{{ $t['transparent_desc'] }}</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="ri-customer-service-2-line"></i>
            </div>
            <h3 class="feature-title">{{ $t['247_support'] }}</h3>
            <p class="feature-desc">{{ $t['support_desc'] }}</p>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="testimonials-container">
            <h2 class="section-title text-center">{{ $t['what_residents_say'] }}</h2>
            <div class="testimonials-grid">
                @forelse($testimonials ?? [] as $testimonial)
                <div class="testimonial-card">
                    <p class="testimonial-text">"{{ $testimonial->content ?? '' }}"</p>
                    <div class="testimonial-author">
                        <img class="testimonial-avatar" src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->author_name }}" style="object-fit:cover;">
                        <div class="testimonial-info">
                            <h4>{{ $testimonial->author_name ?? '' }}</h4>
                            <p>{{ $testimonial->author_role ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="testimonial-card">
                    <p class="testimonial-text">"Vendora helped me find the best coffee supplier in Jimma. The quality is amazing and delivery is always on time!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">AB</div>
                        <div class="testimonial-info">
                            <h4>Abebe Kebede</h4>
                            <p>Local Business Owner</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"As a vendor, Vendora has connected me with so many customers in Jimma. My handicraft business has grown tremendously!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">AT</div>
                        <div class="testimonial-info">
                            <h4>Azeb Tadesse</h4>
                            <p>Handicraft Artisan</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container">
            <h2 class="cta-title">{{ $t['ready_to_start'] }}</h2>
            <p class="cta-text">{{ $t['cta_text'] }}</p>
            <div class="cta-buttons">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="ri-store-line"></i> {{ $t['become_vendor'] }}
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        <i class="ri-user-line"></i> {{ $t['sign_up_customer'] }}
                    </a>
                @else
                    @php
                        $dashboardRoute = '#';
                        if(Auth::user()->role === 'vendor') {
                            $dashboardRoute = route('vendor.dashboard');
                        } elseif(Auth::user()->role === 'admin') {
                            $dashboardRoute = route('admin.dashboard');
                        } else {
                            $dashboardRoute = route('customer.dashboard');
                        }
                    @endphp
                    <a href="{{ $dashboardRoute }}" class="btn btn-primary">
                        <i class="ri-dashboard-line"></i> {{ $t['go_to_dashboard'] }}
                    </a>
                    <a href="{{ route('search.results') }}" class="btn btn-outline">
                        <i class="ri-search-line"></i> {{ $t['explore_vendors'] }}
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
                <p class="footer-text">{{ $t['cta_text'] }}</p>
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
                        <li><a href="{{ route('blog') }}">{{ $t['blog'] }}</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>{{ $t['discover'] }}</h4>
                    <ul>
                        <li><a href="{{ route('how-it-works') }}">{{ $t['how_it_works'] }}</a></li>
                        <li><a href="{{ route('trust-safety') }}">{{ $t['trust_safety'] }}</a></li>
                        <li><a href="{{ route('help-center') }}">{{ $t['help_center'] }}</a></li>
                        <li><a href="{{ route('invite') }}">{{ $t['invite_friends'] }}</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>{{ $t['for_vendors_title'] }}</h4>
                    <ul>
                        <li><a href="{{ route('list-service') }}">{{ $t['list_service'] }}</a></li>
                      

                        <li><a href="{{ route('community') }}">{{ $t['community'] }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <span>&copy; {{ date('Y') }} Vendora. {{ $t['rights_reserved'] }}. Jimma, Ethiopia</span>
            <div class="social-icons">
                <a href="#" target="_blank" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // ==================== COMPLETE BACKEND INTEGRATED JAVASCRIPT ====================

        document.addEventListener('DOMContentLoaded', function() {
            // Store translations for JavaScript use
            const translations = {
                theme_updated: '{{ $t["theme_updated"] }}',
                language_updated: '{{ $t["language_updated"] }}',
                search_error: '{{ $t["search_error"] }}',

                dark_mode: '{{ $t["dark_mode"] }}',
                light_mode: '{{ $t["light_mode"] }}'
            };

            const currentLang = '{{ $currentLang }}';
            const currentTheme = '{{ $currentTheme }}';

            // ==================== NOTIFICATION SYSTEM ====================

            function showNotification(message, type = 'success') {
                // Remove existing notifications
                document.querySelectorAll('.custom-notification').forEach(n => n.remove());

                const notification = document.createElement('div');
                notification.className = `alert alert-${type} custom-notification`;
                notification.innerHTML = `
                    <i class="ri-${type === 'success' ? 'checkbox-circle' : 'error-warning'}-line"></i>
                    <span>${message}</span>
                `;

                notification.style.position = 'fixed';
                notification.style.top = '20px';
                notification.style.right = '20px';
                notification.style.zIndex = '9999';
                notification.style.maxWidth = '300px';
                notification.style.animation = 'slideIn 0.3s ease';
                notification.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // ==================== PROFILE DROPDOWN ====================

            const profileTrigger = document.getElementById('profileTrigger');
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownArrow = document.getElementById('dropdownArrow');

            if (profileTrigger && profileDropdown) {
                profileTrigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    profileDropdown.classList.toggle('active');

                    if (dropdownArrow) {
                        dropdownArrow.style.transform = profileDropdown.classList.contains('active')
                            ? 'rotate(180deg)'
                            : 'rotate(0deg)';
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

            // ==================== LANGUAGE SUBMENU ====================

            const languageToggle = document.getElementById('languageToggle');
            const languageSubmenu = document.getElementById('languageSubmenu');
            const languageArrow = document.getElementById('languageArrow');

            if (languageToggle && languageSubmenu) {
                languageToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    languageSubmenu.classList.toggle('show');

                    if (languageArrow) {
                        languageArrow.style.transform = languageSubmenu.classList.contains('show')
                            ? 'rotate(90deg)'
                            : 'rotate(0deg)';
                    }
                });

                // Close language submenu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!languageSubmenu.contains(event.target) && !languageToggle.contains(event.target)) {
                        languageSubmenu.classList.remove('show');
                        if (languageArrow) {
                            languageArrow.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            }

            // ==================== THEME TOGGLE WITH BACKEND ====================

            window.toggleTheme = async function() {
                const currentTheme = document.body.getAttribute('data-theme') || 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';

                // Get all theme toggle elements
                const themeToggles = document.querySelectorAll('[onclick="toggleTheme()"], .theme-toggle');
                const themeText = document.getElementById('themeText');
                const mobileThemeText = document.querySelector('.mobile-menu div span:first-child');

                // Store original content for restore on error
                const originalContents = [];

                // Show loading state
                themeToggles.forEach(toggle => {
                    if (toggle.classList.contains('dropdown-item')) {
                        const icon = toggle.querySelector('i');
                        if (icon) {
                            originalContents.push({ element: icon, content: icon.className });
                            icon.className = 'ri-loader-4-line ri-spin';
                        }
                    } else if (toggle.classList.contains('theme-toggle')) {
                        const icon = toggle.querySelector('i');
                        if (icon) {
                            originalContents.push({ element: icon, content: icon.className });
                            icon.className = 'ri-loader-4-line ri-spin';
                        }
                    }
                    toggle.style.pointerEvents = 'none';
                });

                try {
                    const response = await fetch('{{ route("theme.toggle") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ theme: newTheme })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update theme on page
                        document.body.setAttribute('data-theme', data.theme);

                        // Update all theme icons
                        themeToggles.forEach(toggle => {
                            const icon = toggle.querySelector('i');
                            if (icon) {
                                icon.className = data.theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
                            }
                        });

                        // Update theme text
                        if (themeText) {
                            themeText.textContent = data.theme === 'dark' ? translations.light_mode : translations.dark_mode;
                        }

                        if (mobileThemeText && mobileThemeText.nodeType === Node.TEXT_NODE) {
                            mobileThemeText.textContent = data.theme === 'dark' ? translations.light_mode : translations.dark_mode;
                        } else if (mobileThemeText) {
                            const textNode = Array.from(mobileThemeText.childNodes).find(node => node.nodeType === Node.TEXT_NODE);
                            if (textNode) {
                                textNode.textContent = data.theme === 'dark' ? translations.light_mode : translations.dark_mode;
                            }
                        }

                        // Show success notification
                        showNotification(translations.theme_updated, 'success');
                    } else {
                        throw new Error(data.message || 'Failed to update theme');
                    }
                } catch (error) {
                    console.error('Theme toggle error:', error);
                    showNotification(error.message || 'Failed to update theme', 'error');

                    // Restore original icons on error
                    originalContents.forEach(item => {
                        if (item.element) {
                            item.element.className = item.content;
                        }
                    });
                } finally {
                    // Restore pointer events
                    themeToggles.forEach(toggle => {
                        toggle.style.pointerEvents = 'auto';
                    });
                }
            };

            // ==================== LANGUAGE SWITCHING WITH BACKEND ====================

            window.switchLanguage = async function(lang) {
                const langButtons = document.querySelectorAll(`.lang-btn, .language-option`);
                const clickedButton = event?.currentTarget || document.querySelector(`[onclick="switchLanguage('${lang}')"]`);

                // Store original content
                const originalContents = [];

                // Show loading state
                langButtons.forEach(btn => {
                    if (btn.classList.contains('lang-btn')) {
                        originalContents.push({ element: btn, content: btn.innerHTML });
                        btn.innerHTML = '<i class="ri-loader-4-line ri-spin"></i>';
                        btn.disabled = true;
                    }
                });

                try {
                    const response = await fetch('{{ route("language.switch") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ locale: lang })
                    });

                    const data = await response.json();

                    if (data.success) {
                        showNotification(translations.language_updated, 'success');
                        // Reload page after short delay to show notification
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        throw new Error(data.message || 'Failed to switch language');
                    }
                } catch (error) {
                    console.error('Language switch error:', error);
                    showNotification(error.message || 'Failed to switch language', 'error');

                    // Restore button states
                    langButtons.forEach((btn, index) => {
                        if (btn.classList.contains('lang-btn')) {
                            btn.innerHTML = originalContents[index]?.content || btn.innerHTML;
                            btn.disabled = false;
                        }
                    });
                }
            };

            // ==================== MOBILE MENU ====================

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

                // Close mobile menu when clicking a link
                mobileMenu.querySelectorAll('a, button').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                    });
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                    }
                });
            }

            // ==================== SMOOTH SCROLLING ====================

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            // Close mobile menu if open
                            if (mobileMenu && mobileMenu.classList.contains('active')) {
                                mobileMenu.classList.remove('active');
                                const icon = menuToggle?.querySelector('i');
                                if (icon) icon.className = 'ri-menu-line';
                            }
                        }
                    }
                });
            });

            // ==================== AUTO-HIDE ALERTS ====================

            setTimeout(() => {
                document.querySelectorAll('.alert:not(.custom-notification)').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // ==================== SCROLL ANIMATION ====================

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

            document.querySelectorAll('.feature-card, .category-item, .local-card, .testimonial-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // ==================== ACTIVE NAVIGATION ====================

            const sections = document.querySelectorAll('section[id]');
            window.addEventListener('scroll', () => {
                let current = '';
                const scrollPos = window.scrollY + 100;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                        current = section.getAttribute('id');
                    }
                });

                document.querySelectorAll('.nav-links .nav-item, .mobile-menu .nav-item').forEach(item => {
                    item.classList.remove('active');
                    const href = item.getAttribute('href');
                    if (href === `#${current}`) {
                        item.classList.add('active');
                    }
                });
            });

            // ==================== SEARCH FORM VALIDATION ====================

            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const query = document.getElementById('searchQuery');
                    if (query && !query.value.trim()) {
                        e.preventDefault();
                        showNotification(translations.search_error, 'error');
                        query.focus();
                    }
                });
            }

            // ==================== ROTATING BACKGROUND IMAGES ====================

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


            // ==================== LOAD INITIAL THEME ====================

            async function loadUserTheme() {
                try {
                    const response = await fetch('{{ route("theme.get") }}', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (data.success && data.theme !== currentTheme) {
                        document.body.setAttribute('data-theme', data.theme);

                        // Update icons
                        document.querySelectorAll('.theme-toggle i, [onclick="toggleTheme()"] i').forEach(icon => {
                            icon.className = data.theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
                        });

                        // Update text
                        const themeText = document.getElementById('themeText');
                        if (themeText) {
                            themeText.textContent = data.theme === 'dark' ? translations.light_mode : translations.dark_mode;
                        }
                    }
                } catch (error) {
                    console.error('Failed to load theme preference:', error);
                }
            }

            // Load theme preference on page load
            loadUserTheme();

            console.log('Vendora Homepage loaded with full backend integration');
        });
    </script>

    {{--  @if(app()->environment('local'))
    <script>
        console.log('Environment: Local');
        console.log('Stats:', {
            vendors: '{{ $vendorCount ?? 0 }}',
            customers: '{{ $customerCount ?? 0 }}',
            categories: '{{ $categoryCount ?? 0 }}',
            theme: '{{ $currentTheme }}',
            language: '{{ $currentLang }}'
        });
    </script>
    @endif  --}}
</body>
</html>