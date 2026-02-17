<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        // Share random categories for the navbar collections
        // Using a view composer or sharing with all views
        \Illuminate\Support\Facades\View::composer('additions.navbar', function ($view) {
            $view->with('navbarCategories', \App\Models\Category::where('parent_id', null)->inRandomOrder()->take(8)->get());
        });
    }
}
