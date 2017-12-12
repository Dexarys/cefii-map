<?php

namespace App\Repository;

use App\Entity\StudentLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StudentLocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StudentLocation::class);
    }

    public function findMarkers()
    {
        return $this->createQueryBuilder('m')
        ->select('m.latitude, m.longitude')
        ->getQuery()
        ->getResult();
    }


}
