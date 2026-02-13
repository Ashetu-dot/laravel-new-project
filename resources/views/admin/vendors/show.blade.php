<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Details</title>
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
        .detail-row {
            display: flex;
            margin-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
        }
        .detail-label {
            width: 140px;
            font-weight: 600;
            color: #6b7280;
        }
        .detail-value {
            flex: 1;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        .status-active { background-color: #d1fae5; color: #065f46; }
        .status-inactive { background-color: #fee2e2; color: #991b1b; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vendor Details</h1>
        
        <div class="detail-row">
            <div class="detail-label">Business Name</div>
            <div class="detail-value">{{ $vendor->business_name ?? $vendor->name }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $vendor->email }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Phone</div>
            <div class="detail-value">{{ $vendor->phone ?? 'N/A' }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Category</div>
            <div class="detail-value">{{ $vendor->category ?? 'N/A' }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Address</div>
            <div class="detail-value">
                @if($vendor->address_line1)
                    {{ $vendor->address_line1 }}<br>
                    @if($vendor->address_line2){{ $vendor->address_line2 }}<br>@endif
                    {{ $vendor->city }}, {{ $vendor->state }} {{ $vendor->zip_code }}
                @else
                    N/A
                @endif
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Website</div>
            <div class="detail-value">
                @if($vendor->website)
                    <a href="{{ $vendor->website }}" target="_blank">{{ $vendor->website }}</a>
                @else
                    N/A
                @endif
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Description</div>
            <div class="detail-value">{{ $vendor->description ?? 'No description' }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="status-badge status-{{ $vendor->is_active ? 'active' : 'inactive' }}">
                    {{ $vendor->is_active ? 'Active' : 'Inactive' }}
                </span>
                @if($vendor->email_verified_at)
                    <span class="status-badge status-verified" style="background-color: #dbeafe; color: #1e40af; margin-left: 8px;">
                        Verified
                    </span>
                @else
                    <span class="status-badge status-pending" style="margin-left: 8px;">
                        Pending Verification
                    </span>
                @endif
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Joined</div>
            <div class="detail-value">
                @if($vendor->created_at)
                    {{ $vendor->created_at->format('F d, Y h:i A') }}
                @else
                    N/A
                @endif
            </div>
        </div>
        
        <a href="{{ route('admin.vendors') }}" class="back-link">← Back to Vendors</a>
    </div>
</body>
</html>