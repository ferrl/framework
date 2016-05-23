<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Modular Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls where the application modules will be locates. The
    | `available` array lists all modules that should be loaded when the
    | service provider boots up. The key from the enabled array determines the
    | priority loading the modules.
    |
    */
    'namespace' => 'App\\Modules',
    'path' => app_path('Modules'),

    'available' => [
        10 => 'other',
        0 => 'frontend',
    ],

];
