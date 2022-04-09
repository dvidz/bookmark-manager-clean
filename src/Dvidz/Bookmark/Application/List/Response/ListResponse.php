<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\List\Response;

use Dvidz\Shared\Domain\Bus\Response\Response;

/**
 * Class ListBookmarkResponse.
 */
class ListResponse implements Response
{
    /**
     * @param array $bookmarks
     */
    public function __construct(protected array $bookmarks)
    {
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->bookmarks;
    }
}
