<?php

declare(strict_types=1);

namespace Api\Bookmark\Repository;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Repository\DeleteBookmarkRepository as DomainDeleteBookmarkRepository;
use Dvidz\Shared\Infrastructure\Symfony\Repository\BaseRepository;

/**
 * Class DeleteBookmarkRepository.
 */
class DeleteBookmarkRepository extends BaseRepository implements DomainDeleteBookmarkRepository
{
    /**
     * @param string $uuid
     *
     * @return bool
     */
    public function deleteBookmark(string $uuid): bool
    {
        try {
            $em = $this->getEntityManager();
            $bookmark = $this->findOneBy(['uuid' => $uuid]);
            $em->remove($bookmark);
            $em->flush();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return string
     */
    protected function className(): string
    {
        return Bookmark::class;
    }
}
