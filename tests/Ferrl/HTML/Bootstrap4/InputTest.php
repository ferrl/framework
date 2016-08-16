<?php

namespace tests\Ferrl\HTML;

use Ferrl\Html\Bootstrap4\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use tests\TestCase;

class InputTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = Input::class;

    /**
     * Setup request session.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        request()->setMethod('post');
        request()->setSession(app('Illuminate\Session\Store'));
    }

    /**
     * convertArrayToDotNotation should remove array notation.
     */
    public function testConvertArrayToDotNotation()
    {
        $this->assertEquals('athletes.name.contains', $this->invokeInaccessibleMethod('convertArrayToDotNotation', ['athletes[name][contains]']));
        $this->assertEquals('athletes_name_contains', $this->invokeInaccessibleMethod('convertArrayToDotNotation', ['athletes[name][contains]', '_']));
    }

    /**
     * canRetrieveOldValue defines if value must be filled.
     */
    public function testPasswordShouldNotHaveValueFilled()
    {
        $this->assertTrue($this->invokeInaccessibleMethod('canRetrieveOldValue', ['text']));
        $this->assertTrue($this->invokeInaccessibleMethod('canRetrieveOldValue', ['email']));
        $this->assertTrue($this->invokeInaccessibleMethod('canRetrieveOldValue', ['tel']));
        $this->assertTrue($this->invokeInaccessibleMethod('canRetrieveOldValue', ['number']));
        $this->assertFalse($this->invokeInaccessibleMethod('canRetrieveOldValue', ['password']));
    }

    /**
     * getIdAttribute builds correct id from name.
     */
    public function testBuildsIdAttributeFromName()
    {
        $this->assertEquals('athlete', $this->invokeInaccessibleMethod('getIdAttribute', ['athlete', []]));
        $this->assertEquals('athlete_name', $this->invokeInaccessibleMethod('getIdAttribute', ['athlete[name]', []]));
        $this->assertEquals('athlete_name_contains', $this->invokeInaccessibleMethod('getIdAttribute', ['athlete[name][contains]', []]));
        $this->assertEquals('joker', $this->invokeInaccessibleMethod('getIdAttribute', ['athlete', ['id' => 'joker']]));
        $this->assertEquals('athlete', $this->invokeInaccessibleMethod('getIdAttribute', ['joker', ['id' => 'athlete']]));
    }

    /**
     * getValueAttribute request value takes precedence over passed value.
     */
    public function testBuildValueFromValueOrRequest()
    {
        $this->assertEquals('athlete', $this->invokeInaccessibleMethod('getValueAttribute', ['name', 'athlete']));
        request()->session()->set('_old_input', ['name' => 'joker']);
        $this->assertEquals('joker', $this->invokeInaccessibleMethod('getValueAttribute', ['name', 'athlete']));
    }

    /**
     * getValidationClassAttribute return class based on error bag.
     */
    public function testBuildValidationClassFromRequest()
    {
        /** @var ViewErrorBag $errors */
        $errors = session()->get('errors') ?: new ViewErrorBag;
        $errors->put('default', new MessageBag);
        $errors->add('email', 'Not a valid e-mail address');

        request()->session()->set('errors', $errors);
        $this->assertEquals('has-success', $this->invokeInaccessibleMethod('getValidationClassAttribute', ['name']));
        $this->assertEquals('has-error', $this->invokeInaccessibleMethod('getValidationClassAttribute', ['email']));

        request()->setMethod('get');
        $this->assertEmpty($this->invokeInaccessibleMethod('getValidationClassAttribute', ['namee']));
    }

    /**
     * render full text field.
     */
    public function testRendersAnInputTextField()
    {
        $expected = <<<'HTML'
<fieldset class="form-group has-success margin-top">
    <label for="athlete_name">Name</label>
    <input type="text" class="form-control no-border-radius" id="athlete_name" name="athlete[name]" value="@ferrl" placeholder="Enter your full name" required>
    <small class="text-muted">No abbreviations</small>
</fieldset>
HTML;
        $actual = $this->invokeInaccessibleMethod('render', ['athlete[name]', '@ferrl', 'text', ['class' => 'no-border-radius', 'group-class' => 'margin-top', 'placeholder' => 'Enter your full name', 'help' => 'No abbreviations', 'label' => 'Name', 'required']]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * render full password field.
     */
    public function testRendersAnInputPasswordField()
    {
        $expected = <<<'HTML'
<fieldset class="form-group has-success margin-top">
    <label for="athlete_password">Password</label>
    <input type="password" class="form-control no-border-radius" id="athlete_password" name="athlete[password]" value="" placeholder="Enter your password" required>
    <small class="text-muted">Must contain at least one special character</small>
</fieldset>
HTML;
        $actual = $this->invokeInaccessibleMethod('render', ['athlete[password]', '@ferrl', 'password', ['class' => 'no-border-radius', 'group-class' => 'margin-top', 'placeholder' => 'Enter your password', 'help' => 'Must contain at least one special character', 'label' => 'Password', 'required']]);

        $this->assertEquals($expected, $actual);
    }
}
