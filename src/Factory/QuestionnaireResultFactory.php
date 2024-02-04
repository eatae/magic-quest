<?php

namespace App\Factory;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;

class QuestionnaireResultFactory
{
    public function create(
        Questionnaire $questionnaire,
        string $userName
    ):QuestionnaireResult {
        $questionnaireResult = (new QuestionnaireResult())
            ->setQuestionnaire($questionnaire)
            ->setUserName($userName);

    }
}