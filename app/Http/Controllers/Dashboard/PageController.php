<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageMeta;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $pages = Page::orderBy('created_at', 'DESC')->paginate(20);

        return view('dashboard.page-pages', compact('routeName', 'pages'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $users = User::orderBy('name', 'ASC')->get();

        return view('dashboard.page-pages-add', compact('routeName', 'users'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $page = Page::create([
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'author_id' => $request->author_id,
            'status' => $request->status,
            'content' => $request->content,
            'delayed_date' => $request->delayed_date,
            'template' => $request->template,
        ]);

        // Set Homepage
        if ($request->homepage_id) {
            $homepage = Setting::where('option_name', 'homepage_id')->first();

            if ($homepage) {
                $homepage->option_value = $request->homepage_id;
            } else {
                Setting::create([
                    'option_name' => 'homepage_id',
                    'option_value' => $page->id
                ]);
            }
        }

        // Add SEO meta fields
        if ($request->seo_title) {
            PageMeta::create([
                'page_id' => $page->id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title,
            ]);
        }
        if ($request->seo_slug) {
            PageMeta::create([
                'page_id' => $page->id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug,
            ]);
        }
        if ($request->meta_description) {
            PageMeta::create([
                'page_id' => $page->id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description,
            ]);
        }

        return redirect()->route('dash.pages.edit', $page->id)->with('success', __('Page was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $page = Page::find($id);
        $users = User::orderBy('name', 'ASC')->get();

        if ($page->delayed_date) {
            $delay = date('Y-m-d\TH:i:s', strtotime($page->delayed_date));
        } else {
            $delay = null;
        }

        // Get site front themes
        $frontTheme = getOption('front_theme');
        $directory = resource_path('views/front/' . $frontTheme . '/templates');
        $items = scandir($directory);
        $templates = [];
        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..' && is_file($directory . '/' . $item)) {
                $templates[] = str_replace(['page-', '.blade', '.php'], '', $item);
            }
        }

        return view('dashboard.page-pages-edit', compact('routeName', 'page', 'users', 'delay', 'templates'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $page = Page::find($id);
        $page->name = $request->name;
        $page->content = $request->content;
        $page->author_id = $request->author_id;
        $page->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $page->content = $request->content;
        $page->status = $request->status;
        $page->delayed_date = $request->delayed_date;
        $page->template = $request->template;
        $page->save();

        // Set Homepage
        $homepage = Setting::where('option_name', 'homepage_id')->first();

        if ($request->homepage_id) {
            if ($homepage) {
                $homepage->option_value = $request->homepage_id;
            } else {
                Setting::create([
                    'option_name' => 'homepage_id',
                    'option_value' => $page->id
                ]);
            }
        } else {
            if ($homepage->option_value == $page->id) {
                $homepage->delete();
            }
        }

        // Update SEO meta fields
        $seo_title = PageMeta::where([
            'page_id' => $id,
            'meta_key' => 'seo_title'
        ])->first();
        if ($seo_title) {
            $seo_title->meta_value = $request->seo_title;
        } else {
            PageMeta::create([
                'page_id' => $id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title
            ]);
        }
        $seo_slug = PageMeta::where([
            'page_id' => $id,
            'meta_key' => 'seo_slug'
        ])->first();
        if ($seo_slug) {
            $seo_slug->meta_value = $request->seo_slug;
        } else {
            PageMeta::create([
                'page_id' => $id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug
            ]);
        }
        $meta_description = PageMeta::where([
            'page_id' => $id,
            'meta_key' => 'meta_description'
        ])->first();
        if ($meta_description) {
            $meta_description->meta_value = $request->meta_description;
        } else {
            PageMeta::create([
                'page_id' => $id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description
            ]);
        }

        return redirect()->back()->with('success', __('Page was updated successfully!'));
    }
}
