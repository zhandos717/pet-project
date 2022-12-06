<?php

namespace App\Http\Resource;

class MessageResource extends JsonResource
{

    function toArray(): array
    {
        return [
            'message'=>$this->resource['message']
        ];
    }
}