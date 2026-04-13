<!-- shared navbar partial -->
<nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Vendora" style="height:48px;width:48px;object-fit:cover;border-radius:50%;vertical-align:middle;">
    </a>

    <!-- Hamburger (mobile) -->
    <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu" onclick="toggleMobileNav()">
        <i class="ri-menu-line" id="hamburgerIcon"></i>
    </button>

    <div class="nav-links" id="navLinks">
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

<style>
    .navbar {
        background-color: var(--navbar-bg, #ffffff);
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 200;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
        width: 100%;
    }

    .navbar .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-primary, #111827);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .navbar .logo i {
        color: var(--primary-gold, #B88E3F);
        font-size: 1.6rem;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: nowrap;
    }

    .nav-link {
        color: var(--text-secondary, #6b7280);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: color 0.2s;
        white-space: nowrap;
    }

    .nav-link:hover {
        color: var(--primary-gold, #B88E3F);
    }

    .btn-login {
        background-color: var(--primary-gold, #B88E3F);
        color: #fff !important;
        padding: 0.45rem 1.2rem;
        border-radius: 9999px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .btn-login:hover {
        background-color: var(--primary-gold-hover, #9c7832);
    }

    /* Hamburger — hidden on desktop */
    .nav-hamburger {
        display: none;
        background: none;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 8px;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.3rem;
        color: var(--text-primary, #111827);
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .nav-hamburger:hover {
        border-color: var(--primary-gold, #B88E3F);
        color: var(--primary-gold, #B88E3F);
    }

    /* ── Tablet (≤ 900px): collapse nav links ── */
    @media (max-width: 900px) {
        .navbar {
            padding: 0 1.25rem;
            flex-wrap: wrap;
            height: auto;
            min-height: 64px;
        }

        .nav-hamburger {
            display: flex;
        }

        .nav-links {
            display: none;
            flex-direction: column;
            align-items: flex-start;
            gap: 0;
            width: 100%;
            padding: 0.5rem 0 1rem;
            border-top: 1px solid var(--border-color, #e5e7eb);
        }

        .nav-links.open {
            display: flex;
        }

        .nav-link {
            width: 100%;
            padding: 0.65rem 0.25rem;
            border-bottom: 1px solid var(--border-color, #e5e7eb);
            font-size: 1rem;
        }

        .btn-login {
            margin-top: 0.5rem;
            width: 100%;
            text-align: center;
            padding: 0.65rem 1rem;
            border-radius: 8px;
        }

        /* language switcher full-width on mobile */
        .lang-dropdown {
            width: 100%;
            margin-top: 0.5rem;
        }

        .lang-trigger {
            width: 100%;
            justify-content: space-between;
            border-radius: 8px;
        }

        .lang-menu {
            width: 100%;
            position: static;
            box-shadow: none;
            border-radius: 8px;
            margin-top: 4px;
        }
    }

    /* ── Mobile (≤ 480px) ── */
    @media (max-width: 480px) {
        .navbar {
            padding: 0 1rem;
        }

        .navbar .logo {
            font-size: 1.2rem;
        }

        .navbar .logo i {
            font-size: 1.4rem;
        }
    }
</style>

<script>
    function toggleMobileNav() {
        const links = document.getElementById('navLinks');
        const icon  = document.getElementById('hamburgerIcon');
        const isOpen = links.classList.toggle('open');
        icon.className = isOpen ? 'ri-close-line' : 'ri-menu-line';
    }

    // Close nav when a link is clicked (SPA-friendly)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('#navLinks .nav-link, #navLinks .btn-login');
        if (link) {
            document.getElementById('navLinks').classList.remove('open');
            document.getElementById('hamburgerIcon').className = 'ri-menu-line';
        }
    });
</script>
