<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use \App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;

class ChangeLanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if(isset($request->lang) && $request->lang=='en' || $request->lang=='ar') {
            App::setLocale($request->lang);
        }
        return $next($request);
    }
}
