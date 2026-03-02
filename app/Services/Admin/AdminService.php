<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminService
{
    const REMEMBER_ME_COOKIE = 'admin_remember';
    const REMEMBER_ME_DURATION = 3600; // 1 hour in seconds

    /**
     * ========================================================================
     * AUTHENTICATION METHODS
     * ========================================================================
     */

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
            // Check if user exists with role = 'admin' and is active
            $admin = User::where('email', $email)
                        ->where('role', 'admin')
                        ->where('is_active', true)
                        ->first();

            if (!$admin) {
                Log::warning('Admin login failed - admin not found or inactive', [
                    'email' => $email,
                    'ip' => request()->ip()
                ]);
                return 0;
            }

            // Use the default auth guard with role condition
            if (Auth::attempt([
                'email' => $email,
                'password' => $password
            ], $remember)) {

                // Verify the authenticated user is actually an admin
                if (Auth::user()->role !== 'admin') {
                    Auth::logout();
                    return 0;
                }

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
                    'name' => $admin->name,
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
        try {
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

            Log::info('Remember me cookie set', ['email' => $email]);

        } catch (\Exception $e) {
            Log::error('Failed to set remember me cookie', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Clear remember me cookie
     *
     * @return void
     */
    private function clearRememberMeCookie(): void
    {
        try {
            Cookie::queue(Cookie::forget(self::REMEMBER_ME_COOKIE));
            Log::info('Remember me cookie cleared');

        } catch (\Exception $e) {
            Log::error('Failed to clear remember me cookie', [
                'error' => $e->getMessage()
            ]);
        }
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

            $user = Auth::user();
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            Log::info('Admin logout successful', [
                'admin_id' => $user->id ?? null,
                'email' => $user->email ?? null
            ]);

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
     * @return User|null
     */
    public function getCurrentAdmin(): ?User
    {
        $user = Auth::user();
        
        if ($user && $user->role === 'admin') {
            return $user;
        }
        
        return null;
    }

    /**
     * Check if admin is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * ========================================================================
     * ADMIN MANAGEMENT METHODS
     * ========================================================================
     */

    /**
     * Create a new admin user
     *
     * @param array $adminData
     * @return User|null
     */
    public function createAdmin(array $adminData): ?User
    {
        try {
            $adminData['password'] = Hash::make($adminData['password']);
            $adminData['role'] = 'admin';
            $adminData['is_active'] = $adminData['is_active'] ?? true;
            $adminData['email_verified_at'] = now();
            $adminData['country'] = $adminData['country'] ?? 'Ethiopia';
            $adminData['theme_preference'] = $adminData['theme_preference'] ?? 'light';

            $admin = User::create($adminData);

            Log::info('New admin created', [
                'admin_id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email
            ]);

            return $admin;

        } catch (\Exception $e) {
            Log::error('Failed to create admin', [
                'error' => $e->getMessage(),
                'email' => $adminData['email'] ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }

    /**
     * Get all admins with pagination
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllAdmins(int $perPage = 15): LengthAwarePaginator
    {
        return User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get admin by ID
     *
     * @param int $adminId
     * @return User|null
     */
    public function getAdminById(int $adminId): ?User
    {
        return User::where('role', 'admin')->find($adminId);
    }

    /**
     * Get admin by email
     *
     * @param string $email
     * @return User|null
     */
    public function getAdminByEmail(string $email): ?User
    {
        return User::where('role', 'admin')->where('email', $email)->first();
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
            $admin = User::where('role', 'admin')->find($adminId);

            if (!$admin) {
                Log::warning('Admin not found for update', ['admin_id' => $adminId]);
                return 0;
            }

            // Hash password if present
            if (isset($updateData['password']) && !empty($updateData['password'])) {
                $updateData['password'] = Hash::make($updateData['password']);
            } else {
                unset($updateData['password']);
            }

            // Prevent changing role to non-admin
            if (isset($updateData['role']) && $updateData['role'] !== 'admin') {
                unset($updateData['role']);
            }

            $result = $admin->update($updateData);

            if ($result) {
                Log::info('Admin profile updated', [
                    'admin_id' => $adminId,
                    'updated_fields' => array_keys($updateData)
                ]);
                return 1;
            }

            return 0;

        } catch (\Exception $e) {
            Log::error('Failed to update admin', [
                'admin_id' => $adminId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return 0;
        }
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
            $admin = User::where('role', 'admin')->find($adminId);

            if (!$admin) {
                Log::warning('Admin not found for status change', ['admin_id' => $adminId]);
                return 0;
            }

            $admin->is_active = $status;
            $admin->save();

            Log::info('Admin status changed', [
                'admin_id' => $adminId,
                'name' => $admin->name,
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
            $admin = User::where('role', 'admin')->find($adminId);

            if (!$admin) {
                Log::warning('Admin not found for deletion', ['admin_id' => $adminId]);
                return 0;
            }

            // Prevent deleting yourself
            $currentAdmin = $this->getCurrentAdmin();
            if ($currentAdmin && $currentAdmin->id === $adminId) {
                Log::warning('Admin attempted to delete own account', [
                    'admin_id' => $adminId
                ]);
                return 0;
            }

            $admin->delete();

            Log::info('Admin deleted successfully', [
                'admin_id' => $adminId,
                'name' => $admin->name,
                'email' => $admin->email,
                'deleted_by' => $currentAdmin->id ?? null
            ]);

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
     * Search admins by name or email
     *
     * @param string $searchTerm
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchAdmins(string $searchTerm, int $perPage = 15): LengthAwarePaginator
    {
        return User::where('role', 'admin')
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('phone', 'like', "%{$searchTerm}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get admin statistics
     *
     * @return array
     */
    public function getAdminStats(): array
    {
        try {
            return [
                'total' => User::where('role', 'admin')->count(),
                'active' => User::where('role', 'admin')->where('is_active', true)->count(),
                'inactive' => User::where('role', 'admin')->where('is_active', false)->count(),
                'new_this_month' => User::where('role', 'admin')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'verified' => User::where('role', 'admin')
                    ->whereNotNull('email_verified_at')
                    ->count(),
                'unverified' => User::where('role', 'admin')
                    ->whereNull('email_verified_at')
                    ->count(),
            ];

        } catch (\Exception $e) {
            Log::error('Error fetching admin stats', [
                'error' => $e->getMessage()
            ]);

            return [
                'total' => 0,
                'active' => 0,
                'inactive' => 0,
                'new_this_month' => 0,
                'verified' => 0,
                'unverified' => 0,
            ];
        }
    }

    /**
     * ========================================================================
     * DASHBOARD STATISTICS METHODS
     * ========================================================================
     */

    /**
     * Get dashboard statistics
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        try {
            $stats = [
                // Admin stats
                'total_admins' => User::where('role', 'admin')->count(),
                'active_admins' => User::where('role', 'admin')->where('is_active', true)->count(),
                
                // Vendor stats
                'total_vendors' => User::where('role', 'vendor')->count(),
                'active_vendors' => User::where('role', 'vendor')->where('is_active', true)->count(),
                'pending_vendors' => User::where('role', 'vendor')->where('is_active', false)->count(),
                'verified_vendors' => User::where('role', 'vendor')->whereNotNull('email_verified_at')->count(),
                
                // Customer stats
                'total_customers' => User::where('role', 'customer')->count(),
                'active_customers' => User::where('role', 'customer')->where('is_active', true)->count(),
                
                // Order stats
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'processing_orders' => Order::where('status', 'processing')->count(),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'cancelled_orders' => Order::where('status', 'cancelled')->count(),
                
                // Revenue stats
                'total_revenue' => Order::where('status', 'completed')->sum('total_amount') ?? 0,
                'today_revenue' => Order::whereDate('created_at', today())
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0,
                'weekly_revenue' => Order::where('created_at', '>=', now()->subWeek())
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0,
                'monthly_revenue' => Order::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0,
                
                // Order counts by time
                'today_orders' => Order::whereDate('created_at', today())->count(),
                'weekly_orders' => Order::where('created_at', '>=', now()->subWeek())->count(),
                'monthly_orders' => Order::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                
                // Product stats
                'total_products' => Product::count(),
                'active_products' => Product::where('is_active', true)->count(),
                'out_of_stock' => Product::where('stock', '<=', 0)->count(),
                'low_stock' => Product::where('stock', '>', 0)->where('stock', '<', 10)->count(),
                
                // Category stats
                'total_categories' => Category::count(),
                
                // Notification stats
                'total_notifications' => Notification::count(),
                'unread_notifications' => Notification::where('is_read', false)->count(),
                
                // Message stats
                'total_messages' => Message::count(),
                'unread_messages' => Message::where('is_read', false)->count(),
            ];

            // Calculate revenue growth percentages
            $lastMonthRevenue = Order::whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->subMonth()->year)
                ->where('status', 'completed')
                ->sum('total_amount') ?? 0;
                
            $stats['revenue_growth'] = $lastMonthRevenue > 0 
                ? round((($stats['monthly_revenue'] - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
                : 100;

            return $stats;

        } catch (\Exception $e) {
            Log::error('Error fetching dashboard stats', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'total_admins' => 0,
                'active_admins' => 0,
                'total_vendors' => 0,
                'active_vendors' => 0,
                'pending_vendors' => 0,
                'verified_vendors' => 0,
                'total_customers' => 0,
                'active_customers' => 0,
                'total_orders' => 0,
                'pending_orders' => 0,
                'processing_orders' => 0,
                'completed_orders' => 0,
                'cancelled_orders' => 0,
                'total_revenue' => 0,
                'today_revenue' => 0,
                'weekly_revenue' => 0,
                'monthly_revenue' => 0,
                'today_orders' => 0,
                'weekly_orders' => 0,
                'monthly_orders' => 0,
                'total_products' => 0,
                'active_products' => 0,
                'out_of_stock' => 0,
                'low_stock' => 0,
                'total_categories' => 0,
                'total_notifications' => 0,
                'unread_notifications' => 0,
                'total_messages' => 0,
                'unread_messages' => 0,
                'revenue_growth' => 0,
            ];
        }
    }

    /**
     * Get recent activities for dashboard
     *
     * @param int $limit
     * @return array
     */
    public function getRecentActivities(int $limit = 10): array
    {
        try {
            $activities = [];

            // Recent admin logins
            $recentLogins = User::where('role', 'admin')
                ->whereNotNull('last_login_at')
                ->orderBy('last_login_at', 'desc')
                ->take(5)
                ->get();

            foreach ($recentLogins as $admin) {
                $activities[] = [
                    'type' => 'admin_login',
                    'message' => "Admin {$admin->name} logged in",
                    'time' => $admin->last_login_at,
                    'time_human' => $admin->last_login_at->diffForHumans(),
                    'icon' => 'ri-user-settings-line',
                    'color' => 'blue'
                ];
            }

            // Recent orders
            $recentOrders = Order::with('user')
                ->latest()
                ->take(5)
                ->get();

            foreach ($recentOrders as $order) {
                $customerName = isset($order->user) ? $order->user->name : 'Customer';
                $activities[] = [
                    'type' => 'new_order',
                    'message' => "New order #{$order->order_number} placed by {$customerName}",
                    'time' => $order->created_at,
                    'time_human' => $order->created_at->diffForHumans(),
                    'amount' => $order->total_amount,
                    'icon' => 'ri-shopping-cart-line',
                    'color' => 'green'
                ];
            }

            // Recent users (vendors/customers)
            $recentUsers = User::whereIn('role', ['vendor', 'customer'])
                ->latest()
                ->take(5)
                ->get();

            foreach ($recentUsers as $user) {
                $activities[] = [
                    'type' => 'new_user',
                    'message' => "New {$user->role} registered: {$user->name}",
                    'time' => $user->created_at,
                    'time_human' => $user->created_at->diffForHumans(),
                    'icon' => $user->role === 'vendor' ? 'ri-store-line' : 'ri-user-line',
                    'color' => $user->role === 'vendor' ? 'gold' : 'purple'
                ];
            }

            // Recent products
            $recentProducts = Product::with('vendor')
                ->latest()
                ->take(5)
                ->get();

            foreach ($recentProducts as $product) {
                $vendorName = 'Vendor';
                if ($product->vendor) {
                    $vendorName = $product->vendor->business_name ?? $product->vendor->name ?? 'Vendor';
                }
                
                $activities[] = [
                    'type' => 'new_product',
                    'message' => "New product added: {$product->name} by {$vendorName}",
                    'time' => $product->created_at,
                    'time_human' => $product->created_at->diffForHumans(),
                    'icon' => 'ri-product-hunt-line',
                    'color' => 'yellow'
                ];
            }

            // Sort by time descending
            usort($activities, function($a, $b) {
                return strtotime($b['time']) - strtotime($a['time']);
            });

            return array_slice($activities, 0, $limit);

        } catch (\Exception $e) {
            Log::error('Error fetching recent activities', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }

    /**
     * ========================================================================
     * UTILITY METHODS
     * ========================================================================
     */

    /**
     * Verify admin password
     *
     * @param int $adminId
     * @param string $password
     * @return bool
     */
    public function verifyPassword(int $adminId, string $password): bool
    {
        try {
            $admin = User::where('role', 'admin')->find($adminId);

            if (!$admin) {
                return false;
            }

            return Hash::check($password, $admin->password);

        } catch (\Exception $e) {
            Log::error('Password verification error', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return false;
        }
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
            $admin = User::where('role', 'admin')->find($adminId);

            if (!$admin) {
                Log::warning('Admin not found for password update', ['admin_id' => $adminId]);
                return 0;
            }

            $admin->password = Hash::make($newPassword);
            $admin->save();

            Log::info('Admin password updated', [
                'admin_id' => $adminId,
                'name' => $admin->name
            ]);

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
        try {
            $query = User::where('email', $email);

            if ($excludeAdminId) {
                $query->where('id', '!=', $excludeAdminId);
            }

            return $query->exists();

        } catch (\Exception $e) {
            Log::error('Email existence check error', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Get notification counts for admin
     *
     * @param int $adminId
     * @return array
     */
    public function getNotificationCounts(int $adminId): array
    {
        try {
            return [
                'unread_notifications' => Notification::where('user_id', $adminId)
                    ->where('is_read', false)
                    ->count(),
                'unread_messages' => Message::where('receiver_id', $adminId)
                    ->where('is_read', false)
                    ->count(),
                'total_notifications' => Notification::where('user_id', $adminId)->count(),
                'total_messages' => Message::where('receiver_id', $adminId)->count(),
            ];

        } catch (\Exception $e) {
            Log::error('Error fetching notification counts', [
                'admin_id' => $adminId,
                'error' => $e->getMessage()
            ]);

            return [
                'unread_notifications' => 0,
                'unread_messages' => 0,
                'total_notifications' => 0,
                'total_messages' => 0,
            ];
        }
    }
}