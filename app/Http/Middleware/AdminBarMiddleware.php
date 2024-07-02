<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && Auth::check() && Auth::user()->is_admin) {
            $content = $response->getContent();
            $adminBarHtml = view('dashboard.partials.admin-bar')->render();
            $response->setContent($content . $adminBarHtml);
        }

        return $response;
    }
}
