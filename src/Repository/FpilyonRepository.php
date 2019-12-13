<?php

namespace App\Repository;

use App\Entity\Fpilyon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Fpilyon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fpilyon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fpilyon[]    findAll()
 * @method Fpilyon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FpilyonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fpilyon::class);
    }

    // /**
    //  * @return Fpilyon[] Returns an array of Fpilyon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fpilyon
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
