<!-- resources/views/admin/reports/partials/sales-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($totalRevenue ?? 0, 2) }}</div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-shopping-bag-3-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalOrders ?? 0) }}</div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-user-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($uniqueCustomers ?? 0) }}</div>
            <div class="stat-label">Unique Customers</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-gold-light">
            <i class="ri-price-tag-3-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($averageOrderValue ?? 0, 2) }}</div>
            <div class="stat-label">Average Order Value</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Sales Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-2-line"></i>
            Daily Sales ({{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }})
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()" id="exportChartBtn">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @if(isset($dailySales) && count($dailySales) > 0)
        <div class="bar-chart" id="salesChart">
            @foreach($dailySales as $day)
                <div class="bar-wrapper" data-value="{{ $day['revenue'] ?? 0 }}" data-date="{{ $day['date'] ?? '' }}">
                    <div class="bar" style="height: {{ $day['height'] ?? 0 }}px;"
                         title="{{ \Carbon\Carbon::parse($day['date'])->format('M d, Y') }} - ETB {{ number_format($day['revenue'] ?? 0, 2) }}"></div>
                    <div class="bar-label">{{ $day['label'] ?? \Carbon\Carbon::parse($day['date'])->format('d M') }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-2-line"></i>
            <h3>No Data Available</h3>
            <p>There is no sales data for the selected period.</p>
        </div>
    @endif
</div>

<!-- Sales Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-list-check" style="color: var(--primary-gold);"></i>
            Sales Details
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyTableToClipboard()" id="copyTableBtn">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportTableToCSV()" id="exportCSVBtn">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()" id="printTableBtn">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($salesData) && $salesData->count() > 0)
        <div class="table-responsive">
            <table id="salesTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Tax</th>
                        <th class="text-right">Shipping</th>
                        <th class="text-right">Discount</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSubtotal = 0;
                        $totalTax = 0;
                        $totalShipping = 0;
                        $totalDiscount = 0;
                        $totalGrandTotal = 0;
                    @endphp

                    @foreach($salesData as $sale)
                        @php
                            // Calculate or use provided values
                            $subtotal = $sale->subtotal ?? ($sale->total_amount ?? 0) - ($sale->tax ?? 0) - ($sale->shipping_cost ?? 0) + ($sale->discount_amount ?? 0);
                            $tax = $sale->tax ?? 0;
                            $shipping = $sale->shipping_cost ?? 0;
                            $discount = $sale->discount_amount ?? 0;
                            $total = $sale->total_amount ?? ($subtotal + $tax + $shipping - $discount);

                            $totalSubtotal += $subtotal;
                            $totalTax += $tax;
                            $totalShipping += $shipping;
                            $totalDiscount += $discount;
                            $totalGrandTotal += $total;

                            // Determine status color
                            $statusColor = 'success';
                            $status = strtolower($sale->status ?? 'completed');

                            if(in_array($status, ['pending', 'processing'])) {
                                $statusColor = 'warning';
                            } elseif(in_array($status, ['cancelled', 'failed'])) {
                                $statusColor = 'danger';
                            } elseif($status == 'refunded') {
                                $statusColor = 'info';
                            }
                        @endphp
                        <tr>
                            <td>{{ $sale->created_at ? \Carbon\Carbon::parse($sale->created_at)->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $sale->id) }}" style="color: var(--primary-gold); text-decoration: none; font-weight: 500;">
                                    {{ $sale->order_number ?? '#' . str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="customer-avatar" style="width: 28px; height: 28px; font-size: 12px;">
                                        @if($sale->user && $sale->user->avatar)
                                            <img src="{{ Storage::url($sale->user->avatar) }}" alt="{{ $sale->user->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        @else
                                            {{ $sale->user ? strtoupper(substr($sale->user->name, 0, 2)) : 'GU' }}
                                        @endif
                                    </div>
                                    <span>{{ $sale->user->name ?? 'Guest User' }}</span>
                                </div>
                            </td>
                            <td class="text-center">{{ $sale->items_count ?? ($sale->items ? $sale->items->count() : 0) }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ ucfirst(str_replace('_', ' ', $sale->payment_method ?? 'cash_on_delivery')) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-right font-mono">ETB {{ number_format($subtotal, 2) }}</td>
                            <td class="text-right font-mono">ETB {{ number_format($tax, 2) }}</td>
                            <td class="text-right font-mono">ETB {{ number_format($shipping, 2) }}</td>
                            <td class="text-right font-mono">ETB {{ number_format($discount, 2) }}</td>
                            <td class="text-right font-mono" style="font-weight: 600;">ETB {{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f9fafb; font-weight: 600;">
                        <td colspan="6" style="text-align: right;">Totals:</td>
                        <td class="text-right">ETB {{ number_format($totalSubtotal, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalTax, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalShipping, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalDiscount, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalGrandTotal, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($salesData, 'links') && $salesData->hasPages())
            <div class="pagination">
                {{ $salesData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-file-list-3-line"></i>
            <h3>No Sales Data</h3>
            <p>No sales records found for the selected period.</p>
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

    .table-container {
        overflow-x: auto;
        margin-bottom: 24px;
        background-color: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    th {
        white-space: nowrap;
        background-color: #f9fafb;
        padding: 16px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
    }

    td {
        white-space: nowrap;
        padding: 16px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
    }

    td:last-child, th:last-child {
        padding-right: 24px;
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

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .font-mono {
        font-family: monospace;
    }

    .bar-chart {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        height: 240px;
        gap: 8px;
        margin-top: 30px;
        overflow-x: auto;
        padding-bottom: 10px;
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
        background: linear-gradient(to top, var(--primary-gold), #e6b450);
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
        transform: rotate(-45deg);
        white-space: nowrap;
        position: absolute;
        bottom: -25px;
    }

    .export-options {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .export-btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-secondary);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .export-btn:hover {
        border-color: var(--primary-gold);
        color: var(--primary-gold);
    }

    @media print {
        .export-options, .pagination, .filter-section {
            display: none !important;
        }

        .table-container {
            box-shadow: none;
            padding: 0;
        }

        table {
            min-width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    initializeTooltips();

    // Add loading states to export buttons
    const exportBtns = document.querySelectorAll('.export-btn');
    exportBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.id !== 'printTableBtn') {
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="spinner" style="width: 14px; height: 14px;"></span> Processing...';
                this.disabled = true;

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 1000);
            }
        });
    });
});

// Initialize tooltips for chart bars
function initializeTooltips() {
    const bars = document.querySelectorAll('.bar-wrapper');
    bars.forEach(bar => {
        bar.addEventListener('mouseenter', function(e) {
            const value = this.dataset.value;
            const date = this.dataset.date;
            if (value && date) {
                const tooltip = document.createElement('div');
                tooltip.className = 'chart-tooltip';
                tooltip.style.position = 'absolute';
                tooltip.style.top = '-40px';
                tooltip.style.left = '50%';
                tooltip.style.transform = 'translateX(-50%)';
                tooltip.style.backgroundColor = 'var(--sidebar-bg)';
                tooltip.style.color = 'white';
                tooltip.style.padding = '4px 8px';
                tooltip.style.borderRadius = '4px';
                tooltip.style.fontSize = '11px';
                tooltip.style.whiteSpace = 'nowrap';
                tooltip.style.zIndex = '1000';
                tooltip.textContent = `${date}: ETB ${parseFloat(value).toFixed(2)}`;

                this.style.position = 'relative';
                this.appendChild(tooltip);
            }
        });

        bar.addEventListener('mouseleave', function() {
            const tooltip = this.querySelector('.chart-tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
}

// Export chart as image
function exportChart() {
    const chart = document.getElementById('salesChart');
    if (!chart) {
        alert('No chart data available to export');
        return;
    }

    // Show loading state
    const exportBtn = document.getElementById('exportChartBtn');
    const originalText = exportBtn.innerHTML;
    exportBtn.innerHTML = '<span class="spinner"></span> Exporting...';
    exportBtn.disabled = true;

    // Simulate chart export (replace with actual chart export logic)
    setTimeout(() => {
        alert('Chart export functionality will be implemented with your preferred charting library');
        exportBtn.innerHTML = originalText;
        exportBtn.disabled = false;
    }, 1000);
}

// Copy table to clipboard
function copyTableToClipboard() {
    const table = document.getElementById('salesTable');
    if (!table) {
        alert('No table data available to copy');
        return;
    }

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Table copied to clipboard successfully!');
    } catch (err) {
        console.error('Failed to copy table:', err);
        alert('Failed to copy table to clipboard');
    }

    window.getSelection().removeAllRanges();
}

// Export table to CSV
function exportTableToCSV() {
    const table = document.getElementById('salesTable');
    if (!table) {
        alert('No table data available to export');
        return;
    }

    const rows = table.querySelectorAll('tr');
    const csv = [];

    // Process header row
    const headers = [];
    const headerCells = rows[0].querySelectorAll('th');
    headerCells.forEach(cell => {
        headers.push(cell.textContent.trim());
    });
    csv.push(headers.join(','));

    // Process data rows (skip footer if present)
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];

        // Skip if this is the footer row
        if (row.querySelector('tfoot') || row.classList.contains('footer')) {
            continue;
        }

        const cols = row.querySelectorAll('td');
        const rowData = [];

        for (const col of cols) {
            // Clean the text content - remove ETB and commas, but keep numbers
            let text = col.textContent.trim();

            // Handle currency values
            if (text.includes('ETB')) {
                text = text.replace('ETB', '').trim();
            }

            // Remove commas from numbers but keep decimal points
            if (!isNaN(text.replace(/,/g, ''))) {
                text = text.replace(/,/g, '');
            }

            rowData.push('"' + text + '"'); // Wrap in quotes to handle commas in data
        }

        csv.push(rowData.join(','));
    }

    // Add footer totals if present
    const footerRows = table.querySelectorAll('tfoot tr');
    if (footerRows.length > 0) {
        const footerData = [];
        const footerCells = footerRows[0].querySelectorAll('td');
        footerCells.forEach(cell => {
            let text = cell.textContent.trim();
            if (text.includes('ETB')) {
                text = text.replace('ETB', '').trim();
            }
            footerData.push('"' + text + '"');
        });
        csv.push(footerData.join(','));
    }

    // Create and download CSV file
    const csvContent = csv.join('\n');
    const blob = new Blob(["\uFEFF" + csvContent], { type: 'text/csv;charset=utf-8;' }); // Add BOM for UTF-8
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'sales-report-{{ $dateFrom }}-to-{{ $dateTo }}.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);

    showToast('CSV file downloaded successfully!');
}

// Show toast notification
function showToast(message) {
    // Create toast element if it doesn't exist
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
        toast.style.transition = 'opacity 0.3s';
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.style.opacity = '1';

    setTimeout(() => {
        toast.style.opacity = '0';
    }, 3000);
}

// Add spinner animation if not exists
if (!document.querySelector('#spinner-style')) {
    const style = document.createElement('style');
    style.id = 'spinner-style';
    style.textContent = `
        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            margin-right: 4px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
}
</script>
@endpush
