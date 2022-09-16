<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use http\QueryString;
use JetBrains\PhpStorm\NoReturn;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function add(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    #[NoReturn] public function findManyToManyQuery(): Query
    {
//            SELECT * FROM  `race__car` , race__pilote where race__car.id not in (SELECT car_id from race__pilote) or race__car.id = race__pilote.car_id GROUP by race__car.id;
        $qb = $this->createQueryBuilder('c');
        $qb
            ->leftJoin('c.pilotes', 'p')
        ;

//                dump($qb->getQuery()->getDQL());
//                dd($qb->getQuery()->getSQL());
        return $qb->getQuery();
    }

//    public function findAllEmptyQuery(): Query
//    {
////        $qb = $this->createQueryBuilder('c');
//////        $qb->andWhere($qb->expr()->count("c.pilotes"));
////        $qb->andWhere("c.color < 2");
////        $qb = $this->createQueryBuilder('c');
////        SELECT *, COUNT(race__pilote.car_id) FROM `race__car` JOIN race__pilote On race__car.id = race__pilote.car_id GROUP by race__pilote.car_id HAVING  COUNT(race__pilote.car_id) < 2;
////        $qb = $this->createQueryBuilder('c');
////        $qb
//////            ->select('*, COUNT(race__pilote.car_id)')
//////            ->from('UserBundle:race__car','c')
////            ->join('Pilote:race__pilote','p')
////            ->groupBy('p.car_id')
////            ->having('COUNT(p.car_id) < 2')
////
//////        ;
////        $qb = $this->createQueryBuilder('c')
////            ->select('p')
////            ->from('Pilote','p')
////
////        ;
////
////        dump($qb->getQuery()->getDQL());
////        dd($qb->getQuery()->getSQL());
//        return $qb->getQuery();
//    }

//    /**
//     * @return Car[] Returns an array of Car objects
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

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
