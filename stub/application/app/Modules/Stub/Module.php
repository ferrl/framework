<?php

namespace App\Modules\Stub;

use Ferrl\Modular\ModuleDefinition;
use Illuminate\Contracts\Routing\Registrar;

class Module extends ModuleDefinition
{
    /**
     * Bind application routes.
     *
     * @param Registrar $router
     * @return void
     */
    public function bindRoutes(Registrar $router)
    {
        $router->get('/', ['as' => 'stub.index', 'uses' => 'DefaultController@index']);
    }
}
