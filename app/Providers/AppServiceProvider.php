<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\YoutubeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(YoutubeService::class, function ($app) {
            $yt = new YoutubeService();
            return $yt;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
