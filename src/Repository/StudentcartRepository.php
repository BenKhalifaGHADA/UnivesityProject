<?php

namespace App\Repository;

use App\Entity\Studentcart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Studentcart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studentcart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studentcart[]    findAll()
 * @method Studentcart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentcartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studentcart::class);
    }

    // /**
    //  * @return Studentcart[] Returns an array of Studentcart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Studentcart
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
