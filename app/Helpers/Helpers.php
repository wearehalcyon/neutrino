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

// Get Head
if (!function_exists('getHead')) {
    function getHead()
    {
        $array = [];
        $settings = Setting::where([
            'option_name' => 'favicon',
        ])->get();

        foreach ($settings as $setting) {
            $array['favicon'] = $setting->option_value;
        }

        echo '<script id="id-base-webfont-script" src="' . asset('assets/js/plugin/webfont/webfont.min.js') . '"></script>';
        echo '<link id="id-base-favicon" rel="icon" href="' . asset('uploads/' . $array['favicon']) . '" type="image/x-icon">';
        $linkFonts = asset('assets/css/fonts.min.css');
        echo <<<HTML
            <script id="id-base-webfont-inline-script">
                WebFont.load({
                    google: { families: ["Public Sans:300,400,500,600,700"] },
                    custom: {
                        families: [
                            "Font Awesome 5 Solid",
                            "Font Awesome 5 Regular",
                            "Font Awesome 5 Brands",
                            "simple-line-icons",
                        ],
                        urls: ["$linkFonts"],
                    },
                    active: function () {
                        sessionStorage.fonts = true;
                    },
                });
            </script>
            HTML;
        echo <<<HTML
                <style id="id-base-admin-bar-styles">
                    *{
                        margin: 0;
                        padding: 0;
                    }
                    #admin-bar-padding.admin-bar-padding{
                        position: sticky;
                        width: 100%;
                        height: 32px;
                        top: 0;
                        left: 0;
                        z-index: 999999999999999989;
                    }
                    #admin-bar.admin-bar{
                        font-family: sans-serif;
                        font-size: 14px;
                        background: #1a2035;
                        color: #b9babf;
                        display: flex;
                        flex-wrap: wrap;
                        align-items: center;
                        justify-content: space-between;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: auto;
                        z-index: 999999999999999999;
                    }
                    #admin-bar.admin-bar .admin-bar-nav{
                        display: flex;
                        flex-wrap: wrap;
                        align-items: center;
                        list-style-type: none;
                        margin: 0 10px;
                        padding: 0;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li{
                        display: inline-block;
                        position: relative;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li a{
                        display: inline-block;
                        color: #b9babf;
                        padding: 5px;
                        text-decoration: none;
                        font-size: 13px;
                        border-radius: 4px;
                        margin-left: 5px;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li:first-child a{
                        border-radius: 0px;
                        margin: 0;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li:hover a{
                        background: rgba(255,255,255,.2);
                        color: #fff;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu{
                        display: none;
                        position: absolute;
                        width: 200px;
                        height: auto;
                        padding: 8px 5px;
                        background-color: rgba(0,0,0,.2);
                        box-shadow: 0 5px 20px rgba(0,0,0,.2);
                        border-radius: 6px;
                        backdrop-filter: blur(30px) saturate(1.2);
                        border: 1px solid rgba(255,255,255,.15);
                    }
                    #admin-bar.admin-bar .admin-bar-nav li:hover .admin-bar-sub-menu{
                        display: block;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li{
                        display: block;
                    }
                    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li a{
                        display: block;
                        font-weight: 300;
                        background: transparent;
                        padding: 5px 10px;
                        color: #fff;
                        border-radius: 4px;
                        margin: 0;
                        text-shadow: 0 0 15px #000, 0 0 5px rgba(0,0,0,.5);
                    }
                    #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li:hover a{
                        background: rgba(255,255,255,.2);
                        color: #fff;
                        filter: brightness(1);
                    }
                    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu{
                        left: auto;
                        right: 0;
                    }
                    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu form button{
                        display: block;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                        font-weight: 300;
                        background: transparent;
                        padding: 5px 10px;
                        color: #fff;
                        border-radius: 4px;
                        margin: 0;
                        text-align: left;
                        text-shadow: 0 0 15px #000, 0 0 5px rgba(0,0,0,.5);
                    }
                    #admin-bar.admin-bar .admin-bar-nav.right-nav li .admin-bar-sub-menu form button:hover{
                        background: rgba(255,255,255,.2);
                        color: #fff;
                        filter: brightness(1);
                    }
                </style>
            HTML;
        echo getOption('head_scripts');
    }
}

// Get Footer
if (!function_exists('getFooter')) {
    function getFooter()
    {
        echo '<script id="id-base-jquery-script" src="' . asset('assets/js/core/jquery-3.7.1.min.js') . '"></script>';
        echo getOption('footer_scripts');
    }
}

// Get stylesheet
if (!function_exists('getThemeAssetsUri')) {
    function getThemeAssetsUri($suffix = null){
        return url('/themes/' . getOption('front_theme') . $suffix);
    }
}
