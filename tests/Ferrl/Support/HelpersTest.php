<?php

namespace tests\Ferrl\Modular\Exceptions;

use Helpers;
use tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * registry must return the fallback value if the key does'nt exist.
     */
    public function testRegistryReturnsDefaultValue()
    {
        $value = Helpers\registry('something.inexistent', 'default value');

        $this->assertEquals('default value', $value);
    }

    /**
     * registry must set a new key value if the key is an associative array.
     */
    public function testRegistryUpdateValues()
    {
        Helpers\registry(['key' => 'overridden value']);
        Helpers\registry(['key' => 'current value']);
        $value = Helpers\registry('key', 'default value');

        $this->assertEquals('current value', $value);
    }

    /**
     * registry must return all keys if a null parameter is passed.
     */
    public function testRegistryReturnAllValues()
    {
        Helpers\registry(['key1' => 'value1']);
        Helpers\registry(['key2' => 'value2']);
        $values = Helpers\registry();

        $this->assertArrayHasKey('key1', $values);
        $this->assertArrayHasKey('key2', $values);
    }

    /**
     * globals works as a alias to registry.
     */
    public function testReturnAllValues()
    {
        Helpers\registry(['key1' => 'value1']);
        Helpers\registry(['key2' => 'value2']);
        $values = Helpers\globals();

        $this->assertArrayHasKey('key1', $values);
        $this->assertArrayHasKey('key2', $values);
    }
}
