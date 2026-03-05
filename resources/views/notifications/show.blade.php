{{-- Simple notification detail page used by NotificationController::show --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background:#f3f4f6;
            color:#111827;
            padding:40px;
        }
        .container {
            max-width:600px;
            margin:0 auto;
            background:#fff;
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
            padding:24px;
        }
        .header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:16px;
        }
        .header h1 {
            font-size:20px;
            margin:0;
        }
        .btn-back {
            text-decoration:none;
            color:#3b82f6;
            font-weight:600;
        }
        .content p {
            margin-bottom:12px;
        }
        .meta {
            font-size:12px;
            color:#6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notification</h1>
            <a href="{{ url()->previous() }}" class="btn-back"><i class="ri-arrow-left-line"></i> Back</a>
        </div>
        <div class="content">
            <p><strong>Title:</strong> {{ $notification->title }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $notification->message }}</p>
        </div>
        <div class="meta">
            <p>Type: {{ $notification->type }}</p>
            <p>Sent: {{ $notification->created_at->diffForHumans() }}</p>
        </div>
    </div>
</body>
</html>
