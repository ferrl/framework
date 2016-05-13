<?php

namespace Ferrl\Modular;

use Ferrl\Contracts\Modular\ModuleDefinition as ModuleDefinitionContract;

class ModuleDefinition implements ModuleDefinitionContract
{
    /**
     * Name of the module.
     *
     * @var string $name
     */
    protected $name;

    /**
     * ModuleDefinition constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Bootstrap a new module.
     *
     * @return boolean
     */
    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
    }
}
