<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Entity\Bookmark;
use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Repository\BookmarkRepository;

/**
 * Class BookmarkService.
 */
class BookmarkService implements BookmarkServiceInterface
{
    /**
     * @var BookmarkRepository
     */
    protected BookmarkRepository $bookmarkRepository;

    /**
     * @param BookmarkRepository $bookmarkRepository
     */
    public function __construct(BookmarkRepository $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function addBookmark(Bookmark $bookmark): void
    {
        $this->bookmarkRepository->saveBookmark($bookmark);
    }

    /**
     * @param array $parameters
     *
     * @return mixed|object|null
     */
    public function findOneBookmarkBy(array $parameters)
    {
        return $this->bookmarkRepository->findOneBy($parameters);
    }

    /**
     * @return array|Bookmark[]
     */
    public function findAll(): array
    {
        return $this->bookmarkRepository->findAll();
    }

    /**
     * @param BookmarkInterface $bookmark
     *
     * @return void
     */
    public function removeBookmark(BookmarkInterface $bookmark): void
    {
        $this->bookmarkRepository->removeBookmark($bookmark);
    }
}
