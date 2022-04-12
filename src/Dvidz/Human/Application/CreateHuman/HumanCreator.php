<?php

declare(strict_types=1);

namespace Dvidz\Human\Application\CreateHuman;

use Dvidz\Human\Domain\Entity\Human;
use Dvidz\Human\Domain\Repository\CreateHumanRepository;

/**
 * Class HumanCreator.
 */
class HumanCreator
{
    /**
     * @param CreateHumanRepository $humanRepository
     */
    public function __construct(CreateHumanRepository $humanRepository)
    {
    }

    /**
     * @param string $type
     *
     * @return Human
     */
    public function createHuman(string $type)
    {
        return Human::createHuman($type);
    }
}
