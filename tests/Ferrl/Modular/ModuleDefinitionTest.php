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
}
