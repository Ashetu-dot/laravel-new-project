<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Messages - Vendora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        :root{
            --primary-bg:#f3f4f6;--sidebar-bg:#1f2937;--sidebar-text:#9ca3af;
            --sidebar-text-active:#fff;--sidebar-active-bg:#374151;--card-bg:#fff;
            --text-primary:#111827;--text-secondary:#6b7280;--border-color:#e5e7eb;
            --primary-gold:#B88E3F;--accent-red:#ef4444;--accent-green:#10b981;
        }
        body{font-family:'Inter',sans-serif;background:var(--primary-bg);color:var(--text-primary);display:flex;min-height:100vh;}
        /* Sidebar */
        .sidebar{width:280px;background:var(--sidebar-bg);min-height:100vh;display:flex;flex-direction:column;position:fixed;left:0;top:0;bottom:0;z-index:100;overflow-y:auto;}
        @media(max-width:768px){.sidebar{transform:translateX(-100%);transition:transform .3s;}.sidebar.active{transform:translateX(0);}.main-content{margin-left:0!important;width:100%!important;}}
        .brand{height:70px;display:flex;align-items:center;padding:0 24px;color:white;font-size:24px;font-weight:700;border-bottom:1px solid #374151;}
        .brand i{color:var(--primary-gold);margin-right:12px;font-size:28px;}
        .nav-menu{padding:24px 16px;flex:1;}
        .nav-group{margin-bottom:24px;}
        .nav-label{color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;padding-left:12px;font-weight:600;}
        .nav-item{display:flex;align-items:center;padding:12px;color:var(--sidebar-text);text-decoration:none;border-radius:8px;margin-bottom:4px;transition:all .2s;font-size:15px;position:relative;}
        .nav-item:hover,.nav-item.active{background:var(--sidebar-active-bg);color:var(--sidebar-text-active);}
        .nav-item i{margin-right:12px;font-size:20px;}
        .badge-count{position:absolute;right:16px;background:var(--accent-red);color:white;font-size:11px;min-width:20px;height:20px;border-radius:20px;display:flex;align-items:center;justify-content:center;}
        .user-profile{padding:20px;border-top:1px solid #374151;display:flex;align-items:center;}
        .avatar{width:40px;height:40px;background:linear-gradient(135deg,var(--primary-gold),#9c7832);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;margin-right:12px;overflow:hidden;flex-shrink:0;}
        .avatar img{width:40px;height:40px;border-radius:50%;object-fit:cover;}
        .user-info h4{color:white;font-size:14px;margin-bottom:2px;}
        .user-info p{color:var(--sidebar-text);font-size:12px;}
        .logout-form{margin-top:8px;}
        .logout-btn{background:none;border:none;color:var(--sidebar-text);cursor:pointer;font-size:15px;display:flex;align-items:center;gap:8px;padding:12px;width:100%;border-radius:8px;transition:all .2s;}
        .logout-btn:hover{background:var(--sidebar-active-bg);color:var(--accent-red);}
        /* Main */
        .main-content{margin-left:280px;flex:1;display:flex;flex-direction:column;width:calc(100% - 280px);}
        .top-header{height:70px;background:var(--card-bg);border-bottom:1px solid var(--border-color);display:flex;align-items:center;justify-content:space-between;padding:0 32px;position:sticky;top:0;z-index:99;}
        .menu-toggle{display:none;font-size:24px;color:var(--text-secondary);cursor:pointer;margin-right:20px;}
        @media(max-width:768px){.menu-toggle{display:block;}.top-header{padding:0 20px;}}
        .page-title{font-size:20px;font-weight:600;display:flex;align-items:center;gap:8px;}
        .header-actions{display:flex;align-items:center;gap:16px;}
        .icon-btn{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-secondary);transition:background .2s;position:relative;text-decoration:none;font-size:20px;}
        .icon-btn:hover{background:var(--primary-bg);color:var(--text-primary);}
        .icon-btn .badge-count{position:absolute;top:-5px;right:-5px;background:var(--accent-red);color:white;font-size:10px;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
        /* Messages */
        .messages-container{padding:32px;flex:1;}
        .messages-layout{display:grid;grid-template-columns:320px 1fr;gap:24px;height:calc(100vh - 134px);}
        @media(max-width:768px){.messages-layout{grid-template-columns:1fr;}}
        /* Conversation list */
        .conversations-panel{background:var(--card-bg);border-radius:12px;border:1px solid var(--border-color);overflow:hidden;display:flex;flex-direction:column;}
        .panel-header{padding:16px 20px;border-bottom:1px solid var(--border-color);display:flex;align-items:center;justify-content:space-between;}
        .panel-header h3{font-size:16px;font-weight:600;}
        .conversation-item{display:flex;align-items:center;gap:12px;padding:14px 20px;cursor:pointer;border-bottom:1px solid var(--border-color);transition:background .2s;text-decoration:none;color:inherit;}
        .conversation-item:hover,.conversation-item.active{background:#f9fafb;}
        .conv-avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--primary-gold),#9c7832);color:white;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0;overflow:hidden;}
        .conv-avatar img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
        .conv-info{flex:1;min-width:0;}
        .conv-name{font-weight:600;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .conv-preview{font-size:12px;color:var(--text-secondary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:2px;}
        .conv-meta{display:flex;flex-direction:column;align-items:flex-end;gap:4px;flex-shrink:0;}
        .conv-time{font-size:11px;color:var(--text-secondary);}
        .unread-dot{width:8px;height:8px;border-radius:50%;background:var(--primary-gold);}
        /* Chat panel */
        .chat-panel{background:var(--card-bg);border-radius:12px;border:1px solid var(--border-color);display:flex;flex-direction:column;overflow:hidden;}
        .chat-header{padding:16px 20px;border-bottom:1px solid var(--border-color);display:flex;align-items:center;gap:12px;}
        .chat-messages{flex:1;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;}
        .message-bubble{max-width:70%;padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.5;}
        .message-bubble.sent{background:var(--primary-gold);color:white;align-self:flex-end;border-bottom-right-radius:4px;}
        .message-bubble.received{background:#f3f4f6;color:var(--text-primary);align-self:flex-start;border-bottom-left-radius:4px;}
        .message-time{font-size:11px;opacity:.7;margin-top:4px;}
        .chat-input-area{padding:16px 20px;border-top:1px solid var(--border-color);display:flex;gap:12px;align-items:flex-end;}
        .chat-input{flex:1;padding:10px 14px;border:1px solid var(--border-color);border-radius:8px;font-size:14px;resize:none;outline:none;font-family:inherit;}
        .chat-input:focus{border-color:var(--primary-gold);}
        .send-btn{background:var(--primary-gold);color:white;border:none;border-radius:8px;padding:10px 16px;cursor:pointer;font-size:18px;transition:background .2s;}
        .send-btn:hover{background:#9c7832;}
        .empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:var(--text-secondary);gap:12px;}
        .empty-state i{font-size:48px;opacity:.3;}
        /* New message */
        .new-message-btn{margin:12px 20px;padding:10px;background:var(--primary-gold);color:white;border:none;border-radius:8px;cursor:pointer;font-size:14px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s;}
        .new-message-btn:hover{background:#9c7832;}
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand"><i class="ri-store-3-fill"></i>Vendora</div>
        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN MENU</div>
                <a href="{{ route('customer.dashboard') }}" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
                <a href="{{ route('search.results') }}" class="nav-item"><i class="ri-search-line"></i> Discover</a>
                <a href="{{ route('customer.orders') }}" class="nav-item"><i class="ri-shopping-bag-3-line"></i> My Orders</a>
            </div>
            <div class="nav-group">
                <div class="nav-label">SHOPPING</div>
                <a href="{{ route('customer.wishlist.index') }}" class="nav-item"><i class="ri-heart-3-line"></i> Wishlist</a>
                <a href="{{ route('customer.following') }}" class="nav-item"><i class="ri-store-line"></i> Following</a>
                <a href="{{ route('customer.coupons') }}" class="nav-item"><i class="ri-coupon-line"></i> My Coupons</a>
            </div>
            <div class="nav-group">
                <div class="nav-label">ACCOUNT</div>
                <a href="{{ route('customer.profile') }}" class="nav-item"><i class="ri-user-line"></i> My Profile</a>
                <a href="{{ route('customer.settings') }}" class="nav-item"><i class="ri-settings-4-line"></i> Settings</a>
                <a href="{{ route('customer.messages') }}" class="nav-item active"><i class="ri-mail-line"></i> Messages
                    @if(isset($unreadCount) && $unreadCount > 0)<span class="badge-count">{{ $unreadCount }}</span>@endif
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Logout?')">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="user-profile">
            <div class="avatar"><img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"></div>
            <div class="user-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Customer since {{ Auth::user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <header class="top-header">
            <div style="display:flex;align-items:center;gap:16px;">
                <div class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></div>
                <div class="page-title"><i class="ri-mail-line" style="color:var(--primary-gold);"></i> Messages</div>
            </div>
            <div class="header-actions">
                <a href="{{ route('customer.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <div class="messages-container">
            @if(session('success'))
                <div style="background:#D1FAE5;color:#065F46;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                    <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
                </div>
            @endif

            <div class="messages-layout">
                <!-- Conversations List -->
                <div class="conversations-panel">
                    <div class="panel-header">
                        <h3>Conversations</h3>
                        <span style="font-size:12px;color:var(--text-secondary);">{{ $conversations->count() }} chats</span>
                    </div>

                    <!-- New Message to Admin -->
                    @if($admins->count() > 0)
                    <form method="POST" action="{{ route('customer.messages.send') }}" id="newMsgForm" style="padding:12px 20px;border-bottom:1px solid var(--border-color);">
                        @csrf
                        <select name="receiver_id" style="width:100%;padding:8px;border:1px solid var(--border-color);border-radius:8px;font-size:13px;margin-bottom:8px;outline:none;">
                            <option value="">Contact Support...</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                        <textarea name="content" placeholder="Type your message..." rows="2"
                            style="width:100%;padding:8px;border:1px solid var(--border-color);border-radius:8px;font-size:13px;resize:none;outline:none;font-family:inherit;" required></textarea>
                        <button type="submit" class="new-message-btn" style="margin:8px 0 0;">
                            <i class="ri-send-plane-line"></i> Send Message
                        </button>
                    </form>
                    @endif

                    <!-- Conversation list -->
                    <div style="overflow-y:auto;flex:1;">
                        @forelse($conversations as $conv)
                        @php
                            $other = $conv->sender_id === Auth::id() ? $conv->receiver : $conv->sender;
                            $isUnread = !$conv->is_read && $conv->receiver_id === Auth::id();
                        @endphp
                        <a href="{{ route('customer.messages.show', $conv->id) }}" class="conversation-item {{ request()->route('id') == $conv->id ? 'active' : '' }}">
                            <div class="conv-avatar">
                                @if($other)
                                    <img src="{{ $other->avatar_url }}" alt="{{ $other->name }}">
                                @else
                                    <i class="ri-user-line"></i>
                                @endif
                            </div>
                            <div class="conv-info">
                                <div class="conv-name">{{ $other->name ?? 'Support' }}</div>
                                <div class="conv-preview">{{ Str::limit($conv->message ?? '', 40) }}</div>
                            </div>
                            <div class="conv-meta">
                                <span class="conv-time">{{ $conv->created_at->diffForHumans(null, true) }}</span>
                                @if($isUnread)<div class="unread-dot"></div>@endif
                            </div>
                        </a>
                        @empty
                        <div style="padding:40px 20px;text-align:center;color:var(--text-secondary);">
                            <i class="ri-mail-line" style="font-size:40px;opacity:.3;display:block;margin-bottom:12px;"></i>
                            <p>No messages yet.</p>
                            <p style="font-size:13px;margin-top:4px;">Use the form above to contact support.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Chat Panel -->
                <div class="chat-panel">
                    <div class="empty-state">
                        <i class="ri-chat-3-line"></i>
                        <p>Select a conversation to read messages</p>
                        <p style="font-size:13px;">or send a new message to support above</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar    = document.getElementById('sidebar');
        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));
            document.addEventListener('click', e => {
                if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target))
                    sidebar.classList.remove('active');
            });
        }
    </script>
</body>
</html>
