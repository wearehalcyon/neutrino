<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function post($slug)
    {
        $page = Post::where('slug', $slug)->first();

        if (!$page) {
            abort(404);
        }

        $theme = Setting::where('option_name', 'front_theme')->first()->option_value;

        // Breadcrumbs
        $breadcrumbs = [
            [
                'name' => 'Home',
                'url' => url('/')
            ],
            [
                'name' => 'Blog',
                'url' => route('pages.blog')
            ],
            [
                'name' => $page->name,
                'url' => false
            ]
        ];

        return view('front.' . $theme . '.post', compact('page', 'breadcrumbs'));
    }

    public function category($category)
    {
        $page = Category::where('slug', $category)->first();

        if (!$page) {
            abort(404);
        }

        $theme = Setting::where('option_name', 'front_theme')->first()->option_value;

        // Breadcrumbs
        $breadcrumbs = [
            [
                'name' => 'Home',
                'url' => url('/')
            ],
            [
                'name' => 'Blog',
                'url' => route('pages.blog')
            ],
            [
                'name' => $page->name,
                'url' => false
            ]
        ];

        return view('front.' . $theme . '.page-category', compact('page', 'breadcrumbs'));
    }
}
