<?php
declare(strict_types=1);

namespace App\Tests;

use App\Row;
use App\Slice;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{
    /** @test */
    public function itInstantiates()
    {
        $row = new Row();
        $this->assertInstanceOf(Row::class, $row);
    }
    /** @test */
    public function itReturnsZeroScoreIfEmpty()
    {
        $row = new Row();
        $this->assertSame(0, $row->getScore());
    }
    /** @test */
    public function itReturnsSumOfSlicesAsScore()
    {
        $row = new Row();
        $slice1 = new Slice(0, 0, 1, 1);
        $slice2 = new Slice(0, 0, 2, 2);
        $row->addSlice($slice1);
        $row->addSlice($slice2);

        $sliceScore = $slice1->getScore() + $slice2->getScore();
        $this->assertSame($sliceScore, $row->getScore());
    }
}
