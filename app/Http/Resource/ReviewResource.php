<?php

namespace App\Http\Resource;

class ReviewResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'body' => $this->resource['body'],
            'created_at' => $this->resource['created_at'],
        ];
    }
}