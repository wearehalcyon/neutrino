<?php

use App\Models\User;
use App\Models\Page;
use App\Models\Post;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\ContentMeta;
use App\Models\Category;
use App\Models\Setting;
use App\Models\ContactForm;
use Illuminate\Support\Str;

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

        if ($settings->isNotEmpty()) {
            foreach ($settings as $setting) {
                $array['favicon'] = $setting->option_value;
            }
        } else {
            $array['favicon'] = null;
        }

        echo '<script id="id-base-webfont-script" src="' . asset('assets/js/plugin/webfont/webfont.min.js') . '"></script>';
        echo '<link id="id-base-favicon" rel="icon" href="' . asset('uploads/' . $array['favicon']) . '" type="image/x-icon">';
        echo '<link rel="apple-touch-icon" href="' . asset('uploads/' . $array['favicon']) . '">';
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
                    @media screen and (max-width: 1200px) {
                        #admin-bar.admin-bar .admin-bar-nav .ab-dm-none,
                        #admin-bar.admin-bar .admin-bar-nav li.ab-dm-none{
                            display: none;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li a{
                            font-size: 0;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li a i{
                            font-size: 16px;
                        }
                        #admin-bar.admin-bar .admin-bar-nav li .admin-bar-sub-menu li a{
                            font-size: 15px;
                        }
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

// Get Permalink
if (!function_exists('getPermalink')) {
    function getPermalink($type = null, $id = null)
    {
        if ($type && $id) {
            if ($type == 'page') {
                $page = Page::find($id);
                return url('/' . optional($page)->slug);
            }
            if ($type == 'post') {
                $post = Post::find($id);
                return url('/' . optional($post)->slug);
            }
        }

        return '';
    }
}

// Get Menu
if (!function_exists('getMenu')) {
    function getMenu($name = null, $menu_id = null, $menu_class = null, $container = true){
        $menu = Menu::where('name', $name)->first();

        if ($menu) {
            $items = MenuItem::where([
                'menu_id' => $menu->id,
                'parent' => null,
            ])
            ->orderBy('order', 'ASC')
            ->get();

            if ($menu_id) {
                $menuID = ' id="' . $menu_id . '"';
            } else {
                $menuID = null;
            }

            if ($container) {
                $menuHtml = '<nav' . $menuID . ' class="menu-nav ' . $menu_class . '">';
                $menuHtml .= '<ul' . $menuID . ' class="menu-list ' . $menu_class . '">';
                foreach ($items as $item) {
                    // Get target
                    if ($item->target === 1) {
                        $target = ' target="_blank"';
                    } else {
                        $target = null;
                    }
                    // Set submenu class
                    $subItems = $item->getSubItems();
                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . ' menu-item-has-children">';
                    } else {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . '">';
                    }
                    // Check link type
                    if ($item->slug) {
                        $menuHtml .= '<a href="' . url($item->slug) . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    } else {
                        $menuHtml .= '<a href="' . $item->url . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    }

                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<ul class="sub-menu">';
                        foreach ($subItems as $subItem) {
                            // Get target
                            if ($subItem->target === 1) {
                                $target = ' target="_blank"';
                            } else {
                                $target = null;
                            }
                            $menuHtml .= '<li class="sub-menu-item sub-menu-item-' . $subItem->id . '">';
                            if ($subItem->slug) {
                                $menuHtml .= '<a href="' . url($subItem->slug) . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            } else {
                                $menuHtml .= '<a href="' . $subItem->url . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            }
                            $menuHtml .= '</li>';
                        }
                        $menuHtml .= '</ul>';
                    }

                    $menuHtml .= '</li>';
                }
                $menuHtml .= '</ul>';
                $menuHtml .= '</nav>';
            } else {
                $menuHtml = '<ul' . $menuID . ' class="menu-list ' . $menu_class . '">';
                foreach ($items as $item) {
                    // Get target
                    if ($item->target === 1) {
                        $target = ' target="_blank"';
                    } else {
                        $target = null;
                    }
                    // Set submenu class
                    $subItems = $item->getSubItems();
                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . ' menu-item-has-children">';
                    } else {
                        $menuHtml .= '<li class="menu-item menu-item-' . $item->id . '">';
                    }
                    // Check link type
                    if ($item->slug) {
                        $menuHtml .= '<a href="' . url($item->slug) . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    } else {
                        $menuHtml .= '<a href="' . $item->url . '" title="' . $item->name . '"' . $target . '>' . $item->name . '</a>';
                    }

                    if ($subItems->isNotEmpty()) {
                        $menuHtml .= '<ul class="sub-menu">';
                        foreach ($subItems as $subItem) {
                            // Get target
                            if ($subItem->target === 1) {
                                $target = ' target="_blank"';
                            } else {
                                $target = null;
                            }
                            $menuHtml .= '<li class="sub-menu-item sub-menu-item-' . $subItem->id . '">';
                            if ($subItem->slug) {
                                $menuHtml .= '<a href="' . url($subItem->slug) . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            } else {
                                $menuHtml .= '<a href="' . $subItem->url . '" title="' . $subItem->name . '"' . $target . '>' . $subItem->name . '</a>';
                            }
                            $menuHtml .= '</li>';
                        }
                        $menuHtml .= '</ul>';
                    }

                    $menuHtml .= '</li>';
                }
                $menuHtml .= '</ul>';
            }
        }

        return $menuHtml ?? null;
    }
}

