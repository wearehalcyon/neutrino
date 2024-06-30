<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $pages = Page::orderBy('created_at', 'DESC')->paginate(20);

        return view('dashboard.page-pages', compact('routeName', 'pages'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $users = User::orderBy('name', 'ASC')->get();

        $homepage = Setting::where('option_name', 'homepage_id')->first();

        return view('dashboard.page-pages-add', compact('routeName', 'users', 'homepage'));
    }
}
