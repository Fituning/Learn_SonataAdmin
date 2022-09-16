<?php

namespace App\Repository;

use App\Entity\Pilote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\NoReturn;

/**
 * @extends ServiceEntityRepository<Pilote>
 *
 * @method Pilote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pilote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pilote[]    findAll()
 * @method Pilote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiloteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pilote::class);
    }

    public function add(Pilote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pilote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

        #[NoReturn] public function findAllEmptyQuery(int $number): Query
        {
//            SELECT * FROM  `race__car` , race__pilote where race__car.id not in (SELECT car_id from race__pilote) or race__car.id = race__pilote.car_id GROUP by race__car.id;
        $qb = $this->createQueryBuilder('p');
        $qb
            ->addSelect('c' )
            ->from('App:Car', 'c')
            ->andWhere($qb->expr()->notIn('c', 'p.car'))
            ->orWhere('c = p.car')
            ->Having('COUNT(p.car) < 3')
            ->groupBy('c.id')
        ;

//        dump($qb->getQuery()->getDQL());
//        dd($qb->getQuery()->getSQL());
        return $qb->getQuery();
    }

//    /**
//     * @return Pilote[] Returns an array of Pilote objects
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

//    public function findOneBySomeField($value): ?Pilote
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
