<?php

namespace App\Repository;

use App\Entity\Quotation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quotation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quotation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quotation[]    findAll()
 * @method Quotation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuotationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quotation::class);
    }

    /**
    * @return Quotation[] Returns an array of Quotation objects
    */
    public function findByStatus($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.status = :val')
            ->setParameter('val', $value)
            ->orderBy('q.created_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Quotation[] Returns an array of Quotation objects
    */
    public function findAllByDate()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.created_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function updateStatus($value, $id)
    {
        return $this->createQueryBuilder('q')
            ->update()
            ->set('q.status', ':val')
            ->setParameter('val', $value)
            ->where('q.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Quotation
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
