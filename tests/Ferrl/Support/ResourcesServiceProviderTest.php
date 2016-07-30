<?php

namespace tests\Ferrl\Support;

use Ferrl\Support\ResourcesServiceProvider;
use tests\TestCase;

class ResourcesServiceProviderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ResourcesServiceProvider::class;

    /**
     * Parameters used to instantiate class under test.
     *
     * @return array
     */
    protected function constructorArgs()
    {
        return [app()];
    }

    /**
     * register must bind default module loader.
     */
    public function testRegisterBindsModuleLoader()
    {
        $this->invokeInaccessibleMethod('register');

        $this->assertArrayHasKey('emails', view()->getFinder()->getHints());
        $this->assertArrayHasKey('layouts', view()->getFinder()->getHints());
    }
}
