<?php

namespace App\Repository;

use App\Entity\VehicleProducer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VehicleProducer|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleProducer|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleProducer[]    findAll()
 * @method VehicleProducer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleProducerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VehicleProducer::class);
    }

    // /**
    //  * @return VehicleProducer[] Returns an array of VehicleProducer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VehicleProducer
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
