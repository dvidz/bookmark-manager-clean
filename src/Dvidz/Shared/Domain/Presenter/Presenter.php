<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Presenter;

use Dvidz\Shared\Domain\Model\ListViewModel;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Interface ListBookmarkPresenter.
 */
interface Presenter
{
    /**
     * @param Response $response
     *
     * @return void
     */
    public function present(Response $response): void;

    /**
     * @return ListViewModel
     */
    public function getView(): ListViewModel;
}
