<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        h1 {
            margin-bottom: 24px;
            color: #111827;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        button {
            background-color: #B88E3F;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 12px;
        }
        button:hover {
            background-color: #9c7832;
        }
        .back-link {
            color: #6b7280;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Vendor</h1>
        <form method="POST" action="{{ route('admin.vendors.update', $vendor->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Business Name</label>
                <input type="text" name="business_name" value="{{ $vendor->business_name ?? $vendor->name }}" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $vendor->email }}" required>
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $vendor->phone }}">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option value="">Select Category</option>
                    <option value="fashion" {{ ($vendor->category ?? '') == 'fashion' ? 'selected' : '' }}>Fashion & Apparel</option>
                    <option value="home" {{ ($vendor->category ?? '') == 'home' ? 'selected' : '' }}>Home & Living</option>
                    <option value="electronics" {{ ($vendor->category ?? '') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                    <option value="art" {{ ($vendor->category ?? '') == 'art' ? 'selected' : '' }}>Art & Collectibles</option>
                    <option value="food" {{ ($vendor->category ?? '') == 'food' ? 'selected' : '' }}>Food & Beverages</option>
                    <option value="beauty" {{ ($vendor->category ?? '') == 'beauty' ? 'selected' : '' }}>Beauty & Personal Care</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ $vendor->description }}</textarea>
            </div>
            
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" value="{{ $vendor->city }}">
            </div>
            
            <div class="form-group">
                <label>State</label>
                <input type="text" name="state" value="{{ $vendor->state }}">
            </div>
            
            <div class="form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1" {{ $vendor->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$vendor->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <button type="submit">Update Vendor</button>
            <a href="{{ route('admin.vendors') }}" class="back-link">Cancel</a>
        </form>
    </div>
</body>
</html>