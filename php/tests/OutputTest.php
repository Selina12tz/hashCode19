<?php
declare(strict_types=1);

namespace App\Tests;

use App\Output;
use App\Slice;
use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    /** @test */
    public function itGeneratesOutput()
    {
        $output = new Output();
        $output->addSlice(new Slice(0, 0, 2, 1));
        $output->addSlice(new Slice(0, 2, 2, 2));
        $output->addSlice(new Slice(0, 3, 2, 4));

        $filename = __DIR__ . '/../resources/example.out';
        $expected = file_get_contents($filename);
        $this->assertEquals($expected, $output);
    }
}
