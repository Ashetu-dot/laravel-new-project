<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

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
            // Check if admin exists in admins table
            $admin = Admin::where('email', $email)
                        ->where('status', true)
                        ->first();

            if (!$admin) {
                Log::warning('Admin login failed - admin not found', [
                    'email' => $email,
                    'ip' => request()->ip()
                ]);
                return 0;
            }

            // Use the admin guard for authentication
            if (Auth::guard('admin')->attempt([
                'email' => $email,
                'password' => $password
            ], $remember)) {

                // Regenerate session for security
                request()->session()->regenerate();

                // Update last login timestamp
                $admin->last_login_at = now();
                $admin->save();

                // Handle remember me cookie
                if ($remember) {
                    $this->setRememberMeCookie($email, $password);
                } else {
                    $this->clearRememberMeCookie();
                }

                // Log the successful login
                Log::info('Admin login successful', [
                    'email' => $email,
                    'admin_id' => $admin->id,
                    'remember_me' => $remember,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);

                return 1; // Success
            }

            // Log failed login attempt
            Log::warning('Admin login failed - invalid password', [
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
            $adminData['status'] = $adminData['status'] ?? true;

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
            $admin = Admin::find($adminId);

            if (!$admin) {
                return 0;
            }

            if (isset($updateData['password'])) {
                $updateData['password'] = Hash::make($updateData['password']);
            }

            // Remove role from update data if present (prevents changing role)
            unset($updateData['role']);

            $result = $admin->update($updateData);

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
     * @param bool $status
     * @return int 1 for success, 0 for failure
     */
    public function changeAdminStatus(int $adminId, bool $status): int
    {
        try {
            $admin = Admin::find($adminId);

            if (!$admin) {
                return 0;
            }

            $admin->status = $status;
            $admin->save();

            Log::info('Admin status changed', [
                'admin_id' => $adminId,
                'status' => $status ? 'active' : 'inactive'
            ]);

            return 1;

        } catch (\Exception $e) {
            Log::error('Failed to change admin status', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Delete admin
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
            $currentAdmin = $this->getCurrentAdmin();
            if ($currentAdmin && $currentAdmin->id === $adminId) {
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
            $stats = [
                'total_admins' => Admin::count(),
                'active_admins' => Admin::where('status', true)->count(),
                'total_vendors' => 0, // These will need to be implemented
                'active_vendors' => 0,
                'pending_vendors' => 0,
                'total_customers' => 0,
                'active_customers' => 0,
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'total_revenue' => Order::where('status', 'completed')->sum('total_amount') ?? 0,
                'today_orders' => Order::whereDate('created_at', today())->count(),
                'today_revenue' => Order::whereDate('created_at', today())->where('status', 'completed')->sum('total_amount') ?? 0,
                'total_products' => Product::count(),
                'out_of_stock' => Product::where('stock', '<=', 0)->count(),
                'total_categories' => Category::count(),
            ];

            // Calculate weekly revenue
            $stats['weekly_revenue'] = Order::where('created_at', '>=', now()->subWeek())
                ->where('status', 'completed')
                ->sum('total_amount') ?? 0;

            return $stats;

        } catch (\Exception $e) {
            Log::error('Error fetching dashboard stats', [
                'error' => $e->getMessage()
            ]);

            return [
                'total_admins' => Admin::count(),
                'active_admins' => Admin::where('status', true)->count(),
                'total_vendors' => 0,
                'active_vendors' => 0,
                'pending_vendors' => 0,
                'total_customers' => 0,
                'active_customers' => 0,
                'total_orders' => 0,
                'pending_orders' => 0,
                'completed_orders' => 0,
                'total_revenue' => 0,
                'today_orders' => 0,
                'today_revenue' => 0,
                'total_products' => 0,
                'out_of_stock' => 0,
                'total_categories' => 0,
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
            $recentLogins = Admin::whereNotNull('last_login_at')
                ->orderBy('last_login_at', 'desc')
                ->take(5)
                ->get();

            foreach ($recentLogins as $admin) {
                $activities[] = [
                    'type' => 'admin_login',
                    'message' => "{$admin->name} logged in",
                    'time' => $admin->last_login_at,
                    'icon' => 'ri-user-settings-line'
                ];
            }

            // Recent orders
            $recentOrders = Order::latest()
                ->take(5)
                ->get();

            foreach ($recentOrders as $order) {
                $activities[] = [
                    'type' => 'new_order',
                    'message' => "New order #{$order->order_number} placed",
                    'time' => $order->created_at,
                    'icon' => 'ri-shopping-cart-line'
                ];
            }

            // Sort by time descending
            usort($activities, function($a, $b) {
                return strtotime($b['time']) - strtotime($a['time']);
            });

            return array_slice($activities, 0, 10);

        } catch (\Exception $e) {
            Log::error('Error fetching recent activities', [
                'error' => $e->getMessage()
            ]);

            return [];
        }
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
            $admin = Admin::find($adminId);

            if (!$admin) {
                return 0;
            }

            $admin->password = Hash::make($newPassword);
            $admin->save();

            Log::info('Admin password updated', ['admin_id' => $adminId]);
            return 1;

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