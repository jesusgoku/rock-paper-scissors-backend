<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\GameService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\GameService', function ($app) {
            return new GameService();
        });
    }
}
