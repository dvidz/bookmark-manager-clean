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
     * @ORM\ManyToOne(targetEntity=TypeLink::class, inversedBy="bookmarks", cascade={"persist"})
     */
    protected TypeLinkInterface $typeLink;

    /**
     * @ORM\ManyToOne(targetEntity=LinkProvider::class, inversedBy="bookmarks", cascade={"persist"})
     */
    protected LinkProviderInterface $linkProvider;

    /**
     * @ORM\ManyToOne(targetEntity=ImageSize::class, inversedBy="bookmarks", cascade={"persist"})
     */
    protected ImageSizeInterface $imageSize;

    /**
     * @ORM\ManyToOne(targetEntity=VideoSize::class, inversedBy="bookmarks", cascade={"persist"})
     */
    protected VideoSizeInterface $videoSize;

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
     * @return \DateTimeImmutable|null
     */
    public function getPublicationDate(): ?\DateTimeImmutable
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTimeImmutable|null $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(?\DateTimeImmutable $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return TypeLinkInterface|null
     */
    public function getTypeLink(): ?TypeLinkInterface
    {
        return $this->typeLink;
    }

    /**
     * @param TypeLinkInterface|null $typeLink
     *
     * @return $this
     */
    public function setTypeLink(?TypeLinkInterface $typeLink): self
    {
        $this->typeLink = $typeLink;

        return $this;
    }

    /**
     * @return LinkProviderInterface|null
     */
    public function getLinkProvider(): ?LinkProviderInterface
    {
        return $this->linkProvider;
    }

    /**
     * @param LinkProviderInterface|null $linkProvider
     *
     * @return $this
     */
    public function setLinkProvider(?LinkProviderInterface $linkProvider): self
    {
        $this->linkProvider = $linkProvider;

        return $this;
    }

    /**
     * @return ImageSizeInterface
     */
    public function getImageSize(): ImageSizeInterface
    {
        return $this->imageSize;
    }

    /**
     * @param ImageSizeInterface $imageSize
     *
     * @return $this
     */
    public function setImageSize(ImageSizeInterface $imageSize): self
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * @return VideoSizeInterface
     */
    public function getVideoSize(): VideoSizeInterface
    {
        return $this->videoSize;
    }

    /**
     * @param VideoSizeInterface $videoSize
     *
     * @return $this
     */
    public function setVideoSize(VideoSizeInterface $videoSize): self
    {
        $this->videoSize = $videoSize;

        return $this;
    }
}
