<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bookmark\Domain;

use Api\Bookmark\Repository\InMemoryBookmarkRepository;
use Dvidz\Bookmark\Application\CreateBookmark\BookmarkCreator;
use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Entity\ValueType\Author;
use Dvidz\Bookmark\Domain\Entity\ValueType\BookmarkedAt;
use Dvidz\Bookmark\Domain\Entity\ValueType\MediaSize;
use Dvidz\Bookmark\Domain\Entity\ValueType\Provider;
use Dvidz\Bookmark\Domain\Entity\ValueType\PublishedAt;
use Dvidz\Bookmark\Domain\Entity\ValueType\Title;
use Dvidz\Bookmark\Domain\Entity\ValueType\Type;
use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Bookmark\Infrastructure\Specification\ValidUrlSpecification;
use Dvidz\Shared\Infrastructure\Uuid;
use PHPUnit\Framework\TestCase;

/**
 * Class BookmarkTest.
 */
class BookmarkTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     *
     * @throws \Exception
     */
    public function with_video_data_it_should_create_a_bookmark_instance_with_video_size(): void
    {
        $data = $this->getBookmarkTypeVideoData();

        $bookmark = Bookmark::bookmark(new Uuid(), new Url($data['url']), $data['provider'], $data['title'], $data['author'], $data['publishedAt'], $data['type'], $data['width'], $data['height'], $data['duration']);
        $this->assertInstanceOf(Bookmark::class, $bookmark);

        $this->assertIsString($bookmark->uuid());
        $this->assertNotEmpty($bookmark->uuid());

        $this->assertInstanceOf(Url::class, $bookmark->url());
        $this->assertEquals($data['url'], $bookmark->url());

        $this->assertInstanceOf(Provider::class, $bookmark->provider());
        $this->assertEquals($data['provider'], $bookmark->provider());

        $this->assertInstanceOf(Title::class, $bookmark->title());
        $this->assertEquals($data['title'], $bookmark->title());

        $this->assertInstanceOf(Author::class, $bookmark->author());
        $this->assertEquals($data['author'], $bookmark->author());

        $this->assertInstanceOf(BookmarkedAt::class, $bookmark->bookmarkedAt());
        $this->assertNotEmpty($bookmark->bookmarkedAt());

        $this->assertInstanceOf(PublishedAt::class, $bookmark->publishedAt());
        $this->assertEquals($data['publishedAt'], $bookmark->publishedAt()->format('Y-m-d'));

        $this->assertInstanceOf(Type::class, $bookmark->type());

        $this->assertInstanceOf(MediaSize::class, $bookmark->mediaSize());
        $this->assertEquals($data['width'], $bookmark->mediaSize()->width());
        $this->assertEquals($data['height'], $bookmark->mediaSize()->height());
        $this->assertEquals($data['duration'], $bookmark->mediaSize()->duration());
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \Exception
     */
    public function with_image_data_it_should_create_a_bookmark_instance_with_image_size(): void
    {
        $data = $this->getBookmarkTypeImageData();

        $bookmark = Bookmark::bookmark(new Uuid(), new Url($data['url']), $data['provider'], $data['title'], $data['author'], $data['publishedAt'], $data['type'], $data['width'], $data['height'], null);
        $this->assertInstanceOf(Bookmark::class, $bookmark);

        $this->assertIsString($bookmark->uuid());
        $this->assertNotEmpty($bookmark->uuid());

        $this->assertInstanceOf(Url::class, $bookmark->url());
        $this->assertEquals($data['url'], $bookmark->url());

        $this->assertInstanceOf(Provider::class, $bookmark->provider());
        $this->assertEquals($data['provider'], $bookmark->provider());

        $this->assertInstanceOf(Title::class, $bookmark->title());
        $this->assertEquals($data['title'], $bookmark->title());

        $this->assertInstanceOf(Author::class, $bookmark->author());
        $this->assertEquals($data['author'], $bookmark->author());

        $this->assertInstanceOf(BookmarkedAt::class, $bookmark->bookmarkedAt());
        $this->assertNotEmpty($bookmark->bookmarkedAt());

        $this->assertInstanceOf(PublishedAt::class, $bookmark->publishedAt());
        $this->assertEquals($data['publishedAt'], $bookmark->publishedAt()->format('Y-m-d'));

        $this->assertInstanceOf(Type::class, $bookmark->type());

        $this->assertInstanceOf(MediaSize::class, $bookmark->mediaSize());
        $this->assertEquals($data['width'], $bookmark->mediaSize()->width());
        $this->assertEquals($data['height'], $bookmark->mediaSize()->height());
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \Exception
     */
    public function given_an_invalid_email_it_should_throw_exception()
    {
        $this->expectException(UrlException::class);

        $badUrl = 'badurl';
        $bookmarkCreator = new BookmarkCreator(new InMemoryBookmarkRepository(), new Uuid(), new ValidUrlSpecification());

        $data = $this->getBookmarkTypeVideoData();
        $bookmarkCreator->bookmark($badUrl, $data['provider'], $data['title'], $data['author'], $data['publishedAt'], $data['type'], $data['width'], $data['height'], $data['duration']);
    }

    /**
     * @return array
     */
    private function getBookmarkTypeImageData(): array
    {
        return [
            'url' => 'https://www.flickr.com/photos/156601024@N05/46660978685/',
            'provider' => 'Flikr',
            'title' => 'Super title',
            'author' => 'Super author',
            'publishedAt' => '2021-09-23',
            'type' => 'image',
            'width' => 640,
            'height' => 480,
        ];
    }

    /**
     * @return array
     */
    private function getBookmarkTypeVideoData(): array
    {
        return [
            'url' => 'https://vimeo.com/5677655',
            'provider' => 'Vimeo',
            'title' => 'Super title',
            'author' => 'Super author',
            'publishedAt' => '2021-09-23',
            'type' => 'video',
            'width' => 640,
            'height' => 480,
            'duration' => 267,
        ];
    }
}
