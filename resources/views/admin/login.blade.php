<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Vendora - Admin Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf') format('opentype');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Medium.otf') format('opentype');
            font-weight: 500;
        }
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf') format('opentype');
            font-weight: 700;
        }

        :root {
            --primary-gold: #B88E3F;
            --primary-gold-hover: #9c7832;
            --bg-color: #F7F7F7;
            --text-dark: #333333;
            --text-gray: #777777;
            --white: #ffffff;
            --error-color: #D32F2F;
            --success-color: #388E3C;
            --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            --border-color: #E0E0E0;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.05) 0%, rgba(247, 247, 247, 0) 40%);
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-family: 'Inter-Bold', sans-serif;
            font-size: 28px;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }
        
        .logo-icon {
            color: var(--primary-gold);
            font-size: 32px;
        }

        .back-link {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary-gold);
        }

        /* Main Content */
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .login-card {
            background: var(--white);
            width: 100%;
            max-width: 440px;
            padding: 48px;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }
        
        /* Decorative element */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-gold), #d4af66);
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .card-header h1 {
            font-size: 28px;
            margin-bottom: 12px;
            color: var(--text-dark);
            font-weight: 700;
        }

        .card-header p {
            color: var(--text-gray);
            font-size: 15px;
            line-height: 1.5;
        }

        /* Alert Messages */
        .alert {
            padding: 14px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #E8F5E9;
            color: var(--success-color);
            border: 1px solid #A5D6A5;
        }

        .alert-error {
            background-color: #FFEBEE;
            color: var(--error-color);
            border: 1px solid #FFCDD2;
        }

        /* Form */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 20px;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            font-size: 20px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--primary-gold);
        }

        .form-control {
            width: 100%;
            padding: 14px 48px 14px 50px;
            font-size: 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background-color: #FAFAFA;
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1);
        }
        
        .form-control.error {
            border-color: var(--error-color);
        }

        .error-message {
            font-size: 12px;
            color: var(--error-color);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            font-size: 14px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-gray);
            user-select: none;
        }
        
        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #D1D1D1;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            position: relative;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]:checked + .custom-checkbox {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }
        
        input[type="checkbox"]:checked + .custom-checkbox::after {
            content: "\EB7B";
            font-family: 'remixicon';
            color: white;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, #ca9e4b 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-sm);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 142, 63, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-links {
            text-align: center;
            margin-top: 24px;
            color: var(--text-gray);
            font-size: 13px;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 16px 24px; }
            .logo { font-size: 24px; }
            .logo-icon { font-size: 28px; }
            .login-card { padding: 32px 24px; }
            .card-header h1 { font-size: 26px; }
        }

        @media (max-width: 480px) {
            .navbar { padding: 12px 16px; }
            .logo { font-size: 22px; }
            .logo-icon { font-size: 26px; }
            .login-card { padding: 28px 20px; }
            .card-header h1 { font-size: 24px; }
            .form-control { padding: 12px 44px 12px 46px; }
        }

        /* Decorative shapes */
        .decorative-shape {
            position: fixed;
            z-index: -1;
            opacity: 0.3;
        }

        .shape-1 {
            top: 100px;
            right: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.15) 0%, rgba(255,255,255,0) 70%);
        }

        .shape-2 {
            bottom: 50px;
            left: -50px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,142,63,0.1) 0%, rgba(255,255,255,0) 70%);
        }
    </style>
</head>
<body>

    <!-- Background Decoration -->
    <div class="decorative-shape shape-1"></div>
    <div class="decorative-shape shape-2"></div>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill logo-icon"></i>
            Vendora
        </a>
        <a href="{{ route('home') }}" class="back-link">
            <i class="ri-arrow-left-line"></i> Back to Home
        </a>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="login-card">
            <div class="card-header">
                <h1>Admin Login</h1>
                <p>Sign in to access the admin dashboard</p>
            </div>

            <!-- Session Status Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ri-checkbox-circle-line"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="ri-error-warning-line"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control @error('email') error @enderror" placeholder="admin@vendora.com" value="{{ old('email', $remembered_email ?? '') }}" required autofocus>
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-2-line input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control @error('password') error @enderror" placeholder="••••••••" required>
                        <i class="ri-eye-off-line toggle-password" onclick="togglePasswordVisibility(this)"></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="ri-error-warning-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember" {{ $remember_checked ? 'checked' : '' }}>
                        <span class="custom-checkbox"></span>
                        Remember me
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="ri-login-box-line"></i>
                    Sign In
                </button>

                <div class="footer-links">
                    <a href="{{ route('home') }}">Return to Website</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility(element) {
            const input = element.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                element.classList.remove('ri-eye-off-line');
                element.classList.add('ri-eye-line');
            } else {
                input.type = 'password';
                element.classList.remove('ri-eye-line');
                element.classList.add('ri-eye-off-line');
            }
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>

</body>
</html>