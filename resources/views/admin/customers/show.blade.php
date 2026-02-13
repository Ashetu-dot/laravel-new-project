<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding: 40px;
        }
        .container {
            max-width: 800px;
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
        .back-link {
            display: inline-block;
            margin-top: 24px;
            color: #B88E3F;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Details</h1>
        <p><strong>ID:</strong> {{ $customer->id }}</p>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Status:</strong> {{ $customer->is_active ? 'Active' : 'Inactive' }}</p>
        <a href="{{ route('admin.customers') }}" class="back-link">← Back to Customers</a>
    </div>
</body>
</html>