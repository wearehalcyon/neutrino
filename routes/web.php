<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dahboard
Route::prefix('/dashboard')->middleware('auth')->group(function (){
    Route::get('/', [App\Http\Controllers\Dashboard\IndexController::class, 'index'])->name('dash');
    // Settings
    Route::get('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'index'])->name('dash.site-settings');
    Route::post('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'update'])->name('dash.site-settings.update');
    // Users
    Route::get('/users', [App\Http\Controllers\Dashboard\UsersController::class, 'index'])->name('dash.users');
    Route::get('/users/edit/{id}', [App\Http\Controllers\Dashboard\UsersController::class, 'edit'])->name('dash.users.edit');
    Route::post('/users/edit/{id}', [App\Http\Controllers\Dashboard\UsersController::class, 'editSave'])->name('dash.users.edit.update');
    Route::get('/users/add', [App\Http\Controllers\Dashboard\UsersController::class, 'add'])->name('dash.users.edit-account.add');
    Route::post('/users/add', [App\Http\Controllers\Dashboard\UsersController::class, 'addSave'])->name('dash.users.edit-account.add.save');
    Route::delete('/users/delete/{id}', [App\Http\Controllers\Dashboard\UsersController::class, 'delete'])->name('dash.users.delete');
    // User roles
    Route::get('/users/roles', [App\Http\Controllers\Dashboard\UserRolesController::class, 'index'])->name('dash.users-roles');
    Route::get('/users/roles/add', [App\Http\Controllers\Dashboard\UserRolesController::class, 'add'])->name('dash.users-roles.add');
    // Menus
    Route::get('/menus', [App\Http\Controllers\Dashboard\MenuController::class, 'index'])->name('dash.menus');
    Route::get('/menus/add', [App\Http\Controllers\Dashboard\MenuController::class, 'add'])->name('dash.menus.add');
    Route::post('/menus/add', [App\Http\Controllers\Dashboard\MenuController::class, 'addSave'])->name('dash.menus.add.save');
    Route::get('/menus/edit/{id}', [App\Http\Controllers\Dashboard\MenuController::class, 'edit'])->name('dash.menus.edit');
    Route::post('/menus/edit/{id}', [App\Http\Controllers\Dashboard\MenuController::class, 'editSave'])->name('dash.menus.edit.save');
    Route::get('/menus/delete/{id}', [App\Http\Controllers\Dashboard\MenuController::class, 'delete'])->name('dash.menus.delete');
    // Menu Items
    Route::get('/menus/items', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'index'])->name('dash.menu.items');
    Route::get('/menus/items/add', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'add'])->name('dash.menu.items.add');
    Route::post('/menus/items/add', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'addSave'])->name('dash.menu.items.add.save');
    Route::get('/menus/items/edit/{id}', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'add'])->name('dash.menu.items.edit');
});

// Front
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
