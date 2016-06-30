<?php

namespace Ferrl\Support\Models;

use ReflectionClass;

trait Presentable
{
    /**
     * Returns the presenter instance.
     *
     * @return Presenter
     */
    public function present()
    {
        if (isset($this->presenter)) {
            if (! isset($this->presenterInstance)) {
                $this->presenterInstance = (new ReflectionClass($this->presenter))
                    ->newInstanceArgs([$this]);
            }

            return $this->presenterInstance;
        }

        return;
    }
}
