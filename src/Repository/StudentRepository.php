<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends  ServiceEntityRepository
{
    /**
     * StudentRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);

    }


    /**
     * BEGIN REQUEST QUERYBUILDER
     */

    /**
     * @return mixed
     */
    public function student_SELECT(){
        $qb=$this->createQueryBuilder('u')
                 ->orderBy('u.lastname', 'ASC');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $id
     * @return int|mixed|string|null
     */
    public function showStudentById($id){
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return QueryBuilder
     */
    public function showStudentByFirstname(){
        return $this->createQueryBuilder('u')
            ->where('u.firstname LIKE :firstname')
            ->andWhere('u.lastname =:lastname')
            ->setParameter('firstname','L%')
            ->setParameter('lastname','Couzens')
            ->getQuery()
            ->getResult()
            ;
   }

    /**
     * @return int|mixed|string
     */
   public function showStudentByLimit(){
        return $this->createQueryBuilder('u')
                    ->setFirstResult(3)
                    ->getQuery()
                    ->getResult();

   }

    /**
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
   public function showNumberStudents(){
       return $this->createQueryBuilder('u')
                   ->select('count(u.id)')
                   ->getQuery()
                   ->getSingleScalarResult();

   }

    /**
     * REQUEST DELETE
     * @param $id
     * @return int|mixed|string
     */
    public function student_DELETE($id){
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder->delete(Student::class, 'u')
                      ->where('u.id = :id')
                      ->setParameter('id', $id);
        $query = $queryBuilder->getQuery();
        return $query->execute();
    }

    /**
     * REQUEST UPDATE
     */
    public function student_UPDATE(){
        $queryBuilder =$this->createQueryBuilder()->update(Student::class, 'u')
            ->setParameter('u.lastname', 'test')
            ->where('u.id = 1');

        return $queryBuilder->getQuery()->getResult();
   
    }

    /**
     * BEGIN REQUEST DQL
     */
    /**
     * @return student[]
     */
    public function findAllStudents(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Student p'
            );
       return $query->getResult();
    }

    /**
     * @param $firstname
     * @return array
     */
    public function findFirstnameParameter ($firstname): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                                     'SELECT p
                                      FROM App\Entity\Student p WHERE p.firstname=:firstname')
                                ->setParameter('firstname', $firstname);;
        return $query->getResult();
    }

    /**
     * @param $firstname
     * @return int|mixed|string
     */
    public function findFirstnameDate($firstname){
      $query=$this->getEntityManager()
                  ->createQuery(
                      'SELECT p
                       FROM App\Entity\Student p 
                       WHERE p.firstname LIKE :firstname AND p.dateofbirth<=CURRENT_DATE()
                       ORDER BY p.dateofbirth ASC'
                       )
                     ->setParameter('firstname','%'.$firstname.'%');
                  return $query->getResult();
    }

    /**
     * END REQUEST DQL
     */
  /*
    public function findOneBySomeField($value): ?Student
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


