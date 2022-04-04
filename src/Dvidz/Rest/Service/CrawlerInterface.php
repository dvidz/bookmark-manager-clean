<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Model\BookmarkModelDto;

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
