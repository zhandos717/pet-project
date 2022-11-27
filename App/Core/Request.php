<?php

declare(strict_types=1);

namespace App\Core;

final class Request
{
    private array $request;

    public function __construct()
    {
        $this->request = $_REQUEST;
    }

    public function get($key, $default = null)
    {
        return $this->request[$key] ?? $default;
    }

    public function has($key): bool
    {
        return isset($this->request[$key]);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function file($key): mixed
    {
        return $_FILES[$key] ?? null;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->request;
    }
}
