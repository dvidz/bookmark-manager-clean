<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CrawlUrl;

use Dvidz\Shared\Domain\Query\QueryHandler;

/**
 * Class UrlQueryHandler.
 */
class UrlQueryHandler implements QueryHandler
{
    /**
     * @param UrlCrawler $crawler
     */
    public function __construct(protected UrlCrawler $crawler)
    {
    }

    /**
     * @param UrlCrawlerQuery $urlCrawlerQuery
     *
     * @return UrlCrawlerResponse
     */
    public function __invoke(UrlCrawlerQuery $urlCrawlerQuery): UrlCrawlerResponse
    {
        return $this->crawler->crawl($urlCrawlerQuery->url);
    }
}
