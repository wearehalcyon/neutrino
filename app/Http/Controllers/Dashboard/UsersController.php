<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\UserRole;
use App\Models\UserToRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        // User record
        $user = User::find($id);
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // User Meta record
        $userMeta = UserMeta::where('user_id', $id)->first();
        $userMeta->first_name = $request->first_name;
        $userMeta->last_name = $request->last_name;
        $userMeta->description = $request->description;
        $userMeta->display_name = $request->display_name;
        $userMeta->birth_date = $request->birth_date;
        $userMeta->save();

        // User Role
        $userRole = UserToRole::where('user_id', $id)->first();
        $userRole->role_id = $request->role_id;
        $userRole->save();

        return redirect()->back()->with('success', __('User data was updated successfully'));
    }

    public function editAccount()
    {
        $routeName = Route::currentRouteName();

        $user = User::find(Auth::id());

        return view('dashboard.page-users-account-edit', compact('routeName', 'user'));
    }
}
