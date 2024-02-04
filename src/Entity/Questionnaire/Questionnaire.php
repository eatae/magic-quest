<?php

namespace App\Entity\Questionnaire;

use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Repository\Questionnaire\QuestionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\Valid]
    #[ORM\OneToMany(mappedBy: 'questionnaire', targetEntity: Question::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'questionnaire', targetEntity: QuestionnaireResult::class, orphanRemoval: true)]
    private Collection $questionnaireResults;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionnaireResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuestionnaire($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuestionnaire() === $this) {
                $question->setQuestionnaire(null);
            }
        }

        return $this;
    }

    public function reorderQuestions(bool $withAnswers = true): void
    {
        if ($withAnswers) {
            foreach ($this->questions as $question) {
                /** @var Question $question */
                $question->reorderAnswers();
            }
        }
        $questionsToArray = $this->questions->toArray();
        shuffle($questionsToArray);

        $this->questions = new ArrayCollection($questionsToArray);
    }

    /**
     * @return Collection<int, QuestionnaireResult>
     */
    public function getQuestionnaireResults(): Collection
    {
        return $this->questionnaireResults;
    }

    public function addQuestionnaireResult(QuestionnaireResult $questionnaireResult): static
    {
        if (!$this->questionnaireResults->contains($questionnaireResult)) {
            $this->questionnaireResults->add($questionnaireResult);
            $questionnaireResult->setQuestionnaire($this);
        }

        return $this;
    }

    public function removeQuestionnaireResult(QuestionnaireResult $questionnaireResult): static
    {
        if ($this->questionnaireResults->removeElement($questionnaireResult)) {
            // set the owning side to null (unless already changed)
            if ($questionnaireResult->getQuestionnaire() === $this) {
                $questionnaireResult->setQuestionnaire(null);
            }
        }

        return $this;
    }
}
