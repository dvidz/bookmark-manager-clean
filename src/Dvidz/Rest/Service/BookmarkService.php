<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Exception\MalformedUrlException;
use App\Dvidz\Rest\Repository\BookmarkRepositoryInterface;
use Assert\Assertion;
use Assert\AssertionFailedException;

/**
 * Class BookmarkService.
 */
class BookmarkService implements BookmarkServiceInterface
{
    /**
     * @var CrawlerInterface
     */
    protected CrawlerInterface $crawler;

    /**
     * @var BookmarkBuilderInterface
     */
    protected BookmarkBuilderInterface $bookmarkBuilder;

    /**
     * @var BookmarkRepositoryInterface
     */
    protected BookmarkRepositoryInterface $bookmarkRepository;

    /**
     * @param CrawlerInterface            $scrapper
     * @param BookmarkBuilderInterface    $bookmarkBuilder
     * @param BookmarkRepositoryInterface $bookmarkRepository
     */
    public function __construct(CrawlerInterface $scrapper, BookmarkBuilderInterface $bookmarkBuilder, BookmarkRepositoryInterface $bookmarkRepository)
    {
        $this->crawler = $scrapper;
        $this->bookmarkBuilder = $bookmarkBuilder;
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @param string $url
     *
     * @return BookmarkInterface
     *
     * @throws MalformedUrlException
     */
    public function bookmark(string $url): BookmarkInterface
    {
        try {
            Assertion::url($url);
        } catch (AssertionFailedException $e) {
            throw new MalformedUrlException();
        }

        // Check if link was already bookmarked.
        if (null === $bookmark = $this->bookmarkRepository->findOneBy(['url' => $url])) {
            // Extract link data to the DTO.
            $bookmarkDto = $this->crawler->crawl($url);

            // Build the bookmark.
            $bookmark = $this->bookmarkBuilder->buildBookmark($bookmarkDto);

            // Add bookmark to database.
            $this->bookmarkRepository->saveBookmark($bookmark);
        }

        return $bookmark;
    }

    /**
     * @return BookmarkRepositoryInterface
     */
    public function getRepository(): BookmarkRepositoryInterface
    {
        return $this->bookmarkRepository;
    }
}
