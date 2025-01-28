<?php

namespace App\Http\Middleware;
use App\Services\ToastNotificationService;
use Closure;
use Illuminate\Http\Request;
class PassToastNotificationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!isLogged() || $request->ajax() || $request->wantsJson()){
            return $next($request);
        }


        $msg = ToastNotificationService::pullToastMsg($user = getLogged());
        if(!empty($msg)){
            $msg = json_decode($msg);
            toast($msg->msg, $msg->type);
        }
        return $next($request);
    }
}
