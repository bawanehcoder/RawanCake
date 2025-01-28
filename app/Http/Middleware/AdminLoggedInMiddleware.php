<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoggedInMiddleware
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('dashboard.login');
        }
        return $next($request);
    }
}
