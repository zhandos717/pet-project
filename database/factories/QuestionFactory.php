<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Repository\Product;
use App\Repository\Question;
use Exception;
use ReflectionException;

final class QuestionFactory
{

    public function definition(): array
    {
        return [
            [
                'question' => 'Какое животное обитает в лесной зоне ?',
                'answers'  => [
                    ['Бегемот'],
                    ['Жираф'],
                    ['Волк', true],
                ]
            ],
            [
                'question' => 'Какое животное обитает в пустыне ?',
                'answers'  => [
                    ['Волк'],
                    ['Тушканчик', true],
                    ['Бегемот'],

                ]
            ],
            [
                'question' => 'Кто проживает на дня океана ?',
                'answers'  => [
                    ['Губка Боб', true],
                    ['Бэтмен'],
                    ['Пантера']
                ]
            ]
        ];
    }

    /**
     * @throws ReflectionException|Exception
     */
    public static function create(): void
    {
        $questionRepository = app(Question::class);
        $answerRepository = app(Product::class);

        $data = (new QuestionFactory)->definition();

        array_map(
        /**
         * @throws Exception
         */ function ($item) use ($questionRepository, $answerRepository) {
            $question = false;

            if($questionRepository->select(['COUNT(*) as count'])->where('title',$item['question'])->get('count') == 0){
                $question = $questionRepository->create([
                    'title' => $item['question']
                ]);
            }

            if ($question) {
                array_map(function ($answer) use ($answerRepository, $question) {
                    $answerRepository->create([
                        'text'        => $answer[0],
                        'positive'    => $answer[1] ?? 0,
                        'question_id' => $question['id'],
                    ]);
                }, $item['answers']);
            }
        },
            $data
        );
    }
}
