<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\LinkProviderRepository;
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
}
