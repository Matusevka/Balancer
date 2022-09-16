<?php

namespace App\Repository;

use App\Entity\Processes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Processes>
 *
 * @method Processes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Processes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Processes[]    findAll()
 * @method Processes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcessesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Processes::class);
    }

    public function add(Processes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Processes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getSummary(int $work_id): mixed
    {
        $dql = "SELECT sum(count_process) AS all_count_process, sum(memory) AS all_memory FROM App\Entity\Processes WHERE work = :work_id";
        return $this->getEntityManager()->createQuery($dql)->setParameter('work_id', $work_id)->getResult();          
    }

//    /**
//     * @return Processes[] Returns an array of Processes objects
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

//    public function findOneBySomeField($value): ?Processes
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
