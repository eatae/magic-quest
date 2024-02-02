<?php

namespace App\Repository\QuestionnaireResult;

use App\Entity\QuestionnaireResult\QuestionnaireResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionnaireResult>
 *
 * @method QuestionnaireResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionnaireResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionnaireResult[]    findAll()
 * @method QuestionnaireResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionnaireResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionnaireResult::class);
    }

//    /**
//     * @return QuestionnaireResult[] Returns an array of QuestionnaireResult objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuestionnaireResult
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
