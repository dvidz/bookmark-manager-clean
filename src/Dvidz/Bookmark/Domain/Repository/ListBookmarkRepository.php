<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Repository;

use Dvidz\Bookmark\Domain\Entity\Bookmark;

/**
 * interface ListBookmarkRepository.
 */
interface ListBookmarkRepository
{
    /**
     * @return Bookmark[]
     */
    public function listBookmark(): array;
}
