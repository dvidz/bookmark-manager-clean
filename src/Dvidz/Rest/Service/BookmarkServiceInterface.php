<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Entity\Bookmark;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class BookmarkServiceInterface.
 */
interface BookmarkServiceInterface
{
    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function addBookmark(Bookmark $bookmark): void;

    /**
     * @param array $parameters
     *
     * @return mixed|object|null
     */
    public function findOneBookmarkBy(array $parameters);

    /**
     * @return array
     */
    public function findAll(): array;
}
