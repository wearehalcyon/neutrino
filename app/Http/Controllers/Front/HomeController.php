<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $theme = Setting::where('option_name', 'front_theme')->first();
        $homepageID = Setting::where('option_name', 'homepage_id')->first();
        if (!$homepageID) {
            abort(404);
        }

        $page = Page::find($homepageID->option_value);
        $template = $page->template;
        if ($template == 'default') {
            $theme = 'front.' . $theme->option_value . '.index';
        } else {
            $theme = 'front.' . $theme->option_value . '.templates.page-' . $template;
        }

        return view($theme, compact('page'));
    }
}
