<?php

use App\Di\Container;
use  App\Kernel;

require __DIR__ . '/../app/init.php';

$app = new Kernel();
$app->setContainer(new Container());
$app->handle();


