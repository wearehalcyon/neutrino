<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UsersController extends Controller
{
    public function index()
    {
        $routeName = Route::currentRouteName();

        $users = User::orderBy('created_at', 'ASC')->paginate(20);

        return view('dashboard.page-users', compact('routeName', 'users'));
    }

    public function edit($id)
    {
        $routeName = Route::currentRouteName();

        $user = User::where('id', $id)->first();

        $roles = UserRole::all();

        return view('dashboard.page-users-edit', compact('routeName', 'user', 'roles'));
    }

    public function editSave(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', __('User data was updated successfully'));
    }
}
