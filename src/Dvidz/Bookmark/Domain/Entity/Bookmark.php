<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Entity;

use Dvidz\Bookmark\Domain\Entity\ValueType\Author;
use Dvidz\Bookmark\Domain\Entity\ValueType\BookmarkedAt;
use Dvidz\Bookmark\Domain\Entity\ValueType\MediaSize;
use Dvidz\Bookmark\Domain\Entity\ValueType\Provider;
use Dvidz\Bookmark\Domain\Entity\ValueType\PublishedAt;
use Dvidz\Bookmark\Domain\Entity\ValueType\Title;
use Dvidz\Bookmark\Domain\Entity\ValueType\Type;
use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Shared\Domain\AggregateRoot;
use Dvidz\Shared\Domain\ValueObject\UuidInterface;

/**
 * Class Bookmark.
 */
class Bookmark extends AggregateRoot
{
    /**
     * @param UuidInterface $uuid
     * @param Url           $url
     * @param Provider      $provider
     * @param Title         $title
     * @param Author        $author
     * @param \DateTime     $publishedAt
     * @param \DateTime     $bookmarkedAt
     * @param Type          $type
     * @param MediaSize     $mediaSize
     */
    private function __construct (
        protected UuidInterface $uuidInterface,
        protected Url $url,
        protected Provider $provider,
        protected Title $title,
        protected Author $author,
        protected \Datetime $publishedAt,
        protected \Datetime $bookmarkedAt,
        protected Type $type,
        protected MediaSize $mediaSize
    ) {
        parent::__construct($uuidInterface);
    }

    /**
     * @param UuidInterface $uuid
     * @param Url           $url
     * @param string        $provider
     * @param string        $title
     * @param string        $author
     * @param string        $publishedAt
     * @param string        $type
     * @param int           $width
     * @param int           $height
     * @param ?int          $duration
     *
     * @return Bookmark
     *
     * @throws \Exception
     */
    public static function bookmark(UuidInterface $uuid, Url $url, string $provider, string $title, string $author, string $publishedAt, string $type, int $width, int $height, ?int $duration): self
    {
        return new self(
            $uuid,
            $url,
            new Provider($provider),
            new Title($title),
            new Author($author),
            new PublishedAt($publishedAt),
            new BookmarkedAt(),
            new Type($type),
            new MediaSize($width, $height, $duration)
        );
    }

    /**
     * @return Url
     */
    public function url(): Url
    {
        return $this->url;
    }

    /**
     * @return Provider
     */
    public function provider(): Provider
    {
        return $this->provider;
    }

    /**
     * @return Title
     */
    public function title(): Title
    {
        return $this->title;
    }

    /**
     * @return Author
     */
    public function author(): Author
    {
        return $this->author;
    }

    /**
     * @return BookmarkedAt
     */
    public function bookmarkedAt(): BookmarkedAt
    {
        return $this->bookmarkedAt;
    }

    /**
     * @return PublishedAt
     */
    public function publishedAt(): PublishedAt
    {
        return $this->publishedAt;
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return $this->type;
    }

    /**
     * @return MediaSize
     */
    public function mediaSize(): MediaSize
    {
        return $this->mediaSize;
    }
}
