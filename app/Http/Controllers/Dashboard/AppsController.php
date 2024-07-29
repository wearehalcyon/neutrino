<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class AppsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $appsRoot = __DIR__ . '/../../../../app/Applications/';
        $appsDir = glob($appsRoot . '*', GLOB_ONLYDIR);
        
        foreach ($appsDir as $item) {
            $appName = basename($item);
            include $appsRoot . $appName . '/' . $appName . '.php';

            if (File::exists($appsRoot . $appName . '/' . $appName . '.php')) {
                $filePHP = $appsRoot . $appName . '/' . $appName . '.php';
            } else {
                $filePHP = null;
            }
            if (File::exists($appsRoot . $appName . '/' . 'info.json')) {
                $fileJSON = json_decode(File::get($appsRoot . $appName . '/' . 'info.json'));
            } else {
                $fileJSON = null;
            }
            if (File::exists($appsRoot . $appName . '/' . 'icon.svg')) {
                $fileSVG = File::get($appsRoot . $appName . '/' . 'icon.svg');
            } else {
                $fileSVG = null;
            }

            $apps[] = [
                'php' => $filePHP,
                'json' => $fileJSON,
                'svg' => $fileSVG,
            ];
        }

        return view('dashboard.page-apps', compact('routeName', 'apps'));
    }
}
