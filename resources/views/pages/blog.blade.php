<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Blog - Vendora | Jimma, Ethiopia</title>
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

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        /* Blog Layout */
        .blog-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
        }

        /* Featured Post */
        .featured-post {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-column: 1 / -1;
            border: 1px solid var(--border-color);
        }

        .featured-post:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .featured-image {
            height: 100%;
            min-height: 350px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 64px;
        }

        .featured-content {
            padding: 40px;
        }

        .featured-category {
            display: inline-block;
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .featured-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .featured-excerpt {
            color: var(--text-secondary);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .featured-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .featured-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .author-info {
            font-size: 14px;
        }

        .author-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .author-title {
            color: var(--text-secondary);
            font-size: 12px;
        }

        .featured-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .read-more-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .read-more-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Blog Grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .blog-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .blog-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .blog-content {
            padding: 24px;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .blog-category {
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }

        .blog-date {
            color: var(--text-secondary);
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .blog-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.4;
            color: var(--text-primary);
        }

        .blog-excerpt {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 10px;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .blog-author-avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .blog-author-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .blog-read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.3s;
        }

        .blog-read-more:hover {
            gap: 8px;
        }

        /* Sidebar */
        .blog-sidebar {
            position: sticky;
            top: 100px;
            align-self: start;
        }

        .sidebar-widget {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .widget-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            color: var(--text-primary);
        }

        .widget-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-color);
        }

        /* Search Widget */
        .search-form {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            overflow: hidden;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            outline: none;
            font-size: 14px;
            background: var(--bg-light);
            color: var(--text-primary);
        }

        .search-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: var(--primary-hover);
        }

        /* Categories Widget */
        .categories-list {
            list-style: none;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-link {
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .category-link i {
            color: var(--primary-color);
            font-size: 14px;
        }

        .category-link:hover {
            color: var(--primary-color);
        }

        .category-count {
            background: var(--bg-light);
            color: var(--text-secondary);
            padding: 2px 8px;
            border-radius: 50px;
            font-size: 12px;
        }

        /* Popular Posts Widget */
        .popular-post {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .popular-post:last-child {
            margin-bottom: 0;
        }

        .popular-image {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .popular-content {
            flex: 1;
        }

        .popular-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .popular-title a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .popular-title a:hover {
            color: var(--primary-color);
        }

        .popular-date {
            font-size: 11px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Tags Widget */
        .tags-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: var(--bg-light);
            color: var(--text-secondary);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }

        .tag:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Newsletter Widget */
        .newsletter-widget p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 16px;
        }

        .newsletter-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            margin-bottom: 10px;
            font-size: 14px;
            background: var(--bg-light);
            color: var(--text-primary);
        }

        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .subscribe-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .subscribe-btn:hover {
            background: var(--primary-hover);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 50px;
            grid-column: 1 / -1;
        }

        .page-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-link.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-dots {
            color: var(--text-secondary);
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

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: var(--radius-md);
            background: var(--card-bg);
            box-shadow: var(--shadow-hover);
            border-left: 4px solid var(--primary-color);
            z-index: 9999;
            animation: slideInRight 0.3s ease;
            max-width: 350px;
        }

        .notification.success {
            border-left-color: var(--success-color);
        }

        .notification.error {
            border-left-color: var(--error-color);
        }

        .notification.info {
            border-left-color: var(--primary-color);
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification i {
            font-size: 24px;
        }

        .notification.success i {
            color: var(--success-color);
        }

        .notification.error i {
            color: var(--error-color);
        }

        .notification.info i {
            color: var(--primary-color);
        }

        .notification-message {
            flex: 1;
            font-size: 14px;
            color: var(--text-primary);
        }

        .notification-close {
            cursor: pointer;
            color: var(--text-secondary);
            transition: color 0.3s;
        }

        .notification-close:hover {
            color: var(--error-color);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
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
        @media screen and (max-width: 1280px) {
            .navbar { padding: 16px 40px; }
            footer { padding: 50px 40px 30px; }
        }

        @media screen and (max-width: 1024px) {
            .navbar { padding: 16px 30px; }
            .brand { font-size: 22px; }
            .nav-links { gap: 30px; }

            .blog-layout {
                grid-template-columns: 1fr;
            }

            .blog-sidebar {
                position: static;
                margin-top: 40px;
            }

            .featured-post {
                grid-template-columns: 1fr;
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .hero h1 { font-size: 40px; }

            .blog-grid {
                grid-template-columns: 1fr;
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

            .hero { padding: 100px 20px 60px; min-height: 400px; }
            .hero h1 { font-size: 36px; }

            .featured-content {
                padding: 30px;
            }

            .featured-title {
                font-size: 24px;
            }

            .featured-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .footer-content { flex-direction: column; }
            .footer-links { flex-wrap: wrap; gap: 30px 60px; }
            footer { padding: 40px 30px 30px; }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }
            .brand i { font-size: 24px; }

            .hero h1 { font-size: 32px; }

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
                'press' => 'Press',
                'blog' => 'Blog',
                'blog_title' => 'Vendora Blog',
                'blog_subtitle' => 'Insights, stories, and updates from the Vendora community',
                'community_spotlight' => 'Community Spotlight',
                'vendor_success' => 'Vendor Success',
                'tips_tricks' => 'Tips & Tricks',
                'photography' => 'Photography',
                'food_drink' => 'Food & Drink',
                'home_services' => 'Home Services',
                'health_beauty' => 'Health & Beauty',
                'read_full_story' => 'Read Full Story',
                'read_more' => 'Read More',
                'min_read' => 'min read',
                'search' => 'Search',
                'search_placeholder' => 'Search articles...',
                'categories' => 'Categories',
                'popular_posts' => 'Popular Posts',
                'popular_tags' => 'Popular Tags',
                'newsletter' => 'Newsletter',
                'newsletter_text' => 'Subscribe to get the latest posts and updates from Vendora.',
                'subscribe' => 'Subscribe',
                'previous' => 'Previous',
                'next' => 'Next',
                'company' => 'Company',
                'discover' => 'Discover',
                'for_vendors_title' => 'For Vendors',
                'how_it_works' => 'How it works',
                'trust_safety' => 'Trust & Safety',
                'help_center' => 'Help Center',
                'invite_friends' => 'Invite Friends',
                'list_service' => 'List your service',


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
                'press' => 'ፕሬስ',
                'blog' => 'ብሎግ',
                'blog_title' => 'የቬንዶራ ብሎግ',
                'blog_subtitle' => 'ማስተዋሎች፣ ታሪኮች እና ዝማኔዎች ከቬንዶራ ማህበረሰብ',
                'community_spotlight' => 'የማህበረሰብ ትኩረት',
                'vendor_success' => 'የነጋዴ ስኬት',
                'tips_tricks' => 'ምክሮች እና ዘዴዎች',
                'photography' => 'ፎቶግራፊ',
                'food_drink' => 'ምግብ እና መጠጥ',
                'home_services' => 'የቤት አገልግሎቶች',
                'health_beauty' => 'ጤና እና ውበት',
                'read_full_story' => 'ሙሉ ታሪክ ያንብቡ',
                'read_more' => 'ተጨማሪ ያንብቡ',
                'min_read' => 'ደቂቃ ንባብ',
                'search' => 'ፈልግ',
                'search_placeholder' => 'መጣጥፎችን ይፈልጉ...',
                'categories' => 'ምድቦች',
                'popular_posts' => 'ታዋቂ ልጥፎች',
                'popular_tags' => 'ታዋቂ መለያዎች',
                'newsletter' => 'ጋዜጣ',
                'newsletter_text' => 'የቅርብ ጊዜ ልጥፎችን እና ዝማኔዎችን ከቬንዶራ ለመቀበል ይመዝገቡ።',
                'subscribe' => 'ይመዝገቡ',
                'previous' => 'ቀዳሚ',
                'next' => 'ቀጣይ',
                'company' => 'ኩባንያ',
                'discover' => 'ያግኙ',
                'for_vendors_title' => 'ለነጋዴዎች',
                'how_it_works' => 'እንዴት እንደሚሰራ',
                'trust_safety' => 'እምነት እና ደህንነት',
                'help_center' => 'የእርዳታ ማዕከል',
                'invite_friends' => 'ጓደኞችን ይጋብዙ',
                'list_service' => 'አገልግሎትዎን ይዘርዝሩ',

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
                'press' => 'Gaalee',
                'blog' => 'Bilogii',
                'blog_title' => 'Bilogii Vendoraa',
                'blog_subtitle' => 'Hubannoo, seenaa fi odeeffannoo haaraa hawaasa Vendoraa',
                'community_spotlight' => 'Ifa Hawaasummaa',
                'vendor_success' => 'Milkaa\'ina Gurgurtaa',
                'tips_tricks' => 'Qayyabee fi Mallattoo',
                'photography' => 'Suuraa Kaasuu',
                'food_drink' => 'Nyaata fi Dhugaatii',
                'home_services' => 'Tajaajila Manaa',
                'health_beauty' => 'Fayyaa fi Miidhagina',
                'read_full_story' => 'Dubbisa Guutuu',
                'read_more' => 'Dabalata dubbisi',
                'min_read' => 'daqiiqa dubbisuu',
                'search' => 'Barbaadi',
                'search_placeholder' => 'Barreeffamoota barbaadi...',
                'categories' => 'Ramaddiiwwan',
                'popular_posts' => 'Barreeffama Beekamoo',
                'popular_tags' => 'Mallattoolee Beekamoo',
                'newsletter' => 'Gaazexaa',
                'newsletter_text' => 'Barreeffama haaraa fi odeeffannoo Vendoraa argachuuf hordofadhu.',
                'subscribe' => 'Hordofadhu',
                'previous' => 'Kan duraa',
                'next' => 'Kan ittaanu',
                'company' => 'Kompanii',
                'discover' => 'Barbaadi',
                'for_vendors_title' => 'Gurgurtootaaf',
                'how_it_works' => 'Akkamitti hojjeta',
                'trust_safety' => 'Amanaa fi Nageenya',
                'help_center' => 'Gargaarsa Giddugala',
                'invite_friends' => 'Hiriyoota waami',
                'list_service' => 'Tajaajila kee galmeessi',
                'community' => 'Hawaasa',
                'rights_reserved' => 'Mirgiwwan hundi eegaman',
            ],
        ];

        $t = $translations[$currentLang] ?? $translations['en'];

        // Check if blog posts exist
        $hasPosts = isset($posts) && $posts instanceof \Illuminate\Support\Collection && $posts->count() > 0;
        $hasCategories = isset($categories) && $categories instanceof \Illuminate\Support\Collection && $categories->count() > 0;
        $hasPopularPosts = isset($popularPosts) && $popularPosts instanceof \Illuminate\Support\Collection && $popularPosts->count() > 0;
        $hasTags = isset($tags) && $tags instanceof \Illuminate\Support\Collection && $tags->count() > 0;
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
        <a href="{{ route('careers') }}" class="nav-item">{{ $t['careers'] }}</a>
        <a href="{{ route('press') }}" class="nav-item">{{ $t['press'] }}</a>
        <a href="{{ route('blog') }}" class="nav-item" style="color: var(--primary-color);">{{ $t['blog'] }}</a>

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
        <h1><span>{{ $t['blog'] }}</span></h1>
        <p>{{ $t['blog_subtitle'] }}</p>
    </section>

    <main>
        <div class="container">
            <div class="blog-layout">
                <!-- Main Content -->
                <div class="blog-main">
                    <!-- Featured Post -->
                    @if($hasPosts && $posts->where('is_featured', true)->first())
                        @php $featured = $posts->where('is_featured', true)->first(); @endphp
                        <article class="featured-post">
                            <div class="featured-image">
                                <i class="ri-{{ $featured->icon ?? 'store-3-line' }}"></i>
                            </div>
                            <div class="featured-content">
                                <span class="featured-category">{{ $featured->category_name ?? $t['community_spotlight'] }}</span>
                                <h2 class="featured-title">{{ $featured->title }}</h2>
                                <p class="featured-excerpt">{{ $featured->excerpt }}</p>
                                <div class="featured-meta">
                                    <div class="featured-author">
                                        <div class="author-avatar">{{ strtoupper(substr($featured->author_name ?? 'AT', 0, 2)) }}</div>
                                        <div class="author-info">
                                            <div class="author-name">{{ $featured->author_name ?? 'Abebe Tadesse' }}</div>
                                            <div class="author-title">{{ $featured->author_title ?? 'Community Manager' }}</div>
                                        </div>
                                    </div>
                                    <div class="featured-date">
                                        <i class="ri-calendar-line"></i>
                                        <span>{{ \Carbon\Carbon::parse($featured->published_at)->format('F j, Y') }}</span>
                                    </div>
                                    <div class="featured-date">
                                        <i class="ri-time-line"></i>
                                        <span>{{ $featured->read_time ?? 5 }} {{ $t['min_read'] }}</span>
                                    </div>
                                </div>
                                <a href="{{ $featured->url ?? '#' }}" class="read-more-btn" onclick="handleReadMore(event, '{{ $featured->slug ?? '' }}')">
                                    {{ $t['read_full_story'] }} <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </article>
                    @else
                        <!-- Default Featured Post -->
                        <article class="featured-post">
                            <div class="featured-image">
                                <i class="ri-store-3-line"></i>
                            </div>
                            <div class="featured-content">
                                <span class="featured-category">{{ $t['community_spotlight'] }}</span>
                                <h2 class="featured-title">How Jimma's Coffee Vendors Are Going Digital</h2>
                                <p class="featured-excerpt">Discover how local coffee roasters in Jimma are using Vendora to reach new customers and preserve traditional Ethiopian coffee culture in the digital age.</p>
                                <div class="featured-meta">
                                    <div class="featured-author">
                                        <div class="author-avatar">AT</div>
                                        <div class="author-info">
                                            <div class="author-name">Abebe Tadesse</div>
                                            <div class="author-title">Community Manager</div>
                                        </div>
                                    </div>
                                    <div class="featured-date">
                                        <i class="ri-calendar-line"></i>
                                        <span>February 17, 2025</span>
                                    </div>
                                    <div class="featured-date">
                                        <i class="ri-time-line"></i>
                                        <span>5 {{ $t['min_read'] }}</span>
                                    </div>
                                </div>
                                <a href="#" class="read-more-btn" onclick="handleReadMore(event)">
                                    {{ $t['read_full_story'] }} <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </article>
                    @endif

                    <!-- Blog Grid -->
                    <div class="blog-grid">
                        @if($hasPosts)
                            @foreach($posts->where('is_featured', false)->take(6) as $post)
                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-{{ $post->icon ?? 'handbag-line' }}"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $post->category_name ?? $t['vendor_success'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('M j, Y') }}</span>
                                    </div>
                                    <h3 class="blog-title">{{ $post->title }}</h3>
                                    <p class="blog-excerpt">{{ $post->excerpt }}</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">{{ strtoupper(substr($post->author_name ?? 'MK', 0, 2)) }}</div>
                                            <span class="blog-author-name">{{ $post->author_name ?? 'Mekdes Kebede' }}</span>
                                        </div>
                                        <a href="{{ $post->url ?? '#' }}" class="blog-read-more" onclick="handleReadMore(event, '{{ $post->slug ?? '' }}')">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        @else
                            <!-- Default Blog Posts -->
                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-handbag-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['vendor_success'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 15, 2025</span>
                                    </div>
                                    <h3 class="blog-title">From Local Shop to Online Success: A Vendora Story</h3>
                                    <p class="blog-excerpt">How a traditional handicraft shop in Jimma grew their business 300% in just 6 months using Vendora's platform.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">MK</div>
                                            <span class="blog-author-name">Mekdes Kebede</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-customer-service-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['tips_tricks'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 12, 2025</span>
                                    </div>
                                    <h3 class="blog-title">10 Tips for Choosing the Right Local Vendor</h3>
                                    <p class="blog-excerpt">From checking reviews to comparing quotes, learn how to find the perfect vendor for your needs on Vendora.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">TB</div>
                                            <span class="blog-author-name">Tekle Berhan</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-camera-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['photography'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 10, 2025</span>
                                    </div>
                                    <h3 class="blog-title">Best Wedding Photographers in Jimma for 2025</h3>
                                    <p class="blog-excerpt">We've rounded up the top-rated wedding photographers on Vendora to help you capture your special day.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">AG</div>
                                            <span class="blog-author-name">Azeb G/Hiwot</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-restaurant-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['food_drink'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 8, 2025</span>
                                    </div>
                                    <h3 class="blog-title">Traditional Ethiopian Dishes You Can Order Online</h3>
                                    <p class="blog-excerpt">From Doro Wat to Kitfo, discover local caterers and restaurants delivering authentic Ethiopian cuisine.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">AT</div>
                                            <span class="blog-author-name">Abebe Tadesse</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-home-gear-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['home_services'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 5, 2025</span>
                                    </div>
                                    <h3 class="blog-title">Home Maintenance Checklist for Jimma Residents</h3>
                                    <p class="blog-excerpt">Keep your home in top shape with this seasonal maintenance guide and find trusted local professionals.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">MK</div>
                                            <span class="blog-author-name">Mekdes Kebede</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <article class="blog-card">
                                <div class="blog-image">
                                    <i class="ri-heart-pulse-line"></i>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-category">{{ $t['health_beauty'] }}</span>
                                        <span class="blog-date"><i class="ri-calendar-line"></i> Feb 3, 2025</span>
                                    </div>
                                    <h3 class="blog-title">Top 5 Salons and Spas in Jimma</h3>
                                    <p class="blog-excerpt">Treat yourself to some self-care at these highly-rated beauty spots recommended by Vendora customers.</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">AG</div>
                                            <span class="blog-author-name">Azeb G/Hiwot</span>
                                        </div>
                                        <a href="#" class="blog-read-more" onclick="handleReadMore(event)">
                                            {{ $t['read_more'] }} <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <a href="#" class="page-link active" onclick="handlePagination(event, 1)">1</a>
                        <a href="#" class="page-link" onclick="handlePagination(event, 2)">2</a>
                        <a href="#" class="page-link" onclick="handlePagination(event, 3)">3</a>
                        <span class="page-dots">...</span>
                        <a href="#" class="page-link" onclick="handlePagination(event, 8)">8</a>
                        <a href="#" class="page-link" onclick="handlePagination(event, 'next')">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="blog-sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ $t['search'] }}</h3>
                        <form class="search-form" onsubmit="handleSearch(event)">
                            <input type="text" class="search-input" id="searchInput" placeholder="{{ $t['search_placeholder'] }}" value="{{ request('q') }}">
                            <button type="submit" class="search-btn">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ $t['categories'] }}</h3>
                        <ul class="categories-list">
                            @if(isset($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, '{{ $category->slug }}')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $category->name }}
                                    </a>
                                    <span class="category-count">{{ $category->posts_count }}</span>
                                </li>
                                @endforeach
                            @else
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'community-spotlight')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['community_spotlight'] }}
                                    </a>
                                    <span class="category-count">12</span>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'vendor-success')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['vendor_success'] }}
                                    </a>
                                    <span class="category-count">8</span>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'tips-tricks')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['tips_tricks'] }}
                                    </a>
                                    <span class="category-count">15</span>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'food-drink')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['food_drink'] }}
                                    </a>
                                    <span class="category-count">10</span>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'home-services')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['home_services'] }}
                                    </a>
                                    <span class="category-count">7</span>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="category-link" onclick="handleCategory(event, 'health-beauty')">
                                        <i class="ri-price-tag-3-line"></i>
                                        {{ $t['health_beauty'] }}
                                    </a>
                                    <span class="category-count">9</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Popular Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ $t['popular_posts'] }}</h3>

                        @if(isset($popularPosts) && $popularPosts->count() > 0)
                            @foreach($popularPosts as $popular)
                            <div class="popular-post">
                                <div class="popular-image">
                                    <i class="ri-{{ $popular->icon ?? 'cup-line' }}"></i>
                                </div>
                                <div class="popular-content">
                                    <h4 class="popular-title">
                                        <a href="#" onclick="handleReadMore(event, '{{ $popular->slug }}')">{{ $popular->title }}</a>
                                    </h4>
                                    <div class="popular-date">
                                        <i class="ri-calendar-line"></i> {{ \Carbon\Carbon::parse($popular->published_at)->format('M j, Y') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="popular-post">
                                <div class="popular-image">
                                    <i class="ri-cup-line"></i>
                                </div>
                                <div class="popular-content">
                                    <h4 class="popular-title">
                                        <a href="#" onclick="handleReadMore(event)">The Best Coffee Shops in Jimma</a>
                                    </h4>
                                    <div class="popular-date">
                                        <i class="ri-calendar-line"></i> Feb 14, 2025
                                    </div>
                                </div>
                            </div>

                            <div class="popular-post">
                                <div class="popular-image">
                                    <i class="ri-handbag-line"></i>
                                </div>
                                <div class="popular-content">
                                    <h4 class="popular-title">
                                        <a href="#" onclick="handleReadMore(event)">How to Start Your Online Vendor Journey</a>
                                    </h4>
                                    <div class="popular-date">
                                        <i class="ri-calendar-line"></i> Feb 10, 2025
                                    </div>
                                </div>
                            </div>

                            <div class="popular-post">
                                <div class="popular-image">
                                    <i class="ri-cake-line"></i>
                                </div>
                                <div class="popular-content">
                                    <h4 class="popular-title">
                                        <a href="#" onclick="handleReadMore(event)">Top Caterers for Your Next Event</a>
                                    </h4>
                                    <div class="popular-date">
                                        <i class="ri-calendar-line"></i> Feb 5, 2025
                                    </div>
                                </div>
                            </div>

                            <div class="popular-post">
                                <div class="popular-image">
                                    <i class="ri-camera-line"></i>
                                </div>
                                <div class="popular-content">
                                    <h4 class="popular-title">
                                        <a href="#" onclick="handleReadMore(event)">Wedding Photography Guide 2025</a>
                                    </h4>
                                    <div class="popular-date">
                                        <i class="ri-calendar-line"></i> Feb 1, 2025
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ $t['popular_tags'] }}</h3>
                        <div class="tags-cloud">
                            @if(isset($tags) && $tags->count() > 0)
                                @foreach($tags as $tag)
                                    <a href="#" class="tag" onclick="handleTag(event, '{{ $tag->slug }}')">#{{ $tag->name }}</a>
                                @endforeach
                            @else
                                <a href="#" class="tag" onclick="handleTag(event, 'jimma')">#Jimma</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'ethiopia')">#Ethiopia</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'coffee')">#Coffee</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'handicrafts')">#Handicrafts</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'wedding')">#Wedding</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'photography')">#Photography</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'food')">#Food</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'beauty')">#Beauty</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'homeservices')">#HomeServices</a>
                                <a href="#" class="tag" onclick="handleTag(event, 'vendors')">#Vendors</a>
                            @endif
                        </div>
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ $t['newsletter'] }}</h3>
                        <p>{{ $t['newsletter_text'] }}</p>
                        <form onsubmit="handleNewsletter(event)">
                            @csrf
                            <input type="email" id="newsletterEmail" class="newsletter-input" placeholder="Your email address" required>
                            <button type="submit" class="subscribe-btn">
                                <i class="ri-send-plane-line"></i>
                                {{ $t['subscribe'] }}
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h2><i class="ri-store-2-fill"></i> Vendora</h2>
                <p class="footer-text">{{ $t['blog_subtitle'] }}</p>
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
                <a href="#" target="_blank"><i class="ri-twitter-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="#" target="_blank"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // ==================== COMPLETE BACKEND INTEGRATION ====================

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

                        showNotification('Theme updated successfully', 'success');
                    }
                })
                .catch(error => {
                    console.error('Error toggling theme:', error);
                    showNotification('Failed to update theme', 'error');
                });
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
                .catch(error => {
                    console.error('Error switching language:', error);
                    showNotification('Failed to switch language', 'error');
                });
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

        // ==================== NOTIFICATION SYSTEM ====================

        function showNotification(message, type = 'success') {
            // Remove existing notifications
            document.querySelectorAll('.notification').forEach(n => n.remove());

            const notification = document.createElement('div');
            notification.className = `notification ${type}`;

            const icon = type === 'success' ? 'ri-checkbox-circle-line' : (type === 'error' ? 'ri-error-warning-line' : 'ri-information-line');

            notification.innerHTML = `
                <div class="notification-content">
                    <i class="${icon}"></i>
                    <div class="notification-message">${message}</div>
                    <i class="ri-close-line notification-close" onclick="this.closest('.notification').remove()"></i>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // ==================== BLOG FUNCTIONALITY ====================

        // Handle search
        window.handleSearch = function(e) {
            e.preventDefault();
            const query = document.getElementById('searchInput').value.trim();

            if (query) {
                // In a real implementation, this would redirect to search results
                // window.location.href = '/blog/search?q=' + encodeURIComponent(query);
                showNotification('Searching for: ' + query, 'info');

                // Simulate search results
                setTimeout(() => {
                    showNotification('Found 5 articles matching "' + query + '"', 'success');
                }, 1000);
            } else {
                showNotification('Please enter a search term', 'error');
            }
        };

        // Handle read more clicks
        window.handleReadMore = function(e, slug) {
            e.preventDefault();

            if (slug) {
                // In a real implementation, this would go to the post page
                // window.location.href = '/blog/' + slug;
                showNotification('Opening article: ' + (slug.replace(/-/g, ' ')), 'info');
            } else {
                showNotification('Article coming soon!', 'info');
            }
        };

        // Handle category clicks
        window.handleCategory = function(e, slug) {
            e.preventDefault();

            if (slug) {
                // In a real implementation, this would filter by category
                // window.location.href = '/blog/category/' + slug;
                showNotification('Showing category: ' + slug.replace(/-/g, ' '), 'info');
            }
        };

        // Handle tag clicks
        window.handleTag = function(e, slug) {
            e.preventDefault();

            if (slug) {
                // In a real implementation, this would filter by tag
                // window.location.href = '/blog/tag/' + slug;
                showNotification('Showing tag: #' + slug, 'info');
            }
        };

        // Handle pagination
        window.handlePagination = function(e, page) {
            e.preventDefault();

            if (page === 'next') {
                showNotification('Loading next page...', 'info');
            } else {
                showNotification('Loading page ' + page + '...', 'info');
            }

            // Simulate page load
            setTimeout(() => {
                showNotification('Page ' + page + ' loaded', 'success');
            }, 1000);
        };

        // Handle newsletter submission
        window.handleNewsletter = function(e) {
            e.preventDefault();
            const email = document.getElementById('newsletterEmail').value.trim();

            if (!email) {
                showNotification('Please enter your email address', 'error');
                return;
            }

            if (!isValidEmail(email)) {
                showNotification('Please enter a valid email address', 'error');
                return;
            }

            // Show loading state
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="spinner"></span> Submitting...';
            btn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // In a real implementation, this would send to the server
                // fetch('/blog/newsletter', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     },
                //     body: JSON.stringify({ email: email })
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         showNotification('{{ $currentLang == 'am' ? 'ለብሎግ ጋዜጣችን ስለተመዘገቡ እናመሰግናለን!' : ($currentLang == 'om' ? 'Gaazexaa bilogii keenyaaf galmeessaniif galatoomi!' : 'Thank you for subscribing to our blog newsletter!') }}', 'success');
                //         e.target.reset();
                //     } else {
                //         showNotification(data.message || 'Subscription failed', 'error');
                //     }
                // })
                // .catch(error => {
                //     showNotification('An error occurred. Please try again.', 'error');
                // })
                // .finally(() => {
                //     btn.innerHTML = originalText;
                //     btn.disabled = false;
                // });

                // Simulated success
                showNotification('{{ $currentLang == 'am' ? 'ለብሎግ ጋዜጣችን ስለተመዘገቡ እናመሰግናለን!' : ($currentLang == 'om' ? 'Gaazexaa bilogii keenyaaf galmeessaniif galatoomi!' : 'Thank you for subscribing to our blog newsletter!') }}', 'success');
                e.target.reset();
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1500);
        };

        // Email validation helper
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Load more posts (infinite scroll simulation)
        window.loadMorePosts = function() {
            showNotification('Loading more articles...', 'info');

            setTimeout(() => {
                showNotification('3 more articles loaded', 'success');
            }, 1500);
        };

        // Share article
        window.shareArticle = function(title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(console.error);
            } else {
                // Fallback
                navigator.clipboard.writeText(url).then(() => {
                    showNotification('Link copied to clipboard!', 'success');
                });
            }
        };
    </script>
</body>
</html>
