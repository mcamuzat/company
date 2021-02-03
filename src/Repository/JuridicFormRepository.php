<?php

namespace App\Repository;

use App\Entity\JuridicForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JuridicForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuridicForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuridicForm[]    findAll()
 * @method JuridicForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuridicFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuridicForm::class);
    }

    // /**
    //  * @return JuridicForm[] Returns an array of JuridicForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JuridicForm
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
