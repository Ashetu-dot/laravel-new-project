<!-- resources/views/admin/reports/partials/orders-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
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
        <div class="stat-icon bg-green-light">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($completedOrders ?? 0) }}</div>
            <div class="stat-label">Completed Orders</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-yellow-light">
            <i class="ri-time-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($pendingOrders ?? 0) }}</div>
            <div class="stat-label">Pending Orders</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-price-tag-3-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($averageOrderValue ?? 0, 2) }}</div>
            <div class="stat-label">Average Order Value</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Order Status Distribution -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-pie-chart-2-line"></i>
            Order Status Distribution
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @if(isset($orderStatusStats) && count($orderStatusStats) > 0)
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px;">
            @foreach($orderStatusStats as $status)
                <div style="text-align: center; min-width: 120px;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 15px; position: relative; background: conic-gradient({{ $status['color'] }} 0deg {{ $status['percentage'] * 3.6 }}deg, #f3f4f6 {{ $status['percentage'] * 3.6 }}deg 360deg);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: 600; font-size: 18px;">{{ $status['percentage'] }}%</div>
                    </div>
                    <div style="font-weight: 600; margin-bottom: 5px;">{{ $status['label'] }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ $status['count'] }} orders</div>
                </div>
            @endforeach
        </div>

        <!-- Summary Table -->
        <div style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
            <table style="width: 100%; max-width: 600px; margin: 0 auto;">
                <tr>
                    <td style="padding: 8px; border: none;">Total Orders:</td>
                    <td style="padding: 8px; border: none; font-weight: 600;">{{ number_format($totalOrders ?? 0) }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: none;">Completion Rate:</td>
                    <td style="padding: 8px; border: none; font-weight: 600;">{{ number_format($completionRate ?? 0, 1) }}%</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: none;">Cancellation Rate:</td>
                    <td style="padding: 8px; border: none; font-weight: 600;">{{ number_format($cancellationRate ?? 0, 1) }}%</td>
                </tr>
            </table>
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-pie-chart-2-line"></i>
            <h3>No Data Available</h3>
            <p>There is no order data for the selected period.</p>
        </div>
    @endif
</div>

<!-- Daily Orders Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-2-line"></i>
            Daily Orders ({{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }})
        </h3>
    </div>

    @if(isset($dailyOrders) && count($dailyOrders) > 0)
        <div class="bar-chart" style="height: 250px;">
            @foreach($dailyOrders as $day)
                <div class="bar-wrapper" style="flex: 1; min-width: 40px;">
                    <div class="bar" style="height: {{ $day['height'] ?? 50 }}px; background: linear-gradient(to top, #3b82f6, #60a5fa);"
                         title="{{ $day['date'] }}: {{ $day['count'] }} orders"></div>
                    <div class="bar-label" style="transform: rotate(-45deg);">{{ $day['label'] }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-2-line"></i>
            <h3>No Data Available</h3>
        </div>
    @endif
</div>

<!-- Orders Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-list-check" style="color: var(--primary-gold);"></i>
            Orders Details
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyOrdersToClipboard()">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportOrdersToCSV()">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($ordersData) && $ordersData->count() > 0)
        <div class="table-responsive">
            <table id="ordersTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Shipping</th>
                        <th class="text-right">Tax</th>
                        <th class="text-right">Discount</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSubtotal = 0;
                        $totalShipping = 0;
                        $totalTax = 0;
                        $totalDiscount = 0;
                        $totalGrandTotal = 0;
                    @endphp

                    @foreach($ordersData as $order)
                        @php
                            $subtotal = $order->subtotal ?? ($order->total_amount - ($order->tax ?? 0) - ($order->shipping_cost ?? 0) + ($order->discount_amount ?? 0));
                            $shipping = $order->shipping_cost ?? 0;
                            $tax = $order->tax ?? 0;
                            $discount = $order->discount_amount ?? 0;
                            $total = $order->total_amount ?? 0;

                            $totalSubtotal += $subtotal;
                            $totalShipping += $shipping;
                            $totalTax += $tax;
                            $totalDiscount += $discount;
                            $totalGrandTotal += $total;

                            $statusColor = match(strtolower($order->status ?? 'pending')) {
                                'completed', 'delivered' => 'success',
                                'processing', 'pending' => 'warning',
                                'cancelled', 'failed' => 'danger',
                                'refunded' => 'info',
                                default => 'warning'
                            };
                        @endphp
                        <tr>
                            <td>{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" style="color: var(--primary-gold); text-decoration: none; font-weight: 500;">
                                    {{ $order->order_number ?? '#' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="customer-avatar" style="width: 28px; height: 28px; font-size: 12px;">
                                        @if($order->user && $order->user->avatar)
                                            <img src="{{ Storage::url($order->user->avatar) }}" alt="" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        @else
                                            {{ $order->user ? strtoupper(substr($order->user->name, 0, 2)) : 'GU' }}
                                        @endif
                                    </div>
                                    <span>{{ $order->user->name ?? 'Guest User' }}</span>
                                </div>
                            </td>
                            <td class="text-center">{{ $order->items_count ?? ($order->items ? $order->items->count() : 0) }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ ucfirst($order->status ?? 'pending') }}
                                </span>
                            </td>
                            <td class="text-right">ETB {{ number_format($subtotal, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($shipping, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($tax, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($discount, 2) }}</td>
                            <td class="text-right" style="font-weight: 600;">ETB {{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f9fafb; font-weight: 600;">
                        <td colspan="6" style="text-align: right;">Totals:</td>
                        <td class="text-right">ETB {{ number_format($totalSubtotal, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalShipping, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalTax, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalDiscount, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalGrandTotal, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if(method_exists($ordersData, 'links'))
            <div class="pagination">
                {{ $ordersData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-shopping-bag-3-line"></i>
            <h3>No Orders Found</h3>
            <p>No orders found for the selected period.</p>
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
// Copy orders to clipboard
function copyOrdersToClipboard() {
    const table = document.getElementById('ordersTable');
    if (!table) return;

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Orders table copied to clipboard!');
    } catch (err) {
        alert('Failed to copy table');
    }

    window.getSelection().removeAllRanges();
}

// Export orders to CSV
function exportOrdersToCSV() {
    const table = document.getElementById('ordersTable');
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
    a.download = 'orders-report-{{ $dateFrom }}-to-{{ $dateTo }}.csv';
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
