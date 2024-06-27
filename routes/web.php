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
    Route::get('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'index'])->name('dash.site-settings');
    Route::post('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'update'])->name('dash.site-settings.update');
});

// Front
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
