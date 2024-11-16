<?php

namespace App\Providers;

use Illuminate\Support\Facades\View; // Pastikan ini diimpor dari Illuminate\Support\Facades\View
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });

        DB::listen(function ($query) {
            Log::info("Query executed: " . $query->sql, $query->bindings);
        });
    }
}
