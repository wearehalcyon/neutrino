<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

    }

    public function post($slug)
    {
        $theme = Setting::where('option_name', 'front_theme')->first()->option_value;
        $page = Post::where('slug', $slug)->first();

        return view('front.' . $theme . '.post', compact('page'));
    }
}
