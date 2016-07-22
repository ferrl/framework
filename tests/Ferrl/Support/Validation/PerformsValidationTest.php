<?php

namespace tests\Ferrl\Support\Validation;

use App\Http\Controllers\ValidationController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use tests\TestCase;

class PerformsValidationTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = ValidationController::class;

    /**
     * Class under test must be instantiable.
     */
    public function testIsInstantiable()
    {
        $this->assertInstanceOf(ValidationController::class, $this->getReflection()->newInstance());
    }

    /**
     * hasErrors must inform if there are errors.
     */
    public function testCheckIfThereAreErrors()
    {
        $this->assertFalse($this->invokeInaccessibleMethod('hasErrors'));
    }

    /**
     * addValidationError must add an error to the bag.
     */
    public function testAddsNewErrorToTheMessageBag()
    {
        $this->invokeInaccessibleMethod('addValidationError', ['field', 'Message']);
        $this->assertTrue($this->invokeInaccessibleMethod('hasErrors'));
    }

    /**
     * formatValidationErrors must return errors as an array.
     */
    public function testFormatsErrorsAsAnArray()
    {
        $this->invokeInaccessibleMethod('addValidationError', ['field', 'Message']);
        $this->assertInternalType('array', $this->invokeInaccessibleMethod('formatValidationErrors'));
    }

    /**
     * getRedirectUrl must return previous accessed url.
     */
    public function testPreviousUrlIsGenerated()
    {
        $this->assertEquals('http://localhost', $this->invokeInaccessibleMethod('getRedirectUrl'));
    }

    /**
     * buildFailedValidationResponse must return an JSON response if the request was ajax call.
     */
    public function testBuildJsonResponseWhenAjax()
    {
        /** @var Request $request */
        $request = app(Request::class);
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');

        $response = $this->invokeInaccessibleMethod('buildFailedValidationResponse', [$request, []]);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * buildFailedValidationResponse must return an redirect response otherwise.
     */
    public function testBuildRedirectResponse()
    {
        /** @var Request $request */
        $request = app(Request::class);

        /** @var RedirectResponse $response */
        $response = $this->invokeInaccessibleMethod('buildFailedValidationResponse', [$request, []]);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertInstanceOf(ViewErrorBag::class, $response->getSession()->get('errors'));
    }

    /**
     * throwValidationException must throw the exception.
     * @expectedException \Illuminate\Validation\ValidationException
     */
    public function testThrowsValidationError()
    {
        $this->invokeInaccessibleMethod('throwValidationException');
    }

    /**
     * valid must throw the exception on when invalid.
     * @expectedException \Illuminate\Validation\ValidationException
     */
    public function testThrowsValidationErrorOnlyWhenInvalid()
    {
        $this->assertTrue($this->invokeInaccessibleMethod('valid'));
        $this->invokeInaccessibleMethod('addValidationError', ['field', 'Message']);
        $this->assertFalse($this->invokeInaccessibleMethod('valid', [false]));
        $this->invokeInaccessibleMethod('valid');
    }
}
