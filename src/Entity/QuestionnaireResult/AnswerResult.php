<?php

namespace App\Entity\QuestionnaireResult;

use App\Entity\Questionnaire\Answer;
use App\Entity\Questionnaire\Question;
use App\Repository\QuestionnaireResult\AnswerResultRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AnswerResultRepository::class)]
class AnswerResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'answerResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionResult $questionResult = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Answer $answer = null;

    #[ORM\Column]
    private bool $selected = false;

    #[ORM\Column(nullable: true)]
    private ?bool $success = null;

    #[ORM\Column]
    private ?int $orderNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionResult(): ?QuestionResult
    {
        return $this->questionResult;
    }

    public function setQuestionResult(?QuestionResult $questionResult): static
    {
        $this->questionResult = $questionResult;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function isSelected(): bool
    {
        return $this->selected;
    }

    public function setSelected(bool $selected): static
    {
        $this->selected = $selected;

        return $this;
    }

    public function isSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccessByQuestion(Question $question): static
    {
        $this->success =
            $question->getValue() === $this->answer->getValue();

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }
}
