<!-- shared navbar partial -->
<nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
        <i class="ri-store-3-fill"></i>
        Vendora
        <span class="ethiopia-badge">
            <i class="ri-map-pin-line"></i> Jimma
        </span>
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link">{{ __('nav.home') }}</a>
        <a href="{{ route('vendors.search') }}" class="nav-link">{{ __('nav.vendors') }}</a>
        <a href="{{ route('about') }}" class="nav-link">{{ __('nav.about') }}</a>
        <a href="{{ route('contact') }}" class="nav-link">{{ __('nav.contact') }}</a>
        @guest
            <a href="{{ route('login') }}" class="btn-login">{{ __('nav.sign_in') }}</a>
        @else
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn-login">{{ __('nav.admin_dashboard') }}</a>
            @elseif(Auth::user()->role === 'vendor')
                <a href="{{ route('vendor.dashboard') }}" class="btn-login">{{ __('nav.vendor_dashboard') }}</a>
            @else
                <a href="{{ route('customer.dashboard') }}" class="btn-login">{{ __('nav.customer_dashboard') }}</a>
            @endif
        @endguest
        @include('partials.language-switcher')
    </div>
</nav>
