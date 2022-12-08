<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prestataire>
 *
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    public function save(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

    }

    public function numberOfPrestataire()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager
            ->createQuery('SELECT count(p) FROM App\Entity\Prestataire p');
        return $query->getSingleScalarResult();
    }
public function findByIntervallePrixHeure($prixMin, $prixMax){
         return $this->createQueryBuilder('p')
             ->andWhere('p.prixHeure > :prixMin and p.prixHeure < :prixMax')
            // ->setParameter('prixMin',$prixMin)
           //  ->setParameter('prixMax',$prixMax)
                ->setParameters(['prixMin'=>$prixMin,'prixMax'=>$prixMax])
             ->getQuery()
             ->getResult();
}




//    /**
//     * @return Prestataire[] Returns an array of Prestataire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
//    public function findOneBySomeField($value): ?Prestataire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
