<?php

namespace App\Factory;

use App\Entity\Questionnaire\Question;
use App\Entity\QuestionnaireResult\AnswerResult;
use App\Entity\QuestionnaireResult\QuestionResult;

class QuestionResultFactory
{
    public function create(
        Question $question,
        AnswerResult ...$answerResults
    ): QuestionResult {
        $questionResult = (new QuestionResult())
            ->setQuestion($question);

        foreach ($answerResults as $answerResult) {
            $questionResult->addAnswerResult($answerResult);
        }

        return $questionResult;
    }
}