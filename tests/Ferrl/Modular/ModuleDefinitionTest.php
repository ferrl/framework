<?php

namespace tests\Ferrl\Modular;

use Ferrl\Modular\ModuleDefinition;
use tests\TestCase;

class ModuleDefinitionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleDefinition::class;

    /**
     * Example of modules configuration.
     *
     * @var array|null
     */
    protected $modules = null;

    /**
     * Parameters used to instantiate class under test.
     *
     * @return array
     */
    protected function constructorArgs()
    {
        return (array) 'frontend';
    }

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
     * Class under test must be instantiable with parameter.
     */
    public function testIsInstantiable()
    {
        $this->assertInstanceOf(ModuleDefinition::class, $this->getReflection()->newInstance('default'));
    }

    /**
     * getModulesFolder must return an existing path.
     */
    public function testModulesPathIsCorrect()
    {
        $path = $this->invokeInaccessibleMethod('getModulesFolder');

        $this->assertTrue(file_exists($path));
    }

    /**
     * getModulesNamespace must return the correct namespace.
     */
    public function testModulesNamespaceIsCorrect()
    {
        $namespace = $this->invokeInaccessibleMethod('getModulesNamespace');

        $this->assertEquals('App\\Modules\\Frontend', $namespace);
    }

    /**
     * getModulesPrefix must be all lowercase.
     */
    public function testModulesPrefixIsCorrect()
    {
        $prefix = $this->invokeInaccessibleMethod('getModulesPrefix');

        $this->assertRegExp('/[a-z0-9]+/', $prefix);
    }

    /**
     * loadHelpers must require an helper file.
     */
    public function testCanUseHelperFunctions()
    {
        $this->invokeInaccessibleMethod('loadHelpers');

        $this->assertTrue(function_exists('Frontend\\testMethod'));
    }

    /**
     * loadRoutes must load example routes.
     */
    public function testRoutesWereLoaded()
    {
        /* @var \Illuminate\Routing\Router $router */
        $this->invokeInaccessibleMethod('loadRoutes');
        $router = app(\Illuminate\Routing\Router::class);

        $this->assertTrue($router->has('frontend.index'));
    }

    /**
     * loadViews must adds view namespace.
     */
    public function testViewsWereLoaded()
    {
        /* @var \Illuminate\View\Factory $view */
        $this->invokeInaccessibleMethod('loadViews');
        $view = app(\Illuminate\View\Factory::class);

        $this->assertTrue($view->exists('frontend::index'));
    }

    /**
     * bootstrap must run smoothly for existing methods.
     */
    public function testRunsSmoothlyForExistingMethods()
    {
        $this->invokeInaccessibleMethod('bootstrap');
    }
}
