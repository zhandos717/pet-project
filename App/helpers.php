<?php

use App\Core\View;
use App\Di\Container;
use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dump')) {
    function dump($data)
    {
        if (is_array($data)) { //If the given variable is an array, print using the print_r function.
            static $int = 0;
            print '<pre><b style="background: red;padding: 1px 5px;">' . $int . '</b> ';
            print_r($data);
            print '</pre>';
            $int++;
        } elseif (is_object($data)) {
            print "<pre>==========================\n";
            var_dump($data);
            print "===========================</pre>";
        } else {
            print "=========&gt; ";
            var_dump($data);
            print " &lt;========= " . PHP_EOL;
        }
    }
}

if (!function_exists('dd')) {
    #[NoReturn]
    function dd($data):void
    {
        dump($data);
        die;
    }
}

if (!function_exists('view')) {
    /**
     * @throws Exception
     */
    function view(string $view, $params = []): void
    {
        (new View())->render($view, $params);
    }
}


if (!function_exists('app')) {
    /**
     * @throws ReflectionException
     */
    function app(string $class, ?string $method = null ): ?object
    {
        $container = new Container();
        return $container->has($class) ? $container->get($class,$method) : null;
    }
}


if (!function_exists('uuid')) {
    function uuid(): string
    {
        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}
if (!function_exists('get_class_name')) {
    /**
     * @throws ReflectionException
     */
    function get_class_name($class): string
    {
        return mb_strtolower(
            (new ReflectionClass($class))
                ->getShortName(),
            'UTF-8'
        );
    }
}

if (!function_exists('get_percent')) {
    function get_percent(int $sum, int $total): float|int
    {
        return $sum != 0 ? round(($sum / $total) * 100) : 0;
    }
}

if (!function_exists('config')) {
    function config(string $key)
    {
        $arr =  explode('.',$key);
        $file = ROOT_PATH.'config/' . array_shift($arr).'.php';
        $data = (include $file);
        $result  = '';

        array_walk_recursive($data, function($item, $key) use(&$result,&$arr)
        {
            if(empty($arr)){
             return;
            }
            if(in_array($key,$arr)){
                $result = $item;
            }
        });
        return $result;
    }
}

if (!function_exists('env')) {
    function env(string $key, ?string $default = null): string|null
    {
        $array = parse_ini_file(__DIR__.'/../.env');
        return $array[$key] ?? $default;
    }
}
