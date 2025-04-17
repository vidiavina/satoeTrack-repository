<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (!function_exists('authUser')) {
    function authUser()
    {
        foreach (['peminjam', 'admin'] as $guard) { // Changed order to prioritize 'peminjam'
            if (Auth::guard($guard)->check()) {
                // Log::info('Authenticated user found for guard: ' . $guard);
                return Auth::guard($guard)->user();
            }
        }

        return null;
    }
}
