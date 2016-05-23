<?php

namespace tests\Ferrl\Modular;

use Ferrl\Modular\ModuleLoader;
use Mockery;
use tests\TestCase;

class ModuleLoaderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleLoader::class;

    /**
     * Example of modules configuration.
     *
     * @var array|null
     */
    protected $modules = null;

    /**
     * Setup module configuration file.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        /* @noinspection PhpIncludeInspection */
        $this->modules = require realpath(__DIR__.'/../../../stub/tests/modules.php');

        config(['modules' => $this->modules]);
    }

    /**
     * Class under test must be instantiable.
     */
    public function testIsInstantiable()
    {
        $this->assertInstanceOf(ModuleLoader::class, $this->getReflection()->newInstance());
    }

    /**
     * getModulesList must return an array.
     */
    public function testListOfModulesIsAnArray()
    {
        $actual = $this->invokeInaccessibleMethod('getModulesList');

        $this->assertInternalType('array', $actual);
    }

    /**
     * getModulesList must have prioritized the array.
     */
    public function testListOfModulesIsPrioritized()
    {
        $actual = $this->invokeInaccessibleMethod('getModulesList');

        $this->assertEquals(['frontend', 'other'], $actual);
    }

    /**
     * getFullyQualifiedModuleClassName must return class name with base namespace.
     */
    public function testFullyQualifiedNameIsCorrect()
    {
        $actual = $this->invokeInaccessibleMethod('getFullyQualifiedModuleClassName', ['frontend']);

        $this->assertEquals('App\\Modules\\Frontend', $actual);
    }

    /**
     * enableModule must enable module by it's name.
     */
    public function testSuccessfullyBootsExistingModule()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\Modular\ModuleDefinition');
        $mock->shouldReceive('bootstrap')->once()->andReturn(true);
        $this->app->instance('App\\Modules\\Frontend', $mock);

        $actual = $this->invokeInaccessibleMethod('enableModule', ['frontend']);

        $this->assertTrue($actual);
    }

    /**
     * enableModule must fail to load nonexistent module.
     *
     * @expectedException \Ferrl\Support\Exceptions\ModuleNotFoundException
     * @expectedExceptionMessage Module App\Modules\Nonexistent does'nt exist
     */
    public function testThrowsSemanticExceptionWhenModuleDoesNotExists()
    {
        $this->invokeInaccessibleMethod('enableModule', ['nonexistent']);
    }

    /**
     * enableModule must fail to load module with wrong signature.
     *
     * @expectedException \Ferrl\Support\Exceptions\InvalidSignatureException
     * @expectedExceptionMessage Class App\Modules\Frontend must implements ModuleDefinition interface
     */
    public function testThrowsSemanticExceptionWhenModuleDoesNotImplementRightInterface()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\Modular\WrongModuleDefinition');
        $this->app->instance('App\\Modules\\Frontend', $mock);

        $this->invokeInaccessibleMethod('enableModule', ['frontend']);
    }

    /**
     * bootstrap must run smoothly for existing methods.
     */
    public function testRunsSmoothlyForExistingMethods()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\Modular\ModuleDefinition');
        $mock->shouldReceive('bootstrap')->twice()->andReturn(true);
        $this->app->instance('App\\Modules\\Frontend', $mock);
        $this->app->instance('App\\Modules\\Other', $mock);

        $this->invokeInaccessibleMethod('bootstrap');
    }
}
