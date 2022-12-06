<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Request;
use App\Http\Controllers\Traits\UserAuthorize;
use App\Http\Resource\ReviewResource;
use App\Repository\Review;
use Exception;

class ReviewController
{
    use  UserAuthorize;
    /**
     * @throws Exception
     */
    public function store(Request $request, Review $review): ReviewResource
    {
        $review->create([
            'product_id' => $request->get('product_id'),
            'user_id' => $this->getUser()['id'],
            'body' => $request->get('body')
        ]);

      return new ReviewResource(
          $review
      );
    }
}