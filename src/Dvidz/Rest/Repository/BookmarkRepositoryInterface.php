<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Repository;

use App\Dvidz\Rest\Entity\Bookmark;

/**
 * Interface BookmarkRepositoryInterface.
 */
interface BookmarkRepositoryInterface
{
    /**
     * @param Bookmark $bookmark
     *
     * @return mixed
     */
    public function saveBookmark(Bookmark $bookmark);
}
