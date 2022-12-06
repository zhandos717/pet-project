<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Resource\UserResource;
use App\Repository\User;
use Exception;

class AuthController
{

    /**
     * @throws Exception
     */
    public function register(Request $request, User $user): UserResource
    {
        $user->create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
            'role_id'  => $request->get('role_id'),
        ]);

        return new UserResource($user);
    }

    /**
     * @throws Exception
     */
    public function login(Request $request, User $user)
    {
        if (!$request->get('password') || !$request->get('email')) {
            throw new Exception('Заполните данные', 401);
        }

      return  new UserResource($user->auth($request->get('email'),$request->get('password')));
    }

    public function logout()
    {

    }
}