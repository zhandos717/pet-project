<?php

const APP_PATH = __DIR__;
const ROOT_PATH = APP_PATH . '/../';
const VIEW_PATH = APP_PATH . '/Views/';
require 'helpers.php';


spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});
