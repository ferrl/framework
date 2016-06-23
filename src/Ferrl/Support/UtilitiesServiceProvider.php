<?php

namespace Ferrl\Support;

use Ferrl\Contracts\Support\Utils\Breadcrumb as BreadcrumbContract;
use Ferrl\Support\Utils\Breadcrumb;
use Illuminate\Support\ServiceProvider;

class UtilitiesServiceProvider extends ServiceProvider
{
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
    }
}
