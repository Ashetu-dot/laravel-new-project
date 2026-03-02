<!-- resources/views/admin/reports/partials/inventory-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-archive-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalProducts ?? 0) }}</div>
            <div class="stat-label">Total Products</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-check-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($inStock ?? 0) }}</div>
            <div class="stat-label">In Stock</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-yellow-light">
            <i class="ri-error-warning-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($lowStock ?? 0) }}</div>
            <div class="stat-label">Low Stock</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-red-light">
            <i class="ri-close-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($outOfStock ?? 0) }}</div>
            <div class="stat-label">Out of Stock</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Inventory Status Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-pie-chart-2-line"></i>
            Inventory Status Overview
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @php
        // Safely calculate percentages with null checks
        $totalProductsValue = $totalProducts ?? 0;
        $inStockValue = $inStock ?? 0;
        $lowStockValue = $lowStock ?? 0;
        $outOfStockValue = $outOfStock ?? 0;

        $inStockPercentage = $inStockPercentage ?? ($totalProductsValue > 0 ? ($inStockValue / $totalProductsValue) * 100 : 0);
        $lowStockPercentage = $lowStockPercentage ?? ($totalProductsValue > 0 ? ($lowStockValue / $totalProductsValue) * 100 : 0);
        $outOfStockPercentage = $outOfStockPercentage ?? ($totalProductsValue > 0 ? ($outOfStockValue / $totalProductsValue) * 100 : 0);
    @endphp

    <div style="display: flex; align-items: center; justify-content: center; gap: 50px; padding: 30px; flex-wrap: wrap;">
        <div style="position: relative; width: 200px; height: 200px;">
            <div style="width: 200px; height: 200px; border-radius: 50%; background: conic-gradient(#10b981 0deg {{ $inStockPercentage * 3.6 }}deg, #f59e0b {{ $inStockPercentage * 3.6 }}deg {{ ($inStockPercentage + $lowStockPercentage) * 3.6 }}deg, #ef4444 {{ ($inStockPercentage + $lowStockPercentage) * 3.6 }}deg 360deg);"></div>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-direction: column; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <span style="font-size: 24px; font-weight: 700; color: var(--text-primary);">{{ number_format($totalProductsValue) }}</span>
                <span style="font-size: 12px; color: var(--text-secondary);">Total Products</span>
            </div>
        </div>

        <div>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                <div style="width: 20px; height: 20px; background: #10b981; border-radius: 4px;"></div>
                <div>
                    <div style="font-weight: 600;">In Stock</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($inStockPercentage, 1) }}% ({{ number_format($inStockValue) }} products)</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                <div style="width: 20px; height: 20px; background: #f59e0b; border-radius: 4px;"></div>
                <div>
                    <div style="font-weight: 600;">Low Stock</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($lowStockPercentage, 1) }}% ({{ number_format($lowStockValue) }} products)</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 20px; height: 20px; background: #ef4444; border-radius: 4px;"></div>
                <div>
                    <div style="font-weight: 600;">Out of Stock</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ number_format($outOfStockPercentage, 1) }}% ({{ number_format($outOfStockValue) }} products)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Value Summary -->
<div class="stats-grid" style="margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-icon bg-gold-light">
            <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($totalStockValue ?? 0, 2) }}</div>
            <div class="stat-label">Total Stock Value</div>
            <div class="stat-period">At cost price</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-price-tag-3-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($totalRetailValue ?? 0, 2) }}</div>
            <div class="stat-label">Retail Value</div>
            <div class="stat-period">At selling price</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-bar-chart-2-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($avgMargin ?? 0, 1) }}%</div>
            <div class="stat-label">Average Margin</div>
            <div class="stat-period">Across all products</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-repeat-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($turnoverRate ?? 0, 1) }}x</div>
            <div class="stat-label">Inventory Turnover</div>
            <div class="stat-period">Last 30 days</div>
        </div>
    </div>
</div>

