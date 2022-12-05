<?php

namespace App\Http\Resuorce;

class MessageResource extends JsonResource
{

    function toArray(): array
    {
        return [
            'message'=>$this->resource['message']
        ];
    }
}