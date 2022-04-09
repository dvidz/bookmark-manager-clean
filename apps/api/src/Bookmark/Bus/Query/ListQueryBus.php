<?php

namespace Api\Bookmark\Bus\Query;

use Dvidz\Bookmark\Application\List\Query\ListQuery;
use Dvidz\Bookmark\Application\List\Query\ListQueryHandler;
use Dvidz\Shared\Domain\Bus\Query\Query;
use Dvidz\Shared\Domain\Bus\Query\QueryBus;
use Dvidz\Shared\Domain\Bus\Response\Response;
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
     * @param ListQueryHandler $handler
     */
    public function __construct(protected ListQueryHandler $handler)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                ListQuery::class => [$handler],
            ])),
        ]);
    }

    /**
     * @param Query $query
     *
     * @return Response|null
     */
    public function ask(Query $query): ?Response
    {
        /** @var HandledStamp $stamp */
        $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
