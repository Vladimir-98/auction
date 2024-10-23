<?php

namespace App\Providers;

use App\Facades\Telegram;
use App\Telegram\Bot\Factory;
use Illuminate\Support\Facades\URL;
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
        if (app()->environment('local')) {
            URL::forceScheme('https');
        }

        $this->app->bind(Telegram::class, function ()
        {
            return new Factory();
        });
    }
}
