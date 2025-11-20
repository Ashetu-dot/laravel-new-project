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
                    <img src="https://ui-avatars.com/api/?name=Admin&background=007bff&color=fff"
                         class="user-image rounded-circle shadow"
                         alt="Admin Image"/>
                    <span class="d-none d-md-inline">Administrator</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- User Header -->
                    <li class="user-header text-bg-primary">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=007bff&color=fff"
                             class="rounded-circle shadow"
                             alt="Admin Image"/>
                        <p>
                            System Administrator
                            <small>Administrator</small>
                        </p>
                    </li>

                    <!-- Menu Footer -->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
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
