<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Model\BookmarkModelDto;

/**
 * Interface ScrapperInterface.
 */
interface ScrapperInterface
{
    public function scrap(string $url): BookmarkModelDto;
}
