<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\List\Query;

use Dvidz\Bookmark\Application\List\Response\ListResponse;
use Dvidz\Bookmark\Domain\Repository\ListBookmarkRepository;

/**
 * Class ListBookmarkFinder.
 */
class ListFinder
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
     * @return ListResponse
     */
    public function __invoke() :ListResponse
    {
        $listBookmark = $this->listBookmarkRepository->listBookmark();

        return new ListResponse($listBookmark);
    }
}
