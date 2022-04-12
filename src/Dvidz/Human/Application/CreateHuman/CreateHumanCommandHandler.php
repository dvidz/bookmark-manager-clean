<?php

declare(strict_types=1);

namespace Dvidz\Human\Application\CreateHuman;

use Dvidz\Human\Domain\Entity\Human;
use Dvidz\Human\Domain\Repository\CreateHumanRepository;
use Dvidz\Shared\Domain\Command\CommandHandler;

/**
 * Class CreateHumanCommandHandler.
 */
class CreateHumanCommandHandler implements CommandHandler
{
    /**
     * @param CreateHumanRepository $createHumanRepository
     */
    public function __construct(protected CreateHumanRepository $createHumanRepository)
    {
    }

    /**
     * @param CreateHumanCommand $createHumanCommand
     *
     * @return void
     */
    public function __invoke(CreateHumanCommand $createHumanCommand)
    {
        $human = Human::createHuman($createHumanCommand->type());

        $this->createHumanRepository->saveHuman($human);
    }
}
