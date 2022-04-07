<?php

namespace Dvidz\Bookmark\Infrastructure\Repository;

use App\Symfony\Rest\Entity\ImageSize;
use App\Symfony\Rest\Entity\LinkProvider;
use App\Symfony\Rest\Entity\TypeLink;
use App\Symfony\Rest\Entity\VideoSize;
use Dvidz\Bookmark\Domain\Aggregate\Bookmark;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository as DomainBookmarkRepository;
use Dvidz\Bookmark\Infrastructure\Entity\Bookmark as BookmarkEntity;

class InMemoryBookmarkRepository implements DomainBookmarkRepository
{
    /**
     * @var BookmarkEntity[]
     */
    protected array $bookmarks;

    /**
     * @param Bookmark $bookmark
     *
     * @return mixed|void
     */
    public function bookmark(Bookmark $bookmark)
    {
        $bookmarkEntity = new BookmarkEntity();

        $typeLinkEntity = new TypeLink();
        $typeLinkEntity->setTypeLinkName((string) $bookmark->type());

        if (null !== $bookmark->mediaSize()->duration()) {
            $videoSize = new VideoSize();
            $videoSize->setDuration(strval($bookmark->mediaSize()->duration()))
                ->setWidth($bookmark->mediaSize()->width())
                ->setHeight($bookmark->mediaSize()->height())
                ->addTypeLink($typeLinkEntity);

            $bookmarkEntity->setVideoSize($videoSize);
        } else {
            $imageSize = new ImageSize();
            $imageSize->setWidth($bookmark->mediaSize()->width())
                ->setHeight($bookmark->mediaSize()->height())
                ->addTypeLink($typeLinkEntity);

            $bookmarkEntity->setImageSize($imageSize);
        }

        $linkProvider = new LinkProvider();
        $linkProvider->addTypeLink($typeLinkEntity);
        $linkProvider->setProviderName((string) $bookmark->provider());

        $bookmarkEntity->setId($bookmark->uuid());
        $bookmarkEntity->setUrl((string) $bookmark->url());
        $bookmarkEntity->setTypeLink($typeLinkEntity);
        $bookmarkEntity->setCreatedAt($bookmark->createdAt());
        $bookmarkEntity->setPublicationDate($bookmark->publishedAt());
        $bookmarkEntity->setLinkAuthor((string) $bookmark->author());
        $bookmarkEntity->setLinkProvider($linkProvider);
        $bookmarkEntity->setLinkTitle((string) $bookmark->title());

        $this->addBookmark($bookmarkEntity);
    }

    /**
     * @param string $uuid
     *
     * @return BookmarkEntity
     */
    public function getBookmark(string $uuid)
    {
        return $this->bookmarks[$uuid];
    }

    /**
     * @param BookmarkEntity $bookmark
     *
     * @return void
     */
    private function addBookmark(BookmarkEntity $bookmark)
    {
        $this->bookmarks[$bookmark->getId()] = $bookmark;
    }
}
