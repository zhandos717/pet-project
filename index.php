<?php

use App\Di\Container;
use  App\Kernel;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/helpers.php';

$app = new Kernel();
$app->setContainer(new Container());
$app->handle();