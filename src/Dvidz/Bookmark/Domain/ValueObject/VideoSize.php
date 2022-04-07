<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\ValueObject;

use Dvidz\Shared\Domain\ValueObject\MediaSize;

/**
 * Class VideoSize
 */
class VideoSize extends MediaSize
{
    protected int $duration;

    /**
     * @param int $width
     * @param int $height
     * @param int $duration
     */
    public function __construct(int $width, int $height, int $duration)
    {
        $this->duration = $duration;

        parent::__construct($width, $height);
    }

    /**
     * @return int
     */
    public function duration(): int
    {
        return $this->duration;
    }
}
