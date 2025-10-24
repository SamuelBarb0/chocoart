<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Course;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Compartir datos del footer con todas las vistas
        View::composer('layouts.app', function ($view) {
            $footerProducts = Product::where('published', true)
                ->orderBy('order')
                ->take(4)
                ->get(['name', 'slug', 'icon']);

            $footerCourses = Course::where('published', true)
                ->orderBy('order')
                ->take(4)
                ->get(['title', 'slug']);

            $view->with([
                'footerProducts' => $footerProducts,
                'footerCourses' => $footerCourses,
            ]);
        });
    }
}
