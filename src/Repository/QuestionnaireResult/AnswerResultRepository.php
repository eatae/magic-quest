<?php

namespace App\Repository\QuestionnaireResult;

use App\Entity\QuestionnaireResult\AnswerResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnswerResult>
 *
 * @method AnswerResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerResult[]    findAll()
 * @method AnswerResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerResult::class);
    }

//    /**
//     * @return AnswerResult[] Returns an array of AnswerResult objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AnswerResult
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
