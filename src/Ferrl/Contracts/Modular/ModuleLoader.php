<?php

namespace Ferrl\Contracts\Modular;

interface ModuleLoader
{
    /**
     * Start all module loader logic.
     *
     * @throws ModuleNotFoundException
     * @return void
     */
    public function run();
}
