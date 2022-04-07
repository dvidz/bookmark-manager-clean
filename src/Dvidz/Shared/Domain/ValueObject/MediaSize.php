<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\ValueObject;

/**
 * Abstract class MediaSize.
 */
abstract class MediaSize implements VideoSizeInterface
{
    /**
     * @var int
     */
    protected int $width;

    /**
     * @var int
     */
    protected int $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
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
        return null;
    }
}
