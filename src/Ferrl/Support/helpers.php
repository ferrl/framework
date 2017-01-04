<?php

if (! function_exists(__NAMESPACE__.'\\add_breadcrumb')) {
    /**
     * Adds a new crumb to a default breadcrumb.
     *
     * @param string $title
     * @param string|null $url
     * @return \Ferrl\Contracts\Support\Utils\Breadcrumb
     */
    function add_breadcrumb($title, $url = null)
    {
        return breadcrumb()->addCrumb($title, $url);
    }
}

if (! function_exists(__NAMESPACE__.'\\breadcrumb')) {
    /**
     * Return a breadcrumb instance.
     *
     * @return \Ferrl\Contracts\Support\Utils\Breadcrumb
     */
    function breadcrumb()
    {
        return app()->make(\Ferrl\Contracts\Support\Utils\Breadcrumb::class);
    }
}

if (! function_exists(__NAMESPACE__.'\\flashes')) {
    /**
     * Get the flashes singleton instance.
     *
     * @return \Ferrl\Support\Utils\FlashMessages
     */
    function flashes()
    {
        return app(\Ferrl\Support\Utils\FlashMessages::class);
    }
}

if (! function_exists(__NAMESPACE__.'\\globals')) {
    /**
     * Alias to the registry function.
     *
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed
     */
    function globals($key = null, $default = null)
    {
        return registry($key, $default);
    }
}

if (! function_exists(__NAMESPACE__.'\\registry')) {
    /**
     * Handles global variables in a controlled namespace.
     *
     * @param string|null $key
     * @param mixed|null  $default
     * @return mixed
     */
    function registry($key = null, $default = null)
    {
        if (is_string($key)) {
            $key = 'registry.'.$key;
        } elseif (is_array($key)) {
            foreach ($key as $index => $value) {
                $key['registry.'.$index] = $value;
                unset($key[$index]);
            }
        } elseif (is_null($key)) {
            $key = 'registry';
        }

        return config($key, $default);
    }
}

if (! function_exists(__NAMESPACE__.'\\render_breadcrumbs')) {
    /**
     * Renders the default breadcrumb.
     *
     * @return string
     */
    function render_breadcrumb()
    {
        return breadcrumb()->renderCrumbs();
    }
}
