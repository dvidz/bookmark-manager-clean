<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Repository;

use App\Symfony\Rest\Entity\LinkProvider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class LinkProviderRepository.
 */
class LinkProviderRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkProvider::class);
    }
}
