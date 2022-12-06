<?php

namespace App\Http\Resource;

class OrderResource extends JsonResource
{
    public function toArray(): array
    {

        return [
            'id'         => $this->resource['id'],
            'name'       => $this->resource['name'],
            'phone'      => $this->resource['phone'],
            'address'    => $this->resource['address'],
            'created_at' => $this->resource['created_at'],
        ];
    }
}