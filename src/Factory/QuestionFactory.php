<?php

namespace App\Factory;

use App\Entity\Questionnaire\Answer;
use App\Entity\Questionnaire\Question;

class QuestionFactory
{
    public function create(string $template, int $value, Answer ...$answers): Question
    {
        $question = new Question();
        $question->setTemplate($template);
        $question->setValue($value);
        foreach ($answers as $answer) {
            $question->addAnswer($answer);
        }

        return $question;
    }


}
