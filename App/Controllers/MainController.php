<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Repository\Answer;
use App\Repository\Question;
use App\Repository\Result;
use Exception;

final class MainController
{
    /**
     * @throws Exception
     */
    public function index(Question $question, Answer $answer): void
    {
        view('index', ['questions' => $question->answers()]);
    }

    /**
     * @throws Exception
     */
    public function result(Request $request, Question $question, Result $result, Answer $answer): void
    {
        $data = $request->get('questions');
        $uuid = $request->get('uuid');

        $totalQuestions = $question->select(['COUNT(*) as count'])->get('count');
        $answers = $answer->select(['id,question_id'])->where('positive', 1)->get();

        $currentResult = array_filter($answers, function ($answer) use ($data) {
            return isset($data[$answer['question_id']]) && $data[$answer['question_id']] == $answer['id'];
        });


        $total = get_percent(count($currentResult), $totalQuestions);

        $totalResult =  $result->select(['COUNT(*) as count'])->get('count');

        $answersBelow =  $result->select(['COUNT(*) as count'])->where('total', '<', $total)->get('count');

        if($result->select(['COUNT(*) as count'])->where('uuid',$uuid)->get('count') == 0)
        {
            $result->create(['data' => json_encode($data), 'total' => $total, 'uuid'=>$uuid]);
        }

        view('result', [
            'total' => $total,
            'answers_below' =>get_percent($answersBelow, $totalResult)
        ]);
    }
}
