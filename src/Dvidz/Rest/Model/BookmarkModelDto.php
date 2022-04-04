<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

/**
 * Class BookmarkModelDto.
 */
class BookmarkModelDto
{
    public int $id;
    public string $url;
    public string $providerName;
    public ?string $linkTitle;
    public ?string $linkAuthor;
    public string $createAt;
    public ?string $publishedDate;
    public string $type;
    public ?string $videoHeight;
    public ?string $videoWidth;
    public ?string $videoDuration;
    public ?string $imageHeight;
    public ?string $imageWidth;
}
