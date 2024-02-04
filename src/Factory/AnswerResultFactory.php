<?php

namespace App\Factory;

use App\Entity\Questionnaire\Answer;
use App\Entity\QuestionnaireResult\AnswerResult;

class AnswerResultFactory
{
    public function create(Answer $answer): AnswerResult
    {
        return (new AnswerResult())->setAnswer($answer);
    }
}