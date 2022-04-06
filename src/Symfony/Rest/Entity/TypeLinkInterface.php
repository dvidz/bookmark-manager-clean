<?php

namespace App\Symfony\Rest\Entity;

/**
 * Interface TypeLinkInterface.
 */
interface TypeLinkInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getTypeLinkName(): string;

    /**
     * @param string $typeLinkName
     *
     * @return $this
     */
    public function setTypeLinkName(string $typeLinkName): self;

    /**
     * @param VideoSizeInterface $videoSize
     *
     * @return $this
     */
    public function addVideoSize(VideoSizeInterface $videoSize): self;

    /**
     * @param ImageSize $imageSize
     *
     * @return $this
     */
    public function addImageSize(ImageSize $imageSize): self;
}
