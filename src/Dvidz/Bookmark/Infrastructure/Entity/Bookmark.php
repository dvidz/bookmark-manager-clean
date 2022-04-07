<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dvidz\Bookmark\Infrastructure\Repository\BookmarkRepository;

/**
 * @ORM\Entity(repositoryClass=BookmarkRepository::class)
 */
class Bookmark
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    protected string $uuid;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    protected string $url;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    protected string $provider;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected string $author;

    /**
     * @ORM\Column(type="date_immutable", nullable=false)
     */
    protected \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="date_immutable",nullable=false)
     */
    protected \DateTimeImmutable $publishedAt;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    protected string $type;

    /**
     * @param $data
     *
     * @return Bookmark
     */
    public static function fromArray($data): self
    {
        $bookmark =  new self();
        $bookmark->uuid = $data['uuid'];
        $bookmark->url = $data['url'];
        $bookmark->provider = $data['provider'];
        $bookmark->title = $data['title'];
        $bookmark->author = $data['author'];
        $bookmark->createdAt = $data['createdAt'];
        $bookmark->publishedAt = $data['bookmarkedAt'];
        $bookmark->type = $data['type'];

        return $bookmark;
    }
}
