<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Product;
use App\Repository\Question;
use App\Repository\Review;
use Exception;

final class ProductService
{

    public function __construct(
        private readonly Product   $product,
    ) {
    }



    /**
     * @throws Exception
     */
    public function getById($id): array
    {
        $data = $this->product->find($id);

        return [];
    }
}

