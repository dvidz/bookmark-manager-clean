<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Manager;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Exception\BookmarkNotFoundException;
use App\Dvidz\Rest\Exception\MalformedUrlException;
use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Model\BookmarkViewModel;
use App\Dvidz\Rest\Model\BookmarkViewModelInterface;
use App\Dvidz\Rest\Service\BookmarkBuilderInterface;
use App\Dvidz\Rest\Service\BookmarkServiceInterface;
use App\Dvidz\Rest\Service\ScrapperInterface;
use Assert\Assertion;
use Assert\AssertionFailedException;

/**
 * Class BookmarkManager.
 */
class BookmarkManager
{
    /**
     * @var ScrapperInterface
     */
    protected ScrapperInterface $scrapper;

    /**
     * @var BookmarkBuilderInterface
     */
    protected BookmarkBuilderInterface $bookmarkBuilder;

    /**
     * @var BookmarkServiceInterface
     */
    protected BookmarkServiceInterface $bookmarkService;

    /**
     * @param ScrapperInterface        $scrapper
     * @param BookmarkBuilderInterface $bookmarkBuilder
     * @param BookmarkServiceInterface $bookmarkService
     */
    public function __construct(ScrapperInterface $scrapper, BookmarkBuilderInterface $bookmarkBuilder, BookmarkServiceInterface $bookmarkService)
    {
        $this->scrapper = $scrapper;
        $this->bookmarkBuilder = $bookmarkBuilder;
        $this->bookmarkService = $bookmarkService;
    }

    /**
     * @param string $linkUrl
     *
     * @return BookmarkInterface
     *
     * @throws MalformedUrlException
     */
    public function bookmark(string $linkUrl): BookmarkInterface
    {
        try {
            Assertion::url($linkUrl);
        } catch (AssertionFailedException $e) {
            throw new MalformedUrlException();
        }

        // Check if link was already bookmarked.
        if (empty($bookmark = $this->bookmarkService->findOneBookmarkBy(['id' => $linkUrl]))) {
            // Extract link data to the DTO.
            $dto = $this->scrapper->scrap($linkUrl);

            // Build the bookmark.
            $bookmark = $this->bookmarkBuilder->buildBookmark($dto);

            // Add bookmark to database.
            $this->bookmarkService->addBookmark($bookmark);
        }

        return $bookmark;
    }

    /**
     * @param BookmarkInterface $bookmark
     *
     * @return BookmarkViewModelInterface
     *
     * @throws MediaTypeException
     */
    public function getViewModel(BookmarkInterface $bookmark): BookmarkViewModelInterface
    {
        return BookmarkViewModel::getViewModel($bookmark);
    }

    /**
     * @return array
     */
    public function bookmarkList(): array
    {
        return $this->bookmarkService->findAll();
    }

    /**
     * @param array $bookmarkList
     *
     * @return array
     *
     * @throws MediaTypeException
     */
    public function getListViewModel(array $bookmarkList): array
    {
        $listViewModel = [];

        if (!empty($bookmarkList)) {
            foreach ($bookmarkList as $item) {
                $listViewModel[] = $this->getViewModel($item);
            }
        }

        return $listViewModel;
    }

    /**
     * @param BookmarkInterface|null $bookmark
     *
     * @return void
     *
     * @throws BookmarkNotFoundException
     */
    public function removeBookmark(?BookmarkInterface $bookmark): void
    {
        if (null === $bookmark) {
            throw new BookmarkNotFoundException();
        }

        $this->bookmarkService->removeBookmark($bookmark);
    }
}
