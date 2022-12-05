<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Repository\Product;
use App\Repository\Question;
use Database\Factories\QuestionFactory;
use Exception;
use ReflectionException;

final class DataBaseSeeder
{
    /**
     * @throws ReflectionException
     */
    public function run(): void
    {
        QuestionFactory::create();
    }
}
