<?php

namespace App\Repository;

use App\Entity\UnicornEnthusiast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UnicornEnthusiast>
 *
 * @method UnicornEnthusiast|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnicornEnthusiast|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnicornEnthusiast[]    findAll()
 * @method UnicornEnthusiast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnicornEnthusiastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnicornEnthusiast::class);
    }

    public function save(UnicornEnthusiast $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UnicornEnthusiast $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UnicornEnthusiast[] Returns an array of UnicornEnthusiast objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UnicornEnthusiast
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
