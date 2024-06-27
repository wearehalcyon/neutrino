<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

class DebugModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $debugOption = getOption('debug_bar');

        if ($debugOption == 1) {
            $debugEnabled = true;
        } else {
            $debugEnabled = false;
        }

        Config::set('app.debug', $debugEnabled);

        return $next($request);
    }
}
