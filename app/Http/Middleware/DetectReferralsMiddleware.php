<?php

namespace App\Http\Middleware;

use App\Services\ReferralService;
use Illuminate\Http\Request;
use Closure;
class DetectReferralsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        ReferralService::detectReferals();
        return $next($request);
    }
}
