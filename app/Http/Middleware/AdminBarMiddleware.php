<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminBarMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $adminBarHtml = View::make('dashboard.partials.admin-bar')->render();

            $content = $response->getContent();

            if (strpos($content, $adminBarHtml) === false) {
                $content = preg_replace('/<body([^>]*)>/', '<body$1>' . $adminBarHtml, $content);
                $response->setContent($content);
            }
        }

        return $response;
    }
}
