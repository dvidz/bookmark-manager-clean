<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Entity\ValueType;

/**
 * Abstract class MediaSize.
 */
class MediaSize
{
    /**
     * @param int  $width
     * @param int  $height
     * @param ?int $duration
     */
    public function __construct(protected int $width, protected int $height, protected ?int $duration)
    {
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * @return int|null
     */
    public function duration(): ?int
    {
        return $this->duration;
    }
}
