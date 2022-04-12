<?php

declare(strict_types=1);

namespace Api\Human\Repository;

use Dvidz\Human\Domain\Entity\Human;
use Dvidz\Human\Domain\Repository\CreateHumanRepository;

/**
 * Class InMemoryHumanRepository.
 */
class InMemoryHumanRepository implements CreateHumanRepository
{
    /**
     * @var array
     */
    public array $storage = [];

    /**
     * @param Human $human
     *
     * @return void
     */
    public function saveHuman(Human $human): void
    {
        $this->storage[] = $human;
    }
}
