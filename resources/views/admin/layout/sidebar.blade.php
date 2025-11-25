<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- ... existing sidebar brand ... -->
<div>
       <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('admin/images/logo.png') }}"
                 alt="Local Vendor Finder Logo"
                 class="brand-image opacity-75 shadow"
                 onerror="this.src='https://via.placeholder.com/150x50/007bff/ffffff?text=LVF+Admin'"/>
            <span class="brand-text fw-light">Vendor Finder</span>
        </a>
</div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Admin Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.profile*') || request()->routeIs('admin.password*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>
                            Admin
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.password.edit') }}" class="nav-link {{ request()->routeIs('admin.password*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-shield-lock"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.list') }}" class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Manage Admins</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ... rest of your sidebar menu ... -->
                <!-- User Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            User Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-shop"></i>
                                <p>Vendors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-clock-history"></i>
                                <p>Pending Vendors</p>
                                <span class="nav-badge badge text-bg-warning me-3" id="pending-vendors-count">3</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Catalog Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Catalog
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-basket"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-tools"></i>
                                <p>Services</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Orders & Transactions -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cart-check"></i>
                        <p>
                            Orders
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-list-check"></i>
                                <p>All Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-clock"></i>
                                <p>Pending Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-credit-card"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Analytics & Reports -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-graph-up"></i>
                        <p>
                            Analytics
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-bar-chart"></i>
                                <p>Sales Analytics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Sales Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>Vendor Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- System Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>
                            System
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-sliders"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cloud-arrow-down"></i>
                                <p>Backup</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-journal-text"></i>
                                <p>System Logs</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Trust & Reviews -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-check"></i>
                        <p>Trust Scores</p>
                    </a>
                </li>

                <!-- Chatbot Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-robot"></i>
                        <p>Chatbot AI</p>
                    </a>
                </li>

                
            </ul>
        </nav>
    </div>
</aside>
