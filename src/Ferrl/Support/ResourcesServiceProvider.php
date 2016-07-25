<?php

namespace Ferrl\Support;

use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(resource_path('emails'), 'emails');
        $this->loadViewsFrom(resource_path('layouts'), 'layouts');
    }
}
