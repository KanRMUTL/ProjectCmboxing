<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot(UrlGenerator $url)
    public function boot()
    {
        Schema::defaultStringLength(191);
        env('APP_ENV') === 'production' ? $url->forceScheme('https') : '' ;// Environment checking
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
