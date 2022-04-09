<?php

declare(strict_types=1);

namespace Api\Bookmark\Bus\Response;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Application\ViewModel\ViewModel;
use Dvidz\Shared\Domain\AggregateRoot;

/**
 * class BookmarkListViewModel.
 */
class BookmarkListViewModel implements ViewModel
{
    protected array $list;

    /**
     * BookmarkListViewModel constructor.
     */
    public function __construct()
    {
        $this->list = [];
    }

    /**
     * @return array
     */
    public function getView(): array
    {
        return $this->list;
    }

    /**
     * @param Bookmark[] $bookmarks
     *
     * @return $this
     */
    public function create(AggregateRoot|array $bookmarks): self
    {
        $bookmarkViewModel = new BookmarkViewModel();

        foreach ($bookmarks as $bookmark) {
            $this->list[] = $bookmarkViewModel->create($bookmark);
        }

        return $this;
    }
}
