<?php

namespace tests\Ferrl\Contracts\Modular;

use Ferrl\Contracts\Modular\ModuleDefinition;
use tests\TestCase;

class ModuleDefinitionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleDefinition::class;

    /**
     * Entity under test must be an interface.
     */
    public function testIsAnInterface()
    {
        $this->assertTrue($this->getReflection()->isInterface());
    }
}
