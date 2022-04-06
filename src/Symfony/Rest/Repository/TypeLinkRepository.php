<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Repository;

use App\Symfony\Rest\Entity\TypeLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TypeLinkRepository.
 */
class TypeLinkRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLink::class);
    }
}
