<?php

namespace Ferrl\HTML\Bootstrap4;

use Ferrl\HTML\Processable;

class Input extends Processable
{
    /**
     * HTML template for text field.
     *
     * @var string
     */
    protected $template = <<<'HTML'
<fieldset class="form-group :validation-class: :group-class:">
    :has-label-begin:<label for=":id:">:label:</label>:has-label-end:
    <input type=":type:" class="form-control :class:" id=":id:" name=":name:" value=":value:" placeholder=":placeholder:">
    :has-help-begin:<small class="text-muted">:help:</small>:has-help-end:
</fieldset>
HTML;

    /**
     * Render field with it's attributes.
     *
     * @param string $name
     * @param string|null $value
     * @param string|null $type
     * @param array $attributes
     * @return string
     */
    public function render($name, $value = null, $type = null, array $attributes = [])
    {
        $merge = [
            'name' => $name,
            'type' => $type ?: 'text',
            'validation-class' => $this->getValidationClassAttribute($name),
            'id' => $this->getIdAttribute($name, $attributes),
            'value' => $this->canRetrieveOldValue($type) ?
                $this->getValueAttribute($name, $value) : null,
        ];

        return $this->process(array_merge($attributes, $merge));
    }

    /**
     * Can retrieve old value or should hide.
     *
     * @param string $type
     * @return bool
     */
    protected function canRetrieveOldValue($type)
    {
        return ! in_array($type, ['password']);
    }

    /**
     * Parse and get ID attribute.
     *
     * @param string $name
     * @param array $attributes
     * @return string
     */
    protected function getIdAttribute($name, array $attributes)
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        return $this->convertArrayToDotNotation($name, '_');
    }

    /**
     * Parse and get value attribute.
     *
     * @param string $name
     * @param string $value
     * @return string
     */
    protected function getValueAttribute($name, $value)
    {
        return old($this->convertArrayToDotNotation($name), $value);
    }

    /**
     * Get validation class based on session errors.
     *
     * @param $name
     * @return string
     */
    protected function getValidationClassAttribute($name)
    {
        if (request()->isMethod('get')) {
            return;
        }

        return $this->errors()->has($this->convertArrayToDotNotation($name))
            ? 'has-error' : 'has-success';
    }

    /**
     * Convert array notation to dot notation.
     *
     * @param string $key
     * @param string $dot
     * @return string
     */
    protected function convertArrayToDotNotation($key, $dot = '.')
    {
        return preg_replace('/\[([A-z\-]+)\]/U', $dot.'$1', $key);
    }
}
