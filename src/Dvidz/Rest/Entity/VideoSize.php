<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\VideoSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VideoSize.
 *
 * @ORM\Entity(repositoryClass=VideoSizeRepository::class)
 */
class VideoSize extends AbstractMediaSize implements VideoSizeInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected ?string $duration;

    /**
     * @ORM\ManyToMany(targetEntity=TypeLink::class, mappedBy="videoSizes")
     */
    protected Collection $typeLinks;

    /**
     * @ORM\OneToMany(targetEntity=Bookmark::class, mappedBy="videoSize")
     */
    protected Collection $bookmarks;

    /**
     * VideoSize constructor.
     */
    public function __construct()
    {
        $this->typeLinks = new ArrayCollection();
        $this->bookmarks = new ArrayCollection();
        $this->duration = null;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     *
     * @return $this
     */
    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
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
            $typeLink->addVideoSize($this);
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
            $bookmark->setVideoSize($this);
        }

        return $this;
    }
}
