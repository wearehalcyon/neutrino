<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolsPageController extends Controller
{
    public function index(){
        $routeName = Route::currentRouteName();

        return view('dashboard.page-custom-admin-page', compact('routeName'));
    }
}
