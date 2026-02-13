<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Local Vendor Finder</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .register-body {
            padding: 2rem;
        }
        .btn-register {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #218838 0%, #1e9e8a 100%);
        }
        .error-message {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .password-strength {
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            margin-top: 5px;
        }
        .password-strength-bar {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            text-align: center;
            flex: 1;
            position: relative;
        }
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            border: 3px solid #e9ecef;
        }
        .step.active .step-number {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }
        .step.completed .step-number {
            background: #20c997;
            color: white;
            border-color: #20c997;
        }
        .step-title {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .step.active .step-title {
            color: #28a745;
            font-weight: bold;
        }
        .step-line {
            position: absolute;
            top: 20px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e9ecef;
            z-index: -1;
        }
        .btn-next, .btn-prev {
            padding: 10px 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-card">
                    <!-- Registration Header -->
                    <div class="register-header">
                        <h2><i class="bi bi-person-plus"></i> Admin Registration</h2>
                        <p class="mb-0">Create your Local Vendor Finder System Account</p>
                    </div>

                    <!-- Registration Body -->
                    <div class="register-body">
                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle"></i> Please fix the following errors:
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-title">Personal Info</div>
                                <div class="step-line"></div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-title">Account Setup</div>
                                <div class="step-line"></div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-title">Complete</div>
                                <div class="step-line"></div>
                            </div>
                        </div>

                        <form action="{{ route('admin.register.submit') }}" method="POST" id="registerForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Step 1: Personal Information -->
                            <div class="form-step active" data-step="1">
                                <h4 class="mb-4"><i class="bi bi-person-vcard"></i> Personal Information</h4>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">
                                            <i class="bi bi-person"></i> First Name *
                                        </label>
                                        <input type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               id="first_name"
                                               name="first_name"
                                               value="{{ old('first_name') }}"
                                               placeholder="Enter first name"
                                               required>
                                        @error('first_name')
                                            <div class="invalid-feedback d-block error-message">
                                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">
                                            <i class="bi bi-person"></i> Last Name *
                                        </label>
                                        <input type="text"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               id="last_name"
                                               name="last_name"
                                               value="{{ old('last_name') }}"
                                               placeholder="Enter last name"
                                               required>
                                        @error('last_name')
                                            <div class="invalid-feedback d-block error-message">
                                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="bi bi-telephone"></i> Phone Number *
                                    </label>
                                    <input type="tel"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="+1 (555) 123-4567"
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback d-block error-message">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="profile_image" class="form-label">
                                        <i class="bi bi-image"></i> Profile Image (Optional)
                                    </label>
                                    <input type="file"
                                           class="form-control @error('profile_image') is-invalid @enderror"
                                           id="profile_image"
                                           name="profile_image"
                                           accept="image/*">
                                    <small class="text-muted">Max file size: 2MB. Allowed: JPG, PNG, GIF</small>
                                    @error('profile_image')
                                        <div class="invalid-feedback d-block error-message">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                    <div id="imagePreview" class="mt-2"></div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div>
                                        <a href="{{ route('admin.login') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left"></i> Back to Login
                                        </a>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-next">
                                        Next <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Account Setup -->
                            <div class="form-step" data-step="2">
                                <h4 class="mb-4"><i class="bi bi-shield-lock"></i> Account Setup</h4>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> Email Address *
                                    </label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter your email"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback d-block error-message">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock"></i> Password *
                                        </label>
                                        <div class="input-group">
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   placeholder="Create password"
                                                   required>
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength mt-2">
                                            <div class="password-strength-bar" id="passwordStrength"></div>
                                        </div>
                                        <small class="text-muted">
                                            Password must be at least 8 characters with uppercase, lowercase, number & special character
                                        </small>
                                        @error('password')
                                            <div class="invalid-feedback d-block error-message">
                                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="bi bi-lock-fill"></i> Confirm Password *
                                        </label>
                                        <div class="input-group">
                                            <input type="password"
                                                   class="form-control"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="Confirm password"
                                                   required>
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div id="passwordMatch" class="mt-2"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">
                                        <i class="bi bi-person-badge"></i> Admin Role *
                                    </label>
                                    <select class="form-select @error('role') is-invalid @enderror"
                                            id="role"
                                            name="role"
                                            required>
                                        <option value="">Select Role</option>
                                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                        <option value="viewer" {{ old('role') == 'viewer' ? 'selected' : '' }}>Viewer</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback d-block error-message">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror"
                                               type="checkbox"
                                               id="terms"
                                               name="terms"
                                               {{ old('terms') ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a> *
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback d-block error-message">
                                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-prev">
                                        <i class="bi bi-arrow-left"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next">
                                        Next <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Review & Complete -->
                            <div class="form-step" data-step="3">
                                <h4 class="mb-4"><i class="bi bi-check-circle"></i> Review & Complete</h4>

                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-person"></i> Personal Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Name:</strong> <span id="reviewName"></span></p>
                                                <p><strong>Phone:</strong> <span id="reviewPhone"></span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Email:</strong> <span id="reviewEmail"></span></p>
                                                <p><strong>Role:</strong> <span id="reviewRole"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Important:</strong> Your account will be pending approval by a Super Admin. You'll receive an email once approved.
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="finalConfirmation"
                                           required>
                                    <label class="form-check-label" for="finalConfirmation">
                                        I confirm that all information provided is accurate and I agree to the terms
                                    </label>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-prev">
                                        <i class="bi bi-arrow-left"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success btn-register" id="submitBtn">
                                        <i class="bi bi-person-plus"></i> Create Account
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Already have account -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Already have an account?
                                <a href="{{ route('admin.login') }}" class="text-decoration-none fw-bold">
                                    <i class="bi bi-box-arrow-in-right"></i> Login here
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms of Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Terms and conditions content here...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Privacy policy content here...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Multi-step form functionality
            const formSteps = document.querySelectorAll('.form-step');
            const steps = document.querySelectorAll('.step');
            const nextButtons = document.querySelectorAll('.btn-next');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const profileImageInput = document.getElementById('profile_image');
            const imagePreview = document.getElementById('imagePreview');
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');
            const finalConfirmation = document.getElementById('finalConfirmation');

            let currentStep = 1;

            // Function to update steps
            function updateSteps() {
                // Update form steps visibility
                formSteps.forEach(step => {
                    step.classList.remove('active');
                    if (parseInt(step.dataset.step) === currentStep) {
                        step.classList.add('active');
                    }
                });

                // Update step indicators
                steps.forEach(step => {
                    const stepNum = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNum === currentStep) {
                        step.classList.add('active');
                    } else if (stepNum < currentStep) {
                        step.classList.add('completed');
                    }
                });
            }

            // Next button click handler
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Validate current step before proceeding
                    if (validateStep(currentStep)) {
                        if (currentStep < 3) {
                            currentStep++;
                            updateSteps();
                        }

                        // Update review section in step 3
                        if (currentStep === 3) {
                            updateReviewSection();
                        }
                    }
                });
            });

            // Previous button click handler
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        updateSteps();
                    }
                });
            });

            // Validate each step
            function validateStep(step) {
                let isValid = true;
                const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);

                // Get all required inputs in current step
                const requiredInputs = currentStepElement.querySelectorAll('[required]');

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                        if (!input.nextElementSibling?.classList?.contains('error-message')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback d-block error-message';
                            errorDiv.innerHTML = `<i class="bi bi-exclamation-circle"></i> This field is required`;
                            input.parentNode.appendChild(errorDiv);
                        }
                    } else {
                        input.classList.remove('is-invalid');
                        const errorDiv = input.parentNode.querySelector('.error-message');
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                    }
                });

                // Special validations for step 2
                if (step === 2) {
                    // Password strength validation
                    if (passwordInput.value) {
                        const strength = checkPasswordStrength(passwordInput.value);
                        if (strength.score < 2) {
                            isValid = false;
                            showPasswordError('Password is too weak. Please use a stronger password.');
                        }
                    }

                    // Password match validation
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        isValid = false;
                        showPasswordMatchError('Passwords do not match');
                    }

                    // Terms checkbox validation
                    const termsCheckbox = document.getElementById('terms');
                    if (!termsCheckbox.checked) {
                        isValid = false;
                        termsCheckbox.classList.add('is-invalid');
                    }
                }

                return isValid;
            }

            // Password strength checker
            function checkPasswordStrength(password) {
                let score = 0;
                const feedback = [];

                // Length check
                if (password.length >= 8) score++;
                else feedback.push('At least 8 characters');

                // Lowercase check
                if (/[a-z]/.test(password)) score++;
                else feedback.push('One lowercase letter');

                // Uppercase check
                if (/[A-Z]/.test(password)) score++;
                else feedback.push('One uppercase letter');

                // Number check
                if (/[0-9]/.test(password)) score++;
                else feedback.push('One number');

                // Special character check
                if (/[^A-Za-z0-9]/.test(password)) score++;
                else feedback.push('One special character');

                // Update strength bar
                const strengthBar = document.getElementById('passwordStrength');
                const colors = ['#dc3545', '#ffc107', '#17a2b8', '#28a745'];
                const widths = ['20%', '40%', '60%', '80%', '100%'];

                strengthBar.style.width = widths[score] || '0%';
                strengthBar.style.backgroundColor = colors[score - 1] || '#dc3545';

                return { score, feedback };
            }

            // Show password error
            function showPasswordError(message) {
                let errorDiv = passwordInput.parentNode.querySelector('.error-message');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-block error-message';
                    passwordInput.parentNode.appendChild(errorDiv);
                }
                errorDiv.innerHTML = `<i class="bi bi-exclamation-circle"></i> ${message}`;
                passwordInput.classList.add('is-invalid');
            }

            // Show password match error
            function showPasswordMatchError(message) {
                const matchDiv = document.getElementById('passwordMatch');
                matchDiv.innerHTML = `<div class="text-danger small"><i class="bi bi-x-circle"></i> ${message}</div>`;
                confirmPasswordInput.classList.add('is-invalid');
            }

            // Update review section
            function updateReviewSection() {
                document.getElementById('reviewName').textContent =
                    `${document.getElementById('first_name').value} ${document.getElementById('last_name').value}`;
                document.getElementById('reviewPhone').textContent = document.getElementById('phone').value;
                document.getElementById('reviewEmail').textContent = document.getElementById('email').value;
                document.getElementById('reviewRole').textContent =
                    document.getElementById('role').options[document.getElementById('role').selectedIndex].text;
            }

            // Password toggle functionality
            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('input');
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                });
            });

            // Image preview
            if (profileImageInput) {
                profileImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) { // 2MB limit
                            alert('File size must be less than 2MB');
                            this.value = '';
                            imagePreview.innerHTML = '';
                            return;
                        }

                        if (!file.type.match('image.*')) {
                            alert('Please select an image file');
                            this.value = '';
                            imagePreview.innerHTML = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = `
                                <div class="d-flex align-items-center">
                                    <img src="${e.target.result}"
                                         class="img-thumbnail me-3"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                    <div>
                                        <p class="mb-1"><strong>${file.name}</strong></p>
                                        <p class="text-muted mb-0">${(file.size / 1024).toFixed(1)} KB</p>
                                    </div>
                                </div>
                            `;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Real-time password strength check
            passwordInput.addEventListener('input', function() {
                if (this.value) {
                    checkPasswordStrength(this.value);
                } else {
                    document.getElementById('passwordStrength').style.width = '0%';
                }
            });

            // Real-time password match check
            confirmPasswordInput.addEventListener('input', function() {
                const matchDiv = document.getElementById('passwordMatch');
                if (passwordInput.value && this.value) {
                    if (passwordInput.value === this.value) {
                        matchDiv.innerHTML = '<div class="text-success small"><i class="bi bi-check-circle"></i> Passwords match</div>';
                        this.classList.remove('is-invalid');
                    } else {
                        matchDiv.innerHTML = '<div class="text-danger small"><i class="bi bi-x-circle"></i> Passwords do not match</div>';
                        this.classList.add('is-invalid');
                    }
                } else {
                    matchDiv.innerHTML = '';
                    this.classList.remove('is-invalid');
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                if (!finalConfirmation.checked) {
                    e.preventDefault();
                    alert('Please confirm that all information is accurate before submitting.');
                    return;
                }

                // Disable submit button and show loading
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm"></i> Creating Account...';
                submitBtn.disabled = true;

                // All validations passed
                return true;
            });

            // Clear validation on input
            const inputs = document.querySelectorAll('input, select');
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
        });
    </script>
</body>
</html>
