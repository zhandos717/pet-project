<?php

return [
    'default'    => env('DB_CONNECTION'),
    'migrations' => [
        'path' => ROOT_PATH . '/database/migrations/'
    ],
    'sqlite'     => [
        'path' => ROOT_PATH . 'database/database.sqlite',
    ],
    'mysql'      => [
        'host'     => env('DB_HOST'),
        'port'     => env('DB_PORT'),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
    ]
];
