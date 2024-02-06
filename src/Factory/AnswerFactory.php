<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Questionnaire\Answer;

class AnswerFactory
{
    public function create(string $template, int $value): Answer
    {
        $answer = new Answer();
        $answer->setTemplate($template);
        $answer->setValue($value);

        return $answer;
    }
}