<!-- Inventory by Category -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-grouped-line"></i>
            Inventory by Category
        </h3>
    </div>

    @if(isset($categoryInventory) && count($categoryInventory) > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th class="text-right">Products</th>
                        <th class="text-right">In Stock</th>
                        <th class="text-right">Low Stock</th>
                        <th class="text-right">Out of Stock</th>
                        <th class="text-right">Stock Value</th>
                        <th class="text-right">Retail Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categoryInventory as $category)
                        <tr>
                            <td>{{ $category['name'] ?? 'N/A' }}</td>
                            <td class="text-right">{{ number_format($category['total_products'] ?? 0) }}</td>
                            <td class="text-right" style="color: #10b981;">{{ number_format($category['in_stock'] ?? 0) }}</td>
                            <td class="text-right" style="color: #f59e0b;">{{ number_format($category['low_stock'] ?? 0) }}</td>
                            <td class="text-right" style="color: #ef4444;">{{ number_format($category['out_of_stock'] ?? 0) }}</td>
                            <td class="text-right">ETB {{ number_format($category['stock_value'] ?? 0, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($category['retail_value'] ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-grouped-line"></i>
            <h3>No Category Data</h3>
        </div>
    @endif
</div>

<!-- Inventory Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-archive-line" style="color: var(--primary-gold);"></i>
            Inventory Details
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyInventoryToClipboard()">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportInventoryToCSV()">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($inventoryData) && $inventoryData->count() > 0)
        <div class="table-responsive">
            <table id="inventoryTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th class="text-right">Current Stock</th>
                        <th class="text-right">Min Stock</th>
                        <th class="text-right">Max Stock</th>
                        <th class="text-right">Reorder Level</th>
                        <th class="text-right">Cost Price</th>
                        <th class="text-right">Selling Price</th>
                        <th class="text-right">Stock Value</th>
                        <th>Status</th>
                        <th>Last Restock</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalStock = 0;
                        $totalStockValue = 0;
                        $totalRetailValue = 0;
                    @endphp

                    @foreach($inventoryData as $item)
                        @php
                            $product = $item->product ?? $item;
                            $stock = $item->stock ?? $product->stock ?? 0;
                            $minStock = $item->min_stock ?? $product->min_stock ?? 5;
                            $maxStock = $item->max_stock ?? $product->max_stock ?? 100;
                            $reorderLevel = $item->reorder_level ?? $product->reorder_level ?? 10;
                            $costPrice = $item->cost_price ?? $product->cost_price ?? ($product->price ?? 0) * 0.7;
                            $price = $product->price ?? 0;
                            $stockValue = $stock * $costPrice;
                            $retailValue = $stock * $price;

                            $totalStock += $stock;
                            $totalStockValue += $stockValue;
                            $totalRetailValue += $retailValue;

                            if ($stock <= 0) {
                                $statusText = 'Out of Stock';
                                $statusColor = 'danger';
                            } elseif ($stock <= $reorderLevel) {
                                $statusText = 'Low Stock';
                                $statusColor = 'warning';
                            } else {
                                $statusText = 'In Stock';
                                $statusColor = 'success';
                            }

                            $needsReorder = $stock <= $reorderLevel;
                        @endphp
                        <tr class="{{ $needsReorder ? 'needs-reorder' : '' }}">
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    @if(isset($product->image) && $product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name ?? '' }}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;">
                                    @else
                                        <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-image-line" style="color: var(--text-secondary);"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-weight: 500;">{{ $product->name ?? 'N/A' }}</div>
                                        @if($needsReorder)
                                            <span class="badge badge-warning" style="font-size: 10px;">Reorder Needed</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->sku ?? 'N/A' }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                @if(isset($product->vendor_id))
                                    <a href="{{ route('admin.vendors.show', $product->vendor_id) }}" style="color: var(--primary-gold); text-decoration: none;">
                                        {{ $product->vendor->store_name ?? 'N/A' }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-right">
                                <span style="font-weight: 600; {{ $needsReorder ? 'color: var(--accent-red);' : '' }}">
                                    {{ number_format($stock) }}
                                </span>
                            </td>
                            <td class="text-right">{{ number_format($minStock) }}</td>
                            <td class="text-right">{{ number_format($maxStock) }}</td>
                            <td class="text-right">{{ number_format($reorderLevel) }}</td>
                            <td class="text-right">ETB {{ number_format($costPrice, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($price, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($stockValue, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>
                                @if(isset($item->last_restock) && $item->last_restock)
                                    {{ \Carbon\Carbon::parse($item->last_restock)->format('M d, Y') }}
                                @elseif(isset($product->last_restock) && $product->last_restock)
                                    {{ \Carbon\Carbon::parse($product->last_restock)->format('M d, Y') }}
                                @else
                                    Never
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f9fafb; font-weight: 600;">
                        <td colspan="4" style="text-align: right;">Totals:</td>
                        <td class="text-right">{{ number_format($totalStock) }}</td>
                        <td colspan="3"></td>
                        <td colspan="2"></td>
                        <td class="text-right">ETB {{ number_format($totalStockValue, 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if(method_exists($inventoryData, 'links'))
            <div class="pagination">
                {{ $inventoryData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-archive-line"></i>
            <h3>No Inventory Data</h3>
            <p>No inventory records found for the selected period.</p>
        </div>
    @endif
</div>

<!-- Reorder Suggestions -->
<div class="card" style="margin-top: 24px;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ri-shopping-cart-2-line"></i>
            Suggested Reorders
        </h3>
        <button class="export-btn" onclick="exportReorderList()">
            <i class="ri-download-line"></i> Export List
        </button>
    </div>

    @if(isset($reorderSuggestions) && count($reorderSuggestions) > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Current Stock</th>
                        <th>Reorder Level</th>
                        <th>Suggested Order</th>
                        <th>Estimated Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reorderSuggestions as $suggestion)
                        @php
                            $suggestedQty = max(($suggestion['max_stock'] ?? 100) - ($suggestion['current_stock'] ?? 0), ($suggestion['reorder_level'] ?? 10) * 2);
                            $estimatedCost = $suggestedQty * ($suggestion['cost_price'] ?? 0);
                        @endphp
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    @if(!empty($suggestion['image']))
                                        <img src="{{ Storage::url($suggestion['image']) }}" alt="" style="width: 30px; height: 30px; border-radius: 4px; object-fit: cover;">
                                    @endif
                                    <span>{{ $suggestion['name'] ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="text-right" style="color: var(--accent-red); font-weight: 600;">{{ number_format($suggestion['current_stock'] ?? 0) }}</td>
                            <td class="text-right">{{ number_format($suggestion['reorder_level'] ?? 0) }}</td>
                            <td class="text-right">{{ number_format($suggestedQty) }} units</td>
                            <td class="text-right">ETB {{ number_format($estimatedCost, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.inventory.reorder', $suggestion['id'] ?? 0) }}" class="action-btn" style="padding: 4px 12px;">
                                    Reorder Now
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state" style="padding: 30px;">
            <i class="ri-check-line"></i>
            <p>No reorder suggestions at this time.</p>
        </div>
    @endif
</div>

@push('styles')
<style>
    .needs-reorder {
        background-color: #fff3e0;
    }

    .needs-reorder:hover td {
        background-color: #ffe4bc !important;
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

    .action-btn {
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-secondary);
        text-decoration: none;
        display: inline-block;
    }

    .action-btn:hover {
        border-color: var(--primary-gold);
        color: var(--primary-gold);
    }
</style>
@endpush

@push('scripts')
<script>
// Copy inventory to clipboard
function copyInventoryToClipboard() {
    const table = document.getElementById('inventoryTable');
    if (!table) return;

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Inventory table copied to clipboard!');
    } catch (err) {
        alert('Failed to copy table');
    }

    window.getSelection().removeAllRanges();
}

// Export inventory to CSV
function exportInventoryToCSV() {
    const table = document.getElementById('inventoryTable');
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
    a.download = 'inventory-report-{{ $dateFrom ?? 'start' }}-to-{{ $dateTo ?? 'end' }}.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);

    showToast('CSV file downloaded successfully!');
}

// Export reorder list
function exportReorderList() {
    showToast('Generating reorder list...');
    // You can implement this based on your routes
     window.location.href = '{{ route("admin.inventory.reorder.export") }}?date_from={{ $dateFrom }}&date_to={{ $dateTo }}';
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
