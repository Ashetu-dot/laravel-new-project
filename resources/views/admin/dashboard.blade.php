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
                <!-- Total Vendors -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>156</h3>
                            <p>Total Vendors</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 21.75c2.485 0 4.5-4.03 4.5-9s-2.015-9-4.5-9S9 3.97 9 9s2.015 9 4.5 9z"/>
                            <path d="M3.75 21.75c2.485 0 4.5-4.03 4.5-9s-2.015-9-4.5-9S-.75 3.97-.75 9s2.015 9 4.5 9z"/>
                            <path d="M23.25 21.75c2.485 0 4.5-4.03 4.5-9s-2.015-9-4.5-9-4.5 4.03-4.5 9 2.015 9 4.5 9z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            View All <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>2,847</h3>
                            <p>Registered Customers</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            View All <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>24</h3>
                            <p>Pending Orders</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10H7v-2h10v2z"/>
                        </svg>
                        <a href="#" class="small-box-footer link-dark">
                            Process Now <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>$12,847</h3>
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

            <!-- Charts & Analytics Row -->
            <div class="row">
                <!-- Revenue Chart -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Platform Revenue & Orders</h3>
                        </div>
                        <div class="card-body">
                            <div id="revenue-chart" style="min-height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Quick Stats</h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Pending Vendor Approvals
                                    <span class="badge bg-warning">8</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Service Requests
                                    <span class="badge bg-info">12</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Low Trust Score Vendors
                                    <span class="badge bg-danger">5</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    New Reviews
                                    <span class="badge bg-success">23</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Chatbot Queries Today
                                    <span class="badge bg-primary">156</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-muted">New Vendor Registration</small>
                                        <small class="text-muted">2 min ago</small>
                                    </div>
                                    <p class="mb-1">"Local Grocery Store" registered</p>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-muted">Order Completed</small>
                                        <small class="text-muted">15 min ago</small>
                                    </div>
                                    <p class="mb-1">Order #ORD-2847 marked as delivered</p>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-muted">New Review</small>
                                        <small class="text-muted">1 hour ago</small>
                                    </div>
                                    <p class="mb-1">"Tech Repair Shop" received 5-star rating</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Dashboard specific JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Update notification counts dynamically
        updateNotificationCounts();
        
        // Initialize charts
        initializeDashboardCharts();
    });

    function updateNotificationCounts() {
        // You can fetch real data from your backend here
        fetch('/admin/api/notification-counts')
            .then(response => response.json())
            .then(data => {
                document.getElementById('notification-count').textContent = data.total;
                document.getElementById('pending-vendors-count').textContent = data.pending_vendors;
            })
            .catch(error => console.error('Error fetching notification counts:', error));
    }

    function initializeDashboardCharts() {
        // Revenue chart configuration
        const sales_chart_options = {
            series: [{
                name: 'Revenue',
                data: [2800, 4800, 3900, 2900, 8600, 4700, 9200, 10800, 7500, 8200, 6900, 12500]
            }, {
                name: 'Orders',
                data: [45, 78, 65, 52, 98, 72, 105, 128, 95, 110, 88, 145]
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false }
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth' },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            tooltip: { x: { format: 'MMM yyyy' } }
        };

        const sales_chart = new ApexCharts(document.querySelector('#revenue-chart'), sales_chart_options);
        sales_chart.render();
    }
</script>
@endpush