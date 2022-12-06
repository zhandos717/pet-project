<?php

declare(strict_types=1);

namespace App\Core;

final class Request
{
    private array $request;

    public function __construct()
    {
        $this->request = array_merge($_REQUEST, (array)json_decode(file_get_contents('php://input')));
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
     *
     * @return mixed|null
     */
    public function file(?string $key = null): mixed
    {
        return $_FILES[$key] ?? $_FILES;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->request;
    }

    public function headers(?string $key = null)
    {
        return getallheaders()[$key] ?? getallheaders();
    }

}