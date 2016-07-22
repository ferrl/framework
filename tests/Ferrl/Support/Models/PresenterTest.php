<?php

namespace tests\Ferrl\Support\Models;

use App\Models\PresentableModel;
use App\Models\Presenters\ModelPresenter;
use Ferrl\Support\Models\Presenter;
use tests\TestCase;

class PresenterTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ModelPresenter::class;

    /**
     * Parameters used to instantiate class under test.
     *
     * @return array
     */
    protected function constructorArgs()
    {
        $presentable = new PresentableModel;
        $presentable->first_name = 'Lucas';
        $presentable->last_name = 'F C';

        return [$presentable];
    }

    /**
     * __get must return formatted name.
     */
    public function testFormatsFullName()
    {
        $this->assertEquals('Lucas', $this->invokeInaccessibleMethod('__get', ['first_name']));
        $this->assertEquals('F C', $this->invokeInaccessibleMethod('__get', ['last_name']));
        $this->assertEquals('Lucas F C', $this->invokeInaccessibleMethod('__get', ['full_name']));
    }
}
