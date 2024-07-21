<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AppsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-apps', compact('routeName'));
    }
}
