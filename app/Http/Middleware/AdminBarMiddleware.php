<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $adminBarHtml = View::make('dashboard.partials.admin-bar')->render();

            $content = $response->getContent();
            $content = Str::replaceFirst('<body>', '' . $adminBarHtml, $content);

            $response->setContent($content);
        }

        return $response;
    }
}
