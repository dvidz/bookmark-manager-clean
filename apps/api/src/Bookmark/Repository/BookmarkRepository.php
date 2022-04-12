<?php

declare(strict_types=1);

namespace Api\Bookmark\Repository;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository as DomainBookmarkRepository;
use Dvidz\Shared\Infrastructure\Symfony\Repository\BaseRepository;

/**
 * Class BookmarkRepository.
 */
class BookmarkRepository extends BaseRepository implements DomainBookmarkRepository
{
    /**
     * @param Bookmark $bookmark
     */
    public function bookmark(Bookmark $bookmark): void
    {
        $em = $this->getEntityManager();
        $em->persist($bookmark);
        $em->flush();
    }

    /**
     * @param string $url
     *
     * @return Bookmark|null
     */
    public function findOneByUrl(string $url): ?Bookmark
    {
        return $this->findOneBy([
            'url.value' => $url,
        ]);
    }

    /**
     * @return string
     */
    protected function className(): string
    {
        return Bookmark::class;
    }
}
