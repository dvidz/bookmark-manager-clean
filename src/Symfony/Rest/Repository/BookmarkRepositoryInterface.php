<?php

namespace App\Symfony\Rest\Repository;

use App\Symfony\Rest\Entity\Bookmark;
use App\Symfony\Rest\Entity\BookmarkInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class BookmarkRepositoryInterface.
 */
interface BookmarkRepositoryInterface extends ObjectRepository
{
    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function saveBookmark(Bookmark $bookmark): void;

    /**
     * @param BookmarkInterface $bookmark
     *
     * @return void
     */
    public function removeBookmark(BookmarkInterface $bookmark): void;
}
