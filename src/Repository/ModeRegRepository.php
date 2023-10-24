<?php

namespace App\Repository;

use App\Entity\ModeReg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModeReg>
 *
 * @method ModeReg|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeReg|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeReg[]    findAll()
 * @method ModeReg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeRegRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeReg::class);
    }

//    /**
//     * @return ModeReg[] Returns an array of ModeReg objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModeReg
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
