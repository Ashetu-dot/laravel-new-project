<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Conversation - Vendora</title>
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
            --primary-gold:#B88E3F;--accent-red:#ef4444;
        }
        body{font-family:'Inter',sans-serif;background:var(--primary-bg);color:var(--text-primary);display:flex;min-height:100vh;}
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
        .main-content{margin-left:280px;flex:1;display:flex;flex-direction:column;width:calc(100% - 280px);}
        .top-header{height:70px;background:var(--card-bg);border-bottom:1px solid var(--border-color);display:flex;align-items:center;justify-content:space-between;padding:0 32px;position:sticky;top:0;z-index:99;}
        .menu-toggle{display:none;font-size:24px;color:var(--text-secondary);cursor:pointer;margin-right:20px;}
        @media(max-width:768px){.menu-toggle{display:block;}.top-header{padding:0 20px;}}
        .page-title{font-size:20px;font-weight:600;display:flex;align-items:center;gap:8px;}
        .chat-container{padding:32px;flex:1;display:flex;flex-direction:column;max-width:800px;margin:0 auto;width:100%;}
        .chat-header{background:var(--card-bg);border-radius:12px;padding:16px 20px;margin-bottom:16px;display:flex;align-items:center;gap:12px;border:1px solid var(--border-color);}
        .other-avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--primary-gold),#9c7832);color:white;display:flex;align-items:center;justify-content:center;font-weight:600;overflow:hidden;flex-shrink:0;}
        .other-avatar img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
        .chat-messages{background:var(--card-bg);border-radius:12px;padding:20px;flex:1;overflow-y:auto;display:flex;flex-direction:column;gap:12px;min-height:300px;max-height:calc(100vh - 380px);border:1px solid var(--border-color);}
        .message-row{display:flex;flex-direction:column;}
        .message-row.sent{align-items:flex-end;}
        .message-row.received{align-items:flex-start;}
        .bubble{max-width:70%;padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.5;}
        .bubble.sent{background:var(--primary-gold);color:white;border-bottom-right-radius:4px;}
        .bubble.received{background:#f3f4f6;color:var(--text-primary);border-bottom-left-radius:4px;}
        .msg-time{font-size:11px;color:var(--text-secondary);margin-top:4px;padding:0 4px;}
        .reply-form{background:var(--card-bg);border-radius:12px;padding:16px 20px;margin-top:16px;border:1px solid var(--border-color);}
        .reply-form textarea{width:100%;padding:10px 14px;border:1px solid var(--border-color);border-radius:8px;font-size:14px;resize:none;outline:none;font-family:inherit;margin-bottom:12px;}
        .reply-form textarea:focus{border-color:var(--primary-gold);}
        .send-btn{background:var(--primary-gold);color:white;border:none;border-radius:8px;padding:10px 20px;cursor:pointer;font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;transition:background .2s;}
        .send-btn:hover{background:#9c7832;}
        .back-link{display:inline-flex;align-items:center;gap:6px;color:var(--text-secondary);text-decoration:none;font-size:14px;margin-bottom:16px;}
        .back-link:hover{color:var(--primary-gold);}
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

    <main class="main-content">
        <header class="top-header">
            <div style="display:flex;align-items:center;gap:16px;">
                <div class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></div>
                <div class="page-title"><i class="ri-mail-line" style="color:var(--primary-gold);"></i> Conversation</div>
            </div>
        </header>

        <div class="chat-container">
            @if(session('success'))
                <div style="background:#D1FAE5;color:#065F46;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                    <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('customer.messages') }}" class="back-link">
                <i class="ri-arrow-left-line"></i> Back to Messages
            </a>

            <!-- Chat Header -->
            <div class="chat-header">
                <div class="other-avatar">
                    @if($otherUser)
                        <img src="{{ $otherUser->avatar_url }}" alt="{{ $otherUser->name }}">
                    @else
                        <i class="ri-user-line"></i>
                    @endif
                </div>
                <div>
                    <div style="font-weight:600;">{{ $otherUser->name ?? 'Support' }}</div>
                    <div style="font-size:12px;color:var(--text-secondary);">{{ $otherUser->role ?? 'Admin' }}</div>
                </div>
            </div>

            <!-- Messages -->
            <div class="chat-messages" id="chatMessages">
                @foreach($conversation as $msg)
                @php $isSent = $msg->sender_id === Auth::id(); @endphp
                <div class="message-row {{ $isSent ? 'sent' : 'received' }}">
                    <div class="bubble {{ $isSent ? 'sent' : 'received' }}">
                        {{ $msg->content ?? $msg->message ?? '' }}
                    </div>
                    <span class="msg-time">{{ $msg->created_at->format('M d, g:i A') }}</span>
                </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            <div class="reply-form">
                <form method="POST" action="{{ route('customer.messages.send') }}">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $otherUser->id ?? '' }}">
                    <input type="hidden" name="parent_id" value="{{ $rootMessage->id ?? '' }}">
                    <textarea name="content" rows="3" placeholder="Type your reply..." required></textarea>
                    <button type="submit" class="send-btn">
                        <i class="ri-send-plane-line"></i> Send Reply
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Scroll to bottom of messages
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;

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
