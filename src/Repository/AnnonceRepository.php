<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 *
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function add(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findUser ($user) {
        return $this->createQueryBuilder('a')
        ->andWhere('a.user = :user')
        ->setParameter('user', $user)
        ->getQuery()
        ->getResult()
    ;
    }
    public function findWithSearch (Search $search) {
        $query = $this
            ->createQueryBuilder('a')
            ->select('a','d', 'c')
            ->join('a.deal', 'd' )
            ->join('a.category', 'c');

        if (!empty($search->deal)) {
            $query = $query
            ->andWhere('d.id IN (:deal)')
            ->setParameter('deal', $search->deal);
        }

        if (!empty($search->categories)) {
            $query = $query
            ->andWhere('c.id IN (:categories)')
            ->setParameter('categories', $search->categories);
        }

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('a.name LIKE :string')
                ->setParameter('string', "%{$search->string}%"); // recherche partielle   
        }

        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Annonce[] Returns an array of Annonce objects
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

//    public function findOneBySomeField($value): ?Annonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
