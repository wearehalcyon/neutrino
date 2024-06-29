<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostToCategory;
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

        $posts = Post::paginate(20);

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

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        $thumbID = time();

        $post = Post::create([
            'name' => $request->name,
            'slug' => $slug,
            'author_id' => $request->author_id,
            'status' => $request->status,
            'content' => $request->content,
        ]);
        $post->thumbnail = Auth::id() . '/' . $thumbID . '_' . $request->thumbnail;
        $post->save();

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
            $fileName = $thumbID . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/' . Auth::id()), $fileName);
        }

        return redirect()->route('dash.posts.edit', $post->id)->with('success', __('Post was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $categories = Category::orderBy('name', 'ASC')->get();
        $users = User::orderBy('name', 'ASC')->get();
        $post = Post::find($id);

        if ($post->delayed_date) {
            $delay = date('Y-m-d\TH:i:s', strtotime($post->delayed_date));
        } else {
            $delay = null;
        }

        return view('dashboard.page-posts-edit', compact('routeName', 'categories', 'users', 'post', 'delay'));
    }



    public function delete($id)
    {
        Post::find($id)->delete();

        return redirect()->route('dash.posts')->with('success', __('Post was deleted successfully!'));
    }
}
