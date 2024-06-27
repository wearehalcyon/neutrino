<?php

use App\Models\User;
use App\Models\Setting;

// Get Option
if (!function_exists('getOption')) {
    function getOption($name = null)
    {
        $option = Setting::where('option_name', $name)->first();
        return $option->option_value;
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
