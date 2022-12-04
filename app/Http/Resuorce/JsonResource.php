<?php

namespace App\Http\Resuorce;

abstract class JsonResource
{

    protected array $resource = [];

    public function __construct(array $data)
    {
        $this->resource = $data;
    }

    public function __invoke(): array
    {
        return ['data' => $this->resource ? $this->toArray() : []];
    }

    public static function collection(array $items): array
    {
        $class = get_called_class();
        $arr = [];

        foreach ($items as $item) {
            $arr[] = (new $class($item))->toArray();
        }

        return ['data' => $arr];
    }

    abstract function toArray(): array;
}