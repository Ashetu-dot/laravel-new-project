<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $available = array_values(Config::get('app.available_locales', ['en']));

        // Prefer authenticated user's stored preference
        if (Auth::check() && Auth::user()->language_preference) {
            $locale = Auth::user()->language_preference;
        } elseif (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            $locale = Config::get('app.locale', 'en');
        }

        if (in_array($locale, $available, true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}

