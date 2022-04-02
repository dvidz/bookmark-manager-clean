<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
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
     * @ORM\ManyToOne(targetEntity=TypeLink::class, inversedBy="bookmarks")
     */
    protected TypeLink $typeLink;

    /**
     * @ORM\ManyToOne(targetEntity=LinkProvider::class, inversedBy="bookmarks")
     */
    protected LinkProvider $linkProvider;

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
        return $this->getLinkProvider()->getProviderName();
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

    /**
     * @return TypeLink|null
     */
    public function getTypeLink(): ?TypeLink
    {
        return $this->typeLink;
    }

    /**
     * @param TypeLink|null $typeLink
     *
     * @return $this
     */
    public function setTypeLink(?TypeLink $typeLink): self
    {
        $this->typeLink = $typeLink;

        return $this;
    }

    /**
     * @return LinkProvider|null
     */
    public function getLinkProvider(): ?LinkProvider
    {
        return $this->linkProvider;
    }

    /**
     * @param LinkProvider|null $linkProvider
     *
     * @return $this
     */
    public function setLinkProvider(?LinkProvider $linkProvider): self
    {
        $this->linkProvider = $linkProvider;

        return $this;
    }
}
