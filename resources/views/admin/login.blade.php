<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Local Vendor Finder</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .login-body {
            padding: 2rem;
        }
        .btn-login {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        }
        .error-message {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .remember-me-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <!-- Login Header -->
                    <div class="login-header">
                        <h2><i class="bi bi-shield-lock"></i> Admin Login</h2>
                        <p class="mb-0">Local Vendor Finder System</p>
                    </div>

                    <!-- Login Form -->
                    <div class="login-body">
                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- General Error Message -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Auto-login Notification -->
                        @if(session('auto_login'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="bi bi-info-circle"></i> {{ session('auto_login') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST" id="loginForm">
                            @csrf

                            <!-- Remember Me Info -->
                            @if(!empty($remembered_email))
                                <div class="remember-me-section">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="useRemembered" checked>
                                        <label class="form-check-label" for="useRemembered">
                                            <i class="bi bi-clock-history"></i> Use remembered credentials
                                        </label>
                                    </div>
                                    <small class="text-muted">Credentials are stored securely for 1 hour</small>
                                </div>
                            @endif

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email Address
                                </label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $remembered_email ?? '') }}"
                                       placeholder="Enter your email"
                                       required
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback d-block error-message">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Enter your password"
                                           required
                                           autocomplete="current-password">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block error-message">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="remember"
                                           name="remember"
                                           {{ old('remember', $remember_checked ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        <i class="bi bi-check-square"></i> Remember me for 1 hour
                                    </label>
                                </div>
                                <a href="#" class="text-decoration-none">Forgot password?</a>
                            </div>

                            <!-- Security Notice -->
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <small>
                                    <i class="bi bi-shield-exclamation"></i>
                                    <strong>Security Notice:</strong> Only check "Remember me" on trusted devices.
                                </small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-login btn-lg text-white">
                                    <i class="bi bi-box-arrow-in-right"></i> Login to Dashboard
                                </button>
                            </div>
                        </form>

                        <!-- Additional Info -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                <i class="bi bi-info-circle"></i>
                                Access restricted to authorized administrators only.
                            </p>
                        </div>

                        <!-- Demo Credentials (Remove in production) -->
                        <div class="mt-3 p-3 bg-light rounded">
                            <small class="text-muted">
                                <strong>Demo Credentials:</strong><br>
                                Email: admin@localvendorfinder.com<br>
                                Password: admin123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember');
            const useRememberedCheckbox = document.getElementById('useRemembered');
            const togglePasswordBtn = document.getElementById('togglePassword');

            // Toggle password visibility
            if (togglePasswordBtn) {
                togglePasswordBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                });
            }

            // Handle use remembered credentials toggle
            if (useRememberedCheckbox) {
                useRememberedCheckbox.addEventListener('change', function() {
                    if (!this.checked) {
                        emailInput.value = '';
                        passwordInput.value = '';
                        rememberCheckbox.checked = false;
                    }
                });
            }

            // Form submission handler
            form.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                button.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm"></i> Logging in...';
                button.disabled = true;
            });

            // Clear validation on input
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const errorElement = this.parentNode.querySelector('.error-message');
                        if (errorElement) {
                            errorElement.remove();
                        }
                    }
                });
            });

            // Auto-focus password if email is pre-filled
            if (emailInput.value && !passwordInput.value) {
                passwordInput.focus();
            }
        });
    </script>
</body>
</html>
