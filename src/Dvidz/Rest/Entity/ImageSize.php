<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\ImageSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ImageSize.
 *
 * @ORM\Entity(repositoryClass=ImageSizeRepository::class)
 */
class ImageSize extends AbstractMediaSize implements ImageSizeInterface
{
    /**
     * @ORM\ManyToMany(targetEntity=TypeLink::class, mappedBy="imageSizes")
     */
    protected Collection $typeLinks;

    /**
     * @ORM\OneToMany(targetEntity=Bookmark::class, mappedBy="imageSize")
     */
    protected Collection $bookmarks;

    /**
     * ImageSize constructors.
     */
    public function __construct()
    {
        $this->typeLinks = new ArrayCollection();
        $this->bookmarks = new ArrayCollection();
    }

    /**
     * @return Collection<int, TypeLink>
     */
    public function getTypeLinks(): Collection
    {
        return $this->typeLinks;
    }

    /**
     * @param TypeLinkInterface $typeLink
     *
     * @return $this
     */
    public function addTypeLink(TypeLinkInterface $typeLink): self
    {
        if (!$this->typeLinks->contains($typeLink)) {
            $this->typeLinks[] = $typeLink;
            $typeLink->addImageSize($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Bookmark>
     */
    public function getBookmarks(): Collection
    {
        return $this->bookmarks;
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return $this
     */
    public function addBookmark(Bookmark $bookmark): self
    {
        if (!$this->bookmarks->contains($bookmark)) {
            $this->bookmarks[] = $bookmark;
            $bookmark->setImageSize($this);
        }

        return $this;
    }

    /**
     * @param string|null $duration
     *
     * @return $this
     */
    public function setDuration(?string $duration): self
    {
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return null;
    }
}
