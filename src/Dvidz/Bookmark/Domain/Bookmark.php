<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain;

use Dvidz\Shared\Domain\BookmarkRoot;
use Dvidz\Shared\Domain\ValueObject\UuidInterface;

/**
 * Class Bookmark.
 */
class Bookmark extends BookmarkRoot
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
     * @param UuidInterface $uuid
     * @param Url           $url
     * @param string        $provider
     * @param string        $title
     * @param string        $author
     * @param string        $publishedAt
     * @param string        $type
     * @param int           $width
     * @param int           $height
     * @param int|null      $duration
     *
     * @throws \Exception
     */
    private function __construct(UuidInterface $uuid, Url $url, string $provider, string $title, string $author, string $publishedAt, string $type, int $width, int $height, ?int $duration)
    {
        $this->url = $url;
        $this->provider = new Provider($provider);
        $this->title = new Title($title);
        $this->author = new Author($author);
        $this->bookmarkedAt = new BookmarkedAt();
        $this->publishedAt = new PublishedAt($publishedAt);
        $this->type = new Type($type);
        $this->mediaSize = new MediaSize($width, $height, $duration);

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
        return new self($uuid, $url, $provider, $title, $author, $publishedAt, $type, $width, $height, $duration);
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
     * @return array
     */
    public function toArray()
    {
        return [
            'uuid' => $this->uuid,
            'url' => $this->url->value(),
            'provider' => $this->provider->value(),
            'title' => $this->title->value(),
            'author' => $this->title->value(),
            'bookmarkedAt' => $this->bookmarkedAt,
            'publishedAt' => $this->publishedAt,
            'type' => $this->type->value(),
        ];
    }
}
