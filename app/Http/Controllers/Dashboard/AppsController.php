<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\Application;

class AppsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $appsRoot = app_path('/Applications/');
        $appsDir = glob($appsRoot . '*', GLOB_ONLYDIR);

        foreach ($appsDir as $item) {
            $appName = basename($item);
            
            $appRecord = Application::where('name', $appName)->first();

            if (!$appRecord) {
                Application::create([
                    'name' => $appName,
                    'slug' => $appName . '/' . $appName
                ]);
            }
        }

        $appsDB = Application::all();
        
        foreach ($appsDB as $app) {
            if (File::exists(app_path('/Applications/' . $app->slug . '.php'))) {
                $filePHP = app_path('/Applications/' . $app->slug . '.php');
            } else {
                $filePHP = null;
            }
            if (File::exists(app_path('/Applications/' . $app->name . '/' . 'info.json'))) {
                $fileJSON = json_decode(File::get(app_path('/Applications/' . $app->name . '/' . 'info.json')));
            } else {
                $fileJSON = null;
            }
            if (File::exists(app_path('/Applications/' . $app->name . '/' . 'icon.svg'))) {
                $fileSVG = File::get(app_path('/Applications/' . $app->name . '/' . 'icon.svg'));
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
