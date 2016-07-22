<?php

namespace tests\Ferrl\Support\Models;

use App\Models\PresentableModel;
use Ferrl\Support\Models\Presenter;
use tests\TestCase;

class PresentableTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = PresentableModel::class;

    /**
     * Class under test must be instantiable.
     */
    public function testIsInstantiable()
    {
        $this->assertInstanceOf(PresentableModel::class, $this->getReflection()->newInstance());
    }

    /**
     * present must return a presenter class.
     */
    public function testCanBePresented()
    {
        $this->assertInstanceOf(Presenter::class, $this->invokeInaccessibleMethod('present'));
    }
}
