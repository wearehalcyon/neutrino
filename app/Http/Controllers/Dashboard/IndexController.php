<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function index()
    {
        $routeName = Route::currentRouteName();

        return view('dashboard.page-index', compact('routeName'));
    }
}
