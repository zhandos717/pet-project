<?php

namespace App\Http\Resuorce;

class GoodsResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'title' => $this->resource['title'],
            'description' => $this->resource['description'],
            'images' => $this->resource['images'],
            'created_at' => $this->resource['created_at'],
        ];
    }
}