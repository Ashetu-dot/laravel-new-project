<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Admin</title>
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
            font-family: 'Inter', sans-serif;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background-color: #B88E3F;
            color: white;
        }
        .btn-primary:hover {
            background-color: #9c7832;
        }
        .btn-secondary {
            background-color: transparent;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }
        .back-link {
            color: #6b7280;
            text-decoration: none;
            margin-left: 12px;
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
        <h1>Create New Admin</h1>

        <div class="alert">
            <i class="ri-information-line"></i> This page is under construction. Admin creation features are coming soon.
        </div>

        <p>You can create new system administrators from this page.</p>

        <div style="margin-top: 32px;">
            <a href="{{ route('admin.admins.list') }}" class="btn btn-primary">
                <i class="ri-arrow-left-line"></i> Back to Admins
            </a>
        </div>
    </div>
</body>
</html>
