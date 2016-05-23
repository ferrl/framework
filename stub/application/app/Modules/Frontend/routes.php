<?php

/**
 * Example route.
 */
Route::get('/', ['as' => 'frontend.index', 'uses' => function () {
    return ['welcome' => true];
}]);
