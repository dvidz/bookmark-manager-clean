<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CrawlUrl;

use Dvidz\Shared\Domain\Query\Query;

/**
 * Class UrlCrawlerQuery.
 */
class UrlCrawlerQuery implements Query
{
    public string $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }
}
