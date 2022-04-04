<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

use App\Dvidz\Rest\Entity\BookmarkInterface;
use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Exception\NullTypeLinkException;

/**
 * Class BookmarkViewModel.
 */
class BookmarkViewModel extends BookmarkModelDto implements BookmarkViewModelInterface
{
    /**
     * @var string
     */
    public string $mediaSize;

    /**
     * @param BookmarkInterface $bookmark
     *
     * @throws MediaTypeException
     * @throws NullTypeLinkException
     */
    private function __construct(BookmarkInterface $bookmark)
    {
        if (null === $typeLink = $bookmark->getTypeLink()) {
            throw new NullTypeLinkException();
        }

        $this->id = $bookmark->getId();
        $this->type = $typeLink->getTypeLinkName();
        $this->url = $bookmark->getUrl();
        $this->providerName = $bookmark->getProviderName();
        $this->linkTitle = $bookmark->getLinkTitle();
        $this->linkAuthor = $bookmark->getLinkAuthor();
        $this->createAt = $bookmark->getCreatedAt()->format('Y-m-d');

        if (null !== $publicationDate = $bookmark->getPublicationDate()) {
            $this->publishedDate = $publicationDate->format('Y-m-d');
        }

        if ('video' === $this->type) {
            $this->videoHeight = strval($bookmark->getVideoSize()->getHeight());
            $this->videoWidth = strval($bookmark->getVideoSize()->getWidth());
            $this->videoDuration = $bookmark->getVideoSize()->getDuration();
        } elseif ('photo' === $this->type) {
            $this->imageHeight = strval($bookmark->getImageSize()->getHeight());
            $this->imageWidth = strval($bookmark->getImageSize()->getWidth());
        } else {
            throw new MediaTypeException('This link type is not supported.');
        }
    }

    /**
     * @param BookmarkInterface $bookmark
     *
     * @return BookmarkViewModelInterface
     *
     * @throws MediaTypeException
     * @throws NullTypeLinkException
     */
    public static function getViewModel(BookmarkInterface $bookmark): BookmarkViewModelInterface
    {
        return new self($bookmark);
    }
}
