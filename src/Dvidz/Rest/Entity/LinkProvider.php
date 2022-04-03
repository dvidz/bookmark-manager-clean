<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\LinkProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class LinkProvider.
 *
 * @ORM\Entity(repositoryClass=LinkProviderRepository::class)
 */
class LinkProvider implements LinkProviderInterface
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
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected string $providerName;

    /**
     * @ORM\OneToMany(targetEntity=Bookmark::class, mappedBy="linkProvider")
     */
    protected Collection $bookmarks;

    /**
     * @ORM\ManyToMany(targetEntity=TypeLink::class, mappedBy="linkProviders")
     */
    protected Collection $typeLinks;

    /**
     * LinkProvider constructor.
     */
    public function __construct()
    {
        $this->bookmarks = new ArrayCollection();
        $this->typeLinks = new ArrayCollection();
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
            $bookmark->setLinkProvider($this);
        }

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
            $typeLink->addLinkProvider($this);
        }

        return $this;
    }
}
