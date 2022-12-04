<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Resuorce\GoodsResource;
use App\Repository\Good;
use Exception;

class GoodController
{
    /**
     * @throws Exception
     */
    public function index(Request $request, Good $goods): array
    {
       return GoodsResource::collection($goods->all());
    }

    /**
     * @throws Exception
     */
    public function show(Request $request, Good $goods): GoodsResource
    {

        return new GoodsResource(
            $goods->find($request->get('good'))
        );
    }
}