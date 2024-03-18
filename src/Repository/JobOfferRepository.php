<?php

namespace App\Repository;

use App\Entity\JobOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobOffer>
 *
 * @method JobOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOffer[]    findAll()
 * @method JobOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOffer::class);
    }
   /**
     * @return JobOffer[] Returns an array of Offer objects
     */
    public function findTenAll(): array
    {
        return $this->createQueryBuilder('j')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return JobOffer[] Returns an array of Offer objects
     */
    public function findTenByCreatedAt(): array
    {
        return $this->createQueryBuilder('j')
            ->orderBy('j.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findPreviousOffer(JobOffer $offer): ?JobOffer
    {
        return $this->createQueryBuilder('j')
            ->where('j.id < :currentId')
            ->setParameter('currentId', $offer->getId())
            ->orderBy('j.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findNextOffer(JobOffer $offer): ?JobOffer
    {
        return $this->createQueryBuilder('j')
            ->where('j.id > :currentId')
            ->setParameter('currentId', $offer->getId())
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
//    /**
//     * @return JobOffer[] Returns an array of JobOffer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobOffer
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
