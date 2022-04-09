<?php

namespace Api\Bookmark\Query;

use Dvidz\Bookmark\Application\ListBookmark\ListBookmarkQuery;
use Dvidz\Bookmark\Application\ListBookmark\ListBookmarkQueryHandler;
use Dvidz\Bookmark\Application\ListBookmark\ListBookmarkResponse;
use Dvidz\Shared\Domain\Query\Query;
use Dvidz\Shared\Domain\Query\QueryBus;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * class ListQueryBus
 */
class ListQueryBus implements QueryBus
{
    /**
     * @var MessageBus
     */
    private MessageBus $bus;

    /**
     * @param ListBookmarkQueryHandler $handler
     */
    public function __construct(protected ListBookmarkQueryHandler $handler)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                ListBookmarkQuery::class => [$handler],
            ])),
        ]);
    }

    /**
     * @param Query $query
     *
     * @return ListBookmarkResponse|null
     */
    public function ask(Query $query): ?ListBookmarkResponse
    {
        /** @var HandledStamp $stamp */
        $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
