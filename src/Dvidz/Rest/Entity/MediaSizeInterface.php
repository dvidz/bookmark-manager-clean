<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

/**
 * Interface MediaSizeInterface.
 */
interface MediaSizeInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return float
     */
    public function getWidth(): float;

    /**
     * @param float $width
     *
     * @return MediaSizeInterface
     */
    public function setWidth(float $width): self;

    /**
     * @return float
     */
    public function getHeight(): float;

    /**
     * @param float $height
     *
     * @return MediaSizeInterface
     */
    public function setHeight(float $height): self;
}
