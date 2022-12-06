<?php

use App\Core\Kernel;
use App\Di\Container;

require __DIR__ . '/../app/init.php';

$app = new Kernel();
$app->setContainer(new Container());
$app->handle();


