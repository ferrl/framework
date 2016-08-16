<?php

namespace Ferrl\Contracts\HTML;

interface Input
{
    /**
     * Render field with it's attributes.
     *
     * @param string $name
     * @param string|null $value
     * @param string|null $type
     * @param array $attributes
     * @return string
     */
    public function render($name, $value = null, $type = null, array $attributes = []);
}
