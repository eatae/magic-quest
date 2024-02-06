<?php

declare(strict_types=1);

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

    #[ORM\OneToMany(mappedBy: 'questionResult', targetEntity: AnswerResult::class, cascade: ['persist'], orphanRemoval: true)]
    #[Assert\Valid]
    private Collection $answerResults;

    #[ORM\Column(options: ['default' => false])]
    #[Assert\IsTrue(groups: ['answered'])]
    private bool $answered = false;

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
        $this->checkSuccess();

        return $this->success;
    }

    public function checkSuccess(): void
    {
        if ($this->isAnswered() && $this->answerResults->count() > 0) {
            $this->success = true;

            /** @var AnswerResult $answerResult */
            foreach ($this->answerResults as $answerResult) {
                if ($answerResult->isSelected() && !$answerResult->isSuccess()) {
                    $this->success = false;
                    break;
                }
            }
        }
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

    /**
     * @return Collection<int, AnswerResult>
     */
    public function getAnswerResults(): Collection
    {
        return $this->answerResults;
    }

    public function addAnswerResult(AnswerResult $answerResult): static
    {
        $cnt = $this->answerResults->count();
        if (!$this->answerResults->contains($answerResult)) {
            $answerResult->setOrderNumber(++$cnt);

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

    public function isAnswered(): bool
    {
        $this->checkAnswered();

        return $this->answered;
    }

    private function checkAnswered(): void
    {
        $this->answered = false;
        /** @var AnswerResult $answerResult */
        foreach ($this->answerResults as $answerResult) {
            if ($answerResult->isSelected()) {
                $this->answered = true;
            }
        }
    }

    public function markSelectedAnswerResults(string ...$answerValues): void
    {
        /** @var AnswerResult $answerResult */
        foreach ($this->answerResults as $answerResult) {
            if (in_array($answerResult->getAnswer()->getTemplate(), $answerValues)) {
                $answerResult->setSelected(true);
            }
        }
    }

    public function collectArrayAnswerResultsByOrderNumber(): array
    {
        $result = [];
        /** @var AnswerResult $answerResult */
        foreach ($this->answerResults as $answerResult) {
            $result[$answerResult->getOrderNumber()] = $answerResult->getAnswer()->getTemplate();
        }

        return $result;
    }
}
