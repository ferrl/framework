<?php

namespace Ferrl\HTML;

use Ferrl\Contracts\HTML\Input as InputContract;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(InputContract::class, function () {
            $builder = config('ferrl.html', 'Bootstrap4');
            $builder = 'Ferrl\\HTML\\'.$builder.'\\Input';

            return new $builder;
        });
    }
}
