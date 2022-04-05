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

    /**
     * @param ?string $duration
     *
     * @return $this
     */
    public function setDuration(?string $duration): self;

    /**
     * @return string|null
     */
    public function getDuration(): ?string;

    /**
     * @param TypeLinkInterface $typeLink
     *
     * @return $this
     */
    public function addTypeLink(TypeLinkInterface $typeLink): self;
}
