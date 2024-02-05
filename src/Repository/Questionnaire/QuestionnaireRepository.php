<?php

namespace App\Repository\Questionnaire;

use App\Entity\Questionnaire\Question;
use App\Entity\Questionnaire\Questionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Questionnaire>
 *
 * @method Questionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questionnaire[]    findAll()
 * @method Questionnaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionnaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questionnaire::class);
    }

    public function getLastId(): ?int
    {
        return $this->getEntityManager()->createQuery(
            'SELECT q.id FROM App\Entity\Questionnaire\Questionnaire q ORDER BY q.created_at DESC')
            ->setMaxResults(1)
            ->getSingleScalarResult();
    }

    public function getLast(): Questionnaire
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT q, questions, answers
            FROM App\Entity\Questionnaire\Questionnaire q
            INNER JOIN q.questions questions
            INNER JOIN questions.answers answers
            WHERE q.id ='.$this->getLastId()
        );

        return $query->getSingleResult();
    }
}
