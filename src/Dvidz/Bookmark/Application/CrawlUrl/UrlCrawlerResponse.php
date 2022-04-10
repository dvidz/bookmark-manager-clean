<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CrawlUrl;

use Dvidz\Shared\Domain\Response\Response;

/**
 * Class UrlCrawlerResponse.
 */
class UrlCrawlerResponse implements Response
{
    /**
     * @param array $data
     */
    public function __construct(protected array $data)
    {
    }

    /**
     * @return array
     */
    public function respond(): array
    {
        return $this->data;
    }
}
