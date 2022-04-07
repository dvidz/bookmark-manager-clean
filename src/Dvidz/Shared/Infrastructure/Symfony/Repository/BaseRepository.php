<?php

namespace Dvidz\Shared\Infrastructure\Symfony\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry     $registry
     * @param SerializerInterface $serializer
     */
    public function __construct(ManagerRegistry $registry, protected SerializerInterface $serializer)
    {
        parent::__construct($registry, $this->className());
    }

    /**
     * @return string
     */
    protected function className() : string
    {
        return '';
    }
}
