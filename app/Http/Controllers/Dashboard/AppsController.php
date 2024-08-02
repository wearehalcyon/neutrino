<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\Application;
use Illuminate\Support\Facades\Http;
use ZipArchive;

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
        
        $apps = [];
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
                'name' => $app->name,
                'slug' => $app->slug,
                'id' => $app->id,
                'status' => $app->status
            ];
        }

        return view('dashboard.page-apps', compact('routeName', 'apps'));
    }

    public function update($id, $name, $status){

        $app = Application::where([
            'id' => $id,
            'name' => $name
        ])->first();

        if ($app && $status != 2) {
            $app->status = $status;
            $app->save();

            return redirect()->back()->with('success', __('App status was updated successfully.'));
        } else {
            return redirect()->back()->with('error', __('Ooops! Something went wrong. App status was not updated.'));
        }
    }

    public function uninstall($id, $name, $status){
        $app = Application::where([
            'id' => $id,
            'name' => $name
        ])->first();

        if ($app && $status == 2) {
            $app->delete();

            File::deleteDirectory(app_path('/Applications/' . $name));

            return redirect()->back()->with('success', __('App was uninstalled successfully.'));
        } else {
            return redirect()->back()->with('error', __('Ooops! Something went wrong. App uninstall was crashed.'));
        }
    }

    public function install(){
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $jsonSource = 'https://api.intakedigital.net/nt/apps-repo.php?type=json';
        $jsonArray = json_decode(file_get_contents($jsonSource));
        $apps = collect($jsonArray);

        return view('dashboard.page-apps-install', compact('routeName', 'apps'));
    }

    public function download($name_id){
        restrictAccess([4,5]);

        $pkgSrc = 'https://api.intakedigital.net/nt/apps/' . $name_id . '/' . $name_id . '.zip';
        $response = Http::get($pkgSrc);

        if ($response->failed()) {
            abort(404);
        }

        return response($response->body(), 200)
            ->header('Content-Type', $response->header('Content-Type'))
            ->header('Content-Disposition', 'attachment; filename="' . $name_id . '.zip"');
    }

    public function installApp($name_id){
        restrictAccess([4,5]);

        $app = Application::where('name', $name_id)->first();

        if (!$app) {
            Application::create([
                'name' => $name_id,
                'slug' => $name_id . '/' . $name_id,
                'status' => 0
            ]);
            $pkgSrc = 'https://api.intakedigital.net/nt/apps/' . $name_id . '/' . $name_id . '.zip';
            $response = Http::get($pkgSrc);
            $tempPath = app_path('Applications/temp_' . $name_id);

            if ($response->failed()) {
                abort(404);
            }

            $fileName = $name_id . '.zip';
            $filePath = app_path('/Applications/' . $fileName);
            File::put($filePath, $response->body());
            $tempPath = app_path('Applications/temp_' . $name_id);

            $zip = new ZipArchive;
            if ($zip->open($filePath) === true) {
                $zip->extractTo($tempPath);
                $zip->close();
            } else {
                File::delete($filePath);
                abort(500, 'Unable to extract the file.');
            }

            $directories = File::directories($tempPath);
            if (count($directories) === 1) {
                $innerFolder = $directories[0];
                
                $extractPath = app_path('Applications/' . $name_id);

                if (!File::exists($extractPath)) {
                    File::makeDirectory($extractPath, 0755, true);
                }

                File::copyDirectory($innerFolder, $extractPath);
            } else {
                abort(500, 'Unexpected folder structure in the archive.');
            }

            File::delete($filePath);
            File::deleteDirectory($tempPath);

            return redirect()->back()->with('success', __('App was installed successfully'));
        } else {
            return redirect()->back()->with('error', __('Oops! Something went wrong. Try again please.'));
        }
    }
}
