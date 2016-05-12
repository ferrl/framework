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
    public function testIsInstantiable()
    {
        $this->assertTrue($this->getReflection()->isInstantiable());
    }

    public function testCanGetListOfModules()
    {
        // setup test
//        $modules = ['default'];
//        config(['modules.available' => $modules]);
//        $reflection = $this->getReflection();
//        $reflection->getMethod('getModulesList')->setAccessible(true);
//
//        $this->assertEquals($modules, $reflection->getMethod('getModulesList')->invoke(new $this->underTest));
    }
}
