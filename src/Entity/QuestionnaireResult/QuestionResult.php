<?php

namespace App\Entity\QuestionnaireResult;

use App\Entity\Questionnaire\Question;
use App\Repository\QuestionnaireResult\QuestionResultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionResultRepository::class)]
class QuestionResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questionResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionnaireResult $questionnaireResult = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\Column]
    private ?bool $success = null;

    #[ORM\Column]
    private ?int $orderNumber = null;

    #[ORM\OneToMany(mappedBy: 'questionResult', targetEntity: AnswerResult::class, orphanRemoval: true)]
    #[Assert\Valid]
    private Collection $answerResults;

    public function __construct()
    {
        $this->answerResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionnaireResult(): ?QuestionnaireResult
    {
        return $this->questionnaireResult;
    }

    public function setQuestionnaireResult(?QuestionnaireResult $questionnaireResult): static
    {
        $this->questionnaireResult = $questionnaireResult;

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

    public function setOrderNumber(int $�orderNumber): static
    {
        $this->orderNumber = $�orderNumber;

        return $this;
    }

    /**
     * @return Collection<int, AnswerResult>
     */
    public function getAnswerResults(): Collection
    {
        return $this->answerResults;
    }

    public function addAnswerResult(AnswerResult $answerResult): static
    {
        if (!$this->answerResults->contains($answerResult)) {
            $this->answerResults->add($answerResult);
            $answerResult->setQuestionResult($this);
        }

        return $this;
    }

    public function removeAnswerResult(AnswerResult $answerResult): static
    {
        if ($this->answerResults->removeElement($answerResult)) {
            // set the owning side to null (unless already changed)
            if ($answerResult->getQuestionResult() === $this) {
                $answerResult->setQuestionResult(null);
            }
        }

        return $this;
    }
}
