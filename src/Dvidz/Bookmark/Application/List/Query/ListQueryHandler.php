<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\List\Query;

use Dvidz\Bookmark\Application\List\Response\ListResponse;
use Dvidz\Shared\Domain\Bus\Query\QueryHandler;

/**
 * class ListQueryHandler.
 */
class ListQueryHandler implements QueryHandler
{
    /**
     * @param ListFinder $listFinder
     */
    public function __construct(private ListFinder $listFinder)
    {
    }

    /**
     * @param ListQuery $query
     *
     * @return ListResponse
     */
    public function __invoke(ListQuery $query): ListResponse
    {
        return $this->listFinder->__invoke();
    }
}
