<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        view()->share('showAdminBar', true);

        return $next($request);
    }
}
