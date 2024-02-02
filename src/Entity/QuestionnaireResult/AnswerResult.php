<?php

namespace App\Entity\QuestionnaireResult;

use App\Entity\Questionnaire\Answer;
use App\Entity\Questionnaire\Question;
use App\Repository\QuestionnaireResult\AnswerResultRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private ?Question $question = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Answer $answer = null;

    #[ORM\Column]
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

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

    public function isSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): static
    {
        $this->success = $success;

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
