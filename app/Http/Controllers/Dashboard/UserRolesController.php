<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserRolesController extends Controller
{
    public function index()
    {
        $routeName = Route::currentRouteName();

        $roles = UserRole::all();

        return view('dashboard.page-user-roles', compact('routeName', 'roles'));
    }
}
