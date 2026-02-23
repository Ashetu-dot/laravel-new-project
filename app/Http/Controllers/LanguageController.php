<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        try {
            $request->validate([
                'locale' => 'required|in:en,am,om'
            ]);

            $locale = $request->locale;

            // Store in session
            session(['locale' => $locale]);

            // If user is authenticated, store in database
            if (auth()->check()) {
                $user = auth()->user();
                $user->language_preference = $locale;
                $user->save();
            }

            return response()->json([
                'success' => true,
                'locale' => $locale,
                'message' => 'Language updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update language'
            ], 500);
        }
    }
}