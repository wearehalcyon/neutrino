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
    Route::get('/users/edit', [App\Http\Controllers\Dashboard\UsersController::class, 'editAccount'])->name('dash.users.edit-account');
    Route::post('/users/edit', [App\Http\Controllers\Dashboard\UsersController::class, 'editAccountSave'])->name('dash.users.edit-account.update');
    // User roles
    Route::get('/users/roles', [App\Http\Controllers\Dashboard\UserRolesController::class, 'index'])->name('dash.users-roles');
});

// Front
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
