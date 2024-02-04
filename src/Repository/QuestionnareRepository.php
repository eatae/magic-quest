<?php

namespace App\Repository;

use App\Entity\Questionnare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Questionnare>
 *
 * @method Questionnare|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questionnare|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questionnare[]    findAll()
 * @method Questionnare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionnareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questionnare::class);
    }

//    /**
//     * @return Questionnare[] Returns an array of Questionnare objects
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

//    public function findOneBySomeField($value): ?Questionnare
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
