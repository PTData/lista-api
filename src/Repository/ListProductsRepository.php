<?php

namespace App\Repository;

use App\Entity\ListProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ListProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListProducts[]    findAll()
 * @method ListProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ListProducts::class);
    }

//    /**
//     * @return ListProducts[] Returns an array of ListProducts objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListProducts
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
