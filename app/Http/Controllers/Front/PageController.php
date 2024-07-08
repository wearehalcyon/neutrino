<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function internal($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if ($page) {
            $theme = Setting::where('option_name', 'front_theme')->first();
            $theme = $theme->option_value;
            $template = $page->template;

            if($template != 'default') {
                $template = 'templates.page-' . $template;
            } else {
                $template = 'index';
            }

            return view('front.' . $theme . '.' . $template, compact('page'));
        } else {
            abort(404);
        }
    }
}
