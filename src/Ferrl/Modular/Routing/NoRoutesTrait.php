<?php

namespace Ferrl\Modular\Routing;

use Illuminate\Contracts\Routing\Registrar;

trait NoRoutesTrait
{
    /**
     * Bind application routes.
     *
     * @param Registrar $router
     * @return void
     * @codeCoverageIgnore
     */
    public function bindRoutes(Registrar $router)
    {
        //
    }
}
