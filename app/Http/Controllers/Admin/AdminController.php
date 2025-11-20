<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminLoginRequest;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show admin login form.
     */
    public function create()
    {
        return view('admin.login');
    }

      /**
     * Handle admin login request.
     */
    public function store(AdminLoginRequest $request)
    {
        // The request is already validated at this point
        $validated = $request->validated();

        // Attempt to log the admin in
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active' // Only allow active admins to login
        ], $request->boolean('remember'))) {
            
            $request->session()->regenerate();
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back! Successfully logged in.');
        }

        // If login failed (wrong password but valid email)
        return back()
            ->withErrors([
                'password' => 'The provided password is incorrect.',
            ])
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Login failed. Please check your credentials.');
    }

       /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')
            ->with('success', 'You have been successfully logged out.');
    }

    /**
     * Verify admin (if needed for authentication).
     */
    public function verify(Request $request)
    {
        // Add your verification logic here
        return view('admin.verify');
    }
    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}