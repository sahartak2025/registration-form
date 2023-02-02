<?php

namespace App\Providers;

use App\Services\InforuSMSService;
use Illuminate\Support\ServiceProvider;

class InfoRuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(InforuSMSService::class, function ($app) {
            return new InforuSMSService(config('external-apis.inforu'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
