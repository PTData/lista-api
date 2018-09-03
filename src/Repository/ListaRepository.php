<?php

namespace App\Repository;

use App\Entity\Lista;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lista|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lista|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lista[]    findAll()
 * @method Lista[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lista::class);
    }

//    /**
//     * @return Lista[] Returns an array of Lista objects
//     */
    
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
    
    public function findOneByIdJoinedToList($list)
    {
        return $this->createQueryBuilder('l')
        ->innerJoin('l.listProducts', 'lp')
        ->innerJoin('lp.produto', 'p')
        //->innerJoin('p.Category', 'c')
        ->select('l')
        ->addSelect('lp')
        
        ->andWhere('l.id = :id')
        ->setParameter('id', $list)
        ->getQuery()
        ->getArrayResult()
        ;
    }
        
    public function findOneByIdJoinedToCategory($productId)
    {
        return $this->createQueryBuilder('p')
        // p.category refers to the "category" property on product
        ->innerJoin('p.category', 'c')
        // selects all the category data to avoid the query
        ->addSelect('c')
        ->andWhere('p.id = :id')
        ->setParameter('id', $productId)
        ->getQuery()
        ->getOneOrNullResult();
    }

    /*
    public function findOneBySomeField($value): ?Lista
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
