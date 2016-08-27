<?php

namespace Ferrl\Html;

use Illuminate\Support\ViewErrorBag;

class Processable
{
    /**
     * HTML template for tag.
     *
     * @var string
     */
    protected $template;

    /**
     * Return the session error bag.
     *
     * @return ViewErrorBag
     */
    public function errors()
    {
        return session()->get('errors') ?: new ViewErrorBag;
    }

    /**
     * Replaces values on template.
     *
     * @param array $values
     * @return string
     */
    protected function process(array $values = [])
    {
        $template = $this->getTemplate();
        $template = $this->removeUnusedConditionalBlocks($template, $values);
        $template = $this->removeUnusedConditionalFields($template, $values);
        $template = $this->replaceExistingValues($template, $values);

        return $template;
    }

    /**
     * Replace existing values.
     *
     * @param string $template
     * @param array $values
     * @return string
     */
    protected function replaceExistingValues($template, array $values)
    {
        $fields = array_keys($values);

        foreach ($fields as $field) {
            $template = preg_replace('/:has-'.$field.'-(?:begin|end):/', '', $template);
            $template = preg_replace('/:'.$field.':/', $values[$field], $template);
        }

        return $template;
    }

    /**
     * Remove unused blocks.
     *
     * @param string $template
     * @param array $values
     * @return string
     */
    protected function removeUnusedConditionalBlocks($template, array $values)
    {
        $remove = array_diff($this->getConditionalFields($template), array_keys($values));

        foreach ($remove as $item) {
            $pattern = '/:has-'.$item.'-begin:([\s\S]+):has-'.$item.'-end:/U';
            $template = preg_replace($pattern, '', $template);
        }

        return $template;
    }

    /**
     * Remove unused fields.
     *
     * @param string $template
     * @param array $values
     * @return string
     */
    protected function removeUnusedConditionalFields($template, array $values)
    {
        $remove = array_diff($this->getConditionalFields($template), array_keys($values));

        foreach ($remove as $item) {
            $pattern = '/:'.$item.':/U';
            $template = preg_replace($pattern, '', $template);
        }

        return $template;
    }

    /**
     * Get all conditional fields included in the layout.
     *
     * @param string $template
     * @return array
     */
    protected function getConditionalFields($template)
    {
        $pattern = '/:(?!has)([a-z\-]+)(?!end):/U';

        preg_match_all($pattern, $template, $matches);

        return array_pop($matches);
    }

    /**
     * Get current template value.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set a new template value.
     *
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
