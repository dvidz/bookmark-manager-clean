<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\Create\Command;

use Dvidz\Shared\Domain\Bus\Command\Command as CommandInterface;

/**
 * Class BookmarkCommand.
 */
class BookmarkCommand implements CommandInterface
{
    public string $url;

    public string $provider;

    public string $title;

    public string $author;

    public string $publishedAt;

    public string $type;

    public int $with;

    public int $height;

    public ?int $duration;

    /**
     * @param string   $url
     * @param string   $provider
     * @param string   $title
     * @param string   $author
     * @param string   $publishedAt
     * @param string   $type
     * @param int      $with
     * @param int      $height
     * @param int|null $duration
     */
    public function __construct(string $url, string $provider, string $title, string $author, string $publishedAt, string $type, int $with, int $height, ?int $duration)
    {
        $this->url = $url;
        $this->provider = $provider;
        $this->title = $title;
        $this->author = $author;
        $this->publishedAt = $publishedAt;
        $this->type = $type;
        $this->with = $with;
        $this->height = $height;
        $this->duration = $duration;
    }
}
