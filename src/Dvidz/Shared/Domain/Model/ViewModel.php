<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Model;

use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawlerResponse;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Interface ViewModel.
 */
interface ViewModel
{
    /**
     * UrlCrawlerResponse $object
     *
     * @return static
     */
    public static function createFromResponse(Response $response): self;
}
