<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;

final class Question extends Repository
{
    /**
     * @throws Exception
     */
    public function answers(): array
    {
       return $this->hasMany(Answer::class,['id', 'text']);
    }
}

