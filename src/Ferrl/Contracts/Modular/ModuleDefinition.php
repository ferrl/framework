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

    /**
     * Set laravel's container instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function setApp($app);

    /**
     * Set name of the module.
     *
     * @param string $name
     */
    public function setName($name);
}
