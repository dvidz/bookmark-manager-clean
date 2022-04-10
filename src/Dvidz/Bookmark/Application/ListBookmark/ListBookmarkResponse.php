<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\ListBookmark;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Class ListBookmarkResponse.
 */
class ListBookmarkResponse implements Response
{
    /**
     * @param Bookmark[] $bookmarks
     */
    public function __construct(protected array $bookmarks)
    {
    }

    /**
     * @return array
     */
    public function respond(): array
    {
        return $this->bookmarks;
    }
}
