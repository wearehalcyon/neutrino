<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;

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
Route::prefix('/id-admin')->middleware('auth')->group(function (){
    Route::get('/', [App\Http\Controllers\Dashboard\IndexController::class, 'index'])->name('dash');
    // Settings
    Route::get('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'index'])->name('dash.site-settings');
    Route::post('/site-settings', [App\Http\Controllers\Dashboard\SiteSettingsController::class, 'update'])->name('dash.site-settings.update');
    // Users
    Route::get('/users', [App\Http\Controllers\Dashboard\UsersController::class, 'index'])->name('dash.users');
    Route::get('/users/edit/{id}', [App\Http\Controllers\Dashboard\UsersController::class, 'edit'])->name('dash.users.edit');
    Route::post('/users/edit/{id}', [App\Http\Controllers\Dashboard\UsersController::class, 'editSave'])->name('dash.users.edit.update');
    Route::get('/users/add', [App\Http\Controllers\Dashboard\UsersController::class, 'add'])->name('dash.users.add');
    Route::post('/users/add', [App\Http\Controllers\Dashboard\UsersController::class, 'addSave'])->name('dash.users.add.save');
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
    Route::get('/menus/items/edit/{id}', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'edit'])->name('dash.menu.items.edit');
    Route::post('/menus/items/edit/{id}', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'editSave'])->name('dash.menu.items.edit.save');
    Route::get('/menus/items/delete/{id}', [App\Http\Controllers\Dashboard\MenuItemsController::class, 'delete'])->name('dash.menu.items.delete');
    //Post Categories
    Route::get('/categories', [App\Http\Controllers\Dashboard\CategoriesController::class, 'index'])->name('dash.categories');
    Route::get('/categories/add', [App\Http\Controllers\Dashboard\CategoriesController::class, 'add'])->name('dash.categories.add');
    Route::post('/categories/add', [App\Http\Controllers\Dashboard\CategoriesController::class, 'addSave'])->name('dash.categories.add.save');
    Route::get('/categories/edit/{id}', [App\Http\Controllers\Dashboard\CategoriesController::class, 'edit'])->name('dash.categories.edit');
    Route::post('/categories/edit/{id}', [App\Http\Controllers\Dashboard\CategoriesController::class, 'editSave'])->name('dash.categories.edit.save');
    Route::get('/categories/delete/{id}', [App\Http\Controllers\Dashboard\CategoriesController::class, 'delete'])->name('dash.categories.delete');
    //Post Tags
    Route::get('/tags', [App\Http\Controllers\Dashboard\TagsController::class, 'index'])->name('dash.tags');
    Route::get('/tags/add', [App\Http\Controllers\Dashboard\TagsController::class, 'add'])->name('dash.tags.add');
    Route::post('/tags/add', [App\Http\Controllers\Dashboard\TagsController::class, 'addSave'])->name('dash.tags.add.save');
    Route::get('/tags/edit/{id}', [App\Http\Controllers\Dashboard\TagsController::class, 'edit'])->name('dash.tags.edit');
    Route::post('/tags/edit/{id}', [App\Http\Controllers\Dashboard\TagsController::class, 'editSave'])->name('dash.tags.edit.save');
    Route::get('/tags/delete/{id}', [App\Http\Controllers\Dashboard\TagsController::class, 'delete'])->name('dash.tags.delete');
    Route::get('/tags/search', [App\Http\Controllers\Dashboard\TagsController::class, 'searchJson'])->name('dash.tags.search');
    // Posts
    Route::get('/posts', [App\Http\Controllers\Dashboard\PostsController::class, 'index'])->name('dash.posts');
    Route::get('/posts/add', [App\Http\Controllers\Dashboard\PostsController::class, 'add'])->name('dash.posts.add');
    Route::post('/posts/add', [App\Http\Controllers\Dashboard\PostsController::class, 'addSave'])->name('dash.posts.add.save');
    Route::get('/posts/edit/{id}', [App\Http\Controllers\Dashboard\PostsController::class, 'edit'])->name('dash.posts.edit');
    Route::post('/posts/edit/{id}', [App\Http\Controllers\Dashboard\PostsController::class, 'editSave'])->name('dash.posts.edit.save');
    Route::get('/posts/delete/{id}', [App\Http\Controllers\Dashboard\PostsController::class, 'delete'])->name('dash.posts.delete');
    Route::get('/posts/quick', [App\Http\Controllers\Dashboard\PostsController::class, 'quickActions'])->name('dash.posts.quickaction');
    Route::get('/posts/duplicate/{id}', [App\Http\Controllers\Dashboard\PostsController::class, 'duplicate'])->name('dash.posts.duplicate');
    // Pages
    Route::get('/pages', [App\Http\Controllers\Dashboard\PageController::class, 'index'])->name('dash.pages');
    Route::get('/pages/add', [App\Http\Controllers\Dashboard\PageController::class, 'add'])->name('dash.pages.add');
    Route::post('/pages/add', [App\Http\Controllers\Dashboard\PageController::class, 'addSave'])->name('dash.pages.add.save');
    Route::get('/pages/edit/{id}', [App\Http\Controllers\Dashboard\PageController::class, 'edit'])->name('dash.pages.edit');
    Route::post('/pages/edit/{id}', [App\Http\Controllers\Dashboard\PageController::class, 'editSave'])->name('dash.pages.edit.save');
    Route::get('/pages/delete/{id}', [App\Http\Controllers\Dashboard\PageController::class, 'delete'])->name('dash.pages.delete');
    Route::get('/pages/quick', [App\Http\Controllers\Dashboard\PageController::class, 'quickActions'])->name('dash.pages.quickaction');
    Route::get('/pages/duplicate/{id}', [App\Http\Controllers\Dashboard\PageController::class, 'duplicate'])->name('dash.pages.duplicate');
    // File Manager
    Route::get('/filemanager', [App\Http\Controllers\Dashboard\FilemanagerController::class, 'index'])->name('dash.fm');
    //Comments
    Route::get('/comments', [App\Http\Controllers\Dashboard\CommentController::class, 'index'])->name('dash.comments');
    Route::get('/comments/update/{id}', [App\Http\Controllers\Dashboard\CommentController::class, 'update'])->name('dash.comments.update');
    // Appearance
    Route::get('/themes', [App\Http\Controllers\Dashboard\AppearanceController::class, 'themes'])->name('dash.themes');
    Route::post('/themes/activate/{theme}', [App\Http\Controllers\Dashboard\AppearanceController::class, 'themesActivate'])->name('dash.themes.activate');
    Route::post('/themes/delete/{theme}', [App\Http\Controllers\Dashboard\AppearanceController::class, 'themesDelete'])->name('dash.themes.delete');
    Route::post('/themes/upload', [App\Http\Controllers\Dashboard\AppearanceController::class, 'themesUpload'])->name('dash.themes.upload');
    // Site Custommize
    Route::get('/customize', [App\Http\Controllers\Dashboard\AppearanceController::class, 'customize'])->name('dash.customize');
    Route::post('/customize', [App\Http\Controllers\Dashboard\AppearanceController::class, 'customizeSave'])->name('dash.customize.save');
    // Contact Forms
    Route::get('/contact-forms', [App\Http\Controllers\Dashboard\ContactFormsController::class, 'index'])->name('dash.c-forms');
    Route::get('/contact-forms/add', [App\Http\Controllers\Dashboard\ContactFormsController::class, 'add'])->name('dash.c-forms.add');
    Route::post('/contact-forms/add', [App\Http\Controllers\Dashboard\ContactFormsController::class, 'addSave'])->name('dash.c-forms.add.save');
    Route::get('/contact-forms/edit/{id}', [App\Http\Controllers\Dashboard\ContactFormsController::class, 'edit'])->name('dash.c-forms.edit');
    Route::post('/contact-forms/edit/{id}', [App\Http\Controllers\Dashboard\ContactFormsController::class, 'editSave'])->name('dash.c-forms.edit.save');
    // Contact Forms Database
    Route::get('/contact-forms/database', [App\Http\Controllers\Dashboard\ContactFormsDatabaseController::class, 'index'])->name('dash.c-forms-db');
    Route::get('/contact-forms/database/{id}-{uid}', [App\Http\Controllers\Dashboard\ContactFormsDatabaseController::class, 'view'])->name('dash.c-forms-db.view');
    Route::get('/contact-forms/database/delete/{id}-{uid}', [App\Http\Controllers\Dashboard\ContactFormsDatabaseController::class, 'delete'])->name('dash.c-forms-db.delete');
    Route::get('/contact-forms/database/mark-unread/{id}-{uid}', [App\Http\Controllers\Dashboard\ContactFormsDatabaseController::class, 'markUnread'])->name('dash.c-forms-db.mark-unread');
});

// Pages
Route::prefix('/')->group(function () {
    $blogBase = Setting::where('option_name', 'blog_base')->first();
    $blogBase = $blogBase->option_value;

    $catBase = Setting::where('option_name', 'category_base')->first();
    $catBase = $catBase->option_value;

    $tagBase = Setting::where('option_name', 'tag_base')->first();
    $tagBase = $tagBase->option_value;

    Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('pages.home');
    Route::get('/{slug}', [App\Http\Controllers\Front\PageController::class, 'internal'])->name('pages.internal');
    Route::get('/' . $blogBase, [App\Http\Controllers\Front\BlogController::class, 'post'])->name('pages.blog');
    Route::get('/' . $blogBase . '/{post}', [App\Http\Controllers\Front\BlogController::class, 'post'])->name('pages.blog.post');
    Route::get('/' . $catBase, [App\Http\Controllers\Front\BlogController::class, 'category'])->name('pages.blog.category');
    Route::get('/' . $tagBase, [App\Http\Controllers\Front\BlogController::class, 'tag'])->name('pages.blog.tag');
});
// Contact Forms
Route::post('/c-form-submit-{form_id}-{name}-{unique_id}', [App\Http\Controllers\Front\ContactFormController::class, 'submit'])->name('c-form.submit');
