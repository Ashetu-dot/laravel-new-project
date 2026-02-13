<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding: 40px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
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
        .alert {
            padding: 16px;
            background-color: #fef3c7;
            color: #92400e;
            border-radius: 8px;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Documentation</h1>

        <div class="alert">
            <i class="ri-information-line"></i> This page is under construction. Full documentation is coming soon.
        </div>

        <h2>Getting Started</h2>
        <p>Welcome to the Vendora admin documentation. Here you'll find guides on how to manage your marketplace effectively.</p>

        <h3 style="margin-top: 24px;">Available Topics</h3>
        <ul style="margin-top: 12px; margin-left: 20px;">
            <li>Managing Orders</li>
            <li>Customer Management</li>
            <li>Vendor Verification</li>
            <li>Catalog Management</li>
            <li>Creating Promotions</li>
            <li>Admin Settings</li>
        </ul>

        <a href="{{ route('admin.help') }}" class="back-link">← Back to Help Center</a>
    </div>
</body>
</html>
