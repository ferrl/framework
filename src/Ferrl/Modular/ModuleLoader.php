<?php

namespace Ferrl\Modular;

use Doctrine\Common\Inflector\Inflector;
use Ferrl\Contracts\Modular\ModuleDefinition as ModuleDefinitionContract;
use Ferrl\Contracts\Modular\ModuleLoader as ModuleLoaderContract;
use Ferrl\Support\Exceptions\InvalidSignatureException;
use Ferrl\Support\Exceptions\ModuleNotFoundException;

class ModuleLoader implements ModuleLoaderContract
{
    /**
     * Laravel's container instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * ModuleLoader constructor.
     */
    public function __construct()
    {
        $this->app = app();
    }

    /**
     * Start all module loader logic.
     *
     * @throws InvalidSignatureException configured module does'nt implement the right interface
     * @throws ModuleNotFoundException configured module does'nt exists
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->getModulesList() as $module) {
            $this->enableModule($module);
        }
    }

    /**
     * Get list from all modules from a config file.
     *
     * @return string[]
     */
    protected function getModulesList()
    {
        $modules = config('modules.available');
        ksort($modules);

        return array_values($modules);
    }

    /**
     * Get fully qualified module class name.
     *
     * @param string $module
     * @return string
     */
    protected function getFullyQualifiedModuleClassName($module)
    {
        $inflector = new Inflector();

        return config('modules.namespace').'\\'.$inflector->classify($module);
    }

    /**
     * Load a single module by it's name.
     *
     * @param string $module
     * @throws InvalidSignatureException module does'nt implement the right interface
     * @throws ModuleNotFoundException module does'nt exists
     * @return bool
     */
    protected function enableModule($module)
    {
        $definition = $this->getFullyQualifiedModuleClassName($module);

        if (! (class_exists($definition) || $this->app->bound($definition))) {
            throw new ModuleNotFoundException("Module {$definition} does'nt exist");
        }

        /** @var ModuleDefinitionContract $module */
        $module = $this->app->make($definition, [$module]);

        if (! $module instanceof ModuleDefinitionContract) {
            throw new InvalidSignatureException("Class {$definition} must implements ModuleDefinition interface");
        }

        return $module->bootstrap();
    }
}
