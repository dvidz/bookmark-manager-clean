<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bookmark\Bus\Command;

use Api\Bookmark\Repository\BookmarkRepository;
use Api\Bookmark\Repository\InMemoryBookmarkRepository;
use Api\Kernel;
use Doctrine\Persistence\ManagerRegistry;
use Dvidz\Bookmark\Application\CreateBookmark\BookmarkCommand;
use Dvidz\Bookmark\Application\CreateBookmark\BookmarkCommandHandler;
use Dvidz\Bookmark\Application\CreateBookmark\BookmarkCreator;
use Dvidz\Bookmark\Application\CreateBookmark\Specification\UniqueUrlSpecification;
use Dvidz\Bookmark\Application\CreateBookmark\Specification\ValidUrlSpecification;
use Dvidz\Shared\Infrastructure\Uuid;
use PHPUnit\Framework\TestCase;

/**
 * Class BookmarkCommandHandlerTest.
 */
class BookmarkCommandHandlerTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \Exception
     */
    public function it_should_create_a_valid_bookmark(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();

        $repository = new InMemoryBookmarkRepository();

        $urlId = rand(1, 100000000);
        $command = new BookmarkCommand(
            'https://vimeo.com/'.$urlId,
            'Vimeo',
            'Super Title',
            'Super author',
            '2020-09-23',
            'video',
            1080,
            720,
            125
        );

        $bookmarkCommandHandler = new BookmarkCommandHandler(
            new BookmarkCreator(
                $repository,
                new Uuid(),
                new ValidUrlSpecification(),
                New UniqueUrlSpecification($repository)
            )
        );

        $bookmarkCommandHandler($command);
    }
}
