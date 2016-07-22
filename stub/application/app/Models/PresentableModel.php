<?php

namespace App\Models;

use App\Models\Presenters\ModelPresenter;
use Ferrl\Support\Models\Presentable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string first_name
 * @property string last_name
 */
class PresentableModel extends Model
{
    use Presentable;

    /**
     * Model presenter.
     * @var \Ferrl\Support\Models\Presenter
     */
    protected $presenter = ModelPresenter::class;
}
