<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Repository;

/**
 * Interface DeleteBookmarkRepository
 */
interface DeleteBookmarkRepository
{
    /**
     * @param string $uuid
     *
     * @return bool
     */
    public function deleteBookmark(string $uuid): bool;
}
