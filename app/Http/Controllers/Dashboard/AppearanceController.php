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
        $publicTheme = public_path('themes/' . $theme);

        if (File::exists($directory)) {
            File::deleteDirectory($directory);
            File::deleteDirectory($publicTheme);
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
        $extractTo = resource_path('views/front');
        $zip = new ZipArchive;

        $log = '';

        // Получаем список директорий до распаковки
        $directoriesBefore = $this->getDirectories($extractTo);

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

                // Получаем список директорий после распаковки
                $directoriesAfter = $this->getDirectories($extractTo);

                // Определяем, какая папка была добавлена
                $newDirectories = array_diff($directoriesAfter, $directoriesBefore);
                if (!empty($newDirectories)) {
                    $themeName = array_pop($newDirectories);
                    $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Theme folder found: $themeName\n";
                    $log .= "Status - OK\n";

                    // Путь к папке assets
                    $assetsPath = $extractTo . DIRECTORY_SEPARATOR . $themeName . DIRECTORY_SEPARATOR . 'assets';
                    $targetPath = public_path("themes/$themeName/assets");

                    if (File::exists($assetsPath)) {
                        if (!File::exists($targetPath)) {
                            File::makeDirectory($targetPath, 0755, true);
                        }

                        File::copyDirectory($assetsPath, $targetPath);
                        File::deleteDirectory($assetsPath);

                        $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Assets folder moved successfully to $targetPath\n";
                        $log .= "Status - OK\n";
                    } else {
                        $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Assets folder not found.\n";
                        $log .= "Status - ERROR\n";
                    }
                } else {
                    $log .= "id-engine:~ " . Str::slug(Auth::user()->name) . "$ Theme folder not found.\n";
                    $log .= "Status - ERROR\n";
                }
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

    protected function getDirectories($directory)
    {
        $directories = [];
        $items = scandir($directory);
        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..' && is_dir($directory . DIRECTORY_SEPARATOR . $item)) {
                $directories[] = $item;
            }
        }
        return $directories;
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

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        // Upload Site Logo
        $siteOption = Setting::where('option_name', 'site_logo')->first();
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/identity/'), $fileName);

            if (!$siteOption) {
                Setting::create([
                    'option_name' => 'site_logo',
                    'option_value' => 'identity/' . $fileName,
                ]);
            } else {
                if (isset($request->site_logo)) {
                    $siteOption->option_value = 'identity/' . $fileName;
                    $siteOption->save();
                }
            }
        }
        if ($request->remove_logo == 1) {
            $siteOption->delete();
        }

        // Upload Header Image
        $siteOptionHI = Setting::where('option_name', 'header_image')->first();
        if ($request->hasFile('header_image')) {
            $file = $request->file('header_image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/identity/'), $fileName);

            if (!$siteOptionHI) {
                Setting::create([
                    'option_name' => 'header_image',
                    'option_value' => 'identity/' . $fileName,
                ]);
            } else {
                if (isset($request->header_image)) {
                    $siteOptionHI->option_value = 'identity/' . $fileName;
                    $siteOptionHI->save();
                }
            }
        }
        if ($request->remove_header_image == 1) {
            $siteOptionHI->delete();
        }

        // Upload Favicon
        $siteOptionFav = Setting::where('option_name', 'favicon')->first();
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/identity/'), $fileName);

            if (!$siteOptionFav) {
                Setting::create([
                    'option_name' => 'favicon',
                    'option_value' => 'identity/' . $fileName,
                ]);
            } else {
                if (isset($request->favicon)) {
                    $siteOptionFav->option_value = 'identity/' . $fileName;
                    $siteOptionHI->save();
                }
            }
        }
        if ($request->remove_favicon == 1) {
            $siteOptionFav->delete();
        }

        // Header Scripts
        $headScripts = Setting::where('option_name', 'head_scripts')->first();
        if (!$headScripts) {
            Setting::create([
                'option_name' => 'head_scripts',
                'option_value' => $request->head_scripts,
            ]);
        } else {
            if (isset($request->head_scripts)) {
                $headScripts->option_value = $request->head_scripts;
            } else {
                $headScripts->option_value = null;
            }
            $headScripts->save();
        }

        // Footer Scripts
        $footerScripts = Setting::where('option_name', 'footer_scripts')->first();
        if (!$footerScripts) {
            Setting::create([
                'option_name' => 'footer_scripts',
                'option_value' => $request->footer_scripts,
            ]);
        } else {
            if (isset($request->footer_scripts)) {
                $footerScripts->option_value = $request->footer_scripts;
            } else {
                $footerScripts->option_value = null;
            }
            $footerScripts->save();
        }

        return redirect()->back()->with('success', __('Site identity was updated successfully!'));
    }
}
