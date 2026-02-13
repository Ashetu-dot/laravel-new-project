<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = Auth::user();

        // Super admin has all permissions
        if ($user->role === 'admin' && $user->email === 'admin@vendora.com') {
            return $next($request);
        }

        // Check if user has any of the required permissions
        foreach ($permissions as $permission) {
            // You can implement a proper permission system here
            // For now, we'll check based on role
            if ($user->role === 'admin' && $permission === 'manage-admins') {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized. You do not have the required permissions.');
    }
}
