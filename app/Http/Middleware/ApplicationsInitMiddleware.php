<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Application;

class ApplicationsInitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appsRoot = app_path('/Applications/');
        $appsDir = glob($appsRoot . '*', GLOB_ONLYDIR);

        $apps = [];
        foreach ($appsDir as $item) {
            $appName = basename($item);

            $app = Application::where('name', $appName)->first();

            if ($app && $app->status === 1) {

                include $appsRoot . $appName . '/' . $appName . '.php';

                if (file_exists($appsRoot . $appName . '/' . $appName . '.php')) {
                    $filePHP = $appsRoot . $appName . '/' . $appName . '.php';
                } else {
                    $filePHP = null;
                }
                if (file_exists($appsRoot . $appName . '/' . 'info.json')) {
                    $fileJSON = json_decode(file_get_contents($appsRoot . $appName . '/' . 'info.json'));
                } else {
                    $fileJSON = null;
                }
                if (file_exists($appsRoot . $appName . '/' . 'icon.svg')) {
                    $fileSVG = file_get_contents($appsRoot . $appName . '/' . 'icon.svg');
                } else {
                    $fileSVG = null;
                }
    
                $apps[] = [
                    'php' => $filePHP,
                    'json' => $fileJSON,
                    'svg' => $fileSVG,
                ];
            } else {
                $apps[] = [];
            }
        }

        return $next($request);
    }
}
