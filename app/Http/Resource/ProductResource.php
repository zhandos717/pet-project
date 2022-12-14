<?php

namespace App\Http\Resource;

class ProductResource extends JsonResource
{
    public function toArray(): array
    {

        return [
            'id'          => $this->resource['id'],
            'title'       => $this->resource['title'],
            'description' => $this->resource['description'],
            'category_id' => $this->resource['category_id'],
            'price'       => $this->resource['price'],
            'images'     => $this->resource['images'] ? json_decode($this->resource['images']) : null,
            'reviews'    => $this->when(isset($this->resource['reviews']),
                ReviewResource::collection($this->resource['reviews'] ?? null, false)),
            'created_at' => $this->resource['created_at'],
        ];
    }
}