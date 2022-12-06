<?php

namespace App\Core;

use App\Di;
use App\Di\Container;
use Database\Seeders\DataBaseSeeder;
use Exception;

class Kernel
{
    public Container $container;

    public function handle(): void
    {
        try {
            $this->handleRoute();

            if (config('app.seeder')) {
                app(DataBaseSeeder::class, 'run');
            }

        } catch (Exception $exception) {
            http_response_code(is_int($exception->getCode()) ? $exception->getCode() : 500);
            header('Content-Type: application/json');
            exit(
            json_encode(
                config('app.debug') ?
                    [
                        'message' => [
                            'message' => $exception->getMessage()
                        ],
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine()
                    ] : [
                    'error' => [
                        'message' => $exception->getMessage()
                    ],
                ]
            )
            );
        }
    }

    /**
     * @throws Exception
     */
    private function handleRoute(): void
    {

        if (explode('/', $_SERVER['REQUEST_URI'])[1] == 'api') {
            require root_path('router/api.php');
        } else {
            require root_path('router/web.php');
        }

        Route::execute($this->container);
    }

    public function setContainer(Di\Container $container): void
    {
        $this->container = $container;
    }
}
