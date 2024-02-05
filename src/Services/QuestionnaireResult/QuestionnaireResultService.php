<?php

namespace App\Services\QuestionnaireResult;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Factory\QuestionnaireResultFactory;
use App\Repository\Questionnaire\QuestionnaireRepository;
use App\Repository\QuestionnaireResult\QuestionnaireResultRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuestionnaireResultService
{
    public function __construct(
        protected QuestionnaireResultFactory $factory,
        protected QuestionnaireResultRepository $questionnaireResultRepository
    ) {}

    public function getNewQuestionnaireResult(
        Questionnaire $questionnaire,
        string $userName
    ): QuestionnaireResult {

        return $this->factory->create($questionnaire, $userName);
    }

    public function save(QuestionnaireResult $result): void
    {
        $this->questionnaireResultRepository->save($result);
    }
}