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
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self;

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
     * @return \DateTimeImmutable
     */
    public function getPublicationDate(): \DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(\DateTimeImmutable $publicationDate): self;
}
