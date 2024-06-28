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

        $categories = Tag::paginate(20);

        return view('dashboard.page-tags', compact('routeName', 'categories'));
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

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('dash.tags')->with('success', 'Category was created successfully!');
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $category = Tag::find($id);

        return view('dashboard.page-tags-edit', compact('routeName', 'category'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $category = Tag::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('dash.tags')->with('success', 'Category was updated successfully!');
    }
}
