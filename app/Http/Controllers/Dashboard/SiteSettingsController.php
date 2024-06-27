<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $routeName = Route::currentRouteName();

        return view('dashboard.page-site-settings', compact('routeName'));
    }

    public function update(Request $request)
    {
        return redirect()->back()->with('success', __('Site settings was updated successfully!'));
    }
}
