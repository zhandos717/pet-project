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

final class QuestionController
{
    /**
     * @throws Exception
     */
    public function index(Question $questionRepository): void
    {
        echo json_encode($questionRepository->answers());
    }
}
