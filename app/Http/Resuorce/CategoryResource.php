<?php

namespace App\Http\Resuorce;

class CategoryResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
        ];
    }
}