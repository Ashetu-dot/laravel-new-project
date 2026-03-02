<!-- resources/views/admin/reports/partials/customers-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-user-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalCustomers ?? 0) }}</div>
            <div class="stat-label">Total Customers</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-user-add-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($newCustomers ?? 0) }}</div>
            <div class="stat-label">New Customers</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-shopping-bag-3-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalCustomerOrders ?? 0) }}</div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-gold-light">
            <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($avgCustomerSpend ?? 0, 2) }}</div>
            <div class="stat-label">Avg. Customer Spend</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Customer Acquisition Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-2-line"></i>
            New Customers Over Time
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @if(isset($customerAcquisition) && count($customerAcquisition) > 0)
        <div class="bar-chart" style="height: 250px;">
            @foreach($customerAcquisition as $period)
                <div class="bar-wrapper" style="flex: 1; min-width: 40px;">
                    <div class="bar" style="height: {{ $period['height'] ?? 50 }}px; background: linear-gradient(to top, #8b5cf6, #a78bfa);"
                         title="{{ $period['label'] }}: {{ $period['count'] }} new customers"></div>
                    <div class="bar-label" style="transform: rotate(-45deg);">{{ $period['label'] }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-2-line"></i>
            <h3>No Data Available</h3>
            <p>There is no customer acquisition data for the selected period.</p>
        </div>
    @endif
</div>

<!-- Customer Segmentation -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-pie-chart-2-line"></i>
            Customer Segmentation
        </h3>
    </div>

    @if(isset($customerSegments) && count($customerSegments) > 0)
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px;">
            @foreach($customerSegments as $segment)
                <div style="text-align: center; min-width: 150px;">
                    <div style="width: 120px; height: 120px; border-radius: 50%; margin: 0 auto 15px; position: relative; background: conic-gradient({{ $segment['color'] }} 0deg {{ $segment['percentage'] * 3.6 }}deg, #f3f4f6 {{ $segment['percentage'] * 3.6 }}deg 360deg);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: 600; font-size: 20px;">{{ $segment['percentage'] }}%</div>
                    </div>
                    <div style="font-weight: 600; margin-bottom: 5px;">{{ $segment['name'] }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ $segment['count'] }} customers</div>
                    <div style="color: var(--text-secondary); font-size: 12px;">Avg: ETB {{ number_format($segment['avg_spend'] ?? 0, 2) }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-pie-chart-2-line"></i>
            <h3>No Segmentation Data</h3>
        </div>
    @endif
</div>

<!-- Top Customers Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-star-line" style="color: var(--primary-gold);"></i>
            Top Customers by Spending
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyCustomersToClipboard()">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportCustomersToCSV()">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($customersData) && $customersData->count() > 0)
        <div class="table-responsive">
            <table id="customersTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Joined Date</th>
                        <th class="text-right">Total Orders</th>
                        <th class="text-right">Total Spent</th>
                        <th class="text-right">Avg. Order Value</th>
                        <th>Last Order</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSpentAll = 0;
                        $totalOrdersAll = 0;
                    @endphp

                    @foreach($customersData as $customer)
                        @php
                            $totalSpent = $customer->total_spent ?? 0;
                            $orderCount = $customer->orders_count ?? 0;
                            $avgOrder = $orderCount > 0 ? $totalSpent / $orderCount : 0;

                            $totalSpentAll += $totalSpent;
                            $totalOrdersAll += $orderCount;

                            $daysSinceLastOrder = $customer->last_order_date ? now()->diffInDays(\Carbon\Carbon::parse($customer->last_order_date)) : null;

                            if ($daysSinceLastOrder === null) {
                                $status = 'new';
                                $statusText = 'No Orders';
                                $statusColor = 'info';
                            } elseif ($daysSinceLastOrder <= 30) {
                                $status = 'active';
                                $statusText = 'Active';
                                $statusColor = 'success';
                            } elseif ($daysSinceLastOrder <= 90) {
                                $status = 'recent';
                                $statusText = 'Recent';
                                $statusColor = 'warning';
                            } else {
                                $status = 'inactive';
                                $statusText = 'Inactive';
                                $statusColor = 'danger';
                            }
                        @endphp
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="customer-avatar" style="width: 32px; height: 32px;">
                                        @if($customer->avatar)
                                            <img src="{{ Storage::url($customer->avatar) }}" alt="{{ $customer->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        @else
                                            {{ strtoupper(substr($customer->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <span style="font-weight: 500;">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? 'N/A' }}</td>
                            <td>{{ $customer->city ?? 'N/A' }}{{ $customer->country ? ', ' . $customer->country : '' }}</td>
                            <td>{{ $customer->created_at ? \Carbon\Carbon::parse($customer->created_at)->format('M d, Y') : 'N/A' }}</td>
                            <td class="text-right">{{ number_format($orderCount) }}</td>
                            <td class="text-right">ETB {{ number_format($totalSpent, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($avgOrder, 2) }}</td>
                            <td>
                                @if($customer->last_order_date)
                                    {{ \Carbon\Carbon::parse($customer->last_order_date)->format('M d, Y') }}
                                @else
                                    Never
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f9fafb; font-weight: 600;">
                        <td colspan="5" style="text-align: right;">Totals / Averages:</td>
                        <td class="text-right">{{ number_format($totalOrdersAll) }}</td>
                        <td class="text-right">ETB {{ number_format($totalSpentAll, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalOrdersAll > 0 ? $totalSpentAll / $totalOrdersAll : 0, 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if(method_exists($customersData, 'links'))
            <div class="pagination">
                {{ $customersData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-user-line"></i>
            <h3>No Customers Found</h3>
            <p>No customer data found for the selected period.</p>
        </div>
    @endif
</div>

@push('styles')
<style>
    .customer-avatar {
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

    .customer-avatar img {
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

    .bar-chart {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        height: 250px;
        gap: 8px;
        margin-top: 20px;
        overflow-x: auto;
        padding-bottom: 30px;
    }

    .bar-wrapper {
        flex: 1;
        min-width: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .bar {
        width: 100%;
        border-radius: 4px 4px 0 0;
        transition: height 0.3s ease;
        min-height: 4px;
        cursor: pointer;
    }

    .bar:hover {
        opacity: 0.9;
        transform: scale(1.02);
    }

    .bar-label {
        font-size: 11px;
        color: var(--text-secondary);
        white-space: nowrap;
        position: absolute;
        bottom: -25px;
    }
</style>
@endpush

@push('scripts')
<script>
// Copy customers to clipboard
function copyCustomersToClipboard() {
    const table = document.getElementById('customersTable');
    if (!table) return;

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Customers table copied to clipboard!');
    } catch (err) {
        alert('Failed to copy table');
    }

    window.getSelection().removeAllRanges();
}

// Export customers to CSV
function exportCustomersToCSV() {
    const table = document.getElementById('customersTable');
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
            rowData.push('"' + text + '"');
        });
        csv.push(rowData.join(','));
    }

    // Download
    const blob = new Blob(["\uFEFF" + csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'customers-report-{{ $dateFrom }}-to-{{ $dateTo }}.csv';
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
