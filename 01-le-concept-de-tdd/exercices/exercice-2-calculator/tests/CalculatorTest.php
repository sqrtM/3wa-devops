<?php

namespace App\Tests;

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new Calculator(2);
    }

    /**
     * @dataProvider provider
     */
    public function testAdd($a, $b)
    {
        self::assertEquals($a + $b, $this->calculator->add($a, $b));
    }

    /**
     * @dataProvider provider
     */
    public function testDivision($a, $b)
    {
        self::assertEquals($a / $b, $this->calculator->division($a, $b));
    }

    public function testExceptionDivision()
    {
        $this->expectException(\DivisionByZeroError::class);
        $this->calculator->division(12, 0);
    }

    public static function provider(): array
    {
        return array(
            array(1, 1),
            array(2, 2),
            array(3, 3),
            array(2.4, 2.4),
            array(10, 10),
            array(1.1, 1.1),
        );
    }
}
