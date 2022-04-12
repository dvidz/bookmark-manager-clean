<?php

namespace Api\Bookmark\Controller;

use Api\Bookmark\Command\BookmarkCommandBus;
use Api\Bookmark\Query\OembedCrawlQueryBus;
use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawlerQuery;
use Dvidz\Bookmark\Application\CreateBookmark\BookmarkCommand;
use Dvidz\Bookmark\Infrastructure\Presenter\OembedCrawlerPresenter;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BookmarkController.
 */
class BookmarkController extends AbstractController
{
    /**
     * @param BookmarkCommandBus     $commandBus
     * @param OembedCrawlQueryBus    $queryBus
     * @param OembedCrawlerPresenter $presenter
     */
    public function __construct(private BookmarkCommandBus $commandBus, private OembedCrawlQueryBus $queryBus, private OembedCrawlerPresenter $presenter)
    {
        parent::__construct($this->commandBus, $this->queryBus, $this->presenter);
    }

    /**
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function __invoke(Request $request, SerializerInterface $serializer): Response
    {
        $urlCrawlerQuery = $serializer->deserialize($request->getContent(), UrlCrawlerQuery::class, 'json');
        $oEmbedViewModel = $this->ask($urlCrawlerQuery);

        $this->dispatch(
            new BookmarkCommand(
                $oEmbedViewModel->url ?? $urlCrawlerQuery->url,
                $oEmbedViewModel->provider,
                $oEmbedViewModel->title,
                $oEmbedViewModel->author,
                $oEmbedViewModel->publishedAt,
                $oEmbedViewModel->type,
                $oEmbedViewModel->width,
                $oEmbedViewModel->height,
                $oEmbedViewModel->duration,
            )
        );

        return new JsonResponse('hello from clean', Response::HTTP_OK);
    }
}
