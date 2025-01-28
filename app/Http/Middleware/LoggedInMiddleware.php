<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoggedInMiddleware
{
    public function handle($request, Closure $next)
    {
            if (!getLogged()) {
                $redirectToRoute = $request->expectsJson() ? '' : route('login');
                throw new AuthenticationException(
                    'Unauthenticated.', ['user'], $redirectToRoute
                );
            }

        return $next($request);

    }
}
