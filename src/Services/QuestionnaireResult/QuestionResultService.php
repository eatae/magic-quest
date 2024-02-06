<?php

declare(strict_types=1);

namespace App\Services\QuestionnaireResult;

use App\Repository\QuestionnaireResult\QuestionResultRepository;

class QuestionResultService
{
    public function __construct(
        protected QuestionResultRepository $questionResultRepository
    ) {
    }

    public function getQuestionResults(
    ): array {
        return $this->questionResultRepository->findAll();
    }
}
