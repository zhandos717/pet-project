<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Controllers\Traits\UserAuthorize;
use App\Http\Resource\MessageResource;
use App\Http\Resource\UserResource;
use App\Repository\User;
use Exception;
use ReflectionException;

class AuthController
{
    use  UserAuthorize;

    /**
     * @throws Exception
     */
    public function register(Request $request, User $user): UserResource
    {
        $user->create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
            'token'    => password_hash(uuid(), PASSWORD_BCRYPT),
            'role_id'  => 1
        ]);

        return new UserResource($user);
    }

    /**
     * @throws Exception
     */
    public function login(Request $request, User $user): UserResource
    {
        if (!$request->get('password') || !$request->get('email')) {
            throw new Exception('Заполните данные', 401);
        }

        return new UserResource($user->auth($request->get('email'), $request->get('password')));
    }

    /**
     * @throws ReflectionException
     */
    public function logout(User $user): MessageResource
    {
        $user->update(['token' => null], ['token' => $this->getUser()['token']]);

        return new MessageResource([
            'message' => 'Токен удален!'
        ]);
    }
}