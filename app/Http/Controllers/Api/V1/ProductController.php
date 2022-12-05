<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Resuorce\ProductResource;
use App\Repository\Product;
use Exception;

class ProductController
{
    /**
     * @param Request $request
     * @param Product $goods
     *
     * @return array
     * @throws Exception
     */
    public function index(Request $request, Product $goods): array
    {
        return ProductResource::collection($goods->all());
    }

    /**
     * @param Request $request
     * @param Product $goods
     *
     * @return ProductResource
     * @throws Exception
     */
    public function store(Request $request, Product $goods): ProductResource
    {
        return new ProductResource(
            $goods->create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'images' => $request->get('images'),
                'category_id'=> $request->get('category_id'),
            ])
        );
    }

    /**
     * @param Request $request
     * @param Product $goods
     *
     * @return ProductResource
     * @throws Exception
     */
    public function show(Request $request, Product $product): ProductResource
    {
        return new ProductResource(
            $product->find($request->get('product'))->reviews()
        );
    }
}