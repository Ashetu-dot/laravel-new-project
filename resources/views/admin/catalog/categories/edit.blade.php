<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Vendora Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #1f2937;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 32px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #B88E3F;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(184, 142, 63, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        .required {
            color: #ef4444;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #B88E3F;
            box-shadow: 0 0 0 3px rgba(184, 142, 63, 0.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #B88E3F, #9c7832);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .form-text {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="{{ route('admin.catalog.categories') }}" class="back-btn">
                <i class="ri-arrow-left-line"></i> Back to Categories
            </a>
            <h1>Edit Category</h1>
        </div>

        @if($errors->any())
        <div class="alert alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top: 8px; margin-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <form action="{{ route('admin.catalog.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Category Name <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $category->slug) }}">
                    <small class="form-text">Leave empty for auto-generation from name</small>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Icon Class</label>
                    <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="e.g., ri-shopping-bag-line">
                    <small class="form-text">RemixIcon class name (optional)</small>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label for="is_active" style="margin: 0;">Active Category</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line"></i> Update Category
                    </button>
                    <a href="{{ route('admin.catalog.categories') }}" class="btn btn-secondary">
                        <i class="ri-close-line"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
