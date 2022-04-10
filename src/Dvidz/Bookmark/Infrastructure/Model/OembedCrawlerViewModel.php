<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Model;

use Dvidz\Shared\Domain\Model\ViewModel;

/**
 * Class OembedCrawlerViewModel.
 */
class OembedCrawlerViewModel implements ViewModel
{
    /**
     * @param string $url
     * @param string $title
     */
    private function __construct(public string $url, public string $title)
    {
    }

    /**
     * @param object $object
     *
     * @return ViewModel
     */
    public static function create(object $object): ViewModel
    {
        return new self(
            $object->url,
            $object->title
        );
    }
}
