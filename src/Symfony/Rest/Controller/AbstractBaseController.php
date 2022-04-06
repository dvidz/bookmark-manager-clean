<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Controller;

use App\Symfony\Rest\Service\BookmarkServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class AbstractBaseController.
 */
abstract class AbstractBaseController extends AbstractController
{
    /**
     * @var BookmarkServiceInterface
     */
    protected BookmarkServiceInterface $bookmarkService;

    /**
     * @var MessageBusInterface
     */
    protected MessageBusInterface $bus;

    /**
     * @param BookmarkServiceInterface $bookmarkService
     * @param MessageBusInterface      $bus
     */
    public function __construct(BookmarkServiceInterface $bookmarkService, MessageBusInterface $bus)
    {
        $this->bookmarkService = $bookmarkService;
        $this->bus = $bus;
    }
}
