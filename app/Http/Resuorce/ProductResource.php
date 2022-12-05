<?php

namespace App\Http\Resuorce;

class ProductResource extends JsonResource
{
    public function toArray(): array
    {

        return [
            'id'          => $this->resource['id'],
            'title'       => $this->resource['title'],
            'description' => $this->resource['description'],
            'images'      => $this->resource['images'],
            'reviews'     => $this->when(isset($this->resource['reviews']),
                ReviewResource::collection($this->resource['reviews'] ?? null, false)),
            'created_at'  => $this->resource['created_at'],
        ];
    }
}