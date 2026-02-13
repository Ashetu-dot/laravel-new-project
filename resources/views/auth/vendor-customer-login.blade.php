<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Vendora Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        /* Copy all your EXISTING <style> block here – exactly as you have it */
        /* (I've omitted the CSS here for brevity, but you must keep your full, beautiful responsive CSS) */
        @font-face {
            font-family: 'Inter';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Regular.otf');
        }
        @font-face {
            font-family: 'Inter-Bold';
            src: url('https://assets-persist.lovart.ai/agent-static-assets/NotoSansHans-Bold.otf');
        }
        :root {
            --primary-gold: #B88E3F;
            --primary-gold-hover: #a07a32;
            --bg-color: #F7F7F7;
            --text-dark: #333333;
            --text-gray: #777777;
            --white: #ffffff;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.05);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            width: 100%; max-width: 1920px; margin: 0 auto; min-height: 100vh; display: flex; flex-direction: column;
        }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 24px 60px; background-color: var(--white); box-shadow: 0 2px 10px rgba(0,0,0,0.02); position: sticky; top: 0; z-index: 100; }
        .logo { font-family: 'Inter-Bold', sans-serif; font-size: 28px; color: var(--text-dark); text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .logo-icon { color: var(--primary-gold); font-size: 32px; }
        .menu-btn { background: none; border: none; cursor: pointer; font-size: 24px; color: var(--text-dark); padding: 8px; border-radius: 50%; transition: background 0.3s; }
        .menu-btn:hover { background-color: rgba(0,0,0,0.05); }
        .main-container { flex: 1; display: flex; justify-content: center; align-items: center; padding: 60px 20px; background-image: radial-gradient(circle at 10% 20%, rgba(184, 142, 63, 0.05) 0%, rgba(247, 247, 247, 0) 40%); }
        .login-card { background: var(--white); width: 100%; max-width: 520px; padding: 60px; border-radius: 24px; box-shadow: var(--card-shadow); position: relative; overflow: hidden; }
        .login-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--primary-gold), #d4af66); }
        .card-header { text-align: center; margin-bottom: 40px; }
        .card-header h1 { font-family: 'Inter-Bold', sans-serif; font-size: 32px; margin-bottom: 12px; color: var(--text-dark); }
        .card-header p { color: var(--text-gray); font-size: 16px; line-height: 1.5; }
        .form-group { margin-bottom: 24px; }
        .form-label { display: block; margin-bottom: 8px; font-family: 'Inter-Bold', sans-serif; font-size: 14px; color: var(--text-dark); }
        .input-wrapper { position: relative; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #999; font-size: 20px; }
        .toggle-password { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer; font-size: 20px; }
        .form-control { width: 100%; padding: 16px 48px 16px 50px; font-size: 16px; border: 1px solid #E0E0E0; border-radius: 12px; background-color: #FAFAFA; color: var(--text-dark); font-family: 'Inter', sans-serif; transition: all 0.3s ease; }
        .form-control:focus { outline: none; border-color: var(--primary-gold); background-color: var(--white); box-shadow: 0 0 0 4px rgba(184, 142, 63, 0.1); }
        .form-control::placeholder { color: #BBBBBB; }
        .form-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; font-size: 14px; }
        .checkbox-wrapper { display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--text-gray); user-select: none; }
        .custom-checkbox { width: 20px; height: 20px; border: 2px solid #D1D1D1; border-radius: 6px; display: flex; align-items: center; justify-content: center; transition: all 0.2s; position: relative; }
        input[type="checkbox"] { display: none; }
        input[type="checkbox"]:checked + .custom-checkbox { background-color: var(--primary-gold); border-color: var(--primary-gold); }
        input[type="checkbox"]:checked + .custom-checkbox::after { content: "\EB7B"; font-family: 'remixicon'; color: white; font-size: 14px; }
        .forgot-link { color: var(--text-gray); text-decoration: none; transition: color 0.2s; }
        .forgot-link:hover { color: var(--primary-gold); text-decoration: underline; }
        .btn-submit { width: 100%; padding: 16px; background: linear-gradient(135deg, var(--primary-gold) 0%, #ca9e4b 100%); color: var(--white); border: none; border-radius: 12px; font-size: 18px; font-family: 'Inter-Bold', sans-serif; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 4px 15px rgba(184, 142, 63, 0.3); }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(184, 142, 63, 0.4); }
        .btn-submit:active { transform: translateY(0); }
        .signup-prompt { text-align: center; margin-top: 24px; color: var(--text-gray); font-size: 15px; }
        .signup-link { color: var(--primary-gold); font-family: 'Inter-Bold', sans-serif; text-decoration: none; margin-left: 4px; }
        .signup-link:hover { text-decoration: underline; }
        .footer-minimal { text-align: center; padding: 30px; color: #999; font-size: 12px; }
        /* Your full responsive media queries go here – keep them exactly as you wrote */
        @media screen and (max-width: 1280px) { .navbar { padding: 24px 40px; } .login-card { max-width: 500px; padding: 50px; } }
        @media screen and (max-width: 1024px) { .navbar { padding: 20px 32px; } .logo { font-size: 26px; } .logo-icon { font-size: 30px; } .login-card { max-width: 480px; padding: 48px; } .card-header h1 { font-size: 30px; } }
        @media screen and (max-width: 900px) { .navbar { padding: 18px 28px; } .login-card { padding: 40px; } .form-control { padding: 14px 44px 14px 46px; } }
        @media screen and (max-width: 768px) { .navbar { padding: 16px 24px; } .logo { font-size: 24px; gap: 6px; } .logo-icon { font-size: 28px; } .main-container { padding: 40px 20px; } .login-card { padding: 40px 32px; border-radius: 20px; max-width: 460px; } .card-header h1 { font-size: 28px; } .card-header p { font-size: 15px; } .form-control { font-size: 15px; } .btn-submit { font-size: 17px; padding: 15px; } }
        @media screen and (max-width: 640px) { .navbar { padding: 14px 20px; } .logo { font-size: 22px; } .logo-icon { font-size: 26px; } .menu-btn { font-size: 22px; padding: 6px; } .main-container { padding: 30px 16px; } .login-card { padding: 32px 24px; border-radius: 20px; } .card-header h1 { font-size: 26px; } .card-header p { font-size: 14px; } .form-label { font-size: 13px; } .form-control { padding: 14px 40px 14px 44px; font-size: 14px; } .input-icon { font-size: 18px; left: 14px; } .toggle-password { font-size: 18px; right: 14px; } .form-actions { flex-direction: column; align-items: flex-start; gap: 12px; margin-bottom: 28px; } .checkbox-wrapper { font-size: 14px; } .forgot-link { font-size: 14px; } .btn-submit { padding: 14px; font-size: 16px; border-radius: 10px; } .signup-prompt { font-size: 14px; margin-top: 20px; } .footer-minimal { padding: 24px 20px; font-size: 11px; } }
        @media screen and (max-width: 480px) { .navbar { padding: 12px 16px; } .logo { font-size: 20px; gap: 4px; } .logo-icon { font-size: 24px; } .menu-btn { font-size: 20px; padding: 4px; } .main-container { padding: 24px 12px; } .login-card { padding: 28px 20px; border-radius: 18px; box-shadow: 0 8px 30px rgba(0,0,0,0.05); } .login-card::before { height: 5px; } .card-header { margin-bottom: 30px; } .card-header h1 { font-size: 24px; } .card-header p { font-size: 13px; } .form-group { margin-bottom: 20px; } .form-label { font-size: 12px; margin-bottom: 6px; } .form-control { padding: 12px 36px 12px 42px; font-size: 14px; border-radius: 10px; } .input-icon { font-size: 16px; left: 12px; } .toggle-password { font-size: 16px; right: 12px; } .custom-checkbox { width: 18px; height: 18px; } input[type="checkbox"]:checked + .custom-checkbox::after { font-size: 12px; } .btn-submit { padding: 13px; font-size: 15px; border-radius: 10px; box-shadow: 0 4px 12px rgba(184, 142, 63, 0.3); } .signup-prompt { font-size: 13px; margin-top: 18px; display: flex; flex-wrap: wrap; justify-content: center; } .footer-minimal { padding: 20px 16px; font-size: 10px; } }
        @media screen and (max-width: 360px) { .navbar { padding: 10px 12px; } .logo { font-size: 18px; } .logo-icon { font-size: 22px; } .login-card { padding: 24px 16px; } .card-header h1 { font-size: 22px; } .card-header p { font-size: 12px; } .form-control { padding: 10px 32px 10px 38px; font-size: 13px; } .btn-submit { padding: 12px; font-size: 14px; } .footer-minimal { padding: 16px 12px; font-size: 9px; } }
        .menu-btn:focus-visible, .btn-submit:focus-visible, .form-control:focus-visible { outline: 2px solid var(--primary-gold); outline-offset: 2px; }
        .toggle-password { transition: color 0.2s; }
        .toggle-password:hover { color: var(--primary-gold); }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="ri-store-3-fill logo-icon"></i>
            Vendora
        </a>
        <button class="menu-btn" aria-label="Menu">
            <i class="ri-menu-line"></i>
        </button>
    </nav>

    <div class="main-container">
        <div class="login-card">
            <div class="card-header">
                <h1>Welcome Back</h1>
                <p>Please enter your details to sign in.</p>
            </div>

            {{-- Laravel form with CSRF and correct action --}}
            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <div style="color: #dc3545; font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="ri-lock-2-line input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        <i class="ri-eye-off-line toggle-password" onclick="togglePasswordVisibility(this)"></i>
                    </div>
                    @error('password')
                        <div style="color: #dc3545; font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="custom-checkbox"></span>
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>

                <div class="signup-prompt">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="signup-link">Sign up</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="footer-minimal">
        &copy; 2024 Vendora Inc. All rights reserved. • <a href="#" style="color: #999; text-decoration: none;">Privacy Policy</a> • <a href="#" style="color: #999; text-decoration: none;">Terms of Service</a>
    </div>

    <script>
        // Simple password toggle function
        function togglePasswordVisibility(element) {
            const input = element.previousElementSibling; // the input field
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
    </script>
</body>
</html>