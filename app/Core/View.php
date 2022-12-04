<?php

declare(strict_types=1);

namespace App\Core;


use Exception;

final class View
{
    /**
     * @throws Exception
     */
    public function render(string $view, ?array $params = []): void
    {
        $path = view_path() . $view . '.php';

        if (!empty($params)) {
            extract($params);
        }

        if (!file_exists($path)) {
            throw new Exception(sprintf('Файл %s не найден.', $view));
        }

        ob_start();
        include $path;
        ob_end_flush();
    }
}
