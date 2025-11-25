@extends('admin.layout.layout')

@section('title', 'Update Password - Admin Panel')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    <i class="bi bi-shield-lock"></i> Update Password
                </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">Profile</a></li>
                    <li class="breadcrumb-item active">Update Password</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-key"></i> Change Your Password
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Security Notice -->
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Security Guidelines</h6>
                            <ul class="mb-0">
                                <li>Use a strong password with at least 6 characters</li>
                                <li>Include uppercase letters, numbers, and special characters</li>
                                <li>Do not reuse old passwords</li>
                                <li>You will be logged out after password change for security</li>
                            </ul>
                        </div>

                        <form action="{{ route('admin.password.update') }}" method="POST" id="passwordForm">
                            @csrf

                            <!-- Email Address (Read-only) -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email Address
                                </label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $admin->email) }}"
                                       readonly
                                       style="background-color: #f8f9fa; cursor: not-allowed;">
                                <div class="form-text">
                                    Your registered email address (cannot be changed here)
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">
                                    <i class="bi bi-lock"></i> Current Password
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password"
                                           name="current_password"
                                           placeholder="Enter your current password"
                                           required
                                           autocomplete="current-password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">
                                    <i class="bi bi-key"></i> New Password
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           id="new_password"
                                           name="new_password"
                                           placeholder="Enter your new password"
                                           required
                                           autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    Must be at least 6 characters and different from current password
                                </div>
                                @error('new_password')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">
                                    <i class="bi bi-key-fill"></i> Confirm New Password
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="new_password_confirmation"
                                           name="new_password_confirmation"
                                           placeholder="Confirm your new password"
                                           required
                                           autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password_confirmation">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Strength Meter -->
                            <div class="mb-3">
                                <div class="password-strength-meter">
                                    <div class="strength-labels d-flex justify-content-between mb-1">
                                        <small>Password Strength:</small>
                                        <small id="strength-text">Weak</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div id="password-strength-bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="bi bi-arrow-left"></i> Back to Profile
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="bi bi-check-circle"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>

    .password-strength-meter {
        margin-top: 10px;
    }
    .progress {
        background-color: #e9ecef;
        border-radius: 4px;
    }
    .progress-bar {
        transition: width 0.3s ease, background-color 0.3s ease;
    }
</style>

@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('passwordForm');
        const currentPassword = document.getElementById('current_password');
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('new_password_confirmation');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('strength-text');
        const submitBtn = document.getElementById('submitBtn');

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                targetInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            });
        });

        // Password strength meter
        newPassword.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let text = 'Weak';
            let color = 'bg-danger';

            if (password.length >= 6) strength += 25;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 25;
            if (password.match(/\d/)) strength += 25;
            if (password.match(/[^a-zA-Z\d]/)) strength += 25;

            if (strength >= 75) {
                text = 'Strong';
                color = 'bg-success';
            } else if (strength >= 50) {
                text = 'Medium';
                color = 'bg-warning';
            } else if (strength >= 25) {
                text = 'Fair';
                color = 'bg-info';
            }

            strengthBar.style.width = strength + '%';
            strengthBar.className = 'progress-bar ' + color;
            strengthText.textContent = text;
        });

        // Form validation
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Check if new password and confirmation match
            if (newPassword.value !== confirmPassword.value) {
                isValid = false;
                alert('New password and confirmation do not match.');
            }

            // Check if new password is different from current
            if (newPassword.value === currentPassword.value) {
                isValid = false;
                alert('New password must be different from current password.');
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Show loading state
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm"></i> Updating...';
            submitBtn.disabled = true;
        });

        // Clear validation on input
        [currentPassword, newPassword, confirmPassword].forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                }
            });
        });

        // Auto-focus current password field
        currentPassword.focus();
    });
</script>
@endpush
