<?php

return [
    'defaults' => [
        'guard' => 'PengelolaBumdes',
        'passwords' => 'users',
    ],

    'guards' => [
        'PengelolaBumdes' => [
            'driver' => 'session',
            'provider' => 'PengelolaBumdes',
        ],

        'KepalaKeluarga' => [
            'driver' => 'session',
            'provider' => 'KepalaKeluarga',
        ],
    ],


    'providers' => [
        'PengelolaBumdes' => [
            'driver' => 'eloquent',
            'model' => App\Models\PengelolaBumdes::class,
        ],

        'KepalaKeluarga' => [
            'driver' => 'eloquent',
            'model' => App\Models\KepalaKeluarga::class,
        ],

    ],


    'passwords' => [
        'PengelolaBumdes' => [
            'provider' => 'PengelolaBumdes',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'KepalaKeluarga' => [
            'provider' => 'KepalaKeluarga',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
