<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VideoSize.
 *
 * @ORM\Entity
 */
class VideoSize extends MediaSize implements VideoSizeInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $duration;

    /**
     * @ORM\ManyToMany(targetEntity=TypeLink::class, mappedBy="videoSizes")
     */
    protected Collection $typeLinks;

    /**
     * VideoSize constructor.
     */
    public function __construct()
    {
        $this->typeLinks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     *
     * @return VideoSize
     */
    public function setDuration(string $duration): VideoSize
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
     * @param TypeLink $typeLink
     *
     * @return $this
     */
    public function addTypeLink(TypeLink $typeLink): self
    {
        if (!$this->typeLinks->contains($typeLink)) {
            $this->typeLinks[] = $typeLink;
            $typeLink->addVideoSize($this);
        }

        return $this;
    }

    /**
     * @param TypeLink $typeLink
     *
     * @return $this
     */
    public function removeTypeLink(TypeLink $typeLink): self
    {
        if ($this->typeLinks->removeElement($typeLink)) {
            $typeLink->removeVideoSize($this);
        }

        return $this;
    }
}
