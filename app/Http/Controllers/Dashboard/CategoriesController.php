<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $categories = Category::orderBy('name', 'ASC')->paginate(20);

        return view('dashboard.page-categories', compact('routeName', 'categories'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-categories-add', compact('routeName'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('dash.categories')->with('success', 'Category was created successfully!');
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $category = Category::find($id);

        return view('dashboard.page-categories-edit', compact('routeName', 'category'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('dash.categories')->with('success', 'Category was updated successfully!');
    }

    public function delete($id)
    {
        restrictAccess([4,5]);

        Category::find($id)->delete();

        return redirect()->route('dash.categories')->with('success', 'Category was deleted successfully!');
    }
}
