<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function index()
    {

    }

    public function errorConnection()
    {
        return view('errors.db-connection');
    }
}
