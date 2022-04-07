<?php

declare(strict_types=1);

namespace Dvidz\Shared\Infrastructure;

/**
 * Interface CrawlerInterface.
 */
interface CrawlerInterface
{
    /**
     * @param string $url
     *
     * @return array
     */
    public function crawl(string $url): array;
}
