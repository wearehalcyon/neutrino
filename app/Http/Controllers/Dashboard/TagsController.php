<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $tags = Tag::paginate(20);

        return view('dashboard.page-tags', compact('routeName', 'tags'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-tags-add', compact('routeName'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Tag::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('dash.tags')->with('success', 'Tag was created successfully!');
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $tag = Tag::find($id);

        return view('dashboard.page-tags-edit', compact('routeName', 'tag'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        $existingPages = Tag::where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();

        if ($existingPages->count() > 0) {
            while (Tag::where('slug', $slug)->where('id', '<>', $id)->exists()) {
                $slug = $baseSlug . '-' . $next;
                $next++;
            }
        }

        $category = Tag::find($id);
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('dash.tags')->with('success', 'Tag was updated successfully!');
    }

    public function delete($id)
    {
        restrictAccess([4,5]);

        Tag::find($id)->delete();

        return redirect()->route('dash.tags')->with('success', 'Tag was deleted successfully!');
    }
}
