<?php

namespace App\Dvidz\Rest\Entity;

/**
 * Interface TypeLinkInterface.
 */
interface TypeLinkInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getTypeLinkName(): string;

    /**
     * @param string $typeLinkName
     *
     * @return $this
     */
    public function setTypeLinkName(string $typeLinkName): self;
}
