<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Messages - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            max-width: 1920px;
            margin: 0 auto;
            width: 100%;
        }

        /* Sidebar styles */
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
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
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

        .logout-form {
            margin-top: 8px;
        }

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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
            height: 100vh;
        }

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

        /* Messages Container */
        .messages-container {
            display: flex;
            height: calc(100vh - 70px);
            overflow: hidden;
        }

        /* Conversations List */
        .conversations-list {
            width: 350px;
            background-color: var(--card-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .conversations-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .conversations-header h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 18px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary-gold);
        }

        .conversation-items {
            flex: 1;
            overflow-y: auto;
            padding: 12px;
        }

        .conversation-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 4px;
            position: relative;
        }

        .conversation-item:hover {
            background-color: #f9fafb;
        }

        .conversation-item.active {
            background-color: #fef3e7;
            border-left: 3px solid var(--primary-gold);
        }

        .conversation-avatar {
            position: relative;
        }

        .conversation-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        .online-indicator {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            background-color: var(--success-color);
            border: 2px solid white;
            border-radius: 50%;
        }

        .conversation-info {
            flex: 1;
            min-width: 0;
        }

        .conversation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .conversation-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--text-primary);
        }

        .conversation-time {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .conversation-preview {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-text {
            font-size: 13px;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .unread-badge {
            background-color: var(--primary-gold);
            color: white;
            font-size: 11px;
            font-weight: 600;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
        }

        /* Chat Area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #f9fafb;
            overflow: hidden;
        }

        .chat-header {
            padding: 20px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-user-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .chat-user-details p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .chat-actions {
            display: flex;
            gap: 8px;
        }

        .chat-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .chat-action-btn:hover {
            background-color: var(--primary-bg);
            color: var(--primary-gold);
        }

        /* Messages */
        .messages-list {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            max-width: 70%;
        }

        .message.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .message-content {
            background-color: var(--card-bg);
            padding: 12px 16px;
            border-radius: 18px;
            border-top-left-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .message.sent .message-content {
            background-color: var(--primary-gold);
            color: white;
            border-top-right-radius: 4px;
            border-top-left-radius: 18px;
        }

        .message-text {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .message-time {
            font-size: 10px;
            color: var(--text-secondary);
            text-align: right;
        }

        .message.sent .message-time {
            color: rgba(255,255,255,0.8);
        }

        .message-status {
            display: inline-block;
            margin-left: 4px;
        }

        .message-status i {
            font-size: 12px;
        }

        .message.sent .message-status i {
            color: rgba(255,255,255,0.8);
        }

        /* Message Input */
        .message-input-area {
            padding: 20px;
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
        }

        .message-form {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .input-wrapper {
            flex: 1;
            position: relative;
        }

        .message-input {
            width: 100%;
            padding: 14px 50px 14px 16px;
            border: 1px solid var(--border-color);
            border-radius: 24px;
            font-size: 14px;
            outline: none;
            resize: none;
            max-height: 120px;
            line-height: 1.5;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .message-input:focus {
            border-color: var(--primary-gold);
        }

        .input-actions {
            position: absolute;
            right: 12px;
            bottom: 12px;
            display: flex;
            gap: 8px;
        }

        .input-action-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            transition: color 0.2s;
        }

        .input-action-btn:hover {
            color: var(--primary-gold);
        }

        .send-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* Empty States */
        .no-conversations {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .no-conversations i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .no-chat-selected {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            background-color: #f9fafb;
        }

        .no-chat-selected i {
            font-size: 64px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .messages-container {
                flex-direction: column;
            }

            .conversations-list {
                width: 100%;
                height: 300px;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .chat-area {
                height: calc(100vh - 370px);
            }
        }

        .bg-soft-gold { background-color: #fef3e7; color: var(--primary-gold); }
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
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.store', Auth::user()->id) }}" class="nav-item">
                    <i class="ri-store-line"></i> My Store
                </a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">PRODUCTS</div>
                <a href="{{ route('vendor.products.create') }}" class="nav-item">
                    <i class="ri-add-circle-line"></i> Add Product
                </a>
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
                <a href="{{ route('vendor.profile') }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('vendor.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
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
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->business_name ?? Auth::user()->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                @else
                    {{ strtoupper(substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2)) }}
                @endif
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
            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="page-title">
                    <i class="ri-mail-line" style="color: var(--primary-gold);"></i> Messages
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('vendor.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('vendor.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="badge-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- Messages Container -->
        <div class="messages-container">
            <!-- Conversations List -->
            <div class="conversations-list">
                <div class="conversations-header">
                    <h2>Conversations</h2>
                    <div class="search-box">
                        <i class="ri-search-line"></i>
                        <input type="text" id="searchConversations" placeholder="Search conversations...">
                    </div>
                </div>

                <div class="conversation-items" id="conversationItems">
                    @forelse($conversationList as $index => $conversation)
                        <div class="conversation-item {{ $index === 0 ? 'active' : '' }}" 
                             data-user-id="{{ $conversation['user']->id }}"
                             onclick="loadConversation({{ $conversation['user']->id }})">
                            <div class="conversation-avatar">
                                @if($conversation['user']->avatar)
                                    <img src="{{ Storage::url($conversation['user']->avatar) }}" alt="{{ $conversation['user']->name }}">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($conversation['user']->name, 0, 2)) }}
                                    </div>
                                @endif
                                @if($conversation['user']->last_login_at && $conversation['user']->last_login_at->gt(now()->subMinutes(5)))
                                    <span class="online-indicator"></span>
                                @endif
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-header">
                                    <span class="conversation-name">{{ $conversation['user']->name }}</span>
                                    <span class="conversation-time">{{ $conversation['last_message']->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="conversation-preview">
                                    <span class="preview-text">
                                        @if($conversation['last_message']->sender_id == Auth::id())
                                            <span style="color: var(--text-secondary);">You: </span>
                                        @endif
                                        {{ Str::limit($conversation['last_message']->content, 30) }}
                                    </span>
                                    @if($conversation['unread_count'] > 0)
                                        <span class="unread-badge">{{ $conversation['unread_count'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-conversations">
                            <i class="ri-mail-open-line"></i>
                            <p>No conversations yet</p>
                            <p style="font-size: 13px; margin-top: 8px;">When customers message you, they will appear here</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Area - FIXED: Changed isNotEmpty() to count() > 0 -->
            <div class="chat-area" id="chatArea">
                @if(!empty($conversationList) && count($conversationList) > 0)
                    @php $firstConversation = $conversationList[0]; @endphp
                    <div class="chat-header" id="chatHeader">
                        <div class="chat-user-info">
                            <div class="conversation-avatar">
                                @if($firstConversation['user']->avatar)
                                    <img src="{{ Storage::url($firstConversation['user']->avatar) }}" alt="{{ $firstConversation['user']->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div class="avatar-placeholder" style="width: 40px; height: 40px; font-size: 16px;">
                                        {{ strtoupper(substr($firstConversation['user']->name, 0, 2)) }}
                                    </div>
                                @endif
                                @if($firstConversation['user']->last_login_at && $firstConversation['user']->last_login_at->gt(now()->subMinutes(5)))
                                    <span class="online-indicator" style="bottom: 0; right: 0;"></span>
                                @endif
                            </div>
                            <div class="chat-user-details">
                                <h3>{{ $firstConversation['user']->name }}</h3>
                                <p>
                                    @if($firstConversation['user']->last_login_at && $firstConversation['user']->last_login_at->gt(now()->subMinutes(5)))
                                        <span style="color: var(--success-color);">● Online</span>
                                    @else
                                        Last seen {{ $firstConversation['user']->last_login_at ? $firstConversation['user']->last_login_at->diffForHumans() : 'N/A' }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <div class="chat-action-btn" onclick="refreshConversation({{ $firstConversation['user']->id }})">
                                <i class="ri-refresh-line"></i>
                            </div>
                            <div class="chat-action-btn" onclick="deleteConversation({{ $firstConversation['user']->id }})">
                                <i class="ri-delete-bin-line"></i>
                            </div>
                        </div>
                    </div>

                    <div class="messages-list" id="messagesList">
                        @foreach($firstConversation['messages'] as $message)
                            <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                                @if($message->sender_id != Auth::id())
                                    <div class="message-avatar">
                                        @if($message->sender->avatar)
                                            <img src="{{ Storage::url($message->sender->avatar) }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            {{ strtoupper(substr($message->sender->name, 0, 2)) }}
                                        @endif
                                    </div>
                                @endif
                                <div class="message-content">
                                    <div class="message-text">{{ $message->content }}</div>
                                    <div class="message-time">
                                        {{ $message->created_at->format('h:i A') }}
                                        @if($message->sender_id == Auth::id())
                                            <span class="message-status">
                                                @if($message->is_read)
                                                    <i class="ri-check-double-line" style="color: var(--success-color);" title="Read"></i>
                                                @else
                                                    <i class="ri-check-line" title="Sent"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="message-input-area">
                        <form class="message-form" id="messageForm" onsubmit="sendMessage(event, {{ $firstConversation['user']->id }})">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $firstConversation['user']->id }}">
                            <div class="input-wrapper">
                                <textarea 
                                    class="message-input" 
                                    id="messageInput"
                                    name="content" 
                                    placeholder="Type your message..."
                                    rows="1"
                                    required
                                    oninput="autoResize(this)"
                                ></textarea>
                                <div class="input-actions">
                                    <button type="button" class="input-action-btn" onclick="attachFile()">
                                        <i class="ri-attachment-2"></i>
                                    </button>
                                    <button type="button" class="input-action-btn" onclick="insertEmoji()">
                                        <i class="ri-emotion-line"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="send-btn" id="sendBtn">
                                <i class="ri-send-plane-2-fill"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="no-chat-selected">
                        <i class="ri-mail-open-line"></i>
                        <h3>No messages yet</h3>
                        <p style="margin-top: 8px;">When customers contact you, their messages will appear here</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // FIXED: Changed isNotEmpty() to count() > 0
        let currentUserId = {{ !empty($conversationList) && count($conversationList) > 0 ? $conversationList[0]['user']->id : 'null' }};
        let loadingMessages = false;

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

            // Auto-scroll to bottom of messages
            scrollToBottom();

            // Search conversations
            document.getElementById('searchConversations')?.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const conversations = document.querySelectorAll('.conversation-item');
                
                conversations.forEach(conv => {
                    const name = conv.querySelector('.conversation-name').textContent.toLowerCase();
                    const preview = conv.querySelector('.preview-text').textContent.toLowerCase();
                    
                    if (name.includes(searchTerm) || preview.includes(searchTerm)) {
                        conv.style.display = 'flex';
                    } else {
                        conv.style.display = 'none';
                    }
                });
            });
        });

        // Auto-resize textarea
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
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
            if (userId === currentUserId) return;
            
            currentUserId = userId;
            
            // Update active state in conversation list
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
                if (item.dataset.userId == userId) {
                    item.classList.add('active');
                }
            });

            // Show loading state
            const chatArea = document.getElementById('chatArea');
            chatArea.innerHTML = `
                <div class="no-chat-selected">
                    <div class="loading-spinner" style="width: 40px; height: 40px;"></div>
                    <p style="margin-top: 16px;">Loading conversation...</p>
                </div>
            `;

            // Fetch conversation
            fetch(`/vendor/messages/conversation/${userId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderConversation(data.data, userId);
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
        function renderConversation(messages, userId) {
            const user = messages.length > 0 ? messages[0].sender : null;
            
            let chatHtml = `
                <div class="chat-header" id="chatHeader">
                    <div class="chat-user-info">
                        <div class="conversation-avatar">
            `;
            
            if (user && user.avatar) {
                chatHtml += `<img src="${user.avatar}" alt="${user.name}" style="width: 40px; height: 40px; border-radius: 50%;">`;
            } else {
                chatHtml += `
                    <div class="avatar-placeholder" style="width: 40px; height: 40px; font-size: 16px;">
                        ${user ? user.name.substring(0, 2).toUpperCase() : '??'}
                    </div>
                `;
            }
            
            chatHtml += `
                        </div>
                        <div class="chat-user-details">
                            <h3>${user ? user.name : 'Customer'}</h3>
                            <p>Last seen just now</p>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <div class="chat-action-btn" onclick="refreshConversation(${userId})">
                            <i class="ri-refresh-line"></i>
                        </div>
                        <div class="chat-action-btn" onclick="deleteConversation(${userId})">
                            <i class="ri-delete-bin-line"></i>
                        </div>
                    </div>
                </div>
                <div class="messages-list" id="messagesList">
            `;
            
            messages.forEach(message => {
                const isMine = message.is_mine;
                chatHtml += `
                    <div class="message ${isMine ? 'sent' : 'received'}">
                `;
                
                if (!isMine) {
                    chatHtml += `
                        <div class="message-avatar">
                            ${message.sender.avatar ? 
                                `<img src="${message.sender.avatar}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">` : 
                                message.sender.name.substring(0, 2).toUpperCase()}
                        </div>
                    `;
                }
                
                chatHtml += `
                        <div class="message-content">
                            <div class="message-text">${message.content}</div>
                            <div class="message-time">
                                ${message.created_at}
                                ${isMine ? `
                                    <span class="message-status">
                                        ${message.is_read ? 
                                            '<i class="ri-check-double-line" style="color: var(--success-color);" title="Read"></i>' : 
                                            '<i class="ri-check-line" title="Sent"></i>'}
                                    </span>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                `;
            });
            
            chatHtml += `
                </div>
                <div class="message-input-area">
                    <form class="message-form" id="messageForm" onsubmit="sendMessage(event, ${userId})">
                        @csrf
                        <input type="hidden" name="receiver_id" value="${userId}">
                        <div class="input-wrapper">
                            <textarea 
                                class="message-input" 
                                id="messageInput"
                                name="content" 
                                placeholder="Type your message..."
                                rows="1"
                                required
                                oninput="autoResize(this)"
                            ></textarea>
                            <div class="input-actions">
                                <button type="button" class="input-action-btn" onclick="attachFile()">
                                    <i class="ri-attachment-2"></i>
                                </button>
                                <button type="button" class="input-action-btn" onclick="insertEmoji()">
                                    <i class="ri-emotion-line"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="send-btn" id="sendBtn">
                            <i class="ri-send-plane-2-fill"></i>
                        </button>
                    </form>
                </div>
            `;
            
            document.getElementById('chatArea').innerHTML = chatHtml;
            scrollToBottom();
        }

        // Send message
        function sendMessage(event, receiverId) {
            event.preventDefault();
            
            const form = event.target;
            const content = document.getElementById('messageInput').value.trim();
            const sendBtn = document.getElementById('sendBtn');
            
            if (!content) return;
            
            // Disable button
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<div class="loading-spinner" style="width: 20px; height: 20px;"></div>';
            
            fetch('{{ route("vendor.messages.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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
                    // Clear input
                    document.getElementById('messageInput').value = '';
                    autoResize(document.getElementById('messageInput'));
                    
                    // Add message to list
                    const messagesList = document.getElementById('messagesList');
                    const messageHtml = `
                        <div class="message sent">
                            <div class="message-content">
                                <div class="message-text">${content}</div>
                                <div class="message-time">
                                    just now
                                    <span class="message-status">
                                        <i class="ri-check-line" title="Sent"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesList.insertAdjacentHTML('beforeend', messageHtml);
                    scrollToBottom();
                    
                    // Update conversation preview
                    updateConversationPreview(receiverId, content);
                } else {
                    alert('Failed to send message: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send message');
            })
            .finally(() => {
                // Re-enable button
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="ri-send-plane-2-fill"></i>';
            });
        }

        // Update conversation preview
        function updateConversationPreview(userId, lastMessage) {
            const conversation = document.querySelector(`.conversation-item[data-user-id="${userId}"]`);
            if (conversation) {
                const preview = conversation.querySelector('.preview-text');
                preview.innerHTML = `<span style="color: var(--text-secondary);">You: </span>${lastMessage.substring(0, 30)}${lastMessage.length > 30 ? '...' : ''}`;
                
                // Move to top
                const parent = conversation.parentNode;
                parent.insertBefore(conversation, parent.firstChild);
            }
        }

        // Refresh conversation
        function refreshConversation(userId) {
            loadConversation(userId);
        }

        // Delete conversation
        function deleteConversation(userId) {
            if (!confirm('Are you sure you want to delete this conversation?')) return;
            
            // Implement delete logic here
            alert('Delete conversation feature coming soon');
        }

        // Attach file
        function attachFile() {
            alert('File attachment coming soon');
        }

        // Insert emoji
        function insertEmoji() {
            const input = document.getElementById('messageInput');
            input.value += ' 😊';
            autoResize(input);
        }

        // Poll for new messages every 10 seconds
        setInterval(() => {
            if (currentUserId && currentUserId !== 'null') {
                fetch(`/vendor/messages/conversation/${currentUserId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        const currentMessages = document.querySelectorAll('.message').length;
                        if (data.data.length > currentMessages) {
                            renderConversation(data.data, currentUserId);
                        }
                    }
                })
                .catch(error => console.error('Polling error:', error));
            }
        }, 10000);
    </script>

</body>
</html>