<?php
declare(strict_types=1);

namespace App\Repository;

use Exception;
use ReflectionException;

final class User extends Repository
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return User
     * @throws ReflectionException
     * @throws Exception
     */
    public function auth(string $email, string $password): User
    {
        $user = $this->where('email', $email)->get()[0];

        if (empty($user['password']) || !password_verify($password, $user['password'])) {
            throw new Exception('Не верный логин или пароль', 401);
        }

        $this->update(['token' => password_hash(uuid(),PASSWORD_BCRYPT)], ['id' => $user['id']]);

        return $this->find($user['id']);
    }

}