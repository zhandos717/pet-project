<?php

namespace App\Http\Resource;

abstract class JsonResource
{

    protected array $resource = [];

    public function __construct(array|callable $data)
    {
        $this->resource = is_array($data) ? $data : $data();
    }

    public function __invoke(): array
    {
        return ['data' => $this->resource ? array_map(function ($data) {

            return is_array($data) ? array_filter($data, function ($item) {
                return !is_null($item);
            }) : $data;

        }, $this->toArray()) : []];
    }

    public static function collection(?array $items = [], bool $wrap = true): array|null
    {
        $class = get_called_class();
        $arr = [];

        if (!isset($items)) {
            return null;
        }

        foreach ($items as $item) {
            $arr[] = (new $class($item))();
        }

        return $wrap ? ['data' => $arr] : $arr;
    }

    abstract function toArray(): array;

    protected function when(bool $condition, mixed $callback): mixed
    {
        if (!$condition) {
            return null;
        }

        return is_callable($callback) ? $callback() : $callback;
    }

}