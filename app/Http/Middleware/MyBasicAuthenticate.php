<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MyBasicAuthenticate
{
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic('username') ?: $next($request);
    }
}
