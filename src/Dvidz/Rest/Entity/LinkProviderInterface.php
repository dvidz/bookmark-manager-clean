<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

/**
 * Interface LinkProviderInterface.
 */
interface LinkProviderInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getProviderName(): string;

    /**
     * @param string $providerName
     *
     * @return $this
     */
    public function setProviderName(string $providerName): self;
}
