<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Repository;

use Dvidz\Bookmark\Domain\Bookmark;

/**
 * Interface BookmarkRepository.
 */
interface BookmarkRepository
{
    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function bookmark(Bookmark $bookmark): void;
}
