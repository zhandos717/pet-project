<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Repository\Answer;
use App\Repository\Question;
use App\Services\ResultService;
use Database\Factories\QuestionFactory;
use Exception;
use ReflectionException;

final class MainController
{
    /**
     * @throws Exception
     */
    public function index(Question $questionRepository): void
    {
        view('index', ['questions' => $questionRepository->answers()]);
    }

    /**
     * @throws Exception
     */
    public function result(Request $request, ResultService $resultService): void
    {
        ['total' => $total, 'answersBelow' => $answersBelow] = $resultService->make([
            'answers' => $request->get('questions'),
            'uuid'    => $request->get('uuid')
        ]);

        view('result', [
            'total'         => $total,
            'answers_below' => $answersBelow
        ]);
    }
}
