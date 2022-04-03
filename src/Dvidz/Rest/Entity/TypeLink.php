<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\TypeLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TypeLink
 *
 * @ORM\Entity(repositoryClass=TypeLinkRepository::class)
 */
class TypeLink implements TypeLinkInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected string $typeLinkName;

    /**
     * @ORM\OneToMany(targetEntity=Bookmark::class, mappedBy="typeLink")
     */
    protected Collection $bookmarks;

    /**
     * @ORM\ManyToMany(targetEntity=LinkProvider::class, inversedBy="typeLinks")
     */
    protected Collection $linkProviders;

    /**
     * @ORM\ManyToMany(targetEntity=ImageSize::class, inversedBy="typeLinks")
     */
    protected Collection $imageSizes;

    /**
     * @ORM\ManyToMany(targetEntity=VideoSize::class, inversedBy="typeLinks")
     */
    protected Collection $videoSizes;

    /**
     * TypeLink Constructor.
     */
    public function __construct()
    {
        $this->bookmarks = new ArrayCollection();
        $this->linkProviders = new ArrayCollection();
        $this->imageSizes = new ArrayCollection();
        $this->videoSizes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTypeLinkName(): string
    {
        return $this->typeLinkName;
    }

    /**
     * @param string $typeLinkName
     *
     * @return $this
     */
    public function setTypeLinkName(string $typeLinkName): self
    {
        $this->typeLinkName = $typeLinkName;

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
            $bookmark->setTypeLink($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, LinkProvider>
     */
    public function getLinkProviders(): Collection
    {
        return $this->linkProviders;
    }

    /**
     * @param LinkProvider $linkProvider
     *
     * @return $this
     */
    public function addLinkProvider(LinkProvider $linkProvider): self
    {
        if (!$this->linkProviders->contains($linkProvider)) {
            $this->linkProviders[] = $linkProvider;
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageSize>
     */
    public function getImageSizes(): Collection
    {
        return $this->imageSizes;
    }

    /**
     * @param ImageSize $imageSize
     *
     * @return $this
     */
    public function addImageSize(ImageSize $imageSize): self
    {
        if (!$this->imageSizes->contains($imageSize)) {
            $this->imageSizes[] = $imageSize;
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoSize>
     */
    public function getVideoSizes(): Collection
    {
        return $this->videoSizes;
    }

    /**
     * @param VideoSizeInterface $videoSize
     *
     * @return $this
     */
    public function addVideoSize(VideoSizeInterface $videoSize): self
    {
        if (!$this->videoSizes->contains($videoSize)) {
            $this->videoSizes[] = $videoSize;
        }

        return $this;
    }
}
