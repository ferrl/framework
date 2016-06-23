<?php

namespace Helpers;

if (! function_exists('add_breadcrumb')) {
    /**
     * Adds a new crumb to a default breadcrumb.
     *
     * @param string $title
     * @param string|null $url
     */
    function add_breadcrumb($title, $url = null)
    {
        /** @var \Ferrl\Contracts\Support\Utils\Breadcrumb $breadcrumb */
        $breadcrumb = app()->make(\Ferrl\Contracts\Support\Utils\Breadcrumb::class);
        $breadcrumb->addCrumb($title, $url);
    }
}

if (! function_exists('globals')) {
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

if (! function_exists('registry')) {
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

if (! function_exists('render_breadcrumbs')) {
    /**
     * Renders the default breadcrumb.
     *
     * @return string
     */
    function render_breadcrumb()
    {
        /** @var \Ferrl\Contracts\Support\Utils\Breadcrumb $breadcrumb */
        $breadcrumb = app()->make(\Ferrl\Contracts\Support\Utils\Breadcrumb::class);
        return $breadcrumb->renderCrumbs();
    }
}
