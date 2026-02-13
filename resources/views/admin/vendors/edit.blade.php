<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Edit Vendor - Vendora Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        :root {
            --primary-bg: #f3f4f6;
            --sidebar-bg: #1f2937;
            --sidebar-text: #9ca3af;
            --sidebar-text-active: #ffffff;
            --sidebar-active-bg: #374151;
            --card-bg: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        .brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            color: white;
            font-size: 24px;
            font-weight: 700;
            border-bottom: 1px solid #374151;
            letter-spacing: -0.5px;
        }
        
        .brand i {
            color: var(--primary-gold);
            margin-right: 12px;
            font-size: 28px;
        }

        .nav-menu {
            padding: 24px 16px;
            flex: 1;
        }

        .nav-group {
            margin-bottom: 24px;
        }

        .nav-label {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            padding-left: 12px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            font-size: 15px;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-active);
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 20px;
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid #374151;
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .user-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info p {
            color: var(--sidebar-text);
            font-size: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        /* Top Header */
        .top-header {
            height: 70px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-secondary);
            cursor: pointer;
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .top-header {
                padding: 0 20px;
            }
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--primary-bg);
            padding: 8px 16px;
            border-radius: 8px;
            width: 400px;
        }

        .search-bar i {
            color: var(--text-secondary);
            margin-right: 8px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: background 0.2s;
            position: relative;
        }

        .icon-btn:hover {
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Form Card */
        .form-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 32px;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: #9c7832;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-dark);
            color: var(--text-dark);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Logout Button */
        .logout-btn {
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: var(--sidebar-active-bg);
            color: var(--accent-red);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-item">
                    <i class="ri-user-3-line"></i> Customers
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">MANAGEMENT</div>
                <a href="{{ route('admin.vendors') }}" class="nav-item">
                    <i class="ri-store-2-line"></i> Vendors
                </a>
                <a href="{{ route('admin.catalog') }}" class="nav-item">
                    <i class="ri-archive-line"></i> Catalog
                </a>
                <a href="{{ route('admin.promotions') }}" class="nav-item">
                    <i class="ri-price-tag-3-line"></i> Promotions
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ADMIN</div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="{{ route('admin.admins.list') }}" class="nav-item">
                    <i class="ri-shield-user-line"></i> Admins
                </a>
                <a href="{{ route('admin.roles') }}" class="nav-item">
                    <i class="ri-shield-keyhole-line"></i> Roles
                </a>
                <a href="{{ route('admin.help') }}" class="nav-item">
                    <i class="ri-question-line"></i> Help
                </a>
                <a href="{{ route('admin.notifications') }}" class="nav-item">
                    <i class="ri-notification-3-line"></i> Notifications
                </a>
                <a href="{{ route('admin.messages') }}" class="nav-item">
                    <i class="ri-mail-line"></i> Messages
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
            </div>
            <div class="user-info">
                <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                <p>{{ Auth::user()->role ?? 'Super Admin' }}</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center;">
                <div class="menu-toggle" id="menuToggle">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search...">
                </div>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('admin.help') }}" class="icon-btn">
                    <i class="ri-question-line"></i>
                </a>
                <a href="{{ route('admin.notifications') }}" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
                <a href="{{ route('admin.messages') }}" class="icon-btn">
                    <i class="ri-mail-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Vendor</h1>
                    <p class="page-subtitle">Update vendor information</p>
                </div>
                <div>
                    <a href="{{ route('admin.vendors') }}" class="btn btn-secondary">
                        <i class="ri-arrow-left-line"></i> Back to Vendors
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i> {{ session('error') }}
                </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Business Name</label>
                            <input type="text" name="business_name" class="form-input" value="{{ old('business_name', $vendor->business_name ?? $vendor->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $vendor->email) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">Select Category</option>
                                <option value="coffee" {{ ($vendor->category ?? '') == 'coffee' ? 'selected' : '' }}>Coffee & Tea</option>
                                <option value="handicrafts" {{ ($vendor->category ?? '') == 'handicrafts' ? 'selected' : '' }}>Traditional Handicrafts</option>
                                <option value="textiles" {{ ($vendor->category ?? '') == 'textiles' ? 'selected' : '' }}>Textiles & Habesha Kemis</option>
                                <option value="food" {{ ($vendor->category ?? '') == 'food' ? 'selected' : '' }}>Ethiopian Food & Spices</option>
                                <option value="jewelry" {{ ($vendor->category ?? '') == 'jewelry' ? 'selected' : '' }}>Traditional Jewelry</option>
                                <option value="art" {{ ($vendor->category ?? '') == 'art' ? 'selected' : '' }}>Art & Paintings</option>
                                <option value="electronics" {{ ($vendor->category ?? '') == 'electronics' ? 'selected' : '' }}>Electronics & Repair</option>
                                <option value="services" {{ ($vendor->category ?? '') == 'services' ? 'selected' : '' }}>Local Services</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone', $vendor->phone ?? '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-textarea" placeholder="Vendor description...">{{ old('description', $vendor->description ?? '') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <select name="city" class="form-select">
                                <option value="">Select City</option>
                                <option value="Jimma" {{ ($vendor->city ?? '') == 'Jimma' ? 'selected' : '' }}>Jimma</option>
                                <option value="Addis Ababa" {{ ($vendor->city ?? '') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                <option value="Bahir Dar" {{ ($vendor->city ?? '') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                                <option value="Hawassa" {{ ($vendor->city ?? '') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Region/State</label>
                            <select name="state" class="form-select">
                                <option value="">Select Region</option>
                                <option value="Oromia" {{ ($vendor->state ?? '') == 'Oromia' ? 'selected' : '' }}>Oromia</option>
                                <option value="Addis Ababa" {{ ($vendor->state ?? '') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                                <option value="Amhara" {{ ($vendor->state ?? '') == 'Amhara' ? 'selected' : '' }}>Amhara</option>
                                <option value="Sidama" {{ ($vendor->state ?? '') == 'Sidama' ? 'selected' : '' }}>Sidama</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Website</label>
                            <input type="url" name="website" class="form-input" value="{{ old('website', $vendor->website ?? '') }}" placeholder="https://example.com">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tax ID / License</label>
                            <input type="text" name="tax_id" class="form-input" value="{{ old('tax_id', $vendor->tax_id ?? '') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $vendor->is_active ? 'checked' : '' }}>
                                <span>Account Active</span>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-check">
                                <input type="checkbox" name="email_verified" class="form-check-input" value="1" {{ $vendor->email_verified_at ? 'checked' : '' }}>
                                <span>Email Verified</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.vendors') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });

        // Confirm logout
        document.querySelectorAll('.logout-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>