<?php

namespace tests\Ferrl\Html;

use Ferrl\Contracts\Html\Input as InputContract;
use Ferrl\Html\Bootstrap4\Input;
use Ferrl\Html\HtmlServiceProvider;
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
