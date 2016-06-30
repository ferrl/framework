<?php

namespace Ferrl\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Presenter {
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Presenter constructor.
     * 
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttribute($key)
    {
        if ($this->hasGetMutator($key)) {
            return $this->mutateAttribute($key);
        }

        return $this->model->$key;
    }

    /**
     * Get the value of an attribute using its mutator.
     *
     * @param string $key
     * @return mixed
     */
    protected function mutateAttribute($key)
    {
        return $this->{'get'.Str::studly($key)}();
    }

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param string $key
     * @return bool
     */
    protected function hasGetMutator($key)
    {
        return method_exists($this, 'get'.Str::studly($key));
    }

    /**
     * Dynamically retrieve attributes on the presenter.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }
}
