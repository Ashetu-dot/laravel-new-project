<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Careers - Vendora | Jimma, Ethiopia</title>
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

        /* Hero Section with Dynamic Background - Matching Home Page */
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

        /* Why Join Us Section */
        .why-join {
            margin-bottom: 80px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .benefit-card {
            background: var(--card-bg);
            padding: 30px 20px;
            border-radius: var(--radius-lg);
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .benefit-icon {
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

        .benefit-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .benefit-card p {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Open Positions */
        .positions-section {
            margin-bottom: 80px;
        }

        .positions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .position-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .position-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .position-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .position-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .position-type {
            background: rgba(184, 142, 63, 0.1);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .position-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .position-location i {
            color: var(--primary-color);
        }

        .position-description {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .position-requirements {
            margin-bottom: 20px;
            flex: 1;
        }

        .requirements-title {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
            color: var(--text-primary);
        }

        .requirements-list {
            list-style: none;
        }

        .requirements-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 8px;
        }

        .requirements-list i {
            color: var(--success-color);
            font-size: 14px;
        }

        .position-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .position-salary {
            font-weight: 600;
            color: var(--primary-color);
        }

        .apply-btn {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border: none;
            cursor: pointer;
        }

        .apply-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        /* Application Form */
        .application-section {
            background: linear-gradient(135deg, rgba(184, 142, 63, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
            padding: 60px 20px;
            border-radius: var(--radius-lg);
            margin-bottom: 80px;
        }

        .application-form {
            max-width: 700px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: var(--text-primary);
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
            color: var(--text-primary);
        }

        .form-label .required {
            color: var(--error-color);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.05);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: var(--bg-light);
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background: rgba(184, 142, 63, 0.05);
            transform: translateY(-2px);
        }

        .file-upload-area.has-file {
            border-color: var(--success-color);
            background: rgba(16, 185, 129, 0.05);
        }

        .file-upload-area.error {
            border-color: var(--error-color);
            background: rgba(239, 68, 68, 0.05);
        }

        .file-upload-icon {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .file-upload-text {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .file-upload-hint {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .file-input {
            display: none;
        }

        .file-preview {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: var(--bg-light);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .file-preview.active {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .file-preview i {
            font-size: 30px;
            color: var(--primary-color);
        }

        .file-preview-info {
            flex: 1;
        }

        .file-preview-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
            color: var(--text-primary);
        }

        .file-preview-size {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .file-preview-remove {
            color: var(--error-color);
            cursor: pointer;
            font-size: 20px;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .file-preview-remove:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .submit-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* FAQ Section */
        .faq-section {
            margin-bottom: 60px;
        }

        .faq-grid {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }

        .faq-item:hover {
            box-shadow: var(--shadow-hover);
        }

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
            color: var(--text-primary);
        }

        .faq-question:hover {
            background: rgba(184, 142, 63, 0.02);
        }

        .faq-question i {
            color: var(--primary-color);
            transition: transform 0.3s;
            font-size: 20px;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 25px 20px;
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.7;
            display: none;
        }

        .faq-answer.active {
            display: block;
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
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-links { gap: 50px; }
        }

        @media screen and (max-width: 900px) {
            .hero h1 { font-size: 40px; }
            .positions-grid {
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

            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .application-form {
                padding: 30px 20px;
            }

            .footer-content {
                flex-direction: column;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 30px 60px;
            }

            .bottom-bar {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

        @media screen and (max-width: 640px) {
            .navbar { padding: 14px 20px; }
            .brand { font-size: 20px; }
            .brand i { font-size: 24px; }

            .hero h1 { font-size: 32px; }
            .section-title { font-size: 28px; }

            .position-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .position-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .footer-links {
                flex-direction: column;
                gap: 30px;
            }
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
            'https://images.unsplash.com- team photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop',
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
                'join_team' => 'Join the Vendora Team',
                'help_connect' => 'Help us connect communities with trusted local vendors across Ethiopia',
                'why_join' => 'Why Join Vendora?',
                'purpose_driven' => 'Purpose-Driven Work',
                'purpose_desc' => 'Make a real impact by helping local businesses thrive and communities connect.',
                'great_culture' => 'Great Team Culture',
                'culture_desc' => 'Work with passionate, supportive colleagues who share your values.',
                'growth_opp' => 'Growth Opportunities',
                'growth_desc' => 'Continuous learning and clear career progression paths.',
                'benefits' => 'Competitive Benefits',
                'benefits_desc' => 'Health insurance, flexible hours, and competitive compensation.',
                'open_positions' => 'Open Positions',
                'requirements' => 'Requirements',
                'apply_now' => 'Apply Now',
                'application_form' => 'Application Form',
                'full_name' => 'Full Name',
                'email' => 'Email Address',
                'phone' => 'Phone Number',
                'position_applying' => 'Position Applying For',
                'select_position' => 'Select a position',
                'cover_letter' => 'Cover Letter',
                'resume' => 'Resume/CV',
                'upload_resume' => 'Click to upload or drag and drop',
                'file_hint' => 'PDF, DOC, DOCX (Max 5MB)',
                'submit_application' => 'Submit Application',
                'faq' => 'Frequently Asked Questions',
                'faq_process' => 'What is the hiring process?',
                'faq_process_answer' => 'Our typical hiring process includes: 1) Application review, 2) Initial phone screening, 3) Technical/panel interview, 4) Final interview with leadership, 5) Offer and onboarding.',
                'faq_remote' => 'Do you offer remote work?',
                'faq_remote_answer' => 'Yes! We offer flexible work arrangements including remote, hybrid, and on-site options depending on the role.',
                'faq_benefits' => 'What benefits do you offer?',
                'faq_benefits_answer' => 'We offer competitive salaries, health insurance, paid time off, professional development opportunities, and flexible working hours.',
                'faq_status' => 'How can I check my application status?',
                'faq_status_answer' => 'After submitting your application, you\'ll receive a confirmation email. Our team reviews applications within 1-2 weeks.',
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
                'join_team' => 'የቬንዶራ ቡድንን ይቀላቀሉ',
                'help_connect' => 'በመላው ኢትዮጵያ ማህበረሰቦችን ከታመኑ የአካባቢ ነጋዴዎች ጋር ለማገናኘት ይረዱን',
                'why_join' => 'ለምን ቬንዶራን ይቀላቀላሉ?',
                'purpose_driven' => 'ዓላማ-ተኮር ስራ',
                'purpose_desc' => 'የአካባቢ ንግዶች እንዲበለጽጉ በመርዳት እና ማህበረሰቦች እንዲገናኙ በማድረግ እውነተኛ ተፅእኖ ይፍጠሩ።',
                'great_culture' => 'ታላቅ የቡድን ባህል',
                'culture_desc' => 'ከሚያልፉ ፣ ደጋፊ የስራ ባልደረቦች ጋር ይስሩ።',
                'growth_opp' => 'የእድገት እድሎች',
                'growth_desc' => 'ቀጣይነት ያለው ትምህርት እና ግልጽ የሙያ እድገት መንገዶች።',
                'benefits' => 'ተወዳዳሪ ጥቅማጥቅሞች',
                'benefits_desc' => 'የጤና መድን፣ ተጣጣፊ ሰዓቶች እና ተወዳዳሪ ካሳ።',
                'open_positions' => 'ክፍት የስራ ቦታዎች',
                'requirements' => 'መስፈርቶች',
                'apply_now' => 'አሁን ያመልክቱ',
                'application_form' => 'የማመልከቻ ቅጽ',
                'full_name' => 'ሙሉ ስም',
                'email' => 'ኢሜይል አድራሻ',
                'phone' => 'ስልክ ቁጥር',
                'position_applying' => 'የሚያመለክቱት ቦታ',
                'select_position' => 'ቦታ ይምረጡ',
                'cover_letter' => 'አብሮ የሚላክ ደብዳቤ',
                'resume' => 'ሲቪ / የስራ ልምድ ማስረጃ',
                'upload_resume' => 'ለመጫን ጠቅ ያድርጉ ወይም ጎትተው ይጣሉ',
                'file_hint' => 'PDF, DOC, DOCX (ከፍተኛ 5ሜጋባይት)',
                'submit_application' => 'ማመልከቻ ያስገቡ',
                'faq' => 'በተደጋጋሚ የሚጠየቁ ጥያቄዎች',
                'faq_process' => 'የቅጥር ሂደቱ እንዴት ነው?',
                'faq_process_answer' => 'የእኛ የተለመደ የቅጥር ሂደት፡- 1) ማመልከቻ መገምገም፣ 2) የመጀመሪያ ደረጃ የስልክ ቃለመጠይቅ፣ 3) ቴክኒካል/ፓናል ቃለመጠይቅ፣ 4) ከአመራር ጋር የመጨረሻ ቃለመጠይቅ፣ 5) ቅናሽ እና ማስተዋወቅ።',
                'faq_remote' => 'የርቀት ስራ ታቀርባላችሁ?',
                'faq_remote_answer' => 'አዎ! እንደ ሚናው የርቀት፣ ድብልቅ እና በቦታው ላይ አማራጮችን ጨምሮ ተጣጣፊ የስራ ዝግጅቶችን እናቀርባለን።',
                'faq_benefits' => 'ምን ጥቅማጥቅሞች ታቀርባላችሁ?',
                'faq_benefits_answer' => 'ተወዳዳሪ ደሞዝ፣ የጤና መድህን፣ የሚከፈልበት እረፍት፣ የሙያ እድገት እድሎች እና ተጣጣፊ የስራ ሰዓቶችን እናቀርባለን።',
                'faq_status' => 'የማመልከቻዬን ሁኔታ እንዴት ማየት እችላለሁ?',
                'faq_status_answer' => 'ማመልከቻዎን ካስገቡ በኋላ የማረጋገጫ ኢሜይል ይደርስዎታል። የእኛ ቡድን ማመልከቻዎችን በ1-2 ሳምንታት ውስጥ ይገመግማል።',
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
                'join_team' => 'Garee Vendoraa wajjin hojjedhu',
                'help_connect' => 'Naannoo Itoophiyaa keessatti hawaasota fi daldaltoota naannoo wal qunnamsiisuuf nu gargaari',
                'why_join' => 'Maaliif Vendora hordofuu qabda?',
                'purpose_driven' => 'Kaayyoo Qabeessaa Hojii',
                'purpose_desc' => 'Daldaltoota naannoo akka badhaadhaniif hawaasotni akka wal qunnaman gargaaruun dhiibbaa dhugaa uumi.',
                'great_culture' => 'Aadaa Garee Gaarii',
                'culture_desc' => 'Hojjetaa kakaasaa, gargaaraa wajjin hojjedhu.',
                'growth_opp' => 'Carraa Guddinaa',
                'growth_desc' => 'Barachuu itti fufuuf karoora guddinaa ifa ta\'e.',
                'benefits' => 'Bu\'aa Dorgommii',
                'benefits_desc' => 'Ittisa fayyaa, sa\'aatii jijjiiramaa fi mindaa dorgommii.',
                'open_positions' => 'Bakka Hoji Bahoo',
                'requirements' => 'Barbaachisoo',
                'apply_now' => 'Amma iyyadhu',
                'application_form' => 'Unka Iyyannaa',
                'full_name' => 'Maqaa Guutuu',
                'email' => 'Teessoo Imeelii',
                'phone' => 'Lakkoofsa Bilbilaa',
                'position_applying' => 'Bakka Iyyannaa',
                'select_position' => 'Bakka filadhu',
                'cover_letter' => 'Xalayaa Hordofsiisaa',
                'resume' => 'Iyyannaa/Kaadhimamoo',
                'upload_resume' => 'Fe\'uuf cuqaasi ykn harkisiitii gadi dhiisi',
                'file_hint' => 'PDF, DOC, DOCX (Hanga 5MB)',
                'submit_application' => 'Iyyannoo galchii',
                'faq' => 'Gaaffiiwwan Yeroo Baay\'ee Gaafataman',
                'faq_process' => 'Adeemsa kijibsiisaa maali?',
                'faq_process_answer' => 'Adeemsi keenya: 1) Iyyannoo ilaaluu, 2) Bilbilaan gaafachuu, 3) Gaaffiiwwan ogummaa, 4) Gaaffiiwwan xumuraa, 5) Kennuu fi galumsa.',
                'faq_remote' => 'Hoji fagoo ni kennituu?',
                'faq_remote_answer' => 'Eeyyee! Hoji fagoo, makaa fi iddoo jiru filannoowwan kennina.',
                'faq_benefits' => 'Bu\'aa maalii kennitu?',
                'faq_benefits_answer' => 'Mindaa dorgommii, ittisa fayyaa, yeroo boqonnaa kaffalamu, carraa guddinaa fi sa\'aatii hojii jijjiiramaa kennina.',
                'faq_status' => 'Haala iyyannoo koo akkamitti ilaala?',
                'faq_status_answer' => 'Erga iyyannoo keessan galchitanii booda, imeelii mirkaneessaa ni argattu. Gareen keenya iyyannoo torban 1-2 keessatti ilaala.',
            ],
        ];

        $t = $translations[$currentLang] ?? $translations['en'];

        // Check if positions exist and is iterable
        $hasPositions = isset($positions) && $positions instanceof \Illuminate\Support\Collection && $positions->count() > 0;
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
            <a href="{{ route('careers') }}" class="nav-item" style="color: var(--primary-color);">{{ $t['careers'] }}</a>

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
        <a href="{{ route('careers') }}" class="nav-item" style="color: var(--primary-color);">{{ $t['careers'] }}</a>

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
        <h1>{{ $t['join_team'] }}</h1>
        <p>{{ $t['help_connect'] }}</p>
    </section>

    <main>
        <div class="container">
            <!-- Why Join Us Section -->
            <section class="why-join">
                <h2 class="section-title">{{ $t['why_join'] }}</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-heart-line"></i>
                        </div>
                        <h3>{{ $t['purpose_driven'] }}</h3>
                        <p>{{ $t['purpose_desc'] }}</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-team-line"></i>
                        </div>
                        <h3>{{ $t['great_culture'] }}</h3>
                        <p>{{ $t['culture_desc'] }}</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                        <h3>{{ $t['growth_opp'] }}</h3>
                        <p>{{ $t['growth_desc'] }}</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="ri-hand-heart-line"></i>
                        </div>
                        <h3>{{ $t['benefits'] }}</h3>
                        <p>{{ $t['benefits_desc'] }}</p>
                    </div>
                </div>
            </section>

            <!-- Open Positions -->
            <section class="positions-section">
                <h2 class="section-title">{{ $t['open_positions'] }}</h2>
                <div class="positions-grid">
                    @if($hasPositions)
                        @foreach($positions as $position)
                        <div class="position-card" data-position-id="{{ $position->id }}">
                            <div class="position-header">
                                <h3 class="position-title">{{ $position->title }}</h3>
                                <span class="position-type">{{ $position->type }}</span>
                            </div>
                            <div class="position-location">
                                <i class="ri-map-pin-line"></i>
                                <span>{{ $position->location }}</span>
                            </div>
                            <p class="position-description">{{ $position->description }}</p>
                            <div class="position-requirements">
                                <div class="requirements-title">{{ $t['requirements'] }}:</div>
                                <ul class="requirements-list">
                                    @php
                                        $requirements = is_string($position->requirements)
                                            ? json_decode($position->requirements, true)
                                            : (is_array($position->requirements) ? $position->requirements : []);
                                    @endphp
                                    @foreach($requirements as $requirement)
                                    <li><i class="ri-check-line"></i> {{ $requirement }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="position-footer">
                                <span class="position-salary">{{ $position->salary }}</span>
                                <button class="apply-btn" onclick="setPosition({{ $position->id }}, '{{ $position->title }}', '{{ $position->type }}')">
                                    {{ $t['apply_now'] }} <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Fallback positions -->
                        <div class="position-card" data-position-id="1">
                            <div class="position-header">
                                <h3 class="position-title">Senior Full Stack Developer</h3>
                                <span class="position-type">Full-time</span>
                            </div>
                            <div class="position-location">
                                <i class="ri-map-pin-line"></i>
                                <span>Jimma / Remote</span>
                            </div>
                            <p class="position-description">
                                We're looking for an experienced Full Stack Developer to help build and scale our platform. You'll work on both frontend and backend, creating seamless experiences for vendors and customers.
                            </p>
                            <div class="position-requirements">
                                <div class="requirements-title">{{ $t['requirements'] }}:</div>
                                <ul class="requirements-list">
                                    <li><i class="ri-check-line"></i> 4+ years of experience with Laravel/PHP</li>
                                    <li><i class="ri-check-line"></i> Strong JavaScript/Vue.js skills</li>
                                    <li><i class="ri-check-line"></i> Experience with MySQL and database design</li>
                                    <li><i class="ri-check-line"></i> Familiarity with REST APIs and microservices</li>
                                </ul>
                            </div>
                            <div class="position-footer">
                                <span class="position-salary">Competitive Salary</span>
                                <button class="apply-btn" onclick="setPosition(1, 'Senior Full Stack Developer', 'Full-time')">
                                    {{ $t['apply_now'] }} <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="position-card" data-position-id="2">
                            <div class="position-header">
                                <h3 class="position-title">Community Manager</h3>
                                <span class="position-type">Full-time</span>
                            </div>
                            <div class="position-location">
                                <i class="ri-map-pin-line"></i>
                                <span>Jimma (On-site)</span>
                            </div>
                            <p class="position-description">
                                Join our team to build and nurture relationships with vendors and customers in Jimma and beyond. You'll be the face of Vendora in the community.
                            </p>
                            <div class="position-requirements">
                                <div class="requirements-title">{{ $t['requirements'] }}:</div>
                                <ul class="requirements-list">
                                    <li><i class="ri-check-line"></i> 2+ years in community management or similar</li>
                                    <li><i class="ri-check-line"></i> Excellent communication in Amharic and English</li>
                                    <li><i class="ri-check-line"></i> Experience with social media management</li>
                                    <li><i class="ri-check-line"></i> Passion for local business development</li>
                                </ul>
                            </div>
                            <div class="position-footer">
                                <span class="position-salary">Competitive Salary</span>
                                <button class="apply-btn" onclick="setPosition(2, 'Community Manager', 'Full-time')">
                                    {{ $t['apply_now'] }} <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="position-card" data-position-id="3">
                            <div class="position-header">
                                <h3 class="position-title">UI/UX Designer</h3>
                                <span class="position-type">Full-time</span>
                            </div>
                            <div class="position-location">
                                <i class="ri-map-pin-line"></i>
                                <span>Jimma / Remote</span>
                            </div>
                            <p class="position-description">
                                Design beautiful, intuitive experiences for our users. You'll work on both vendor and customer interfaces, making our platform easy and enjoyable to use.
                            </p>
                            <div class="position-requirements">
                                <div class="requirements-title">{{ $t['requirements'] }}:</div>
                                <ul class="requirements-list">
                                    <li><i class="ri-check-line"></i> 3+ years of UI/UX design experience</li>
                                    <li><i class="ri-check-line"></i> Proficiency in Figma, Adobe XD</li>
                                    <li><i class="ri-check-line"></i> Portfolio demonstrating user-centered design</li>
                                    <li><i class="ri-check-line"></i> Experience with mobile-first design</li>
                                </ul>
                            </div>
                            <div class="position-footer">
                                <span class="position-salary">Competitive Salary</span>
                                <button class="apply-btn" onclick="setPosition(3, 'UI/UX Designer', 'Full-time')">
                                    {{ $t['apply_now'] }} <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="position-card" data-position-id="4">
                            <div class="position-header">
                                <h3 class="position-title">Sales & Partnerships Lead</h3>
                                <span class="position-type">Full-time</span>
                            </div>
                            <div class="position-location">
                                <i class="ri-map-pin-line"></i>
                                <span>Jimma (On-site)</span>
                            </div>
                            <p class="position-description">
                                Drive our growth by building relationships with vendors and strategic partners across Ethiopia. You'll be key to expanding our vendor network.
                            </p>
                            <div class="position-requirements">
                                <div class="requirements-title">{{ $t['requirements'] }}:</div>
                                <ul class="requirements-list">
                                    <li><i class="ri-check-line"></i> 3+ years in sales or business development</li>
                                    <li><i class="ri-check-line"></i> Strong network in Ethiopian business community</li>
                                    <li><i class="ri-check-line"></i> Excellent negotiation and communication skills</li>
                                    <li><i class="ri-check-line"></i> Fluent in Amharic and English</li>
                                </ul>
                            </div>
                            <div class="position-footer">
                                <span class="position-salary">Competitive + Commission</span>
                                <button class="apply-btn" onclick="setPosition(4, 'Sales & Partnerships Lead', 'Full-time')">
                                    {{ $t['apply_now'] }} <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Application Form -->
            <section id="application-form" class="application-section">
                <div class="application-form">
                    <h2 class="form-title"><span>{{ $t['application_form'] }}</span></h2>

                    @if($errors->any())
                        <div class="alert alert-error" style="margin-bottom: 20px;">
                            <i class="ri-error-warning-line"></i>
                            <ul style="margin-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" id="applicationForm">
                        @csrf
                        <input type="hidden" name="position_id" id="position_id" value="{{ old('position_id') }}">
                        <input type="hidden" name="position_title" id="position_title" value="">
                        <input type="hidden" name="position_type" id="position_type" value="">

                        <div class="form-group">
                            <label class="form-label">{{ $t['full_name'] }} <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ $t['email'] }} <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ $t['phone'] }} <span class="required">*</span></label>
                            <input type="tel" name="phone" class="form-input @error('phone') error @enderror" value="{{ old('phone') }}" placeholder="+251 91 234 5678" required>
                            @error('phone')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ $t['position_applying'] }} <span class="required">*</span></label>
                            <select name="position" class="form-select @error('position') error @enderror" id="position_select" required>
                                <option value="">{{ $t['select_position'] }}</option>
                                @if($hasPositions)
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position') == $position->id ? 'selected' : '' }} data-type="{{ $position->type }}">{{ $position->title }}</option>
                                    @endforeach
                                @else
                                    <option value="1" {{ old('position') == '1' ? 'selected' : '' }} data-type="Full-time">Senior Full Stack Developer</option>
                                    <option value="2" {{ old('position') == '2' ? 'selected' : '' }} data-type="Full-time">Community Manager</option>
                                    <option value="3" {{ old('position') == '3' ? 'selected' : '' }} data-type="Full-time">UI/UX Designer</option>
                                    <option value="4" {{ old('position') == '4' ? 'selected' : '' }} data-type="Full-time">Sales & Partnerships Lead</option>
                                    <option value="5" {{ old('position') == '5' ? 'selected' : '' }} data-type="Open">Open Application</option>
                                @endif
                            </select>
                            @error('position')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ $t['cover_letter'] }}</label>
                            <textarea name="cover_letter" class="form-textarea @error('cover_letter') error @enderror" placeholder="{{ $t['cover_letter'] }}...">{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ $t['resume'] }} <span class="required">*</span></label>
                            <div class="file-upload-area @error('resume') error @enderror" id="fileUploadArea" onclick="document.getElementById('resume').click()">
                                <i class="ri-upload-cloud-2-line file-upload-icon"></i>
                                <div class="file-upload-text" id="uploadText">{{ $t['upload_resume'] }}</div>
                                <div class="file-upload-hint">{{ $t['file_hint'] }}</div>
                                <input type="file" id="resume" name="resume" class="file-input" accept=".pdf,.doc,.docx" required>
                            </div>
                            <div class="file-preview" id="filePreview">
                                <i class="ri-file-pdf-line"></i>
                                <div class="file-preview-info">
                                    <div class="file-preview-name" id="fileName"></div>
                                    <div class="file-preview-size" id="fileSize"></div>
                                </div>
                                <i class="ri-close-line file-preview-remove" onclick="clearFile()"></i>
                            </div>
                            @error('resume')
                                <div class="error-message"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn" id="submitBtn">
                            <i class="ri-send-plane-line"></i>
                            {{ $t['submit_application'] }}
                        </button>
                    </form>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="faq-section">
                <h2 class="section-title">{{ $t['faq'] }}</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>{{ $t['faq_process'] }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            {{ $t['faq_process_answer'] }}
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>{{ $t['faq_remote'] }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            {{ $t['faq_remote_answer'] }}
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>{{ $t['faq_benefits'] }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            {{ $t['faq_benefits_answer'] }}
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>{{ $t['faq_status'] }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="faq-answer">
                            {{ $t['faq_status_answer'] }}
                        </div>
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
                <p class="footer-text">{{ $t['help_connect'] }}</p>
                <div class="mt-4">
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

            // Set position from buttons
            window.setPosition = function(id, title, type) {
                document.getElementById('position_id').value = id;
                document.getElementById('position_title').value = title;
                document.getElementById('position_type').value = type;
                document.getElementById('position_select').value = id;

                document.getElementById('application-form').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            };

            // Update position select when dropdown changes
            document.getElementById('position_select')?.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('position_id').value = this.value;
                document.getElementById('position_title').value = selectedOption.text;
                document.getElementById('position_type').value = selectedOption.dataset.type || '';
            });

            // File upload preview
            const fileInput = document.getElementById('resume');
            const fileUploadArea = document.getElementById('fileUploadArea');
            const uploadText = document.getElementById('uploadText');
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                        if (!validTypes.includes(file.type)) {
                            alert('Please upload a PDF or Word document');
                            this.value = '';
                            return;
                        }

                        if (file.size > 5 * 1024 * 1024) {
                            alert('File size must be less than 5MB');
                            this.value = '';
                            return;
                        }

                        fileName.textContent = file.name;
                        fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                        filePreview.classList.add('active');
                        fileUploadArea.classList.add('has-file');
                        uploadText.textContent = 'File selected: ' + file.name;
                    }
                });
            }

            window.clearFile = function() {
                if (fileInput) fileInput.value = '';
                if (filePreview) filePreview.classList.remove('active');
                if (fileUploadArea) fileUploadArea.classList.remove('has-file');
                if (uploadText) uploadText.textContent = '{{ $t["upload_resume"] }}';
            };

            // FAQ toggle
            window.toggleFAQ = function(element) {
                element.classList.toggle('active');
                const answer = element.nextElementSibling;
                answer.classList.toggle('active');
            };

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

            // Form submission loading state
            const applicationForm = document.getElementById('applicationForm');
            const submitBtn = document.getElementById('submitBtn');

            if (applicationForm) {
                applicationForm.addEventListener('submit', function(e) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner"></span> {{ $t["submit_application"] }}...';
                });
            }

            // Rotating background images
            const heroBackground = document.querySelector('.hero-background');
            if (heroBackground) {
                const backgrounds = [
                    'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?q=80&w=2071&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=2068&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=2083&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop',
                ];

                setInterval(() => {
                    const randomIndex = Math.floor(Math.random() * backgrounds.length);
                    heroBackground.style.backgroundImage = `url('${backgrounds[randomIndex]}')`;
                }, 10000);
            }

            @if(old('position_id'))
                document.getElementById('position_id').value = '{{ old('position_id') }}';
                document.getElementById('position_select').value = '{{ old('position') }}';

                const select = document.getElementById('position_select');
                const selectedOption = select.options[select.selectedIndex];
                if (selectedOption) {
                    document.getElementById('position_title').value = selectedOption.text;
                    document.getElementById('position_type').value = selectedOption.dataset.type || '';
                }
            @endif
        });
    </script>
</body>
</html>
