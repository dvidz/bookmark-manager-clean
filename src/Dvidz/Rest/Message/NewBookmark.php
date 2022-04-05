<?php

namespace App\Dvidz\Rest\Message;

/**
 * Class NewBookmark
 */
class NewBookmark
{
    /**
     * @var int
     */
    private int $bookmarkId;

    /**
     * @param int $bookmarkId
     */
    public function __construct(int $bookmarkId)
    {
        $this->bookmarkId = $bookmarkId;
    }

    /**
     * @return int
     */
    public function getBookmarkId(): int
    {
        return $this->bookmarkId;
    }
}
