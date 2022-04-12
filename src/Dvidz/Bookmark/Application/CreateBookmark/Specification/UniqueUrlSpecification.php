<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CreateBookmark\Specification;

use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlAlreadyBookmarkedException;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository;
use \Dvidz\Bookmark\Domain\Specification\UniqueUrlSpecification as DomainUniqueUrlSpecification;

/**
 * Class UniqueUrlSpecification.
 */
class UniqueUrlSpecification implements DomainUniqueUrlSpecification
{
    /**
     * @param BookmarkRepository $bookmarkRepository
     */
    public function __construct(protected BookmarkRepository $bookmarkRepository)
    {
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws UrlAlreadyBookmarkedException
     */
    public function isSatisfiedBy(string $value): bool
    {
        if (!is_null($this->bookmarkRepository->findOneByUrl($value))) {
            throw new UrlAlreadyBookmarkedException('Url is already bookmarked');
        }

        return true;
    }

    /**
     * @param Url $url
     *
     * @return bool
     *
     * @throws UrlAlreadyBookmarkedException
     */
    public function isUniqueUrl(Url $url): bool
    {
        return $this->isSatisfiedBy($url->value());
    }
}
