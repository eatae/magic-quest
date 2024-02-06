<?php

namespace App\Services\QuestionnaireResult;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Repository\QuestionnaireResult\QuestionResultRepository;
use Doctrine\Common\Collections\Collection;

class QuestionResultService
{
    public function __construct(
        protected QuestionResultRepository $questionResultRepository
    ) {}

    public function getQuestionResults(
    ): array {

        return $this->questionResultRepository->findAll();
    }
}