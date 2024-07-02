<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminBarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            echo view('dashboard.partials.admin-bar')->render();
        });
    }

    public function register()
    {
        //
    }
}
