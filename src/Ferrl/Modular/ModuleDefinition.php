<?php

namespace Ferrl\Modular;

use Ferrl\Contracts\Modular\ModuleDefinition as ModuleDefinitionContract;

class ModuleDefinition implements ModuleDefinitionContract
{
    /**
     * Name of the module.
     *
     * @var string
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
     * @return bool
     */
    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
    }
}
