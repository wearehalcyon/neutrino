<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class MenuItemsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $items = MenuItem::paginate(20);

        $menus = Menu::all();

        return view('dashboard.page-menu-items', compact('routeName', 'items', 'menus'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $menus = Menu::all();

        return view('dashboard.page-menu-items-add', compact('routeName', 'menus'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        if ($request->type == 1) {
            $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        } else {
            $slug = null;
        }

        $item = MenuItem::create([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $slug,
            'custom_class' => $request->custom_class,
            'author_id' => Auth::id(),
            'menu_id' => $request->menu_id,
            'target' => $request->target ? 1 : null,
            'url' => $request->url
        ]);

        return redirect()->route('dash.menu.items.edit', $item->id)->with('success', __('Menu item was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $item = MenuItem::find($id);

        $menus = Menu::all();

        return view('dashboard.page-menu-items-edit', compact('routeName', 'item', 'menus'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $item = MenuItem::find($id);
        $item->name = $request->name;
        $item->type = $request->type;
        if ($request->type == 1) {
            $item->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
            $item->url = null;
        } else {
            $item->slug = null;
            $item->url = $request->url;
        }
        $item->custom_class = $request->custom_class;
        $item->menu_id = $request->menu_id;
        $item->target = $request->target ? 1 : null;
        $item->save();

        return redirect()->back()->with('success', __('Menu item was updated successfully!'));
    }

    public function delete($id)
    {
        MenuItem::find($id)->delete();

        return redirect()->route('dash.menu.items')->with('success', __('Menu item was deleted successfully!'));
    }
}
