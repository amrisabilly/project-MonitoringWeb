<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Folder;

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
        // Mengirimkan data $folders ke semua view yang menggunakan layout 'layouts.app'
        View::composer('layouts.app', function ($view) {
            $folders = Folder::all();  // Ambil data folder dari model Folder
            $view->with('folders', $folders);  // Kirimkan data ke view
        });
    }
}
