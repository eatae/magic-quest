<?php

declare(strict_types=1);

namespace App\Services\QuestionnaireResult;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Factory\QuestionnaireResultFactory;
use App\Repository\QuestionnaireResult\QuestionnaireResultRepository;

class QuestionnaireResultService
{
    public function __construct(
        protected QuestionnaireResultFactory $factory,
        protected QuestionnaireResultRepository $questionnaireResultRepository
    ) {
    }

    public function getNewQuestionnaireResult(
        Questionnaire $questionnaire,
        string $userName
    ): QuestionnaireResult {
        return $this->factory->create($questionnaire, $userName);
    }

    public function getQuestionResults(
    ): array {
        return $this->questionnaireResultRepository->findAll();
    }

    public function save(QuestionnaireResult $result): void
    {
        $this->questionnaireResultRepository->save($result);
    }
}
