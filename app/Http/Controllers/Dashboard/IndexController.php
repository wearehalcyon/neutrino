<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $routeName = Route::currentRouteName();

        $posts = Post::paginate(5);
        $pages = Page::paginate(5);
        $comments = Comment::paginate(5);
        $categories = Category::paginate(5);

        return view('dashboard.page-index', compact('routeName', 'posts', 'comments', 'categories', 'pages'));
    }
}
