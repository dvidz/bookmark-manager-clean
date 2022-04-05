<?php

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Repository\BookmarkRepositoryInterface;

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
