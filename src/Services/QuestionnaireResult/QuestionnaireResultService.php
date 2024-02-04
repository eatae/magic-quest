<?php

namespace App\Services\QuestionnaireResult;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Factory\QuestionnaireResultFactory;

class QuestionnaireResultService
{
    public function __construct(
        protected QuestionnaireResultFactory $factory
    ) {}

    public function getNewQuestionnaireResult(
        Questionnaire $questionnaire,
        string $userName
    ): QuestionnaireResult {

        return $this->factory->create($questionnaire, $userName);
    }
}