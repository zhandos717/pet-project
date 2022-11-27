<?php

namespace App\Core;

use App\Di\Container;
use Exception;

class Route
{
    public static array $routes = [];

    public static function GET($uri, $callback)
    {
        self::$routes[$uri] = $callback;
    }

    public static function POST($uri, $callback)
    {
        self::$routes[$uri] = $callback;
    }

    /**
     * @throws Exception
     */
    public static function execute(Container $container)
    {
        [$uri] = explode('?', $_SERVER['REQUEST_URI']);

        if (!isset(self::$routes[$uri])) {
            throw new  Exception('not found');
        }

        if (is_callable(self::$routes[$uri])) {
            self::$routes[$uri]();
        }

        if (is_array(self::$routes[$uri])) {
            [$controller, $method] = self::$routes[$uri];

            if (!$container->has($controller)) {
                (new $controller())->$method();
            }
            $container->get($controller, $method);
        }
    }
}
