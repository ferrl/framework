<?php

namespace tests\Ferrl\Modular;

use Ferrl\Modular\ModuleLoader;
use tests\TestCase;

class ModuleLoaderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleLoader::class;

    /**
     * Tests if entity under test is instantiable.
     */
    public function testIsAnInterface()
    {
        $this->assertTrue($this->getReflection()->isInstantiable());
    }
}
