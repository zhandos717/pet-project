<?php

use App\Core\Kernel;
use App\Di\Container;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/helpers.php';

$app = new Kernel();
$app->setContainer(new Container());
$app->handle();