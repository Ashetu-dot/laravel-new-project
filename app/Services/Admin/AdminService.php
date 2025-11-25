<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Vendor; // We'll create this later
use App\Models\Customer; // We'll create this later
use App\Models\Order; // We'll create this later

class AdminService
{
    const REMEMBER_ME_COOKIE = 'admin_remember';
    const REMEMBER_ME_DURATION = 3600; // 1 hour in seconds

    /**
     * Attempt to login admin with email and password
     *
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return int 1 for success, 0 for failure
     */
    public function login(string $email, string $password, bool $remember = false): int
    {
        try {
            // Attempt to authenticate the admin
            if (Auth::guard('admin')->attempt([
                'email' => $email,
                'password' => $password,
                'status' => 'active'
            ], $remember)) {

                // Regenerate session for security
                request()->session()->regenerate();

                // Update last login timestamp
                $admin = Auth::guard('admin')->user();
                if ($admin && method_exists($admin, 'updateLastLogin')) {
                    $admin->updateLastLogin();
                }

                // Handle remember me cookie
                if ($remember) {
                    $this->setRememberMeCookie($email, $password);
                } else {
                    $this->clearRememberMeCookie();
                }

                // Log the successful login
                Log::info('Admin login successful', [
                    'email' => $email,
                    'remember_me' => $remember,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);

                return 1; // Success
            }

            // Log failed login attempt
            Log::warning('Admin login failed', [
                'email' => $email,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            return 0; // Failure

        } catch (\Exception $e) {
            // Log any exceptions during login
            Log::error('Admin login exception', [
                'email' => $email,
                'error' => $e->getMessage(),
                'ip' => request()->ip()
            ]);

            return 0; // Failure
        }
    }

    /**
     * Set remember me cookie with encrypted credentials
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    private function setRememberMeCookie(string $email, string $password): void
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
            'expires' => time() + self::REMEMBER_ME_DURATION
        ];

        $encryptedCredentials = encrypt($credentials);

        Cookie::queue(
            self::REMEMBER_ME_COOKIE,
            $encryptedCredentials,
            self::REMEMBER_ME_DURATION / 60 // Convert to minutes
        );
    }

    /**
     * Clear remember me cookie
     *
     * @return void
     */
    private function clearRememberMeCookie(): void
    {
        Cookie::queue(Cookie::forget(self::REMEMBER_ME_COOKIE));
    }

    /**
     * Get remember me credentials from cookie
     *
     * @return array|null
     */
    public function getRememberMeCredentials(): ?array
    {
        try {
            $cookie = request()->cookie(self::REMEMBER_ME_COOKIE);

            if (!$cookie) {
                return null;
            }

            $credentials = decrypt($cookie);

            // Check if cookie has expired
            if (isset($credentials['expires']) && $credentials['expires'] < time()) {
                $this->clearRememberMeCookie();
                return null;
            }

            return [
                'email' => $credentials['email'] ?? null,
                'password' => $credentials['password'] ?? null
            ];

        } catch (\Exception $e) {
            // If decryption fails, clear the invalid cookie
            $this->clearRememberMeCookie();
            Log::warning('Invalid remember me cookie cleared');
            return null;
        }
    }

    /**
     * Auto-login using remember me cookie
     *
     * @return int 1 for success, 0 for failure
     */
    public function loginWithRememberMe(): int
    {
        try {
            $credentials = $this->getRememberMeCredentials();

            if (!$credentials || !isset($credentials['email']) || !isset($credentials['password'])) {
                return 0;
            }

            // Attempt login with remembered credentials
            return $this->login($credentials['email'], $credentials['password'], true);

        } catch (\Exception $e) {
            Log::error('Remember me auto-login failed', [
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    /**
     * Check if remember me cookie exists and is valid
     *
     * @return bool
     */
    public function hasValidRememberMe(): bool
    {
        $credentials = $this->getRememberMeCredentials();
        return !is_null($credentials);
    }

    /**
     * Logout the current admin
     *
     * @return int 1 for success, 0 for failure
     */
    public function logout(): int
    {
        try {
            // Clear remember me cookie on logout
            $this->clearRememberMeCookie();

            Auth::guard('admin')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            Log::info('Admin logout successful');
            return 1; // Success

        } catch (\Exception $e) {
            Log::error('Admin logout exception', [
                'error' => $e->getMessage()
            ]);

            return 0; // Failure
        }
    }

    /**
     * Get current authenticated admin
     *
     * @return Admin|null
     */
    public function getCurrentAdmin(): ?Admin
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Check if admin is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Create a new admin user
     *
     * @param array $adminData
     * @return Admin|null
     */
    public function createAdmin(array $adminData): ?Admin
    {
        try {
            $adminData['password'] = Hash::make($adminData['password']);

            $admin = Admin::create($adminData);

            Log::info('New admin created', [
                'admin_id' => $admin->id,
                'email' => $admin->email
            ]);

            return $admin;

        } catch (\Exception $e) {
            Log::error('Failed to create admin', [
                'error' => $e->getMessage(),
                'email' => $adminData['email'] ?? 'unknown'
            ]);

            return null;
        }
    }

    /**
     * Update admin profile
     *
     * @param int $adminId
     * @param array $updateData
     * @return int 1 for success, 0 for failure
     */
    public function updateAdmin(int $adminId, array $updateData): int
    {
        try {
            if (isset($updateData['password'])) {
                $updateData['password'] = Hash::make($updateData['password']);
            }

            $result = Admin::where('id', $adminId)->update($updateData);

            if ($result) {
                Log::info('Admin profile updated', ['admin_id' => $adminId]);
                return 1;
            }

            return 0;

        } catch (\Exception $e) {
            Log::error('Failed to update admin', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Get admin by ID
     *
     * @param int $adminId
     * @return Admin|null
     */
    public function getAdminById(int $adminId): ?Admin
    {
        return Admin::find($adminId);
    }

    /**
     * Get all admins with pagination
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllAdmins(int $perPage = 15)
    {
        return Admin::latest()->paginate($perPage);
    }

    /**
     * Change admin status (active/inactive)
     *
     * @param int $adminId
     * @param string $status
     * @return int 1 for success, 0 for failure
     */
    public function changeAdminStatus(int $adminId, string $status): int
    {
        try {
            if (!in_array($status, ['active', 'inactive'])) {
                return 0;
            }

            $result = Admin::where('id', $adminId)->update(['status' => $status]);

            if ($result) {
                Log::info('Admin status changed', [
                    'admin_id' => $adminId,
                    'status' => $status
                ]);
                return 1;
            }

            return 0;

        } catch (\Exception $e) {
            Log::error('Failed to change admin status', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Delete admin (soft delete if implemented)
     *
     * @param int $adminId
     * @return int 1 for success, 0 for failure
     */
    public function deleteAdmin(int $adminId): int
    {
        try {
            $admin = Admin::find($adminId);

            if (!$admin) {
                return 0;
            }

            // Prevent deleting yourself
            if ($admin->id === Auth::guard('admin')->id()) {
                return 0;
            }

            $admin->delete();

            Log::info('Admin deleted', ['admin_id' => $adminId]);
            return 1;

        } catch (\Exception $e) {
            Log::error('Failed to delete admin', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Get admin statistics for dashboard
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        try {
            // Basic stats that will work immediately
            $stats = [
                'total_admins' => Admin::where('status', 'active')->count(),
                'total_vendors' => 0,
                'total_customers' => 0,
                'pending_vendors' => 0,
                'total_orders' => 0,
                'revenue' => 0,
                'today_orders' => 0,
                'weekly_revenue' => 0,
            ];

            // Try to get vendor stats if Vendor model exists
            if (class_exists('App\Models\Vendor')) {
                $stats['total_vendors'] = \App\Models\Vendor::count();
                $stats['pending_vendors'] = \App\Models\Vendor::where('status', 'pending')->count();
            }

            // Try to get customer stats if Customer model exists
            if (class_exists('App\Models\Customer')) {
                $stats['total_customers'] = \App\Models\Customer::count();
            }

            // Try to get order stats if Order model exists
            if (class_exists('App\Models\Order')) {
                $stats['total_orders'] = \App\Models\Order::count();
                $stats['today_orders'] = \App\Models\Order::whereDate('created_at', today())->count();

                // Calculate weekly revenue
                $weeklyRevenue = \App\Models\Order::where('created_at', '>=', now()->subWeek())
                    ->where('status', 'completed')
                    ->sum('total_amount');
                $stats['weekly_revenue'] = $weeklyRevenue ?? 0;
            }

            // Calculate total revenue if available
            if (class_exists('App\Models\Transaction')) {
                $stats['revenue'] = \App\Models\Transaction::where('status', 'completed')->sum('amount');
            }

            return $stats;

        } catch (\Exception $e) {
            Log::error('Error fetching dashboard stats', [
                'error' => $e->getMessage()
            ]);

            // Return safe default stats
            return [
                'total_admins' => Admin::where('status', 'active')->count(),
                'total_vendors' => 0,
                'total_customers' => 0,
                'pending_vendors' => 0,
                'total_orders' => 0,
                'revenue' => 0,
                'today_orders' => 0,
                'weekly_revenue' => 0,
            ];
        }
    }

    /**
     * Get recent activities for dashboard
     *
     * @return array
     */
    public function getRecentActivities(): array
    {
        try {
            $activities = [];

            // Recent admin logins
            $recentLogins = Admin::where('last_login_at', '>=', now()->subDays(7))
                ->orderBy('last_login_at', 'desc')
                ->take(5)
                ->get();

            foreach ($recentLogins as $admin) {
                $activities[] = [
                    'type' => 'admin_login',
                    'message' => "{$admin->name} logged in",
                    'time' => $admin->last_login_at,
                    'icon' => 'bi-person-circle'
                ];
            }

            // You can add more activity types here as you develop the application
            // - New vendor registrations
            // - New orders
            // - System events, etc.

            return $activities;

        } catch (\Exception $e) {
            Log::error('Error fetching recent activities', [
                'error' => $e->getMessage()
            ]);

            return [];
        }
    }

    /**
     * Get chart data for dashboard
     *
     * @return array
     */
    public function getChartData(): array
    {
        // Default chart data - you can enhance this later
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'revenue' => [0, 0, 0, 0, 0, 0],
            'orders' => [0, 0, 0, 0, 0, 0],
            'vendors' => [0, 0, 0, 0, 0, 0],
        ];
    }

    /**
     * Search admins by name or email
     *
     * @param string $searchTerm
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchAdmins(string $searchTerm, int $perPage = 15)
    {
        return Admin::where('name', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get admin by email
     *
     * @param string $email
     * @return Admin|null
     */
    public function getAdminByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }

    /**
     * Verify admin password
     *
     * @param int $adminId
     * @param string $password
     * @return bool
     */
    public function verifyPassword(int $adminId, string $password): bool
    {
        $admin = Admin::find($adminId);

        if (!$admin) {
            return false;
        }

        return Hash::check($password, $admin->password);
    }

    /**
     * Update admin password
     *
     * @param int $adminId
     * @param string $newPassword
     * @return int 1 for success, 0 for failure
     */
    public function updatePassword(int $adminId, string $newPassword): int
    {
        try {
            $hashedPassword = Hash::make($newPassword);

            $result = Admin::where('id', $adminId)->update([
                'password' => $hashedPassword
            ]);

            if ($result) {
                Log::info('Admin password updated', ['admin_id' => $adminId]);
                return 1;
            }

            return 0;

        } catch (\Exception $e) {
            Log::error('Failed to update admin password', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Check if email already exists
     *
     * @param string $email
     * @param int|null $excludeAdminId
     * @return bool
     */
    public function emailExists(string $email, ?int $excludeAdminId = null): bool
    {
        $query = Admin::where('email', $email);

        if ($excludeAdminId) {
            $query->where('id', '!=', $excludeAdminId);
        }

        return $query->exists();
    }
}
