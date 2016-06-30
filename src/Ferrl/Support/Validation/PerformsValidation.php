<?php

namespace Ferrl\Support\Validation;

use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

/**
 * @property MessageBag errorBag
 */
trait PerformsValidation
{
    /**
     * Throws validation errors.
     *
     * @throws ValidationException
     */
    protected function throwValidationException()
    {
        $request = request();
        $validator = app(Validator::class)->make([], []);

        throw new ValidationException($validator, $this->buildFailedValidationResponse(
            $request, $this->formatValidationErrors()
        ));
    }

    /**
     * Adds a new error to the error bag.
     *
     * @param string $field
     * @param string $message
     */
    protected function addValidationError($field, $message)
    {
        $this->errorBag->add($field, $message);
    }

    /**
     * Return an error response.
     *
     * @param Request $request
     * @param array $errors
     * @return Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (($request->ajax() && ! $request->pjax()) || $request->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return redirect()->to($this->getRedirectUrl())
            ->withInput($request->input())
            ->withErrors($errors, 'default');
    }

    /**
     * Return errors as an array.
     *
     * @return array
     */
    protected function formatValidationErrors()
    {
        return $this->errorBag->getMessages();
    }

    /**
     * Get previous url link.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return app(UrlGenerator::class)->previous();
    }

    /**
     * Return true if there is errors in the bag.
     *
     * @return bool
     */
    protected function hasErrors()
    {
        return (bool) $this->errorBag->count();
    }
}
