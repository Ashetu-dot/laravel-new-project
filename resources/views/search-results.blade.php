<!DOCTYPE html>
<html lang="{{ session('locale','en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Vendora Marketplace | Jimma, Ethiopia</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <style>
        :root {
            --primary-gold: #B88E3F;
            --primary-hover: #9C762F;
            --text-dark: #333333;
            --text-gray: #666666;
            --border-color: #E5E7EB;
            --white: #FFFFFF;
            --light-gray: #F9FAFB;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 24px rgba(0,0,0,0.12);
            --radius-sm: 8px;
            --radius-lg: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --text-primary: #1e293b;
            --accent: #B88E3F;
            --error: #EF4444;
            --success: #10B981;
        }

        /* Dark Mode Variables */
        body.dark-mode {
            --primary-gold: #D4A55A;
            --primary-hover: #C1934A;
            --text-dark: #E5E7EB;
            --text-gray: #9CA3AF;
            --border-color: #374151;
            --white: #1F2937;
            --light-gray: #111827;
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --text-primary: #f3f4f6;
            --accent: #D4A55A;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
            --shadow-hover: 0 8px 24px rgba(0,0,0,0.4);
            --error: #F87171;
            --success: #34D399;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
            transition: background-color 0.3s, color 0.3s;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Alert Styles */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .alert-error {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            min-height: 80px;
            transition: background-color 0.3s;
        }

        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            gap: 30px;
        }

        .logo-badge {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo i {
            font-size: 32px;
        }

        .ethiopia-badge {
            background-color: #FEF3E7;
            color: var(--primary-gold);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .theme-lang-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toggle-btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--light-gray);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 20px;
        }

        .toggle-btn-icon:hover {
            background-color: var(--primary-gold);
            color: white;
            transform: translateY(-2px);
        }

        /* dark-mode adjustments */
        body.dark-mode .toggle-btn-icon {
            background-color: #0b1220;
            border-color: #1f2937;
            color: #cbd5e1;
        }
        body.dark-mode .theme-lang-toggle { color: #cbd5e1; }

        .language-selector {
            position: relative;
        }

        .language-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-hover);
            min-width: 150px;
            display: none;
            z-index: 100;
        }

        .language-selector:hover .language-dropdown {
            display: block;
        }

        .language-option {
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .language-option:hover {
            background-color: var(--light-gray);
            color: var(--primary-gold);
        }

        .search-container {
            flex: 1;
            max-width: 600px;
            position: relative;
        }

        .search-input {
            width: 100%;
            height: 48px;
            padding: 0 20px 0 50px;
            border: 2px solid var(--border-color);
            border-radius: 30px;
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--light-gray);
            color: var(--text-dark);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            font-size: 20px;
            pointer-events: none;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--light-gray);
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            position: relative;
            text-decoration: none;
        }

        .nav-btn:hover {
            background-color: var(--primary-gold);
            color: var(--white);
            transform: translateY(-2px);
        }

        .badge-count {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: #EF4444;
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-dark);
            padding: 6px 12px;
            border-radius: 30px;
            transition: var(--transition);
        }

        .user-menu:hover {
            background-color: var(--light-gray);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-gold);
        }

        /* Search History Dropdown */
        .search-history {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-hover);
            margin-top: 8px;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 100;
        }

        .search-history.active {
            display: block;
        }

        .history-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: var(--transition);
        }

        .history-item:hover {
            background-color: var(--light-gray);
        }

        .history-text {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            text-decoration: none;
            flex: 1;
        }

        .history-remove {
            color: var(--text-gray);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: var(--transition);
        }

        .history-remove:hover {
            background-color: #FEE2E2;
            color: #EF4444;
        }

        .clear-history-btn {
            padding: 8px 12px;
            background: transparent;
            border: none;
            color: var(--primary-gold);
            font-size: 12px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }

        .clear-history-btn:hover {
            background-color: var(--light-gray);
        }

        /* Filters Section */
        .filters-section {
            background-color: var(--white);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 80px;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .filters-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-group {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background-color: var(--white);
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background-color: var(--primary-gold);
            color: var(--white);
            border-color: var(--primary-gold);
        }

        .filter-tag {
            background-color: var(--light-gray);
            color: var(--text-dark);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-tag i {
            cursor: pointer;
            font-size: 16px;
        }

        .filter-tag i:hover {
            color: var(--primary-hover);
        }

        .results-count {
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* View Toggle */
        .view-toggle {
            display: flex;
            gap: 8px;
            background-color: var(--light-gray);
            padding: 4px;
            border-radius: var(--radius-sm);
        }

        .view-btn {
            padding: 8px 12px;
            border: none;
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            border-radius: 6px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .view-btn.active {
            background-color: var(--white);
            color: var(--primary-gold);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Active Filters Bar */
        .active-filters {
            background-color: var(--white);
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .active-filters .container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .clear-filters {
            color: var(--primary-gold);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-left: 8px;
        }

        .clear-filters:hover {
            text-decoration: underline;
        }

        /* Advanced Filters Panel */
        .advanced-filters {
            background-color: var(--white);
            padding: 20px;
            border-radius: var(--radius-lg);
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            display: none;
        }

        .advanced-filters.active {
            display: block;
        }

        .advanced-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-input-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-gray);
        }

        .filter-input {
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--light-gray);
            color: var(--text-dark);
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .price-range {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-range input {
            flex: 1;
        }

        /* Sidebar */
        .main-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
            margin: 40px 0 60px;
        }

        .sidebar {
            position: sticky;
            top: 200px;
            height: fit-content;
        }

        .sidebar-section {
            background-color: var(--white);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            transition: background-color 0.3s;
        }

        .sidebar-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trending-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .trending-item:last-child {
            border-bottom: none;
        }

        .trending-item:hover {
            padding-left: 8px;
        }

        .trending-number {
            width: 24px;
            height: 24px;
            background-color: var(--primary-gold);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        .trending-info {
            flex: 1;
        }

        .trending-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .trending-meta {
            font-size: 12px;
            color: var(--text-gray);
        }

        /* Main Content Grid */
        .content-area {
            min-height: 600px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .grid-container.list-view {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        /* Vendor Card with Product Pricing */
        .vendor-card {
            background-color: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid transparent;
            position: relative;
        }

        .vendor-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(184, 142, 63, 0.2);
        }

        .list-view .vendor-card {
            flex-direction: row;
            height: 200px;
        }

        .card-image-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 2px;
            height: 200px;
            background-color: #f1f5f9;
            position: relative;
        }

        .list-view .card-image-grid {
            width: 280px;
            height: 100%;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr;
        }

        .card-img-main {
            grid-row: 1 / span 2;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .list-view .card-img-main {
            grid-row: 1;
        }

        .card-img-sub {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .list-view .card-img-sub {
            display: none;
        }

        .verified-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--primary-gold);
            color: white;
            padding: 4px 10px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            z-index: 2;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .quick-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transition: var(--transition);
            z-index: 2;
        }

        .vendor-card:hover .quick-actions {
            opacity: 1;
        }

        .quick-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .quick-action-btn:hover {
            background-color: var(--primary-gold);
            color: white;
            transform: scale(1.1);
        }

        .quick-action-btn.saved {
            background-color: var(--primary-gold);
            color: white;
        }

        .compare-checkbox {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 6px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            opacity: 0;
            transition: var(--transition);
            z-index: 2;
        }

        .vendor-card:hover .compare-checkbox {
            opacity: 1;
        }

        .compare-checkbox input[type="checkbox"] {
            cursor: pointer;
        }

        .card-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .list-view .card-content {
            padding: 16px 20px;
            justify-content: center;
        }

        .vendor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
            gap: 10px;
        }

        .vendor-name {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .list-view .vendor-name {
            font-size: 20px;
        }

        .vendor-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            background-color: #fef3e7;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary-gold);
            flex-shrink: 0;
        }

        .vendor-category {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 12px;
            display: block;
        }

        .vendor-description {
            font-size: 13px;
            color: var(--text-gray);
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Product Pricing Section */
        .product-pricing {
            margin: 12px 0;
            padding: 12px;
            background-color: var(--light-gray);
            border-radius: var(--radius-sm);
            border-left: 3px solid var(--primary-gold);
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .product-item:last-child {
            margin-bottom: 0;
        }

        .product-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .price-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .original-price {
            font-size: 12px;
            color: var(--text-gray);
            text-decoration: line-through;
        }

        .current-price {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary-gold);
        }

        .discount-badge {
            background-color: #10B981;
            color: white;
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .vendor-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            color: var(--text-gray);
            font-size: 13px;
            flex-wrap: wrap;
        }

        .list-view .vendor-meta {
            margin-top: 12px;
            padding-top: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item i {
            color: var(--primary-gold);
            font-size: 14px;
        }

        .action-area {
            margin-top: 16px;
            display: flex;
            gap: 10px;
        }

        .list-view .action-area {
            margin-top: 12px;
        }

        .btn-outline {
            flex: 1;
            height: 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: transparent;
            font-weight: 500;
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-outline:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .btn-primary {
            flex: 1;
            height: 40px;
            border: none;
            border-radius: var(--radius-sm);
            background: var(--primary-gold);
            font-weight: 500;
            font-size: 13px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(184, 142, 63, 0.3);
        }

        .btn-shop {
            flex: 1;
            height: 40px;
            padding: 0 16px;
            background: var(--primary-gold);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            position: relative;
        }

        .btn-shop:hover {
            background: #9c7832;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(184, 142, 63, 0.3);
        }

        .btn-shop::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-shop:hover::before {
            opacity: 1;
        }

        .btn-following {
            flex: 1;
            height: 40px;
            border: 1px solid var(--primary-gold);
            border-radius: var(--radius-sm);
            background: #fef3e7;
            font-weight: 500;
            font-size: 13px;
            color: var(--primary-gold);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-following:hover {
            background: #fee7d6;
        }

        /* Compare Bar */
        .compare-bar {
            position: fixed;
            bottom: -100px;
            left: 0;
            right: 0;
            background-color: var(--white);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            padding: 16px 0;
            transition: var(--transition);
            z-index: 1000;
        }

        .compare-bar.active {
            bottom: 0;
        }

        .compare-bar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .compare-items {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .compare-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background-color: var(--light-gray);
            border-radius: var(--radius-sm);
            font-size: 14px;
        }

        .compare-item-remove {
            cursor: pointer;
            color: var(--text-gray);
            transition: var(--transition);
        }

        .compare-item-remove:hover {
            color: #EF4444;
        }

        /* Empty State */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .no-results i {
            font-size: 64px;
            color: var(--primary-gold);
            margin-bottom: 20px;
        }

        .no-results h3 {
            font-size: 28px;
            margin-bottom: 12px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .no-results p {
            font-size: 16px;
            color: var(--text-gray);
            margin-bottom: 24px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 60px 0 80px;
            flex-wrap: wrap;
        }

        .pagination .page-link {
            min-width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            background-color: var(--white);
            color: var(--text-dark);
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .pagination .page-link:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .pagination .page-link.active {
            background-color: var(--primary-gold);
            color: white;
            border-color: var(--primary-gold);
        }

        .pagination .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination .page-link.next-prev {
            padding: 0 16px;
        }

        /* Quick View Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--white);
            border-radius: var(--radius-lg);
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--light-gray);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 1;
        }

        .modal-close:hover {
            background-color: var(--primary-gold);
            color: white;
        }

        .modal-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 30px;
        }

        .modal-images {
            display: grid;
            grid-template-rows: 2fr 1fr;
            gap: 10px;
            height: 400px;
        }

        .modal-main-image {
            grid-row: 1 / span 2;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-sm);
        }

        .modal-sub-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .modal-sub-image:hover {
            opacity: 0.8;
        }

        .modal-info {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .modal-rating {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 16px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .modal-actions .btn-primary,
        .modal-actions .btn-outline,
        .modal-actions .btn-shop {
            flex: 1;
            height: 48px;
            font-size: 15px;
        }

        /* Share Modal */
        .share-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .share-btn {
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: var(--white);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 12px;
        }

        .share-btn:hover {
            border-color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .share-btn i {
            font-size: 24px;
        }

        .share-btn.facebook i { color: #1877F2; }
        .share-btn.twitter i { color: #1DA1F2; }
        .share-btn.whatsapp i { color: #25D366; }
        .share-btn.email i { color: #EA4335; }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid #f1f5f9;
            border-top-color: var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            border-left: 4px solid var(--primary-gold);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-hover);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 3000;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left-color: var(--success);
        }

        .toast.error {
            border-left-color: var(--error);
        }

        .toast-icon {
            font-size: 24px;
        }

        .toast.success .toast-icon {
            color: var(--success);
        }

        .toast.error .toast-icon {
            color: var(--error);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-gray);
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-gray);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-gray);
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive Design */
        @media screen and (max-width: 1400px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 1200px) {
            .container { padding: 0 30px; }
            .main-layout {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: static;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
            }
        }

        @media screen and (max-width: 1024px) {
            .search-container { max-width: 400px; }
            .search-input { font-size: 15px; }
            .modal-body {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 900px) {
            .nav-content {
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 16px;
            }
            .logo { grid-column: 1; }
            .nav-actions { grid-column: 2; justify-self: end; }
            .search-container {
                grid-column: 1 / -1;
                max-width: 100%;
                order: 3;
                margin-top: 8px;
            }
            .filters-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .filter-group {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 12px;
                -webkit-overflow-scrolling: touch;
            }
            .filter-btn { flex-shrink: 0; }
            .results-count { align-self: flex-end; }
        }

        @media screen and (max-width: 768px) {
            .navbar { min-height: 70px; }
            .logo { font-size: 24px; }
            .logo i { font-size: 28px; }
            .ethiopia-badge { font-size: 10px; padding: 2px 8px; }

            .grid-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card-image-grid { height: 180px; }
            .vendor-name { font-size: 16px; }

            .pagination .page-link {
                min-width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .share-options {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 640px) {
            .container { padding: 0 20px; }

            .list-view .vendor-card {
                flex-direction: column;
                height: auto;
            }

            .list-view .card-image-grid {
                width: 100%;
                height: 200px;
            }

            .search-input { height: 44px; font-size: 15px; }
            .search-icon { font-size: 18px; left: 16px; }

            .filter-btn {
                height: 40px;
                padding: 0 16px;
                font-size: 13px;
            }

            .filter-tag { font-size: 12px; padding: 4px 12px; }
            .results-count { font-size: 13px; }

            .vendor-name { font-size: 17px; }

            .modal-body {
                padding: 20px;
            }

            .modal-images {
                height: 250px;
            }
        }

        @media screen and (max-width: 480px) {
            .nav-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .logo {
                grid-column: 1;
                justify-self: center;
                font-size: 22px;
            }
            .nav-actions {
                grid-column: 1;
                justify-self: center;
                gap: 8px;
            }
            .nav-btn { width: 36px; height: 36px; font-size: 20px; }
            .user-avatar { width: 36px; height: 36px; }

            .card-image-grid { height: 170px; }

            .footer-links { gap: 20px; }
            .footer-links a { font-size: 13px; }

            .compare-items {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }

        @media screen and (max-width: 360px) {
            .logo { font-size: 20px; }
            .logo i { font-size: 24px; }
            .nav-btn { width: 32px; height: 32px; font-size: 18px; }
            .user-avatar { width: 32px; height: 32px; }
            .search-input { height: 40px; font-size: 14px; padding-left: 42px; }
            .search-icon { left: 14px; font-size: 16px; }
            .card-image-grid { height: 160px; }
            .vendor-name { font-size: 16px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <div class="logo-badge">
                <a href="{{ route('home') }}" class="logo">
                    <i class="ri-store-3-fill"></i>
                    Vendora
                </a>
                <span class="ethiopia-badge">
                    <i class="ri-map-pin-line"></i> Jimma, Ethiopia
                </span>
            </div>

            <div class="search-container">
                <i class="ri-search-line search-icon"></i>
                <form action="{{ route('search.results') }}" method="GET" style="width: 100%;">
                    <input type="text" name="query" class="search-input" placeholder="{{ __('Search for vendors, products, or categories in Jimma...') }}" value="{{ request('query') }}" id="searchInput" autocomplete="off">
                </form>

                <!-- Search History Dropdown -->
                <div class="search-history" id="searchHistory">
                    @auth
                        @php
                            $searchHistories = auth()->user()->searchHistory()->latest()->take(5)->get();
                        @endphp

                        @forelse($searchHistories as $history)
                        <div class="history-item" data-id="{{ $history->id }}">
                            <a href="{{ route('search.results', ['query' => $history->query]) }}" class="history-text">
                                <i class="ri-history-line"></i>
                                <span>{{ $history->query }}</span>
                                @if($history->results_count > 0)
                                    <small style="color: var(--text-gray); margin-left: 8px;">({{ $history->results_count }} {{ __('results') }})</small>
                                @endif
                            </a>
                            <i class="ri-close-line history-remove" onclick="removeSearchHistory({{ $history->id }}, this)"></i>
                        </div>
                        @empty
                        <div class="history-item">
                            <span class="history-text" style="color: var(--text-gray);">
                                <i class="ri-information-line"></i>
                                {{ __('No search history yet') }}
                            </span>
                        </div>
                        @endforelse

                        @if($searchHistories->count() > 0)
                        <button class="clear-history-btn" onclick="clearAllSearchHistory()">
                            <i class="ri-delete-bin-line"></i> {{ __('Clear all history') }}
                        </button>
                        @endif
                    @endauth

                    @guest
                    <div class="history-item">
                        <span class="history-text" style="color: var(--text-gray);">
                            <i class="ri-lock-line"></i>
                            {{ __('Login to see your search history') }}
                        </span>
                    </div>
                    @endguest
                </div>
            </div>

            <div class="nav-actions">
                <!-- Theme and language controls -->
                <div class="theme-lang-toggle">
                    <button class="toggle-btn-icon" id="themeToggle" title="{{ __('Toggle theme') }}">
                        <i class="ri-moon-line"></i>
                    </button>

                    <!-- Language Selector -->
                    <div class="language-selector" id="languageSelector">
                        <button class="toggle-btn-icon" id="languageToggle" onclick="toggleLanguageDropdown(event)" aria-haspopup="true" aria-expanded="false" title="{{ __('Change language') }}">
                            <i class="ri-translate-2"></i>
                        </button>
                        <div class="language-dropdown">
                            <div class="language-option" data-locale="en" onclick="changeLanguage('en')">
                                <i class="ri-english-input"></i> English @if(session('locale','en')==='en')<i class="ri-check-line" style="float:right"></i>@endif
                            </div>
                            <div class="language-option" data-locale="am" onclick="changeLanguage('am')">
                                <i class="ri-translate"></i> አማርኛ @if(session('locale','en')==='am')<i class="ri-check-line" style="float:right"></i>@endif
                            </div>
                            <div class="language-option" data-locale="om" onclick="changeLanguage('om')">
                                <i class="ri-translate"></i> Afaan Oromoo @if(session('locale','en')==='om')<i class="ri-check-line" style="float:right"></i>@endif
                            </div>
                        </div>
                    </div>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="nav-btn" aria-label="Login" title="Login">
                        <i class="ri-user-line"></i>
                    </a>
                    <a href="{{ route('register') }}" class="nav-btn" aria-label="Sign Up" title="Sign Up" style="background: var(--primary-gold); color: white;">
                        <i class="ri-user-add-line"></i>
                    </a>
                @else
                    @php
                        $unreadNotificationsCount = 0;
                        $cartCount = 0;

                        try {
                            if (Auth::check()) {
                                // Get notification count based on role
                                if (Auth::user()->role === 'customer') {
                                    $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();
                                } elseif (Auth::user()->role === 'vendor') {
                                    $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();
                                } elseif (Auth::user()->role === 'admin') {
                                    $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();
                                }

                                // Get cart count only for customers
                                if (Auth::user()->role === 'customer' && method_exists(Auth::user(), 'cartItems')) {
                                    $cartCount = Auth::user()->cartItems()->count();
                                }
                            }
                        } catch (\Exception $e) {
                            // Log error but don't break the page
                            \Log::error('Error getting counts: ' . $e->getMessage());
                        }
                    @endphp

                    {{-- Notification links based on role --}}
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.notifications') }}" class="nav-btn" aria-label="Notifications">
                            <i class="ri-notification-3-line"></i>
                            @if($unreadNotificationsCount > 0)
                                <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </a>
                    @elseif(Auth::user()->role === 'vendor')
                        <a href="{{ route('vendor.notifications') }}" class="nav-btn" aria-label="Notifications">
                            <i class="ri-notification-3-line"></i>
                            @if($unreadNotificationsCount > 0)
                                <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.notifications') }}" class="nav-btn" aria-label="Notifications">
                            <i class="ri-notification-3-line"></i>
                            @if($unreadNotificationsCount > 0)
                                <span class="badge-count">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </a>
                    @endif

                    {{-- Cart link only for customers --}}
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.cart.index') }}" class="nav-btn" aria-label="Cart">
                            <i class="ri-shopping-bag-3-line"></i>
                            @if($cartCount > 0)
                                <span class="badge-count">{{ $cartCount }}</span>
                            @endif
                        </a>
                    @endif

                    {{-- Profile link --}}
                    <a href="{{ route('profile.show', Auth::id()) }}" class="user-menu">
                        @php
                            $avatarUrl = Auth::user()->avatar
                                ? Storage::url(Auth::user()->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=B88E3F&color=fff&size=200';
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="user-avatar" loading="lazy">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Filters -->
    <section class="filters-section">
        <div class="container filters-wrapper">
            <div class="filter-group">
                <form action="{{ route('search.results') }}" method="GET" id="filterForm" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    @if(request('query'))
                        <input type="hidden" name="query" value="{{ request('query') }}">
                    @endif

                    <select name="location" class="filter-btn" onchange="this.form.submit()">
                        <option value="">📍 {{ __('All Ethiopia') }}</option>
                        <option value="Jimma" {{ request('location') == 'Jimma' ? 'selected' : '' }}>📍 Jimma</option>
                        <option value="Addis Ababa" {{ request('location') == 'Addis Ababa' ? 'selected' : '' }}>📍 Addis Ababa</option>
                        <option value="Bahir Dar" {{ request('location') == 'Bahir Dar' ? 'selected' : '' }}>📍 Bahir Dar</option>
                        <option value="Hawassa" {{ request('location') == 'Hawassa' ? 'selected' : '' }}>📍 Hawassa</option>
                    </select>

                    <select name="category" class="filter-btn" onchange="this.form.submit()">
                        <option value="">🏷️ {{ __('All Categories') }}</option>
                        <option value="coffee" {{ request('category') == 'coffee' ? 'selected' : '' }}>☕ {{ __('Coffee & Tea') }}</option>
                        <option value="handicrafts" {{ request('category') == 'handicrafts' ? 'selected' : '' }}>🎨 {{ __('Handicrafts') }}</option>
                        <option value="textiles" {{ request('category') == 'textiles' ? 'selected' : '' }}>🧵 {{ __('Textiles') }}</option>
                        <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>🍲 {{ __('Food & Spices') }}</option>
                    </select>

                    <select name="rating" class="filter-btn" onchange="this.form.submit()">
                        <option value="">⭐ {{ __('Any Rating') }}</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ 4+ {{ __('Stars') }}</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ 3+ {{ __('Stars') }}</option>
                    </select>

                    <select name="sort" class="filter-btn" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>🔄 {{ __('Newest First') }}</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>⭐ {{ __('Top Rated') }}</option>
                        <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>📦 {{ __('Most Products') }}</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>💰 {{ __('Price: Low to High') }}</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>💰 {{ __('Price: High to Low') }}</option>
                    </select>

                    <button type="button" class="filter-btn" onclick="toggleAdvancedFilters()">
                        <i class="ri-settings-3-line"></i> {{ __('Advanced') }}
                    </button>

                    <button type="button" class="filter-btn" onclick="clearAllFilters()">
                        <i class="ri-filter-off-line"></i> {{ __('Clear') }}
                    </button>
                </form>

                @if(request('category'))
                    <div class="filter-tag">
                        {{ ucfirst(request('category')) }}
                        <i class="ri-close-line" onclick="removeFilter('category')"></i>
                    </div>
                @endif
                @if(request('location'))
                    <div class="filter-tag">
                        {{ request('location') }}
                        <i class="ri-close-line" onclick="removeFilter('location')"></i>
                    </div>
                @endif
            </div>

            <div style="display: flex; align-items: center; gap: 16px;">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="setView('grid')">
                        <i class="ri-grid-fill"></i> {{ __('Grid') }}
                    </button>
                    <button class="view-btn" onclick="setView('list')">
                        <i class="ri-list-unordered"></i> {{ __('List') }}
                    </button>
                </div>

                <span class="results-count">
                    @if($vendors->total() > 0)
                        {{ __('Showing') }} {{ $vendors->firstItem() }} - {{ $vendors->lastItem() }} {{ __('of') }} {{ $vendors->total() }} {{ __('vendors') }}
                    @else
                        {{ __('No vendors found') }}
                    @endif
                </span>
            </div>
        </div>
    </section>

    <!-- Advanced Filters Panel -->
    <div class="container">
        <div class="advanced-filters" id="advancedFilters">
            <form action="{{ route('search.results') }}" method="GET">
                @if(request()->all())
                    @foreach(request()->all() as $key => $value)
                        @if($key != 'price_min' && $key != 'price_max' && $key != 'availability')
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                @endif

                <div class="advanced-grid">
                    <div class="filter-input-group">
                        <label>{{ __('Price Range') }} (ETB)</label>
                        <div class="price-range">
                            <input type="number" name="price_min" class="filter-input" placeholder="{{ __('Min') }}" value="{{ request('price_min') }}" min="0">
                            <span>-</span>
                            <input type="number" name="price_max" class="filter-input" placeholder="{{ __('Max') }}" value="{{ request('price_max') }}" min="0">
                        </div>
                    </div>

                    <div class="filter-input-group">
                        <label>{{ __('Availability') }}</label>
                        <select name="availability" class="filter-input">
                            <option value="">{{ __('Any') }}</option>
                            <option value="in_stock" {{ request('availability') == 'in_stock' ? 'selected' : '' }}>{{ __('In Stock') }}</option>
                            <option value="pre_order" {{ request('availability') == 'pre_order' ? 'selected' : '' }}>{{ __('Pre Order') }}</option>
                        </select>
                    </div>

                    <div class="filter-input-group">
                        <label>{{ __('Delivery Time') }}</label>
                        <select name="delivery" class="filter-input">
                            <option value="">{{ __('Any') }}</option>
                            <option value="same_day" {{ request('delivery') == 'same_day' ? 'selected' : '' }}>{{ __('Same Day') }}</option>
                            <option value="next_day" {{ request('delivery') == 'next_day' ? 'selected' : '' }}>{{ __('Next Day') }}</option>
                            <option value="week" {{ request('delivery') == 'week' ? 'selected' : '' }}>{{ __('Within a Week') }}</option>
                        </select>
                    </div>

                    <div class="filter-input-group">
                        <label>{{ __('Vendor Type') }}</label>
                        <select name="vendor_type" class="filter-input">
                            <option value="">{{ __('All') }}</option>
                            <option value="individual" {{ request('vendor_type') == 'individual' ? 'selected' : '' }}>{{ __('Individual') }}</option>
                            <option value="business" {{ request('vendor_type') == 'business' ? 'selected' : '' }}>{{ __('Business') }}</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" class="btn-outline" onclick="toggleAdvancedFilters()">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn-primary">{{ __('Apply Filters') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Active Filters Bar -->
    @if(request()->anyFilled(['query', 'category', 'location', 'rating', 'sort', 'price_min', 'price_max', 'availability', 'delivery', 'vendor_type']))
    <div class="active-filters">
        <div class="container">
            <span style="font-size: 14px; color: var(--text-gray);">{{ __('Active filters') }}:</span>
            @if(request('query'))
                <span class="filter-tag">"{{ request('query') }}"</span>
            @endif
            @if(request('category'))
                <span class="filter-tag">{{ ucfirst(request('category')) }}</span>
            @endif
            @if(request('location'))
                <span class="filter-tag">{{ request('location') }}</span>
            @endif
            @if(request('rating'))
                <span class="filter-tag">{{ request('rating') }}+ {{ __('Stars') }}</span>
            @endif
            @if(request('price_min') || request('price_max'))
                <span class="filter-tag">
                    {{ __('Price') }}: {{ request('price_min') ?? '0' }} - {{ request('price_max') ?? '∞' }} ETB
                </span>
            @endif
            @if(request('availability'))
                <span class="filter-tag">{{ ucfirst(str_replace('_', ' ', request('availability'))) }}</span>
            @endif
            @if(request('delivery'))
                <span class="filter-tag">{{ ucfirst(str_replace('_', ' ', request('delivery'))) }}</span>
            @endif
            @if(request('vendor_type'))
                <span class="filter-tag">{{ ucfirst(request('vendor_type')) }} {{ __('Vendor') }}</span>
            @endif
            @if(request('sort') && request('sort') != 'newest')
                <span class="filter-tag">{{ __('Sort') }}: {{ ucfirst(str_replace('_', ' ', request('sort'))) }}</span>
            @endif
            <a href="{{ route('search.results') }}" class="clear-filters">{{ __('Clear all') }}</a>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <div class="container main-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Trending Vendors -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <i class="ri-fire-line"></i> {{ __('Trending Vendors') }}
                </h3>
                <div class="trending-list">
                    @forelse($trendingVendors ?? [] as $index => $vendor)
                    <div class="trending-item" onclick="window.location.href='{{ route('vendor.show', $vendor->id) }}'">
                        <span class="trending-number">{{ $index + 1 }}</span>
                        <div class="trending-info">
                            <div class="trending-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                            <div class="trending-meta">⭐ {{ number_format($vendor->rating, 1) }} • {{ $vendor->products_count ?? 0 }} {{ __('products') }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="trending-item">
                        <div class="trending-info">
                            <div class="trending-meta">{{ __('No trending vendors available') }}</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recently Viewed -->
            @auth
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <i class="ri-history-line"></i> {{ __('Recently Viewed') }}
                </h3>
                <div class="trending-list">
                    @php
                        $recentlyViewed = auth()->user()->recentlyViewedVendors()->take(3)->get();
                    @endphp

                    @forelse($recentlyViewed as $vendor)
                    <div class="trending-item" onclick="window.location.href='{{ route('vendor.show', $vendor->id) }}'">
                        <div class="trending-info">
                            <div class="trending-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                            <div class="trending-meta">{{ __('Viewed') }} {{ $vendor->pivot->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="trending-item">
                        <div class="trending-info">
                            <div class="trending-meta">{{ __('No recently viewed vendors') }}</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
            @endauth

            <!-- Save Search -->
            @auth
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <i class="ri-bookmark-line"></i> {{ __('Save This Search') }}
                </h3>
                <button class="btn-primary" style="width: 100%;" onclick="saveSearch()">
                    <i class="ri-save-line"></i> {{ __('Save Search') }}
                </button>
            </div>
            @endauth

            <!-- Export Results -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <i class="ri-download-line"></i> {{ __('Export Results') }}
                </h3>
                <div style="display: flex; gap: 8px;">
                    <button class="btn-outline" style="flex: 1;" onclick="exportResults('csv')">
                        CSV
                    </button>
                    <button class="btn-outline" style="flex: 1;" onclick="exportResults('pdf')">
                        PDF
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="content-area">

            @if($vendors->count() > 0)
            <div class="grid-container" id="vendorGrid">
                @foreach($vendors as $vendor)
                <div class="vendor-card">
                    <div class="card-image-grid">
                        @if($vendor->email_verified_at)
                            <span class="verified-badge"><i class="ri-verified-badge-fill"></i> {{ __('Verified') }}</span>
                        @endif

                        <!-- Quick Actions -->
                        <div class="quick-actions">
                            <button class="quick-action-btn" onclick="toggleSave({{ $vendor->id }}, this)" title="{{ __('Save Vendor') }}">
                                <i class="ri-bookmark-line"></i>
                            </button>
                            <button class="quick-action-btn" onclick="shareVendor({{ $vendor->id }})" title="{{ __('Share') }}">
                                <i class="ri-share-line"></i>
                            </button>
                            <button class="quick-action-btn" onclick="quickView({{ $vendor->id }})" title="{{ __('Quick View') }}">
                                <i class="ri-eye-line"></i>
                            </button>
                        </div>

                        <!-- Compare Checkbox -->
                        <div class="compare-checkbox">
                            <input type="checkbox" id="compare-{{ $vendor->id }}" onchange="toggleCompare({{ $vendor->id }})">
                            <label for="compare-{{ $vendor->id }}">{{ __('Compare') }}</label>
                        </div>

                        @php
                            $mainImage = $vendor->main_image
                                ? (filter_var($vendor->main_image, FILTER_VALIDATE_URL)
                                    ? $vendor->main_image
                                    : Storage::url($vendor->main_image))
                                : 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80';

                            $subImage1 = $vendor->sub_image_1
                                ? (filter_var($vendor->sub_image_1, FILTER_VALIDATE_URL)
                                    ? $vendor->sub_image_1
                                    : Storage::url($vendor->sub_image_1))
                                : 'https://images.unsplash.com/photo-1565193566173-7a646c770962?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80';

                            $subImage2 = $vendor->sub_image_2
                                ? (filter_var($vendor->sub_image_2, FILTER_VALIDATE_URL)
                                    ? $vendor->sub_image_2
                                    : Storage::url($vendor->sub_image_2))
                                : 'https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80';
                        @endphp
                        <img src="{{ $mainImage }}"
                             alt="{{ $vendor->business_name }}"
                             class="card-img-main"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=No+Image';">
                        <img src="{{ $subImage1 }}"
                             alt="{{ $vendor->business_name }}"
                             class="card-img-sub"
                             loading="lazy"
                             onerror="this.style.display='none'">
                        <img src="{{ $subImage2 }}"
                             alt="{{ $vendor->business_name }}"
                             class="card-img-sub"
                             loading="lazy"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="card-content">
                        <div class="vendor-header">
                            <h3 class="vendor-name">{{ $vendor->business_name ?? $vendor->name }}</h3>
                            <div class="vendor-rating">
                                <i class="ri-star-fill"></i> {{ number_format($vendor->rating ?? 4.5, 1) }}
                            </div>
                        </div>
                        <span class="vendor-category">{{ $vendor->category ?? __('General Store') }}</span>

                        @if($vendor->description)
                        <p class="vendor-description">{{ Str::limit($vendor->description, 100) }}</p>
                        @endif

                        <!-- Product Pricing with Original Price & Discount -->
                        @if($vendor->products()->count() > 0)
                        <div class="product-pricing">
                            @foreach($vendor->products()->latest()->take(2)->get() as $product)
                            <div class="product-item">
                                <span class="product-name">{{ Str::limit($product->name, 20) }}</span>
                                <div class="price-wrapper">
                                    @if(isset($product->original_price) && $product->original_price > $product->price)
                                        <span class="original-price">{{ number_format($product->original_price) }} ETB</span>
                                        <span class="current-price">{{ number_format($product->price) }} ETB</span>
                                        @php
                                            $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                                        @endphp
                                        <span class="discount-badge">-{{ $discount }}%</span>
                                    @else
                                        <span class="current-price">{{ number_format($product->price) }} ETB</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @if($vendor->products()->count() > 2)
                            <div style="text-align: right; font-size: 11px; color: var(--text-gray); margin-top: 4px;">
                                +{{ $vendor->products()->count() - 2 }} {{ __('more products') }}
                            </div>
                            @endif
                        </div>
                        @endif

                        <div class="vendor-meta">
                            <div class="meta-item">
                                <i class="ri-map-pin-2-line"></i>
                                <span>{{ $vendor->city ?? 'Jimma' }}, {{ $vendor->state ?? 'Oromia' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="ri-box-3-line"></i>
                                <span>{{ $vendor->products_count ?? 0 }} {{ __('Products') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="ri-user-follow-line"></i>
                                <span>{{ $vendor->followers_count ?? 0 }} {{ __('Followers') }}</span>
                            </div>
                        </div>
                         <div class="action-area">
                            <a href="{{ route('vendor.show', $vendor->id) }}" class="btn-outline" title="{{ __('View vendor profile and information') }}">
                                <i class="ri-store-line"></i> {{ __('View Shop') }}
                            </a>
                            <a href="{{ route('vendor.show', $vendor->id) }}#products" class="btn-shop" title="{{ __('Go directly to products section') }}">
                                <i class="ri-shopping-bag-line"></i> {{ __('Shop Now') }}
                            </a>
                            @auth
                                @if(Auth::id() !== $vendor->id)
                                    @php
                                        $isFollowing = Auth::user()->following()->where('vendor_id', $vendor->id)->exists();
                                    @endphp
                                    @if($isFollowing)
                                        <form action="{{ route('user.vendor.unfollow', $vendor->id) }}" method="POST" style="flex:1;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-following">
                                                <i class="ri-user-unfollow-line"></i> {{ __('Following') }}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.vendor.follow', $vendor->id) }}" method="POST" style="flex:1;">
                                            @csrf
                                            <button type="submit" class="btn-primary">
                                                <i class="ri-user-follow-line"></i> {{ __('Follow') }}
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn-primary">
                                    <i class="ri-user-follow-line"></i> {{ __('Follow') }}
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($vendors->hasPages())
            <div class="pagination">
                @if($vendors->onFirstPage())
                    <span class="page-link disabled"><i class="ri-arrow-left-s-line"></i></span>
                @else
                    <a href="{{ $vendors->previousPageUrl() }}" class="page-link next-prev"><i class="ri-arrow-left-s-line"></i> {{ __('Prev') }}</a>
                @endif

                @php
                    $start = max(1, $vendors->currentPage() - 2);
                    $end = min($vendors->lastPage(), $vendors->currentPage() + 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $vendors->url(1) }}" class="page-link">1</a>
                    @if($start > 2)
                        <span class="page-link disabled">...</span>
                    @endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ $vendors->url($i) }}" class="page-link {{ $i == $vendors->currentPage() ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if($end < $vendors->lastPage())
                    @if($end < $vendors->lastPage() - 1)
                        <span class="page-link disabled">...</span>
                    @endif
                    <a href="{{ $vendors->url($vendors->lastPage()) }}" class="page-link">{{ $vendors->lastPage() }}</a>
                @endif

                @if($vendors->hasMorePages())
                    <a href="{{ $vendors->nextPageUrl() }}" class="page-link next-prev">{{ __('Next') }} <i class="ri-arrow-right-s-line"></i></a>
                @else
                    <span class="page-link disabled">{{ __('Next') }} <i class="ri-arrow-right-s-line"></i></span>
                @endif
            </div>
            @endif

            @else
            <div class="no-results">
                <i class="ri-store-3-line"></i>
                <h3>{{ __('No vendors found') }}</h3>
                <p>{{ __('We couldn\'t find any vendors matching your search criteria. Try adjusting your filters or explore other categories.') }}</p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('search.results') }}" class="btn-primary" style="padding: 12px 24px; font-size: 14px; width: auto;">
                        <i class="ri-filter-off-line"></i> {{ __('Clear all filters') }}
                    </a>
                    <a href="{{ route('register') }}" class="btn-outline" style="padding: 12px 24px; font-size: 14px; width: auto;">
                        <i class="ri-store-line"></i> {{ __('Become a Vendor') }}
                    </a>
                </div>
            </div>
            @endif

        </main>
    </div>

    <!-- Compare Bar -->
    <div class="compare-bar" id="compareBar">
        <div class="container compare-bar-content">
            <div class="compare-items" id="compareItems">
                <!-- Compare items will be added here dynamically -->
            </div>
            <div style="display: flex; gap: 12px;">
                <button class="btn-outline" onclick="clearCompare()">
                    {{ __('Clear All') }}
                </button>
                <button class="btn-primary" onclick="compareVendors()">
                    {{ __('Compare') }} (<span id="compareCount">0</span>)
                </button>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal" id="quickViewModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeQuickView()">
                <i class="ri-close-line"></i>
            </button>
            <div class="modal-body" id="quickViewContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <!-- Share Modal -->
    <div class="modal" id="shareModal">
        <div class="modal-content" style="max-width: 500px;">
            <button class="modal-close" onclick="closeShareModal()">
                <i class="ri-close-line"></i>
            </button>
            <div style="padding: 30px;">
                <h2 style="margin-bottom: 20px;">{{ __('Share Vendor') }}</h2>
                <div class="share-options">
                    <a href="#" class="share-btn facebook" onclick="shareOn('facebook'); return false;">
                        <i class="ri-facebook-fill"></i>
                        Facebook
                    </a>
                    <a href="#" class="share-btn twitter" onclick="shareOn('twitter'); return false;">
                        <i class="ri-twitter-fill"></i>
                        Twitter
                    </a>
                    <a href="#" class="share-btn whatsapp" onclick="shareOn('whatsapp'); return false;">
                        <i class="ri-whatsapp-fill"></i>
                        WhatsApp
                    </a>
                    <a href="#" class="share-btn email" onclick="shareOn('email'); return false;">
                        <i class="ri-mail-fill"></i>
                        Email
                    </a>
                </div>
                <div style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">{{ __('Copy Link') }}</label>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" id="shareLink" class="filter-input" style="flex: 1;" readonly>
                        <button class="btn-primary" onclick="copyLink()">{{ __('Copy') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Operation completed successfully</div>
        </div>
        <div class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-links">
                <a href="{{ route('home') }}">{{ __('Home') }}</a>
                <a href="{{ route('search.results') }}">{{ __('Browse Vendors') }}</a>
                <a href="{{ route('register') }}">{{ __('Become a Vendor') }}</a>
                <a href="{{ route('privacy-policy') }}">{{ __('Privacy Policy') }}</a>
                <a href="{{ route('terms-of-service') }}">{{ __('Terms of Service') }}</a>
                <a href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
            </div>
            <p>&copy; {{ date('Y') }} Vendora Marketplace. {{ __('Connecting Jimma with local vendors. All rights reserved.') }}</p>
        </div>
    </footer>

    <script>
        // Global variables
        let compareList = JSON.parse(localStorage.getItem('compareList')) || [];
        const vendorShowUrl = '{{ route("vendor.show", ":id") }}';
        const vendorSaveUrl = '{{ route("vendor.save.customer", ":id") }}';
        const vendorUnsaveUrl = '{{ route("vendor.unsave.customer", ":id") }}';
        const vendorQuickViewUrl = '{{ route("vendor.quick-view", ":id") }}';
        const compareUrl = '{{ route("vendors.compare") }}';
        let savedVendors = new Set();
        let currentView = localStorage.getItem('viewMode') || 'grid';

        // Theme toggle - sync with backend and localStorage
        function applyTheme(theme) {
            document.body.classList.toggle('dark-mode', theme === 'dark');
            const ico = document.querySelector('#themeToggle i') || document.querySelector('#themeToggleMobile i');
            if (ico) ico.className = theme === 'dark' ? 'ri-sun-line' : 'ri-moon-line';
        }

        function updateTheme(theme) {
            applyTheme(theme);
            localStorage.setItem('theme', theme);
            fetch('/toggle-theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: theme })
            });
        }

        const themeToggleBtn = document.getElementById('themeToggle');
        const themeToggleBtnMobile = document.getElementById('themeToggleMobile');
        [themeToggleBtn, themeToggleBtnMobile].forEach(btn => {
            if (!btn) return;
            btn.addEventListener('click', function() {
                const isDark = document.body.classList.toggle('dark-mode');
                const theme = isDark ? 'dark' : 'light';
                const icon = this.querySelector('i');
                if (icon) icon.className = isDark ? 'ri-sun-line' : 'ri-moon-line';
                updateTheme(theme);
            });
        });

        // initialize theme on load from server or storage
        (function() {
            let theme = localStorage.getItem('theme');
            if (theme) {
                applyTheme(theme);
            } else {
                fetch('/get-theme').then(r=>r.json()).then(data=>{
                    if (data.success && data.theme) {
                        applyTheme(data.theme);
                        try { localStorage.setItem('theme', data.theme); } catch(e) {}
                    }
                }).catch(()=>{});
            }
        })();

        // Language dropdown toggle and switch
        function toggleLanguageDropdown(e, isMobile = false) {
            e.stopPropagation();
            const selId = isMobile ? 'languageSelectorMobile' : 'languageSelector';
            const sel = document.getElementById(selId);
            if (!sel) return;
            const dd = sel.querySelector('.language-dropdown');
            const expanded = dd.style.display !== 'block';
            dd.style.display = expanded ? 'block' : 'none';
            const btn = document.getElementById(isMobile ? 'languageToggleMobile' : 'languageToggle');
            if (btn) btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }

        function changeLanguage(locale, isMobile = false) {
            document.querySelectorAll('.language-option').forEach(opt => {
                if (opt.dataset.locale === locale) {
                    if (!opt.querySelector('i')) {
                        const icon = document.createElement('i');
                        icon.className = 'ri-check-line';
                        icon.style.float = 'right';
                        opt.appendChild(icon);
                    }
                } else {
                    const icon = opt.querySelector('i');
                    if (icon) icon.remove();
                }
            });
            const desktopSel = document.getElementById('languageSelector');
            if (desktopSel) {
                const dd = desktopSel.querySelector('.language-dropdown');
                if (dd) dd.style.display = 'none';
                const btn = document.getElementById('languageToggle');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
            if (isMobile) {
                const mobileSel = document.getElementById('languageSelectorMobile');
                if (mobileSel) {
                    const dd = mobileSel.querySelector('.language-dropdown');
                    if (dd) dd.style.display = 'none';
                    const btn = document.getElementById('languageToggleMobile');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            }
            try { localStorage.setItem('locale', locale); } catch{};
            fetch('/switch-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ locale: locale })
            }).then(() => {
                window.location.reload();
            }).catch(err => console.error('Failed to change language', err));
        }

        // Close language dropdown when clicking outside
        document.addEventListener('click', function(event) {
            ['languageSelector','languageSelectorMobile'].forEach(id => {
                const sel = document.getElementById(id);
                if (!sel) return;
                const dd = sel.querySelector('.language-dropdown');
                if (dd && !sel.contains(event.target)) {
                    dd.style.display = 'none';
                    const btn = sel.querySelector('button');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // set html lang from localStorage as soon as possible
        (function() {
            try {
                const storedLocale = localStorage.getItem('locale');
                if (storedLocale && document.documentElement.lang !== storedLocale) {
                    document.documentElement.lang = storedLocale;
                }
            } catch(e) { }
        })();

        // Set initial view
        document.addEventListener('DOMContentLoaded', function() {
            const grid = document.getElementById('vendorGrid');
            const buttons = document.querySelectorAll('.view-btn');

            if (grid && buttons.length >= 2) {
                if (currentView === 'list') {
                    grid.classList.add('list-view');
                    buttons[1].classList.add('active');
                    buttons[0].classList.remove('active');
                } else {
                    grid.classList.remove('list-view');
                    buttons[0].classList.add('active');
                    buttons[1].classList.remove('active');
                }
            }

            // Initialize compare checkboxes
            compareList.forEach(id => {
                const checkbox = document.getElementById(`compare-${id}`);
                if (checkbox) checkbox.checked = true;
            });
            updateCompareBar();
        });

        // Search History
        const searchInput = document.getElementById('searchInput');
        const searchHistory = document.getElementById('searchHistory');

        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                if (searchHistory) {
                    searchHistory.classList.add('active');
                }
            });
        }

        document.addEventListener('click', (e) => {
            if (searchHistory && !searchInput?.contains(e.target) && !searchHistory.contains(e.target)) {
                searchHistory.classList.remove('active');
            }
        });

        // Toast notification
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');

            toast.className = 'toast ' + type;
            toastIcon.innerHTML = type === 'success' ? '<i class="ri-checkbox-circle-line"></i>' : '<i class="ri-error-warning-line"></i>';
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Remove search history item
        function removeSearchHistory(id, element) {
            if (!confirm('{{ __("Remove this search from history?") }}')) {
                return;
            }

            fetch(`/search/history/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the element from DOM
                    element.closest('.history-item').remove();

                    // Check if there are no more history items
                    const historyContainer = document.getElementById('searchHistory');
                    const remainingItems = historyContainer.querySelectorAll('.history-item:not(.clear-history-btn)');

                    if (remainingItems.length === 0) {
                        historyContainer.innerHTML = `
                            <div class="history-item">
                                <span class="history-text" style="color: var(--text-gray);">
                                    <i class="ri-information-line"></i>
                                    {{ __('No search history yet') }}
                                </span>
                            </div>
                        `;
                    }
                    showToast('Success', 'Search history removed');
                } else {
                    showToast('Error', 'Failed to remove search history', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to remove search history', 'error');
            });
        }

        // Clear all search history
        function clearAllSearchHistory() {
            if (!confirm('{{ __("Clear all search history?") }}')) {
                return;
            }

            fetch('/search/history/clear/all', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    showToast('Error', 'Failed to clear search history', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Failed to clear search history', 'error');
            });
        }

        // Remove single filter
        function removeFilter(filterName) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        }

        // Clear all filters
        function clearAllFilters() {
            window.location.href = '{{ route("search.results") }}';
        }

        // Toggle Advanced Filters
        function toggleAdvancedFilters() {
            const panel = document.getElementById('advancedFilters');
            if (panel) {
                panel.classList.toggle('active');
            }
        }

        // Set View (Grid/List)
        function setView(view) {
            currentView = view;
            localStorage.setItem('viewMode', view);
            const grid = document.getElementById('vendorGrid');
            const buttons = document.querySelectorAll('.view-btn');

            if (!grid) return;

            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.closest('.view-btn').classList.add('active');

            if (view === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        }

        // Toggle Save Vendor
        function toggleSave(vendorId, button) {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            const icon = button.querySelector('i');

            if (savedVendors.has(vendorId)) {
                savedVendors.delete(vendorId);
                button.classList.remove('saved');
                icon.className = 'ri-bookmark-line';
                fetch(vendorUnsaveUrl.replace(':id', vendorId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Success', 'Vendor removed from saved');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'Failed to unsave vendor', 'error');
                });
            } else {
                savedVendors.add(vendorId);
                button.classList.add('saved');
                icon.className = 'ri-bookmark-fill';
                fetch(vendorSaveUrl.replace(':id', vendorId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Success', 'Vendor saved successfully');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'Failed to save vendor', 'error');
                });
            }
        }

        // Share Vendor
        function shareVendor(vendorId) {
            const modal = document.getElementById('shareModal');
            const linkInput = document.getElementById('shareLink');
            if (linkInput) {
                linkInput.value = window.location.origin + vendorShowUrl.replace(':id', vendorId);
            }
            if (modal) {
                modal.classList.add('active');
            }
        }

        // Close Share Modal
        function closeShareModal() {
            document.getElementById('shareModal').classList.remove('active');
        }

        // Share on Social Media
        function shareOn(platform) {
            const url = document.getElementById('shareLink')?.value;
            if (!url) return;

            const text = '{{ __("Check out this amazing vendor on Vendora!") }}';

            let shareUrl = '';
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${encodeURIComponent(text)}&body=${encodeURIComponent(url)}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank');
            }
        }

        // Copy Link
        function copyLink() {
            const input = document.getElementById('shareLink');
            if (!input) return;

            input.select();
            document.execCommand('copy');

            const button = event.target.closest('button');
            if (button) {
                const originalText = button.textContent;
                button.textContent = '{{ __("Copied!") }}';
                button.style.backgroundColor = '#10B981';
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.backgroundColor = '';
                }, 2000);
            }
        }

        // Quick View
        function quickView(vendorId) {
            const modal = document.getElementById('quickViewModal');
            const content = document.getElementById('quickViewContent');

            if (!modal || !content) return;

            content.innerHTML = '<div style="text-align: center; padding: 60px 40px;"><div class="loading-spinner" style="margin: 0 auto 20px;"></div><p style="color: var(--text-gray);">{{ __("Loading vendor details...") }}</p></div>';
            modal.classList.add('active');

            fetch(vendorQuickViewUrl.replace(':id', vendorId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        let productsHtml = '';
                        if (data.products && data.products.length > 0) {
                            productsHtml = data.products.map(product => {
                                const discountHtml = product.discount > 0 ?
                                    `<span class="discount-badge" style="margin-left: 8px;">-${product.discount}%</span>` : '';
                                return `
                                    <div class="product-item" style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dashed var(--border-color);">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="font-weight: 500;">${product.name}</span>
                                            <div>
                                                ${product.original_price ?
                                                    `<span style="text-decoration: line-through; color: var(--text-gray); font-size: 12px; margin-right: 8px;">${product.original_price} ETB</span>`
                                                    : ''}
                                                <span style="color: var(--primary-gold); font-weight: 700;">${product.price} ETB</span>
                                                ${discountHtml}
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }).join('');
                        } else {
                            productsHtml = '<p style="color: var(--text-gray); text-align: center;">{{ __("No products available") }}</p>';
                        }

                        content.innerHTML = `
                            <div class="modal-images">
                                <img src="${data.main_image}" alt="${data.name}" class="modal-main-image">
                                <img src="${data.sub_image1}" alt="${data.name}" class="modal-sub-image">
                                <img src="${data.sub_image2}" alt="${data.name}" class="modal-sub-image">
                            </div>
                            <div class="modal-info">
                                <h2 class="modal-title">${data.name}</h2>
                                <div class="modal-rating">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="color: #FBBF24;">★★★★★</div>
                                        <span style="font-weight: 600;">${data.rating}</span>
                                        <span style="color: var(--text-gray);">(${data.reviews_count} {{ __('reviews') }})</span>
                                    </div>
                                </div>

                                <p style="color: var(--text-gray); line-height: 1.6; margin: 10px 0;">
                                    ${data.description}
                                </p>

                                <div style="margin: 15px 0;">
                                    <h4 style="margin-bottom: 10px; color: var(--text-dark);">{{ __('Popular Products') }}</h4>
                                    ${productsHtml}
                                </div>

                                <div class="modal-meta">
                                    <div class="meta-item">
                                        <i class="ri-map-pin-2-line"></i>
                                        <span>${data.location}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="ri-box-3-line"></i>
                                        <span>${data.products_count} {{ __('Products') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="ri-user-follow-line"></i>
                                        <span>${data.followers_count} {{ __('Followers') }}</span>
                                    </div>
                                </div>

                                <div class="modal-actions" style="display: flex; gap: 12px; margin-top: 20px;">
                                    <a href="#" onclick="window.location.href=vendorShowUrl.replace(':id', data.id)" class="btn-outline" style="flex: 1; text-align: center;">
                                        <i class="ri-store-line"></i> {{ __('View Full Shop') }}
                                    </a>
                                    <button class="btn-shop" onclick="closeQuickView(); window.location.href=vendorShowUrl.replace(':id', data.id) + '#products'" style="flex: 1;">
                                        <i class="ri-shopping-bag-line"></i> {{ __('Shop Now') }}
                                    </button>
                                </div>
                            </div>
                        `;
                    } else {
                        throw new Error(data.message || '{{ __("Failed to load vendor details") }}');
                    }
                })
                .catch(error => {
                    console.error('Quick view error:', error);
                    content.innerHTML = `
                        <div style="text-align: center; padding: 60px 40px;">
                            <i class="ri-error-warning-line" style="font-size: 48px; color: #EF4444; margin-bottom: 20px;"></i>
                            <h3 style="color: var(--text-dark); margin-bottom: 10px;">{{ __("Error Loading Vendor") }}</h3>
                            <p style="color: var(--text-gray); margin-bottom: 20px;">{{ __("Failed to load vendor details. Please try again.") }}</p>
                            <button class="btn-primary" onclick="closeQuickView()" style="padding: 10px 24px;">
                                <i class="ri-close-line"></i> {{ __("Close") }}
                            </button>
                        </div>
                    `;
                });
        }

        // Close Quick View
        function closeQuickView() {
            document.getElementById('quickViewModal').classList.remove('active');
        }

        // Toggle Compare
        function toggleCompare(vendorId) {
            const index = compareList.indexOf(vendorId);
            const checkbox = document.getElementById(`compare-${vendorId}`);

            if (index > -1) {
                compareList.splice(index, 1);
                if (checkbox) checkbox.checked = false;
            } else {
                if (compareList.length >= 3) {
                    alert('{{ __("You can compare up to 3 vendors at a time") }}');
                    if (checkbox) checkbox.checked = false;
                    return;
                }
                compareList.push(vendorId);
                if (checkbox) checkbox.checked = true;
            }

            localStorage.setItem('compareList', JSON.stringify(compareList));
            updateCompareBar();
        }

        // Update Compare Bar
        function updateCompareBar() {
            const bar = document.getElementById('compareBar');
            const items = document.getElementById('compareItems');
            const countSpan = document.getElementById('compareCount');

            if (!bar || !items || !countSpan) return;

            if (compareList.length > 0) {
                bar.classList.add('active');
                countSpan.textContent = compareList.length;

                // Fetch vendor names for display
                items.innerHTML = '';
                compareList.forEach(id => {
                    const vendorElement = document.querySelector(`#compare-${id}`)?.closest('.vendor-card');
                    const vendorName = vendorElement?.querySelector('.vendor-name')?.textContent || `Vendor ${id}`;
                    items.innerHTML += `
                        <div class="compare-item">
                            <span>${vendorName}</span>
                            <i class="ri-close-line compare-item-remove" onclick="toggleCompare(${id})"></i>
                        </div>
                    `;
                });
            } else {
                bar.classList.remove('active');
            }
        }

        // Clear Compare
        function clearCompare() {
            compareList = [];
            localStorage.setItem('compareList', JSON.stringify(compareList));
            document.querySelectorAll('input[type="checkbox"][id^="compare-"]').forEach(cb => {
                cb.checked = false;
            });
            updateCompareBar();
        }

        // Compare Vendors
        function compareVendors() {
            if (compareList.length < 2) {
                alert('{{ __("Please select at least 2 vendors to compare") }}');
                return;
            }
            window.location.href = `${compareUrl}?vendors=${compareList.join(',')}`;
        }

        // Save Search
        function saveSearch() {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            const searchParams = new URLSearchParams(window.location.search);
            const searchData = {
                query: searchParams.get('query') || '',
                filters: Object.fromEntries(searchParams),
                saved_at: new Date().toISOString()
            };

            fetch('/search/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(searchData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success', '{{ __("Search saved successfully!") }}');
                } else {
                    showToast('Error', '{{ __("Failed to save search") }}', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', '{{ __("Failed to save search") }}', 'error');
            });
        }

        // Export Results
        function exportResults(format) {
            const url = new URL(window.location.href);
            url.searchParams.set('export', format);
            window.open(url.toString(), '_blank');
        }

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Close modals on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal.active').forEach(modal => {
                    modal.classList.remove('active');
                });
            }
        });

        // Close modals on background click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        });

        // Confirm logout (if logout button exists)
        document.querySelectorAll('form[action*="logout"] button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('{{ __("Are you sure you want to logout?") }}')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
