<?php

declare(strict_types=1);

namespace Api\Human\Controller;

use Api\Human\Command\CreateHumainCommandBus;
use Dvidz\Human\Application\CreateHuman\CreateHumanCommand;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateHumanController.
 */
class CreateHumanController extends AbstractController
{
    /**
     * @param CreateHumainCommandBus $commandBus
     */
    public function __construct(protected CreateHumainCommandBus $commandBus)
    {
        parent::__construct($commandBus, null, null);
    }

    /**
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, SerializerInterface $serializer)
    {
        $createHumanCommand = $serializer->deserialize(
            $request->getContent(),
            CreateHumanCommand::class,
            'json'
        );

        $this->dispatch($createHumanCommand);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
