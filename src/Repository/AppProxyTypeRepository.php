<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use GeneralCrime\Apf\Umgt\Doctrine\Entity\AppProxyType;

/**
 * @extends ServiceEntityRepository<AppProxyType>
 * @method AppProxyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppProxyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppProxyType[]    findAll()
 * @method AppProxyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppProxyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppProxyType::class);
    }

    public function add(AppProxyType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AppProxyType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return AppProxyType[] Returns an array of AppProxyType objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AppProxyType
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
