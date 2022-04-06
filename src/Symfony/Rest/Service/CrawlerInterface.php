<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Service;

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
