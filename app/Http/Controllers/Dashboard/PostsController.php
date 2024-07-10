<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContentMeta;
use App\Models\PostToCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $posts = Post::orderBy('created_at', 'DESC')->paginate(20);;

        return view('dashboard.page-posts', compact('routeName', 'posts'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $users = User::orderBy('name', 'ASC')->get();

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('dashboard.page-posts-add', compact('routeName', 'users', 'categories'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        $post = Post::create([
            'name' => $request->name,
            'slug' => $slug,
            'author_id' => $request->author_id,
            'status' => $request->status,
            'content' => $request->content,
            'delayed_date' => $request->delayed_date,
        ]);

        if ($request->category_id) {
            foreach ($request->category_id as $category_id) {
                PostToCategory::create([
                    'post_id' => $post->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        // Upload thumbnail to the public/uploads/ID path
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
            $post->thumbnail = 'uploads/' . $request->thumbnail;
            $post->save();
        }

        // Add SEO meta fields
        if ($request->seo_title) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title,
                'type' => 'post'
            ]);
        }
        if ($request->seo_slug) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug,
                'type' => 'post'
            ]);
        }
        if ($request->meta_description) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description,
                'type' => 'post'
            ]);
        }

        return redirect()->route('dash.posts.edit', $post->id)->with('success', __('Post was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $categories = Category::orderBy('name', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();
        $users = User::orderBy('name', 'ASC')->get();
        $post = Post::find($id);

        if ($post->delayed_date) {
            $delay = date('Y-m-d\TH:i:s', strtotime($post->delayed_date));
        } else {
            $delay = null;
        }

        return view('dashboard.page-posts-edit', compact('routeName', 'categories', 'tags', 'users', 'post', 'delay'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        $existingPages = Post::where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();

        if ($existingPages->count() > 0) {
            while (Post::where('slug', $slug)->where('id', '<>', $id)->exists()) {
                $slug = $baseSlug . '-' . $next;
                $next++;
            }
        }

        $post = Post::find($id);
        $post->name = $request->name;
        $post->content = $request->content;
        $post->author_id = $request->author_id;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->delayed_date = $request->delayed_date;
        $post->created_at = $request->created_at;
        $post->save();

        $categories = PostToCategory::where('post_id', $id)->delete();

        if ($request->category_id) {
            foreach ($request->category_id as $category_id) {
                PostToCategory::create([
                    'post_id' => $post->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        // Upload thumbnail to the public/uploads/ID path
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
            $post->thumbnail = 'uploads/' . $request->thumbnail;
            $post->save();
        }

        if (!$request->thumbnail) {
            $post->thumbnail = null;
            $post->save();
        }

        // Update SEO meta fields
        $seo_title = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'seo_title'
        ])->first();
        if ($seo_title) {
            $seo_title->meta_value = $request->seo_title;
            $seo_title->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title
            ]);
        }
        $seo_slug = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'seo_slug'
        ])->first();
        if ($seo_slug) {
            $seo_slug->meta_value = $request->seo_slug;
            $seo_slug->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug
            ]);
        }
        $meta_description = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'meta_description'
        ])->first();
        if ($meta_description) {
            $meta_description->meta_value = $request->meta_description;
            $meta_description->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description
            ]);
        }

        return redirect()->back()->with('success', __('Post was updated successfully!'));
    }

    public function delete($id)
    {
        Post::find($id)->delete();

        return redirect()->route('dash.posts')->with('success', __('Post was deleted successfully!'));
    }
}
