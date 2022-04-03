<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Manager;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Model\BookmarkViewModel;
use App\Dvidz\Rest\Model\BookmarkViewModelInterface;
use App\Dvidz\Rest\Service\BookmarkBuilderInterface;
use App\Dvidz\Rest\Service\BookmarkServiceInterface;
use App\Dvidz\Rest\Service\ScrapperInterface;

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
     */
    public function bookmark(string $linkUrl): BookmarkInterface
    {
        // Check if link was already bookmarked.
        if(empty($bookmark = $this->bookmarkService->findOneBookmarkBy(['id' => $linkUrl]))) {
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
}
