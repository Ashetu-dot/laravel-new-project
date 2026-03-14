<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Find Vendors - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-bg: #f3f4f6;
            --navbar-bg: #ffffff;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo i {
            color: var(--primary-gold);
            font-size: 2rem;
        }

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .btn-login {
            background-color: var(--primary-gold);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: var(--primary-gold-hover);
        }

        /* Search Header */
        .search-header {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .search-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .search-header p {
            font-size: 1.125rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-stats {
            margin-top: 1.5rem;
            font-size: 1rem;
            opacity: 0.8;
        }

        .search-stats i {
            color: var(--primary-gold);
            margin-right: 0.5rem;
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Filters Sidebar */
        .filters-sidebar {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .filters-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-label {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
            color: var(--text-secondary);
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .filter-checkbox input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            cursor: pointer;
        }

        .filter-search {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-search:focus {
            border-color: var(--primary-gold);
        }

        .btn-filter {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-gold);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-filter:hover {
            background-color: var(--primary-gold-hover);
        }

        .btn-reset {
            width: 100%;
            padding: 0.75rem;
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }

        .btn-reset:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        /* Vendors Grid */
        .vendors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .vendor-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            border: 1px solid transparent;
        }

        .vendor-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-gold);
        }

        .vendor-header {
            height: 100px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            position: relative;
        }

        .vendor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            position: absolute;
            bottom: -40px;
            left: 20px;
            border: 4px solid white;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .vendor-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .vendor-verified {
            position: absolute;
            bottom: -35px;
            right: 20px;
            background-color: var(--success-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .vendor-content {
            padding: 3rem 1.5rem 1.5rem;
        }

        .vendor-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .vendor-category {
            display: inline-block;
            background-color: #fef3e7;
            color: var(--primary-gold);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .vendor-location {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .star-filled {
            color: #f59e0b;
        }

        .star-half {
            color: #f59e0b;
        }

        .star-empty {
            color: #e5e7eb;
        }

        .rating-value {
            font-weight: 600;
        }

        .rating-count {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .vendor-stats {
            display: flex;
            gap: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .stat i {
            color: var(--primary-gold);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .empty-icon {
            font-size: 5rem;
            color: var(--border-color);
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination-item {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--card-bg);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-item:hover {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination-item.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        /* Footer */
        .footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 2rem;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        .copyright {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Loading */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(184, 142, 63, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-gold);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .logo {
                font-size: 1.25rem;
            }

            .logo i {
                font-size: 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .search-header {
                padding: 2rem 1rem;
            }

            .search-header h1 {
                font-size: 1.75rem;
            }

            .main-container {
                padding: 1rem;
            }

            .vendor-avatar {
                width: 60px;
                height: 60px;
                bottom: -30px;
            }

            .vendor-content {
                padding: 2.5rem 1rem 1rem;
            }

            .vendor-name {
                font-size: 1.125rem;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Search Header -->
    <div class="search-header">
        <h1>Discover Amazing Vendors in Jimma</h1>
        <p>Find the best local businesses, services, and products from trusted vendors</p>
        <div class="search-stats">
            <i class="ri-store-3-line"></i>
            {{ count($vendors) }} vendors found
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Filters Sidebar -->
        <div class="filters-sidebar">
            <div class="filters-title">
                <i class="ri-filter-3-line"></i>
                Filter Vendors
            </div>

            <div class="filter-group">
                <div class="filter-label">Search by name</div>
                <input type="text" class="filter-search" id="searchInput" placeholder="Vendor name..." value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <div class="filter-label">Categories</div>
                <div class="filter-options">
                    @php
                        $categories = collect($vendors)->pluck('category')->unique()->sort()->values();
                    @endphp
                    @foreach($categories as $category)
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category[]" value="{{ $category }}" {{ in_array($category, (array)request('category')) ? 'checked' : '' }}>
                            {{ $category }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-label">Location</div>
                <div class="filter-options">
                    @php
                        $locations = collect($vendors)->map(function($vendor) {
                            return $vendor['city'] ?? 'Jimma';
                        })->unique()->sort()->values();
                    @endphp
                    @foreach($locations as $location)
                        <label class="filter-checkbox">
                            <input type="checkbox" name="location[]" value="{{ $location }}" {{ in_array($location, (array)request('location')) ? 'checked' : '' }}>
                            {{ $location }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-label">Minimum Rating</div>
                <select class="filter-search" id="ratingFilter">
                    <option value="">Any Rating</option>
                    <option value="4.5" {{ request('rating') == '4.5' ? 'selected' : '' }}>4.5+ Stars</option>
                    <option value="4.0" {{ request('rating') == '4.0' ? 'selected' : '' }}>4.0+ Stars</option>
                    <option value="3.5" {{ request('rating') == '3.5' ? 'selected' : '' }}>3.5+ Stars</option>
                    <option value="3.0" {{ request('rating') == '3.0' ? 'selected' : '' }}>3.0+ Stars</option>
                </select>
            </div>

            <div class="filter-group">
                <div class="filter-label">Sort By</div>
                <select class="filter-search" id="sortFilter">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                </select>
            </div>

            <button class="btn-filter" onclick="applyFilters()">
                <i class="ri-filter-3-line"></i> Apply Filters
            </button>
            <button class="btn-reset" onclick="resetFilters()">
                <i class="ri-refresh-line"></i> Reset
            </button>
        </div>

        <!-- Vendors Grid -->
        @if(count($vendors) > 0)
            <div class="vendors-grid">
                @foreach($vendors as $vendor)
                    <a href="{{ route('vendor.show', $vendor['id']) }}" class="vendor-card">
                        <div class="vendor-header">
                            <div class="vendor-avatar">
                                @if(isset($vendor['avatar']) && $vendor['avatar'])
                                    <img src="{{ $vendor['avatar'] }}" alt="{{ $vendor['business_name'] }}">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ $vendor['avatar_text'] ?? substr($vendor['business_name'], 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            @if(isset($vendor['verified']) && $vendor['verified'])
                                <div class="vendor-verified">
                                    <i class="ri-verified-badge-fill"></i> Verified
                                </div>
                            @endif
                        </div>

                        <div class="vendor-content">
                            <div class="vendor-name">
                                {{ $vendor['business_name'] }}
                                @if(isset($vendor['is_featured']) && $vendor['is_featured'])
                                    <i class="ri-star-fill" style="color: var(--primary-gold);" title="Featured Vendor"></i>
                                @endif
                            </div>

                            <span class="vendor-category">{{ $vendor['category'] }}</span>

                            <div class="vendor-location">
                                <i class="ri-map-pin-line"></i>
                                {{ $vendor['full_address'] ?? $vendor['location_string'] ?? $vendor['city'] . ', ' . $vendor['state'] }}
                            </div>

                            <div class="vendor-rating">
                                <div class="stars">
                                    {!! $vendor['rating_stars'] !!}
                                </div>
                                <span class="rating-value">{{ number_format($vendor['rating'], 1) }}</span>
                                <span class="rating-count">({{ $vendor['total_reviews'] ?? 0 }} reviews)</span>
                            </div>

                            <div class="vendor-stats">
                                @if(isset($vendor['products_count']))
                                    <div class="stat">
                                        <i class="ri-shopping-bag-line"></i>
                                        {{ $vendor['products_count'] }} products
                                    </div>
                                @endif
                                <div class="stat">
                                    <i class="ri-user-follow-line"></i>
                                    {{ $vendor['followers_count'] ?? 0 }} followers
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(isset($pagination) && $pagination['last_page'] > 1)
                <div class="pagination">
                    @if($pagination['current_page'] > 1)
                        <a href="{{ route('vendors.search', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" class="pagination-item">
                            <i class="ri-arrow-left-s-line"></i>
                        </a>
                    @endif

                    @for($i = 1; $i <= $pagination['last_page']; $i++)
                        @if($i >= $pagination['current_page'] - 2 && $i <= $pagination['current_page'] + 2)
                            <a href="{{ route('vendors.search', array_merge(request()->query(), ['page' => $i])) }}"
                               class="pagination-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor

                    @if($pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ route('vendors.search', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" class="pagination-item">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    @endif
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="ri-store-3-line empty-icon"></i>
                <h3>No vendors found</h3>
                <p>Try adjusting your search or filter criteria to find what you're looking for.</p>
                <a href="{{ route('vendors.search') }}" class="btn-filter" style="display: inline-block; width: auto; padding: 0.75rem 2rem;">
                    <i class="ri-refresh-line"></i> Clear Filters
                </a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="copyright">
                &copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia
            </div>
            <div class="footer-links">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Apply filters
        function applyFilters() {
            document.getElementById('loadingOverlay').style.display = 'flex';

            const search = document.getElementById('searchInput').value;
            const rating = document.getElementById('ratingFilter').value;
            const sort = document.getElementById('sortFilter').value;

            const categories = Array.from(document.querySelectorAll('input[name="category[]"]:checked')).map(cb => cb.value);
            const locations = Array.from(document.querySelectorAll('input[name="location[]"]:checked')).map(cb => cb.value);

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (rating) params.append('rating', rating);
            if (sort) params.append('sort', sort);
            categories.forEach(c => params.append('category[]', c));
            locations.forEach(l => params.append('location[]', l));

            window.location.href = '{{ route("vendors.search") }}?' + params.toString();
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('loadingOverlay').style.display = 'flex';
            window.location.href = '{{ route("vendors.search") }}';
        }

        // Search on enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        // Hide loading overlay when page loads
        window.addEventListener('load', function() {
            document.getElementById('loadingOverlay').style.display = 'none';
        });

        // Follow vendor (AJAX)
        function followVendor(vendorId, button) {
            fetch(`/vendor/${vendorId}/follow`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.innerHTML = '<i class="ri-user-unfollow-line"></i> Following';
                    button.style.backgroundColor = 'var(--success-color)';
                    button.onclick = function() { unfollowVendor(vendorId, button); };

                    // Update followers count
                    const countElement = button.closest('.vendor-card').querySelector('.vendor-stats .stat:last-child span');
                    if (countElement) {
                        countElement.textContent = parseInt(countElement.textContent) + 1 + ' followers';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Unfollow vendor (AJAX)
        function unfollowVendor(vendorId, button) {
            fetch(`/vendor/${vendorId}/unfollow`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.innerHTML = '<i class="ri-user-follow-line"></i> Follow';
                    button.style.backgroundColor = 'var(--primary-gold)';
                    button.onclick = function() { followVendor(vendorId, button); };

                    // Update followers count
                    const countElement = button.closest('.vendor-card').querySelector('.vendor-stats .stat:last-child span');
                    if (countElement) {
                        countElement.textContent = parseInt(countElement.textContent) - 1 + ' followers';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
