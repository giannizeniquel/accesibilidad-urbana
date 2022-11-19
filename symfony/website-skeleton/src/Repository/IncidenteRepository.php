<?php

namespace App\Repository;

use App\Entity\Incidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Incidente>
 *
 * @method Incidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incidente[]    findAll()
 * @method Incidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Incidente::class);
    }

    public function add(Incidente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Incidente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Incidente[] Returns an array of Incidente objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findAllSector($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.calles','calle')
            ->join('calle.calleSectors','cs')
            ->join('cs.idSector','sect')
            ->andWhere('sect.id = :val')
            ->andWhere('i.altura BETWEEN sect.alturaInicial AND sect.alturaFinal')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findCalleNombre($calle){

        return $this->createQueryBuilder('i')
            ->join('i.calles','calle')
            ->andWhere('calle.nombre like :val')
            ->setParameter('val', '%'.$calle.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getExiste($idCalle, $altura){

        return $this->createQueryBuilder('i')
            ->join('i.calles','calle')
            ->andWhere('calle.id =  :idCalle')
            ->andWhere('i.altura BETWEEN  (:altura - 200) AND (:altura + 200)')
            ->setParameter('idCalle', $idCalle)
            ->setParameter('altura', $altura)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneORNullResult()
        ;
    }
}
