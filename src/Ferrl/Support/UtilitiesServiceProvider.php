<?php

namespace Ferrl\Support;

use Ferrl\Contracts\Support\Utils\Breadcrumb as BreadcrumbContract;
use Ferrl\Support\Utils\Breadcrumb;
use Ferrl\Support\Utils\FlashMessages;
use Illuminate\Support\ServiceProvider;

class UtilitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../stub/tests/ferrl.php' => config_path('ferrl.php'),
        ], 'ferrl');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BreadcrumbContract::class, function () {
            return new Breadcrumb();
        });

        $this->app->singleton(FlashMessages::class, function () {
            return new FlashMessages;
        });
    }
}
