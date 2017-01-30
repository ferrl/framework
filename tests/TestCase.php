<?php

namespace tests;

use App\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;
use ReflectionClass;

abstract class TestCase extends LaravelTestCase
{
    /**
     * Defines class/interface/trait under test.
     *
     * @var string
     */
    protected $underTest;

    /**
     * Keeps a instance of the class/interface/trait under test.
     *
     * @var string
     */
    protected $underTestInstance;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = new Application(__DIR__.'/../stub/application/');
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Parameters used to instantiate class under test.
     *
     * @return array
     */
    protected function constructorArgs()
    {
        return [];
    }

    /**
     * Get reflection from class under test.
     *
     * @return ReflectionClass
     */
    public function getReflection()
    {
        $underTest = $this->underTest;

        return new ReflectionClass($underTest);
    }

    /**
     * Invoke an inaccessible (private/protected) method.
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    protected function invokeInaccessibleMethod($method, array $params = [])
    {
        $reflection = $this->getReflection();

        if (! $this->underTestInstance) {
            $this->underTestInstance = $reflection->newInstanceArgs($this->constructorArgs());

            if (method_exists($this, 'constructorHooks')) {
                $this->constructorHooks($this->underTestInstance);
            }
        }

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($this->underTestInstance, $params);
    }
}
