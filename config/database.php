<?php

return [
    'migrations'=>[
        'path'=> ROOT_PATH. '/database/migrations/'
    ],
    'default'=> env('DB_CONNECTION'),

    'sqlite'=>[
        'path'=> ROOT_PATH .'/database/database.sqlite',
    ],
];
