<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Products Management - Vendora Admin | Jimma, Ethiopia</title>
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
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
            background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.02) 0%, transparent 20%),
                              radial-gradient(circle at 90% 80%, rgba(184, 142, 63, 0.02) 0%, transparent 20%);
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
            box-shadow: var(--shadow-xl);
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
            width: calc(100% - 32px);
            margin: 8px 16px 16px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
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
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .breadcrumb a:hover {
            color: var(--primary-gold);
            background: var(--primary-soft);
        }

        .breadcrumb i {
            font-size: 12px;
            color: var(--text-soft);
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

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-primary);
        }

        .page-header h1 i {
            color: var(--primary-gold);
            background: var(--primary-soft);
            padding: 10px;
            border-radius: 14px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Buttons */
        .btn {
            padding: 14px 28px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            background: var(--primary-bg);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-1px);
            background: white;
        }

        /* Filters */
        .filters-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            margin-bottom: 32px;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-weight: 600;
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-group label i {
            color: var(--primary-gold);
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            background: white;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .filter-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 16px;
            padding-right: 48px;
        }

        .filter-actions {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .filter-actions .btn {
            padding: 14px 24px;
        }

        /* Table Container */
        .table-container {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
            overflow-x: auto;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
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

        .results-info i {
            color: var(--primary-gold);
        }

        .results-info strong {
            color: var(--primary-gold);
            font-weight: 700;
            background: white;
            padding: 4px 10px;
            border-radius: 30px;
            margin: 0 2px;
            box-shadow: var(--shadow-sm);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
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
            white-space: nowrap;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid var(--border-soft);
            font-size: 14px;
            color: var(--text-primary);
            white-space: nowrap;
        }

        tr {
            transition: all 0.3s;
        }

        tr:hover td {
            background: var(--primary-soft);
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .product-image {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary-soft), var(--border-soft));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-soft);
            font-size: 24px;
            box-shadow: var(--shadow-md);
            border: 2px solid white;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .product-name {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 15px;
        }

        .product-sku {
            font-size: 11px;
            color: var(--text-soft);
        }

        .badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-sm);
        }

        .badge-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .badge-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .badge-warning {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .badge-info {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
            background: var(--primary-bg);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .action-btn-view:hover {
            background: var(--accent-blue);
            color: white;
            border-color: transparent;
        }

        .action-btn-edit:hover {
            background: var(--accent-yellow);
            color: white;
            border-color: transparent;
        }

        .action-btn-delete:hover {
            background: var(--accent-red);
            color: white;
            border-color: transparent;
        }

        /* Enhanced Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid var(--border-color);
            flex-wrap: wrap;
            gap: 20px;
        }

        .pagination-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-secondary);
            font-size: 14px;
            padding: 8px 20px;
            background: var(--primary-soft);
            border-radius: 40px;
        }

        .pagination-info i {
            color: var(--primary-gold);
            font-size: 18px;
        }

        .pagination-info strong {
            color: var(--primary-gold);
            font-weight: 700;
            background: white;
            padding: 4px 10px;
            border-radius: 30px;
            margin: 0 2px;
            box-shadow: var(--shadow-sm);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination-item {
            min-width: 44px;
            height: 44px;
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
            padding: 0 16px;
        }

        .pagination-item i {
            font-size: 20px;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
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
            padding: 0 8px;
            font-size: 18px;
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

        .alert i {
            font-size: 24px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--card-bg);
            border-radius: 20px;
            border: 2px dashed var(--border-color);
        }

        .empty-icon {
            font-size: 80px;
            color: var(--text-soft);
            margin-bottom: 24px;
            opacity: 0.5;
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
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .page-header h1 {
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
                min-width: 38px;
                height: 38px;
                font-size: 13px;
                padding: 0 10px;
            }
            .filter-row {
                grid-template-columns: 1fr;
            }
            .filter-actions {
                flex-direction: column;
            }
            .filter-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 20px 12px;
            }
            .table-container {
                padding: 20px;
            }
            .results-info {
                width: 100%;
                justify-content: center;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .top-header, .filters-card, .btn, .action-buttons, .pagination-wrapper {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            table {
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
                <a href="{{ route('admin.products') }}" class="nav-item active">
                    <i class="ri-shopping-cart-line"></i> Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
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
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>Products</span>
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
                    <i class="ri-message-3-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Container -->
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

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>
                        <i class="ri-shopping-cart-line"></i>
                        Products Management
                    </h1>
                    <p>Manage and organize your product catalog</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="ri-add-line"></i> Add New Product
                </a>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <form method="GET" action="{{ route('admin.products') }}">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label><i class="ri-search-line"></i> Search</label>
                            <input type="text" name="search" placeholder="Search by product name, SKU..." value="{{ request('search') }}">
                        </div>

                        <div class="filter-group">
                            <label><i class="ri-price-tag-3-line"></i> Category</label>
                            <select name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label><i class="ri-store-line"></i> Vendor</label>
                            <select name="vendor">
                                <option value="">All Vendors</option>
                                @foreach($vendors as $v)
                                    <option value="{{ $v->id }}" {{ request('vendor') == $v->id ? 'selected' : '' }}>
                                        {{ $v->business_name ?? $v->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label><i class="ri-toggle-line"></i> Status</label>
                            <select name="status">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-filter-line"></i> Apply Filters
                            </button>
                            @if(request()->anyFilled(['search', 'category', 'vendor', 'status']))
                                <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                                    <i class="ri-close-line"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="ri-shopping-cart-line"></i>
                        Products List
                    </h3>
                    @if($products->count() > 0)
                    <div class="results-info">
                        <i class="ri-file-list-line"></i>
                        Showing <strong>{{ $products->firstItem() }}</strong> - <strong>{{ $products->lastItem() }}</strong> 
                        of <strong>{{ $products->total() }}</strong> products
                    </div>
                    @endif
                </div>

                @if($products->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Vendor</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    <div class="product-image">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <i class="ri-image-line"></i>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $product->name }}</span>
                                        @if($product->sku)
                                            <span class="product-sku">SKU: {{ $product->sku }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $product->category->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span style="font-weight: 500;">{{ $product->vendor->business_name ?? $product->vendor->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($product->price, 2) }} ETB</strong>
                                @if($product->sale_price)
                                    <br><span style="font-size: 11px; color: var(--accent-red); text-decoration: line-through;">{{ number_format($product->sale_price, 2) }} ETB</span>
                                @endif
                            </td>
                            <td>
                                @if($product->stock > 20)
                                    <span class="badge badge-success">{{ $product->stock }} units</span>
                                @elseif($product->stock > 0)
                                    <span class="badge badge-warning">{{ $product->stock }} units</span>
                                @else
                                    <span class="badge badge-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="action-btn action-btn-view" title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn action-btn-edit" title="Edit Product">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn action-btn-delete" title="Delete Product">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Enhanced Pagination -->
                @if(method_exists($products, 'links') && $products->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <i class="ri-file-list-line"></i>
                        Showing <strong>{{ $products->firstItem() }}</strong> - <strong>{{ $products->lastItem() }}</strong> 
                        of <strong>{{ $products->total() }}</strong> results
                    </div>

                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        @if($products->onFirstPage())
                            <span class="pagination-item disabled">
                                <i class="ri-arrow-left-s-line"></i>
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="pagination-item">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <span class="pagination-item active">{{ $page }}</span>
                            @elseif($page == 1 || $page == $products->lastPage() || abs($page - $products->currentPage()) <= 2)
                                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                            @elseif($page == 2 || $page == $products->lastPage() - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="pagination-item">
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

                @else
                <div class="empty-state">
                    <i class="ri-shopping-cart-line empty-icon"></i>
                    <h3 class="empty-title">No products found</h3>
                    <p class="empty-text">Try adjusting your filters or add a new product to get started</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> Add New Product
                    </a>
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

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Add keyboard shortcut for search (Ctrl+K)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('input[name="search"]')?.focus();
            }
        });
    </script>

  
</body>
</html>