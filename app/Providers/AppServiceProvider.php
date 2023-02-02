<?php

namespace App\Providers;

use App\Channels\SMSChannel;
use Illuminate\Support\Facades\Notification;
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
    public function boot(): void
    {
        Notification::extend('sms', function ($app) {
            return new SMSChannel();
        });

        Notification::extend('email', function ($app) {
            return new SMSChannel();
        });
    }
}
