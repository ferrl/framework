<?php

namespace tests\Ferrl\HTML;

use HTML;
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
        $mock = Mockery::mock('Ferrl\HTML\Bootstrap4\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\HTML\Bootstrap4\Input', $mock);

        HTML\input_field('name');
    }

    /**
     * email_field must build a new input field.
     */
    public function testEmailFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\HTML\Bootstrap4\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\HTML\Bootstrap4\Input', $mock);

        HTML\email_field('email');
    }

    /**
     * password_field must build a new input field.
     */
    public function testPasswordFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\HTML\Bootstrap4\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\HTML\Bootstrap4\Input', $mock);

        HTML\password_field('password');
    }

    /**
     * text_field must build a new input field.
     */
    public function testTextFieldCallsRender()
    {
        /** @var Mockery\Mock $mock */
        $mock = Mockery::mock('Ferrl\HTML\Bootstrap4\Input');
        $mock->shouldReceive('render')->once()->andReturn('<input>');
        $this->app->instance('Ferrl\HTML\Bootstrap4\Input', $mock);

        HTML\text_field('name');
    }
}
