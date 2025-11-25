@extends('admin.layout.layout')

@section('title', 'Admin Dashboard - Local Vendor Finder')

@section('content')
<main class="app-main">
    <!-- App Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- App Content -->
    <div class="app-content">
        <div class="container-fluid">
            <!-- Statistics Row -->
            <div class="row">
                <!-- Total Admins -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $stats['total_admins'] ?? 0 }}</h3>
                            <p>Total Admins</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            View All <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Vendors -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $stats['total_vendors'] ?? 0 }}</h3>
                            <p>Total Vendors</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            View All <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Pending Vendors -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $stats['pending_vendors'] ?? 0 }}</h3>
                            <p>Pending Vendors</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-dark">
                            Review Now <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>${{ number_format($stats['revenue'] ?? 0) }}</h3>
                            <p>Total Revenue</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91 2.58.6 4.18 1.54 4.18 3.71 0 1.78-1.37 2.98-3.13 3.29z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            View Report <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Dashboard Content -->
            <div class="row">
                <!-- Recent Activity -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-clock-history"></i> Recent Activity
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Activity</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>New vendor registration</td>
                                            <td>2 minutes ago</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>Profile update</td>
                                            <td>5 minutes ago</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>Mike Johnson</td>
                                            <td>Order placed</td>
                                            <td>10 minutes ago</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td>Sarah Wilson</td>
                                            <td>Payment received</td>
                                            <td>15 minutes ago</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-graph-up"></i> Quick Stats
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Active Users</span>
                                    <strong>1,234</strong>
                                </div>
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Conversion Rate</span>
                                    <strong>23.5%</strong>
                                </div>
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar bg-info" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Bounce Rate</span>
                                    <strong>12.8%</strong>
                                </div>
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar bg-warning" style="width: 28%"></div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-flex justify-content-between">
                                    <span>Avg. Session</span>
                                    <strong>4m 32s</strong>
                                </div>
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar bg-primary" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-hdd-stack"></i> System Status
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Server Load</span>
                                    <span class="badge bg-success">Normal</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Database</span>
                                    <span class="badge bg-success">Online</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>API Services</span>
                                    <span class="badge bg-success">Active</span>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Storage</span>
                                    <span class="badge bg-warning">75% Used</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mt-4">
                <!-- Revenue Chart -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-bar-chart-line"></i> Revenue Overview
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 300px;">
                                <!-- Revenue chart would go here -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-bar-chart" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Revenue chart will be displayed here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Vendors -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-trophy"></i> Top Vendors
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Tech Solutions Inc.</h6>
                                        <small class="text-muted">Electronics</small>
                                    </div>
                                    <span class="badge bg-primary">$12.5K</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Fresh Foods Market</h6>
                                        <small class="text-muted">Groceries</small>
                                    </div>
                                    <span class="badge bg-primary">$9.8K</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Fashion Hub</h6>
                                        <small class="text-muted">Clothing</small>
                                    </div>
                                    <span class="badge bg-primary">$7.2K</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Home Essentials</h6>
                                        <small class="text-muted">Home & Garden</small>
                                    </div>
                                    <span class="badge bg-primary">$6.5K</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Auto Parts Pro</h6>
                                        <small class="text-muted">Automotive</small>
                                    </div>
                                    <span class="badge bg-primary">$5.9K</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-cart-check"></i> Recent Orders
                            </h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-circle"></i> View All Orders
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Vendor</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#ORD-001</td>
                                            <td>John Smith</td>
                                            <td>Tech Solutions Inc.</td>
                                            <td>$245.99</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td>Nov 15, 2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-002</td>
                                            <td>Emma Wilson</td>
                                            <td>Fashion Hub</td>
                                            <td>$189.50</td>
                                            <td><span class="badge bg-warning">Processing</span></td>
                                            <td>Nov 14, 2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-003</td>
                                            <td>Mike Johnson</td>
                                            <td>Home Essentials</td>
                                            <td>$320.75</td>
                                            <td><span class="badge bg-info">Shipped</span></td>
                                            <td>Nov 14, 2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-004</td>
                                            <td>Sarah Brown</td>
                                            <td>Fresh Foods Market</td>
                                            <td>$89.99</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td>Nov 13, 2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.small-box {
    border-radius: 0.375rem;
    position: relative;
    overflow: hidden;
    margin-bottom: 1.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.small-box .inner {
    padding: 1.5rem;
    position: relative;
    z-index: 2;
}

.small-box .inner h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1;
}

.small-box .inner p {
    font-size: 1.1rem;
    margin: 0;
}

.small-box-icon {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 1;
    font-size: 5rem;
    opacity: 0.3;
    width: 80px;
    height: 80px;
    transition: all 0.3s ease;
}

.small-box:hover .small-box-icon {
    transform: scale(1.1);
    opacity: 0.4;
}

.small-box-footer {
    position: relative;
    text-align: center;
    padding: 0.5rem 1rem;
    color: rgba(255, 255, 255, 0.8);
    display: block;
    background: rgba(0, 0, 0, 0.1);
    text-decoration: none;
    transition: all 0.3s ease;
}

.small-box-footer:hover {
    background: rgba(0, 0, 0, 0.15);
    color: #fff;
    text-decoration: none;
}

.text-bg-warning .small-box-footer {
    color: rgba(0, 0, 0, 0.8) !important;
}

.text-bg-warning .small-box-footer:hover {
    color: #000 !important;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    padding: 1rem 1.25rem;
}

.card-title {
    margin-bottom: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.table th {
    border-top: none;
    font-weight: 600;
    background-color: rgba(0, 0, 0, 0.02);
}

.progress {
    border-radius: 0.375rem;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}
</style>
@endsection
