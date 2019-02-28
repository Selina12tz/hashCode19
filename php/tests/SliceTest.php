<?php
declare(strict_types=1);

namespace App\Tests;

use App\Slice;
use PHPUnit\Framework\TestCase;

class SliceTest extends TestCase
{
    /** @test */
    public function itInitializes()
    {
        $slice = new Slice(0, 0, 1, 1);
        $this->assertInstanceOf(Slice::class, $slice);
    }
    /** @test */
    public function itGetsScoreCorrectly()
    {
        $slice = new Slice(0, 0, 1, 1);
        $this->assertEquals(1, $slice->getScore());

        $slice = new Slice(0, 0, 1, 10);
        $this->assertEquals(10, $slice->getScore());

        $slice = new Slice(0, 0, 2, 2);
        $this->assertEquals(4, $slice->getScore());

        $slice = new Slice(0, 0, 100, 5);
        $this->assertEquals(500, $slice->getScore());

        $slice = new Slice(0, 0, 4, 6);
        $this->assertEquals(24, $slice->getScore());
    }
    /** @test */
    public function itAcceptsCoordinatesInAnyOrder()
    {
        $slice = new Slice(1, 1, 0, 0);
        $this->assertEquals(1, $slice->getScore());

        $slice = new Slice(1, 10, 0, 0);
        $this->assertEquals(10, $slice->getScore());

        $slice = new Slice(2, 2, 0, 0);
        $this->assertEquals(4, $slice->getScore());

        $slice = new Slice(100, 5, 0, 0);
        $this->assertEquals(500, $slice->getScore());

        $slice = new Slice(4, 6, 0, 0);
        $this->assertEquals(24, $slice->getScore());
    }
}
