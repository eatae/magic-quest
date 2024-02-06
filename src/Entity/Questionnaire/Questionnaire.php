<?php

declare(strict_types=1);

namespace App\Entity\Questionnaire;

use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Repository\Questionnaire\QuestionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
#[ORM\HasLifecycleCallbacks]
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

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionnaireResults = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTimeImmutable();
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
                /* @var Question $question */
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
