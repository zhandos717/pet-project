<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Good;
use App\Repository\Question;
use App\Repository\Result;
use Exception;

final class ResultService
{

    public function __construct(
        private readonly Question $question,
        private readonly Result $result,
        private readonly Good $answer
    ) {
    }

    /**
     * @throws Exception
     */
    public function make(array $data): array
    {
        ['answers' => $data, 'uuid' => $uuid] = $data;

        $totalQuestions = $this->question->select(['COUNT(*) as count'])->get('count');
        $answers = $this->answer->select(['id,question_id'])->where('positive', 1)->get();

        $currentResult = array_filter($answers, function ($answer) use ($data) {
            return isset($data[$answer['question_id']]) && $data[$answer['question_id']] == $answer['id'];
        });


        $total = get_percent(count($currentResult), $totalQuestions);

        $totalResult = $this->result->select(['COUNT(*) as count'])->get('count');

        $answersBelow = $this->result->select(['COUNT(*) as count'])->where('total', '<', $total)->get('count');

        if ($this->result->select(['COUNT(*) as count'])->where('uuid', $uuid)->get('count') == 0) {
            $this->result->create(['data' => json_encode($data), 'total' => $total, 'uuid' => $uuid]);
        }

        return [
            'answersBelow' => get_percent($answersBelow, $totalResult),
            'total'        => $total,
        ];
    }


    /**
     * @throws Exception
     */
    public function getByUUID($uuid): array
    {
        $data = $this->result->select()->where('uuid', $uuid)->get();

        if (empty($data)) {
            return [
                'answersBelow' => 0,
                'total'        => 0,
            ];
        }
        ['total' => $total] = array_shift($data);

        $totalResult = $this->result->select(['COUNT(*) as count'])->get('count');
        $answersBelow = $this->result->select(['COUNT(*) as count'])->where('total', '<', $total)->get('count');

        return [
            'answersBelow' => get_percent($answersBelow, $totalResult),
            'total'        => $total,
        ];
    }
}

