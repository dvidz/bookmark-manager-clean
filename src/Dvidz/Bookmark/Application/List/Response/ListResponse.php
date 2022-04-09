<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\List\Response;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Domain\Bus\Response\Response;

/**
 * Class ListBookmarkResponse.
 */
class ListResponse implements Response
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
