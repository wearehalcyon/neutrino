<?php

use App\Models\User;
use App\Models\Setting;

// Get Option
if (!function_exists('getOption')) {
    function getOption($name = null)
    {
        $option = Setting::where('option_name', $name)->first();

        if ($option) {
            return $option->option_value;
        }

        return '';
    }
}

// Get User
if (!function_exists('getUser')) {
    function getUser($id = null)
    {
        $user = User::join('user_metas', 'users.id', '=', 'user_metas.user_id')
            ->where('users.id', $id)
            ->select(
                'users.*',
                'user_metas.*',
                'users.id as id',
            )
            ->first();

        return $user;
    }
}

// Get User Role
if (!function_exists('getUserRole')) {
    function getUserRole($id = null){
        if ($id) {
            $user = User::find($id);
        } else {
            $user = User::find(Auth::id());
        }

        return $user->getRole();
    }
}

// Get access
if (!function_exists('restrictAccess')) {
    function restrictAccess($array = null){
        if (in_array(getUserRole()->id, $array)) {
            abort(404);
        }
    }
}
if (!function_exists('hideAccess')) {
    function hideAccess($array = null){
        if (in_array(getUserRole()->id, $array)) {
            return false;
        }

        return true;
    }
}
