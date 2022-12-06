<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Enums\Role;
use App\Http\Controllers\Traits\UserAuthorize;
use App\Http\Resource\CategoryResource;
use App\Http\Resource\MessageResource;
use App\Repository\Category;
use Exception;
use ReflectionException;

class CategoryController
{

    use  UserAuthorize;


    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->can(Role::ADMIN);
    }

    /**
     * @param Request  $request
     * @param Category $category
     *
     * @return array
     * @throws Exception
     */
    public function index(Request $request, Category $category): array
    {
        return CategoryResource::collection($category->all());
    }

    /**
     * @param Request  $request
     * @param Category $category
     *
     * @return CategoryResource
     * @throws Exception
     */
    public function store(Request $request, Category $category): CategoryResource
    {
        return new CategoryResource(
            $category->create([
                'name' => $request->get('name')
            ])
        );
    }

    /**
     * @param Request  $request
     * @param Category $category
     *
     * @return MessageResource
     * @throws Exception
     */
    public function destroy(Request $request, Category $category): MessageResource
    {
        $category->delete($request->get('category'));
        return new MessageResource([
            'message'=>'Запись удалена!'
        ]);
    }

}