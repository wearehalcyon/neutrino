<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ZipArchive;
use function foo\func;

class AppearanceController extends Controller
{
    public function themes()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        // Get site front themes
        $themeActive = Setting::where('option_name', 'front_theme')->first();
        $directory = resource_path('views/front');
        $items = scandir($directory);
        $themes = [];
        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..' && is_dir($directory . '/' . $item)) {
                $themes[] = $item;
            }
        }

        return view('dashboard.page-themes', compact('routeName', 'themes', 'themeActive'));
    }

    public function themesActivate(Request $request, $theme)
    {
        restrictAccess([4,5]);

        $themeActive = Setting::where('option_name', 'front_theme')->first();
        $themeActive->option_value = $theme;
        $themeActive->save();

        return redirect()->back()->with('success', __('Theme was activated successfully!'));
    }

    public function themesDelete(Request $request, $theme)
    {
        restrictAccess([4,5]);

        $directory = resource_path('views\\front\\' . $theme);

        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }

        return redirect()->back()->with('success', __('Theme was deleted successfully!'));
    }

    public function themesUpload(Request $request)
    {
        restrictAccess([4,5]);

        $request->validate([
            'theme_file' => 'required|file|mimes:zip'
        ]);

        $zipFile = $request->file('theme_file');
        $zipFilePath = $zipFile->getPathname();
        $extractTo = resource_path('views\\front');
        $zip = new ZipArchive;

        $log = '';

        if ($zip->open($zipFilePath) === TRUE) {
            $log .= "Last Action: " . date('D M d, Y') . " at " . date('H:i:s') . " | initialized by " . Auth::user()->name . " (" . Str::slug(Auth::user()->name) . "$)\n";
            $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Zip file opened successfully.\n";
            $log .= "Status - OK\n";

            if (!File::exists($extractTo)) {
                File::makeDirectory($extractTo, 0755, true);
                $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Created directory: $extractTo\n";
                $log .= "Status - OK\n";
            }

            if ($zip->extractTo($extractTo)) {
                $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Files extracted successfully.\n";
                $log .= "Status - OK\n";
                $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Extracting to: $extractTo\n";
                $log .= "Status - OK\n";
            } else {
                $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Failed to extract files.\n";
                $log .= "Status - ERROR\n";
            }

            $zip->close();
            $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Zip file closed.\n";
            $log .= "Status - OK\n";
            $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Theme installed successfully.\n";
            $log .= "Status - OK\n";
            $log .= "Enjoy! :)\n";
        } else {
            $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Failed to open zip file.\n";
            $log .= "Status - ERROR\n";
        }

        return redirect()->back()->with('success', __('Theme was uploaded and installed successfully!'))->with('log', $log);
    }

    public function customize()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-custommize', compact('routeName'));
    }

    public function customizeSave(Request $request)
    {
        restrictAccess([4,5]);

        dd($request);
    }
}
