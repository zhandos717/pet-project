<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Resuorce\ReviewResource;
use App\Repository\Review;
use Exception;

class ReviewController
{

    /**
     * @throws Exception
     */
    public function store(Request $request, Review $review): ReviewResource
    {
      return new ReviewResource(
          $review->create([
              'product_id' => $request->get('product_id'),
              'user_id' => $request->get('user_id',1),
              'body' => $request->get('body')
          ])
      );
    }
}