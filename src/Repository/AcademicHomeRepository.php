<?php

namespace App\Repository;

use App\Entity\AcademicHome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AcademicHome|null find($id, $lockMode = null, $lockVersion = null)
 * @method AcademicHome|null findOneBy(array $criteria, array $orderBy = null)
 * @method AcademicHome[]    findAll()
 * @method AcademicHome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcademicHomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AcademicHome::class);
    }

    // /**
    //  * @return AcademicHome[] Returns an array of AcademicHome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AcademicHome
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
