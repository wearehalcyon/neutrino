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

        $slug = Str::slug($request->name);
        $tag = Tag::where('slug', $slug)->first();
        if ($tag) {
            $count = 2;

            while (Tag::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }

            $finalSlug = $slug . '-' . $count;
        } else {
            $finalSlug = $slug;
        }

        Tag::create([
            'name' => $request->name,
            'slug' => $finalSlug,
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

        $slug = Str::slug($request->name);
        $tag = Tag::where('slug', $slug)->first();
        if ($tag) {
            $count = 2;

            while (Tag::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }

            $finalSlug = $slug . '-' . $count;
        } else {
            $finalSlug = $slug;
        }

        $category = Tag::find($id);
        $category->name = $request->name;
        $category->slug = $finalSlug;
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
