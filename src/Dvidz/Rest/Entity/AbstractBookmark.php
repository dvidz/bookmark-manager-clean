<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractBookmark implements BookmarkInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", name="url", unique=true)
     */
    protected string $url;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected string $providerName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $linkTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected string $linkAuthor;

    /**
     * @ORM\Column(type="date_immutable", length=100, nullable=false)
     */
    protected \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="date_immutable", length=100, nullable=false)
     */
    protected \DateTimeImmutable $publicationDate;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getProviderName(): string
    {
        return $this->providerName;
    }

    /**
     * @param string $providerName
     *
     * @return $this
     */
    public function setProviderName(string $providerName): self
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkTitle(): string
    {
        return $this->linkTitle;
    }

    /**
     * @param string $linkTitle
     *
     * @return $this
     */
    public function setLinkTitle(string $linkTitle): self
    {
        $this->linkTitle = $linkTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkAuthor(): string
    {
        return $this->linkAuthor;
    }

    /**
     * @param string $linkAuthor
     *
     * @return $this
     */
    public function setLinkAuthor(string $linkAuthor): self
    {
        $this->linkAuthor = $linkAuthor;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTimeImmutable $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(\DateTimeImmutable $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }
}
