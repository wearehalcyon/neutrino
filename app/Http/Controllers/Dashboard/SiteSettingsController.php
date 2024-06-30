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
            if (isset($request->site_name)) {
                $debugBar = Setting::where('option_name', 'site_name')->first();
                $debugBar->option_value = $request->site_name;
                $debugBar->save();
            } else {
                $debugBar = Setting::where('option_name', 'site_name')->first();
                $debugBar->option_value = null;
                $debugBar->save();
            }
        }

        // Site URL
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'site_url',
                'option_value' => $request->site_url,
            ]);
        } else {
            if (isset($request->site_url)) {
                $debugBar = Setting::where('option_name', 'site_url')->first();
                $debugBar->option_value = $request->site_url;
                $debugBar->save();
            } else {
                $debugBar = Setting::where('option_name', 'site_url')->first();
                $debugBar->option_value = null;
                $debugBar->save();
            }
        }

        // Site Description
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'site_description',
                'option_value' => $request->site_description,
            ]);
        } else {
            if (isset($request->site_description)) {
                $debugBar = Setting::where('option_name', 'site_description')->first();
                $debugBar->option_value = $request->site_description;
                $debugBar->save();
            } else {
                $debugBar = Setting::where('option_name', 'site_description')->first();
                $debugBar->option_value = null;
                $debugBar->save();
            }
        }

        // Posts Per Page
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'posts_per_page',
                'option_value' => $request->posts_per_page,
            ]);
        } else {
            if (isset($request->posts_per_page)) {
                $debugBar = Setting::where('option_name', 'posts_per_page')->first();
                $debugBar->option_value = $request->posts_per_page;
                $debugBar->save();
            } else {
                $debugBar = Setting::where('option_name', 'posts_per_page')->first();
                $debugBar->option_value = null;
                $debugBar->save();
            }
        }

        // Debug Bar
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'debug_bar',
                'option_value' => 1,
            ]);
        } else {
            if (isset($request->debug_bar)) {
                $debugBar = Setting::where('option_name', 'debug_bar')->first();
                $debugBar->option_value = 1;
                $debugBar->save();
            } else {
                $debugBar = Setting::where('option_name', 'debug_bar')->first();
                $debugBar->option_value = 0;
                $debugBar->save();
            }
        }

        // Set Homepage
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'homepage_id',
                'option_value' => $request->homepage_id,
            ]);
        } else {
            if (isset($request->homepage_id)) {
                $debugBar = Setting::where('option_name', 'homepage_id')->first();
                $debugBar->option_value = $request->homepage_id;
                $debugBar->save();
            }
        }

        // Set front theme
        if (!getOption('front_theme')) {
            Setting::create([
                'option_name' => 'front_theme',
                'option_value' => $request->front_theme,
            ]);
        } else {
            if (isset($request->front_theme)) {
                $debugBar = Setting::where('option_name', 'front_theme')->first();
                $debugBar->option_value = $request->front_theme;
                $debugBar->save();
            }
        }

        // Mailer Type
//        if (isset($request->mailer_type)) {
//            $debugBar = Setting::where('option_name', 'mailer_type')->first();
//            $debugBar->option_value = $request->mailer_type;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_type')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Host
//        if (isset($request->mailer_host)) {
//            $debugBar = Setting::where('option_name', 'mailer_host')->first();
//            $debugBar->option_value = $request->mailer_host;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_host')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Port
//        if (isset($request->mailer_port)) {
//            $debugBar = Setting::where('option_name', 'mailer_port')->first();
//            $debugBar->option_value = $request->mailer_port;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_port')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Username
//        if (isset($request->mailer_username)) {
//            $debugBar = Setting::where('option_name', 'mailer_username')->first();
//            $debugBar->option_value = $request->mailer_username;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_username')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Password
//        if (isset($request->mailer_password)) {
//            $debugBar = Setting::where('option_name', 'mailer_password')->first();
//            $debugBar->option_value = $request->mailer_password;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_password')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Encryption
//        if (isset($request->mailer_encryption)) {
//            $debugBar = Setting::where('option_name', 'mailer_encryption')->first();
//            $debugBar->option_value = 1;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_encryption')->first();
//            $debugBar->option_value = 0;
//            $debugBar->save();
//        }
//
//        // Mailer Sender Email
//        if (isset($request->mailer_sender_address)) {
//            $debugBar = Setting::where('option_name', 'mailer_sender_address')->first();
//            $debugBar->option_value = $request->mailer_sender_address;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_sender_address')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }
//
//        // Mailer Message Title
//        if (isset($request->mailer_title)) {
//            $debugBar = Setting::where('option_name', 'mailer_title')->first();
//            $debugBar->option_value = $request->mailer_title;
//            $debugBar->save();
//        } else {
//            $debugBar = Setting::where('option_name', 'mailer_title')->first();
//            $debugBar->option_value = null;
//            $debugBar->save();
//        }

        // Return
        return redirect()->back()->with('success', __('Site settings was updated successfully!'));
    }
}
