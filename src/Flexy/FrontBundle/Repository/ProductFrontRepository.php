<?php

namespace App\Flexy\FrontBundle\Repository;

use App\Flexy\ShopBundle\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PubBanner|null find($id, $lockMode = null, $lockVersion = null)
 * @method PubBanner|null findOneBy(array $criteria, array $orderBy = null)
 * @method PubBanner[]    findAll()
 * @method PubBanner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFrontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }




     /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findDeals()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.promotion IS NOT NULL ')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


        /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findByKeyWord($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name LIKE :val')
            ->orWhere('p.skuCode LIKE :val')
            ->orWhere('p.metaTitle LIKE :val')
            ->orWhere('p.metaDescription LIKE :val')
            ->orWhere('p.description LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


        
    public function findByKeyWordAndCategory($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name LIKE :val')
            ->orWhere('p.description LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    // /**
    //  * @return PubBanner[] Returns an array of PubBanner objects
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
    public function findOneBySomeField($value): ?PubBanner
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
