<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Vendora</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F7F7F7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        }
        .header {
            background: linear-gradient(135deg, #B88E3F 0%, #d4af66 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 40px 30px;
        }
        .button {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(135deg, #B88E3F 0%, #ca9e4b 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3);
        }
        .footer {
            background-color: #F5F5F5;
            padding: 30px;
            text-align: center;
            color: #777777;
            font-size: 14px;
        }
        .ethiopia-badge {
            display: inline-block;
            padding: 4px 12px;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Vendora</h1>
            <div class="ethiopia-badge">
                <i class="ri-map-pin-line"></i> Jimma, Ethiopia
            </div>
        </div>
        
        <div class="content">
            <h2 style="color: #333; margin-bottom: 20px;">Verify Your Email Address</h2>
            
            <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                Hello {{ $user->name }},
            </p>
            
            <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                Thank you for registering with Vendora! Please click the button below to verify your email address and activate your account.
            </p>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="button">
                    Verify Email Address
                </a>
            </div>
            
            <p style="color: #666; line-height: 1.6; margin-top: 30px; font-size: 14px;">
                If you did not create an account, no further action is required.
            </p>
            
            <p style="color: #999; font-size: 12px; margin-top: 20px;">
                This verification link will expire in 60 minutes.
            </p>
            
            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
            
            <p style="color: #999; font-size: 12px;">
                If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
                <br>
                <a href="{{ $verificationUrl }}" style="color: #B88E3F; word-break: break-all;">
                    {{ $verificationUrl }}
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Vendora. All rights reserved. Jimma, Ethiopia</p>
            <p style="margin-top: 10px;">
                <a href="{{ route('privacy-policy') }}" style="color: #B88E3F; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
                |
                <a href="{{ route('terms-of-service') }}" style="color: #B88E3F; text-decoration: none; margin: 0 10px;">Terms of Service</a>
                |
                <a href="{{ route('contact') }}" style="color: #B88E3F; text-decoration: none; margin: 0 10px;">Contact Us</a>
            </p>
        </div>
    </div>
</body>
</html>