<?php

namespace Ferrl\Contracts\Modular;

use Ferrl\Support\Exceptions\InvalidSignatureException;
use Ferrl\Support\Exceptions\ModuleNotFoundException;

interface ModuleLoader
{
    /**
     * Start all module loader logic.
     *
     * @throws InvalidSignatureException configured module does'nt implement the right interface
     * @throws ModuleNotFoundException configured module does'nt exists
     * @return void
     */
    public function bootstrap();
}
