<?php

namespace App\Repository;

use App\Entity\Count;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Count|null find($id, $lockMode = null, $lockVersion = null)
 * @method Count|null findOneBy(array $criteria, array $orderBy = null)
 * @method Count[]    findAll()
 * @method Count[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Count::class);
    }

    // /**
    //  * @return Count[] Returns an array of Count objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Count
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
