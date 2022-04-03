<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

/**
 * Interface BookmarkInterface.
 */
interface BookmarkInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getProviderName(): string;

    /**
     * @return string
     */
    public function getLinkTitle(): string;

    /**
     * @param string $linkTitle
     *
     * @return $this
     */
    public function setLinkTitle(string $linkTitle): self;

    /**
     * @return string
     */
    public function getLinkAuthor(): string;

    /**
     * @param string $linkAuthor
     *
     * @return $this
     */
    public function setLinkAuthor(string $linkAuthor): self;

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): self;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getPublicationDate(): ?\DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(\DateTimeImmutable $publicationDate): self;

    /**
     * @return TypeLinkInterface|null
     */
    public function getTypeLink(): ?TypeLinkInterface;

    /**
     * @return VideoSizeInterface
     */
    public function getVideoSize(): VideoSizeInterface;

    /**
     * @return ImageSizeInterface
     */
    public function getImageSize(): ImageSizeInterface;
}
