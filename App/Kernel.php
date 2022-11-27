<?php

namespace App;

use App\Core\Route;
use App\Di\Container;
use Exception;

class Kernel
{
    public Container $container;

    public function handle(): void
    {
        try {
            $this->handleRoute();
        } catch (Exception $exception) {
            echo "Ошибка:  {$exception->getMessage()} <br>
                  Файл:  {$exception->getFile()} <br>
                  Строка:  {$exception->getLine()}";
        }
    }

    /**
     * @throws Exception
     */
    private function handleRoute(): void
    {
        require ROOT_PATH . 'router/web.php';
        Route::execute($this->container);
    }

    public function setContainer(Di\Container $container): void
    {
        $this->container = $container;
    }
}
