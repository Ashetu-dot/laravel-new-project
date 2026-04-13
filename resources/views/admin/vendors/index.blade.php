<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Vendor Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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
        }

        /* Sidebar */
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
        }

        .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
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
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
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
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1280px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Filter Section */
        .filter-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .filter-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .filter-input, .filter-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .filter-input:focus, .filter-select:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
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
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .btn-success {
            background-color: var(--accent-green);
            color: white;
        }
        .btn-success:hover {
            background-color: #0b9a6e;
        }

        /* Table */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            background-color: #f9fafb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: var(--text-primary);
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-active { background-color: #d1fae5; color: #065f46; }
        .status-inactive { background-color: #fee2e2; color: #991b1b; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-verified { background-color: #dbeafe; color: #1e40af; }

        .vendor-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .vendor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            object-fit: cover;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            background-color: transparent;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .action-btn-success {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: var(--accent-green);
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .action-btn-success:hover {
            background-color: #0b9a6e;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination-item {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-item:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
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

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    @include('partials.admin-sidebar')

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
                    <input type="text" placeholder="Search vendors...">
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Vendors Management</h1>
                    <p class="page-subtitle">Manage and verify marketplace vendors</p>
                </div>
                <div>
                    <span class="status-badge status-pending">Last updated: {{ now()->format('M d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-store-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Vendors</div>
                        <div class="stat-number">{{ number_format($vendorStats['total'] ?? 0) }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-store-3-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Active</div>
                        <div class="stat-number">{{ number_format($vendorStats['active'] ?? 0) }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-time-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Pending</div>
                        <div class="stat-number">{{ number_format($vendorStats['pending'] ?? 0) }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-verified-badge-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Verified</div>
                        <div class="stat-number">{{ number_format($vendorStats['verified'] ?? 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <h3 class="filter-title">Filter Vendors</h3>
                <form method="GET" action="{{ route('admin.vendors') }}" class="filter-form">
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" name="search" class="filter-input" placeholder="Business name, email, description..." value="{{ request('search') }}">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select name="status" class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Verification</label>
                        <select name="verification" class="filter-select">
                            <option value="">All</option>
                            <option value="pending" {{ request('verification') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ request('verification') == 'verified' ? 'selected' : '' }}>Verified</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-filter-line"></i> Apply Filters
                        </button>
                        <a href="{{ route('admin.vendors') }}" class="btn btn-secondary">
                            <i class="ri-close-line"></i> Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Vendors Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Vendors List</h3>
                    <span>Showing {{ $vendors->firstItem() ?? 0 }} - {{ $vendors->lastItem() ?? 0 }} of {{ $vendors->total() ?? 0 }} vendors</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Business</th>
                            <th>Contact</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors ?? [] as $vendor)
                        <tr>
                            <td>
                                <div class="vendor-cell">
                                    <img src="{{ $vendor->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($vendor->business_name ?? $vendor->name) . '&background=B88E3F&color=fff' }}" alt="Vendor Logo" class="vendor-avatar">
                                    <div>
                                        <div style="font-weight: 600;">{{ $vendor->business_name ?? $vendor->name }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary);">ID: #{{ $vendor->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $vendor->email }}</div>
                                <div style="font-size: 12px; color: var(--text-secondary);">{{ $vendor->phone ?? 'No phone' }}</div>
                            </td>
                            <td>{{ $vendor->category ?? 'N/A' }}</td>
                            <td>
                                @if($vendor->city && $vendor->state)
                                    {{ $vendor->city }}, {{ $vendor->state }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($vendor->created_at)
                                    <div>{{ $vendor->created_at->format('M d, Y') }}</div>
                                @else
                                    <div>N/A</div>
                                @endif
                            </td>
                            <td>
                                <div style="margin-bottom: 4px;">
                                    <span class="status-badge status-{{ $vendor->is_active ? 'active' : 'inactive' }}">
                                        {{ $vendor->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                @if($vendor->email_verified_at)
                                    <span class="status-badge status-verified" style="font-size: 11px; padding: 2px 8px;">
                                        <i class="ri-check-line" style="font-size: 12px;"></i> Verified
                                    </span>
                                @else
                                    <span class="status-badge status-pending" style="font-size: 11px; padding: 2px 8px;">
                                        <i class="ri-time-line" style="font-size: 12px;"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="action-btn" title="View Vendor">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="action-btn" title="Edit Vendor">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @if(!$vendor->email_verified_at)
                                        <form action="{{ route('admin.vendors.verify', $vendor->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn-success" title="Verify Vendor" >
                                                <i class="ri-check-line"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 60px;">
                                <i class="ri-store-2-line" style="font-size: 48px; color: var(--text-secondary); margin-bottom: 16px; display: block;"></i>
                                <h3 style="margin-bottom: 8px;">No vendors found</h3>
                                <p style="color: var(--text-secondary);">Try adjusting your search or filter criteria</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });
        });


    </script>

</body>
</html>
