<?php

namespace tests\Ferrl\Modular;

use Ferrl\Modular\ModuleLoader;
use Ferrl\Contracts\Modular\ModuleLoader as ModuleLoaderContract;
use Ferrl\Modular\ModuleServiceProvider;
use Mockery;
use tests\TestCase;

class ModuleServiceProviderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleServiceProvider::class;

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

        $this->assertInstanceOf(ModuleLoader::class, app(ModuleLoaderContract::class));
    }

    /**
     * boot must bootstrap module loader.
     */
    public function testBootMustBootstrapLoader()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\Modular\ModuleLoader');
        $mock->shouldReceive('bootstrap')->once()->andReturnNull();

        $this->app->singleton(ModuleLoaderContract::class, function () use ($mock) {
            return $mock;
        });

        $this->invokeInaccessibleMethod('boot');
    }
}
