<?php

namespace App\Modules\Stub;

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
        $router->get('/', ['as' => 'stub.index', 'uses' => 'DefaultController@index']);
    }
}
