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
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $users = User::orderBy('created_at', 'ASC')->paginate(20);

        return view('dashboard.page-users', compact('routeName', 'users'));
    }

    public function edit($id)
    {
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $user = User::where('id', $id)->first();

        $roles = UserRole::all();

        return view('dashboard.page-users-edit', compact('routeName', 'user', 'roles'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([3,4,5]);

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
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $user = User::find(Auth::id());

        return view('dashboard.page-users-account-edit', compact('routeName', 'user'));
    }

    public function editAccountSave(Request $request)
    {
        restrictAccess([3,4,5]);

        $id = Auth::id();

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

        return redirect()->back()->with('success', __('Account data was updated successfully'));
    }

    public function add()
    {
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $roles = UserRole::all();

        return view('dashboard.page-users-add', compact('routeName', 'roles'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([3,4,5]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserMeta::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'description' => $request->description,
            'birth_day' => $request->birth_day,
        ]);

        UserToRole::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('dash.users')->with('success', __('User was created successfully'));
    }

    public function delete()
    {
        restrictAccess([3,4,5]);
    }
}
