<?php

declare(strict_types=1);

namespace App\Tests\Unit\Humain\Domain;

use Dvidz\Human\Domain\Entity\Human;
use PHPUnit\Framework\TestCase;

/**
 * class HumainTest.
 */
class HumainTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function asADeveloperIWantToCreateAHumain()
    {
        $type = 'European';

        $humain = Human::createHuman($type);

        $this->assertInstanceOf(Human::class, $humain);
        $this->assertEquals('European', $humain->type());
    }
}
