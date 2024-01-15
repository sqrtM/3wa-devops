<?php

declare(strict_types=1);

namespace Exercise6\tests;

require __DIR__ . "/../Calculator.php";

use Exception;
use Exercise6\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    /**
     * @throws Exception
     */
    public function testEmptyStringEqualsZero()
    {
        self::assertEquals(0, $this->calculator->add(""));
    }

    /**
     * @throws Exception
     */
    public function testAddsCorrectly()
    {
        self::assertEquals(4, $this->calculator->add("2,2"));
        self::assertEquals(11, $this->calculator->add("4,4,3"));
        self::assertEquals(0, $this->calculator->add("0,0"));
        self::assertEquals(1998, $this->calculator->add("999,999"));
        self::assertEquals(2, $this->calculator->add("1,0,0,0,0,1"));
    }

    /**
     * @throws Exception
     */
    public function testAcceptsNewLinesAsSeparator()
    {
        self::assertEquals(4, $this->calculator->add("2\n2"));
        self::assertEquals(11, $this->calculator->add("4,4\n3"));
    }

    /**
     * @throws Exception
     */
    public function testDoesNotAcceptSuccessiveSeparators()
    {
        self::assertEquals(4, $this->calculator->add("2,2"));
        $this->expectExceptionMessage("Input contains a non-numeric character which is not a valid separator");
        self::assertEquals(11, $this->calculator->add("4,4,\n3"));
    }

    /**
     * @throws Exception
     */
    public function testAcceptsSingleCharCustomSeparator()
    {
        self::assertEquals(4, $this->calculator->add("//;\n2;2"));
        self::assertEquals(4, $this->calculator->add("//f\n2f2"));
        self::assertEquals(13, $this->calculator->add("//|\n4,4|3\n2"));
    }

    /**
     * @throws Exception
     */
    public function testDoesNotAcceptNegativeNumbers()
    {
        $this->expectExceptionMessage("Negative number(s) not allowed : -2");
        self::assertEquals(0, $this->calculator->add("//;\n2;-2"));
    }

    /**
     * @throws Exception
     */
    public function testExceptionsConcatCorrectly()
    {
        $this->expectExceptionMessage("Negative number(s) not allowed : -2\nNegative number(s) not allowed : -3\nInput contains a non-numeric character which is not a valid separator");
        self::assertEquals(0, $this->calculator->add("//;\n2;-2,-3,v"));
    }
}