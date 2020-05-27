<?php

namespace App\Repository;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    /**
     * Create a Query for pagination and return this one
     */
    public function findAllWithPagination(RechercheVoiture $val): Query
    {
        $req =  $this->createQueryBuilder('v');
        if ($val->getMinAnnee()) {
            $req =  $req->andWhere('v.annee >= :min')
                ->setParameter('min', $val->getMinAnnee());
        } 
        if ($val->getMaxAnnee()) {
            $req = $req->andWhere('v.annee <= :max')
                ->setParameter('max', $val->getMaxAnnee());
        }
            $req->orderBy('v.annee', 'ASC');

        return $req->getQuery();
    }

    // /**
    //  * Undocumented function
    // *
    // * @param [type] $value

    // * @return void
    // */
    //  * @return Voiture[] Returns an array of Voiture objects

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('v')
    //         ->andWhere('v.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('v.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

    // /**
    //  * Undocumented function
    //  *
    //  * @param [type] $value
    //  * @return Voiture|null
    //  */
    // public function findOneBySomeField($value): ?Voiture
    // {
    //     return $this->createQueryBuilder('v')
    //         ->andWhere('v.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

}
