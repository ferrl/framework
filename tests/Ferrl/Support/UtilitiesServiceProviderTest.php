<?php

namespace tests\Ferrl\Support;

use Ferrl\Contracts\Support\Utils\Breadcrumb as BreadcrumbContract;
use Ferrl\Support\UtilitiesServiceProvider;
use Ferrl\Support\Utils\Breadcrumb;
use tests\TestCase;

class UtilitiesServiceProviderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = UtilitiesServiceProvider::class;

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

        $this->assertInstanceOf(Breadcrumb::class, app(BreadcrumbContract::class));
    }
}
