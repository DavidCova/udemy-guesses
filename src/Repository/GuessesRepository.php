<?php

namespace App\Repository;

use App\Entity\Guesses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guesses>
 *
 * @method Guesses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guesses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guesses[]    findAll()
 * @method Guesses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuessesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guesses::class);
    }

    public function save(Guesses $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Guesses $entity, bool $flush = FALSE): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Guesses[] Returns an array of Guesses objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Guesses
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
