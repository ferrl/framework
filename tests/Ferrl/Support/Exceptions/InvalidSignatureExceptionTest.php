<?php

namespace tests\Ferrl\Modular\Exceptions;

use Ferrl\Support\Exceptions\InvalidSignatureException;
use RuntimeException;
use tests\TestCase;

class InvalidSignatureExceptionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = InvalidSignatureException::class;

    /**
     * Entity under test must be an runtime exception.
     */
    public function testIsAnException()
    {
        $this->assertTrue($this->getReflection()->newInstance() instanceof RuntimeException);
    }
}
