<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Enums\Role;
use App\Http\Controllers\Traits\UserAuthorize;
use App\Http\Resource\MessageResource;
use App\Http\Resource\OrderResource;
use App\Repository\Category;
use App\Repository\Order;
use Exception;

class OrderController
{
    use  UserAuthorize;

    public function index(Request $request, Order $order): ?array
    {
        $this->can(Role::ADMIN);

        return OrderResource::collection($order->all());
    }

    public function store(Request $request, Order $order)
    {

        $order->create([
            'name'    => $request->get('name'),
            'phone'   => $request->get('phone'),
            'address' => $request->get('address')
        ]);

        return new OrderResource($order);
    }

    /**
     * @param Request $request
     * @param Order   $order
     *
     * @return MessageResource
     * @throws Exception
     */
    public function destroy(Request $request, Order $order): MessageResource
    {
        $order->delete($request->get('order'));
        return new MessageResource([
            'message' => 'Запись удалена!'
        ]);
    }

}