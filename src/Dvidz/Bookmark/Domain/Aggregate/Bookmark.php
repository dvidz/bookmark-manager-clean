<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Aggregate;

use Dvidz\Bookmark\Domain\ValueObject\Author;
use Dvidz\Bookmark\Domain\ValueObject\BookmarkedAt;
use Dvidz\Bookmark\Domain\ValueObject\CreatedAt;
use Dvidz\Bookmark\Domain\ValueObject\ImageSize;
use Dvidz\Bookmark\Domain\ValueObject\Provider;
use Dvidz\Bookmark\Domain\ValueObject\PublishedAt;
use Dvidz\Bookmark\Domain\ValueObject\Title;
use Dvidz\Bookmark\Domain\ValueObject\Type;
use Dvidz\Bookmark\Domain\ValueObject\Url;
use Dvidz\Bookmark\Domain\ValueObject\VideoSize;
use Dvidz\Shared\Domain\Aggregate\AggregateRoot;
use Dvidz\Shared\Domain\ValueObject\MediaSize;
use Dvidz\Shared\Domain\ValueObject\UuidInterface;

/**
 * Class Bookmark.
 */
class Bookmark extends AggregateRoot
{
    /**
     * @var Url
     */
    protected Url $url;

    /**
     * @var Provider
     */
    protected Provider $provider;

    /**
     * @var Title
     */
    protected Title $title;

    /**
     * @var Author
     */
    protected Author $author;

    /**
     * @var BookmarkedAt
     */
    protected BookmarkedAt $bookmarkedAt;

    /**
     * @var PublishedAt
     */
    protected PublishedAt $publishedAt;

    /**
     * @var Type
     */
    protected Type $type;

    /**
     * @var MediaSize
     */
    protected MediaSize $mediaSize;

    /**
     * @var CreatedAt
     */
    protected CreatedAt $createdAt;

    /**
     * @param UuidInterface $uuid
     * @param Url           $url
     * @param string        $provider
     * @param string        $title
     * @param string        $author
     * @param string        $publishedAt
     * @param string        $type
     * @param MediaSize     $mediaSize
     *
     * @throws \Exception
     */
    private function __construct(UuidInterface $uuid, Url $url, string $provider, string $title, string $author, string $publishedAt, string $type, MediaSize $mediaSize)
    {
        $this->url = $url;
        $this->provider = new Provider($provider);
        $this->title = new Title($title);
        $this->author = new Author($author);
        $this->bookmarkedAt = new BookmarkedAt();
        $this->publishedAt = new PublishedAt($publishedAt);
        $this->type = new Type($type);
        $this->mediaSize = $mediaSize;
        $this->createdAt = new CreatedAt();

        parent::__construct($uuid);
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
        if (null === $duration) {
            $mediaSize = new ImageSize($width, $height);
        } else {
            $mediaSize = new VideoSize($width, $height, $duration);
        }

        return new self($uuid, $url, $provider, $title, $author, $publishedAt, $type, $mediaSize);
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

    /**
     * @return CreatedAt
     */
    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function toArray()
    {
        return [
            'uuid' => $this->uuid,
            'url' => $this->url->value(),
            'provider' => $this->provider->value(),
            'title' => $this->title->value(),
            'author' => $this->title->value(),
            'createdAt' => $this->createdAt,
            'bookmarkedAt' => $this->bookmarkedAt,
            'type' => $this->type->value(),
        ];
    }
}
