<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Messages | Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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
            --primary-hover: #9C762F;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-bg: #111827;
            --sidebar-bg: #1a1e2b;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #2d3348;
            --card-bg: #1f2937;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --primary-gold: #D4A55A;
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
            transition: background-color 0.3s, color 0.3s;
        }

        /* Sidebar - Matching Dashboard Style */
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
            transition: background-color 0.3s;
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
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            transition: background-color 0.3s;
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

        @media (max-width: 1024px) {
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
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        .badge-dot {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 8px;
            height: 8px;
            background-color: var(--accent-red);
            border-radius: 50%;
            border: 2px solid var(--card-bg);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 11px;
            font-weight: 600;
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
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            border-color: var(--text-primary);
            color: var(--text-primary);
        }

        .btn-danger {
            background-color: var(--accent-red);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Messages Layout */
        .messages-container {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            height: calc(100vh - 230px);
            min-height: 600px;
        }

        @media (max-width: 1024px) {
            .messages-container {
                grid-template-columns: 1fr;
                height: auto;
            }
        }

        /* Conversations List */
        .conversations-list {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border-color);
        }

        .conversations-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .conversations-header h2 {
            font-size: 16px;
            font-weight: 600;
        }

        .new-message-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-gold);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .new-message-btn:hover {
            background-color: #9c7832;
            transform: scale(1.05);
        }

        .conversations-search {
            padding: 12px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .conversations-search input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: var(--card-bg);
            color: var(--text-primary);
        }

        .conversations-search input:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .conversations {
            flex: 1;
            overflow-y: auto;
            max-height: calc(100vh - 380px);
        }

        .conversation-item {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .conversation-item:hover {
            background-color: var(--primary-bg);
        }

        .conversation-item.active {
            background-color: #fef3e7;
            border-left: 3px solid var(--primary-gold);
        }

        .conversation-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .conversation-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .online-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background-color: var(--accent-green);
            border-radius: 50%;
            border: 2px solid var(--card-bg);
        }

        .conversation-info {
            flex: 1;
            min-width: 0;
        }

        .conversation-name-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .conversation-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
        }

        .conversation-time {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .conversation-preview {
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .preview-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-badge {
            min-width: 20px;
            padding: 2px 6px;
            border-radius: 999px;
            background-color: var(--primary-gold);
            color: white;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        .no-conversations {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .no-conversations i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Message Area */
        .message-area {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .message-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .message-contact {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            overflow: hidden;
        }

        .contact-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .contact-info h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
            color: var(--text-primary);
        }

        .contact-info p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .message-actions {
            display: flex;
            gap: 8px;
        }

        .message-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border-color);
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .message-action-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
            border-color: var(--primary-gold);
        }

        .message-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-height: calc(100vh - 380px);
            background-color: var(--primary-bg);
        }

        .message-bubble {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            font-size: 14px;
            line-height: 1.5;
            word-wrap: break-word;
        }

        .message-bubble.sent {
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .message-bubble.received {
            background-color: var(--card-bg);
            color: var(--text-primary);
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            border: 1px solid var(--border-color);
        }

        .message-time {
            font-size: 10px;
            margin-top: 6px;
            opacity: 0.8;
            text-align: right;
        }

        .message-status {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            margin-left: 4px;
        }

        .message-input-area {
            padding: 16px 20px;
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 12px;
            align-items: flex-end;
            background-color: var(--card-bg);
        }

        .message-input-wrapper {
            flex: 1;
            position: relative;
        }

        .message-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 24px;
            font-size: 14px;
            outline: none;
            resize: none;
            max-height: 120px;
            min-height: 48px;
            background-color: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.2s;
        }

        .message-input:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .message-input:disabled {
            background-color: var(--primary-bg);
            cursor: not-allowed;
        }

        .send-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .send-btn:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .no-chat-selected {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: var(--text-secondary);
            gap: 16px;
            padding: 40px;
            text-align: center;
        }

        .no-chat-selected i {
            font-size: 64px;
            opacity: 0.5;
        }

        .no-chat-selected h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background-color: var(--primary-bg);
            color: var(--accent-red);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
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

        .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: var(--card-bg);
            color: var(--text-primary);
        }

        .form-select:focus, .form-textarea:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin: 16px 32px 0;
            display: flex;
            align-items: center;
            gap: 12px;
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
            border-left: 4px solid var(--accent-green);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--accent-red);
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--accent-yellow);
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--accent-blue);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 24px;
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

        /* Loading Spinner */
        .loading-spinner {
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Utility Classes */
        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }

        .text-center { text-align: center; }
        .mt-4 { margin-top: 16px; }
        .mb-4 { margin-bottom: 16px; }
        .w-100 { width: 100%; }

        /* Theme Toggle */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .theme-toggle:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--primary-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--text-secondary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gold);
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .action-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }
    </style>
