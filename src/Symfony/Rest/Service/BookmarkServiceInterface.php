<?php

namespace App\Symfony\Rest\Service;

use App\Symfony\Rest\Entity\BookmarkInterface;
use App\Symfony\Rest\Repository\BookmarkRepositoryInterface;

/**
 * Interface BookmarkServiceInterface.
 */
interface BookmarkServiceInterface
{
    /**
     * @param string $url
     *
     * @return BookmarkInterface
     */
    public function bookmark(string $url): BookmarkInterface;

    /**
     * @return BookmarkRepositoryInterface
     */
    public function getRepository(): BookmarkRepositoryInterface;
}
