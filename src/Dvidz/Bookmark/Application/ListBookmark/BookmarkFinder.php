<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\ListBookmark;

use Dvidz\Bookmark\Domain\Repository\ListBookmarkRepository;

/**
 * Class ListBookmarkFinder.
 */
class BookmarkFinder
{
    /**
     * @var ListBookmarkRepository
     */
    protected ListBookmarkRepository $listBookmarkRepository;

    /**
     * @param ListBookmarkRepository $listBookmarkRepository
     */
    public function __construct(ListBookmarkRepository $listBookmarkRepository)
    {
        $this->listBookmarkRepository = $listBookmarkRepository;
    }

    /**
     * @return ListBookmarkResponse
     */
    public function __invoke() :ListBookmarkResponse
    {
        $listBookmark = $this->listBookmarkRepository->listBookmark();

        return new ListBookmarkResponse($listBookmark);
    }
}
