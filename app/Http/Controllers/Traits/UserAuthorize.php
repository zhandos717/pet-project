<?php

namespace App\Http\Controllers\Traits;

use App\Core\Request;
use App\Enums\Role;
use App\Repository\User;
use Exception;
use ReflectionException;

trait UserAuthorize
{
    /**
     * @throws ReflectionException
     */
    public function isAdmin(): bool
    {
        return $this->getUser()['role_id'] == Role::ADMIN;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function can(Role $role): void
    {
        if ($this->getUser()['role_id'] != $role->value) {
            throw new Exception('Запрещено', 403);
        }
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    private function getUser()
    {
        $token = app(Request::class)->headers('Token');

        if (!is_string($token)) {
            throw new Exception('Запрещено', 403);
        }

        $user = app(User::class)->where('token', $token)->get();

        if (empty($user)){
            throw new Exception('Запрещено', 403);
        }

        return  $user[0];
    }
}