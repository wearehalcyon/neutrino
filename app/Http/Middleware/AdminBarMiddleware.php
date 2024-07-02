<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && Auth::check()) {
            $content = $response->getContent();
            $adminBarHtml = view('dashboard.partials.admin-bar')->render();
            $response->setContent($adminBarHtml . $content);
        }

        return $response;
    }
}