</head>
<body>

    <!-- Sidebar - Matching Dashboard Style -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
            
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i>
                    Orders
                    @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i>
                    Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i>
                    Vendors
                    @if(isset($pendingVendorsCount) && $pendingVendorsCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-yellow); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $pendingVendorsCount }}</span>
                    @endif
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.catalog.products') }}" class="nav-item">
                    <i class="ri-shopping-cart-line"></i>
                    Products
                </a>
                <a href="{{ route('admin.catalog.categories') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i>
                    Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="nav-item">
                    <i class="ri-archive-line"></i>
                    Inventory
                </a>
                <a href="{{ route('admin.promotions.promotions') }}" class="nav-item">
                    <i class="ri-megaphone-line"></i>
                    Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i>
                    Analytics
                </a>
                <a href="{{ route('admin.reports') }}" class="nav-item">
                    <i class="ri-file-list-3-line"></i>
                    Reports
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ADMIN</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i>
                    Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i>
                    Administrators
                </a>
                <a href="{{ route('admin.support-tickets') }}" class="nav-item">
                    <i class="ri-customer-service-line"></i>
                    Support Tickets
                </a>
                <a href="{{ route('admin.video-tutorials') }}" class="nav-item">
                    <i class="ri-video-line"></i>
                    Video Tutorials
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i>
                    Help & Support
                </a>
                <a href="{{ route('admin.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i>
                    Notifications
                    @if(!empty($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="nav-item active">
                    <i class="ri-mail-line"></i>
                    Messages
                    @if(!empty($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span style="margin-left: auto; background-color: var(--accent-red); color: white; padding: 2px 8px; border-radius: 999px; font-size: 11px;">{{ $unreadMessagesCount > 9 ? '9+' : $unreadMessagesCount }}</span>
                    @endif
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                @if(!empty($user->avatar))
                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                @else
                    {{ substr($user->name ?? 'AD', 0, 2) }}
                @endif
            </div>
            <div class="user-info">
                <h4>{{ $user->name ?? 'Admin User' }}</h4>
                <p>{{ ucfirst($user->role ?? 'administrator') }}</p>
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
                    <input type="text" id="searchConversations" placeholder="Search conversations..." autocomplete="off">
                </div>
            </div>

            <div class="header-actions">
                <button class="theme-toggle" id="themeToggle">
                    <i class="ri-moon-line"></i>
                </button>
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(!empty($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn" style="background-color: var(--primary-bg); color: var(--primary-gold);">
                    <i class="ri-mail-line"></i>
                    @if(!empty($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount > 9 ? '9+' : $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

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

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Messages</h1>
                    <p class="page-subtitle">Communicate with vendors and customers from your admin panel</p>
                </div>
                <button class="btn btn-primary" onclick="openNewMessageModal()">
                    <i class="ri-mail-add-line"></i>
                    New Message
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('admin.customers') }}" class="action-btn">
                    <i class="ri-user-3-line"></i> View Customers
                </a>
                <a href="{{ route('admin.vendors') }}" class="action-btn">
                    <i class="ri-store-2-line"></i> View Vendors
                </a>
                <a href="{{ route('admin.support-tickets') }}" class="action-btn">
                    <i class="ri-customer-service-line"></i> Support Tickets
                </a>
            </div>

            @if(!empty($conversations) && count($conversations) > 0)
                @php 
                    $firstConversation = $conversations->first();
                    $firstOtherUser = $firstConversation->sender_id == $user->id ? $firstConversation->receiver : $firstConversation->sender;
                @endphp

                <div class="messages-container">
                    <!-- Conversations List -->
                    <div class="conversations-list">
                        <div class="conversations-header">
                            <h2>Conversations</h2>
                            <div class="new-message-btn" onclick="openNewMessageModal()">
                                <i class="ri-add-line"></i>
                            </div>
                        </div>
                        <div class="conversations-search">
                            <input type="text" id="conversationSearch" placeholder="Search by name..." autocomplete="off">
                        </div>
                        <div class="conversations" id="conversationsList">
                            @foreach($conversations as $conversation)
                                @php
                                    $otherUser = $conversation->sender_id == $user->id ? $conversation->receiver : $conversation->sender;
                                    $unreadCount = isset($conversation->unread_count) ? $conversation->unread_count : 0;
                                @endphp
                                <div class="conversation-item {{ $loop->first ? 'active' : '' }}"
                                     data-user-id="{{ $otherUser->id }}"
                                     data-user-name="{{ strtolower($otherUser->name) }}"
                                     onclick="loadConversation({{ $otherUser->id }})">
                                    <div class="conversation-avatar">
                                        @if(!empty($otherUser->avatar))
                                            <img src="{{ Storage::url($otherUser->avatar) }}" alt="{{ $otherUser->name }}">
                                        @else
                                            {{ strtoupper(substr($otherUser->name, 0, 2)) }}
                                        @endif
                                        @if($otherUser->is_online ?? false)
                                            <span class="online-indicator"></span>
                                        @endif
                                    </div>
                                    <div class="conversation-info">
                                        <div class="conversation-name-row">
                                            <span class="conversation-name">{{ $otherUser->name }}</span>
                                            <span class="conversation-time">
                                                {{ $conversation->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="conversation-preview">
                                            <span class="preview-text">
                                                @if($conversation->sender_id == $user->id)
                                                    <span style="color: var(--text-secondary);">You: </span>
                                                @endif
                                                {{ Str::limit($conversation->content, 30) }}
                                            </span>
                                            @if($unreadCount > 0)
                                                <span class="unread-badge">{{ $unreadCount }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Message Area -->
                    <div class="message-area" id="chatArea">
                        <div class="message-header" id="chatHeader">
                            <div class="message-contact">
                                <div class="contact-avatar" id="contactAvatar">
                                    @if(!empty($firstOtherUser->avatar))
                                        <img src="{{ Storage::url($firstOtherUser->avatar) }}" alt="{{ $firstOtherUser->name }}">
                                    @else
                                        {{ strtoupper(substr($firstOtherUser->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="contact-info">
                                    <h4 id="contactName">{{ $firstOtherUser->name }}</h4>
                                    <p id="contactStatus">{{ ucfirst($firstOtherUser->role ?? 'User') }} • Last seen {{ $firstOtherUser->last_login_at ? $firstOtherUser->last_login_at->diffForHumans() : 'recently' }}</p>
                                </div>
                            </div>
                            <div class="message-actions">
                                <button class="message-action-btn" onclick="refreshConversation()" title="Refresh">
                                    <i class="ri-refresh-line"></i>
                                </button>
                                <button class="message-action-btn" onclick="deleteConversation({{ $firstOtherUser->id }})" title="Delete conversation">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="message-body" id="messagesList">
                            @foreach($firstConversation->getConversationThread() as $message)
                                <div class="message-bubble {{ $message->sender_id == $user->id ? 'sent' : 'received' }}">
                                    <div>{{ $message->content }}</div>
                                    <div class="message-time">
                                        {{ $message->created_at->format('M d, Y h:i A') }}
                                        @if($message->sender_id == $user->id)
                                            <span class="message-status">
                                                @if($message->is_read)
                                                    <i class="ri-check-double-line" style="color: var(--accent-blue);" title="Read"></i>
                                                @else
                                                    <i class="ri-check-line" title="Sent"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="message-input-area">
                            <div class="message-input-wrapper">
                                <textarea
                                    class="message-input"
                                    id="messageInput"
                                    rows="1"
                                    placeholder="Type your message..."
                                    oninput="autoResize(this)"
                                    onkeydown="handleKeyPress(event, {{ $firstOtherUser->id }})"
                                ></textarea>
                            </div>
                            <button class="send-btn" id="sendBtn" onclick="sendMessage({{ $firstOtherUser->id }})">
                                <i class="ri-send-plane-2-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="ri-mail-open-line empty-icon"></i>
                    <h3 class="empty-title">No Messages Yet</h3>
                    <p class="empty-text">
                        When vendors or customers contact you, their conversations will appear here.
                    </p>
                    <button class="btn btn-primary" onclick="openNewMessageModal()">
                        <i class="ri-mail-add-line"></i>
                        Start a Conversation
                    </button>
                </div>
            @endif
        </div>
    </main>

    <!-- New Message Modal -->
    <div class="modal" id="newMessageModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>New Message</h2>
                <button class="modal-close" onclick="closeModal('newMessageModal')">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Select Recipient</label>
                    <select id="receiverSelect" class="form-select">
                        <option value="">Choose a user...</option>
                        @foreach($users as $recipient)
                            <option value="{{ $recipient->id }}">{{ $recipient->name }} ({{ ucfirst($recipient->role) }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea id="newMessageContent" class="form-textarea" placeholder="Type your message..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('newMessageModal')">Cancel</button>
                <button class="btn btn-primary" onclick="sendNewMessage()">Send Message</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Conversation</h2>
                <button class="modal-close" onclick="closeModal('deleteModal')">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this conversation? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentUserId = {{ $firstOtherUser->id ?? 'null' }};
        let deleteUserId = null;
        let messagePollingInterval = null;
        const SEND_MESSAGE_URL = '{{ route("admin.messages.send") }}';
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme') || 'light';
        
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="ri-sun-line"></i>';
        }
        
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            
            if (isDark) {
                localStorage.setItem('theme', 'dark');
                themeToggle.innerHTML = '<i class="ri-sun-line"></i>';
            } else {
                localStorage.setItem('theme', 'light');
                themeToggle.innerHTML = '<i class="ri-moon-line"></i>';
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

                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                    }
                });
            }

            // Search conversations
            const searchInput = document.getElementById('searchConversations');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    document.querySelectorAll('.conversation-item').forEach(item => {
                        const name = item.getAttribute('data-user-name') || '';
                        const preview = item.querySelector('.preview-text')?.textContent.toLowerCase() || '';
                        item.style.display = (name.includes(term) || preview.includes(term)) ? 'flex' : 'none';
                    });
                });
            }

            // Conversation search inside the list
            const conversationSearch = document.getElementById('conversationSearch');
            if (conversationSearch) {
                conversationSearch.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    document.querySelectorAll('#conversationsList .conversation-item').forEach(item => {
                        const name = item.getAttribute('data-user-name') || '';
                        item.style.display = name.includes(term) ? 'flex' : 'none';
                    });
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

            // Start polling for new messages if a conversation is selected
            if (currentUserId) {
                startMessagePolling();
            }
        });

        // Auto resize textarea
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }

        // Handle Enter key press
        function handleKeyPress(event, receiverId) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage(receiverId);
            }
        }

        // Scroll to bottom of messages
        function scrollToBottom() {
            const messagesList = document.getElementById('messagesList');
            if (messagesList) {
                messagesList.scrollTop = messagesList.scrollHeight;
            }
        }

        // Load conversation
        function loadConversation(userId) {
            currentUserId = userId;

            // Update active state
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.toggle('active', item.getAttribute('data-user-id') == userId);
            });

            const chatArea = document.getElementById('chatArea');
            if (!chatArea) return;

            // Show loading state
            chatArea.innerHTML = `
                <div class="no-chat-selected">
                    <i class="ri-loader-4-line ri-spin"></i>
                    <h3>Loading conversation...</h3>
                </div>
            `;

            // Stop existing polling
            if (messagePollingInterval) {
                clearInterval(messagePollingInterval);
            }

            fetch(`/admin/messages/conversation/${userId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderConversation(data.messages, data.other_user);
                    // Start polling for this conversation
                    startMessagePolling();
                } else {
                    alert('Failed to load conversation');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load conversation');
            });
        }

        // Render conversation
        function renderConversation(messages, otherUser) {
            const chatArea = document.getElementById('chatArea');
            
            let messagesHtml = '';
            messages.forEach(message => {
                const isMine = message.sender_id == {{ $user->id }};
                messagesHtml += `
                    <div class="message-bubble ${isMine ? 'sent' : 'received'}">
                        <div>${escapeHtml(message.content)}</div>
                        <div class="message-time">
                            ${new Date(message.created_at).toLocaleString('en-US', { 
                                month: 'short', 
                                day: 'numeric', 
                                year: 'numeric',
                                hour: 'numeric', 
                                minute: 'numeric',
                                hour12: true 
                            })}
                            ${isMine ? `
                                <span class="message-status">
                                    ${message.is_read ? 
                                        '<i class="ri-check-double-line" style="color: var(--accent-blue);" title="Read"></i>' : 
                                        '<i class="ri-check-line" title="Sent"></i>'
                                    }
                                </span>
                            ` : ''}
                        </div>
                    </div>
                `;
            });

            chatArea.innerHTML = `
                <div class="message-header">
                    <div class="message-contact">
                        <div class="contact-avatar">
                            ${otherUser.avatar ? 
                                `<img src="${otherUser.avatar}" alt="${otherUser.name}">` : 
                                otherUser.name.substring(0,2).toUpperCase()
                            }
                        </div>
                        <div class="contact-info">
                            <h4>${escapeHtml(otherUser.name)}</h4>
                            <p>${otherUser.role ? ucfirst(otherUser.role) : 'User'}</p>
                        </div>
                    </div>
                    <div class="message-actions">
                        <button class="message-action-btn" onclick="refreshConversation()" title="Refresh">
                            <i class="ri-refresh-line"></i>
                        </button>
                        <button class="message-action-btn" onclick="deleteConversation(${otherUser.id})" title="Delete conversation">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
                <div class="message-body" id="messagesList">
                    ${messagesHtml}
                </div>
                <div class="message-input-area">
                    <div class="message-input-wrapper">
                        <textarea
                            class="message-input"
                            id="messageInput"
                            rows="1"
                            placeholder="Type your message..."
                            oninput="autoResize(this)"
                            onkeydown="handleKeyPress(event, ${otherUser.id})"
                        ></textarea>
                    </div>
                    <button class="send-btn" onclick="sendMessage(${otherUser.id})">
                        <i class="ri-send-plane-2-fill"></i>
                    </button>
                </div>
            `;

            scrollToBottom();
        }

        // Escape HTML to prevent XSS
        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Capitalize first letter
        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Send message
        function sendMessage(receiverId) {
            const input = document.getElementById('messageInput');
            const content = input.value.trim();
            if (!content) return;

            const sendBtn = document.getElementById('sendBtn');
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<div class="loading-spinner"></div>';

            fetch(SEND_MESSAGE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    receiver_id: receiverId,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add message to chat
                    const messagesList = document.getElementById('messagesList');
                    messagesList.insertAdjacentHTML('beforeend', `
                        <div class="message-bubble sent">
                            <div>${escapeHtml(content)}</div>
                            <div class="message-time">
                                just now
                                <span class="message-status">
                                    <i class="ri-check-line" title="Sent"></i>
                                </span>
                            </div>
                        </div>
                    `);
                    
                    input.value = '';
                    autoResize(input);
                    scrollToBottom();
                    
                    // Update conversation preview
                    updateConversationPreview(receiverId, content);
                    
                    // Update unread count in sidebar
                    updateUnreadCount();
                } else {
                    alert(data.message || 'Failed to send message');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send message');
            })
            .finally(() => {
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="ri-send-plane-2-fill"></i>';
            });
        }

        // Send new message from modal
        function sendNewMessage() {
            const receiverId = document.getElementById('receiverSelect').value;
            const content = document.getElementById('newMessageContent').value.trim();

            if (!receiverId) {
                alert('Please select a recipient');
                return;
            }

            if (!content) {
                alert('Please enter a message');
                return;
            }

            const sendBtn = document.querySelector('#newMessageModal .btn-primary');
            const originalText = sendBtn.innerHTML;
            sendBtn.disabled = true;
            sendBtn.innerHTML = 'Sending...';

            fetch(SEND_MESSAGE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    receiver_id: receiverId,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('newMessageModal');
                    // Reload page to show new conversation
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to send message');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send message');
            })
            .finally(() => {
                sendBtn.disabled = false;
                sendBtn.innerHTML = originalText;
            });
        }

        // Update conversation preview
        function updateConversationPreview(userId, lastMessage) {
            const item = document.querySelector(`.conversation-item[data-user-id="${userId}"]`);
            if (!item) return;
            
            const preview = item.querySelector('.preview-text');
            if (preview) {
                const truncated = lastMessage.length > 30 ? lastMessage.substring(0, 30) + '…' : lastMessage;
                preview.innerHTML = `<span style="color: var(--text-secondary);">You: </span>${escapeHtml(truncated)}`;
            }
            
            // Move to top of list
            const list = document.getElementById('conversationsList');
            if (list && list.firstChild !== item) {
                list.insertBefore(item, list.firstChild);
            }
        }

        // Refresh current conversation
        function refreshConversation() {
            if (currentUserId) {
                loadConversation(currentUserId);
            }
        }

        // Delete conversation
        function deleteConversation(userId) {
            deleteUserId = userId;
            document.getElementById('deleteModal').classList.add('active');
            
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.onclick = function() {
                confirmDelete();
            };
        }

        function confirmDelete() {
            if (!deleteUserId) return;

            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const originalText = confirmBtn.innerHTML;
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = 'Deleting...';

            fetch(`/admin/messages/conversation/${deleteUserId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.messages) {
                    const deletePromises = data.messages.map(message => 
                        fetch(`/admin/messages/${message.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN,
                                'Accept': 'application/json'
                            }
                        })
                    );
                    
                    return Promise.all(deletePromises);
                }
            })
            .then(() => {
                closeModal('deleteModal');
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete conversation');
            })
            .finally(() => {
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = originalText;
            });
        }

        // Start polling for new messages
        function startMessagePolling() {
            if (messagePollingInterval) {
                clearInterval(messagePollingInterval);
            }
            
            messagePollingInterval = setInterval(() => {
                if (currentUserId) {
                    checkForNewMessages(currentUserId);
                }
            }, 5000); // Check every 5 seconds
        }

        // Check for new messages
        function checkForNewMessages(userId) {
            fetch(`/admin/messages/conversation/${userId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const messagesList = document.getElementById('messagesList');
                    if (!messagesList) return;
                    
                    const currentMessages = messagesList.children;
                    const newMessages = data.messages.slice(currentMessages.length);
                    
                    newMessages.forEach(message => {
                        const isMine = message.sender_id == {{ $user->id }};
                        messagesList.insertAdjacentHTML('beforeend', `
                            <div class="message-bubble ${isMine ? 'sent' : 'received'}">
                                <div>${escapeHtml(message.content)}</div>
                                <div class="message-time">
                                    ${new Date(message.created_at).toLocaleString()}
                                    ${isMine ? `
                                        <span class="message-status">
                                            ${message.is_read ? 
                                                '<i class="ri-check-double-line" style="color: var(--accent-blue);" title="Read"></i>' : 
                                                '<i class="ri-check-line" title="Sent"></i>'
                                            }
                                        </span>
                                    ` : ''}
                                </div>
                            </div>
                        `);
                    });
                    
                    if (newMessages.length > 0) {
                        scrollToBottom();
                        updateUnreadCount();
                    }
                }
            })
            .catch(error => console.error('Polling error:', error));
        }

        // Update unread count in sidebar
        function updateUnreadCount() {
            fetch('/admin/messages/unread/count', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const badges = document.querySelectorAll('.badge-count');
                    badges.forEach(badge => {
                        if (badge.closest('a[href*="messages"]')) {
                            if (data.count > 0) {
                                badge.textContent = data.count > 9 ? '9+' : data.count;
                                badge.style.display = 'flex';
                            } else {
                                badge.style.display = 'none';
                            }
                        }
                    });
                    
                    // Update sidebar badge
                    const sidebarBadge = document.querySelector('.nav-item.active span');
                    if (sidebarBadge) {
                        if (data.count > 0) {
                            sidebarBadge.textContent = data.count > 9 ? '9+' : data.count;
                            sidebarBadge.style.display = 'inline';
                        } else {
                            sidebarBadge.style.display = 'none';
                        }
                    }
                }
            })
            .catch(error => console.error('Error updating unread count:', error));
        }

        // Modal functions
        function openNewMessageModal() {
            document.getElementById('newMessageModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal.active').forEach(modal => {
                    modal.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>