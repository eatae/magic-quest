<?php

declare(strict_types=1);

namespace App\Services\Questionnaire;

use App\Entity\Questionnaire\Questionnaire;
use App\Repository\Questionnaire\QuestionnaireRepository;

class QuestionnaireService
{
    public function __construct(
        protected QuestionnaireRepository $repository
    ) {
    }

    public function getLastQuestionnaire(): Questionnaire
    {
        return $this->repository->getLast();
    }
}
