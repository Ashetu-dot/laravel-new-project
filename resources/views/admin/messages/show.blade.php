<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Details</title>
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
        <h1>Message Details</h1>
        
        <div class="alert">
            <i class="ri-information-line"></i> Message details view is under construction.
        </div>
        
        <p>This page will display individual message details.</p>
        
        <a href="{{ route('admin.messages') }}" class="back-link">← Back to Messages</a>
    </div>
</body>
</html>