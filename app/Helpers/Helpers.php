<?php

use Illuminate\Support\Facades\App;
use App\Models\ContactFormDatabase;
use App\Models\Tag;
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
// use Jenssegers\Agent\Agent;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;
use App\Services\ActionHooks;
use Illuminate\Support\Facades\Route;

// Extract shortcode from content
require_once 'inc/process-shortcodes.php';

// Action Hooks
if (!function_exists('addAction')) {
    function addAction($hook, $callback, $priority = 1)
    {
        if (app()->bound(ActionHooks::class)) {
            app(ActionHooks::class)->addAction($hook, $callback, $priority);
        } else {
            ActionHooks::addEarlyAction($hook, $callback, $priority);
        }
    }
}
if (!function_exists('doAction')) {
    function doAction($hook, $args = [])
    {
        app(ActionHooks::class)->doAction($hook, $args);
    }
}
if (!function_exists('addFilter')) {
    function addFilter($hook, $callback, $priority = 1)
    {
        if (app()->bound(ActionHooks::class)) {
            app(ActionHooks::class)->addFilter($hook, $callback, $priority);
        } else {
            ActionHooks::addEarlyFilter($hook, $callback, $priority);
        }
    }
}
if (!function_exists('applyFilter')) {
    function applyFilter($hook, $value, $args = []){
        return app(ActionHooks::class)->applyFilter($hook, $value, $args);
    }
}

// Check installation
if (!function_exists('checkInstallation')) {
    function checkInstallation(){
        $instDir = public_path('/installation/');
        if (File::exists($instDir)) {
            return true;
        } else {
            return false;
        }
    }
}

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
    function getHead(){
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

        echo '<script id="nt-base-webfont-script" src="' . asset('assets/js/plugin/webfont/webfont.min.js') . '"></script>';
        if ($array['favicon']) {
            echo '<link id="nt-base-favicon" rel="icon" href="' . asset('uploads/' . $array['favicon']) . '" type="image/x-icon">';
            echo '<link rel="apple-touch-icon" href="' . asset('uploads/' . $array['favicon']) . '">';
        } else {
            echo '<link id="nt-base-favicon" rel="icon" href="' . asset('favicon.png') . '" type="image/x-icon">';
            echo '<link rel="apple-touch-icon" href="' . asset('favicon.png') . '">';
        }
        $linkFonts = asset('assets/css/fonts.min.css');
        echo <<<HTML
            <script id="nt-base-webfont-inline-script">
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
                <style id="nt-base-admin-bar-styles">
                    *{
                        margin: 0;
                        padding: 0;
                    }
                    #admin-bar-padding.admin-bar-padding{
                        position: sticky;
                        width: 100%;
                        height: 30px;
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
                        -webkit-backdrop-filter: blur(30px) saturate(1.2);
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
    function getFooter(){
        echo '<script id="nt-base-jquery-script" src="' . asset('assets/js/core/jquery-3.7.1.min.js') . '"></script>';
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
    function getPermalink($type = null, $id = null){
        if ($type && $id) {
            if ($type == 'page') {
                $page = Page::find($id);
                return url('/' . optional($page)->slug);
            }
            if ($type == 'post') {
                $post = Post::find($id);
                return url('/' . getOption('blog_base') . '/' . optional($post)->slug);
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
    function getMetaData($type = null, $id = null, $key = null){
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

// Get category
if (!function_exists('getCategory')) {
    function getCategory($slug = null)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return false;
        }

        return $category;
    }
}

// Get tag
if (!function_exists('getTag')) {
    function getTag($slug = null)
    {
        $tag = Tag::where('slug', $slug)->first();

        if (!$tag) {
            return false;
        }

        return $tag;
    }
}

// Get page
if (!function_exists('getPage')) {
    function getPage($slug = null)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return false;
        }

        return $page;
    }
}

// Get page by ID
if (!function_exists('getPageByID')) {
    function getPageByID($id = null)
    {
        $page = Page::find($id);

        if (!$page) {
            return false;
        }

        return $page;
    }
}

// Get post
if (!function_exists('getPost')) {
    function getPost($slug = null)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return false;
        }

        return $post;
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
            $posts = Post::orderBy($orderby, $order)->paginate($limit);
        } else {
            $posts = Post::orderBy($orderby, $order)->paginate($limit);
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

        if ($categories) {
            return $categories;
        }

        return '';
    }
}

