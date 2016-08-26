<?php

namespace Helpers;

if (! function_exists(__NAMESPACE__.'\\input_field')) {
    /**
     * Creates a new input field.
     *
     * @param string $name
     * @param string|null $value
     * @param string|null $type
     * @param array $attributes
     * @return string
     */
    function input_field($name, $value = null, $type = null, $attributes = [])
    {
        /** @var Input $input */
        $input = app(\Ferrl\Contracts\Html\Input::class);

        return $input->render($name, $value, $type, $attributes);
    }
}

if (! function_exists(__NAMESPACE__.'\\email_field')) {
    /**
     * Creates a new email field.
     *
     * @param string $name
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    function email_field($name, $value = null, $attributes = [])
    {
        return input_field($name, $value, 'email', $attributes);
    }
}

if (! function_exists(__NAMESPACE__.'\\password_field')) {
    /**
     * Creates a new password field.
     *
     * @param string $name
     * @param array $attributes
     * @return string
     */
    function password_field($name, $attributes = [])
    {
        return input_field($name, null, 'password', $attributes);
    }
}

if (! function_exists(__NAMESPACE__.'\\text_field')) {
    /**
     * Creates a new text field.
     *
     * @param string $name
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    function text_field($name, $value = null, $attributes = [])
    {
        return input_field($name, $value, 'text', $attributes);
    }
}
