<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Core\Request;
use App\Repository\Answer;
use App\Repository\Question;
use App\Services\ResultService;
use Database\Factories\QuestionFactory;
use Exception;
use ReflectionException;

final class ResultController
{
    /**
     * @throws Exception
     */
    public function show(Request $request, ResultService $resultService): void
    {
        echo json_encode(
            $resultService->getByUUID($request->get('uuid'))
        );
    }
}
