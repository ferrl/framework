<?php

namespace tests\Ferrl\HTML;

use Ferrl\Contracts\HTML\Input as InputContract;
use Ferrl\Contracts\Modular\ModuleLoader as ModuleLoaderContract;
use Ferrl\HTML\Bootstrap4\Input;
use Ferrl\HTML\HtmlServiceProvider;
use Mockery;
use tests\TestCase;

class HtmlServiceProviderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = HtmlServiceProvider::class;

    /**
     * Parameters used to instantiate class under test.
     *
     * @return array
     */
    protected function constructorArgs()
    {
        return [app()];
    }

    /**
     * register must bind default module loader.
     */
    public function testRegisterBindsModuleLoader()
    {
        $this->invokeInaccessibleMethod('register');

        $this->assertInstanceOf(Input::class, app(InputContract::class));
    }
}
