<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\EventListener;

use App\Dvidz\Rest\Controller\ListBookmarkController;
use App\Dvidz\Rest\Controller\PostBookmarkController;
use App\Dvidz\Rest\Controller\RemoveBookmarkController;
use App\Dvidz\Rest\Exception\BookmarkNotFoundException;
use App\Dvidz\Rest\Exception\MalformedUrlException;
use App\Dvidz\Rest\Service\BookmarkService;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

/**
 * Class BookmarkListener.
 *
 * @psalm-suppress InternalMethod
 */
class BookmarkListener implements EventSubscriberInterface
{
    /**
     * @var CacheInterface
     */
    protected CacheInterface $cache;

    /**
     * @var BookmarkService
     */
    protected BookmarkService $bookmarkService;

    /**
     * @var RequestEvent
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected RequestEvent $requestEvent;

    /**
     * @var MessageBusInterface
     */
    protected MessageBusInterface $bus;

    /**
     * @param TagAwareCacheInterface $bookmarkCache
     * @param BookmarkService        $bookmarkService
     * @param MessageBusInterface    $bus
     */
    public function __construct(TagAwareCacheInterface $bookmarkCache, BookmarkService $bookmarkService, MessageBusInterface $bus)
    {
        $this->cache = $bookmarkCache;
        $this->bookmarkService = $bookmarkService;
        $this->bus = $bus;
    }

    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse(
            [
                $exception->getMessage(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        $event->setResponse($response);
    }

    /**
     * @param RequestEvent $event
     *
     * @return void
     *
     * @throws BookmarkNotFoundException
     * @throws MalformedUrlException
     * @throws InvalidArgumentException
     *
     * @psalm-suppress InvalidThrow
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $this->requestEvent = $event;

        if ('api_bookmark_create' ===  $event->getRequest()->get('_route')) {
            /** @psalm-suppress UndefinedInterfaceMethod */
            $this->cache->invalidateTags(['list', 'item']);
            $url = $event->getRequest()->request->get('url');

            try {
                Assertion::url($url);
            } catch (AssertionFailedException $e) {
                throw new MalformedUrlException();
            }

            $response = $this->cache->get(urlencode($url), function (ItemInterface $item) {
                $item->tag('item');
                $postBookmarkController = new PostBookmarkController($this->bookmarkService, $this->bus);
                /** @psalm-suppress UndefinedInterfaceMethod */
                $this->cache->invalidateTags(['list']);

                return $postBookmarkController($this->requestEvent->getRequest());
            });

            $response->setPublic();
            $event->setResponse($response);
        }

        if ('api_bookmark_list' === $this->requestEvent->getRequest()->get('_route')) {
            $response = $this->cache->get('bookmark_list', function (ItemInterface $item) {
                $item->tag('list');
                $listBookmarkController = new ListBookmarkController($this->bookmarkService, $this->bus);

                return $listBookmarkController();
            });

            $response->setPublic();
            $event->setResponse($response);
        }

        if ('api_bookmark_delete' === $event->getRequest()->get('_route')) {
            $request = $event->getRequest();
            /** @psalm-suppress InternalMethod */
            $bookmarkId = $request->get('id');

            if (null === $bookmark = $this->bookmarkService->getRepository()->find($bookmarkId)) {
                throw new BookmarkNotFoundException(
                    sprintf(
                        'Bookmark with id %s not found. Can not remove bookmark.',
                        $bookmarkId
                    ),
                    Response::HTTP_NO_CONTENT
                );
            }

            $removeBookmarkController = new RemoveBookmarkController($this->bookmarkService, $this->bus);
            $response = $removeBookmarkController($bookmark);

            $this->cache->delete(urlencode($bookmark->getUrl()));
            /** @psalm-suppress UndefinedInterfaceMethod */
            $this->cache->invalidateTags(['list']);

            $event->setResponse($response);
        }
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
