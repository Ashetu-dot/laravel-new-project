<!-- resources/views/admin/reports/partials/products-report.blade.php -->

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-green-light">
            <i class="ri-shopping-cart-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalProducts ?? 0) }}</div>
            <div class="stat-label">Total Products</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-blue-light">
            <i class="ri-eye-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalViews ?? 0) }}</div>
            <div class="stat-label">Total Views</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-purple-light">
            <i class="ri-star-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">{{ number_format($totalReviews ?? 0) }}</div>
            <div class="stat-label">Total Reviews</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-gold-light">
            <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div class="stat-details">
            <div class="stat-value">ETB {{ number_format($totalProductSales ?? 0, 2) }}</div>
            <div class="stat-label">Total Sales</div>
            <div class="stat-period">{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<!-- Top Products Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-bar-chart-2-line"></i>
            Top 10 Best Selling Products
        </h3>
        <div class="export-options">
            <button class="export-btn" onclick="exportChart()">
                <i class="ri-download-line"></i> Export Chart
            </button>
        </div>
    </div>

    @if(isset($topProducts) && count($topProducts) > 0)
        <div style="padding: 20px;">
            @foreach($topProducts as $index => $product)
                @php
                    $percentage = $product->percentage ?? ($product->total_sold / $topProducts->max('total_sold') * 100);
                @endphp
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="width: 30px; height: 30px; background-color: var(--primary-gold); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">{{ $index + 1 }}</div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <div>
                                <span style="font-weight: 500;">{{ $product->name }}</span>
                                <span style="font-size: 12px; color: var(--text-secondary); margin-left: 10px;">{{ $product->vendor->store_name ?? 'N/A' }}</span>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-weight: 600; color: var(--primary-gold);">{{ number_format($product->total_sold ?? 0) }} sold</span>
                                <span style="font-size: 12px; color: var(--text-secondary); margin-left: 15px;">ETB {{ number_format($product->revenue ?? 0, 2) }}</span>
                            </div>
                        </div>
                        <div style="height: 8px; background-color: #f3f4f6; border-radius: 4px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $percentage }}%; background: linear-gradient(90deg, var(--primary-gold), #e6b450); border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-bar-chart-2-line"></i>
            <h3>No Data Available</h3>
            <p>There is no product sales data for the selected period.</p>
        </div>
    @endif
</div>

<!-- Category Distribution -->
<div class="chart-container">
    <div class="chart-header">
        <h3>
            <i class="ri-pie-chart-2-line"></i>
            Products by Category
        </h3>
    </div>

    @if(isset($categoryStats) && count($categoryStats) > 0)
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px;">
            @foreach($categoryStats as $category)
                <div style="text-align: center; min-width: 120px;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 15px; position: relative; background: conic-gradient({{ $category['color'] }} 0deg {{ $category['percentage'] * 3.6 }}deg, #f3f4f6 {{ $category['percentage'] * 3.6 }}deg 360deg);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: 600; font-size: 18px;">{{ $category['percentage'] }}%</div>
                    </div>
                    <div style="font-weight: 600; margin-bottom: 5px;">{{ $category['name'] }}</div>
                    <div style="color: var(--text-secondary); font-size: 13px;">{{ $category['count'] }} products</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px;">
            <i class="ri-pie-chart-2-line"></i>
            <h3>No Category Data</h3>
        </div>
    @endif
</div>

<!-- Products Table -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h3 style="font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="ri-shopping-cart-line" style="color: var(--primary-gold);"></i>
            Products Report
        </h3>
        <div class="export-options" style="margin-bottom: 0;">
            <button class="export-btn" onclick="copyProductsToClipboard()">
                <i class="ri-file-copy-line"></i> Copy
            </button>
            <button class="export-btn" onclick="exportProductsToCSV()">
                <i class="ri-file-excel-line"></i> CSV
            </button>
            <button class="export-btn" onclick="window.print()">
                <i class="ri-printer-line"></i> Print
            </button>
        </div>
    </div>

    @if(isset($productsData) && $productsData->count() > 0)
        <div class="table-responsive">
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Cost</th>
                        <th class="text-right">Margin</th>
                        <th class="text-right">Stock</th>
                        <th class="text-right">Sold</th>
                        <th class="text-right">Revenue</th>
                        <th class="text-right">Views</th>
                        <th>Rating</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0;
                        $totalCost = 0;
                        $totalStock = 0;
                        $totalSold = 0;
                        $totalRevenue = 0;
                        $totalViews = 0;
                    @endphp

                    @foreach($productsData as $product)
                        @php
                            $price = $product->price ?? 0;
                            $cost = $product->cost_price ?? ($price * 0.7);
                            $margin = $price - $cost;
                            $marginPercentage = $price > 0 ? ($margin / $price) * 100 : 0;

                            $sold = $product->total_sold ?? 0;
                            $revenue = $product->total_revenue ?? ($price * $sold);
                            $views = $product->views ?? 0;
                            $stock = $product->stock ?? 0;
                            $rating = $product->avg_rating ?? 0;

                            $totalPrice += $price;
                            $totalCost += $cost;
                            $totalStock += $stock;
                            $totalSold += $sold;
                            $totalRevenue += $revenue;
                            $totalViews += $views;

                            if ($stock <= 0) {
                                $statusText = 'Out of Stock';
                                $statusColor = 'danger';
                            } elseif ($stock <= 5) {
                                $statusText = 'Low Stock';
                                $statusColor = 'warning';
                            } else {
                                $statusText = 'In Stock';
                                $statusColor = 'success';
                            }

                            $isActive = $product->is_active ?? true;
                            if (!$isActive) {
                                $statusText = 'Inactive';
                                $statusColor = 'secondary';
                            }
                        @endphp
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;">
                                    @else
                                        <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-image-line" style="color: var(--text-secondary);"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-weight: 500;">{{ $product->name }}</div>
                                        <div style="font-size: 11px; color: var(--text-secondary);">{{ Str::limit($product->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->sku ?? 'N/A' }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.vendors.show', $product->vendor_id) }}" style="color: var(--primary-gold); text-decoration: none;">
                                    {{ $product->vendor->store_name ?? 'N/A' }}
                                </a>
                            </td>
                            <td class="text-right">ETB {{ number_format($price, 2) }}</td>
                            <td class="text-right">ETB {{ number_format($cost, 2) }}</td>
                            <td class="text-right">
                                <span style="color: {{ $marginPercentage > 20 ? 'var(--accent-green)' : ($marginPercentage > 10 ? 'var(--accent-yellow)' : 'var(--accent-red)') }};">
                                    {{ number_format($marginPercentage, 1) }}%
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="badge badge-{{ $statusColor }}" style="font-size: 11px;">
                                    {{ number_format($stock) }}
                                </span>
                            </td>
                            <td class="text-right">{{ number_format($sold) }}</td>
                            <td class="text-right">ETB {{ number_format($revenue, 2) }}</td>
                            <td class="text-right">{{ number_format($views) }}</td>
                            <td class="text-center">
                                @if($rating > 0)
                                    <span style="color: var(--primary-gold);">
                                        {{ number_format($rating, 1) }} ★
                                    </span>
                                @else
                                    <span style="color: var(--text-secondary);">-</span>
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
                        <td colspan="4" style="text-align: right;">Totals / Averages:</td>
                        <td class="text-right">ETB {{ number_format($totalPrice, 2) }}</td>
                        <td class="text-right">ETB {{ number_format($totalCost, 2) }}</td>
                        <td class="text-right">{{ number_format(($totalPrice - $totalCost) / max($totalPrice, 1) * 100, 1) }}%</td>
                        <td class="text-right">{{ number_format($totalStock) }}</td>
                        <td class="text-right">{{ number_format($totalSold) }}</td>
                        <td class="text-right">ETB {{ number_format($totalRevenue, 2) }}</td>
                        <td class="text-right">{{ number_format($totalViews) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if(method_exists($productsData, 'links'))
            <div class="pagination">
                {{ $productsData->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="ri-shopping-cart-line"></i>
            <h3>No Products Found</h3>
            <p>No products found for the selected period.</p>
        </div>
    @endif
</div>

<!-- Product Performance Metrics -->
<div class="recent-section" style="margin-top: 24px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
    <!-- Top Rated Products -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ri-star-line"></i>
                Top Rated Products
            </h3>
        </div>
        @if(isset($topRatedProducts) && $topRatedProducts->count() > 0)
            <div style="padding: 16px;">
                @foreach($topRatedProducts as $product)
                    <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6;">
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">{{ $product->name }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">
                                <span style="color: var(--primary-gold);">{{ number_format($product->avg_rating, 1) }} ★</span>
                                ({{ $product->reviews_count }} reviews)
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="padding: 20px;">
                <i class="ri-star-line"></i>
                <p>No rated products</p>
            </div>
        @endif
    </div>

    <!-- Most Viewed Products -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ri-eye-line"></i>
                Most Viewed
            </h3>
        </div>
        @if(isset($mostViewedProducts) && $mostViewedProducts->count() > 0)
            <div style="padding: 16px;">
                @foreach($mostViewedProducts as $product)
                    <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6;">
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">{{ $product->name }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">
                                {{ number_format($product->views) }} views
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="padding: 20px;">
                <i class="ri-eye-line"></i>
                <p>No view data</p>
            </div>
        @endif
    </div>

    <!-- Low Stock Alerts -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ri-alert-line"></i>
                Low Stock Alerts
            </h3>
        </div>
        @if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
            <div style="padding: 16px;">
                @foreach($lowStockProducts as $product)
                    <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6;">
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">{{ $product->name }}</div>
                            <div style="font-size: 12px;">
                                <span class="badge badge-warning">Stock: {{ $product->stock }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="padding: 20px;">
                <i class="ri-check-line"></i>
                <p>No low stock alerts</p>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .product-image {
        width: 40px;
        height: 40px;
        border-radius: 4px;
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

    .badge-secondary {
        background-color: #f3f4f6;
        color: #4b5563;
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
// Copy products to clipboard
function copyProductsToClipboard() {
    const table = document.getElementById('productsTable');
    if (!table) return;

    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand('copy');
        showToast('Products table copied to clipboard!');
    } catch (err) {
        alert('Failed to copy table');
    }

    window.getSelection().removeAllRanges();
}

// Export products to CSV
function exportProductsToCSV() {
    const table = document.getElementById('productsTable');
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
            // Handle the image and text combination
            if (td.querySelector('img')) {
                text = td.querySelector('.font-500')?.textContent.trim() || text;
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
    a.download = 'products-report-{{ $dateFrom }}-to-{{ $dateTo }}.csv';
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
