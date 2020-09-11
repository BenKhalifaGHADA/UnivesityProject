<?php

namespace App\Repository;

use App\Entity\Phonenumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Phonenumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method Phonenumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method Phonenumber[]    findAll()
 * @method Phonenumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhonenumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Phonenumber::class);
    }

    // /**
    //  * @return Phonenumber[] Returns an array of Phonenumber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Phonenumber
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
