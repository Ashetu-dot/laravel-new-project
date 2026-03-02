<!-- resources/views/admin/reports/partials/vendors-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-store-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalVendors ?? 0) }}</div>
            <div class="stat-label">Total Vendors</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-store-2-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($activeVendors ?? 0) }}</div>
            <div class="stat-label">Active Vendors</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-shopping-cart-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalVendorProducts ?? 0) }}</div>
            <div class="stat-label">Total Products</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-gold-light">
            <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($totalVendorSales ?? 0, 2) }}</div>
            <div class="stat-label">Total Sales</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Vendor Performance Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-2-line"></i>
            Top Vendors by Sales
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @if(isset($topVendors) && count($topVendors) > 0)
        <div style="padding: 20px;">
            @foreach($topVendors as $index => $vendor)
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="width: 30px; height: 30px; background-color: var(--primary-gold); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">{{ $index + 1 }}</div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="font-weight: 500;">{{ $vendor->store_name ?? $vendor->name }}</span>
                            <span style="font-weight: 600; color: var(--primary-gold);">ETB {{ number_format($vendor->total_sales ?? 0, 2) }}</span>
                        </div>
                        <div style="height: 8px; background-color: #f3f4f6; border-radius: 4px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $vendor->percentage ?? 0 }}%; background: linear-gradient(90deg, var(--primary-gold), #e6b450); border-radius: 4px;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 12px; color: var(--text-secondary);">
                            <span>{{ number_format($vendor->products_count ?? 0) }} products</span>
                            <span>{{ number_format($vendor->orders_count ?? 0) }} orders</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-2-line"></i>
            <h3>No Data Available</h3>
            <p>There is no vendor performance data for the selected period.</p>
        </div>
    @endif
</div>

<!-- Vendor Status Distribution -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-pie-chart-2-line"></i>
            Vendor Status Distribution
        </h3>
    </div>

    @if(isset($vendorStatusStats) && count($vendorStatusStats) > 0)
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px;">
            @foreach($vendorStatusStats as $status)
                <div style="text-align: center; min-width: 120px;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 15px; position: relative; background: conic-gradient({{ $status['color'] }} 0deg {{ $status['percentage'] * 3.6 }}deg, #f3f4f6 {{ $status['percentage'] * 3.6 }}deg 360deg);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: 600; font-size: 18px;">{{ $status['percentage'] }}%</div>
                    </div>
                    <div style="font-weight: 600; margin-bottom: 5px;">{{ $status['label'] }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ $status['count'] }} vendors</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-pie-chart-2-line"></i>
            <h3>No Status Data</h3>
        </div>
    @endif
</div>

