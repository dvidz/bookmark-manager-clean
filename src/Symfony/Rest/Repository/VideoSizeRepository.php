<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Repository;

use App\Symfony\Rest\Entity\VideoSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class VideoSizeRepository.
 */
class VideoSizeRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoSize::class);
    }
}
