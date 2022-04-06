<?php

namespace App\Symfony\Rest\Service;

use App\Symfony\Rest\Entity\Bookmark;
use App\Symfony\Rest\Entity\ImageSize;
use App\Symfony\Rest\Entity\LinkProvider;
use App\Symfony\Rest\Entity\LinkProviderInterface;
use App\Symfony\Rest\Entity\MediaSizeInterface;
use App\Symfony\Rest\Entity\TypeLink;
use App\Symfony\Rest\Entity\TypeLinkInterface;
use App\Symfony\Rest\Entity\VideoSize;
use App\Symfony\Rest\Exception\MediaTypeException;
use App\Symfony\Rest\Model\BookmarkModelDto;
use App\Symfony\Rest\Repository\ImageSizeRepository;
use App\Symfony\Rest\Repository\LinkProviderRepository;
use App\Symfony\Rest\Repository\TypeLinkRepository;
use App\Symfony\Rest\Repository\VideoSizeRepository;

/**
 * Class BookMarkBuilder.
 */
class BookMarkBuilder implements BookmarkBuilderInterface
{
    /**
     * @var LinkProviderRepository
     */
    protected LinkProviderRepository $linkProviderRepository;

    /**
     * @var TypeLinkRepository
     */
    protected TypeLinkRepository $typeLinkRepository;

    /**
     * @var VideoSizeRepository
     */
    protected VideoSizeRepository $videoSizeRepository;

    /**
     * @var ImageSizeRepository
     */
    protected ImageSizeRepository $imageSizeRepository;

    /**
     * @param LinkProviderRepository $linkProviderRepository
     * @param TypeLinkRepository     $typeLinkRepository
     * @param VideoSizeRepository    $videoSizeRepository
     * @param ImageSizeRepository    $imageSizeRepository
     */
    public function __construct(LinkProviderRepository $linkProviderRepository, TypeLinkRepository $typeLinkRepository, VideoSizeRepository $videoSizeRepository, ImageSizeRepository $imageSizeRepository)
    {
        $this->linkProviderRepository = $linkProviderRepository;
        $this->typeLinkRepository = $typeLinkRepository;
        $this->videoSizeRepository = $videoSizeRepository;
        $this->imageSizeRepository = $imageSizeRepository;
    }

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return LinkProviderInterface
     */
    public function buildLinkProvider(BookmarkModelDto $bookmarkModelDto): LinkProviderInterface
    {
        // Check if linkProvider exist.
        if (!empty($linkProvider = $this->linkProviderRepository->findOneBy(['providerName' => $bookmarkModelDto->providerName]))) {
            return $linkProvider;
        }

        return (new LinkProvider())
            ->setProviderName($bookmarkModelDto->providerName);
    }

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return TypeLinkInterface
     */
    public function buildTypeLink(BookmarkModelDto $bookmarkModelDto): TypeLinkInterface
    {
        // Check if TypeLink is already registered in database.
        if (!empty($typeLink = $this->typeLinkRepository->findOneBy(['typeLinkName' => $bookmarkModelDto->type]))) {
            return $typeLink;
        }

        return (new TypeLink())
            ->setTypeLinkName($bookmarkModelDto->type);
    }

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return MediaSizeInterface
     *
     * @throws MediaTypeException
     */
    public function buildMediaSize(BookmarkModelDto $bookmarkModelDto): MediaSizeInterface
    {
        // TODO : Add a strategy pattern.
        if ('video' === $bookmarkModelDto->type) {
            if (!empty($videoSize = $this->videoSizeRepository->findOneBy([
                'width' => $bookmarkModelDto->videoWidth,
                'height' => $bookmarkModelDto->videoHeight,
                'duration' => $bookmarkModelDto->videoDuration,
            ]))) {
                return $videoSize;
            }

            return (new VideoSize())
                ->setWidth((float) $bookmarkModelDto->videoWidth)
                ->setHeight((float) $bookmarkModelDto->videoHeight)
                ->setDuration($bookmarkModelDto->videoDuration);
        }

        if ('photo' === $bookmarkModelDto->type) {
            if (!empty($imageSize = $this->imageSizeRepository->findOneBy([
                'width' => $bookmarkModelDto->imageWidth,
                'height' => $bookmarkModelDto->imageHeight,
            ]))) {
                return $imageSize;
            }

            return (new ImageSize())
                ->setWidth((float) $bookmarkModelDto->imageWidth)
                ->setHeight((float) $bookmarkModelDto->imageHeight);
        }

        throw new MediaTypeException(sprintf(
            'Can not handle MediaSize with this bookmark type %s',
            $bookmarkModelDto->type
        ));
    }

    /**
     * @param BookmarkModelDto $bookmarkModelDto
     *
     * @return Bookmark
     *
     * @throws MediaTypeException
     * @throws \Exception
     */
    public function buildBookmark(BookmarkModelDto $bookmarkModelDto): Bookmark
    {
        $linkProvider = $this->buildLinkProvider($bookmarkModelDto);
        $typeLink = $this->buildTypeLink($bookmarkModelDto);
        $mediaSize = $this->buildMediaSize($bookmarkModelDto);
        $mediaSize->addTypeLink($typeLink);

        $bookmark = (new Bookmark())
            ->setUrl($bookmarkModelDto->url)
            ->setLinkProvider($linkProvider)
            ->setTypeLink($typeLink)
            ->setLinkAuthor((string) $bookmarkModelDto->linkAuthor)
            ->setLinkTitle((string) $bookmarkModelDto->linkTitle)
            ->setPublicationDate(new \DateTimeImmutable((string) $bookmarkModelDto->publishedDate))
            ->setCreatedAt(new \DateTimeImmutable());

        if ('video' === $typeLink->getTypeLinkName()) {
            $bookmark->setVideoSize($mediaSize);
        }

        if ('photo' === $typeLink->getTypeLinkName()) {
            $bookmark->setImageSize($mediaSize);
        }

        return $bookmark;
    }
}
