<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Questionnaire\Answer;
use App\Entity\Questionnaire\Question;
use App\Entity\QuestionnaireResult\AnswerResult;

class AnswerResultFactory
{
    public function create(Question $question, Answer $answer): AnswerResult
    {
        return (new AnswerResult())
            ->setAnswer($answer)
            ->setSuccessByQuestion($question);
    }
}
