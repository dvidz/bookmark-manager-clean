<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ImageSize.
 *
 * @ORM\Entity
 */
class ImageSize extends MediaSize
{
    /**
     * @ORM\ManyToMany(targetEntity=TypeLink::class, mappedBy="imageSizes")
     */
    protected Collection $typeLinks;

    /**
     * ImageSize constructors.
     */
    public function __construct()
    {
        $this->typeLinks = new ArrayCollection();
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
            $typeLink->addImageSize($this);
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
            $typeLink->removeImageSize($this);
        }

        return $this;
    }
}
