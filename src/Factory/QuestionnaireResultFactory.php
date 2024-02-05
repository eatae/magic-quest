<?php

namespace App\Factory;

use App\Entity\Questionnaire\Questionnaire;
use App\Entity\QuestionnaireResult\QuestionnaireResult;

class QuestionnaireResultFactory
{
    public function __construct(
        protected QuestionResultFactory $questionResultFactory,
        protected AnswerResultFactory $answerResultFactory
    ) {}

    public function create(
        Questionnaire $questionnaire,
        string $userName
    ): QuestionnaireResult {
        $questionnaireResult = (new QuestionnaireResult())
            ->setQuestionnaire($questionnaire)
            ->setUserName($userName);

        // create QuestionsResult
        foreach ($questionnaire->getQuestions() as $question) {
            $questionResult = $this->questionResultFactory->create($question);
            // create AnswerResult
            foreach ($question->getAnswers() as $answer) {
                $answerResult = $this->answerResultFactory->create($answer);
                // add AnswerResult to QuestionResult
                $questionResult->addAnswerResult($answerResult);
            }
            // add QuestionResult to QuestionnaireResult
            $questionnaireResult->addQuestionResult($questionResult);
        }

        return $questionnaireResult;
    }
}