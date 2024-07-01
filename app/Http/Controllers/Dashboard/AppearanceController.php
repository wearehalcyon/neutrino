<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
}
