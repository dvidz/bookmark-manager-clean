<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Presenter;

use Dvidz\Bookmark\Infrastructure\Model\BookmarkListListViewModel;
use Dvidz\Shared\Domain\Presenter\Presenter as DomainPresenter;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Class BookmarkListPresenter.
 */
class BookmarkListPresenter implements DomainPresenter
{
    /**
     * @var BookmarkListListViewModel
     */
    protected BookmarkListListViewModel $bookmarListViewModel;

    /**
     * @param Response $response
     *
     * @return void
     */
    public function present(Response $response): void
    {
        $this->bookmarListViewModel = new BookmarkListListViewModel($response);
    }

    /**
     * @return BookmarkListListViewModel
     */
    public function getView(): BookmarkListListViewModel
    {
        return $this->bookmarListViewModel;
    }
}
