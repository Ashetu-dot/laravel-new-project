<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendor Dashboard - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* All your existing styles remain exactly the same */
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

        :root {
            --primary-bg: #f3f4f6;
            --sidebar-bg: #1f2937;
            --sidebar-text: #9ca3af;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #374151;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
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
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 24px;
            font-weight: 700;
            border-bottom: 1px solid #374151;
            letter-spacing: -0.5px;
        }

        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 28px;
        }

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

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .nav-label {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            font-size: 15px;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-active);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid #374151;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
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
            .menu-toggle {
                display: block;
            }
            .top-header {
                padding: 0 20px;
            }
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--primary-bg);
            padding: 8px 16px;
            border-radius: 8px;
            width: 400px;
        }

        .search-bar i {
            color: var(--text-secondary);
            margin-right: 8px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
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
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        .badge-count {
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
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .welcome-text h2 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .welcome-text p {
            opacity: 0.9;
            font-size: 16px;
        }

        .welcome-stats {
            display: flex;
            gap: 32px;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-details {
            flex: 1;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        .action-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: left;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .action-content h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .action-content p {
            color: var(--text-secondary);
            font-size: 13px;
        }

        /* Recent Followers */
        .followers-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .follower-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .follower-item:last-child {
            border-bottom: none;
        }

        .follower-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .follower-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .follower-details h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .follower-details p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .follower-time {
            color: var(--text-secondary);
            font-size: 13px;
        }

        /* Orders Section */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 32px 0 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .orders-header h3 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .order-filter-btn {
            padding: 6px 16px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            background: transparent;
            color: var(--text-secondary);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .order-filter-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .order-filter-btn.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .order-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 1024px) {
            .order-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .order-stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .order-stat-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .order-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .order-stat-info {
            flex: 1;
        }

        .order-stat-label {
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .order-stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Orders Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-shipped { background-color: #ede9fe; color: #6d28d9; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }

        .order-items-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .order-actions {
            display: flex;
            gap: 8px;
        }

        .order-action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .order-action-btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .order-action-btn-primary:hover {
            background-color: #9c7832;
        }

        .order-action-btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .order-action-btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .status-update-select {
            padding: 6px 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 12px;
            color: var(--text-primary);
            background-color: white;
            cursor: pointer;
        }

        .status-update-select:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            border-left: 4px solid var(--primary-gold);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            border-left-color: var(--success-color);
        }

        .toast-error {
            border-left-color: var(--accent-red);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-secondary);
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
        }

        .empty-icon {
            font-size: 48px;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .empty-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination-item {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
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
            gap: 8px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background-color: var(--card-bg);
            border-radius: 16px 16px 0 0;
            z-index: 10;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-secondary);
            transition: color 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .modal-close:hover {
            background-color: #f3f4f6;
            color: var(--accent-red);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            position: sticky;
            bottom: 0;
            background-color: var(--card-bg);
            border-radius: 0 0 16px 16px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-primary);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .file-upload-area:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
        }

        .file-upload-icon {
            font-size: 32px;
            color: var(--primary-gold);
            margin-bottom: 8px;
        }

        .file-upload-text {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .file-upload-hint {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .image-preview {
            display: none;
            margin-top: 16px;
            padding: 12px;
            background-color: #f9fafb;
            border-radius: 8px;
            align-items: center;
            gap: 12px;
        }

        .image-preview.active {
            display: flex;
        }

        .image-preview img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .preview-info {
            flex: 1;
        }

        .preview-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .preview-size {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
        
        /* Alert Styles */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .alert i {
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Action completed successfully!</div>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </button>
    </div>

    <!-- Add Product Modal -->
    <div class="modal-overlay" id="addProductModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2>
                    <i class="ri-add-circle-line" style="color: var(--primary-gold);"></i>
                    Add New Product
                </h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form id="addProductForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label class="form-label">Product Name <span style="color: var(--accent-red);">*</span></label>
                        <input type="text" id="productName" name="name" class="form-input" placeholder="e.g. Ethiopian Coffee, Traditional Dress..." required>
                        <div id="nameError" class="error-message"></div>
                    </div>

                    <!-- Category & Price -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Category <span style="color: var(--accent-red);">*</span></label>
                            <select id="productCategory" name="category_id" class="form-select" required>
                                <option value="">Select category</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div id="categoryError" class="error-message"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Price (ETB) <span style="color: var(--accent-red);">*</span></label>
                            <input type="number" id="productPrice" name="price" class="form-input" placeholder="e.g. 500" min="0" step="0.01" required>
                            <div id="priceError" class="error-message"></div>
                        </div>
                    </div>

                    <!-- Sale Price & Stock -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Sale Price (ETB)</label>
                            <input type="number" id="productSalePrice" name="sale_price" class="form-input" placeholder="e.g. 450" min="0" step="0.01">
                            <div class="form-hint">Leave empty if not on sale</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Stock Quantity <span style="color: var(--accent-red);">*</span></label>
                            <input type="number" id="productStock" name="stock" class="form-input" placeholder="e.g. 50" min="0" value="1" required>
                            <div class="form-hint">Leave 0 for out of stock</div>
                        </div>
                    </div>

                    <!-- SKU -->
                    <div class="form-group">
                        <label class="form-label">SKU (Optional)</label>
                        <input type="text" id="productSku" name="sku" class="form-input" placeholder="e.g. COF-001">
                        <div class="form-hint">Stock Keeping Unit - unique identifier</div>
                        <div id="skuError" class="error-message"></div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label class="form-label">Description <span style="color: var(--accent-red);">*</span></label>
                        <textarea id="productDescription" name="description" class="form-textarea" placeholder="Describe your product, its features, and what makes it special..." required maxlength="500"></textarea>
                        <div class="form-hint"><span id="charCount">0</span>/500 characters</div>
                        <div id="descriptionError" class="error-message"></div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div style="display: flex; align-items: center;">
                            <label class="toggle-switch" style="position: relative; display: inline-block; width: 52px; height: 28px; margin-right: 10px;">
                                <input type="checkbox" name="is_active" id="productStatus" value="1" checked style="opacity: 0; width: 0; height: 0;">
                                <span class="toggle-slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .3s; border-radius: 34px;"></span>
                            </label>
                            <span class="toggle-label" id="statusLabel">Active</span>
                        </div>
                        <div class="form-hint">Toggle to activate/deactivate product</div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-group">
                        <label class="form-label">Product Images</label>
                        <div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
                            <i class="ri-upload-cloud-2-line file-upload-icon"></i>
                            <div class="file-upload-text">Click to upload or drag and drop</div>
                            <div class="file-upload-hint">SVG, PNG, JPG or GIF (max. 5MB per image, up to 5 images)</div>
                            <input type="file" id="fileInput" name="images[]" style="display: none;" accept="image/*" multiple>
                        </div>
                        <div id="imagePreviewContainer" class="image-preview-container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 20px;"></div>
                        <div id="imagesError" class="error-message"></div>
                    </div>

                    <!-- Tags -->
                    <div class="form-group">
                        <label class="form-label">Tags</label>
                        <input type="text" id="productTags" name="tags" class="form-input" placeholder="e.g. coffee, traditional, gift">
                        <div class="form-hint">Separate tags with commas</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span id="submitText">Add Product</span>
                        <span id="submitSpinner" class="spinner" style="display: none;"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal-overlay" id="orderDetailsModal">
        <div class="modal-container" style="max-width: 800px;">
            <div class="modal-header">
                <h2>
                    <i class="ri-shopping-bag-3-line" style="color: var(--primary-gold);"></i>
                    Order Details
                </h2>
                <button class="modal-close" onclick="closeOrderModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                <!-- Order details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeOrderModal()">Close</button>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal-overlay" id="updateStatusModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2>
                    <i class="ri-refresh-line" style="color: var(--primary-gold);"></i>
                    Update Order Status
                </h2>
                <button class="modal-close" onclick="closeStatusModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="statusOrderId" name="order_id">

                    <div class="form-group">
                        <label class="form-label">Current Status</label>
                        <div id="currentStatusDisplay" class="form-input" style="background-color: #f9fafb;" readonly></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Status <span style="color: var(--accent-red);">*</span></label>
                        <select id="newOrderStatus" name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Notes (Optional)</label>
                        <textarea id="statusNotes" name="notes" class="form-textarea" placeholder="Add any notes about this status change..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeStatusModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitStatusUpdate()">Update Status</button>
            </div>
        </div>
    </div>

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
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item active">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.show', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-store-line"></i> My Store
                </a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">PRODUCTS</div>
                <button onclick="openModal()" class="nav-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                    <i class="ri-add-circle-line"></i> Add Product
                </button>
                <a href="{{ route('vendor.products.index') }}" class="nav-item">
                    <i class="ri-list-check"></i> Manage Products
                </a>
                <a href="{{ route('vendor.categories.index') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Sales Report
                </a>
                <a href="{{ route('vendor.store-views') }}" class="nav-item">
                    <i class="ri-eye-line"></i> Store Views
                </a>
                <a href="{{ route('vendor.reviews.index') }}" class="nav-item">
                    <i class="ri-star-line"></i> Reviews
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SETTINGS</div>
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('profile.edit', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->business_name ?? Auth::user()->name }}</h4>
                <p>Vendor since {{ Auth::user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" id="dashboardSearch" placeholder="Search orders by customer name or order ID...">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('vendor.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if($unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('vendor.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if($unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

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

            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-text">
                    <h2>Welcome back, {{ Auth::user()->business_name ?? Auth::user()->name }}! 👋</h2>
                    <p>Your store is performing well in Jimma. Here's your summary.</p>
                </div>
                <div class="welcome-stats">
                    <div class="stat">
                        <div class="stat-number">{{ $followersCount }}</div>
                        <div class="stat-label">Followers</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">{{ $productsCount }}</div>
                        <div class="stat-label">Products</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-eye-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ number_format($storeViews) }}</div>
                        <div class="stat-label">Store Views</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-label">Orders</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">ETB {{ number_format($totalRevenue) }}</div>
                        <div class="stat-label">Revenue</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-star-line"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">{{ number_format($averageRating, 1) }}</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <button onclick="openModal()" class="action-card">
                    <div class="action-icon bg-green-light">
                        <i class="ri-add-line"></i>
                    </div>
                    <div class="action-content">
                        <h4>Add Product</h4>
                        <p>List a new product</p>
                    </div>
                </button>

                <a href="{{ route('vendor.show', Auth::user()->id) }}" class="action-card">
                    <div class="action-icon bg-blue-light">
                        <i class="ri-store-line"></i>
                    </div>
                    <div class="action-content">
                        <h4>View Store</h4>
                        <p>See your public store</p>
                    </div>
                </a>

                <a href="{{ route('vendor.products.index') }}" class="action-card">
                    <div class="action-icon bg-yellow-light">
                        <i class="ri-list-check"></i>
                    </div>
                    <div class="action-content">
                        <h4>Manage Products</h4>
                        <p>View all your products</p>
                    </div>
                </a>
            </div>

            <!-- Orders Section -->
            <div class="orders-header">
                <h3>
                    <i class="ri-shopping-bag-3-line" style="color: var(--primary-gold);"></i>
                    Recent Orders
                </h3>
                <div class="order-filters">
                    <button class="order-filter-btn active" onclick="filterOrders('all')">All</button>
                    <button class="order-filter-btn" onclick="filterOrders('pending')">Pending</button>
                    <button class="order-filter-btn" onclick="filterOrders('processing')">Processing</button>
                    <button class="order-filter-btn" onclick="filterOrders('completed')">Completed</button>
                </div>
            </div>

            <!-- Order Stats -->
            <div class="order-stats-grid">
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-blue-light">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Total Orders</div>
                        <div class="order-stat-value">{{ $totalOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-yellow-light">
                        <i class="ri-time-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Pending</div>
                        <div class="order-stat-value">{{ $pendingOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-purple-light">
                        <i class="ri-refresh-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Processing</div>
                        <div class="order-stat-value">{{ $processingOrders }}</div>
                    </div>
                </div>
                <div class="order-stat-card">
                    <div class="order-stat-icon bg-green-light">
                        <i class="ri-check-line"></i>
                    </div>
                    <div class="order-stat-info">
                        <div class="order-stat-label">Completed</div>
                        <div class="order-stat-value">{{ $completedOrders }}</div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-container">
                <table id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr class="order-row" data-status="{{ $order->status }}">
                            <td><strong>#{{ $order->order_number }}</strong></td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ substr($order->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">{{ $order->user->name }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $order->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 12px; color: var(--text-secondary);">{{ $order->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="order-items-preview">
                                    @foreach($order->items as $item)
                                        @if($item->product && $item->product->vendor_id == Auth::id())
                                            {{ $item->product->name }} x{{ $item->quantity }}{{ !$loop->last ? ', ' : '' }}
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td><strong>ETB {{ number_format($order->total_amount) }}</strong></td>
                            <td>
                                <span class="order-status status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn order-action-btn-secondary" onclick="viewOrderDetails('{{ $order->id }}')" title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <button class="order-action-btn order-action-btn-primary" onclick="updateOrderStatus('{{ $order->id }}', '{{ $order->status }}')" title="Update Status">
                                        <i class="ri-refresh-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px;">
                                <i class="ri-shopping-bag-3-line" style="font-size: 48px; color: var(--text-secondary);"></i>
                                <h3 style="margin-top: 16px;">No orders yet</h3>
                                <p style="color: var(--text-secondary);">When customers place orders, they will appear here.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

             <!-- Pagination -->
            @if($recentOrders->hasPages())
            <div class="pagination">
                {{ $recentOrders->links() }}
            </div>
            @endif  

            <!-- Recent Followers -->
            <div class="followers-section" style="margin-top: 40px;">
                <div class="section-header">
                    <h3>Recent Followers</h3>
                    <a href="#" class="btn btn-secondary">View All</a>
                </div>

                @if($recentFollowers->count() > 0)
                    @foreach($recentFollowers as $follower)
                    <div class="follower-item">
                        <div class="follower-info">
                            <div class="follower-avatar">
                                {{ substr($follower->name, 0, 2) }}
                            </div>
                            <div class="follower-details">
                                <h4>{{ $follower->name }}</h4>
                                <p>Member since {{ $follower->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                        <div class="follower-time">
                            {{ $follower->pivot->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="ri-user-unfollow-line empty-icon"></i>
                        <h4 class="empty-title">No followers yet</h4>
                        <p class="empty-text">Promote your store to start gaining followers</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // CSRF Token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Toast notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (type === 'success') {
                toastIcon.innerHTML = '<i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>';
                toast.classList.remove('toast-error');
                toast.classList.add('toast-success');
            } else {
                toastIcon.innerHTML = '<i class="ri-error-warning-line" style="color: var(--accent-red);"></i>';
                toast.classList.remove('toast-success');
                toast.classList.add('toast-error');
            }

            toast.classList.add('show');

            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Modal functions
        function openModal() {
            document.getElementById('addProductModal').classList.add('active');
            document.body.style.overflow = 'hidden';
            resetForm();
            
            // Load categories if needed
            loadCategories();
        }

        function closeModal() {
            document.getElementById('addProductModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        function closeOrderModal() {
            document.getElementById('orderDetailsModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        function closeStatusModal() {
            document.getElementById('updateStatusModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Load categories for dropdown
        function loadCategories() {
            const categorySelect = document.getElementById('productCategory');
            
            // Only load if empty
            if (categorySelect.options.length <= 1) {
                fetch('{{ route("vendor.categories.list") }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.categories) {
                            data.categories.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id;
                                option.textContent = category.name;
                                categorySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading categories:', error));
            }
        }

        // Close modal when clicking outside
        document.getElementById('addProductModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('orderDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        document.getElementById('updateStatusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeOrderModal();
                closeStatusModal();
            }
        });

        // Reset form
        function resetForm() {
            document.getElementById('addProductForm').reset();
            document.getElementById('imagePreviewContainer').innerHTML = '';
            document.getElementById('charCount').textContent = '0';
            document.getElementById('statusLabel').textContent = 'Active';

            // Clear error messages
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.remove('active');
                el.textContent = '';
            });
        }

        // Character counter for description
        document.getElementById('productDescription').addEventListener('input', function() {
            const count = this.value.length;
            document.getElementById('charCount').textContent = count;
        });

        // Toggle status label
        document.getElementById('productStatus').addEventListener('change', function() {
            document.getElementById('statusLabel').textContent = this.checked ? 'Active' : 'Inactive';
        });

        // File upload preview (multiple images)
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';

            const files = Array.from(e.target.files);

            if (files.length > 5) {
                showToast('Error', 'Maximum 5 images allowed', 'error');
                this.value = '';
                return;
            }

            files.forEach((file, index) => {
                if (file.size > 5 * 1024 * 1024) {
                    showToast('Error', `${file.name} exceeds 5MB`, 'error');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'image-preview-item';
                    previewItem.style.position = 'relative';
                    previewItem.style.borderRadius = '8px';
                    previewItem.style.overflow = 'hidden';
                    previewItem.style.aspectRatio = '1';
                    previewItem.style.border = '1px solid var(--border-color)';
                    
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" style="width: 100%; height: 100%; object-fit: cover;">
                        <button type="button" class="image-preview-remove" onclick="removeImage(${index})" style="position: absolute; top: 5px; right: 5px; width: 24px; height: 24px; border-radius: 50%; background-color: rgba(0,0,0,0.5); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-close-line"></i>
                        </button>
                    `;
                    container.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            });
        });

        // Form submission
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            document.getElementById('submitText').style.display = 'none';
            document.getElementById('submitSpinner').style.display = 'inline-block';
            document.getElementById('submitBtn').disabled = true;

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.remove('active');
                el.textContent = '';
            });

            const formData = new FormData(this);

            fetch('{{ route("vendor.products.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success!', data.message, 'success');
                    closeModal();

                    // Update products count in welcome banner
                    const productsCountElement = document.querySelector('.welcome-stats .stat:last-child .stat-number');
                    if (productsCountElement) {
                        const currentCount = parseInt(productsCountElement.textContent) || 0;
                        productsCountElement.textContent = currentCount + 1;
                    }

                    // Reload after 1.5 seconds to show new product
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast('Error', data.message || 'Failed to add product', 'error');
                }
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    // Validation errors
                    error.response.json().then(data => {
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(`${field}Error`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                                errorElement.classList.add('active');
                            } else {
                                // Try with field name variations
                                const fieldMap = {
                                    'category_id': 'categoryError',
                                    'sale_price': 'salePriceError',
                                    'is_active': 'statusError'
                                };
                                const errorId = fieldMap[field] || `${field}Error`;
                                const fallbackError = document.getElementById(errorId);
                                if (fallbackError) {
                                    fallbackError.textContent = data.errors[field][0];
                                    fallbackError.classList.add('active');
                                }
                            }
                        });
                        showToast('Validation Error', 'Please check the form fields', 'error');
                    });
                } else {
                    showToast('Error', 'An error occurred. Please try again.', 'error');
                }
            })
            .finally(() => {
                document.getElementById('submitText').style.display = 'inline';
                document.getElementById('submitSpinner').style.display = 'none';
                document.getElementById('submitBtn').disabled = false;
            });
        });

        // Function to remove image from preview
        function removeImage(index) {
            const dt = new DataTransfer();
            const fileInput = document.getElementById('fileInput');
            const files = Array.from(fileInput.files);
            
            files.splice(index, 1);
            
            files.forEach(file => {
                dt.items.add(file);
            });
            
            fileInput.files = dt.files;
            
            // Refresh preview
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = '';
            
            Array.from(fileInput.files).forEach((file, i) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'image-preview-item';
                    previewItem.style.position = 'relative';
                    previewItem.style.borderRadius = '8px';
                    previewItem.style.overflow = 'hidden';
                    previewItem.style.aspectRatio = '1';
                    previewItem.style.border = '1px solid var(--border-color)';
                    
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${i + 1}" style="width: 100%; height: 100%; object-fit: cover;">
                        <button type="button" class="image-preview-remove" onclick="removeImage(${i})" style="position: absolute; top: 5px; right: 5px; width: 24px; height: 24px; border-radius: 50%; background-color: rgba(0,0,0,0.5); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-close-line"></i>
                        </button>
                    `;
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        }

        // Order functions
        function filterOrders(status) {
            // Update active filter button
            document.querySelectorAll('.order-filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter table rows
            const rows = document.querySelectorAll('.order-row');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function viewOrderDetails(orderId) {
            fetch(`/vendor/orders/${orderId}`)
                .then(response => response.text())
                .then(html => {
                    // For now, we'll use a sample since we need to create the show view
                    const modalContent = document.getElementById('orderDetailsContent');
                    modalContent.innerHTML = `
                        <div style="margin-bottom: 24px;">
                            <h3 style="margin-bottom: 16px; font-size: 18px;">Order #${orderId}</h3>
                            <p>Loading order details...</p>
                        </div>
                    `;
                    document.getElementById('orderDetailsModal').classList.add('active');
                    document.body.style.overflow = 'hidden';
                })
                .catch(() => {
                    showToast('Error', 'Could not load order details', 'error');
                });
        }

        function updateOrderStatus(orderId, currentStatus) {
            document.getElementById('statusOrderId').value = orderId;
            document.getElementById('currentStatusDisplay').textContent = currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1);
            document.getElementById('newOrderStatus').value = currentStatus;
            document.getElementById('updateStatusModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function submitStatusUpdate() {
            const orderId = document.getElementById('statusOrderId').value;
            const newStatus = document.getElementById('newOrderStatus').value;
            const notes = document.getElementById('statusNotes').value;

            fetch(`/vendor/orders/${orderId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: newStatus,
                    notes: notes
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success!', `Order #${orderId} status updated to ${newStatus}`, 'success');
                    closeStatusModal();
                    
                    // Update the status in the table
                    const row = event.target.closest('tr');
                    if (row) {
                        const statusCell = row.querySelector('.order-status');
                        if (statusCell) {
                            statusCell.className = `order-status status-${newStatus}`;
                            statusCell.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                            row.dataset.status = newStatus;
                        }
                    }
                    
                    // Reload after 1 second to refresh data
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showToast('Error', data.message || 'Failed to update status', 'error');
                }
            })
            .catch(error => {
                showToast('Error', 'An error occurred. Please try again.', 'error');
            });
        }

        // Search functionality
        document.getElementById('dashboardSearch').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.order-row');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm) || searchTerm === '') {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>