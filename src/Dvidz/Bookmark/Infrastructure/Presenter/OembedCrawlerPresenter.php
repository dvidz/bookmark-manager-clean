<?php

namespace Dvidz\Bookmark\Infrastructure\Presenter;

use Dvidz\Bookmark\Infrastructure\Model\OembedCrawlerViewModel;
use Dvidz\Shared\Domain\Model\ViewModel;
use Dvidz\Shared\Domain\Presenter\Presenter;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Class OembedCrawlerPresenter.
 */
class OembedCrawlerPresenter implements Presenter
{
    /**
     * @var OembedCrawlerViewModel
     */
    protected OembedCrawlerViewModel $oembedCrawlerViewModel;

    /**
     * @param Response $response
     *
     * @return void
     */
    public function present(Response $response): void
    {
        $this->oembedCrawlerViewModel = OembedCrawlerViewModel::create($response);
    }

    /**
     * @return ViewModel
     */
    public function getView(): ViewModel
    {
        return $this->oembedCrawlerViewModel;
    }
}
