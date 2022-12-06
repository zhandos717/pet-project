<?php

namespace App\Http\Resource;

class UserResource extends JsonResource
{

    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'email'=> $this->resource['email'],
            'name'=> $this->resource['name'],
            'token'=> $this->resource['token'],
            'role_id'=> $this->resource['role_id'],
        ];
    }
}