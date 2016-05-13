<?php

namespace tests\Ferrl\Modular\Exceptions;

use Ferrl\Support\Exceptions\ModuleNotFoundException;
use RuntimeException;
use tests\TestCase;

class ModuleNotFoundExceptionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModuleNotFoundException::class;

    /**
     * Entity under test must be an runtime exception.
     */
    public function testIsAnException()
    {
        $this->assertTrue($this->getReflection()->newInstance() instanceof RuntimeException);
    }
}
