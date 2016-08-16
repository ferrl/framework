<?php

namespace tests\Ferrl\HTML;

use Helpers;
use Mockery;
use tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * input_field must build a new input field.
     */
    public function testInputFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\HTML\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\Contracts\HTML\Input', $mock);

        Helpers\input_field('name');
    }

    /**
     * email_field must build a new input field.
     */
    public function testEmailFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\HTML\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\Contracts\HTML\Input', $mock);

        Helpers\email_field('email');
    }

    /**
     * password_field must build a new input field.
     */
    public function testPasswordFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\HTML\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\Contracts\HTML\Input', $mock);

        Helpers\password_field('password');
    }

    /**
     * text_field must build a new input field.
     */
    public function testTextFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\Contracts\HTML\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\Contracts\HTML\Input', $mock);

        Helpers\text_field('name');
    }
}
