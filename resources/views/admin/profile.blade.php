@extends('admin.layout.layout')

@section('title', 'My Profile - Admin Panel')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    <i class="bi bi-person-circle"></i> My Profile
                </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
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

        <div class="row">
            <!-- Profile Information Column -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-badge"></i> Profile Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $admin->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $admin->email) }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Mobile -->
                                <div class="col-md-6 mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           id="mobile"
                                           name="mobile"
                                           value="{{ old('mobile', $admin->mobile) }}">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text"
                                           class="form-control bg-light"
                                           id="role"
                                           value="{{ ucfirst(str_replace('_', ' ', $admin->role)) }}"
                                           readonly>
                                    <div class="form-text">Your role cannot be changed from here</div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text"
                                           class="form-control bg-light"
                                           id="status"
                                           value="{{ ucfirst($admin->status) }}"
                                           readonly>
                                    <div class="form-text">Account status</div>
                                </div>

                                <!-- Last Login -->
                                <div class="col-md-6 mb-3">
                                    <label for="last_login" class="form-label">Last Login</label>
                                    <input type="text"
                                           class="form-control bg-light"
                                           id="last_login"
                                           value="{{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}"
                                           readonly>
                                </div>
                            </div>

                            <!-- Member Since -->
                            <div class="mb-3">
                                <label for="created_at" class="form-label">Member Since</label>
                                <input type="text"
                                       class="form-control bg-light"
                                       id="created_at"
                                       value="{{ $admin->created_at->format('F j, Y') }}"
                                       readonly>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Change Section -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-shield-lock"></i> Change Password
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf

                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password"
                                           name="current_password"
                                           placeholder="Enter current password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- New Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control @error('new_password') is-invalid @enderror"
                                               id="new_password"
                                               name="new_password"
                                               placeholder="Enter new password">
                                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control"
                                               id="new_password_confirmation"
                                               name="new_password_confirmation"
                                               placeholder="Confirm new password">
                                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password_confirmation">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Requirements -->
                            <div class="alert alert-info">
                                <h6><i class="bi bi-info-circle"></i> Password Requirements</h6>
                                <ul class="mb-0">
                                    <li>Minimum 6 characters</li>
                                    <li>Include uppercase and lowercase letters</li>
                                    <li>Include numbers and special characters for better security</li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-key"></i> Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <!-- Profile Summary Card -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person"></i> Profile Summary
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <!-- Profile Image -->
                        <div class="mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=007bff&color=fff&size=120"
                                 class="rounded-circle shadow"
                                 alt="Profile Image"
                                 width="120"
                                 height="120">
                        </div>

                        <h5>{{ $admin->name }}</h5>
                        <p class="text-muted">{{ $admin->email }}</p>

                        <div class="d-grid gap-2">
                            <span class="badge bg-{{ $admin->status === 'active' ? 'success' : 'secondary' }} mb-2">
                                {{ ucfirst($admin->status) }}
                            </span>
                            <span class="badge bg-info">
                                {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Security Card -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Security</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Keep your account secure by regularly updating your password.</p>
                        <div class="d-grid">
                            <button type="button" class="btn btn-warning" onclick="scrollToPassword()">
                                <i class="bi bi-shield-lock"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.settings') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                            <a href="{{ route('admin.admins.list') }}" class="btn btn-outline-info">
                                <i class="bi bi-people"></i> Manage Admins
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Account Status Card -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Account Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $admin->status === 'active' ? 'success' : 'secondary' }} float-end">
                                {{ ucfirst($admin->status) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Role:</strong>
                            <span class="float-end">{{ ucfirst(str_replace('_', ' ', $admin->role)) }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Last Login:</strong>
                            <span class="float-end">
                                {{ $admin->last_login_at ? $admin->last_login_at->diffForHumans() : 'Never' }}
                            </span>
                        </div>
                        <div>
                            <strong>Member Since:</strong>
                            <span class="float-end">{{ $admin->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Form submission loading state
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm"></i> Processing...';
                    submitBtn.disabled = true;
                }
            });
        });

        // Clear validation errors on input
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    const feedback = this.parentElement.querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.remove();
                    }
                }
            });
        });
    });

    function scrollToPassword() {
        document.querySelector('.card-header:has(.bi-shield-lock)').scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>

<style>
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

.form-control.bg-light {
    background-color: #f8f9fa !important;
}

.small-box {
    border-radius: 0.375rem;
    position: relative;
    overflow: hidden;
}

.small-box .inner h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
}

.small-box .icon {
    position: absolute;
    top: -10px;
    right: 10px;
    z-index: 0;
    font-size: 70px;
    opacity: 0.3;
    transition: all 0.3s;
}

.small-box:hover .icon {
    font-size: 75px;
    opacity: 0.4;
}

.input-group .btn-outline-secondary {
    border-left: 0;
}
</style>
@endpush
