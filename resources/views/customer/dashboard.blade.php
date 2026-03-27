<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Customer Dashboard | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Your personal dashboard on Vendora - Manage orders, follow vendors, and discover local products in Jimma, Ethiopia">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
            font-display: swap;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
            font-display: swap;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-dark: #8B6B2F;
            --primary-light: #E5D4B3;
            --primary-soft: rgba(184, 142, 63, 0.1);
            --sidebar-bg: #1a1f2e;
            --sidebar-dark: #0f1420;
            --sidebar-text: #a0a8b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #2d3348;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-soft: #94a3b8;
            --bg-body: #f1f5f9;
            --bg-soft: #f8fafc;
            --border-color: #e2e8f0;
            --border-soft: #edf2f7;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            --shadow-gold: 0 10px 25px -5px rgba(184, 142, 63, 0.3);
            --gradient-gold: linear-gradient(135deg, var(--primary-gold), var(--primary-dark));
            --gradient-sidebar: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-dark) 100%);
            --gradient-blue: linear-gradient(135deg, #3b82f6, #2563eb);
            --gradient-green: linear-gradient(135deg, #10b981, #059669);
            --gradient-yellow: linear-gradient(135deg, #f59e0b, #d97706);
            --gradient-purple: linear-gradient(135deg, #8b5cf6, #7c3aed);
            --gradient-red: linear-gradient(135deg, #ef4444, #dc2626);
            --success-light: #d1fae5;
            --success-dark: #065f46;
            --info-light: #dbeafe;
            --info-dark: #1e40af;
            --warning-light: #fef3c7;
            --warning-dark: #92400e;
            --danger-light: #fee2e2;
            --danger-dark: #991b1b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-body);
            background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.02) 0%, transparent 20%),
                              radial-gradient(circle at 90% 80%, rgba(184, 142, 63, 0.02) 0%, transparent 20%);
            color: var(--text-primary);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            line-height: 1.6;
            position: relative;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-soft);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 10px;
            transition: all 0.3s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--gradient-sidebar);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: var(--shadow-xl);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gold);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        .brand {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 26px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            letter-spacing: -0.5px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 32px;
            filter: drop-shadow(0 2px 4px rgba(184, 142, 63, 0.3));
            animation: gentlePulse 3s infinite;
        }

        @keyframes gentlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 32px;
        }

        .nav-label {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 12px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 15px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--gradient-gold);
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 2px 2px 0;
        }

        .nav-item:hover, .nav-item.active {
            background: linear-gradient(135deg, var(--sidebar-active-bg), rgba(184, 142, 63, 0.15));
            color: var(--sidebar-text-active);
            transform: translateX(4px);
            box-shadow: var(--shadow-md);
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-item i {
            margin-right: 14px;
            font-size: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover i {
            transform: scale(1.1) rotate(5deg);
            color: var(--primary-gold);
        }

        .badge-count {
            position: absolute;
            right: 16px;
            background: linear-gradient(135deg, var(--primary-gold), var(--primary-dark));
            color: white;
            font-size: 11px;
            font-weight: 700;
            min-width: 22px;
            height: 22px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-sm);
            animation: pulse 2s infinite;
        }

        .user-profile {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            position: sticky;
            bottom: 0;
        }

        .avatar {
            width: 52px;
            height: 52px;
            background: var(--gradient-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 16px;
            font-size: 20px;
            box-shadow: var(--shadow-lg);
            border: 3px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transition: all 0.3s;
        }

        .avatar:hover {
            transform: scale(1.05);
            border-color: var(--primary-gold);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info h4 {
            color: white;
            font-size: 16px;
            margin-bottom: 4px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Top Header */
        .top-header {
            height: 70px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .top-header { padding: 0 20px; }
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: background 0.2s;
            position: relative;
            text-decoration: none;
            font-size: 20px;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        .icon-btn .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 20px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 20px 16px;
            }
        }

        /* Welcome Banner */
        .welcome-banner {
            background: var(--gradient-gold);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            animation: slideInDown 0.8s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s infinite;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(10px, -10px) rotate(120deg); }
            66% { transform: translate(-10px, 10px) rotate(240deg); }
        }

        .welcome-text {
            position: relative;
            z-index: 1;
        }

        .welcome-text h2 {
            font-size: 32px;
            margin-bottom: 12px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .welcome-text p {
            opacity: 0.95;
            font-size: 18px;
            font-weight: 500;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .welcome-stats {
            display: flex;
            gap: 48px;
            position: relative;
            z-index: 1;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 4px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        @media (max-width: 768px) {
            .welcome-banner {
                padding: 30px;
                text-align: center;
                justify-content: center;
            }
            .welcome-text h2 {
                font-size: 24px;
            }
            .welcome-text p {
                font-size: 16px;
            }
            .welcome-stats {
                gap: 30px;
            }
            .stat-number {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .welcome-stats {
                flex-direction: column;
                gap: 16px;
                width: 100%;
            }
            .stat {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 0;
                border-bottom: 1px solid rgba(255,255,255,0.2);
            }
            .stat:last-child {
                border-bottom: none;
            }
            .stat-number {
                margin-bottom: 0;
            }
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
            animation-fill-mode: both;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-gold);
            transform: scaleX(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: left;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-gold);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            position: relative;
            transition: all 0.3s;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-details {
            flex: 1;
        }

        .stat-value {
            font-size: 34px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 15px;
            font-weight: 600;
        }

        /* Section Title */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-title h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            position: relative;
            padding-bottom: 8px;
        }

        .section-title h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-gold);
            border-radius: 3px;
        }

        .view-all {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            padding: 8px 16px;
            border-radius: 30px;
            background: var(--primary-soft);
        }

        .view-all:hover {
            background: var(--primary-gold);
            color: white;
            transform: translateX(4px);
            gap: 10px;
        }

        /* Following Grid */
        .following-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        @media (max-width: 1200px) {
            .following-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .following-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .following-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .vendor-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            position: relative;
            animation: fadeInUp 0.6s ease;
            animation-fill-mode: both;
        }

        .vendor-card:nth-child(1) { animation-delay: 0.1s; }
        .vendor-card:nth-child(2) { animation-delay: 0.2s; }
        .vendor-card:nth-child(3) { animation-delay: 0.3s; }
        .vendor-card:nth-child(4) { animation-delay: 0.4s; }

        .vendor-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-gold);
        }

        .vendor-image {
            height: 160px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .vendor-image img.vendor-banner {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vendor-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.35) 100%);
            z-index: 1;
        }

        .vendor-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            position: absolute;
            bottom: -40px;
            left: 24px;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary-gold);
            font-weight: 800;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            z-index: 2;
            transition: all 0.3s;
        }

        .vendor-card:hover .vendor-logo {
            transform: scale(1.05) rotate(5deg);
            border-color: var(--primary-gold);
        }

        .vendor-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .vendor-info {
            padding: 52px 24px 24px;
        }

        .vendor-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-primary);
        }

        .vendor-category {
            color: var(--text-secondary);
            font-size: 15px;
            margin-bottom: 20px;
            font-weight: 500;
            display: inline-block;
            padding: 4px 12px;
            background: var(--primary-soft);
            border-radius: 30px;
        }

        .vendor-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 14px;
            background: var(--primary-soft);
            padding: 4px 12px;
            border-radius: 30px;
        }

        .vendor-rating i {
            color: var(--primary-gold);
        }

        .vendor-products {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
        }

        /* Recent Orders Table */
        .table-container {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 32px;
            box-shadow: var(--shadow-md);
            overflow-x: auto;
            margin-bottom: 40px;
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease 0.5s both;
        }

        @media (max-width: 768px) {
            .table-container {
                padding: 20px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        @media (max-width: 900px) {
            table {
                min-width: 700px;
            }
        }

        th {
            text-align: left;
            padding: 16px 20px;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
            background: var(--bg-soft);
            white-space: nowrap;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 15px;
            color: var(--text-primary);
            font-weight: 500;
            white-space: nowrap;
        }

        tr {
            transition: all 0.3s;
        }

        tr:hover td {
            background: var(--primary-soft);
            transform: scale(1.01);
            box-shadow: var(--shadow-sm);
        }

        .order-status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            min-width: 100px;
            text-align: center;
        }

        .status-pending { 
            background: linear-gradient(135deg, #fef3c7, #fde68a); 
            color: #92400e;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);
        }
        .status-processing { 
            background: linear-gradient(135deg, #dbeafe, #bfdbfe); 
            color: #1e40af;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        }
        .status-completed { 
            background: linear-gradient(135deg, #d1fae5, #a7f3d0); 
            color: #065f46;
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
        }
        .status-cancelled { 
            background: linear-gradient(135deg, #fee2e2, #fecaca); 
            color: #991b1b;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
        }

        .vendor-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .vendor-thumb {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--gradient-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: 700;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.3s;
        }

        tr:hover .vendor-thumb {
            transform: scale(1.1) rotate(5deg);
        }

        .vendor-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-small {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
            background: var(--bg-soft);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-small:hover {
            background: var(--gradient-gold);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Recommended Vendors */
        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        @media (max-width: 1400px) {
            .recommended-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 1000px) {
            .recommended-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 600px) {
            .recommended-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 380px) {
            .recommended-grid {
                grid-template-columns: 1fr;
            }
        }

        .recommended-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease;
            animation-fill-mode: both;
        }

        .recommended-card:nth-child(1) { animation-delay: 0.1s; }
        .recommended-card:nth-child(2) { animation-delay: 0.2s; }
        .recommended-card:nth-child(3) { animation-delay: 0.3s; }
        .recommended-card:nth-child(4) { animation-delay: 0.4s; }
        .recommended-card:nth-child(5) { animation-delay: 0.5s; }
        .recommended-card:nth-child(6) { animation-delay: 0.6s; }

        .recommended-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-gold);
        }

        .recommended-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--gradient-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto 16px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: all 0.3s;
            border: 3px solid transparent;
        }

        .recommended-card:hover .recommended-avatar {
            transform: scale(1.1) rotate(5deg);
            border-color: var(--primary-gold);
        }

        .recommended-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .recommended-name {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 6px;
            color: var(--text-primary);
        }

        .recommended-category {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            padding: 4px 10px;
            background: var(--primary-soft);
            border-radius: 30px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease;
        }

        .empty-icon {
            font-size: 100px;
            color: var(--text-soft);
            margin-bottom: 24px;
            opacity: 0.6;
            animation: float 3s infinite;
        }

        .empty-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 32px;
            font-size: 16px;
            font-weight: 500;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Buttons */
        .btn {
            padding: 14px 32px;
            border-radius: 40px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .btn-primary {
            background: var(--gradient-gold);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .btn-secondary {
            background: var(--bg-soft);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            background: white;
        }

        /* Logout Button */
        .logout-btn {
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            width: 100%;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            transform: translateX(4px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .pagination-item {
            padding: 10px 16px;
            border: 2px solid var(--border-color);
            border-radius: 30px;
            background: var(--card-bg);
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 44px;
            text-align: center;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .pagination-item.active {
            background: var(--gradient-gold);
            color: white;
            border-color: transparent;
            box-shadow: var(--shadow-md);
        }

        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 32px;
            height: 32px;
            border: 3px solid var(--border-color);
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Skeleton Loading */
        .skeleton {
            background: linear-gradient(90deg, 
                var(--bg-soft) 25%, 
                var(--border-color) 50%, 
                var(--bg-soft) 75%
            );
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Tooltips */
        [data-tooltip] {
            position: relative;
            cursor: help;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 8px 12px;
            background: var(--text-primary);
            color: white;
            font-size: 12px;
            font-weight: 500;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-8px);
        }

        /* Color Utilities */
        .bg-blue-gradient { background: var(--gradient-blue); }
        .bg-green-gradient { background: var(--gradient-green); }
        .bg-yellow-gradient { background: var(--gradient-yellow); }
        .bg-purple-gradient { background: var(--gradient-purple); }
        .bg-red-gradient { background: var(--gradient-red); }
        
        .bg-blue-light { background: linear-gradient(135deg, #eff6ff, #dbeafe); color: #3b82f6; }
        .bg-green-light { background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #10b981; }
        .bg-yellow-light { background: linear-gradient(135deg, #fffbeb, #fef3c7); color: #f59e0b; }
        .bg-purple-light { background: linear-gradient(135deg, #f5f3ff, #ede9fe); color: #8b5cf6; }
        .bg-red-light { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #ef4444; }
        .bg-gold-light { background: linear-gradient(135deg, #fef3e7, #fed7aa); color: var(--primary-gold); }

        /* Responsive Table */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            table {
                min-width: 700px;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .top-header, .btn, .view-all, .pagination {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .dashboard-container {
                padding: 20px;
            }
            .stat-card, .vendor-card, .table-container {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            :root {
                --primary-gold: #b88e3f;
                --text-primary: #000000;
                --text-secondary: #333333;
                --border-color: #000000;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN MENU</div>
                <a href="{{ route('customer.dashboard') }}" class="nav-item active">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('search.results') }}" class="nav-item">
                    <i class="ri-search-line"></i> Discover
                </a>
                <a href="{{ route('customer.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> My Orders
                    @if(isset($recentOrders) && $recentOrders->count() > 0)
                        <span class="badge-count">{{ $recentOrders->count() }}</span>
                    @endif
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SHOPPING</div>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item">
                    <i class="ri-heart-3-line"></i> Wishlist
                </a>
                <a href="{{ route('customer.following') }}" class="nav-item">
                    <i class="ri-store-line"></i> Following
                    @if(isset($followingCount) && $followingCount > 0)
                        <span class="badge-count">{{ $followingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> My Coupons
                </a>
                <a href="{{ route('customer.cart.index') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Cart
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="badge-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('customer.profile') }}" class="nav-item">
                    <i class="ri-user-line"></i> My Profile
                </a>
                <a href="{{ route('customer.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Customer since {{ Auth::user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-dashboard-line" style="color: var(--primary-gold);"></i> My Dashboard
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('customer.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-text">
                    <h2>Welcome back, {{ Auth::user()->name ?? 'Customer' }}! 👋</h2>
                    <p>Discover new vendors and products tailored just for you in Jimma</p>
                </div>
                <div class="welcome-stats">
                    <div class="stat">
                        <div class="stat-number">{{ $followingCount ?? 0 }}</div>
                        <div class="stat-label">Following</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">{{ isset($recentOrders) ? $recentOrders->count() : 0 }}</div>
                        <div class="stat-label">Orders</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-store-2-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $followingCount ?? 0 }}</div>
                        <div class="stat-label">Vendors Followed</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ isset($recentOrders) ? $recentOrders->count() : 0 }}</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-heart-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ Auth::user() ? (Auth::user()->wishlists()->count() ?? 0) : 0 }}</div>
                        <div class="stat-label">Wishlist Items</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-star-smile-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ Auth::user() ? (Auth::user()->reviews()->count() ?? 0) : 0 }}</div>
                        <div class="stat-label">Reviews</div>
                    </div>
                </div>
            </div>

            <!-- Vendors You Follow -->
            <div class="section-title">
                <h3>Vendors You Follow</h3>
                <a href="{{ route('customer.following') }}" class="view-all">
                    View All <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>

            @if(isset($following) && $following->count() > 0)
                <div class="following-grid">
                    @foreach($following as $vendor)
                        <a href="{{ route('vendor.show', $vendor->id) }}" class="vendor-card">
                            <div class="vendor-image">
                                @if($vendor->banner_url)
                                    <img src="{{ $vendor->banner_url }}" alt="{{ $vendor->business_name ?? $vendor->name }} banner" class="vendor-banner" loading="lazy">
                                @endif
                                <div class="vendor-logo">
                                    <img src="{{ $vendor->avatar_url }}" alt="{{ $vendor->business_name ?? $vendor->name }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                </div>
                            </div>
                            <div class="vendor-info">
                                <div class="vendor-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                                <div class="vendor-category">{{ $vendor->category ?? 'General Store' }}</div>
                                <div class="vendor-meta">
                                    <div class="vendor-rating">
                                        <i class="ri-star-fill"></i> 
                                        {{ number_format($vendor->rating ?? 4.5, 1) }}
                                    </div>
                                    <div class="vendor-products">
                                        <i class="ri-store-2-line"></i> 
                                        {{ $vendor->products_count ?? 0 }} products
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($following, 'links'))
                    <div class="pagination">
                        {{ $following->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="ri-heart-3-line empty-icon"></i>
                    <h3 class="empty-title">No vendors followed yet</h3>
                    <p class="empty-text">Start following vendors to see their products and updates here</p>
                    <a href="{{ route('search.results') }}" class="btn btn-primary">
                        <i class="ri-search-line"></i> Discover Vendors
                    </a>
                </div>
            @endif

            <!-- Recent Orders -->
            <div class="section-title" style="margin-top: 48px;">
                <h3>Recent Orders</h3>
                <a href="{{ route('customer.orders') }}" class="view-all">
                    View All <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Vendor</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td><strong>#{{ $order->order_number ?? $order->id }}</strong></td>
                                <td>
                                    <div class="vendor-cell">
                                        <div class="vendor-thumb">
                                            <img src="{{ $order->vendor?->avatar_url ?? 'https://ui-avatars.com/api/?name=V&background=B88E3F&color=fff&size=80' }}"
                                                 alt="{{ $order->vendor->business_name ?? 'Vendor' }}" loading="lazy"
                                                 style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">{{ $order->vendor->business_name ?? $order->vendor->name ?? 'Unknown Vendor' }}</div>
                                            <div style="font-size: 13px; color: var(--text-secondary);">{{ $order->items->count() ?? 0 }} items</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->created_at ? $order->created_at->format('M d, Y') : date('M d, Y') }}</td>
                                <td><strong>{{ number_format($order->total_amount ?? 0, 2) }} ETB</strong></td>
                                <td>
                                    <span class="order-status status-{{ strtolower($order->status ?? 'pending') }}">
                                        {{ ucfirst($order->status ?? 'Pending') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-small">
                                        <i class="ri-eye-line"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 60px;">
                                    <i class="ri-shopping-cart-line" style="font-size: 48px; color: var(--text-secondary); margin-bottom: 16px; display: block;"></i>
                                    <p style="color: var(--text-secondary); margin-bottom: 20px; font-size: 16px;">No orders yet</p>
                                    <a href="{{ route('search.results') }}" class="btn btn-primary">
                                        <i class="ri-search-line"></i> Start Shopping
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Recommended Vendors -->
            <div class="section-title">
                <h3>Recommended for You</h3>
                <a href="{{ route('search.results') }}" class="view-all">
                    View All <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>

            <div class="recommended-grid">
                @forelse($recommendedVendors as $vendor)
                    <a href="{{ route('vendor.show', $vendor->id) }}" class="recommended-card">
                        <div class="recommended-avatar">
                            <img src="{{ $vendor->avatar_url }}" alt="{{ $vendor->business_name ?? $vendor->name }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        </div>
                        <div class="recommended-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                        <div class="recommended-category">{{ $vendor->category ?? 'General Store' }}</div>
                    </a>
                @empty
                    <p style="color:var(--text-secondary);grid-column:1/-1;text-align:center;padding:2rem;">
                        No recommendations yet. <a href="{{ route('search.results') }}" style="color:var(--primary-gold);">Explore vendors</a>
                    </p>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle with improved functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const body = document.body;

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('active');
                    
                    // Change icon based on state
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = sidebar.classList.contains('active') ? 'ri-close-line' : 'ri-menu-line';
                    }

                    // Prevent body scroll when sidebar is open on mobile
                    if (window.innerWidth <= 1024) {
                        body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
                    }
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 1024) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && sidebar.classList.contains('active')) {
                            sidebar.classList.remove('active');
                            const icon = menuToggle.querySelector('i');
                            if (icon) icon.className = 'ri-menu-line';
                            body.style.overflow = '';
                        }
                    }
                });

                // Handle escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });

                // Close sidebar on window resize if open
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 1024 && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                        const icon = menuToggle.querySelector('i');
                        if (icon) icon.className = 'ri-menu-line';
                        body.style.overflow = '';
                    }
                });
            }

            // Confirm logout with better UX
            document.querySelectorAll('.logout-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to logout from Vendora?')) {
                        e.preventDefault();
                    }
                });
            });

            // Enhanced search with debounce
            const searchInput = document.querySelector('.search-bar input');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        if (this.value.length >= 3) {
                            this.closest('form').submit();
                        }
                    }, 500);
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.closest('form').submit();
                    }
                });
            }

            // Add loading state to buttons
            document.querySelectorAll('.btn, .btn-small').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (this.href && !this.href.includes('#') && !this.href.includes('javascript')) {
                        if (!confirm('Proceed with this action?')) {
                            e.preventDefault();
                        } else {
                            this.classList.add('loading');
                        }
                    }
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Animate stats on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stat-card, .vendor-card, .recommended-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // Add tooltips dynamically
            document.querySelectorAll('[data-tooltip]').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.textContent = el.dataset.tooltip;
                    document.body.appendChild(tooltip);
                    
                    const rect = el.getBoundingClientRect();
                    tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
                    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                    
                    setTimeout(() => tooltip.remove(), 3000);
                });
            });

            // Handle notifications badge click
            document.querySelectorAll('.icon-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const badge = this.querySelector('.badge-count');
                    if (badge && badge.textContent !== '0') {
                        // Optional: mark as read logic here
                    }
                });
            });

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + K to focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    searchInput?.focus();
                }
                
                // Escape to clear search
                if (e.key === 'Escape' && searchInput === document.activeElement) {
                    searchInput.blur();
                }
            });

            // Performance: lazy load images
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));

            // Handle offline/online status
            window.addEventListener('online', function() {
                showNotification('You are back online!', 'success');
            });

            window.addEventListener('offline', function() {
                showNotification('You are offline. Some features may be unavailable.', 'warning');
            });

            // Simple notification function
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.textContent = message;
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 16px 24px;
                    background: ${type === 'success' ? '#10b981' : '#f59e0b'};
                    color: white;
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 9999;
                    animation: slideIn 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });

        // Add to homescreen prompt for mobile (optional)
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            // You can show a custom install prompt here
        });

        // Service worker registration (if you have one)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(err => {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }

        // Performance monitoring
        window.addEventListener('load', () => {
            if (window.performance) {
                const perfData = window.performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                console.log(`Page load time: ${pageLoadTime}ms`);
            }
        });

        // Add CSS animations for notifications
        const style = document.createElement('style');
        style.textContent = `
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
        `;
        document.head.appendChild(style);
    </script>

    @if(app()->environment('local'))
        <!-- Development environment indicator -->
        <div style="position: fixed; bottom: 10px; right: 10px; background: #FFD700; color: #000; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; opacity: 0.5; z-index: 9999;">
            DEV MODE
        </div>
    @endif
</body>
</html>