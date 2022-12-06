<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Enums\Role;
use App\Http\Controllers\Traits\UserAuthorize;
use App\Http\Resource\ProductResource;
use App\Repository\Product;
use Exception;

class ProductController
{
    use  UserAuthorize;

    /**
     * @param Request $request
     * @param Product $goods
     *
     * @return array
     * @throws Exception
     */
    public function index(Request $request, Product $goods): array
    {
        if($request->has('category_id')){
            $goods->where('category_id',$request->get('category_id'));
        }

        return ProductResource::collection($goods->get());
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
        $this->can(Role::ADMIN);

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
     * @param Product $product
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