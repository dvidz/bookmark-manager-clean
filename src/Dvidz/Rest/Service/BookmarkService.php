<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Exception\MalformedUrlException;
use App\Dvidz\Rest\Model\BookmarkModelDto;
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
            // Crawl url.
            $data = $this->crawler->crawl($url);

            // Build bookmark.
            $bookmark = $this->bookmarkBuilder->buildBookmark(
                $this->buildBookmarkModelDto($data, $url)
            );

            // Register bookmark.
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

    /**
     * @param array  $data
     * @param string $url
     *
     * @return BookmarkModelDto
     */
    private function buildBookmarkModelDto(array $data, string $url): BookmarkModelDto
    {
        $bookmarkModelDto = new BookmarkModelDto();

        $bookmarkModelDto->url = $url;
        $bookmarkModelDto->linkTitle = $data['title'] ?? null;
        $bookmarkModelDto->providerName = $data['provider_name'] ?? null;
        $bookmarkModelDto->linkAuthor = $data['author_url'] ?? null;
        $bookmarkModelDto->publishedDate = $data['publishedDate'] ?? null;
        $bookmarkModelDto->type = $data['type'] ?? null;
        $bookmarkModelDto->imageWidth = strval($data['imageWidth']);
        $bookmarkModelDto->imageHeight = strval($data['imageHeight']);
        $bookmarkModelDto->videoWidth = strval($data['videoWidth']);
        $bookmarkModelDto->videoHeight = strval($data['videoHeight']);
        $bookmarkModelDto->videoDuration = strval($data['duration']);

        return $bookmarkModelDto;
    }
}
