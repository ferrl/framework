<?php

namespace Ferrl\Contracts\Modular;

interface ModuleDefinition
{
    /**
     * Bootstrap a new module.
     *
     * @return bool
     */
    public function bootstrap();
}
