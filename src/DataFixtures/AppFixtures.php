<?php

namespace App\DataFixtures;

use App\Entity\Questionnaire\Question;
use App\Entity\Questionnaire\Questionnaire;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        protected QuestionFactory $questionFactory
    ) {}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $questionnaire = new Questionnaire();

        $question = $this->questionFactory->create(
            "1 + 1 =",
            2
        );

        dd($question);
    }
}
