<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function findByEtat($etat) {
        return $this->createQueryBuilder('v')
            ->andWhere('v.etat = :etat')
            ->setParameter('etat', $etat)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllVehicule() {
        $conexion = $this->getEntityManager()->getConnection();
        $requete = "SELECT name, caracteres, photo, etat
        FROM Vehicule 
        ORDER BY name";
        try {
            $prep = $conexion->prepare($requete);
            $prep->execute();
            return $prep->fetchAll();
        }catch (\PDOException $e) {
            echo $e->getMessage();
            echo "\n erreur findAllVehicule \n";
            return array();
        }
    }

    // /**
    //  * @return Vehicule[] Returns an array of Vehicule objects
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
    public function findOneBySomeField($value): ?Vehicule
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
