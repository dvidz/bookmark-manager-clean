<?php

namespace App\Tests\Unit\Bookmark\Infrastucture\Repository;

use Doctrine\Persistence\ObjectManager;
use Dvidz\Bookmark\Domain\Aggregate\Bookmark;
use Dvidz\Bookmark\Domain\ValueObject\Url;
use Dvidz\Bookmark\Infrastructure\Repository\BookmarkRepository;
use Dvidz\Bookmark\Infrastructure\Repository\InMemoryBookmarkRepository;
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

        // Now, mock the repository so it returns the mock of the employee
        $bookmarkRepository = $this->createMock(BookmarkRepository::class);
        // use getMock() on PHPUnit 5.3 or below
        // $employeeRepository = $this->getMock(ObjectRepository::class);
        $bookmarkRepository->expects($this->once())
            ->method('bookmark')
            ->with($bookmark);


        $bookmarkRepository->bookmark($bookmark);

//        $fetchedBookmark = $bookmarkRepository->getBookmark($bookmark->uuid());
//
//        $this->assertNotNull($fetchedBookmark);
//        $this->assertEquals($bookmark->provider(), $fetchedBookmark->getProviderName());
//        $this->assertEquals($bookmark->title(), $fetchedBookmark->getLinkTitle());
//        $this->assertEquals($bookmark->type(), $fetchedBookmark->getTypeLink()->getTypeLinkName());
    }
}