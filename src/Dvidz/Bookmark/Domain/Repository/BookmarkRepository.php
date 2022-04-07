<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Repository;

use Dvidz\Bookmark\Domain\Aggregate\Bookmark;

/**
 * Interface BookmarkRepository.
 */
interface BookmarkRepository
{
    /**
     * @param Bookmark $bookmark
     *
     * @return mixed
     */
    public function bookmark(Bookmark $bookmark);
}
