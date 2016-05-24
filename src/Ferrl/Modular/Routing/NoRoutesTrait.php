<?php

namespace Ferrl\Modular\Routing;

use Illuminate\Routing\Router;

trait NoRoutesTrait
{
    /**
     * Bind application routes.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     * @codeCoverageIgnore
     */
    public function bindRoutes(Router $router)
    {
        //
    }
}
