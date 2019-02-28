<?php
declare(strict_types=1);

namespace App\Tests;

use App\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    /** @test */
    public function itReadsInputParams()
    {
        $filename = __DIR__ . '/../resources/example.in';
        $input = new Input($filename);
        $this->assertEquals('3', $input->getR());
        $this->assertEquals('5', $input->getC());
        $this->assertEquals('1', $input->getL());
        $this->assertEquals('6', $input->getH());
    }
    /** @test */
    public function itReadsInputPizza()
    {
        $filename = __DIR__ . '/../resources/example.in';
        $input = new Input($filename);
        $pizza = [];
        $pizza[] = 'TTTTT';
        $pizza[] = 'TMMMT';
        $pizza[] = 'TTTTT';
        $this->assertEquals($pizza, $input->getPizza());
    }
}
