<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Service;

use App\Symfony\Rest\Entity\Bookmark;
use App\Symfony\Rest\Entity\LinkProviderInterface;
use App\Symfony\Rest\Entity\MediaSizeInterface;
use App\Symfony\Rest\Entity\TypeLinkInterface;
use App\Symfony\Rest\Model\BookmarkModelDto;

/**
 * Interface BookmarkBuilderInterface.
 */
interface BookmarkBuilderInterface
{
    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return LinkProviderInterface
     */
    public function buildLinkProvider(BookmarkModelDto $bookmarkModelDto): LinkProviderInterface;

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return TypeLinkInterface
     */
    public function buildTypeLink(BookmarkModelDto $bookmarkModelDto): TypeLinkInterface;

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return MediaSizeInterface
     */
    public function buildMediaSize(BookmarkModelDto $bookmarkModelDto): MediaSizeInterface;

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return Bookmark
     */
    public function buildBookmark(BookmarkModelDto $bookmarkModelDto): Bookmark;
}
