<?php

namespace App\Tests\Unit\Bookmark\Infrastucture\Repository;

use Api\Bookmark\Repository\BookmarkRepository;
use Dvidz\Bookmark\Domain\Bookmark;
use Dvidz\Bookmark\Domain\Url;
use Dvidz\Shared\Infrastructure\Uuid;
use PHPUnit\Framework\TestCase;

class BookmarkRepositoryTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function given_a_bookmark_it_should_save()
    {
        $data = [
            'url' => 'https://www.flickr.com/photos/156601024@N05/46660978685/',
            'provider' => 'Flikr',
            'title' => 'Super title',
            'author' => 'Super author',
            'publishedAt' => '2021-09-23',
            'type' => 'image',
            'width' => 640,
            'height' => 480,
        ];

        $bookmark = Bookmark::bookmark(new Uuid(), new Url($data['url']), $data['provider'], $data['title'], $data['author'], $data['publishedAt'], $data['type'], $data['width'], $data['height'], null);

        $bookmarkRepository = $this->createMock(BookmarkRepository::class);
        $bookmarkRepository->expects($this->once())
            ->method('bookmark')
            ->with($bookmark);


        $bookmarkRepository->bookmark($bookmark);
    }
}