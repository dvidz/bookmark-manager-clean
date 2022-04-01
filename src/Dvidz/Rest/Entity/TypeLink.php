<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\TypeLinkRepository;
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
}
