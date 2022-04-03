<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Model\BookmarkModelDto;

/**
 * Interface ScrapperInterface.
 */
interface ScrapperInterface
{
    /**
     * @param string $url
     *
     * @return BookmarkModelDto
     */
    public function scrap(string $url): BookmarkModelDto;
}
