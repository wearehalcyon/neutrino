<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SiteSettingsController extends Controller
{
    public function index()
    {
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $pages = Page::orderBy('name', 'ASC')->get();

        // Get site front themes
        $directory = resource_path('views/front');
        $items = scandir($directory);
        $themes = [];
        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..' && is_dir($directory . '/' . $item)) {
                $themes[] = $item;
            }
        }

        return view('dashboard.page-site-settings', compact('routeName', 'pages', 'themes'));
    }

    public function update(Request $request)
    {
        restrictAccess([3,4,5]);

        // Site name
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'site_name',
                'option_value' => $request->site_name,
            ]);
        } else {
            $sitename = Setting::where('option_name', 'site_name')->first();
            if (isset($request->site_name)) {
                $sitename->option_value = $request->site_name;
                $sitename->save();
            } else {
                $sitename->option_value = null;
                $sitename->save();
            }
        }

        // Site URL
        if (!getOption('site_url')) {
            Setting::create([
                'option_name' => 'site_url',
                'option_value' => $request->site_url,
            ]);
        } else {
            $siteurl = Setting::where('option_name', 'site_url')->first();
            if (isset($request->site_url)) {
                $siteurl->option_value = $request->site_url;
                $siteurl->save();
            } else {
                $siteurl->option_value = null;
                $siteurl->save();
            }
        }

        // Site administration email
        if (!getOption('site_email')) {
            Setting::create([
                'option_name' => 'site_email',
                'option_value' => $request->site_email,
            ]);
        } else {
            $siteemail = Setting::where('option_name', 'site_email')->first();
            if (isset($request->site_email)) {
                $siteemail->option_value = $request->site_email;
                $siteemail->save();
            } else {
                $siteemail->option_value = null;
                $siteemail->save();
            }
        }

        // Site Description
        if (!getOption('site_description')) {
            Setting::create([
                'option_name' => 'site_description',
                'option_value' => $request->site_description,
            ]);
        } else {
            $sitedesc = Setting::where('option_name', 'site_description')->first();
            if (isset($request->site_description)) {
                $sitedesc->option_value = $request->site_description;
                $sitedesc->save();
            } else {
                $sitedesc->option_value = null;
                $sitedesc->save();
            }
        }

        // Posts Per Page
        if (!getOption('posts_per_page')) {
            Setting::create([
                'option_name' => 'posts_per_page',
                'option_value' => $request->posts_per_page,
            ]);
        } else {
            $postsperpage = Setting::where('option_name', 'posts_per_page')->first();
            if (isset($request->posts_per_page)) {
                $postsperpage->option_value = $request->posts_per_page;
                $postsperpage->save();
            } else {
                $postsperpage->option_value = null;
                $postsperpage->save();
            }
        }

        // Debug Bar
        $debugbar = Setting::where('option_name', 'debug_bar')->first();
        if (!$debugbar) {
            Setting::create([
                'option_name' => 'debug_bar',
                'option_value' => 1,
            ]);
        } else {
            if ($request->debug_bar) {
                $debugbar->option_value = 1;
            } else {
                $debugbar->option_value = 0;
            }
            $debugbar->save();
        }

        $texteditor = Setting::where('option_name', 'extended_editor')->first();
        if (!$texteditor) {
            Setting::create([
                'option_name' => 'extended_editor',
                'option_value' => 1,
            ]);
        } else {
            if ($request->extended_editor) {
                $texteditor->option_value = 1;
            } else {
                $texteditor->option_value = 0;
            }
            $texteditor->save();
        }

        // Set Homepage
        $sethomepage = Setting::where('option_name', 'homepage_id')->first();
        if (!$sethomepage) {
            Setting::create([
                'option_name' => 'homepage_id',
                'option_value' => $request->homepage_id,
            ]);
        } else {
            if (isset($request->homepage_id)) {
                $sethomepage->option_value = $request->homepage_id;
            } else {
                $sethomepage->option_value = null;
            }
            $sethomepage->save();
        }

        // Set Blog Index Page
        $setblogpage = Setting::where('option_name', 'blog_index_id')->first();
        if (!$setblogpage) {
            Setting::create([
                'option_name' => 'blog_index_id',
                'option_value' => $request->blog_index_id,
            ]);
        } else {
            if (isset($request->blog_index_id)) {
                $setblogpage->option_value = $request->blog_index_id;
            } else {
                $setblogpage->option_value = null;
            }
            $setblogpage->save();
        }

        // Set front theme
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'front_theme',
                'option_value' => $request->front_theme,
            ]);
        } else {
            if (isset($request->front_theme)) {
                $fronttheme = Setting::where('option_name', 'front_theme')->first();
                $fronttheme->option_value = $request->front_theme;
                $fronttheme->save();
            }
        }

        // Blog Base
        $blogbase = Setting::where('option_name', 'blog_base')->first();
        if (!$blogbase) {
            Setting::create([
                'option_name' => 'blog_base',
                'option_value' => $request->blog_base,
            ]);
        } else {
            if (isset($request->blog_base)) {
                $blogbase->option_value = $request->blog_base;
            } else {
                $blogbase->option_value = null;
            }
            $blogbase->save();
        }

        // Category Base
        $category = Setting::where('option_name', 'category_base')->first();
        if (!$category) {
            Setting::create([
                'option_name' => 'category_base',
                'option_value' => $request->category_base,
            ]);
        } else {
            if (isset($request->category_base)) {
                $category->option_value = $request->category_base;
            } else {
                $category->option_value = null;
            }
            $category->save();
        }

        // Tag Base
        $tagbase = Setting::where('option_name', 'tag_base')->first();
        if (!$tagbase) {
            Setting::create([
                'option_name' => 'tag_base',
                'option_value' => $request->tag_base,
            ]);
        } else {
            if (isset($request->tag_base)) {
                $tagbase->option_value = $request->tag_base;
            } else {
                $tagbase->option_value = null;
            }
            $tagbase->save();
        }

        // Return
        return redirect()->back()->with('success', __('Site settings was updated successfully!'));
    }
}
