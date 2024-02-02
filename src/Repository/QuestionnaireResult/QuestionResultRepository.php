<?php

namespace App\Repository\QuestionnaireResult;

use App\Entity\QuestionnaireResult\QuestionResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionResult>
 *
 * @method QuestionResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionResult[]    findAll()
 * @method QuestionResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionResult::class);
    }

//    /**
//     * @return QuestionResult[] Returns an array of QuestionResult objects
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

//    public function findOneBySomeField($value): ?QuestionResult
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
