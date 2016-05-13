<?php

namespace Ferrl\Contracts\Modular;

interface ModuleDefinition
{
    /**
     * ModuleDefinition constructor.
     *
     * @param string $module
     */
    public function __construct($module);

    /**
     * Bootstrap a new module.
     *
     * @return bool
     */
    public function bootstrap();
}
