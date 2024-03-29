<?php

namespace App\Repository;

use App\Entity\Characters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Characters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Characters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Characters[]    findAll()
 * @method Characters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharactersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Characters::class);
    }

    public function findCharacterByName($name){
        return $this->createQueryBuilder('c')
                    ->select('c.lastname as lastname, c.firstname as firstname, c.slug as slug, c.picture as picture')
                    ->where('c.lastname LIKE :nom')
                    ->orWhere('c.firstname LIKE :nom')
                    ->setParameter('nom', '%'.$name.'%')
                    ->orderBy('c.lastname','ASC')
                    ->addOrderBy('c.firstname','ASC')
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Characters[] Returns an array of Characters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Characters
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
