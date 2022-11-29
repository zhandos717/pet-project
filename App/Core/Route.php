<?php

namespace App\Core;

use App\Di\Container;
use Exception;

class Route
{
    public static array $routes = [];

    public static function GET($uri, $action): void
    {
        self::$routes[$uri] = [
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function POST($uri, $action): void
    {
        self::$routes[$uri] = [
            'action' => $action,
            'method' => 'POST'
        ];
    }

    /**
     * @throws Exception
     */
    public static function execute(Container $container): void
    {
        [$uri] = explode('?', $_SERVER['REQUEST_URI']);

        if (!isset(self::$routes[$uri])) {
            throw new  Exception('Ошибка 404');
        }

        if ($_SERVER['REQUEST_METHOD'] != self::$routes[$uri]['method']) {
            throw new  Exception('Ошибка 405. Метод не поддерживается!');
        }

        if (is_callable(self::$routes[$uri]['action'])) {
            self::$routes[$uri]['action']();
        }

        if (is_array(self::$routes[$uri]['action'])) {
            [$controller, $method] = self::$routes[$uri]['action'];

            if (!$container->has($controller)) {
                (new $controller())->$method();
            }
            $container->get($controller, $method);
        }
    }
}
