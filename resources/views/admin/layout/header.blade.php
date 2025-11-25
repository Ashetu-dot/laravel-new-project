<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!-- Left Side -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <span class="nav-link text-dark fw-bold">Local Vendor Finder Admin</span>
            </li>
        </ul>

        <!-- Right Side -->
        <ul class="navbar-nav ms-auto">
            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">5 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-shop me-2"></i> 3 new vendor registrations
                        <span class="float-end text-secondary fs-7">2 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-cart me-2"></i> 8 new orders
                        <span class="float-end text-secondary fs-7">1 hour</span>
                    </a>
                </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->guard('admin')->user()->name ?? 'Admin') }}&background=007bff&color=fff&size=32"
                         class="user-image rounded-circle shadow"
                         alt="Admin Image"
                         width="32"
                         height="32"/>
                    <span class="d-none d-md-inline">{{ auth()->guard('admin')->user()->name ?? 'Administrator' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- User Header -->
                    <li class="user-header text-bg-primary">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->guard('admin')->user()->name ?? 'Admin') }}&background=007bff&color=fff&size=80"
                             class="rounded-circle shadow"
                             alt="Admin Image"
                             width="80"
                             height="80"/>
                        <p>
                            {{ auth()->guard('admin')->user()->name ?? 'System Administrator' }}
                            <small>{{ ucfirst(str_replace('_', ' ', auth()->guard('admin')->user()->role ?? 'Administrator')) }}</small>
                        </p>
                    </li>

                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="#">Profile</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Settings</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Help</a>
                            </div>
                        </div>
                    </li>

                    <!-- Menu Footer -->
                    <li class="user-footer">
                        <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
.user-header {
    padding: 1rem;
    text-align: center;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
}

.user-header img {
    width: 80px;
    height: 80px;
    border: 3px solid rgba(255,255,255,0.2);
    margin-bottom: 0.5rem;
}

.user-header p {
    margin: 0;
    color: white;
    font-size: 1rem;
    font-weight: 600;
}

.user-header small {
    display: block;
    color: rgba(255,255,255,0.8);
    font-size: 0.875rem;
    font-weight: 400;
    margin-top: 0.25rem;
}

.user-image {
    width: 32px;
    height: 32px;
    margin-right: 0.5rem;
    object-fit: cover;
}

.user-body {
    padding: 0.75rem 1rem;
}

.user-body .row {
    margin: 0 -0.5rem;
}

.user-body .col-4 {
    padding: 0 0.5rem;
}

.user-body a {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.875rem;
}

.user-body a:hover {
    color: #007bff;
}

.user-footer {
    padding: 0.75rem 1rem;
    background-color: rgba(0,0,0,0.03);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-default {
    background-color: #f8f9fa;
    border-color: #ddd;
    color: #444;
}

.btn-default:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
}

.dropdown-menu-lg {
    min-width: 280px;
}

.navbar-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 0.6rem;
    padding: 0.25em 0.4em;
}
</style>
