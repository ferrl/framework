<?php

namespace Ferrl\Modular;

use Ferrl\Contracts\Modular\ModuleLoader as ModuleLoaderContract;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var ModuleLoaderContract $loader */
        $loader = $this->app->make(ModuleLoaderContract::class);
        $loader->bootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ModuleLoaderContract::class, function () {
            return new ModuleLoader;
        });
    }
}
