<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CrawlUrl;

/**
 * Interface UrlCrawler.
 */
interface UrlCrawler
{
    /**
     * @param string $url
     *
     * @return UrlCrawlerResponse
     */
    public function crawl(string $url): UrlCrawlerResponse;
}
