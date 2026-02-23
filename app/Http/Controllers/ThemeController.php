<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Toggle theme between light and dark
     */
    public function toggle(Request $request)
    {
        try {
            $request->validate([
                'theme' => 'required|in:light,dark'
            ]);

            $theme = $request->theme;

            // Store in session
            session(['theme' => $theme]);

            // If user is authenticated, store in database
            if (auth()->check()) {
                $user = auth()->user();
                $user->theme_preference = $theme;
                $user->save();
            }

            return response()->json([
                'success' => true,
                'theme' => $theme,
                'message' => 'Theme updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update theme'
            ], 500);
        }
    }

    /**
     * Get current theme preference
     */
    public function getTheme(Request $request)
    {
        $theme = 'light'; // default

        // Check if user is authenticated and has preference
        if (auth()->check() && auth()->user()->theme_preference) {
            $theme = auth()->user()->theme_preference;
        }
        // Otherwise check session
        else if (session()->has('theme')) {
            $theme = session('theme');
        }

        return response()->json([
            'success' => true,
            'theme' => $theme
        ]);
    }
}