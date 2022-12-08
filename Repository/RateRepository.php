<?php

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rate>
 *
 * @method Rate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rate[]    findAll()
 * @method Rate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    public function save(Rate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
public function getRatePrestataire($id){
        return $this->createQueryBuilder('r')
            ->andWhere('r.idPrestataire = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
}
    public function MoyRate($id)
    {
        return $this->createQueryBuilder('r')
            ->select('avg(r.rate) as Moyrt')
            ->andWhere('r.idPrestataire = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function PrestataireTopRated1(){
        return $this->createQueryBuilder('r')
            ->select('avg(r.rate) as moy','idPrestataire.nom as nom','idPrestataire.prenom as prenom')
            ->join("r.idPrestataire","idPrestataire")
            ->groupBy('r.idPrestataire')
            ->orderBy('moy','DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

    }
    public function PrestataireTopRated(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager
            ->createQuery('SELECT avg FROM App\Entity\Prestataire p');
        return $query->getSingleScalarResult();

    }

//    /**
//     * @return Rate[] Returns an array of Rate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rate
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