// Get category posts
if (!function_exists('getCategoryPosts')) {
    function getCategoryPosts($id = null, $excluded = null, $doubles = [], $orderby = 'created_at', $order = 'ASC', $limit = null)
    {
        if ($orderby == 'random') {
            $posts = Post::join('post_to_categories', 'posts.id', '=', 'post_to_categories.post_id')
                ->where('post_to_categories.category_id', $id)
                ->where('posts.id', '!=', $excluded)
                ->whereNotIn('posts.id', $doubles)
                ->select('posts.*')
                ->distinct()
                ->inRandomOrder()
                ->paginate($limit);
        } else {
            $posts = Post::join('post_to_categories', 'posts.id', '=', 'post_to_categories.post_id')
                ->where('post_to_categories.category_id', $id)
                ->where('posts.id', '!=', $excluded)
                ->whereNotIn('posts.id', $doubles)
                ->select('posts.*')
                ->distinct()
                ->orderBy('posts.' . $orderby, $order)
                ->paginate($limit);
        }

        if ($posts) {
            return $posts;
        }

        return '';
    }
}

// Get category posts
if (!function_exists('getTagPosts')) {
    function getTagPosts($id = null, $orderby = 'created_at', $order = 'ASC', $limit = null)
    {
        if ($orderby == 'random') {
            $posts = Post::join('post_to_tags', 'posts.id', '=', 'post_to_tags.post_id')
                ->where('post_to_tags.tag_id', $id)
                ->select('posts.*')
                ->inRandomOrder()
                ->paginate($limit);
        } else {
            $posts = Post::join('post_to_tags', 'posts.id', '=', 'post_to_tags.post_id')
                ->where('post_to_tags.tag_id', $id)
                ->select('posts.*')
                ->orderBy('posts.' . $orderby, $order)
                ->paginate($limit);
        }

        if ($posts) {
            return $posts;
        }

        return '';
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

// Get related posts
if (!function_exists('getRelatedPosts')) {
    function getRelatedPosts($id = null, $limit = null, $orderby = 'created_at', $order = 'ASC'){
        $query = Post::where('id', '!=', $id);

        if ($orderby === 'random') {
            $query->inRandomOrder();
        } else {
            $query->orderBy($orderby, $order);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }
}

// Get tag link
if (!function_exists('getTagLink')) {
    function getTagLink($slug = null) {
        if ($slug) {
            $link = route('pages.blog.tag', $slug);

            if ($link) {
                return $link;
            }
        }

        return '';
    }
}

// Get category link
if (!function_exists('getCategoryLink')) {
    function getCategoryLink($slug = null) {
        if ($slug) {
            $link = route('pages.blog.category', $slug);

            if ($link) {
                return $link;
            }
        }

        return '';
    }
}

// Get Contact Form Database messages counter
if (!function_exists('getCFMCounter')) {
    function getContactFormsMessages(){
        $messages = ContactFormDatabase::where('read', 0)->get();

        return $messages;
    }
}

// Get GeoIP
if (!function_exists('getGeoIp')) {
    function getGeoIp($ip = null)
    {
        $location = Location::get($ip);
        if (!$location) {
            return false;
        }
        $location = collect($location);
        return $location;
    }
}

// Get user agent
if (!function_exists('getUserAgent')) {
    function getUserAgent($data = null, $value = null)
    {
        if (!$data) {
            return '';
        }
        $device = Agent::device($data);
        $platform = Agent::platform($data);
        $browser = Agent::browser($data);

        if ($value == 'device') {
            if (!$device) {
                return 'Computer/Laptop';
            } else {
                return $device;
            }
        } elseif ($value == 'platform') {
            return $platform;
        } elseif ($value == 'browser') {
            return $browser;
        }
    }
}

// Is mobile detect
if (!function_exists('isMobile')) {
    function isMobile($data = null)
    {
        if ($data) {
            return Agent::isMobile($data);
        } else {
            return Agent::isMobile();
        }
    }
}

// Get author
if (!function_exists('getAuthor')) {
    function getAuthor($id = null)
    {
        $user = User::find($id);

        return $user;
    }
}

// Get excerpt
if (!function_exists('getExcerpt')) {
    function getExcerpt($content = null, $limit = null, $suffix = null)
    {
        if (!$content) {
            return '';
        }

        $clean = strip_tags($content);

        $excerpt = Str::limit($clean, $limit, $suffix);

        return $excerpt;
    }
}