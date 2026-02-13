<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
        input, select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
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
        .back-link {
            color: #6b7280;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Customer</h1>
        <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $customer->name }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $customer->phone }}">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1" {{ $customer->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$customer->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit">Update Customer</button>
            <a href="{{ route('admin.customers') }}" class="back-link">Cancel</a>
        </form>
    </div>
</body>
</html>