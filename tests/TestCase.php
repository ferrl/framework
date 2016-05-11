<?php

namespace tests;

use PHPUnit_Framework_TestCase;
use ReflectionClass;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Defines class/interface/trait under test.
     *
     * @var string
     */
    protected $underTest;

    /**
     * Get reflection from class under test.
     */
    public function getReflection()
    {
        $underTest = $this->underTest;

        return new ReflectionClass($underTest);
    }
}
