<?php

namespace App\Providers;

use App\Models\AppData;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share app data to all views
        View::composer('*', function ($view) {
            $appData = AppData::first();
            $view->with('appData', $appData);
        });
    }
}
