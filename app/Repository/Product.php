<?php
declare(strict_types=1);

namespace App\Repository;

use Exception;

final class Product extends Repository
{

    /**
     * @throws Exception
     */
    public function reviews(): array
    {
        return $this->hasMany(Review::class);
    }
}
