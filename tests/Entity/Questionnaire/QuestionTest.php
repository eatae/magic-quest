<?php

declare(strict_types=1);

namespace App\Tests\Entity\Questionnaire;

use App\Entity\Questionnaire\Questionnaire;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Tests\BaseKernelTestCase;

class QuestionTest extends BaseKernelTestCase
{
    protected AnswerFactory $answerFactory;
    protected QuestionFactory $questionFactory;

    protected function setUp(): void
    {
        $this->answerFactory = new AnswerFactory();
        $this->questionFactory = new QuestionFactory();

        parent::setUp();
    }

    public function testReorderAnswers()
    {
        $question = $this->questionFactory->create(
            '1 + 1',
            2,
            ...[
                $this->answerFactory->create('1', 1),
                $this->answerFactory->create('2', 2),
                $this->answerFactory->create('3', 3),
                $this->answerFactory->create('4', 4),
                $this->answerFactory->create('5', 5),
                $this->answerFactory->create('6', 6),
                $this->answerFactory->create('7', 7),
                $this->answerFactory->create('8', 8),
                $this->answerFactory->create('9', 9),
            ]
        );

        $orderAnswers = $question->getAnswers();
        $question->reorderAnswers();

        $this->assertNotEquals($orderAnswers, $question->getAnswers());
    }

    public function answersProvider(): array
    {
        $answerFactory = new AnswerFactory();

        return [
            [
                '5 + 5',
                10,
                $answerFactory->create('11', 11),
                $answerFactory->create('12', 12),
                // error exists
                true,
            ],
            [
                '5 + 5',
                10,
                $answerFactory->create('10', 10),
                $answerFactory->create('12', 12),
                // error exists
                false,
            ],
        ];
    }

    /**
     * @dataProvider answersProvider
     */
    public function testQuestionHasValidAnswer($qTemplate, $qValue, $firstAnswer, $secondAnswer, $errorExists)
    {
        $questionnaire = (new Questionnaire())->setTitle('Test Validate');

        $questionnaire->addQuestion(
            $this->questionFactory->create(
                $qTemplate,
                $qValue,
                ...[
                    $firstAnswer,
                    $secondAnswer,
                ]
            )
        );

        $this->assertEquals(
            $this->validator->validate($questionnaire)->count() > 0,
            $errorExists
        );
    }
}
