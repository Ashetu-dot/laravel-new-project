<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Always authenticate purely by email & password.
        // The user's role is determined from the database after successful login.
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Update last login
            $user = Auth::user();
            $user->last_login_at = now();
            $user->save();

            // Redirect based on role
            return $this->authenticated($request, $user);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle authenticated user
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'vendor') {
            if (!$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Your vendor account is pending approval.');
            }
            return redirect()->route('vendor.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    /**
     * Show registration form
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,vendor',
            'business_name' => 'required_if:role,vendor|nullable|string|max:255',
            'phone' => 'required_if:role,vendor|nullable|string|max:20',
            'terms' => 'required|accepted'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'business_name' => $request->business_name ?? $request->name,
            'is_active' => $request->role === 'vendor' ? false : true,
        ]);

        Auth::login($user);

        if ($user->role === 'vendor') {
            return redirect()->route('vendor.dashboard')->with('success', 'Registration successful! Your account is pending approval.');
        }

        return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
