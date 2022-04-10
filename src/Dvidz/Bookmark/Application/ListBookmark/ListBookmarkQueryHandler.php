<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\ListBookmark;

use Dvidz\Shared\Domain\Query\QueryHandler;

/**
 * class ListQueryHandler.
 */
class ListBookmarkQueryHandler implements QueryHandler
{
    /**
     * @param BookmarkFinder $listFinder
     */
    public function __construct(private BookmarkFinder $listFinder)
    {
    }

    /**
     * @param ListBookmarkQuery $query
     *
     * @return ListBookmarkResponse
     */
    public function __invoke(ListBookmarkQuery $query): ListBookmarkResponse
    {
        return $this->listFinder->__invoke();
    }
}
