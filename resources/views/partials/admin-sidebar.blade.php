{{-- Shared Admin Sidebar --}}
<nav class="sidebar" id="sidebar">
    <div class="brand" style="height:70px;display:flex;align-items:center;padding:0 20px;border-bottom:1px solid #374151;">
        <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:44px;width:44px;object-fit:cover;border-radius:50%;flex-shrink:0;">
    </div>

    <div class="nav-menu" style="padding:20px 16px;flex:1;overflow-y:auto;">
        <div class="nav-group" style="margin-bottom:20px;">
            <div class="nav-label" style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;padding-left:12px;font-weight:600;">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="ri-shopping-bag-3-line"></i> Orders
                @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                    <span style="margin-left:auto;background:#ef4444;color:white;padding:2px 8px;border-radius:12px;font-size:11px;">{{ $pendingOrdersCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.vendors') }}" class="nav-item {{ request()->routeIs('admin.vendors*') ? 'active' : '' }}">
                <i class="ri-store-2-line"></i> Vendors
                @if(isset($pendingVendorsCount) && $pendingVendorsCount > 0)
                    <span style="margin-left:auto;background:#f59e0b;color:white;padding:2px 8px;border-radius:12px;font-size:11px;">{{ $pendingVendorsCount }}</span>
                @endif
            </a>
        </div>

        <div class="nav-group" style="margin-bottom:20px;">
            <div class="nav-label" style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;padding-left:12px;font-weight:600;">Management</div>
            <a href="{{ route('admin.products') }}" class="nav-item {{ request()->routeIs('admin.products*') && request('tab') !== 'categories' ? 'active' : '' }}">
                <i class="ri-shopping-cart-line"></i> Products
            </a>
            <a href="{{ route('admin.products') }}?tab=categories" class="nav-item {{ request()->routeIs('admin.products') && request('tab') === 'categories' ? 'active' : '' }}">
                <i class="ri-price-tag-3-line"></i> Categories
            </a>
            <a href="{{ route('admin.inventory') }}" class="nav-item {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
                <i class="ri-archive-line"></i> Inventory
            </a>
            <a href="{{ route('admin.promotions.promotions') }}" class="nav-item {{ request()->routeIs('admin.promotions*') ? 'active' : '' }}">
                <i class="ri-megaphone-line"></i> Promotions
            </a>
        </div>

        <div class="nav-group" style="margin-bottom:20px;">
            <div class="nav-label" style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;padding-left:12px;font-weight:600;">Analytics</div>
            <a href="{{ route('admin.analytics') }}" class="nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                <i class="ri-bar-chart-2-line"></i> Analytics
            </a>
            <a href="{{ route('admin.reports') }}" class="nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <i class="ri-file-list-3-line"></i> Reports
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-label" style="color:#6b7280;font-size:11px;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;padding-left:12px;font-weight:600;">Admin</div>
            <a href="{{ route('admin.admins.list') }}" class="nav-item {{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
                <i class="ri-shield-user-line"></i> Administrators
            </a>
            <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="ri-settings-4-line"></i> Settings
            </a>
            <a href="{{ route('admin.help') }}" class="nav-item {{ request()->routeIs('admin.help') ? 'active' : '' }}">
                <i class="ri-question-line"></i> Help & Support
            </a>
            <form method="POST" action="{{ route('admin.logout') }}" class="logout-form" style="margin-top:8px;">
                @csrf
                <button type="submit" class="logout-btn" onclick="return confirm('Logout?')">
                    <i class="ri-logout-box-line"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="user-profile" style="padding:16px 20px;border-top:1px solid #374151;display:flex;align-items:center;gap:12px;flex-shrink:0;">
        <div style="width:40px;height:40px;border-radius:50%;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,#B88E3F,#9c7832);">
            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name ?? 'Admin' }}"
                 style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
                 onerror="this.style.display='none';this.parentElement.innerHTML='<span style=\'display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:white;font-weight:600;font-size:14px;\'>{{ strtoupper(substr(Auth::user()->name ?? "AD", 0, 2)) }}</span>'">
        </div>
        <div style="min-width:0;">
            <div style="color:white;font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px;">{{ Auth::user()->name ?? 'Admin User' }}</div>
            <div style="color:#9ca3af;font-size:12px;">{{ ucfirst(Auth::user()->role ?? 'administrator') }}</div>
        </div>
    </div>
</nav>
