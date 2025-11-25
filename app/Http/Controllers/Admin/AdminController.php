<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Services\Admin\AdminService;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\AdminPasswordUpdateRequest;

class AdminController extends Controller
{
    protected $adminService;

    /**
     * Constructor with dependency injection
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = $this->adminService->getDashboardStats();
        $recentActivities = $this->adminService->getRecentActivities();
        $chartData = $this->adminService->getChartData();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'chartData'));
    }

    /**
     * Show admin login form.
     */
    public function create()
    {
        // If already logged in, redirect to dashboard
        if ($this->adminService->isAuthenticated()) {
            return redirect()->route('admin.dashboard');
        }

        // Check for remember me auto-login
        if ($this->adminService->hasValidRememberMe()) {
            $result = $this->adminService->loginWithRememberMe();
            if ($result === 1) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back! Auto-login successful.');
            }
        }

        // Get remembered credentials for pre-filling
        $rememberedCredentials = $this->adminService->getRememberMeCredentials();

        return view('admin.login', [
            'remembered_email' => $rememberedCredentials['email'] ?? '',
            'remember_checked' => !empty($rememberedCredentials)
        ]);
    }

    /**
     * Handle admin login request.
     */
    public function store(AdminLoginRequest $request)
    {
        $validated = $request->validated();

        $result = $this->adminService->login(
            $validated['email'],
            $validated['password'],
            $request->boolean('remember')
        );

        if ($result === 1) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back! Successfully logged in.');
        }

        return back()
            ->withErrors(['password' => 'The provided credentials are incorrect.'])
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Login failed. Please check your credentials.');
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        $result = $this->adminService->logout();

        if ($result === 1) {
            return redirect()->route('admin.login')
                ->with('success', 'You have been successfully logged out.');
        }

        return redirect()->route('admin.login')
            ->with('error', 'Logout failed. Please try again.');
    }

    /**
     * Display a listing of admins.
     */
    public function list(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $admins = $this->adminService->searchAdmins($search);
        } else {
            $admins = $this->adminService->getAllAdmins();
        }

        return view('admin.admins.index', compact('admins', 'search'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function createAdmin()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function storeAdmin(AdminCreateRequest $request)
    {
        // Check if email already exists
        if ($this->adminService->emailExists($request->email)) {
            return back()
                ->withErrors(['email' => 'The email address is already registered.'])
                ->withInput($request->except('password'));
        }

        $adminData = $request->validated();
        $admin = $this->adminService->createAdmin($adminData);

        if ($admin) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin created successfully.');
        }

        return back()
            ->with('error', 'Failed to create admin. Please try again.')
            ->withInput($request->except('password'));
    }

    /**
     * Display the specified admin.
     */
    public function show($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Prevent editing yourself if needed
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return redirect()->route('admin.profile')
                ->with('info', 'Please use the profile page to edit your own account.');
        }

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Check if email already exists (excluding current admin)
        if ($this->adminService->emailExists($request->email, $id)) {
            return back()
                ->withErrors(['email' => 'The email address is already registered.'])
                ->withInput($request->except('password'));
        }

        $updateData = $request->validated();

        // If password is empty, remove it from update data
        if (empty($updateData['password'])) {
            unset($updateData['password']);
        }

        $result = $this->adminService->updateAdmin($id, $updateData);

        if ($result === 1) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin updated successfully.');
        }

        return back()
            ->with('error', 'Failed to update admin. Please try again.')
            ->withInput($request->except('password'));
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy($id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'Admin not found.');
        }

        // Prevent deleting yourself
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return redirect()->route('admin.admins.list')
                ->with('error', 'You cannot delete your own account.');
        }

        $result = $this->adminService->deleteAdmin($id);

        if ($result === 1) {
            return redirect()->route('admin.admins.list')
                ->with('success', 'Admin deleted successfully.');
        }

        return redirect()->route('admin.admins.list')
            ->with('error', 'Failed to delete admin. Please try again.');
    }

    /**
     * Change admin status (active/inactive)
     */
    public function changeStatus($id, Request $request)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found.'
            ], 404);
        }

        // Prevent changing your own status
        $currentAdmin = $this->adminService->getCurrentAdmin();
        if ($currentAdmin && $currentAdmin->id == $admin->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot change your own status.'
            ], 403);
        }

        $status = $request->get('status');
        $result = $this->adminService->changeAdminStatus($id, $status);

        if ($result === 1) {
            return response()->json([
                'success' => true,
                'message' => 'Admin status updated successfully.',
                'new_status' => $status
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update admin status.'
        ], 500);
    }

    /**
     * Show admin profile
     */
    public function profile()
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access your profile.');
        }

        return view('admin.profile', compact('admin'));
    }

    /**
     * Update admin profile
     */
    public function updateProfile(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your profile.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'mobile' => 'nullable|string|max:20',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];

        // Handle password change
        if ($request->filled('new_password')) {
            // Verify current password
            if (!$this->adminService->verifyPassword($admin->id, $request->current_password)) {
                return back()
                    ->withErrors(['current_password' => 'The current password is incorrect.'])
                    ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
            }

            $updateData['password'] = $request->new_password;
        }

        $result = $this->adminService->updateAdmin($admin->id, $updateData);

        if ($result === 1) {
            return back()->with('success', 'Profile updated successfully.');
        }

        return back()
            ->with('error', 'Failed to update profile. Please try again.')
            ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
    }

    /**
     * Show the form for editing admin password.
     */
    public function editPassword()
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your password.');
        }

        return view('admin.password.update_password', compact('admin'));
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(AdminPasswordUpdateRequest $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update your password.');
        }

        // Verify current password
        if (!$this->adminService->verifyPassword($admin->id, $request->current_password)) {
            return back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput($request->only('email'));
        }

        // Update password
        $result = $this->adminService->updatePassword($admin->id, $request->new_password);

        if ($result === 1) {
            // Logout and redirect to login page with success message
            $this->adminService->logout();

            return redirect()->route('admin.login')
                ->with('success', 'Password updated successfully. Please login with your new password.');
        }

        return back()
            ->with('error', 'Failed to update password. Please try again.')
            ->withInput($request->only('email'));
    }

    /**
     * Verify admin (if needed for authentication).
     */
    public function verify(Request $request)
    {
        return view('admin.verify');
    }

    /**
     * Search admins (AJAX endpoint)
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([]);
        }

        $admins = Admin::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->select('id', 'name', 'email')
            ->limit(10)
            ->get();

        return response()->json($admins);
    }

    /**
     * Get admin statistics (AJAX endpoint for dashboard widgets)
     */
    public function getStats()
    {
        $stats = $this->adminService->getDashboardStats();

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Show admin settings page
     */
    public function settings()
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access settings.');
        }

        return view('admin.settings', compact('admin'));
    }

    /**
     * Update admin settings
     */
    public function updateSettings(Request $request)
    {
        $admin = $this->adminService->getCurrentAdmin();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to update settings.');
        }

        $request->validate([
            'theme' => 'nullable|in:light,dark',
            'language' => 'nullable|in:en,es,fr',
            'notifications' => 'nullable|boolean',
        ]);

        // Here you can implement settings update logic
        // For now, we'll just return a success message

        return back()->with('success', 'Settings updated successfully.');
    }
}
