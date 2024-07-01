<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CommentController extends Controller
{
    public function index()
    {
        restrictAccess([3,4,5]);

        $routeName = Route::currentRouteName();

        $comments = Comment::orderBy('created_at', 'ASC')->paginate(20);

        return view('dashboard.page-comments', compact('routeName', 'comments'));
    }
}
