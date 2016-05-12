<?php

namespace Ferrl\Modular;

use Ferrl\Contracts\Modular\ModuleLoader as ModuleLoaderContract;
use Ferrl\Contracts\Modular\ModuleNotFoundException;

class ModuleLoader implements ModuleLoaderContract
{
    /**
     * Start all module loader logic.
     *
     * @throws ModuleNotFoundException
     * @return void
     */
    public function run()
    {
        $modules = $this->getModulesList();
    }

    /**
     * Get list from all modules from a config file.
     *
     * @return string[]
     */
    protected function getModulesList()
    {
        return config('modules.available');
    }
}
