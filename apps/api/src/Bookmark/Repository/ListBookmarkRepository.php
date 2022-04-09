<?php

declare(strict_types=1);

namespace Api\Bookmark\Repository;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Repository\ListBookmarkRepository as DomainListBookmarkRepository;
use Dvidz\Shared\Infrastructure\Symfony\Repository\BaseRepository;

/**
 * Class ListBookmarkRepository.
 */
class ListBookmarkRepository extends BaseRepository implements DomainListBookmarkRepository
{
    /**
     * @return array|Bookmark[]
     */
    public function listBookmark(): array
    {
        return $this->findAll();
    }

    /**
     * @return string
     */
    protected function className() : string
    {
        return Bookmark::class;
    }
}
