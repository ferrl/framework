<?php

namespace App\Models\Presenters;

use App\Models\PresentableModel;
use Ferrl\Support\Models\Presenter;

class ModelPresenter extends Presenter
{
    /**
     * @var PresentableModel
     */
    protected $model;

    /**
     * Get formatted full name.
     * @return string
     */
    public function getFullName()
    {
        return implode(' ', [$this->model->first_name, $this->model->last_name]);
    }
}
