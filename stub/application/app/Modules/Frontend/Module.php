<?php

namespace App\Modules\Frontend;

use Ferrl\Modular\ModuleDefinition;
use Illuminate\Routing\Router;

class Module extends ModuleDefinition
{
    /**
     * Bind application routes.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function bindRoutes(Router $router)
    {
        $router->get('/', ['as' => 'frontend.index', 'uses' => 'DefaultController@index']);
    }
}
