<?php

namespace Api\Bookmark\Query;

use Dvidz\Bookmark\Application\ListBookmark\ListBookmarkResponse;
use Dvidz\Shared\Domain\Query\Query;
use Dvidz\Shared\Domain\Query\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * class ListQueryBus
 */
class ListQueryBus implements QueryBus
{
    /**
     * @param MessageBusInterface $queryBus
     */
    public function __construct(protected MessageBusInterface $queryBus)
    {
    }

    /**
     * @param Query $query
     *
     * @return ListBookmarkResponse|null
     */
    public function ask(Query $query): ?ListBookmarkResponse
    {
        /** @var HandledStamp $stamp */
        $stamp = $this->queryBus->dispatch($query)->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
