<?php

namespace Api\Bookmark\Query;

use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawlerQuery;
use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawlerResponse;
use Dvidz\Bookmark\Application\CrawlUrl\UrlQueryHandler;
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
 * Class OembedCrawlQueryBus.
 */
class OembedCrawlQueryBus implements QueryBus
{
    /**
     * @var MessageBus
     */
    private MessageBus $bus;

    /**
     * @param UrlQueryHandler $handler
     */
    public function __construct(protected UrlQueryHandler $handler)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                UrlCrawlerQuery::class => [$handler],
            ])),
        ]);
    }

    /**
     * @param Query $query
     *
     * @return UrlCrawlerResponse|null
     */
    public function ask(Query $query): ?UrlCrawlerResponse
    {
        /** @var HandledStamp $stamp */
        $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
