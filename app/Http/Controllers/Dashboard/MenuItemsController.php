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

        return view('dashboard.page-menu-items', compact('routeName', 'items'));
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
}
