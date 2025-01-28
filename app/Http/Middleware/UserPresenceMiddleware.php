<?php

namespace App\Http\Middleware;
use App\Services\UserPresenceService;
use Closure;
class UserPresenceMiddleware
{
    public function handle($request, Closure $next)
    {
        if(isLogged()){
            $userPresenceObj = app()->make(UserPresenceService::class)->registerUserPresence();
        }
        return $next($request);
    }
}
