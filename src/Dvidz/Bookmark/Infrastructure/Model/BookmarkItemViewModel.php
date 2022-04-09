<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Model;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Domain\Entity\AggregateRoot;
use Dvidz\Shared\Domain\Model\ItemViewModel;

/**
 * Class BookmarkItemViewModel.
 */
class BookmarkItemViewModel implements ItemViewModel
{
    public string $uuid;
    public string $url;
    public string $provider;
    public string $title;
    public string $publishedAt;
    public string $bookmarkedAt;
    public string $type;
    public string $author;
    public int $width;
    public int $height;
    public ?int $duration;

    /**
     * @param Bookmark $bookmark
     */
    private function __construct(Bookmark $bookmark)
    {
            $this->uuid = $bookmark->uuid();
            $this->bookmarkedAt = $bookmark->bookmarkedAt()->format('Y-m-d');
            $this->publishedAt = $bookmark->publishedAt()->format('Y-m-d');
            $this->url = (string) $bookmark->url();
            $this->provider = (string) $bookmark->provider();
            $this->type = (string) $bookmark->type();
            $this->title = (string) $bookmark->title();
            $this->author = (string) $bookmark->author();
            $this->width = $bookmark->mediaSize()->width();
            $this->height = $bookmark->mediaSize()->height();
            $this->duration = $bookmark->mediaSize()->duration();
    }
    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return $this
     */
    public static function createFromAggregate(AggregateRoot $aggregateRoot): self
    {
        return new self($aggregateRoot);
    }
}
