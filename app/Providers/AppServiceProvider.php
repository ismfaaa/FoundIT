<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// untuk otomatis pake bootstrap di pagination ver laravel
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Supaya {{ $items->links() }} otomatis pakai desain Bootstrap 5
        Paginator::useBootstrapFive();
    }
}
