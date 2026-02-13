<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendora - Verify Email</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        /* Copy the same styles from your registration page */
        :root {
            --primary-color: #B88E3F;
            --primary-hover: #9c7832;
            --text-dark: #333333;
            --text-light: #777777;
            --bg-body: #F7F7F7;
            --bg-card: #FFFFFF;
            --border-color: #E0E0E0;
            --error-color: #D32F2F;
            --success-color: #388E3C;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: var(--bg-card);
            padding: 24px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .logo {
            font-size: 28px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .verify-card {
            background: var(--bg-card);
            width: 100%;
            max-width: 500px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 48px;
            text-align: center;
        }

        .verify-icon {
            font-size: 64px;
            color: var(--primary-color);
            margin-bottom: 24px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        p {
            color: var(--text-light);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .btn {
            padding: 14px 32px;
            border-radius: var(--radius-sm);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background-color: var(--primary-color);
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3);
        }

        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background-color: #E8F5E9;
            color: var(--success-color);
            border: 1px solid #A5D6A5;
        }

        @media (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .verify-card { padding: 32px 24px; }
            h1 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill"></i>
            Vendora
        </a>
    </nav>

    <main class="main-container">
        <div class="verify-card">
            <i class="ri-mail-check-line verify-icon"></i>
            
            <h1>Verify Your Email Address</h1>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            <p>
                Thanks for signing up! Before getting started, could you verify your email address by clicking the link we just emailed to you? If you didn't receive the email, we'll gladly send you another.
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn">
                    <i class="ri-mail-send-line"></i>
                    Resend Verification Email
                </button>
            </form>
            
            <p style="margin-top: 24px; font-size: 14px;">
                <a href="{{ route('home') }}" style="color: var(--primary-color); text-decoration: none;">
                    <i class="ri-arrow-left-line"></i> Back to Home
                </a>
            </p>
        </div>
    </main>
</body>
</html>