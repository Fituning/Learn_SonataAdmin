<?php

namespace App\Repository;

use App\Entity\CarPilote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\NoReturn;

/**
 * @extends ServiceEntityRepository<CarPilote>
 *
 * @method CarPilote|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarPilote|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarPilote[]    findAll()
 * @method CarPilote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarPiloteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarPilote::class);
    }

    public function add(CarPilote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarPilote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    #[NoReturn] public function findNewPilotesQuery(): Query
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->leftJoin('c.pilote', 'cp')
            ->leftJoin('cp.cars', 'p');
//            ->andWhere("c != cp.car ");

//        dump($qb->getQuery()->getDQL());
//        dd($qb->getQuery()->getSQL());
        return $qb->getQuery();
    }
//    /**
//     * @return CarPilote[] Returns an array of CarPilote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarPilote
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
