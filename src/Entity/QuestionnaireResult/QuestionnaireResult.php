<?php

namespace App\Entity\QuestionnaireResult;

use App\Entity\Questionnaire\Questionnaire;
use App\Repository\QuestionnaireResult\QuestionnaireResultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionnaireResultRepository::class)]
class QuestionnaireResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questionnaireResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Questionnaire $questionnaire = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'questionnaireResult', targetEntity: QuestionResult::class, orphanRemoval: true)]
    #[Assert\Valid]
    private Collection $questionResults;

    public function __construct()
    {
        $this->questionResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionnaire(): ?Questionnaire
    {
        return $this->questionnaire;
    }

    public function setQuestionnaire(?Questionnaire $questionnaire): static
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

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

    /**
     * @return Collection<int, QuestionResult>
     */
    public function getQuestionResults(): Collection
    {
        return $this->questionResults;
    }

    public function addQuestionResult(QuestionResult $questionResult): static
    {
        if (!$this->questionResults->contains($questionResult)) {
            $this->questionResults->add($questionResult);
            $questionResult->setQuestionnaireResult($this);
        }

        return $this;
    }

    public function removeQuestionResult(QuestionResult $questionResult): static
    {
        if ($this->questionResults->removeElement($questionResult)) {
            // set the owning side to null (unless already changed)
            if ($questionResult->getQuestionnaireResult() === $this) {
                $questionResult->setQuestionnaireResult(null);
            }
        }

        return $this;
    }
}
