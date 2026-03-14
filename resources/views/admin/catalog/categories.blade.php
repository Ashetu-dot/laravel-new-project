<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Categories Management - Vendora Admin | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --primary-bg: #f3f4f6;
            --sidebar-bg: #1f2937;
            --sidebar-text: #9ca3af;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #374151;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-soft: #9ca3af;
            --border-color: #e5e7eb;
            --border-soft: #f3f4f6;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --primary-soft: rgba(184, 142, 63, 0.1);
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-blue: #3b82f6;
            --accent-yellow: #f59e0b;
            --accent-purple: #8b5cf6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-gold: 0 4px 12px rgba(184, 142, 63, 0.2);
            --gradient-gold: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-hover));
            --gradient-ethiopia: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--border-soft);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gold-hover);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #111827 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
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
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 32px;
            filter: drop-shadow(0 2px 4px rgba(184, 142, 63, 0.3));
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: var(--gradient-ethiopia);
            color: white;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
            box-shadow: var(--shadow-sm);
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 28px;
        }

        .nav-label {
            color: #6b7280;
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
            padding: 12px 16px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
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
            width: 3px;
            background: var(--gradient-gold);
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover, .nav-item.active {
            background: linear-gradient(135deg, var(--sidebar-active-bg), rgba(184, 142, 63, 0.1));
            color: var(--sidebar-text-active);
            transform: translateX(4px);
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .nav-item:hover i {
            transform: scale(1.1);
            color: var(--primary-gold);
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .avatar {
            width: 44px;
            height: 44px;
            background: var(--gradient-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
            font-size: 18px;
            box-shadow: var(--shadow-md);
            border: 2px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        /* Logout Button */
        .logout-btn {
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            width: 100%;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
            margin: 8px 16px 16px;
            width: calc(100% - 32px);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            transform: translateX(4px);
        }

        .logout-btn i {
            font-size: 20px;
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
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            background: var(--primary-bg);
            border: 1px solid var(--border-color);
        }

        .menu-toggle:hover {
            background: var(--primary-gold);
            color: white;
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: flex;
            }
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            width: 100%;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: var(--card-bg);
            padding: 10px 20px;
            border-radius: 40px;
            width: 400px;
            border: 2px solid transparent;
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .search-bar:focus-within {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
            transform: translateY(-1px);
            background: white;
        }

        .search-bar i {
            color: var(--text-secondary);
            margin-right: 10px;
            font-size: 18px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
        }

        .search-bar input::placeholder {
            color: var(--text-soft);
        }

        @media (max-width: 1200px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                width: 200px;
            }
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.3s;
            position: relative;
            text-decoration: none;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .icon-btn:hover {
            background: var(--gradient-gold);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
            border-color: transparent;
        }

        .badge-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, var(--accent-red), #dc2626);
            color: white;
            font-size: 10px;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 16px;
            }
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--primary-gold);
            background: var(--primary-soft);
            padding: 10px;
            border-radius: 14px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        .last-updated {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--primary-soft);
            border-radius: 40px;
            font-size: 13px;
            color: var(--primary-gold);
            font-weight: 500;
            border: 1px solid rgba(184, 142, 63, 0.2);
        }

        /* Alert Messages */
        .alert {
            padding: 16px 24px;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            border-left: 4px solid;
            box-shadow: var(--shadow-md);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #ecfdf5);
            color: #065f46;
            border-left-color: var(--accent-green);
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2, #fef2f2);
            color: #991b1b;
            border-left-color: var(--accent-red);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7, #fffbeb);
            color: #92400e;
            border-left-color: var(--accent-yellow);
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #1e40af;
            border-left-color: var(--accent-blue);
        }

        .alert i {
            font-size: 24px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: var(--card-bg);
            padding: 28px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
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
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-gold);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            transition: all 0.3s;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.2;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--gradient-gold);
            color: white;
            box-shadow: var(--shadow-gold);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 142, 63, 0.4);
        }

        .btn-secondary {
            background: var(--card-bg);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background: white;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            padding: 10px 20px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .quick-action-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: white;
        }

        .quick-action-btn.active {
            background: var(--gradient-gold);
            color: white;
            border-color: transparent;
            box-shadow: var(--shadow-gold);
        }

        /* Table */
        .table-container {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-title {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-primary);
        }

        .table-title i {
            color: var(--primary-gold);
            background: var(--primary-soft);
            padding: 8px;
            border-radius: 10px;
        }

        .results-info {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--primary-soft);
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            border: 1px solid rgba(184, 142, 63, 0.2);
        }

        .results-info strong {
            color: var(--primary-gold);
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
            background: var(--primary-bg);
        }

        td {
            padding: 20px;
            border-bottom: 1px solid var(--border-soft);
            font-size: 14px;
            color: var(--text-primary);
        }

        tr {
            transition: all 0.3s;
        }

        tr:hover td {
            background: var(--primary-soft);
        }

        .category-name {
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 600;
        }

        .category-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s;
        }

        tr:hover .category-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .category-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .category-id {
            font-size: 11px;
            color: var(--text-soft);
            font-weight: 400;
        }

        .child-categories {
            margin-left: 58px;
            margin-top: 10px;
            padding-left: 16px;
            border-left: 2px dashed var(--border-color);
        }

        .child-category-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 0;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .child-category-item i {
            color: var(--primary-gold);
            font-size: 14px;
        }

        .child-category-item span {
            flex: 1;
        }

        .child-category-item .product-count {
            color: var(--text-soft);
            font-size: 11px;
        }

        .more-categories {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 0;
            color: var(--primary-gold);
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-sm);
        }

        .status-active { 
            background: linear-gradient(135deg, #d1fae5, #a7f3d0); 
            color: #065f46;
        }
        .status-inactive { 
            background: linear-gradient(135deg, #fee2e2, #fecaca); 
            color: #991b1b;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 16px;
        }

        .action-btn:hover {
            background: var(--gradient-gold);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
        }

        .action-btn.delete:hover {
            background: linear-gradient(135deg, var(--accent-red), #dc2626);
        }

        /* Enhanced Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 20px;
        }

        .pagination-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .pagination-info i {
            color: var(--primary-gold);
            font-size: 20px;
        }

        .pagination-info strong {
            color: var(--primary-gold);
            font-weight: 700;
            background: var(--primary-soft);
            padding: 4px 10px;
            border-radius: 30px;
            margin: 0 2px;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pagination-item {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: var(--card-bg);
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            padding: 0 12px;
        }

        .pagination-item i {
            font-size: 18px;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: white;
        }

        .pagination-item.active {
            background: var(--gradient-gold);
            color: white;
            border-color: transparent;
            box-shadow: var(--shadow-gold);
        }

        .pagination-item.disabled {
            opacity: 0.5;
            pointer-events: none;
            background: var(--primary-bg);
        }

        .pagination-dots {
            color: var(--text-soft);
            font-weight: 600;
            padding: 0 4px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 80px;
            color: var(--text-soft);
            margin-bottom: 24px;
            opacity: 0.6;
            animation: float 3s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .empty-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 32px;
            font-size: 16px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .bg-blue-light { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .bg-green-light { background: linear-gradient(135deg, #10b981, #059669); }
        .bg-yellow-light { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .bg-purple-light { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .bg-red-light { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .bg-gold-light { background: linear-gradient(135deg, #B88E3F, #9c7832); }

        /* Responsive */
        @media (max-width: 640px) {
            .page-title {
                font-size: 24px;
            }
            .pagination-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }
            .pagination {
                width: 100%;
                justify-content: center;
            }
            .pagination-item {
                min-width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 20px 12px;
            }
            .quick-actions {
                flex-direction: column;
            }
            .quick-action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .top-header, .action-bar, .quick-actions, .btn, .action-buttons {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .table-container {
                box-shadow: none;
                border: 1px solid #ddd;
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
            <span class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma
            </span>
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">DASHBOARD</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-line"></i> Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-line"></i> Vendors
                </a>
                <a href="{{ route('admin.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item active">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i> Inventory
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MARKETING</div>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i> Promotions
                </a>
                <a href="{{ route('admin.coupons') }}" class="nav-item">
                    <i class="ri-coupon-line"></i> Coupons
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i> Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SYSTEM</div>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i> Administrators
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
                </a>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if(Auth::user() && Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                <p>{{ ucfirst(Auth::user()->role ?? 'administrator') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                <i class="ri-logout-box-line"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <form action="{{ route('admin.catalog.categories') }}" method="GET" style="width: 100%; display: flex;">
                        <input type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <!-- Alert Messages -->
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

            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="ri-alert-line"></i>
                    {{ session('warning') }}
                </div>
            @endif

            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        <i class="ri-price-tag-3-line"></i>
                        Categories Management
                    </h1>
                    <p class="page-subtitle">Organize products with categories and subcategories</p>
                </div>
                <div class="last-updated">
                    <i class="ri-time-line"></i>
                    Last updated: {{ now()->format('M d, Y H:i') }}
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Categories</div>
                        <div class="stat-number">{{ number_format($totalCategories ?? $categories->total() ?? 0) }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-price-tag-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Active Categories</div>
                        <div class="stat-number">{{ number_format($activeCategories ?? $categories->where('is_active', true)->count() ?? 0) }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-product-hunt-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Products</div>
                        <div class="stat-number">{{ number_format($totalProductsInCategories ?? $categories->sum('products_count') ?? 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <div>
                    <a href="{{ route('admin.catalog.categories.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> Add New Category
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('admin.catalog.categories') }}" class="quick-action-btn {{ !request('filter') ? 'active' : '' }}">
                    <i class="ri-list-check"></i> All Categories
                </a>
                <a href="{{ route('admin.catalog.categories') }}?filter=active" class="quick-action-btn {{ request('filter') == 'active' ? 'active' : '' }}">
                    <i class="ri-check-line"></i> Active Only
                </a>
                <a href="{{ route('admin.catalog.categories') }}?filter=inactive" class="quick-action-btn {{ request('filter') == 'inactive' ? 'active' : '' }}">
                    <i class="ri-close-line"></i> Inactive Only
                </a>
                <a href="{{ route('admin.catalog.categories') }}?filter=parent" class="quick-action-btn {{ request('filter') == 'parent' ? 'active' : '' }}">
                    <i class="ri-price-tag-line"></i> Parent Categories
                </a>
                <a href="{{ route('admin.catalog.categories') }}?filter=child" class="quick-action-btn {{ request('filter') == 'child' ? 'active' : '' }}">
                    <i class="ri-price-tag-2-line"></i> Subcategories
                </a>
                <a href="{{ route('admin.catalog.categories.export') }}" class="quick-action-btn">
                    <i class="ri-download-line"></i> Export
                </a>
            </div>

            <!-- Categories Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="ri-price-tag-3-line"></i>
                        Categories List
                    </h3>
                    <div class="results-info">
                        <i class="ri-file-list-line"></i>
                        Showing <strong>{{ $categories->firstItem() ?? 0 }}</strong> - <strong>{{ $categories->lastItem() ?? 0 }}</strong> 
                        of <strong>{{ $categories->total() ?? 0 }}</strong> categories
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Parent Category</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories ?? [] as $category)
                        <tr>
                            <td>
                                <div class="category-name">
                                    <div class="category-icon bg-gold-light">
                                        <i class="ri-price-tag-line"></i>
                                    </div>
                                    <div class="category-details">
                                        <span style="font-weight: 600;">{{ $category->name }}</span>
                                        <span class="category-id">ID: #{{ $category->id }}</span>
                                    </div>
                                </div>

                                <!-- Show child categories if any -->
                                @if($category->children && $category->children->count() > 0)
                                <div class="child-categories">
                                    @foreach($category->children->take(3) as $child)
                                    <div class="child-category-item">
                                        <i class="ri-price-tag-2-line"></i>
                                        <span>{{ $child->name }}</span>
                                        <span class="product-count">({{ $child->products_count ?? 0 }} products)</span>
                                    </div>
                                    @endforeach
                                    @if($category->children->count() > 3)
                                    <div class="more-categories">
                                        <i class="ri-more-line"></i>
                                        <span>+{{ $category->children->count() - 3 }} more subcategories</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                @if($category->parent_id)
                                    @php
                                        $parent = \App\Models\Category::find($category->parent_id);
                                    @endphp
                                    <span class="status-badge status-active" style="background-color: #e0f2fe; color: #0369a1;">
                                        {{ $parent->name ?? 'N/A' }}
                                    </span>
                                @else
                                    <span style="color: var(--text-secondary);">—</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-weight: 600;">{{ $category->products_count ?? 0 }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $category->is_active ? 'active' : 'inactive' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                @if($category->created_at)
                                    <div>{{ $category->created_at->format('M d, Y') }}</div>
                                    <div style="font-size: 11px; color: var(--text-secondary);">{{ $category->created_at->diffForHumans() }}</div>
                                @else
                                    <div>N/A</div>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.catalog.categories.edit', $category->id) }}" class="action-btn" title="Edit Category">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <a href="{{ route('admin.products') }}?category={{ $category->id }}" class="action-btn" title="View Products">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <form action="{{ route('admin.catalog.categories.toggle-status', $category->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn" title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="ri-{{ $category->is_active ? 'pause' : 'play' }}-line"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.catalog.categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category? This will affect all products in this category.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete Category">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 60px;">
                                <div class="empty-state">
                                    <i class="ri-price-tag-3-line empty-icon"></i>
                                    <h3 class="empty-title">No categories found</h3>
                                    <p class="empty-text">Get started by creating your first category to organize your products</p>
                                    <a href="{{ route('admin.catalog.categories.create') }}" class="btn btn-primary">
                                        <i class="ri-add-line"></i> Add New Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Enhanced Pagination -->
                @if(method_exists($categories, 'links') && $categories->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <i class="ri-file-list-line"></i>
                        Showing <strong>{{ $categories->firstItem() }}</strong> - <strong>{{ $categories->lastItem() }}</strong> 
                        of <strong>{{ $categories->total() }}</strong> results
                    </div>

                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        @if($categories->onFirstPage())
                            <span class="pagination-item disabled">
                                <i class="ri-arrow-left-s-line"></i>
                            </span>
                        @else
                            <a href="{{ $categories->previousPageUrl() }}" class="pagination-item">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            @if($page == $categories->currentPage())
                                <span class="pagination-item active">{{ $page }}</span>
                            @elseif($page == 1 || $page == $categories->lastPage() || abs($page - $categories->currentPage()) <= 2)
                                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                            @elseif($page == 2 || $page == $categories->lastPage() - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($categories->hasMorePages())
                            <a href="{{ $categories->nextPageUrl() }}" class="pagination-item">
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        @else
                            <span class="pagination-item disabled">
                                <i class="ri-arrow-right-s-line"></i>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Mobile menu toggle
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

            // Highlight quick action buttons based on current filter
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');
            if (filter) {
                document.querySelectorAll('.quick-action-btn').forEach(btn => {
                    if (btn.href.includes(`filter=${filter}`)) {
                        btn.classList.add('active');
                    }
                });
            }

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Confirm delete actions
            document.querySelectorAll('form[onsubmit]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to perform this action?')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Add keyboard shortcut for search (Ctrl+K)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('.search-bar input')?.focus();
            }
        });
    </script>

    @if(app()->environment('local'))
        <!-- Development environment indicator -->
        <div style="position: fixed; bottom: 10px; right: 10px; background: #FFD700; color: #000; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; opacity: 0.5; z-index: 9999;">
            DEV MODE
        </div>
    @endif
</body>
</html>