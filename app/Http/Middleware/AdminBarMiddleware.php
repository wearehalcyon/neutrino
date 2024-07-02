<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            require_once resource_path('views/dashboard/partials/admin-bar.php');
        }

        return $next($request);
    }
}
