<?php

namespace App\Tests\Entity\Questionnaire;


use App\Entity\Questionnaire\Questionnaire;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Tests\BaseKernelTestCase;

class QuestionnaireTest extends BaseKernelTestCase
{
    protected AnswerFactory $answerFactory;
    protected QuestionFactory $questionFactory;

    protected function setUp(): void
    {
        $this->answerFactory = new AnswerFactory();
        $this->questionFactory = new QuestionFactory();

        parent::setUp();
    }

    public function testReorderQuestions()
    {
        $questionnaire = (new Questionnaire())->setTitle('Test reorder questions&');
        $questionnaire->addQuestion($this->questionFactory->create('1 + 0',1));
        $questionnaire->addQuestion($this->questionFactory->create('2 + 0',2));
        $questionnaire->addQuestion($this->questionFactory->create('3 + 0',3));
        $questionnaire->addQuestion($this->questionFactory->create('4 + 0',4));
        $questionnaire->addQuestion($this->questionFactory->create('5 + 0',5));

        $orderQuestions = $questionnaire->getQuestions();
        $questionnaire->reorderQuestions();

        $this->assertNotEquals($orderQuestions, $questionnaire->getQuestions());
    }
}