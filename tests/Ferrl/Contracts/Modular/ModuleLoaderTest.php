<?php

namespace tests\Ferrl\Contracts\Modular;

use Ferrl\Contracts\Modular\ModuleLoader;
use tests\TestCase;

class ModuleLoaderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleLoader::class;

    /**
     * Entity under test must be an interface.
     */
    public function testIsAnInterface()
    {
        $this->assertTrue($this->getReflection()->isInterface());
    }
}
