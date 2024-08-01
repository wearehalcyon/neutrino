<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActionHooks;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ActionHooks::class, function ($app) {
            return new ActionHooks();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
