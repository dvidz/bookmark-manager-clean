<?php

declare(strict_types=1);

namespace Dvidz\Human\Domain\Repository;

use Dvidz\Human\Domain\Entity\Human;

/**
 * Interface CreateHumanRepository.
 */
interface CreateHumanRepository
{
    /**
     * @param Human $human
     *
     * @return void
     */
    public function saveHuman(Human $human): void;
}
