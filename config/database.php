<?php

return [
    'default'    => env('DB_CONNECTION'),
    'migrations' => [
        'path' => root_path() . '/database/migrations/'
    ],
    'sqlite'     => [
        'path' => root_path() . 'database/database.sqlite',
    ],
    'mysql'      => [
        'host'     => env('DB_HOST'),
        'port'     => env('DB_PORT'),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
    ]
];