// Get META parameter
if (!function_exists('getMetaData')) {
    function getMetaData($type = null, $id = null, $key = null)
    {
        $args = [
            'type' => $type,
            $type . '_id' => $id,
            'meta_key' => $key,
        ];
        $data = ContentMeta::where($args)->first();

        return optional($data)->meta_value;
    }
}

// Get Body class
if (!function_exists('getBodyClass')) {
    function getBodyClass($custom_classes = null)
    {
        if (Auth::user()) {
            $classes = 'body-class launched admin-bar ' . $custom_classes;
        } else {
            $classes = 'body-class launched ' . $custom_classes;
        }

        return $classes;
    }
}

// Get posts
if (!function_exists('getPosts')) {
    function getPosts($category = null, $orderby = 'created_at', $order = 'ASC', $limit = null)
    {
        if ($limit) {
            $limit = $limit;
        } else {
            $limit = getOption('posts_per_page');
        }
        if ($category) {
            $posts = Post::orderBy($orderby, $order)->limit($limit)->get();
        } else {
            $posts = Post::orderBy($orderby, $order)->limit($limit)->get();
        }

        return $posts;
    }
}

// Get date
if (!function_exists('getPostDate')) {
    function getPostDate($format = null, $date = null)
    {
        return date($format, strtotime($date));
    }
}

// Get post categories
if (!function_exists('getPostCategories')) {
    function getPostCategories($id = null)
    {
        $categories = Category::join('post_to_categories', 'categories.id', '=', 'post_to_categories.category_id')
            ->where('post_to_categories.post_id', $id)
            ->select('categories.*')
            ->get();

        return $categories;
    }
}

// Get contact form
if (!function_exists('getContactForm')) {
    function getContactForm($name = null, $id = null, $custom_form_id = null, $custom_form_class = null)
    {
        $form = ContactForm::where([
            'id' => $id,
            'name' => $name,
        ])->first();

        if ($form) {
            $html = '<form id="contact-form-' . $id . ' ' . $custom_form_id . '" action="' . route('c-form.submit', [$id, $name, Str::random(5) . '-' . Str::random(5) . '-' . Str::random(5)]) . '" method="post" enctype="multipart/form-data" class="contact-form-wrapper contact-form-' . $id . ' ' . $custom_form_class . '">';
            $html .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
            $html .= $form->form_fields;
            $html .= '</form>';

            return $html;
        }

        return '';
    }
}

// Get post link
if (!function_exists('getPostLink')) {
    function getPostLink($slug = null)
    {
        if ($slug) {
            return route('pages.blog.post', $slug);
        }
        return null;
    }
}
