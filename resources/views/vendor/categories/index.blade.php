
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Categories - Vendora | Jimma, Ethiopia</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Add all your existing styles here */
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
            --accent-purple: #8b5cf6;
            --border-color: #e5e7eb;
            --primary-gold: #B88E3F;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
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

        /* Sidebar - same as before */
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

        .ethiopia-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
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

         .profile-avatar-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--white);
            box-shadow: var(--shadow);
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

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-red);
            color: white;
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 24px 16px;
            }
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .category-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
            border-color: var(--primary-gold);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .category-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-gold), #9c7832);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .category-image {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
        }

        .category-actions {
            display: flex;
            gap: 8px;
        }

        .category-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .category-action-btn:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
        }

        .category-action-btn.delete:hover {
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .category-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .badge-active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-inactive {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-parent {
            background-color: var(--accent-blue);
            color: white;
        }

        .category-description {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
            min-height: 60px;
        }

        .category-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .product-count {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .product-count i {
            color: var(--primary-gold);
        }

        .category-slug {
            font-size: 11px;
            color: var(--text-secondary);
            background-color: #f3f4f6;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .btn {
            padding: 10px 20px;
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

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background-color: var(--card-bg);
            z-index: 10;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-secondary);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background-color: #f3f4f6;
            color: var(--accent-red);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            position: sticky;
            bottom: 0;
            background-color: var(--card-bg);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-primary);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--card-bg);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
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

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .file-upload-area:hover {
            border-color: var(--primary-gold);
            background-color: #fef3e7;
        }

        .image-preview {
            display: none;
            margin-top: 16px;
            align-items: center;
            gap: 12px;
        }

        .image-preview.active {
            display: flex;
        }

        .image-preview img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .error-message {
            color: var(--accent-red);
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            border-left: 4px solid var(--primary-gold);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            border-left-color: var(--success-color);
        }

        .toast-error {
            border-left-color: var(--accent-red);
        }

        .toast-icon {
            font-size: 24px;
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
            color: var(--text-secondary);
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            background-color: var(--card-bg);
            border-radius: 12px;
        }

        .empty-icon {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .bg-blue-light { background-color: #eff6ff; color: var(--accent-blue); }
        .bg-green-light { background-color: #ecfdf5; color: var(--accent-green); }
        .bg-yellow-light { background-color: #fffbeb; color: var(--accent-yellow); }
        .bg-purple-light { background-color: #f5f3ff; color: var(--accent-purple); }
        .bg-red-light { background-color: #fee2e2; color: var(--accent-red); }
        .bg-gold-light { background-color: #fef3e7; color: var(--primary-gold); }
    </style>
</head>
<body>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-icon" id="toastIcon">
            <i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Action completed successfully!</div>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <i class="ri-close-line"></i>
        </button>
    </div>

    <!-- Add/Edit Category Modal -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 id="modalTitle">
                    <i class="ri-add-circle-line" style="color: var(--primary-gold);"></i>
                    Add New Category
                </h2>
                <button class="modal-close" onclick="closeCategoryModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form id="categoryForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="categoryId" name="id">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Category Name <span style="color: var(--accent-red);">*</span></label>
                        <input type="text" id="categoryName" name="name" class="form-input" placeholder="e.g. Ethiopian Coffee, Handicrafts..." required>
                        <div id="nameError" class="error-message"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Parent Category</label>
                            <select id="categoryParent" name="parent_id" class="form-select">
                                <option value="">None (Top Level)</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <div class="form-check">
                                <input type="checkbox" id="categoryActive" name="is_active" class="form-check-input" value="1" checked>
                                <label for="categoryActive">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea id="categoryDescription" name="description" class="form-textarea" placeholder="Describe this category..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category Image</label>
                        <div class="file-upload-area" onclick="document.getElementById('categoryImage').click()">
                            <i class="ri-upload-cloud-2-line" style="font-size: 24px; color: var(--primary-gold); margin-bottom: 8px; display: block;"></i>
                            <div>Click to upload or drag and drop</div>
                            <div style="font-size: 12px; color: var(--text-secondary); margin-top: 4px;">SVG, PNG, JPG (max. 2MB)</div>
                            <input type="file" id="categoryImage" name="image" style="display: none;" accept="image/*">
                        </div>
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveCategoryBtn">
                        <span id="saveText">Save Category</span>
                        <span id="saveSpinner" class="spinner" style="display: none;"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-container" style="max-width: 400px;">
            <div class="modal-header">
                <h2>
                    <i class="ri-delete-bin-line" style="color: var(--danger-color);"></i>
                    Delete Category
                </h2>
                <button class="modal-close" onclick="closeDeleteModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 16px;">Are you sure you want to delete this category?</p>
                <p style="color: var(--text-secondary); font-size: 14px;">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmDelete()" style="background-color: var(--danger-color);">Delete</button>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <i class="ri-store-3-fill"></i>
            Vendora
            
        </div>

        <div class="nav-menu">
            <div class="nav-group">
                <div class="nav-label">VENDOR</div>
                <a href="{{ route('vendor.dashboard') }}" class="nav-item">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('vendor.show', $vendor->id) }}" class="nav-item">
                    <i class="ri-store-line"></i> My Store
                </a>
                <a href="{{ route('vendor.orders.index') }}" class="nav-item">
                    <i class="ri-shopping-bag-3-line"></i> Orders
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">PRODUCTS</div>
                <a href="{{ route('vendor.products.index') }}" class="nav-item">
                    <i class="ri-list-check"></i> Manage Products
                </a>
                <a href="{{ route('vendor.categories.index') }}" class="nav-item active">
                    <i class="ri-price-tag-3-line"></i> Categories
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">ANALYTICS</div>
                <a href="{{ route('vendor.sales-report') }}" class="nav-item">
                    <i class="ri-bar-chart-2-line"></i> Sales Report
                </a>
                <a href="#" class="nav-item">
                    <i class="ri-eye-line"></i> Store Views
                </a>
                <a href="#" class="nav-item">
                    <i class="ri-star-line"></i> Reviews
                </a>
            </div>

            <div class="nav-group">
                <div class="nav-label">SETTINGS</div>
                <a href="{{ route('profile.show', $vendor->id) }}" class="nav-item">
                    <i class="ri-user-line"></i> Profile
                </a>
                <a href="{{ route('profile.edit', $vendor->id) }}" class="nav-item">
                    <i class="ri-settings-4-line"></i> Store Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; margin-top: 8px;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="user-profile">
            @if(Auth::user()->avatar)
                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->business_name ?? Auth::user()->name }}" class="profile-avatar-img">
            @else
                <div class="avatar">
                    {{ substr(Auth::user()->business_name ?? Auth::user()->name, 0, 2) }}
                </div>
            @endif
            <div class="user-info">
                <h4>{{ $vendor->business_name ?? $vendor->name }}</h4>
                <p>Vendor since {{ $vendor->created_at->format('M Y') }}</p>
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
                    <input type="text" placeholder="Search categories...">
                </div>
            </div>

            <div class="header-actions">
                <a href="#" class="icon-btn">
                    <i class="ri-notification-3-line"></i>
                </a>
                <a href="#" class="icon-btn">
                    <i class="ri-mail-line"></i>
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-container">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Categories</h1>
                    <p class="page-subtitle">Manage product categories for your store</p>
                </div>
                <div>
                    <button onclick="openAddCategoryModal()" class="btn btn-primary">
                        <i class="ri-add-line"></i> Add Category
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Categories</div>
                        <div class="stat-value">{{ $categories->count() }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="ri-product-hunt-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Products</div>
                        <div class="stat-value">{{ $categories->sum('products_count') }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-light">
                        <i class="ri-stack-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Parent Categories</div>
                        <div class="stat-value">{{ $categories->whereNull('parent_id')->count() }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="ri-star-line"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Active</div>
                        <div class="stat-value">{{ $categories->where('is_active', true)->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            @if($categories->count() > 0)
            <div class="categories-grid">
                @foreach($categories as $category)
                <div class="category-card" id="category-{{ $category->id }}">
                    <div class="category-header">
                        <div class="category-name">
                            @if($category->image)
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="category-image">
                            @else
                                <div class="category-icon">
                                    <i class="{{ $category->icon ?? 'ri-price-tag-line' }}"></i>
                                </div>
                            @endif
                            {{ $category->name }}
                            @if($category->parent_id)
                                <span class="category-badge badge-parent">Sub</span>
                            @endif
                            <span class="category-badge {{ $category->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="category-actions">
                            <button class="category-action-btn" onclick="openEditCategoryModal({{ $category->id }})" title="Edit">
                                <i class="ri-edit-line"></i>
                            </button>
                            @if($category->products_count == 0 && $category->children_count == 0)
                            <button class="category-action-btn delete" onclick="openDeleteModal({{ $category->id }})" title="Delete">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            @endif
                        </div>
                    </div>

                    <div class="category-description">
                        {{ $category->description ?? 'No description available.' }}
                    </div>

                    <div class="category-footer">
                        <div class="product-count">
                            <i class="ri-shopping-bag-3-line"></i>
                            {{ $category->products_count }} Products
                        </div>
                        <span class="category-slug">{{ $category->slug }}</span>
                    </div>

                    @if($category->parent)
                    <div style="margin-top: 8px; font-size: 12px; color: var(--text-secondary);">
                        <i class="ri-arrow-up-line"></i> Parent: {{ $category->parent->name }}
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="ri-price-tag-3-line empty-icon"></i>
                <h3 class="empty-title">No Categories Yet</h3>
                <p class="empty-text">Create categories to organize your products and make them easier to find.</p>
                <button onclick="openAddCategoryModal()" class="btn btn-primary">
                    <i class="ri-add-line"></i> Add Your First Category
                </button>
            </div>
            @endif
        </div>
    </main>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let deleteCategoryId = null;
        let currentImageDeleted = false;

        // Toast functions
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (type === 'success') {
                toastIcon.innerHTML = '<i class="ri-checkbox-circle-line" style="color: var(--success-color);"></i>';
                toast.classList.remove('toast-error');
                toast.classList.add('toast-success');
            } else {
                toastIcon.innerHTML = '<i class="ri-error-warning-line" style="color: var(--accent-red);"></i>';
                toast.classList.remove('toast-success');
                toast.classList.add('toast-error');
            }

            toast.classList.add('show');
            setTimeout(hideToast, 3000);
        }

        function hideToast() {
            document.getElementById('toast').classList.remove('show');
        }

        // Modal functions
        function openAddCategoryModal() {
            document.getElementById('modalTitle').innerHTML = '<i class="ri-add-circle-line" style="color: var(--primary-gold);"></i> Add New Category';
            document.getElementById('categoryId').value = '';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('categoryParent').value = '';
            document.getElementById('categoryActive').checked = true;
            document.getElementById('imagePreview').classList.remove('active');
            document.getElementById('imagePreview').innerHTML = '';
            document.getElementById('categoryModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function openEditCategoryModal(id) {
            fetch(`/vendor/categories-list`)
                .then(response => response.json())
                .then(data => {
                    const category = data.categories.find(c => c.id === id);
                    if (category) {
                        document.getElementById('modalTitle').innerHTML = '<i class="ri-edit-line" style="color: var(--primary-gold);"></i> Edit Category';
                        document.getElementById('categoryId').value = category.id;
                        document.getElementById('categoryName').value = category.name;
                        document.getElementById('categoryDescription').value = category.description || '';
                        document.getElementById('categoryParent').value = category.parent_id || '';
                        document.getElementById('categoryActive').checked = category.is_active;

                        if (category.image) {
                            const preview = document.getElementById('imagePreview');
                            const imageUrl = category.image.startsWith('http') ? category.image : `/storage/${category.image}`;
                            preview.innerHTML = `
                                <img src="${imageUrl}" alt="Preview">
                                <div class="preview-info">
                                    <div>Current Image</div>
                                    <button type="button" onclick="deleteCurrentImage()" style="background: none; border: none; color: var(--accent-red); cursor: pointer; font-size: 12px;">Remove</button>
                                </div>
                            `;
                            preview.classList.add('active');
                        }

                        document.getElementById('categoryModal').classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                });
        }

        function deleteCurrentImage() {
            currentImageDeleted = true;
            document.getElementById('imagePreview').classList.remove('active');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
            document.body.style.overflow = '';
            currentImageDeleted = false;
        }

        function openDeleteModal(id) {
            deleteCategoryId = id;
            document.getElementById('deleteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            deleteCategoryId = null;
            document.getElementById('deleteModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modals when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) closeCategoryModal();
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Close with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCategoryModal();
                closeDeleteModal();
            }
        });

        // File upload preview
        document.getElementById('categoryImage').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <div class="preview-info">
                            <div class="preview-name">${file.name}</div>
                            <div class="preview-size">${(file.size / 1024).toFixed(1)} KB</div>
                        </div>
                    `;
                    preview.classList.add('active');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('categoryId').value;
            const url = id ? `/vendor/categories/${id}` : '/vendor/categories';
            const method = id ? 'PUT' : 'POST';

            // Show loading
            document.getElementById('saveText').style.display = 'none';
            document.getElementById('saveSpinner').style.display = 'inline-block';
            document.getElementById('saveCategoryBtn').disabled = true;

            // Clear errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.remove('active');
                el.textContent = '';
            });

            const formData = new FormData();
            formData.append('name', document.getElementById('categoryName').value);
            formData.append('description', document.getElementById('categoryDescription').value);
            formData.append('parent_id', document.getElementById('categoryParent').value || '');
            formData.append('is_active', document.getElementById('categoryActive').checked ? '1' : '0');

            const imageFile = document.getElementById('categoryImage').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            if (currentImageDeleted) {
                formData.append('delete_image', '1');
            }

            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST', // Use POST with _method override for PUT
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success!', data.message, 'success');
                    closeCategoryModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('Error', data.message || 'Failed to save category', 'error');
                }
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    error.response.json().then(data => {
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(`${field}Error`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                                errorElement.classList.add('active');
                            }
                        });
                    });
                } else {
                    showToast('Error', 'An error occurred', 'error');
                }
            })
            .finally(() => {
                document.getElementById('saveText').style.display = 'inline';
                document.getElementById('saveSpinner').style.display = 'none';
                document.getElementById('saveCategoryBtn').disabled = false;
            });
        });

        // Confirm delete
        function confirmDelete() {
            if (!deleteCategoryId) return;

            fetch(`/vendor/categories/${deleteCategoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Success!', data.message, 'success');
                    closeDeleteModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('Error', data.message || 'Failed to delete category', 'error');
                    closeDeleteModal();
                }
            })
            .catch(error => {
                showToast('Error', 'An error occurred', 'error');
                closeDeleteModal();
            });
        }

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });
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