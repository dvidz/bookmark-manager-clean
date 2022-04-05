<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Repository;

use App\Dvidz\Rest\Entity\Bookmark;
use App\Dvidz\Rest\Entity\BookmarkInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class BookmarkRepository.
 */
class BookmarkRepository extends ServiceEntityRepository implements BookmarkRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookmark::class);
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function saveBookmark(Bookmark $bookmark): void
    {
        $em = $this->getEntityManager();
        $em->persist($bookmark);
        $em->flush();
    }

    /**
     * @param BookmarkInterface $bookmark
     *
     * @return void
     */
    public function removeBookmark(BookmarkInterface $bookmark): void
    {
        $em = $this->getEntityManager();
        $em->remove($bookmark);
        $em->flush();
    }
}