<!-- Vendors Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-store-line" style="color: var(--primary-gold);"></i>
            Vendor Performance Details
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyVendorsToClipboard()">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportVendorsToCSV()">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($vendorsData) && $vendorsData->count() > 0)
        <div class="table-responsive">
            <table id="vendorsTable">
                <thead>
                    <tr>
                        <th>Vendor</th>
                        <th>Store Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Joined Date</th>
                        <th class="text-right">Products</th>
                        <th class="text-right">Orders</th>
                        <th class="text-right">Total Sales</th>
                        <th class="text-right">Commission</th>
                        <th class="text-right">Earnings</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalProductsAll = 0;
                        $totalOrdersAll = 0;
                        $totalSalesAll = 0;
                        $totalCommissionAll = 0;
                        $totalEarningsAll = 0;
                    @endphp

                    @foreach($vendorsData as $vendor)
                        @php
                            $productsCount = $vendor->products_count ?? 0;
                            $ordersCount = $vendor->orders_count ?? 0;
                            $totalSales = $vendor->total_sales ?? 0;
                            $commission = $vendor->commission ?? 0;
                            $commissionRate = $vendor->commission_rate ?? 10; // Default 10%
                            $commissionAmount = $totalSales * ($commissionRate / 100);
                            $earnings = $totalSales - $commissionAmount;

                            $totalProductsAll += $productsCount;
                            $totalOrdersAll += $ordersCount;
                            $totalSalesAll += $totalSales;
                            $totalCommissionAll += $commissionAmount;
                            $totalEarningsAll += $earnings;

                            $isActive = $vendor->is_active ?? true;
                            $isVerified = $vendor->is_verified ?? false;

                            if ($isActive && $isVerified) {
                                $statusText = 'Active';
                                $statusColor = 'success';
                            } elseif ($isActive && !$isVerified) {
                                $statusText = 'Pending';
                                $statusColor = 'warning';
                            } else {
                                $statusText = 'Inactive';
                                $statusColor = 'danger';
                            }
                        @endphp
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="vendor-avatar" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-gold), #9c7832); color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; overflow: hidden;">
                                        @if($vendor->avatar)
                                            <img src="{{ Storage::url($vendor->avatar) }}" alt="{{ $vendor->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            {{ strtoupper(substr($vendor->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <span style="font-weight: 500;">{{ $vendor->name }}</span>
                                </div>
                            </td>
                            <td>{{ $vendor->store_name ?? 'N/A' }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->phone ?? 'N/A' }}</td>
                            <td>{{ $vendor->city ?? 'N/A' }}{{ $vendor->country ? ', ' . $vendor->country : '' }}</td>
                            <td>{{ $vendor->created_at ? \Carbon\Carbon::parse($vendor->created_at)->format('M d, Y') : 'N/A' }}</td>
                            <td class="text-right">{{ number_format($productsCount) }}</td>
                            <td class="text-right">{{ number_format($ordersCount) }}</td>
                            <td class="text-right">ETB {{ number_format($totalSales, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($commissionAmount, 2) }} <span style="font-size: 11px; color: var(--text-secondary);">({{ $commissionRate }}%)</span></td>
                            <td class="text-right">ETB {{ number_format($earnings, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                                @if(!$isVerified && $isActive)
                                    <span class="badge badge-warning" style="margin-left: 5px;">Unverified</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f9fafb; font-weight: 600;">
                        <td colspan="6" style="text-align: right;">Totals:</td>
                        <td class="text-right">{{ number_format($totalProductsAll) }}</td>
                        <td class="text-right">{{ number_format($totalOrdersAll) }}</td>
                        <td class="text-right">ETB {{ number_format($totalSalesAll, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalCommissionAll, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalEarningsAll, 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if(method_exists($vendorsData, 'links'))
            <div class="pagination">
                {{ $vendorsData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-store-line"></i>
            <h3>No Vendors Found</h3>
            <p>No vendor data found for the selected period.</p>
        </div>
    @endif
</div>

<!-- Recent Vendor Activities -->
<div class="recent-section" style="margin-top: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Recent Products -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ri-shopping-cart-line"></i>
                Recent Products Added
            </h3>
        </div>
        @if(isset($recentProducts) && $recentProducts->count() > 0)
            <div style="padding: 16px;">
                @foreach($recentProducts as $product)
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;">
                        @else
                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 4px;"></div>
                        @endif
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">{{ $product->name }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ $product->vendor->store_name ?? 'N/A' }} • {{ $product->created_at->diffForHumans() }}</div>
                        </div>
                        <div style="font-weight: 600;">ETB {{ number_format($product->price, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="padding: 30px;">
                <i class="ri-shopping-cart-line"></i>
                <p>No recent products</p>
            </div>
        @endif
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ri-shopping-bag-3-line"></i>
                Recent Vendor Orders
            </h3>
        </div>
        @if(isset($recentVendorOrders) && $recentVendorOrders->count() > 0)
            <div style="padding: 16px;">
                @foreach($recentVendorOrders as $order)
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                        <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-shopping-bag-line" style="color: var(--text-secondary);"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">#{{ $order->order_number ?? $order->id }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ $order->vendor->store_name ?? 'N/A' }} • {{ $order->created_at->diffForHumans() }}</div>
                        </div>
                        <div>
                            <span class="badge badge-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="padding: 30px;">
                <i class="ri-shopping-bag-3-line"></i>
                <p>No recent orders</p>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .vendor-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-gold), #9c7832);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        overflow: hidden;
    }

    .vendor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    tfoot td {
        border-top: 2px solid var(--border-color);
        font-size: 14px;
    }

    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }

    .badge-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background-color: #fed7aa;
        color: #92400e;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-info {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .recent-section {
        margin-top: 24px;
    }

    .card {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        padding: 20px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-title i {
        color: var(--primary-gold);
    }
</style>
@endpush

@push('scripts')
<script>
// Copy vendors to clipboard
function copyVendorsToClipboard() {
    const table = document.getElementById('vendorsTable');
    if (!table) return;

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Vendors table copied to clipboard!');
    } catch (err) {
        alert('Failed to copy table');
    }

    window.getSelection().removeAllRanges();
}

// Export vendors to CSV
function exportVendorsToCSV() {
    const table = document.getElementById('vendorsTable');
    if (!table) return;

    const rows = table.querySelectorAll('tr');
    const csv = [];

    // Headers
    const headers = [];
    rows[0].querySelectorAll('th').forEach(th => {
        headers.push(th.textContent.trim());
    });
    csv.push(headers.join(','));

    // Data rows (skip footer)
    for (let i = 1; i < rows.length - 1; i++) {
        const row = rows[i];
        const rowData = [];
        row.querySelectorAll('td').forEach(td => {
            let text = td.textContent.trim().replace(/,/g, '');
            // Handle the nested badge text
            if (td.querySelector('.badge')) {
                text = td.querySelector('.badge').textContent.trim();
            }
            rowData.push('"' + text + '"');
        });
        csv.push(rowData.join(','));
    }

    // Download
    const blob = new Blob(["\uFEFF" + csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'vendors-report-{{ $dateFrom }}-to-{{ $dateTo }}.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);

    showToast('CSV file downloaded successfully!');
}

// Export chart
function exportChart() {
    showToast('Chart export functionality coming soon');
}

// Show toast notification
function showToast(message) {
    let toast = document.getElementById('toast-notification');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast-notification';
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.right = '20px';
        toast.style.backgroundColor = 'var(--primary-gold)';
        toast.style.color = 'white';
        toast.style.padding = '12px 24px';
        toast.style.borderRadius = '8px';
        toast.style.zIndex = '9999';
        toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.style.opacity = '1';

    setTimeout(() => {
        toast.style.opacity = '0';
    }, 3000);
}
</script>
@endpush
