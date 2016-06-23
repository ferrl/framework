<?php

namespace Ferrl\Contracts\Support\Utils;

interface Breadcrumb
{
    /**
     * Adds a crumb to the path.
     *
     * @param string $title
     * @param string|null $url
     */
    public function addCrumb($title, $url = null);

    /**
     * Renders the crumbs in the configured view.
     *
     * @return string
     */
    public function renderCrumbs();
}
