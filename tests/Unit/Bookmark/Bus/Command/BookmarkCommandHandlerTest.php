<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bookmark\Bus\Command;

use Api\Kernel;
use Doctrine\Persistence\ManagerRegistry;
use Dvidz\Bookmark\Application\Create\Command\BookmarkCommand;
use Dvidz\Bookmark\Application\Create\Command\BookmarkCommandHandler;
use Dvidz\Bookmark\Application\Create\Command\BookmarkCreator;
use Dvidz\Bookmark\Domain\Bookmark;
use Dvidz\Bookmark\Infrastructure\Specification\ValidUrlSpecification;
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

        /** @var ManagerRegistry $managerRegistry */
        $managerRegistry = $kernel->getContainer()->get('doctrine');
        $repository = $managerRegistry->getRepository(Bookmark::class);

        $command = new BookmarkCommand(
            'https://vimeo.com/345678/',
            'Vimeo',
            'Super Title',
            'Super author',
            '2020-09-23',
            'video',
            1080,
            720,
            125
        );

        $bookmarkCommandHandler = new BookmarkCommandHandler(new BookmarkCreator($repository, new Uuid(), new ValidUrlSpecification()));
        $bookmark = $bookmarkCommandHandler($command);

        $this->assertNotEmpty($bookmark);
    }
}