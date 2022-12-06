<?php

namespace App\Core;

use App\Di\Container;
use App\Http\Resource\JsonResource;
use Exception;

class Route
{
    public static array $routes = ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'];

    public static array $route = [];

    private static function add(string $method, string $url, $action): void
    {
        $url = ltrim($url, '/');
        $url = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $url);
        $route = '#^' . $url . '$#';
        self::$routes[$method][$route] = [
            'action' => $action
        ];
    }

    public static function get($uri, $action): void
    {
        self::add('GET', $uri, $action);
    }

    public static function delete(string $uri, $action): void
    {
        self::add('DELETE', $uri, $action);
    }

    public static function put($uri, $action): void
    {
        self::add('PUT', $uri, $action);
    }

    public static function post($uri, $action): void
    {
        self::add('POST', $uri, $action);
    }

    /**
     * @throws Exception
     */
    private static function match(): void
    {
        [$uri] = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
        
        $method = $_SERVER['REQUEST_METHOD'];
        
        $data = [];
     

        if (!isset(self::$routes[$method])) {
            throw new  Exception('Метод не поддерживается', 405);
        }

        foreach (self::$routes[$method] as $route => $params) {
            if (preg_match($route, $uri, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $data[$key] = $match;
                    }
                };
                self::$route = array_merge(['data' => $data], $params);
                return;
            }
        }

        throw new  Exception('Страница не найдена', 404);
    }

    /**
     * @throws Exception
     */
    public static function execute(Container $container): void
    {
        self::match();

        if (is_callable(self::$route)) {
            self::$route['action']();
        }

        if (isset(self::$route['action']) && is_array(self::$route['action'])) {
            [$controller, $method] = self::$route['action'];

            if (isset(self::$route['data'])) {
                $_REQUEST = array_merge(self::$route['data'], $_REQUEST);
            }

            if (!$container->has($controller)) {
                (new $controller())->$method();
            }

            $response = $container->get($controller, $method);

            if (is_array($response)) {
                header('Content-Type: application/json');
                echo json_encode($response);
            }

            if (is_object($response)) {
                header('Content-Type: application/json');
                /**
                 * @var JsonResource $response
                 */
                echo json_encode($response());
            }

            if (is_string($response)) {
                echo $response;
            }
        }
    }


}
