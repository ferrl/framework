<?php

namespace tests\Ferrl\Contracts\Modular;

use Ferrl\Contracts\Modular\ModuleNotFoundException;
use RuntimeException;
use tests\TestCase;

class ModuleNotFoundExceptionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleNotFoundException::class;

    /**
     * Tests if entity under test is an interface.
     */
    public function testIsAnException()
    {
        $this->assertTrue($this->getReflection()->newInstance() instanceof RuntimeException);
    }
}
