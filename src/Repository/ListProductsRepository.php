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

    public function findByListId($id)
    {
        $result = $this->createQueryBuilder('l')
        ->where('l.lista = :val')
        //->andWhere('l.id = :val')
        ->setParameter('val', $id)
        //->setMaxResults(10)
        //->orderBy('l.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
        return $result;
    }
    
    public function findById($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = '
        SELECT p.name , u.name as user, p.id FROM list_products lp
        inner join produto p on p.id = lp.produto_id
        inner join lista l on l.id = lp.lista_id
        inner join users u on u.id =  l.user_id_id
        WHERE lp.lista_id = :id
        ORDER BY p.id ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
    
    public function getAllWithRowSql($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = '
        SELECT * FROM list_products p
        WHERE p.lista_id = :id
        ORDER BY p.id ASC
        ';
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id])->fetchAll();
    }
    
    public function getAllWithRowSqlById($id) : array
    {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
        'SELECT p FROM App\Entity\ListProducts p
        WHERE p.lista = :id
        ORDER BY p.id ASC'
        )->setParameter('id', $id);
            
            // returns an array of Product objects
       return $query->execute()->fetchAll();
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
