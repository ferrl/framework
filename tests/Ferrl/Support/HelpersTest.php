<?php

namespace tests\Ferrl\Modular\Exceptions;

use Ferrl\Contracts\Support\Utils\Breadcrumb as BreadcrumbContract;
use Ferrl\Support\Utils\Breadcrumb;
use Illuminate\View\Factory as View;
use tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * Example of ferrl configuration.
     *
     * @var array|null
     */
    protected $ferrl = null;

    /**
     * Setup module configuration file.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        /* @noinspection PhpIncludeInspection */
        $this->ferrl = require realpath(__DIR__.'/../../../stub/tests/ferrl.php');

        /** @var View $factory */
        $factory = app(View::class);
        $factory->addNamespace('layouts', realpath(__DIR__.'/../../../stub/application/resources/layouts'));

        config(['ferrl' => $this->ferrl]);
    }

    /**
     * registry must return the fallback value if the key does'nt exist.
     */
    public function testRegistryReturnsDefaultValue()
    {
        $value = registry('something.inexistent', 'default value');

        $this->assertEquals('default value', $value);
    }

    /**
     * registry must set a new key value if the key is an associative array.
     */
    public function testRegistryUpdateValues()
    {
        registry(['key' => 'overridden value']);
        registry(['key' => 'current value']);
        $value = registry('key', 'default value');

        $this->assertEquals('current value', $value);
    }

    /**
     * registry must return all keys if a null parameter is passed.
     */
    public function testRegistryReturnAllValues()
    {
        registry(['key1' => 'value1']);
        registry(['key2' => 'value2']);
        $values = registry();

        $this->assertArrayHasKey('key1', $values);
        $this->assertArrayHasKey('key2', $values);
    }

    /**
     * globals works as a alias to registry.
     */
    public function testGlobalsReturnAllValues()
    {
        registry(['key1' => 'value1']);
        registry(['key2' => 'value2']);
        $values = globals();

        $this->assertArrayHasKey('key1', $values);
        $this->assertArrayHasKey('key2', $values);
    }

    /**
     * globals works as a alias to registry.
     */
    public function testBreadcrumbHelpers()
    {
        $this->app->singleton(BreadcrumbContract::class, function () {
            return new Breadcrumb();
        });

        add_breadcrumb('First', 'first.html');
        add_breadcrumb('Second', 'second.html');

        $crawler = new \DOMDocument;
        $crawler->loadHTML(render_breadcrumb());

        $this->assertEquals(1, $crawler->getElementsByTagName('ul')->length);
        $this->assertEquals(2, $crawler->getElementsByTagName('li')->length);
    }
}
