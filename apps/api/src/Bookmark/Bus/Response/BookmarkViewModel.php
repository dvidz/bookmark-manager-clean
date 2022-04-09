<?php

declare(strict_types=1);

namespace Api\Bookmark\Bus\Response;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Shared\Application\ViewModel\ViewModel;
use Dvidz\Shared\Domain\AggregateRoot;

/**
 * Class BookmarkViewModel.
 */
class BookmarkViewModel implements ViewModel
{
    public string $uuid;
    public string $url;
    public string $provider;
    public string $type;
    public string $author;
    public int $width;
    public int $height;
    public ?int $duration;

    /**
     * @param Bookmark $bookmark
     *
     * @return BookmarkViewModel
     */
    public function create(AggregateRoot|array $bookmark): BookmarkViewModel
    {
        $this->uuid = $bookmark->uuid();
        $this->url = $bookmark->url()->value();
        $this->provider = $bookmark->provider()->value();
        $this->type = $bookmark->type()->value();
        $this->author = $bookmark->author()->value();
        $this->width = $bookmark->mediaSize()->width();
        $this->height = $bookmark->mediaSize()->height();
        $this->duration = $bookmark->mediaSize()->duration();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getView(): mixed
    {
        return $this;
    }
}
