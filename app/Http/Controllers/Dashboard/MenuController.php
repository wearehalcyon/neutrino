<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $menus = Menu::paginate(20);

        return view('dashboard.page-menus', compact('routeName', 'menus'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-menus-add', compact('routeName'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'author_id' => Auth::id()
        ]);

        return redirect()->route('dash.menus.edit', $menu->id)->with('success', __('Menu was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $menu = Menu::find($id);

        return view('dashboard.page-menus-edit', compact('routeName', 'menu'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->back()->with('success', __('Menu was updated successfully!'));
    }

    public function delete($id)
    {
        restrictAccess([4,5]);

        Menu::find($id)->delete();

        return redirect()->route('dash.menus')->with('success', __('Menu was deleted successfully!'));
    }
}
