<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ToolsPageController extends Controller
{
    public function index(){
        $routeName = Route::currentRouteName();

        $title = doAction('custom_admin_page_title');

        return view('dashboard.page-custom-admin-page', compact('routeName', 'title'));
    }
}
