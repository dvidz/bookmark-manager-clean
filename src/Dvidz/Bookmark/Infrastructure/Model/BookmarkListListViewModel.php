<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Model;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Domain\Model\ListViewModel;
use Dvidz\Shared\Domain\Response\Response;

/**
 * class BookmarkListViewModel.
 */
class BookmarkListListViewModel implements ListViewModel
{
    protected array $list = [];

    /**
     * BookmarkListViewModel constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        foreach ($response->respond() as $bookmark) {
            $this->addToList($bookmark);
        }
    }

    /**
     * @param Response $reponse
     *
     * @return $this
     */
    public static function createFromResponse(Response $reponse): self
    {
        return new self($reponse);
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->list;
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    private function addToList(Bookmark $bookmark)
    {
        $this->list[] = BookmarkItemViewModel::createFromAggregate($bookmark);
    }
}
