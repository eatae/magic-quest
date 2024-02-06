<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Questionnaire\Questionnaire;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        protected QuestionFactory $questionFactory,
        protected AnswerFactory $answerFactory,
        protected ValidatorInterface $validator
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $questionnaire = new Questionnaire();
        $questionnaire->setTitle('Magic Quest');

        // 1. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '1 + 1 =',
                2,
                ...[
                    $this->answerFactory->create('3', 3),
                    $this->answerFactory->create('2', 2),
                    $this->answerFactory->create('0', 0),
                ]
            )
        );

        // 2. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '2 + 2 =',
                4,
                ...[
                    $this->answerFactory->create('4', 4),
                    $this->answerFactory->create('3 + 1', 4),
                    $this->answerFactory->create('10', 10),
                ]
            )
        );

        // 3. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '3 + 3 =',
                6,
                ...[
                    $this->answerFactory->create('1 + 5', 6),
                    $this->answerFactory->create('1', 1),
                    $this->answerFactory->create('6', 6),
                    $this->answerFactory->create('2 + 4', 6),
                ]
            )
        );

        // 4. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '3 + 3 =',
                6,
                ...[
                    $this->answerFactory->create('1 + 5', 6),
                    $this->answerFactory->create('1', 1),
                    $this->answerFactory->create('6', 6),
                    $this->answerFactory->create('2 + 4', 6),
                ]
            )
        );

        // 5. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '4 + 4 =',
                8,
                ...[
                    $this->answerFactory->create('8', 8),
                    $this->answerFactory->create('4', 4),
                    $this->answerFactory->create('0', 0),
                    $this->answerFactory->create('0 + 8', 8),
                ]
            )
        );

        // 6. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '5 + 5 =',
                10,
                ...[
                    $this->answerFactory->create('6', 6),
                    $this->answerFactory->create('18', 18),
                    $this->answerFactory->create('10', 10),
                    $this->answerFactory->create('9', 9),
                    $this->answerFactory->create('0', 0),
                ]
            )
        );

        // 7. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '6 + 6 =',
                12,
                ...[
                    $this->answerFactory->create('3', 3),
                    $this->answerFactory->create('9', 9),
                    $this->answerFactory->create('0', 0),
                    $this->answerFactory->create('12', 12),
                    $this->answerFactory->create('5 + 7', 12),
                ]
            )
        );

        // 8. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '7 + 7 =',
                14,
                ...[
                    $this->answerFactory->create('5', 5),
                    $this->answerFactory->create('14', 14),
                ]
            )
        );

        // 9. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '8 + 8 =',
                16,
                ...[
                    $this->answerFactory->create('16', 16),
                    $this->answerFactory->create('12', 12),
                    $this->answerFactory->create('9', 9),
                    $this->answerFactory->create('5', 5),
                ]
            )
        );

        // 10. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '9 + 9 =',
                18,
                ...[
                    $this->answerFactory->create('18', 18),
                    $this->answerFactory->create('9', 9),
                    $this->answerFactory->create('17 + 1', 18),
                    $this->answerFactory->create('2 + 16', 18),
                ]
            )
        );

        // 11. question
        $questionnaire->addQuestion(
            $this->questionFactory->create(
                '10 + 10 =',
                20,
                ...[
                    $this->answerFactory->create('0', 0),
                    $this->answerFactory->create('2', 2),
                    $this->answerFactory->create('8', 8),
                    $this->answerFactory->create('20', 20),
                ]
            )
        );

        $errors = $this->validator->validate($questionnaire);
        if (count($errors) > 0) {
            throw new \LogicException((string) $errors);
        }

        $manager->persist($questionnaire);
        $manager->flush();
    }
}
